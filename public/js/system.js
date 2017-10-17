var app = angular.module('SytemApp', []);

app.directive('myEnter', function () {
    return function (scope, element, attrs) {
        element.bind("keydown keypress", function (event) {
            if(event.which === 13) {
                console.log(element,event);

                scope.$apply(function (){
                    scope.$eval(attrs.myEnter);

                    console.log('OK EVAL MyEnter');

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
