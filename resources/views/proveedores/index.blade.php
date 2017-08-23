@extends('layouts.adminlte')

@section('contenido')
        Proveedores Index

        <hr >

        @include('component.crudbtn',[
                'recurso' => 'proveedores',
                'id' => '12'
        ])
@endsection
