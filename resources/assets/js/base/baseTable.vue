<template>
  <div>
    <div class="box">
      <div class="box-header">
        <h3 class="box-title">Lista de {{ titulo }}</h3>

        <div class="pull-right">

          <modal-bootstrap :titulo="promptbtn" :action="action" :form="form">
            <input v-model="form.nombre" class="form-control input-lg autofocus" type="text" required>
          </modal-bootstrap>

        </div>

      </div>
      <div class="box-body no-padding" v-loading.body="tableLoading" element-loading-text="Cargando...">
        <table class="table table-striped">
          <thead>
          <tr>
            <th style="width: 10px"></th>
            <th style="width: 120px">Acciones</th>
            <th v-for="columna in columnas">{{ columna | capitalize }}</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="item in tableData">
            <td>
              <el-checkbox></el-checkbox>
            </td>
            <td>
              <btn-delete-confirm :elemento="item" :action="action"></btn-delete-confirm>
            </td>
            <td v-for="columna in columnas" v-text="item[columna]"></td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: ['titulo','action','load','columnas'],
    data () {
      return {
        form: {},

        isDeleting: true,
        tableLoading: true,
        promptbtn: '',

        checkAll: true,
        isIndeterminate: true,

        errors: [],
        tableData: []

      }
    },
    mounted() {
      this.promptbtn = 'Agregar '+this.titulo;
      this.loadTable();
    },
    methods: {
      loadTable() {
        this.tableLoading = true;

        axios.get(this.load)
        .then(response => {
          this.tableData = response.data;
          this.tableLoading = false;
        })
        .catch(e => {
          this.errors.push(e);
          this.tableLoading = false;
        });
      },
      btnDelete() {
        this.isDeleting = true;
      }
    },
    filters: {
      capitalize: function (value) {
        if (!value) return ''
        value = value.toString()
        return value.charAt(0).toUpperCase() + value.slice(1)
      }
    }
  }
</script>