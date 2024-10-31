<?php

namespace Database\Seeders;

use App\Models\Categories;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $users = User::all();
        $categories = Categories::all();

        Post::factory(3)
            ->create([
                'is_featured' => true,
                'user_id' => $users->random()->id,
                'category_id' => $categories->random()->id,
            ]);

        Post::factory(20)
            ->create([
                'is_featured' => false,
                'user_id' => fn() => $users->random()->id,
                'category_id' => fn() => $categories->random()->id,
            ]);
    }
}
