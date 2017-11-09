<?php

namespace App\Http\Controllers\Productos;

use App\Http\Controllers\Almacenes\Model\AlmacenesModel;
use App\Http\Controllers\Categorias\Model\CategoriasModel;
use App\Http\Controllers\Marcas\Model\MarcasModel;
use App\Http\Controllers\Productos\Model\ProductosModel;
use App\Http\Controllers\Proveedores\Model\ProveedoresModel;
use App\User;
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
        $productos = ProductosModel::with([
            'almacen','proveedor','marca','categoria'
        ])->paginate(10);

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
        $proveedores = User::role('proveedor')->get();
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
        // Falta realizar todas las validaciones previo a guardar los datos

        $newItem = new ProductosModel();
        $newItem->nombre = $request->get('nombre');
        $newItem->barcode = $request->get('codigo_de_barras');
        $newItem->codigo_interno = $request->get('codigo_interno');
        $newItem->descripcion = $request->get('descripcion');
        $newItem->precio_proveedor = $request->get('precio_proveedor');
        $newItem->precio_venta = $request->get('precio_venta');
        $newItem->aplicar_porcentaje = $request->get('aplicar_porcentaje');
        $newItem->estado = $request->get('estado');
        $newItem->stock= $request->get('stock');

        $id_marca = $request->get('marca');
        $id_almacen = $request->get('almacen');
        $id_categoria = $request->get('categoria');

        // Proveedores necesita de mas datos para un alta dinamica
        $id_proveedor = $request->get('proveedor');

        // Si la marca no es numerica, crea una nueva
        if(!is_numeric($id_marca)) {
            $newMarca = MarcasModel::firstOrCreate(['nombre' => $id_marca]);
            $id_marca = $newMarca->id;
        }

        // Si la almacen no es numerica, crea una nueva
        if(!is_numeric($id_almacen)) {
            $newAlmacen = AlmacenesModel::firstOrCreate(['nombre' => $id_almacen]);
            $id_almacen = $newAlmacen->id;
        }

        // Si la categoria no es numerica, crea una nueva
        if(!is_numeric($id_categoria)) {
            $newCategoria = CategoriasModel::firstOrCreate(['nombre' => $id_categoria]);
            $id_categoria = $newCategoria->id;
        }

        $newItem->id_marca = $id_marca;
        $newItem->id_almacen = $id_almacen;
        $newItem->id_categoria = $id_categoria;

        // El proveedor seleccionado
        $newItem->id_proveedor = $id_proveedor;

        // Gestiona el upload de la imagen
        if($request->hasFile('imagen'))
        {
            $file = $request->file('imagen');

            $path = public_path().'/upload';
            $fileName = uniqid() . $file->getClientOriginalName();
            $file->move($path, $fileName);

            $newItem->imagen = $fileName;

        }
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
        $proveedores = User::role('proveedor')->get();

        $almacenes = AlmacenesModel::all();
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
         $producto ->nombre = $request->get('nombre');
         $producto ->barcode = $request->get('codigo_de_barras');
         $producto ->codigo_interno = $request->get('codigo_interno');
         $producto ->descripcion = $request->get('descripcion');
         $producto ->precio_proveedor = $request->get('precio_proveedor');
         $producto ->precio_venta = $request->get('precio_venta');
         $producto ->aplicar_porcentaje = $request->get('aplicar_porcentaje');
         $producto ->estado = $request->get('estado');
         $producto ->stock= $request->get('stock');
         $producto ->stock_minimo= $request->get('stock_minimo');
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
