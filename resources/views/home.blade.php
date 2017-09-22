@extends('layouts.adminlte')

@section('contenido')

  <div class="col-md-4">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="fa fa-bell-o"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Ventas pendientes: {{ $resumenPendiente->ventas->count() }}</span>
        <span class="info-box-text">Productos: {{ $resumenPendiente->cantidadProductos }}</span>
        <span class="info-box-text">Costo retenido: $ <b>{{ $resumenPendiente->costoTotal }}</b></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>

  <div class="col-md-4">
    <div class="info-box">
      <span class="info-box-icon bg-aqua"><i class="ion ion-ios-cart-outline"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Ventas finalizadas: {{ $resumenFinalizada->ventas->count() }}</span>
        <span class="info-box-text">Productos: {{ $resumenFinalizada->cantidadProductos }}</span>
        <span class="info-box-text">Costo: $ <b>{{ $resumenFinalizada->costoTotal }}</b></span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>


  <div class="col-md-12">
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
  </div>



@endsection
