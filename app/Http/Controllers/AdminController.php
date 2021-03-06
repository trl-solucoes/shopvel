<?php

namespace Shoppvel\Http\Controllers;

use Illuminate\Http\Request;
use Shoppvel\Http\Requests;
use Shoppvel\Models\Carrinho;
use Shoppvel\Models\Produto;
use Shoppvel\Models\Venda;
use Shoppvel\Models\VendaItem;
use Shoppvel\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

class AdminController extends Controller {

    public function getDashboard() {
        $u = Auth::guard()->user();
        if($u['role'] != 'admin'){
                return redirect()->action('FrenteLojaController@getIndex');
            }else{    
                $models['qtdePedidos']['total'] = Venda::count();
                $models['qtdePedidos']['pendentes-pagamento'] = Venda::naoPagas()->count();
                $models['qtdePedidos']['pagos'] = Venda::pagas()->count();
                $models['qtdePedidos']['finalizados'] = Venda::finalizadas()->count();
                return view('admin.dashboard', $models);    
            }
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

    function adminUsers(){
        $models['usuarios']=User::all();
        //dd($models);
        return view('admin.adminuser.list-users',$models);
    }
    function removeUser($id){
        $models['user']=User::find($id)->delete();
        \Session::flash('mensagens-sucesso', 'Usuário excluído com Sucesso');
        return redirect()->route('admin.adminUsers');
    }
     function editUser(Request $request)
    {
        
        // retira pontos e traços do cpf pois eh melhor 
        // gravar sem formatação para garantir padronização dos dados
        if(isset($request->senha)){
            User::find($request->id)->update([
                'name' => $request->nome,
                'endereco' => $request->endereco,
                'password' => bcrypt($request->senha)
                     
            ]);
        }else{
             User::find($request->id)->update([
                'name' => $request->nome,
                'endereco' => $request->endereco,
            ]);
        } 
         \Session::flash('mensagens-sucesso', 'Usuário atualizado com Sucesso!!');
        return redirect()->route('admin.adminUsers');
    }
   
}
