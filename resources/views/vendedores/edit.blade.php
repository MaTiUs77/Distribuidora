@extends('layouts.adminlte')

@section('contenido')

    <div class="container">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Editar vendedor</h3>
            </div>
            <div class="box-body">
                <form class="form-horizontal" role="form" method="post" action="{{ route('vendedores.update',$vendedor->id) }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT" />

                    <input class="form-control input-lg" type="text" name="name" required placeholder="Nombre" value="{{$vendedor->nombre}}">
                    <br>
                    <input class="form-control input-lg" type="text" name="apellido" required placeholder="Apellido" value="{{$vendedor->apellido}}">
                    <br>
                    <input class="form-control input-lg" type="text" name="telefono" required placeholder="Telefono" value="{{$vendedor->telefono}}">
                    <br>
                    <input class="form-control input-lg" type="text" name="direccion" required placeholder="Direccion" value="{{$vendedor->direccion}}">
                    <br>
                    <input class="form-control input-lg" type="email" name="email" required placeholder="Email" value="{{$vendedor->email}}">
                    <br>
                    <input class="form-control input-lg" type="text" name="cuil_cuit" required placeholder="Cuil/Cuit" value="{{$vendedor->cuil_cuit}}">
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