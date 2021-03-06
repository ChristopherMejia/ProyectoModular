<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plantilla;
use DB;

class AutoevaluacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $plantillas = DB::table('organismos')
                        ->join('plantillas', 'organismos.id', '=', 'plantillas.organismo_id')
                        ->select('organismos.nombre', 'plantillas.*')
                        ->paginate(5);
        
        return view('plantilla/show',compact('plantillas'));
    }
}
