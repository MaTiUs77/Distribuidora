@extends('layouts.adminlte')

@section('contenido')

        @include('component.abm.baseTableProveedores',[
                'resource' => 'proveedores',
                'items' => $proveedores,
        ])

@endsection
