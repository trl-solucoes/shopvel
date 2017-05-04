<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterItemVendaAddAvaliado extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('itens_venda', function ($table) {
            $table->boolean('avaliado')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('itens_venda', function ($table) {
            $table->dropColumn('avaliado');
        });
    }

}
