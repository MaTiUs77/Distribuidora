<div class="box">
  <div class="box-header">
    <h3 class="box-title">Lista de {{ ucfirst($resource) }}</h3>

    <a class="btn btn-primary pull-right" href="{{ route($resource.'.create') }}">
      <i class="fa fa-plus"></i>
      Agregar
      <span class="hidden-xs">
        {{ ucfirst($resource) }}
      </span>
    </a>

  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
    <table class="table table-striped">
      <tbody>
      <tr>
        <th style="width: 180px">Acciones</th>
        <th style="width: 10px">Id</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Rol</th>
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
          <td>{{ $item->name }}</td>
          <td>{{ $item->email }}</td>
          <td>
            @foreach ($item->roles as $rol)
              <span class="label label-primary">{{ $rol->name }}</span>
            @endforeach
          </td>
        </tr>
      @endforeach

      </tbody>
    </table>
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
