<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\InputOutput;
use App\Person;
use App\Employe;
use App\Branch;
use Faker\Generator as Faker;

$factory->define(InputOutput::class, function (Faker $faker) {
    $person = Person::inRandomOrder()->first();
    $employe = Employe::inRandomOrder()->first();
    $branchoffice = Branch::inRandomOrder()->first();
    
    return [
        'person_id'  => $person->id,
        'inside'  =>null,
        'outside'  => null,
        'employe_id'  => $employe->id,
        'branch_id' => $branchoffice->id,
    ];
});
