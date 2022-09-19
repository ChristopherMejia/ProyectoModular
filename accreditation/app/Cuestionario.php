<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuestionario extends Model
{
    protected $primaryKey = 'id';
    protected $table = "cuestionarios";

    public function guias()
    {
        return $this->belongsTo('App\Guia', 'guia_id', 'id');
    }
}
