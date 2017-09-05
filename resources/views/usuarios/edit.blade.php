@extends('layouts.adminlte')

@section('contenido')

  <div class="container">
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Editar almacen</h3>
      </div>
      <div class="box-body">
        <form class="form-horizontal" role="form" method="post" action="{{ route('usuarios.update',$user->id) }}">

          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="hidden" name="_method" value="PUT" />

          <input class="form-control input-lg" type="text" name="name" required placeholder="Nombre" value="{{$user->name}}">
          <br>

          <input class="form-control input-lg" type="email" name="email" required placeholder="Ingresar email" value="{{$user->email}}">
          <br>

          <input class="form-control input-lg" type="password" name="password" required placeholder="Ingresar clave" value="{{$user->password}}">
          <br>

          <select name="role_id" class="form-control input-lg">
            <option value="">- Asignar un rol -</option>
            @foreach($roles as $rol)
              <option value="{{$rol->id}}">{{$rol->name}}</option>
            @endforeach
          </select>

          <br>

          <div class="text-center">
            <button class="btn btn-success"><i class="fa fa-edit"></i> Actualizar</button>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection
