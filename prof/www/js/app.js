// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
// 'starter.services' is found in services.js
// 'starter.controllers' is found in controllers.js
angular.module('app', ['ionic', 'app.controllers', 'app.routes', 'app.directives','app.services','pim.constant','ngCordova','ion-datetime-picker'])

.config(function($ionicConfigProvider, $sceDelegateProvider){
  
    $ionicConfigProvider.backButton.previousTitleText(false).text(''); 
  

  $sceDelegateProvider.resourceUrlWhitelist([ 'self','*://www.youtube.com/**', '*://player.vimeo.com/video/**']);

})
.config(function($ionicConfigProvider){
  $ionicConfigProvider.tabs.position("top");
  $ionicConfigProvider.tabs.style("standard");
  $ionicConfigProvider.navBar.alignTitle("left");
  $ionicConfigProvider.views.swipeBackEnabled(false);
}) 
.run(function($ionicPlatform, $state, $rootScope, $location, $ionicPickerI18n) {

  $ionicPickerI18n.weekdays = ["Di", "Lu", "Ma", "Me", "Je", "Ve", "Sa"];
  $ionicPickerI18n.months = ["Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre"];
  $ionicPickerI18n.ok = "Confirmer";
  $ionicPickerI18n.cancel = "Annuler";
  $ionicPickerI18n.title = "Annuler";

  $rootScope.GoTo = function( page ) { 
      $state.go(page); 
  }
  $ionicPlatform.ready(function() {

    if( ionic.Platform.isIOS() ){
        $('body').addClass('platformIOSActive');
    }
    // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
    // for form inputs)
    if (window.cordova && window.cordova.plugins && window.cordova.plugins.Keyboard) {
      cordova.plugins.Keyboard.hideKeyboardAccessoryBar(false);
      cordova.plugins.Keyboard.disableScroll(true);
    }
    if (window.StatusBar) {
      // org.apache.cordova.statusbar required
      StatusBar.styleDefault();
    }

    document.addEventListener("backbutton", function () {  
          if( $location.path() == '/login' ){ 
              navigator.app.exitApp();
              return false;
          }
    }, false);

    if( window.FirebasePlugin ){
      
        window.FirebasePlugin.grantPermission();

        window.FirebasePlugin.getToken(function(token) { 
            console.log("FirebasePlugin ",token);
             $rootScope.token = token;
        }, function(error) {
            console.error("FirebasePlugin ",error);
        });

        window.FirebasePlugin.onNotificationOpen(function(notification) {
            console.log(notification);
            if( localStorage.getItem('logged_in_prof') == "true" ){ 
              $rootScope.$emit("getMessages", {});
              $state.go("tabs.messages")
            }else{ 
              $state.go("login")
            }
        }, function(error) {
            console.error(error);
        });
    } 


       
    }); 
})

/*
  This directive is used to disable the "drag to open" functionality of the Side-Menu
  when you are dragging a Slider component.
*/
.directive('disableSideMenuDrag', ['$ionicSideMenuDelegate', '$rootScope', function($ionicSideMenuDelegate, $rootScope) {
    return {
        restrict: "A",  
        controller: ['$scope', '$element', '$attrs', function ($scope, $element, $attrs) {

            function stopDrag(){
              $ionicSideMenuDelegate.canDragContent(false);
            }

            function allowDrag(){
              $ionicSideMenuDelegate.canDragContent(true);
            }

            $rootScope.$on('$ionicSlides.slideChangeEnd', allowDrag);
            $element.on('touchstart', stopDrag);
            $element.on('touchend', allowDrag);
            $element.on('mousedown', stopDrag);
            $element.on('mouseup', allowDrag);

        }]
    };
}])

/*
  This directive is used to open regular and dynamic href links inside of inappbrowser.
*/
.directive('hrefInappbrowser', function() {
  return {
    restrict: 'A',
    replace: false,
    transclude: false,
    link: function(scope, element, attrs) {
      var href = attrs['hrefInappbrowser'];

      attrs.$observe('hrefInappbrowser', function(val){
        href = val;
      });
      
      element.bind('click', function (event) {

        window.open(href, '_system', 'location=yes');

        event.preventDefault();
        event.stopPropagation();

      });
    }
  };
});