<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Cite;
use App\Reservation;
use App\Branch;
use Faker\Generator as Faker;

$factory->define(Cite::class, function (Faker $faker) {
    $reservation = Reservation::inRandomOrder()->first();
    $branchoffice = Branch::inRandomOrder()->first();
    return [
        'reservation_id' => $reservation->id,
        'reason' => $faker->sentence(),
        'branch_id' => $branchoffice->id,
    ];
});
