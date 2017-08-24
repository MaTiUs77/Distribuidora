@extends('layouts.adminlte')

@section('contenido')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="well well-sm">
                    <form class="form-horizontal" role="form" method="post" action="{{ route('proveedores.update',$proveedores->id) }}">
                        <fieldset>
                            <legend class="text-center header">Datos del Proveedor</legend>
                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT" />
                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                                <div class="col-md-8">
                                    <input id="name" name="name" type="text" placeholder="Nombre" class="form-control" value="{{$proveedores->nombre}}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-phone-square bigicon"></i></span>
                                <div class="col-md-8">
                                    <input id="telefono" name="telefono" type="text" placeholder="Telefono" class="form-control" value="{{$proveedores->telefono}}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-address-card bigicon"></i></span>
                                <div class="col-md-8">
                                    <input id="direccion" name="direccion" type="text" placeholder="Direccion" class="form-control" value="{{$proveedores->direccion}}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-envelope bigicon"></i></span>
                                <div class="col-md-8">
                                    <input id="email" name="email" type="email" placeholder="Email" class="form-control" value="{{$proveedores->email}}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary btn-lg">Actualizar</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection