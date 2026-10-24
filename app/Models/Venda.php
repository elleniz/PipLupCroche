<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Usuario;
use App\Models\ItemVenda;

class Venda extends Model
{
    use HasFactory;
    

    protected $fillable = [
        'usuario_id',
        'data',
        'prazo_entrega',
        'valor_total',
        'status',
    ];


public function produtos() {
    return $this->belongsToMany(Produto::class,'item_venda','venda_id','produto_id')
    ->withPivot('quantidade')
    ->withTimestamps();
    }


public function usuario()
{
    return $this->belongsTo(Usuario::class, 'usuario_id');
}

public function itensVenda()
{
    return $this->hasMany(ItemVenda::class);
}
}