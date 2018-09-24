<?php  
class Prof_ extends CI_Model {

        private $table = "prof";  
        private $setting = "settingcentre";
        private $valideCompte = "Votre compte est validé par l'administration";
        private $notValideCompte = "Votre compte est suspendu par l'administration";
        private $autoSentMessage = "l'auto envoi des messages est activé sur votre compte";
        private $NotautoSentMessage = "l'auto envoi des messages est désactivé sur votre compte";

        public  function insert()
        {
            extract($_POST);
                $profClasses = array();
                foreach ($classe as $key => $value) {
                   $profClasses[] = $value.':'.$groupe[$key];
                } 
                $profClasses = array_unique($profClasses);
                $array = array(
                                    'idCentre' => $this->getIdCentreByCode($code), 
                                    'nom' => $prenom.' '.$nom, 
                                    'matieres' => $matieres, 
                                    'classe' => implode(',', $profClasses), 
                                    'niveau' => $niveau, 
                                    'state' => 0, 
                                    'email' => $email, 
                                    'pwd' => sha1($pwd),
                                    'time' => time(),
                                    'deleted' => 0
                                );

                $this->db->insert($this->table, $array);
                $idProf = $this->db->insert_id();
                
                $query = $this->db->get_where($this->table, array('idProf'=>$idProf));
                $result = $query->result();
                $dataSession = array(
                        'id'  => $result[0]->idProf , 
                        'usertype'  => 'prof',
                        'idCentre'  => $result[0]->idCentre , 
                        'nom' => $result[0]->nom,
                        'photo' => $result[0]->photo,
                        'niveau' => $result[0]->niveau,
                        'logged_in_prof' => true
                ); 

                $this->session->set_userdata($dataSession);
            return ( $idProf > 0 ) ? true : false;
        }
        public function verifCode($code)
        {   
            extract($_POST);
            if(isset($appname)){
                $where = array('code'=>$code, 'appname'=>$appname);
            }else{
                $where = array('code'=>$code);
            }
            $query = $this->db->get_where('centre', $where); 
            return $query->num_rows();
        }
        public function verifEmail()
        {
            $query = $this->db->get_where($this->table, array('email'=> $_POST['email'], 'deleted'=> 0)); 
            if( $query->num_rows() ){
                return false;
            }else{
                return true;
            }
        }
        public function get()
        {
            $idCentre = $this->session->id;
            $niveau = $this->session->niveau;

            $this->db->select('P.idProf, P.nom, P.classe, P.email, P.matieres, P.fidele, P.state, S.appellationClasses, S.appellationGroupe, S.classes');
            $this->db->from($this->table.' as P');
            $this->db->join( 'settingcentre as S', 'P.idCentre = S.idCentre');
            $this->db->where( array('P.idCentre' => $idCentre,'P.niveau' => $niveau,'S.idCentre' => $idCentre,'S.niveau' => $niveau, 'P.deleted' => 0 ) );
            $this->db->order_by('idProf','DESC');

            $query = $this->db->get(); 
            return $query->result();
        }
        public function connecte()
        {
            extract($_POST);
            $query = $this->db->get_where($this->table, array('email'=>$email,'pwd'=>sha1($pwd), 'deleted'=> 0)); 
            $num_rows = $query->num_rows(); 
            if( $num_rows > 0 ){
                $result = $query->result(); 

                $dataSession = array(
                        'usertype'  => 'prof',
                        'id'  => $result[0]->idProf , 
                        'idCentre'  => $result[0]->idCentre , 
                        'nom' => $result[0]->nom,
                        'photo' => $result[0]->photo,
                        'niveau' => $result[0]->niveau,
                        'logged_in_prof' => true
                ); 
                $this->session->set_userdata($dataSession);

                if( isset($token) ){
                    $this->db->update(
                    $this->table, 
                    array('token' => $token), 
                    array('idProf' => $result[0]->idProf));
                }
                

                return true;
            }else{
                return false;
            }
        }
        public function getMatiere($idProf)
        {
            $niveau = $this->session->niveau;
            $query = $this->db->get_where($this->table,array('idProf'=>$idProf,'niveau'=>$niveau));
            $result = $query->result();

            return $result[0]->matieres;
        }
        public function getMatiereProf()
        {
            $idProf = $this->session->id;
            $query = $this->db->get_where($this->table,array('idProf'=>$idProf));
            $result = $query->result();
            $matieresProf = explode(',', $result[0]->matieres);

            $this->db->select('id,intitule');
            $this->db->from('matieres');
            $this->db->where_in('id', $matieresProf);
            $query = $this->db->get(); 
            return $query->result(); 
        }
        public function delete($idProf){

            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->where(array('idProf'=>$idProf));
            $query = $this->db->get(); 
            $prof =  $query->result()[0];
            $arrayOfTokens = array();
            if( !empty($prof->token) ){
                $arrayOfTokens[] = $prof->token;
                $this->load->model("Messages"); 
                $message = "Votre compte est supprimé par l'administration";
                $this->Messages->push($arrayOfTokens, "prof", $message);
            }
            if(
                $this->db->update(
                        $this->table, 
                        array('state' => 0, 'deleted' => 1), 
                        array('idProf' => $idProf))
            )   return true;
            else return false; 
        }
        public function valide($idProf){

            $this->db->select('state');
            $this->db->from($this->table);
            $this->db->where(array('idProf'=>$idProf));
            $query = $this->db->get(); 
            $result =  $query->result();

            if( $result[0]->state ) return true;
            else return false;
        }
        public function fidele($idProf){

            $this->db->select('fidele');
            $this->db->from($this->table);
            $this->db->where(array('idProf'=>$idProf));
            $query = $this->db->get(); 
            $result =  $query->result();

            if( $result[0]->fidele ) return true;
            else return false;
        }
        public function editState($idProf){
            if( $this->valide($idProf) ){
                $state = 0;
                $message = $this->notValideCompte;
            }else{
                $state = 1;
                $message = $this->valideCompte; 
            }
            
            $this->db->update(
                    $this->table, 
                    array('state' => $state), 
                    array('idProf' => $idProf)
            );
            $query = $this->db->get_where($this->table, array('idProf'=>$idProf)); 
            $prof = $query->result()[0];
            $arrayOfTokens = array();
            if( !empty($prof->token) ){
                $arrayOfTokens[] = $prof->token;
                $this->load->model("Messages");
                $this->Messages->push($arrayOfTokens, "prof", $message);
            }

            return ($state == 1) ? 'true' : 'false' ;
        }
        public function editFidelite($idProf){
            if( $this->fidele($idProf) ){
                $state = 0;
                $message = $this->NotautoSentMessage;
            }else{
                $state = 1;
                $message = $this->autoSentMessage; 
            }
            
            $this->db->update(
                    $this->table, 
                    array('fidele' => $state), 
                    array('idProf' => $idProf)
            );
            $query = $this->db->get_where($this->table, array('idProf'=>$idProf)); 
            $prof = $query->result()[0];
            $arrayOfTokens = array();
            if( !empty($prof->token) ){
                $arrayOfTokens[] = $prof->token;
                $this->load->model("Messages");
                $this->Messages->push($arrayOfTokens, "prof", $message);
            }

            return ($state == 1) ? 'true' : 'false' ;
        }
        public function updateMatiere($dataMatieres)
        {
               
            if(
                   $this->db->update(
                            $this->table, 
                            $dataMatieres, 
                            array('idProf' => $dataMatieres['idProf'])
                    )
            ){
                return true;
            }else{
                return false;
            }
        }
        public function updateClassesProf($dataClasses)
        {
            
            if(
                   $this->db->update(
                            $this->table, 
                            $dataClasses, 
                            array('idProf' => $dataClasses['idProf'])
                    )
            ){
                return true;
            }else{
                return false;
            }
        }
        public function updatePwdProf($dataPwd)
        {
            $dataPwd['pwd'] = sha1($dataPwd['pwd']);
            if(
                   $this->db->update(
                            $this->table, 
                            $dataPwd, 
                            array('idProf' => $dataPwd['idProf'])
                    )
            ){
                return true;
            }else{
                return false;
            }
        }
        public function select()
        {
            $query = $this->db->get_where($this->table, array('idProf'=>$this->session->id)); 
            $result = $query->result();
            return $result[0];
        }
        public function GetCustomProfs($idProfs, $select='nom')
        { 

            $this->db->select($select);
            $this->db->from($this->table);
            $this->db->where_in('idProf',$idProfs); 
            

            $query = $this->db->get(); 
            return $query->result(); 
        }
        public function GetCustomProf($idProf, $select='nom')
        { 

            $this->db->select($select);
            $this->db->from($this->table);
            $this->db->where('idProf',$idProf); 
            

            $query = $this->db->get(); 
            return $query->result(); 
        }
        public function verified()
        {
            $query = $this->db->get_where($this->table, array('idProf'=>$this->session->id)); 
            $result = $query->result(); 
            return $result[0]->state;
        }
        public function changePwd()
        {
            extract($_POST); 
            $query = $this->db->get_where($this->table, array('idProf' => $this->session->id,'pwd' => sha1($oldPassword))); 
            $num_rows = $query->num_rows();    
            if( $num_rows > 0 ){ 
                $array = array(
                    'pwd'=> sha1($NewPassword)
                );
                $this->db->update($this->table, $array, array('idProf' => $this->session->id));
                return true;
            }else{
                return false;
            }
        }

