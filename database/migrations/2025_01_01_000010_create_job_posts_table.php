<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('job_posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('company')->nullable();
            $table->string('location')->nullable();
            $table->string('salary')->nullable();
            $table->string('type')->nullable();
            $table->text('description')->nullable();
            $table->string('apply_url')->nullable();
            $table->string('deadline')->nullable();
            $table->string('source_url')->nullable()->unique();
            $table->string('image')->nullable();
            $table->timestamp('posted_at')->nullable();
        });

        Schema::create('job_benefits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->constrained('job_posts')->onDelete('cascade');
            $table->string('benefit');
        });

        Schema::create('job_requirements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->constrained('job_posts')->onDelete('cascade');
            $table->string('requirement');
        });

        Schema::create('job_responsibilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_id')->constrained('job_posts')->onDelete('cascade');
            $table->string('responsibility');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('job_responsibilities');
        Schema::dropIfExists('job_requirements');
        Schema::dropIfExists('job_benefits');
        Schema::dropIfExists('job_posts');
    }
};
