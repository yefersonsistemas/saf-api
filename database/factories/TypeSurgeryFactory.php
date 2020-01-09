<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Typesurgery;
use App\Branch;
use App\ClassificationSurgery;
use App\Employe;

use Faker\Generator as Faker;

$factory->define(Typesurgery::class, function (Faker $faker) {
    $branchoffice = Branch::inRandomOrder()->first();
    $claSurgery = ClassificationSurgery::inRandomOrder()->first();
    $employe = Employe::inRandomOrder()->first();
    return [
        'name' =>$faker->word,
        'duration' =>$faker->randomDigit,
        'cost' =>$faker->randomFloat,
        'description' =>$faker->sentence(5),
        'classification_surgery_id' =>$claSurgery->id,
        'employe_id' =>$employe->id,
        'branch_id' => $branchoffice->id,
    ];
});
