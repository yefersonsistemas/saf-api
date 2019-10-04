<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Faker\Factory;
use App\Image;

/**
 * Trait for Dinamic Image Seeder
 */
trait ImageFactory
{
    public function to(string $folder, string $imageable_id, string $imageable_type)
    {
        $path = storage_path('app/public/') . $folder;
        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0755, true);
        }

        $faker = Factory::create();
        $avatar = $faker->file($fuente = 'resources/images/' . $folder, $destino = 'public/storage/' . $folder);

        $path = str_replace('public/storage/', '', $avatar);
        factory(Image::class)->create([
            'path'           => $path,
            'imageable_id'   => $imageable_id,
            'imageable_type' => $imageable_type,
        ]);
    }

    public function deleteDirectory(string $path)
    {
        if (File::isDirectory($path)) {
            File::deleteDirectory($path);
            return true;
        }else {
            return false;
        }
    }
}
