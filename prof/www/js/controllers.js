
function checkConnection() {
    return {
    	type : "CELL_4G",
    	value : true
    } 

   var networkState = navigator.connection.type;

    var states = {};
    states[Connection.UNKNOWN]  = 'Unknown connection';
    states[Connection.ETHERNET] = 'Ethernet connection';
    states[Connection.WIFI]     = 'WiFi connection';
    states[Connection.CELL_2G]  = 'Cell 2G connection';
    states[Connection.CELL_3G]  = 'Cell 3G connection';
    states[Connection.CELL_4G]  = 'Cell 4G connection';
    states[Connection.CELL]     = 'Cell generic connection';
    states[Connection.NONE]     = 'Pas de connexion internet';
    
    return {
    	type : networkState,
    	value : states[networkState]
    } 
} 
if( !localStorage.getItem('fileDownloaded') ){
	var obj = {};
	localStorage.setItem('fileDownloaded', JSON.stringify(obj));
	localStorage.setItem('logosDownloaded', JSON.stringify(obj));
	localStorage.setItem('messages', "");
	localStorage.setItem('historique', "");
} 

angular.module('app.controllers', [])
     
.controller('loginCtrl',  function ($scope, $rootScope, $state, $stateParams, $alert, $loader, $AjaxQuery, $interval, $cordovaBadge, $cordovaLocalNotification, $ionicHistory) {
	 
	$scope.checkConnectionInternet = function () {
    	var network = checkConnection(); 
		$rootScope.NetworkTrue = ( network.type == "none" ) ? false : true; 
    }
    
    $scope.form = {};
	$scope.$on('$ionicView.beforeEnter', function() { 
		$scope.form = {};
		$scope.form.tel = "";
		$scope.form.pwd = "";
	    if( localStorage.getItem('logged_in_prof') == 'true' ){
     		$interval(function () { 
				$scope.checkConnectionInternet(); 
			},1000)
			 
     		$state.go('tabs.messages');
	    }
    });
	
	$scope.login = function () { 
		$loader(true);
		var reqData ={ 
			email :  $scope.form.tel,
            pwd	  :  $scope.form.pwd,
            token :  $rootScope.token
		}  
		$AjaxQuery.post('connecte', reqData ).success(function(data) {
			console.log(data);
			
			if(data.state == 'false'){
				$alert.error('Téléphone et/ou mot de passe incorrects',2000)
			}else{
				localStorage.setItem('logged_in_prof','true');
				localStorage.setItem('idProf',data.info.id);
				localStorage.setItem('idCentre',data.info.idCentre);
				localStorage.setItem('niveau',data.info.niveau);
				localStorage.setItem('nom',data.info.nom);

				$scope.form.tel = "";
				$scope.form.pwd = "";
				
				$interval(function () { 
					$scope.checkConnectionInternet(); 
				},1000) 
				 
				//$cordovaBadge.set(0);

				localStorage.setItem('messages','');
				$ionicHistory.clearCache();
   				$ionicHistory.clearHistory();

				$state.go('tabs.messages');
			} 
		})
		
	}

})
.controller('registerCtrl',  function ($scope, $rootScope, $state, $stateParams, $alert, $loader, $AjaxQuery, $ionicModal, API) {

	$scope.codeValide = false;

	$scope.code="";//a36e63
	$scope.DATA = {};
	$scope.DATA.niveau = [];
	$scope.DATA.matieres = [];
	$scope.DATA.classes = {};
	$scope.DATA.classes.intituleClasse = [];
	$scope.DATA.classes.intituleGroupe = [];
	$scope.rowsClasses = [{index: 0, classe: -1, groupe: -1}]; 
	$scope.cgu = true; 
	$scope.verifCode = function verifCode() {
		var code = $scope.code; $rootScope.NetworkTrue = true;
		if( code.length >= 6 ){
			$loader(true);
			$scope.DATA = {};
			var reqData = {};
			if( $rootScope.NetworkTrue ){ 
				$AjaxQuery.post('verifCode/'+code, reqData).success(function (data) {
					$loader(false);
					if(data == '1'){
						$scope.codeValide = true;
						$AjaxQuery.post("getNiveauByCode/"+code, reqData).success(function (data) {
			                $scope.DATA.niveau = data;
			                $scope.niveau = "";
			            })
			            $AjaxQuery.post("getMatieresByCode/"+code, reqData).success(function (data) {
			                 $scope.DATA.matieres = data;
			            })
			            $AjaxQuery.post("getClassesByCode/"+code, reqData).success(function (data) {
			                $scope.DATA.classes = data;
			                setTimeout(function () {
			                 	$scope.$apply(function () {
			                 		$scope.groupeProf = 0;
			                 		$scope.classeProf = 0; 
			                 	})
			                },200)
			            })
					}else{
			          $alert.error('Code invalide')
			        }
				})
			}else{
				alert( "pas de connexion internet" )
			} 
		}
	}

	$scope.nbrRow = function ( nbr ) { 
		if(nbr > 0){
			var array = [];
			for (var i = 0; i < nbr; i++) {
				array.push( i );
			}
			return array;
		}
		else {
			return [0];
		}
		
	}
	

	$scope.checkedOrNot = function (id, isChecked, index) {
        console.log("index:" + index + " " + isChecked);

        if (isChecked) {
            $scope.selectedMatiere.push(id);
        } else {
            var _index = $scope.selectedMatiere.indexOf(id);
            $scope.selectedMatiere.splice(_index, 1);
        }
        console.log( $scope.selectedMatiere )
    }; 

    $scope.classeProfArray = [];
	$scope.groupeProfArray = [];
	$scope.addRow = function () {
		var array = {
			index:$scope.rowsClasses.length,
			classe : -1,
			groupe : -1
		}  
		$scope.rowsClasses.push( array )  
		console.log($scope.rowsClasses )
	}
	$scope.removeRow = function ( index ) { 
		$scope.rowsClasses.splice(index, 1);
	}
	$scope.OnchangeNiveau = function () {
		$AjaxQuery.post("getMatieresByCode/"+$scope.code+"/"+$scope.niveau, {}).success(function (data) {
             $scope.DATA.matieres = data;
        })
        $AjaxQuery.post("getClassesByCode/"+$scope.code+"/"+$scope.niveau, {}).success(function (data) {
             $scope.DATA.classes = data;
        })
	}
	$ionicModal.fromTemplateUrl('matieres-modal.html', {
		scope: $scope,
		animation: 'slide-in-up'
	}).then(function(modal) {
	    $scope.modal1 = modal;
	});
	$scope.openModal1 = function() { 
		$scope.modal1.show();
	};
	$scope.closeModal1 = function() {
      $scope.modal1.hide();
    };

    $ionicModal.fromTemplateUrl('classes-modal.html', {
		scope: $scope,
		animation: 'slide-in-up'
	}).then(function(modal) {
	    $scope.modal2 = modal;
	});
	$scope.openModal2 = function() { 
		$scope.modal2.show();
	};
	$scope.closeModal2 = function() {
      $scope.modal2.hide();
    };




    $scope.selectedMatiere = [];
	$scope.fname = "";
	$scope.lname = "";
	$scope.niveau = "";
	
	$scope.tel = "";
	$scope.pwd = "";
	$scope.confirmPwd = "";
    $scope.validatefForm = function () { 

    	if( $scope.fname == "" ){
    		$alert.error('Veuillez saisir votre prénom');
			return false 
    	}
    	if( $scope.lname == "" ){
    		$alert.error('Veuillez saisir votre nom');
			return false 
    	}
    	if( $scope.niveau == "" ){
    		$alert.error('Veuillez choisir un niveau d\'enseignement');
			return false 
    	}

    	if( $scope.rowsClasses.length == 0 ){
    		$alert.error('Veuillez choisir la/les classes enseignées');
			return false 
    	}

    	var validClasses = true;
    	angular.forEach( $scope.rowsClasses,function (item, key) {
    		console.log(item.classe)
    		if(item.classe == -1 || item.groupe == -1){ 
    			validClasses = false;
    		} 
    	})

    	if( $scope.selectedMatiere.length == 0 ){
    		$alert.error('Veuillez choisir la/les matières enseignées');
			return false 
    	}

    	

    	
		if(!validClasses){
			$alert.error('Veuillez bien choisir la classe enseignée');
			return false;
		}
		if( $scope.tel == "" ){
    		$alert.error('Veuillez saisir votre numéro de téléphone');
			return false 
    	}
    	if( $scope.tel.length < 10 ){
    		$alert.error('Veuillez saisir un numéro de téléphone valide');
			return false 
    	}
    	if( $scope.pwd == "" ){
    		$alert.error('Veuillez saisir un mot de passe');
			return false 
    	}
    	if( $scope.pwd.length < 6 ){
    		$alert.error('Veuillez saisir un mot de passe supérieure à 6 chiffres');
			return false 
    	}
    	if( $scope.confirmPwd == "" ){
    		$alert.error('Veuillez confirmer votre mot de passe');
			return false 
    	} 
    	
    	if( $scope.confirmPwd != $scope.pwd ){ 
    		$alert.error('Les mots de passe ne sont pas identiques');
			return false 
    	}
    	if(!$scope.cgu){ 
			$alert.error("Veuillez accepter les conditions d'utilisation et la politique de confidentialité");
			return false
		}

    	return true;
    	
    }
    $scope.validate = function() {
    	if( $scope.validatefForm() ){ 
    		$scope.openModal();
    	}
    }

    $scope.addProf = function () {
    	$scope.closeModal();
    	var reqData = {
    			email: $scope.tel
		}
		$loader(true)
		var classeArray = []; 
		var groupeArray = [];
		angular.forEach( $scope.rowsClasses,function (item, key) { 
    		classeArray.push(item.classe)
    		groupeArray.push(item.groupe)
    	})

		setTimeout(function () {
			$AjaxQuery.post("verifEmail/", reqData).success(function (data) {
    				$loader(false)
                  	if( data == "true" ){
	                   	var reqData = {
			    			code: $scope.code,
			    			prenom   	: $scope.fname,
			    			nom   		: $scope.lname,
			    			matieres    : $scope.selectedMatiere.join(','),
			    			classe : classeArray,
			    			groupe : groupeArray,
			    			niveau  	: $scope.niveau,
			    			email   	: $scope.tel,
			    			pwd   		: $scope.pwd
			    		}
			    		$AjaxQuery.post("addProf/", reqData).success(function (data) {
			                $alert.success("Inscription réussie", 3000)
			                setTimeout(function () { 
			                	$state.go('login')
			                })
			            })
	                }else{
	                   	$alert.error("Ce numéro de téléphone existe déjà")
	                }
            })
		},1000)
    }

    $ionicModal.fromTemplateUrl('templates/modal-register.html', {
		scope: $scope,
		animation: 'slide-in-up'
	}).then(function(modal) {
		$scope.modal = modal;
	});
	$scope.openModal = function() {
		$scope.modal.show();
	};
	$scope.closeModal = function() {
		$scope.modal.hide();
	}; 


    $ionicModal.fromTemplateUrl('templates/modal-cgu.html', {
		scope: $scope,
		animation: 'slide-in-up'
	}).then(function(modal) {
		$scope.ModalCGU = modal;
	});
	$scope.openModalCGU = function() {
		$scope.ModalCGU.show();
	};
	$scope.closeModalCGU = function() {
		$scope.ModalCGU.hide();
	}; 

	$scope.openModalPoli = function () { 
		cordova.InAppBrowser.open(API.server+'privacy-policy-prof.html', '_blank', 'EnableViewPortScale=yes');
	}

})
.controller('forgetpwdCtrl',  function ($scope, $rootScope, $state, $stateParams, $alert, $loader, $AjaxQuery, $filter, $cordovaBadge) {

})
.controller('messagesCtrl',  function ($scope, $rootScope, $state, $stateParams, $alert, $loader, $AjaxQuery, $filter, $cordovaBadge, API) {
	$scope.messages = [];  

	$scope.urlLogos = API.server+"assets/upload/logos/";

	$scope.allowSend = false;

	$scope.getMessages = function () {

		if($rootScope.NetworkTrue){
			var reqData ={ 
				idProf :  localStorage.getItem('idProf'),
				idCentre :  localStorage.getItem('idCentre'),
				niveau :  localStorage.getItem('niveau')
			} 
			if(localStorage.getItem('messages') != ''){
				$rootScope.dataMessages = JSON.parse(localStorage.getItem('messages'))
			}else{
				$loader(true);
				$scope.messages = []; 
			}
			var badge = 0;
			$AjaxQuery.post('messages', reqData ).success(function(data) { 
				localStorage.setItem('messages', JSON.stringify(data));
				$rootScope.dataMessages = data; 
				$rootScope.countMessage = data.countMessage;
				angular.forEach( data.messages,function (message, key) {
					badge = (message.vu == 0) ? badge+1 : badge;
					console.log(badge)
				})
				//$cordovaBadge.set(badge);
				if( window.cordova ){
					$cordovaBadge.set( 0 ); 
				}
				$rootScope.badge = badge;

				$scope.allowSend = (data.allowSend == 1) ? true : false;
			})
		}else{
			setTimeout(function () {
				$scope.getMessages();
			},500)
		}
	}
	$scope.directionality = function ( str ) {
		if( str.search('dir="rtl"') >= 0 && str.search("class='deletedMessage'") < 0){
			return "rtl";
		}else{
			return "ltr";
		}
	}   
	$scope.$on('$ionicView.afterEnter', function() {
		setTimeout(function () {
			if($rootScope.NetworkTrue){ 
			 	$scope.getMessages();
			}
		},1000)
	}); 
	$rootScope.$on("getMessages", function(){ 
           $scope.getMessages(); 
    });  

    $scope.openMessage = function (key, message) {
    	 switch( message.categorie ){
    	 		case 'prof':
    	 			$state.go('tabs.message', { "key" : key })
    	 			break;

    	 		case 'prof-admin':
    	 			$state.go('tabs.chats', { "key" : key })
    	 			break;
    	 }
    }

	
 
})
.controller('chatsCtrl',  function ($scope, $rootScope, $state, $stateParams, $alert, $loader, $AjaxQuery, $filter, $cordovaBadge) {

		
	$scope.data = {};
	$scope.messages = [];
	$scope.autoResponse = false;
	
	if( $stateParams.key != 'new' ) {
		$scope.message = $rootScope.dataMessages.messages[$stateParams.key]; 
		$scope.messages = JSON.parse( $scope.message.content );

		var reqData ={ 
			idMessage :  $scope.message.idMessage,
			idProf :  localStorage.getItem('idProf'),
			idCentre :  localStorage.getItem('idCentre'),
			niveau :  localStorage.getItem('niveau')
		} 
		
		$AjaxQuery.post('addVuToMessage', reqData ).success(function(data) {
			console.log(data); 
		})
	} 
		

	$scope.sendMessage = function () {
		$loader(true);
		$AjaxQuery.post('sendMessageToAdmin', {
			idProf 	 :  localStorage.getItem('idProf'),
			idCentre :  localStorage.getItem('idCentre'),
			niveau 	 :  localStorage.getItem('niveau'),
			message  :  $scope.data.message,
			align 	 : $scope.align
		} ).success(function(data) { 
			if(parseInt(data) > 0){
				$scope.messages.push({
					from: 'prof',
					content: $scope.data.message
				})
				$scope.data.message = '';

				setTimeout(function () {
					$scope.showAutoResponse();
				},1000)
			} 
			

		})

			
	}

	$scope.showAutoResponse = function () {
		if( $scope.messages.length == 1 ){ 
			$scope.autoResponse = true; 
		}
	}
	$scope.$on('$ionicView.beforeEnter', function() {  
		$scope.showAutoResponse();
		$scope.align = 'left'; 
	}) 

	$scope.changeContentMesssage =  function() { 
		 
        var rtlChar = /[\u0590-\u083F]|[\u08A0-\u08FF]|[\uFB1D-\uFDFF]|[\uFE70-\uFEFF]/mg;
        var isRTL = $scope.data.message.match(rtlChar);
        if(isRTL !== null) {
            $scope.align = 'right'; 
            $scope.txtDirection = "rtl";  
        }
        else {
            $scope.align = 'left'; 
            $scope.txtDirection = "ltr";  
        }
    }



})
.controller('messageCtrl', function ($scope, $sce, $loader, $stateParams,  $rootScope, $AjaxQuery, $ionicModal, $timeout, $cordovaFileTransfer, API) {

		var network = checkConnection(); 
		$rootScope.NetworkTrue = ( network.type == "none" ) ? false : true; 

		$scope.message = $rootScope.dataMessages.messages[$stateParams.key];
		if($rootScope.dataMessages.messages[$stateParams.key].vu == 0){
			var reqData ={ 
				idMessage :  $rootScope.dataMessages.messages[$stateParams.key].idMessage,
				idProf :  localStorage.getItem('idProf'),
				idCentre :  localStorage.getItem('idCentre'),
				niveau :  localStorage.getItem('niveau')
			} 
			if($rootScope.NetworkTrue){
				$AjaxQuery.post('addVuToMessage', reqData ).success(function(data) {
					console.log(data); 
				})
			}
		}  
		$scope.ExternalPath = API.server+"assets/upload/";

		$scope.trustAsHtml = function(string) {
		    return $sce.trustAsHtml(string);
		};
		setTimeout(function () {
			var width = 0;
			$('.item-destination').each(function () {
				width += parseInt( $(this).width() ) + 37;
			})
			$('.item-destination-continer .scroll').css('width', width);
		}) 
	 	$scope.directionality = function ( str ) {
			if( str.search('dir="rtl"') >= 0 && str.search("class='deletedMessage'") < 0){
				return "rtl";
			}else{
				return "ltr";
			}
		}
	 	////////////////********** Open Modal **************//////////////////
	 	$ionicModal.fromTemplateUrl('image-modal.html', {
	      scope: $scope,
	      animation: 'slide-in-up'
	    }).then(function(modal) {
	      $scope.modal = modal;
	    });

	    $scope.openModal = function() {
	      $scope.modal.show();
	    };

	    $scope.closeModal = function() {
	      $scope.modal.hide();
	    };

	    //Cleanup the modal when we're done with it!
	    $scope.$on('$destroy', function() {
	      $scope.modal.remove();
	    });
	    // Execute action on hide modal
	    $scope.$on('modal.hide', function() {
	      // Execute action
	    });
	    // Execute action on remove modal
	    $scope.$on('modal.removed', function() {
	      // Execute action
	    });
	    $scope.$on('modal.shown', function() {
	      console.log('Modal is shown!');
	    });
	 
	    $scope.ShowBtnDowload = false;  
	    $scope.rotateValue = 0;
	    $scope.rotateImage = function () {
	    	$scope.rotateValue += 90;
	    }
	    /////////////////////////////////// download image from server to locale ////////////////////////////////////////
	    $scope.showImage = function(fileName) { 
	        
	        $scope.imageSrc = $scope.ExternalPath+fileName;
	        $scope.openModal(); 

	    }  
	    $scope.loadFile = false;
		$scope.openLocalUrl = function ( file ) { 
	    	path = $scope.ExternalPath; 
			if( ionic.Platform.isIOS() ){
      			window.open( path+file,'_blank','EnableViewPortScale=yes,location=no');
	      	}else{ 
	      		//window.open( path+file,'_system','location=yes');
	      		var externalUrlFile = path+file;
	      		var internalUrlFile = cordova.file.externalApplicationStorageDirectory+file;
	      		
	      		window.resolveLocalFileSystemURL(internalUrlFile, function () {
					cordova.plugins.fileOpener2.open( 
		      			internalUrlFile, 
		      			mime.getType( file ) 
					);
				}, function () {
					$scope.loadFile = true;
		      		$cordovaFileTransfer.download(externalUrlFile, internalUrlFile, {}, true)
			    	.then(function(result) {
			    		$scope.loadFile = false;
			    		cordova.plugins.fileOpener2.open( 
			      			internalUrlFile, 
			      			mime.getType( file ) 
						);
			    	})
				}) 
	      	}
		} 
	    ////////////////************************//////////////////
})   
.controller('historiqueCtrl',  function ($scope, $rootScope, $state, $stateParams, $alert, $loader, $AjaxQuery, $filter) {
	$scope.messages = []; 
	$scope.form = {};

	$scope.$on('$ionicView.beforeEnter', function() {
		var reqData ={ 
			idProf :  localStorage.getItem('idProf'),
			idCentre :  localStorage.getItem('idCentre'),
			niveau :  localStorage.getItem('niveau')
		} 
		if(localStorage.getItem('historique') != ''){
			$rootScope.dataMessagesToParent = JSON.parse(localStorage.getItem('historique'));
		}else{
			$loader(true)
		} 
		if($rootScope.NetworkTrue){
			$AjaxQuery.post('historique', reqData).success(function(data) {
				localStorage.setItem('historique', JSON.stringify(data));
				$rootScope.dataMessagesToParent = data; 
			})
		}
	});
	$scope.directionality = function ( str ) {
		if( str.search('dir="rtl"') >= 0 && str.search("class='deletedMessage'") < 0 ){
			return "rtl";
		}else{
			return "ltr";
		}
	}
	$scope.searchInMessage = function (str) {
		// console.log(str)
		// if( str.length > 0 ){
		// 	$rootScope.dataMessagesToParent = JSON.parse(localStorage.getItem('historique'));
		// }ele
	}

})

