<?php

namespace App\Http\Controllers\Marcas;

use App\Http\Controllers\Marcas\Model\MarcasModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Marcas extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marcas = MarcasModel::paginate(10);

        $datos = compact('marcas');
        return view('marcas.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('marcas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newItem = new MarcasModel();
        $newItem->nombre = $request->get('name');
        $newItem->save();
        return redirect()->route('marcas.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $marca = MarcasModel::findOrFail($id);
        $dato = compact('marca');
        return view('marcas.edit', $dato);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $marcas = MarcasModel::findOrFail($id);
        $marcas->nombre = $request->get('name');
        $marcas->save();
        return redirect()->route('marcas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $marcas = MarcasModel::findOrFail($id);
        $marcas->delete();
        return redirect()->route('marcas.index')->with('message', 'Marca eliminada con exito!');
    }
}
