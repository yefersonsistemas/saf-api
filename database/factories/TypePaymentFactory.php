<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TypePayment;
use App\Branch;
use Faker\Generator as Faker;

$factory->define(TypePayment::class, function (Faker $faker) {
    $branchoffice = Branch::inRandomOrder()->first();
    return [
        'name' => $faker->word,
        'branch_id' => $branchoffice->id,
    ];
});
