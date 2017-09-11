@extends('layouts.adminlte')

@section('contenido')

    @include('component.abm.baseTablePerfil',[
            'resource' => 'perfil',
            'items' => $perfil,
    ])

@endsection
