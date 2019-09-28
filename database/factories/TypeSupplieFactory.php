<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TypeSupplie;
use App\Branch;
use Faker\Generator as Faker;

$factory->define(TypeSupplie::class, function (Faker $faker) {
    $branchoffice = Branch::inRandomOrder()->first();
    return [
        'name'  => $faker->word,
        'description'  => $faker->sentence,
        'branch_id' => $branchoffice->id,
    ];
});
