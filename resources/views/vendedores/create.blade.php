@extends('layouts.adminlte')

@section('contenido')

    <div class="container">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Crear Vendedor</h3>
            </div>
            <div class="box-body">
                <form class="form-horizontal" role="form" method="post" action="{{ route('vendedores.store') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <input class="form-control input-lg" type="text" name="name" required placeholder="Nombre">
                    <br>
                    <input class="form-control input-lg" type="text" name="apellido" required placeholder="Apellido">
                    <br>
                    <input class="form-control input-lg" type="text" name="telefono" required placeholder="Telefono">
                    <br>
                    <input class="form-control input-lg" type="text" name="direccion" required placeholder="Direccion">
                    <br>
                    <input class="form-control input-lg" type="text" name="email" required placeholder="Email">
                    <br>
                    <input class="form-control input-lg" type="text" name="cuil_cuit" required placeholder="Cuil/Cuit">
                    <br>
                    <input class="form-control input-lg" type="text" name="user_id" placeholder="Usuario">
                    <br>

                    <div class="text-center">
                        <button class="btn btn-success"><i class="fa fa-plus"></i> Crear</button>
                    </div>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
    </div>

@endsection