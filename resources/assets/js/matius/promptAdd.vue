<template>
  <div>
    <a href="javascript:;" class="btn btn-primary" data-toggle="modal" data-target="#vueModalCreate">
      <i class="fa fa-plus"></i>
      Agregar
      <span class="hidden-xs">
        {{ recurso }}
      </span>
    </a>

    <!-- Modal -->
    <div id="vueModalCreate" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Agregar {{ recurso }}</h4>
          </div>
          <div class="modal-body">
            <slot></slot>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" data-dismiss="modal"><i class="fa fa-plus"></i>  Crear</button>
          </div>
        </div>

      </div>
    </div>

  </div>
</template>

<script>
export default {
  props: ['recurso'],
  data () {
    return {
//      texto: 'Agregar'
    }
  },
  mounted() {
      console.log('Component mounted.')
  },
  methods: {
    componentMethod () {
      console.log('componentMethod.')
    }
  },
  computed: {
    componentComputed () {
      console.log('componentComputed.')
    }
  }
}
</script>