<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Allergy;
use App\Branch;
use Faker\Generator as Faker;

$factory->define(Allergy::class, function (Faker $faker) {
    $branchoffice = Branch::inRandomOrder()->first();

    return [
        'name' => $faker->word,
        'branch_id' => $branchoffice->id,
    ];
});
