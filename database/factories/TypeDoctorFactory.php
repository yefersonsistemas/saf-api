<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TypeDoctor;
use App\BranchOffice;
use Faker\Generator as Faker;

$factory->define(TypeDoctor::class, function (Faker $faker) {
    $branchoffice = BranchOffice::inRandomOrder()->first();
    return [
        'name' => $faker->word,
        'comission' => $faker->randomFloat,
        'branchoffice_id' => $breanchoffice->id,
    ];
});
