<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Supplie;
use App\Branch;
use App\TypeSupplie;
use Faker\Generator as Faker;

$factory->define(Supplie::class, function (Faker $faker) {
    $typesupplie = TypeSupplie::inRandomOrder()->first();
    $branchoffice = Branch::inRandomOrder()->first();
    return [
        'name'  => $faker->word,
        'type_supplie_id'  => $typesupplie->id,
        'presentation'  => $faker->word,
        'branch_id' => $branchoffice->id,
    ];
});