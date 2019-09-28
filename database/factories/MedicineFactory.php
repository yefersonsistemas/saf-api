<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Medicine;
use App\Branch;
use Faker\Generator as Faker;

$factory->define(Medicine::class, function (Faker $faker) {
    $branchoffice = Branch::inRandomOrder()->first();
    return [
        'name' => $faker->company,
        'branch_id' => $branchoffice->id,
    ];
});
