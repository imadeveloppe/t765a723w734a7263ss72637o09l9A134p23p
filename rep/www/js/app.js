// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
// 'starter.services' is found in services.js
// 'starter.controllers' is found in controllers.js
angular.module('app', ['ionic','ngCordova','app.controllers', 'app.routes', 'app.directives','app.services'])

.config(function($ionicConfigProvider){
  $ionicConfigProvider.tabs.position("bottom");
  $ionicConfigProvider.tabs.style("standard");
  $ionicConfigProvider.navBar.alignTitle("center");
})

.run(function($ionicPlatform, $rootScope, $state) {
  $ionicPlatform.ready(function() {
    // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
    // for form inputs)
    if (window.cordova && window.cordova.plugins && window.cordova.plugins.Keyboard) {
      cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
      cordova.plugins.Keyboard.disableScroll(true);
    }
    if (window.StatusBar) {
      // org.apache.cordova.statusbar required
      StatusBar.styleDefault();
    }


    window.FirebasePlugin.getToken(function(token) { 
        console.log("FirebasePlugin ",token);
        $rootScope.token = token;
    }, function(error) {
        console.error("FirebasePlugin ",error);
    });

    window.FirebasePlugin.onNotificationOpen(function(notification) {
        console.log(notification);
        $state.go('tabs.home');
        $rootScope.$emit("CallGetCenters", {});
    }, function(error) {
        console.error(error);
    });


  });
})