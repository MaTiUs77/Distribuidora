@extends('layouts.adminlte')

@section('contenido')

    <div class="container">
        <div class="box box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Asignar cliente</h3>
            </div>
            <div class="box-body">
                <form role="form" method="post" action="{{ route('ventas.store') }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input class="form-control input-lg" type="text" name="cliente" id="cliente" required placeholder="Cliente">
                    <input type="hidden" name="cliente_id" id="id">
                    <br>
                    <div class="text-center">
                        <button class="btn btn-success" id="Assignar"><i class="fa fa-plus"></i>Assignar</button>
                    </div>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
    </div>

@endsection

@section('footer')
<script >

    $(function() {
        $("#cliente").autocomplete({
            source: "ventas/search/autocomplete",
            minLength: 2,
            select: function (event, ui) {
                console.log(ui.item.id);
                $('#cliente').val(ui.item.name);
                $('#id').val(ui.item.id);
            }
        });
        });

</script>


@endsection