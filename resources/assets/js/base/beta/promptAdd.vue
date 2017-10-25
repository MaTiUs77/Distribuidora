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