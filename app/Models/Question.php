<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    use HasFactory; //Faz com que essa model identifique e utilize a factory dela

    // Utilizado pra quando o campo vai ser utilizado
    // Faz com que a formatação venha da forma que eu quero (casts no laravel documentation)
    protected $casts = [
        'draft' => 'bool',
    ];

    protected $guarded = [];

    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

}
