<?php

use Illuminate\Database\Seeder;
use App\Itinerary;

class ItineraryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Itinerary::truncate();
       // factory(Itinerary::class, 5)->create();
    }
}
