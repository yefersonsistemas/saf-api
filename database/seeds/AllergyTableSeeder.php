<?php

use Illuminate\Database\Seeder;
use App\Allergy;
use App\PAtient;
use App\Branch;

class AllergyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Allergy::truncate();
        // factory(Allergy::class, 20)->create();

        factory(Allergy::class, 20)->create()->each(function ($allergy) { 
            $patients = Patient::with('diagnostic')->get();  
                       
            $patients = $patients->each(function ($patient) { 
                return $patient->diagnostic('patient_id'); 
            });

            $allergy->patient()->attach($patients->random()->id);
        }); 
    }
}
