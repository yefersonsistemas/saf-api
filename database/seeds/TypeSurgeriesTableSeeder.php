<?php

use Illuminate\Database\Seeder;
use App\Typesurgery;
use App\Traits\ImageFactory;

class TypeSurgeriesTableSeeder extends Seeder
{
    use ImageFactory;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Typesurgery::truncate();
        $this->deleteDirectory(storage_path('/app/public/surgeries'));
        

        factory(Typesurgery::class, 5)->create()->each(function ($cirugia) {
            $this->to('surgeries', $cirugia->id, 'App\Typesurgery');
        });
        
    }
}