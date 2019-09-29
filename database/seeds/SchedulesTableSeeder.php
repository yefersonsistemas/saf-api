<?php

use Illuminate\Database\Seeder;
use App\Schedule;

class SchedulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schedule::truncate();
        factory(Schedule::class, 10)->create();
    }
}