.controller('messageToParentCtrl', function ($scope, $sce,  $state, $loader, $alert, $stateParams,  $rootScope, $AjaxQuery, $ionicModal, $timeout, $cordovaFileTransfer, API) {
	$scope.message = $rootScope.dataMessagesToParent.messages[$stateParams.key];

	$scope.MessageKey = $stateParams.key;
	
	var network = checkConnection(); 
	$rootScope.NetworkTrue = ( network.type == "none" ) ? false : true; 
	
		 //if( ionic.Platform.isIOS() ){
		 //  		$scope.ExternalPath = cordova.file.documentsDirectory;
		 //  	}else{
		 //  		// $scope.ExternalPath = "file:///data/data/com.imad.tawassolapp/files/";
		 //  		$scope.ExternalPath = cordova.file.externalDataDirectory; 
		 //  	}
	 	$scope.ExternalPath = API.server+"assets/upload/";

		$scope.trustAsHtml = function(string) {
		    return $sce.trustAsHtml(string);
		};
		setTimeout(function () {
			var width = 0;
			$('.item-destination').each(function () {
				width += parseInt( $(this).width() ) + 37;
			})
			$('.item-destination-continer .scroll').css('width', width);
		}) 
		 
		$scope.directionality = function ( str ) {
			if( str.search('dir="rtl"') >= 0 && str.search("class='deletedMessage'") < 0){
				return "rtl";
			}else{
				return "ltr";
			}
		}
		$scope.removeMessage = function () { 
			$loader(true)
			$AjaxQuery.post('removeMessage/'+$scope.message.idMessage, {} ).success(function(data) {
				console.log(data); 
				if(data=='true'){
					$state.go('tabs.historique');
					$alert.success("Message supprimé", 2000)
				}
				$loader(false)
			})
		}
	 	////////////////********** Open Modal **************//////////////////
	 	$ionicModal.fromTemplateUrl('image-modal.html', {
	      scope: $scope,
	      animation: 'slide-in-up'
	    }).then(function(modal) {
	      $scope.modal = modal;
	    });

	    $scope.openModal = function() {
	      $scope.modal.show();
	    };

	    $scope.closeModal = function() {
	      $scope.modal.hide();
	    };

	    $scope.ShowBtnDowload = false;  
	    $scope.rotateValue = 0;
	    $scope.rotateImage = function () {
	    	$scope.rotateValue += 90;
	    }
	    /////////////////////////////////// download image from server to locale ////////////////////////////////////////
	    $scope.showImage = function(fileName) { 
	        
	        $scope.imageSrc = $scope.ExternalPath+fileName;
	        $scope.openModal(); 

	    }  
		$scope.openLocalUrl = function ( file ) { 
	    	path = $scope.ExternalPath;
			if( ionic.Platform.isIOS() ){
      			window.open( path+file,'_blank','EnableViewPortScale=yes,location=no');
	      	}else{ 
	      		
	      		var externalUrlFile = path+file;
	      		var internalUrlFile = cordova.file.externalApplicationStorageDirectory+file;
	      		
	      		window.resolveLocalFileSystemURL(internalUrlFile, function () {
					cordova.plugins.fileOpener2.open( 
		      			internalUrlFile, 
		      			mime.getType( file ) 
					);
				}, function () {
					$scope.loadFile = true;
		      		$cordovaFileTransfer.download(externalUrlFile, internalUrlFile, {}, true)
			    	.then(function(result) {
			    		$scope.loadFile = false;
			    		cordova.plugins.fileOpener2.open( 
			      			internalUrlFile, 
			      			mime.getType( file ) 
						);
			    	})
				}) 
	      	}
		} 
	    ////////////////************************//////////////////
}) 

.controller('nouveauMessageCtrl',  function ($ionicHistory, $scope,$state,API, $stateParams, $rootScope, $ionicModal, $loader, $AjaxQuery,$sce, $alert, $filter, $cordovaCamera, $cordovaImagePicker, $cordovaActionSheet) {  
	
	$scope.serverUrl = API.server

	
	$scope.trustAsHtml = function(string) {
	    return $sce.trustAsHtml(string);
	};

	$scope.HtmlDecode = function HtmlDecode(html)
	{
	  	var txt = document.createElement("textarea");
	    txt.innerHTML = html;
	    return txt.value;
	}

	$scope.htmlToPlaintext = function htmlToPlaintext(html) {

		console.log(html)
		 //remove code brakes and tabs
	    html = html.replace(/\n/g, "");
	    html = html.replace(/\t/g, ""); 

	    //keep html brakes and tabs
	    html = html.replace(/<\/td>/g, "\t");
	    html = html.replace(/<\/table>/g, "\n");
	    html = html.replace(/<\/tr>/g, "\n");
	    html = html.replace(/<\/p>/g, "\n");
	    html = html.replace(/<\/div>/g, "\n");
	    html = html.replace(/<\/h>/g, "\n");
	    html = html.replace(/<br>/g, "\n"); html = html.replace(/<br( )*\/>/g, "\n");

	    //parse html into text
	    var dom = (new DOMParser()).parseFromString('<!doctype html><body>' + html, 'text/html');
	    return dom.body.textContent;	
	}
	
	
	$scope.$on('$ionicView.beforeEnter', function() { 
		
		$scope.matiere = {};
		$scope.form = {};
		$scope.form.destination = '';
		$scope.form.destinationType = ''; 
		$scope.form.content = ''; 
		$scope.matiere.selected = 'null';
		$scope.destination = '';
		$scope.type = '';
		$scope.align = 'left'; 
		$scope.file = "";  
		$scope.txtDirection = "ltr"; 

		$scope.form.dateValue = "";





		if($rootScope.NetworkTrue){ 
			$loader(true);
			var reqData ={ 
				idProf :  localStorage.getItem('idProf'),
				idCentre :  localStorage.getItem('idCentre'),
				niveau :  localStorage.getItem('niveau')
			} 
			$AjaxQuery.post('newMessage', reqData).success(function(data) {
				console.log(data);
				$scope.data = data;  
				if($scope.data.matieres.length > 1){
					$scope.matiere.selected = 'null';
				}else{
					$scope.matiere.selected = 0;
				}

				console.log($stateParams.transfer)

				

				if( $stateParams.hash != ''  ){	

					$scope.editetMessage = $rootScope.dataMessagesToParent.messages[$stateParams.hash]; 
						
					console.log($scope.editetMessage.align)

					if( $stateParams.transfer == '1'){
						$scope.form.content =  $scope.htmlToPlaintext( $scope.editetMessage.content.split("</p><br />").join("</p>") )
						$scope.editetMessage = false;
 

					}else if( $stateParams.hash != '' ){ 
						
						$scope.data.oldFile = $scope.editetMessage.file; 

						var destinationArray = []
						angular.forEach( $scope.editetMessage.destinationArray , function (array, key) {
							destinationArray.push( "_"+array.id+"_" );
						})

						setTimeout(function () {
							console.log(destinationArray)
						})

						$scope.form.destination = destinationArray.join(',');
						$scope.form.destinationType = $scope.editetMessage.type; 

						angular.forEach($scope.data.matieres, function (matiere, key) {
							if( matiere.intitule ==  $scope.editetMessage.matiere){
								$scope.matiere.selected = key;
							}
						})

						$scope.form.content = $scope.htmlToPlaintext( $scope.editetMessage.content .split("</p><br />").join("</p>"))
						$scope.align = $scope.editetMessage.align; 
						$scope.form.dateValue = $scope.editetMessage.date;  
 
					}

					$scope.changeContentMesssage()



				}
					


			}) 
		}
		
		 
	});

	$scope.removeOldFile = function () {
		$scope.data.oldFile = '';
	}

	$scope.changeContentMesssage =  function() {

		console.log( $scope );
		 
        var rtlChar = /[\u0590-\u083F]|[\u08A0-\u08FF]|[\uFB1D-\uFDFF]|[\uFE70-\uFEFF]/mg;
        var isRTL = $scope.form.content.match(rtlChar);
        if(isRTL !== null) {
            $scope.align = 'right'; 
            $scope.txtDirection = "rtl";  
        }
        else {
            $scope.align = 'left'; 
            $scope.txtDirection = "ltr";  
        }
    }
	
	$scope.sendMessage = function () {  

		var destination = $scope.form.destination; 
		// var content = tinyMCE.activeEditor.getContent(); 
		var content = $scope.form.content;//$scope.form.content; 
		 
		console.log(content)

		if( destination == '' ){
			$alert.error("Destination non renseignée")
		}
		if(destination != '' && $scope.matiere.selected =='null'){
			$alert.error("Matière non renseignée")
		}else{
			if(destination!='' && $scope.matiere.selected !='null' && content ===undefined){
				$alert.error("Message vide");
			}else{
				if( $scope.txtDirection == 'rtl' ){
					content = '<p dir="rtl">'+content+'</p>';
				}
				var reqData = { 
					'idProf' :  localStorage.getItem('idProf'),
					'idCentre' :  localStorage.getItem('idCentre'),
					'niveau' :  localStorage.getItem('niveau'),
					'destination':destination,
					'type':$scope.form.destinationType,
					'matiere':$scope.data.matieres[$scope.matiere.selected].intitule,
					'align':$scope.align,
					'content':content,
					'base64':$scope.file,
					'date': $filter('date')($scope.form.dateValue, "dd/MM/yyyy"),
					'old-file' : $scope.data.oldFile
				} 

				if( $scope.editetMessage ){
					reqData.idMessage = $scope.editetMessage.idMessage;
				}

				console.log(reqData)
				$loader(true);
				$AjaxQuery.post('SendMessageToParentByProf', reqData).success(function(data) {
					if(data == 1){
						$alert.success("Message bien envoyé", 2000)
						$state.go('tabs.historique'); 
					}
					if( data == -1 ){
						$alert.error("Vous n'êtes pas encore validé par l'administration")
					}
					if( data == -2 ){
						$alert.error("Destination non renseignée")
					}
					if( data == -3 ){
						$alert.error("Le compte de votre établissement est désactivé")
					}
				}) 
			}
		}
			
		
	}
	$scope.toggleGroup = function(group) {
	    if ($scope.isGroupShown(group)) {
	      $scope.shownGroup = null;
	    } else {
	      $scope.shownGroup = group;
	    }
	};
	$scope.isGroupShown = function(group) {
	    return $scope.shownGroup === group;
	};
	$scope.isFr = true;
	$scope.changeLangue = function ( lang ) {
		$scope.isFr = (lang=='fr')?true:false;
	}
	$scope.selectModele = function (model) {
		 $scope.contentArea = $filter('truncate')(model.content);
		 $scope.align = model.align;
		 // tinyMCE.activeEditor.setContent(model.content, {format : 'raw'});  
		 $scope.closeModal();
	}
	$scope.viewList = function (id) {  

  		$(id).toggleClass("active");
  		$(id).next().slideToggle();
	}
	$scope.SetDestination = function ( idSpan ) { 
		$(idSpan).find('i.icon-check').toggleClass('ion-android-checkbox-outline');
		$(idSpan).parent().toggleClass('active')
        $(idSpan).parent().parent().parent().removeClass('active');
        if( $(idSpan).parent().hasClass('active') ){

          if( $scope.form.destinationType != '' && $scope.form.destinationType == $(idSpan).attr('data-type')  ){
            $(idSpan).parent().addClass('active');
            $('.destination .scroll').append('<span class="'+$(idSpan).attr('data-type')+$(idSpan).attr('data-id')+'">'+$(idSpan).attr('data-text')+'</span>');
            
            var array = $scope.form.destination.split(',');
            array.push($(idSpan).attr('data-id'));
            $scope.form.destination = array.join(',');

          }
          else{
            $('.destinations').find('li').removeClass('active').find('.icon-check').removeClass('ion-android-checkbox-outline');
            $(idSpan).parent().addClass('active')
            $(idSpan).find('i.icon-check').addClass('ion-android-checkbox-outline')

            $('.destination .scroll').html('<span class="'+$(idSpan).attr('data-type')+$(idSpan).attr('data-id')+'">'+$(idSpan).attr('data-text')+'</span>'); 
            $scope.form.destination =$(idSpan).attr('data-id'); 
            $scope.form.destinationType = $(idSpan).attr('data-type');  

          } 
          
        }else{

           $(idSpan).find('li').addClass('active');
           $('.destination .scroll').find('span.'+$(idSpan).attr('data-type')+$(idSpan).attr('data-id')).remove(); 
           var array = $scope.form.destination.split(',');
           array.splice(array.indexOf($(idSpan).attr('data-id')), 1);

           $scope.form.destination =array.join(',');
           if( $scope.form.destination == '' ){
            $scope.form.destinationType ='';

           }
           
        }  
        console.log($scope.form.destination)
	}
	function toDataUrl(src, callback, outputFormat) {
	  var img = new Image();
	  img.crossOrigin = 'Anonymous';
	  img.onload = function() {
	    var canvas = document.createElement('CANVAS');
	    var ctx = canvas.getContext('2d');
	    var dataURL;
	    canvas.height = this.height;
	    canvas.width = this.width;
	    ctx.drawImage(this, 0, 0);
	    dataURL = canvas.toDataURL(outputFormat);
	    callback(dataURL);
	  };
	  img.src = src;
	  if (img.complete || img.complete === undefined) {
	    img.src = "data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==";
	    img.src = src;
	  }
	}
  
	$scope.ChooserFile = function () {
		var options = {
		    title: 'Choisir une option',
		    buttonLabels: ['Appareil photo', 'Galerie'],
		    addCancelButtonWithLabel: 'Annuler',
		    androidEnableCancelButton : true,
		    winphoneEnableCancelButton : true
		 };
		$cordovaActionSheet.show(options)
	    .then(function(btnIndex) {
	    	console.log(btnIndex)
	        if(btnIndex == 1){
	        	$scope.OpenCamera();
	        }else if(btnIndex == 2){
	        	$scope.OpenGallery();
	        }
	    });

	}
	$scope.OpenCamera = function () {  

		if( ionic.Platform.isIOS() ){ 
		    var options = {
		      	destinationType: navigator.camera.DestinationType.DATA_URL,
		        targetHeight: 600,
		        targetWidth: 600,
		        encodingType: navigator.camera.EncodingType.PNG,
	            quality: 100  
		    };	
		}else{
	    	var options = {
		      quality: 100,
		      destinationType: Camera.DestinationType.DATA_URL,
		      sourceType: Camera.PictureSourceType.CAMERA,
		      allowEdit: false,
		      encodingType: Camera.EncodingType.JPEG,
		      targetWidth: 600,
		      // targetHeight: 100,
		      popoverOptions: CameraPopoverOptions,
		      saveToPhotoAlbum: false,
			  correctOrientation:true
		    };
	    }
	    

	    $cordovaCamera.getPicture(options).then(function(imageData) { 
	      $scope.file = "data:image/jpeg;base64," + imageData; 
	    }, function(err) {
	      // error
	    });
	}
	$scope.OpenGallery = function () {  

		if( ionic.Platform.isIOS() ){ 
			var options = {
			   maximumImagesCount: 1, 
			   quality: 100,
			   width: 600,
		       height: 600,
		 	};
			$cordovaImagePicker.getPictures(options)
		    .then(function (results) {
		     
		      	toDataUrl( results[0], function(base64Img) {
				  $scope.file=base64Img;
				}); 
 
		    }, function(error) {
		       
		    });
		}else{   
		 	var options = {	
				sourceType: navigator.camera.PictureSourceType.PHOTOLIBRARY,
                destinationType: navigator.camera.DestinationType.DATA_URL,
                maximumImagesCount: 1, 
			   	quality: 100,
			   	width: 600,
		        height: 600,
			   	correctOrientation:true

			}
			$cordovaCamera.getPicture(options).then(function(imageData) { 
		      $scope.file = "data:image/jpeg;base64," + imageData; 
		    }, function(err) {
		      // error
		    });
	 	}
	  	
	}

	$scope.removeFile = function () {
		$scope.file = "";
	} 

	$ionicModal.fromTemplateUrl('destination-modal.html', {
		scope: $scope,
		animation: 'slide-in-up'
	}).then(function(modal) {
	    $scope.modal1 = modal;
	});

	$ionicModal.fromTemplateUrl('matiere-modal.html', {
		scope: $scope,
		animation: 'slide-in-up'
	}).then(function(modal) {
	    $scope.modal2 = modal;
	});

	$ionicModal.fromTemplateUrl('model-modal.html', {
		scope: $scope,
		animation: 'slide-in-up'
	}).then(function(modal) {
	    $scope.modal3 = modal;
	});

	$scope.openModal1 = function() {
		// $scope.form = {};
		$scope.form.destination = '';
		$scope.form.destinationType = '';
		if( $('.destination .scroll')[0] ){
			$('.destination .scroll').html('');
		}
		
		$scope.modal1.show();
	};
	$scope.openModal2 = function() {
		$scope.modal2.show();
	};
	$scope.openModal3 = function() {
		$scope.modal3.show();
	};
	$scope.$on('$destroy', function() {
      $scope.modal.remove();
    }); 
	$scope.closeModal = function() {
		if( $scope.modal1 ){
			$scope.modal1.remove()
		    .then(function() {
		      	$ionicModal.fromTemplateUrl('destination-modal.html', {
					scope: $scope,
					animation: 'slide-in-up'
				}).then(function(modal) {
				    $scope.modal1 = modal;
				});
		    });
		}
		if( $scope.modal2 ){
			$scope.modal2.remove()
		    .then(function() {
		      $ionicModal.fromTemplateUrl('matiere-modal.html', {
					scope: $scope,
					animation: 'slide-in-up'
				}).then(function(modal) {
				    $scope.modal2 = modal;
				});
		    });
		}
		if( $scope.modal3 ){
			$scope.modal3.remove()
		    .then(function() {
		      $ionicModal.fromTemplateUrl('model-modal.html', {
					scope: $scope,
					animation: 'slide-in-up'
				}).then(function(modal) {
				    $scope.modal3 = modal;
				});
		    });
		}
	}; 


})

