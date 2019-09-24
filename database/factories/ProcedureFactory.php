<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Procedure;
use App\BranchOffice;
use Faker\Generator as Faker;

$factory->define(Procedure::class, function (Faker $faker) {
    $branchoffice = BranchOffice::inRandomOrder()->first();
    return [
        'name' => $faker->word,
        'description' => $faker->sentence(8),
        'price' => $faker->randomFloat,
        'branchoffice_id' => $breanchoffice->id,
    ];
});
