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
        $programas = ProgramaEducativo::paginate(10);
        return view('programa_educativo.programas_educativos',[
            'programas' => $programas,
        ]);
    }
    public function store(Request $request)
    {
        
        $programa = new ProgramaEducativo;
        $programa->nombre = $request->name;
        $programa->nivel  = $request->level;
        $programa->save();

        return response()->json(['message' => 'success'], 200);

    }
    public function show(Request $request)
    {
        $programaEducativo = ProgramaEducativo::where('id', $request->id)->first();
        return response()->json(['message' => 'success', 'programaEducativo' => $programaEducativo], 200);
    }

    public function edit(Request $request)
    {
        $programaEducativo = ProgramaEducativo::where('id', $request->id)->first();
        $programaEducativo->nombre = $request->name;
        $programaEducativo->nivel = $request->level;
        $programaEducativo->save();

        return response()->json(['message' => 'success'], 200);
     
    }

    public function destroy(Request $request)
    {
        $programaEducativo = ProgramaEducativo::where('id', $request->id)->first();
        $programaEducativo->delete();
        return response()->json(['message' => 'success'], 200);
    }
}
