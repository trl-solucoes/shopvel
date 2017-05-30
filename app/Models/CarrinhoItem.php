<?php

namespace Shoppvel\Models;

use Shoppvel\Models\Produto;
use Shoppvel\Models\Marca;

/**
 * CarrinhoItem não é um modelo do tipo Eloquent, e sim um modelo para ser utilizado
 * pelo carrinho para armazenar algumas propriedades, note que elas estão public
 * por não necessitarem de muita lógica neste exemplo
 */
class CarrinhoItem {
    public $produto;
    public $quantidade;
    public $valor;
    public $marca;
    public $marca_id;
}
