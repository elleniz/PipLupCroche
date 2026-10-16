<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    use HasFactory;

    protected $table = 'usuarios';

    protected $fillable = [
        'nome',
        'cpf',
        'telefone',
        'email',
        'endereco',
        'data_nascimento',
        'tipo',
    ];

    public function vaga()
    {   
    return $this->hasOne(Vaga::class);
    }

    //trabalho 2
    public function pedidos()
    {
        return $this->hasMany(Pedido::class);
    }

}

