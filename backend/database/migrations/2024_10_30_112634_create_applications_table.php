<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('job_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->foreignId('recruiter_id')->constrained('users')->onDelete('cascade');
            $table->text('additional_info')->nullable();
            $table->string('resume_path')->nullable();
            $table->timestamps();

        });
    }


    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
