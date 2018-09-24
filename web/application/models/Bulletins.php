<?php  
class Bulletins extends CI_Model {


	public function sendBulletins()
    {
        $config = array(
            "upload_path" => 'assets/bulltins/',
            "allowed_types" => 'pdf'
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

            $nbrBultins =  $this->split_pdf( $upload_data['file_name']);
            unlink($config["upload_path"].$upload_data['file_name']);
            
            if( $nbrBultins > 0 ){

                return array(
                    "success" => true,
                    "sentBulletins" => $nbrBultins
                );
            }else{
                return array(
                    "success" => false,
                    "msg" => "Ce fichier pdf ne contient aucun bulletin."
                );
            }
        }else{
            return array(
                "success" => false,
                "msg" => $upload_data['msg']
            );
        }

    }/////////////////////// 


    public function split_pdf($filename)
	{
		require_once(APPPATH.'libraries/fpdf/fpdf.php');
		require_once(APPPATH.'libraries/fpdi/fpdi.php');
		//require_once('fpdg/PdfToText.phpclass' ) ;
		
		$end_directory = 'assets/bulltins/';
		$splites_directory = $end_directory."splites/";

		$new_path = preg_replace('/[\/]+/', '/', $end_directory.'/'.substr($filename, 0, strrpos($filename, '/')));
		
		if (!is_dir($new_path)) { mkdir($new_path, 0777, true); }
		$pdf = new FPDI();
		$pagecount = $pdf->setSourceFile($end_directory.$filename); 
 		
 		
 		$sentBulletins = 0;

		for ($i = 1; $i <= $pagecount; $i++) {
			$new_pdf = new FPDI();
			$new_pdf->AddPage();
			$new_pdf->setSourceFile($end_directory.$filename);
			$new_pdf->useTemplate($new_pdf->importPage($i));
			try {

				$new_filename = $splites_directory.time().".pdf";
				$new_pdf->Output($new_filename, "F");
 
 				//////////////////////////////////////////
 				if( $this->renamePDF( $new_filename, $splites_directory ) ){
 					$sentBulletins++;
 				} 
				//////////////////////////////////////////
				


			}catch (Exception $e) {
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
		}

		return $sentBulletins; 

	}

	public function renamePDF( $filename, $destination_directory )
	{
		require_once(APPPATH.'libraries/fpdg/PdfToText.phpclass' ) ;


		$xml_file	=  APPPATH."libraries/fpdg/xml/info.xml" ;
		$ptot		=  new PdfToText ( $filename, PdfToText::PDFOPT_CAPTURE ) ;
		$ptot -> SetCaptures ( $xml_file ) ;
		$captures	=  $ptot -> GetCaptures ( ) ;
		$NotClearedString = $captures -> Title [1];
		 
		$slug ="";

		if( strpos($NotClearedString,"G ") !== false){
		 $slug = "G";
		}elseif (strpos($NotClearedString,"L ") !== false) {
		 $slug = "L";
		}elseif (strpos($NotClearedString,"X ") !== false) {
		 $slug = "X";
		}elseif (strpos($NotClearedString,"A ") !== false) {
		 $slug = "A";
		}elseif (strpos($NotClearedString,"B ") !== false) {
		 $slug = "B";
		}elseif (strpos($NotClearedString,"C ") !== false) {
		 $slug = "C";
		}elseif (strpos($NotClearedString,"D ") !== false) {
		 $slug = "D";
		}elseif (strpos($NotClearedString,"E ") !== false) {
		 $slug = "E";
		}elseif (strpos($NotClearedString,"F ") !== false) {
		 $slug = "F";
		}elseif (strpos($NotClearedString,"H ") !== false) {
		 $slug = "H";
		}elseif (strpos($NotClearedString,"I ") !== false) {
		 $slug = "I";
		}elseif (strpos($NotClearedString,"J ") !== false) {
		 $slug = "J";
		}elseif (strpos($NotClearedString,"K ") !== false) {
		 $slug = "K";
		}elseif (strpos($NotClearedString,"M ") !== false) {
		 $slug = "M";
		}elseif (strpos($NotClearedString,"N ") !== false) {
		 $slug = "N";
		}elseif (strpos($NotClearedString,"O ") !== false) {
		 $slug = "O";
		}elseif (strpos($NotClearedString,"P ") !== false) {
		 $slug = "P";
		} elseif (strpos($NotClearedString,"Q ") !== false) {
		 $slug = "Q";
		} elseif (strpos($NotClearedString,"R ") !== false) {
		 $slug = "R";
		} elseif (strpos($NotClearedString,"S ") !== false) {
		 $slug = "S";
		} elseif (strpos($NotClearedString,"T ") !== false) {
		 $slug = "T";
		} elseif (strpos($NotClearedString,"V ") !== false) {
		 $slug = "V";
		} elseif (strpos($NotClearedString,"U ") !== false) {
		 $slug = "U";
		} elseif (strpos($NotClearedString,"W ") !== false) {
		 $slug = "W";
		} elseif (strpos($NotClearedString,"Y ") !== false) {
		 $slug = "Y";
		} elseif (strpos($NotClearedString,"Z ") !== false) {
		 $slug = "Z";
		} 

		if ($slug !="") {
			$clearedString = $this->GetBetween("$slug "," ",$NotClearedString);
			$StudentID = "$slug" . $clearedString ; 
 
			rename($filename, $destination_directory . "$StudentID.pdf");

			$currentTime = time();
			$finaleFile = $currentTime."_bulletin_$StudentID.pdf";

			if( copy($destination_directory . "$StudentID.pdf", 'assets/upload/'.$finaleFile) ){

				unlink($destination_directory . "$StudentID.pdf");

				//////////////////////////////////////////////////////////////////////// 
				//////////////////////////////////////////////////////////////////////// 
				//////////////////////////////////////////////////////////////////////// 
				//////////////////////////////////////////////////////////////////////// 
				//////////////////////////////////////////////////////////////////////// 
				//////////////////////////////////////////////////////////////////////// 
				$this->load->model('Messages');
				$this->load->model('Client');

				if( $this->Client->getIdClientByCode( $StudentID ) ){
					$array = array(
		                    'categorie' => 'parent', 
		                    'from' => 'centre', 
		                    'idFrom' => $this->session->id, 
		                    'idCentre' => $this->session->id, 
		                    'niveau' => $this->session->niveau,
		                    'type' => "parent", 
		                    'destination' => $this->Client->getIdClientByCode( $StudentID ), 
		                    'content' => $_POST['content'], 
		                    'file' => $finaleFile, 
		                    'typeFile' => "notImage",  
		                    'time' => $currentTime, 
		                    'state' =>1, 
		                    'align' =>( isset($_POST['align']) ) ? $_POST['align'] : 'left'
		            );

		            if( $this->db->insert("messages", $array) ){
		                $idMessage = $this->db->insert_id();
		                $this->Messages->SendPuchToParents( $idMessage );
		                return true;
		            }else{
		            	unlink('assets/upload/'.$finaleFile);
		                return false;
		            }
				}else{
					unlink('assets/upload/'.$finaleFile);
					return false;
				} 
				//////////////////////////////////////////////////////////////////////// 
				//////////////////////////////////////////////////////////////////////// 
				//////////////////////////////////////////////////////////////////////// 
				//////////////////////////////////////////////////////////////////////// 
				//////////////////////////////////////////////////////////////////////// 

				 
			} 
		}else{
			unlink($filename);
			return false;
		} 
	}

	public function GetBetween($var1="",$var2="",$pool){
		$temp1 = strpos($pool,$var1)+strlen($var1);
		$result = substr($pool,$temp1,strlen($pool));
		$dd=strpos($result,$var2);
		if($dd == 0){
		$dd = strlen($result);
		}
		return substr($result,0,$dd);
	}



} ?>