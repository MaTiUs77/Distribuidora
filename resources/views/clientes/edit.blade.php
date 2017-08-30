@extends('layouts.adminlte')

@section('contenido')

    <div class="container">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Editar cliente</h3>
            </div>
            <div class="box-body">
                <form class="form-horizontal" role="form" method="post" action="{{ route('clientes.update',$cliente->id) }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT" />

                    <input class="form-control input-lg" type="text" name="name" required placeholder="Nombre" value="{{$cliente->nombre}}">
                    <br>
                    <input class="form-control input-lg" type="text" name="telefono" required placeholder="Telefono" value="{{$cliente->telefono}}">
                    <br>
                    <input class="form-control input-lg" type="text" name="direccion" required placeholder="Direccion" value="{{$cliente->direccion}}">
                    <br>
                    <input class="form-control input-lg" type="email" name="email" required placeholder="Email" value="{{$cliente->email}}">
                    <br>
                    <input class="form-control input-lg" type="text" name="cuil_cuit" required placeholder="Cuil/Cuit" value="{{$cliente->cuil_cuit}}">
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