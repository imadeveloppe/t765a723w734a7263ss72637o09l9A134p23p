<?php header('Access-Control-Allow-Origin: *');
defined('BASEPATH') OR exit('No direct script access allowed');

class Prof extends CI_Controller {
	public $messages = array();
 
	///////////////////////////////////////// Les message ///////////////////////////////////////
	 	public function messages($message)
	 	{
		   $tab['CompteNotVerified']['title'] = 'Information';
		   $tab['CompteNotVerified']['content'] = 'Votre compte n\'est pas encore validé par votre établissement';
		   $tab['CompteNotVerified']['type'] = 'danger';
		   
		   $tab['Update']['title'] = 'Information';
		   $tab['Update']['content'] = 'Les informations sont enregistrées avec succès'; 
		   $tab['Update']['type'] = 'success';

		   $tab['updateMatiere']['title'] = 'Information';
		   $tab['updateMatiere']['content'] = 'Les matières sont bien enregistrées'; 
		   $tab['updateMatiere']['type'] = 'success';

		   $tab['UpdateClasse']['title'] = 'Information';
		   $tab['UpdateClasse']['content'] = 'Les classes/groupes sont bien enregistrés'; 
		   $tab['UpdateClasse']['type'] = 'success'; 

		   $tab['SendMessage']['title'] = 'Information';
		   $tab['SendMessage']['content'] = 'Le message est bien envoyé'; 
		   $tab['SendMessage']['type'] = 'success';

		   $tab['FaildMessage']['title'] = 'Information';
		   $tab['FaildMessage']['content'] = 'Le message n\'a pas été envoyé, essayez plus tard'; 
		   $tab['FaildMessage']['type'] = 'danger';

		   $tab['PermissedTosendMessage']['title'] = 'Désolé';
		   $tab['PermissedTosendMessage']['content'] = 'Vous ne pouvez pas envoyer des messages. Votre compte n\'est pas encore validé par votre établissement '; 
		   $tab['PermissedTosendMessage']['type'] = 'warning';

		   $tab['NotActivatedCenter']['title'] = 'Désolé';
		   $tab['NotActivatedCenter']['content'] = 'Le compte de votre établissement est désactivé'; 
		   $tab['NotActivatedCenter']['type'] = 'warning';

		   $tab['addProbleme']['title'] = 'Information';
		   $tab['addProbleme']['content'] = 'Merci d\'avoir collaboré à l\'amélioration de TawassolApp' ; 
		   $tab['addProbleme']['type'] = 'success';

		   $tab['NotAddProbleme']['title'] = 'Information';
		   $tab['NotAddProbleme']['content'] = 'Votre rapport n\'a pas pu être envoyé. Merci de réessayer plus tard'; 
		   $tab['NotAddProbleme']['type'] = 'warning';

		   $tab['absence']['title'] = 'Information';
		   $tab['absence']['content'] = 'La déclaration d\'absence / de retard a été enregistrée'; 
		   $tab['absence']['type'] = 'success';

	 		return $tab[$message];
	 	}
	/////////////////////////////////////////////////////////////////////////////////////////////

 	////////////////////////////////// Pages ///////////////////////////////////////////////
	 	public function index()
		{    
			$data['title'] = "Authentification";  
			$this->load->view('prof/login.php', $data);
		}
		public function login()
		{     
			$this->index();
		} 
		public function register()
		{  
			$data['title'] = "Inscription";
			$this->load->view('prof/register.php',$data); 
		}

		public function home()
		{  
			if( $this->isLogedProf() ){
				$data['info'] = $this->session->userdata();
				$data['page'] = 'home';
				$data['HasMarks'] = $this->HasMarksForMessages();
				$data['countMessage'] = $this->MessageProfNonVu();
				$data['countMessageProfToAdmin'] = $this->MessageProfToAdminNonVu();
				$data['title'] = "Tableau de bord";

				$data['message'] = $this->messages;

				$this->load->model('Emplois');
				$data['emploiProf'] = $this->Emplois->getEmploiProf($this->session->id);

				$this->load->view('prof/header.php',$data); 
				$this->load->view('prof/home.php'); 
				$this->load->view('prof/footer.php'); 
			}
		}

