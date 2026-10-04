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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();

            $table->string('nome', 200);

            $table->string('cpf', 14)->unique();

            $table->string('telefone', 20);

            $table->string('email', 100);

            $table->string('endereco', 500)->nullable();

            $table->date('data_nascimento')->nullable();

            $table->string('tipo', 20);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};