<?php

use Illuminate\Database\Seeder;
use App\Patient;
use App\Disease;
use App\Diagnostic;
use App\Treatment;
use App\Traits\ImageFactory;

class PatientsTableSeeder extends Seeder
{
    use ImageFactory;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Patient::truncate();
        $this->deleteDirectory(storage_path('/app/public/patient'));

        factory(Patient::class,10)->create()->each(function ($patient) {
            $this->to('patient', $patient->id, 'App\Patient');

            factory(App\Disease::class)->create();
            $treatment = factory(App\Treatment::class)->create();
                factory(App\Diagnostic::class)->create([
                    'treatment_id' => $treatment->id
                ]);
        });

        
    }
}
