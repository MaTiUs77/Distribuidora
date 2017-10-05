var redis = require('redis');

var client;
var redisub;

var rp = require('request-promise');

var app,socket;


function init(_app,_socket)
{
  socket = _socket;
  app = _app;

  client = redis.createClient(6379,"redis");
  redisub = redis.createClient(6379,"redis");
  redisub.subscribe("venta");

  client.on('error', function(err){
    console.log('Algo salio mal con Redis', err)
  });

  console.log('Terminal iniciada con Socket.io');
  socket.emit('nodeserver', "Terminal iniciada con Socket.io");

  setRedisActions();

  socketActions();
}

function setRedisActions()
{
  redisub.on("error", function(){
    console.log("Error al subscribir");
  });

  // Permite escuchar el canal de comunicacion de Redis
  redisub.on('message', function(channel,data){
    console.log('redisMessage',channel, data);
    socket.emit('redisMessageChannel', JSON.parse(data));
  });

  // Al ingresar obtiene de redis la ultima imagen de la factura
  client.get('venta', function(error, data) {
    if (error) throw error;
    socket.emit('redisMessageChannel', JSON.parse(data));
  });
}

function socketActions()
{
  socket.on('disconnect', function () {
    console.log('Socket desconectado');

    redisub.quit();
    redisub.unsubscribe();
    client.quit();
  });


  socket.on('addByCodigo', function(codigoProducto,venta_id)
  {
    console.log("Action addByAcodigo",codigoProducto,venta_id);

    addByCodigo(codigoProducto,venta_id).then(function (result) {
        // En este punto, el api de laravel ya se comunico con redis y lo actualizo,
        // no es necesario hacer nada, ya que node esta escuchando el canal de redis y actualizo el front
        // Logueo solo para ver el retorno del api en laravel
        console.log("addByCodigoResponse",result);

        // Puedo emitir una respuesta de node, para que el front haga otra cosa
        socket.emit('updateFacturacion', result);
      })
      .catch(function (err) {
        console.log("No se pudo acceder al API");
      });
  });

  socket.on('removeDetalleId', function(detalle_id,venta_id)
  {
    console.log("Action removeDetalleId",detalle_id,venta_id);
    removeDetalleId(detalle_id,venta_id).then(function (result) {
        console.log("removeDetalleIdResponse",result);

        // Puedo emitir una respuesta de node, para que el front haga otra cosa
        socket.emit('updateFacturacion', result);
      })
      .catch(function (err) {
        console.log("No se pudo acceder al API");
      });
  });
}

function addByCodigo(codigoProducto,venta_id)
{
  var cantidad = 1;

  var options = {
    uri: 'http://web/api/terminal/add/'+venta_id+'/'+cantidad+'/'+codigoProducto,
    headers: {
      'User-Agent': 'Request-Promise'
    },
    json: true
  };

  return rp(options);
}

function removeDetalleId(detalle_id,venta_id)
{
  var options = {
    uri: 'http://web/api/terminal/remove/'+detalle_id,
    headers: {
      'User-Agent': 'Request-Promise'
    },
    json: true
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