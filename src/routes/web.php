<?php

use Illuminate\Support\Facades\Route;

// Importa a classe, pra poder escrever so AuthController::class abaixo,
// em vez do caminho completo App\Http\Controllers\AuthController::class.
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});


// Route::get: essa rota so responde a requisicoes GET (navegador pedindo pra VER a pagina).
// primeiro parametro: a URL que ativa essa rota.
// segundo parametro, [AuthController::class, 'formRegistro']: quando bater aqui,
// chama o metodo formRegistro() dentro da classe AuthController - equivale a fazer
// (new AuthController)->formRegistro(), so que o Laravel instancia a classe sozinho.
// name(): da um NOME pra essa rota - a partir de agora, em qualquer lugar do codigo,
// route('registro.form') gera a URL certa, sem escrever '/registro' repetido pelo projeto.
Route::get('/registro', [AuthController::class, 'formRegistro'])->name('registro.form');

// Route::post: essa rota so responde quando o FORMULARIO e enviado (metodo POST),
// nao quando alguem so visita a pagina.
Route::post('/registro', [AuthController::class, 'registrar'])->name('registro');

Route::get('/login', [AuthController::class, 'formLogin'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// So POST porque sair e uma ACAO (muda o estado da sessao) - nunca deveria responder
// a um GET (um link clicado sem querer nao deveria deslogar ninguem).
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');