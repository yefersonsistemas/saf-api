<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TypeDoctor;
use App\Branch;
use Faker\Generator as Faker;

$factory->define(TypeDoctor::class, function (Faker $faker) {
    $branchoffice = Branch::inRandomOrder()->first();
    return [
        'name' => $faker->word,
        'comission' => 0.75,
        'branch_id' => $branchoffice->id,
    ];
});
