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
            'branch_id' => '1',
        ]);

        Configuration::create([
            'name'  => 'limit',
            'value' => 'indefinido',
            'branch_id' => '1',
        ]);
    }
}
