@extends('layouts.app')

@section('conteudo')
    <h1>Produtos</h1>
    <a href="{{ route('produtos.create') }}">Novo produto</a>

    <table>
        <thead>
            <tr><th>Nome</th><th>Categoria</th><th>Tamanho</th><th>Cor</th><th>Preço</th><th>Estoque</th><th>Ações</th></tr>
        </thead>
        <tbody>
            @foreach ($produtos as $produto)
                <tr>
                    <td>{{ $produto->nome }}</td>
                    {{-- $produto->categoria->nome: usa o relacionamento declarado no Model --}}
                    <td>{{ $produto->categoria->nome }}</td>
                    <td>{{ $produto->tamanho }}</td>
                    <td>{{ $produto->cor }}</td>
                    <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
                    <td>{{ $produto->estoque }}</td>
                    <td>
                        <a href="{{ route('produtos.edit', $produto) }}">Editar</a>
                        <form action="{{ route('produtos.destroy', $produto) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Apagar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection