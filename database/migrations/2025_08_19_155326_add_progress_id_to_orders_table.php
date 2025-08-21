<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->foreignId('progress_id')->nullable()->after('status')->constrained('progresses')->onDelete('set null');
        });

        if (Schema::hasTable('progresses')) {
            $pendingId = DB::table('progresses')->where('name', 'Pending')->value('id');
            $onProgressId = DB::table('progresses')->where('name', 'On Progress')->value('id');
            $failedId = DB::table('progresses')->where('name', 'Failed')->value('id');

            if ($pendingId) DB::table('orders')->where('status', 'pending')->update(['progress_id' => $pendingId]);
            if ($onProgressId) DB::table('orders')->where('status', 'success')->update(['progress_id' => $onProgressId]);
            if ($failedId) DB::table('orders')->whereIn('status', ['failed', 'expired', 'cancel', 'deny'])->update(['progress_id' => $failedId]);
        }
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['progress_id']);
            $table->dropColumn('progress_id');
        });
    }
};

