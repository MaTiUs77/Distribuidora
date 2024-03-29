  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">

        @hasanyrole('vendedor|admin')
        <li class="bg-green">
          <a href="{{ url('ventas/terminal') }}" style="background-color: rgb(0, 166, 90);">
            <i class="fa fa-gear" style="color: rgb(255, 255, 255);"></i><span style="color: rgb(255, 255, 255);">Iniciar terminal de venta</span>
          </a>
        </li>
        @endhasanyrole

        <li>
          <!-- search form (Optional) -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="producto" class="form-control" placeholder="Buscar..." id="sidebarBuscarProducto">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
        </li>


        <li class="header">MENU</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="{{ route('home') }}"><i class="fa fa-home"></i> <span>Inicio</span></a></li>
        <li><a href="{{ route('productos.index') }}"><i class="fa fa-shopping-cart"></i> <span>Productos</span></a></li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-handshake-o"></i>
            <span>Ventas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            @hasanyrole('vendedor|admin')
            <li><a href="{{route('ventas.index')}}"><i class="fa fa-plus"></i> Nueva venta</a></li>
            @endhasanyrole

            <li>
              <a href="{{route('pendientes.index')}}"><i class="fa fa-cart-arrow-down"></i> Ver registros</a>
            </li>
          </ul>
        </li>

        @hasanyrole('admin')

        <li class="treeview">
          <a href="#">
            <i class="fa fa-address-book"></i>
            <span>Agenda</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            @hasanyrole('admin')
            <li><a href="{{ route('usuarios.index') }}"><i class="fa fa-user"></i> <span>Usuarios</span></a></li>
            @endhasanyrole
            <li><a href="{{ route('clientes.index') }}"><i class="fa fa-address-card"></i> <span>Clientes</span></a></li>
            <li><a href="{{ route('proveedores.index') }}"><i class="fa fa-truck"></i> <span>Proveedores</span></a></li>
          </ul>
        </li>

        @endhasanyrole


        @hasanyrole('admin')

        <li class="treeview">
          <a href="#">
            <i class="fa fa-database"></i>
            <span>Bade de datos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">

            <li><a href="{{ route('marcas.index') }}"><i class="fa fa-tags"></i> <span>Marcas</span></a></li>
            <li><a href="{{ route('categorias.index') }}"><i class="fa fa-book"></i> <span>Categorias</span></a></li>
            <li><a href="{{ route('almacenes.index') }}"><i class="fa fa-cubes"></i> <span>Almacenes</span></a></li>
          </ul>
        </li>

        @endhasanyrole

        @stack('sidebar_menu')
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
