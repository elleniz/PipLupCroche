<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'preco',    
        'quantidade',
        'peso',
        'categoria_id',
        'descricao',
        'material',
        'imagem',

    ];



public function categoria()
{
    return $this->belongsTo(Categoria::class, 'categoria_id');
}

}