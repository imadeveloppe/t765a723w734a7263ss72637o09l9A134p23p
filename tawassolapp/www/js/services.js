angular.module('app.services', [])

///////////////////*********PROD*********///////////////////
.constant('API', {
    url: "https://tawassolapp.com/Client_/",
    server: "https://tawassolapp.com/",
    appId: "com.ionicframework.app538533"
})

// ///////////////////*********DEV*********///////////////////
// .constant('API', {
//     url: "http://dev.tawassolapp.com/Client_/",
//     server: "http://dev.tawassolapp.com/",
//     appId: "com.ionicframework.app538533"
// })

// ///////////////////*********LOCAL*********///////////////////
// .constant('API', {
//     url: "http://tawassolapp.local/Client_/",
//     server: "http://tawassolapp.local/",
//     appId: "com.ionicframework.app538533"
// })

.factory('$AjaxQuery', function($http, API){
  return {
    post: function(task, params){ 
      var reqData ={ 
			method : 'POST',
      url : API.url+task, 
			headers: {'Content-Type': 'application/x-www-form-urlencoded'},
			transformRequest: function(obj) {
		        var str = [];
		        for(var p in obj)
		        str.push(encodeURIComponent(p) + "=" + encodeURIComponent(obj[p]));
		        return str.join("&");
		    },
			data : params
		} 
      return $http(reqData);
    }
  }
}).factory('$alert', function($http){
  	return {
    	success: function(text, timer){  
    		timer = timer || 0;
     		swal({ 
     		  title:'Succès',
			  text: text,  
			  type:'success',
			  confirmButtonColor: "#DD6B55",
			  confirmButtonText: "Fermer", 
			  animation:'slide-from-top',
			  timer : timer,
			  showConfirmButton: (timer > 0) ? false : true
			})
  		},
  		error: function(text){ 
     		swal({ 
     		  title:'Erreur',
			  text: text,
			  type:'error',
			  inputType:false,
			  animation:'slide-from-top',
			  confirmButtonColor: "#DD6B55",
			  confirmButtonText: "Fermer"
			})
  		}
    }
}).factory('$loader', function($ionicLoading){
  	return function (show, timer) {
  		timer = timer || 0;
  		if( show ){
  			$ionicLoading.show({
		      template: '<ion-spinner icon="android" class="spinner-calm">',
		      animation: 'slide-up', 
		      duration: timer
		    });
  		}else{
  			$ionicLoading.hide();
  		}
  	}	
  	

}) 

.service('BlankService', [function(){

}])
.filter('nl2br', function($sce){
    return function(msg,is_xhtml) { 
        var is_xhtml = is_xhtml || true;
        var breakTag = (is_xhtml) ? '<br />' : '<br>';
        var msg = (msg + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
        return $sce.trustAsHtml(msg);
    }
})
.filter('truncate', function($sce){
    return function strip_tags(input, allowed) {
      allowed = (((allowed || '') + '')
        .toLowerCase()
        .match(/<[a-z][a-z0-9]*>/g) || [])
        .join(''); // making sure the allowed arg is a string containing only tags in lowercase (<a><b><c>)
      var tags = /<\/?([a-z][a-z0-9]*)\b[^>]*>/gi,
        commentsAndPhpTags = /<!--[\s\S]*?-->|<\?(?:php)?[\s\S]*?\?>/gi;
      return input.replace(commentsAndPhpTags, '')
        .replace(tags, function($0, $1) {
          return allowed.indexOf('<' + $1.toLowerCase() + '>') > -1 ? $0 : ' ';
        });
    }
})

.factory('$storage', ['$window', function($window) {
    return {
        set: function(key, value) {
            window.localStorage[key] = value;
        },
        get: function(key) {
            return window.localStorage[key] || false;
        },
        setObject: function(key, value) {
            window.localStorage[key] = JSON.stringify(value);
        },
        getObject: function(key) { 
            return window.localStorage[key] ? JSON.parse(window.localStorage[key])  : false;
        },
        setArrayOfObjects: function(key, value) { 
            window.localStorage[key] = JSON.stringify(value);
        },
        getArrayOfObjects: function(key) {
            return window.localStorage[key] ? JSON.parse(window.localStorage[key]) : false;
        }

    }
}])

.factory('USERDATA', function($storage, API) {

     var dataKey = '12fbjUJj88d9afSDad0s4RFj5e8d1c44g4ff553jDf484gZ94jdwH92'+API.appId;

     var data = $storage.getObject(dataKey);
 
     if( data === false ){
        $storage.setObject(dataKey, {
          messages : [],
          students : [],
          currentUser : ''
        });
     }
     data = $storage.getObject(dataKey);
     var currentUser = data.currentUser;

     console.log(data)


     return{
        getMessages : function () { 
          return data.messages;
        },
        setMessages : function (messages) { 
          data.messages = messages;
          $storage.setObject(dataKey, data);
        },
        getStudents : function () {
          return data.students;
        },
        setStudents : function (students) { 
          data.students = students;
          $storage.setObject(dataKey, data);
        },
        getCurrentUser : function () {
          return data.currentUser;
        },
        getCurrentUserInfos : function () {
          var student = {}
          angular.forEach(data.students, function (value, key) {
            if( value.idClient == data.currentUser ){
              student = value;
            }
          })
          return student;
        },
        setCurrentUser : function (currentUser) { 
          data.currentUser = currentUser;
          $storage.setObject(dataKey, data);
        },
        getParentName : function () {
          return data.students[0].nomParent; 
        }
     }
});