<?php

namespace App\Http\Controllers\Productos;

use App\Http\Controllers\Almacenes\Model\AlmacenesModel;
use App\Http\Controllers\Categorias\Model\CategoriasModel;
use App\Http\Controllers\Marcas\Model\MarcasModel;
use App\Http\Controllers\Productos\Model\ProductosModel;
use App\Http\Controllers\Proveedores\Model\ProveedoresModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Productos extends Controller
{
    /**
     * Si no se encuentra autenticado solamente ve el index!
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['role:admin|vendedor'])->except('index');
    }

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
        $almacenes = AlmacenesModel::all();
        $proveedores = ProveedoresModel::all();
        $marcas = MarcasModel::all();
        $categorias = CategoriasModel::all();

        $datos = compact('almacenes','proveedores','marcas','categorias');
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
        $newItem->descripcion = $request->get('descripcion');
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
        $producto = ProductosModel::findOrFail($id);

        $almacenes = AlmacenesModel::all();
        $proveedores = ProveedoresModel::all();
        $marcas = MarcasModel::all();
        $categorias = CategoriasModel::all();

        $datos = compact('producto','almacenes','proveedores','marcas','categorias');
        return view('productos.edit', $datos);
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
         $producto = ProductosModel::findOrFail($id);
         $producto ->nombre = $request->get('producto');
         $producto ->barcode = $request->get('barcode');
         $producto ->descripcion = $request->get('descripcion');
         $producto ->precio_proveedor = $request->get('precio_proveedor');
         $producto ->precio_venta = $request->get('precio_venta');
         $producto ->aplicar_porcentaje = $request->get('aplicar_porcentaje');
         $producto ->estado = $request->get('estado');
         $producto ->stock= $request->get('stock');
         $producto ->id_almacen = $request->get('almacen');
         $producto ->id_proveedor = $request->get('proveedor');
         $producto ->id_marca = $request->get('marca');
         $producto ->id_categoria = $request->get('categoria');

         if ($request->hasFile('imagen')) {
             $image = $request->file('imagen');
             $imagenName = time().'.'.$image->guessClientExtension();
             $destinationPath = public_path('upload');
             $image->move($destinationPath, $imagenName);

//            $image->store('productos');

              $producto->imagen  = $imagenName;

         }

         $producto ->save();

        return redirect()->route('productos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = ProductosModel::findOrFail($id);
        $producto->delete();
        return redirect()->route('productos.index')->with('message', 'Producto eliminado con exito!');
    }
}
