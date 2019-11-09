<?php

use Illuminate\Database\Seeder;
use App\Disease;
use App\Patient;

class DiseasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Disease::truncate();
        factory(Disease::class,10)->create()->each(function ($disease) { 
            $patients = Patient::with('disease')->get();  
                       
            $patients = $patients->each(function ($patient) { 
                return $patient->disease('patient_id'); 
            });

            $disease->patient()->attach($patients->random()->id);

        });  
    }
}
