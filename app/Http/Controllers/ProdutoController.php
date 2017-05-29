<?php

namespace Shoppvel\Http\Controllers;

use Illuminate\Http\Request;
use Shoppvel\Http\Requests;
use Shoppvel\Models\Produto;
use Shoppvel\Models\Marca;
use Shoppvel\Models\Categoria;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;
use DB;

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
        $models['listprodutos'] = Produto::all();
        $models['listcategorias'] = Categoria::all();
        return view('admin.produtos.listProduto', $produtos);
    }

    function formProduto(){
        $marcas['listmarcas'] = Marca::all();
        return view('admin.produtos.cadProduto', $marcas);
    }

    public function limpaVariavel($var){
        $novo = preg_replace(array("/(á|à|ã|â|ä)/","/(Á|À|Ã|Â|Ä)/","/(é|è|ê|ë)/","/(É|È|Ê|Ë)/","/(í|ì|î|ï)/","/(Í|Ì|Î|Ï)/","/(ó|ò|õ|ô|ö)/","/(Ó|Ò|Õ|Ô|Ö)/","/(ú|ù|û|ü)/","/(Ú|Ù|Û|Ü)/","/(ñ)/","/(Ñ)/"),explode(" ","a A e E i I o O u U n N"),$var);
        $novo = str_replace(" ", "", $novo);
        return $novo;
    }

    function salvar(Request $request) {
        $produto = new Produto();
        $produto->nome = $request->nome;
        $produto->descricao = $request->descricao;
        $produto->categoria_id = $request->categoria_id;
        $produto->marca_id = $request->marca_id;
        $produto->qtde_estoque = $request->qtde_estoque;
        $produto->preco_venda = $request->preco_venda;
        $produto->destacado = $request->destacado;

        $nome_foto = ProdutoController::limpaVariavel($request->nome);
        $foto = $request->file('imagem_nome')->getClientOriginalExtension();
        $request->file('imagem_nome')->move(base_path().'/storage/app/public/', $nome_foto.'.'.$foto);

        $produto->imagem_nome = $nome_foto.'.'.$foto;
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

   public function avaliarProduto(Request $request) {
        $produto = Produto::findOrFail($request->get('id'));
       
        if($produto->avaliacao_qtde = Produto::find('avaliacao_qtde') == ''){
            $produto->avaliacao_qtde += $request->get('optradio');
            $produto->avaliacao_total++;
            $produto->avaliacao_qtde--;
            $produto->save();
        }else{
            $produto->avaliacao_qtde += $request->get('optradio');
            $produto->avaliacao_qtde--;
            $produto->avaliacao_total++;
            $produto->update();
        }
   }

}
