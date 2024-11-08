<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Título da vaga
            $table->text('description'); // Descrição da vaga
            $table->string('location'); // Localização da vaga
            $table->decimal('salary', 10, 2)->nullable(); // Salário (opcional)
            $table->enum('employment_type', ['full-time', 'part-time', 'contract', 'internship']); // Tipo de emprego
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade'); // Relacionamento com empresa
            $table->foreignId('recruiter_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
