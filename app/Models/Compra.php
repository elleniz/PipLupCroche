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
        'materiais',
        'quantidades',
    ];


public function materiais() {
    return $this->HasMany(Material::class, 'item_compra', 'compra_id', 'material_id')
    ->withPivot('quantidade')
    ->withTimestamps();
    }

}