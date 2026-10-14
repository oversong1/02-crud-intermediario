@extends('layouts.app')

@section('conteudo')
    <h1>Novo pedido</h1>

    @if ($errors->any())
        <ul>@foreach ($errors->all() as $erro)<li>{{ $erro }}</li>@endforeach</ul>
    @endif

    <form action="{{ route('pedidos.store') }}" method="POST">
        @csrf

        <label>Produto:</label>
        <select name="produto_id">
            @foreach ($produtos as $produto)
                <option value="{{ $produto->id }}">{{ $produto->nome }} (estoque: {{ $produto->estoque }})</option>
            @endforeach
        </select>

        <label>Quantidade:</label>
        <input type="number" name="quantidade" min="1" value="1">

        <button type="submit">Criar pedido</button>
    </form>
@endsection