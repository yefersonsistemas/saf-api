<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Typesurgery;
use App\Branch;

use Faker\Generator as Faker;

$factory->define(Typesurgery::class, function (Faker $faker) {
    $branchoffice = Branch::inRandomOrder()->first();
    return [
        'name' =>$faker->word,
        'duration' =>$faker->randomDigit,
        'cost' =>$faker->randomFloat,
        'description' =>$faker->sentence(5),
        'branch_id' => $branchoffice->id,
    ];
});
