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
        $plantillas=DB::table('plantillas as p')
            ->join('organismos as orgs','p.idOrganismo','=','orgs.id')
            ->select('p.id','orgs.nombre as organismo','p.version')
            ->orderBy('p.idOrganismo','desc')
            ->paginate(7);
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
        $plantilla->idOrganismo = $idOrganismo;
        $plantilla->version = $version;
        $plantilla->save();

        return \redirect()->back()->with('message', 'Successfully');
    }

    public function show($id)
    {
        return view('plantilla/show',
        [
            'Plantillas' => Plantilla::paginate(8)
        ]);
    }

    public function edit($id)
    {
        $plantilla=DB::table('plantillas as p')
            ->where('p.id','=',$id)
            ->join('organismos as org','p.idOrganismo','=','org.id')
            ->select('p.id','org.nombre as organismo','p.version')
            ->get();
        return view('plantilla.edit',["plantilla"=>$plantilla[0]]);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
