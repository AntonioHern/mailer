<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;

class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //está en el homecontroller
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
        //guardar archivo en carpeta storage
        $file=$request->file('file');
        $archivo=$request->get('nombre-archivo');
        $filename = now().'#'.$file->getClientOriginalName();
        //se linkea la carpeta storage con php artisan storage:link para crear acceso directo en
        //directorio public
        $path=$file->storeAs('public',$filename);

        //insertar en base de datos
        $documento= new Documento();
        $documento->nombre=$filename;
        $documento->created_user=auth()->user()->id;
        $documento->descripcion='null';
        $documento->save();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function show(Documento $documento)
    {

        $path=storage_path('app/public/'.$documento->nombre);
        return response()->file($path,[
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$documento->nombre.'"'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function edit(Documento $documento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        //actualizar descripcion
        $documento=Documento::find($id);
        $documento->descripcion=request('descripcion');
        $documento->save();
        return response()->json(['success'=>'Documento actualizado correctamente']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Documento  $documento
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //eliminar archivo de carpeta storage
        $documento=Documento::find($id);
        $path=storage_path('app/public/'.$documento->nombre);
        unlink ($path);
       Documento::destroy($id);
        return response()->json([

            'success' => 'Record deleted successfully!'

        ]);

    }
}
