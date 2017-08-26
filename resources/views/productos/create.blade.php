@extends('layouts.adminlte')

@section('contenido')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="well well-sm">
                <form class="form-horizontal" role="form" method="post" action="{{ route('productos.store') }}">
                    <fieldset>
                        <legend class="text-center header">Datos del Producto</legend>
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center">Producto</span>
                            <div class="col-md-8">
                                <input id="producto" name="producto" type="text" placeholder="Nombre del Producto" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center">Barcode</span>
                            <div class="col-md-8">
                                <input id="barcode" name="barcode" type="text" placeholder="Barcode" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center">Precio Proveedor</span>
                            <div class="col-md-8">
                                <input id="precio_proveedor" name="precio_proveedor" type="text" placeholder="Precio_Proveedor" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center">Precio Venta</span>
                            <div class="col-md-8">
                                <input id="precio_venta" name="precio_venta" type="text" placeholder="Precio_Venta" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center">Porcentaje</span>
                            <div class="col-md-8">
                                <input id="aplicar_porcentaje" name="aplicar_porcentaje" type="text" placeholder="Porcentaje" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center">Estado</span>
                            <div class="col-md-8">
                                <input id="estado" name="estado" type="text" placeholder="Estado" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center">Stock</span>
                            <div class="col-md-8">
                                <input id="stock" name="stock" type="number" placeholder="Stock" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center">Almacen</span>
                            <div class="col-md-8">
                                <select name="almacen" class="form-control">
                                    @for($i=0;$i<count($producto['almacen']);$i++)
                                    <option name="almacen" value={{$producto['almacen'][$i]->id}}>{{$producto['almacen'][$i]->nombre}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center">Proveedor</span>
                            <div class="col-md-8">
                                <select  name="proveedor" class="form-control">
                                    @for($i=0;$i<count($producto['proveedor']);$i++)
                                        <option value={{$producto['proveedor'][$i]->id}}>{{$producto['proveedor'][$i]->nombre}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center">Marca</span>
                            <div class="col-md-8">
                                <select name="marca" class="form-control">
                                    @for($i=0;$i<count($producto['marca']);$i++)
                                        <option value={{$producto['marca'][$i]->id}}>{{$producto['marca'][$i]->nombre}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center">Categoria</span>
                            <div class="col-md-8">
                                <select name="categoria" class="form-control">
                                    @for($i=0;$i<count($producto['categoria']);$i++)
                                        <option value={{$producto['categoria'][$i]->id}}>{{$producto['categoria'][$i]->nombre}}</option>
                                    @endfor
                                </select>
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