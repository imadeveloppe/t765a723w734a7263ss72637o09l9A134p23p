<?php  
class Villes extends CI_Model {

        private $table = "villes"; 
        public $intitule; 

        public  function insert()
        {
            $query = $this->db->get_where($this->table,array('intitule'=>trim($_POST['intitule'])));
            $result = $query->result();
            if( count($result) == 0 ){
                $this->intitule    = $_POST['intitule']; 
                $this->db->insert($this->table, $this);  
                return  $this->db->insert_id();
            }else{
                return 0;
            } 
                
        }
        public function get()
        { 
            $this->db->select('*');
            $this->db->from($this->table);  
            $this->db->order_by('intitule','ASC');

            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } 
        public function update($id)
        { 
            $this->intitule    = $_POST['intitule'];
            if( $this->db->update($this->table, $this, array('id' => $id)) ){
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
} ?>