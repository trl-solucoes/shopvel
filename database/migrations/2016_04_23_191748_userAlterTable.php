<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserAlterTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        \DB::table('users')->delete();
        
        Schema::table('users', function ($table) {
            $table->longText('endereco')->default('');
            $table->string('cpf', 11)->default('');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('users', function ($table) {
            $table->dropColumn(['endereco', 'cpf']);
        });
    }

}
