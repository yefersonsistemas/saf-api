<?php

use Illuminate\Database\Seeder;
use App\Medicine;
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
       factory(Medicine::class, 20)->create()->each(function ($medicine) { 
            $patients = Patient::with('diagnostic')->get();  
                       
            $patients = $patients->each(function ($patient) { 
                return $patient->diagnostic('patient_id'); 
            });

            $medicine->patient()->attach($patients->random()->id);
        });  
    }
}