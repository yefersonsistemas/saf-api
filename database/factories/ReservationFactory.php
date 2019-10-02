<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Reservation;
use App\Schedule;
use App\Branch;
use App\Person;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Reservation::class, function (Faker $faker) {
    $schedule = Schedule::inRandomOrder()->first();
    $branchoffice = Branch::inRandomOrder()->first();
    $person = Person::inRandomOrder()->first();
    return [
        'date' => Carbon::now()->Format('Y-m-d'),
        'description' =>$faker->sentence,
        'status'  => $faker->randomElement(['Pendiente', 'Aprobado', 'Cancelado']),
        'person_id'  =>$person->id,
        'schedule_id'  =>$schedule->id,
        'branch_id' => $branchoffice->id,
    ];
});
