<?php

use Illuminate\Database\Seeder;
use App\TypeCleaning;
use App\Employe;
use App\Branch;

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
        factory(TypeCleaning::class, 20)->create()->each(function ($cleaning) {
            $employes = Employe::with('position')->get()->first();

            $employes = $employes->each(function ($employe) {
                return $employe->position('mantenimiento');
            });                                            

            //$cleaning->employe()->attach($employes->random()->id); //attach enlaza tipo de limpieza con empleados 
        });  
    }
}
