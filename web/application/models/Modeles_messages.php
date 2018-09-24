<?php  
class Modeles_messages extends CI_Model {

        private $table = "modeles_messages"; 
        public $type; 
        public $align; 
        public $title; 
        public $content; 

        public  function insert()
        { 
            $this->type    = $_POST['type']; 
            $this->align    = $_POST['align']; 
            $this->title    = $_POST['title']; 
            $this->content    = $_POST['content']; 
            $this->db->insert($this->table, $this);  
            return  $this->db->insert_id();
                
        }
        public function get( $type )
        { 
            $this->db->select('*');
            $this->db->from($this->table);  
            $this->db->where( array("type"=>$type));  
            $this->db->order_by('id','DESC');

            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } 
        public function getAll()
        { 
            $this->db->select('*');
            $this->db->from($this->table);   
            $this->db->order_by('id','DESC');

            $query = $this->db->get();
            $result = $query->result();
            return $result;
        } 
        public function update($id)
        { 
            // $this->intitule    = $_POST['intitule'];
            // if( $this->db->update($this->table, $this, array('id' => $id)) ){
            //     return true;
            // }else{
            //     return false;
            // }
        }
        public function delete($id)
        { 
            $this->db->where('id', $id);
            return $this->db->delete($this->table);
        } 
} ?>