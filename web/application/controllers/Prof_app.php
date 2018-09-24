<?php header('Access-Control-Allow-Origin: *');
defined('BASEPATH') OR exit('No direct script access allowed');

class Prof_app extends CI_Controller {
	public $messages = array();
 
	 

 	////////////////////////////////// Pages ///////////////////////////////////////////////  
		public function newMessage($idMessage = false)
		{    
			$this->SetParams($_POST['idProf'], $_POST['idCentre'], $_POST['niveau'] );
			$idProf = $this->session->id;
			$this->load->model('Prof_');
			$prof = $this->Prof_->GetCustomProfs(array($idProf),'*'); 
        	$groupeProf =  (strpos($prof[0]->classe, ',') !== false) ? explode(',', str_replace(':', '', $prof[0]->classe)) : array(str_replace(':', '', $prof[0]->classe));
        	$classeProf = array();

        	
        	$tabClass =  (strpos($prof[0]->classe, ',') !== false) ? explode(',', $prof[0]->classe) : array($prof[0]->classe);

            foreach ($tabClass as  $value1) {
                $tab = explode(':', $value1);
                $classeProf[] = $tab[0];
            }

            $this->load->model('Modeles_messages');
			$data['modeles'] = $this->Modeles_messages->get( 'prof-to-parent' );

			if( !$idMessage ){
				$data['transfer'] ='';
			}else{
				$this->load->model('Messages');
				$data['transfer'] = $this->Messages->GetContentMessageById($idMessage);
			}  
			$this->load->model('SettingCentre');
			$data['matieres'] = $this->Prof_->getMatiereProf();
			$nbrClassesByNiveau = $this->SettingCentre->nbrClassesByNiveau();

            $parents = $this->GetAllClientInCentre(); 
        	$intituleClasse = $this->intituleClasse();
			$intituleGroupe = $this->intituleGroupe();  
 			
 			//print_r($intituleGroupe);

			$i=0; 
			$data['destination'] = array();
			foreach ($intituleClasse as $classe){

 				if( in_array($i+1, $classeProf)) {
 					$data['destination'][$i]['classe'] = $classe;
 					for ($j=0; $j < $nbrClassesByNiveau[$i] ; $j++){
 						if( in_array(($i+1).($j+1), $groupeProf)) {
 							$data['destination'][$i]['groupes'][$j]['groupe'] = $classe ." - G".$intituleGroupe[$j];
 							$data['destination'][$i]['groupes'][$j]['dataId'] = "_".($i+1)."-".($j+1)."_";
 							 if( in_array( ($i+1).($j+1), $parents['classes']) ){
 							 	$k = 0;
 							 	foreach ( $parents['eleve'] as $key => $eleve){
 									 if( $eleve->classe == ($i+1).($j+1) ){
 										$data['destination'][$i]['groupes'][$j]['eleves'][$k]['nom'] = $eleve->nom;
 										$data['destination'][$i]['groupes'][$j]['eleves'][$k]['dataId'] = "_".$eleve->idClient."_"; 
 										$data['destination'][$i]['groupes'][$j]['eleves'][$k]['registred'] = (!empty( $eleve->token )) ? 1 : 0; 
 									 }

 									$k++;
 							 	}

 							 }
 						}
 					}
 				}
 				$i++;
 			}
			

			// if( !$this->verified() ){
			// 	$this->messages[] = $this->messages('CompteNotVerified');
			// }  
			echo json_encode($data);
		}

