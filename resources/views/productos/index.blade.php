@extends('layouts.adminlte')

@section('contenido')

        @include('component.resourceTable',[
                'recurso' => 'productos',
                'lista' => $productos,
        ])

@endsection
