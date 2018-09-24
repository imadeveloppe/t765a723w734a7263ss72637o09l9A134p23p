<?php  
class Sous_administrateur extends CI_Model {
	private $table = "sous_administrateur";   

	public function insert(){
	 	$_POST['pwd'] = sha1($_POST['pwd']);
        if( isset($_POST['access']) ){
            $_POST['access'] = serialize($_POST['access']);
        } 
	 	$_POST['idCentre'] = $this->session->id;

        $query = $this->db->get_where($this->table, array('tel'=>$_POST['tel']));

        if( $query->num_rows() == 0 ){
            if( $this->db->insert($this->table, $_POST) ){ 
                return array(
                    "success" => 1,
                    "message" => "Le responsable a été ajouté avec succès."
                );
            }else{
                return array(
                    "success" => 2,
                    "message" => "Erreur d'insertion de cet utilisateur, veuillez réessayer plus tard"
                );
            } 
        }else{
            return array(
                "success" => 0,
                "message" => "Ce numéro de téléphone est déjà utilisé."
            );
        }
    	 	
	} 


    public function update(){
        if( !empty($_POST['pwd']) ){
            $_POST['pwd'] = sha1($_POST['pwd']);
        }else{
            unset($_POST['pwd']);
        }
        
        if( isset($_POST['access']) ){
            $_POST['access'] = serialize($_POST['access']);
        } 
        $_POST['idCentre'] = $this->session->id;

        $query = $this->db->get_where($this->table, array('tel'=>$_POST['tel'], 'id !='=>$_POST['id']));

        if( $query->num_rows() == 0 ){
            if( $this->db->update($this->table, $_POST, array('id' => $_POST['id'])) ){ 
                return array(
                    "success" => 1,
                    "message" => "Les informations sont modifiées avec succès"
                );
            }else{
                return array(
                    "success" => 2,
                    "message" => "Erreur d'insertion de ce responsable, veuillez réessayer plus tard"
                );
            } 
        }else{
            return array(
                "success" => 0,
                "message" => "Ce numéro de téléphone est déjà utilisé."
            );
        }
            
    } 

	public function get(){
	 	$query = $this->db->get_where($this->table, array('idCentre'=>$this->session->id)); 
        return $query->result();
	} 

    public function getDefaultNiveau($access){ 

        foreach (unserialize($access) as $key => $value) {
            switch ($key) {
                case 'prescolaire':
                    return 0;
                    break; 

                case 'primaire':
                    return 1;
                    break; 

                case 'college':
                    return 2;
                    break; 

                case 'lycee':
                    return 3;
                    break; 
            }
        }
    }  

	public function connecte(){
        extract($_POST);

        $query = $this->db->get_where($this->table, array('tel'=>$email,'pwd'=>sha1($pwd) )); 
        $num_rows = $query->num_rows(); 
        if( $num_rows > 0 ){
            $subAdmin = $query->result()[0];

            $query = $this->db->get_where('centre', array('id'=>$subAdmin->idCentre)); 
            $result = $query->result()[0];

            $userAccess = unserialize($subAdmin->access);


            $dataSession = array(
                    'usertype'  => 'admin',
                    'id'  => $result->id ,
                    'code'=> $result->code,
                    'nom' => $result->nom,
                    'photo' => $result->photo,
                    'allowProfToSendMsg' => $result->allowProfToSendMsg,
                    'allowParentToSendMsg' => $result->allowParentToSendMsg,
                    'niveau' => $this->getDefaultNiveau($subAdmin->access),
                    'logged_in' => true,
                    'subAdmin' => true,
                    'access' => unserialize($subAdmin->access)
            ); 
            $this->session->set_userdata($dataSession);
            return true;
        }else{
            return false;
        }
    }
}
?>