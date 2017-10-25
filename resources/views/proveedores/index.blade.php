@extends('layouts.adminlte')

@section('contenido')

    <base-table
            titulo="Proveedores"
            load="{{ url('api/datatable/proveedores') }}"
            action="{{ route('proveedores.index')  }}"
            :columnas="['name','email']"
            :form="form">

        <div class="row">
            <div class="col-xs-6">
                <div class="form-group">
                    <label class="control-label" for="nombre">Nombre:</label>
                    <input v-model="form.nombre" type="text" class="form-control autofocus" id="nombre" placeholder="Ingrese Nombre" name="nombre" required>
                </div>

            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    <label class="control-label" for="email">Email:</label>
                    <input v-model="form.email" type="email" class="form-control" id="email" placeholder="Ingrese Email" name="email" required>
                </div>
            </div>
        </div>

    </base-table>

{{--
    @include('component.abm.baseTableProveedores',[
            'resource' => 'proveedores',
            'items' => $proveedores,
    ])
--}}

@endsection
