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

class GuiaController extends Controller
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


    public function create(Request $request){
        // dd($request);
        $guia = new Guia;
        $guia->plantilla_id = $request->plantilla_id;
        $guia->programa_educativo_id = $request->programa_educativo_id;
        $guia->nombre_coordinador = $request->nombre_coordinador;
        $guia->fecha_inicio = $request->fecha_inicio;
        $guia->status = $request->status;
        $guia->save();

        return response()->json(['message' => 'success'], 200);
        // $data = ProgramaEducativo::find($idProgramaEducativo);
        // // dd($data);
        // return view('plantilla.start', [ 'data' => $data]);

    }


    public function edit($id)
    {
        $guia = Guia::find($id);
        $categorias = DB::table('categorias')->where('guia_id','=', $guia->id)->get();

        $guia = Guia::with('plantillas')->with('programasEducativos')->where( 'id' , $id)->first();
        
        /* $nombre  = $plantilla->organismo->nombre;
        $version = $plantilla->version;
        $id      = $plantilla->id;
        $plantilla_info = array(
            'plantilla_id'      => $id,
            'plantilla_nombre'  => $nombre,
            'plantilla_version' => $version,
        );
 */
        /* if($categorias->isEmpty()){//si la plantilla esta vacia redirige a start
            return view('plantilla.start')->with('plantilla', $plantilla_info);
        } */

        $i=0;
        foreach($categorias as $categoria){
            $j=0;
            $subcategorias[$i] = DB::table('subcategorias')->where('categoria_id','=', $categoria->id)->get();
            foreach($subcategorias[$i] as $subcategoria){
                $k=0;
                $preguntas[$i][$j] = DB::table('preguntas')->where('subcategoria_id','=', $subcategoria->id)->get();
                foreach($preguntas[$i][$j] as $pregunta){
                    $pregunta->opciones = json_decode($pregunta->opciones);
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

        //return array('plantilla' => $plantilla_info, 'categorias' => $categorias, 'subcategorias' => $subcategorias, 'preguntas' => $preguntas);
        return view('guia.edit',['guia' => $guia, 'categorias' => $categorias ?? null,
        'subcategorias' => $subcategorias ?? null, 'preguntas' => $preguntas ?? null, 'subpreguntas' => $subpreguntas ?? null]);
    }

    public function update(Request $request, $id)
    {
        $guia = Guia::find($id);

        //dd($request->all());

        //arreglos de una dimension [] para las categorias
        $categorias = $request->get('categorias');
        $id_categorias = $request->get('id_categorias');

        //arreglos de dos dimensiones[][] para las subcategorias
        $subcategorias = $request->get('subcategorias');
        $id_subcategorias = $request->get('id_subcategorias');

        //arreglos de tres dimensiones[][][] para las preguntas
        $preguntas = $request->get('preguntas');
        $id_preguntas = $request->get('id_preguntas');
        $tipos = $request->get('tipos');
        $evidencias = $request->get('evidencias');
        $adjuntos = $request->get('adjuntos');
        $opciones = $request->get('opciones');

        //arreglos de cuatro dimensiones[][][][] para las subpreguntas
        $subpreguntas = $request->get('subpreguntas');
        $id_subpreguntas = $request->get('id_subpreguntas');
        $tipos_sub = $request->get('tipos_sub');
        $subopciones = $request->get('subopciones');

        $i = 0;

        while($i < count($categorias)){ //itera por cada categoria
            if($id_categorias[$i] != null){ //si ya existe la categoria, la actualiza
                $categoriasUpdate = DB::table('categorias')
                ->where('id', $id_categorias[$i])
                ->update(['descripcion' => $categorias[$i]]);

                $categoria = Categoria::find($id_categorias[$i]);
            }
            else{ //si no existe la categoria, crea una nueva
                $categoria = new Categoria();
                $categoria->guia_id = $guia->id;
                $categoria->descripcion = $categorias[$i];
                $categoria->save();
            }
            if($subcategorias)//verifica que existan las subcategorias
            if($subcategorias[$i] ?? null){//verifica que existan las subcategorias en la categoria
                $j=0;
                while($j < count($subcategorias[$i])){//itera por cada subcategoria
                    if($id_subcategorias[$i][$j] != null){ //si ya existe la subcategoria, la actualiza
                        $subcategoriasUpdate = DB::table('subcategorias')
                        ->where('id', $id_subcategorias[$i][$j])
                        ->update(['descripcion' => $subcategorias[$i][$j]]);

                        $subcategoria = Subcategoria::find($id_subcategorias[$i][$j]);
                    }
                    else{ //si no existe la subcategoria, crea una nueva
                        $subcategoria = new Subcategoria();
                        $subcategoria->categoria_id = $categoria->id;
                        $subcategoria->descripcion = $subcategorias[$i][$j];
                        $subcategoria->save();
                    }

                    if($preguntas)//verifica que existan las preguntas
                    if($preguntas[$i][$j] ?? null){//verifica que existan las preguntas en la subcategoria
                        $k=0;
                        while($k < count($preguntas[$i][$j])){//itera por cada pregunta
                            if($id_preguntas[$i][$j][$k] != null){ //si ya existe la pregunta, la actualiza
                                $preguntasUpdate = DB::table('preguntas')
                                ->where('id', $id_preguntas[$i][$j][$k])
                                ->update(['descripcion' => $preguntas[$i][$j][$k],
                                'tipo' => $tipos[$i][$j][$k],
                                'evidencia' => ($evidencias[$i][$j][$k] ? '1' : '0'),
                                'descripcion_evidencia' => $evidencias[$i][$j][$k],
                                'adjunto' => ($adjuntos[$i][$j][$k] ? '1' : '0'),
                                'opciones' => json_encode($opciones[$i][$j][$k])]);

                                $pregunta = Pregunta::find($id_preguntas[$i][$j][$k]);
                            }
                            else{ //si no existe la pregunta, crea una nueva
                                $pregunta = new Pregunta();
                                $pregunta->subcategoria_id = $subcategoria->id;
                                $pregunta->descripcion = $preguntas[$i][$j][$k];
                                $pregunta->tipo = $tipos[$i][$j][$k];
                                $pregunta->evidencia = ($evidencias[$i][$j][$k] ? '1' : '0');
                                $pregunta->descripcion_evidencia = $evidencias[$i][$j][$k];
                                $pregunta->adjunto = ($adjuntos[$i][$j][$k] ? '1' : '0');
                                $pregunta->opciones = json_encode($opciones[$i][$j][$k]);
                                $pregunta->save();
                            }
                            if($subpreguntas)//verifica que existan las subpreguntas
                            if($subpreguntas[$i][$j][$k] ?? null){//verifica que existan las subpreguntas en la pregunta
                                $l=0;
                                    while($l < count($subpreguntas[$i][$j][$k])){//itera por cada subpregunta ##CORREGIR
                                        if($id_subpreguntas[$i][$j][$k][$l] != null){ //si ya existe la subpregunta, la actualiza
                                            $subpreguntasUpdate = DB::table('subpreguntas')
                                            ->where('id', $id_subpreguntas[$i][$j][$k][$l])
                                            ->update(['descripcion' => $subpreguntas[$i][$j][$k][$l],
                                            'tipo' => $tipos_sub[$i][$j][$k][$l],
                                            'opciones' => json_encode($subopciones[$i][$j][$k][$l])]);
                                            $subpregunta = Subpregunta::find($id_subpreguntas[$i][$j][$k][$l]);
                                        }
                                        else{ //si no existe la subspregunta, crea una nueva
                                            $subpregunta = new Subpregunta();
                                            $subpregunta->pregunta_id = $pregunta->id;
                                            $subpregunta->descripcion = $subpreguntas[$i][$j][$k][$l];
                                            $subpregunta->tipo = $tipos_sub[$i][$j][$k][$l];
                                            $subpregunta->opciones = json_encode($subopciones[$i][$j][$k][$l]);
                                            $subpregunta->save();
                                        }
                                    $l=$l+1;
                                    }
                            }
                            $k=$k+1;
                        }
                    }
                    $j=$j+1;
                }
            }
            $i=$i+1;
        }

        $guia->status = 'Pendiente';
        $guia->save();
       /*  return array(/*'ids' => $id_categorias, 'categorias' => $categorias, 'ids_subcategorias' => $id_subcategorias,
        'subcategorias' =>$subcategorias, 'ids_preguntas' => $id_preguntas, 'preguntas' => $preguntas, 'tipos' => $tipos, 'evidencias' => $evidencias, 'adjuntos' => $adjuntos, 'subpreguntas' => $subpreguntas); */
        return $this->index();
    }


    public function start($id)
    {

        $guia = Guia::with('plantillas')->with('programasEducativos')->where( 'id' , $id)->get()->first();
        return view('guia.start', [ 'guia' => $guia]);

    }


    public function finish(Request $request, $id)
    {
        $guia = Guia::find($id);
        $guia->status = 'Finalizada';
        $guia->save();
    }
}
