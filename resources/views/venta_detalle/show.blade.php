@extends('layouts.adminlte')
@section('sidebar','sidebar-mini sidebar-collapse')

@push('ng-body')
    ng-controller="Terminal" ng-init="init({{ $venta->id }},'{{ env('IP_ACCESSO_REMOTO') }}:8080')" ng-keydown='functionKey($event)'
@endpush

@section('contenido')
    <div class="row">
        <!-- Detalle de venta -->
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

        <!-- Panel de operacion -->
        <div class="col-sm-4">
            <div class="box box-solid">
                <div class="box-body">
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

                    <div class="row">
                        <div class="col-sm-9">
                            <label for="codigoProducto">Producto:</label>
                            <input class="form-control input-lg" type="text" placeholder="Nombre o Codigo del Producto" id="codigoProducto" ng-model="codigoProducto" my-enter="addProducto()" >
                        </div>
                        <div class="col-sm-3">
                            <label for="cantidadProducto">Cantidad:</label>
                            <input class="form-control input-lg" type="text" placeholder="Cantidad" ng-model="cantidadProducto" ng-init="cantidadProducto = 1" my-enter="addProducto()" >
                        </div>
                    </div>

                    <hr>

                    <div class="text-right">
                        <a href="javascript:;"  data-toggle="modal" data-target="#modalCobro" class="btn btn-success">F2 - Cobrar</a>
                    </div>
                </div>
                <!-- /.box-body -->
            </div>
       </div>
    </div>

    <div id="modalCobro" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title">Cobro</h5>
                </div>
                <div class="modal-body">
                    <!-- Calculo de cambio -->
                    <div class="callout" ng-class="{ 'callout-info': (cambioCalculado == 0) , 'callout-success': (cambioCalculado > 0) , 'callout-danger': (cambioCalculado < 0)}">
                        <div class="row">
                            <div class="col-sm-6">
                                <p>
                                    Monto recibido
                                </p>
                                <input class="form-control" type="text" placeholder="Recibido" id="montoRecibido" ng-model="montoRecibido" my-enter="calcularCambio()" >

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
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <!-- Socket.io-->
    <script src="http://{{ env('IP_ACCESSO_REMOTO') }}:8080/socket.io/socket.io.js"></script>
    <!-- Terminal -->
    <script src="{{ asset('js/terminal.js') }}"></script>

    <script >

        $(function() {
            $("#codigoProducto").autocomplete({
                source: "{{ url('api/autocomplete/productos') }}",
                minLength: 2,
                select: function (event, ui) {
                    $('#codigoProducto').val(ui.item.name);
                }
            });

            $('#modalCobro').on('shown.bs.modal', function () {
                $('#montoRecibido').focus();
            });
        });
    </script>
@endsection