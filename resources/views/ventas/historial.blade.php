@extends('layouts.adminlte')

@section('contenido')
    <div class="container">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Ventas Finalizadas</h3>
            </div>
            <div class="box-body">
                <table class="table table-bordered table-striped">
                    <tbody>
                    <tr>
                        <th>Fecha Creado</th>
                        <th>Cliente</th>
                        <th>Vendedor</th>
                        <th>Productos</th>
                        <th>Total</th>
                        <th>Acciones</th>
                    </tr>


                    @foreach($resumen->ventas as $venta)
                        <tr>

                            <td>{{ $venta->created_at }}</td>
                            <td>{{ $venta->cliente->name }}</td>
                            <td>{{ $venta->vendedor->name }}</td>
                            <td>{{ $venta->cantidad }}</td>
                            <td>$ {{ $venta->total }}</td>
                            <td>

                                    <a class="btn btn-default btn-sm" href="#">
                                        <i class="fa fa-edit fa-lg"></i>  </a>

                                    <a class="btn btn-default btn-sm" href="{{route('venta_detalle.historial',$venta->id)}}" title="Ver Detalle">
                                        <i class="fa fa-desktop fa-lg"></i>  </a>

                                    <button class="btn btn-default btn-sm"><i class="fa phpdebugbar-fa-file-pdf-o fa-lg"></i></button>

                            </td>

                        </tr>
                    @endforeach

                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-right">
                                <b>Total</b> de Productos vendidos
                            </td>
                            <td>
                                {{ $resumen->cantidadProductos }}
                            </td>
                            <td>
                              $  {{ $resumen->costoTotal }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>

@endsection
