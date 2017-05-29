<?php

namespace Shoppvel\Http\Controllers;

use Illuminate\Http\Request;
use Shoppvel\Http\Requests;
use Shoppvel\Models\Produto;
use Shoppvel\Models\Categoria;
use Shoppvel\Models\Marca;

class FrenteLojaController extends Controller {

    function getIndex() {
        /**
         * Verifique o arquivo Controller.php onde usamos uma variavel
         * compartilhada (global) para todas as views, que devem ser motrar
         * as categorias do lado esquerdo em nosso sistema, assim não precisamos
         * chamar em cada acao a lista de categorias para popular aquele menu
         */
        $models['produtos'] = Produto::where('destacado', 'LIKE', '1')->paginate(20);
        $models['listcategorias'] = Categoria::all();
        //$models['listmarcas'] = Marca::all();
        //$models['produtos'] = \Shoppvel\Models\Produto::Paginate(20);
        return view('frente.entrada', $models);
    }

    function getSobre() {
        //$models['listmarcas'] = Marca::all();
        return view('sobre');
    }

    function oferta(){
        $models['produtos'] = Produto::where([
    ['destacado', '=', '1'],
    ['id', '<=', '40'],
])->paginate(20);
        return view('frente.entrada',$models);
    }
}
