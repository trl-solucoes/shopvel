<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		//Model::unguard();
        // $this->call(UsersTableSeeder::class);
		$this->call(UserSeeder::class);
		$this->call(CategoriasSeeder::class);
		$this->call(MarcasSeeder::class);
		$this->call(ProdutosSeeder::class);
		//Model::reguard();
    }
}
