<?php

use Illuminate\Database\Seeder;
use App\Medicine;
// use App\Branch;
// use App\Diagnostic;
// use App\Employe;
// use App\Patient;

class MedicinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Medicine::truncate();
       factory(Medicine::class, 20)->create();
    //    factory(Medicine::class, 20)->create()->each(function ($medicine) { 
    //         $patients = Employe::with('diagnostic')->get();  
                       
    //         // $patients = $patients->each(function ($patient) { 
    //         //     return $patient->diagnostic('patient_id'); 
    //         // });

    //         $medicine->patient()->attach($patients->random()->id);
    //     });  
    }
}
//Eloquent usa el nombre del método para determinar la columna de la base de datos que se usará para la relación