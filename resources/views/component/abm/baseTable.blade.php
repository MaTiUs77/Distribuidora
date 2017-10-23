<div class="box">
  <div class="box-header">
    <h3 class="box-title">Lista de {{ ucfirst($resource) }}</h3>

    <div class="pull-right">
      <div id="root">
        <prompt-add recurso="{{ ucfirst($resource) }}">

          <form role="form" method="post" action="{{ route($resource.'.store') }}" id="formCreate">
            {{ csrf_field() }}

            <input id="inputCreateNombre" class="form-control input-lg" type="text" name="name" required placeholder="Ingresar nombre de {{ ucfirst($resource) }}">
          </form>

        </prompt-add>
      </div>
    </div>

  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
    <table class="table table-striped">
      <tbody>
      <tr>
        <th style="width: 100px">Acciones</th>
        <th>Nombre</th>
      </tr>

      @foreach($items as $item)
        <tr>
          <td>
            @include('component.abm.btn',[
                'resource' => $resource,
                'item' => $item,
                'modalEdit' => true
            ])
          </td>
          <td>{{ $item->nombre }}</td>
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

@section('footer')
  <script src="{{ mix('js/baseTable.js') }}"></script>
@endsection