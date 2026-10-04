<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        Categoria::create([
            'nome' => 'amigurumi',
            'descricao' => 'Bonecos e personagens feitos em crochê.',
            'tipo' => 'bonecos',
        ]);

        Categoria::create([
            'nome' => 'bolsa',
            'descricao' => 'Bolsas e acessórios para uso pessoal.',
            'tipo' => 'acessorio pequeno',
        ]);

        Categoria::create([
            'nome' => 'decoração',
            'descricao' => 'Itens decorativos feitos em crochê.',
            'tipo' => 'decoracao de quarto',
        ]);

        Categoria::create([
            'nome' => 'acessório',
            'descricao' => 'Acessórios e itens para uso pessoal.',
            'tipo' => 'brinco',
        ]);

        Categoria::create([
            'nome' => 'casa',
            'descricao' => 'Produtos para utilização e decoração da casa.',
            'tipo' => 'utilitário',
        ]);
    }
}
