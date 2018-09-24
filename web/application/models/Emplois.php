<?php  
class Emplois extends CI_Model {

        private $table = "emplois"; 
        public $intitule; 

        public  function insert()
        {
            $array = array(
                "idCentre" => $this->session->id,
                "niveau" => $this->session->niveau,
                "type" => $_POST['type']
            );

            switch ($_POST['type']) {
                case 'classe':
                    $array['value'] = $_POST['classe']."/".$_POST['groupe'];
                    break; 
                case 'prof':
                    $array['value'] = $_POST['idprof'];
                    break; 
            } 
            ////////////////////////////////////////////////////////////////// 
            $content_dir = base_url().'assets/upload/emplois/'; 
            $tmp_file = $_FILES['file']['tmp_name']; 

            $config = array(
                'upload_path' => 'assets/upload/emplois/',
                'allowed_types' => 'gif|jpg|jpeg|png|pdf'
            ); 

            $this->load->library('upload', $config);
            $this->upload->initialize($config); 
            

            if(!empty($_FILES['file']['name'])){ 

                $_FILES['file']['name'] = time().preg_replace("/[^a-zA-Z0-9.]/", "", $_FILES['file']['name']);
                
                if($this->upload->do_upload('file')){ 

                    $array['file'] = $config['upload_path'].$this->upload->data('file_name');   
                     
                    if( pathinfo(strtolower($this->upload->data('file_name')), PATHINFO_EXTENSION) =='pdf' ){

                        
                        require 'application/libraries/pdf-to-image/src/Pdf.php';



                        $pdf = new Spatie\PdfToImage\Pdf( $config['upload_path'].$this->upload->data('file_name') );
 

                        $pdf->saveImage($config['upload_path'].str_replace('.pdf', '.png', $this->upload->data('file_name')));
 
                        $array['file'] = str_replace('pdf', 'png', $array['file']);

                    } 

                    $query = $this->db->get_where( $this->table ,array(
                        "idCentre" => $this->session->id,
                        "niveau" => $this->session->niveau,
                        "type" => $array['type'],
                        "value" => $array['value']
                    )); 

                    $existeRow = $query->result();

                    if( !$query->result() ){
                        $this->db->insert($this->table, $array);
                    }else{
                        $this->db->update(
                        $this->table, 
                        $array, 
                        array('id' => $existeRow[0]->id) );
                    }
 
                    

                    return true;
                        
                }
            }
            //////////////////////////////////////////////////////////////////
   
        }
        public function get( $type )
        { 
            $this->db->select('*');
            $this->db->from($this->table);  
            $this->db->where('type', $type);   
            $this->db->where('idCentre', $this->session->id);   
            $this->db->where('niveau', $this->session->niveau);   
            $query = $this->db->get();
            $result = $query->result(); 
            return $result;
        }  

        public function getEmploiProf($idProf)
        {  
            $this->db->select('file');
            $this->db->from($this->table);  
            $this->db->where('type', 'prof');  
            $this->db->where('value', $idProf);  
            $query = $this->db->get();
            $result = $query->result();  
            return (count($result) > 0) ? base_url().$result[0]->file : false;
        } 

        public function getEmploiClasse( $args = false )
        {   
            if( !$args ){
                $args = array(
                    "classe"    => $_POST["classe"],
                    "groupe"    => $_POST["groupe"],
                    "idCentre"  => $_POST["idCentre"]
                );
            }

            $this->db->select('file');
            $this->db->from($this->table);  
            $this->db->where('type', 'classe');   
            $this->db->where(array(
                "value" => $args['classe'].'/'.$args['groupe'],
                "idCentre" => $args['idCentre']
            ));  
            $query = $this->db->get();
            $result = $query->result();  
            return (count($result) > 0) ? base_url().$result[0]->file : false;
        } 

        public function delete($id)
        { 
            $this->db->where('id', $id);
            return $this->db->delete($this->table);
        } 
} ?>