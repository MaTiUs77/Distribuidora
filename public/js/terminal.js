var app = angular.module('SytemApp', []);

app.controller('Terminal', function($scope) {
    $scope.nodeHost = 'localhost:8080';
    $scope.facturacion = {};

    console.log('Terminal con Socket.io');

    var socket = io.connect('http://'+$scope.nodeHost, { 'forceNew': true });

    socket.on('nodeserver', function(data) {
        console.log("Client on nodeserver",data);
    });

    socket.on('ventaUpdated', function(data) {
        console.log("Client on ventaUpdated",data);

        $scope.facturacion = JSON.parse(data);
        console.log("Venta updated",$scope.facturacion);
        $scope.$digest();
    });

    socket.on('buscarProductoResponse', function(data) {
        console.log("Client on buscarProductoResponse",data);
    });

    $scope.findByCodigo = function(codigoProducto)
    {
        console.log("Client findByCodigo",codigoProducto);

        if(codigoProducto!=undefined)
        {
            socket.emit('buscarProducto', codigoProducto);
        }
    }
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
