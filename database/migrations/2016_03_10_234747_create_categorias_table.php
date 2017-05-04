<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriasTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('categorias', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('nome', '50')->unique();
            $table->integer('categoria_id')->nullable()->unsigned();
            $table->foreign('categoria_id')->references('id')->on('categorias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('categorias');
    }

}
