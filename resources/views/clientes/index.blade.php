@extends('layouts.adminlte')

@section('contenido')

  <base-table
          titulo="Clientes"
          load="{{ url('api/datatable/clientes') }}"
          action="{{ route('clientes.index')  }}"
          :columnas="['name','email']"
          :form="form" xmlns:v-on="http://www.w3.org/1999/xhtml">
    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-6">
          <div class="well well-sm">
            <div class="form-group">
              <form class="form-horizontal" role="form" method="post" action="{{ route('clientes.store') }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <label>Tipo de identificacion</label>
                <input name="tipo_identificacion" class="form-control input-group-sm" v-model="form.tipo_identificacion" placeholder="Ingrese tipo de identificacion"/>
            </div>
          </div>
        </div>
        <div class="col-xs-6">
          <div class="well well-sm">
            <div class="form-group">
              <label>Numero de identificacion</label>
              <input type="text" name="numero_identificacion" id="numero_identificacion" class="form-control input-group-sm" placeholder="Ingrese numero de identificacion" v-model="form.numero_identificacion"/>
              <span class="label label-danger">@{{ alerta }}</span>
              <span class="label label-primary">@{{ buscando }}</span>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-9 pull-right">
          <input type="button" class="btn btn-primary" @click="getInfoAfip()" value="OBTENER DATOS AFIP">
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-xs-6">
          <div class="well well-sm">
            <div class="form-group">
              <label>Nombre</label>
              <input type="text" name="nombre" id="nombre" class="form-control input-group-sm" placeholder="Ingrese nombre del cliente" v-model="form.nombre"/>
            </div>
          </div>
        </div>
        <div class="col-xs-6">
          <div class="well well-sm">
            <div class="form-group">
              <label>Direccion</label>
              <input type="text" name="direccion" class="form-control input-group-sm" placeholder="Ingrese direccion del cliente" v-model="form.direccion"/>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-6">
          <div class="well well-sm">
            <div class="form-group">
              <label>Localidad</label>
              <input type="text" name="localidad" class="form-control input-group-sm" placeholder="Ingrese localidad" v-model="form.localidad"/>
            </div>
          </div>
        </div>
        <div class="col-xs-6">
          <div class="well well-sm">
            <div class="form-group">
              <label>Codigo Postal</label>
              <input type="text" name="codigo_postal" class="form-control input-group-sm" placeholder="Ingrese Codigo Postal" v-model="form.codigo_postal"/>
            </div>
          </div>
        </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-xs-6">
          <div class="well well-sm">
            <div class="form-group">
              <label>Pais</label>
              <input type="text" name="pais" class="form-control input-group-sm" placeholder="Ingrese pais" v-model="form.pais"/>
            </div>
          </div>
        </div>
        <div class="col-xs-6">
          <div class="well well-sm">
            <div class="form-group">
              <label>Provincia</label>
              <input type="text" name="provincia" class="form-control input-group-sm" placeholder="Ingrese provincia" v-model="form.provincia"/>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-xs-6">
          <div class="well well-sm">
            <div class="form-group">
              <label>Telefono</label>
              <input type="text" name="telefono" class="form-control input-group-sm" placeholder="Ingrese telefono" v-model="form.telefono"/>
            </div>
          </div>
        </div>
        <div class="col-xs-6">
          <div class="well well-sm">
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email" class="form-control input-group-sm" placeholder="Ingrese email" v-model="form.email" required/>
              <span class="label label-danger">@{{ message }}</span>
            </div>
          </div>
        </div>
        </form>
      </div>
    </div>

  </base-table>

@endsection
