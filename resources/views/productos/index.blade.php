@extends('layouts.adminlte')

@section('sidebar','sidebar-mini sidebar-collapse')

@section('contenido')

    <!-- START CUSTOM TABS -->
    <div class="row">
        <div class="col-md-12">
            <!-- Custom Tabs -->
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">Filtros</a></li>
                    <li><a href="#tab_2" data-toggle="tab">Importar</a></li>
                    <li><a href="#tab_3" data-toggle="tab">Exportar</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label for="inputId">ID</label>
                                    <input id="inputId" type="text" class="form-control input-sm" placeholder="Buscar por ID">
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label for="inputProveedor">Proveedor</label>
                                    <input id="inputProveedor" type="text" class="form-control input-sm" placeholder="Buscar por Proveedor">
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label for="inputMarca">Marca</label>
                                    <input id="inputMarca" type="text" class="form-control input-sm" placeholder="Buscar por Marca">
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label for="inputCategoria">Categoria</label>
                                    <input id="inputCategoria" type="text" class="form-control input-sm" placeholder="Buscar por Categoria">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" placeholder="Buscar por nombre" class="form-control input-sm">
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group">
                                <label>Barcode</label>
                                <input type="text" placeholder="Buscar por barcode" class="form-control input-sm">
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group">
                                <label>Codigo</label>
                                <input type="text" placeholder="Buscar por codigo" class="form-control input-sm">
                                </div>
                            </div>
                            <div class="col-xs-3">
                                <div class="form-group">
                                <label>Estado</label>
                                <input type="text" placeholder="Buscar por estado" class="form-control input-sm">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_2">
                        <form action="{{ route('inventario.import') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <span class="btn btn-default btn-file">
                                Seleccionar archivo Excel <input type='file'name="import_file"/>
                            </span>
                            <input type="submit" class="btn btn-success" value="Iniciar importacion">
                        </form>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="tab_3">

                        <a href="{{ route('inventario.download','pdf') }}" class="btn btn-default">Exportar PDF</a>
                        <a href="{{ route('inventario.download','xls') }}" class="btn btn-default">Exportar XLS</a>
                        <a href="{{ route('inventario.download','xlsx') }}" class="btn btn-default">Exportar XLSX</a>
                        <a href="{{ route('inventario.download','csv') }}" class="btn btn-default">Exportar CSV</a>
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
    <!-- END CUSTOM TABS -->

    @include('component.abm.baseTableProductos',[
        'resource' => 'productos',
        'items' => $productos,
    ])

@endsection
