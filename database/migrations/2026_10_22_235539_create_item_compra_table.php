@'
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('item_compra', function (Blueprint $table) {
            $table->id();

            $table->foreignId('compra_id')
                ->constrained('compras')
                ->cascadeOnDelete();

            $table->foreignId('material_id')
                ->constrained('materiais')
                ->cascadeOnDelete();

            $table->unsignedInteger('quantidade');

            $table->timestamps();

            $table->unique(['compra_id', 'material_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('item_compra');
    }
};