		public function sendToParent($idMessage = false, $editMessage = 0)
		{   
			if( $this->isLogedProf() ){
 
				$idProf = $this->session->id;
				$this->load->model('Prof_');
				$prof = $this->Prof_->GetCustomProfs(array($idProf),'*'); 
            	$data['groupeProf'] =  (strpos($prof[0]->classe, ',') !== false) ? explode(',', str_replace(':', '', $prof[0]->classe)) : array(str_replace(':', '', $prof[0]->classe));
            	$data['classeProf'] = array();

            	
            	$tabClass =  (strpos($prof[0]->classe, ',') !== false) ? explode(',', $prof[0]->classe) : array($prof[0]->classe);

	            foreach ($tabClass as  $value1) {
	                $tab = explode(':', $value1);
	                $data['classeProf'][] = $tab[0];
	            }

	            $this->load->model('Modeles_messages');
				$data['modeles'] = $this->Modeles_messages->get( 'prof-to-parent' );

	            $data['parents'] = $this->GetAllClientInCentre();

            	$data['intituleClasse'] = $this->intituleClasse();
				$data['intituleGroupe'] = $this->intituleGroupe();  
				$data['matieres'] = $this->Prof_->getMatiereProf();
				$data['nbrClassesByNiveau'] = $this->SettingCentre->nbrClassesByNiveau();

				$data['title'] = "Communiquer avec les élèves";
				$data['info'] = $this->session->userdata();
				$data['page'] = 'home';
				
				$data['Message'] = false;
				$data['EditMessage'] = false;
				$data['transfer'] ='';

				// print_r([
				// 	"$editMessage"=> $editMessage,
				// 	"$idMessage"=> $idMessage,
				// ]); die();
				if( $editMessage ){ 
					$this->load->model('Messages');
					$data['Message'] = $this->Messages->GetMessageById($idMessage);
					$data['EditMessage'] = true;
				}elseif( $idMessage ){ 
					$this->load->model('Messages');
					$data['transfer'] = $this->Messages->GetMessageById($idMessage);
				}
 
				$data['countMessage'] = $this->MessageProfNonVu();

				if( !$this->verified() ){
					$this->messages[] = $this->messages('CompteNotVerified');
				}
				$data['HasMarks'] = $this->HasMarksForMessages();
				$data['message'] = $this->messages;
				$this->load->view('prof/header.php',$data); 
				$this->load->view('sendToParentByProf.php'); 
				$this->load->view('prof/footer.php'); 
				$this->load->view('prof/modals/modal-send-parent-prof.php');
			}else{
				redirect('Prof/login');
			}
		}

		public function absence()
		{  
			if( $this->isLogedProf() ){
				$data['info'] = $this->session->userdata();
				$data['page'] = 'absence';
				$data['HasMarks'] = $this->HasMarksForMessages();
				$data['countMessage'] = $this->MessageProfNonVu();
				$data['title'] = "Absence / Retard"; 

				$data['intituleClasse'] = $this->intituleClasse();

				$this->load->model('SettingCentre'); 
				$data['nbrClassesByNiveau'] = $this->SettingCentre->nbrClassesByNiveau();

				$data['intituleGroupe'] = $this->intituleGroupe();  
				$data['matieres'] = $this->Prof_->getMatiereProf(); 

				$data['message'] = $this->messages;

				$this->load->view('prof/header.php',$data); 
				$this->load->view('prof/absence.php'); 
				$this->load->view('prof/footer.php'); 
				$this->load->view('prof/modals/modal-absence.php');
			}
		}

