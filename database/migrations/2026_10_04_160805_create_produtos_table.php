<?php
//acabado

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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('nome',200);
            $table->decimal('preco' , 10, 2);
            $table->integer('quantidade');

            $table->foreignId('categoria_id')
            ->unique()
            ->nullable()
            ->constrained('categorias')
            ->nullOnDelete();
            $table->string('descricao', 200)->nullable();
            $table->string('imagem', 150)->nullable();
            $table->string('peso', 10);
            $table->string('material', 40);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
