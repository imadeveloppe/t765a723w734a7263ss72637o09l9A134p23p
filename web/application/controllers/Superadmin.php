<?php header('Access-Control-Allow-Origin: *');
defined('BASEPATH') OR exit('No direct script access allowed');

class SuperAdmin extends CI_Controller {
		public $messages = array();
 
	///////////////////////////////////////// Les message ///////////////////////////////////////
	 	public function messages($message)
	 	{ 		   
		   $tab['Update']['title'] = 'Information';
		   $tab['Update']['content'] = 'Les information sont bien enregistrés avec succès'; 
		   $tab['Update']['type'] = 'success';
 
	 		return $tab[$message];
	 	}
	/////////////////////////////////////////////////////////////////////////////////////////////

 	////////////////////////////////// Pages ///////////////////////////////////////////////
	 	public function index()
		{    
			if( $this->isLogedSuperAdmin() ){
				redirect('superadmin/home');
			}else{ 
				$data['title'] = "Authentification";  
				$this->load->view('superadmin/login.php', $data);
			}
		}
		public function home()
		{ 
			if( $this->isLogedSuperAdmin() ){
				
  				ini_set('memory_limit', '-1');

  				$this->load->model('Centre');
				$data['nbrEcole'] = $this->Centre->nbrCenter();

				$this->load->model('Client');
				$data['nbrClient'] = $this->Client->nbrClient();
 

				$data['CentersByRep'] = $this->CentersByRep();

				$this->load->model('Villes');
				$result = $this->Villes->get();
				foreach ($result as $key => $value) {
					$data['villes'][$value->id] = $value->intitule;
				}

				$data['title'] = "Tableau de bord";
				$data['info'] = $this->session->userdata();
				$data['page'] = 'home';  
 
				$this->load->view('superadmin/header.php',$data); 
				$this->load->view('superadmin/home.php'); 
				$this->load->view('superadmin/footer.php');  
				$this->load->view('superadmin/modals/modal-home.php');
			}else{
				redirect('superadmin/login');
			}
		}
		public function profile()
		{ 
			if( $this->isLogedSuperAdmin() ){
				$this->load->model('ModelSuperAdmin');
				$data['SuperAdmin'] = $this->ModelSuperAdmin->select();
 
				$data['message'] = $this->messages;

				$data['title'] = "Profil";
				$data['info'] = $this->session->userdata();
				$data['page'] = 'profile';
				$this->load->view('superadmin/header.php',$data); 
				$this->load->view('superadmin/profile.php'); 
				$this->load->view('superadmin/footer.php'); 
			}else{
				redirect('superadmin/login');
			}
		}
		public function representants()
		{
			if( $this->isLogedSuperAdmin() ){

				$this->load->model('ModelRep');
				$data['representants'] = $this->ModelRep->get();

				$this->load->model('Villes');
				$data['villes'] = $this->Villes->get();
 
				$data['message'] = $this->messages; 
				$data['title'] = "Représentants";
				$data['info'] = $this->session->userdata();
				$data['page'] = 'rep';
				$this->load->view('superadmin/header.php',$data); 
				$this->load->view('superadmin/representants.php'); 
				$this->load->view('superadmin/footer.php');
				$this->load->view('superadmin/modals/modal-representants.php');
			}else{
				redirect('superadmin/login');
			} 
		}
		public function Etablissements()
		{
			if( $this->isLogedSuperAdmin() ){

				$this->load->model('Villes');
				$data['villes'] = $this->Villes->get();

				$this->load->model('ModelRep');
				$data['reps'] = $this->ModelRep->getAll();

				$data['ecoles'] = $this->getEcolesByVille();
				$data['message'] = $this->messages;
				$data['title'] = "Etablissements";
				$data['info'] = $this->session->userdata();
				$data['page'] = 'ecole';
				$this->load->view('superadmin/header.php',$data); 
				$this->load->view('superadmin/centres.php'); 
				$this->load->view('superadmin/footer.php');
				$this->load->view('superadmin/modals/modal-centres.php');
			}else{
				redirect('superadmin/login');
			} 
		}
		
