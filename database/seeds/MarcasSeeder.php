<?php

use Illuminate\Database\Seeder;

class MarcasSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        factory(Shoppvel\Models\Marca::class, 20)->create();
    }

}
