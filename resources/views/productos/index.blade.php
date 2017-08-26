@extends('layouts.adminlte')

@section('contenido')

        @include('component.abm.baseTableProductos',[
                'resource' => 'productos',
                'items' => $productos,
        ])

@endsection
