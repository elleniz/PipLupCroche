<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class ClienteLoginController extends Controller
{
    public function inicio()
    {
        if (!session('cliente_logado')) {
            return redirect()->route('login');
        }

        return redirect()->route('cliente.home');
    }

    public function produtos()
    {
        if (!session('cliente_logado')) {
            return redirect()->route('login');
        }

        $dados = Produto::all();

        return view('cliente.home', compact('dados'));
    }

    public function logout(Request $request)
    {
        $request->session()->forget([
            'cliente_logado',
            'cliente_nome',
        ]);

        return redirect()->route('login');
    }
}