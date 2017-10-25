<base-table :columnas="['Nombre']" titulo="{{ ucfirst($resource) }}" load="{{ url('api/datatable/'.$resource) }}" action="{{ route($resource.'.index') }}"></base-table>

{{--
@if($items instanceof  \Illuminate\Pagination\LengthAwarePaginator)
  <div class="text-center">
    {{ $items->links() }}
  </div>
@endif
--}}

{{--
@section('footer')
  <script>
    $(function(){
      $('.onmodal').on('shown.bs.modal', function (e) {
        var el = $('.autofocus');
        el.focus();
        console.log(el);
      });
    });
  </script>
@endsection--}}
