// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
// 'starter.services' is found in services.js
// 'starter.controllers' is found in controllers.js
angular.module('app', ['ionic','ngCordova','app.controllers', 'app.routes', 'app.directives','app.services', 'jrCrop'])

.config(function($ionicConfigProvider){
  $ionicConfigProvider.tabs.position("bottom");
  $ionicConfigProvider.tabs.style("standard");
  $ionicConfigProvider.navBar.alignTitle("left");
  $ionicConfigProvider.backButton.text( "" ).icon('ion-android-arrow-back');
  $ionicConfigProvider.backButton.previousTitleText(false);
  $ionicConfigProvider.views.swipeBackEnabled(false);
}) 
.run(function($ionicPlatform, $location, $rootScope, $state) {
  $ionicPlatform.ready(function() {
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
          if( $location.path() == '/tab/messages' ){ 
              navigator.app.exitApp();
          }
          if( $location.path() == '/register' ){ 
              $rootScope.$emit("changeMassarCode", {});
          }
    }, false);

    if(window.FirebasePlugin ){
        
        window.FirebasePlugin.grantPermission();
        //window.FirebasePlugin.setBadgeNumber(3);
        
        window.FirebasePlugin.getToken(function(token) { 
            console.log("FirebasePlugin ",token);
            $rootScope.token = token;
        }, function(error) {
            console.error("FirebasePlugin ",error);
        });
        
        window.FirebasePlugin.onNotificationOpen(function(notification) {
            console.log(notification);
            $rootScope.$emit("CallMessages", {}); 
            //$state.go("tabs.messages")
        }, function(error) {
            console.error(error);
        });
    }
    

  });
}) 