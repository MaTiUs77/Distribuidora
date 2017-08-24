@extends('layouts.adminlte')

@section('contenido')

        @include('component.abm.baseTable',[
                'resource' => 'marcas',
                'items' => $marcas,
        ])

@endsection
