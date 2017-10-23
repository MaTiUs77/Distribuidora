<template>
  <v-form v-model="valid">
    <v-text-field
      label="Nombre"
      v-model="name"
      :rules="nameRules"
      :counter="10"
      required
    ></v-text-field>
    <v-text-field
      label="E-mail"
      v-model="email"
      :rules="emailRules"
      required
    ></v-text-field>
  </v-form>
</template>

<script>
  export default {
    data () {
      return {
        valid: false,
        name: '',
        nameRules: [
          (v) => !!v || 'El nombre es requerido',
          (v) => v.length <= 10 || 'El nombre debe tener al menos 10 caracteres'
        ],
        email: '',
        emailRules: [
          (v) => !!v || 'E-mail es requerido',
          (v) => /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail debe ser valido'
        ]
      }
    }
  }
</script>
