@extends('layouts.adminlte')

@section('contenido')

    <div class="container">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Editar categoria</h3>
            </div>
            <div class="box-body">
                <form class="form-horizontal" role="form" method="post" action="{{ route('categorias.update',$categoria->id) }}">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT" />

                    <input class="form-control input-lg" type="text" name="name" required placeholder="Nombre" value="{{$categoria->nombre}}">
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