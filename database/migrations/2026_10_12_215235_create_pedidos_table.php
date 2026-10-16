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
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            //chave estrangeira + pega o id do usuario que fez o pedido + nao da pra excluir usuario
            //que tem pedido
            $table->foreignId('usuario_id') 
              ->constrained('usuarios')
              ->restrictOnDelete();
            
            $table->date('data');

            $table->date('prazo_entrega');

            $table->decimal('valor_total', 10, 2);

            //FAZer esse em select!!
            $table->string('status', 20)->nullable()
                  ->default('NÃO INFORMADO');
        
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
