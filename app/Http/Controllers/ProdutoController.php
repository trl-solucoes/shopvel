<?php

namespace Shoppvel\Http\Controllers;

use Illuminate\Http\Request;
use Shoppvel\Http\Requests;
use Shoppvel\Models\Produto;
use Shoppvel\Models\Marca;

class ProdutoController extends Controller {

    function getProdutoDetalhes($id) {
        $models['produto'] = Produto::find($id);
        return view('frente.produto-detalhes', $models);
    }

    function getBuscar(Request $request) {
        $this->validate($request, [
            'termo-pesquisa' => 'required|filled'
                ]
        );

        $termo = $request->get('termo-pesquisa');

        $produtos = Produto::where('nome', 'LIKE', '%' . $termo . '%')
                ->paginate(10);
        //$produtos->setPath('buscar/'.$termo);
        $models['produtos'] = $produtos;
        $models['termo'] = $termo;
        return view('frente.resultado-busca', $models);
    }

    function listProduto(){
        $produtos['listprodutos'] = Produto::paginate(20);
        return view('admin.produtos.listProduto', $produtos);
    }

    function formProduto(){
        $marcas['listmarcas'] = Marca::all();
        return view('admin.produtos.cadProduto', $marcas);
    }

    function salvar(Request $request) {
        $produto = new Produto();
        $produto->nome = $request->nome;
        $produto->descricao = $request->descricao;
        $produto->categoria_id = $request->categoria_id;
        $produto->marca_id = $request->marca_id;
        $produto->qtde_estoque = $request->qtde_estoque;
        $produto->preco_venda = $request->preco_venda;
        $produto->imagem_nome = $request->imagem_nome;
        $produto->destacado = $request->destacado;
        $produto->save();
        \Session::flash('mensagens-sucesso', 'Cadastrado com Sucesso');
        return redirect()->action('ProdutoController@listProduto')->with('mensagens-sucesso', 'Cadastrado com Sucesso!');
    }

    function excluirProduto($id) {
        $models['produto'] = Produto::find($id)->delete();
        \Session::flash('mensagens-sucesso', 'Excluido com Sucesso');
            return redirect()->action('ProdutoController@listProduto');
    }

    function editProduto($id) {
        $models['produto'] = Produto::find($id);
        $models['listmarcas'] = Marca::all();    
            return view('admin.produtos.editProduto', $models);
    }

    public function atualizarProduto(Request $request, $id) {

        $data = $request->all();

        if(Produto::find($id)->update($data)){
           return redirect()->action('ProdutoController@listProduto')->with('mensagens-sucesso', 'Atualizado com Sucesso!');
       } else {
           return redirect()->back()
           ->with('mensagens-erro', 'Erro!!!')
           ->withInput();
       }

   }

}
