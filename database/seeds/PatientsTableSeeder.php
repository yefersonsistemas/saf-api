<?php

use Illuminate\Database\Seeder;
use App\Patient;

class PatientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Patient::truncate();
        factory(Patient::class, 30)->create();
     /*   factory(Patient::class)->create([
            'date' => '2019-07-11',
            'name' => 'LESBIA',
            'lastname' => 'GOMEZ',
            'type_dni' => 'V',
            'dni' => 10789200,
            'gender' => 'FEMENINO',
            'phone' => '0416757315',
            'email' => 'ANACOLOMBO.748@HOTMAIL.COM',
            'place' => 'CARORA',
            'birthdate' => '1971-05-03',
            'age' => 48,
            'weight' => 58,
            'occupation' => 'OFICIO DE HOGAR',
            'profession' => 'Cocinero',
            'address' => 'AV. JACINTO LARA CARORA EDO. LARA',
            'previous_surgery' => 'RESECCIÓN DE TU. ETMOIDAL',
            'doctor_id' => 1,
        ]);

        factory(Patient::class)->create([
            'date' => '2019-07-11',
            'name' => 'LUISA MARIA',
            'lastname' => 'GONZALES TOVAR',
            'type_dni' => 'V',
            'dni' => 20541500,
            'gender' => 'FEMENINO',
            'phone' => '04121503611',
            'email' => 'LMGONZALEZTOVAR@GMAIL.COM',
            'place' => 'YARITAGUA',
            'birthdate' => '1991-10-23',
            'age' => 27,
            'weight' => 56,
            'occupation' => 'T.U.S EN INGENIERIA INDUSTRIAL',
            'profession' => 'Ingeniero/a',
            'address' => 'YARITAGUA CARRERA 20 ENTRE 8 Y 9 SAN JOSE',
            'previous_surgery' => 'SEPTOPLASTIA',
            'doctor_id' => 1,
        ]);

        factory(Patient::class)->create([
            'date' => '2019-07-11',
            'name' => 'NELIMAR CECILIA',
            'lastname' => 'PINEDA RIVERO',
            'type_dni' => 'V',
            'dni' => 19104721,
            'gender' => 'FEMENINO',
            'phone' => '04140552729',
            'email' => 'NELIMARPINEDA@GMAIL.COM',
            'place' => 'URDANETA',
            'birthdate' => '1986-11-22',
            'age' => 32,
            'weight' => 56,
            'occupation' => 'ADMINISTRACION',
            'profession' => 'Cocinero',
            'address' => 'PAVIA CALLE PRINCIPAL CASA16-03',
            'previous_surgery' => 'CESARIA',
            'doctor_id' => 1,
        ]);*/


    }
}
