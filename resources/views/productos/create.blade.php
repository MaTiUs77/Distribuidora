@extends('layouts.adminlte')

@section('contenido')

    <div class="container-fluid">
        <form role="form" method="post" enctype="multipart/form-data" action="{{ route('productos.store') }}" >
            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="row">
                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Nuevo Producto</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="form-group">
                                    <div class="thumbnail">
                                        <output id="list" style="text-align: center"></output>
                                        <div class="caption">
                                            <div class="text-center">
                                              <span class="btn btn-default btn-file">
                                                Seleccionar imagen <input type='file' id="files" name="imagen"/>
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
                                    <input class="form-control input-xs" type="text" name="nombre" placeholder="Nombre o Descripcion" required>
                                </div>
                                <div class="form-group">
                                    <label>Codigo de Barras</label>
                                    <input class="form-control input-xs" type="text" name="codigo_de_barras" required placeholder="Codigo de barras">
                                </div>
                                <div class="form-group">
                                    <label>Codigo Interno</label>
                                    <input class="form-control input-xs" type="text" name="codigo_interno" required placeholder="Codigo interno">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Stock</label>
                                    <input class="form-control input-xs" type="text" name="stock" required placeholder="Stock">
                                </div>
                                <!-- /.form-group -->
                                <div class="form-group">
                                    <label>Stock Minimo</label>
                                    <input class="form-control input-xs" type="text" name="stock_minimo" required placeholder="Stock Minimo">
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
                                    <input class="form-control input-xs" type="text" name="precio_proveedor" required placeholder="Precio Proveedor">
                                </div>
                            </div>
                            <div class="col-xs-4">
                            <div class="form-group">
                                    <label>Aplicar Procentaje %</label>
                                    <input class="form-control input-xs" type="text" name="aplicar_porcentaje" required placeholder="Aplicar Porcentaje">
                                </div>
                                </div>
                            <div class="col-xs-4">
                            <div class="form-group">
                                    <label>Precio Venta</label>
                                    <input class="form-control input-xs" type="text" name="precio_venta" required placeholder="Precio">
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-success">Dar de alta el producto</button>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <div class="box box-default">
                    <div class="box-header with-border">
                        <h3 class="box-title">Datos opcionales</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>Marca</label>
                                    <select name="marca" class="select2 form-control">
                                        @foreach($marcas as $marca)
                                            <option value="{{$marca->id}}">{{$marca->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Categoria</label>
                                    <select name="categoria" class="select2 form-control">
                                        @foreach($categorias as $categoria)
                                            <option value="{{$categoria->id}}">{{$categoria->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label>Proveedor</label>
                                    <select name="proveedor" class="select2 form-control">
                                        @foreach($proveedores as $proveedor)
                                            <option value="{{$proveedor->id}}">{{$proveedor->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Almacen</label>
                                    <select name="almacen" class="select2 form-control">
                                        @foreach($almacenes as $almacen)
                                            <option value="{{$almacen->id}}">{{$almacen->nombre}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!-- Crear nota u observacion para el producto -->
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label>Nota</label>
                                    <textarea class="form-control"name="descripcion" placeholder="Escribe alguna nota"></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <!-- /.box -->
        </form>
    </div>


@endsection

@section('footer')
    <script>
        function archivo(evt) {
            var files = evt.target.files; // FileList object

            // Obtenemos la imagen del campo "file".
            for (var i = 0, f; f = files[i]; i++) {
                //Solo admitimos imágenes.
                if (!f.type.match('image.*')) {
                    continue;
                }

                var reader = new FileReader();

                reader.onload = (function(theFile) {
                    return function(e) {
                        // Insertamos la imagen
                        document.getElementById("list").innerHTML = ['<img class="img-thumbnail img-responsive" src="', e.target.result,'" title="', escape(theFile.name), '" style="width:200px; height:180px;"/>'].join('');
                    };
                })(f);

                reader.readAsDataURL(f);
            }
        }

        document.getElementById('files').addEventListener('change', archivo, false);
    </script>
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
        $(function() {
            $(".select2").select2({
                language: "es",
                tags: true
            });
        });
    </script>
@endsection
