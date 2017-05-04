<?php

use Illuminate\Database\Seeder;

class CategoriasSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        for ($index = 0; $index < 20; $index++) {
            factory(Shoppvel\Models\Categoria::class)->create();
        }
    }

}
