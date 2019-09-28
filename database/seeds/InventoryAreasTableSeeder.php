<?php

use Illuminate\Database\Seeder;
use App\InventoryArea;

class InventoryAreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        InventoryArea::truncate();
        factory(InventoryArea::class, 20)->create();
    }
}
