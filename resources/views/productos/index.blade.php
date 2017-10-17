@extends('layouts.adminlte')

@section('contenido')

    <div class="box box-primary">
        <div class="box-header">
            <a class="btn btn-primary" href="{{ route('inventario.index') }}">
                <i class="fa fa-excel"></i>
                Importar XML
            </a>
        </div>
    </div>

    @include('component.abm.baseTableProductos',[
        'resource' => 'productos',
        'items' => $productos,
    ])

@endsection
