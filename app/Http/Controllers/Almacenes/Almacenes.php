<?php

namespace App\Http\Controllers\Almacenes;

use App\Http\Controllers\Almacenes\Model\AlmacenesModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Almacenes extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //  $almacenes = AlmacenesModel::paginate(10);

        $datos = compact('almacenes');
        return view('almacenes.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('almacenes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newItem = new AlmacenesModel();
        $newItem->nombre = $request->get('nombre');
        $newItem->save();

        return $newItem;
//        return redirect()->route('almacenes.index');
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
        $almacen = AlmacenesModel::findOrFail($id);
        $dato = compact('almacen');
        return view('almacenes.edit', $dato);

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
        $almacen = AlmacenesModel::findOrFail($id);
        $almacen->nombre = $request->get('name');
        $almacen->save();
        return redirect()->route('almacenes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $almacen = AlmacenesModel::findOrFail($id);
        $almacen->delete();

        return $almacen;
  //      return redirect()->route('almacenes.index')->with('message', 'Almacen eliminado con exito!');
    }
}
