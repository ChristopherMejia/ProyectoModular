<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlantillaRequest;
use Illuminate\Http\Request;
use App\Plantilla;
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
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function start($id)
    {
        $plantilla=DB::table('plantillas as p')
            ->where('p.id','=',$id)
            ->join('organismos as org','p.idOrganismo','=','org.id')
            ->select('p.id','org.nombre as organismo','p.version')
            ->get();
        return view('plantilla.start',["plantilla"=>$plantilla[0]]);
    }
}
