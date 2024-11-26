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
            $table->string('title');
            $table->text('description');
            $table->text('request');
            $table->string('location');
            $table->decimal('salary', 10, 2)->nullable();
            $table->enum('employment_type', ['presential', 'remote', 'hybrid']);
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');
            $table->foreignId('recruiter_id')->constrained('users')->onDelete('cascade');
            $table->enum('department', ['technology', 'sales', 'marketing', 'human resources', 'financial']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
