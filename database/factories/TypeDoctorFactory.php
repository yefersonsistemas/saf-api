<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TypeDoctor;
use App\Branch;
use Faker\Generator as Faker;

$factory->define(TypeDoctor::class, function (Faker $faker) {
    $branchoffice = Branch::inRandomOrder()->first();
    return [
        'name' => $faker->word,
        'comission' => $faker->randomFloat,
        'branch_id' => $branchoffice->id,
    ];
});
