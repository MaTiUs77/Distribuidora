@extends('layouts.adminlte')

@section('contenido')

    <div class="container">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Cambiar cliente para la venta</h3>
            </div>
            <div class="box-body">
                <form class="form-horizontal" role="form" method="post" action="{{ route('ventas.update',$venta->id) }}">

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="PUT" />

                    <input class="form-control input-lg" type="text" name="cliente" id="cliente" required placeholder="Nombre" value="{{$venta->cliente->name}}">
                    <input class="form-control input-lg" type="hidden" name="cliente_id" id="cliente_id">
                    <br>

                    <div class="text-center">
                        <button class="btn btn-success"><i class="fa fa-edit"></i> Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection



@section('footer')

    <script >

        $(function() {
            $("#cliente").autocomplete({
                source: "{{ url("api/autocomplete/clientes") }}",
                minLength: 2,
                select: function (event, ui) {
                    console.log(ui.item.id);
                    $('#cliente').val(ui.item.name);
                    $('#cliente_id').val(ui.item.id);
                }
            });
        });

    </script>


@endsection