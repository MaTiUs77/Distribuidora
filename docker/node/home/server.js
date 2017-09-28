var redis = require('redis');
var express = require('express');
var app = express();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var http = require('http');

var client = redis.createClient(6379,"redis");

app.use(express.static('public'));

app.get('/', function(req, res) {
  res.status(200).send("Servidor NodeJs Online");
});

app.get('/buscar/producto', function(req, res) {
  var termino = req.query.term;
  var args2 = ["movies", "["+termino, '('+termino+'\xff', 'LIMIT', "0", "2"];
  client.zrangebylex(args2, function(err, response) {
    if (err) throw err;
    console.log(response);
    res.json(response);
  });
});

io.on('connection', function(socket) {
  client.on('error', function(err){
    console.log('Something went wrong ', err)
  });

  console.log('Nuevo cliente en Socket.io');
  socket.emit('redis', "Bienvenido a Socket.io");

  var redisub = redis.createClient(6379,"redis");
  redisub.subscribe("venta");

  redisub.on("error", function(){
    console.log("Error al subscribir");
  })

  redisub.on('message', function(channel,data){
    console.log(channel, data)
    socket.emit('ventaUpdated', data);
  });

  client.get('venta', function(error, data) {
    if (error) throw error;
    socket.emit('ventaUpdated', data);
  });

   socket.on('buscarProducto', function(termino) {

     console.log(termino);
     socket.emit('buscarProductoResponse', termino);
   });

  /*
  socket.on('testAutocomplete', function(termino) {
    var args2 = ["movie", "["+termino, '('+termino+'\xff', 'LIMIT', "0", "2"];

    console.log (args2);
    client.zrangebylex(args2, function(err, response) {
      if (err) throw err;
      console.log(response);
      socket.emit('buscarProductoResponse', response);
    });
  });
 */

});

server.listen(8080, function() {
  console.log("Servidor corriendo en http://localhost:8080");
});
