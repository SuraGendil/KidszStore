<?php

namespace Database\Seeders;

use App\Models\Progress;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Gunakan updateOrCreate untuk membuat seeder ini idempotent (bisa dijalankan berkali-kali)
        // dan menghindari masalah foreign key constraint.
        $progresses = [
            ['name' => 'Pending', 'color' => 'yellow'],
            ['name' => 'On Progress', 'color' => 'blue'],
            ['name' => 'Done', 'color' => 'green'],
            ['name' => 'Cancelled', 'color' => 'gray'],
            ['name' => 'Failed', 'color' => 'red'],
        ];

        foreach ($progresses as $progress) {
            Progress::updateOrCreate(['name' => $progress['name']], $progress);
        }
    }
}
