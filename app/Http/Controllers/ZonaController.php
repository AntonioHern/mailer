<?php

namespace App\Http\Controllers;

use App\Http\Requests\ZonaRequest;
use App\Models\Zona;
use Illuminate\Http\Request;

class ZonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zonas=Zona::all();
        return view('zonas.index',compact('zonas'));
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
    public function store(ZonaRequest $request)
    {
        $datosZona=request()->except('_token');
        $datosZona['nombre']=mb_strtoupper($datosZona['nombre']);
        $datosZona['created_user']=auth()->user()->id;
        $datosZona['created_at']=now();

        Zona::insert($datosZona);
        return back()->withStatus(__('Zona creada correctamente!'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Zona  $zona
     * @return \Illuminate\Http\Response
     */
    public function show(Zona $zona)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Zona  $zona
     * @return \Illuminate\Http\Response
     */
    public function edit(Zona $zona)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Zona  $zona
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $datosZona=request()->except(['_token','_method']);
        $datosZona['created_user']=auth()->user()->id;
        $datosZona['nombre']= mb_strtoupper($datosZona['nombre']);
        $datosZona['updated_at']=now();
        Zona::where('id','=',$request->id)->update($datosZona);
        return back()->withStatus(__('Zona actualizada correctamente!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Zona  $id
     */
    public function destroy($id)
    {
        Zona::destroy($id);
        return response()->json([

            'success' => 'Record deleted successfully!'

        ]);
    }

}
