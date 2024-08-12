<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\{Question};
use Illuminate\Http\{RedirectResponse};

class LikeController extends Controller
{
    // Essa linha é um Route Model Binding (link entre a rota e a model)
    // Pega o id que foi passado pela rota e executa um find na Model especificada (Question) para procurar a questão com esse id
    public function __invoke(Question $question): RedirectResponse
    {
        // Diz que o usuário gostou da pergunta
        user()->like($question); // Para usar essa linha desse jeito precisa mexer o composer.json e criar um diretório Support com um arquivo Function.php com função global

        // Faz com que retorne para o ponto em que estava antes de chamar essa função estava
        return back();
    }
}
