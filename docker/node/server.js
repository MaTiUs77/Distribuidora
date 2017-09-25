var redis = require('redis');
var express = require('express');
var app = express();
var server = require('http').Server(app);
var io = require('socket.io')(server);

var messages = [{
  id: 1,
  text: "Hola soy un mensaje",
  author: "Carlos Azaustre"
}];

var client = redis.createClient(6379,"redis");

app.use(express.static('public'));

app.get('/', function(req, res) {
  res.status(200).send("Hello World!");
});

io.on('connection', function(socket) {
  console.log('Alguien se ha conectado con Sockets');
  socket.emit('messages', messages);

  socket.on('new-message', function(data) {
    messages.push(data);

    io.sockets.emit('messages', messages);
  });
});

server.listen(8080, function() {
  console.log("Servidor corriendo en http://localhost:8080");
});

client.on('error', function(err){
  console.log('Something went wrong ', err)
});

client.set('online', 'Redis online', redis.print);
client.get('online', function(error, result) {
  if (error) throw error;
  console.log('GET result ->', result)
});
