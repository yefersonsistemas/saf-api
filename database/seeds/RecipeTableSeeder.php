<?php

use Illuminate\Database\Seeder;
use App\Recipe;

class RecipeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Recipe::truncate();
        factory(Recipe::class)->create();
    }
}
