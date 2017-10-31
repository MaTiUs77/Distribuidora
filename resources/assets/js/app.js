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
    form: {}
  },
  created() {
    console.log('Root vue created');
  }
});