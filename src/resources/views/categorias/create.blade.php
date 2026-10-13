@extends('layouts.app')

@section('conteudo')
    <h1>Nova categoria</h1>
    <form action="{{ route('categorias.store') }}" method="POST">
        @csrf
        <label>Nome:</label>
        <input type="text" name="nome" value="{{ old('nome') }}">
        <button type="submit">Criar</button>
    </form>
@endsection