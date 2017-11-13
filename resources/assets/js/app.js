window.Vue = require('vue');

import Vue from 'vue'

import 'element-ui/lib/theme-default/index.css'
import ElementUI from 'element-ui'
Vue.use(ElementUI);

import VueHotkey from 'v-hotkey'
Vue.use(VueHotkey);

import fullscreen from 'vue-fullscreen'
Vue.use(fullscreen);

Vue.directive('focus', {
  inserted: function (el) {
    el.focus();
  }
});

Vue.component('uploadImage', require('./base/uploadImage.vue'));
Vue.component('btnDeleteConfirm', require('./base/btnDeleteWithConfirm.vue'));
Vue.component('modalBootstrap', require('./base/modalBootstrap.vue'));
Vue.component('baseTable', require('./base/baseTable.vue'));

Vue.component('terminal', require('./base/terminal.vue'));

const root = new Vue({
  el: '#root',
  data: {
    form: {'nombre' : '','direccion' : '', 'localidad' : '', 'tipo_identificacion' : '', 'provincia' : '', 'codigo_postal' : '', 'pais': 'ARGENTINA','numero_identificacion':''},
    infoAfip: [],
    alerta : '',
    buscando : ''
  },
  created() {
    console.log('Root vue created');
  },
  methods: {
    getInfoAfip : function () {
      this.numero_identificacion = $("#numero_identificacion").val();
      this.alerta = '';

      if(this.numero_identificacion.length == 11){
        var ruta = '/afip/persona/'+this.numero_identificacion;
        this.buscando = "BUSCANDO...";
        axios.get(ruta).then(response => {
        this.buscando = '';
        this.infoAfip = response.data;
        this.form.nombre = this.infoAfip.data.nombre;
        this.form.direccion = this.infoAfip.data.domicilioFiscal.direccion;
        this.form.localidad = this.infoAfip.data.domicilioFiscal.localidad;
        this.form.codigo_postal= this.infoAfip.data.domicilioFiscal.codPostal;
        this.form.tipo_identificacion = this.infoAfip.data.tipoClave;
      })
      }else{
        this.alerta = 'numero de cuil invalido';
      }
    }
  }
});

