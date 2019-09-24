<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Icome;
use App\Billing;
use App\BranchOffice;
use Faker\Generator as Faker;

$factory->define(Icome::class, function (Faker $faker) {
    $billing = Billing::inRandomOrder()->first();
    $branchoffice = BranchOffice::inRandomOrder()->first();

    return [
        'billing_id' => $billing->id,
        'total' => $faker->randomFloat,
        'branchoffice_id' => $breanchoffice->id,
    ];
});
