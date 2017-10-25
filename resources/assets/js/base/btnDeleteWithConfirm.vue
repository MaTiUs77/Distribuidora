<template>
  <div>
    <el-popover
            ref="popover"
            placement="right"
            width="160"
            v-model="popVisible">
      <p>Confirma la eliminacion?</p>
      <div style="text-align: right; margin: 0">
        <el-button size="mini" type="text" @click="popVisible = false">cancelar</el-button>
        <el-button type="primary" size="mini" @click="confirmDelete">confirmar</el-button>
      </div>
    </el-popover>

    <el-button type="danger" icon="delete" size="small" v-popover:popover :loading="isDeleting">Borrar</el-button>
  </div>
</template>

<script>
  export default {
    props: ['action','elemento'],
    data() {
      return {
        popVisible: false,
        isDeleting: false
      };
    },
    methods: {
      confirmDelete(e) {
        let deleteRoute =  this.action+'/'+this.elemento.id;
        this.popVisible = false;
        this.isDeleting = true;

        axios.post(deleteRoute,{
            _method: 'DELETE'
          })
           .then(response => {
            this.isDeleting = false;

            this.$message({
              message: 'Eliminado con exito.',
              type: 'success'
            });

            this.$parent.loadTable();
        })
        .catch(e => {
            this.isDeleting = false;

            this.$notify({
              title: 'Error',
              message: e.message,
              type: 'danger'
            });

          this.errors.push(e)
        });

      }
    }
  }
</script>