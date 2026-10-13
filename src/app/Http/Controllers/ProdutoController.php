<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // with('categoria'): "eager loading" - busca os produtos E as categorias deles
        // numa unica ida extra ao banco, em vez de 1 query por produto dentro do @foreach
        // da View (isso evita o problema de "N+1 queries" que voce ja corrigiu no
        // desafio real da Esferas, so que agora prevenido de proposito, desde o inicio).
        $produtos = Produto::with('categoria')->get();
        return view('produtos.index', ['produtos' => $produtos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::all(); // pro dropdown do formulario
        return view('produtos.create', ['categorias' => $categorias]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dados = $request->validate([
            'categoria_id' => 'required|exists:categorias,id', // exists: confere se esse id realmente existe na tabela
            'nome' => 'required|string|max:255',
            'tamanho' => 'required|string|max:5',
            'cor' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
            'estoque' => 'required|integer|min:0',
        ]);

        Produto::create($dados);
        return redirect()->route('produtos.index')->with('sucesso', 'Produto criado!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produto $produto)
    {
        return view('produtos.show', ['produto' => $produto]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produto $produto)
    {
        $categorias = Categoria::all();
        return view('produtos.edit', ['produto' => $produto, 'categorias' => $categorias]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produto $produto)
    {
        $dados = $request->validate([
            'categoria_id' => 'required|exists:categorias,id',
            'nome' => 'required|string|max:255',
            'tamanho' => 'required|string|max:5',
            'cor' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
            'estoque' => 'required|integer|min:0',
        ]);

        $produto->update($dados);

        return redirect()->route('produtos.index')->with('sucesso', 'Produto atualizado!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produto $produto)
    {
        $produto->delete();
        return redirect()->route('produtos.index')->with('sucesso', 'Produto apagado!');
    }
}
