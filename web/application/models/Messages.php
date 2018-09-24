<?php  
class Messages extends CI_Model {

        private $table = "messages";  
        private $validSentMessage = "Votre message est validé par l'administration";


        public function push($arrayOfTokens, $type, $message, $titleMessage = false)
        { 
            // API access key from Google API's Console
            
            switch ( $type ) {
                case 'parent':
                    $API_ACCESS_KEY = 'AAAAHAOmp5k:APA91bF2Pk6MXEhV2gZ7CTbHcuz25hT5SUd6TfOdMGKEpgNWvVQVpdpbSeFUzyUcfoQQJTOuVr_FjUrbuCo5F6rFn4ajaOgmZW0Gkg45_BntXkcxdjcQg4DIlXRSUSE5KpkZe1tD8-G6';
                    $titleApp = $titleMessage ? $titleMessage : "Nouveau message";
                    break;
                case 'prof':
                    $API_ACCESS_KEY =  'AAAAqVYhNWA:APA91bEBNkAvRX16knKill5FFU7-XYaeHTHi-40Gh3tfuRZL9vPsJGCoD00_jV7AZCmL1jPzJHMuMQrncLH5Mmu1Y9S5PPejh2kU6lZcFcmT7wPW_YVFlaXGF5PvHw29c0g2vawiMsqq';
                    $titleApp = $titleMessage ? $titleMessage : "Nouveau message";;
                    break; 

                case 'rep':
                    $API_ACCESS_KEY =  'AAAAMQvglm0:APA91bHsc0238TQTGfHCMeQHpIiEp-V7EpyDpmQk-Kmu1ANkzRmAPx3RJZ6eOlFWZGK5QAkHoo_etKwk9yRFzzvIGPA1EcY_LPtPiRVWcauNbF3i7re_qxM8Nd07PvYbu1qby86ycZuP';
                    $titleApp = $titleMessage ? $titleMessage : "Nouvelle inscription";;
                    break; 

                    
            }
             
            $fields = array
            (
                'registration_ids'  => $arrayOfTokens,
                "notification" => array(
                    "title" => $titleApp,
                    "text" => trim( html_entity_decode($message) ),
                    'vibrate'   => 1,
                    'sound'     => "default",
                    'largeIcon' => 'large_icon',
                    'smallIcon' => 'small_icon' 
                )

            );
             
            $headers = array
            (
                'Authorization: key=' . $API_ACCESS_KEY,
                'Content-Type: application/json'
            );
             
            $ch = curl_init();
            curl_setopt( $ch,CURLOPT_URL, 'https://android.googleapis.com/gcm/send' );
            curl_setopt( $ch,CURLOPT_POST, true );
            curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
            curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
            curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
            $result = curl_exec($ch );
            curl_close( $ch );
            
            // echo "<pre>";
            //     print_r(($arrayOfTokens));
            //     print_r(json_decode($result));
            // echo "</pre>";

            //  die();
            
        }
        public function SendPuchToParents( $idMessage )
        {
            $arrayOfTokens = array();

            $query = $this->db->get_where( "messages" ,array('idMessage' => $idMessage) );
            $message = $query->result()[0];

            $idCentre = $message->idCentre;
            $niveau = $message->niveau;

            $query = $this->db->get_where( "client" , array('idCentre' => $idCentre, 'niveau' => $niveau, 'state' => 1, 'deleted' => 0) );
            $users = $query->result();

            foreach ($users as $key => $user) :
                if( !empty($user->token) ):
                    switch ($message->type) {
                        case 'parent':
                            $tab = (strpos($message->destination, ',') !== false) ? explode(',', $message->destination)  : array($message->destination);

                            if( in_array($user->idClient, $tab) ){ 
                                    if(strpos($user->token, '/') !== false){
                                        $array = explode("/", $user->token);
                                        $arrayOfTokens[] = $array[0];
                                        $arrayOfTokens[] = $array[1];
                                    }else{
                                        $arrayOfTokens[] = $user->token;  
                                    }
                            }
                            
                            break;

                        case 'classe':  
                            $tab = (strpos($message->destination, ',') !== false) ? explode(',', $message->destination)  : array($message->destination);
                             
                            if ( in_array($user->classe, $tab) ) { 
                                if(strpos($user->token, '/') !== false){
                                    $array = explode("/", $user->token);
                                    $arrayOfTokens[] = $array[0];
                                    $arrayOfTokens[] = $array[1];
                                }else{
                                    $arrayOfTokens[] = $user->token;  
                                }  
                            }  
                            break;

                        case 'groupe': 
                            $tab = (strpos($message->destination, ',') !== false) ? explode(',', $message->destination)  : array($message->destination);

                            if ( in_array($user->classe.'-'.$user->groupe, $tab) ) {
                                if(strpos($user->token, '/') !== false){
                                    $array = explode("/", $user->token);
                                    $arrayOfTokens[] = $array[0];
                                    $arrayOfTokens[] = $array[1];
                                }else{
                                    $arrayOfTokens[] = $user->token;  
                                }                       
                            } 
                            break;

                        case 'all':
                            if(strpos($user->token, '/') !== false){
                                $array = explode("/", $user->token);
                                $arrayOfTokens[] = $array[0];
                                $arrayOfTokens[] = $array[1];
                            }else{
                                $arrayOfTokens[] = $user->token;  
                            }
                            break;
                        
                    }
                endif;
            endforeach; 
            if( count($arrayOfTokens) > 0 ){ 
                $this->push($arrayOfTokens, 'parent', strip_tags($message->content));
            } 

            // if(strpos($user->token, '/') !== false){
            //     $array = explode("/", $user->token);
            //     $arrayOfTokens[] = $array[0];
            //     $arrayOfTokens[] = $array[1];
            // }else{
            //     $arrayOfTokens[] = $user->token;  
            // }
            
        }

