<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Visitor;
use App\Branch;
use App\Person;
use Faker\Generator as Faker;

$factory->define(Visitor::class, function (Faker $faker) {
    $person = Person::inRandomOrder()->first();
    $branchoffice = Branch::inRandomOrder()->first();
    return [
        'person_id' => $person->id,
        'type_visitor' => $faker->randomElement(['Paciente', 'Visitante']),
        'branch_id' => $branchoffice->id,
    ];
});