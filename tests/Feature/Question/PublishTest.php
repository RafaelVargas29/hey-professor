<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, put};

it('should be able to publush a question ', function () {

    // Criando um usuário
    $user = User::factory()->create();

    // Criando questão com draft true
    $question = Question::factory()->create(['draft' => true]);

    /** @var User $user */
    // Agindo como um usuário
    actingAs($user);

    // Enviando uma request para a rota
    put(route('question.publish', $question))
        ->assertRedirect();

    //Vai no banco de dados e atualiza a Model com os novos dados
    $question->refresh();

    /** @var Question $question */
    // Esperando que o draft agora seja falso
    expect($question)
        ->draft->toBeFalse();
});
