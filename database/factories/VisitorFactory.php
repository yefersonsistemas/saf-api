<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Visitor;
use App\BranchOffice;
use Faker\Generator as Faker;

$factory->define(Visitor::class, function (Faker $faker) {
    $person = Person::inRandomOrder()->first();
    $branchoffice = BranchOffice::inRandomOrder()->first();
    return [
        'person_id' => $person->id,
        'type_visitor' => $faker->word,
        'branchoffice_id' => $breanchoffice->id,
    ];
});
