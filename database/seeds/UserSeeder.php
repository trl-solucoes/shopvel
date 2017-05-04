<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $u = new Shoppvel\User();
        $u->name = 'Edison Rodrigo';
        $u->email = 'edisonmoura@gmail.com';
        $u->cpf = '04984638931';
        $u->role = 'admin';
        $u->password = bcrypt('111111');
        $u->save();
    }

}
