<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Rubben',
            'username' => 'Ryxena',
            'bio' => 'Admin of the blog',
            'email' => 'rubbenmulyo59@gmail.com',
            'password' => '12345678'
        ]);
        User::create([
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
            'bio' => 'Admin of the blog',
        ]);

        User::factory(5)->create();
    }
}
