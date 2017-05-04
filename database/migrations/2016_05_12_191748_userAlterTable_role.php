<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserAlterTableRole extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        \DB::table('users')->delete();
        
        Schema::table('users', function ($table) {
            $table->string('role')->default('cliente');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('users', function ($table) {
            $table->dropColumn(['role']);
        });
    }

}
