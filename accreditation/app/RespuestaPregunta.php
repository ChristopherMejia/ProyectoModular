<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RespuestaPregunta extends Model
{
    protected $primaryKey = 'id';

    protected $table = 'respuestas_pregunta';
}
