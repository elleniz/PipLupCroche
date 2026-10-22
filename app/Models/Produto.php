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
        'nome_imagem',
        'categoria_id',
        'descricao',
        'material',
        'imagem',

    ];



public function categoria()
{
    return $this->belongsTo(Categoria::class, 'categoria_id');
}

public function vendas()
{
    return $this->belongsToMany(Venda::class, 'item_venda', 'produto_id', 'venda_id')
    ->withPivot('quantidade')
    ->withTimestamps();
}

}