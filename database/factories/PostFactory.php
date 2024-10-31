<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use App\Models\Categories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        $title = $this->faker->sentence();
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'content' => $this->generateContent(),
            'thumbnail' => 'https://placehold.co/600x400/png',
            'is_featured' => $this->faker->boolean(10),
            'user_id' => User::factory(),
            'category_id' => Categories::factory(),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }

    private function generateContent()
    {
        return collect([
            '<h2>' . $this->faker->sentence() . '</h2>',
            '<p>' . $this->faker->paragraph(5) . '</p>',
            '<blockquote>' . $this->faker->sentence() . '</blockquote>',
            '<p>' . $this->faker->paragraph(4) . '</p>',
            '<h3>' . $this->faker->sentence() . '</h3>',
            '<p>' . $this->faker->paragraph(3) . '</p>'
        ])->join("\n\n");
    }
}
