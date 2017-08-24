@extends('layouts.adminlte')

@section('contenido')


    <h1 align="center">Marcas</h1>
    @include('component.resourceTable',[
                'recurso' => 'marcas',
                'lista' => $marcas,
        ])


@endsection