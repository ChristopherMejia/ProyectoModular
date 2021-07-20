<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlantillaRequest;
use Illuminate\Http\Request;
use App\Plantilla;
use App\Organismo;
use App\Categoria;
use App\Subcategoria;
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
        $i=0;
        foreach($categorias as $categoria){
            $subcategorias[$i] = DB::table('subcategorias')->where('idCategoria','=', $categoria->id)->get();
            $i++;
        }

        $nombre  = $plantilla->organismo->nombre;
        $version = $plantilla->version;
        $id      = $plantilla->id;
        $plantilla_info = array(
            'plantilla_id'      => $id,
            'plantilla_nombre'  => $nombre,
            'plantilla_version' => $version,
        );
        //return array('plantilla' => $plantilla_info, 'categorias' => $categorias, 'subcategorias' => $subcategorias);
        return view('plantilla.edit',['plantilla' => $plantilla_info, 'categorias' => $categorias, 'subcategorias' => $subcategorias]);
    }

    public function update(Request $request, $id)
    {
        $plantilla = Plantilla::find($id);

        $categorias = $request->get('categorias');
        $id_categorias = $request->get('id_categorias');

        $subcategorias = $request->get('subcategorias');
        $id_subcategorias = $request->get('id_subcategorias');

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
            $j=0;
            while($j < count($subcategorias[$i])){
                if($id_subcategorias[$i][$j] != null){ //si ya existe la subcategoria, la actualiza
                    $subcategoriasUpdate = DB::table('subcategorias')
                    ->where('id', $id_subcategorias[$i][$j])
                    ->update(['descripcion' => $subcategorias[$i][$j]]);
                } 
                else{ //si no existe la subcategoria, crea una nueva
                    $subcategoria = new Subcategoria();
                    $subcategoria->idCategoria = $categoria->id;
                    $subcategoria->descripcion = $subcategorias[$i][$j];
                    $subcategoria->save();
                }
                $j=$j+1;
            }
            $i=$i+1;
        }
        return array('ids' => $id_categorias, 'categorias' => $categorias, 'ids_subcategorias' => $id_subcategorias, 'subcategorias' =>$subcategorias);
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