        public function update()
        {
            extract($_POST); 
            $array = array(
                'nom'=> $nom,
                'email'=> $email,
                'tel'=> $tel,
                'about'=> $about
            );  
            if( isset($_FILES['photo']) && !empty($_FILES['photo']['name'])){
                $content_dir = base_url().'assets/upload/'; 
                $tmp_file = $_FILES['photo']['tmp_name']; 

                $config['upload_path'] ='assets/upload/'; 
                $config['allowed_types'] = 'gif|jpg|jpeg|png';
                $this->load->library('upload', $config);
                
                if($this->upload->do_upload('photo')){
                        $this->removeOldImage();
                        $array['photo'] = $this->upload->data('file_name'); 
                        $this->session->photo = $array['photo'];
                }else{
                    echo $this->upload->display_errors();
                }  
            }
            $this->db->update($this->table, $array, array('idProf' => $this->session->id));
            $this->session->nom = $nom;
            
        } 
        public function getIdCentreByCode($code)
        {
            $query = $this->db->get_where('centre', array('code'=>$code));
            $result =  $query->result();
            return $result[0]->id;
        }
        public function removeOldImage()
        {
            $query = $this->db->get_where($this->table, array('idProf'=>$this->session->id)); 
            $result = $query->result(); 
            if( trim($result[0]->photo) != '' ):
                $file = 'assets/upload/'.$result[0]->photo; 
                if( file_exists($file) ){
                    unlink($file);
                }
            endif;
        }
        public function getPhoto($idProf)
        {
            $this->db->select('photo');
            $this->db->from($this->table);
            $this->db->where(array('idProf' => $idProf));
            $query = $this->db->get(); 
            $result = $query->result();
            if( empty( $result[0]->photo ) ){
                return '';
            }else{
                return base_url().'assets/upload/'.$result[0]->photo; 
            }
            
        }

        public function getIdCentre($idProf = null)
        {   
            $id = ( $idProf ) ? $idProf : $this->session->id;
            $query = $this->db->get_where($this->table, array('idProf'=> $id)); 
            $result = $query->result(); 
            return $result[0]->idCentre;
        }

        public function nbrProfNotVerified($idCentre, $niveau)
        {
            $query = $this->db->get_where($this->table,array(
                                                'idCentre'=>$idCentre,
                                                'state'=> 0,
                                                'deleted'=> 0,
                                                'niveau'=>$niveau
                                            )); 
            return count( $query->result() );
        }
        public function AjaxNbrProfsNotValidate($idCentre)
        { 
             
            $nbrProfs = array();
            for ($i=0; $i < 4 ; $i++) { 
                $query = $this->db->get_where($this->table,array(
                                                'idCentre'=>$idCentre,
                                                'state'=> 0,
                                                'deleted'=> 0,
                                                'niveau'=>$i
                                            ));

                $nbrProfs[ $i ] = count( $query->result() );
            } 
            return $nbrProfs; 

        }
        public function selectProf($idProf)
        {
            $query = $this->db->select('P.nom, P.email as tel, V.intitule as ville, C.nom as ecole'); 
            $query = $this->db->from($this->table.' as P'); 
            $query = $this->db->join('centre as C', 'P.idCentre = C.id'); 
            $query = $this->db->join('villes as V', 'C.ville = V.id'); 
            $query = $this->db->where(array('P.idProf'=>$idProf));
            $query = $this->db->get();
            $result = $query->result();
            return $result[0];
        }
        public function valideAllProf( $state )
        {   
            $idCentre = $this->session->id;
            $niveau = $this->session->niveau;

            $this->db->update(
            $this->table, 
                array('state' => $state),
                array('idCentre' => $idCentre, 'niveau' => $niveau)
            );

            $this->db->select('token');
            $this->db->from($this->table); 
            $this->db->where( array('idCentre' => $idCentre,'niveau' => $niveau) ); 

            $query = $this->db->get();  
            $this->load->model('Messages');
            $arrayOfTokens = array();
            foreach ($query->result() as $key => $prof) {
                if( !empty($prof->token) ){
                     $arrayOfTokens[] = $prof->token;
                }
            } 
            $message = ($state == 1) ? $this->valideCompte : $this->notValideCompte;
            if( count($arrayOfTokens) > 0 ){
                $this->Messages->push($arrayOfTokens, "prof", $message);
            }
        }

