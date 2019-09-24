<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\TypeArea;
use App\BranchOffice;
use Faker\Generator as Faker;

$factory->define(TypeArea::class, function (Faker $faker) {
    $branchoffice = BranchOffice::inRandomOrder()->first();

    return [
        'name' =>$faker->word,
        'description' =>$faker->sentence,
        'branchoffice_id' => $breanchoffice->id,
        
    ];
});
