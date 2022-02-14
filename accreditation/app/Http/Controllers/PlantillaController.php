<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlantillaRequest;
use Illuminate\Http\Request;
use App\Plantilla;
use App\Organismo;
use App\Categoria;
use App\Subcategoria;
use App\Pregunta;
use App\Subpregunta;
use App\ProgramaEducativo;
use App\Guia;

use DB;

class PlantillaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = array();
        $organismos = Organismo::all()->sortBy('nombre');
        $programas = ProgramaEducativo::all()->sortBy('nombre');
        $plantillas=DB::table('plantillas as plantilla')
            ->join('organismos as organismo','plantilla.organismo_id','=','organismo.id')
            ->select('plantilla.id','organismo.nombre','plantilla.version')
            ->orderBy('plantilla.organismo_id','desc')
            ->paginate(7);
        $guias = Guia::with('plantillas')->with('programasEducativos')->orderBy('plantilla_id')->paginate(7);
        // dd($guias);
        // informacion de las guias organizada
        foreach($guias as $guia)
        {
            $organimos = Organismo::where('id', $guia->plantillas->organismo_id)->first();

            $arrayAux = [
                "id" => $guia->id,
                "id_plantilla" => $guia->plantillas->id,
                "version" => $guia->plantillas->version,
                "plantilla" => $organimos->nombre,
                "programa_educativo_nivel" => $guia->programasEducativos->nivel,
                "programa_educativo_nombre" => $guia->programasEducativos->nombre,
                "nombre_coordinador" => $guia->nombre_coordinador,
                "status" => $guia->status,
            ];
            array_push($data, $arrayAux);
        }
        // dd($data);
        return view('plantilla.index',[
            "plantillas" => $plantillas,
            "organismos" => $organismos,
            "programas" => $programas,
            "guias" => $data,
        ]);
    }

    public function create(Request $request)
    {
        $plantilla = new Plantilla;
        $plantilla->organismo_id = $request->idOrganismo;
        $plantilla->version = $request->version;
        $plantilla->save();

        return response()->json(['message' => 'success'], 200);

    }

    public function show(Request $request){
        $plantilla = Plantilla::with('organismo')->where('id', $request->id)->first();
        return response()->json(['message' => 'success', 'plantilla' => $plantilla], 200);
    }

    public function destroy(Request $request)
    {
        $guias = Guia::where('plantilla_id', $request->id)->get();
        if($guias->count() > 0){

            foreach ($guias as $guia) {
                # code...
                $guia->delete();
            }
        }
        $plantilla = Plantilla::find($request->id);
        $plantilla->delete();
        return response()->json(['message' => 'success'], 200);

    }
}
