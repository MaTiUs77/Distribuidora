<div class="row">
  <div class="col-sm-10">
    <div class="panel panel-primary">
      <div class="panel-heading">{{$perfil->nombre}} {{$perfil->apellido}}</div>
      <div class="panel-body">
        <div class="row">
          <div class="col-sm-4">
            <img src="{{asset('/images/perfiles/Koala.jpg')}}" class="img-rounded" alt="Cinque Terre" width="254" height="206">
          </div>
          <div class="col-sm-4">
            <h4>Nombre </h4>
            <h4>Codigo</h4>
            <h4>Telefono</h4>
            <h4>Direccion</h4>
            <h4>Tipo de Ident.</h4>
            <h4>Numero de Ident.</h4>
            <h4>Email</h4>
            <h4>Pais</h4>
            <h4>Provincia</h4>
            <h4>Localidad</h4>

          </div>
          <div class="col-sm-4">
            <p class="text-light-blue">{{$perfil->nombre}}</p>
            <p class="text-light-blue">{{$perfil->codigo}}</p>
            <p class="text-light-blue">{{$perfil->telefono}}</p>
            <p class="text-light-blue">{{$perfil->direccion}}</p>
            <p class="text-light-blue">{{$perfil->tipo_identificacion}}</p>
            <p class="text-light-blue">{{$perfil->numero_identificacion}}</p>
            <p class="text-light-blue">{{$perfil->email}}</p>
            <p class="text-light-blue">{{$perfil->pais}}</p>
            <p class="text-light-blue">{{$perfil->provincia}}</p>
            <p class="text-light-blue">{{$perfil->localidad}}</p>
          </div>

        </div>
      </div>
      <div class="panel-footer">
      <a href="{{route('perfil.edit',$perfil->id)}}" class="btn btn-success btn-md">Modificar</a>


      </div>
    </div>

  </div>

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
