<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('users/login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
