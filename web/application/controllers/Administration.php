<?php header('Access-Control-Allow-Origin: *');
defined('BASEPATH') OR exit('No direct script access allowed');
 


class Administration extends CI_Controller { 

	public $messages = array(); 
 

	public function debug($array)
	{
		echo "<pre>";
			print_r($array);
		echo "</pre>";
	}

	///////////////////////////////////////// Les message ///////////////////////////////////////
	 	public function messages($message, $parram1 = '')
	 	{
		   $tab['CompteNotVerified']['title'] = 'Information';
		   $tab['CompteNotVerified']['content'] = 'Votre compte n\'est pas encore validé par notre équipe';
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
		   $tab['FaildMessage']['content'] = 'Le message n\'a pas été envoyé. Essayez plus tard'; 
		   $tab['FaildMessage']['type'] = 'danger';

		   $tab['PermissedTosendMessage']['title'] = 'Désolé';
		   $tab['PermissedTosendMessage']['content'] = 'Vous ne pouvez pas envoyer des messages. Votre compte n\'est pas encore validé par notre équipe '; 
		   $tab['PermissedTosendMessage']['type'] = 'warning';

		   $tab['addProbleme']['title'] = 'Information';
		   $tab['addProbleme']['content'] = 'Merci d\'avoir collaboré à l\'amélioration de TawassolApp'; 
		   $tab['addProbleme']['type'] = 'success';

		   $tab['NotAddProbleme']['title'] = 'Information';
		   $tab['NotAddProbleme']['content'] = 'Votre rapport n\'a pas pu être envoyé. Merci de réessayer plus tard'; 
		   $tab['NotAddProbleme']['type'] = 'warning';
 
		   $tab['imporedXls']['title'] = 'Information';
		   $tab['imporedXls']['content'] = $parram1.' élève(s) ont été importé(s)'; 
		   $tab['imporedXls']['type'] = 'success';

		   $tab['errorImportXls']['title'] = 'Erreur';
		   $tab['errorImportXls']['content'] = $parram1; 
		   $tab['errorImportXls']['type'] = 'danger';

		   $tab['sentBulletins']['title'] = 'Information';
		   $tab['sentBulletins']['content'] = $parram1.' Bulletin(s) envoyé(s)'; 
		   $tab['sentBulletins']['type'] = 'success';

		   $tab['ErrorSentBulletins']['title'] = 'Erreur';
		   $tab['ErrorSentBulletins']['content'] = $parram1; 
		   $tab['ErrorSentBulletins']['type'] = 'danger';

		   $tab['addSubAdmin']['title'] = 'Information';
		   $tab['addSubAdmin']['content'] = "Le sous-administrateur a été ajouté avec succée";
		   $tab['addSubAdmin']['type'] = 'success';

		   $tab['import_emplois']['title'] = 'Information';
		   $tab['import_emplois']['content'] = "L'emploi du temps est bien importé.";
		   $tab['import_emplois']['type'] = 'success';

	 		return $tab[$message];
	 	}

	/////////////////////////////////////////////////////////////////////////////////////////////

	 	public function getNiveauByIndex($index){
		    return array('prescolaire','primaire','college','lycee')[$index];
		} 
	 	public function hasAccess($access)
	 	{
	 		$info = $this->session->userdata();

		    if( !$info['subAdmin'] ){  
		      return true;
		    } 
		    $currentNiveauName = $this->getNiveauByIndex( $info['niveau'] );
		    if( isset($info['access'][$currentNiveauName]) && in_array($access, $info['access'][$currentNiveauName]) ){  
		      return true;
		    } 
		    return false;
	 	}

	 	public function access_denied()
	 	{	
	 		$data['title'] = "Accès refusé";
	 		$data['info'] = $this->session->userdata();
			$data['page'] = 'reception';
	 		$this->load->view('admin/header.php',$data); 
			$this->load->view('admin/noaccess.php'); 
			$this->load->view('admin/footer.php'); 
	 	}

 	////////////////////////////////// Pages ///////////////////////////////////////////////
	 	public function index()
		{    
			if( $this->isLogedAdmin() ){
				redirect('Administration/login');
			}else{  
				$this->load->view('home.html');
			}
		}
		public function login()
		{     
			$data['title'] = "Authentification";  
			$this->load->view('admin/login', $data);
		} 
		public function register()
		{ 
			$this->load->model('Villes');
			$data['villes'] = $this->Villes->get();

			$data['title'] = "Inscription";
			$this->load->view('admin/register.php',$data); 
		}
		public function forgetPwd()
		{    
			$data['title'] = "Récupération de mot de passe";  
			$this->load->view('admin/forget-pwd.php', $data);
		}
		public function home()
		{  
			if( $this->isLogedAdmin() ){

				///// has Access
				// if( !$this->hasAccess('sendtoparent') && !$this->hasAccess('sendtoprof') && !$this->hasAccess('validsent') ) { 
				// 		redirect('Administration/access_denied'); exit(); 
				// }

				$this->load->model('Messages');
				$data['nbrMessages'] = $this->Messages->nbrMessageNotSend();
				$data['countReceivedMessageNotVu'] = $this->countReceivedMessageNotVu();
				$data['countAbsence'] = $this->countAbsence();	

				$data['title'] = "Tableau de bord";
				$data['info'] = $this->session->userdata();
				$data['page'] = 'home'; 

				if( !$this->verified() ){
					$this->messages[] = $this->messages('CompteNotVerified');
				}

				$data['message'] = $this->messages;
				$this->load->view('admin/header.php',$data); 
				$this->load->view('admin/home.php'); 
				$this->load->view('admin/footer.php'); 
			}else{
				redirect('Administration/login');
			}
		}

