@extends('layouts.adminlte')

@section('contenido')

    <a href="{{ route('inventario.download','xls') }}"><button class="btn btn-success">Download Excel xls</button></a>
    <a href="{{ route('inventario.download','xlsx') }}"><button class="btn btn-success">Download Excel xlsx</button></a>
    <a href="{{ route('inventario.download','csv') }}"><button class="btn btn-success">Download CSV</button></a>

    <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="{{ route('inventario.import') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
        {{ csrf_field() }}

        <input type="file" name="import_file" />
        <button class="btn btn-primary">Seleccionar archivo</button>
    </form>

@endsection
