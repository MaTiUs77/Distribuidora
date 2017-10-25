<template>
  <div>

    <el-button type="primary" v-bind:title="titulo" data-toggle="modal" data-target="#myModal">
      <i class="fa fa-plus"></i>
      {{ titulo }}
    </el-button>

    <!-- MODAL -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">{{ titulo }}</h4>
          </div>
          <div class="modal-body">
            <!-- Form -->
            <form role="form" method="post" @action="action" @submit.prevent="submitForm">
              <slot></slot>
            </form>
            <!-- end Form-->
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" @click="submitForm" data-dismiss="modal"><i class="fa fa-plus"></i>  Crear</button>
          </div>
        </div>
      </div>
    </div>
    <!-- END MODAL -->
  </div>
</template>

<script>

  export default {
    props: ['titulo','action','form'],
    data () {
      return {
        visible : false
      }
    },
    mounted() {
      this.autofocus();
    },
    methods: {
      // Realiza un foco al campo que tenga la clase autofocus en el modal
      autofocus() {
        $("#myModal").on('shown.bs.modal', function () {
          $("#myModal .autofocus").focus();
        });
      },
      // Enviar formulario
      submitForm(e) {

        axios.post(this.action,this.form).then(response => {
          $("#myModal").modal('hide');
          this.notificar();
        })
        .catch(e => {
//          this.errors.push(e);

          let bodyMessage = e.response.data.message;

          this.$notify({
            message: bodyMessage,
            type: 'error'
          });

      });
      },
      // Notifica que la operacion se realizo con exito
      notificar() {
        this.$message({
          message: 'Agregado con exito.',
          type: 'success'
        });

        // Limpia formulario y actualiza la tabla del $parent
        this.$parent.loadTable();
      }
    }
  }
</script>
x