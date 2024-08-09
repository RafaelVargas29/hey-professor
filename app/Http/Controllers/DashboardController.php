<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // __invoque() faz com que quando eu enviar uma request para esse controlador ele vai retornar diretamente essa função
    public function __invoke()
    {
        // Retorna uma view e alguns parâmetros
        return view('dashboard', [
            //Variável que estou passando como parâmetro e que posso usar na view dashboard
            // Question::all() está instnaciando a Model Question e pegando tudo que tem na tabela correspondente a ela
            'questions' => Question::all(),
        ]);
    }
}
