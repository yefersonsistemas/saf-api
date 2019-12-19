<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Service;
use App\Branch;
use Faker\Generator as Faker;

$factory->define(Service::class, function (Faker $faker) {
    $branchoffice = Branch::inRandomOrder()->first();
    return [
        'name' => $faker->word,
        'description' => $faker->sentence(8),
        'branch_id' => $branchoffice->id,
    ];
});
