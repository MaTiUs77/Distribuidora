@extends('layouts.adminlte')

@section('contenido')

    <div class="box box-primary">
        <div class="box-header">

            <form action="{{ route('inventario.import') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <span class="btn btn-default btn-file">
                    Seleccionar archivo Excel <input type='file'name="import_file"/>
                </span>
                <input type="submit" class="btn btn-success" value="Importar">


                <div class="dropdown pull-right">
                    <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">Exportar inventario
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('inventario.download','pdf') }}">PDF</a></li>
                        <li class="divider"></li>
                        <li><a href="{{ route('inventario.download','xls') }}">XLS</a></li>
                        <li><a href="{{ route('inventario.download','xlsx') }}">XLSX</a></li>
                        <li><a href="{{ route('inventario.download','csv') }}">CSV</a></li>
                    </ul>
                </div>

            </form>

        </div>
    </div>

    @include('component.abm.baseTableProductos',[
        'resource' => 'productos',
        'items' => $productos,
    ])

@endsection
