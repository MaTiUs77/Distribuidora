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

  <div class="col-md-4">
    <div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Alertas de stock</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <ul class="products-list product-list-in-box">

        @foreach($alertaStock as $producto)

        <li class="item">
          <div class="product-info">
            <a href="javascript:void(0)" class="product-title">{{ $producto->nombre }}
              <span class="product-description">
                  {{ $producto->stock }} de {{ $producto->stock_minimo }}
              </span>
          </div>
        </li>

          @endforeach

      </ul>
    </div>
    <!-- /.box-body -->
    <div class="box-footer text-center">
      <a href="javascript:void(0)" class="uppercase">Ver todas las alertas</a>
    </div>
    <!-- /.box-footer -->
  </div>
  </div>

@endsection