<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User biasa
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // User Admin
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123'), // Pastikan password di-hash
            'is_admin' => true,
        ]);

        // Panggil seeder lain untuk mengisi data slides
        $this->call([
            SlideSeeder::class,
        ]);
    }
}