angular.module('pim.constant', []) 
// PROD
.constant('API', {
    url: "https://tawassolapp.com/Prof_app/",
    server: "https://tawassolapp.com/"
});
////DEV
// .constant('API', {
//     url: "https://dev.tawassolapp.com/Prof_app/",
//     server: "https://dev.tawassolapp.com/"
// });
// //LOCAL
// .constant('API', {
//     url: "http://dev.tawassolapp.local/Prof_app/",
//     server: "http://dev.tawassolapp.local/"
// });


angular.module('app.services', [])

.factory('BlankFactory', [function(){

}])
.factory('$AjaxQuery', function($http, $loader, $alert, API){
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

    var back = $http(reqData)
    back.then(function () {
        $loader(false)
    },
    function (e) {
      console.log(e)
      $loader(false);
      $alert.error('Erreur de connexion',2000)
    })
      return back;
    }
  }
}).factory('$alert', function($http){
  	return {
    	success: function(text, timer){  
    		timer = timer || 0;
        var obj = { 
          title:'Succès',
          text: text,  
          type:'success',
          confirmButtonColor: "#DD6B55",
          confirmButtonText: "Fermer", 
          animation:'slide-from-top', 
          showConfirmButton: (timer > 0) ? false : true
        }
        if(timer > 0){
          obj.timer = timer;
        }
     		swal(obj)
  		},
  		error: function(text, timer){ 
        timer = timer || 0;
        var obj = { 
          title:'Erreur',
          text: text,
          type:'error',
          inputType:false,
          animation:'slide-from-top',
          confirmButtonColor: "#DD6B55", 
          showConfirmButton: (timer > 0) ? false : true
        }
        if(timer > 0){
          obj.timer = timer;
        }
     		swal(obj)
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
});