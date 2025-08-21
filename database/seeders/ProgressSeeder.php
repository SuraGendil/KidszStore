<?php

namespace Database\Seeders;

use App\Models\Progress;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgressSeeder extends Seeder
{
    public function run(): void
    {
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