		public function matieres($niveau)
		{
			if( $this->isLogedSuperAdmin() ){
				$this->load->model('Matieres');
				$data['matieres'] = $this->Matieres->get($niveau);

				$data['niveau'] = $niveau;
				$data['message'] = $this->messages; 
				$data['title'] = "Matières";
				$data['info'] = $this->session->userdata();
				$data['page'] = 'matieres';
				$this->load->view('superadmin/header.php',$data); 
				$this->load->view('superadmin/matieres.php'); 
				$this->load->view('superadmin/footer.php');
				$this->load->view('superadmin/modals/modal-matieres.php');
			}else{
				redirect('superadmin/login');
			} 
		}
		public function villes()
		{
			if( $this->isLogedSuperAdmin() ){

				$this->load->model('Villes');
				$data['villes'] = $this->Villes->get();
				 
				$data['message'] = $this->messages;
				$data['title'] = "Villes";
				$data['info'] = $this->session->userdata();
				$data['page'] = 'villes';
				$this->load->view('superadmin/header.php',$data); 
				$this->load->view('superadmin/villes.php'); 
				$this->load->view('superadmin/footer.php');
				$this->load->view('superadmin/modals/modal-villes.php');
			}else{
				redirect('superadmin/login');
			} 
		}
		public function modeles()
		{
			if( $this->isLogedSuperAdmin() ){

				$this->load->model('Modeles_messages');
				$data['modeles'] = $this->Modeles_messages->getAll();
				 
				$data['message'] = $this->messages;
				$data['title'] = "Modéles de messages";
				$data['info'] = $this->session->userdata();
				$data['page'] = 'modeles';
				$this->load->view('superadmin/header.php',$data); 
				$this->load->view('superadmin/modeles.php'); 
				$this->load->view('superadmin/footer.php');
				$this->load->view('superadmin/modals/modal-modeles.php');
			}else{
				redirect('superadmin/login');
			} 
		}
		public function problemes()
		{
			if( $this->isLogedSuperAdmin() ){

				$this->load->model('Probleme');
				$data['problemes'] = $this->Probleme->get(); 
				$data['title'] = "Problèmes signalés";
				$data['info'] = $this->session->userdata();
				$data['page'] = 'probleme';
				$this->load->view('superadmin/header.php',$data); 
				$this->load->view('superadmin/probleme.php'); 
				$this->load->view('superadmin/footer.php'); 
				$this->load->view('superadmin/modals/modal-probleme.php');
			}else{
				redirect('superadmin/login');
			} 
		}

		


		 
 	////////////////////////////////////////////////////////////////////////////////////////


	///////////////////////////////////// Fonctions ////////////////////////////////////////
		public function login()
		{     
			$this->index();
		}  
		public function logout()
		{    
			$this->session->sess_destroy(); 
			$this->index();
		} 
		
		public function isLogedSuperAdmin()
		{
			if( $this->session->logged_in_SuperAdmin ) return true;
			else return false; 
		} 
		public function connecte()
		{
			$this->load->model('ModelSuperAdmin');
			if( $this->ModelSuperAdmin->login() ){
				$data = "true";
			}else{
				$data = "false"; 
			}
	 		echo $data;
		}
		public function update()
		{
			if( isset( $_POST['nom']) ):
				$this->load->model('ModelSuperAdmin');
				$this->ModelSuperAdmin->update(); 
				$this->messages[] = $this->messages('Update');
				$this->profile();
			else:
				redirect('superadmin/profile');
			endif;
		}
		public function changePwd()
		{
			$this->load->model('ModelSuperAdmin');
			if( $this->ModelSuperAdmin->changePwd() ){
				$data = "true";
			}else{
				$data = "false"; 
			}
	 		echo $data;
		}
		public function addMatiere()
		{
			$this->load->model('Matieres');
			$id_insered = $this->Matieres->insert();
			if( $id_insered > 0 ){
				$data['state'] = "true";
				$data['id'] = $id_insered;
			}else{
				$data['state'] = "false"; 
			}
	 		echo json_encode($data);
		}
		public function deleteMatiere($id)
		{
			$this->load->model('Matieres');
			if( $this->Matieres->delete($id) ){
				echo "true";
			}else{
				echo "false";
			}
		}
		public function editMatiere( $id )
		{
			$this->load->model('Matieres');
			if( $this->Matieres->update($id) ){
				echo "true";
			}else{
				echo "false";
			}
		}
		public function addVille()
		{
			$this->load->model('Villes');
			$id_insered = $this->Villes->insert();
			if( $id_insered > 0 ){
				$data['state'] = "true";
				$data['id'] = $id_insered;
			}else{
				$data['state'] = "false"; 
			}
	 		echo json_encode($data);
		}
		public function addmodele()
		{
			$this->load->model('Modeles_messages');
			$id_insered = $this->Modeles_messages->insert();
			if( $id_insered > 0 ){
				$data['state'] = "true";
				$data['id'] = $id_insered;
			}else{
				$data['state'] = "false"; 
			}
	 		echo json_encode($data);
		}
		public function deleteVille($id)
		{
			$this->load->model('Villes');
			if( $this->Villes->delete($id) ){
				echo "true";
			}else{
				echo "false";
			}
		}
		public function deletemodele($id)
		{
			$this->load->model('Modeles_messages');
			if( $this->Modeles_messages->delete($id) ){
				echo "true";
			}else{
				echo "false";
			}
		}
		public function deleteProbleme($id)
		{
			$this->load->model('Probleme');
			if( $this->Probleme->delete($id) ){
				echo "true";
			}else{
				echo "false";
			}
		}
		public function editVille( $id )
		{
			$this->load->model('Villes');
			if( $this->Villes->update($id) ){
				echo "true";
			}else{
				echo "false";
			}
		}
		public function addRep()
		{
			$this->load->model('ModelRep');
			$data = $this->ModelRep->insert();
			if( $data['id'] > 0 ){
				$data['state'] = "true";
				$data['id'] = $data['id'];
				$data['code'] = $data['code'];

			}else{
				$data['state'] = "false"; 
			}
	 		echo json_encode($data);
		}
		public function deleteRep($id)
		{
			$this->load->model('ModelRep');
			if( $this->ModelRep->delete($id) ){
				echo "true";
			}else{
				echo "false";
			}
		}
		public function editRep( $id )
		{
			$this->load->model('ModelRep');
			if( $this->ModelRep->update($id) ){
				echo "true";
			}else{
				echo "false";
			}
		}

