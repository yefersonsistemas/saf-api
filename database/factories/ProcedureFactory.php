<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Procedure;
use App\Branch;
use Faker\Generator as Faker;

$factory->define(Procedure::class, function (Faker $faker) {
    $branchoffice = Branch::inRandomOrder()->first();
    return [
        'name' => $faker->word,
        'description' => $faker->sentence(8),
        'price' => $faker->randomFloat,
        'branch_id' => $branchoffice->id,
    ];
});
