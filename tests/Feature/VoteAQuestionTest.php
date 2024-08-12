<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, assertDatabaseHas, post};

it('it should be able to like a question', function () {

    // Arrange:: Preparar (Cria um usuário e uma questão)
    $user     = User::factory()->create();
    $question = Question::factory()->create();

    // Act:: Agir (Vai imitar as ações de um usuário. Ex.: enviar request e logar no sistema)
    /** @var User $user */
    actingAs($user);

    /** @var Question $question */
    post(route('question.like', $question))->assertRedirect();

    // Assert:: Verificar (verifica se existe um registro nesse modelo no banco de dados    )
    assertDatabaseHas('votes', [
        'question_id' => $question->id,
        'like'        => 1,
        'unlike'      => 0,
        'user_id'     => $user->id,
    ]);

});
