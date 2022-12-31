<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\Email;
use App\Models\Zona;

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
     * @return \Illuminate\View\View
     */
    public function index()
    {
       $documentos = Documento::all()->sortByDesc('created_at');
       $zonas = Zona::all();
       $envios = Email::all()->sortByDesc('created_at');
        return view('dashboard',['documentos' => $documentos, 'zonas' => $zonas, 'envios' => $envios]);
    }

}
