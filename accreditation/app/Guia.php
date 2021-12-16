<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Guia extends Model
{
    protected $primaryKey = 'id';
    
    protected $fillable = [
        'id',
        'plantilla_id',
        'programa_educativo_id',
        'nombre_coordinador',
        'fecha',
        'created_at',
        'updated_at',
    ];

    public function plantillas()
    {
        return $this->belongsTo('App\Plantilla', 'plantilla_id', 'id');
    }
    public function programasEducativos()
    {
        return $this->belongsTo('App\ProgramaEducativo', 'programa_educativo_id', 'id');
    } 
}
