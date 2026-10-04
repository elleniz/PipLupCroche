<?php

namespace Database\Factories;

use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'nome' => fake()->randomElement([
                'Bolsa',
                'Bolsa transversal',
                'Amigurumi',
                'Cropped',
                'Tapete',
                'Tapete de banheiro',
                'Gorro',
                'Chaveiro',
                'Sapinho',
                'Piplup',
                'Suéter',
                'Capa para Gabinete',
                'Capa para Botijão de gás',
                'Capa para almofada',
                'Lenço',
                'Sousplat',
                'Porta-copo',
                'Ursinho',
                'Necessaire',
                'Touca',
                'Cachecol',
            ]) . ' ' . fake()->randomElement([
                'Rosa',
                'Maresia',
                'Piplup',
                'Vintage',
                'Da Vovó',
                'Colorido',
                'Degradê',
                'Único',
                'Super Raro',
                'Floral',
                'Delicado',
                'Arco-íris',
                'Lilás',
                'Roxo',
                'Amarelo',
                'Branco',
                'Marrom',
                'Preto',
                'Especial',
                'Sustentável',
                'Premium',
            ]),

            'preco' => fake()->randomFloat(
                2,
                10,
                1000
            ),

            'quantidade' => fake()->numberBetween(1, 10),

             'descricao' => $this->faker->randomElement([
                'Produto feito à mão com muito carinho.',
                'Peça artesanal produzida cuidadosamente em pontos baixos.',
                'Produto exclusivo da PipLup Crochê.',
                'Peça artesanal de alta qualidade inspirada no anime "One Piece".',
                'Produto ideal para presentear alguém especial.',
                'Produto exclusivo, feito à mão e com muito carinho.',
                'Esse produto foi destaque na Feira de Crochê Anual de Florianópolis',
                'Peça mensal exclusiva - agosto',
                'Um produto delicado, criativo e cheio de personalidade.',
                'Esse crochê foi para a feira de melhores crochês de Pinhalzinho.',
                'Produto top 10.',
                'Uma das peças mais especiais da nossa coleção.',
                'Produto com acabamento delicado e visual encantador.',
                'Peça exclusiva para quem procura algo diferente.',
            ]),

            'peso' => $this->faker->randomElement([
                '25g',
                '50g',
                '75g',
                '100g',
                '150g',
                '200g',
                '250g',
                '300g',
                '350g',
                '400g',
                '450g',
                '500g',
            ]),

            'material' => $this->faker->randomElement([
                'ALGODÃO',
                'ALGODÃO RECICLADO',
                'BARBANTE',
                'BARBANTE PREMIUM',
                'FIO DE MALHA',
                'FIO DE MALHA RECICLADO',
                'LÃ NATURAL',
                'LÃ ACRÍLICA',
                'MISTURA DE ALGODÃO E POLIÉSTER',
            ]),
        ];
    }
}