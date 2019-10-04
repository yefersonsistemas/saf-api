<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Speciality;
use App\Branch;
use Faker\Generator as Faker;

$factory->define(Speciality::class, function (Faker $faker) {
    $branchoffice = Branch::inRandomOrder()->first();

    return [
        'name'        => $faker->company,
        'description' => $faker->sentence,
        'branch_id' => $branchoffice->id,
    ];
});