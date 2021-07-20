<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'roles';
    public $timestamps = false;


    protected $fillable = [
        'id',
        'name',
    ];
}