.controller('absenceCtrl',  function ($ionicHistory, $scope,$state,API, $stateParams, $rootScope, $ionicModal, $loader, $AjaxQuery,$sce, $alert, $filter, $cordovaCamera, $cordovaImagePicker, $cordovaActionSheet) {  

	$scope.$on('$ionicView.beforeEnter', function() { 


		var currentDate = new Date();
		var dd = currentDate.getDate();
		var mm = currentDate.getMonth()+1; //January is 0!
		var yyyy = currentDate.getFullYear(); 
		if(dd<10) {
		    dd = '0'+dd
		}  
		if(mm<10) {
		    mm = '0'+mm
		}  
		today = dd + '/' + mm + '/' + yyyy; 

		$scope.data = {
			date: today,
			time: currentDate.getHours() + ":" + "00",
			matieres: [],
			destination: [],
			groupes: [],
			eleves: [],
			absence: [],
			retard: []
		}

		var reqData ={ 
			idProf :  localStorage.getItem('idProf'),
			idCentre :  localStorage.getItem('idCentre'),
			niveau :  localStorage.getItem('niveau')
		} 

		$AjaxQuery.post('absense', reqData).success(function(data) {
			$scope.data.matieres = data.matieres;
			$scope.data.destination = data.destination;
		})
	})


	$scope.changeClasse = function () { 
		$scope.data.groupes = $scope.data.destination[ $scope.data.selectclasse ].groupes;
		 
	}

	$scope.changeGroupe = function () { 
		console.log($scope.data)

		if( $scope.data.selectgroupe.length > 0 ){
			var dataGroupe = $scope.data.destination[ $scope.data.selectclasse ].groupes[$scope.data.selectgroupe];

			if( dataGroupe.hasOwnProperty('eleves') ){
				
				$scope.data.eleves = dataGroupe.eleves;

				$scope.data.classe = dataGroupe.dataClasse;
				$scope.data.groupe = dataGroupe.dataGroupe;

				$scope.hasEleves = true;

			}else{
				$scope.data.eleves = []
				$scope.hasEleves = false;
			}
		}else{
			$scope.data.eleves = []
			$scope.hasEleves = false;
		}
			
	}

	$scope.toggleSelection = function (type, value) {

		if( type == 'abs' ){
			var idx = $scope.data.absence.indexOf(value); 
		    // Is currently selected
		    if (idx > -1) {
		      $scope.data.absence.splice(idx, 1);
		    } 
		    // Is newly selected
		    else {
		      $scope.data.absence.push(value); 
		    }

		    var reatrd = $('.tdRetard input[data-value='+value+']')
	      	if( reatrd.is(":checked") ){
	      		reatrd.prop('checked', false);
	      	}

		}else{
			var idx = $scope.data.retard.indexOf(value); 
		    // Is currently selected
		    if (idx > -1) {
		      $scope.data.retard.splice(idx, 1);
		    } 
		    // Is newly selected
		    else {
		      $scope.data.retard.push(value);  
		    }

		    var absence = $('.tdAbsence input[data-value='+value+']')
	      	if( absence.is(":checked") ){
	      		absence.prop('checked', false);
	      	}
		}

	    
	};

	$scope.sendAbsence = function () {
 
		if( !$scope.data.matiere ){
			$alert.error('Veuillez choisir la matière enseignées');
			return
		}

		if( $scope.data.absence.length == 0 &&  $scope.data.retard.length == 0 ){
			$alert.error('Veuillez renseigner un absence / retard');
			return
		}

		var data = {
			matiere: $scope.data.matiere,
			classe: $scope.data.classe,
			groupe: $scope.data.groupe,
			date: $filter('date')($scope.data.date, "dd-MM-yyyy"),
			time: $filter('date')($scope.data.time, "H:m"),
			absence: $scope.data.absence,
			retard: $scope.data.retard
		}
		console.log($scope.data.absence)
		console.log($scope.data.retard)
		 
		var reqData ={ 
			idProf :  localStorage.getItem('idProf'),
			idCentre :  localStorage.getItem('idCentre'),
			niveau :  localStorage.getItem('niveau'),
			data:  JSON.stringify(data)
		}  

		$AjaxQuery.post('insertAbsenceFromProf', reqData).success(function(data) {
			$alert.success('l\'opération a été complétée avec succès',2000)
			$state.go('tabs.historique')
		})

	}
})
 
