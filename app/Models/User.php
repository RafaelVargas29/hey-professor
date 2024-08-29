<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    //funcão de voto. Diz que um usuário pode ter muitos votos
    /**
     * @return HasMany<Vote> //Solução para resolver erro TRelatedModel
    */
    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    public function like(Question $question): void
    {

        // Está atualizando ou criando uma like para um id de pergunta de um um id de usuário
        $this->votes()->updateOrCreate(
            ['question_id' => $question->id], // Verififca se a pergunta é a mesma

            [
                'like'   => 1,
                'unlike' => 0,
            ]
        );
    }

    public function unlike(Question $question): void
    {

        // Está atualizando ou criando uma unlike para um id de pergunta de um um id de usuário
        $this->votes()->updateOrCreate(
            ['question_id' => $question->id], // Verififca se a pergunta é a mesma

            [
                'like'   => 0,
                'unlike' => 1,
            ]
        );
    }

    public function questions(): HasMany
    {
        // Diz que um usuário pode ter várias questões
        return $this->hasMany(Question::class, 'created_by');
    }
}
