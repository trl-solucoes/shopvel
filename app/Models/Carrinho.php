<?php

namespace Shoppvel\Models;

use Shoppvel\Models\Produto;
use Shoppvel\Models\CarrinhoItem;
use \Illuminate\Support\Collection;

/**
 * Carrinho não é um modelo do tipo Eloquent, e sim um modelo que gerencia
 * uma coleção de items de Produto na sessão
 */
class Carrinho {
    const NOME_CARRINHO = 'carrinho';

    private $itens = null;
    private $session = null;
    
    public function __construct() {
        $this->itens = session(self::NOME_CARRINHO, new Collection());   
    }

    public function getItens() {
        return $this->itens;
    }
    
    private function addItem($item) {
        $this->itens->push($item);
        session([self::NOME_CARRINHO => $this->itens]);
        session()->save();
    }
    
    public function add($id, $qtde = 1) {
        $p = Produto::find($id);
        
        if ($p == null) {
            return false;
        }
        
        $item = new CarrinhoItem();
        $item->produto = $p;
        $item->qtde = $qtde;
        $item->valor = 1 * $p->preco_venda;
        
        $this->addItem($item);

        return true;
    }

    public function deleteItem($id){
        $itens_carrinho = $this->getItens();
        foreach ($itens_carrinho as $i => $item) {
            if($item->produto->id == $id){
                unset($itens_carrinho[$i]);
            } 
        }

        $this->esvaziar();
        session([self::NOME_CARRINHO => $itens_carrinho]);
        session()->save();
        
    }

    public function getTotal() {
        $total = 0;
        foreach ($this->itens as $item) {
            $total += $item->qtde * $item->produto->preco_venda;
        }
        return $total;
    }
    
    public function esvaziar() {
        session()->forget(self::NOME_CARRINHO);    
    }
}
