<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    const MANAGER = 1;
    const COORDINATOR = 2;
    const TEACHER = 3;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public function isManager(){
        return $this->role_id ===  User::MANAGER;
    }
    public function isCoordinator(){
        return $this->role_id === User::COORDINATOR;
    }
    public function isTeacher(){
        return $this->role_id === User::TEACHER;
    }
}