		public function reception()
		{
			if( $this->isLogedAdmin() ){

				///// has Access
				if( !$this->hasAccess('reception_prof') && !$this->hasAccess('reception_parent') ) { 
						redirect('Administration/access_denied'); exit(); 
				}

				$this->load->model('Centre');
				$this->load->model('Messages');
				$data['centre'] = $this->Centre->select();

				$data['MessagesProf'] = $this->Messages->GetMessageProfToAdmin();
				$data['MessagesParent'] = $this->Messages->GetMessageParentToAdmin();

				$data['countReceivedMessageNotVu'] = $this->countReceivedMessageNotVu();

				$data['intituleClasse'] = $this->intituleClasse();
				$data['intituleGroupe'] = $this->intituleGroupe();

				//$this->debug($data['Messages']);

				if( !$this->verified() ){
					$this->messages[] = $this->messages('CompteNotVerified');
				}

				$data['message'] = $this->messages;
				$data['title'] = "Messages";
				
				$data['info'] = $this->session->userdata();
				$data['page'] = 'reception';
				$this->load->view('admin/header.php',$data); 
				$this->load->view('admin/reception.php'); 
				$this->load->view('admin/footer.php'); 
				$this->load->view('admin/modals/modal-reception.php'); 
 

			}else{
				redirect('Administration/login');
			}
		}
		public function profil($activeTab = 1)
		{ 
			if( $this->isLogedAdmin() ){

				if( !$this->hasAccess('profile') ) { 
						redirect('Administration/access_denied'); exit(); 
				}

				$this->load->model('Centre');
				$data['centre'] = $this->Centre->select();

				if( !$this->verified() ){
					$this->messages[] = $this->messages('CompteNotVerified');
				}
				
				$data['countReceivedMessageNotVu'] = $this->countReceivedMessageNotVu();

				$data['message'] = $this->messages;
				$data['title'] = "Profil";
				
				$data['info'] = $this->session->userdata();
				$data['page'] = 'profile';

				$data['activeTab'] = $activeTab;

				$this->load->model('Sous_administrateur'); 
				$data['sous_administrateur'] = $this->Sous_administrateur->get();
				
				$this->load->view('admin/header.php',$data); 
				$this->load->view('admin/profile.php'); 
				$this->load->view('admin/footer.php'); 
				$this->load->view('admin/modals/modal-profil.php'); 
			}else{
				redirect('Administration/login');
			}
		}
		public function classes()
		{
			if( $this->isLogedAdmin() ){

				if( !$this->hasAccess('gerer_classes') ) { 
						redirect('Administration/access_denied'); exit(); 
				}
 
				$this->load->model('SettingCentre');
				$data['appellationClasses'] = $this->SettingCentre->getAppellationClasses();

				$this->load->model('SettingCentre');
				$data['appellationGroupe'] = $this->SettingCentre->getAppellationGroupe();
				$data['intituleGroupe'] = $this->intituleGroupe();

				$data['nbrClassesByNiveau'] = $this->SettingCentre->nbrClassesByNiveau();

				$data['countReceivedMessageNotVu'] = $this->countReceivedMessageNotVu();

				$data['intituleNiveau'] = $this->intituleNiveau( $this->session->niveau );


				$this->load->model('Client');
				$data['GetNbrClientsByGroupe'] = $this->Client->GetNbrClientsByGroupeImported();


				if( !$this->verified() ){
					$this->messages[] = $this->messages('CompteNotVerified');
				} 
				$data['message'] = $this->messages;
				$data['title'] = "Gestion | classes";
				$data['info'] = $this->session->userdata();
				$data['page'] = 'gestion';

				
				
				$this->load->view('admin/header.php',$data); 
				$this->load->view('admin/classes.php'); 
				$this->load->view('admin/footer.php');
			}else{
				redirect('Administration/login');
			} 
		}
		public function matieres()
		{
			if( $this->isLogedAdmin() ){

				if( !$this->hasAccess('gerer_matieres') ) { 
						redirect('Administration/access_denied'); exit(); 
				}

				$this->load->model('Matieres');
				$data['matieres'] = $this->Matieres->get();

				$this->load->model('SettingCentre');
				$data['matiereEcole'] = $this->SettingCentre->getMatieres();

				$data['countReceivedMessageNotVu'] = $this->countReceivedMessageNotVu();
 
				if( !$this->verified() ){
					$this->messages[] = $this->messages('CompteNotVerified');
				} 
				$data['message'] = $this->messages;
				$data['title'] = "Gestion | Matières";
				$data['info'] = $this->session->userdata();
				$data['page'] = 'gestion';
				$this->load->view('admin/header.php',$data); 
				$this->load->view('admin/matieres.php'); 
				$this->load->view('admin/footer.php');
			}else{
				redirect('Administration/login');
			} 
		}
		public function eleves( $niveau = -1 )
		{	
			if( $this->isLogedAdmin() ){	

				if( !$this->hasAccess('gerer_eleves') ) { 
						redirect('Administration/access_denied'); exit(); 
				}

				if($niveau >= 0){
					$this->session->niveau = $niveau;
					header('location:http://'.$_SERVER['HTTP_HOST'].substr($_SERVER['REQUEST_URI'], 0, -1));
				}else{
					$this->load->model('Client');
					$data['eleves'] = $this->Client->get();

					$data['intituleClasse'] = $this->intituleClasse();
					$data['intituleGroupe'] = $this->intituleGroupe();

					$data['countReceivedMessageNotVu'] = $this->countReceivedMessageNotVu();	

					/************************************ Filter ******************************************************/
					$this->load->model('SettingCentre');
					$data['appellationClasses'] = $this->SettingCentre->getAppellationClasses();

					$this->load->model('SettingCentre');
					$data['appellationGroupe'] = $this->SettingCentre->getAppellationGroupe();
					$data['intituleGroupe'] = $this->intituleGroupe();

					$this->load->model('Client');
					$data['generatedPassword'] = $this->Client->generatePassword();

					$data['nbrClassesByNiveau'] = $this->SettingCentre->nbrClassesByNiveau();

					$data['intituleNiveau'] = $this->intituleNiveau( $this->session->niveau );

					$this->load->model('SettingCentre');
					$data['nbrClassesByNiveau'] = $this->SettingCentre->nbrClassesByNiveau();

					$this->load->model('Client');
					$data['GetNbrClientsByGroupe'] = $this->Client->GetNbrClientsByGroupe();

					/******************************************************************************************/

					if( !$this->verified() ){
						$this->messages[] = $this->messages('CompteNotVerified');
					}  
					$data['message'] = $this->messages;
					$data['title'] = "Gestion | eleves";
					$data['info'] = $this->session->userdata();
					$data['page'] = 'gestion';
					$this->load->view('admin/header.php',$data); 
					$this->load->view('admin/eleves.php'); 
					$this->load->view('admin/footer.php');
					$this->load->view('admin/modals/modal-eleve.php');
				}
			}else{
				redirect('Administration/login');
			} 
		}
		public function prof( $niveau = -1 )
		{	
			if( $this->isLogedAdmin() ){	


				if( !$this->hasAccess('gerer_profs') ) { 
						redirect('Administration/access_denied'); exit(); 
				}

				if($niveau >= 0){
					$this->session->niveau = $niveau;
					header('location:http://'.$_SERVER['HTTP_HOST'].substr($_SERVER['REQUEST_URI'], 0, -1));
				}else{
					$this->load->model('Prof_');
					$data['profs'] = $this->Prof_->get();

					$data['intituleClasse'] = $this->intituleClasse();
					$data['intituleGroupe'] = $this->intituleGroupe();

					$this->load->model('SettingCentre');
					$data['nbrClassesByNiveau'] = $this->SettingCentre->nbrClassesByNiveau();

					$data['countReceivedMessageNotVu'] = $this->countReceivedMessageNotVu();

					$this->load->model('Matieres');
					$data['matieres'] = $this->Matieres->get();

					$data['ecoleMatieres'] = $this->SettingCentre->getMatieres();
					
					if( !$this->verified() ){
						$this->messages[] = $this->messages('CompteNotVerified');
					}

					$data['message'] = $this->messages;
					$data['title'] = "Gestion | prof";
					$data['info'] = $this->session->userdata();
					$data['page'] = 'gestion';
					$this->load->view('admin/header.php',$data); 
					$this->load->view('admin/prof.php'); 
					$this->load->view('admin/footer.php');
					$this->load->view('admin/modals/modal-prof.php');
				}
			}else{
				redirect('Administration/login');
			} 
		}  
		public function sendToProf($idMessage = false)
		{
			if( $this->isLogedAdmin() ){

				if( !$this->hasAccess('sendtoprof') ) { 
						redirect('Administration/access_denied'); exit(); 
				}

				$data['intituleClasse'] = $this->intituleClasse();
				$data['intituleGroupe'] = $this->intituleGroupe();

				$this->load->model('SettingCentre');
				$data['nbrClassesByNiveau'] = $this->SettingCentre->nbrClassesByNiveau();
				$data['ecoleMatieres'] = $this->SettingCentre->getMatieres();

				$data['countReceivedMessageNotVu'] = $this->countReceivedMessageNotVu();

				$data['ProfsByMatiere'] = $this->GetProfsByMatiere();
				$this->load->model('Matieres');
				$data['matieres'] = $this->Matieres->get();

				$this->load->model('Modeles_messages');
				$data['modeles'] = $this->Modeles_messages->get( 'ecole-to-prof' );
				
				if( !$this->verified() ){
					$this->messages[] = $this->messages('CompteNotVerified');
				}

				$data['message'] = $this->messages;
				$data['title'] = "Communiquer avec les enseignants";
				$data['info'] = $this->session->userdata();
				$data['page'] = 'home';
				
				if( !$idMessage ){
					$data['transfer'] ='';
				}else{
					$this->load->model('Messages');
					$data['transfer'] = $this->Messages->GetContentMessageById($idMessage);
				}
				$this->load->view('admin/header.php',$data); 
				$this->load->view('admin/sendToProf.php'); 
				$this->load->view('admin/footer.php');
				$this->load->view('admin/modals/modal-send-prof.php');
			}else{
				redirect('Administration/login');
			} 
		}

