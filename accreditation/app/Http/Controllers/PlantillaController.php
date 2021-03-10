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
        return view('plantilla',["plantillas"=>$plantillas]);
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
        //dd($request->all());
        $plantilla = new Plantilla;
        $plantilla->organismo_id = $request->input('idOrganismo');
        $plantilla->version = $request->input('version');
        $plantilla->save();

        return \redirect()->back()->with('message', 'Successfully');
    }

    public function show()
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
}
