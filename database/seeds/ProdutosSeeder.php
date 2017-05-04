<?php

use Illuminate\Database\Seeder;

class ProdutosSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(Shoppvel\Models\Produto::class, 600)->create();
    }

}
