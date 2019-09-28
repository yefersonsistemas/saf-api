<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Disease;
use App\Branch;
use Faker\Generator as Faker;

$factory->define(Disease::class, function (Faker $faker) {
    $branchoffice = Branch::inRandomOrder()->first();
    return [
        'name'        => $faker->company,
        'branch_id' => $branchoffice->id,
    ];
});
