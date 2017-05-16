<?php

namespace Shoppvel\Http\Controllers;

use Illuminate\Http\Request;
use Shoppvel\Http\Requests;
use Shoppvel\Models\Carrinho;
use Shoppvel\Models\Produto;
use Illuminate\Support\Facades\Auth;

class CarrinhoController extends Controller {

    private $carrinho = null;

    function __construct() {
        parent::__construct();
        $this->carrinho = new Carrinho();
    }

    function anyAdicionar(Request $request, $id) {
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
        return redirect()
            ->route('carrinho.listar');
    }

    public function getFinalizarCompra() {
        if ($this->carrinho->getItens()->count() == 0) {
            return back()->withErrors('Nenhum item no carrinho para finalizar compra!');
        }

        $models = $this->getCarrinhoModels();

        return view('frente.finalizar-compra', $models);
    }

}
