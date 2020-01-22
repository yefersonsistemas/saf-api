<?php

use Illuminate\Database\Seeder;
use App\Procedure;
use App\Employe;
use App\Branch;

class ProcedureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Procedure::truncate();
        
        // factory(Procedure::class, 20)->create();

        factory(Procedure::class)->create([
            'name'    => 'consulta',
            'description' => 'Solo consulta',
        ]);

        factory(Procedure::class)->create([
            'name'    => 'Anestesia',
            'description' => 'bloquea la sensibilidad táctil',
            'price' => 15000,
        ]);

        factory(Procedure::class)->create([
            'name'    => 'Radiografía de la cara',
             'description' => 'serie de imágenes de los huesos de la cara',
             'price' => 35000,
        ]);

        factory(Procedure::class)->create([
            'name'    => 'Exploraciones de oído, garganta y nariz',
             'description' => 'identifica la presencia de tapones de cera o exceso de cerumen, 
             secreciones irregulares, cuerpos extraños, lesiones bacterianas y micóticas, 
             infecciones frecuentes o recurrentes.',
             'price' => 25000,
        ]);

        factory(Procedure::class)->create([
            'name'    => 'Timpanometría',
             'description' => 'evalua la movilidad de la membrana timpánica',
             'price' => 18000,
        ]);

        factory(Procedure::class)->create([
            'name'    => ' Audiometría',
             'description' => 'mide la capacidad de cada oído de percibir las vibraciones de diversas bandas del espectro audible',
             'price' => 22000,
        ]);

    }
}
