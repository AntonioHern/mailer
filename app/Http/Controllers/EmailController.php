<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $email=new Email();
        $email->enviador_id= auth()->user()->id;
        $email->zona_id=$request->zona_id;
        $email->nombre_archivo=$request->nombrearchivo;
        $email->asunto=$request->asunto;
        $email->cuerpo=$request->cuerpo;
        $email->created_at=now();
        $email->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function show(Email $email)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function edit(Email $email)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Email $email)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Email  $email
     * @return \Illuminate\Http\Response
     */
    public function destroy(Email $email)
    {
        //
    }

    public function enviarEmail(Request $request)
    {
        //dd($request->all());
        $this->store($request);
        $nombre = explode("#", $request->nombrearchivo);
        $nombrearchivo = $nombre[1];
        $zona = request()->input('zona_id');
        $clientes = Cliente::where('zona_id', $zona)->get();
        $path= storage_path('app/public/'.$request->nombrearchivo);

       foreach ($clientes as $cliente) {
           //el array de variables que se pasan a la vista del email
           $array['cuerpo'] = $request->cuerpo;
           $array['asunto'] = $request->asunto;
           $tipo_email = $request->tipo_email[0];
           Mail::send($tipo_email, $array, function ($mensaje) use ($request, $cliente, $path,$nombrearchivo) {
               $mensaje->subject($request->asunto);
               $mensaje->to($cliente->email, $cliente->nombre);
               $mensaje->attach($path, [
                   'as' => $nombrearchivo,
                   'mime' => 'application/pdf',
               ]);
           });
        }
        return back()->withStatus(__('Campaña enviada correctamente!'));
    }

}
