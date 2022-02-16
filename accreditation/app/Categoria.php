<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $table = 'categorias';

}
