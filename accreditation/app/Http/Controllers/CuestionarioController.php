<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plantilla;
use App\Organismo;
use App\Categoria;
use App\Subcategoria;
use App\Pregunta;
use App\Subpregunta;
use App\ProgramaEducativo;
use App\Guia;
use App\Cuestionario;
use DB;

class CuestionarioController extends Controller
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
        $cuestionarios = Cuestionario::with('plantillas')->with('programasEducativos')->orderBy('plantilla_id')->paginate(7);
        //dd($cuestionarios);

        foreach($cuestionarios as $cuestionario)
        {
            $organismos = Organismo::where('id', $cuestionario->plantillas->organismo_id)->first();

            $arrayAux = [
                "id" => $cuestionario->id,
                "id_plantilla" => $cuestionario->plantillas->id,
                "version" => $cuestionario->plantillas->version,
                "plantilla" => $organismos->nombre,
                "programa_educativo_nivel" => $cuestionario->programasEducativos->nivel,
                "programa_educativo_nombre" => $cuestionario->programasEducativos->nombre,
                "nombre_coordinador" => User::find($cuestionario->usuario_id)->select('first_name'),
                "status" => $cuestionario->status,
            ];
            array_push($data, $arrayAux);
        }
        // dd($data);
        return view('cuestionario.index',[
            "plantillas" => $plantillas,
            "organismos" => $organismos,
            "programas" => $programas,
            "guias" => $guias,
            "cuestionarios" => $data,
        ]);
    }
}
