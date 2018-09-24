angular.module('app.routes', ['ionicUIRouter'])

.config(function($stateProvider, $urlRouterProvider) {

  // Ionic uses AngularUI Router which uses the concept of states
  // Learn more here: https://github.com/angular-ui/ui-router
  // Set up the various states which the app can be in.
  // Each state's controller can be found in controllers.js
  $stateProvider
    
  

  .state('tabs', {
    url: '/tab',
    templateUrl: 'templates/tabs.html', 
    abstract:true
  })

  /* 
    The IonicUIRouter.js UI-Router Modification is being used for this route.
    To navigate to this route, do NOT use a URL. Instead use one of the following:
      1) Using the ui-sref HTML attribute:
        ui-sref='tabs.messages'
      2) Using $state.go programatically:
        $state.go('tabs.messages');
    This allows your app to figure out which Tab to open this page in on the fly.
    If you're setting a Tabs default page or modifying the .otherwise for your app and
    must use a URL, use one of the following:
      /tab1/messages
      /tab3/messages
  */ 
  .state('login', {
    url: '/login',
    templateUrl: 'templates/login.html',
    controller: 'loginCtrl'
  })
  .state('tabs.home', {
    url: '/home',
    cache: false,
    views: {
      'tab-home': {
        templateUrl: 'templates/home.html',
        controller: 'homeCtrl'
      }
    }
  })
  .state('tabs.setting', {
    url: '/setting',
    cache: false,
    views: {
      'tab-setting': {
        templateUrl: 'templates/setting.html',
        controller: 'settingCtrl'
      }
    }
  })
  .state('tabs.about', {
    url: '/setting/about',
    views: {
      'tab-setting': {
        templateUrl: 'templates/about.html',
        controller: 'aboutCtrl'
      }
    }
  }).state('tabs.changePwd', {
    url: '/setting/changePwd',
    views: {
      'tab-setting': {
        templateUrl: 'templates/change-pwd.html',
        controller: 'pwdCtrl'
      }
    }
  }).state('tabs.bug', {
    url: '/setting/bug',
    views: {
      'tab-setting': {
        templateUrl: 'templates/bug.html',
        controller: 'bugCtrl'
      }
    }
  })
  .state('blocked', {
    url: '/blocked',
    templateUrl: 'templates/blocked.html',
    controller: 'blockedCtrl'
  })
  

$urlRouterProvider.otherwise('/login')

  

});