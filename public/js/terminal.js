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

    console.log('Terminal con Socket.io');

    var socket = io.connect('http://'+$scope.nodeHost, { 'forceNew': true });

    socket.on('nodeserver', function(data) {
        console.log("Client on nodeserver",data);
    });

    // Inicializo la terminal con la ID de venta
    $scope.init = function(venta_id)
    {
        $scope.venta_id = venta_id;
    };

    socket.on('addByCodigoResponse', function(data) {
        console.log("Client on addByCodigoResponse",data);

        console.log(data);

        if(data.error!=undefined)
        {
            swal(data.error, "", "error");
        } else {
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
});

app.directive('myEnter', function () {
    return function (scope, element, attrs) {
        element.bind("keydown keypress", function (event) {
            if(event.which === 13) {
                scope.$apply(function (){
                    scope.$eval(attrs.myEnter);
                });

                element.val('');

                event.preventDefault();
            }
        });
    };
});
