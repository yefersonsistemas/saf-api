<?php

use Illuminate\Database\Seeder;
use App\Medicine;
use App\Branch;
use App\Diagnostic;
use App\Patient;

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
    //         $patients = Patient::where('employe_id')->get();  
                       
    //         // $patients = $patients->each(function ($patient) { 
    //         //     return $patient->employe->diagnostic; 
    //         // });

    //         $medicine->patient()->attach($patients->random()->id);
    //     });  
    }
}
