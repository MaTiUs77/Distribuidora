@extends('layouts.adminlte')

@section('contenido')
    <div ng-controller="Terminal" ng-init="init({{ $venta->id }})" ng-cloak>
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
                    <label class="label label-danger">sin perfil</label>
                    @if(isset($venta->vendedor->perfil))
                        <address>
                            <strong>{{$venta->cliente->perfil->nombre}}</strong><br>
                            {{$venta->cliente->perfil->direccion}}<br>
                            Tel: {{$venta->cliente->perfil->telefono}}<br>
                            Email: {{$venta->cliente->perfil->email}}
                        </address>
                    @else
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
            {{--FORMULARIO PARA AGREGAR PRODUCTOS--}}

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
                        </tr>
                        {{--
                        @foreach($resumen->detalles as $detalle)
                            <tr>
                                <td>{{ $detalle->producto->nombre }}</td>
                                <td>{{ $detalle->producto->barcode}}</td>
                                <td>$ {{ $detalle->producto->precio_venta}}</td>
                                <td>{{ $detalle->cantidad }}</td>
                                <td id="total">$ {{ $detalle->costoTotal }}</td>
                                <td>{{ $detalle->producto->marca->nombre }}</td>
                                <td style="width: 100px;">
                                    <form method="POST" class="form" action="{{ route('venta_detalle.destroy',$detalle->id) }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="delete" />
                                        <button class="btn btn-default btn-sm" title="Eliminar Producto">
                                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                                        </button>
                                        <a class="btn btn-default btn-sm" id="qty" data-slider-value="{{$detalle->id}}" title="Modificar Cantidad" data-toggle="modal" data-target=".bd-example-modal-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                    </form>

                                </td>
                            </tr>
                        @endforeach
                        --}}
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>


            <div class="row">

                <div class="col-xs-6 pull-right" >
                    <p class="lead">Presupuesto</p>

                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>Productos:</th>
                                <td>
                                    @{{ facturacion.cantidadProductos }}
                                    {{-- $resumen->cantidadProductos --}}
                                </td>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td>
                                    {{-- $resumen->costoTotal --}}
                                    $ @{{ facturacion.costoTotal }}
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-xs-6 fa-pull-right">
                    <form role="form" enctype="multipart/form-data" method="post" action="{{ route('pendientes.update',$venta->id) }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PUT" />
                        <button class="btn btn-default btn-lg">Finalizar Venta</button>
                    </form>
                </div>
            </div>
        </section>

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


    <!-- Main Footer -->
    <footer class="main-footer navbar-fixed-bottom">
        <!-- To the right -->
        <div class="pull-right hidden-xs">
            Todos los derechos reservados.
        </div>
        <!-- Default to the left -->


        <table>
            <tr>
                <th colspan="8">
                    <form class="form-inline" role="form" method="post" action="{{ route('venta_detalle.store') }}">
                        <input class="form-control" type="text" placeholder="Codigo Angular" id="addByCodigoInput" ng-model="codigoProducto" my-enter="addByCodigo(codigoProducto)" >


                        <input type= "hidden" name="_token" value="{{ csrf_token() }}">

                        <input class="form-control" type="hidden" name="producto_id" id="producto_id">

                        <button class="btn btn-success"><i class="fa fa-plus"></i> Agregar</button>
                    </form>


                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                </th>
            </tr>
        </table>
    </footer>

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