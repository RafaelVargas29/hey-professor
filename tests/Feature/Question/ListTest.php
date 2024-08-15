<?php

use App\Models\{Question, User};

use function Pest\Laravel\{actingAs, get};

it('should list all the questions', function () {
    // Arrange: Criar perguntas
    // Instancia o factory model User e cria um usuário
    $user = User::factory()->create();

    // utiliza a função actingAs do Pest para agir como um usuário
    /** @var User $user */
    actingAs($user);

    //Instancia o factory da model Question para criar 5 novas perguntas utilizando as funções count e create
    $questions = Question::factory()->count(5)->create();

    // Act: Acessar a rota
    //Utiliza a função get do Pest para acessar a rota
    $response = get(route('dashboard'));

    // Assert: Verificar se a lista de perguntas está sendo mostrada
    /** @var Question $q */ // indica que o $q é uma variável do tipo Question
    foreach($questions as $q) {

        $response->assertSee($q->question);
    }
});
