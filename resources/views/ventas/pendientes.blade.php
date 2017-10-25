@extends('layouts.adminlte')

@section('contenido')
<style>
    table tbody, table thead{
        width: auto;
        table-layout: auto;
        font-size: 85%;
        text-align: left;
    }

    tr{
        text-align: left;
    }
    th{
        background-color: #4d5e6e;
        font-style: normal;
        color: white;
        width: 50px;
    }
</style>
    <div class="container-fluid">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">RESUMEN DE VENTAS</h3>
            </div>
            <div class="box-body">
                    <div class="row">
                        <div class="col-xs-2 fa-pull-right">
                                <a href="{{ url('ventas/terminal') }}" class="btn btn-success"><i class="fa fa-plus-square"></i> NUEVA VENTA</a>
                        </div>
                    </div>
                <hr>
                <!-- START CUSTOM TABS -->
                <div class="row">
                    <div class="col-md-12">
                        <!-- Custom Tabs -->
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_1" data-toggle="tab">Filtros</a></li>
                                <li><a href="#tab_2" data-toggle="tab">Importar</a></li>
                                <li><a href="#tab_3" data-toggle="tab">Exportar</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <div class="form-group">
                                                <label for="inputId">ID</label>
                                                <input id="inputId" type="text" class="form-control input-sm" placeholder="Buscar por ID">
                                            </div>
                                        </div>
                                        <div class="col-xs-3">
                                            <div class="form-group">
                                                <label for="inputCliente">Cliente</label>
                                                <input id="inputCliente" type="text" class="form-control input-sm" placeholder="Buscar por Cliente">
                                            </div>
                                        </div>
                                        <div class="col-xs-3">
                                            <div class="form-group">
                                                <label for="inputVendedor">Vendedor</label>
                                                <input id="inputVendedor" type="text" class="form-control input-sm" placeholder="Buscar por Vendedor">
                                            </div>
                                        </div>
                                        <div class="col-xs-3">
                                            <div class="form-group">
                                                <label for="inputOrigen">Origen</label>
                                                <input id="inputOrigen" type="text" class="form-control input-sm" placeholder="Buscar por Origen">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_2">
                                    <form action="{{ route('inventario.import') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}

                                        <span class="btn btn-default btn-file">
                                Seleccionar archivo Excel <input type='file'name="import_file"/>
                            </span>
                                        <input type="submit" class="btn btn-success" value="Iniciar importacion">
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_3">

                                    <a href="{{ route('inventario.download','pdf') }}" class="btn btn-default">Exportar PDF</a>
                                    <a href="{{ route('inventario.download','xls') }}" class="btn btn-default">Exportar XLS</a>
                                    <a href="{{ route('inventario.download','xlsx') }}" class="btn btn-default">Exportar XLSX</a>
                                    <a href="{{ route('inventario.download','csv') }}" class="btn btn-default">Exportar CSV</a>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <!-- nav-tabs-custom -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
                <!-- END CUSTOM TABS -->
                <hr>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-responsive">

                        <table class="table table-condensed table-bordered">
                    <tbody>
                    <tr>
                        <th>Estado</th>
                        <th>Cliente</th>
                        <th>Vendedor</th>
                        <th>Origen</th>
                        <th>Fecha Emision</th>
                        <th>Fecha Vencimiento</th>
                        <th>Total</th>
                        <th>Cobrado</th>
                        <th>A Cobrar</th>
                        <th>Sin Descuento</th>
                        <th>Con Descuento</th>
                        <th>Acciones</th>

                    </tr>


                    @foreach($resumen->ventas as $venta)
                        @switch($venta->estado)
                        @case('COBRADO')

                        <tr class="success" id="miTablaPersonalizada">
                        @break

                        @case("A COBRAR")
                        <tr class="warning" id="miTablaPersonalizada">

                        @break

                        @default
                        <tr class="danger" id="miTablaPersonalizada">

                        @endswitch

                            <td>{{ $venta->estado }}</td>
                            <td>{{ $venta->cliente->name }}</td>
                            <td>{{ $venta->vendedor->name }}</td>
                            <td>{{ $venta->origen}}</td>
                            <td>{{ $venta->fecha_emision}}</td>
                            <td>{{ $venta->fecha_vencimiento }}</td>
                            <td><b>$ {{ $venta->total_venta }}</b> </td>
                            <td><b>$ {{ $venta->cobrado }}</b></td>
                            <td><b>$ {{ $venta->a_cobrar }}</b></td>
                            <td><b>$ {{ $venta->subtotal_sin_descuento }}</b></td>
                            <td><b>$ {{ $venta->subtotal_con_descuento }}</b></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle btn-xs" type="button" data-toggle="dropdown">Acciones
                                        <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <form method="POST" action="{{ route('ventas.destroy',$venta->id) }}">
                                           <li><a class="btn btn-default btn-xs" href="{{route('ventas.edit',$venta->id)}}">
                                                <i class="fa fa-edit fa-lg"></i> Cliente</a></li>

                                            <li><a class="btn btn-default btn-xs" href="{{route('venta_detalle.show',$venta->id)}}">
                                                <i class="fa fa-cart-plus fa-lg"></i> Editar</a></li>

                                            {{ csrf_field() }}
                                            <input type="hidden" name="_method" value="delete" />
                                            <li><button class="btn btn-default btn-xs"><i class="fa fa-trash-o fa-lg"></i> Eliminar</button></li>
                                        </form>
                                    </ul>
                                </div>
                            </td>

                        </tr>
                    @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-right">
                                <b>Total</b> de Productos retenidos
                            </td>
                            <td>
                                {{ $resumen->cantidadProductos }}
                            </td>
                            <td>
                                <b>$ {{ $resumen->costoTotal }}</b>
                            </td>
                        </tr>
                    </tfoot>
                </table>
                        </div>
                    </div>
            <!-- /.box-body -->
                </div>
            </div>
        </div>
    </div>

    @if($resumen->ventas instanceof  \Illuminate\Pagination\LengthAwarePaginator)
        <div class="text-center">
            {{ $resumen->ventas->links() }}
        </div>
    @endif


@endsection
