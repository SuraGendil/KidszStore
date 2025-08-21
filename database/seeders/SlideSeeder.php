<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; 
use App\Models\Slide; 

class SlideSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('slides')->truncate();
    }
}