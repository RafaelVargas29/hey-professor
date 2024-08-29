<?php

namespace App\Policies;

use App\Models\{Question, User};

class QuestionPolicy
{
    // O $user passado como parâmetro é o usuário logado
    // o $question é que foi passado lá no PublishController
    public function publish(User $user, Question $question): bool
    {
        // Verifica se o criador da questão é o usuário logado
        return $question->createdBy->is($user);
    }

}
