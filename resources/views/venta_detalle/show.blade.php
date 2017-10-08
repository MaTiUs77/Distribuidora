@extends('layouts.adminlte')
@section('sidebar','sidebar-mini sidebar-collapse')

@section('contenido')
    <div ng-controller="Terminal" ng-init="init({{ $venta->id }})" ng-cloak>

        <div class="row">
            <div class="col-xs-8">
                <section class="invoice">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <i class="fa fa-globe"></i> Distribuidora
                                <small class="pull-right">Date: 2/10/2014</small>
                            </h2>
                        </div>
                        <!-- /.col -->
                    </div>

                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            Vendedor
                            @if(isset($venta->vendedor->perfil))
                                <address>
                                    <strong>{{$venta->vendedor->perfil->nombre}}</strong><br>
                                    {{$venta->vendedor->perfil->direccion}}<br>
                                    Tel: {{$venta->vendedor->perfil->telefono}}<br>
                                    Email: {{$venta->vendedor->perfil->email}}
                                </address>
                            @else
                                <label class="label label-danger">sin perfil</label>
                                <address>
                                    <strong>{{$venta->vendedor->name}}</strong><br>
                                    Email: {{$venta->vendedor->email}}
                                </address>
                            @endif
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            Cliente

                            @if(isset($venta->cliente->perfil))
                                <address>
                                    <strong>{{$venta->cliente->perfil->nombre}}</strong><br>
                                    {{$venta->cliente->perfil->direccion}}<br>
                                    Tel: {{$venta->cliente->perfil->telefono}}<br>
                                    Email: {{$venta->cliente->perfil->email}}
                                </address>
                            @else
                                <label class="label label-danger">sin perfil</label>
                                <address>
                                    <strong>{{$venta->cliente->name}}</strong><br>
                                    Email: {{$venta->cliente->email}}
                                </address>
                            @endif
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-4 invoice-col">
                            <b>Venta N° {{$venta->id}}</b><br>
                            <br>
                            <b>Creada:</b> {{$venta->created_at}} <br>
                            <b>Entrega:</b> {{$venta->fecha_entrega}} <br>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Tabla de datos completada por Redis -->
                    <div class="row">
                        <div class="col-xs-12 table-responsive">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Codigo</th>
                                    <th>Precio</th>
                                    <th>Cantidad</th>
                                    <th>Total</th>
                                    <th>Marca</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr ng-repeat="detalle in facturacion.detalles">
                                    <td>@{{ detalle.producto.nombre }}</td>
                                    <td>@{{ detalle.producto.barcode}}</td>
                                    <td>$ @{{ detalle.producto.precio_venta}}</td>
                                    <td>@{{ detalle.cantidad }}</td>
                                    <td id="total">$ @{{ detalle.costoTotal }}</td>
                                    <td>@{{ detalle.producto.marca.nombre }}</td>
                                    <td>
                                        <button ng-click="removeDetalleId(detalle.id)" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            </div>
            <div class="col-sm-4">

                <div class="box box-solid">
                    <div class="box-body">

                        <input class="form-control input-lg" type="text" placeholder="Ingrese el Nombre o Codigo del Producto" id="addByCodigoInput" ng-model="codigoProducto" my-enter-blank="true" my-enter="addByCodigo(codigoProducto)" >

                        <br>

                        <div class="callout callout-info">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p>
                                        Total
                                    </p>
                                    <h2 style="padding:0px;margin:0px;">
                                        $ @{{ facturacion.costoTotal }}
                                    </h2>

                                </div>
                                <div class="col-sm-6">
                                    <p>
                                        Productos
                                    </p>
                                    <h2 style="padding:0px;margin:0px;">
                                        @{{ facturacion.cantidadProductos }}
                                    </h2>

                                </div>
                            </div>
                        </div>

                        <!-- Calculo de cambio -->
                        <div class="callout" ng-class="{ 'callout-info': (cambioCalculado == 0) , 'callout-success': (cambioCalculado > 0) , 'callout-danger': (cambioCalculado < 0)}">
                            <div class="row">
                                <div class="col-sm-6">
                                    <p>
                                        Monto recibido
                                    </p>
                                    <input class="form-control" type="text" placeholder="Recibido" ng-model="montoRecibido" my-enter="calcularCambio()" >

                                </div>

                                <div class="col-sm-6">
                                    <p ng-hide="cambioInsuficiente()">
                                        Cambio
                                    </p>
                                    <p ng-show="cambioInsuficiente()">
                                        Faltan
                                    </p>
                                    <h2 style="padding:0px;margin:0px;">
                                        $ @{{ cambioCalculado  }}
                                    </h2>

                                </div>
                            </div>
                        </div>

                        <!-- Campos desplegables -->
                        <div class="row">
                            <div class="col-sm-6">
                                <p>
                                    Comprobante
                                </p>

                                <select class="form-control">
                                    <option>Cliente final</option>
                                    <option>Ticket</option>
                                    <option>Factura Electronica</option>
                                    <option>Factura C</option>
                                    <option>Nota de credito C</option>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <p>
                                    Tipo de pago
                                </p>

                                <select class="form-control">
                                    <option>Contado</option>
                                    <option>Tarjeta de credito</option>
                                </select>
                            </div>
                        </div>

                        <br>

                        @if($venta->origen =='TERMINAL')
                            <a href="{{ route('pendientes.finish',[$venta->id,'TERMINAL']) }}" class="btn btn-success btn-block">F6 - Finalizar Venta</a>
                        @else
                            <a href="{{ route('pendientes.finish',$venta->id) }}" class="btn btn-success btn-block">F6 - Finalizar Venta</a>
                        @endif
                    </div>
                    <!-- /.box-body -->
                </div>
           </div>

        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


    <!-- Tabla de datos completada por Redis -->
        <br>
        <br>
        <br>

        <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title" id="exampleModalLabel">Modificar Cantidad</h5>
                    </div>
                    <form class="form-horizontal" role="form" method="post" action="{{ route('venta_detalle.update',$venta->id) }}">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PUT" />

                    <div class="modal-body">
                        <input type="number" class="form-control input-lg" min="1" name="cantidad" id="cantidad" required>
                        <input type="hidden" id="venta_detalle_id" class="form-control input-lg" min="1" name="venta_detalle_id">
                    </div>
                    <div class="modal-footer">
                        <p>Pulse Enter para Guardar</p>
                        {{--<button type="button" class="btn btn-primary">Guardar</button>--}}
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer')

    <script >

        $(function() {
            $("#producto").autocomplete({
                source: "{{ url('ventas/search/autocomplete/producto') }}",
                minLength: 2,
                select: function (event, ui) {
                    $('#producto').val(ui.item.name);
                    $('#producto_id').val(ui.item.id);
                }
            });
        });

    </script>

    <script>
        $(function(){

            $(document).on("click", "#qty", function (e) {

                e.preventDefault();
                var _self = $(this);

                var myBookId = _self.data('sliderValue');

                $("#venta_detalle_id").val(myBookId);
                $(_self.attr('href')).modal('show');
            });

        });
    </script>
@endsection