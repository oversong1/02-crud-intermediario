@extends('layouts.app')

@section('conteudo')
    <h1>Criar conta</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $erro)
                <li>{{ $erro }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('registro') }}" method="POST">
        @csrf
        <label>Nome:</label>
        <input type="text" name="nome" value="{{ old('nome') }}">

        <label>E-mail:</label>
        <input type="email" name="email" value="{{ old('email') }}">

        <label>Senha:</label>
        <input type="password" name="password">

        <label>Confirme a senha:</label>
        {{-- "password_confirmation" - o nome EXATO que a regra "confirmed" espera --}}
        <input type="password" name="password_confirmation">

        <button type="submit">Criar conta</button>
    </form>
@endsection