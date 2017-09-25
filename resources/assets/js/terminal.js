var app = angular.module('SytemApp', []);

app.controller('Terminal', function($scope, $locale) {
    $scope.beers = [0, 1, 2, 3, 4, 5, 6];

    console.log('Terminal',$scope.beers);
});
