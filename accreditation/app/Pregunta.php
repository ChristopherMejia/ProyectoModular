<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pregunta extends Model
{
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable =[
        'idTipo',
        'version',
    ];
}
