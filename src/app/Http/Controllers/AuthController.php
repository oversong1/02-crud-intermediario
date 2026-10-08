<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  // classe que faz login/logout/check
use Illuminate\Support\Facades\Hash;  // classe que gera/confere hash de senha

class AuthController extends Controller
{
    // GET /registro - mostra o formulario
    public function formRegistro()
    {
        return view('auth.registro');
    }

    // POST /registro - cria o usuario e ja loga ele
    public function registrar(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // unique: nao deixa 2 usuarios com o mesmo email
            'password' => 'required|min:6|confirmed',        // confirmed: exige um campo "password_confirmation" igual
        ]);

        $usuario = User::create([
            'name' => $dados['nome'],
            'email' => $dados['email'],
            // Hash::make(): NUNCA guarde a senha em texto puro - o hash e uma "one-way"
            // (nao tem como "descriptografar" de volta, so comparar um novo hash igual)
            'password' => Hash::make($dados['password']),
        ]);

        Auth::login($usuario); // ja loga automaticamente, sem precisar passar pelo formulario de login

        // Ainda nao existe a rota 'produtos.index' (so vem na Fase 4) - por enquanto,
        // redireciona pra raiz. Vamos trocar isso quando a rota existir.
        return redirect('/')->with('sucesso', 'Conta criada!');
    }

    // GET /login - mostra o formulario
    public function formLogin()
    {
        return view('auth.login');
    }

    // POST /login - confere e-mail/senha
    public function login(Request $request)
    {
        $credenciais = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Auth::attempt(): confere o email/senha contra a tabela "users" (comparando
        // o hash sozinho) - se bater, JA cria a sessao de login, devolve true.
        if (Auth::attempt($credenciais)) {
            // regenerate(): troca o ID da sessao depois do login - protege contra um
            // ataque chamado "session fixation" (alguem forcar voce a usar uma sessao
            // que ja conhece, antes de voce logar).
            $request->session()->regenerate();

            // Mesma situacao do registrar() acima - ajustamos pra 'produtos.index' na Fase 4.
            return redirect('/');
        }

        // back(): volta pra pagina anterior (o formulario), preservando a URL
        return back()->withErrors(['email' => 'E-mail ou senha inválidos.']);
    }

    // POST /logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();     // apaga a sessao atual
        $request->session()->regenerateToken(); // gera um novo token CSRF

        return redirect()->route('login.form');
    }
}
