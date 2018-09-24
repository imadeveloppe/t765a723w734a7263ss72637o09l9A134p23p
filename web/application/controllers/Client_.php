<?php header('Access-Control-Allow-Origin: *');
	  header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
defined('BASEPATH') OR exit('No direct script access allowed');

class Client_ extends CI_Controller {
	 
	 public function login()
	 {
	 	$this->load->model('Client'); 

	 	$data = $this->Client->login(); 
	 	
	 	if( $data['login'] == 'true' ){
	 		foreach ($data['students']  as $key => $student) {
				$data['students'][$key]->badge = $this->getNbrMessagesNonVu($student->idClient);
			}
	 	} 	

	 	echo json_encode($data);
	 }
	 public function insertClient()
	 {
	 	$this->load->model('Client'); 
	 	echo json_encode( $this->Client->insertClient() );
	 }
	 public function messages($idClient, $showResult = true)
	 {
	 	extract($_POST);
	 	$this->load->model('Centre');
	 	$this->load->model('Prof_'); 
	 	$this->load->model('Client');  

	 	
	 	
		if( !$this->Client->existClients($idClient) ){
			if( $showResult ){
		 		echo "NoStudents";
		 	}else{
		 		return false;
		 	} 
	 	}else{

	 		if(isset($token)){
	 			$this->Client->updateToken($token, $idClient);  
	 		}
	 		           	 


		 	$data['messages'] = $this->GetMessage($idClient);   
		 	
		 	$messages = array();  
		 	foreach ($data['messages'] as $key => $value) {
		 		$messages[$key]['idMessage'] = $value->idMessage;
		 		$messages[$key]['message_type'] = $value->message_type;
		 		$messages[$key]['idFrom'] = $value->idFrom;
		 		$messages[$key]['idClient'] = $value->idClient;
		 		$messages[$key]['ecole'] =  $this->Centre->getNomEcole( $this->Client->getIdCentre($value->idClient) );
		 		$messages[$key]['profil'] = $this->Centre->getPhoto( $this->Client->getIdCentre($value->idClient) );

		 		$messages[$key]['from'] = ($value->from == 'centre' ) ? "administration" : 'prof';
		 		if( $value->from == "prof" ){	
		 			$object = $this->Prof_->GetCustomProfs( $value->idFrom );
		 			$messages[$key]['prof'] = $object[0]->nom;
		 		}
		 		$messages[$key]['time'] = date('d/m/Y', $value->time);
		 		$messages[$key]['align'] = $value->align;
		 		$messages[$key]['content'] = $value->content;
		 		$messages[$key]['matiere'] = $value->matiere;
		 		$messages[$key]['name'] = $this->Client->GetCustomClient(array($value->idClient))[0]->nom;
		 		$messages[$key]['file'] = ($value->file != '') ? $value->file : '';
		 		$messages[$key]['typeFile'] = $value->typeFile;
		 		$messages[$key]['date'] = $value->date;
		 		if( !empty($value->vu) ){
		 			$tab = (strpos($value->vu, ',') !== false) ?  explode(',', $value->vu)  : array($value->vu);
		 			if( in_array($value->idClient, $tab) ){
		 				$messages[$key]['vu'] = "true";
		 			}else{
		 				$messages[$key]['vu'] = "false";
		 			}
		 		}else{
		 			$messages[$key]['vu'] = "false";
		 		}
		 	}
		 	if( $showResult ){
		 		echo json_encode($messages);
		 	}else{
		 		return $messages;
		 	}
		 		
		}
	 }
	public function GetMessage($idClient)
	{
			$this->load->model('Messages');
			$messages = array(); 
			$data =   $this->Messages->GetMessageClient($idClient);
			// echo "<pre>"; 
			// 	print_r($data);
			// echo "</pre>";
			if( !empty($data['idClient']) ):
				foreach ($data['messages'] as $key => $message) :

					$timeStampOneMounthFromNow = time() - 60*60*24*30;

					

					switch ($message->type) {
						case 'parent':
							$tab = (strpos($message->destination, ',') !== false) ? explode(',', $message->destination)  : array($message->destination);

							foreach ($data['idClient'] as $keyClient => $idClient) {

								if( $message->time >= $data['time'][$keyClient] && $message->time > $timeStampOneMounthFromNow ):

									if( in_array($idClient, $tab) && $data['idCentre'][$keyClient] == $data['messages'][$key]->idCentre && $data['niveau'][$keyClient] == $data['messages'][$key]->niveau ){
										$data['messages'][$key]->idClient = $idClient;
										$messages[] = (object)(array)$data['messages'][$key]; 
									}
								endif;
							}
							
							break;

						case 'classe':  
							$tab = (strpos($message->destination, ',') !== false) ? explode(',', $message->destination)  : array($message->destination);
	 						 
							foreach ($data['classe'] as $keyClass => $classe) {

								if( $message->time >= $data['time'][$keyClass] && $message->time > $timeStampOneMounthFromNow ):
									if (in_array($classe, $tab) && $data['idCentre'][$keyClass] == $data['messages'][$key]->idCentre && $data['niveau'][$keyClass] == $data['messages'][$key]->niveau) {

										$data['messages'][$key]->idClient = $data['idClient'][$keyClass]; 
										$messages[] = (object)(array)$data['messages'][$key];  
										
									} 
								endif;  
	 						} 
							break;

						case 'groupe': 
							$tab = (strpos($message->destination, ',') !== false) ? explode(',', $message->destination)  : array($message->destination);

							foreach ($data['groupe'] as $keyGroupe => $groupe) {

								if( $message->time >= $data['time'][$keyGroupe] && $message->time > $timeStampOneMounthFromNow ):

									if (in_array($data['classe'][$keyGroupe].'-'.$groupe, $tab)  && $data['idCentre'][$keyGroupe] == $data['messages'][$key]->idCentre && $data['niveau'][$keyGroupe] == $data['messages'][$key]->niveau) {
										$data['messages'][$key]->idClient = $data['idClient'][$keyGroupe];
										$messages[] = (object)(array)$data['messages'][$key];								
									} 
								endif;
							} 
							break;

						case 'all':
							foreach ($data['idClient'] as $keyClient => $idClient) { 
								if( $message->time >= $data['time'][$keyClient] && $message->time > $timeStampOneMounthFromNow ):
									
									if($data['idCentre'][$keyClient] == $data['messages'][$key]->idCentre && $data['niveau'][$keyClient] == $data['messages'][$key]->niveau){
										$data['messages'][$key]->idClient = $idClient;
										$messages[] = (object)(array)$data['messages'][$key];
									}
								endif;
								
							} 
							break;
						
					}
				endforeach;  
				usort($messages, function ($a, $b){ 
					if($a->time==$b->time) return 0;
   					return $a->time < $b->time?1:-1;
				});
				return $messages;
			else:
				return array();
			endif;
		}

