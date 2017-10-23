/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(1);


/***/ }),
/* 1 */
/***/ (function(module, exports) {

var app = angular.module('SytemApp', []);

app.controller('Terminal', function ($scope) {
    var addByCodigoInput = $('#addByCodigoInput');

    addByCodigoInput.submit(function (evt) {
        evt.preventDefault();
    });

    addByCodigoInput.focus();

    $scope.venta_id;

    $scope.nodeHost = 'localhost:8080';

    $scope.facturacion = {};
    $scope.cambioCalculado = 0;
    var socket;

    // Inicializo la terminal con la ID de venta
    $scope.init = function (venta_id, host) {
        $scope.venta_id = venta_id;
        if (host != undefined) {
            $scope.nodeHost = host;
        }

        console.log('Terminal con Socket.io');
        socket = io.connect('http://' + $scope.nodeHost, { 'forceNew': true });

        socket.on('nodeserver', function (data) {
            console.log("Client on nodeserver", data);
        });
        socket.on('redisMessageChannel', function (data) {
            console.log("Client on redisMessageChannel", data);
            $scope.facturacion = data;
            $scope.$digest();
        });

        socket.on('updateFacturacion', function (data) {
            console.log("Client on updateFacturacion", data);

            if (data.error != undefined) {
                console.log("Client on updateFacturacion error", data);
                swal(data.error, "", "error");
            } else {
                $scope.facturacion = data.resumen;
                $scope.$digest();
            }
        });

        socket.emit('setVentaId', $scope.venta_id);
    };

    // Agrega productos a la venta_id segun el barcode solicitado
    $scope.addProducto = function () {
        console.log("Client addProducto", $scope.venta_id, $scope.codigoProducto, $scope.cantidadProducto);

        if ($scope.codigoProducto != undefined && $scope.cantidadProducto > 0) {
            socket.emit('addProducto', $scope.venta_id, $scope.codigoProducto, $scope.cantidadProducto);

            $scope.codigoProducto = '';
            $scope.cantidadProducto = 1;
            $('#codigoProducto').focus();
        }
    };

    // Agrega productos a la venta_id segun el barcode solicitado
    $scope.removeDetalleId = function (detalle_id) {
        console.log("Client removeDetalleId", detalle_id, $scope.venta_id);
        socket.emit('removeDetalleId', detalle_id, $scope.venta_id);
    };

    // Calcula el cambio segun el monto recibido
    $scope.calcularCambio = function () {
        console.log("Calculando cambio", $scope.montoRecibido);
        var calculo = $scope.montoRecibido - $scope.facturacion.costoTotal;
        $scope.cambioCalculado = calculo;
    };

    $scope.cambioInsuficiente = function () {
        if ($scope.cambioCalculado < 0) {
            console.log('Insuficiente');
            return true;
        } else {
            return false;
        }
    };

    $scope.functionKey = function ($event) {
        var key = $event.keyCode;

        switch (key) {
            case 113:
                // F2
                console.log("Finalizar venta");
                return false;
                break;
            case 114:
                // F3
                console.log(key);
                return false;
                break;
            case 115:
                // F4
                console.log(key);
                return false;
                break;
            default:
                console.log(key);
                break;
        }
    };
});

app.directive('myEnter', function () {
    return function (scope, element, attrs) {
        element.bind("keydown keypress", function (event) {
            if (event.which === 13) {
                console.log(element, event);

                scope.$apply(function () {
                    scope.$eval(attrs.myEnter);

                    console.log('OK EVAL MyEnter');

                    var blank = scope.$eval(attrs.myEnterBlank);
                    if (blank) {
                        element.val('');
                    }
                });

                event.preventDefault();
            }
        });
    };
});

/***/ })
/******/ ]);