<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Notification;
use App\Branch;
use App\Person;
use App\User;
use Faker\Generator as Faker;

$factory->define(Notification::class, function (Faker $faker) {
    $user = User::inRandomOrder()->first();
    $users = User::inRandomOrder()->first();
    $person = Person::inRandomOrder()->first();
    $branchoffice = Branch::inRandomOrder()->first();
    return [
        'user_id' => $user->id,
        'person_id' => $person->id,
        'users_id' => $users->id,
        'branch_id' => $branchoffice->id,
    ];
});
