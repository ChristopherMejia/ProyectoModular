<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PlantillaController;
use App\Http\Requests\ProgramaEducativoRequest;
use App\ProgramaEducativo;

class ProgramaEducativoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('NivelEducacion.create_level');
    }
    public function store(ProgramaEducativoRequest $request)
    {
        
        $programa = new ProgramaEducativo;
        $programa->nombre = $request->educacion;
        $programa->nivel  = $request->nivel;
        $programa->save();

        return \redirect()->back()->with('message', 'Successfully');

    }
    public function show()
    {
        return view('NivelEducacion.show',
        [
            'Programas' => ProgramaEducativo::paginate(8)
        ]);
    }
}
