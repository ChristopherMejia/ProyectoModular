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

    public function create()
    {
        return view('organismo/create');
    }

    public function store(OrganismoRequest $request)
    {
        $name = $request->input('name');

        $organismo = new Organismo;
        $organismo->nombre = $name;
        $organismo->save();

        return \redirect()->back()->with('message', 'Successfully');
    }

    public function show()
    {
        return view('organismo/show',
        [
            'Organismos' => Organismo::all()
        ]);
    }

    public function edit(OrganismoRequest $request)
    {
        // dd($request->all());
        $organismo = Organismo::find($request->id);
        $organismo->nombre = $request->name;
        $organismo->save();
        return \redirect()->back()->with('message', 'Successfully');
    }

    public function destroy(Request $request)
    {
        // dd($request);
        $organismo = Organismo::find($request->id);
        $organismo->delete();
        return \redirect()->back()->with('message', 'Successfully');
    }
}
