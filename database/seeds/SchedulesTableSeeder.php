<?php

use Illuminate\Database\Seeder;
use App\Schedules;

class SchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Reservation::truncate();
        factory(Reservation::class, 3)->create();
    }
}