		public function sendToParent( $idMessage = false )
		{
			if( $this->isLogedAdmin() ){


				if( !$this->hasAccess('sendtoparent') ) { 
						redirect('Administration/access_denied'); exit(); 
				}


				$data['intituleClasse'] = $this->intituleClasse();
				$data['intituleGroupe'] = $this->intituleGroupe();

				$this->load->model('SettingCentre');
				$data['nbrClassesByNiveau'] = $this->SettingCentre->nbrClassesByNiveau(); 

				$data['ParentsByClass'] = $this->GetClientByClass(); 

				$this->load->model('Modeles_messages');
				$data['modeles'] = $this->Modeles_messages->get( 'ecole-to-parent' );

				$data['countReceivedMessageNotVu'] = $this->countReceivedMessageNotVu();
				
				if( !$this->verified() ){
					$this->messages[] = $this->messages('CompteNotVerified');
				}

				$data['message'] = $this->messages;
				$data['title'] = "Communiquer avec les parents";
				$data['info'] = $this->session->userdata();
				$data['page'] = 'home';

				if( !$idMessage ){
					$data['transfer'] ='';
				}else{
					$this->load->model('Messages');
					$data['transfer'] = $this->Messages->GetContentMessageById($idMessage);
				}

				$this->load->view('admin/header.php',$data); 
				$this->load->view('sendToParent.php'); 
				$this->load->view('admin/footer.php');
				$this->load->view('admin/modals/modal-send-parent.php');
			}else{
				redirect('Administration/login');
			} 
		}
		public function valideSent( $niveau = -1 )
		{	
			if( $this->isLogedAdmin() ){	


				if( !$this->hasAccess('validsent') ) { 
						redirect('Administration/access_denied'); exit(); 
				}

				if($niveau >= 0){
					$this->session->niveau = $niveau;
					header('location:http://'.$_SERVER['HTTP_HOST'].substr($_SERVER['REQUEST_URI'], 0, -1));
				}else{
					$data['Messages'] = $this->GetMessageFromProfs(); 



					if( !$this->verified() ){
						$this->messages[] = $this->messages('CompteNotVerified');
					}

					$data['countReceivedMessageNotVu'] = $this->countReceivedMessageNotVu();

					$data['message'] = $this->messages;
					$data['title'] = "Valider les envois  des enseignants";
					$data['info'] = $this->session->userdata();
					$data['page'] = 'home';
					$this->load->view('admin/header.php',$data); 
					$this->load->view('admin/valideSent.php'); 
					$this->load->view('admin/footer.php');
					$this->load->view('admin/modals/modal-valide-send.php');
				}  
			}else{
				redirect('Administration/login');
			} 
		}

