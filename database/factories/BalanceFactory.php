<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Balance;
use App\Employe;
use App\BranchOffice;
use Faker\Generator as Faker;

$factory->define(Balance::class, function (Faker $faker) {
    $employe = Employe::inRandomOrder()->first();
    $branchoffice = BranchOffice::inRandomOrder()->first();
    return [
        'employe_id' =>$employe->id,
        'total' =>$faker->randomFloat,
        'branchoffice_id' => $breanchoffice->id,
    ];
});
