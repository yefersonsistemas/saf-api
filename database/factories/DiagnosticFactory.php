<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Diagnostic;
use App\Patient;
use App\Employe;
use App\Branch;
use App\Treatment;
use Faker\Generator as Faker;

$factory->define(Diagnostic::class, function (Faker $faker) {
    $patient = Patient::inRandomOrder()->first();
    $treatment = Treatment::inRandomOrder()->first();
    $employes = Employe::with('person.user')->get(); //trae todos los empleados q estan relacinados con persona 
                                                    //y con un usuario en el sistema
    $employes = $employes->each(function ($item) { //recorre c/u de los empleados y lo va guardando en item
        if($item->person->user != null){
            return $item->person->user->role('doctor'); //comparo q el empleado en item relacionado con persona tenga un
        }
    });                                             //usuario y q ademas tenga el rol sea doctor

    $branchoffice = Branch::inRandomOrder()->first();

    return [
        'patient_id'        => $patient->id,
        'description'       => $faker->sentence(8),
        'reason'            => $faker->sentence(5),
        'enfermedad_actual' => $faker->sentence(8),
        'examen_fisico'     => $faker->sentence(8),
        'reason'            => $faker->sentence(5),
        'treatment_id'      => $treatment->id,
        'indications'       => $faker->sentence(5),
        'employe_id'        => $employes->random()->id,
        'branch_id'         => $branchoffice->id,
    ];
});
