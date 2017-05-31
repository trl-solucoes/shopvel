<?php

namespace Shoppvel\Http\Controllers;

use Illuminate\Http\Request;
use Shoppvel\Http\Requests;
use Shoppvel\Models\Carrinho;
use Shoppvel\Models\Produto;
use Shoppvel\Models\Marca;
//use Shoppvel\Controllers\ClienteController;
use Illuminate\Support\Facades\Auth;
use laravel\pagseguro\Config\Config;
use laravel\pagseguro\Credentials\Credentials;
use laravel\pagseguro\Checkout\Facade\CheckoutFacade;
use DB;

class CarrinhoController extends Controller {

    private $carrinho = null;

    function __construct() {
        parent::__construct();
        $this->carrinho = new Carrinho();
    }

    function anyAdicionar(Request $request, $id) {
        $est = Produto::find($id)->qtde_estoque;
        if ($id == null) {
            return \Redirect::back()
                            ->withErrors('Nenhum código de produto informado para adicionar ao carrinho.');
        }
        // se um id foi passado e a adição ao carrinho está ok
        if ($this->carrinho->add($id, $request->get('qtde'))) {
            return redirect()->route('carrinho.listar')
                            ->with('mensagens-sucesso', 'Produto adicionado ao carrinho');
        }

        return \Redirect::back()->withErrors('Erro ao adicionar produto no carrinho');
    }

    function getListar() {
        $models = $this->getCarrinhoModels();
        if(isset($models['itens'][0])){
            $id = $models['itens'][0]->produto->marca_id;
            $models['marcas'] = DB::table('marcas')->join('produtos', 'produtos.marca_id', '=', 'marcas.id')->where('produtos.marca_id', '=', $id)->take(4)->get();
        }
        return view('frente.carrinho-listar', $models);
    }

    function getEsvaziar() {
        $this->carrinho->esvaziar();
        return redirect('/')->with('mensagens-sucesso', 'Carrinho vazio');
    }

    /**
     * Função para montar
     * o link de pagamento de um carrinho com  o Pagseguro
     * 
     * @return type
     */
    protected function checkout() {
        $models = null;
        if (\Auth::user()) {

            $user = \Auth::user();

            $itens = [];

            foreach ($this->carrinho->getItens() as $item) {
                $itens[] = [
                    'id' => $item->produto->id,
                    'description' => $item->produto->nome,
                    'quantity' => $item->qtde,
                    'amount' => $item->produto->preco_venda,
                ];
            }


            $dadosCompra = [
                'items' => $itens,
                'sender' => [
                    'email' => $user->email,
                    'name' => $user->name,
                ]
            ];

            if ($user->cpf) {
                $dadosCompra['sender']['documents'] = [
                    [
                        'number' => $user->cpf,
                        'type' => 'cpf'
                    ]
                ];
            }

            $checkout = \PagSeguro::checkout()->createFromArray($dadosCompra);
            try {
                $models['info'] = $checkout->send(\PagSeguro::credentials()->get());
            } catch (\Exception $e) {
                $models = null;
            }
        }
        return $models;
    }

    /**
     * Método interno do controlador carrinho para montar as classes modelo
     * as serem passadas para as diversas visões que as necessitam
     */
    private function getCarrinhoModels() {
        $models['itens'] = $this->carrinho->getItens();
        $models['total'] = $this->carrinho->getTotal();
        if ($models['itens']->count() > 0) {
            $models['pagseguro'] = $this->checkout();
        }
        return $models;
    }

    function remover_item($id){
        $this->carrinho->deleteItem($id);
        return redirect('/carrinho');
    }

    public function getFinalizarCompra() {
        if ($this->carrinho->getItens()->count() == 0) {
            return back()->withErrors('Nenhum item no carrinho para finalizar compra!');
        }

        $models = $this->getCarrinhoModels();

        return view('frente.finalizar-compra', $models);
    }

    function calcFrete(Request $request){

            $cep = $request->get('cep');
            $cep_origem = "84072020";
            $peso = 2.0;
            $valor = 200;
            $tipo_frete = 41106;
            $altura = 6;
            $largura = 20;
            $comprimento = 20;

            $url = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?";
            $url .="nCdEmpresa=";
            $url .="&sDsSenha=";
            $url .="&sCepOrigem=84072020";
            $url .="&sCepDestino=" . $cep;
            $url .="&nVlPeso=" . $peso;
            $url .="&nVlLargura=" . $largura;
            $url .="&nVlAltura=" . $altura;
            $url .="&nCdFormato=1";
            $url .="&nVlComprimento=" . $comprimento;
            $url .="&sCdMaoPropria=n";
            $url .="&nVlValorDeclarado=" . $valor;
            $url .="&sCdAvisoRecebimento=n";
            $url .="&nCdServico=" . $tipo_frete;
            $url .="&nVlDiamentro=0";
            $url .="&StrRetorno=xml";
            
            $xml = simplexml_load_file($url);

            $models = $this->getCarrinhoModels();
            $models['valorfrete'] = $xml->cServico->Valor;
            $models['prazo'] = $xml->cServico->PrazoEntrega;
            //dd($xml->cServico);

            return view('frente.carrinho-listar', $models);
            //return redirect()->route('carrinho.listar')->with($models);

    }
}
