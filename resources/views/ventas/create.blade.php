@extends('layouts.adminlte')

@section('contenido')

    <div class="container">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Ingresar producto</h3>
            </div>
            <div class="box-body">
                <div class="row">
                    <div class="col-sm-4">
                    <h3>FINCA SUR</h3>

                        <h2>de {{$venta->vendedor->name}}</h2>
                    </div>
                    {{--PANEL BODY--}}
                    <div class="col-sm-4">
                        <div class="panel panel-primary ">
                            <div class="panel-heading">DETALLE CLIENTE</div>
                            <div class="panel-body client-left-side">
                                <h4>N° DE FACTURA: <span class="text-blue">{{$venta->id}}</span></h4>
                                <h4>FECHA DE EMISION:<span class="text-blue"> {{$venta->created_at}} </span></h4>
                                <h4>FECHA DE ENTREGA:<span class="text-blue">  {{$venta->fecha_entrega}} </span></h4>
                                <h4>CLIENTE O RAZON SOCIAL:<span class="text-blue">  {{$venta->cliente->name}}</span></h4>
                                <h4>DIRECCION FISCAL: <span class="text-blue"> {{$venta->clientePerfil->direccion}}</span></h4>
                                <h4>ESTADO:<span class="text-blue"> {{$venta->estado}} </span> </h4>
                            </div>
                            <div class="panel-footer">
                                <h4>VENDEDOR:<span class="text-blue"> {{$venta->vendedor->name}} </span></h4>
                            </div>
                        </div>
                    </div>
                    {{--FIN PANEL BODY--}}
                    <div class="col-sm-4"> </div>


                </div>
                <div class="row">

                    {{--FORMULARIO PARA AGREGAR PRODUCTOS--}}

                    <form role="form" method="post" action="{{ route('venta_detalle.store') }}">

                        <div class="col-sm-4">

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="text-center">
                                <input class="form-control input-lg" type="text" name="producto" id="producto"  required placeholder="Ingrese producto">
                                <input class="form-control input-lg" type="hidden" name="venta_id" id="venta_id" value="{{$venta->id}}">
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <input class="form-control input-lg" type="number" name="cantidad" id="cantidad"  required placeholder="Cantidad">
                            <input class="form-control input-lg" type="hidden" name="product_id" id="product_id">
                        </div>
                        <div class="col-sm-4">
                            <button class="btn btn-success"><i class="fa fa-plus"></i> Agregar</button>
                        </div>

                    </form>
                    {{--FIN FORMULARIO--}}

                </div>
                <div class="row">
                    <br>

                    <div class="col-sm-10">
                        <table class="table table-striped">
                            <tbody>
                            <tr>
                                <th style="width: 10px">Id_venta_detalle</th>
                                <th>ID_venta</th>
                                <th>Nombre Producto</th>
                                <th>Codigo Producto</th>
                                <th>Precio Producto</th>
                                <th>Cantidad</th>
                                <th>Total</th>
                                <th>Marca</th>
                                <th>Acciones</th>
                            </tr>
                            @foreach($venta_detalle as $item)

                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->venta_id }}</td>
                                    <td>{{ $item->productos->nombre }}</td>
                                    <td>{{ $item->productos->barcode}}</td>
                                    <td>$ {{ $item->productos->precio_venta}}</td>
                                    <td>{{ $item->cantidad }}</td>
                                    <td id="total">$ {{ $item->productos->precio_venta * $item->cantidad}}</td>
                                    <td>{{ $item->productos->marca->nombre }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('venta_detalle.destroy',$item->id) }}">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="delete" />
                                            <button class="btn btn-danger" title="Eliminar Producto"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                        </form>
                                        <a class="btn btn-success" id="qty" data-slider-value="{{$item->id}}" title="Modificar Cantidad" data-toggle="modal" data-target=".bd-example-modal-sm">
                                            <i class="fa fa-bars"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <th>Total</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th id="total2">$</th>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


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
                source: "http://distribuidora.com/ventas/search/autocomplete/producto",
                minLength: 2,
                select: function (event, ui) {
                    $('#producto').val(ui.item.name);
                    $('#product_id').val(ui.item.id);
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