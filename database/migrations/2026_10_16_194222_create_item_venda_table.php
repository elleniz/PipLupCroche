@'
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item_venda', function (Blueprint $table) {
            $table->id();

            $table->foreignId('venda_id')
                ->constrained('vendas')
                ->cascadeOnDelete();

            $table->foreignId('produto_id')
                ->constrained('produtos')
                ->cascadeOnDelete();

            $table->unsignedInteger('quantidade');

            $table->timestamps();

            $table->unique(['venda_id', 'produto_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_venda');
    }
};
