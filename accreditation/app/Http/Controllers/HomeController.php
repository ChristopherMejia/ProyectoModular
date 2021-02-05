<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Plantilla;
use DB;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $plantillas=DB::table('plantillas as p')
            ->join('organismos as orgs','p.idOrganismo','=','orgs.id')
            ->select('p.id','orgs.nombre as organismo','p.version')
            ->orderBy('p.idOrganismo','desc')
            ->paginate(7);
        return view('home',["plantillas"=>$plantillas]);
    }
}
