<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    // hasMany: "um Produto TEM VARIOS ItemPedido" - traz todas as linhas de item_pedidos
    // onde a coluna "produto_id" bate com o id DESTE produto especifico.
    public function itensPedido(): HasMany
    {
        return $this->hasMany(ItemPedido::class);
    }
}
