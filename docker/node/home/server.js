var express = require('express');
var app = express();
var server = require('http').Server(app);
var io = require('socket.io')(server);

var terminal = require('./src/Terminal');

app.use(express.static('public'));

app.get('/', function(req, res) {
  res.status(200).send("Servidor NodeJs Online");
});

io.on('connection', function(socket) {
  terminal.init(app,socket);
  
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
  console.log("Servidor Node en http://localhost:8080");
});
