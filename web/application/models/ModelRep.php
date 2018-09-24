<?php  
class ModelRep extends CI_Model {

        private $table = "representant";   

        public function login()
        {
            extract($_POST);

            $query = $this->db->get_where($this->table, 
                                          array(
                                                'tel' => $login, 
                                                'pwd' => sha1($pwd),
                                                'deleted' => 0 
                                                )
                                          );
            if( $query->num_rows() > 0 ){
                $result = $query->result();
                if( $result[0]->state == 1 ){
                    $data['state'] = "true";
                    $data['idRep'] = $result[0]->id;

                    if( isset($token) ){
                        $this->db->update(
                        $this->table, 
                        array('token' => $token), 
                        array('id' => $data['idRep']) );
                    }

                }else{
                    $data['state'] = "blocked";
                    $data['message'] = "Votre Compte est désactivé, merci de contacter l'administrateur";
                }
            }else{
                $data['state'] = "error";
                $data['message'] = "Numéro de téléphone/mot de passe sont incorects";
            }


            return $data;
        }
        public function GetInfoRep($idRep)
        {
            $this->db->select('nom, tel, state, code');
            $this->db->from($this->table);
            $this->db->where(array('id'=>$idRep));
            $query = $this->db->get();
            $result = $query->result();
            return $result[0];
        }
        public function get()
        {   
            $this->db->select('R.nom, R.ville, R.tel, R.id, R.code, V.intitule');
            $this->db->from($this->table.' as R');
            $this->db->join('villes as V','V.id = R.ville');
            $this->db->where( array('R.deleted' => 0 ) );
            $query = $this->db->get(); 
            $result = $query->result();
            return $result;
        }
        public function getAll()
        {   
            
            $query = $this->db->get_where( $this->table, array('deleted' => 0 )); 
            $result = $query->result();
            return $result;
        }
        public function changePwd($idRep) 
        {
            extract($_POST); 
            $query = $this->db->get_where($this->table, array('id' => $idRep,'pwd' => sha1($pwd))); 
            $num_rows = $query->num_rows();    
            if( $num_rows > 0 ){ 
                $array = array(
                    'pwd'=> sha1($Newpwd)
                );
                $this->db->update($this->table, $array, array('id' => $idRep));
                return true;
            }else{
                return false;
            }
        }
        public function generateUniqueCode() {
           $existe = true;
           while ( $existe) {
                $token = substr(md5(uniqid(rand(), true)),0,6);  // creates a 6 digit token
                $query = $this->db->get_where($this->table, array('code'=>$token)); 
                if ( !$query->num_rows() ) {
                  $existe = false;
                }
           } 

           return $token;
        }
        public  function insert()
        {  
            extract($_POST);
                $array = array(
                                'code' => '', 
                                'nom' => $nom, 
                                'ville' => $ville, 
                                'tel' => $tel, 
                                'pwd' => sha1($pwd),
                                'state' => 1
                              ); 

                $this->db->insert($this->table, $array);
                $id = $this->db->insert_id();

                $newCode = $this->generateUniqueCode();
                $this->db->update(
                    $this->table, 
                    array('code' => $newCode), 
                    array('id' => $id)
                ); 
                $data['id'] = $id;
                $data['code'] = $newCode;
            return $data;   
        }
        public function update($id)
        { 
            extract($_POST);
            $array = array( 
                'nom' => $nom, 
                'ville' => $ville, 
                'tel' => $tel
            ); 
            if( !empty( $pwd )  ){
                $array['pwd'] = sha1( $pwd );
            }
            if( $this->db->update($this->table, $array, array('id' => $id))  ){
                return true;
            }else{
                return false;
            }
        }

        public function delete($id)
        { 
            $this->db->where('id', $id);
            return $this->db->delete($this->table);

            if( $this->db->update(
                    $this->table, 
                    array('deleted' => 0, 'state' => 0), 
                    array('id' => $id) ) 
            ) return true;
                else return false;
        }
        
        public function isValide($idRep)
        { 
            $result = $this->GetInfoRep($idRep);
            return ($result->state == 1) ? true : false;
        }  


} ?>