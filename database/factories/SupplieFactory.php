<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Supplie;
use App\BranchOffice;
use App\TypeSupplie;
use Faker\Generator as Faker;

$factory->define(Supplie::class, function (Faker $faker) {
    $typesupplie = TypeSupplie::inRandomOrder()->first();
    $branchoffice = BranchOffice::inRandomOrder()->first();
    return [
        'name'  => $faker->word,
        'type_supplie_id'  => $typesupplie->id,
        'presentation'  => $faker->word,
        'branchoffice_id' => $breanchoffice->id,
    ];
});
