@extends('layouts.adminlte')

@section('contenido')

    <div class="container">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Ventas Pendientes</h3>
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

                    @foreach($pendientes as $resumen)
                    <tr>

                        <td>{{ $resumen->venta->created_at }}</td>
                        <td>{{ $resumen->venta->cliente->name }}</td>
                        <td>{{ $resumen->venta->vendedor->name }}</td>
                        <td>{{ $resumen->venta->cantidad }}</td>
                        <td>{{ $resumen->venta->total }}</td>
                        <td>
                            <form method="POST" action="{{ route('ventas.destroy',$resumen->venta->id) }}">
                                <a class="btn btn-default btn-sm" href="{{route('ventas.edit',$resumen->venta->id)}}">
                                    <i class="fa fa-edit fa-lg"></i>  </a>

                                <a class="btn btn-default btn-sm" href="{{route('venta_detalle.show',$resumen->venta->id)}}">
                                    <i class="fa fa-cart-plus fa-lg"></i>  </a>

                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="delete" />
                                <button class="btn btn-default btn-sm"><i class="fa fa-trash-o fa-lg"></i></button>
                            </form>
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

                            </td>
                            <td>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>

@endsection
