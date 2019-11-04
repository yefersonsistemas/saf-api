<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Treatment;
use App\Branch;
use Faker\Generator as Faker;

$factory->define(Treatment::class, function (Faker $faker) {
    $branchoffice = Branch::inRandomOrder()->first();
    return [
        'name' => $faker->word,
        'measure' => $faker->word,
        'doses' => $faker->word,
        'duration' => $faker->sentence(3),
        'branch_id' => $branchoffice->id,
    ];
});
