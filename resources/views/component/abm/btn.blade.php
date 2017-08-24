<a href="{{ route($resource.'.edit',$item->id) }}" class="btn btn-warning btn-sm" >Editar</a>

<a href="javascript:{{ $resource.$item->id }}_delete({{$item->id}});" class="btn btn-danger btn-sm">Eliminar</a>

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
              closeOnConfirm: false
            },
            function(){
              $('#form_{{ $resource.$item->id }}').submit();
            });
  }
</script>
