<?php

/*
  |--------------------------------------------------------------------------
  | Routes File
  |--------------------------------------------------------------------------
  |
  | Here is where you will register all of the routes in an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */


/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | This route group applies the "web" middleware group to every route
  | it contains. The "web" middleware group is defined in your HTTP
  | kernel and includes session state, CSRF protection, and more.
  |
 */

Route::post('/pagseguro/notification', [
    'uses' => '\laravel\pagseguro\Platform\Laravel5\NotificationController@notification',
    'as' => 'pagseguro.notification',
]);

Route::auth();

Route::get('/', 'FrenteLojaController@getIndex');

Route::get('admin/',function(){
  return view('frente.entrada');
});

Route::get('admin/sobre', [
    'as' => 'admin.sobre',
    'uses' => 'AdminController@getSobre'
]);

Route::any('calcfrete', [
  'as' => 'frete.calcular',
  'uses' => 'CarrinhoController@calcFrete'
]);

Route::get('sobre', [
    'as' => 'sobre',
    'uses' => 'FrenteLojaController@getSobre'
]);
Route::get('oferta/listar',[
  'as'=> 'oferta.listar',
  'uses' => 'FrenteLojaController@oferta'
]);
Route::get('pagseguro/checkout', [
    'as' => 'pagseguro.checkout',
    'uses' => 'PedidoController@postCheckout'
]);
Route::get('categoria/{id?}', [
    'as' => 'categoria.listar',
    'uses' => 'CategoriaController@getCategoria'
]);
/*
 * ATENÇÃO para esta rota, ela deve estar antes de produto/{id}
 * para funcionar
 */
Route::any('produto/buscar', [
    'as' => 'produto.buscar',
    'uses' => 'ProdutoController@getBuscar'
]);
Route::get('produto/{id}', [
    'as' => 'produto.detalhes',
    'uses' => 'ProdutoController@getProdutoDetalhes'
]);
Route::get('imagem/arquivo/{nome}', [
    'as' => 'imagem.file',
    'uses' => 'ImagemController@getImagemFile'
]);

Route::any('carrinho/adicionar/{id}', [
    'as' => 'carrinho.adicionar',
    'uses' => 'CarrinhoController@anyAdicionar'
]);

Route::get('carrinho', [
    'as' => 'carrinho.listar',
    'uses' => 'CarrinhoController@getListar'
]);

Route::get('carrinho/esvaziar', [
    'as' => 'carrinho.esvaziar',
    'uses' => 'CarrinhoController@getEsvaziar'
]);

Route::any('carrinho/remover-item/{id}', [
    'as' => 'carrinho.remover-item',
    'uses' => 'CarrinhoController@remover_item'
]);

Route::group(['middleware' => ['auth']], function () {
    Route::get('carrinho/finalizar-compra', [
        'as' => 'carrinho.finalizar-compra',
        'uses' => 'CarrinhoController@getFinalizarCompra'
    ]);
Route::post('carrinho/avaliar', [
    'as' => 'carrinho.avaliar',
    'uses' => 'CarrinhoController@Avaliar'

]);

    Route::get('cliente/dashboard', [
        'as' => 'cliente.dashboard',
        'uses' => 'ClienteController@getDashboard'
    ]);

    Route::get('cliente/pedidos/{id?}', [
        'as' => 'cliente.pedidos',
        'uses' => 'ClienteController@getPedidos'
    ]);
    Route::get('cliente/perfil', [
        'as' => 'cliente.perfil',
        'uses' => 'ClienteController@getPerfil'
    ]);
    Route::any('cliente/avaliar/{id}', [
        'as' => 'cliente.avaliar',
        'uses' => 'ClienteController@postAvaliar'
    ]);

    Route::get('admin', [
      'as' => 'admin',
      'uses' => 'AdminController@getDashboard'
    ]);
    Route::get('admin/dashboard', [
        'as' => 'admin.dashboard',
        'uses' => 'AdminController@getDashboard'
    ]);
    Route::put('admin/pedido/pago/{id}', [
        'as' => 'admin.pedido.pago',
        'uses' => 'AdminController@putPedidoPago'
    ]);
    Route::put('admin/pedido/finalizado/{id}', [
        'as' => 'admin.pedido.finalizado',
        'uses' => 'AdminController@putPedidoFinalizado'
    ]);
    Route::get('admin/pedidos/{id?}', [
        'as' => 'admin.pedidos',
        'uses' => 'AdminController@getPedidos'
    ]);
    Route::get('admin/perfil', [
        'as' => 'admin.perfil',
        'uses' => 'AdminController@getPerfil'
    ]);
    //Apartir daqui

    Route::get('admin/listCategoria',[
        'as'=>'admin.listCategoria',
        'uses'=>'CategoriaController@listCategoria'
    ]);
     Route::get('admin/cadCategoria',[
        'as'=>'admin.cadCategoria',
        'uses'=>'CategoriaController@formCategoria'
    ]);
     Route::post('admin/saveCategoria', [
        'as'=>'admin.saveCategoria',
        'uses'=>'CategoriaController@salvar']);

     Route::get('admin/deleteCategoria/{id}',[
        'as'=>'admin.deleteCategoria',
        'uses'=>'CategoriaController@excluirCategoria']);
     
     Route::get('admin/editCategoria/{id}',[
        'as'=>'admin.editCategoria',
        'uses'=>'CategoriaController@editCategoria']);

     Route::patch('admin/updtCategoria/{id}',[
        'as'=>'admin.updtCategoria',
         'uses'=> 'CategoriaController@atualizarCategoria']);

     Route::get('admin/listProduto',[
        'as'=>'admin.listProduto',
        'uses'=>'ProdutoController@listProduto']);

     Route::get('admin/cadProduto',[
        'as'=>'admin.cadProduto',
        'uses'=>'ProdutoController@formProduto']);

     Route::post('admin/saveProduto', [
        'as'=>'admin.saveProduto',
        'uses'=>'ProdutoController@salvar']);

     Route::get('admin/deleteProduto/{id}',[
        'as'=>'admin.deleteProduto',
        'uses'=>'ProdutoController@excluirProduto']);
     
     Route::get('admin/editProduto/{id}',[
        'as'=>'admin.editProduto',
        'uses'=>'ProdutoController@editProduto']);

     Route::patch('admin/updtProduto/{id}',[
        'as'=>'admin.updtProduto',
         'uses'=> 'ProdutoController@atualizarProduto']);

     Route::get('admin/listMarca',[
        'as'=>'admin.listMarca',
        'uses'=>'MarcaController@listMarca']);

     Route::get('admin/cadMarcas',[
        'as'=>'admin.cadMarcas',
        'uses'=>'MarcaController@cadMarca']);

     Route::post('admin/saveMarca',[
        'as'=>'admin.saveMarca',
        'uses'=>'MarcaController@saveMarca']);

     Route::get('admin/deleteMarca/{id}',[
        'as'=>'admin.deleteMarca',
        'uses'=>'MarcaController@excluirMarca']);

     Route::get('admin/editMarca/{id}',[
        'as'=>'admin.editMarca',
        'uses'=>'MarcaController@editMarca']);

     Route::patch('admin/updtMarca/{id}', [
        'as'=>'admin.updtMarca',
        'uses'=>'MarcaController@updtMarca']);
     
     Route::get('admin/adminUsers',[
        'as'=>'admin.adminUsers',
        'uses'=>'AdminController@adminUsers'
      ]);
     Route::get('admin/removeUser/{id}',[
        'as'=>'admin.removeUser',
        'uses'=>'AdminController@removeUser'
      ]);
});


//Route::get('/home', 'HomeController@index');
