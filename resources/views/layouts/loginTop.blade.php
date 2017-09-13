<li class="dropdown user user-menu">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">

    @if(Auth::check())
      <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="user-image" alt="User Image">
      <span class="hidden-xs">{{ Auth::user()->name }}</span>
    @else
      <img src="{{ asset('adminlte/dist/img/user.png') }}" class="user-image" alt="User Image">
      <span class="hidden-xs">Iniciar sesion</span>
    @endif
  </a>
  <ul class="dropdown-menu">

    @if(Auth::check())

    <!-- Usuario logueado -->
    <li class="user-header">
      <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }} " class="img-circle" alt="User Image">
      <p>
        {{ Auth::user()->name }}
        <small> {{ Auth::user()->email }}</small>
      </p>
    </li>

    <li class="user-footer">
      <div class="pull-left">
        <a href="{{route('perfil.index')}}" class="btn btn-default btn-flat">Perfil</a>
      </div>
      <div class="pull-right">
        <form id="logout-form"
              action="{{ url('/logout') }}"
              method="POST">
          {{ csrf_field() }}

          <input type="submit" class="btn btn-default btn-flat" value="Finalizar"/>
        </form>
      </div>
    </li>

    @else

    <!-- Loguear usuario -->
    <div class="panel panel-default">
      <div class="panel-heading">Ingresar al sistema</div>
      <div class="panel-body">
        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
          {{ csrf_field() }}
          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            <div class="col-md-12">
              <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required autofocus>

              @if ($errors->has('email'))
                <span class="help-block">
                  <strong>{{ $errors->first('email') }}</strong>
              </span>
              @endif
            </div>
          </div>

          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
            <div class="col-md-12">
              <input id="password" type="password" class="form-control" name="password" placeholder="Clave" required>

              @if ($errors->has('password'))
                <span class="help-block">
                  <strong>{{ $errors->first('password') }}</strong>
              </span>
              @endif
            </div>
          </div>


      <div class="pull-left">
        <button type="submit" class="btn btn-success">
          Ingresar
        </button>
      </div>
      <div class="pull-right">
        <a class="btn btn-link" href="{{ route('password.request') }}">
          Olvido su clave?
        </a>
      </div>

    </form>
      </div>
    </div>

    @endif

  </ul>
</li>

