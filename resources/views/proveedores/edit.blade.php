@extends('layouts.adminlte')

@section('contenido')

    <div class="container">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Editar proveedor</h3>
            </div>
            <div class="box-body">
                <form class="form-horizontal" role="form" method="post" action="{{ route('proveedores.update',$proveedor->id) }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT" />

                    <input class="form-control input-lg" type="text" name="name" required placeholder="Nombre" value="{{$proveedor->nombre}}">
                    <br>
                    <input class="form-control input-lg" type="text" name="telefono" required placeholder="Telefono" value="{{$proveedor->telefono}}">
                    <br>
                    <input class="form-control input-lg" type="text" name="direccion" required placeholder="Direccion" value="{{$proveedor->direccion}}">
                    <br>
                    <input class="form-control input-lg" type="text" name="email" required placeholder="Email" value="{{$proveedor->email}}">
                    <br>

                    <div class="text-center">
                        <button class="btn btn-success"><i class="fa fa-edit"></i> Actualizar</button>
                    </div>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
    </div>

@endsection