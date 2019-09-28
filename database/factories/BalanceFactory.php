<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Balance;
use App\Employe;
use App\Branch;
use Faker\Generator as Faker;

$factory->define(Balance::class, function (Faker $faker) {
    $employe = Employe::inRandomOrder()->first();
    $branchoffice = Branch::inRandomOrder()->first();
    return [
        'employe_id' =>$employe->id,
        'total' =>$faker->randomFloat,
        'branch_id' => $branchoffice->id,
    ];
});
