@extends('layouts.adminlte')

@section('contenido')

        @include('component.abm.baseTableVendedores',[
                'resource' => 'vendedores',
                'items' => $vendedores,
        ])

@endsection
