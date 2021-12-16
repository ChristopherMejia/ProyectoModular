<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $roles = Role::all();
        return response()->json(['message' => 'success', 'roles'=>$roles], 200);

    }
}
