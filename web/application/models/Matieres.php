<?php  
class Matieres extends CI_Model {

        private $table = "matieres"; 
        public $intitule; 
        public $niveau; 

        public  function insert()
        {
             $query = $this->db->get_where($this->table,array('intitule'=>trim($_POST['intitule']),'niveau'=>trim($_POST['niveau']) ));
            $result = $query->result();
            if( count($result) == 0 ){

                $this->intitule    = $_POST['intitule'];
                $this->niveau    = $_POST['niveau'];
                $this->db->insert($this->table, $this); 

                return  $this->db->insert_id();
            }else{
                return 0;
            }  

        }
        public function get($niveau=999999)
        {

            if($niveau == 999999) $niveau = $this->session->niveau;
            $query = $this->db->get_where($this->table,array('niveau'=>$niveau)); 
            $result = $query->result(); 
            return $result;
        } 
        public function update($id)
        {  
            $array = array('intitule' =>$_POST['intitule'] );
            if( $this->db->update($this->table, $array, array('id' => $id)) ){
                return true;
            }else{
                return false;
            }
        }
        public function delete($id)
        { 
            $this->db->where('id', $id);
            return $this->db->delete($this->table);
        }
        public function GetCustomMatieres($idMatieres)
        { 

            $this->db->select('intitule');
            $this->db->from($this->table);
            $this->db->where_in('id',$idMatieres); 
            

            $query = $this->db->get(); 
            return $query->result(); 
        }
} ?>