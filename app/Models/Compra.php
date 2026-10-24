<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Material;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = [
        'fornecedor',
        'data_compra',
        'valor_total',
    ];

    //1 compra tem n materiais | material pode ter varias compras | item_compra guarda os materiais
    public function materiais()
    {
        return $this->belongsToMany(
            Material::class,
            'item_compra',
            'compra_id',
            'material_id'
        )
        ->withPivot('quantidade')
        ->withTimestamps();
    }
}