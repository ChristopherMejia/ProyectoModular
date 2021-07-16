<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlantillaRequest;
use Illuminate\Http\Request;
use App\Plantilla;
use App\Organismo;
use App\Categoria;
use DB;

class PlantillaController extends Controller
{
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

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
        return view('plantilla.edit',['plantilla' => $plantilla_info, 'categorias' => $categorias]);
    }

    public function update(Request $request, $id)
    {
        $plantilla = Plantilla::find($id);

        $categorias = $request->get(key:'categorias');
        $id_categorias = $request->get(key:'id_categorias');

        $cont = 0;

        while($cont < count($categorias)){ //itera por cada categoria
            if($id_categorias[$cont] != null){ //si ya existe la categoria, la actualiza
                $categoriasUpdate = DB::table('categorias')
                ->where('id', $id_categorias[$cont])
                ->update(['descripcion' => $categorias[$cont]]);
            } 
            else{ //si no existe la categoria, crea una nueva
                $categoria = new Categoria();
                $categoria->idPlantilla = $plantilla->id;
                $categoria->descripcion = $categorias[$cont];
                $categoria->save();
            }
            $cont=$cont+1;
        }

        return array('ids' => $id_categorias, 'categorias' => $categorias);
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
