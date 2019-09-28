<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\TypeSurgery;
use App\Branch;

use Faker\Generator as Faker;

$factory->define(TypeSurgery::class, function (Faker $faker) {
    $branchoffice = Branch::inRandomOrder()->first();
    return [
        'name' =>$faker->word,
        'duration' =>$faker->randomDigit,
        'cost' =>$faker->randomFloat,
        'branch_id' => $branchoffice->id,
    ];
});
