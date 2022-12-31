<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteRequest;
use App\Models\Cliente;
use App\Models\Zona;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes=Cliente::all();
        $zonas=Zona::all();
        return view('clientes.index',compact('clientes','zonas'));
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
    public function store(ClienteRequest $request)
    {
        $cliente= new Cliente();
        $cliente->nombre = $request->get('nombre');
        $cliente->email= $request->get('email');
        if($request->get('codpostal')==null){
            $cliente->codpostal = '00000';
        }else{
            $cliente->codpostal = $request->get('codpostal');
        }
        $cliente->zona_id= $request->get('zona_id');
        $cliente->created_user= auth()->user()->id;
        $cliente->created_at= now();
        $cliente->save();
        return back()->withStatus(__('Cliente añadido correctamente!'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $datosCliente=request()->except(['_token','_method']);
        $datosCliente['created_user']=auth()->user()->id;
        $datosCliente['updated_at']=now();
        Cliente::where('id','=',$request->id)->update($datosCliente);
        return back()->withStatus(__('Cliente actualizado correctamente!'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cliente::destroy($id);
        return response()->json([

            'success' => 'Record deleted successfully!'

        ]);
    }
}
