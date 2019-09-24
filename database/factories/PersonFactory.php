<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Person;
use App\BranchOffice;
use Faker\Generator as Faker;

$factory->define(Person::class, function (Faker $faker) {
    $branchoffice = BranchOffice::inRandomOrder()->first();
   
    return [
        'type_dni' => $faker->randomElement(['V', 'E', 'J']),
        'dni' => $faker->numberBetween(10000000, 30000000),
        'name' => $faker->firstName,
        'lastname'=> $faker->lastName,
        'address'  => $faker->address,
        'phone' => $faker->numberBetween(04140000000, 04260000000),
        'email' => $faker->email,
        'branchoffice_id' => $breanchoffice->id,
    ];
});
