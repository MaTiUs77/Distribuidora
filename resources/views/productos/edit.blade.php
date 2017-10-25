@extends('layouts.adminlte')

@section('contenido')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Nuevo Producto</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">

                            <form role="form" method="post" enctype="multipart/form-data" action="{{ route('productos.update',$producto->id) }}" >
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="PUT" />
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <div class="thumbnail">
                                            <output id="list" style="text-align: center">
                                                <img id="blah" alt=""  src="{{ asset("upload/".$producto->imagen) }}">
                                            </output>
                                            <div class="caption">
                                                <div class="text-center">
                                                  <span class="btn btn-default btn-file">
                                                    Seleccionar imagen <input type='file' id="files" name="imagen" onchange="readURL(this);"/>
                                                  </span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- /.col -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nombre o Descripcion</label>
                                        <input class="form-control input-xs" type="text" name="nombre" placeholder="Nombre o Descripcion" required value="{{$producto->nombre}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Codigo de Barras</label>
                                        <input class="form-control input-xs" type="text" name="codigo_de_barras" required placeholder="Codigo de barras" value="{{$producto->barcode}}">
                                    </div>
                                    <div class="form-group">
                                        <label>Codigo Interno</label>
                                        <input class="form-control input-xs" type="text" name="codigo_interno" required placeholder="Codigo interno" value="{{$producto->codigo_interno}}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Stock</label>
                                        <input class="form-control input-xs" type="text" name="stock" required placeholder="Stock" value="{{$producto->stock}}">
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label>Stock Minimo</label>
                                        <input class="form-control input-xs" type="text" name="stock_minimo" required placeholder="Stock Minimo" value="{{$producto->stock_minimo}}">
                                    </div>
                                    <!-- /.form-group -->
                                    <div class="form-group">
                                        <label>Estado</label>
                                        <select name="estado"  class="form-control input-xs" >
                                            <option value="activo">Activo</option>
                                            <option value="inactivo">Inactivo</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /.col -->
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label>Precio Proveedor</label>
                                    <input class="form-control input-xs" type="text" name="precio_proveedor" required placeholder="Precio Proveedor" value="{{$producto->precio_proveedor}}">
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label>Aplicar Procentaje %</label>
                                    <input class="form-control input-xs" type="text" name="aplicar_porcentaje" required placeholder="Aplicar Porcentaje" value="{{$producto->aplicar_porcentaje}}">
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label>Precio Venta</label>
                                    <input class="form-control input-xs" type="text" name="precio_venta" required placeholder="Precio" value="{{$producto->precio_venta}}">
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-success">Actualizar Producto</button>
                        </div>
                        <hr>
                        <h3>OPCIONAL</h3>
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label>Marca</label>
                                    <select name="marca" class="form-control input-xs">
                                        <option value="">- Seleccionar una marca -</option>
                                        @foreach($marcas as $marca)
                                            <option value="{{$marca->id}}" {{ ($marca->id == $producto->id_marca) ? 'selected=selected' :'' }}>{{$marca->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Categoria</label>
                                    <select name="categoria" class="form-control input-xs">
                                        <option value="">- Seleccionar una categoria -</option>
                                        @foreach($categorias as $categoria)
                                            <option value="{{$categoria->id}}" {{ ($categoria->id == $producto->id_categoria) ? 'selected=selected' :'' }}>{{$categoria->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label>Proveedor</label>
                                    <select name="proveedor" class="form-control input-xs">
                                        <option value="">- Seleccionar un proveedor -</option>
                                        @foreach($proveedores as $proveedor)
                                            <option value="{{$proveedor->id}}" {{ ($proveedor->id == $producto->id_proveedor) ? 'selected=selected' :'' }}>{{$proveedor->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Almacen</label>
                                    <select name="almacen" class="form-control input-xs">
                                        <option value="">- Seleccionar un almacen -</option>
                                        @foreach($almacenes as $almacen)
                                            <option value="{{$almacen->id}}" {{ ($almacen->id == $producto->id_almacen) ? 'selected=selected' :'' }}>{{$almacen->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <label>Nota</label>
                                    <input class="form-control input-xs" type="text" name="descripcion" placeholder="Escribe alguna nota" value="{{$producto->descripcion}}">
                                </div>
                            </div>
                            </form>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
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
  <script>
  function readURL(input) {
       if (input.files && input.files[0]) {
           var reader = new FileReader();

           reader.onload = function (e) {
               $('#blah')
                   .attr('src', e.target.result)
                   .width(150)
                   .height(200);
           };

           reader.readAsDataURL(input.files[0]);
       }
   }
  </script>
@endsection
