<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subopcion extends Model
{
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'idSubpregunta',
        'descripcion',
    ];
}