        public function SendPuchToProfs( $idMessage )
        {
            $arrayOfTokens = array();

            $query = $this->db->get_where( "messages" ,array('idMessage' => $idMessage) );
            $message = $query->result()[0];

            $idCentre = $message->idCentre;
            $niveau = $message->niveau;

            $query = $this->db->get_where( "prof" , array('idCentre' => $idCentre, 'niveau' => $niveau, 'state' => 1, 'deleted' => 0) );
            $users = $query->result();

            foreach ($users as $key => $user) :
                 
                if( !empty($user->token) ):
                    switch ($message->type) {
                        case 'prof':
                            $tab =  (strpos($message->destination, ',') !== false) ? explode(',', $message->destination) : array($message->destination);

                            if( in_array($user->idProf, $tab )){
                                $arrayOfTokens[] = $user->token; 
                            }
                            break;

                        case 'matiere':
                            $finded = 0;
                            $tab =  (strpos($message->destination, ',') !== false) ? explode(',', $message->destination) : array($message->destination);

                            $matieres = (strpos($user->matieres, ',') !== false) ? explode(',', $user->matieres) : array($user->matieres);
                            foreach ($matieres as $matiere) { 

                                if (in_array($matiere, $tab)) {
                                    $finded++;
                                } 
                            }
                            if( $finded > 0 ){
                                $arrayOfTokens[] = $user->token;
                            } 
                            break;

                        case 'classe':
                            $finded = 0;
                            $tab =  (strpos($message->destination, ',') !== false) ? explode(',', $message->destination) : array($message->destination);
                            
                            $classes = (strpos($user->classe, ',') !== false) ? explode(',', $user->classe) : array($user->classe);
                            foreach ($classes as $classe) {
                                if (in_array( explode(":", $classe)[0] , $tab)) {
                                    $finded++;
                                } 
                            } 
                            if( $finded > 0 ){
                                $arrayOfTokens[] = $user->token;
                            } 
                            break;

                        case 'groupe':
                            $finded = 0;
                            $tab =  (strpos($message->destination, ',') !== false) ? explode(',', str_replace('-', '', $message->destination)) : array(str_replace('-', '', $message->destination));

                            $groupes = (strpos($user->classe, ',') !== false) ? explode(',', $user->classe) : array($user->classe);
                            foreach ($groupes as $groupe) {
                                if (in_array( str_replace(':', '',$groupe) ,$tab )) {
                                    $finded++;
                                } 
                            }  
                            if( $finded > 0 ){
                                $arrayOfTokens[] = $user->token;
                            } 
                            break;
                            
                        case 'all': 
                            $arrayOfTokens[] = $user->token;
                            break;
                        
                    }
                endif;
            endforeach;
            if( count($arrayOfTokens) > 0 ){
                $this->push($arrayOfTokens, 'prof', strip_tags($message->content));
            }

        }

        public function SendMessageToProf()
        {   
            ////////////////////////////////////////////////////////// 

            $config['upload_path'] = APPPATH.'../assets/upload/';  
            $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|doc|docx|xls|xlsx|ppt|pptx';

            $this->load->library('upload', $config);
            $file = '';
            $typeFile = "";
            if(!empty($_FILES['file']['name'])):

                $_FILES['file']['name'] = preg_replace("/[^a-zA-Z0-9.]/", "", $_FILES['file']['name']);

                if($this->upload->do_upload('file')):

                    $path = $_FILES['file']['name'];
                    $ext = pathinfo(strtolower($path), PATHINFO_EXTENSION);
                    $arrayExtension = array("jpeg", "jpg", "png", "gif");

                    if( in_array($ext, $arrayExtension) ): // if file is images
                        //////////////////////////////////////////////////////////////////// 
                        $file = $this->upload->data('file_name'); 
                        
                        $this->load->library('image_lib'); 

                        $config2['image_library'] = 'gd2';
                        $config2['source_image'] = $config['upload_path'].$file;
                        $config2['new_image'] = $config['upload_path'].'thumbs/';
                        $config2['maintain_ratio'] = TRUE;
                        $config2['create_thumb'] = TRUE;
                        $config2['thumb_marker'] = '';
                        $config2['quality'] = '100%';
                        $config2['width'] = 300;
                        $config2['height'] = 300;
                        $config2['overwrite'] = true;
                        $this->image_lib->initialize($config2);
                        if ( !$this->image_lib->resize()):
                            $this->session->set_flashdata('errors', $this->image_lib->display_errors('', ''));  
                        endif;

                        $this->image_lib->clear();

                        $config3['image_library'] = 'gd2';
                        $config3['source_image'] = $config['upload_path'].$file;
                        $config3['new_image'] = $config['upload_path'].'android/';
                        $config3['maintain_ratio'] = TRUE;
                        $config3['create_thumb'] = TRUE;
                        $config3['thumb_marker'] = '';
                        $config3['quality'] = '100%';
                        $config3['width'] = 600;
                        $config3['height'] = 600;
                        $config3['overwrite'] = true;
                        $this->image_lib->initialize($config3);
                        if ( !$this->image_lib->resize()):
                            $this->session->set_flashdata('errors', $this->image_lib->display_errors('', ''));  
                        endif;
                        ///////////////////////////////////////////////////
                        $typeFile = 'image';
                    else:
                        $file = $this->upload->data('file_name');
                        $typeFile = 'notImage';
                    endif;
 
                else: 
                    $file = '';
                    $typeFile = '';
                endif;  
            endif; 
            ////////////////////////////////////////////////////////// 
            $array = array(
                            'categorie' => 'prof', 
                            'from' => 'centre', 
                            'idFrom' => $this->session->id, 
                            'idCentre' => $this->session->id, 
                            'niveau' => $this->session->niveau,
                            'type' => $_POST['type'], 
                            'destination' => str_replace('_', '', $_POST['destination']), 
                            'content' => $_POST['content'], 
                            'file' => $file, 
                            'typeFile' => $typeFile, 
                            'date' => $_POST['date'], 
                            'time' => time(), 
                            'state' =>1,
                            'align' =>( isset($_POST['align']) ) ? $_POST['align'] : 'left'
                           );

            if( $this->db->insert($this->table, $array) ){
                $idMessage = $this->db->insert_id();
                $this->SendPuchToProfs( $idMessage );
                return true;
            }else{
                return false;
            }
        }
        public function SendMessageToParent()
        {   
            ////////////////////////////////////////////////////////// 

            $config['upload_path'] = APPPATH.'../assets/upload/';  
            $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|doc|docx|xls|xlsx|ppt|pptx';

            $this->load->library('upload', $config);
            $file = '';
            $typeFile = "";
            if(!empty($_FILES['file']['name'])):

                
                $_FILES['file']['name'] = preg_replace("/[^a-zA-Z0-9.]/", "", $_FILES['file']['name']);

                if($this->upload->do_upload('file')):

                    $path = $_FILES['file']['name'];
                    $ext = pathinfo(strtolower($path), PATHINFO_EXTENSION);
                    $arrayExtension = array("jpeg", "jpg", "png", "gif");

                    if( in_array($ext, $arrayExtension) ): // if file is images
                        //////////////////////////////////////////////////////////////////// 
                        $file = $this->upload->data('file_name'); 
                        
                        $this->load->library('image_lib'); 

                        $config2['image_library'] = 'gd2';
                        $config2['source_image'] = $config['upload_path'].$file;
                        $config2['new_image'] = $config['upload_path'].'thumbs/';
                        $config2['maintain_ratio'] = TRUE;
                        $config2['create_thumb'] = TRUE;
                        $config2['thumb_marker'] = '';
                        $config2['quality'] = '100%';
                        $config2['width'] = 300;
                        $config2['height'] = 300;
                        $config2['overwrite'] = true;
                        $this->image_lib->initialize($config2);
                        if ( !$this->image_lib->resize()):
                            $this->session->set_flashdata('errors', $this->image_lib->display_errors('', ''));  
                        endif;

                        $this->image_lib->clear();

                        $config3['image_library'] = 'gd2';
                        $config3['source_image'] = $config['upload_path'].$file;
                        $config3['new_image'] = $config['upload_path'].'android/';
                        $config3['maintain_ratio'] = TRUE;
                        $config3['create_thumb'] = TRUE;
                        $config3['thumb_marker'] = '';
                        $config3['quality'] = '100%';
                        $config3['width'] = 600;
                        $config3['height'] = 600;
                        $config3['overwrite'] = true;
                        $this->image_lib->initialize($config3);
                        if ( !$this->image_lib->resize()):
                            $this->session->set_flashdata('errors', $this->image_lib->display_errors('', ''));  
                        endif;
                        ///////////////////////////////////////////////////
                        $typeFile = 'image';
                    else:
                        $file = $this->upload->data('file_name');
                        $typeFile = 'notImage';
                    endif; 
 
                else: 
                    echo "<pre>";
                        print_r($this->upload->display_errors());
                    echo "</pre>";
                    die();
                    $file = '';
                    $typeFile = '';
                endif;   
            endif;
            ////////////////////////////////////////////////////////// 
            $array = array(
                    'categorie' => 'parent', 
                    'message_type' => $_POST['message_type'],
                    'from' => 'centre', 
                    'idFrom' => $this->session->id, 
                    'idCentre' => $this->session->id, 
                    'niveau' => $this->session->niveau,
                    'type' => $_POST['type'], 
                    'destination' => str_replace('_', '', $_POST['destination']), 
                    'content' => $_POST['content'], 
                    'file' => $file, 
                    'typeFile' => $typeFile, 
                    'date' => $_POST['date'], 
                    'time' => time(), 
                    'state' =>1, 
                    'align' =>( isset($_POST['align']) ) ? $_POST['align'] : 'left'
            );

            if( $array['message_type'] == 'parent' ){
                $array['message_type'] = 'discipline';
                $array['forParent'] = 1;
            }

            if( $this->db->insert($this->table, $array) ){
                $idMessage = $this->db->insert_id();
                $this->SendPuchToParents( $idMessage );
                return true;
            }else{
                return false;
            }
        }
        public function base64_to_jpeg($base64_string, $output_file)
        {
            $ifp = fopen($output_file, "wb"); 
            $data = explode(',', $base64_string);
            fwrite($ifp, base64_decode($data[1])); 
            fclose($ifp);  
        }

        public function autoSendMessageToParent( $idCentre, $niveau, $idClient, $content )
        {   
             $array = array(
                    'categorie' => 'parent', 
                    'from' => 'centre', 
                    'idFrom' => $idCentre, 
                    'idCentre' => $idCentre, 
                    'niveau' => $niveau,
                    'type' => 'parent', 
                    'destination' => $idClient, 
                    'content' => $content, 
                    "message_type"=> "discipline", 
                    'time' => time()-60, 
                    'state' =>1, 
                    'align' =>'left'
            );
            if( $this->db->insert($this->table, $array) ){
                $idMessage = $this->db->insert_id();
                $this->SendPuchToParents( $idMessage );
                return true;
            }else{
                return false;
            }
        }
        public function SendMessageToParentByProf()
        {   
            ////////////////////////////////////////////////////////// 
            $config['upload_path'] = APPPATH.'../assets/upload/'; 
            $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf|doc|docx|xls|xlsx|ppt|pptx';

            $file = '';
            $typeFile = "";
            if(!empty($_FILES['file'] )): 

                $_FILES['file']['name'] = preg_replace("/[^a-zA-Z0-9.]/", "", $_FILES['file']['name']);
            
                $this->load->library('upload', $config);
                if($this->upload->do_upload('file')):

                    $path = $_FILES['file']['name'];
                    $ext = pathinfo(strtolower($path), PATHINFO_EXTENSION);
                    $arrayExtension = array("jpeg", "jpg", "png", "gif");

                    if( in_array($ext, $arrayExtension) ): // if file is images
                        //////////////////////////////////////////////////////////////////// 
                        $file = $this->upload->data('file_name'); 
                        
                        $this->load->library('image_lib'); 

                        $config2['image_library'] = 'gd2';
                        $config2['source_image'] = $config['upload_path'].$file;
                        $config2['new_image'] = $config['upload_path'].'thumbs/';
                        $config2['maintain_ratio'] = TRUE;
                        $config2['create_thumb'] = TRUE;
                        $config2['thumb_marker'] = '';
                        $config2['quality'] = '100%';
                        $config2['width'] = 300;
                        $config2['height'] = 300;
                        $config2['overwrite'] = true;
                        $this->image_lib->initialize($config2);
                        if ( !$this->image_lib->resize()):
                            $this->session->set_flashdata('errors', $this->image_lib->display_errors('', ''));  
                        endif;

                        $this->image_lib->clear();

                        $config3['image_library'] = 'gd2';
                        $config3['source_image'] = $config['upload_path'].$file;
                        $config3['new_image'] = $config['upload_path'].'android/';
                        $config3['maintain_ratio'] = TRUE;
                        $config3['create_thumb'] = TRUE;
                        $config3['thumb_marker'] = '';
                        $config3['quality'] = '100%';
                        $config3['width'] = 600;
                        $config3['height'] = 600;
                        $config3['overwrite'] = true;
                        $this->image_lib->initialize($config3);
                        if ( !$this->image_lib->resize()):
                            $this->session->set_flashdata('errors', $this->image_lib->display_errors('', ''));  
                        endif;
                        ///////////////////////////////////////////////////
                        $typeFile = 'image';
                    else:
                        $file = $this->upload->data('file_name');
                        $typeFile = 'notImage';
                    endif;
 
                else: 
                    $file = '';
                    $typeFile = '';
                endif;   
            endif; 

            if( isset($_POST['base64']) && $_POST['base64']!=''){

                $file = time()."from_approf.jpg"; 
                $typeFile = 'image'; 

                $this->base64_to_jpeg( $_POST['base64'], $config['upload_path'].$file ); // originale image
                ///////////////////////********************************* size 1 **********************************//////////////////////
                    $this->load->library('image_lib');  
                    $config1['image_library'] = 'gd2';
                    $config1['source_image'] = $config['upload_path'].$file;
                    $config1['new_image'] = $config['upload_path'].'android/';
                    $config1['maintain_ratio'] = TRUE;
                    $config1['create_thumb'] = TRUE;
                    $config1['thumb_marker'] = '';
                    $config1['quality'] = '100%';
                    $config1['width'] = 600;
                    $config1['height'] = 600;
                    $config1['overwrite'] = true;
                    $this->image_lib->initialize($config1);
                    if ( !$this->image_lib->resize()):
                        $this->session->set_flashdata('errors', $this->image_lib->display_errors('', ''));  
                    endif;
                ///////////////////////********************************* end size 1 **********************************//////////////////////
                ///////////////////////********************************* size 2 **********************************//////////////////////
                    $this->load->library('image_lib');  
                    $config2['image_library'] = 'gd2';
                    $config2['source_image'] = $config['upload_path'].$file;
                    $config2['new_image'] = $config['upload_path'].'thumbs/';
                    $config2['maintain_ratio'] = TRUE;
                    $config2['create_thumb'] = TRUE;
                    $config2['thumb_marker'] = '';
                    $config2['quality'] = '100%';
                    $config2['width'] = 300;
                    $config2['height'] = 300;
                    $config2['overwrite'] = true;
                    $this->image_lib->initialize($config2);
                    if ( !$this->image_lib->resize()):
                        $this->session->set_flashdata('errors', $this->image_lib->display_errors('', ''));  
                    endif;
                ///////////////////////********************************* end size 2 **********************************//////////////////////
            }
            //////////////////////////////////////////////////////////
            $this->load->model('Prof_');
            $state = ($this->Prof_->fidele($this->session->id)) ? 1 : 0;
            $array = array(
                'categorie' => 'parent', 
                'message_type' => 'devoir',
                'from' => 'prof', 
                'remarque' => '', 
                'idFrom' => $this->session->id, 
                'idCentre' => $this->session->idCentre, 
                'niveau' => $this->session->niveau,
                'type' => $_POST['type'], 
                'destination' => str_replace('_', '', $_POST['destination']), 
                'matiere' => $_POST['matiere'], 
                'content' => nl2br($_POST['content']), 
                'file' => $file, 
                'typeFile' => $typeFile, 
                'date' => $_POST['date'], 
                'time' => time(), 
                'state' =>$state, 
                'align' =>( isset($_POST['align']) ) ? $_POST['align'] : 'left'
            );

             
            if( isset($_POST['idMessage']) ){
                
                if( !empty($_POST['old-file']) && empty($array['file']) ){
                    unset($array['file']);
                    unset($array['typeFile']);
                }

                $this->db->update(
                        $this->table,  $array,   array('idMessage' => $_POST['idMessage'])
                );

            }else{
                $this->db->insert($this->table, $array);
                if( $state == 1 ){
                    $idMessage = $this->db->insert_id();
                    $this->SendPuchToParents( $idMessage );
                }
                
            }

            return true;
        }
        public function GetMessageFromProfs($etat)
        {
            $idCentre = $this->session->id;
            $niveau = $this->session->niveau;

            $this->db->select('
                                M.idMessage,
                                M.type,
                                M.destination,
                                M.matiere,
                                M.content,
                                M.align,
                                M.file,
                                M.typeFile,
                                M.date,
                                M.time,
                                M.vu,
                                P.nom as prof,
                                P.idProf,
                                P.fidele 
                            ');
            $this->db->from($this->table.' as M');
            $this->db->join( 'prof as P', 'M.idFrom = P.idProf');
            $this->db->where( array( 
                                'M.state' => $etat,    
                                'M.remarque' => '',    
                                'M.from' => 'prof', 
                                'M.niveau' => $this->session->niveau,
                                'M.idCentre' => $this->session->id
                                ) 
                            );
            $this->db->order_by('M.time','DESC');

            $query = $this->db->get();

            return $query->result();
        }
        public function GetMessageFromOneProf()
        {
            $idProf = $this->session->id;
            $niveau = $this->session->niveau;

            $this->db->select('
                                M.idMessage,
                                M.remarque,
                                M.type,
                                M.destination,
                                M.matiere,
                                M.content,
                                M.align,
                                M.file,
                                M.typeFile,
                                M.time,
                                M.date,
                                M.state,
                                P.nom as prof 
                            ');
            $this->db->from($this->table.' as M');
            $this->db->join( 'prof as P', 'M.idFrom = P.idProf');
            $this->db->where( array(
                                'M.categorie' => 'parent',
                                'M.niveau' => $niveau, 
                                'M.from' => 'prof', 
                                'P.idProf' => $idProf,
                                'P.niveau' => $niveau ,
                                'M.niveau' => $niveau 
                                ) 
                            );
            $this->db->order_by('M.time','DESC');

            $query = $this->db->get();

            return $query->result();
        }
        public function GetMessageFromCentre( $toProf = false )
        {
             
            if( $this->session->logged_in_prof ){
                $idCentre = $this->session->idCentre;
            }else{
                $idCentre = $this->session->id;
            }
            $niveau = $this->session->niveau;

            $this->db->select('
                                idMessage,
                                categorie,
                                type,
                                destination,
                                content,
                                align,
                                typeFile,
                                file,
                                time,
                                date,
                                vu
                            ');
            $this->db->from($this->table);   
            $this->db->where( array(  
                'from' => 'centre',  
                'idFrom' => $idCentre,
                'niveau' => $niveau
            ) );
            $this->db->order_by('time','DESC');

            $query = $this->db->get(); 
           return $query->result();
        } 

        public function removeMessage($idMessage, $intituleClasse, $intituleGroupe)
        {    
            if( $this->session->usertype == 'admin' ){ 
                $deletedMessage = $this->GetMessageById( $idMessage );  

                if( $deletedMessage->categorie == 'parent' && $deletedMessage->from == 'prof' ){


                    switch ($deletedMessage->type) {
                        case 'groupe':
                            $destination =  (strpos($deletedMessage->destination, ',') !== false) ? explode(',',$deletedMessage->destination) : array($deletedMessage->destination);

                            foreach ($destination as $key1 => $value1) {
                                $destination[$key1] = explode('-', $value1);
                            }  
                            foreach ($destination as $key2 => $dest2) {
                                $destination[$key2] = $intituleClasse[$dest2[0]-1].' - G'.$intituleGroupe[$dest2[1]-1];
                            }  
   
                            break;
                        
                        case 'classe':      
                            $destination =  (strpos($deletedMessage->destination, ',') !== false) ? explode(',',$deletedMessage->destination) : array($deletedMessage->destination); 
                            foreach ($destination as $key1 => $value1) {
                                $destination[$key1] = $intituleClasse[$value1[0]-1];
                            } 
 
                            break;

                        case 'parent': 
                            $destination = (strpos($deletedMessage->destination, ',') !== false) ? explode(',',$deletedMessage->destination) : array($deletedMessage->destination);
                            $this->load->model('Client');
                            $parents = $this->Client->GetCustomClient($destination);
                            $ClassName = $this->Client->getClassName($destination);
                            unset($destination); 
                            //print_r($parents); die();
                            if( $parents != 'false' ){
                                $i = 0; 
                                $destination = [];
                                foreach ($parents as  $dest) {
                                    $destination[] = $dest->nom.' ( '.$ClassName[$i].' )'; 
                                    $i++;
                                }                           
                            } 
                            break;

                        case 'all':
                            $destination = array('Tous les parents'); 
                            break;
                    }

                    $deletedMessage->destination = $destination;

                    $destinations = '';
                    foreach ($destination as $key => $value) {
                        $destinations .= '<span class="item-destination">'.$value.'</span>';
                    }

                    $newMessage = "<strong>Votre message a été supprimé par l'administration.</strong><div class='deletedMessage'><strong>Date:</strong> ".date("d/m/Y",$deletedMessage->time)."<strong>Matière:</strong>".$deletedMessage->matiere."<strong>Destination:</strong> <ion-scroll class='item-destination-continer' direction='x' scrollbar-x='false'>".$destinations."</ion-scroll> <strong>Message:</strong><div class='msg'>".$deletedMessage->content."</div></div>";

                    $array = array(
                        'categorie' => 'prof', 
                        'from' => 'centre', 
                        'idFrom' => $deletedMessage->idCentre, 
                        'idCentre' => $deletedMessage->idCentre, 
                        'niveau' => $deletedMessage->niveau,
                        'type' => 'prof', 
                        'destination' => $deletedMessage->idFrom, 
                        'content' => $newMessage,  
                        'file' => $deletedMessage->file, 
                        'typeFile' => $deletedMessage->typeFile,  
                        'time' => time(), 
                        'state' =>1,
                        'align' => 'left'
                    );
  

                    if( strpos($deletedMessage->content, "class='deletedMessage'") === false ){
                        if( $this->db->insert($this->table, $array) ){ 
                            $newIdMessage = $this->db->insert_id();  
                            $this->SendPuchToProfs( $newIdMessage );
                        }
                    }
                    
                }

                    

                     
            } 

            $this->db->where('idMessage', $idMessage); 
            $this->db->delete($this->table);
            if( $this->db->affected_rows() > 0 )   return true;
            else return false;
        }

        public function addRemarqueToMessage($array)
        {
            return $this->db->update(
                    $this->table, 
                    array('remarque' => $array['remarque']),  
                    array('idMessage' => $array['idMessage'])
            );
        }

        public function NotifProf( $idMessage )
        {
            $this->db->select('token');
            $this->db->from("prof".' as P'); 
            $this->db->join( $this->table.' as M', 'M.idFrom = P.idProf');
            $this->db->where( array(  'M.idMessage' => $idMessage ) );
            $query = $this->db->get();

            $prof = $query->result()[0]; 
            $arrayOfTokens = array();
            if( !empty( $prof->token ) ){
                $arrayOfTokens[] = $prof->token;
            }
            if( count($arrayOfTokens) > 0 ){ 
                $this->push($arrayOfTokens, 'prof', $this->validSentMessage);
            }
        }
        public function sendMessage($idMessage,$etat)
        {
            if($idMessage != 'all'):
                if(
                    $this->db->update(
                            $this->table, 
                            array('state' => $etat,'vu'=>''),  
                            array('idMessage' => $idMessage)
                    )
                ){
                    $this->SendPuchToParents( $idMessage );
                    $this->NotifProf( $idMessage );
                    return true;
                }
                else{
                     return false;
                }

            elseif($idMessage == 'all'):
                if(
                    $this->db->update(
                            $this->table, 
                            array('state' => 1)) 
                ){
                    return true;
                }
                else{
                     return false;
                }
            endif;
        }
        
        public function nbrMessageNotSend($idCentre=false, $niveau=false)
        {
            if( !$idCentre ){
                $idCentre = $this->session->id;
                $niveau = $this->session->niveau;
            } 

            $this->db->select('count(M.idMessage) as nbr');
            $this->db->from($this->table.' as M'); 
            $this->db->join( 'prof as P', 'M.idFrom = P.idProf');
            $this->db->where( array(
                                'M.categorie' => 'parent',
                                'M.niveau' => $niveau, 
                                'M.state' => 0,
                                'M.from' => 'prof',
                                'P.idCentre' => $idCentre,
                                'P.niveau' => $niveau
                                ) 
                            ); 

            $query = $this->db->get();
            $result = $query->result();

            return $result[0]->nbr;
        }
        public function AjaxNbrMessageNotSend($idCentre)
        {  
            $nbrMsg = array();
            for ($i=0; $i < 4 ; $i++) { 
                $this->db->select('count(M.idMessage) as nbr');
                $this->db->from($this->table.' as M'); 
                $this->db->join( 'prof as P', 'M.idFrom = P.idProf');
                $this->db->where( array(
                                    'M.categorie' => 'parent',
                                    'M.niveau' => $i, 
                                    'M.state' => 0,
                                    'M.from' => 'prof',
                                    'P.idCentre' => $idCentre,
                                    'P.niveau' => $i
                                    ) 
                                ); 

                $query = $this->db->get();
                $result = $query->result();

                $nbrMsg[$i]= $result[0]->nbr;
            }

            return $nbrMsg; 
            
        }
        public function GetMessageFromCentreToOneProf( $idProf = false )
        {   
            $this->load->model('Prof_');

            $idProf = ( $idProf) ?  $idProf : $this->session->id;

            $prof = $this->Prof_->GetCustomProfs(array($idProf),'*');
            $data['idProf'] = $idProf; 
            $data['matieres'] =  (strpos($prof[0]->matieres, ',') !== false) ? explode(',', $prof[0]->matieres) : array($prof[0]->matieres);

            $data['groupe'] =  (strpos(str_replace(':', '', $prof[0]->classe), ',') !== false) ? explode(',', str_replace(':', '', $prof[0]->classe)) : array(str_replace(':', '', $prof[0]->classe));
            $data['classe'] = array();

            $tab = (strpos($prof[0]->classe, ',') !== false) ? explode(',', $prof[0]->classe) : array($prof[0]->classe);
            foreach ($tab as  $value1) {
                $tab = explode(':', $value1);
                $data['classe'][] = $tab[0];
            }

            $data['messages'] = $this->GetMessageFromCentre();
             
            foreach ($data['messages'] as $key => $value2) {
                if( $value2->categorie == 'parent' ){
                    unset($data['messages'][$key]);
                }
            }
            
            return $data;
        }
        public function addVuToMessage($idMessage, $idClient)
        {
            $this->db->select('vu');
            $this->db->from($this->table);
            $this->db->where(array('idMessage'=>$idMessage));

            $query = $this->db->get();
            $result = $query->result();
            
            $vu = "null";
            if( empty($result[0]->vu) ){
                $vu = $idClient;
            }else{
                if( (strpos($result[0]->vu, ',') !== false) ){
                    if( !in_array($idClient, explode(',', $result[0]->vu)) ){
                        $vu = $result[0]->vu.','.$idClient;
                    } 
                }else{
                    if($idClient != $result[0]->vu ){
                        $vu = $result[0]->vu.','.$idClient;
                    }else{
                         $vu = $idClient;
                    }
                }
                
            }

            if( $vu != "null" ){
                $this->db->update( $this->table,   array('vu' => $vu),  array('idMessage' => $idMessage) );
                return true;
            }else{
                return false;
            }
        }
        public function GetMessageClient($idClient, $message_type = 'parent')
        {   
            
            // $query = $this->db->get_where('client',array('adresseMac' => $adresseMac, 'state' => 1));
            $this->db->select("Cl.idClient,Cl.idCentre,Cl.niveau,Cl.classe,Cl.groupe, Cl.time");
            $this->db->from("client as Cl");
            $this->db->join( 'centre as Ce', 'Cl.idCentre = Ce.id'); 
            $this->db->like('Cl.idClient', $idClient); 
            $this->db->where(array('Cl.state' => 1,'Ce.deleted' => 0, 'Cl.deleted' => 0)); 

            
            if( isset($_POST['appname']) ){
                $this->db->where(array('Cl.appname'=> $_POST['appname'])); 
            }

            $query = $this->db->get(); 
            $results = $query->result(); 



            foreach ($results as $result) {
                $data['idClient'][] = $result->idClient; 
                $data['idCentre'][] = $result->idCentre; 
                $data['niveau'][] = $result->niveau; 
                $data['classe'][] = $result->classe; 
                $data['groupe'][] = $result->groupe; 
                $data['time'][] = $result->time; 
            } 



            $data['messages'] = $this->GetMessageForClient($idClient, $message_type);
            foreach ($data['messages'] as $key => $value2) {
                if( $value2->categorie == 'prof' ){
                    unset($data['messages'][$key]);
                }
            }  


            return $data; 
        } 
        public function GetMessageForClient($idClient, $message_type)
        {   
            // $query = $this->db->get_where('client',array('adresseMac' => $adresseMac));
            $this->db->select("Cl.idCentre");
            $this->db->from("client as Cl");
            $this->db->join( 'centre as Ce', 'Cl.idCentre = Ce.id'); 
            $this->db->where('Cl.idClient', $idClient); 
            $this->db->where(array('Cl.state' => 1,'Ce.deleted' => 0, 'Cl.deleted' => 0));

            if( isset( $_POST['appname'] ) ){
                $this->db->where(array('Cl.appname'=> $_POST['appname'])); 
            }

            $this->db->group_by("Cl.idCentre");
            $query = $this->db->get(); 
            $results = $query->result();  


            


            $idCentre = array();
            $niveau = array();
            $inscriptionTime = array();
            foreach ($results as $result) {
                $idCentre[] = $result->idCentre;
                // $niveau[] = $result->niveau;
                // $inscriptionTime[] = $result->time;
            } 

            
            

            $Messages = array(); 



            foreach ($idCentre as $key => $value) {
                $this->db->select('
                                    idMessage,
                                    idCentre,
                                    categorie,
                                    message_type,
                                    from, 
                                    idFrom,
                                    type,
                                    destination,
                                    matiere,
                                    content,
                                    niveau,
                                    align,
                                    file,
                                    typeFile,
                                    time,
                                    date,
                                    align,
                                    vu
                                ');
                $this->db->from($this->table);  
                $this->db->where(array( 
                        "state" => 1, 
                        "idCentre" => $idCentre[$key]
                    )
                ); 

                if( $message_type == 'eleve' ){
                    $this->db->where(array( 
                            "forParent" => 0  
                        )
                    ); 
                }
                
                $this->db->order_by('time','DESC');

                $query = $this->db->get(); 

                $result = $query->result();

                $Messages = array_merge($Messages, $result); 

            }
            
            // echo "<pre>";
            //     print_r($Messages);
            // die();
        
           return $Messages;
        } 
        public function GetContentMessageById($idMessage)
        {
            $this->db->select('content');
            $this->db->from($this->table); 
            $this->db->where( array('idMessage' => $idMessage));  
            $query = $this->db->get(); 
            $result = $query->result();

            return $result[0]->content;
        }

        public function GetMessageById($idMessage)
        { 
            
            $query = $this->db->get_where( $this->table ,array('idMessage' => $idMessage) );
            return $query->result()[0];
 
        }

        public function GetMessageHistory($type, $classe, $groupe, $idClient = false)
        {
            switch ($type) {
                case 'prof-to-parent':
                    $this->db->select('time, matiere, content, destination,  align, file, typeFile');
                    $this->db->from($this->table); 
                    $this->db->where(   array(
                                            'from' => 'prof',
                                            'type' => 'groupe',
                                            'niveau' => $this->session->niveau,
                                            'idCentre' => $this->session->id
                                        )
                                    );  
                    $this->db->order_by('time','DESC');

                    $query = $this->db->get(); 
                    $result = $query->result();

                    $Messages = array();
                    foreach ($result as $key => $row) {
                        $destinations = (strpos($row->destination, ',') !== false) ? explode(',',$row->destination) : array($row->destination);
                        foreach ($destinations as  $destination) {
                            if( $destination == $classe."-".$groupe ){
                                $Messages[] = $row;
                            }
                        }  
                    }
                    return $Messages;
                    break; 

                 case 'prof-to-one-parent':
                    
                    $this->db->select('time, matiere, content, destination,  align, type,  file, typeFile');
                    $this->db->from($this->table); 
                    $this->db->where(   array(
                                            'from' => 'prof', 
                                            'niveau' => $this->session->niveau,
                                            'idCentre' => $this->session->id
                                        )
                                    );  
                    $this->db->order_by('time','DESC');

                    $query = $this->db->get(); 
                    $result = $query->result();

                    $Messages = array();
                    foreach ($result as $key => $row) {
                        switch ($row->type) {
                            case 'parent':
                                $destinations = (strpos($row->destination, ',') !== false) ? explode(',',$row->destination) : array($row->destination);
                                foreach ($destinations as  $destination) {
                                    if( $destination == $idClient ){
                                        $Messages[] = $row;
                                    }
                                }   
                                break;
                            
                            case 'groupe':
                                $destinations = (strpos($row->destination, ',') !== false) ? explode(',',$row->destination) : array($row->destination);
                                foreach ($destinations as  $destination) {
                                    if( $destination == $classe."-".$groupe ){
                                        $Messages[] = $row;
                                    }
                                }  
                                break; 
                        }
                    }
                     
                    return $Messages;
                    
                    break; 

                case 'admin-to-one-parent':
                    
                    $this->db->select('time, matiere, content, destination,  align, type, file, typeFile');
                    $this->db->from($this->table); 
                    $this->db->where(   array(
                                            'from' => 'centre', 
                                            'categorie' => 'parent',
                                            'niveau' => $this->session->niveau,
                                            'idCentre' => $this->session->id
                                        )
                                    );  
                    $this->db->order_by('time','DESC');

                    $query = $this->db->get(); 
                    $result = $query->result();

                    $Messages = array();
                    foreach ($result as $key => $row) {
                        switch ($row->type) {
                            case 'parent':
                                $destinations = (strpos($row->destination, ',') !== false) ? explode(',',$row->destination) : array($row->destination);
                                foreach ($destinations as  $destination) {
                                    if( $destination == $idClient ){
                                        $Messages[] = $row;
                                    }
                                }   
                                break;
                            
                            case 'groupe':
                                $destinations = (strpos($row->destination, ',') !== false) ? explode(',',$row->destination) : array($row->destination);
                                foreach ($destinations as  $destination) {
                                    if( $destination == $classe."-".$groupe ){
                                        $Messages[] = $row;
                                    }
                                }  
                                break;

                            case 'classe':
                                $destinations = (strpos($row->destination, ',') !== false) ? explode(',',$row->destination) : array($row->destination);
                                foreach ($destinations as  $destination) {
                                    if( $destination == $classe ){
                                        $Messages[] = $row;
                                    }
                                }  
                                break;

                            case 'all':
                                $Messages[] = $row;
                                break; 
                        }
                    }
                     
                    return $Messages;
                    
                    break;  

                case 'admin-to-one-prof':
                    
                    $Messages = array();
                    $data =   $this->GetMessageFromCentreToOneProf( $idClient );

                    

                    foreach ($data['messages'] as $key => $message) :
                         
                        switch ($message->type) {
                            case 'prof':
                                $tab =  (strpos($message->destination, ',') !== false) ? explode(',', $message->destination) : array($message->destination);

                                if( in_array($data['idProf'], $tab )){
                                    $Messages[] = $data['messages'][$key]; 
                                }
                                break;

                            case 'matiere':
                                $finded = 0;
                                $tab =  (strpos($message->destination, ',') !== false) ? explode(',', $message->destination) : array($message->destination);
                                foreach ($data['matieres'] as $matieres) { 

                                    if (in_array($matieres, $tab)) {
                                        $finded++;
                                    } 
                                }
                                if( $finded > 0 ){
                                    $Messages[] = $data['messages'][$key]; 
                                } 
                                break;

                            case 'classe':
                                $finded = 0;
                                $tab =  (strpos($message->destination, ',') !== false) ? explode(',', $message->destination) : array($message->destination);
                                    
                                foreach ($data['classe'] as $classe) {
                                    if (in_array($classe, $tab)) {
                                        $finded++;
                                    } 
                                } 
                                if( $finded > 0 ){
                                    $Messages[] = $data['messages'][$key]; 
                                } 
                                break;

                            case 'groupe':
                                $finded = 0;
                                $tab =  (strpos($message->destination, ',') !== false) ? explode(',', str_replace('-', '', $message->destination)) : array(str_replace('-', '', $message->destination));

                                foreach ($data['groupe'] as $groupe) {
                                    if (in_array($groupe,$tab )) {
                                        $finded++;
                                    } 
                                }  
                                if( $finded > 0 ){
                                    $Messages[] = $data['messages'][$key]; 
                                } 
                                break;
                                
                            case 'all': 
                                $Messages[] = $data['messages'][$key];
                                break;
                            
                        }
                    endforeach;
                    
                    return $Messages;
                    
                    break; 
            } 
        } 

        public function sendMessageToAdminByProf()
        {
             $array = array(
                    'categorie' => 'prof-admin', 
                    'from' => 'centre', 
                    'idFrom' => $_POST['idCentre'], 
                    'idCentre' => $_POST['idCentre'], 
                    'niveau' => $_POST['niveau'],
                    'type' => 'prof', 
                    'destination' => $_POST['idProf'],  
                    'time' => time(), 
                    'align' => $_POST['align'],
                    'state' =>1,
                    'vu' =>$_POST['idProf']
            );
 
            $array['content'] = json_encode(array(
                array(
                    'from' => 'prof', 
                    'content' => $_POST['message'], 
                    'date' => date('d/m/Y', time()),
                    'align' => $_POST['align']
                )
            ));

            if( $this->db->insert($this->table, $array) ){ 
                return $this->db->insert_id();
            }else{
                return 0;
            }
        }

        public function responseMessageToAdminByProf()
        { 
            if( isset($_POST['idMessage']) ){

                $query = $this->db->get_where($this->table,array('idMessage'=>$_POST['idMessage']));
                $exitingMessages = json_decode( $query->result()[0]->content );
                $exitingMessages[] = array(
                    'from' => 'admin', 
                    'content' => $_POST['message'], 
                    'date' => date('d/m/Y', time()),
                    'align' => $_POST['align']
                );

                $this->db->update(
                        $this->table,  array(
                            "content" => json_encode($exitingMessages),
                            "vu" => ""
                        ),array('idMessage' => $_POST['idMessage'])
                );

                echo 1;
            }
                
        }

        public function responseMessageToAdminByParent()
        { 
            if( isset($_POST['idMessage']) ){ //  

                $this->db->select($this->table.'.*, C.token');
                $this->db->from($this->table);
                $this->db->join('client as C', $this->table.'.destination = C.idClient ');
                $this->db->where($this->table.'.idMessage', $_POST['idMessage']); 
                $query = $this->db->get(); 
                $result = $query->result()[0];

                $exitingMessages = json_decode( $result->content );
                $exitingMessages[] = array(
                    'from' => 'admin', 
                    'content' => $_POST['message'], 
                    'date' => date('d/m/Y', time()),
                    'align' => $_POST['align']
                );

                $this->db->update(
                        $this->table,  array(
                            "content" => json_encode($exitingMessages),
                            "vu" => ""
                        ),array('idMessage' => $_POST['idMessage'])
                );

                $this->push(array(), 'parent', $_POST['message'], 'À votre écoute');

                //////////////// Send Push////////////////////////////////
                

                $this->push(explode("/", $result->token), 'parent', $_POST['message'], 'À votre écoute');
                ////////////////////////////////////////////////

                echo 1;
            }
                
        }

        public function GetMessageProfToAdmin()
        {
            $niveau = $this->session->niveau;

            $this->db->select('
                                M.idMessage,
                                M.type,
                                M.destination,
                                M.matiere,
                                M.content,
                                M.align,
                                M.file,
                                M.typeFile,
                                M.time,
                                M.date,
                                M.state,
                                M.vu,
                                P.nom as prof 
                            ');
            $this->db->from($this->table.' as M');
            $this->db->join( 'prof as P', 'M.destination = P.idProf');
            $this->db->where('M.categorie','prof-admin'); 
            $this->db->where('M.niveau', $this->session->niveau); 

            if( $this->session->usertype == 'admin' ){
                $this->db->where('M.idCentre', $this->session->id); 
            }
            if( $this->session->usertype == 'prof' ){
                $this->db->where('M.destination', $this->session->id); 
            }

            $this->db->order_by('M.time','DESC');

            $query = $this->db->get();

            return $query->result();
        }

        public function GetMessageParentToAdmin()
        { 

            $this->db->select('
                                M.idMessage,
                                M.type,
                                M.destination,
                                M.matiere,
                                M.content,
                                M.align,
                                M.file,
                                M.typeFile,
                                M.time,
                                M.date,
                                M.state,
                                M.vu,
                                C.fname, 
                                C.lname,
                                C.nomParent,
                                C.telParent,
                                C.classe,
                                C.groupe
                            ');
            $this->db->from($this->table.' as M');
            $this->db->join( 'client as C', 'M.destination = C.idClient');
            $this->db->where( array(
                                'M.categorie' => 'parent-admin', 
                                'M.idCentre' => $this->session->id,
                                'M.niveau' => $this->session->niveau
                                ) 
                            );
            $this->db->order_by('M.time','DESC');

            $query = $this->db->get();

            return $query->result();
        }

        public function getMessagesSentToadmin($students)
        {
            $studentsIds = array();
            foreach ($students as $key => $student) {
                $studentsIds[] = $student->idClient;
            }

            $this->db->select($this->table.'.*, C.fname, C.lname, Ce.photo as logoEcole ');
            $this->db->from($this->table);
            $this->db->join('client as C', $this->table.'.destination = C.idClient ');
            $this->db->join('centre as Ce', 'C.idCentre = Ce.id ');
            $this->db->where_in('C.idClient',$studentsIds); 
            $this->db->where($this->table.'.categorie','parent-admin'); 
            $this->db->order_by('time','DESC'); 
            $query = $this->db->get();
            $result = $query->result();

            foreach ($result as $key => $value) {
                $result[$key]->content = json_decode( $value->content );    
                $result[$key]->lastMessage = $value->content[count($value->content )-1];
                $result[$key]->vu = empty($value->vu) ? 0 : 1;
            } 

            return $result;
        }

        public function sendMessageToAdminbyParent( $client )
        {    

            $array = array(
                    'categorie' => 'parent-admin', 
                    'from' => 'centre', 
                    'idFrom' => $client->idCentre, 
                    'idCentre' => $client->idCentre, 
                    'niveau' => $client->niveau,
                    'type' => 'prof', 
                    'destination' => $client->idClient,  
                    'time' => time(), 
                    'align' => $_POST['align'],
                    'state' =>1,
                    'vu' => $client->idClient
            );

            ///new message 
            $array['content'] = json_encode(array(
                array(
                    'from' => 'parent', 
                    'content' => $_POST['message'], 
                    'date' => date('d/m/Y', time()),
                    'align' => $_POST['align']
                )
            ));

            if( $this->db->insert($this->table, $array) ){ 
                echo 1;
            }else{
                return 0;
            }
        }

        public function MessageProfToAdminNonVu()
        {
            $niveau = $this->session->niveau;

            $this->db->select('*');
            $this->db->from($this->table.' as M');
            $this->db->join( 'prof as P', 'M.destination = P.idProf');
            $this->db->where('M.categorie','prof-admin'); 
            $this->db->where('M.niveau', $this->session->niveau); 

            $this->db->where('M.destination', $this->session->id);
            $this->db->where('M.vu', '');

            $this->db->order_by('M.time','DESC');

            $query = $this->db->get();

            return count($query->result());
        }
            
         
} ?>