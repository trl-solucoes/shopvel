<?php

namespace Shoppvel\Http\Controllers;

use Illuminate\Http\Request;
use Shoppvel\Http\Requests;
use Shoppvel\Models\Carrinho;
use Shoppvel\Models\Produto;
use Shoppvel\Models\Venda;
use Shoppvel\Models\VendaItem ;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

class ClienteController extends Controller {

    public function getDashboard() {
        $models['qtdePedidos']['total'] = Auth::user()->vendas()->count();
        $models['qtdePedidos']['pendentes-pagamento'] = Auth::user()->vendasNaoPagas()->count();
        $models['qtdePedidos']['pagos'] = Auth::user()->vendasPagas()->count();
        $models['qtdePedidos']['finalizados'] = Auth::user()->vendasFinalizadas()->count();
        return view('frente.cliente.dashboard', $models);
    }
    
    public function getPerfil() {
        return view('frente.cliente.perfil');
    }
    
    public function getPedidos(Request $req, $id = null) {
        if ($id == null) {
            if ($req->has('status') == false) {
                $models['tipoVisao'] = 'Todos';
                $models['pedidos'] = \Auth::user()->vendas;
            } else {
                if ($req->status == 'nao-pagos') {
                    $models['tipoVisao'] = 'Não Pagos';
                    $models['pedidos'] = \Auth::user()->vendasNaoPagas;
                } else if ($req->status == 'pagos') {
                    $models['tipoVisao'] = 'Pagos';
                    $models['pedidos'] = \Auth::user()->vendasPagas;
                } else if ($req->status == 'finalizados') {
                    $models['tipoVisao'] = 'Finalizados/Enviados';
                    $models['pedidos'] = \Auth::user()->vendasFinalizadas;
                }
            }
            return view('frente.cliente.pedidos-listar', $models);
        }

        $models['pedido'] = Venda::find($id);
        return view('frente.cliente.pedido-detalhes', $models);
    }
    
    public function postAvaliar(Request $req, $itemVendaId) {
        $itemVenda = VendaItem::find($itemVendaId);
        $produto = $itemVenda->produto;
        
        DB::beginTransaction();

        $itemVenda->avaliado = true;
        $itemVenda->save();
        
        $produto->increment('avaliacao_qtde');
        $produto->increment('avaliacao_total', $req->avaliacao);
        $produto->save();
        
        DB::commit();
        
        return back()->with('mensagens-sucesso', 'Produto avaliado com sucesso!');
    }
}
