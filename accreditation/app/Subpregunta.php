<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subpregunta extends Model
{
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable =[
        'idTipo',
        'descripcion',
        'idPregunta',
        'identificacion',
    ];
}
