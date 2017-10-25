<div class="dropdown">
    <button class="btn btn-primary btn-xs dropdown-toggle" type="button" data-toggle="dropdown">Acciones
        <span class="caret"></span></button>
    <ul class="dropdown-menu">

        @if(isset($modalEdit))
        <li>
            <a href="#" class="abmEdit" data-toggle="modal" data-target="#modalEdit" data-id="{{ $item->id }}" data-nombre="{{ $item->nombre }}">
                <i class="fa fa-edit"></i>
                Editar
            </a>
        </li>
        @else
            <li>
                <a href="{{ route($resource.'.edit',$item->id) }}">
                    <i class="fa fa-edit"></i>
                    Editar
                </a>
            </li>
        @endif

        @yield('component.abm.btn.option')

        <li class="divider"></li>
        <li>
            <a href="javascript:{{ $resource }}_delete({{$item->id}});">
                <i class="fa fa-trash"></i>
                Eliminar
            </a>
        </li>
    </ul>
</div>

<form id="form_{{ $resource }}_{{ $item->id }}" method="POST" action="{{ route($resource.'.destroy',$item->id) }}">
  {{ csrf_field() }}
  <input type="hidden" name="_method" value="delete" />
</form>

@if ($loop->first)

    @section('footer')
        @parent
        <!-- Modal -->
        <div id="modalEdit" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Editar <span id="editId"></span></h4>
                    </div>
                    <div class="modal-body">
                        <form id="formEdit" class="form-horizontal" role="form" method="post" action="#">

                            {{ csrf_field() }}
                            <input type="hidden" name="_method" value="PUT" />

                            <input id="inputEditNombre" class="form-control input-lg" type="text" name="name" required placeholder="Nombre">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="abmEditSubmit btn btn-success" data-dismiss="modal" onclick="$('#formEdit').submit();"><i class="fa fa-edit"></i> Actualizar</button>
                    </div>
                </div>

            </div>
        </div>

        <script>
            function {{ $resource }}_delete(id) {
                swal({
                  title: "Confirma eliminar?",
                  text: "No podra recuperar esta informacion!",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "Si, eliminar!",
                  cancelButtonText: "Cancelar",
                  closeOnConfirm: false
                },
                function(){
                  $('#form_{{ $resource }}_'+id).submit();
                });
            }

            $(document).on("click", ".abmEdit", function () {
                var editId = $(this).data('id');
                var editNombre = $(this).data('nombre');
                $(".modal-header #editId").text( editId);
                $(".modal-body #inputEditNombre").val( editNombre);

                var actionUrl = '{{ url($resource) }}/'+editId;
                console.log(actionUrl);
                $('#formEdit').attr('action',actionUrl);
            });

            $('#modalEdit').on('shown.bs.modal', function () {
                $('#inputEditNombre').focus();
            });
        </script>
    @endsection
@endif