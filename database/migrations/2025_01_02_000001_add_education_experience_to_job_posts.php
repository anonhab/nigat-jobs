<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('job_posts', function (Blueprint $table) {
            $table->string('education')->nullable()->after('type');
            $table->string('experience')->nullable()->after('education');
        });
    }

    public function down(): void
    {
        Schema::table('job_posts', function (Blueprint $table) {
            $table->dropColumn(['education', 'experience']);
        });
    }
};
