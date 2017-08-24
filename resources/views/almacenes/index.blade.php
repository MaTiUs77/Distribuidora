@extends('layouts.adminlte')

@section('contenido')

        @include('component.abm.baseTable',[
                'resource' => 'almacenes',
                'items' => $almacenes,
        ])

@endsection
