<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Employe;
use App\Person;
use App\Position;
use App\Branch;
use Faker\Generator as Faker;

$factory->define(Employe::class, function (Faker $faker) {
    $person = Person::inRandomOrder()->first();
    $position = Position::inRandomOrder()->first();
    $branchoffice = Branch::inRandomOrder()->first();

    return [
        'person_id'  => $person->id,
        'position_id'  => $position->id,
        'branch_id' => $branchoffice->id,
    ];
});
