@extends('layouts.adminlte')

@section('contenido')
    <div class="container">
        <form role="form" method="post" action="{{ route('productos.store') }}">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Crear producto</h3>
                </div>
                <div class="box-body">
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


                    <input type="hidden" name="estado" value="inactivo">

                    <div class="clearfix"></div>

                    <div class="text-center">
                        <button class="btn btn-success">Dar de alta el producto</button>
                    </div>
                </div>
            </div>

            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">Opcional</h3>
                </div>
                <div class="box-body">
                    <div class="col-sm-12">
                        <textarea class="form-control input-lg" name="descripcion" placeholder="Descripcion del producto"></textarea>
                    </div>

                    <div class="clearfix"></div>
                    <hr>

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
                </div>
            </div>
        </form>
    </div>
@endsection

@section('footer')
    <script>

        /*
            Version BETA
            Es necesario optimizar en caso de que no se encuentre definitos todos los valores
        */

        $(function() {
            var precio_proveedor = $("input[name='precio_proveedor']");
            var precio_venta = $("input[name='precio_venta']");
            var precio_aplicado = $("input[name='aplicar_porcentaje']");

            precio_proveedor.keyup(function() {
                var precio_proveedor_val = Number($( this ).val());
                var aplicar_porcentaje_val = Number(precio_aplicado.val());

                var calcular_precio_venta =   (precio_proveedor_val  * aplicar_porcentaje_val / 100) + precio_proveedor_val ;
                precio_venta.val(calcular_precio_venta);
            });

            precio_venta.keyup(function() {
                var precio_proveedor_val = Number(precio_proveedor.val());
                var precio_venta_val = Number($( this ).val());

                var calcular_porcentaje =   ((precio_venta_val - precio_proveedor_val )) / precio_proveedor_val *  100;
                precio_aplicado.val(calcular_porcentaje);
            });

            precio_aplicado.keyup(function() {
                var precio_proveedor_val = Number(precio_proveedor.val());
                var aplicar_porcentaje_val = Number($( this ).val());

                var calcular_precio_venta =   (precio_proveedor_val  * aplicar_porcentaje_val / 100) + precio_proveedor_val ;
                precio_venta.val(calcular_precio_venta);
            });
        });
    </script>
@endsection
