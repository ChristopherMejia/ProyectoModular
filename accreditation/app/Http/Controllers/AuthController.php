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
    public function login()
    {
        $rules = array(
            'email'    => 'required|email', // make sure the email is an actual email
            'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
        );

        $validator = Validator::make(Input::all(), $rules);

        // if the validator fails, redirect back to the form
        if ($validator->fails()) {
            return Redirect::to('login');
                
        } else {
        
            // create our user data for the authentication
            $userdata = array(
                'email'     => Input::get('email'),
                'password'  => Input::get('password')
            );
        
            // attempt to do the login
            if (Auth::attempt($userdata)) {
                echo 'SUCCESS!';
            } else {        
            
                // validation not successful, send back to form 
                return redirect::to('login');
            
            }
        
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('login');
    }
}
