<?php

use Illuminate\Database\Seeder;
use App\Inventory;
use App\Supplie;
use App\Equipment;

class InventoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Inventory::truncate();
        factory(Inventory::class, 20)->create()->each( function ($inventory) {
            $supplie = Supplie::inRandomOrder()->first();
            $inventory->supplie_id = $supplie->id;
            $inventory->save();
        });
        factory(Inventory::class, 20)->create()->each( function ($inventory) {
            $equipment = Equipment::inRandomOrder()->first();
            $inventory->equipment_id = $equipment->id;
            $inventory->save();
        });
    }
}
