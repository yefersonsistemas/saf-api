<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Hospitalization;
use App\Branch;
use Faker\Generator as Faker;

$factory->define(Hospitalization::class, function (Faker $faker) {
    $branchoffice = Branch::inRandomOrder()->first();
    return [
        'description' => $faker->sentence(8),
        'branch_id' => $branchoffice->id,
    ];
});
