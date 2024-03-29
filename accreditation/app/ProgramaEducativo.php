<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgramaEducativo extends Model
{
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'nombre',
        'nivel',
    ];

    protected $table = 'programa_educativo';

    public function guias()
    {
        return $this->hasMany('App\Guia');
    }
}
