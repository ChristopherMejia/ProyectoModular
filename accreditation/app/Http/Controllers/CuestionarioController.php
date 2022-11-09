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
use App\User;
use App\RespuestaPregunta;
use App\RespuestaSubpregunta;
use App\FileControl\FileControl;
use DB;
use Auth;

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
            ->get();
        $guias = Guia::with('plantillas')->with('programasEducativos')->orderBy('plantilla_id')->get();
        $cuestionarios = Cuestionario::with('guias')->orderBy('guia_id')->get();
        //dd($cuestionarios);

        foreach($cuestionarios as $cuestionario)
        {
            $organismos = Organismo::where('id', $cuestionario->guias->plantillas->organismo_id)->first();

            $arrayAux = [
                "id" => $cuestionario->id,
                "id_plantilla" => $cuestionario->guias->plantillas->id,
                "version" => $cuestionario->guias->plantillas->version,
                "plantilla" => $organismos->nombre,
                "programa_educativo_nivel" => $cuestionario->guias->programasEducativos->nivel,
                "programa_educativo_nombre" => $cuestionario->guias->programasEducativos->nombre,
                "nombre_coordinador" => User::find($cuestionario->usuario_id)->first_name,
                "status" => $cuestionario->status,
            ];
            array_push($data, $arrayAux);
        }
        //dd($data);
        return view('cuestionario.index',[
            "plantillas" => $plantillas,
            "organismos" => $organismos,
            "programas" => $programas,
            "guias" => $guias,
            "cuestionarios" => $data,
        ]);
    }

    
    public function create(Request $request)
    {
        $cuestionario = new Cuestionario;
        $cuestionario->guia_id = $request->guia_id;
        $cuestionario->usuario_id = Auth::user()->id;
        $cuestionario->fecha_inicio =  date('d-m-y');
        $cuestionario->status = "Activo"; 
        $cuestionario->save();

        return response()->json(['message' => 'success'], 200);
    }

    public function edit($id)
    {
        $cuestionario = Cuestionario::find($id);
        $guia = Guia::find($cuestionario->guia_id);
        $categorias = DB::table('categorias')->where('guia_id','=', $guia->id)->get();
        $respuestasPregunta = RespuestaPregunta::where('cuestionario_id',$id)->get();
        $respuestasSubpregunta = RespuestaSubpregunta::where('cuestionario_id',$id)->get();
        $respuestas_pregunta = [];
        $evidencias_pregunta = [];
        $respuestas_subpregunta = [];

        $i=0;
        foreach($categorias as $categoria){
            $j=0;
            $subcategorias[$i] = DB::table('subcategorias')->where('categoria_id','=', $categoria->id)->get();
            foreach($subcategorias[$i] as $subcategoria){
                $k=0;
                $preguntas[$i][$j] = DB::table('preguntas')->where('subcategoria_id','=', $subcategoria->id)->get();
                foreach($preguntas[$i][$j] as $pregunta){
                    $pregunta->opciones = json_decode($pregunta->opciones);
                    $adjuntos_pregunta[$i][$j][$k] = DB::table('adjunto_pregunta')->where('pregunta_id','=', $pregunta->id)->first();
                    $subpreguntas[$i][$j][$k] = DB::table('subpreguntas')->where('pregunta_id','=', $pregunta->id)->get();
                    foreach($subpreguntas[$i][$j][$k] as $subpregunta){
                        $subpregunta->opciones = json_decode($subpregunta->opciones);
                    }
                    $k++;
                }
                $j++;
            }
            $i++;
        }

        foreach($respuestasPregunta as $respuestaPregunta){
            $respuestas_pregunta[$respuestaPregunta->pregunta_id] = $respuestaPregunta->respuesta;
            $evidencias_pregunta[$respuestaPregunta->pregunta_id] = $respuestaPregunta->evidencia;
        }

        foreach($respuestasSubpregunta as $respuestaSubpregunta){
            $respuestas_subpregunta[$respuestaSubpregunta->subpregunta_id] = $respuestaSubpregunta->respuesta;
        }
        

        //dd($respuestas_pregunta,$respuestas_subpregunta);
        return view('cuestionario.edit',['cuestionario' => $cuestionario, 'guia' => $guia, 'categorias' => $categorias ?? null,
        'subcategorias' => $subcategorias ?? null, 'preguntas' => $preguntas ?? null, 'adjuntos_pregunta' => $adjuntos_pregunta ?? null,
        'subpreguntas' => $subpreguntas ?? null, 'respuestasPregunta' => $respuestas_pregunta ?? null, 
        'respuestasSubpregunta' => $respuestas_subpregunta ?? null,  'evidenciasPregunta' => $evidencias_pregunta ?? null]);
    }

    public function update(Request $request, $id)
    {
        $cuestionario = Cuestionario::find($id);
        
        //dd($request->all());
        $ids_pregunta = $request->get('ids_Pregunta');
        if(isset($ids_pregunta)){
            foreach($ids_pregunta as $id_pregunta){
                $respuestaPregunta = RespuestaPregunta::where('cuestionario_id',$cuestionario->id)->where('pregunta_id',$id_pregunta)->first();
                if($respuestaPregunta === null){
                    $respuestaPregunta = new RespuestaPregunta;
                    $respuestaPregunta->cuestionario_id = $cuestionario->id;
                    $respuestaPregunta->pregunta_id = $id_pregunta;
                }
                $respuestaPregunta->respuesta = $request->get('res_pregunta_' . $id_pregunta);

                if ($request->hasFile('evi_pregunta_' . $id_pregunta)) {
                    $fileName = FileControl::storeSingleFile($request->file('evi_pregunta_' . $id_pregunta), 'evidencias');
                    $respuestaPregunta->evidencia = "/evidencias/{$fileName}";
                }

                $respuestaPregunta->save();
            }
        }

        $ids_subpregunta = $request->get('ids_subpregunta');
        if(isset($ids_subpregunta)){
            foreach($ids_subpregunta as $id_subpregunta){
                $respuestaSubpregunta = RespuestaSubpregunta::where('cuestionario_id',$cuestionario->id)->where('subpregunta_id',$id_subpregunta)->first();
                if($respuestaSubpregunta === null){
                    $respuestaSubpregunta = new RespuestaSubpregunta;
                    $respuestaSubpregunta->cuestionario_id = $cuestionario->id;
                    $respuestaSubpregunta->subpregunta_id = $id_subpregunta;
                }
                $respuestaSubpregunta->respuesta = $request->get('res_subpregunta_' . $id_subpregunta);
                $respuestaSubpregunta->evidencia = $request->get('evidencia_subpregunta_' . $id_subpregunta);
                $respuestaSubpregunta->save();
            }
        }

        return $this->index();
    }

}
