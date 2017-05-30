<?php

namespace Shoppvel\Http\Controllers;

use Illuminate\Http\Request;
use Shoppvel\Http\Requests;
use Shoppvel\Models\Marca;
use Shoppvel\Models\Produto;
use Shoppvel\Models\Categoria;

class MarcaController extends Controller {

    function getMarca($id) {
        $models['categoria'] = Categoria::all();
        $models['listmarcas'] = Marca::all();
        $models['marca'] = \Shoppvel\Models\Marca::find($id);
        return view('frente.produtos-marca', $models);
    }

    function listMarca(){
        $models['listmarcas'] = Marca::all();
        return view('admin.marcas.listMarcas', $models);
    }

    function cadMarca(){
        return view('admin.marcas.cadMarcas');
    }

    function saveMarca(Request $request) {
        $marca = new Marca();
        $marca->create($request->all());
        \Session::flash('mensagens-sucesso', 'Cadastrada com Sucesso');
        return redirect()->action('MarcaController@listMarca');
    }

    function excluirMarca($id){
        $marca['marca'] = Marca::find($id)->delete();
        \Session::flash('mensagens-sucesso', 'Excluida com Sucesso');
        return redirect()->action('MarcaController@listMarca');
    }

    function editMarca($id){
        $models['marca'] = Marca::find($id);
        return view('admin.marcas.editMarcas', $models);
    }

    function updtMarca(Request $request, $id){
        $data = $request->all();

        if(Marca::find($id)->update($data)){
           return redirect()->action('MarcaController@listMarca')->with('mensagens-sucesso', 'Atualizado com Sucesso!');
       } else {
           return redirect()->back()
           ->with('mensagens-erro', 'Erro!!!')
           ->withInput();
       }
    }
}
