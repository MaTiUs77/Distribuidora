<div class="box">
  <div class="box-header">
    <h3 class="box-title">Lista de {{ ucfirst($resource) }}</h3>

    <a class="btn btn-primary pull-right" href="{{ route($resource.'.create') }}">
      Agregar {{ ucfirst($resource) }}
    </a>

  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
    <table class="table table-striped">
      <tbody>
      <tr>
        <th style="width: 150px">Acciones</th>
        <th style="width: 10px">Id</th>
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
          <td>
            @include('component.abm.btn',[
                'resource' => $resource,
                'item' => $item,
            ])
          </td>
          <td>{{ $item->id }}</td>
          <td>{{ $item->nombre }}</td>
          <td>{{ $item->barcode }}</td>
          <td>{{ $item->precio_proveedor }}</td>
          <td>{{ $item->precio_venta }}</td>
          <td>{{ $item->aplicar_porcentaje }}</td>
          <td>{{ $item->estado }}</td>
          <td>{{ $item->stock }}</td>
          <td>{{ $item->id_almacen}}</td>
          <td>{{ $item->id_proveedor}}</td>
          <td>{{ $item->id_marca}}</td>
          <td>{{ $item->id_categoria}}</td>
        </tr>
      @endforeach

      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>


@if(session()->has('message'))
  <script>

    document.onreadystatechange = () => {
      if (document.readyState === 'complete') {
        swal("{{ session('message') }}", "", "success")
      }
    }

  </script>
@endif
