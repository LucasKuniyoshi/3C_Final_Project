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
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relacionamento com User
            $table->foreignId('job_id')->constrained()->onDelete('cascade');  // Relacionamento com Job
            $table->string('name'); // Nome do candidato
            $table->string('recruiter_name'); // Nome do recrutador
            $table->text('additional_info')->nullable();
            $table->string('resume_path')->nullable();
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