		public function absense()
		{    
			$this->SetParams($_POST['idProf'], $_POST['idCentre'], $_POST['niveau'] );
			$idProf = $this->session->id;
			$this->load->model('Prof_');
			$prof = $this->Prof_->GetCustomProfs(array($idProf),'*'); 
        	$groupeProf =  (strpos($prof[0]->classe, ',') !== false) ? explode(',', str_replace(':', '', $prof[0]->classe)) : array(str_replace(':', '', $prof[0]->classe));
        	$classeProf = array();

        	
        	$tabClass =  (strpos($prof[0]->classe, ',') !== false) ? explode(',', $prof[0]->classe) : array($prof[0]->classe);

            foreach ($tabClass as  $value1) {
                $tab = explode(':', $value1);
                $classeProf[] = $tab[0];
            }
 

			 
			$this->load->model('SettingCentre');
			$data['matieres'] = $this->Prof_->getMatiereProf();
			$nbrClassesByNiveau = $this->SettingCentre->nbrClassesByNiveau();

            $parents = $this->GetAllClientInCentre(); 
        	$intituleClasse = $this->intituleClasse();
			$intituleGroupe = $this->intituleGroupe();  
 			
 			//print_r($intituleGroupe);

			$i=0; 
			$data['destination'] = array();
			foreach ($intituleClasse as $classe){

 				if( in_array($i+1, $classeProf)) {
 					$data['destination'][$i]['classe'] = $classe;
 					for ($j=0; $j < $nbrClassesByNiveau[$i] ; $j++){
 						if( in_array(($i+1).($j+1), $groupeProf)) {
 							$data['destination'][$i]['groupes'][$j]['groupe'] = $classe ." - G".$intituleGroupe[$j];
 							$data['destination'][$i]['groupes'][$j]['dataClasse'] = ($i+1);
 							$data['destination'][$i]['groupes'][$j]['dataGroupe'] = ($j+1);

 							 if( in_array( ($i+1).($j+1), $parents['classes']) ){
 							 	$k = 0;
 							 	foreach ( $parents['eleve'] as $key => $eleve){
 									 if( $eleve->classe == ($i+1).($j+1) ){
 										$data['destination'][$i]['groupes'][$j]['eleves'][$k]['nom'] = $eleve->lname." ".$eleve->fname;
 										$data['destination'][$i]['groupes'][$j]['eleves'][$k]['dataId'] = $eleve->idClient; 
 										$data['destination'][$i]['groupes'][$j]['eleves'][$k]['registred'] = (!empty( $eleve->token )) ? 1 : 0; 
 									 } 
 									$k++;
 							 	}

 							 	$data['destination'][$i]['groupes'][$j]['eleves'] = array_values( $data['destination'][$i]['groupes'][$j]['eleves'] );

 							 }
 						}
 					}
 				}
 				$i++;
 			}
			

			// if( !$this->verified() ){
			// 	$this->messages[] = $this->messages('CompteNotVerified');
			// }  
			echo json_encode($data);
		}
		public function profile()
		{ 
			$this->SetParams($_POST['idProf'], $_POST['idCentre'], $_POST['niveau'] ); 
			$this->load->model('Prof_');
			$data['prof'] = $this->Prof_->select();
 			echo json_encode($data);
		}
		// public function probleme()
		// {
		// 	if( $this->isLogedProf() ){

				
		// 		if( !$this->verified() ){
		// 			$this->messages[] = $this->messages('CompteNotVerified');
		// 		}
		// 		$data['countMessage'] = $this->MessageProfNonVu();
		// 		$data['message'] = $this->messages;
		// 		$data['title'] = "Signaler un problème";
		// 		$data['info'] = $this->session->userdata();
		// 		$data['page'] = 'probleme';
		// 		$this->load->view('prof/header.php',$data); 
		// 		$this->load->view('prof/probleme.php'); 
		// 		$this->load->view('prof/footer.php');
		// 	}else{
		// 		redirect('prof/login');
		// 	} 
		// }
		public function SetParams($idProf,$idCentre,$niveau)
		{
			$this->session->id = $idProf;
			$this->session->idCentre = $idCentre;
			$this->session->niveau = $niveau;
			$this->session->logged_in_prof = true;
		}
		public function historique()
		{ 	 
			$this->SetParams($_POST['idProf'], $_POST['idCentre'], $_POST['niveau'] );
			$data['messages'] = $this->GetMessageFromOneProf(); 
 
			//$data['countMessage'] = $this->MessageProfNonVu();
			echo json_encode($data); 
		}
		public function messages()
		{ 	
			$this->SetParams($_POST['idProf'], $_POST['idCentre'], $_POST['niveau'] );
			$data['messages'] = $this->GetMessageFromCentreToOneProf(); 

			$this->load->model('Centre'); 
			$data['logoEcole'] = $this->Centre->GetLogoCentre( $_POST['idCentre'] );
			$data['allowSend'] = intval($this->Centre->GetInfoCentre( $_POST['idCentre'] )->allowProfToSendMsg);

			// if( !$this->verified() ){
			// 	$this->messages[] = $this->messages('CompteNotVerified');
			// }
			$data['countMessage'] = $this->MessageProfNonVu(); 
			echo json_encode($data); 
		}
		// public function forgetPwd()
		// {    
		// 	if( $this->isLogedProf() ){
		// 		redirect('prof/home');
		// 	}else{ 
		// 		$data['title'] = "Récupération de mot de passe";  
		// 		$this->load->view('prof/forget-pwd.php', $data);
		// 	}
		// }

		 
 	////////////////////////////////////////////////////////////////////////////////////////


