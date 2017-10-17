@extends('layouts.adminlte')

@section('contenido')

  @include('component.abm.baseTableEmpresa',[
    'resource' => 'empresa',
    'items' => $empresa,
  ])

@endsection
