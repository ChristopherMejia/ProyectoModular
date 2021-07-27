<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlantillaRequest;
use Illuminate\Http\Request;
use App\Plantilla;
use App\Organismo;
use App\Categoria;
use App\Subcategoria;
use App\Pregunta;
use DB;

class PlantillaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $plantillas=DB::table('plantillas as plantilla')
            ->join('organismos as organismo','plantilla.organismo_id','=','organismo.id')
            ->select('plantilla.id','organismo.nombre','plantilla.version')
            ->orderBy('plantilla.organismo_id','desc')
            ->paginate(7);
        //dd($plantillas);
        return view('plantilla.index',["plantillas"=>$plantillas]);
    }

    public function create()
    {
        $organismos=DB::table('organismos as orgs')
            ->select('orgs.id','orgs.nombre')
            ->get();
        return view('plantilla.create',["organismos"=>$organismos]);
    }

    public function store(PlantillaRequest $request)
    {
        $idOrganismo = $request->input('idOrganismo');
        $version = $request->input('version');

        $plantilla = new Plantilla;
        $plantilla->organismo_id = $idOrganismo;
        $plantilla->version = $version;
        $plantilla->save();

        return \redirect()->back()->with('message', 'Successfully');
    }

    public function show($id)
    {
        //
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
                $preguntas[$i][$j] = DB::table('preguntas')->where('idSubcategoria','=', $subcategoria->id)->get();
                $j++;
            }
            $i++;
        }

        //return array('plantilla' => $plantilla_info, 'categorias' => $categorias, 'subcategorias' => $subcategorias, 'preguntas' => $preguntas);
        return view('plantilla.edit',['plantilla' => $plantilla_info, 'categorias' => $categorias ?? null, 
        'subcategorias' => $subcategorias ?? null, 'preguntas' => $preguntas ?? null]);
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
            if($subcategorias){//verifica que existan las categorias
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
                    if($preguntas[$i] ?? null){//verifica que existan las preguntas en la subcategoria
                        $k=0;
                        while($k < count($preguntas[$i][$j])){//itera por cada pregunta
                            if($id_preguntas[$i][$j][$k] != null){ //si ya existe la pregunta, la actualiza
                                $preguntasUpdate = DB::table('preguntas')
                                ->where('id', $id_preguntas[$i][$j][$k])
                                ->update(['descripcion' => $preguntas[$i][$j][$k],
                                'idTipo' => $tipos[$i][$j][$k],
                                'conEvidencia' => ($evidencias[$i][$j][$k] ? '1' : '0'),
                                'conAdjunto'   => ($adjuntos[$i][$j][$k] ? '1' : '0')]);

                                $pregunta = Pregunta::find($id_preguntas[$i][$j][$k]);
                            } 
                            else{ //si no existe la pregunta, crea una nueva
                                $pregunta = new Pregunta();
                                $pregunta->idSubcategoria = $subcategoria->id;
                                $pregunta->descripcion = $preguntas[$i][$j][$k];
                                $pregunta->idTipo = $tipos[$i][$j][$k];
                                $pregunta->conEvidencia = ($evidencias[$i][$j][$k] ? '1' : '0');
                                $pregunta->conAdjunto = ($adjuntos[$i][$j][$k] ? '1' : '0');
                                $pregunta->save();
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
        'subcategorias' =>$subcategorias,*/ 'ids_preguntas' => $id_preguntas, 'preguntas' => $preguntas, 'tipos' => $tipos, 'evidencias' => $evidencias, 'adjuntos' => $adjuntos);
    }

    public function destroy($id)
    {
        //
    }

    public function start($id)
    {
        $plantilla = Plantilla::find($id);
        $nombre  = $plantilla->organismo->nombre;
        $version = $plantilla->version;
        $plantilla_info = array(
            'plantilla_nombre'  => $nombre,
            'plantilla_version' => $version,
        );
        return view('plantilla.start')->with('plantilla', $plantilla_info);

    }
}
