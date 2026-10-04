<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaga extends Model
{
    use HasFactory;

    protected $table = 'vagas';

    protected $fillable = [
        'usuario_id',
        'funcao',
        'salario',
        'escala',
        'jornada_trabalho',
        'turno',
        'tempo_profissao',
    ];

    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
