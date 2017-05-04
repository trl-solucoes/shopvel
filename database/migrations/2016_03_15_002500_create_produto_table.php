<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProdutoTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('produtos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nome', '100')->unique();
            $table->mediumText('descricao');
            $table->integer('avaliacao_qtde')->default(0);
            $table->integer('avaliacao_total')->default(0);
            $table->integer('qtde_estoque');
            $table->float('preco_venda');
            $table->boolean('destacado')->default(FALSE);
            $table->string('imagem_nome', 100);
            $table->integer('categoria_id')->unsigned();
            $table->integer('marca_id')->unsigned();
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->foreign('marca_id')->references('id')->on('marcas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('produtos');
    }

}
