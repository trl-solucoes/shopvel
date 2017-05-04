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

class AdminController extends Controller {

    public function getDashboard() {
        $models['qtdePedidos']['total'] = Venda::count();
        $models['qtdePedidos']['pendentes-pagamento'] = Venda::naoPagas()->count();
        $models['qtdePedidos']['pagos'] = Venda::pagas()->count();
        $models['qtdePedidos']['finalizados'] = Venda::finalizadas()->count();
        return view('admin.dashboard', $models);
    }
    
    public function getPerfil() {
        return view('admin.perfil');
    }
    
    public function getPedidos(Request $req, $id = null) {
        if ($id == null) {
            if ($req->has('status') == false) {
                $models['tipoVisao'] = 'Todos';
                $models['pedidos'] = Venda::all();
            } else {
                if ($req->status == 'nao-pagos') {
                    $models['tipoVisao'] = 'Não Pagos';
                    $models['pedidos'] = Venda::naoPagas()->get();
                } else if ($req->status == 'pagos') {
                    $models['tipoVisao'] = 'Pagos';
                    $models['pedidos'] = Venda::pagas()->get();
                } else if ($req->status == 'finalizados') {
                    $models['tipoVisao'] = 'Finalizados/Enviados';
                    $models['pedidos'] = Venda::finalizadas()->get();
                }
            }
            return view('admin.pedidos-listar', $models);
        }

        $models['pedido'] = Venda::find($id);
        return view('admin.pedido-detalhes', $models);
    }
    
    public function putPedidoPago(Request $request, $id) {
        $pedido = Venda::find($id);
        
        if ($pedido == null) {
            return back()->withErrors('Pedido não encontrado!');
        }
        
        $pedido->pago = TRUE;
        $pedido->save();
        
        return redirect()->route('admin.pedidos', '?status=pagos')->with('mensagens-sucesso', 'Pedido atualizado');
    }
    
    public function putPedidoFinalizado(Request $request, $id) {
        $pedido = Venda::find($id);
        
        if ($pedido == null) {
            return back()->withErrors('Pedido não encontrado!');
        }
        
        $pedido->enviado = TRUE;
        $pedido->save();
        
        return redirect()->route('admin.pedidos', '?status=finalizados')->with('mensagens-sucesso', 'Pedido finalizado');
    }
    function getSobre() {
        return view('admin.sobre');
    }
}
