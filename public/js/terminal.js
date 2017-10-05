var app = angular.module('SytemApp', []);

app.controller('Terminal', function($scope)
{
    var addByCodigoInput = $('#addByCodigoInput');

    addByCodigoInput.submit(function (evt) {
        evt.preventDefault();
    });

    addByCodigoInput.focus();

    $scope.venta_id;

    $scope.nodeHost = 'localhost:8080';

    $scope.facturacion = {};
    $scope.cambioCalculado = 0;

    console.log('Terminal con Socket.io');

    var socket = io.connect('http://'+$scope.nodeHost, { 'forceNew': true });

    socket.on('nodeserver', function(data) {
        console.log("Client on nodeserver",data);
    });

    // Inicializo la terminal con la ID de venta
    $scope.init = function(venta_id)
    {
        $scope.venta_id = venta_id;

        socket.emit('setVentaId', $scope.venta_id);
    };

    socket.on('redisMessageChannel', function(data) {
        console.log("Client on redisMessageChannel",data);
        $scope.facturacion = data;
        $scope.$digest();
    });

    socket.on('updateFacturacion', function(data) {
        console.log("Client on updateFacturacion",data);

        if(data.error!=undefined)
        {
            console.log("Client on updateFacturacion error",data);
            swal(data.error, "", "error");
        } else
        {
            $scope.facturacion = data.resumen;
            $scope.$digest();
        }
    });

    // Agrega productos a la venta_id segun el barcode solicitado
    $scope.addByCodigo= function(codigoProducto)
    {
        console.log("Client addByCodigo",codigoProducto,$scope.venta_id);

        if(codigoProducto!=undefined)
        {
            socket.emit('addByCodigo', codigoProducto, $scope.venta_id);
        }
    };

    // Agrega productos a la venta_id segun el barcode solicitado
    $scope.removeDetalleId= function(detalle_id)
    {
        console.log("Client removeDetalleId",detalle_id,$scope.venta_id);
        socket.emit('removeDetalleId', detalle_id, $scope.venta_id);
    };

    // Calcula el cambio segun el monto recibido
    $scope.calcularCambio= function()
    {
        console.log("Calculando cambio",$scope.montoRecibido);
        var calculo = $scope.montoRecibido - $scope.facturacion.costoTotal;
        $scope.cambioCalculado = calculo;
    };

    $scope.cambioInsuficiente= function()
    {
        if($scope.cambioCalculado < 0)
        {
            console.log('Insuficiente');
            return true;
        } else {
            return false;
        }
    };


});

app.directive('myEnter', function () {
    return function (scope, element, attrs) {
        element.bind("keydown keypress", function (event) {
            if(event.which === 13) {
                console.log(element,event);

                scope.$apply(function (){
                    scope.$eval(attrs.myEnter);

                    var blank = scope.$eval(attrs.myEnterBlank);
                    if(blank)
                    {
                        element.val('');
                    }
                });

                event.preventDefault();
            }
        });
    };
});
