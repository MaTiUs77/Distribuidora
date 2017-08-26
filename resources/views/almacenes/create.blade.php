@extends('layouts.adminlte')

@section('contenido')

    <div class="container">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Crear almacen</h3>
            </div>
            <div class="box-body">
                <form role="form" method="post" action="{{ route('almacenes.store') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <input class="form-control input-lg" type="text" name="name" placeholder="Ingresar nombre del nuevo almacen">

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