	///////////////////////////////////// Fonctions ////////////////////////////////////////
		public function verifCode($code)
		{
			$this->load->model('Prof_');
			
			if( $this->Prof_->verifCode($code) > 0 ){
				echo 1;
			}else{
				echo 0;
			}
		}
		public function verifEmail()
		{
			$this->load->model('Prof_');
			
			if( $this->Prof_->verifEmail() ){
				echo "true";
			}else{
				echo "false";
			}
		}
		public function addProf()
		{	 
			$this->load->model('Prof_'); 
			$_POST["classe"] = explode(",", $_POST["classe"]);
			$_POST["groupe"] = explode(",", $_POST["groupe"]);

			if( $this->Prof_->insert() ){
				echo "true";
			} else{
				echo "false";
			}
		} 
	 	public function isLogedProf()
		{
			if( $this->session->logged_in_prof ) return true;
			else return false; 
		} 
		public function connecte()
		{
			$this->load->model('Prof_');
			if( $this->Prof_->connecte() ){
				$data['state'] = "true";
				$data['info'] = $this->session->userdata();
			}else{
				$data['state'] = "false"; 
			}
	 		echo json_encode($data);
		}
		public function verified()
		{
			$this->load->model('Prof_');
			if($this->Prof_->verified()) return true;
			else return false;
		}
		public function logout()
		{    
			$this->session->sess_destroy(); 
			$this->index();
		} 
		public function removeMessage($idMessage)
		{
			$this->load->model('Messages');
			if( $this->Messages->removeMessage($idMessage) ){
				echo "true";
			} 
		}
		public function changePwd()
		{
			$this->SetParams($_POST['idProf'], $_POST['idCentre'], $_POST['niveau'] );
			$this->load->model('Prof_');
			if( $this->Prof_->changePwd() ){
				$data = "true";
			}else{
				$data = "false"; 
			}
	 		echo $data;
		}
		public function update()
		{	
			$this->SetParams($_POST['idProf'], $_POST['idCentre'], $_POST['niveau'] );
			$this->load->model('Prof_');
			$this->Prof_->update(); 
		}
		public function signalerProbleme()
		{	
			$this->SetParams($_POST['idProf'], $_POST['idCentre'], $_POST['niveau'] );
			$this->load->model('Probleme');  
			if( $this->Probleme->insert('prof') ){
				echo "true";
			}else{
				echo "false";
			}
		}
		public function GetMessageFromOneProf()
		{
			$this->load->model('Messages');
			$result = $this->Messages->GetMessageFromOneProf(); 
			$messages = $result;  

    
			$intituleClasse = $this->intituleClasse();
			$intituleGroupe = $this->intituleGroupe();

			foreach ($result as $key => $value) { 
				// $value->content = nl2br($value->content);
				switch ($value->type) {
					case 'groupe':
						$destination =  (strpos($value->destination, ',') !== false) ? explode(',',$value->destination) : array($value->destination);

						$messages[$key]->destinationArray = array();
						foreach ($destination as $key1 => $value1) {
							$destination[$key1] = explode('-', $value1);

							$messages[$key]->destinationArray[] = array(
								"id" => $value1,
								"nom" => ""
							);
						}  
						foreach ($destination as $key2 => $dest2) {
							$destination[$key2] = $intituleClasse[$dest2[0]-1].' - G'.$intituleGroupe[$dest2[1]-1];
							$messages[$key]->destinationArray[$key2]["nom"] = $destination[$key2];
						}  
 
						$messages[$key]->destination = $destination;  
						break;
					
					case 'classe':    	
						$destination =  (strpos($value->destination, ',') !== false) ? explode(',',$value->destination) : array($value->destination); 
						foreach ($destination as $key1 => $value1) {
							$destination[$key1] = $intituleClasse[$value1[0]-1];
						} 

 
						$messages[$key]->destination = $destination;
						break;

					case 'parent': 
						$destination = (strpos($value->destination, ',') !== false) ? explode(',',$value->destination) : array($value->destination);
						$this->load->model('Client');
						$parents = $this->Client->GetCustomClient($destination);
						$ClassName = $this->Client->getClassName($destination);
						unset($destination); 
						//print_r($parents); die();
						if( $parents != 'false' ){
							$i = 0;
							$messages[$key]->destinationArray = array();
							foreach ($parents as  $dest) {
								$destination[] = $dest->nom.' ( '.$ClassName[$i].' )';
								$messages[$key]->destinationArray[] = array(
									"id" => $dest->idClient,
									"nom" => $dest->nom
								);
								$i++;
							}		
							$messages[$key]->destination = $destination;					
						}else{
							unset($messages[$key]);
						}
						break;

					case 'all':
						$destination = array('Tous les parents'); 
						$messages[$key]->destination = $destination;
						break;
				} 
			}
			 
			return $messages;
		}
		public function intituleNiveau($niveau=0,$index=0)
		{
			$tab = array(); 
			///////////// Préscolaire /////////////// 
			$tab[0][1] = array('Crèche', 'TPS', 'PS', 'MS', 'GS'); 
			$tab[0][2] = array('Crèche', 'PS1', 'PS', 'MS', 'GS');
			
			///////////// Primaire///////////////
			$tab[1][1] = array('1AP', '2AP', '3AP', '4AP', '5AP', '6AP');
			$tab[1][2] = array('CE1', 'CE2', 'CE3', 'CE4', 'CE5', 'CE6'); 
			$tab[1][3] = array('CP', 'CE1', 'CE2', 'CM1', 'CM2', '6ème' );  

			///////////// College ///////////////
			$tab[2][1] = array('1AC', "2AC", "3AC", "");
			$tab[2][2] = array('7AF', '8AF', '9AF', ''); 
			$tab[2][3] = array('6ème', '5ème', '4ème', '3ème'); 

			///////////// lycee ///////////////
			$tab[3][1] = array(
							'TCL', 
							'TCS', 

							'1BAC SE',
							'1BAC SM',
							'1BAC SEG', 

							'2BAC SP',  
							'2BAC SVT',  
							'2BAC SMA',  
							'2BAC SMB',  
							'2BAC SE',  
							'2BAC TGC'  
						);

			if( $niveau == 0 and $index == 0 ) return $tab[$this->session->niveau];
			else return $tab[$niveau][$index];
		}

