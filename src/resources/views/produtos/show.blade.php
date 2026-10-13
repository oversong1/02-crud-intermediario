@extends('layouts.app')

@section('conteudo')
    <h1>{{ $produto->nome }}</h1>
    <p>Categoria: {{ $produto->categoria->nome }}</p>
    <p>Tamanho: {{ $produto->tamanho }} | Cor: {{ $produto->cor }}</p>
    <p>Preço: R$ {{ number_format($produto->preco, 2, ',', '.') }}</p>
    <p>Estoque: {{ $produto->estoque }}</p>
@endsection