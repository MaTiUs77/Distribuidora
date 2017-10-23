require('./bootstrap');
window.Vue = require('vue');

import Vue from 'vue'

Vue.component('prompt-add', require('./matius/promptAdd.vue'));

const root = new Vue({
    el: '#root',
    data: {
//        title: "Montoto"
    },
    created() {
        console.log('Root vue created');
    }
});
