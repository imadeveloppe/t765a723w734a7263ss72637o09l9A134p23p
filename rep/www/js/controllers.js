///////////////***** Global Varibles ******/////////////////////////
	// window.onerror = function(message, url, lineNumber) {
 //        alert("Error: "+message+" in "+url+" at line "+lineNumber);
 //    } 
////////////////////////////////////////////////////////////////////
angular.module('app.controllers', [])

.controller('NotifCtrl', ['$scope','$state', '$stateParams','$rootScope','$AjaxQuery','$cordovaLocalNotification', 
function ($scope,$state, $stateParams, $rootScope, $AjaxQuery, $cordovaLocalNotification) {  
 
    $rootScope.$on("UpdateBadge", function(){
           $scope.UpdateBadge();
    }); 
	$scope.UpdateBadge = function UpdateBadge() {
		var notifBadge =  parseInt( localStorage.getItem('notifRep') );
		notifBadge = ( notifBadge > 0 ) ? notifBadge : 0;
		$scope.notif = notifBadge;  
		//cordova.plugins.notification.badge.set( notifBadge );
	}
	$scope.UpdateBadge();
	

}])
 












.controller('loginCtrl', ['$scope', '$AjaxQuery','$loader','$alert','$rootScope','$state','$interval', 
function ($scope, $AjaxQuery, $loader, $alert, $rootScope, $state, $interval ) { 
 
		$scope.login = function () { 
			if( $scope.username && $scope.password  ){
				$loader(true);
				var reqData = {
					login : $scope.username,
					pwd : $scope.password,
					token: $rootScope.token
				}
				$AjaxQuery.post('login', reqData ).success(function(data) { 
					$loader(false); 
			 		if( data.state == 'error' ){ 
			 			 $alert.error(data.message)
			 		}
			 		if( data.state == 'blocked'){
			 			$state.go('blocked');
			 		}
			 		if(data.state == 'true'){

			 			localStorage.setItem('idRep',data.idRep); 
			 			$state.go('tabs.home'); 
 
			 		} 
				})
			} 
		}
		
 
	
	 
}])






.controller('homeCtrl', ['$scope', '$stateParams','$AjaxQuery','$state','$interval','$rootScope','$alert','$loader','$cordovaLocalNotification', 
function ($scope, $stateParams, $AjaxQuery, $state, $interval, $rootScope, $alert, $loader, $cordovaLocalNotification ) { 
 	
 	$rootScope.$on("CallGetCenters", function(){
           $scope.GetCenters();
    });
    $scope.GetCenters = function () {
    	$loader(true)
    	$AjaxQuery.post('GetCenters/'+localStorage.getItem('idRep'), {} ).success(function(data) { 
    		$loader(false)	 
	 		$scope.etablissements = data; 
	 		localStorage.setItem('centers',data);
	 		localStorage.setItem('NbrCenter', data.length )
	 		// console.log(data.length) 
	 		var count =0; 
	 		angular.forEach(data, function (center, key) {
	 			count = (center.state == 0) ? count+1 : count; 
	 		})
	 		console.log(data)
	 		localStorage.setItem('notifRep', count)
	 		$rootScope.$emit("UpdateBadge", {});

		})
    }
 	$scope.GetCenters();

	$scope.changeState = function (idEtab) {
		console.log(idEtab)
		$loader(true)
		$AjaxQuery.post('updateState/'+idEtab, {} ).success(function(data) { 
			$loader(false)
			var notifRep = parseInt(localStorage.getItem('notifRep'));
			if(data == 'true'){
				localStorage.setItem('notifRep', notifRep-1 );
			}else if(data == 'false'){
				localStorage.setItem('notifRep', notifRep+1 );
			}
			$rootScope.$emit("UpdateBadge", {});
		})
	}
	$scope.Call = function (tel) {
		// console.log(tel)
		window.plugins.CallNumber.callNumber(
			function (result) {
				console.log(result)
			}, function (result) {
				console.log(result)
			}, tel, 
			true
		);
		return false;
	}
		 
}])


 














.controller('settingCtrl', ['$scope', '$stateParams', '$loader','$AjaxQuery', 
function ($scope, $stateParams,$loader,$AjaxQuery) {

	$scope.rep = JSON.parse(localStorage.getItem('rep')); 
	$AjaxQuery.post('GetInfoRep/'+localStorage.getItem('idRep'), {} ).success(function(data) { 
		localStorage.setItem('rep', JSON.stringify(data));
		$scope.rep = data;
	})
}])





.controller('pwdCtrl', ['$scope', '$stateParams','$state','$loader','$alert','$AjaxQuery', 
function ($scope, $stateParams, $state,  $loader, $alert, $AjaxQuery) {
		$scope.changePwd = function () {
			if( $scope.oldPwd && $scope.newPwd && $scope.confirmPwd ){
				if( $scope.newPwd == $scope.confirmPwd ){
					var reqData = {
						pwd : $scope.oldPwd,					
						Newpwd : $scope.newPwd
					}
					$loader(true)
					$AjaxQuery.post('changePwd/'+localStorage.getItem('idRep'), reqData ).success(function(data) { 
						$loader(false)		
						if(data == 1 ){
							$alert.success('Le mot de passe est bien changé',3000)
		                    $scope.oldPwd = $scope.newPwd = $scope.confirmPwd = '';
		                    setTimeout(function () {
		                    	$state.go('tabs.setting');
		                    },3200)
		                }else{
		                    $alert.error('L\'ancien mot de passe est incorrect')
		                }
					})
				}else{
					$alert.error('Merci de confirmer votre mot de passe')
				}
			}else{
					$alert.error('merci de renseigner les champs')
			}
		}

}])




.controller('aboutCtrl', ['$scope', '$stateParams', 
function ($scope, $stateParams) {


}])














.controller('bugCtrl', ['$scope', '$stateParams','$AjaxQuery','$alert', '$loader', 
function ($scope, $stateParams, $AjaxQuery, $alert, $loader) { 
	$scope.sendRapport = function sendRapport() {

		if( $scope.contentBug != '' ){
			$loader(true);
			var reqData = {
				content : $scope.contentBug,
		        from : 'Representant',
		        idFrom : localStorage.getItem('idRep')
			}
			$AjaxQuery.post('addProbleme', reqData ).success(function(data) {
				$loader(false);
				if( data == "true" ){  
		             $alert.success('Merci, Vos commentaires nous aident à améliorer TawassolApp pour tous',3000);
		             $scope.contentBug = '';
		        }else{ 
		            $alert.error('Erreur, essayer plutard')
		        } 
			})
		}
	} 

}]).controller('blockedCtrl', ['$scope', '$state', 
function ($scope, $state) { 
	 
}]); 






function verified() {
	if( localStorage.getItem('state') == 'true' ) return true;
	else return false;
}