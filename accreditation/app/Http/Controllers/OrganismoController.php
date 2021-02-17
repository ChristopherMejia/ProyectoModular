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
        return view('home',
        [
            'Organismos' => Organismo::all()
        ]);
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

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
