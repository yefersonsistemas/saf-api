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
    //    factory(Medicine::class)->create()->each(function ($medicine) { 
    //         $patients = Patient::with('diagnostic')->get();  
                       
    //         $patients = $patients->each(function ($patient) { 
    //             return $patient->diagnostic('patient_id'); 
    //         });

    //         $medicine->patient()->attach($patients->random()->id);
    //     });  

        factory(Medicine::class)->create([
            'name'    => 'Ibuprofeno',
        ]);

        factory(Medicine::class)->create([
            'name'    => 'Acetaminofen',
        ]);

        factory(Medicine::class)->create([
            'name'    => 'Diclofenac',
        ]);
        
        factory(Medicine::class)->create([
            'name'    => 'Amoxicilina',
        ]);

        factory(Medicine::class)->create([
            'name'    => 'Ampicilina',
        ]);

        factory(Medicine::class)->create([
            'name'    => 'Poliotico',
        ]);

        factory(Medicine::class)->create([
            'name'    => 'Ciprofloxacina',
        ]);

        factory(Medicine::class)->create([
            'name'    => 'Dexametasona',
        ]);

    }
}