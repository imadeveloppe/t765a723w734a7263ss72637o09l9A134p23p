<?php  
class Centre extends CI_Model {

        private $table = "centre";

        public $id_rep;
        public $code;
        public $niveau;
        public $nom; 
        public $ville; 
        public $state = 0;
        public $tel;
        public $adress;
        public $email;
        public $pwd;
        public $time; 
        public $appname ="com.ionicframework.app538533"; 
        public $deleted = 0; 

        public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        } 
        public function getIdRepByCode($code)
        {
            $query = $this->db->get_where('representant', array('code'=>$code));
            $result =  $query->result();
            return $result[0]->id;
        } 
        public function verifCode($code)
        {
        	$query = $this->db->get_where('representant', array('code'=>$code, 'deleted'=>0)); 
        	return $query->num_rows();
        }
        public function verifTel()
        {
            $query = $this->db->get_where($this->table, array('email'=>$_POST['email'], 'deleted'=>0 )); 
            if( $query->num_rows() ){
                return false;
            }else{
                return true;
            }
        }

        public function verifEmail()
        {
            $query = $this->db->get_where($this->table, array('tel'=>$_POST['tel'], 'deleted'=>0 )); 
            if( $query->num_rows() ){
                return false;
            }else{
                return true;
            }
        }

        public function generateUniqueCode( $lentgh = 6 ) {
           $existe = true;
           while ( $existe) {
           		$token = substr(md5(uniqid(rand(), true)),0,$lentgh);  // creates a 6 digit token
			   	$query = $this->db->get_where($this->table, array('code'=>$token)); 
			   	if ( !$query->num_rows() ) {
			      $existe = false;
			   	}
           } 

		   return $token;
		}
		public function verified()
		{
			$query = $this->db->get_where($this->table, array('id'=>$this->session->id)); 
        	$result = $query->result(); 
        	return $result[0]->state;
		}
		public function connecte()
		{
			extract($_POST);
			$query = $this->db->get_where($this->table, array('email'=>$email,'pwd'=>sha1($pwd),'deleted'=>0 )); 
        	$num_rows = $query->num_rows(); 
        	if( $num_rows > 0 ){
        		$result = $query->result();
        		$dataSession = array(
				        'id'  => $result[0]->id ,
				        'code'=> $result[0]->code,
                        'nom' => $result[0]->nom,
				        'photo' => $result[0]->photo,
                        'niveau' => 1,
				        'logged_in' => true
				); 
				$this->session->set_userdata($dataSession);
        		return true;
        	}else{
        		return false;
        	}
		}
        public function GetPwdForgeted()
        {
            extract($_POST); 
            $query = $this->db->get_where($this->table, array('tel'=>$email, 'deleted' => 0 ));  
            $num_rows = $query->num_rows(); 

            if( $num_rows > 0 ){
                $result = $query->result(); 
                ////////////////////////////////////////// 
                $newPwd = $this->generateUniqueCode(8);
                $this->resetPwd($email,$newPwd); 

                $headers = 'From: TawassolApp<contact@tawassolapp.com>' . "\r\n" .
                    'Content-type: text/html; charset=utf-8' . "\r\n".
                    'Reply-To: contact@tawassolapp.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

                $to      = $email;
                $subject = 'Récupération de mot de passe';
                $message = 'Vous avez oublié votre mot de passe.<br> Voici vos nouveaux paramètres de compte: <br><br>
                Téléphone : <b>'.$result[0]->email.'</b><br>
                Mot de passe : <b>'.$newPwd.'</b><br><br><em><b>Remarque :</b> Merci de changer votre mot de passe après la connexion.</em>';
                 
                if( mail($to, $subject, $message, $headers) ) return true;
                else return false;
    
                //////////////////////////////////////////
                return true;
            }else{
                return false;
            }
        }
        public function resetPwd($email, $newPwd)
        {
           $this->db->update(
                    $this->table, 
                    array('pwd' => sha1($newPwd)), 
                    array('tel' => $email)
                );
        }
        public  function insert()
        {
                $this->id_rep    = $this->getIdRepByCode($_POST['code']);  
                $this->code    = ""; 
                $this->niveau    = implode(':', $_POST['niveau']);
                $this->nom  = $_POST['nom'];
                $this->tel  = $_POST['tel'];
                $this->adress  = $_POST['adress'];
                $this->email  = $_POST['email'];
                $this->ville  = $_POST['ville'];
                $this->pwd  = sha1($_POST['pwd']);
                $this->time     = time(); 

                $this->db->insert($this->table, $this);
                $id = $this->db->insert_id();

                $newCode = $this->generateUniqueCode();
                $this->db->update(
                	$this->table, 
                	array('code' => $newCode), 
                	array('id' => $id)
                );

                $dataSession = array(
				        'id'  => $id,
				        'code'=> $newCode,
                        'nom' => $this->nom,
                        'photo' => "",
				        'niveau' => 1,
				        'logged_in' => true
				);

				$this->session->set_userdata($dataSession);

                $query = $this->db->select('token'); 
                $query = $this->db->from('representant'); 
                $query = $this->db->where(array('id' => $this->id_rep));
                $query = $this->db->get();
                $rep = $query->result()[0];


                if( !empty( $rep->token ) ){ 
                    $arrayOfTokens = array($rep->token);
                    $this->load->model("Messages");
                    $this->Messages->push($arrayOfTokens, 'rep', $this->nom);
                }

                

        }
        public function select()
        {
        	$query = $this->db->select('C.nom, C.email, C.tel, C.about,C.niveau, V.intitule as ville'); 
            $query = $this->db->from($this->table.' as C'); 
            $query = $this->db->join('villes as V', 'C.ville = V.id'); 
            $query = $this->db->where(array('C.id'=>$this->session->id));
            $query = $this->db->get();
        	$result = $query->result();
        	return $result[0];
        }
        public function selectCenter($idCentre)
        {
            $query = $this->db->select('C.nom, C.email as tel, V.intitule as ville'); 
            $query = $this->db->from($this->table.' as C'); 
            $query = $this->db->join('villes as V', 'C.ville = V.id'); 
            $query = $this->db->where(array('C.id'=>$idCentre));
            $query = $this->db->get();
            $result = $query->result();
            return $result[0];
        }
        public function removeOldImage()
        {
        	$query = $this->db->get_where($this->table, array('id'=>$this->session->id)); 
        	$result = $query->result(); 
        	if( trim($result[0]->photo) != '' ):
                $file = 'assets/upload/'.$result[0]->photo; 
            	$fileResize = 'assets/upload/logos/'.$result[0]->photo; 
            	if( file_exists($file) ){
            		unlink($file);
            	}
                if( file_exists($fileResize) ){
                    unlink($fileResize);
                }
            endif;
        }
        public function update()
        {
        	extract($_POST);
            $array = array(
                'nom'=> $nom,
                'email'=> $email, 
                'tel'=> $tel,
                'niveau'=> implode(':', $niveau_),
                'about'=> $about
            );  

            foreach ($niveau_ as $key => $N) {
                
                $query = $this->db->get_where("settingcentre", array('idCentre'=>$this->session->id, 'niveau'=>$N ));
                if( count($query->result()) == 0 ){
                    $this->db->insert(
                                    'settingcentre', 
                        array(
                                'idCentre' => $this->session->id, 
                                'appellationClasses'=>1,
                                'appellationGroupe'=>1,
                                'classes'=>'1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1',
                                'niveau'=>$N
                            )
                    );
                }
                  
            }

            //////////////////////////////////////////////////////////////////
        	$content_dir = base_url().'assets/upload/'; 
        	$tmp_file = $_FILES['photo']['tmp_name']; 

    		$config['upload_path'] ='assets/upload/'; 
    		$config['allowed_types'] = 'gif|jpg|jpeg|png';
			$this->load->library('upload', $config);
			if(!empty($_FILES['photo']['name'])){
				if($this->upload->do_upload('photo')){
						$this->removeOldImage();

						$array['photo'] = $this->upload->data('file_name'); 
                        $this->session->photo = $array['photo'];

                        $file = $this->upload->data('file_name');  
                        $this->load->library('image_lib'); 

                        $config2['image_library'] = 'gd2';
                        $config2['source_image'] = $config['upload_path'].$file;
                        $config2['new_image'] = $config['upload_path'].'logos/';
                        $config2['maintain_ratio'] = TRUE;
                        $config2['create_thumb'] = TRUE;
                        $config2['thumb_marker'] = '';
                        $config2['quality'] = '100%';
                        $config2['width'] = 100;
                        $config2['height'] = 100;
                        $config2['overwrite'] = false;

                        $this->image_lib->initialize($config2);
                        if ( !$this->image_lib->resize()){
                            $this->session->set_flashdata('errors', $this->image_lib->display_errors('', ''));  
                        } 


				}else{
					echo $this->upload->display_errors();
				}  
			}
            //////////////////////////////////////////////////////////////////

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
        public function getPhoto($idCentre)
        {
            $this->db->select('photo');
            $this->db->from($this->table);
            $this->db->where(array('id' => $idCentre));
            $query = $this->db->get(); 
            $result = $query->result(); 

            return $result[0]->photo;
        }
        public function GetLogoCentre( $idCentre = null )
        {
           $query = $this->db->get_where($this->table, array('id'=> ($idCentre) ? $idCentre : $this->session->id ));
           $result = $query->result(); 
           return $result[0]->photo;
        }
        public function GetAppNameCentre()
        {
           $query = $this->db->get_where($this->table, array('id'=>$this->session->id));
           $result = $query->result(); 
           return $result[0]->appname;
        }
        public function GetCenters($idRep)
        { 
            $this->db->select('C.id, C.nom, C.email, C.photo, C.state, V.intitule');
            $this->db->from($this->table.' as C');
            $this->db->join('villes as V', 'V.id = C.ville');
            $this->db->where(array('C.id_rep'=>$idRep, 'C.deleted'=>0));
            $this->db->order_by('C.id','DESC');
            $query = $this->db->get();

            if(  $query->num_rows() > 0  ){
                $result = $query->result();
                $data = array();
                $this->load->model('Client');
                foreach ($result as $key => $value) {
                   $data[$key]['id'] = $value->id;
                   $data[$key]['nom'] = $value->nom;
                   $data[$key]['ville'] = $value->intitule;
                   $data[$key]['logo'] = $value->photo;
                   $data[$key]['tel'] = $value->email;
                   $data[$key]['state'] = $value->state; 
                   $data[$key]['nbrClient'] = $this->Client->nbrClientInCenter($value->id);
                }
            }else{
                $data = '';
            }

            return $data;
        }
        public function valide($idCentre){

            $this->db->select('state');
            $this->db->from($this->table);
            $this->db->where(array('id'=>$idCentre));
            $query = $this->db->get(); 
            $result =  $query->result();

            if( $result[0]->state ) return true;
            else return false;
        }
        public function updateState($idCentre){
            if( $this->valide($idCentre) ){
                $state = 0;
            }else{
                $state = 1;
            }
            
            $this->db->update(
                    $this->table, 
                    array('state' => $state), 
                    array('id' => $idCentre)
            ); 
            return ($state == 1) ? 'true' : 'false' ;
        } 
        public function ajaxNbrCenter($idRep)
        {
            $this->db->select(' count(id) as count ');
            $this->db->from($this->table);
            $this->db->where(array('id_rep'=>$idRep, 'deleted' => 0));
            $query = $this->db->get();
            $result = $query->result();
            return $result[0]->count;
        }
        public function nbrCenter()
        {
            $this->db->select(' count(id) as count ');
            $this->db->from($this->table);
            $this->db->where(array('state'=>1, 'deleted'=>0 ));
            $query = $this->db->get();
            $result = $query->result();
            return $result[0]->count;
        }
        public function nbrClientByRep($idRep)
        {
            $this->db->select(' count(id) as count ');
            $this->db->from($this->table);
            $this->db->where(array('id_rep'=>$idRep,'state'=>1, 'deleted'=>0));
            $query = $this->db->get();
            $result = $query->result();
            return $result[0]->count;
        }
        public function centresByVille($idRep)
        { 
            $this->load->model('Client');
            $data = array(); 
               $query = $this->db->get_where($this->table, array('id_rep'=>$idRep, 'deleted'=>0 ));
               $result = $query->result();
               if( !empty( $result ) ){
                    foreach ($result as $key => $centre) {
                        $data[$centre->ville][$key]['idCentre'] = $centre->id;
                        $data[$centre->ville][$key]['state'] = $centre->state;
                        $data[$centre->ville][$key]['nom'] = $centre->nom;
                        $data[$centre->ville][$key]['tel'] = $centre->email;
                        $data[$centre->ville][$key]['nbrClient'] = $this->Client->nbrClientInCenter($centre->id);
                    }
               } 

            return $data;
        }
        public function getEcolesByVille()
        {

            $this->db->select('C.id, C.nom, C.email, C.id_rep as idRep, C.ville, C.tel, R.nom as nomRep');
            $this->db->from($this->table.' as C');
            $this->db->join('representant as R', 'R.id = C.id_rep');
            $this->db->where(array('C.state'=>1 )); 
            $query = $this->db->get();
            $result = $query->result();
            foreach ($result as $key => $centre) {
                $data[$centre->ville][$key]['id'] = $centre->id;
                $data[$centre->ville][$key]['nom'] = $centre->nom;
                $data[$centre->ville][$key]['tel'] = $centre->email; 
                $data[$centre->ville][$key]['idRep'] = $centre->idRep; 
                $data[$centre->ville][$key]['nomRep'] = $centre->nomRep; 
                $data[$centre->ville][$key]['ville'] = $centre->ville; 
            }

            return $data;
        }
        public function updateEcoleRep()
        {
            extract($_POST);
            if(
                $this->db->update(
                    $this->table, 
                    array('id_rep' => $idRep), 
                    array('id' => $id)
                )
            ) echo "true";
            else echo "false";
        }
        public function GetNiveau($idCentre)
        {
            $query = $this->db->get_where($this->table, array('id'=>$idCentre));
            $result = $query->result();

            if( strlen($result[0]->niveau) > 1 ){
                return explode(":", $result[0]->niveau);
            }else{
                return array($result[0]->niveau);
            }
            
        }
        public function getNiveauByCode($code)
        {
            $query = $this->db->get_where($this->table, array('code'=>$code));
            $result = $query->result();
            $stringNiveau = array(0=>'Préscolaire', 1=>'Primaire', 2=>'Collège', 3=>'Lycée');
            if( strlen($result[0]->niveau) > 1 ){
                $niveaux =  explode(":", $result[0]->niveau);
                $tab = array();
                foreach ($niveaux as $key => $value) {
                   $tab[$value] = $stringNiveau[$value];
                }
                return $tab;
            }else{
                return array($result[0]->niveau => $stringNiveau[$result[0]->niveau]);
            }
        }
        public function getNomEcole($idCentre)
        {
            $this->db->select('nom');
            $this->db->from($this->table);
            $this->db->where(array('id' => $idCentre));
            $query = $this->db->get(); 
            $result = $query->result(); 
            return $result[0]->nom;
        }

        public function deleteCenter($idCentre)
        {
            $this->db->update(
                        $this->table, 
                        array('deleted' => 1), 
                        array('id' => $idCentre));
        }
        public function ActiveCenter($idCentre)
        {
            $this->db->update(
                        $this->table, 
                        array('deleted' => 0), 
                        array('id' => $idCentre));
        }
        function NotifRepWhenCentreIsDeleted( $idCentre ){
            $query = $this->db->select('R.token, C.nom'); 
            $query = $this->db->from($this->table.' as C'); 
            $query = $this->db->join('representant as R', 'C.id_rep = R.id'); 
            $query = $this->db->where(array('C.id'=>$idCentre));
            $query = $this->db->get();
            $result = $query->result();

            $arrayOfTokens = array();
            $arrayOfTokens[] = $result[0]->token;
            $nomEtablissement = $result[0]->nom;

            $this->load->model('Messages');
            $message = "Etablissement ".$nomEtablissement." supprimé par l'equipe TawassolApp";
            $this->Messages->push($arrayOfTokens, 'rep', strip_tags( $message ));
        }

        function NotifRepWhenCentreIsActivated( $idCentre ){
            $query = $this->db->select('R.token, C.nom'); 
            $query = $this->db->from($this->table.' as C'); 
            $query = $this->db->join('representant as R', 'C.id_rep = R.id'); 
            $query = $this->db->where(array('C.id'=>$idCentre));
            $query = $this->db->get();
            $result = $query->result();

            $arrayOfTokens = array();
            $arrayOfTokens[] = $result[0]->token;
            $nomEtablissement = $result[0]->nom;
            
            $this->load->model('Messages');
            $message = "Etablissement ".$nomEtablissement." restauré par l'equipe TawassolApp";
            $this->Messages->push($arrayOfTokens, 'rep', strip_tags( $message ));
        }


}
?>