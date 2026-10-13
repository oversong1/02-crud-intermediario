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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();

            // foreignId + constrained: cria a coluna "categoria_id" (BIGINT) E JA cria
            // a foreign key apontando pra "categorias.id" - equivalente ao que voce
            // escrevia a mao com REFERENCES no schema.sql do PHP puro.
            $table->foreignId('categoria_id')->constrained('categorias');

            $table->string('nome');
            $table->string('tamanho', 5);
            $table->string('cor');
            $table->decimal('preco', 10, 2);
            $table->unsignedInteger('estoque')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
