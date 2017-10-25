<base-table
        titulo="{{ ucfirst($resource) }}"
        load="{{ url('api/datatable/'.$resource) }}"
        action="{{ route($resource.'.index') }}"
        :columnas="['nombre']"
        :form="form">

        <input v-model="form.nombre" class="form-control input-lg autofocus" type="text" placeholder="Ingresar nombre" required>

</base-table>
