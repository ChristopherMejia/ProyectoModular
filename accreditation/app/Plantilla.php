<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plantilla extends Model
{
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable =[
        'organismo_id',
        'version',
    ];

    public function organismo()
    {
        return $this->belongsTo('App\Organismo');
    }

}