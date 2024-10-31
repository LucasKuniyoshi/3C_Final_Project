<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nome da empresa
            $table->string('email')->unique(); // E-mail único
            $table->string('password');// Senha
            $table->string('cnpj')->unique(); //CNPJ da empresa
            $table->text('description')->nullable(); // Descrição da empresa (opcional)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
