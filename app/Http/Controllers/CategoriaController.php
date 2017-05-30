<?php

namespace Shoppvel\Http\Controllers;

use Illuminate\Http\Request;
use Shoppvel\Http\Requests;
use Shoppvel\Models\Categoria;
use Shoppvel\Models\Marca;
use Shoppvel\Http\Requests\CategoriaRequest;
use Shoppvel\Http\Requests\CategoriaUpdateRequest;

class CategoriaController extends Controller {

    function getCategoria($id = null) {
        if ($id == null) {
            $models['listcategorias'] = Categoria::all();
            //$models['listmarcas'] = Marca::all();
            return view('frente.categorias', $models);
        }
        
        // se um id foi passado
        $models['categoria'] = \Shoppvel\Models\Categoria::find($id);
        $models['listmarcas'] = Marca::all();
        return view('frente.produtos-categoria', $models);
    }
    
    function listCategoria(){
    	return view('admin.categorias.listCategorias');
    }
    function formCategoria(){
    	$categorias['categoria'] = Categoria::all();
    	return view('admin.categorias.cadCategoria', $categorias);
    }
    function editar($id) {
        $models['categoria'] = \Shoppvel\Models\Categoria::find($id);
            return view('admin.categoria.form', $models);
        }
    function salvar(Request $request){
    	$categoria = new Categoria();
    	$categoria->create($request->all());
    	\Session::flash('mensagens-sucesso', 'Cadastrado com Sucesso');
            return redirect()->action('CategoriaController@listCategoria');
    }
    function setCategoria(Request $request){
    	$categoria=new Categoria();
    	$categoria->id=$request->id;
    	$categoria->nome=$request->nome;
    	$categoria->id_pai=$request->id_pai;
    	$categoria->save();
    }
    function excluirCategoria($id){
    	$categorias['categoria']=\Shoppvel\Models\Categoria::find($id)->delete();
    	\Session::flash('mensagens-sucesso', 'Excluida com Sucesso');
        return redirect()->action('CategoriaController@listCategoria');

    }
    function editCategoria($id){
        $models['listcategorias']=Categoria::find($id);
        return view('admin.categorias.editCategoria',$models);
    }

    public function atualizarCategoria(Request $request, $id) {

        $data = $request->all();

        if(Categoria::find($id)->update($data)){
           return redirect()->action('CategoriaController@listCategoria')->with('mensagens-sucesso', 'Atualizado com Sucesso!');
       } else {
           return redirect()->back()
           ->with('mensagens-erro', 'Erro!!!')
           ->withInput();
       }

   }
}
