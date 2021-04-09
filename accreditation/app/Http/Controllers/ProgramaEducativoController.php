<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PlantillaController;

class ProgramaEducativoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('NivelEducacion.create_level');
    }
}
