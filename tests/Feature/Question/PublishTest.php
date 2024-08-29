<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, put};

it('should be able to publush a question ', function () {

    // Criando um usuário
    $user = User::factory()->create();

    // Criando questão com draft true
    $question = Question::factory()
        ->for($user, 'createdBy')
        ->create(['draft' => true]);

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

it('should make sure that only the person who has created the question can publish the question', function () {

    // Criando um usuário
    $rightUser = User::factory()->create(); // Usuário certo
    $wrongUser = User::factory()->create(); // Usuário errado

    // Criando questão com draft true
    $question = Question::factory()->create(['draft' => true, 'created_by' => $rightUser->id]);

    /** @var User $wrongUser */
    // Agindo como um usuário errado
    actingAs($wrongUser);

    // Enviando uma request para a rota com usuário errado
    put(route('question.publish', $question))
    ->assertForbidden(); // Bloqueia request do usuário errado

    /** @var User $rightUser */
    // Agindo como um usuário certo
    actingAs($rightUser);

    // Enviando uma request para a rota
    put(route('question.publish', $question))
    ->assertRedirect();
});
