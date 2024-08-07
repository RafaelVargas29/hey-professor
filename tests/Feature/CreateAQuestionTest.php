<?php

use App\Models\User;

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas, post};

it('should be able to create a new question bigger than 255 characters', function () {
    // Aarrange :: Preparar
    $user = User::factory()->create();

    actingAs($user);

    // Act :: Agir
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 260) . '?',
    ]);

    // Assert :: Verificar
    $request->assertRedirect(route('dashboard'));

    assertDatabaseCount('questions', 1);

    assertDatabaseHas('questions', ['question' => str_repeat('*', 260) . '?']);
});

it('should check if ends with question mark ?', function () {
    // Arrange :: Preparar
    $user = User::factory()->create();

    actingAs($user);

    // Act :: Agir
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 10),
    ]);

    // Assert :: Verificar
    $request->assertSessionHasErrors([
        'question' => 'Are you sure that is a question? It is missing the question mark in the end.',
    ]);

    assertDatabaseCount('questions', 0);
});

it('should have at least 10 characters', function () {
    // Arrange :: Preparar
    $user = User::factory()->create();

    actingAs($user);

    // Act :: Agir
    $request = post(route('question.store'), [
        'question' => str_repeat('*', 8) . '?',
    ]);

    // Assert :: Verificar
    $request->assertSessionHasErrors(['question' => __('validation.min.string', ['min' => 10, 'attribute' => 'question'])]); //Verifica se houve erro nesse campo e indica qual foi o erro

    assertDatabaseCount('questions', 0);
});
