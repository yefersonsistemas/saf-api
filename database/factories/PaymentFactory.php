<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Payment;
use App\Employe;
use App\Branch;
use Faker\Generator as Faker;

$factory->define(Payment::class, function (Faker $faker) {
    $employe = Employe::inRandomOrder()->first();
    $branchoffice = Branch::inRandomOrder()->first();
    return [
        'total' =>$faker->randomFloat,
        'total_withdrawal' =>$faker->randomFloat,
        'employe_id' =>$employe->id,
        'branch_id' => $branchoffice->id,
    ];
});
