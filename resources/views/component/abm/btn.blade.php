<div class="dropdown">
    <button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown">Acciones
        <span class="caret"></span></button>
    <ul class="dropdown-menu">
        <li>
            <a href="{{ route($resource.'.edit',$item->id) }}">
                <i class="fa fa-edit"></i>
                Editar
            </a>
        </li>

        @yield('component.abm.btn.option')

        <li class="divider"></li>
        <li>
            <a href="javascript:{{ $resource.$item->id }}_delete({{$item->id}});">
                <i class="fa fa-trash"></i>
                Eliminar
            </a>
        </li>
    </ul>
</div>

<form id="form_{{ $resource.$item->id }}" method="POST" action="{{ route($resource.'.destroy',$item->id) }}">
  {{ csrf_field() }}
  <input type="hidden" name="_method" value="delete" />
</form>

<script>
  function {{ $resource.$item->id }}_delete(id) {
    swal({
      title: "Confirma eliminar?",
      text: "No podra recuperar esta informacion!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Si, eliminar!",
      cancelButtonText: "Cancelar",
      closeOnConfirm: false
    },
    function(){
      $('#form_{{ $resource.$item->id }}').submit();
    });
  }
</script>
