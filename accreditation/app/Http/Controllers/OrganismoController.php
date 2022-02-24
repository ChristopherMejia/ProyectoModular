<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganismoRequest;
use Illuminate\Http\Request;
use App\Organismo;

class OrganismoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('home');
    }

    public function display()
    {
        $organismos = Organismo::orderBy('nombre')->paginate(5);
        return view('organismo/organismos', [
            'organismos' => $organismos,
        ]);
    }

    public function store(OrganismoRequest $request)
    {
        $name = $request->input('name');

        $organismo = new Organismo;
        $organismo->nombre = $name;
        $organismo->save();

        return response()->json(['message' => 'success'], 200);
    }

    public function show(Request $request)
    {
        // dd($request->all());
        $organismo = Organismo::where('id', $request->id)->first();
        return response()->json(['message' => 'success', 'organismo' => $organismo], 200);
    }

    public function edit(OrganismoRequest $request)
    {
        // dd($request->all());
        $organismo = Organismo::find($request->id);
        $organismo->nombre = $request->name;
        $organismo->save();
        return response()->json(['message' => 'success'], 200);

    }

    public function destroy(Request $request)
    {
        // dd($request);
        $organismo = Organismo::find($request->id);
        $organismo->delete();
        return response()->json(['message' => 'success'], 200);

    }
}
