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
        return view('programa_educativo.create_level');
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
        return view('programa_educativo.show',
        [
            'Programas' => ProgramaEducativo::paginate(8)
        ]);
    }

    public function edit(ProgramaEducativoRequest $request)
    {
        $id_program = $request->id;
        $programSchool = ProgramaEducativo::where('id', $id_program)->first();
        if($request->nivel === "null"){
            $programSchool->nombre = $request->educacion;
        }else{
            $programSchool->nombre = $request->educacion;
            $programSchool->nivel = $request->nivel;
        }
        $programSchool->save();

        return \redirect()->back()->with('message', 'Successfully');
     
    }

    public function destroy(Request $request)
    {
        dd($request->all());
    }
}
