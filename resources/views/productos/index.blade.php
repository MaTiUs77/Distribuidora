@extends('layouts.adminlte')

@section('contenido')

        @include('component.abm.baseTable',[
                'resource' => 'productos',
                'items' => $productos,
        ])

@endsection
