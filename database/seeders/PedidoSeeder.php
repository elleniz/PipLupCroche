<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pedido;
use App\Models\Usuario;

class PedidoSeeder extends Seeder
{
    public function run(): void
    {
        $usuarios = Usuario::where('tipo', 'CLIENTE')->get(); //só clientes

        foreach ($usuarios as $usuario) { 
            Pedido::factory()->create([
                'usuario_id' => $usuario->id,
            ]);
        }
    }
}
