<div class="box">
  <div class="box-header">
    <h3 class="box-title">Lista de {{ ucfirst($resource) }}</h3>

    <a href="javascript:;" class="btn btn-primary pull-right" data-toggle="modal" data-target="#modalCreate">
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


  <!-- Modal -->
  <div id="modalCreate" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar {{ ucfirst($resource) }}</h4>
        </div>
        <div class="modal-body">

          <form role="form" method="post" action="{{ route($resource.'.store') }}" id="formCreate">
            {{ csrf_field() }}

            <input id="inputCreateNombre" class="form-control input-lg" type="text" name="name" required placeholder="Ingresar nombre de {{ ucfirst($resource) }}">
          </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" data-dismiss="modal" onclick="$('#formCreate').submit()"><i class="fa fa-plus"></i>  Crear</button>
        </div>
      </div>

    </div>
  </div>

  <script>

    $('#modalCreate').on('shown.bs.modal', function () {
      $('#inputCreateNombre').focus();
    });

  </script>
@endsection