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
        <th>Telefono</th>
        <th>Direccion</th>
        <th>Email</th>
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
          <td>{{ $item->telefono }}</td>
          <td>{{ $item->direccion }}</td>
          <td>{{ $item->email }}</td>
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
