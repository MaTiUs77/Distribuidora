<template>
  <div>

    <!-- CONFIRM DELETE -->
    <el-popover
            ref="popDelete"
            placement="right"
            width="160"
            v-model="popDeleteVisible">
      <p>Confirma la eliminacion?</p>
      <div style="text-align: right; margin: 0">
        <el-button size="mini" type="text" @click="popDeleteVisible = false">cancelar</el-button>
        <el-button type="primary" size="mini" @click="confirmDelete">confirmar</el-button>
      </div>
    </el-popover>

    <!-- EDITAR -->
    <el-popover
            ref="popEdit"
            placement="right"
            width="160"
            v-model="popEditVisible">
      <p>Esta opcion no esta disponible</p>
      <div style="text-align: right; margin: 0">
        <el-button size="mini" type="text" @click="popEditVisible = false">aceptar</el-button>
      </div>
    </el-popover>

    <!-- BTN CRUD -->
    <el-button-group>
      <el-button type="info" icon="edit" size="small" v-popover:popEdit ></el-button>
      <el-button type="danger" icon="delete" size="small" @click="confirmDelete" :loading="isDeleting"></el-button>
    </el-button-group>
  </div>
</template>

<script>
  export default {
    props: ['action','elemento'],
    data() {
      return {
        popDeleteVisible: false,
        popEditVisible: false,
        isDeleting: false
      };
    },
    methods: {
      confirmDelete(e) {
        this.$confirm('Se eliminara permanentemente. Desea continuar?', 'Atencion', {
            confirmButtonText: 'Si',
            cancelButtonText: 'Cancelar',
            type: 'warning'
          }).then(() => {
            this.startDelete(e);
          });
      },
      startDelete(e) {
        let deleteRoute =  this.action+'/'+this.elemento.id;
        this.popDeleteVisible = false;
        this.isDeleting = true;

        axios.post(deleteRoute,{
            _method: 'DELETE'
          })
           .then(response => {
            this.isDeleting = false;
            // Carga tabla $parent
            this.$parent.loadTable();
        })
        .catch(e => {
            this.isDeleting = false;

            let bodyMessage = e.response.data.message;

            this.$notify({
              message: bodyMessage,
              type: 'error'
            });
        });

      }
    }
  }
</script>