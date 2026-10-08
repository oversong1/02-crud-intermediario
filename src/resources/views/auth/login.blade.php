@extends('layouts.app')

@section('conteudo')
    <h1>Login</h1>

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $erro)
                <li>{{ $erro }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('login') }}" method="POST">
        @csrf
        <label>E-mail:</label>
        <input type="email" name="email" value="{{ old('email') }}">

        <label>Senha:</label>
        <input type="password" name="password">

        <button type="submit">Entrar</button>
    </form>

    <p>Não tem conta? <a href="{{ route('registro.form') }}">Registre-se</a></p>
@endsection
