<?php

use Illuminate\Database\Seeder;
use Inventory;

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
        factory(Inventory::class, 20)->create();
    }
}
