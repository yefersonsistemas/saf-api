<?php

use Illuminate\Database\Seeder;
use App\TypeCleaning;
use App\Employe;
use App\Branch;
use App\Position;

class TypeCleaningTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TypeCleaning::truncate();
        factory(TypeCleaning::class, 10)->create()->each(function ($cleaning){
            $id = Position::where('name','mantenimiento')->first();
            $employes = Employe::where('position_id', $id->id)->get(); 

            $cleaning->employe()->attach($employes->random()->id);
        });
    }
}
