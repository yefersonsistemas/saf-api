<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Treatment;
use App\Branch;
use App\Medicine;
use Faker\Generator as Faker;

$factory->define(Treatment::class, function (Faker $faker) {
    $branchoffice = Branch::inRandomOrder()->first();
    return [
        'medicine_id' => null,
        'measure' => $faker->word,
        'doses' => $faker->word,
        'indications' => $faker->word,
        'duration' => $faker->sentence(3),
        'branch_id' => $branchoffice->id,
    ];
});
