<?php

/*
  |--------------------------------------------------------------------------
  | Model Factories
  |--------------------------------------------------------------------------
  |
  | Here you may define all of your model factories. Model factories give
  | you a convenient way to create models for testing and seeding your
  | database. Just tell the factory how a default model should look.
  |
 */

//$faker->addProvider(new Faker\Provider\pt_BR\Person($faker));

$factory->define(Shoppvel\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(Shoppvel\Models\Categoria::class, function (Faker\Generator $faker) {
    $faker->locale('pt_BR');

    return [
        'nome' => $faker->unique()->word,
        'categoria_id' => function () use ($faker) {
            $cats = Shoppvel\Models\Categoria::all('id')->toArray();
            $cats = array_column($cats, 'id');
            $pai = Shoppvel\Models\Categoria::find($faker->optional()->randomElement($cats));
            return $pai == null ? null : $pai->id;
        },
    ];
});

$factory->define(Shoppvel\Models\Marca::class, function (Faker\Generator $faker) {
    $faker->locale('pt_BR');

    return [
        'nome' => $faker->unique()->company,
    ];
});

$factory->define(Shoppvel\Models\Produto::class, function (Faker\Generator $faker) {
    $faker->locale('pt_BR');

    $avQtde = $faker->randomNumber(3);
    $avTotal = $faker->numberBetween(0, 5) * $avQtde;
    
    return [
        'nome' => $faker->text(50),
        'descricao' => $faker->text(2000),
        'avaliacao_qtde' => $avQtde,
        'avaliacao_total' => $avTotal,
        'qtde_estoque' => $faker->numberBetween(0, 50),
        'preco_venda' => $faker->randomFloat(2, 10, 5000),
        'destacado' => $faker->boolean(),
        'imagem_nome' => $faker->word().'.jpg',
        'marca_id' => function () use ($faker) {
            $marca = Shoppvel\Models\Marca::all('id')->toArray();
            $marca = array_column($marca, 'id');
            $rel = Shoppvel\Models\Marca::find($faker->randomElement($marca));
            return $rel == null ? null : $rel->id;
        },
        'categoria_id' => function () use ($faker) {
            $cats = Shoppvel\Models\Categoria::all('id')->toArray();
            $cats = array_column($cats, 'id');
            $rel = Shoppvel\Models\Categoria::find($faker->randomElement($cats));
            return $rel == null ? null : $rel->id;
        },
    ];
});

