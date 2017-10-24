<div class="box">
  <div class="box-header">
    <h3 class="box-title">Lista de {{ ucfirst($resource) }}</h3>

    @hasanyrole('vendedor|admin')
    <a class="btn btn-primary pull-right" href="{{ route($resource.'.create') }}">
      <i class="fa fa-plus"></i>
      Agregar
      <span class="hidden-xs">
        {{ ucfirst($resource) }}
      </span>
    </a>
    @endhasanyrole

  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
    <div class="table-responsive">
      <table class="table table-condensed table-striped">
      <tbody>
      <tr>
        @hasanyrole('vendedor|admin')
        <th style="width: 100px">Acciones</th>
        @endhasanyrole
{{--
        <th>Imagen</th>
--}}
        <th>Nombre</th>
        <th>Barcode</th>
        <th>Precio Proveedor</th>
        <th>Precio Venta</th>
        <th>Porcentaje</th>
        <th>Estado</th>
        <th>Stock</th>
        <th>Almacen</th>
        <th>Proveedor</th>
        <th>Marca</th>
        <th>Categoria</th>
      </tr>

      @foreach($items as $item)

        <tr>
          @hasanyrole('vendedor|admin')
          <td>

              <!-- Agrega botones adicionales al componente btn.abm -->
              @section('component.abm.btn.option')
              <li>
                <a href="">
                  <i class="fa fa-cube"></i>
                  Ajustar stock
                </a>
              </li>
              @endsection

              @include('component.abm.btn',[
                  'resource' => $resource,
                  'item' => $item,
              ])
          </td>
          @endhasanyrole
{{--
          <td>
            <img src="{{ asset("upload/".$item->imagen) }}" width="100" style="display: block;">
          </td>
--}}
          <td>{{ $item->nombre }}</td>
          <td>{{ $item->barcode }}</td>
          <td> $ {{ $item->precio_proveedor }}</td>
          <td> $ {{ $item->precio_venta }}</td>
          <td> % {{ $item->aplicar_porcentaje }}</td>
          <td>{{ $item->estado }}</td>
          @if($item->stock < $item->stock_minimo)
            <td class="warning">{{ $item->stock }} de {{$item->stock_minimo}}</td>
          @else
            <td>{{ $item->stock }}</td>
          @endif
          <td>{{ $item->almacen->nombre }}</td>
          <td>{{ $item->proveedor->name }}</td>
          <td>{{ $item->marca->nombre }}</td>
          <td>{{ $item->categoria->nombre }}</td>

          <!-- DESABILITAMSO AL CARRITO
          <td>
            <a href="{{ route('carrito.add', [ $item->id, 1 ] ) }}" class="btn btn-success btn-sm" >
                <i class="fa fa-edit"></i>
                <span class="hidden-xs">
                     Al arrito
                </span>
            </a>
          </td>
          -->
        </tr>
      @endforeach

      </tbody>
    </table>
    </div>
  </div>
  <!-- /.box-body -->
</div>

@if($items instanceof  \Illuminate\Pagination\LengthAwarePaginator)
  <div class="text-center">
    {{ $items->links() }}
  </div>
@endif


@if(session()->has('message'))
  <script>

    document.onreadystatechange = () => {
      if (document.readyState === 'complete') {
        swal("{{ session('message') }}", "", "success")
      }
    }

  </script>
@endif
