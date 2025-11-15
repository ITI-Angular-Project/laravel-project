<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('comments')
            ->where('commentable_type', 'App\\Models\\Job')
            ->update(['commentable_type' => 'jobs']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('comments')
            ->where('commentable_type', 'jobs')
            ->update(['commentable_type' => 'App\\Models\\Job']);
    }
};
