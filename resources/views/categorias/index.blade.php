@extends('layouts.adminlte')

@section('contenido')


    <h1 align="center">Categorias</h1>
    @include('component.resourceTable',[
                'recurso' => 'categorias',
                'lista' => $categorias,
        ])


@endsection