		public function intituleClasse()
		{
			$this->load->model('SettingCentre');

			$intituleNiveau = $this->intituleNiveau();
			return $intituleNiveau[$this->SettingCentre->getAppellationClasses()];
		}
		public function intituleGroupe($index=0)
		{
			$tab = array();  

			///////////// numerique ///////////////
			for ($i=1; $i <= 26 ; $i++) { 
				$tab[1][] = $i;
			}

			///////////// alphabetique ///////////////
			$tab[2] = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');

			$this->load->model('SettingCentre');
			if($index == 0) return $tab[$this->SettingCentre->getAppellationGroupe()];
			else return $tab[$index];
		}
		public function GetMessageFromCentreToOneProf()
		{
			$this->load->model('Messages');
			$messages = array();

			$data =   $this->Messages->GetMessageFromCentreToOneProf();
			foreach ($data['messages'] as $key => $message) :
				$tabVu = explode(',', $message->vu);
				$message->vu = (in_array($data['idProf'], $tabVu)) ? 1 : 0;

				switch ($message->type) {
					case 'prof':
						$tab =  (strpos($message->destination, ',') !== false) ? explode(',', $message->destination) : array($message->destination);

						if( $data['messages'][$key]->categorie == 'prof-admin' ){ 
							$data['messages'][$key]->lastMessage = json_decode( $data['messages'][$key]->content )[ count(json_decode($data['messages'][$key]->content))-1 ];
						}

						if( in_array($data['idProf'], $tab )){
							$messages[] = $data['messages'][$key]; 
						}
						break;

					case 'matiere':
						$finded = 0;
						$tab =  (strpos($message->destination, ',') !== false) ? explode(',', $message->destination) : array($message->destination);
						foreach ($data['matieres'] as $matieres) { 

							if (in_array($matieres, $tab)) {
								$finded++;
							} 
						}
						if( $finded > 0 ){
							$messages[] = $data['messages'][$key]; 
						} 
						break;

					case 'classe':
						$finded = 0;
						$tab =  (strpos($message->destination, ',') !== false) ? explode(',', $message->destination) : array($message->destination);
							
						foreach ($data['classe'] as $classe) {
							if (in_array($classe, $tab)) {
								$finded++;
							} 
						} 
						if( $finded > 0 ){
							$messages[] = $data['messages'][$key]; 
						} 
						break;

					case 'groupe':
						$finded = 0;
						$tab =  (strpos($message->destination, ',') !== false) ? explode(',', str_replace('-', '', $message->destination)) : array(str_replace('-', '', $message->destination));

						foreach ($data['groupe'] as $groupe) {
							if (in_array($groupe,$tab )) {
								$finded++;
							} 
						}  
						if( $finded > 0 ){
							$messages[] = $data['messages'][$key]; 
						} 
						break;
						
					case 'all': 
						$messages[] = $data['messages'][$key];
						break; 
					
				}

				
			endforeach;
			
			return $messages;
		}

