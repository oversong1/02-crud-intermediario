<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Loja de Roupas</title>
    {{-- @vite: gera as tags <link>/<script> certas, apontando pro CSS/JS compilado --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <header>
        {{-- Continua apontando pra '/' por enquanto - ajustamos na Fase 4 --}}
        <a href="/">Loja de Roupas</a>

        {{-- @auth / @guest: diretivas do Blade que conferem Auth::check() sozinhas --}}
        @auth
            <span>Olá, {{ auth()->user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST" style="display:inline">
                @csrf
                <button type="submit">Sair</button>
            </form>
        @endauth

        @guest
            <a href="{{ route('login.form') }}">Login</a>
        @endguest
    </header>

    <main>
        {{-- Se a sessao tiver uma mensagem de "sucesso" (definida em algum Controller), mostra ela --}}
        @if (session('sucesso'))
            <p style="color: green;">{{ session('sucesso') }}</p>
        @endif

        {{-- @yield: o "buraco" onde o conteudo de cada pagina especifica entra --}}
        @yield('conteudo')
    </main>
</body>
</html>