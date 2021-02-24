<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organismo extends Model
{
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'id',
        'nombre',
    ];

    public function plantillas()
    {
        return $this->hasMany('App\Plantilla');
    }
}
