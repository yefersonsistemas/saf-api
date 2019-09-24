<?php

use Illuminate\Database\Seeder;
use TypeEquipment;

class TypeEquipmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeEquipment::truncate();
        factory(TypeEquipment::class, 20)->create();
    }
}
