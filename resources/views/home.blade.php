@extends('layouts.adminlte')

@section('contenido')
  Test de permisos de usuarios

  @role('vendedor')
    <div>Soy un vendedor</div>
  @else
    <div>No soy un vendedor</div>
  @endrole

  @role('admin')
    <div>Soy admin</div>
  @else
    <div>No soy admin</div>
  @endrole


  @can('productos.destroy')
    <div>Puedo eliminar un producto!</div>
  @endcan

@endsection
