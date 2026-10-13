@extends('layouts.app')

@section('conteudo')
    <h1>Editar produto</h1>

    @if ($errors->any())
        <ul>@foreach ($errors->all() as $erro)<li>{{ $erro }}</li>@endforeach</ul>
    @endif

    <form action="{{ route('produtos.update', $produto) }}" method="POST">
        @csrf
        @method('PUT')

        <label>Categoria:</label>
        <select name="categoria_id">
            @foreach ($categorias as $categoria)
                {{-- selected="selected" se o id bater com a categoria atual do produto --}}
                <option value="{{ $categoria->id }}" {{ $categoria->id === $produto->categoria_id ? 'selected' : '' }}>
                    {{ $categoria->nome }}
                </option>
            @endforeach
        </select>

        <label>Nome:</label>
        <input type="text" name="nome" value="{{ old('nome', $produto->nome) }}">

        <label>Tamanho:</label>
        <input type="text" name="tamanho" value="{{ old('tamanho', $produto->tamanho) }}">

        <label>Cor:</label>
        <input type="text" name="cor" value="{{ old('cor', $produto->cor) }}">

        <label>Preço:</label>
        <input type="text" name="preco" value="{{ old('preco', $produto->preco) }}">

        <label>Estoque:</label>
        <input type="number" name="estoque" value="{{ old('estoque', $produto->estoque) }}">

        <button type="submit">Salvar</button>
    </form>
@endsection