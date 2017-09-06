@extends('layouts.adminlte')

@section('contenido')

  <div class="container">
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Crear usuario</h3>
      </div>
      <div class="box-body">
        <form role="form" method="post" action="{{ route('usuarios.store') }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <input class="form-control input-lg" type="text" name="name"  required placeholder="Ingresar nombre">
          <br>

          <input class="form-control input-lg" type="email" name="email" required placeholder="Ingresar email">
          <br>

          <input class="form-control input-lg" type="password" name="password" required placeholder="Ingresar clave">
          <br>

          <select name="role_id" class="form-control input-lg">
            <option value="">- Asignar un rol -</option>
            @foreach($roles as $rol)
              <option value="{{$rol->id}}">{{$rol->name}}</option>
            @endforeach
          </select>

          <br>
          <div class="text-center">
            <button class="btn btn-success"><i class="fa fa-plus"></i> Crear</button>
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
