  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Buscar...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="active"><a href="#"><i class="fa fa-home"></i> <span>Inicio</span></a></li>
        <li><a href="#"><i class="fa fa-shopping-cart"></i> <span>Productos</span></a></li>
        <li><a href="#"><i class="fa fa-handshake-o"></i> <span>Pedidos</span></a></li>
        <li><a href="#"><i class="fa fa-cubes"></i> <span>Reposicion</span></a></li>
        <li><a href="#"><i class="fa fa-money"></i> <span>Facturacion</span></a></li>

        <li class="header">USUARIOS</li>
        <li><a href="#"><i class="fa fa-address-card"></i> <span>Clientes</span></a></li>
        <li><a href="#"><i class="fa fa-briefcase"></i> <span>Vendedores</span></a></li>

        <li class="header">ADMINISTRACION</li>
        <li><a href="#"><i class="fa fa-address-book"></i> <span>Distribuidores</span></a></li>
        <li><a href="#"><i class="fa fa-tags"></i> <span>Marcas</span></a></li>
        <li><a href="#"><i class="fa fa-book"></i> <span>Categorias</span></a></li>

        @stack('sidebar_menu')
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

