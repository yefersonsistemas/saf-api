<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Classification;
use App\Branch;
use Faker\Generator as Faker;

$factory->define(Classification::class, function (Faker $faker) {
    $branchoffice = Branch::inRandomOrder()->first();
    return [
        'name' => $faker->word,
        'branch_id' => $branchoffice->id,
    ];
});
