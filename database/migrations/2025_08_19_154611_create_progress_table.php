<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('progresses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // e.g., Pending, On Progress, Done, Cancelled
            $table->string('color')->default('gray'); // e.g., yellow, blue, green, red for badges
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('progresses');
    }
};

