@extends('layouts.adminlte')

@section('contenido')
    <!-- Form subscription -->
    <form role="form" method="POST" action="{{ route('marcas.update',$marcas->id) }}">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT" />
        <p class="h5 text-center mb-4">Modifica la marca</p>

        <div class="md-form">
            <i class="fa fa-book"></i>
            <input type="text" id="form3" class="form-control" name="name" value="{{$marcas->nombre}}" required>
            <label for="form3">Nombre Marca</label>
        </div>

        <div class="text-center">
            <button class="btn btn-indigo">Modificar <i class="fa fa-paper-plane-o ml-1"></i></button>
        </div>

    </form>

    <!-- Form subscription -->
@endsection