<template>
  <div>

    <el-button @click="visible = true">
      <i class="fa fa-plus"></i>
      {{ titulo }}
    </el-button>

    <el-dialog v-bind:title="titulo" :visible.sync="visible" @open="onDialogOpen">

      <form role="form" method="post" @action="action" @submit.prevent="submitForm">
        <slot></slot>
      </form>
    </el-dialog>
<!--
    &lt;!&ndash; Modal &ndash;&gt;
    <div id="vueModalCreate" class="modal fade onmodal" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">{{ titulo }}</h4>
          </div>
          <div class="modal-body">
            &lt;!&ndash; Modal Body&ndash;&gt;

            <form role="form" method="post" @action="action" @submit.prevent="submitForm">
              <slot></slot>

              <input v-model="form.nombre" class="form-control input-lg autofocus" type="text" required placeholder="Ingresar nombre de">

            </form>

            &lt;!&ndash; Modal Body&ndash;&gt;
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" @click="submitForm" data-dismiss="modal"><i class="fa fa-plus"></i>  Crear</button>
          </div>
        </div>

      </div>
    </div>
-->
    <!-- END Modal -->

  </div>
</template>

<script>

  export default {
    props: ['titulo','action','form'],
    data () {
      return {
        visible : false,
        montoto : false
      }
    },
    mounted() {
      console.log('Component mounted.');
    },
    methods: {
      notificar() {
        this.$message({
          message: 'Agregado con exito.',
          type: 'success'
        });

        this.form.nombre = '';
        this.$parent.loadTable();
      },
      onDialogOpen() {
        // Al abrir el dialogo
      },
      submitForm(e) {
        console.log('Submiting form');

        axios.post(this.action,this.form)
          .then(response => {
            this.visible = false;
            this.notificar();
          })
          .catch(e => {
            this.errors.push(e)
        });
      }
    }
  }
</script>
x