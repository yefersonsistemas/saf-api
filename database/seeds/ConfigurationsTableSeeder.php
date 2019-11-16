<?php

use App\Configuration;
use Illuminate\Database\Seeder;

class ConfigurationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Configuration::truncate();

        Configuration::create([
            'name'  => 'limit',
            'value' => 3,
            'branch_id' => 1,
        ]);

        Configuration::create([  //esto es el rango de semanas para agendar una cita actualmente es de 3 meses
            'name'  => 'anticipation',
            'value' => 12,
            'branch_id' => 1,
        ]);
    }
}
