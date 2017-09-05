@extends('layouts.adminlte')

@section('contenido')

  @include('component.abm.baseTableUsuarios',[
    'resource' => 'usuarios',
    'items' => $users,
  ])

@endsection
