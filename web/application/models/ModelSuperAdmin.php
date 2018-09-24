<?php  
class ModelSuperAdmin extends CI_Model {

        private $table = "superadmin";   

        public function login()
        {
            extract($_POST);

            $query = $this->db->get_where($this->table, 
                                          array(
                                                'tel' => $tel, 
                                                'pwd' => sha1($pwd) 
                                                )
                                          );
            
            if( $query->num_rows() > 0 ){
                $result = $query->result();
                $data['state'] = "true";  
                $dataSession = array(
                        'id'  => $result[0]->id , 
                        'nom'  => $result[0]->nom,
                        'logged_in_SuperAdmin'=>true
                ); 
                $this->session->set_userdata($dataSession);

                return true;
            }else{
                $data['state'] = "error";
                $data['message'] = "Numéro de téléphone/mot de passe sont incorects";
                return false;
            }

            return $data;
        }  
        public function select()
        {
            $query = $this->db->get_where($this->table, array('id'=>$this->session->id)); 
            $result = $query->result();
            return $result[0];
        }
        public function update()
        {
            extract($_POST); 

            $array = array(
                'nom'=> $nom, 
                'tel'=> $tel
            ); 

            $this->db->update($this->table, $array, array('id' => $this->session->id));
            $this->session->nom = $nom;
            
        } 
        public function changePwd()
        {
            extract($_POST); 
            $query = $this->db->get_where($this->table, array('id' => $this->session->id,'pwd' => sha1($oldPassword))); 
            $num_rows = $query->num_rows();    
            if( $num_rows > 0 ){ 
                $array = array(
                    'pwd'=> sha1($NewPassword)
                );
                $this->db->update($this->table, $array, array('id' => $this->session->id));
                return true;
            }else{
                return false;
            }
        }


} ?>