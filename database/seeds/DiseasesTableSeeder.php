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
        // factory(Disease::class,20)->create();  

        factory(Disease::class)->create([
            'name'    => 'Adenoides',
        ]);

        factory(Disease::class)->create([
            'name'    => 'Alergías',
        ]);

        factory(Disease::class)->create([
            'name'    => 'Amigdalitis',
        ]);

        factory(Disease::class)->create([
            'name'    => 'Cancer de esófago',
        ]);
        
        factory(Disease::class)->create([
            'name'    => 'Mareo y vértigo',
        ]);

        factory(Disease::class)->create([
            'name'    => 'Rinitis alérgica',
        ]);

        factory(Disease::class)->create([
            'name'    => 'Sinusitis',
        ]);

        factory(Disease::class)->create([
            'name'    => 'Tinnitus',
        ]);

        factory(Disease::class)->create([
            'name'    => 'Trastorno del gusto y el olfato',
        ]);

        factory(Disease::class)->create([
            'name'    => 'Infecciones del oído',
        ]);
    }
}