		public function absence()
		{	
			if( $this->isLogedAdmin() ){	


				if( !$this->hasAccess('validsent') ) { 
						redirect('Administration/access_denied'); exit(); 
				}

				if( !$this->verified() ){
					$this->messages[] = $this->messages('CompteNotVerified');
				}

				$this->load->model('Absence');
				$data['absences'] = $this->Absence->getAll();

				$data['countReceivedMessageNotVu'] = $this->countReceivedMessageNotVu();	
				

				


				$this->load->model('Matieres');
				$data['matieres'] = $this->Matieres->get();

				$data['intituleClasse'] = $this->intituleClasse();
				$data['intituleGroupe'] = $this->intituleGroupe();
				$data['nbrClassesByNiveau'] = $this->SettingCentre->nbrClassesByNiveau();

				$data['searchData'] = false;

				if( isset( $_POST['classe'] ) && isset( $_POST['classe'] ) ){
					$data['searchData'] = $this->Absence->getSpecificAntries();
				}



				$data['message'] = $this->messages;
				$data['title'] = "Valider les envois  des enseignants";
				$data['info'] = $this->session->userdata();
				$data['page'] = 'home';
				$this->load->view('admin/header.php',$data); 
				$this->load->view('admin/absence.php'); 
				$this->load->view('admin/footer.php');
				// $this->load->view('admin/modals/modal-absence.php');

			}else{
				redirect('Administration/login');
			} 
		}


		/////////////////////////////////////////////////

		public function historique()
		{
			if( $this->isLogedAdmin() ){

				if( !$this->hasAccess('historique_prof_parents') && !$this->hasAccess('historique_admin_parents') && !$this->hasAccess('historique_admin_prof') ) { 
						redirect('Administration/access_denied'); exit(); 
				}

				$data['MessagesProf'] = $this->GetMessageFromProfs(1);
				$data['MessagesCentre'] = $this->GetMessageFromCentre();

				$data['intituleClasse'] = $this->intituleClasse();
				$data['intituleGroupe'] = $this->intituleGroupe();
				$this->load->model('SettingCentre');
				$data['nbrClassesByNiveau'] = $this->SettingCentre->nbrClassesByNiveau(); 

				$data['countReceivedMessageNotVu'] = $this->countReceivedMessageNotVu();

				$this->load->model('Matieres');
				$data['matieres'] = $this->Matieres->get();
 
				$data['matiereEcole'] = $this->SettingCentre->getMatieres();

				if( !$this->verified() ){
					$this->messages[] = $this->messages('CompteNotVerified');
				}

				$data['message'] = $this->messages;
				$data['title'] = "Historique";
				$data['info'] = $this->session->userdata();
				$data['page'] = 'historique'; 
				$this->load->view('admin/header.php',$data); 
				$this->load->view('admin/historique.php'); 
				$this->load->view('admin/footer.php');
				$this->load->view('admin/modals/modal-valide-send.php');
			}else{
				redirect('Administration/login');
			} 
		}
		public function export( $type, $classe, $groupe, $idUser=false ){
		 
		  $this->load->library('fpdf_gen'); 

		  $this->load->model('Centre');
		  $data['logoEcole'] = $this->Centre->select()->photo;

		  switch ($type) {
		  	case 'prof-to-parent':

		  		$data['title'] = $this->intituleClasse()[$classe-1]."-G".$this->intituleGroupe()[$groupe-1];
		  		$this->load->model('Messages');
		  		$data['Messages'] = $this->Messages->GetMessageHistory('prof-to-parent',$classe, $groupe);

		  		$data['pdf'] = $this->fpdf_gen->getPdf(); 

				$this->load->view('admin/pdf/prof-to-parent.php', $data);  

		  		break; 

		  	case 'prof-to-one-parent':
		  		$this->load->model('Client');
		  		$client = $this->Client->GetCustomClient(array($idUser), 'fname,lname')[0];

		  		$data['title'] = $client->fname.' '.$client->lname;
		  		$this->load->model('Messages');
		  		$data['Messages'] = $this->Messages->GetMessageHistory('prof-to-one-parent',$classe, $groupe, $idUser);

		  		$data['pdf'] = $this->fpdf_gen->getPdf(); 

				$this->load->view('admin/pdf/prof-to-one-parent', $data);
		  		break; 

		  	case 'admin-to-one-parent':
		  		
		  		$this->load->model('Client');
		  		$client = $this->Client->GetCustomClient(array($idUser), 'fname,lname')[0];

		  		$data['title'] = $client->fname.' '.$client->lname;
		  		$this->load->model('Messages');
		  		$data['Messages'] = $this->Messages->GetMessageHistory('admin-to-one-parent',$classe, $groupe, $idUser);

		  		$data['pdf'] = $this->fpdf_gen->getPdf(); 

				$this->load->view('admin/pdf/admin-to-one-parent', $data);
		  		break; 

		  	case 'admin-to-one-prof':
		  		
		  		$this->load->model('Prof_');
		  		$client = $this->Prof_->GetCustomProf($idUser, 'nom')[0];

		  		$data['title'] = $client->nom;
		  		$this->load->model('Messages');
		  		$data['Messages'] = $this->Messages->GetMessageHistory('admin-to-one-prof',$classe, $groupe, $idUser);

		  		$data['pdf'] = $this->fpdf_gen->getPdf(); 

		  		
				$this->load->view('admin/pdf/admin-to-one-prof', $data);
		  		break; 
		  } 
		  
		}

		public function probleme($param=false)
		{
			if( $this->isLogedAdmin() ){

				if( $param ):
					$this->load->model('Client');
					$query = $this->db->get_where('client', array('password' => '' )); 
					$result = $query->result();

					foreach ($result as $key => $eleve) {
						$this->db->update(
	                        'client', 
	                        array(
	                                "password" => $this->Client->generatePassword()
	                        ), 
	                        array('idClient' => $eleve->idClient)
	                    );
					}

					echo "end"; 

					die();

				endif;

				
				if( !$this->verified() ){
					$this->messages[] = $this->messages('CompteNotVerified');
				}

				$data['countReceivedMessageNotVu'] = $this->countReceivedMessageNotVu();

				$data['message'] = $this->messages;
				$data['title'] = "Signaler un problème";
				$data['info'] = $this->session->userdata();
				$data['page'] = 'probleme';
				$this->load->view('admin/header.php',$data); 
				$this->load->view('admin/probleme.php'); 
				$this->load->view('admin/footer.php');
			}else{
				redirect('Administration/login');
			} 
		}


		public function importXls()
		{	
			if( $this->isLogedAdmin() ){
				$this->load->model('Client');
				$data = $this->Client->importXls();

				if($data["success"]){
					$this->messages[] = $this->messages('imporedXls', $data['inseredRows']);
				}else{
					$this->messages[] = $this->messages('errorImportXls', $data['msg']);
				}  
				$this->classes();
			}else{
				redirect('Administration/login');
			} 
		}

