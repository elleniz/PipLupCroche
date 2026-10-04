<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => ['required', 'string'],
            'senha' => ['required', 'string'],
        ]);

        $login = trim((string) $request->input('login'));
        $senha = (string) $request->input('senha');

        /*
        |--------------------------------------------------------------------------
        | Login administrativo
        |--------------------------------------------------------------------------
        */

        if ($login === 'admin' && $senha === '123') {
            $request->session()->regenerate();

            $request->session()->forget([
                'cliente_logado',
                'cliente_nome',
            ]);

            $request->session()->put([
                'usuario_logado' => true,
                'usuario_login' => 'Admin',
            ]);

            return redirect()->route('home');
        }

        /*
        |--------------------------------------------------------------------------
        | Login de cliente
        |--------------------------------------------------------------------------
        */

        if ($login === 'cliente' && $senha === 'cliente123') {
            $request->session()->regenerate();

            $request->session()->forget([
                'usuario_logado',
                'usuario_login',
            ]);

            $request->session()->put([
                'cliente_logado' => true,
                'cliente_nome' => 'Cliente',
            ]);

            return redirect()->route('cliente.home');
        }

        return back()
            ->withErrors([
                'login' => 'Login ou senha inválidos.',
            ])
            ->withInput($request->only('login'));
    }

    public function logout(Request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}