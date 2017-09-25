var redis = require('redis');
var express = require('express');
var app = express();
var server = require('http').Server(app);
var io = require('socket.io')(server);

var client = redis.createClient(6379,"redis");

app.use(express.static('public'));

app.get('/', function(req, res) {
  res.status(200).send("Hello World!");
});

io.on('connection', function(socket) {
  console.log('Alguien se ha conectado con Sockets');

  client.on('error', function(err){
    console.log('Something went wrong ', err)
  });
//client.set('name', 'Redis online', redis.print);
  client.get('name', function(error, result) {
    if (error) throw error;
    socket.emit('redis', result);
  });

  socket.emit('redis', "Hola desde SocketIO");

/*  socket.on('new-message', function(data) {
    io.sockets.emit('messages', messages);
  });*/
});

server.listen(8080, function() {
  console.log("Servidor corriendo en http://localhost:8080");
});