		public function bulletins()
		{
			if( $this->isLogedAdmin() ){
 
				$data['message'] = $this->messages;
				$data['title'] = "Bulletins";
				$data['info'] = $this->session->userdata();
				$data['page'] = 'home';

				$this->load->view('admin/header.php',$data); 
				$this->load->view('admin/bulletins.php'); 
				$this->load->view('admin/footer.php');

			}else{
				redirect('Administration/login');
			} 
		}

		public function sendBulletins()
		{	
			if( $this->isLogedAdmin() ){

				$this->load->model('Bulletins'); 
				$data =	$this->Bulletins->sendBulletins();
				if( $data['success'] ){
					$this->messages[] = $this->messages('sentBulletins', $data['sentBulletins']);
				}else{
					$this->messages[] = $this->messages('ErrorSentBulletins', $data['msg']);
				}
				$this->bulletins();

			}else{
				redirect('Administration/login');
			}  
		}

		public function emploi_de_temps_classe()
		{	
			if( $this->isLogedAdmin() ){

				if( !$this->hasAccess('emplois_classe') ) { 
						redirect('Administration/access_denied'); exit(); 
				}

				$data = array();

				$this->load->model('SettingCentre');
				$data['appellationClasses'] = $this->SettingCentre->getAppellationClasses();

				$this->load->model('SettingCentre');
				$data['appellationGroupe'] = $this->SettingCentre->getAppellationGroupe();
				$data['intituleGroupe'] = $this->intituleGroupe();

				$data['nbrClassesByNiveau'] = $this->SettingCentre->nbrClassesByNiveau(); 
				$data['intituleNiveau'] = $this->intituleNiveau( $this->session->niveau );

				$data['countReceivedMessageNotVu'] = $this->countReceivedMessageNotVu();

				$this->load->model('Emplois');
				$data['emplois'] = $this->Emplois->get('classe');


				$this->load->model('Messages'); 
				$data['nbrMessages'] = $this->Messages->nbrMessageNotSend(); 
				$data['page'] = 'emploi_de_temps';
				$data['title'] = "Emploi de temps";
				$data['info'] = $this->session->userdata();

				$data['message'] = $this->messages;
				

				$this->load->view('admin/header.php',$data); 
				$this->load->view('admin/emploi_de_temps_classe.php'); 
				$this->load->view('admin/footer.php');
				$this->load->view('admin/modals/modal-emplois.php'); 

			}else{
				redirect('Administration/login');
			}  
		}

		public function emploi_de_temps_prof()
		{	
			if( $this->isLogedAdmin() ){


				if( !$this->hasAccess('emplois_prof') ) { 
						redirect('Administration/access_denied'); exit(); 
				}
				
				$data = array();
				

				$this->load->model('Prof_');
				$data['profs'] = $this->Prof_->get();

				$data['arrayProfs'] = array();
				foreach ($data['profs'] as $key => $prof) {
					$data['arrayProfs'][$prof->idProf] = $prof->nom;
				}

				$this->load->model('Emplois');
				$data['emplois'] = $this->Emplois->get('prof');

				$data['countReceivedMessageNotVu'] = $this->countReceivedMessageNotVu();

				$this->load->model('Messages'); 
				$data['nbrMessages'] = $this->Messages->nbrMessageNotSend(); 
				$data['page'] = 'emploi_de_temps';
				$data['title'] = "Emploi de temps";
				$data['info'] = $this->session->userdata();

				$data['message'] = $this->messages;

				$this->load->view('admin/header.php',$data); 
				$this->load->view('admin/emploi_de_temps_prof.php'); 
				$this->load->view('admin/footer.php');
				$this->load->view('admin/modals/modal-emplois.php'); 
			}else{
				redirect('Administration/login');
			}  
		}

 	////////////////////////////////////////////////////////////////////////////////////////


	///////////////////////////////////// Fonctions ////////////////////////////////////////
	 	public function isLogedAdmin()
		{
			if(isset($_POST['niveau'])){
	 			$this->session->niveau = $_POST['niveau'];
	 			redirect('Administration/home');
	 		}
			if( $this->session->logged_in ) return true;
			else return false; 
		} 
		public function verifCode($code)
		{
			$this->load->model('Centre');
			
			if( $this->Centre->verifCode($code) > 0 ){
				echo 1;
			}else{
				echo 0;
			}
		}
		public function verifUser()
		{
			$this->load->model('Centre');
			
			$data = array();
			if( $this->Centre->verifTel() ){
				$data['tel'] = true;
			}else{
				$data['tel'] = false;
			}

			if( $this->Centre->verifEmail() ){
				$data['email'] = true;
			}else{
				$data['email'] = false;
			}

			echo json_encode($data);
		}
		public function addCentre()
		{
			$this->load->model('Centre');
			$this->load->model('SettingCentre');
			$this->Centre->insert(); 
			$this->SettingCentre->insert($this->session->id); 

	 		redirect('Administration/login');
		} 
		public function verified()
		{
			$this->load->model('Centre');
			if($this->Centre->verified()) return true;
			else return false;
		}
		
		public function update()
		{
			if( isset( $_POST['nom']) ):
				$this->load->model('Centre');
				$this->Centre->update(); 
				$this->messages[] = $this->messages('Update');
				$this->profil();
			else:
				redirect('Administration/profile');
			endif;
		} 
		public function connecte()
		{
			$this->load->model('Sous_administrateur');
			$this->load->model('Centre');
			
			if( $_POST['sub-admin'] == 1 ){
				if( $this->Sous_administrateur->connecte() ){
					$data = "true";
				}else{
					$data = "false"; 
				}
			}else{
				if( $this->Centre->connecte() ){
					$data = "true";
				}else{
					$data = "false"; 
				}
			}

				
	 		echo $data;
		}
		public function GetPwdForgeted()
		{
			$this->load->model('Centre');
			if( $this->Centre->GetPwdForgeted() ){
				$data = "true";
			}else{
				$data = "false"; 
			}
	 		echo $data;
		}
		public function logout()
		{    
			$this->session->sess_destroy(); 
			$this->index();
		} 
		public function changePwd()
		{
			$this->load->model('Centre');
			if( $this->Centre->changePwd() ){
				$data = "true";
			}else{
				$data = "false"; 
			}
	 		echo $data;
		}
		public function matiereEcole()
		{

			if( isset( $_POST['matieres']) ):
				$this->load->model('SettingCentre');
				$this->SettingCentre->updateMatiere(implode(',', $_POST['matieres']));
				$this->messages[] = $this->messages('updateMatiere');
				$this->matieres();
			else:
				redirect('Administration/classes');
			endif;
		}
		public function intituleNiveau($niveau)
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

