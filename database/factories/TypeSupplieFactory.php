<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TypeSupplie;
use App\BranchOffice;
use Faker\Generator as Faker;

$factory->define(TypeSupplie::class, function (Faker $faker) {
    $branchoffice = BranchOffice::inRandomOrder()->first();
    return [
        'name'  => $faker->word,
        'description'  => $faker->sentence,
        'branchoffice_id' => $breanchoffice->id,
    ];
});
