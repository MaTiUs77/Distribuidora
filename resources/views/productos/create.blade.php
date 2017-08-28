@extends('layouts.adminlte')

@section('contenido')

    <div class="container">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Crear producto</h3>
            </div>
            <h4 class="box-body">
                <form role="form" method="post" action="{{ route('productos.store') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <!-- Basicos -->
                    <div class="col-sm-4">
                        <input class="form-control input-lg" type="text" name="barcode" required placeholder="Barcode">
                    </div>

                    <div class="col-sm-4">
                        <input class="form-control input-lg" type="text" name="producto" required placeholder="Nombre del producto">
                    </div>

                    <div class="col-sm-4">
                        <input class="form-control input-lg" type="text" name="stock" required placeholder="Stock">
                    </div>

                    <div class="clearfix"></div>
                    <hr>

                    <!-- Precios-->
                    <div class="col-sm-4">
                        <input class="form-control input-lg" type="text" name="precio_proveedor" required placeholder="Precio del proveedor">
                    </div>

                    <div class="col-sm-4">
                        <input class="form-control input-lg" type="text" name="precio_venta" required placeholder="Precio de venta">
                    </div>

                    <div class="col-sm-4">
                        <input class="form-control input-lg" type="text" name="aplicar_porcentaje" required placeholder="Porcentaje aplicado">
                    </div>

                    <div class="clearfix"></div>
                    <hr>

                    <!-- Selects -->
                    <div class="col-sm-6">
                        <select name="almacen" class="form-control input-lg">
                            <option value="">- Seleccionar un almacen -</option>
                            @foreach($almacenes as $almacen)
                                <option value="{{$almacen->id}}">{{$almacen->nombre}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-6">
                        <select name="proveedor" class="form-control input-lg">
                            <option value="">- Seleccionar un proveedor -</option>
                            @foreach($proveedores as $proveedor)
                                <option value="{{$proveedor->id}}">{{$proveedor->nombre}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="clearfix"></div>
                    <hr>

                    <h4>Opcional</h4>

                    <div class="col-sm-6">
                        <select name="marca" class="form-control input-lg">
                            <option value="">- Seleccionar una marca -</option>
                            @foreach($marcas as $marca)
                                <option value="{{$marca->id}}">{{$marca->nombre}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-sm-6">
                        <select name="categoria" class="form-control input-lg">
                            <option value="">- Seleccionar una categoria -</option>
                            @foreach($categorias as $categoria)
                                <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                            @endforeach
                        </select>
                    </div>

                    <input type="hidden" name="estado" value="inactivo">

                    <div class="clearfix"></div>
                    <br>
                    <br>


                    <div class="text-center">
                        <button class="btn btn-success"><i class="fa fa-plus"></i> Crear</button>
                    </div>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
@endsection