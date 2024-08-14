<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('question_id')->nullable(); //Cria a coluna question_id
            $table->foreign('question_id')->references('id')->on('questions')->cascadeOnDelete(); // Conecta a coluna question_id à coluna id da tabela question
            $table->unsignedBigInteger('user_id')->nullable(); // Cria a coluna user_id
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete(); // conecta a coluna user_id à coluna id da tabela users
            $table->unsignedSmallInteger('like')->default(0); // Quantidade menor de inteiros e todos positivos
            $table->unsignedSmallInteger('unlike')->default(0); // Quantidade menor de inteiros e todos positivos
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
