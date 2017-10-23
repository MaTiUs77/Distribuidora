<template>
  <div>
    <v-stepper v-model="e1">
      <v-stepper-header>
        <v-stepper-step step="1" :complete="e1 > 1">Seleccionar Persona</v-stepper-step>
        <v-divider></v-divider>
        <v-stepper-step step="2" :complete="e1 > 2">Alta de persona</v-stepper-step>
        <v-divider></v-divider>
        <v-stepper-step step="3" :complete="e1 > 3">Inscribir</v-stepper-step>
        <v-divider></v-divider>
        <v-stepper-step step="4">Constancia de inscripcion</v-stepper-step>
      </v-stepper-header>

      <v-stepper-content step="1">

        <form_basic></form_basic>

        <v-btn color="primary" @click.native="e1 = 2">Continue</v-btn>
        <v-btn flat>Cancel</v-btn>
      </v-stepper-content>

      <v-stepper-content step="2">

        <form_validation_with_submit></form_validation_with_submit>
        <v-btn color="primary" @click.native="e1 = 3">Continue</v-btn>
        <v-btn flat @click.native="e1 = 1">Volver</v-btn>
      </v-stepper-content>

      <v-stepper-content step="3">
        <v-btn color="primary" @click.native="e1 = 4">Continue</v-btn>
        <v-btn flat>Cancel</v-btn>
      </v-stepper-content>

      <v-stepper-content step="4">
        <v-btn color="success" @click.native="e1 = 1">Imprimir constancia</v-btn>
        <v-btn flat>Cancel</v-btn>
      </v-stepper-content>

    </v-stepper>
  </div>
</template>

<script>
  export default {
    data () {
      return {
        e1: 0
      }
    }
  }
</script>
