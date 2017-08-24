@extends('layouts.adminlte')

@section('contenido')
    <!-- Form subscription -->
    <form role="form" method="post" action="{{ route('marcas.store') }}">
        <p class="h5 text-center mb-4">Subscribe nueva categoria</p>

        <div class="md-form">
            <i class="fa fa-book"></i>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="text" id="form3" class="form-control" name="name" required>
            <label for="form3">Nombre Categoria</label>
        </div>

        <div class="text-center">
            <button class="btn btn-indigo">Agregar <i class="fa fa-paper-plane-o ml-1"></i></button>
        </div>

    </form>
    <!-- Form subscription -->
@endsection