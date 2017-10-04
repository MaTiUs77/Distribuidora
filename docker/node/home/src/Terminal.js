var redis = require('redis');

var client = redis.createClient(6379,"redis");
var rp = require('request-promise');

var app,socket;

function init(_app,_socket)
{
  socket = _socket;
  app = _app;

  client.on('error', function(err){
    console.log('Algo salio mal con Redis', err)
  });

  console.log('Terminal iniciada con Socket.io');
  socket.emit('nodeserver', "Terminal iniciada con Socket.io");

  socketActions();
//  setRoutes();
}

function socketActions()
{
  socket.on('buscarProducto', function(termino)
  {
    buscarProducto().then(function (result) {
        console.log("buscarProductoResponse",result);
        socket.emit('buscarProductoResponse', result);
      })
      .catch(function (err) {
        console.log("No se pudo buscar el producto",err.message);
      });
  });
}

function buscarProducto(termino) {
  var options = {
    uri: 'http://localhost/api/terminal/add',
    qs: {
      termino: termino
    },
    headers: {
      'User-Agent': 'Request-Promise'
    },
    json: true // Automatically parses the JSON string in the response
  };

  return rp(options);
}

/*
function setRoutes()
{
  app.get('/buscar/producto', function(req, res) {
    var termino = req.query.term;
    var args2 = ["movies", "["+termino, '('+termino+'\xff', 'LIMIT', "0", "2"];
    client.zrangebylex(args2, function(err, response) {
      if (err) throw err;
      console.log(response);
      res.json(response);
    });
  });
}
*/

module.exports = {
  init : init
};

/*
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

 */