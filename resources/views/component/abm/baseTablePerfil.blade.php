<div class="row">
  <div class="col-sm-10">

    <div class="panel panel-primary">
      <div class="panel-heading">{{$perfil->nombre}} {{$perfil->apellido}}</div>
      <div class="panel-body">
        <div class="row">
          <div class="col-sm-4">
            <img src="{{asset('images/perfiles/koala.jpg')}}" class="img-rounded" alt="Cinque Terre" width="254" height="206">
          </div>
          <div class="col-sm-4">
            <h4>Nombre </h4>
            <h4>Apellido</h4>
            <h4>Telefono</h4>
            <h4>Direccion</h4>
            <h4>Email</h4>
            <h4>Cuit_Cuil</h4>

          </div>
          <div class="col-sm-4">
            <h4>{{$perfil->nombre}}</h4>
            <h4>{{$perfil->apellido}}</h4>
            <h4>{{$perfil->telefono}}</h4>
            <h4>{{$perfil->direccion}}</h4>
            <h4>{{$perfil->email}}</h4>
            <h4>{{$perfil->cuil_cuit}}</h4>

          </div>

        </div>
      </div>
      <div class="panel-footer">
      <a href="{{route('perfil.edit',$perfil->id)}}" class="btn btn-success btn-md">Modificar</a>


      </div>
    </div>

  </div>

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
