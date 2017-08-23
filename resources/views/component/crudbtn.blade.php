


<form method="POST" action="{{ route($recurso.'.destroy',$id) }}">

  <a href="{{ route($recurso.'.edit',$id) }}" class="btn btn-warning" >Editar</a>


  {{ csrf_field() }}
  <input type="hidden" name="_method" value="delete" />
  <input type="submit" class="btn btn-danger" value="Eliminar"/>
</form>