		public function sendToAdmin()
		{  
			if( $this->isLogedProf() ){
				$data['info'] = $this->session->userdata();
				$data['page'] = 'home';
				$data['HasMarks'] = $this->HasMarksForMessages();
				$data['countMessage'] = $this->MessageProfNonVu();
				$data['title'] = "Tableau de bord";
				$data['message'] = $this->messages;

				$data['MessagesProf'] = $this->Messages->GetMessageProfToAdmin();


				$this->load->view('prof/header.php',$data); 
				$this->load->view('prof/sendToAdmin.php'); 
				$this->load->view('prof/footer.php'); 
			}
		}
		public function profile()
		{ 
			if( $this->isLogedProf() ){
				$this->load->model('Prof_');
				$data['prof'] = $this->Prof_->select();

				if( !$this->verified() ){
					$this->messages[] = $this->messages('CompteNotVerified');
				}
				$data['HasMarks'] = $this->HasMarksForMessages();
				$data['countMessage'] = $this->MessageProfNonVu();
				$data['message'] = $this->messages;
				$data['title'] = "Profil";
				$data['info'] = $this->session->userdata();
				$data['page'] = 'profile';
				$this->load->view('prof/header.php',$data); 
				$this->load->view('prof/profile.php'); 
				$this->load->view('prof/footer.php'); 
			}else{
				redirect('prof/login');
			}
		}
		public function probleme()
		{
			if( $this->isLogedProf() ){

				
				if( !$this->verified() ){
					$this->messages[] = $this->messages('CompteNotVerified');
				}
				$data['HasMarks'] = $this->HasMarksForMessages();
				$data['countMessage'] = $this->MessageProfNonVu();
				$data['message'] = $this->messages;
				$data['title'] = "Signaler un problème";
				$data['info'] = $this->session->userdata();
				$data['page'] = 'probleme';
				$this->load->view('prof/header.php',$data); 
				$this->load->view('prof/probleme.php'); 
				$this->load->view('prof/footer.php');
			}else{
				redirect('prof/login');
			} 
		}
		public function historique()
		{
			if( $this->isLogedProf() ){

				$data['MessagesProf'] = $this->GetMessageFromOneProf();  
				  
				if( !$this->verified() ){
					$this->messages[] = $this->messages('CompteNotVerified');
				} 
				$data['HasMarks'] = $this->HasMarksForMessages();
				$data['countMessage'] = $this->MessageProfNonVu();
				$data['message'] = $this->messages;
				$data['title'] = "Historique";
				$data['info'] = $this->session->userdata();
				$data['page'] = 'historique';
				$this->load->view('prof/header.php',$data); 
				$this->load->view('prof/historique.php'); 
				$this->load->view('prof/footer.php');
				$this->load->view('prof/modals/modal-valide-send.php');
			}else{
				redirect('prof/login');
			} 
		}
		public function message()
		{
			if( $this->isLogedProf() ){

				$data['messages'] = $this->GetMessageFromCentreToOneProf(); 

				$this->load->model('Centre'); 
				$data['logoEcole'] = $this->Centre->GetLogoCentre( $this->session->idCentre );

				if( !$this->verified() ){
					$this->messages[] = $this->messages('CompteNotVerified');
				}
				$data['HasMarks'] = $this->HasMarksForMessages();
				$data['countMessage'] = $this->MessageProfNonVu();
				$data['message'] = $this->messages;
				$data['title'] = "Messages";
				$data['info'] = $this->session->userdata();
				$data['page'] = 'messages';
				$this->load->view('prof/header.php',$data); 
				$this->load->view('prof/message.php'); 
				$this->load->view('prof/footer.php');
				$this->load->view('prof/modals/modal-valide-send.php');
			}else{
				redirect('prof/login');
			} 
		}
		public function forgetPwd()
		{    
			if( $this->isLogedProf() ){
				redirect('prof/sendToParent');
			}else{ 
				$data['title'] = "Récupération de mot de passe";  
				$this->load->view('prof/forget-pwd.php', $data);
			}
		}

		 
 	////////////////////////////////////////////////////////////////////////////////////////


	///////////////////////////////////// Fonctions ////////////////////////////////////////