			return $tab[$niveau];
		}
		public function intituleClasse()
		{
			$this->load->model('SettingCentre');

			$intituleNiveau = $this->intituleNiveau($this->session->niveau);
			return $intituleNiveau[$this->SettingCentre->getAppellationClasses()];
		}
		public function intituleGroupe()
		{
			$tab = array();  

			///////////// numerique ///////////////
			for ($i=1; $i <= 26 ; $i++) { 
				$tab[1][] = $i;
			}

			///////////// alphabetique ///////////////
			$tab[2] = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');

			$this->load->model('SettingCentre');
			return $tab[$this->SettingCentre->getAppellationGroupe()];
		}

		public function classesEcole()
		{
			if( isset( $_POST['classes']) ):
				$this->load->model('SettingCentre');
				$this->SettingCentre->updateClasse();
				$this->messages[] = $this->messages('UpdateClasse');
				$this->classes();
			else:
				redirect('Administration/classes');
			endif;
		}

		public function deleteClient($idClient)
		{
			$this->load->model('Client');
			if( $this->Client->delete($idClient) ){
				echo "true";
			}else{
				echo "false";
			}
		}
		public function deleteParent($idClient, $indexParent)
		{
			$this->load->model('Client');
			if( $this->Client->deleteParent($idClient, $indexParent) ){
				echo "true";
			}else{
				echo "false";
			}
		}
		public function deleteProf($idProf)
		{
			$this->load->model('Prof_');
			if( $this->Prof_->delete($idProf) ){
				echo "true";
			}else{
				echo "false";
			}
		}
		public function editStateClient($idClient)
		{
			$this->load->model('Client');
			echo $this->Client->editState($idClient);
		}
		public function editStatePhotoClient($idClient)
		{
			$this->load->model('Client');
			echo $this->Client->editStatePhoto($idClient);
		}
		public function editStateProf($idProf)
		{
			$this->load->model('Prof_');
			echo $this->Prof_->editState($idProf);
		}
		public function editFideliteProf($idProf)
		{
			$this->load->model('Prof_');
			echo $this->Prof_->editFidelite($idProf);
		}
		public function updateClient()
		{
			$clientData = array();
			parse_str($_POST['clientData'], $clientData);

			if( trim($clientData['nomParent'][1]) != '' &&  trim($clientData['telParent'][1]) != '' ){
				$clientData['nomParent'] = implode("/", $clientData['nomParent']);
				$clientData['telParent'] = implode("/", $clientData['telParent']);
			}else{
				$clientData['nomParent'] = $clientData['nomParent'][0];
				$clientData['telParent'] = $clientData['telParent'][0];
			} 

			$this->load->model('Client');
			$result = $this->Client->updateClient($clientData);
			if( $result or empty($result) ){
				echo $result;
			}else{
				echo "false";
			}
		}
		public function updateMatiersProf()
		{	
			
			$dataMatieres = array();
			parse_str($_POST['dataMatieres'], $dataMatieres);
 			$dataMatieres['matieres'] = implode(',', $dataMatieres['matieres']); 

			$this->load->model('Prof_');
			if( $this->Prof_->updateMatiere($dataMatieres) ){
				echo $dataMatieres['matieres'];
			}else{
				echo "false";
			}
		}
		public function updatePwdProf()
		{	
			
			$dataPwd = array();
			parse_str($_POST['dataPwd'], $dataPwd); 

			$this->load->model('Prof_');
			if( $this->Prof_->updatePwdProf($dataPwd) ){
				echo "true";
			}else{
				echo "false";
			}
		}
		public function updateClassesProf()
		{	
			
			$dataClasses = array();
			parse_str($_POST['dataClasses'], $dataClasses);

			if(isset($dataClasses['classe'])):
				foreach ($dataClasses['classe'] as $key => $value) {
					$dataClasses['classe'][$key] = $value.':'.$dataClasses['groupe'][$key];
				}
				$dataClasses['classe'] = array_unique($dataClasses['classe']);
				$dataClasses['classe'] = implode(',', $dataClasses['classe']);
				unset($dataClasses['groupe']);   
			else:
				$dataClasses['classe'] = '';
			endif;

			$this->load->model('Prof_');
			if( $this->Prof_->updateClassesProf($dataClasses) ){
				echo $dataClasses['classe'];
			}else{
				echo "false";
			}
		}
		public function jSonMatieresProf($idProf)
		{
			$this->load->model('Matieres');
			$this->load->model('Prof_');

			$matieres = $this->Matieres->get(); 
			$matieresProf = explode(',', $this->Prof_->getMatiere($idProf)); 

			foreach ($matieres as $matiere) {
				if( in_array($matiere->id, $matieresProf) ){
					$tab[] = array('id'=>$matiere->id, 'intitule'=>$matiere->intitule);
				}
			}

			echo  (isset($tab)) ? json_encode($tab) : '';
		}
		public function GetProfsByMatiere()
		{
			$this->load->model('SettingCentre');
			return $this->SettingCentre->GetProfsByMatiere();
		}
		public function GetClientByClass()
		{
			$this->load->model('SettingCentre');
			return $this->SettingCentre->GetClientByClass();
		}
		public function SendMessageToProf()
		{  
			if( isset($_POST['destination']) && !empty($_POST['destination']) ){

				if( !$this->verified() ){
					$this->messages[] = $this->messages('PermissedTosendMessage');
				}else{
					$this->load->model('Messages');
					if( $this->Messages->SendMessageToProf() ){
						$this->messages[] = $this->messages('SendMessage'); 
					}
					else{
						$this->messages[] = $this->messages('FaildMessage'); 
					}
				} 

				$this->sendToProf();

			}else{
                redirect('Administration/sendToProf');
            }
		}
		public function SendMessageToParent()
		{ 
			if( isset($_POST['destination']) && !empty($_POST['destination']) ){
				if( !$this->verified() ){
					$this->messages[] = $this->messages('PermissedTosendMessage');
				}else{
					$this->load->model('Messages');
					if( $this->Messages->SendMessageToParent() ){
						$this->messages[] = $this->messages('SendMessage'); 
					}
					else{
						$this->messages[] = $this->messages('FaildMessage'); 
					}
				}

				$this->sendToParent();

			}else{
                redirect('Administration/sendToParent');
            }
		}
		public function GetMessageFromProfs($etat=0)
		{
			$this->load->model('Messages');
			$this->load->model('Client');
			$result = $this->Messages->GetMessageFromProfs($etat); 
			$messages = $result; 
 

			$intituleClasse = $this->intituleClasse();
			$intituleGroupe = $this->intituleGroupe();



			foreach ($result as $key => $value) { 
 	

				if(  !empty($value->vu) && strpos($value->vu, ',') === false ){
					$clients = $this->Client->GetCustomClient( $value->vu );
					

					if( $clients != 'false' ){  
						$messages[$key]->vu = $clients[0]->nom;
						$messages[$key]->nbrVu = 1;
					}else{
						$messages[$key]->vu = '';
						$messages[$key]->nbrVu = 0;
					}
					
				}elseif(strpos($value->vu, ',') !== false){
					$vu = array();
					foreach (explode(',', $value->vu) as  $idClient) { 
						$clients = $this->Client->GetCustomClient( $idClient );
						if( $clients != 'false' ){
							$vu[] = $clients[0]->nom;
						}
					}
					$messages[$key]->vu = implode('<br>', $vu);
					$messages[$key]->nbrVu = count($vu);

				}else{
					$messages[$key]->nbrVu = 0;
				}
 	



				switch ($value->type) {
					case 'groupe':
						$destination = (strpos($value->destination, ',') !== false) ? explode(',',$value->destination) : array($value->destination);
						foreach ($destination as $key1 => $value1) {
							$destination[$key1] = explode('-', $value1);
						}  
						foreach ($destination as $key2 => $dest2) {
							$destination[$key2] = $intituleClasse[$dest2[0]-1].' - G'.$intituleGroupe[$dest2[1]-1];
						}  

						$messages[$key]->destination = $destination;  
						break;
					
					case 'classe':    	
						$destination = (strpos($value->destination, ',') !== false) ? explode(',',$value->destination) : array($value->destination); 
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
		public function GetMessageFromCentre()
		{
			$this->load->model('Messages');
			$this->load->model('Client');
			$this->load->model('Prof_');
			$result = $this->Messages->GetMessageFromCentre( $toProf = true );  

			$messages = $result;  

			$intituleClasse = $this->intituleClasse();
			$intituleGroupe = $this->intituleGroupe();

			foreach ($result as $key => $value) { 

				if( $value->categorie == 'parent' or $value->categorie == 'prof' ):

					if( $value->categorie == 'parent'){	

						if(  !empty($value->vu) && strpos($value->vu, ',') === false ){
							$result = $this->Client->GetCustomClient( $value->vu );
							if($result != 'false'){
								$messages[$key]->vu = $result[0]->nom;
								$messages[$key]->nbrVu = 1;
							}else{
								$messages[$key]->vu = '';
								$messages[$key]->nbrVu = 0;
							}
							
						}elseif(strpos($value->vu, ',') !== false){
							$vu = array();
							foreach (explode(',', $value->vu) as  $idClient) { 
								$result = $this->Client->GetCustomClient( $idClient );
								if($result != 'false'){
									$vu[] = $result[0]->nom;
								}
							}
							$messages[$key]->vu = implode('<br>', $vu);
							$messages[$key]->nbrVu = count($vu);

						}else{
							$messages[$key]->nbrVu = 0;
						}

					}

					if( $value->categorie == 'prof'){	

						if(  !empty($value->vu) && strpos($value->vu, ',') === false ){
							$result = $this->Prof_->GetCustomProf( $value->vu );
							if($result){
								$messages[$key]->vu = $result[0]->nom;
								$messages[$key]->nbrVu = 1;
							}else{
								$messages[$key]->vu = '';
								$messages[$key]->nbrVu = 0;
							}
							
						}elseif(strpos($value->vu, ',') !== false){
							$vu = array();
							foreach (explode(',', $value->vu) as  $idClient) { 
								$result = $this->Prof_->GetCustomProf( $value->vu );
								if($result){
									$vu[] = $result[0]->nom;
								}
							}
							$messages[$key]->vu = implode('<br>', $vu);
							$messages[$key]->nbrVu = count($vu);

						}else{
							$messages[$key]->nbrVu = 0;
						}

					}


					switch ($value->type) {
						case 'groupe':
							$destination = (strpos($value->destination, ',') !== false) ? explode(',',$value->destination) : array($value->destination);
							foreach ($destination as $key1 => $value1) {
								$destination[$key1] = explode('-', $value1);
							}  
							foreach ($destination as $key2 => $dest2) {
								$destination[$key2] = $intituleClasse[$dest2[0]-1].' - G'.$intituleGroupe[$dest2[1]-1];
							}  

							$messages[$key]->destination = $destination;  
							break;
						
						case 'classe':    	
							$destination = (strpos($value->destination, ',') !== false) ? explode(',',$value->destination) : array($value->destination);  
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

							if($parents != 'false'){
								$destination = array(); 
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

						case 'prof': 
							$destination = (strpos($value->destination, ',') !== false) ? explode(',',$value->destination) : array($value->destination); 
							$this->load->model('Prof_');
							$profs = $this->Prof_->GetCustomProfs($destination);
							$destination = array();
							foreach ($profs as  $dest) {
								$destination[] = $dest->nom;
							}

							$messages[$key]->destination = $destination;
							break;

						case 'matiere': 
							$destination = (strpos($value->destination, ',') !== false) ? explode(',',$value->destination) : array($value->destination); 
							$this->load->model('Matieres');
							$matieres = $this->Matieres->GetCustomMatieres($destination);
							unset($destination); 
							foreach ($matieres as  $dest) {
								$destination[] = $dest->intitule;
							}

							$messages[$key]->destination = $destination;
							break;

						case 'all':
							if( $value->categorie == 'parent' )
								$destination = array('Tous les parents');
							elseif( $value->categorie == 'prof' )
								$destination = array('Tous les enseignants');

							$messages[$key]->destination = $destination;
							break;
					}  

				else:
					unset($messages[$key]);
				endif;

			} 

			return $messages;
		}
		public function removeMessage($idMessage)
		{
			$this->load->model('Messages');
			$intituleClasse = $this->intituleClasse();
			$intituleGroupe = $this->intituleGroupe();
			if( $this->Messages->removeMessage($idMessage, $intituleClasse, $intituleGroupe) ){
				echo "true";
			}
			
		}
		public function addRemarqueToMessage()
		{	 
			$this->load->model('Messages'); 
			if(  $this->Messages->addRemarqueToMessage($_POST)  ){
				echo "true";
			}
			
		}
		public function sendMessage($idMessage,$etat=1)
		{
			$this->load->model('Messages');
			if( $this->Messages->sendMessage($idMessage,$etat) ){
				echo "true";
			}
		}
		public function nbrMessageNotSend($idCentre=false, $niveau=false)
		{
			$this->load->model('Messages'); 
			if( !$idCentre ){
				return $this->Messages->nbrMessageNotSend();
			}else{ 
				echo $this->Messages->nbrMessageNotSend($idCentre, $niveau);
			} 
		} 
		public function GetNofifByAjax($idCentre)
		{
			$this->load->model('Messages'); 
			$this->load->model('Client'); 
			$this->load->model('Prof_'); 

			$data = array();
			$data['messages'] = $this->Messages->AjaxNbrMessageNotSend($idCentre);
			$data['parents'] = $this->Client->AjaxNbrClientsNotValidate($idCentre);
			$data['profs'] = $this->Prof_->AjaxNbrProfsNotValidate($idCentre);

			echo json_encode( $data ) ;
		} 
		public function signalerProbleme()
		{
			 if( isset($_POST['content']) && !empty($_POST['content'])){
			 	$this->load->model('Probleme');  
				if( $this->Probleme->insert('centre') ){
					$this->messages[] = $this->messages('addProbleme'); 
				}
				else{
					$this->messages[] = $this->messages('NotAddProbleme'); 
				}

				$this->Probleme();
			 }
		}
		public function nbrEleveNotVerified($idCentre, $niveau)
		{
			$this->load->model('Client');
			echo $this->Client->nbrEleveNotVerified($idCentre, $niveau);
		}
		public function nbrProfNotVerified($idCentre, $niveau)
		{
			$this->load->model('Prof_');
			echo $this->Prof_->nbrProfNotVerified($idCentre, $niveau);
		}
		public function GetNiveauCentre($idCentre)
		{ 
			$this->load->model('Centre');
			echo json_encode($this->Centre->GetNiveau($idCentre));
		}
		public function valideAllClient( $state )
		{
			$this->load->model('Client');
			$this->Client->valideAllClient( $state );
			redirect('Administration/eleves');
		}
		public function valideAllProf( $state )
		{
			$this->load->model('Prof_');
			$this->Prof_->valideAllProf( $state );
			redirect('Administration/prof');
		}
		public function addClientFromAdmin()
		{	
			$clientData = array();
			parse_str($_POST['clientData'], $clientData);

			$this->load->model('Client'); 
			$this->Client->addClientFromAdmin( $clientData );
		}

		public function deleteClientFromGroupe()
		{	
			$this->load->model('Centre');
			$password = $this->Centre->getPassword();

			if( sha1($_POST['password']) == $password ){
				$this->load->model('Client');
				if( $this->Client->deleteClientFromGroupe() ){
					echo 1;
				}else{
					echo -1;
				}
			}else{
				echo 0;
			} 
		}

		public function getElevesByGroupe()
		{
			$this->load->model('Client'); 
			echo json_encode($this->Client->getElevesByGroupe());
		}
 		
 		public function getListProfsByMatiere($idMatiere)
 		{
 			$this->load->model('Prof_');
 			echo json_encode($this->Prof_->getProfsByMatiere($idMatiere));
 		}

 		public function responseMessageToAdminByProf()
 		{
 			$this->load->model('Messages'); 
 			echo $this->Messages->responseMessageToAdminByProf();
 		}

 		public function responseMessageToAdminByParent()
 		{
 			$this->load->model('Messages'); 
 			echo $this->Messages->responseMessageToAdminByParent();
 		}

 		public function allowSendMessages ()
 		{ 
 			$this->load->model('Centre'); 
 			$this->Centre->allowSendMessages();
 		}

 		public function import_emplois()
 		{  	 
 			$this->load->model('Emplois'); 
 			if( $this->Emplois->insert() ){


				$this->messages[] = $this->messages('import_emplois');

 				if( $_POST['redirect'] == 'emploi_de_temps_classe' ){
 					$this->emploi_de_temps_classe();
 				}else{
 					$this->emploi_de_temps_prof();
 				}
				  

 			} 
 
 		}

 		public function deleteEmploi( $id )
 		{  	 
 			$this->load->model('Emplois'); 
 			if( $this->Emplois->delete($id) ){
 				echo "true";
 			}
 		}

 		public function updateDocs()
 		{  	 
 			$this->load->model('Centre'); 
 			if( $this->Centre->updateDocs() ){
 				$this->messages[] = $this->messages('Update');
				$this->profil(3);
 			}
 		}

 		public function addSubAdmin()
 		{	 
 			if(isset($_POST['id']) && $_POST['id'] == 0){
 				$this->load->model('Sous_administrateur'); 
	 			echo json_encode($this->Sous_administrateur->insert());
 			}
 			elseif(isset($_POST['id']) && $_POST['id'] > 0){
 				$this->load->model('Sous_administrateur'); 
	 			echo json_encode($this->Sous_administrateur->update());
 			}else{
 				redirect('Administration/profile');
 			}
 			
 		}

 		public function sendAbsence()
 		{ 
 			$this->load->model('Absence');
 			$this->Absence->sendAbsence();  

 			redirect('Administration/absence');
 		}

 		public function countAbsence()
 		{ 
 			$this->load->model('Absence');
 			return $this->Absence->countAbsence();   
 		}

 		public function countReceivedMessageNotVu()
 		{
 			$this->load->model('Messages');
 			$MessagesProf = $this->Messages->GetMessageProfToAdmin();
			$MessagesParent = $this->Messages->GetMessageParentToAdmin();

			$count = 0;
			foreach ($MessagesProf as $key => $message) {

				$messages = json_decode($message->content);
				if( count($messages) == 1 ){
                      $count += 1;
                }  
			}
			foreach ($MessagesParent as $key => $message) {
				
				$messages = json_decode($message->content);
				if( count($messages) == 1 ){
                      $count += 1;
                } 
			}

			return $count;
 		}
		
	////////////////////////////////////////////////////////////////////////////////////////

}
