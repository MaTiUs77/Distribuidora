@extends('layouts.adminlte')

@section('contenido')

        @include('component.abm.baseTable',[
                'resource' => 'proveedores',
                'items' => $proveedores,
        ])

@endsection