		public function HasMarksForMessages()
		{
			$MessagesProf = $this->GetMessageFromOneProf(); 
			$HasMarks = false;
			foreach ($MessagesProf as $key => $message) {
				if( $message->state == 0 &&  $message->remarque != ''  ){
					return true;
				}
			} 
		}
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
			$this->Prof_->insert(); 

			redirect('prof/sendToParent');
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
				$data = "true";
			}else{
				$data = "false"; 
			}
	 		echo $data;
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
		public function changePwd()
		{
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
			if( isset( $_POST['nom']) ):
				$this->load->model('Prof_');
				$this->Prof_->update(); 
				$this->messages[] = $this->messages('Update');
				$this->profile();
			else:
				redirect('prof/profile');
			endif;
		}
		public function signalerProbleme()
		{
			 if( isset($_POST['content']) && !empty($_POST['content'])){
			 	$this->load->model('Probleme');  
				if( $this->Probleme->insert('prof') ){
					$this->messages[] = $this->messages('addProbleme'); 
				}
				else{
					$this->messages[] = $this->messages('NotAddProbleme'); 
				}

				$this->Probleme();
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
				switch ($value->type) {
					case 'groupe':
						$destination =  (strpos($value->destination, ',') !== false) ? explode(',',$value->destination) : array($value->destination);

						foreach ($destination as $key1 => $value1) {
							$destination[$key1] = explode('-', $value1);
						}  
						foreach ($destination as $key2 => $dest2) {
							$destination[$key2] = $intituleClasse[$dest2[0]-1].' - G'.$intituleGroupe[$dest2[1]-1];
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
							foreach ($parents as  $dest) {
								$destination[] = $dest->nom.' ( '.$ClassName[$i].' )';
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
				 
				switch ($message->type) {
					case 'prof':
						$tab =  (strpos($message->destination, ',') !== false) ? explode(',', $message->destination) : array($message->destination);

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
				if( $value->categorie == 'prof' ){
					if( !empty($value->vu)  ){
						$tab =  (strpos($value->vu, ',') !== false) ? explode(',', $value->vu) : array($value->vu);

						if( in_array($idProf, $tab) ){
							unset( $messages[$key] );
						}
					}
				}else{

					unset( $messages[$key] );
				} 
			}
			return count($messages);
		}

		public function MessageProfToAdminNonVu()
		{
			$this->load->model('Messages');
			return $this->Messages->MessageProfToAdminNonVu();
		}

		public function GetAllClientInCentre()
		{
			$this->load->model('Client');
			return $this->Client->GetAllClientInCentre();
		}
		public function SendMessageToParentByProf()
		{ 
			if( isset($_POST['destination']) && !empty($_POST['destination']) ){

				$this->load->model('Centre');
				$this->load->model('Prof_');

				$idCentre = $this->Prof_->getIdCentre();


				if( !$this->Centre->verified( $idCentre ) ){

					$this->messages[] = $this->messages('NotActivatedCenter');

				}else if( !$this->verified() ){

					$this->messages[] = $this->messages('PermissedTosendMessage');

				}else{
					$this->load->model('Messages');
					if( $this->Messages->SendMessageToParentByProf() ){
						$this->messages[] = $this->messages('SendMessage'); 
					}
					else{
						$this->messages[] = $this->messages('FaildMessage'); 
					}
				}

				$this->home();

			}else{
                redirect('prof/sendToParent');
            }
		}
		public function addVuToMessage($id)
		{
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
			if( $this->Messages->sendMessageToAdminByProf() ){
				echo 1;
			}
		}

		public function getElevesByGroupe()
		{
			$this->load->model('Client');
			echo json_encode(
				$this->Client->getElevesByGroupe( $this->session->niveau, $this->session->idCentre, $_POST['classe'], $_POST['groupe'], 0, 0)
			);
		}

		public function insertAbsenceFromProf()
		{
			$this->load->model('Absence');
			$this->Absence->insertAbsenceFromProf();
			$this->messages[] = $this->messages('absence');
			$this->absence();
		}

}