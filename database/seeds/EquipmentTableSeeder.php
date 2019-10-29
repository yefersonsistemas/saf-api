<?php

use Illuminate\Database\Seeder;
use App\Equipment;

class EquipmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Equipment::truncate();
        factory(Equipment::class, 20)->create();
    }
}
