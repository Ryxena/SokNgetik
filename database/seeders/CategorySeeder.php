<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = [
            'Technology',
            'Lifestyle',
            'Travel',
            'Food',
            'Health'
        ];

        foreach ($categories as $category) {
            Categories::create([
                'name' => $category,
                'slug' => Str::slug($category),
            ]);
        }

        // Create additional random categories
        Categories::factory(3)->create();
    }
}
