<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Icome;
use App\Billing;
use App\Branch;
use Faker\Generator as Faker;

$factory->define(Icome::class, function (Faker $faker) {
    $billing = Billing::inRandomOrder()->first();
    $branchoffice = Branch::inRandomOrder()->first();

    return [
        'billing_id' => $billing->id,
        'total' => $faker->randomFloat,
        'branch_id' => $branchoffice->id,
    ];
});
