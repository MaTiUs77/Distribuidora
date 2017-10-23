<!DOCTYPE html>
<html>
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">

  <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
  <link href="{{ mix('css/vuetify.min.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
  <v-app>
        <inscripcion_stepper></inscripcion_stepper>
  </v-app>
</div>

<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>