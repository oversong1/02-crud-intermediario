<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categoria extends Model
{
    protected $fillable = ['nome'];

    // hasMany: "uma Categoria TEM VARIOS Produto" - o Laravel ja sabe que a coluna
    // de ligacao se chama "categoria_id" (convencao: nome_da_classe_no_singular + _id)
    public function produtos(): HasMany
    {
        return $this->hasMany(Produto::class);
    }
}
