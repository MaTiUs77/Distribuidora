@extends('layouts.adminlte')

@section('contenido')
    <!-- Form subscription -->
    <form role="form" method="POST" action="{{ route('categorias.update',$categorias->id) }}">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="PUT" />
        <p class="h5 text-center mb-4">Modifica la categoria</p>

        <div class="md-form">
            <i class="fa fa-book"></i>
            <input type="text" id="form3" class="form-control" name="name" value="{{$categorias->nombre}}" required>
            <label for="form3">Nombre Categoria</label>
        </div>

        <div class="text-center">
            <button class="btn btn-indigo">Modificar <i class="fa fa-paper-plane-o ml-1"></i></button>
        </div>

    </form>

    <!-- Form subscription -->
@endsection