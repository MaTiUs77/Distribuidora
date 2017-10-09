@extends('layouts.adminlte')
@section('sidebar')
@section('contenido')
    <div ng-controller="Terminal" ng-init="init({{ $venta->id }})" ng-cloak>

        <div class="row">
            <div class="col-xs-12">
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
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-xs-6 pull-right">

                                    <h4>
                                        Productos :     @{{ facturacion.cantidadProductos }}
                                     </h4>

                                    <h4>
                                        Total:  $ @{{ facturacion.costoTotal }}
                                    </h4>
                                </div>

                           </div>
                            <div class="row">
                                <div class="col-xs-6 pull-request">
                                    <a href="#" class="btn btn-success btn-block">Imprimir Factura</a>
                                    </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </section>
            </div>




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