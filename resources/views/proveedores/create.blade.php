@extends('layouts.adminlte')

@section('contenido')
    {{--<!-- Form subscription -->--}}
    {{--<form role="form" method="post" action="{{ route('proveedores.store') }}">--}}
        {{--<p class="h5 text-center mb-4">Subscribe nuevo proveedor</p>--}}

        {{--<div class="md-form">--}}
            {{--<i class="fa fa-book"></i>--}}
            {{--<input type="hidden" name="_token" value="{{ csrf_token() }}">--}}
            {{--<input type="text" id="form3" class="form-control" name="name" required>--}}
            {{--<label for="form3">Nombre Proveedor</label>--}}
        {{--</div>--}}

        {{--<div class="text-center">--}}
            {{--<button class="btn btn-indigo">Agregar <i class="fa fa-paper-plane-o ml-1"></i></button>--}}
        {{--</div>--}}

    {{--</form>--}}
    {{--<!-- Form subscription -->--}}
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="well well-sm">
                    <form class="form-horizontal" role="form" method="post" action="{{ route('proveedores.store') }}">
                        <fieldset>
                            <legend class="text-center header">Datos del Proveedor</legend>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                                <div class="col-md-8">
                                    <input id="fname" name="name" type="text" placeholder="Nombre" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-phone-square bigicon"></i></span>
                                <div class="col-md-8">
                                    <input id="lname" name="telefono" type="text" placeholder="Telefono" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-address-card bigicon"></i></span>
                                <div class="col-md-8">
                                    <input id="email" name="direccion" type="text" placeholder="Direccion" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-envelope bigicon"></i></span>
                                <div class="col-md-8">
                                    <input id="phone" name="email" type="email" placeholder="Email" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-success btn-lg">Agregar</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection