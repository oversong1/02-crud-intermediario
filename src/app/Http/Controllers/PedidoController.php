<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// DB: classe pra controlar transacao manualmente (DB::transaction, visto mais abaixo)
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{
    public function create()
    {
        $produtos = Produto::all();
        return view('pedidos.create', ['produtos' => $produtos]);
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
        ]);

        // findOrFail(): busca o Produto pelo id que veio do formulario - se nao
        // existir, ja lanca 404 sozinho, sem precisar de "if" pra conferir null.
        $produto = Produto::findOrFail($dados['produto_id']);

        if ($produto->estoque < $dados['quantidade']) {
            return back()->withErrors(['quantidade' => 'Estoque insuficiente.']);
        }

        // DB::transaction(): tudo dentro da funcao roda junto, ou nada roda -
        // equivalente ao beginTransaction()/commit()/rollBack() manual do PHP puro,
        // so que o Laravel ja faz o rollback AUTOMATICO se qualquer exception acontecer
        // dentro da funcao, sem voce escrever try/catch.
        DB::transaction(function () use ($dados, $produto) {
            $pedido = Pedido::create([
                'user_id' => Auth::id(), // Auth::id(): id do usuario logado agora
                'status' => 'confirmado',
            ]);

            $pedido->itens()->create([
                'produto_id' => $produto->id,
                'quantidade' => $dados['quantidade'],
                'preco_unitario' => $produto->preco,
            ]);

            // decrement(): atalho pra UPDATE produtos SET estoque = estoque - X WHERE id = ...
            $produto->decrement('estoque', $dados['quantidade']);
        });

        return redirect()->route('produtos.index')->with('sucesso', 'Pedido criado!');
    }
}