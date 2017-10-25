require('./bootstrap');
window.Vue = require('vue');

import Vue from 'vue'

import 'element-ui/lib/theme-default/index.css'
import ElementUI from 'element-ui'
Vue.use(ElementUI);

//import VueHotkey from 'v-hotkey'

//Vue.use(VueHotkey);

Vue.directive('focus', {
  inserted: function (el) {
    el.focus();
  }
});

Vue.component('btnDeleteConfirm', require('./base/btnDeleteWithConfirm.vue'));
Vue.component('promptAdd', require('./base/promptAdd.vue'));
Vue.component('baseTable', require('./base/baseTable.vue'));

const root = new Vue({
  el: '#root',
  created() {
    console.log('Root vue created');
  }
});