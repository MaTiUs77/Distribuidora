@extends('layouts.adminlte')

@section('contenido')

    @include('component.abm.baseTable',[
        'resource' => 'categorias',
        'items' => $categorias,
    ])

@endsection
