<?php

use Illuminate\Database\Seeder;
use App\Visitor;

class VisitorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Visitor::truncate();
        factory(Visitor::class, 20)->create();
    }
}
