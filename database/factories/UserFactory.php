<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Branch;
use App\Person;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
 */

$factory->define(User::class, function (Faker $faker) {
    $user = User::inRandomOrder()->first();
    $branchoffice = Branch::inRandomOrder()->first();
    $person = Person::inRandomOrder()->first();
    return [
        'email'             => $faker->email,
        'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'person_id'         => $person->id,
        'branch_id'         => $branchoffice->id,
        'remember_token'    => Str::random(10),
    ];
});