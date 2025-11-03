<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->constrained('jobs')->onDelete('cascade');
            $table->foreignId('candidate_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('applicant_name', 150);
            $table->string('applicant_email', 180);
            $table->string('applicant_phone', 30)->nullable();
            $table->string('linkedin_url', 255)->nullable();
            $table->string('resume_path', 255);
            $table->text('cover_letter')->nullable();
            $table->enum('status', ['submitted', 'accepted', 'rejected'])->default('submitted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
