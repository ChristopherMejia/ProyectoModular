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

    public function createGuia(Request $request){
        // dd($request);
        $id = $request->plantilla_id;
        $guia = new Guia;
        $guia->plantilla_id = $request->plantilla_id;
        $guia->programa_educativo_id = $request->programa_educativo_id;
        $guia->nombre_coordinador = $request->nombre_coordinador;
        $guia->fecha_inicio = $request->fecha_inicio;
        $guia->status = $request->status;
        $guia->save();

        return response()->json(['message' => 'success'], 200);

    }


    public function edit($id)
    {
        $plantilla = Plantilla::find($id);
        $categorias = DB::table('categorias')->where('idplantilla','=', $plantilla->id)->get();

        $nombre  = $plantilla->organismo->nombre;
        $version = $plantilla->version;
        $id      = $plantilla->id;
        $plantilla_info = array(
            'plantilla_id'      => $id,
            'plantilla_nombre'  => $nombre,
            'plantilla_version' => $version,
        );

        if($categorias->isEmpty()){//si la plantilla esta vacia redirige a start
            return view('plantilla.start')->with('plantilla', $plantilla_info);
        }

        $i=0;
        foreach($categorias as $categoria){
            $j=0;
            $subcategorias[$i] = DB::table('subcategorias')->where('idCategoria','=', $categoria->id)->get();
            foreach($subcategorias[$i] as $subcategoria){
                $k=0;
                $preguntas[$i][$j] = DB::table('preguntas')->where('idSubcategoria','=', $subcategoria->id)->get();
                foreach($preguntas[$i][$j] as $pregunta){
                    $subpreguntas[$i][$j][$k] = DB::table('subpreguntas')->where('idPregunta','=', $pregunta->id)->get();
                    $k++;
                }
                $j++;
            }
            $i++;
        }

        //return array('plantilla' => $plantilla_info, 'categorias' => $categorias, 'subcategorias' => $subcategorias, 'preguntas' => $preguntas);
        return view('plantilla.edit',['plantilla' => $plantilla_info, 'categorias' => $categorias ?? null,
        'subcategorias' => $subcategorias ?? null, 'preguntas' => $preguntas ?? null, 'subpreguntas' => $subpreguntas ?? null]);
    }

    public function update(Request $request, $id)
    {
        $plantilla = Plantilla::find($id);

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

        //arreglos de cuatro dimensiones[][][][] para las subpreguntas
        $subpreguntas = $request->get('subpreguntas');
        $id_subpreguntas = $request->get('id_subpreguntas');
        $tipos_sub = $request->get('tipos_sub');

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
                $categoria->idPlantilla = $plantilla->id;
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
                        $subcategoria->idCategoria = $categoria->id;
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
                                'idTipo' => $tipos[$i][$j][$k],
                                'conEvidencia' => ($evidencias[$i][$j][$k] ? '1' : '0'),
                                'descripcionEvidencia' => $evidencias[$i][$j][$k],
                                'conAdjunto'   => ($adjuntos[$i][$j][$k] ? '1' : '0')]);

                                $pregunta = Pregunta::find($id_preguntas[$i][$j][$k]);
                            }
                            else{ //si no existe la pregunta, crea una nueva
                                $pregunta = new Pregunta();
                                $pregunta->idSubcategoria = $subcategoria->id;
                                $pregunta->descripcion = $preguntas[$i][$j][$k];
                                $pregunta->idTipo = $tipos[$i][$j][$k];
                                $pregunta->conEvidencia = ($evidencias[$i][$j][$k] ? '1' : '0');
                                $pregunta->descripcionEvidencia = $evidencias[$i][$j][$k];
                                $pregunta->conAdjunto = ($adjuntos[$i][$j][$k] ? '1' : '0');
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
                                            'idTipo' => $tipos_sub[$i][$j][$k][$l]]);

                                            $subpregunta = Subpregunta::find($id_subpreguntas[$i][$j][$k][$l]);
                                        }
                                        else{ //si no existe la subspregunta, crea una nueva
                                            $subpregunta = new Subpregunta();
                                            $subpregunta->idPregunta = $pregunta->id;
                                            $subpregunta->descripcion = $subpreguntas[$i][$j][$k][$l];
                                            $subpregunta->idTipo = $tipos_sub[$i][$j][$k][$l];
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
        return array(/*'ids' => $id_categorias, 'categorias' => $categorias, 'ids_subcategorias' => $id_subcategorias,
        'subcategorias' =>$subcategorias,*/ 'ids_preguntas' => $id_preguntas, 'preguntas' => $preguntas, 'tipos' => $tipos, 'evidencias' => $evidencias, 'adjuntos' => $adjuntos, 'subpreguntas' => $subpreguntas);
    }

    public function destroy($id)
    {
        //
    }

    public function start($id)
    {

        $data = Guia::with('plantillas')->with('programasEducativos')->where( 'id' , $id)->first();
        // dd($data);
        return view('plantilla.start', [ 'data' => $data]);

    }
}
