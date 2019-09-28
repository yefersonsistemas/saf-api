<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\TypeArea;
use App\Branch;
use Faker\Generator as Faker;

$factory->define(TypeArea::class, function (Faker $faker) {
    $branchoffice = Branch::inRandomOrder()->first();

    return [
        'name' =>$faker->word,
        'description' =>$faker->sentence,
        'branch_id' => $branchoffice->id,
        
    ];
});
