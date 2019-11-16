<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Configuration;
use App\Branch;
use Faker\Generator as Faker;

$factory->define(Configuration::class, function (Faker $faker) {
    $branchoffice = Branch::inRandomOrder()->first();
    return [
        'name' => $faker->randomDigit,
        'value' => $faker->word,
        'branch_id' => $branchoffice->id,
    ];
});
