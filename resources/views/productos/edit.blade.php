@extends('layouts.adminlte')

@section('contenido')

    <div class="container">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Editar producto</h3>
            </div>
            <h4 class="box-body">
                <form role="form" method="post" action="{{ route('productos.update',$producto->id) }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT" />

                    <!-- Basicos -->
                    <div class="col-sm-4">
                        <input class="form-control input-lg" type="text" name="barcode" required placeholder="Barcode" value="{{$producto->barcode}}">
                    </div>

                    <div class="col-sm-4">
                        <input class="form-control input-lg" type="text" name="producto" required placeholder="Nombre del producto"  value="{{$producto->nombre}}">
                    </div>

                    <div class="col-sm-4">
                        <input class="form-control input-lg" type="text" name="stock" required placeholder="Stock"  value="{{$producto->stock}}">
                    </div>

                    <div class="clearfix"></div>
                    <hr>

                    <!-- Precios-->
                    <div class="col-sm-4">
                        <input class="form-control input-lg" type="text" name="precio_proveedor" required placeholder="Precio del proveedor"  value="{{$producto->precio_proveedor}}">
                    </div>

                    <div class="col-sm-4">
                        <input class="form-control input-lg" type="text" name="precio_venta" required placeholder="Precio de venta"  value="{{$producto->precio_venta}}">
                    </div>

                    <div class="col-sm-4">
                        <input class="form-control input-lg" type="text" name="aplicar_porcentaje" required placeholder="Porcentaje aplicado"  value="{{$producto->aplicar_porcentaje}}">
                    </div>

                    <div class="clearfix"></div>
                    <hr>

                    <!-- Selects -->
                    <div class="col-sm-6">
                        <select name="almacen" class="form-control input-lg">
                            @foreach($almacenes as $almacen)
                                <option value="{{$almacen->id}}" {{ ($almacen->id == $producto->id_almacen) ? 'selected=selected' :'' }}>{{$almacen->nombre}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-6">
                        <select name="proveedor" class="form-control input-lg">
                            @foreach($proveedores as $proveedor)
                                <option value="{{$proveedor->id}}" {{ ($proveedor->id == $producto->id_proveedor) ? 'selected=selected' :'' }}>{{$proveedor->nombre}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="clearfix"></div>
                    <hr>

                    <h4>Opcional</h4>

                    <div class="col-sm-6">
                        <select name="marca" class="form-control input-lg">
                            @foreach($marcas as $marca)
                                <option value="{{$marca->id}}" {{ ($marca->id == $producto->id_marca) ? 'selected=selected' :'' }}>{{$marca->nombre}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-6">
                        <select name="categoria" class="form-control input-lg">
                            @foreach($categorias as $categoria)
                                <option value="{{$categoria->id}}" {{ ($categoria->id == $producto->id_marca) ? 'selected=selected' :'' }}>{{$categoria->nombre}}</option>
                            @endforeach
                        </select>
                    </div>

                    <input type="hidden" name="estado" value="inactivo">

                    <div class="clearfix"></div>
                    <br>
                    <br>


                    <div class="text-center">
                        <button class="btn btn-success"><i class="fa fa-edit"></i> Actualizar</button>
                    </div>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
@endsection