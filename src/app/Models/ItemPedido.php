<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemPedido extends Model
{
    protected $fillable = [
        'pedido_id', 
        'produto_id', 
        'quantidade', 
        'preco_unitario'
        ];

    // belongsTo: "um ItemPedido PERTENCE A UM Pedido" - usa a coluna "pedido_id"
    // (nome padrao, sem precisar avisar) pra achar o Pedido com esse id.
    public function pedido(): BelongsTo
    {
        return $this->belongsTo(Pedido::class);
    }

    // belongsTo: "um ItemPedido PERTENCE A UM Produto" - usa a coluna "produto_id"
    // pra achar o Produto com esse id.
    public function produto(): BelongsTo
    {
        return $this->belongsTo(Produto::class);
    }
}
