<?php

use Illuminate\Database\Seeder;
use Procedure;

class ProcedureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Procedure::truncate();
        factory(Procedure::class, 20)->create();
    }
}
