<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('item_pedidos', function (Blueprint $table) {
            $table->id();

            // de qual pedido e esse item - aponta pro "id" da tabela "pedidos"
            $table->foreignId('pedido_id')->constrained();

            // de qual produto e esse item - aponta pro "id" da tabela "produtos"
            $table->foreignId('produto_id')->constrained();

            // quantas unidades desse produto foram compradas neste item
            $table->unsignedInteger('quantidade');

            // Os numeros (10, 2) do decimal(): 10 = quantos digitos o numero pode ter
            // NO TOTAL (antes + depois do ponto); 2 = quantos desses digitos ficam
            // DEPOIS do ponto decimal. Exemplo: 12345678.90 (8 antes + 2 depois = 10).
            $table->decimal('preco_unitario', 10, 2);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_pedidos');
    }
};