		public function addVuToMessage($idMessage, $idClient)
		{
			$this->load->model('Messages');
			if( $this->Messages->addVuToMessage($idMessage, $idClient) ){
				echo "true";
			}else{
				echo "false";
			}
		}

		public function getNbrMessagesNonVu($idClient)
		{
			$messages = $this->messages($idClient, false);
			if( $messages ){
				$badge = 0;
				foreach ( $messages as $key => $message) {
					if( $message['vu'] == 'false' ){
						$badge++;
					}
				}

				return $badge;
			}else{
				return 0;
			}
				
		}

		// public function getCountMessage($idClient)
		// { 	
		// 	$this->load->model('Client');
		// 	if( !$this->Client->existClients($idClient) ){
		//  		echo "NoStudents";
		//  	}else{
		// 		$messages = $this->GetMessage($idClient); 
		// 		echo count($messages);
		// 	}
		// }
		public function saveInfoParent($idClient)
		{ 
			$this->load->model('Client');
			if( $this->Client->saveInfoParent($idClient)){
				echo "true";
			}else{
				echo "false";
			}
		}
		
		public function verifCode($code)
		{
			$this->load->model('Client');
			
			$result = $this->Client->verifCode($code);

			if( $result["num_rows"] > 0 ){
				$data = array(
					"success" => 1,
					"info" => $result['info']
				);
			}else{
				$data = array(
					"success" => 0 
				);
			}

			echo json_encode($data);
		}
		public function getClassesByCode($code, $niveau=0)
		{
			$this->load->model('Prof_');
			$this->load->model('Client');
			$idCentre = $this->Prof_->getIdCentreByCode($code); 

			$this->load->model('SettingCentre');
			$options = $this->SettingCentre->GetOptionsCentre($idCentre,$niveau);
 			
 			$data['intituleClasse'] = $this->Client->intituleNiveau($niveau, $options->appellationClasses);
			$data['intituleGroupe'] = $this->Client->intituleGroupe($options->appellationGroupe); 
			$data['nbrClassesByNiveau'] =  (strpos($options->classes, ',') !== false) ? explode(',', $options->classes)  : array($options->classes);
 			echo json_encode($data);
		}
		public function getInfosClient( $idClient )
		{
			$this->load->model('Client');
			echo json_encode( $this->Client->getInfosClient( $idClient ) );
		}
		public function addProbleme()
		{
			$this->load->model('Probleme');
			if( $this->Probleme->insert($_POST['from'], $_POST['idFrom']) ){
				echo "true";
			}else{
				echo "false";
			}
		}
		public function verified($idClient)
		{
			$this->load->model('Client');
			if($this->Client->verified($idClient)) echo 'true';
			else echo 'false';
		}
		public function getNiveauByCode($code)
 		{
 			$this->load->model('Centre');
 			echo json_encode($this->Centre->getNiveauByCode($code));
 		}

 		public function getStudents()
 		{
 			extract($_POST);
 			$this->load->model('Client'); 
 			$this->load->model('Centre'); 

 			$data = $this->Client->getStudents( $adresseMac ); 

			foreach ($data['students']  as $key => $student) {
				$data['students'][$key]->badge = $this->getNbrMessagesNonVu($student->idClient);
			}

			echo json_encode($data);
 		}
 		public function getParentName()
 		{
 			extract($_POST);
 			$this->load->model('Client');
 			echo json_encode($this->Client->getParentName( $adresseMac ));
 		}

 		public function addphotoClient()
 		{
 			$this->load->model('Client');
 			echo json_encode($this->Client->addphotoClient());
 		}
 		
 		public function removePhotoClient()
 		{
 			$this->load->model('Client');
 			echo json_encode($this->Client->removePhotoClient());
 		}

 		public function getMessagesSentToadmin()
 		{
 			$this->load->model('Messages');
 			$this->load->model('Client'); 
			echo json_encode($this->Messages->getMessagesSentToadmin( $this->Client->getStudentsByAdresseMac($_POST['adresseMac']) ));
 		}

 		public function sendMessageToAdmin()
 		{
 			$this->load->model('Messages'); 
 			$this->load->model('Client');  

			echo $this->Messages->sendMessageToAdminbyParent( $this->Client->getClient( $_POST['idClient'] ) );
 		}

 		public function getEmploi()
		{
			$this->load->model('Emplois'); 

			echo json_encode(array(
				"success" => true,
				"emploiClasse" => $this->Emplois->getEmploiClasse()
			));
		}
	 
}
