@extends('layouts.adminlte')

@section('contenido')

  <base-table
          titulo="Usuarios"
          load="{{ url('api/datatable/usuarios') }}"
          action="{{ route('usuarios.index')  }}"
          :columnas="['name','email']"
          :form="form">

        <div class="form-group">
          <label class="control-label" for="nombre">Nombre:</label>
          <input v-model="form.name" type="text" class="form-control autofocus" id="nombre" placeholder="Ingrese Nombre" name="nombre" required>
        </div>

        <div class="form-group">
          <label class="control-label" for="email">Email:</label>
          <input v-model="form.email" type="email" class="form-control" id="email" placeholder="Ingrese Email" name="email" required>
        </div>

        <div class="form-group">
          <label class="control-label" for="rol">Rol:</label>
          <select v-model="form.role_id" class="form-control" id="rol" name="role_id" required>
            <option value="">- Asignar un rol -</option>
            @foreach($roles as $rol)
              <option value="{{$rol->id}}">{{$rol->name}}</option>
            @endforeach
          </select>
        </div>

        <div class="form-group">
          <label class="control-label" for="password">Clave:</label>
          <input v-model="form.password" type="password" class="form-control" id="password" placeholder="Ingresar clave" name="password" required>
        </div>

  </base-table>

@endsection
