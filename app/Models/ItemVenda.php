<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Venda;
use App\Models\Produto;

class ItemVenda extends Model
{
    use HasFactory;

    protected $table = 'item_venda';

    protected $fillable = [
        'venda_id',
        'produto_id',
        'quantidade',
    ];

    protected function casts(): array
    {
        return [
            'quantidade' => 'integer',
        ];
    }
//1:n
    public function venda(): BelongsTo
    {
        return $this->belongsTo(Venda::class);
    }

    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produto::class);
    }

}
