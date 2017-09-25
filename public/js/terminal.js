var app = angular.module('SytemApp', []);

app.controller('Terminal', function($scope) {
    $scope.productos = [];

    console.log('Terminal con SocketIo');

    var socket = io.connect('http://localhost:8080', { 'forceNew': true });

    socket.on('redis', function(data) {
        console.log("Redis",data);
    });

    $scope.findByCodigo = function(codigoProducto)
    {
        if(codigoProducto!=undefined)
        {
            console.log(codigoProducto);
            socket.emit('new-message', codigoProducto);

            $scope.productos.push('que onda');
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