		public function CentersByRep()
		{
			$this->load->model('ModelRep');
			$representants = $this->ModelRep->get();
			$data = array();
			$this->load->model('Centre');
			$this->load->model('Client');
			foreach ($representants as $key => $representant) {
				$data[$key]['id'] = $representant->id;
				$data[$key]['nom'] = $representant->nom;
				$data[$key]['tel'] = $representant->tel;
				$data[$key]['nbrCentre'] = $this->Centre->nbrClientByRep($representant->id);
				$data[$key]['nbrClient'] = $this->Client->nbrClientByRep($representant->id);
				$data[$key]['villes'] = $this->Centre->centresByVille($representant->id);
			}

			return $data;
		}
		public function getEcolesByVille()
		{
			$this->load->model('Centre');
			return $this->Centre->getEcolesByVille();
		}
		public function updateEcoleRep()
		{
			$this->load->model('Centre');
			$this->Centre->updateEcoleRep();
		}
		public function nbrProblemes()
		{
			$this->load->model('Probleme');
			echo $this->Probleme->nbrProblemes();
		}
		public function editStateProbleme($idProbleme)
		{
			$this->load->model('Probleme');
			echo $this->Probleme->editState($idProbleme);
		}
		public function selectCenter($idCentre)
		{
			$this->load->model('Centre');
			$result = $this->Centre->selectCenter($idCentre);
			if($result){
				echo json_encode($result);
			}else{
				echo 0;
			}
		}
		public function selectProf($idProf)
		{
			$this->load->model('Prof_');
			$result = $this->Prof_->selectProf($idProf);
			if($result){
				echo json_encode($result);
			}else{
				echo 0;
			}
		}
		public function selectClient($idClient)
		{
			$this->load->model('Client');
			$result = $this->Client->selectClient($idClient);
			if($result){
				echo json_encode($result);
			}else{
				echo 0;
			}
			
		}

		public function deleteCenter($idCentre)
		{	
			$this->load->model('Centre');
			$this->Centre->deleteCenter($idCentre);
			$this->Centre->NotifRepWhenCentreIsDeleted($idCentre);

			$this->load->model('Client');
			$this->Client->DeleteAllClientsInCentre($idCentre);

			$this->load->model('Prof_');
			$this->Prof_->DeleteAllProfsInCentre($idCentre);


			
		}
		public function ActiveCenter($idCentre)
		{	
			$this->load->model('Centre');
			$this->Centre->ActiveCenter($idCentre);
			$this->Centre->NotifRepWhenCentreIsActivated($idCentre);

			$this->load->model('Client');
			$this->Client->ActiveAllClientsInCentre($idCentre);

			$this->load->model('Prof_');
			$this->Prof_->ActiveAllProfsInCentre($idCentre);
			
		}
	////////////////////////////////////////////////////////////////////////////////////////

}