angular.module('app.services', [])

.factory('BlankFactory', [function(){

}])
.factory('$AjaxQuery', function($http){
  return {
    post: function(task, params){ 
      var reqData ={ 
			method : 'POST',
      // url : 'http://dev.tawassolapp.local/Rep/'+task,
      url : 'http://dev.tawassolapp.com/Rep/'+task,
			// url : 'https://tawassolapp.com/Rep/'+task,
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
		      template: '<ion-spinner icon="lines" class="spinner-calm">',
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
});