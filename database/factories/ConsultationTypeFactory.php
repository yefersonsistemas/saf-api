<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\ConsultationType;
use App\Branch;
use App\Reservation;
use Faker\Generator as Faker;

$factory->define(ConsultationType::class, function (Faker $faker) {
    $branchoffice = Branch::inRandomOrder()->first();
    $reservation = Reservation::inRandomOrder()->first();

    return [
        'name' => $faker->sentence,
        'description' => $faker->sentence,
        'reservation_id' => $reservation->id,
        'branch_id'   => $branchoffice->id,
    ];
});
