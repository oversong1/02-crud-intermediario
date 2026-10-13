@extends('layouts.app')

@section('conteudo')
    <h1>Categorias</h1>
    <a href="{{ route('categorias.create') }}">Nova categoria</a>

    <ul>
        @foreach ($categorias as $categoria)
            <li>
                {{ $categoria->nome }}
                <form action="{{ route('categorias.destroy', $categoria) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Apagar</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection