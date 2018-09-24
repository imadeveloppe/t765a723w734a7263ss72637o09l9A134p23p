<?php  
class Client extends CI_Model {

        private $table = "client";    

        public function getMessageValideCompte( $client )
        {
           if( $this->valide($client->idClient) ){ 
                $message = "Le compte de ".$client->fname." ".$client->lname." est validé par l'administration";
            }else{  
                $message = "Le compte de ".$client->fname." ".$client->lname." est suspendu par l'administration";
            }

            return $message;
        }

        public function generatePassword( $lentgh = 6 ) { 

           return substr(md5(uniqid(rand(), true)),0,$lentgh);  // creates a 6 digit token;
        }

        public function importXls()
        {   
            //$file_data = $this->upload->data();

            $config = array(
                "upload_path" => APPPATH .'models/',
                "allowed_types" => 'xlsx'
            ); 
            
            //load the upload library
            $this->load->library('upload', $config); 
            $this->upload->initialize($config); 

            $upload_data = array();
            $hasError = false; 

            //if not successful, set the error message
            if (!$this->upload->do_upload('file')) {
                $upload_data = array('msg' => strip_tags($this->upload->display_errors()));
                $hasError = true; 
            }else { //else, set the success message 
                $upload_data = $this->upload->data(); 
            }
 

            if( !$hasError ){
                $inputFileName = APPPATH .'models/'. $upload_data['file_name'];
                require_once dirname(__FILE__) . '/../libraries/PHPExcel/PHPExcel.php';

                $excelReader = PHPExcel_IOFactory::createReaderForFile($inputFileName);
                $excelObj = $excelReader->load($inputFileName);
                $worksheet = $excelObj->getSheet(0); 
                 
                // **************************************
                    $this->load->model('Centre'); 

                    $niveau = $this->session->niveau;
                    $classe = $_POST['classe'];
                    $groupe = $_POST['groupe']; 
                    $appname = $this->Centre->GetAppNameCentre(); 
                // **************************************
 
                $data = array();    
                $inseredRows = 0;
                $nbrRowsInFile = 0;
                for ($i = 12; $i <= 100; $i++) {
                    //$worksheet->getCell('F'.$i)->getValue()
                    if( !empty( $worksheet->getCell('C'.$i)->getValue() ) ){ 

                        $inseredRow = $this->InsertEleveIfNotExiste(array(
                                        'idCentre' =>       $this->session->id,
                                        'code' =>           $worksheet->getCell('C'.$i)->getValue(),
                                        'password' =>           $this->generatePassword(),
                                        'nom' =>            $worksheet->getCell('F'.$i)->getValue()." ".$worksheet->getCell('D'.$i)->getValue(),
                                        'fname' =>          $worksheet->getCell('F'.$i)->getValue(),
                                        'lname' =>          $worksheet->getCell('D'.$i)->getValue(),
                                        'niveau' =>         $niveau,
                                        'classe' =>         $classe,
                                        'groupe' =>         $groupe,
                                        'appname' =>        $appname,
                                        'time' =>           time(),
                                        'state' =>          0,
                                        'nbrInscription' => 0
                                    ));
                        if( $inseredRow  ){
                            $inseredRows++;
                        }
                        
                        $nbrRowsInFile++;
                    }
                }   

                if( file_exists( $inputFileName ) ){
                    unlink( $inputFileName );
                }

                if( $nbrRowsInFile > 0 ){
                    return array(
                        "success" => true,
                        "inseredRows" => $inseredRows
                    );
                }else{
                    return array(
                        "success" => false,
                        "msg" => "Ce fichier est vide ou il est protégé en lecture. Ouvrez-le avec Microsoft Excel et activer la modification."
                    );
                }

                
            }else{
                return array(
                    "success" => false,
                    "msg" => $upload_data['msg']
                );
            }
               
             
        }
        public function InsertEleveIfNotExiste($client)
        { 

            $this->db->select(" * ");
            $this->db->from($this->table); 
            $this->db->where( array( 
                                'code' =>       $client['code'],  
                                'deleted' =>    0
                                ) 
                            );  
            $query = $this->db->get(); 
            $result =  $query->result();

            if( count($result) == 0 ){

                $this->db->insert($this->table, $client);
                
            }else{
                if( empty($result[0]->password) ){
                    $this->db->update(
                        $this->table, 
                        array(
                            "classe"    => $client['classe'],
                            "groupe"    => $client['groupe'],
                            "niveau"    => $client['niveau'], 
                            "password"  => $client['password'] 
                        ), 
                        array( 
                            'code' =>       $client['code'],  
                            'deleted' =>    0
                        ) 
                    );
                }else{
                    $this->db->update(
                        $this->table, 
                        array(
                            "classe"    => $client['classe'],
                            "groupe"    => $client['groupe'],
                            "niveau"    => $client['niveau']
                        ), 
                        array( 
                            'code' =>       $client['code'],  
                            'deleted' =>    0
                        ) 
                    );
                }
                    
            }

            return true;
        }
        public function login()
        {
            extract($_POST);
            // $this->db->get_where($this->table, array('adresseMac' => $adresseMac, 'deleted' => 0 )); 

            $this->db->select("Cl.*");
            $this->db->from($this->table." as Cl");
            $this->db->join( 'centre as Ce', 'Cl.idCentre = Ce.id'); 
            $this->db->like('Cl.adresseMac', $adresseMac);  
            $this->db->where(array('Cl.deleted'=>0,  'Ce.appname'=>$appname));

            $query = $this->db->get();
            $result = $query->result();

            if( $query->num_rows() > 0 ){
                
                $array = array();
                foreach ($result as $key => $client) {

                    $array = array(
                        'id' => $client->idClient,
                        'idCentre' => $client->idCentre,
                        'niveau' => $client->niveau,
                        'logged_in_parant'=> true
                    );
                    $this->session->set_userdata($array);

                    $tabclasse = $this->intituleClasse();
                    $tabgroupe = $this->intituleGroupe();

                    $result[$key]->ClassGroupe = $tabclasse[$client->classe - 1].' - G'.$tabgroupe[$client->groupe - 1];

                } 

                $index = array_search( $appname, $array);

                

                $data['login'] = "true";
                $data['students'] = $result; 

                $this->db->update(
                    $this->table, 
                    array('token' => $token), 
                    array('adresseMac' => $adresseMac) );
                
                
            }else{
                $data['login'] = "false";
            }

            return $data;
        }
        public function loginAtEleveFromWebApp()
        {
            extract($_POST);
            $this->db->select("*");
            $this->db->from($this->table); 
            $this->db->like( $_POST ); 
            $this->db->where(array('deleted' => 0));
            $query = $this->db->get();
            $result = $query->result();

            if( $query->num_rows() > 0 ){
                $dataSession = array(
                        'usertype'  => 'client',
                        'idClient'  => $result[0]->idClient,
                        'logged_in' => true
                );
                $this->session->set_userdata($dataSession);
                echo 1;
            }else{
                echo 0;
            }
        }
        public function existClients( $idClient )
        {   
            // $query = $this->db->get_where($this->table, array('adresseMac' => $adresseMac,'deleted' => 0 ));
            $this->db->select("Cl.idCentre, Cl.niveau, Cl.time");
            $this->db->from($this->table." as Cl");
            $this->db->join( 'centre as Ce', 'Cl.idCentre = Ce.id');  
            $this->db->where(array('Cl.idClient' => $idClient, 'Ce.deleted' => 0, 'Cl.deleted' => 0, 'Cl.nomParent !=' => ''));
            $query = $this->db->get();  
            
            if( $query->num_rows() > 0 ){
                return true;
            }else{
                return false;
            }
        }
        public function verifCode($code)
        {
            extract($_POST); 

            $this->db->select("Cl.*");
            $this->db->from($this->table." as Cl");
            $this->db->join( 'centre as Ce', 'Cl.idCentre = Ce.id');  
            $this->db->where(array( 'Cl.code'=>$code,  'Cl.deleted'=>0,  'Ce.appname'=>$appname));

            

            $query = $this->db->get();  

            $student = $query->result()[0];

            $array = array(
                'id' => $student->idClient,
                'idCentre' => $student->idCentre,
                'niveau' => $student->niveau,
                'logged_in_parant'=> true
            );
            $this->session->set_userdata($array);

            $tab1 = $this->intituleClasse();
            $tab2 = $this->intituleGroupe();
            $tab3 = array("Préscolaire","Primaire","Collège","Lycée");

            $student->classe = $tab1[$student->classe - 1];
            $student->groupe = "G".$tab2[$student->groupe - 1];
            $student->niveau = $tab3[$student->niveau];

            $this->load->model('Centre');
            $student->nomEcole   = $this->Centre->getNomEcole($student->idCentre);
            $student->photoEcole = base_url()."assets/upload/logos/".$this->Centre->getPhoto($student->idCentre);

            return array(
                "num_rows" => $query->num_rows(),
                "info" => $student
            );
        }
        public function insertClient()
        { 

                extract($_POST);  

                $query = $this->db->get_where($this->table, array('idClient'=>$idClient)); 
                $result = $query->result(); 

                if( count($result) > 0 and $result[0]->nbrInscription == 0 ){  

                    $this->db->update(
                        $this->table, 
                        array(
                                "nomParent" => $nomParent,  
                                "telParent" => $telParent, 
                                'nbrInscription' => 1,
                                'time' => time(),
                                'adresseMac' => $adresseMac,  
                                'token' => $token,
                                'pub' => $pub,
                                'appname'  => $appname
                        ), 
                        array('idClient' => $result[0]->idClient)
                    );
                    
                    $query = $this->db->get_where($this->table, array('idClient'=>$idClient));
                    $result = $query->result();
                    $array = array(
                                    'id' => $result[0]->idClient,
                                    'idCentre' => $result[0]->idCentre,
                                    'niveau' => $result[0]->niveau,
                                    'logged_in_parant'=> true
                                  );
                    $this->session->set_userdata($array);

                    return array(
                        "success" => 1,
                        "message" => "Merci pour votre inscription à TawassolApp."
                    );
                }
                elseif( count($result) > 0 and $result[0]->nbrInscription == 1 ){
                    if( $result[0]->nomParent == $nomParent ){

                        return array(
                            "success" => 0,
                            "message" => $nomParent." a déjà inscrit cet élève"
                        );

                    }else if( $result[0]->telParent == $telParent ){

                        return array(
                            "success" => 0,
                            "message" => "Ce numero de téléphone est déjà utilisé pour cet élève"
                        );
                        
                    }else{ 

                        if(
                            $this->db->update(
                                $this->table, 
                                array(
                                        "nomParent" => $result[0]->nomParent."/".$nomParent,  
                                        "telParent" => $result[0]->telParent."/".$telParent, 
                                        'nbrInscription' => 2,
                                        'adresseMac' => $result[0]->adresseMac."/".$adresseMac,  
                                        'token' => $result[0]->token."/".$token
                                ), 
                                array('idClient' => $result[0]->idClient)
                            )
                        ){
                            $this->load->model('Messages');
                            $content = '<div dir="ltr"><br>Votre établissement vous informe que '.$result[0]->fname.' '.$result[0]->lname.' est désormais suivi par deux tuteurs:<br><br> - '.$result[0]->nomParent.' ('.$result[0]->telParent.') <br>
                                - '.$nomParent.' ('.$telParent.') <br><br>
                                Merci de nous contacter en cas d&apos;opposition.</div><br><br><br>';
                                
                            // $content .= '<div dir="rtl">تخبركم إدارة المؤسسة أنه تم تسجيل '.$nomParent.' رقم هاتفه '.$telParent.' وليا ثانيا للتلميذ '.$result[0]->fname.' '.$result[0]->lname.' .<br>رجاء الإتصال بالمؤسسة في حالة اعتراض.</div>';
                            
                            $this->Messages->autoSendMessageToParent( $result[0]->idCentre, $result[0]->niveau, $result[0]->idClient, $content);
                        }

                        return array(
                            "success" => 1,
                            "message" => "Merci pour votre inscription à TawassolApp."
                        );
                    }
                        
                }
                else{
                    return array(
                        "success" => 0,
                        "message" => $result[0]->fname." ".$result[0]->lname." est déjà inscrit(e) dans cet établissement"
                    );
                }
                    
        }

        public function get()
        {
            $idCentre = $this->session->id;
            $niveau = $this->session->niveau;

            $this->db->select('C.idClient, C.nom,C.fname,C.lname, C.code, C.password, C.telParent, C.classe, C.groupe, C.nomParent,C.photo, C.statePhoto, C.maladie, C.remarque, C.state, S.appellationClasses, S.appellationGroupe, S.classes');
            $this->db->from($this->table.' as C');
            $this->db->join( 'settingcentre as S', 'C.idCentre = S.idCentre');


            if( isset($_POST['classe']) && isset($_POST['groupe'])  ){ 
                $this->db->where( array('C.idCentre' => $idCentre,
                                        'C.niveau' => $niveau,
                                        'C.classe' => $_POST['classe'],
                                        'C.groupe' => $_POST['groupe'],
                                        'S.idCentre' => $idCentre,
                                        'S.niveau' => $niveau, 
                                        'C.deleted' => 0 
                                    ) );
                $this->db->order_by('classe','INC');
                $this->db->order_by('groupe','INC');
            }else{
                $this->db->where( array('C.idCentre' => $idCentre,'C.niveau' => $niveau,'S.idCentre' => $idCentre,'S.niveau' => $niveau, 'C.deleted' => 0 ) );
                $this->db->order_by('state','INC');
                $this->db->order_by('nbrInscription','DESC');
            } 
            
            // $this->db->order_by('idClient','INC');
            

            $query = $this->db->get(); 
            return $query->result();
        }
        public function delete($idClient){

            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->where(array('idClient'=>$idClient));
            $query = $this->db->get(); 
            $client =  $query->result()[0];
            $arrayOfTokens = array();
            if( !empty($client->token) ){
                $arrayOfTokens[] = $client->token;
                $this->load->model("Messages"); 
                $message = "Le compte de ".$client->fname." ".$client->lname." est supprimé par l'administration";
                $this->Messages->push($arrayOfTokens, "parent", $message);
            } 

            if(
                $this->db->update(
                        $this->table, 
                        array('state' => 0, 'deleted' => 1), 
                        array('idClient' => $idClient))
            )   return true;
            else return false;  
        }
        public function valide($idClient){

            $this->db->select('state');
            $this->db->from($this->table);
            $this->db->where(array('idClient'=>$idClient));
            $query = $this->db->get(); 
            $result =  $query->result();

            if( $result[0]->state ) return true;
            else return false;
        }
        public function ValidatePhoto($idClient){

            $this->db->select('statePhoto');
            $this->db->from($this->table);
            $this->db->where(array('idClient'=>$idClient));
            $query = $this->db->get(); 
            $result =  $query->result();

            if( $result[0]->statePhoto ) return true;
            else return false;
        }
        public function editState($idClient){
            if( $this->valide($idClient) ){
                $state = 0; 
            }else{
                $state = 1; 
            }
            
            $this->db->update(
                    $this->table, 
                    array('state' => $state), 
                    array('idClient' => $idClient)
            );

            $query = $this->db->get_where($this->table, array('idClient'=>$idClient)); 
            $client = $query->result()[0];
            $arrayOfTokens = array();
            if( !empty($client->token) ){
                $arrayOfTokens[] = $client->token;
                $this->load->model("Messages"); 

                $this->Messages->push($arrayOfTokens, "parent", $this->getMessageValideCompte($client) );
            }

            return ($state == 1) ? 'true' : 'false' ;
        }
        public function editStatePhoto($idClient){
            if( $this->ValidatePhoto($idClient) ){
                $statePhoto = 0; 
            }else{
                $statePhoto = 1; 
            }
            
            $this->db->update(
                    $this->table, 
                    array('statePhoto' => $statePhoto), 
                    array('idClient' => $idClient)
            ); 

            return ($statePhoto == 1) ? 'true' : 'false' ;
        }
        public function updateClient($clientData)
        {
            if( strpos( $clientData['photo'], "data:image/" )  !== false){

                $this->removeOldImage( $clientData['idClient'] );

                $filePath = "assets/upload/eleves/".time().$this->session->id.".jpg";
                $this->load->model('Messages');
                $this->Messages->base64_to_jpeg($clientData['photo'], $filePath);

                $this->load->library('image_lib'); 

                $config['image_library'] = 'gd2';
                $config['source_image'] = $filePath;
                $config['new_image'] = "assets/upload/eleves/";
                $config['maintain_ratio'] = TRUE;
                $config['create_thumb'] = TRUE;
                $config['thumb_marker'] = '';
                $config['quality'] = '100%';
                $config['width'] = 300;
                $config['height'] = 300;
                $config['overwrite'] = true;
                $this->image_lib->initialize($config);
                if ( !$this->image_lib->resize()):
                    $this->session->set_flashdata('errors', $this->image_lib->display_errors('', ''));  
                endif;

                $clientData['photo'] = base_url().$filePath;
                $clientData['statePhoto'] = 1;
            }
            $clientData['nom'] = $clientData['fname']." ".$clientData['lname'];
            if(
                   $this->db->update(
                            $this->table, 
                            $clientData, 
                            array('idClient' => $clientData['idClient'])
                    )
            ){
                return $clientData['photo'];
            }else{
                return false;
            }
        }
        public function GetCustomClient($idClients, $select='idClient, nom')
        { 

            $this->db->select($select);
            $this->db->from($this->table);
            $this->db->where_in('idClient',$idClients); 
            

            $query = $this->db->get(); 
            return ($query->result()) ? $query->result() : 'false' ; 
        }
        public function GetAllClientInCentre()
        {
            $idCentre = $this->session->idCentre;
            $niveau = $this->session->niveau;

            $this->db->select('idClient, fname, lname, nom, token, classe, groupe');
            $this->db->from($this->table);
            $this->db->where(array(
                                    'idCentre' => $idCentre,
                                    'niveau' => $niveau,
                                    'deleted' => 0
                                  )); 
            $this->db->order_by( 'idClient ASC'); 
            

            $query = $this->db->get(); 
            $result = $query->result();
            $data['classes'] = array();
            if( $result ):
                foreach ($result as $key => $value) {
                    $data['classes'][$key] = $result[$key]->classe =  $value->classe.$value->groupe;
                     
                    unset($result[$key]->groupe);
                }
            endif;
            $data['eleve'] = $result; 
            return $data; 
        }
        
        public function saveInfoParent($idClient)
        {
            extract($_POST);
            $array = array(
                                'nomParent' => $nomParent,
                                'email' => $email,
                                'tel' => $tel
                              );
            if( $this->db->update($this->table, $array,array('idClient' => $idClient)) ){
                return true;
            }else{
                return false;
            }
        }

        public function intituleNiveau($niveau=99,$index=0)
        {
            $tab = array(); 

            /////////////Prescolaire///////////////
            $tab[0][1] = array('Crèche', 'TPS', 'PS', 'MS', 'GS'); 
            $tab[0][2] = array('Crèche', 'PS1', 'PS', 'MS', 'GS');

            ///////////// Primaire///////////////
            $tab[1][1] = array('1AP', '2AP', '3AP', '4AP', '5AP', '6AP');
            $tab[1][2] = array('CE1', 'CE2', 'CE3', 'CE4', 'CE5', 'CE6'); 
            $tab[1][3] = array('CP', 'CE1', 'CE2', 'CM1', 'CM2', '6ème' ); 

            ///////////// College ///////////////
            $tab[2][1] = array('1AC', "2AC", "3AC", "");
            $tab[2][2] = array('7AF', '8AF', '9AF', ''); 
            $tab[2][3] = array('6ème', '5ème', '4ème', '3ème'); 

            ///////////// lycee ///////////////
            $tab[3][1] = array(
                            'TCL', 
                            'TCS', 

                            '1BAC SE',
                            '1BAC SM',
                            '1BAC SEG', 

                            '2BAC SP',  
                            '2BAC SVT',  
                            '2BAC SMA',  
                            '2BAC SMB',  
                            '2BAC SE',  
                            '2BAC TGC'
                        );

            if( $niveau==99 ) return $tab[$this->session->niveau];
            else return $tab[$niveau][$index];
        }

        public function intituleClasse()
        {
            $this->load->model('SettingCentre');

            $intituleNiveau = $this->intituleNiveau();
            return $intituleNiveau[$this->SettingCentre->getAppellationClasses()];
        }
        public function intituleGroupe($index=0)
        {
            $tab = array();  

            ///////////// numerique ///////////////
            for ($i=1; $i <= 26 ; $i++) { 
                $tab[1][] = $i;
            }

            ///////////// alphabetique ///////////////
            $tab[2] = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');

            $this->load->model('SettingCentre');
            if($index == 0) return $tab[$this->SettingCentre->getAppellationGroupe()];
            else return $tab[$index];
        }
        public function getInfosClient($idClient)
        {
            
            $query = $this->db->get_where($this->table, array('idClient' => $idClient ));
            $result = $query->result();
            if( $result ):
                $data['nom'] = $result[0]->nom;
                $data['email'] = $result[0]->email;
                $data['tel'] = $result[0]->telParent;
                $data['nomParent'] = $result[0]->nomParent; 
                $tab = $this->intituleClasse();
                $data['classe'] = $tab[$result[0]->classe - 1]; 
                $tab = $this->intituleGroupe();
                $data['groupe'] = 'G'.$tab[$result[0]->groupe - 1]; 
            return $data;
            else:
                return false;
            endif;
        }
        public function getClient($idClient)
        {
            
            $query = $this->db->get_where($this->table, array('idClient' => $idClient ));
            return  $query->result()[0];
        }

        public function issetClientInArray($fname, $lname, $clients){
            $count = 0;
            foreach ($clients as $key => $client) {
                if( strtolower($fname) == strtolower($client->lname) &&   strtolower($lname) == strtolower($client->fname)){
                    $count++;
                }
            }
            return ( $count > 0 ) ? true : false;
        }   
        public function nbrClientPhysic( $clients )
        { 
            // $count = 0;
            // foreach ($clients as $key => $client) {
            //     if( $this->issetClientInArray($client->fname, $client->lname, $clients) ){
            //         unset($clients[$key]);
            //         $count++;
            //     }
            // }
            return 0;
        }

        public function nbrClientInCenter($idCentre)
        {
            $nbrClients = array();

            // ********************************************* 
             $this->db->select(" C.idClient "); 
            $this->db->from( $this->table.' as C' );
            $this->db->join('centre', 'centre.id = C.idCentre ');
            $this->db->where( array('C.idCentre'=>$idCentre, 'C.deleted'=>0, 'centre.state' => 1, 'centre.deleted' => 0) ); 
            $query = $this->db->get();
            $result = $query->result(); 
            $nbrClients['imported'] = count($result);
            // ********************************************* 

            // ********************************************* 
             $this->db->select(" C.idClient "); 
            $this->db->from( $this->table.' as C' );
            $this->db->join('centre', 'centre.id = C.idCentre ');
            $this->db->where( array('C.idCentre'=>$idCentre,'C.nomParent !='=>'', 'C.deleted'=>0, 'centre.state' => 1, 'centre.deleted' => 0) ); 
            $query = $this->db->get();
            $result = $query->result(); 
            $nbrClients['regitred'] = count($result);
            // ********************************************* 


            // ********************************************* 
             $this->db->select(" C.idClient "); 
            $this->db->from( $this->table.' as C' );
            $this->db->join('centre', 'centre.id = C.idCentre ');
            $this->db->where( array('C.idCentre'=>$idCentre,'C.state'=>1,'C.nomParent !='=>'', 'C.deleted'=>0, 'centre.state' => 1, 'centre.deleted' => 0) ); 
            $query = $this->db->get();
            $result = $query->result(); 
            $nbrClients['validated'] = count($result);
            // ********************************************* 

            return $nbrClients;
        }
        public function nbrClient()
        {
            $nbrClients = array();

            // *********************************************
            $this->db->select(" C.idClient "); 
            $this->db->from( $this->table.' as C' );
            $this->db->join('centre', 'centre.id = C.idCentre ');
            $this->db->where(array('C.deleted'=>0, 'centre.state' => 1, 'centre.deleted' => 0));  
            $query = $this->db->get();
            $result = $query->result(); 
            $nbrClients['imported'] = count($result);
            // *********************************************
 

            // // *********************************************
             $this->db->select(" C.idClient "); 
            $this->db->from( $this->table.' as C' );
            $this->db->join('centre', 'centre.id = C.idCentre ');
            $this->db->where(array('C.deleted'=>0, 'C.nomParent !='=>'','centre.state' => 1, 'centre.deleted' => 0));  
            $query = $this->db->get();
            $result = $query->result(); 
            $nbrClients['regitred'] = count($result);
            // // *********************************************


            // // *********************************************
             $this->db->select(" C.idClient ");  
            $this->db->from( $this->table.' as C' );
            $this->db->join('centre', 'centre.id = C.idCentre ');
            $this->db->where(array('C.state'=>1, 'C.deleted'=>0, 'C.nomParent !='=>'', 'centre.state' => 1, 'centre.deleted' => 0));  
            $query = $this->db->get();
            $result = $query->result(); 
            $nbrClients['validated'] = count($result);
            // ********************************************* 
             

            return $nbrClients;


        }
        public function nbrClientByRep($idRep)
        {   
            $nbrClients = array();

            // *********************************************
             $this->db->select(" C.idClient "); 
            $this->db->from($this->table.' as C');
            $this->db->join('centre', 'centre.id = C.idCentre ');
            $this->db->join('representant', 'representant.id = centre.id_rep');
            $this->db->where(array('C.deleted'=>0, 'centre.state' => 1, 'centre.deleted' => 0,'C.deleted' => 0, 'representant.id' => $idRep  )); 
            $query = $this->db->get();
            $result = $query->result();
            $nbrClients['imported'] = count($result);
            // *********************************************


            // *********************************************
             $this->db->select(" C.idClient "); 
            $this->db->from($this->table.' as C');
            $this->db->join('centre', 'centre.id = C.idCentre ');
            $this->db->join('representant', 'representant.id = centre.id_rep');
            $this->db->where(array('C.nomParent !='=>'', 'centre.state' => 1, 'centre.deleted' => 0, 'C.deleted'=>0, 'representant.id' => $idRep  )); 
            $query = $this->db->get();
            $result = $query->result();
            $nbrClients['regitred'] = count($result);
            // *********************************************


            // *********************************************
             $this->db->select(" C.idClient "); 
            $this->db->from($this->table.' as C');
            $this->db->join('centre', 'centre.id = C.idCentre ');
            $this->db->join('representant', 'representant.id = centre.id_rep');
            $this->db->where(array('C.state'=>1, 'centre.state' => 1, 'centre.deleted' => 0, 'C.nomParent !='=>'', 'C.deleted'=>0, 'representant.id' => $idRep  )); 
            $query = $this->db->get();
            $result = $query->result(); 
            $nbrClients['validated'] = count($result);
            // *********************************************
            

            return $nbrClients;
        }
        public function verified($idClient)
        {
            $query = $this->db->get_where($this->table, array('idClient'=>$idClient)); 
            $result = $query->result(); 
            return $result[0]->state;
        }
        public function getIdCentre($idClient)
        {
            $query = $this->db->get_where($this->table, array('idClient'=>$idClient)); 
            $result = $query->result(); 
            return $result[0]->idCentre;
        }
        public function nbrEleveNotVerified($idCentre, $niveau)
        {
            $query = $this->db->get_where($this->table,array(
                                            'idCentre'=>$idCentre,
                                            'state'=> 0,
                                            'telParent !='=> '',
                                            'deleted'=> 0,
                                            'niveau'=>$niveau
                                        ));
            return count( $query->result() );
        }
        public function AjaxNbrClientsNotValidate($idCentre)
        {   
            $nbrClients = array();
            for ($i=0; $i < 4 ; $i++) { 
                $query = $this->db->get_where($this->table,array(
                                            'idCentre'=>$idCentre,
                                            'state'=> 0,
                                            'telParent !='=> '',
                                            'deleted'=> 0,
                                            'niveau'=> $i
                                        ));

                $nbrClients[ $i ] = count( $query->result() );
            } 
            return $nbrClients; 

        }

        public function getClassName($destination)
        {
            $data = array();
            foreach ($destination as $key => $idClient) {
                if( $this->getInfosClient($idClient) ){
                    $info = $this->getInfosClient($idClient); 
                    $data[] = $info['classe'].' - '.$info['groupe'];
                } 
            }
            return $data;
             
        }
        public function getStudents( $adresseMac )
        {     

            $this->db->select("Cl.*, Ce.about, Ce.reglement_interieur, Ce.vacances_scolaires");
            $this->db->from($this->table.' as Cl'); 
            $this->db->join( 'centre as Ce', 'Cl.idCentre = Ce.id');
            $this->db->like('Cl.adresseMac', $adresseMac); 
            $this->db->where(array('Cl.deleted' => 0, 'Cl.appname'=> $_POST['appname'])); 
            $query = $this->db->get();
            $result = $query->result(); 

            $data = array();
            if( $query->num_rows() > 0 ){ 

                $nbrAllows = 0;   
                foreach ($result as $key => $student) {

                    $array = array(
                        'id' => $student->idClient,
                        'idCentre' => $student->idCentre,
                        'niveau' => $student->niveau,
                        'logged_in_parant'=> true
                    );
                    $this->session->set_userdata($array);

                    $tabclasse = $this->intituleClasse();
                    $tabgroupe = $this->intituleGroupe();

                    $allowState = intval($this->Centre->GetInfoCentre( $student->idCentre )->allowParentToSendMsg);
                    $nbrAllows += $allowState;
                    $result[$key]->allowSend = $allowState; 
                    $result[$key]->badge = 0; 

                    $result[$key]->ClassGroupe = $tabclasse[$student->classe - 1].' - G'.$tabgroupe[$student->groupe - 1];

                }  
             }
            return array(
                "students" => $result,
                "allowSend" => ($nbrAllows == count($result)) ? 1 : false
            );                
        } 

        public function getStudentsByAdresseMac ( $adresseMac )
        {
            $this->db->select("*");
            $this->db->from($this->table); 
            $this->db->like('adresseMac', $adresseMac);
            $query = $this->db->get();
            return $query->result(); 
        }
        public function getParentName($adresseMac)
        {
            // $query = $this->db->get_where($this->table, array('adresseMac' => $adresseMac ));
            $this->db->select("*");
            $this->db->from($this->table); 
            $this->db->like('adresseMac', $adresseMac);  
            $this->db->where(array('deleted' => 0,'appname' => $_POST['appname'])); 
            $query = $this->db->get();

            if( $query->num_rows() > 0 ) {
                $parent = $query->result(); 

                $arrayAddressMac = (strpos($parent[0]->adresseMac, '/') !== false) ? explode('/',$parent[0]->adresseMac) : array($parent[0]->adresseMac);
                $arrayNomParents = (strpos($parent[0]->nomParent, '/') !== false) ? explode('/',$parent[0]->nomParent) : array($parent[0]->nomParent);
                $arrayTelParents = (strpos($parent[0]->telParent, '/') !== false) ? explode('/',$parent[0]->telParent) : array($parent[0]->telParent);

                $key = array_search($adresseMac, $arrayAddressMac);

                $data['nom'] = $arrayNomParents[ $key ];
                $data['telParent'] = $arrayTelParents[ $key ]; 
            }
            return $data;
        }
        public function selectClient($idClient)
        {
            $query = $this->db->select('P.nomParent as nom, V.intitule as ville, C.nom as ecole, P.telParent as tel'); 
            $query = $this->db->from($this->table.' as P'); 
            $query = $this->db->join('centre as C', 'P.idCentre = C.id'); 
            $query = $this->db->join('villes as V', 'C.ville = V.id'); 
            $query = $this->db->where(array('P.idClient'=>$idClient));
            $query = $this->db->get();
            $result = $query->result();
            return $result[0];
        }

        public function getInfoEleve($idClient)
        {
            $query = $this->db->select('P.*, V.intitule as ville, C.nom as ecole, C.photo as logo, P.telParent as tel, C.about, C.reglement_interieur, C.vacances_scolaires'); 
            $query = $this->db->from($this->table.' as P'); 
            $query = $this->db->join('centre as C', 'P.idCentre = C.id'); 
            $query = $this->db->join('villes as V', 'C.ville = V.id'); 
            $query = $this->db->where(array('P.idClient'=>$idClient));
            $query = $this->db->get();
            $result = $query->result();
            return $result[0];
        }
        public function valideAllClient( $state )
        {   
            $idCentre = $this->session->id;
            $niveau = $this->session->niveau;

            $this->db->update(
            $this->table, 
                array('state' => $state),
                array('idCentre' => $idCentre,'niveau' => $niveau)
            );

            $this->db->select('*');
            $this->db->from($this->table); 
            $this->db->where( array('idCentre' => $idCentre,'niveau' => $niveau) ); 

            $query = $this->db->get();  
            $this->load->model('Messages');
            $arrayOfTokens = array();
            foreach ($query->result() as $key => $client) {
                if( !empty($client->token) ){ 
                    $this->Messages->push(array($client->token), "parent", $this->getMessageValideCompte($client));
                }
            }  
        }
        public function removeOldImage( $idClient )
        {
            $query = $this->db->get_where($this->table, array('idClient'=>$idClient)); 
            $result = $query->result(); 
            if( trim($result[0]->photo) != '' ): 
                $filename = str_replace(base_url(), "", $result[0]->photo);
                if( file_exists($filename) ){
                    unlink($filename);
                } 
            endif;
        }
        public function updateToken($token, $idClient)
        {
            $this->db->select("idClient, adresseMac, token");
            $this->db->from($this->table);  
            $this->db->where(array("appname" => $_POST['appname'], "idClient" => $idClient));  
            $query = $this->db->get();
            $parents = $query->result(); 

            foreach ($parents as $key => $parent) {
                $arrayAddressMac = (strpos($parent->adresseMac, '/') !== false) ? explode('/',$parent->adresseMac) : array($parent->adresseMac);
                $arrayToken = (strpos($parent->token, '/') !== false) ? explode('/',$parent->token) : array($parent->token);
                
                $index = array_search($addressMac, $arrayAddressMac);


                if( count($arrayToken) == 1 ){
                    $newToken = $token; 
                }elseif( count($arrayToken) == 2 && $index == 0 ){
                    $newToken = $token."/".$arrayToken[1];
                }elseif( count($arrayToken) == 2 && $index == 1 ){
                    $newToken = $arrayToken[0]."/".$token;
                } 

                $this->db->where(array("idClient"=> $parent->idClient));
                $this->db->update( $this->table, array('token' => $newToken)); //Mise a jour de token  
            }
        }
        public function saveDeletedParent( $idClient, $parent )
        {
            $this->db->select('deletedParents');
            $this->db->from($this->table);
            $this->db->where(array('idClient'=>$idClient));
            $query = $this->db->get(); 
            $deletedParents =  $query->result()[0]->deletedParents;

            if( empty($deletedParents) ){
                $deletedParents = json_encode(array( $parent ));
            }else{
                $deletedParents = json_decode( $deletedParents );
                $deletedParents[] = $parent;
                $deletedParents = json_encode($deletedParents);
            }  

            if(
                $this->db->update(
                            $this->table, 
                            array("deletedParents" => $deletedParents), 
                            array('idClient' => $idClient))
            ){
                return $deletedParents;
            }
        }
        public function deleteParent($idClient, $indexParent)
        {
            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->where(array('idClient'=>$idClient));
            $query = $this->db->get(); 
            $client =  $query->result()[0];

            if( $client->nbrInscription == 2 && $indexParent == 0 ){

                $parent = array(
                    "name" => explode("/", $client->nomParent)[0],
                    "tel" => explode("/", $client->telParent)[0]
                ); 
                $client->deletedParents = $this->saveDeletedParent( $idClient, $parent );

                $client->nomParent = explode("/", $client->nomParent)[1];
                $client->telParent = explode("/", $client->telParent)[1];
                $client->adresseMac = explode("/", $client->adresseMac)[1];
                $client->token = explode("/", $client->token)[1]; 
                $client->nbrInscription = 1;

                

            }elseif( $client->nbrInscription == 2 && $indexParent == 1 ){

                $parent = array(
                    "name" => explode("/", $client->nomParent)[1],
                    "tel" => explode("/", $client->telParent)[1]
                ); 
                $client->deletedParents = $this->saveDeletedParent( $idClient, $parent );

                $client->nomParent = explode("/", $client->nomParent)[0];
                $client->telParent = explode("/", $client->telParent)[0];
                $client->adresseMac = explode("/", $client->adresseMac)[0];
                $client->token = explode("/", $client->token)[0]; 
                $client->nbrInscription = 1; 
                

            }elseif( $client->nbrInscription == 1 ){

                $parent = array(
                    "name" => $client->nomParent,
                    "tel" => $client->telParent
                ); 
                $client->deletedParents = $this->saveDeletedParent( $idClient, $parent );

                $client->nomParent = "";
                $client->telParent = "";
                $client->adresseMac = "";
                $client->token = ""; 
                $client->nbrInscription = 0;  
            }

            if( 
             $this->db->update(
                        $this->table, 
                        $client, 
                        array('idClient' => $idClient))
            ){
                return true;
            }else{
                return false;
            }
        }

        public function addphotoClient()
        {
            extract($_POST);

            $filePath = "assets/upload/eleves/".time().".jpg";
            $this->load->model('Messages');
            $this->Messages->base64_to_jpeg($photo, $filePath);

            return $this->db->update(
                    $this->table, 
                    array('photo' => base_url().$filePath), 
                    array('idClient' => $idClient) ); 

        }
        public function removePhotoClient()
        {  
            extract($_POST);
            return $this->db->update(
                    $this->table, 
                    array('photo' => ""), 
                    array('idClient' => $idClient) ); 

        }

        public function DeleteAllClientsInCentre($idCentre)
        {   
            // $query = $this->db->get_where($this->table, array('idCentre'=>$idCentre,'state'=>1, 'deleted'=>0)); 
            // $result = $query->result();

            // $arrayOfTokens = array();
            // foreach ($result as $key => $client) {
            //     if(strpos($client->token, '/') !== false){
            //         $array = explode("/", $client->token);
            //         $arrayOfTokens[] = $array[0];
            //         $arrayOfTokens[] = $array[1];
            //     }else{
            //         $arrayOfTokens[] = $client->token;  
            //     }
            // }
            // $this->load->model('Messages');
            // $message = "Votre Etablissement a été suspendu par l'equipe TawassolApp";
            // $this->Messages->push($arrayOfTokens, 'parent', strip_tags( $message ));

            $this->db->update(
                        $this->table, 
                        array('deleted' => 1), 
                        array('idCentre' => $idCentre) );
        }
        public function ActiveAllClientsInCentre($idCentre)
        {   

            // $query = $this->db->get_where($this->table, array('idCentre'=>$idCentre,'state'=>1, 'deleted'=>1)); 
            // $result = $query->result();

            // $arrayOfTokens = array();
            // foreach ($result as $key => $client) {
            //     if(strpos($client->token, '/') !== false){
            //         $array = explode("/", $client->token);
            //         $arrayOfTokens[] = $array[0];
            //         $arrayOfTokens[] = $array[1];
            //     }else{
            //         $arrayOfTokens[] = $client->token;  
            //     }
            // }
            // $this->load->model('Messages');
            // $message = "Votre Etablissement viens d'être activé par l'equipe TawassolApp";
            // $this->Messages->push($arrayOfTokens, 'parent', strip_tags( $message ));

            $this->db->update(
                        $this->table, 
                        array('deleted' => 0), 
                        array('idCentre' => $idCentre) );
        }

        public function addClientFromAdmin($clientData)
        {   
            if( strpos( $clientData['photo'], "data:image/" )  !== false){ 

                $filePath = "assets/upload/eleves/".time().$this->session->id.".jpg";
                $this->load->model('Messages');
                $this->Messages->base64_to_jpeg($clientData['photo'], $filePath);

                $this->load->library('image_lib'); 

                $config['image_library'] = 'gd2';
                $config['source_image'] = $filePath;
                $config['new_image'] = "assets/upload/eleves/";
                $config['maintain_ratio'] = TRUE;
                $config['create_thumb'] = TRUE;
                $config['thumb_marker'] = '';
                $config['quality'] = '100%';
                $config['width'] = 300;
                $config['height'] = 300;
                $config['overwrite'] = true;
                $this->image_lib->initialize($config);
                if ( !$this->image_lib->resize()):
                    $this->session->set_flashdata('errors', $this->image_lib->display_errors('', ''));  
                endif;

                $clientData['photo'] = base_url().$filePath;
                $clientData['statePhoto'] = 1;
            }

            $this->load->model('Centre');

            $clientData['idCentre'] = $this->session->id;
            $clientData['nom'] = $clientData['fname']." ".$clientData['lname'];
            $clientData['appname'] = $this->Centre->GetAppNameCentre();
            $clientData['niveau'] = $this->session->niveau;;
            $clientData['time'] = time();
            $clientData['state'] = 0;
            $clientData['nbrInscription'] = 0;

            //////////////////////////////// if Empty Classe
            $query = $this->db->get_where($this->table, array(
                    'idCentre'=>$clientData['idCentre'],
                    'niveau'=>$clientData['niveau'],
                    'classe'=>$clientData['classe'],
                    'groupe'=>$clientData['groupe'], 
                    'deleted'=>0
                )
            ); 
            $result = $query->result();
            ////////////////////////////////////////
            if( count($result) > 0 ){
                $clientData['password'] = $this->generatePassword();
                if( $this->InsertEleveIfNotExiste( $clientData ) ){
                    $data = array(
                        "success" => 1,
                        "message" => "L'élève est bien ajouté"
                    );
                }else{
                    $data = array(
                        "success" => 0,
                        "message" => "Il existe déjà un élève avec ce code Massar"
                    );
                } 
            }else{
                $data = array(
                    "success" => 0,
                    "message" => "La classe est encore vide.<br>Importer d'abord une liste à partir de <a href=\"./classes#importation\">Gérer les classes</a>"
                );
            }


                

            echo json_encode($data);
                
        }

        public function GetNbrClientsByGroupe()
        {
            //$query = "SELECT  FROM `client` WHERE `niveau` = 1 and idCentre = $this->session->niveau and `deleted` = 0 and `state` = 1 group by `classe`, `groupe`";

            $this->db->select(" classe, groupe, count(idClient) as count ");
            $this->db->from($this->table); 
            $this->db->where( array( 
                                'niveau' =>      $this->session->niveau,  
                                'idCentre' =>    $this->session->id,
                                'deleted' =>    0,
                                // 'state' =>    1
                                ) 
                            ); 
            $this->db->group_by("classe, groupe");

            $query = $this->db->get();
            $result = array();
            foreach ($query->result() as $key => $value) {
                $result[$value->classe.$value->groupe] = $value->count;  
            }
            
            return $result;
        }

        public function GetNbrClientsByGroupeImported()
        {
            //$query = "SELECT  FROM `client` WHERE `niveau` = 1 and idCentre = $this->session->niveau and `deleted` = 0 and `state` = 1 group by `classe`, `groupe`";

            $this->db->select(" classe, groupe, count(idClient) as count ");
            $this->db->from($this->table); 
            $this->db->where( array( 
                                'niveau' =>      $this->session->niveau,  
                                'idCentre' =>    $this->session->id,
                                'deleted' =>    0
                                ) 
                            ); 
            $this->db->group_by("classe, groupe");

            $query = $this->db->get();
            $result = array();
            foreach ($query->result() as $key => $value) {
                $result[$value->classe.$value->groupe] = $value->count;  
            }
            
            return $result;
        }

        public function getIdClientByCode($code)
        {
            $query = $this->db->get_where($this->table, array( 'code'=>$code, 'idCentre' => $this->session->id,  'deleted'=>0)); 
            $student = $query->result();

            if( count($student) > 0 ){
                return $student[0]->idClient;
            }else{
                return false;
            }
        }


        public function deleteClientFromGroupe()
        {
            if( $this->db->update(
                                $this->table, 
                                array('deleted' => 1), 
                                array(
                                    'idCentre' => $this->session->id,
                                    'niveau' => $this->session->niveau,
                                    'classe' => $_POST['classe'],
                                    'groupe' => $_POST['groupe']
                                ) 
                            ) 
            ){
                return true;
            }else{
                return false;
            }
        }

        public function getElevesByGroupe($niveau = false, $idCentre = false, $classe = false, $groupe = false, $deleted = 0,  $state = 1 )
        { 
            $data = array(
                'niveau'    =>   $niveau   ? $niveau    :   $this->session->niveau,  
                'idCentre'  =>   $idCentre ? $idCentre  :   $this->session->id,
                'classe'    =>   $classe   ? $classe    :   $_POST["classe"],
                'groupe'    =>   $groupe   ? $groupe    :   $_POST["groupe"]
            ); 

            $this->db->select("idClient, fname, lname");
            $this->db->from($this->table); 

            $args = array( 
                'niveau'    =>    $data["niveau"],  
                'idCentre'  =>    $data["idCentre"],
                'classe'    =>    $data["classe"],
                'groupe'    =>    $data["groupe"],
                'deleted'   =>    0, 
            );
            if( $state == 1 ){
                $args['state'] = 1;
            } 

            $this->db->where( $args );   
            $query = $this->db->get(); 
            return $query->result();

        }

















} ?>