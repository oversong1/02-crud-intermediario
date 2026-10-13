<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produto extends Model
{
    protected $fillable = [
        'categoria_id',
        'nome',
        'tamanho',
        'cor',
        'preco',
        'estoque',
    ];

    // belongsTo: "um Produto PERTENCE A UMA Categoria" - o inverso do hasMany
    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class);
    }
}
