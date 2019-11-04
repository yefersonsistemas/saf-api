<?php

use App\Classification;
use Illuminate\Database\Seeder;

class ClassificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Classification::truncate();
        factory(Classification::class, 5)->create();
    }
}
