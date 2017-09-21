@extends('layouts.adminlte')

@section('contenido')

    <div class="container">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Ventas Pendientes</h3>
            </div>
            <div class="box-body">
                <table class="table table-striped">
                    <tbody>
                    <tr>
                        <th style="width: 10px">Id</th>
                        <th>Fecha Creado</th>
                        <th>Fecha Entrega</th>
                        <th>Estado</th>
                        <th>Cliente</th>
                        <th>Vendedor</th>
                        <th>Acciones</th>
                    </tr>

                    @foreach($pendientes as $item)
                    <tr>

                    <td>{{ $item->id }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->fecha_entrega }}</td>
                    <td>{{ $item->estado }}</td>
                    <td>{{ $item->cliente->name }}</td>
                    <td>{{ $item->vendedor->name }}</td>
                        <td><a class="btn btn-success" href="{{route('ventas.edit',$item->id)}}">
                                <i class="fa fa-bars fa-lg"></i> Modificar Cliente</a>
                            <a class="btn btn-success" href="{{route('venta_detalle.show',$item->id)}}">
                                <i class="fa fa-bars fa-lg"></i> Modificar Productos</a>

                            <form method="POST" action="{{ route('ventas.destroy',$item->id) }}">
                                {{ csrf_field() }}
                                <input type="hidden" name="_method" value="delete" />
                                <button class="btn btn-danger"><i class="fa fa-trash-o fa-lg"></i>Cancelar</button>
                            </form>
                    </td>

                    </tr>
                    @endforeach
                    <tr>
                        <th>Total</th>
                        <th>$</th>
                    </tr>
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </div>

@endsection
