<?php

use Illuminate\Database\Seeder;
use App\MachineEquipment;

class MachineEquipmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MachineEquipment::truncate();
        factory(MachineEquipment::class, 20)->create();
    }
}
