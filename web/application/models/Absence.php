<?php  
class Absence extends CI_Model {

    private $table = "absence_retard"; 	
    private $table_detail = "absence_retard_detail"; 	

    public function insertAbsenceFromProf( $array = false )
    {    
    	extract($_POST);
    	$dateTab = explode('-', $date);
    	$date_time = $dateTab[2]."-".$dateTab[1]."-".$dateTab[0]." ".$time.":00";



		$this->db->insert($this->table, array(
			"niveau" 	=> $this->session->niveau,
			"idcentre" 	=> $this->session->idCentre,
			"idProf" 	=> $this->session->id, 
			"classe" 	=> $classe, 
			"groupe" 	=> $groupe, 
			"matiere" 	=> $matiere, 
			"date_time" => $date_time,
			"state" => 0,
		)); 
		$idAbsence = $this->db->insert_id(); 

		$absence_detail = array();
    	if( isset($absence) ){
    		foreach ($absence as $key => $idClient) {
	    		$absence_detail[$idClient] = array(
	    			"id_absence" 	=>	$idAbsence,
	    			"idClient" 		=>	$idClient,
	    			"absence" 		=>	1,
	    			"retard" 		=>	0,
	    		);
	    	}
    	}

    	if( isset($retard) ){
    		foreach ($retard as $key => $idClient) {
    			if( !isset( $absence_detail[$idClient] ) ){

    				$absence_detail[$idClient] = array(
		    			"id_absence" 	=>	$idAbsence,
		    			"idClient" 		=>	$idClient,
		    			"absence" 		=>	0,
		    			"retard" 		=>	1,
		    		);

    			}else{
		    		$absence_detail[$idClient]["retard"] = 1;
	    		}
    		}
    	}

    	$q = $this->db->insert_batch($this->table_detail, $absence_detail);   
 
	    	
    }

    public function getAll()
    {    

        $this->db->select("A.*, M.intitule as intitule_matiere, P.nom as prof");
        $this->db->from($this->table." as A");
        $this->db->join( 'prof as P', 'P.idProf = A.idProf'); 
        $this->db->join( 'matieres as M', 'M.id = A.matiere'); 
        $this->db->where(array(
            "A.idCentre"  => $this->session->id,
            "A.niveau"    => $this->session->niveau,
            "A.state"     => 0,
        )); 
        $this->db->order_by( 'A.classe ASC, A.groupe ASC, A.id DESC'); 
        $query = $this->db->get();     
        $results_absence = $query->result();

        foreach ($results_absence as $key => $Absence) {
            

            $this->db->select("D.*, C.fname, C.lname");
            $this->db->from($this->table_detail." as D");
            $this->db->join( 'client as C', 'D.idClient = C.idClient'); 
            $this->db->where(array(
                "D.id_absence"  => $Absence->id
            )); 
            $this->db->order_by( 'D.id ASC'); 
            $query = $this->db->get();  

            $Absence->details = $query->result();

        }

        

        return $results_absence;

    }

    public function getSpecificAntries()
    {  

 

        $this->db->select("A.*, M.intitule as intitule_matiere, P.nom as prof");
        $this->db->from($this->table." as A");
        $this->db->join( 'prof as P', 'P.idProf = A.idProf'); 
        $this->db->join( 'matieres as M', 'M.id = A.matiere'); 
        $this->db->where(array(
            "A.idCentre"  => $this->session->id,
            "A.niveau"    => $this->session->niveau,
            "A.state"     => 1
        )); 

        if(!empty($_POST['classe'])){
            $this->db->where(array( 
                "A.classe"     => $_POST['classe']
            ));
        }

        if(!empty($_POST['groupe'])){
            $this->db->where(array( 
                "A.groupe"     => $_POST['groupe']
            ));
        }

        if(!empty($_POST['matiere'])){
            $this->db->where(array( 
                "A.matiere"     => $_POST['matiere']
            ));
        }

        if(!empty($_POST['date'])){
            $dateObject = explode('-', $_POST['date']);
            $this->db->like( 
                "A.date_time",  $dateObject[2]."-".$dateObject[1]."-".$dateObject[0], 'after'
            );
        }

        $this->db->order_by( 'A.classe ASC, A.groupe ASC, A.id DESC'); 
        $query = $this->db->get();     
        $results_absence = $query->result();

        foreach ($results_absence as $key => $Absence) {
            

            $this->db->select("D.*, C.fname, C.lname");
            $this->db->from($this->table_detail." as D");
            $this->db->join( 'client as C', 'D.idClient = C.idClient'); 
            $this->db->where(array(
                "D.id_absence"  => $Absence->id
            )); 
            $this->db->order_by( 'D.id ASC'); 
            $query = $this->db->get();  

            $Absence->details = $query->result();

        }

         return $results_absence;
    }

    public function countAbsence()
    {
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->where(array(
            "idCentre"  => $this->session->id,
            "niveau"    => $this->session->niveau,
            "state"     => 0,
        )); 
        $query = $this->db->get();     
        return count($query->result());
    }

    public function getOne( $id_absence )
    {    

        $this->db->select("A.*, M.intitule as intitule_matiere, P.nom as prof");
        $this->db->from($this->table." as A");
        $this->db->join( 'prof as P', 'P.idProf = A.idProf'); 
        $this->db->join( 'matieres as M', 'M.id = A.matiere'); 
        $this->db->where(array(
            "A.id"  => $id_absence
        ));  
        $query = $this->db->get(); 

        return $query->result()[0];  

    }

    public function updateState( $id_absence, $state = 1 )
    {     
        $this->db->update($this->table, array("state"=>$state), array('id' => $id_absence));

    }

    public function sendAbsence()
    {
        
        $this->load->model('Messages');
        $this->load->model('Client');

        

        foreach ($_POST['absence'] as $key => $idClient) {
            
            $client = $this->Client->GetCustomClient($idClient, '*')[0];
            $absent = $this->getOne($_POST['idAbsence']);


            $content = $client->fname." ".$client->lname." a été déclaré(e) absent(e) le ".date('d/m/Y', strtotime($absent->date_time))." lors de la séance de ".$absent->intitule_matiere."  à ".date('H:i', strtotime($absent->date_time)).".";

            $this->Messages->autoSendMessageToParent( $client->idCentre, $client->niveau, $client->idClient, $content );
        }

        foreach ($_POST['retard'] as $key => $idClient) {
            
            $client = $this->Client->GetCustomClient($idClient, '*')[0];
            $retard = $this->getOne($_POST['idAbsence']);

            $content = $client->fname." ".$client->lname." a été déclaré(e) en retard le ".date('d/m/Y', strtotime($retard->date_time))." lors de la séance de ".$retard->intitule_matiere."  à ".date('H:i', strtotime($retard->date_time)).".";

            $this->Messages->autoSendMessageToParent( $client->idCentre, $client->niveau, $client->idClient, $content );
        } 
 
        $this->updateState($_POST['idAbsence']);
    }
} ?>