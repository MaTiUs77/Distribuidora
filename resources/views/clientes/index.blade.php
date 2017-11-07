@extends('layouts.adminlte')

@section('contenido')

  <base-table
          titulo="Clientes"
          load="{{ url('api/datatable/clientes') }}"
          action="{{ route('clientes.index')  }}"
          :columnas="['name','email']"
          :form="form">

<div class="container-fluid">
  <div class="row">
    <div class="col-xs-6">
      <div class="well well-sm">
        <div class="form-group">
          <form class="form-horizontal" role="form" method="post" action="{{ route('clientes.store') }}" id="app">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <label>Tipo de identificacion</label>
          <select name="tipo_identificacion" class="form-control input-group-sm">
            <option value="dni">DNI</option>
            <option value="cuil" selected>CUIL</option>
            <option value="cuit">CUIT</option>
          </select>
        </div>
      </div>
    </div>
    <div class="col-xs-6">
      <div class="well well-sm">
        <div class="form-group">
          <label>Numero de identificacion</label>
          <input type="text" name="numero_identificacion" class="form-control input-group-sm" placeholder="Ingrese numero de identificacion"/>
        </div>
      </div>
    </div>
  </div>

    <div class="row">
      <div class="col-xs-9 pull-right">
        <input type="button" class="btn btn-success" value="OBTENER DATOS DE LA AFIP" id="afip">
      </div>
    </div>
<hr>
  <div class="row">
    <div class="col-xs-6">
      <div class="well well-sm">
        <div class="form-group">
          <label>Nombre</label>
          <input type="text" name="nombre" class="form-control input-group-sm" placeholder="Ingrese nombre del cliente"/>
        </div>
      </div>
    </div>
    <div class="col-xs-6">
      <div class="well well-sm">
        <div class="form-group">
          <label>Direccion</label>
          <input type="text" name="direccion" class="form-control input-group-sm" placeholder="Ingrese direccion del cliente"/>
        </div>
      </div>
  </div>
</div>
  <div class="row">
    <div class="col-xs-6">
      <div class="well well-sm">
        <div class="form-group">
          <label>Localidad</label>
          <input type="text" name="localidad" class="form-control input-group-sm" placeholder="Ingrese localidad"/>
        </div>
      </div>
    </div>
    <div class="col-xs-6">
      <div class="well well-sm">
        <div class="form-group">
          <label>Codigo Postal</label>
          <input type="text" name="codigo_postal" class="form-control input-group-sm" placeholder="Ingrese Codigo Postal"/>
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
          <input type="text" name="pais" class="form-control input-group-sm" placeholder="Ingrese pais"/>
        </div>
      </div>
    </div>
    <div class="col-xs-6">
      <div class="well well-sm">
        <div class="form-group">
          <label>Provincia</label>
          <input type="text" name="provincia" class="form-control input-group-sm" placeholder="Ingrese provincia"/>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-xs-6">
      <div class="well well-sm">
        <div class="form-group">
          <label>Telefono</label>
          <input type="text" name="telefono" class="form-control input-group-sm" placeholder="Ingrese telefono"/>
        </div>
      </div>
    </div>
    <div class="col-xs-6">
      <div class="well well-sm">
        <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" class="form-control input-group-sm" placeholder="Ingrese email"/>
        </div>
      </div>
    </div>
    </form>
  </div>
</div>
  </base-table>

@endsection
