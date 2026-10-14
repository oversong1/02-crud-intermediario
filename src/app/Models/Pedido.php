<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pedido extends Model
{
    protected $fillable = ['user_id', 'status'];

    // hasMany: "um Pedido TEM VARIOS ItemPedido" - o Laravel procura, sozinho, uma
    // coluna chamada "pedido_id" dentro de item_pedidos, e traz todas as linhas
    // onde esse pedido_id bate com o id DESTE pedido especifico.
    public function itens(): HasMany
    {
        return $this->hasMany(ItemPedido::class);
    }

    // belongsTo: "um Pedido PERTENCE A UM User" - o inverso do hasMany.
    // O segundo parametro aqui e NECESSARIO: por padrao, o Laravel esperaria
    // uma coluna chamada "usuario_id" (baseado no nome do metodo "usuario"),
    // mas a coluna real se chama "user_id" - por isso avisamos explicitamente.
    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
