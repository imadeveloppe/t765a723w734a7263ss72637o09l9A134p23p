<?php  
class Probleme extends CI_Model {

        private $table = "probleme";   

        public function insert($from,$idFrom = '')
        {
            if( empty($idFrom) ){
                $idFrom = $this->session->id;
            }
            $file = '';
            if( isset($_FILES['file']) ):
                $content_dir = base_url().'assets/upload/';  
                $tmp_file = $_FILES['file']['tmp_name']; 

                $config['upload_path'] ='assets/upload/'; 
                $config['allowed_types'] = 'gif|jpg|png';
                $this->load->library('upload', $config);
                
                if(!empty($_FILES['file']['name'])){
                    if($this->upload->do_upload('file')){ 
                            $file = $this->upload->data('file_name');  
                    }else{
                        echo $this->upload->display_errors();
                        $file = '';
                    }  
                }
            endif;

            $array = array(
                            'from' => $from, 
                            'idFrom' => $idFrom, 
                            'content' => $_POST['content'], 
                            'file' => $file, 
                            'time' => time() 
                          );
            if( $this->db->insert($this->table, $array) ){
                return true;
            }else{
                return false;
            }
        }
        public function get()
        {
            
            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->order_by('time','DESC');
            $query = $this->db->get();
            return $query->result();
        }
        public function delete($id)
        { 
            $this->db->where('idProbleme', $id);
            return $this->db->delete($this->table);
        }

        public function nbrProblemes()
        {
            $query = $this->db->get_where($this->table,array('state'=>0));
            return count( $query->result() );
        }
        public function isFixed($idProbleme){

            $this->db->select('state');
            $this->db->from($this->table);
            $this->db->where(array('idProbleme'=>$idProbleme));
            $query = $this->db->get(); 
            $result =  $query->result();

            if( $result[0]->state ) return true;
            else return false;
        }
        public function editState($idProbleme){
            if( $this->isFixed($idProbleme) ){
                $state = 0;
            }else{
                $state = 1;
            }
            
            $this->db->update(
                    $this->table, 
                    array('state' => $state), 
                    array('idProbleme' => $idProbleme)
            );

            return ($state == 1) ? 'true' : 'false' ;
        }

} ?>