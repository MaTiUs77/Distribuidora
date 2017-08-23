@extends('layouts.adminlte')

@section('contenido')
    <h1 align="center">Categorias</h1>
    <!--Grid row-->
    <div class="row d-flex align-items-center mb-4">

        <!--Grid column-->
        <div class="text-center mb-3 col-md-2">
            <a href="{{route('categorias.create')}}" class="btn btn-success btn-block btn-rounded z-depth-1" >Crear</a>
        </div>
        <!--Grid column-->
    </div>
    <!--Grid row-->
    <!--Table-->

    <table class="table">

        <!--Table head-->

        <thead class="blue-grey lighten-4">
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <!--Table head-->

        <!--Table body-->
        <tbody>

        @if($categorias->isEmpty())
        <p>No se encontraron categorias</p>
        @endif
        @isset($categorias)
        @foreach($categorias as $categoria)
        <tr>
            <td scope="row">{{$categoria->id}}</td>
            <td>{{$categoria->nombre}}</td>
            <td> @include('component.crudbtn',[
                'recurso' => 'categorias',
                'id' => $categoria->id
        ])</td>

        </tr>
            @endforeach
            @endisset
        </tbody>
        <!--Table body-->
    </table>
    <!--Table-->


@endsection