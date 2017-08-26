<?php

namespace App\Http\Controllers\Productos;

use App\Http\Controllers\Almacenes\Model\AlmacenesModel;
use App\Http\Controllers\Categorias\Model\CategoriasModel;
use App\Http\Controllers\Marcas\Model\MarcasModel;
use App\Http\Controllers\Productos\Model\ProductosModel;
use App\Http\Controllers\Proveedores\Model\ProveedoresModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rules\In;

class Productos extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = ProductosModel::all();
        $datos = compact('productos');
        return view('productos.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $almacen = AlmacenesModel::all();
        $proveedor = ProveedoresModel::all();
        $marca = MarcasModel::all();
        $categoria = CategoriasModel::all();
        $producto = [
            'almacen' => $almacen,
            'proveedor' => $proveedor,
            'marca' => $marca,
            'categoria' => $categoria
        ];
        $datos = compact('producto');
        return view('productos.create',$datos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newItem = new ProductosModel();
        $newItem->nombre = $request->get('producto');
        $newItem->barcode = $request->get('barcode');
        $newItem->precio_proveedor = $request->get('precio_proveedor');
        $newItem->precio_venta = $request->get('precio_venta');
        $newItem->aplicar_porcentaje = $request->get('aplicar_porcentaje');
        $newItem->estado = $request->get('estado');
        $newItem->stock= $request->get('stock');
        $newItem->id_almacen = $request->get('almacen');
        $newItem->id_proveedor = $request->get('proveedor');
        $newItem->id_marca = $request->get('marca');
        $newItem->id_categoria = $request->get('categoria');
        $newItem->save();
        return redirect()->route('productos.index');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
