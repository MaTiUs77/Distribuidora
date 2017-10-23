require('./bootstrap');
window.Vue = require('vue');

import Vue from 'vue'

import VueHotkey from 'v-hotkey'
import Vuetify from 'vuetify'

Vue.use(Vuetify);
Vue.use(VueHotkey);

//Vue.component('terminal', require('./components/TerminalComponent.vue'));

Vue.component('autocomplete_personas', require('./components/autocompletePersonas.vue'));
Vue.component('inscripcion_alumno', require('./components/inscripcionAlumno.vue'));

Vue.component('inscripcion_stepper', require('./components/inscripcionStepper.vue'));

Vue.component('datepicker', require('./components/ejemplo/pickers/date-internationalization.vue'));
Vue.component('form_basic', require('./components/ejemplo/forms/basic-validation.vue'));
Vue.component('form_validation_with_submit', require('./components/ejemplo/forms/validation-with-submit-and-clear.vue'));

const app = new Vue({
    el: '#app',
    data: {
        title: "Montoto"
    },
    created() {
        console.log('App created');
    }
});
