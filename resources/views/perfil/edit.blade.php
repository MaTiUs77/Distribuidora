@extends('layouts.adminlte')

@section('contenido')

  <div class="container">
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Editar perfil</h3>
      </div>
      <div class="box-body">
        <form class="form-horizontal" role="form" method="post" action="{{ route('perfil.update',$perfil->id) }}">

          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="_method" value="PUT" />

          <input class="form-control input-lg" type="text" name="name" required placeholder="Nombre" value="{{$perfil->nombre}}">
          <br>

          <input class="form-control input-lg" type="text" name="apellido" required placeholder="Ingresar email" value="{{$perfil->apellido}}">
          <br>
          <input class="form-control input-lg" type="text" name="telefono" required placeholder="Ingresar email" value="{{$perfil->telefono}}">
          <br>
          <input class="form-control input-lg" type="text" name="direccion" required placeholder="Ingresar email" value="{{$perfil->direccion}}">
          <br>
          <input class="form-control input-lg" type="email" name="email" required placeholder="Ingresar email" value="{{$perfil->email}}">
          <br>
          <input class="form-control input-lg" type="text" name="cuil_cuit" required placeholder="Ingresar email" value="{{$perfil->cuil_cuit}}">
          <br>

            <div class="text-center">
            <button class="btn btn-success"><i class="fa fa-edit"></i> Actualizar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif
@endsection
