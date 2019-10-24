<?php

use Illuminate\Database\Seeder;
use App\Diagnostic;

class DiagnosticsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Diagnostic::truncate();
        factory(Diagnostic::class, 30)->create();
        
        // factory(Diagnostic::class)->create([
        //     'description'    => 'RINITIS ALERGICA',
        //     'reason'        => 'RINITIS ALERGICA',
        //     'treatment'     => 'LAVADOS NASALES 
        //     CORTYNASE
        //     DESLER M 
        //     POR 1 MES
            
        //     CONTROL EN 1 MES',
        //     'annex'         => null,
        //     'next_cite'     => null,
        //     'patient_id'    => 2,
        //     'employe_id'    => 2,
        // ]);

        // factory(Diagnostic::class)->create([
        //     'description'    => 'SIALOADENITIS CRONICA DERECHA',
        //     'reason'        => 'AUMENTO DE VOLUMEN DE GLANDULA SUBMAXILAR DERECHA',
        //     'treatment'     => 'SE INDICA RESOLUCION QUIRURGICA',
        //     'annex'         => null,
        //     'next_cite'     => null,
        //     'patient_id'    => 3,
        //     'employe_id'    => 2,
        // ]);
    }
}
