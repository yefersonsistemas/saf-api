<?php

use Illuminate\Database\Seeder;
use App\Diagnostic;

class DiagnosticsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         Diagnostic::truncate();
        factory(Diagnostic::class, 20)->create();
        
        
    }
}
