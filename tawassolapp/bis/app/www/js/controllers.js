///////////////***** Global Varibles ******/////////////////////////
window.onerror = function(message, url, lineNumber) {
    //alert("Error: "+message+" in "+url+" at line "+lineNumber);
} 
 
 
function checkConnection() {
    return {
    	type : "3G",
    	value :true
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
// localStorage.setItem('adresseMac','08:EE:8B:BB:80:8E');  
if( !localStorage.getItem('customBackground') ){
	localStorage.setItem('customBackground',"url(img/bg/bg1.jpeg)"); 
}
if( !localStorage.getItem('fileDownloaded') ){
	var obj = {};
	localStorage.setItem('fileDownloaded', JSON.stringify(obj));
	localStorage.setItem('logosDownloaded', JSON.stringify(obj));
	localStorage.setItem('login',"false")
} 

////////////////////////////////////////////////////////////////////
angular.module('app.controllers', [])

.controller('NotifCtrl', ['$scope', "$state", '$stateParams','$rootScope','$AjaxQuery', '$cordovaBadge', '$alert', '$cordovaLocalNotification', '$interval', 
function ($scope, $state, $stateParams, $rootScope, $AjaxQuery, $cordovaBadge, $alert, $cordovaLocalNotification, $interval) {  

	$rootScope.$on("checkConnectionInternet", function(){
           $scope.checkConnectionInternet();	
    }); 
    $rootScope.$on("UpdateBadge", function(){
           $scope.UpdateBadge();
    });
    $scope.checkConnectionInternet = function () {
    	var network = checkConnection(); 
		$rootScope.NetworkTrue = ( network.type == "none" ) ? false : true; 
    } 
	$scope.UpdateBadge = function UpdateBadge() {
		var notifBadge =  parseInt( localStorage.getItem('notif') );
		if(notifBadge <= 0){
			localStorage.setItem('notif', 0);
			notifBadge = 0;
		}   
		$rootScope.notifBagde  = notifBadge;  
		if( notifBadge ){
			//cordova.plugins.notification.badge.set( notifBadge );
		} else{
			//cordova.plugins.notification.badge.set( 0 );
		}
		if( window.cordova ){
			cordova.plugins.notification.badge.set( 0 );
		}

	}
	$scope.UpdateBadge();

}])
 




.controller('homeCtrl', function ($scope, $stateParams, $AjaxQuery, API, $state, $interval, $rootScope, $alert, $cordovaLocalNotification, USERDATA, $ionicModal ) { 

 	
 	$ionicModal.fromTemplateUrl('liststudents-home.html', {
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

	$scope.connectUser = function (idClient) { 
		USERDATA.setCurrentUser(idClient); 
	 	$state.go('tabs.messages');
	 	$scope.closeModal()
	}
	

	$scope.login = function (reqData) {
		$AjaxQuery.post('login', reqData ).success(function(data) {  
	 		if( data.login == 'false' ){ 
	 			$state.go('register');
	 		}else{ 
	 			localStorage.setItem('login', "true")   

	 			USERDATA.setStudents(data.students); 

	 			if( data.students.length > 1 ){
	 				$scope.students = data.students;
	 				$scope.openModal();
	 			}else{  
	 				$scope.students = data.students;
	 				$scope.connectUser(data.students[0].idClient) 

	 			}

	 			$interval(function () { 
					$rootScope.$emit("checkConnectionInternet", {}); 
				},3000)  

	 		}
		})
	}


	// ////////////////////////////////////////////////////////
	// $scope.login({
	// 	adresseMac   : "3A90369C-0603-4F56-A9A5-3B3D1CA6B577",
	// 	token	: "3A90369C-0603-4F56-A9A5-3B3D1CA6B577",
	// 	appname: API.appId
	// }) 
	// localStorage.setItem('adresseMac',"3A90369C-0603-4F56-A9A5-3B3D1CA6B577"); 
	// ////////////////////////////////////////////////////////

	function onDeviceReady() { 
		var element = document.getElementById('deviceProperties'); 




		if( localStorage.getItem('login') == "false" || localStorage.getItem('login') == "" ){ 
			///////////////////////////////// Test Connexion ///////////////////////////////////////////////
			var network = checkConnection(); 
			$rootScope.NetworkTrue = ( network.type == "none" ) ? false : true; 
			////////////////////////////////////////////////////////////////////////////////////////////////
			window.plugins.uniqueDeviceID.get(function (adresseMac){  
			 		console.log("adresseMac ",adresseMac )
		            localStorage.setItem('adresseMac',adresseMac); 
		            
		            window.FirebasePlugin.getToken(function(token) { 
			            var reqData ={ 
							 adresseMac   : localStorage.getItem('adresseMac'),
							 token	: token,
							 appname: API.appId
						} 
						if( $rootScope.NetworkTrue ){ 
							$scope.login(reqData)
						}else{
							alert( "Pas de connexion internet" );
							onDeviceReady();
						}
					}, function(error) {
				        console.error("FirebasePlugin ",error);
				    });

		        },function(fail) { 
		            alert(fail);
		        }
		    ); 
		}else{ 
			$state.go('tabs.messages'); 
			$interval(function () {  
				$rootScope.$emit("checkConnectionInternet", {}); 
			},3000); 

		}
	}
	$scope.$on('$ionicView.beforeEnter', function() {
		document.addEventListener('deviceready', onDeviceReady, false);
	}) 
	// document.addEventListener('deviceready', onDeviceReady, false); 


	
	 
})











.controller('messagesCtrl',  function ($scope,$cordovaFileTransfer, $state, API, $stateParams, $AjaxQuery, $rootScope, $ionicPopover, $cordovaLocalNotification, $ionicScrollDelegate, USERDATA ) { 

	$scope.Messages = [];

	$scope.student = USERDATA.getCurrentUserInfos()
	$scope.CurrentUser = USERDATA.getCurrentUser() 
	

	console.log($scope.student, $scope.CurrentUser);

	$scope.active = 1;

	$scope.urlLogos = API.server+"assets/upload/logos/";
	$scope.$on('$ionicView.beforeEnter', function() {
        $scope.GetMessages() // Call Messages
        $scope.EleveSelected = {};  
    });
	$scope.dataFilterEleves = []; 

 	if( window.cordova ){
 		$cordovaLocalNotification.cancelAll()
 	}

 	$rootScope.$on("CallMessages", function(){
           $scope.GetMessages();
    });  

 	$scope.RefreshMessages = function () {
 		setTimeout(function () {
 			$scope.GetMessages();
 		},1000)
 	}

 	$scope.gotoListeEleve = function () {
 		$state.go('tabs.setting')
 		setTimeout(function () {
 			$state.go('tabs.students')
 		})
 	}

 	$scope.directionality = function ( str ) {
		if( str.search('dir="rtl"') >= 0 ){
			return "rtl";
		}else{
			return "ltr";
		}
	}
    $scope.dataFilterEleves =[]

    var unique = function(origArr) {
	    var newArr = [],
	        origLen = origArr.length,
	        found, x, y;

	    for (x = 0; x < origLen; x++) {
	        found = undefined;
	        for (y = 0; y < newArr.length; y++) {
	            if (origArr[x] === newArr[y]) {
	                found = true;
	                break;
	            }
	        }
	        if (!found) {
	            newArr.push(origArr[x]);
	        }
	    }
	    return newArr;
	}  
    $scope.isJson = function( str ) {
	    try {
	        JSON.parse(str);
	    } catch (e) {
	        return false;
	    }
	    return true;
	}
 
	$scope.GetMessages = function() {

		$scope.dataBadge = {
			devoir	: 0,
			discipline	: 0,
			actualite	: 0
		}
		var messages = USERDATA.getMessages();  

		angular.forEach(messages, function (message, key) {
			if( message.vu != 'true' ){  

				switch( message.message_type ){
					case 'devoir': 
						$scope.dataBadge.devoir++;
						$scope.Messages.push( message );
						break;
					case 'discipline': 
						$scope.dataBadge.discipline++;
						break;
					case 'actualite': 
						$scope.dataBadge.actualite++;
						break;
				}
			} 

			if( ionic.Platform.isIOS() ){
				$scope.downloadDeletedFile( message );
			}
		})

		$scope.filter('devoir', 1)

		if( $rootScope.NetworkTrue ){  
			window.FirebasePlugin.getToken(function(token) { 
				var reqData ={
					token: token,
					appname: API.appId
				} 
				$AjaxQuery.post('messages/'+$scope.CurrentUser, reqData ).success(function(data) {

					$scope.$broadcast('scroll.refreshComplete');

					

					if( data=="NoStudents" ){
 
						if( USERDATA.getStudents().length > 1 ){
							localStorage.setItem('login', "false") 
							$state.go("home");
						}else{
							$state.go("blocked");
							localStorage.setItem('notif', 0 );
							$rootScope.$emit("UpdateBadge", {});
						}

					}else{

						if( $scope.isJson(JSON.stringify(data)) ){

							USERDATA.setMessages( data )

							$scope.filter('devoir', 1)

							$scope.active = 1;
							var nbrMessagesReaded = 0;
							var nbrMessagesNotRead = 0;

							$scope.dataBadge = {
								devoir	: 0,
								discipline	: 0,
								actualite	: 0
							}
							
							angular.forEach(data, function (message, key) {
								if( message.vu == 'true' ){
									nbrMessagesReaded++;
								}else{
									nbrMessagesNotRead++;

									switch( message.message_type ){
										case 'devoir': 
											$scope.dataBadge.devoir++;
											$scope.Messages.push( message );
											break;
										case 'discipline': 
											$scope.dataBadge.discipline++;
											break;
										case 'actualite': 
											$scope.dataBadge.actualite++;
											break;
									}
								} 

								if( ionic.Platform.isIOS() ){
									$scope.downloadDeletedFile( message );
								}
							})
							localStorage.setItem('totalMessages', nbrMessagesReaded + nbrMessagesNotRead ); 
							localStorage.setItem('messageNotReaded', nbrMessagesNotRead ); 
							if( nbrMessagesNotRead > 0 ){
								//console.log( nbrMessagesNotRead )
								localStorage.setItem('notif', nbrMessagesNotRead );
								$rootScope.$emit("UpdateBadge", {});
							}else{
								localStorage.setItem('notif', 0 );
								$rootScope.$emit("UpdateBadge", {});
							}


						}


					} 
				}) 
			}, function(error) {
		        console.error("FirebasePlugin ",error);
		    });

		}else{
			setTimeout(function () {
				$scope.GetMessages();
			}, 500)
		}
	} 

	//////////////////// Filter  
	$scope.filter = function(arg, active) {  
		$scope.active = active;
		$ionicScrollDelegate.scrollTop();
		
		var messages = USERDATA.getMessages(); 
		$scope.Messages = []

		angular.forEach(messages, function (message, key) {
			if( message.message_type == arg ){
				$scope.Messages.push( message );
			}
		}) 
	}     
	///////////////////////////

	//// pop hover 
	$scope.openPopover = function ($event, ecole, logo) {

		///////////////////////////////// Test Connexion ///////////////////////////////////////////////
		var network = checkConnection(); 
		$rootScope.NetworkTrue = ( network.type == "none" ) ? false : true; 
		////////////////////////////////////////////////////////////////////////////////////////////////

		var serverUrl = API.server+"assets/upload/";
		var SmallLogo = API.server+"assets/upload/logos/";
		if( ionic.Platform.isIOS() ){
      		$scope.ExternalPath = cordova.file.documentsDirectory;
      	}else{
      		// $scope.ExternalPath = "file:///data/data/com.imad.tawassolapp/files/";
      		$scope.ExternalPath = cordova.file.externalDataDirectory; 
      	} 

      	var downloadedLogos = JSON.parse( localStorage.getItem('logosDownloaded') ); 
   		var findVal = 0; 
   		angular.forEach(downloadedLogos,function (key, value) {

   			if ( logo == parseInt( value ) ) { 
	   			findVal++;
	   			console.log("downloaded");
	   		} 
   		}) 
   		$scope.downloaded = ( findVal > 0 ) ? true : false;
 

		if( logo == "img/nologo.png"){
			var template = '<ion-popover-view><ion-header-bar> <h1 class="title">'+ecole+'</h1> </ion-header-bar> <div class="ion-content"><img width="100%" src="'+logo+'"></div></ion-popover-view>';
		}else{
			if( $scope.downloaded ){
				var template = '<ion-popover-view><ion-header-bar> <h1 class="title">'+ecole+'</h1> </ion-header-bar> <div class="ion-content"><img width="100%" src="'+$scope.ExternalPath+logo+'"></div></ion-popover-view>';
			}else if( !$scope.downloaded && $rootScope.NetworkTrue ){
				$scope.downloadImage( logo );
				var template = '<ion-popover-view><ion-header-bar> <h1 class="title">'+ecole+'</h1> </ion-header-bar> <div class="ion-content"><img width="100%" src="'+serverUrl+logo+'"></div></ion-popover-view>';
			} 
			else if(!$scope.downloaded && !$rootScope.NetworkTrue){
				var template = '<ion-popover-view><ion-header-bar> <h1 class="title">'+ecole+'</h1> </ion-header-bar> <div class="ion-content"><img width="100%" src="'+SmallLogo+logo+'"></div></ion-popover-view>';
			}
		} 
		
		$scope.popover = $ionicPopover.fromTemplate(template, {
		    scope: $scope
		}); 
		$scope.popover.show($event);
	}
	$scope.downloadImage = function (logo) {

    	$scope.downloading = true; 
    	var urlImage = API.server+"assets/upload/"+logo;  
      	var targetPath = $scope.ExternalPath+logo; 

	    $cordovaFileTransfer.download(urlImage, targetPath, {}, true)
	    .then(function(result) { 

		    var JSONDownloadedLogos = JSON.parse( localStorage.getItem('logosDownloaded') );
		    //console.log("Before",JSONDownloadedLogos)
		    JSONDownloadedLogos[logo] = logo;
		    //console.log("After",JSONDownloadedLogos)
			localStorage.setItem('logosDownloaded', JSON.stringify( JSONDownloadedLogos ) );

	    },function(err) {  

	        $scope.downloading = false; 
	        $scope.downloaded = false; 
	        
	    },function(progress) { 
	    	$scope.progressing = (progress.loaded / progress.total) * 100; 
	    });
    }


    $scope.downloadDeletedFile = function (message) {

    	var downloadedFiles = JSON.parse( localStorage.getItem('fileDownloaded') ); 
   		var findVal = 0;
   		angular.forEach(downloadedFiles,function (key, value) {

   			if ( parseInt( message.idMessage ) == parseInt( value ) ) { 
	   			findVal++;
	   		} 
   		})  
   		setTimeout(function () {
   			if( findVal > 0 ){ 

   				var filePath = API.server+"assets/upload/";
		    	var targetPath = cordova.file.dataDirectory+"/"+message.file; 

		    	window.resolveLocalFileSystemURL(targetPath, function () {
					console.log("File existe")
				}, function () {
					console.log("File Not existe, start new downloading...")

					if( $rootScope.NetworkTrue ){ 

						if( message.typeFile == 'notImage' ){
							var urlImage = API.server+"assets/upload/"+message.file; 
						}else{
							var urlImage = API.server+"assets/upload/android/"+message.file; 
						}  

						$cordovaFileTransfer.download(urlImage, targetPath, {}, true)
					    .then(function(result) {      
					         console.log("downloaded");
					    }); 
					}
				})

				// window.resolveLocalFileSystemURL("", function () {
				// 	console.log("File existe")
				// }, function () {
				// 	console.log("File Not existe, start new downloading...") 
				// })
			}
		})
    }
	

	
})




















.controller('messageCtrl', function ($scope,$sce,$loader,$cordovaToast, API, $stateParams,  $rootScope, $AjaxQuery, $ionicModal, $timeout, $cordovaFileTransfer, $cordovaFile, USERDATA) {   
		


	if( $stateParams.idMessage != null || localStorage.getItem('idMessage') ){  
		 
		$scope.filePath = API.server+"assets/upload/thumbs/";
		///////////////////////////////// Test Connexion ///////////////////////////////////////////////
		var network = checkConnection(); 
		$rootScope.NetworkTrue = ( network.type == "none" ) ? false : true; 
		////////////////////////////////////////////////////////////////////////////////////////////////

		if( ionic.Platform.isIOS() ){
      		// $scope.ExternalPath = cordova.file.documentsDirectory;
      		// $scope.ExternalPath = cordova.file.applicationStorageDirectory
      		$scope.ExternalPath = cordova.file.dataDirectory+"/";//cordova.file.documentsDirectory
      	}else{
      		// $scope.ExternalPath = "file:///data/data/com.imad.tawassolapp/files/";
      		// $scope.ExternalPath = cordova.file.externalDataDirectory; 
      		$scope.ExternalPath = cordova.file.externalApplicationStorageDirectory;
      	}


		$scope.$on('$ionicView.beforeEnter', function() {
	        $scope.customBackground = localStorage.getItem('customBackground'); 
	        //$scope.fileDownloaded = false;
	    });
	    $scope.trustAsHtml = function(string) {
		    return $sce.trustAsHtml(string);
		};
		$scope.directionality = function ( str ) {

			if( str && str.search('dir="rtl"') >= 0 ){
				return "rtl";
			}else{
				return "ltr";
			}
		}
	    $scope.DownloadFile = function(fileName) {   
	    	
	      	var urlFile = API.server+"assets/upload/"+fileName; 

	      	var targetPath = $scope.ExternalPath+fileName;
	      	
		    var trustHosts = true;
		    var options = {};  
			
		    $cordovaFileTransfer.download(urlFile, targetPath, options, trustHosts)
		    .then(function(result) {  
		    	console.log("success Download", result)   

		        $scope.downloading = false; 
		        $scope.downloaded = true;  

		        var JSONDownloadedFIle = JSON.parse( localStorage.getItem('fileDownloaded') ); 
		    	JSONDownloadedFIle[$scope.Message.idMessage] = $scope.Message.idMessage;
		    	localStorage.setItem('fileDownloaded', JSON.stringify( JSONDownloadedFIle ) );

		    	$scope.downloadFileToGallery( targetPath ); // for android

		    },function(err) { 
		       console.log("error Download", err) 
		    },function(progress) {
		        console.log("Downloading...", progress) 
		    }); 
			

	    }
		$scope.downloadImage = function (fileName) {

	    	$scope.downloading = true; 
	    	var urlImage = API.server+"assets/upload/android/"+fileName;   
	      	var targetPath = $scope.ExternalPath+fileName; 

	      	console.log("HERE", urlImage) 
	      	 
      		$cordovaFileTransfer.download(urlImage, targetPath, {}, true)
		    .then(function(result) {    
		    	console.log("success Download", result)  
		    	$scope.downloading = false; 
		        $scope.downloaded = true;   

		        var JSONDownloadedFIle = JSON.parse( localStorage.getItem('fileDownloaded') ); 
		    	JSONDownloadedFIle[$scope.Message.idMessage] = $scope.Message.idMessage;
		    	localStorage.setItem('fileDownloaded', JSON.stringify( JSONDownloadedFIle ) );

		        $scope.downloadFileToGallery( targetPath );
		        

		    },function(err) {  
		    	console.log("error Download", err) 
		        $scope.downloading = false; 
		        $scope.downloaded = false; 
		        
		    },function(progress) { 
		    	console.log("Downloading...", progress) 
		    }); 
	    }

	    
		$scope.downloaded = true;

		var newData = USERDATA.getMessages();

		console.log(newData) 
		
	 	angular.forEach( newData, function(message, key) { 
	 		
		   if( parseInt(message.idMessage) == parseInt($stateParams.idMessage) && parseInt(message.idClient) == parseInt($stateParams.idClient) ){  
		   		//console.log("idMessage", message.idMessage) 
		   		$scope.Message = message;

		   		if( message.message_type == 'devoir' ){
	   				$scope.page_title = message.matiere
	   			}
	   			if( message.message_type == 'discipline' ){
	   				$scope.page_title = "Administration"
	   			}
	   			if( message.message_type == 'actualite' ){
	   				$scope.page_title = "Évènement"
	   			}
		   		
		   		////// If downloaded file
		   		//console.log( localStorage.getItem('fileDownloaded') )
		   		
		   		if( message.file != '' ){
		   			var downloadedFiles = JSON.parse( localStorage.getItem('fileDownloaded') ); 
		   			console.log(downloadedFiles);
			   		var findVal = 0;
			   		angular.forEach(downloadedFiles,function (key, value) {

			   			if ( message.idMessage == parseInt( value ) ) { 
				   			findVal++;  
				   			
				   		} 
			   		})  
			   		setTimeout(function () {
			   			if( findVal > 0 ){ 
			   				$scope.downloaded = true;  
				   		}else{
				   			$scope.downloaded = false;
				   			console.log( message.typeFile )
				   			if( message.typeFile != 'notImage' ){
				   				if( $rootScope.NetworkTrue ){
					   				$scope.downloadImage( message.file ); 
					   				console.log( "downloadImage" )
					   			} 
				   			}else{ 
				   				if( $rootScope.NetworkTrue ){
				   					$scope.DownloadFile( message.file );
				   					$scope.downloading = true; 
				        			$scope.downloaded = false;   
				        			console.log( "DownloadFile" )
				   				}
				   			} 
				   		}

			   		})
		   		}
		   			
		   		////////////////////////// 
		   		if( message.vu == 'false' ){ 
		   			if( $rootScope.NetworkTrue ){ 
			   			$AjaxQuery.post('addVuToMessage/'+message.idMessage+'/'+message.idClient, {} ).success(function(data) {

							// localStorage.setItem('notif', (parseInt(localStorage.getItem('notif')) - 1) );  
							// $rootScope.$emit("UpdateBadge", {}); 
						}) 
					}
		   		}
		   		
		   		
		   }
		});  
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
	    /////////////////////////////////// download image from server to locale ////////////////////////////////////////
	    $scope.showImage = function(fileName) { 
	        
	        $scope.imageSrc = $scope.ExternalPath+fileName;
	        $scope.openModal(); 

	    }  
		$scope.openLocalUrl = function ( file ) { 
	    	path = $scope.ExternalPath;
			console.log(path+file, mime.getType( file ));
			if( ionic.Platform.isIOS() ){
      			window.open( path+file,'_blank','EnableViewPortScale=yes,location=no');
	      	}else{    
	      		cordova.plugins.fileOpener2.open( 
	      			path+file, 
	      			mime.getType( file ) 
				);
	      	}
		}

		$scope.openUrl = function ( file ) { 
	    	path = $scope.filePath;
			window.open( path+file,'_system','location=yes');
			console.log("openUrl", path+file)
		}
 
	    /////////////////////////////////// Move image to gallery ////////////////////////////////////////

	    $scope.downloadFileToGallery = function ( targetPath ) { 

	    	if( !$scope.fileDownloaded ){
	    		$scope.fileDownloaded = true;
	    		

		    	window.cordova.plugins.imagesaver.saveImageToGallery(targetPath, onSaveImageSuccess, onSaveImageError); 
				function onSaveImageSuccess(success) {
				  $scope.fileDownloaded = true;
				} 
				function onSaveImageError(error) { 
					console.log("Save Image error", error);
					$scope.fileDownloaded = false;
				}
	    	}
	    	
	    }


	    $scope.rotateValue = 0;
	    $scope.rotateImage = function () {
	    	$scope.rotateValue += 90;
	    }
	    ////////////////************************//////////////////
	}
 
	
})



















.controller('settingCtrl', function ($scope,$state, API, $rootScope, $stateParams,$AjaxQuery, USERDATA) {
	// console.log("Parent ",localStorage.getItem('Parent'))
	// console.log("students ",localStorage.getItem('students'))

	$scope.allowSend = false;

	$scope.students = USERDATA.getStudents();
	$scope.currentUser = USERDATA.getCurrentUser(); 
	$scope.currentUserInfos = USERDATA.getCurrentUserInfos();
	$scope.parent = USERDATA.getParentName();

	$AjaxQuery.post('getStudents', { 
		 adresseMac   : localStorage.getItem('adresseMac'),
		 appname: API.appId
	} ).success(function(data) {

		if( data.students.length == 0 ){ 
			$state.go("blocked");
			localStorage.setItem('notif', 0 );
			$rootScope.$emit("UpdateBadge", {});
		}

		$scope.allowSend = data.allowSend;
		$scope.students = data.students;
		USERDATA.setStudents(data.students);

		var findConnectedUser = false;
		angular.forEach(data.students, function (client, key) {
			if( USERDATA.getCurrentUser() == client.idClient  ){
				findConnectedUser = true;
			}
		})

		setTimeout(function () {
			if( !findConnectedUser ){
				USERDATA.setCurrentUser(data.students[0].idClient);
			}
		})

		$scope.students = USERDATA.getStudents();
		$scope.currentUser = USERDATA.getCurrentUser(); 
		$scope.currentUserInfos = USERDATA.getCurrentUserInfos();
		$scope.parent = USERDATA.getParentName(); 
	})

	var reqData ={ 
		 adresseMac   : localStorage.getItem('adresseMac'),
		 appname   : API.appId
	}  
	if( localStorage.getItem('Parent') != '' ){
		$scope.Parent = JSON.parse(localStorage.getItem('Parent'));
	}else{
		$scope.Parent = {
			nom: ""
		}
	} 
	if( $rootScope.NetworkTrue){ 
		$AjaxQuery.post('getParentName', reqData ).success(function(data) {
			localStorage.setItem('Parent', JSON.stringify(data));
			$scope.Parent = data; 
		})
	}

	$scope.gotoDownloadFolder = function () {

		startApp.set({ 
		    "package":"com.sec.android.app.myfiles",
		    "uri":"/storage/emulated/0/TawassolApp/"
		}).start() 
	} 

	


	$scope.connectUser = function (idClient) {
		USERDATA.setCurrentUser(idClient);
		$state.go('tabs.messages');
	}

	$scope.openPdfUrl = function (filename) {
		if(window.cordova){
			if( ionic.Platform.isIOS() ){
				cordova.InAppBrowser.open(API.server+'assets/upload/docs/'+filename, '_blank', 'EnableViewPortScale=yes');
			}else{
				cordova.InAppBrowser.open(API.server+'assets/upload/docs/'+filename, '_system');
			}
		}else{
			window.open(API.server+'assets/upload/docs/'+filename);
		}
	}

})





.controller('enploiCtrl', function ($scope, $rootScope, $state, $stateParams, $alert, $loader, $AjaxQuery, USERDATA) {
	
	$scope.$on('$ionicView.beforeEnter', function() {  

		var student = USERDATA.getCurrentUserInfos()
		$scope.callback = false;
		$AjaxQuery.post('getEmploi/', {
			classe: student.classe,
			groupe: student.groupe,
			idCentre: student.idCentre
		}).success(function(data) { 
			if( data.success ){
				$scope.emploiClasse = data.emploiClasse;
				$scope.callback = true;
			}
		})

		$scope.customBackground = localStorage.getItem('customBackground'); 
	}); 

})














.controller('studentsCtrl', function ($scope,$rootScope, API, $stateParams,$AjaxQuery,$alert) {
	var reqData ={ 
		 adresseMac   : localStorage.getItem('adresseMac'),
		 appname: API.appId
	} 
	$rootScope.students = JSON.parse(localStorage.getItem('students'));
	if( $rootScope.NetworkTrue ){ 
		$AjaxQuery.post('getStudents', reqData ).success(function(data) {
			localStorage.setItem('students', JSON.stringify(data.users));
			$rootScope.students = data.users;
		})
	}
	// $scope.showState = function (name, state) {
	// 	if(state==true){
	// 		$alert.success('Le compte de '+name+' est validé',3000)
	// 	}else{
	// 		$alert.error('Le compte de '+name+' est désactivé. Contacter l\'administration')
	// 	}
	// }
})




.controller('addStudentCtrl', function ($scope,$rootScope, API, $stateParams, $loader, $AjaxQuery,$alert,$state, $location, $ionicModal, USERDATA) {

	$scope.code = '';
	if(localStorage.getItem('Parent')){
		var Parent =  JSON.parse(localStorage.getItem('Parent'))
		$scope.nomParent = Parent.nom; 
		$scope.telParent = Parent.telParent; 
	}else{
		$scope.nomParent = "";
		$scope.telParent = "";
	}
	 

	$scope.codeValide = false;
	$scope.verifCode = function verifCode() { 

		var code = $scope.code;
		if( code.length >= 6 ){
			$loader(true); 
			var reqData = {
				appname: API.appId
			};
			$rootScope.NetworkTrue = true
			if( $rootScope.NetworkTrue ){ 
				$AjaxQuery.post('verifCode/'+code, reqData).success(function (data) {
					console.log(data)
					$loader(false);
					if(data.success == 1){    
						$scope.codeValide = true;  
						$scope.nomEcole = data.info.nomEcole;
						$scope.photoEcole = data.info.photoEcole;
						$scope.fname = data.info.fname;
						$scope.lname = data.info.lname;
						$scope.niveau = data.info.niveau;
						$scope.classe = data.info.classe;
						$scope.groupe = data.info.groupe;
						$scope.idClient = data.info.idClient;
						$scope.cgu = true;
						$scope.pub = true;
			        }else{
			          $alert.error('Code invalide')
			        }
				})
			}else{
				alert( "Pas de connexion internet" )
			} 
		}
	}
 	$scope.changeCode = function changeCode() {
		$scope.codeValide = false;
	}

	$rootScope.$on("CallMessages", function(){
           $scope.codeValide = false;
    });

	$scope.OnchangeClasse = function() {
		 $scope.nbrGroupeByClasse = [];    
		 for (var i = 0; i < $scope.nbrClassesByNiveau[parseInt($scope.classe) - 1]; i++) {  
        	$scope.nbrGroupeByClasse.push($scope.intituleGroupe[i]) 
		 }   
		 $scope.groupe = "";  
	}
	$scope.OnchangeNiveau = function() {
		var code = $scope.code;
		var niveau = parseInt($scope.niveau);
		if( $rootScope.NetworkTrue ){ 
			$AjaxQuery.post("getClassesByCode/"+code+"/"+niveau, {}).success(function (data) {
	            $scope.intituleClasse = []
	        	angular.forEach(data.intituleClasse, function (value, key) {
	        		var array = {
	        			id : key+1,
	        			name : value
	        		} 
	        		if( data.nbrClassesByNiveau[key] > 0 ){
		        		$scope.intituleClasse.push(array)
		        	}
	        	})
	        	$scope.intituleGroupe = []
	        	angular.forEach(data.intituleGroupe, function (value, key) {
	        		var array = {
	        			id : key+1,
	        			name : value
	        		}  
	        		$scope.intituleGroupe.push(array)
	        	}) 
	        	$scope.classe = ""; 

				$scope.nbrGroupeByClasse = [];    
				for (var i = 0; i < data.nbrClassesByNiveau[0]; i++) { 
		        	$scope.nbrGroupeByClasse.push($scope.intituleGroupe[i]) 
				}    
				$scope.groupe = "";
				$scope.nbrClassesByNiveau = data.nbrClassesByNiveau;
	        })
        }else{
			alert( "Pas de connexion internet" )
		} 
	}
	function validate() {

		var  nomParent = telParent = cgu = false; 
 

		if($scope.nomParent){ 
			nomParent=true;
		}else{
			$alert.error('Veuillez saisir le nom du parent');
			return false
		} 

		if($scope.telParent){ 
			if($scope.telParent.length >= 10){
				telParent=true;
			}else{
				$alert.error('Veuillez saisir un numéro de téléphone valide');
				return false
			}

		}else{
			$alert.error('Veuillez saisir votre numéro de téléphone');
			return false
		} 

		if($scope.cgu){ 
			cgu=true;
		}else{
			$alert.error("Veuillez accepter les conditions d'utilisation et la politique de confidentialité");
			return false
		} 

		if(nomParent && telParent && cgu){ 
			return true
		}else{
			return false
		} 

	}
	
	$scope.addStudent = function addStudent() {   
		if( validate() ){ 
			$scope.openModal(); 
		}
	}
	$scope.sendData = function () {
		$loader(true); 
		if( $rootScope.NetworkTrue ){   
		window.FirebasePlugin.getToken(function(token) { 
			var reqData ={ 
				 adresseMac   : localStorage.getItem('adresseMac'),
				 idClient   	  : $scope.idClient,  
				 nomParent    : $scope.nomParent,
				 telParent    : $scope.telParent,
				 token    	  : token,
				 appname      : API.appId,
				 pub		  : ($scope.pub) ? 1 : 0
			}  
			console.log(reqData)
			$AjaxQuery.post('insertClient', reqData ).success(function(data) {
					$scope.closeModal();
					$loader(false);
					if( data.success == 1 ){   
				        if( $location.path() == "/register" ){
				        	$alert.success( data.message,4000); 
				        	var reqData ={ 
								 adresseMac   : localStorage.getItem('adresseMac'),
								 appname: API.appId
							} 
							$AjaxQuery.post('getStudents', reqData ).success(function(data) {
								localStorage.setItem('login', "true")    
					 			USERDATA.setStudents(data.students); 
					 			USERDATA.setCurrentUser(data.students[0].idClient); 
	 							$state.go('tabs.messages');
							})

						}else{
							$alert.success('L\'élève est bien ajouté',4000);
							setTimeout(function () {
								$state.go('tabs.setting');
							},4000)
						} 
				    }else{
				    	$alert.error( data.message )
				    } 
				})
		}, function(error) {
	        console.error("FirebasePlugin ",error);
	    }); 
				

		}else{
			alert( "Pas de connexion internet" )
		}
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
		cordova.InAppBrowser.open(API.server+'privacy-policy.html', '_blank', 'EnableViewPortScale=yes');
	}



	
})
















.controller('aboutCtrl', ['$scope', '$stateParams', 
function ($scope, $stateParams) {

	$scope.appVersion = ''
	cordova.getAppVersion.getVersionNumber().then(function (AppVersion) {
		$scope.appVersion = AppVersion;
	})

}])

.controller('backgroundCtrl', ['$scope', '$stateParams','$loader','$cordovaToast', 
function ($scope, $rootScope, $loader, $cordovaToast) {  

	var today = new Date();
	var dd = today.getDate();
	var mm = today.getMonth()+1; //January is 0!
	var yyyy = today.getFullYear();

	if(dd<10) {
	    dd='0'+dd
	} 

	if(mm<10) {
	    mm='0'+mm
	} 

	$scope.today = dd+'/'+mm+'/'+yyyy;

	$scope.$on('$ionicView.beforeEnter', function() {  
		$scope.data = [];
		for (var i = 1; i <= 6; i++) {
			$scope.data.push( 'url(img/bg/bg'+i+'.jpeg)' )
		}
		$scope.customBackground = $scope.data[0];
		$scope.index = 0;
	});
	$scope.changeBG = function (index) { 
		$scope.hideSwip = true;
		$scope.customBackground = $scope.data[index]; 
		$scope.index = index;
	}
	$scope.appliqueBackground = function (index) {
		//console.log($scope.data);
		localStorage.setItem('customBackground', $scope.data[$scope.index]);
		$cordovaToast.showShortCenter( "Arrière plan défini." );
	}
}])


.controller('blockedCtrl', function ($scope, $stateParams, $ionicHistory, USERDATA) { 
	localStorage.setItem('fileDownloaded', "[]");
	localStorage.setItem('logosDownloaded', "[]");
	localStorage.setItem('login',"false")
	localStorage.setItem('idClient',"");
	localStorage.setItem('state',"");
	localStorage.setItem('login', "false")
	localStorage.setItem('students', "[]")
	localStorage.setItem('Parent', "") 
	$ionicHistory.clearHistory();
    $ionicHistory.clearCache();

    USERDATA.setStudents([]);
	USERDATA.setCurrentUser('');
	USERDATA.setMessages( [] );
})


.controller('profileStudentCtrl', function ($scope, $rootScope, $stateParams, $cordovaActionSheet, $cordovaCamera, $cordovaImagePicker, $jrCrop, $AjaxQuery, USERDATA) {
		
	$scope.students = USERDATA.getStudents();

	console.log($scope.students)

	angular.forEach($scope.students, function (student, key) {
		if( student.idClient ==  $stateParams.idClient){
			$scope.student = student;
		}
	})



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
		        targetHeight: 400,
		        targetWidth: 400,
		        encodingType: navigator.camera.EncodingType.PNG,
	            quality: 85  
		    };	
		}else{
	    	var options = {
		      quality: 85,
		      destinationType: Camera.DestinationType.DATA_URL,
		      sourceType: Camera.PictureSourceType.CAMERA,
		      allowEdit: false,
		      encodingType: Camera.EncodingType.JPEG,
		      targetWidth: 400,
		      // targetHeight: 400,
		      popoverOptions: CameraPopoverOptions,
		      saveToPhotoAlbum: false,
			  correctOrientation:true
		    };
	    }

	    $cordovaCamera.getPicture(options).then(function(imageData) {    
	      	$jrCrop.crop({
                url: "data:image/jpeg;base64," + imageData,
                circle: true,
                width: 250,
                height: 250
            }).then(function(canvas) { 
                $scope.student.photo = canvas.toDataURL();  
                $scope.sendPhoto();
            }, function() { 
            });
	    }, function(err) {
	      // error
	    });
	}
	$scope.OpenGallery = function () {   

	    if( ionic.Platform.isIOS() ){ 
			var options = {
			 	maximumImagesCount: 1,
			    width: 400,
			    height: 400,
			    quality: 100
		 	};
			$cordovaImagePicker.getPictures(options)
		    .then(function (results) {
		     
		      	toDataUrl( results[0], function(base64Img) {
				  	$jrCrop.crop({
		                url: base64Img,
		                circle: true,
		                width: 250,
		                height: 250
		            }).then(function(canvas) { 
		                $scope.student.photo = canvas.toDataURL();
		                $scope.sendPhoto();  
		            }, function() { 
		            });
				}); 
 
		    }, function(error) {
		       
		    });
		}else{   
		 	var options = {	
				sourceType: navigator.camera.PictureSourceType.PHOTOLIBRARY,
                destinationType: navigator.camera.DestinationType.DATA_URL,
                maximumImagesCount: 1, 
			   	quality: 100,
			   	width: 300,
		        height: 300,
			   	correctOrientation:true

			}
			$cordovaCamera.getPicture(options).then(function(imageData) { 
		      var base64Img = "data:image/jpeg;base64," + imageData; 
		      $jrCrop.crop({
	                url: base64Img,
	                circle: true,
	                width: 250,
	                height: 250
	            }).then(function(canvas) { 
	                $scope.student.photo = canvas.toDataURL();
	                $scope.sendPhoto();  
	            }, function() { 
	            });
		    }, function(err) {
		      // error
		    });
	 	}
	}

	$scope.removePhoto = function () {
		
		var reqData = {
			idClient: $scope.student.idClient
		}
		$scope.progress = true;
		if( $rootScope.NetworkTrue ){  
			$AjaxQuery.post('removePhotoClient', reqData ).success(function(data) {
				$scope.progress = false;
				$scope.student.photo = "";
			}) 
		}else{
			alert('Pas de connexion');
		}
	}

	$scope.sendPhoto = function() {
		var reqData = {
			idClient: $scope.student.idClient,
			photo: $scope.student.photo
		}
		$scope.progress = true;
		if( $rootScope.NetworkTrue ){  
			$AjaxQuery.post('addphotoClient', reqData ).success(function(data) {
				$scope.progress = false;
			}) 
		}else{
			alert('Pas de connexion');
		}
	}
})



.controller('massarCtrl', ['$scope', '$stateParams', 
function ($scope, $stateParams) {
	$scope.gotoMassar = function () {
		window.open("https://massar.men.gov.ma/Account", "_system")
	}
}])




.controller('chatsCtrl', function ($scope, $stateParams, $AjaxQuery, $rootScope, API) {
	
	if( localStorage.getItem('parentChats') == null ){
		$scope.messages = [];
		$rootScope.chats = [];
	}else{
		$scope.messages = JSON.parse( localStorage.getItem('parentChats') );
		$rootScope.chats = JSON.parse( localStorage.getItem('parentChats') );
	}
		

	$scope.allowSend = false;

	$scope.urlLogos = API.server+"assets/upload/logos/"

	$scope.$on('$ionicView.beforeEnter', function() {
		$scope.getMessages()
	})

	$scope.getMessages = function () {
		$AjaxQuery.post('getMessagesSentToadmin', {
		    "adresseMac" : localStorage.getItem('adresseMac')
		} ).success(function(data) { 
			$scope.messages = data;
			$rootScope.chats = data;
			localStorage.setItem('parentChats', JSON.stringify( data ))
			$scope.allowSend = ( data.allowSend == 1 ) ? true : false;
		})
	}

})

.controller('chatCtrl', function ($scope, $stateParams, $rootScope, $AjaxQuery, $loader,$ionicModal, $state, $storage, USERDATA) {
	$scope.autoResponse = false;
	$scope.data = {};
	$scope.message = [];

	$ionicModal.fromTemplateUrl('liststudents-Modal.html', {
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
	  $state.go('tabs.chats')
	};

	$scope.$on('$ionicView.beforeEnter', function() {
		 
		if( $stateParams.key != 'new' ) {
			$scope.message = $rootScope.chats[$stateParams.key].content;

			$AjaxQuery.post('addVuToMessage/'+$rootScope.chats[$stateParams.key].idMessage+"/"+USERDATA.getCurrentUser(), {} ).success(function(data) {}) 

		}else{
			$scope.message = [];
		} 

		$scope.showAutoResponse()
		$scope.align = 'left'; 
		
		$scope.students = USERDATA.getStudents();

		console.log($scope.students)

		setTimeout(function () {
			if( $scope.students.length > 1 && $stateParams.key == 'new' ){ 
				$scope.openModal()
			}else{
				$scope.data.idClient = $scope.students[0].idClient;
			} 
		},500)

	})

	$scope.limitSendMessage = function ( actionType = 'get' ) {
		var date = new Date();
    	var year = date.getFullYear();
    	var month = date.getMonth();
    	var date = date.getDate();

		var key = year+'_'+month+'_'+date+'_'+$scope.data.idClient; 
 		

		if( actionType == 'set' ){
			if( $storage.get(key) ){ 
	 			$storage.set(key, parseInt($storage.get(key)) + 1);
	 		}else{
	 			$storage.set(key, 1);
	 		}
	 		console.log(key)
 			console.log('new value : ',$storage.get(key));
		}

		

		if( actionType == 'get' ){
			return parseInt($storage.get(key))
		} 

 		
	}

	$scope.sendMessage = function () {
		 
		$loader(true);
		$AjaxQuery.post('sendMessageToAdmin', {
			idClient 	 :  $scope.data.idClient, 
			message  :  $scope.data.message,
			align 	 : $scope.align
		}).success(function(data) { 
			$loader(false);
			if(data == 1){
				$scope.limitSendMessage('set');
				$scope.message.push({
					from: 'parent',
					content: $scope.data.message
				})
				$scope.data.message = '';

				setTimeout(function () {
					$scope.showAutoResponse();
				},1000)
			} 
			

		})

			
	}

	$scope.chooseStudent = function (student) {
		$scope.data.idClient = student.idClient;
		$scope.modal.hide();

		if( $stateParams.key == 'new' ){
			$scope.MaxMessage = $scope.limitSendMessage() >= 5 ? true : false; 
			console.log($scope.limitSendMessage('get'))
		}
	}

	$scope.showAutoResponse = function () { 
		if( $scope.message.length == 1 ){  
			setTimeout(function () {
				$scope.$apply(function () {
					$scope.autoResponse = true; 
				})
			})
		}
	}

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








.controller('bugCtrl', function ($scope,$rootScope, $stateParams, $AjaxQuery, $alert, $loader) { 
	$scope.sendRapport = function sendRapport() {

		if( $scope.contentBug != '' ){ 
			var reqData = {
				content : $scope.contentBug,
		        from : 'parent',
		        idFrom : localStorage.getItem('idClient')
			}
			if( $rootScope.NetworkTrue ){  
				$loader(true); 
				$AjaxQuery.post('addProbleme', reqData ).success(function(data) {
					$loader(false);
					if( data == "true" ){  
			             $alert.success('Merci. Vos commentaires nous aideront à améliorer TawassolApp.',3000);
			             $scope.contentBug = '';
			        }else{ 
			            $alert.error('Erreur, éssayer plus tard')
			        } 
				})
			}else{
				alert( "Pas de connexion internet" );
			}
		}
	} 

})

.controller('espaceEleveCtrl', function ($scope, USERDATA) { 
	  
	$scope.$on('$ionicView.beforeEnter', function() {
        $scope.customBackground = localStorage.getItem('customBackground');  
        $scope.userInfo = USERDATA.getCurrentUserInfos();
    });
}); 







function verified() {
	if( localStorage.getItem('state') == 'true' ) return true;
	else return false;
}