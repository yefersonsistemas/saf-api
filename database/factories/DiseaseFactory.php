<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Disease;
use App\BranchOffice;
use Faker\Generator as Faker;

$factory->define(Disease::class, function (Faker $faker) {
    $branchoffice = BranchOffice::inRandomOrder()->first();
    return [
        'name'        => $faker->company,
        'branchoffice_id' => $breanchoffice->id,
    ];
});
