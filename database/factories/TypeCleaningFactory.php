<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TypeCleaning;
use App\Branch;
use Faker\Generator as Faker;

$factory->define(TypeCleaning::class, function (Faker $faker) {
    $branchoffice = Branch::inRandomOrder()->first();
    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
        'branch_id' => $branchoffice->id,
    ];
});