        public function DeleteAllProfsInCentre($idCentre)
        {   
            // $query = $this->db->get_where($this->table, array('idCentre'=>$idCentre,'state'=>1, 'deleted'=>0)); 
            // $result = $query->result();

            // $arrayOfTokens = array();
            // foreach ($result as $key => $prof) {
            //     if( !empty($prof->token) ){
            //         $arrayOfTokens[] = $prof->token;
            //     }
            // }
            // $this->load->model('Messages');
            // $message = "Votre Etablissement a été suspendu par l'equipe TawassolApp";
            // $this->Messages->push($arrayOfTokens, 'prof', strip_tags( $message ));

            $this->db->update(
                        $this->table, 
                        array('deleted' => 1), 
                        array('idCentre' => $idCentre) );
            
        }
        public function ActiveAllProfsInCentre($idCentre)
        {   
            // $query = $this->db->get_where($this->table, array('idCentre'=>$idCentre,'state'=>1, 'deleted'=>1)); 
            // $result = $query->result();

            // $arrayOfTokens = array();
            // foreach ($result as $key => $prof) {
            //     if( !empty($prof->token) ){
            //         $arrayOfTokens[] = $prof->token;
            //     }
            // }
            // $this->load->model('Messages');
            // $message = "Votre Etablissement viens d'être activé par l'equipe TawassolApp";
            // $this->Messages->push($arrayOfTokens, 'prof', strip_tags( $message ));
            
            $this->db->update(
                        $this->table, 
                        array('deleted' => 0), 
                        array('idCentre' => $idCentre));
        }
        public function getProfsByMatiere($idMatiere)
        {
            $niveau = $this->session->niveau;
            $idCentre = $this->session->id;
            $query = $this->db->get_where($this->table,array('idCentre'=>$idCentre,'niveau'=>$niveau));

            $profs = array();
            foreach ($query->result() as $key => $prof) {
                $arrayMatieres = (strpos($prof->matieres, ',') !== false) ? explode(',',$prof->matieres) : array($prof->matieres);
                if(in_array($idMatiere, $arrayMatieres)){
                    $profs[] = array(
                        "idProf" => $prof->idProf,
                        "name" => $prof->nom
                    );
                }
            }

            return $profs;
        }






















} ?>