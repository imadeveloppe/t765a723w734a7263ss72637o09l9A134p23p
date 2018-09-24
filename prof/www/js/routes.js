angular.module('app.routes', [])

.config(function($stateProvider, $urlRouterProvider) {

  // Ionic uses AngularUI Router which uses the concept of states
  // Learn more here: https://github.com/angular-ui/ui-router
  // Set up the various states which the app can be in.
  // Each state's controller can be found in controllers.js
  $stateProvider
    
  

  .state('tabs', {
    url: '/tabs',
    templateUrl: 'templates/tabs.html',
    abstract:true
  })

  .state('login', {
    url: '/login',
    templateUrl: 'templates/login.html',
    controller: 'loginCtrl'
  })
  .state('register', {
    url: '/register',
    templateUrl: 'templates/register.html',
    controller: 'registerCtrl'
  })
  .state('forgetpwd', {
    url: '/forgetpwd',
    templateUrl: 'templates/forgetpwd.html',
    controller: 'forgetpwdCtrl'
  })
  .state('tabs.messages', {
    url: '/messages',
    cache:false,
    views: {
      'tab1': {
        templateUrl: 'templates/messages.html',
        controller: 'messagesCtrl'
      }
    }
  })
  .state('tabs.chats', {
    url: '/chats/:key',
    cache:false,
    views: {
      'tab1': {
        templateUrl: 'templates/chats.html',
        controller: 'chatsCtrl'
      }
    }
  })
  .state('tabs.message', {
    url: '/message/:key',
    views: {
      'tab1': {
        templateUrl: 'templates/message.html',
        controller: 'messageCtrl'
      }
    }
  })
  .state('tabs.historique', {
    url: '/historique',
    cache:false,
    views: {
      'tab2': {
        templateUrl: 'templates/historique.html',
        controller: 'historiqueCtrl'
      }
    }
  })
  .state('tabs.messageToParent', {
    url: '/messageToParent/:key',
    cache:false,
    views: {
      'tab2': {
        templateUrl: 'templates/messageToParent.html',
        controller: 'messageToParentCtrl'
      }
    }
  })
  .state('tabs.nouveauMessage', {
    url: '/new-message/:hash/:transfer',
    reload: false, 
    views: {
      'tab2': {
        templateUrl: 'templates/nouveauMessage.html',
        controller: 'nouveauMessageCtrl'
      }
    }
  }) 

  .state('tabs.absence', {
    url: '/absence/',
    reload: false, 
    views: {
      'tab2': {
        templateUrl: 'templates/absence.html',
        controller: 'absenceCtrl'
      }
    }
  }) 

  .state('tabs.rGlage', {
    url: '/reglage',
    views: {
      'tab3': {
        templateUrl: 'templates/rGlage.html',
        controller: 'rGlageCtrl'
      }
    }
  })

  .state('tabs.personnel-info', {
    url: '/reglage/personnel-info',
    views: {
      'tab3': {
        templateUrl: 'templates/personnel-info.html',
        controller: 'personnelInfoCtrl'
      }
    }
  })
  .state('tabs.about', {
    url: '/reglage/about',
    views: {
      'tab3': {
        templateUrl: 'templates/about.html'
      }
    }
  })
  .state('tabs.emplois', {
    url: '/reglage/emplois',
    views: {
      'tab3': {
        templateUrl: 'templates/emplois.html',
         controller: 'enploiCtrl'
      }
    }
  })
  .state('tabs.bug', {
    url: '/reglage/bug',
    views: {
      'tab3': {
        templateUrl: 'templates/bug.html',
        controller: 'bugCtrl'
      }
    }
  })
  .state('tabs.pwd', {
    url: '/reglage/pwd',
    views: {
      'tab3': {
        templateUrl: 'templates/pwd.html',
        controller: 'pwdCtrl'
      }
    }
  })

$urlRouterProvider.otherwise('/login')

  

});