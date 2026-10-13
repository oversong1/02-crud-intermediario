@extends('layouts.app')

@section('conteudo')
    <h1>Novo produto</h1>

    @if ($errors->any())
        <ul>@foreach ($errors->all() as $erro)<li>{{ $erro }}</li>@endforeach</ul>
    @endif

    <form action="{{ route('produtos.store') }}" method="POST">
        @csrf

        <label>Categoria:</label>
        <select name="categoria_id">
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
            @endforeach
        </select>

        <label>Nome:</label>
        <input type="text" name="nome" value="{{ old('nome') }}">

        <label>Tamanho:</label>
        <input type="text" name="tamanho" value="{{ old('tamanho') }}">

        <label>Cor:</label>
        <input type="text" name="cor" value="{{ old('cor') }}">

        <label>Preço:</label>
        <input type="text" name="preco" value="{{ old('preco') }}">

        <label>Estoque:</label>
        <input type="number" name="estoque" value="{{ old('estoque') }}">

        <button type="submit">Criar</button>
    </form>
@endsection