<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

Artisan::command('generate:dummy-images', function () {
    $this->info('Generating dummy images...');

    // Create directory if it doesn't exist
    if (!Storage::exists('public/posts')) {
        Storage::makeDirectory('public/posts');
    }

    // Generate 5 dummy images
    for ($i = 1; $i <= 5; $i++) {
        $image = Image::canvas(800, 600, '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT));

        // Add some random shapes
        for ($j = 0; $j < 5; $j++) {
            $color = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
            $image->circle(
                mt_rand(50, 200),
                mt_rand(0, 800),
                mt_rand(0, 600),
                function ($draw) use ($color) {
                    $draw->background($color);
                }
            );
        }

        $image->save(storage_path('app/public/posts/default-' . $i . '.jpg'));
    }

    $this->info('Dummy images generated successfully!');
})->describe('Generate dummy images for posts');
