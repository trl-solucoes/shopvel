<?php

namespace Shoppvel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Shoppvel\Http\Requests;
use Shoppvel\Models\Carrinho;
use Shoppvel\Models\Produto;
use Shoppvel\Models\Venda;
use Shoppvel\Models\VendaItem ;
use Illuminate\Support\Facades\Auth;
use laravel\pagseguro\Config\Config;
use laravel\pagseguro\Credentials\Credentials;
use laravel\pagseguro\Checkout\Facade\CheckoutFacade;

class PedidoController extends Controller {

    private $carrinho = null;

    function __construct() {
        parent::__construct();
        $this->carrinho = new Carrinho();
    }

    /**
     * Método que salva um pedido, chamado pelo Pagseguro ao redirecionar
     * de um pagamento realizado/iniciado.
     * 
     * Recebe por parâmetro de query string o transaction_id, que é a identificação
     * da transação no Pagseguro e será gravado junto com os dados do pedido
     * para poder recuperar informações de lá
     * 
     * @param Request $req
     */
    public function postCheckout(Request $req) {
        if ($req->has('transaction_id') === FALSE) {
            return back()->withErrors('Problemas ao receber a chave de trasação do Pagseguro, '
                    . 'este pedido não foi gravado');
        }
        
        $pedido = new Venda();
        
        /**
         * Trabalha com a inserção de venda e itens de venda dentro de uma
         * transação do banco de dados, para evitar inconsistências
         */
        DB::beginTransaction();
        
        $pedido->user_id = \Auth::user()->id;
        $pedido->data_venda = \Carbon\Carbon::now();
        $pedido->valor_venda = $this->carrinho->getTotal();
        $pedido->pagseguro_transaction_id = $req->transaction_id;
        $pedido->save();
        
        foreach ($this->carrinho->getItens() as $idx => $itemCarrinho) {
            $itemVenda = new VendaItem();
            $itemVenda->produto_id = $itemCarrinho->produto->id;
            $itemVenda->qtde = $itemCarrinho->qtde;
            $itemVenda->preco_venda = $itemCarrinho->produto->preco_venda;
            
            // TODO atualizar status de pagamento
         
            $pedido->itens()->save($itemVenda);
            
            $itemCarrinho->produto->decrement('qtde_estoque', $itemCarrinho->qtde);
        }
        
        /**
         * Se nenhum erro ocorrer confirma o conjunto de ações no banco com 
         * um commit, caso contrário um rollback executará por padrão
         * se um commit não for chamado explicitamente
         */
        DB::commit();

        $this->carrinho->esvaziar();

        return redirect()
            ->route('cliente.dashboard')
            ->with('mensagens-sucesso', 'Pedido realizado com sucesso.');
    }

    public function postCheckoutNotification(Request $req) {
        echo('NOTIFICATON Ainda não implementado<br/>');
        dd($req->all());
    }

}
