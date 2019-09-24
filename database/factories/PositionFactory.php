<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Position;
use App\BranchOffice;
use Faker\Generator as Faker;

$factory->define(Position::class, function (Faker $faker){
$branchoffice = BranchOffice::inRandomOrder()->first();

    return [
        'name' =>$faker->word,
        'branchoffice_id' => $breanchoffice->id,
    ];
});
