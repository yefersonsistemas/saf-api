<?php

use Illuminate\Database\Seeder;
use CleaningRecord;

class CleaningRecordTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CleaningRecord::truncate();
        factory(CleaningRecord::class, 20)->create();
    }
}
