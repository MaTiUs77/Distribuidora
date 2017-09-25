var app = angular.module('SytemApp', []);

app.controller('Terminal', function($scope) {
    $scope.productos = [];

    console.log('Terminal controller iniciado');

    $scope.findByCodigo = function(codigoProducto)
    {
        if(codigoProducto!=undefined)
        {
            console.log(codigoProducto);
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
