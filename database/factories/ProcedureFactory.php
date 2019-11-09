<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Procedure;
use App\Branch;
use App\Speciality;
use Faker\Generator as Faker;

$factory->define(Procedure::class, function (Faker $faker) {
    $speciality = Speciality::inRandomOrder()->first();
    $branchoffice = Branch::inRandomOrder()->first();
    return [
        'name' => $faker->word,
        'description' => $faker->sentence(8),
        'price' => $faker->randomFloat,
        'specialitie_id' => $speciality->id,
        'branch_id' => $branchoffice->id,
    ];
});
