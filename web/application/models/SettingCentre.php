<?php  
class SettingCentre extends CI_Model {

        private $table = "settingcentre";  

        public  function insert($idCentre)
        { 
            foreach ($_POST['niveau'] as $key => $niveau):

                $this->db->insert(
                                $this->table, 
                                array(
                                        'idCentre' => $idCentre, 
                                        'appellationClasses'=>1,
                                        'appellationGroupe'=>1,
                                        'classes'=>'1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1',
                                        'niveau'=>$niveau
                                    )
                                ); 
            endforeach;
                
        } 
        
        public  function getMatieres()
        { 
            if( $this->session->logged_in_prof ){
                $idCentre = $this->session->idCentre;
            }else{
                $idCentre = $this->session->id;
            }
            $niveau = $this->session->niveau;
            $query = $this->db->get_where(
                                            $this->table, 
                                            array('idCentre' => $idCentre,'niveau' => $niveau)
                                         );
            $result = $query->result();

            if( $result[0]->matieres ) return explode(',', $result[0]->matieres);
            return array();
        }
        public  function getMatieresByCode($code, $niveau=1)
        {   
            $this->load->model('Prof_');
            $idCentre = $this->Prof_->getIdCentreByCode($code);
            $query = $this->db->get_where(
                                            $this->table, 
                                            array('idCentre' => $idCentre,'niveau' => $niveau)
                                         );
            $result = $query->result();

            if( $result[0]->matieres ) return explode(',', $result[0]->matieres);
            return array();
        }
        public  function getAppellationClasses()
        {   
            if( $this->session->logged_in_prof or $this->session->logged_in_parant ){
                $idCentre = $this->session->idCentre;
            }else{
                $idCentre = $this->session->id;
            }
            
            $niveau = $this->session->niveau;
            $query = $this->db->get_where(
                                            $this->table, 
                                            array('idCentre' => $idCentre,'niveau' => $niveau)
                                         );
            $result = $query->result(); 

            return $result[0]->appellationClasses;
        }
        public  function getAppellationGroupe()
        { 
            if( $this->session->logged_in_prof or $this->session->logged_in_parant ){
                $idCentre = $this->session->idCentre;
            }else{
                $idCentre = $this->session->id;
            }
            $niveau = $this->session->niveau;
            $query = $this->db->get_where(
                                            $this->table, 
                                            array('idCentre' => $idCentre,'niveau' => $niveau)
                                         );
            $result = $query->result();

            return $result[0]->appellationGroupe;
        }
        public  function nbrClassesByNiveau()
        { 
            if( $this->session->logged_in_prof ){
                $idCentre = $this->session->idCentre;
            }else{
                $idCentre = $this->session->id;
            }
            $niveau = $this->session->niveau;
            $query = $this->db->get_where(
                                            $this->table, 
                                            array('idCentre' => $idCentre,'niveau' => $niveau)
                                         );
            $result = $query->result();
            $classes = explode(',', $result[0]->classes);
            
            return $classes;
        }
        public function updateMatiere($matieres)
        {  
            if( 
                $this->db->update(
                    $this->table, 
                    array('matieres' => $matieres), 
                    array('idCentre' => $this->session->id,'niveau' => $this->session->niveau)
                ) 
            ){ 
                return true;
            }else{
                return false;
            }
        }
        public function updateClasse()
        {
            extract($_POST);
            $appellation = (isset($appellation)) ? $appellation : 1;
            if( 
                $this->db->update(
                    $this->table, 
                    array(
                          'appellationClasses' => $appellationClasses,
                          'appellationGroupe' => $appellationGroupe,
                           'classes' => implode(',', $classes)
                          ), 
                    array(
                        'idCentre' => $this->session->id,
                        'niveau' => $this->session->niveau
                        )
                ) 
            ){
                return true;
            }else{

                $this->db->insert(
                                $this->table, 
                    array(
                            'idCentre' => $this->session->id, 
                            'appellationClasses'=>1,
                            'appellationGroupe'=>1,
                            'classes'=>'1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1',
                            'niveau'=>$this->session->niveau
                        )
                ); 
                $this->updateClasse();
            }
        }

        public function GetProfsByMatiere()
        { 
            $ProfsByMatiere = array();
            foreach ($this->getMatieres() as  $idMatiere):

                if( $this->session->logged_in_prof ){
                    $idCentre = $this->session->idCentre;
                }else{
                    $idCentre = $this->session->id;
                }
                $niveau = $this->session->niveau;
                $query = $this->db->get_where(
                                                'prof', 
                                                array('idCentre' => $idCentre,'niveau' => $niveau, 'deleted' => 0)
                                             );
                foreach ($query->result() as $result) {
                    $matieresProf = (strpos($result->matieres, ',') !== false) ? explode(',', $result->matieres) : array($result->matieres);
                    if( in_array($idMatiere, $matieresProf) ){
                        $ProfsByMatiere[$idMatiere][] = array('idProf'=>$result->idProf,'nom'=>$result->nom);
                    }
                }

            endforeach;

            return $ProfsByMatiere;
        }
        public function GetClientByClass()
        { 
            $ClientByClass = array(); 

            if( $this->session->logged_in_prof ){
                $idCentre = $this->session->idCentre;
            }else{
                $idCentre = $this->session->id;
            }
            $niveau = $this->session->niveau;

            $query = $this->db->get_where(
                                            'client', 
                                            array('idCentre' => $idCentre,'niveau' => $niveau, 'deleted' => 0)
                                         );
            foreach ($query->result() as $result) {
                $ClientByClass[$result->classe.$result->groupe][] = array(
                                                                        'idClient'=>$result->idClient,
                                                                        'nom'=>$result->nom,
                                                                        'registred'=> ( !empty($result->token) ) ? true : false ,
                                                                        );
            }
 
            return $ClientByClass;
        }
        public function GetOptionsCentre($idCentre, $niveau)
        {
            $query = $this->db->get_where(
                                            $this->table, 
                                            array('idCentre' => $idCentre,'niveau' => $niveau)
                                         );
            $result = $query->result();

            return $result[0];
        }
} ?>