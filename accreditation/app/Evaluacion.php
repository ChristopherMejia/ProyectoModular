<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'plantilla_id',
        'programa_educativo_id',
        'nombre_coordinador',
    ];

    public function plantilla()
    {
        return $this->belongsTo('App\Plantilla');
    }
    
}
