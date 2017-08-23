<div class="box">
  <div class="box-header">
    <h3 class="box-title">Lista de {{ ucfirst($recurso) }}</h3>

    <a class="btn btn-primary pull-right" href="{{ route($recurso.'.create') }}">
      Agregar {{ ucfirst($recurso) }}
    </a>

  </div>
  <!-- /.box-header -->
  <div class="box-body no-padding">
    <table class="table table-striped">
      <tbody>
      <tr>
        <th style="width: 10px">Id</th>
        <th>Nombre</th>
        <th style="width: 200px"></th>
      </tr>

      @foreach($lista as $item)
        <tr>
          <td>{{ $item->id }}</td>
          <td>{{ $item->nombre }}</td>
          <td>
            @include('component.crudbtn',[
                'recurso' => $recurso,
                'id' => $item->id
            ])
          </td>
        </tr>
      @endforeach

      </tbody>
    </table>
  </div>
  <!-- /.box-body -->
</div>