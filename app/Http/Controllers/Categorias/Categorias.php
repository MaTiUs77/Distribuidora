<?php

namespace App\Http\Controllers\Categorias;

use App\Http\Controllers\Categorias\Model\CategoriasModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class Categorias extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $categorias = CategoriasModel::paginate(10);

        $datos = compact('categorias');
        return view('categorias.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newItem = new CategoriasModel();
        $newItem->nombre = $request->get('nombre');
        $newItem->save();

        return $newItem;

//        return redirect()->route('categorias.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoria = CategoriasModel::findOrFail($id);
        $dato = compact('categoria');
        return view('categorias.edit', $dato);
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
        $categoria = CategoriasModel::findOrFail($id);
        $categoria->nombre = $request->get('name');
        $categoria->save();
        return redirect()->route('categorias.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = CategoriasModel::findOrFail($id);
        $categoria->delete();

        return $categoria;

//        return redirect()->route('categorias.index')->with('message', 'Categoria eliminada con exito!');
    }
}