		public function MessageProfNonVu()
		{
			$idProf = $this->session->id;
			$messages = $this->GetMessageFromCentreToOneProf();
			foreach ($messages as $key => $value) {
				if( !empty($value->vu) ){
					$tab =  (strpos($value->vu, ',') !== false) ? explode(',', $value->vu) : array($value->vu);

					if( in_array($idProf, $tab) ){
						unset( $messages[$key] );
					}
				}
			}
			return count($messages);
		}

		public function GetAllClientInCentre()
		{
			$this->load->model('Client');
			return $this->Client->GetAllClientInCentre();
		}
		public function SendMessageToParentByProf()
		{ 
			$this->SetParams($_POST['idProf'], $_POST['idCentre'], $_POST['niveau'] ); 
			if( isset($_POST['destination']) && !empty($_POST['destination']) ){

				$this->load->model('Centre');
				$this->load->model('Prof_'); 
				$idCentre = $this->Prof_->getIdCentre( $_POST['idProf'] );

				if( !$this->Centre->verified( $idCentre) ){
					$message = "-3";
				}else if( !$this->verified() ){
					$message = "-1";
				}else{
					$_POST['content']  = str_ireplace('www.', 'http://www.', $_POST['content'] );
					$_POST['content'] = preg_replace( "~[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]~", "<a target='_blank' href=\"\\0\">\\0</a>", $_POST['content']);
					$this->load->model('Messages');
					if( $this->Messages->SendMessageToParentByProf() ){
						$message = "1"; 
					}
					else{
						$message = "0";
					}
				}  
			}else{
				$message = "-2";
			}
			echo $message;
		}
		public function addVuToMessage()
		{	
			$this->session->id = $_POST['idProf'];
			$this->session->idCentre = $_POST['idCentre'];
			$this->session->niveau = $_POST['niveau'];
			$this->session->logged_in_prof = true;
			$id = $_POST['idMessage'];
			$this->load->model('Messages');
			if( $this->Messages->addVuToMessage($id, $this->session->id ) ){
				echo "true";
			}else{
				echo "false";
			}
		}
 		public function getNiveauByCode($code)
 		{
 			$this->load->model('Centre');
 			echo json_encode($this->Centre->getNiveauByCode($code));
 		}
		public function getMatieresByCode($code, $niveau=1)
		{
			$this->load->model('Matieres');
			$data['matieres'] = $this->Matieres->get($niveau); 
			$this->load->model('SettingCentre');
			$data['matieresCentre'] = $this->SettingCentre->getMatieresByCode($code, $niveau);
			$matieresCentre = array();
			foreach ($data['matieres'] as $key => $value) {
				if( in_array($value->id, $data['matieresCentre']) ){ 
					$matieresCentre[$key]['id'] = $value->id; 
					$matieresCentre[$key]['intitule'] = $value->intitule; 
				}
				
			} 

			echo json_encode($matieresCentre);
		}
		public function getClassesByCode($code, $niveau=1)
		{
			$this->load->model('Prof_');
			$idCentre = $this->Prof_->getIdCentreByCode($code); 

			$this->load->model('SettingCentre');
			$options = $this->SettingCentre->GetOptionsCentre($idCentre,$niveau);
 			
 			$data['intituleClasse'] = $this->intituleNiveau($niveau,$options->appellationClasses);
			$data['intituleGroupe'] = $this->intituleGroupe($options->appellationGroupe); 
			$data['nbrClassesByNiveau'] = (strpos($options->classes, ',') !== false) ?  explode(',', $options->classes)  : array($options->classes); 

 			echo json_encode($data);
		}
	////////////////////////////////////////////////////////////////////////////////////////

		public function sendMessageToAdmin()
		{
			$this->load->model('Messages');
			echo $this->Messages->sendMessageToAdminByProf();
		}

		public function getEmploiProf($idProf)
		{
			$this->load->model('Emplois'); 

			echo json_encode(array(
				"success" => true,
				"emploiProf" => $this->Emplois->getEmploiProf($idProf)
			));
		}

		public function insertAbsenceFromProf()
		{
			

			$this->SetParams($_POST['idProf'], $_POST['idCentre'], $_POST['niveau'] ); 

			$_POST = (array)json_decode($_POST['data']); 

			$_POST['date'] =  str_replace("/", "-", $_POST['date']);

			$this->load->model('Absence');
			$this->Absence->insertAbsenceFromProf(); 

			echo 1;
		}

}