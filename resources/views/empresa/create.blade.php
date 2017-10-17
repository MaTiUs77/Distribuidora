@extends('layouts.adminlte')

@section('contenido')

  <div class="container">
    <div class="row">
      <div class="col-xs-10">
    <div class="box box-success">
      <div class="box-header with-border">
        <h3 class="box-title">Crear empresa</h3>
      </div>
      <div class="box-body">
        <form class="form-horizontal" role="form" method="post" action="{{ route('empresa.store') }}">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">

          <div class="form-group">
            <label class="control-label col-sm-2" for="nombre">Nombre:</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="nombre" placeholder="Ingrese Titular de la Compañia" name="nombre">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="razon_social">Razon Social:</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="razon_social" placeholder="Ingrese Razon social" name="razon_social">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="domicilio_comercial">Domicilio Comercial:</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="domicilio_comercial" placeholder="Ingrese Doc" name="domicilio_comercial">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="telefono">Telefono:</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="telefono" placeholder="Ingrese Telefono" name="telefono">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="cuit">CUIT:</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="cuit" placeholder="CUIT" name="cuit">
            </div>
          </div>

          <div class="form-group">
            <label class="control-label col-sm-2" for="email">Email:</label>
            <div class="col-sm-8">
              <input type="email" class="form-control" id="email" placeholder="Ingrese Email" name="email">
            </div>
          </div>
          <br>
          <div class="text-center">
            <button class="btn btn-success"><i class="fa fa-plus"></i> Crear</button>
          </div>
        </form>
      </div>
    </div>
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
