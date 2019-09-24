<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Reservation;
use App\Schedule;
use App\BranchOffice;
use Faker\Generator as Faker;

$factory->define(Reservation::class, function (Faker $faker) {
    $schedule = Schedule::inRandomOrder()->first();
    $branchoffice = BranchOffice::inRandomOrder()->first();
    return [
        'date' => $faker->date,
        'description' =>$faker->sentence,
        'status'  => $faker->randomElement(['approved', 'pending', 'cancelled']),
        'schedule_id'  =>$schedule->id,
        'branchoffice_id' => $breanchoffice->id,
    ];
});
