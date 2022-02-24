<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserPostRequest;
use Illuminate\Support\Facades\Hash;
use App\User;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::orderBy('first_name')->paginate(5);
        return view('users.users',[
            'users' => $users,
        ]);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $user = new User;
        $user->first_name = $request->name;
        $user->last_name = $request->lastName;
        $user->email = $request->email;
        $user->role_id = $request->role;
        $user->password = Hash::make($request->password);
        $user->save();
        return response()->json(['message' => 'success'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $user = User::where('id', $request->idUser)->first();
        return response()->json(['message' => 'success', 'user' => $user], 200);
    }

    public function update(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $user->first_name = $request->name;
        $user->last_name = $request->lastName;
        $user->email = $request->email;
        $user->role_id = $request->role;

        ($request->password == null) ? '' : $user->password = $request->password;
        $user->save();
        return response()->json(['message' => 'success'], 200);
    }

    public function delete(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $user->delete();

        return response()->json(['message' => 'success'], 200);
    }
}
