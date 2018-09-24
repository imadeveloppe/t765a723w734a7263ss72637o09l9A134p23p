angular.module('app.directives', [])

.directive('textarea', function() {
  return {
    restrict: 'E',
    link: function(scope, element, attr){
        var update = function(){
            element.css("height", "auto");
            var height = element[0].scrollHeight; 
            element.css("height", element[0].scrollHeight + "px");
        };
        scope.$watch(attr.ngModel, function(){
            update();
        });
    }
  };
})

// .directive("directive", function() {
//     return {
//         restrict: "A",
//         require: "ngModel",
//         link: function(scope, element, attrs, ngModel) {

//             function read() {
//                 // view -> model
//                 var html = element.html();
//                 html = html.replace(/&nbsp;/g, "\u00a0");
//                 ngModel.$setViewValue(html);
//             }
//             // model -> view
//             ngModel.$render = function() {
//                 element.html(ngModel.$viewValue || "");
//             };

//             element.bind("blur", function() {
//                 scope.$apply(read);
//             });
//             element.bind("keydown keypress", function (event) {
//                 // if(event.which === 13) {
//                 //     this.blur();
//                 //     event.preventDefault();
//                 // }
//             });
//         }
//     };
// })

.filter('html',function($sce){
    return function(input){
        return $sce.trustAsHtml(input);
    }
})