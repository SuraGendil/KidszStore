<?php

namespace Database\Seeders;

use App\Models\Progress;
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
        // Panggil seeder lain untuk mengisi data slides dan progres
        $this->call([
            SlideSeeder::class,
            ProgressSeeder::class,
        ]);

        // Gunakan updateOrCreate untuk menghindari error duplikat saat seeder dijalankan ulang
        // User biasa
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            ['name' => 'Test User', 'password' => bcrypt('password')]
        );

        // User Admin
        User::updateOrCreate(
            ['email' => 'admin@example.com'],
            ['name' => 'Admin User', 'password' => bcrypt('admin123'), 'is_admin' => true]
        );
    }
}