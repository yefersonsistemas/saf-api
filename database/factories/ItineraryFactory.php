<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Exam;
use App\Itinerary;
use App\Patient;
use App\Procedure;
use App\Recipe;
use App\Employe;
use App\Reservation;
use App\Surgery;
use App\Branch;
use Faker\Generator as Faker;

$factory->define(Itinerary::class, function (Faker $faker) {
    $patient = Patient::inRandomOrder()->first();
    $employe = Employe::inRandomOrder()->first();
    $procedue = Procedure::inRandomOrder()->first();
    $surgery = Surgery::inRandomOrder()->first();
    $exam = Exam::inRandomOrder()->first();
    $recipe = Recipe::inRandomOrder()->first();
    $reservation = Reservation::inRandomOrder()->first();
    $branchoffice = Branch::inRandomOrder()->first();
    return [
        'patient_id' => $patient->id,
        'employe_id' => $employe->id,
        'procedure_id' =>  $procedue->id,
        'surgery_id' =>  $surgery->id,
        'exam_id' =>  $exam->id,
        'recipe_id' =>  $recipe->id,
        'reservation_id' =>  $reservation->id,
        'branch_id' =>  $branchoffice->id,
    ];
});
