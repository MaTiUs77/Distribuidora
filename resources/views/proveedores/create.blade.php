@extends('layouts.adminlte')

@section('contenido')

    <div class="container">
        <div class="row">
            <div class="col-xs-10">
                <div class="box box-success">
                    <div class="box-header with-border">
                        <h3 class="box-title">Crear Proveedor</h3>
                    </div>
                    <div class="box-body">
                        <form class="form-horizontal" role="form" method="post" action="{{ route('proveedores.store') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="nombre">Nombre:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nombre" placeholder="Ingrese Nombre" name="nombre">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="codigo">Codigo:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="codigo" placeholder="Ingrese Codigo" name="codigo">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="telefono">Telefono:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="telefono" placeholder="Ingrese Telefono" name="telefono">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="direccion">Direccion:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="direccion" placeholder="Ingrese Direccion" name="direccion">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="tipo_identificacion">Tipo Ident.:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="tipo_identificacion" placeholder="DNI CUIL CUIT" name="tipo_identificacion">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="numero_identificacion">N° Ident.:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="numero_identificacion" placeholder="Numero de Identificacion" name="numero_identificacion">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="email">Email:</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" id="email" placeholder="Ingrese Email" name="email">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="pais">Pais:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="pais" placeholder="Ingrese Pais" name="pais">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="provincia">Provincia:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="provincia" placeholder="Ingrese Provincia" name="provincia">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-sm-2" for="localidad">Localidad:</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="localidad" placeholder="Ingrese Localidad" name="localidad">
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
