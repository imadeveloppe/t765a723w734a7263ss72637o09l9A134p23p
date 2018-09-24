<?php header('Access-Control-Allow-Origin: *');
defined('BASEPATH') OR exit('No direct script access allowed');

class Rep extends CI_Controller {
	 
	 public function login()
	 {
	 	$this->load->model('ModelRep'); 
	 	echo json_encode($this->ModelRep->login());
	 }
	 public function GetCenters($idRep)
	 {
	 	 $this->load->model('Centre'); 
	 	 if( $this->Centre->GetCenters($idRep) ){
	 	 	echo json_encode($this->Centre->GetCenters($idRep));
	 	 }else{
	 	 	echo "{}";
	 	 }
	 	 
	 }
	 public function updateState($idCentre)
	 {
	 	$this->load->model('Centre'); 
	 	echo $this->Centre->updateState($idCentre);
	 }
	 public function GetInfoRep($idRep)
	 {
	 	$this->load->model('ModelRep'); 
	 	echo json_encode($this->ModelRep->GetInfoRep($idRep));
	 }
	 public function changePwd($idRep)
	 {
	 	$this->load->model('ModelRep'); 
	 	echo $this->ModelRep->changePwd($idRep);
	 }
	 public function ajaxNbrCenter($idRep)
	 {	$this->load->model('ModelRep'); 
	 	if( $this->ModelRep->isValide($idRep) ){
	 		$this->load->model('Centre'); 
	 		echo $this->Centre->ajaxNbrCenter($idRep);
	 	}else{
	 		echo 'blocked';
	 	}
	 	
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
	 
}
