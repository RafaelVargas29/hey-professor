<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory; //Faz com que essa model identifique e utilize a factory dela

    protected $guarded = [];
}