.controller('rGlageCtrl', function ($scope, $state, $stateParams, $rootScope, $cordovaBadge, $ionicHistory) {

	$scope.logOut = function () {
		localStorage.setItem('logged_in_prof', "false");
		localStorage.removeItem('idProf');
		localStorage.removeItem('idCentre');
		localStorage.removeItem('niveau');
		localStorage.removeItem('nom');
		localStorage.setItem('messages', "");
		localStorage.setItem('historique', "");
		$cordovaBadge.set(0);
		$rootScope.badge = 0;
		$ionicHistory.clearCache();
   		$ionicHistory.clearHistory();
		$state.go('login');
	}

})

.controller('enploiCtrl', function ($scope, $rootScope, $state, $stateParams, $alert, $loader, $AjaxQuery) {
	
	$scope.$on('$ionicView.beforeEnter', function() {  
		$scope.callback = false;
		$AjaxQuery.post('getEmploiProf/'+localStorage.getItem('idProf'), {}).success(function(data) { 
			if( data.success ){
				$scope.emploiProf = data.emploiProf;
				$scope.callback = true;
			}
		})
	}); 

})
   
.controller('personnelInfoCtrl', function ($scope, $rootScope, $state, $stateParams, $alert, $loader, $AjaxQuery) {
	
	$loader(true);
	var reqData ={ 
		idProf :  localStorage.getItem('idProf'),
		idCentre :  localStorage.getItem('idCentre'),
		niveau :  localStorage.getItem('niveau')
	} 
	$AjaxQuery.post('profile', reqData).success(function(data) { 
		console.log(data);
		
		$scope.data = data.prof; 
	})

	$scope.updateInfo = function () {
		$loader(true);
		var reqData ={ 
			idProf :  localStorage.getItem('idProf'),
			idCentre :  localStorage.getItem('idCentre'),
			niveau :  localStorage.getItem('niveau'), 
			nom: $scope.data.nom,
            email: $scope.data.email,
            tel: $scope.data.tel,
            about: ''
		} 
		$AjaxQuery.post('update', reqData).success(function(data) { 
			console.log(data);
			
			$alert.success('Les informations sont bien enregistrées',2000)
		})
	}

})

