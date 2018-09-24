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
  .state('register', {
    url: '/register',
    cache: false,
    templateUrl: 'templates/register.html',
    controller: 'addStudentCtrl'
  })
  .state('home', {
    url: '/home',
    templateUrl: 'templates/home.html',
    controller: 'homeCtrl'
  })
  .state('tabs.messages', {
    url: '/messages',
    cache: false,
    views: {
      'tab-messages': {
        templateUrl: 'templates/messages.html',
        controller: 'messagesCtrl'
      }
    }
  }).state('tabs.setting', {
    url: '/setting',
    cache: false,
    views: {
      'tab-setting': {
        templateUrl: 'templates/setting.html',
        controller: 'settingCtrl'
      }
    }
  })
  .state('tabs.message', {
    url: '/messages/message/:idMessage/:idClient',
    cache: false,
    views: {
      'tab-messages': {
        templateUrl: 'templates/message.html',
        controller: 'messageCtrl'
      }
    },
    params:{
      idMessage:null,
      idClient:null
    }
  })
  .state('tabs.students', {
    url: '/setting/students',
    cache: false,
    views: {
      'tab-setting': {
        templateUrl: 'templates/students.html',
        controller: 'studentsCtrl'
      }
    }
  })
  .state('tabs.chats', {
    url: '/setting/chats',
    cache: false,
    views: {
      'tab-setting': {
        templateUrl: 'templates/chats.html',
        controller: 'chatsCtrl'
      }
    }
  })
  .state('tabs.chat', {
    url: '/setting/chat/:key', 
    views: {
      'tab-setting': {
        templateUrl: 'templates/chat.html',
        controller: 'chatCtrl'
      }
    }
  }).state('tabs.addStudent', {
    url: '/setting/students/addStudent',
    views: {
      'tab-setting': {
        templateUrl: 'templates/add-student.html',
        controller: 'addStudentCtrl'
      }
    }
  }).state('tabs.profileStudent', {
    url: '/setting/students/profileStudent/:idClient',
    views: {
      'tab-setting': {
        templateUrl: 'templates/profileStudent.html',
        controller: 'profileStudentCtrl'
      }
    }
  })

   .state('tabs.emplois', {
    url: '/setting/emplois',
    views: {
      'tab-setting': {
        templateUrl: 'templates/emplois.html',
         controller: 'enploiCtrl'
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
  }).state('tabs.massar', {
    url: '/setting/massar',
    views: {
      'tab-setting': {
        templateUrl: 'templates/massar.html',
        controller: 'massarCtrl'
      }
    }
  }).state('tabs.otals', {
    url: '/setting/otals',
    views: {
      'tab-setting': {
        templateUrl: 'templates/otals.html',
        controller: 'massarCtrl'
      }
    }
  }).state('tabs.background', {
    url: '/setting/background',
    views: {
      'tab-setting': {
        templateUrl: 'templates/background.html',
        controller: 'backgroundCtrl'
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

  .state('tabs.espaceEleve', {
    url: '/espaceEleve', 
    views: {
      'tab-setting': {
        templateUrl: 'templates/espaceEleve.html',
        controller: 'espaceEleveCtrl'
      }
    }
  })
  

$urlRouterProvider.otherwise('/home')

  

});