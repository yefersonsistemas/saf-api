<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Reservation;
use App\Schedule;
use App\Branch;
use App\Person;
use App\Patient;
use App\Speciality;
use Carbon\Carbon;
use Faker\Generator as Faker;

$factory->define(Reservation::class, function (Faker $faker) {
    $schedule = Schedule::inRandomOrder()->first();
    $branchoffice = Branch::inRandomOrder()->first();
    $person = Person::inRandomOrder()->first();
    $patient = Patient::inRandomOrder()->first();
    $specialitie = Speciality::inRandomOrder()->first();
    return [
        'date' => Carbon::now()->Format('Y-m-d'),
        'description' =>$faker->sentence,
        'patient_id' => $patient->id, 
        'approved'  => null,  //aprobado
        'reschedule'  => null,  //reprogramar
        'cancel'  => null,  //cancelado
        'discontinued'  => null,  //suspendido
        'person_id'  =>$person->id,
        'schedule_id'  =>$schedule->id,
        'specialitie_id' =>$specialitie->id,
        'branch_id' => $branchoffice->id,
    ];
});
