@extends('layouts.adminlte')

@section('contenido')

        @include('component.abm.baseTableClientes',[
                'resource' => 'clientes',
                'items' => $clientes,
        ])

@endsection
