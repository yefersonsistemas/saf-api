<?php

use Illuminate\Database\Seeder;
use App\Area;
use App\Traits\ImageFactory;

class AreasTableSeeder extends Seeder
{
    use ImageFactory;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Area::truncate();
        $this->deleteDirectory(storage_path('/app/public/area'));
        factory(Area::class, 20)->create()->each(function($area)
        {
            $this->to('area', $area->id, 'App\Area');
        });

        factory(Area::class)->create([
            'name'          => 'consultorio 1',
        ]);

        factory(Area::class)->create([
            'name'          => 'consultorio 2',
        ]);

        factory(Area::class)->create([
            'name'          => 'consultorio 3',
        ]);
        
    }
}

