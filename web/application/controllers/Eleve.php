<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Eleve extends CI_Controller {
	 
	public function index()
	{ 	  
		$this->load->view('eleve/login.php'); 
	}

	public function connecte()
	{	
		$this->load->model('Client');
		$this->Client->loginAtEleveFromWebApp();
	}

	public function home()
	{ 	

		if( $this->isLogedEleve() ){

			$idClient = $this->session->idClient;
			$data["messages"] = $this->messages($idClient);
			$data["idClient"] = $idClient;

			$this->load->model('Client');
			$data["infos"] = $this->Client->getInfoEleve($idClient); 

			$this->load->model('Emplois'); 
			$data["infos"]->emplois = $this->Emplois->getEmploiClasse(array(
				"classe"	=> $data["infos"]->classe,
				"groupe"	=> $data["infos"]->groupe,
				"idCentre"	=> $data["infos"]->idCentre
			));

			$this->load->view('eleve/home.php', $data); 

		}else{
			redirect('Eleve');
		}
	}

	public function messages($idClient, $showResult = true)
	 {
	 	 
	 	$this->load->model('Centre');
	 	$this->load->model('Prof_'); 
	 	$this->load->model('Client');  

	 	
	 	
		if( !$this->Client->existClients($idClient) ){
			return false;
	 	}else{  

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
		 		$messages[$key]['file'] = ($value->file != '') ? base_url()."assets/upload/".$value->file : '';
		 		$messages[$key]['typeFile'] = $value->typeFile;
		 		$messages[$key]['date'] = $value->date;
		 		if( !empty($value->vu) ){
		 			$tab = (strpos($value->vu, ',') !== false) ?  explode(',', $value->vu)  : array($value->vu);
		 			if( in_array($value->idClient, $tab) ){
		 				$messages[$key]['vu'] = true;
		 			}else{
		 				$messages[$key]['vu'] = false;
		 			}
		 		}else{
		 			$messages[$key]['vu'] = false;
		 		}
		 	}

		 	return $messages;
		 		
		}
	}

	public function GetMessage($idClient)
	{
			$this->load->model('Messages');
			$messages = array(); 
			$data =   $this->Messages->GetMessageClient($idClient, 'eleve');
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


	public function logout()
	{
		$this->session->sess_destroy(); 
		redirect('Eleve');
	}

	public function isLogedEleve()
	{ 
		if( $this->session->logged_in ) return true;
		else return false; 
	} 
	 
}