.controller('bugCtrl',  function ($scope,$rootScope, $stateParams, $AjaxQuery, $alert, $loader) { 
	$scope.sendRapport = function sendRapport() {

		if( $scope.contentBug != '' ){ 
			var reqData = {
				idProf :  localStorage.getItem('idProf'),
				idCentre :  localStorage.getItem('idCentre'),
				niveau :  localStorage.getItem('niveau'), 
				content : $scope.contentBug,
		        from : 'prof',
		        idFrom : localStorage.getItem('idProf')
			}
			 if( $rootScope.NetworkTrue ){  
				$loader(true); 
				$AjaxQuery.post('signalerProbleme', reqData ).success(function(data) {
					
					if( data == "true" ){  
			             $alert.success('Merci. Vos commentaires nous aideront à améliorer TawassolApp.',3000);
			             $scope.contentBug = '';
			        }else{ 
			            $alert.error('Erreur, essayer plus tard',3000)
			        } 
				})
			 }else{
			 	alert( "Pas de connexion Internet" );
			 }
		}
	} 

}) 

.controller('pwdCtrl', function ($scope,$rootScope, $stateParams, $AjaxQuery, $alert, $loader) { 
	 
	$scope.changePwd = function () { 
		if( $scope.oldPwd!='' &&  $scope.newPwd!='' &&  $scope.confirmPwd!='' ){
			if($scope.newPwd!=$scope.confirmPwd){
				$alert.error("Merci de bien confirmer votre mot de passe")
			}else{
				var reqData ={ 
					idProf :  localStorage.getItem('idProf'),
					idCentre :  localStorage.getItem('idCentre'),
					niveau :  localStorage.getItem('niveau'), 
					oldPassword: $scope.oldPwd,
		            NewPassword: $scope.newPwd
				} 
				$loader(true);
				$AjaxQuery.post('changePwd', reqData).success(function(data) {  
					
					if(data == "true"){
						$alert.success('Le mot de passe est bien modifié',3000)
					}else{
						$alert.error("L'ancien mot de passe est incorrect")
					}
					
				})
			}
		}else{
			$alert.error("Veuiller remplire tous les champs")
		} 
	} 

})
 