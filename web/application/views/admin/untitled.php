<?php
function str_features($string){
   if(strlen($string) > 0){
   $nlbr = nl2br($string);
   $newstr = explode("<br />", $nlbr);
   $output = array_slice($newstr, 1);
   foreach ($output as $key => $value) {
   	if(empty( trim( $value ) ) ){
   		unset( $output[$key] );
	}else{
		$output[$key] = str_replace('•', '', str_replace('• ', '', $value));
	}
   }
   $final = implode("||", $output);
   $strfinale = $final;
   }else{
      $strfinale = "";
   }
   return $strfinale;
}

 function get_statu($sta){
    if(strlen($sta) > 0){
        $statu = "publish";
    }else{
        $statu = "draft";
    }
    return $statu;
 }

 
 

function produitActif($statu){

   $status = strtolower($statu);

   if(strlen($status) > 0){
      $stat = 1;
   }else{
      $stat = 0;
   }
   return $stat;
}

function getCategory($cat){
    $term = strtolower(trim($cat));
	if(ICL_LANGUAGE_CODE == "fr"){
		    if($term == "manette"){
		        $term = "manettes-e-sport";
		    }elseif($term == "mouse"){
		        $term = "souris";
		    }elseif($term == "clavier"){
		        $term = "claviers";
		    }elseif($term == "casque"){
		        $term = "casques";
		    }else{
		        $term = "accessoires";
		    }

	}elseif(ICL_LANGUAGE_CODE == "es"){
		    if($term == "gamepads"){
		        $term = "gamepads-e-sport_es";
		    }elseif($term == "ratones-de-juegos"){
		        $term = $term."_es";
		    }elseif($term == "teclados"){
		        $term = $term."_es";
		    }elseif($term == "headsets"){
		        $term = $term."_es";
		    }else{
		        $term = "accesorios_es";
		    }

	}elseif(ICL_LANGUAGE_CODE == "it"){
	    if($term == "gamepads"){
	        $term = "gamepads-e-sport_it";
	    }elseif($term == "mouse"){
	        $term = $term."_it";
	    }elseif($term == "tastiere"){
	        $term = $term."_it";
	    }elseif($term == "cuffie"){
	        $term = $term."_it";
	    }else{
	        $term = "accessori_it";
	    }

	}elseif(ICL_LANGUAGE_CODE == "en"){
	    if($term == "gamepads"){
	        $term = "gamepads-e-sport";
	    }elseif($term == "headsets"){
	        $term = $term;
	    }elseif($term == "keyboards"){
	        $term = $term;
	    }elseif($term == "mouse"){
	        $term = $term;
	    }else{
	        $term = "accessories";
	    }
	    
	}elseif(ICL_LANGUAGE_CODE == "de"){
	    if($term == "gamepads"){
	        $term = "controllers-e-sport_de";
	    }elseif($term == "headsets"){
	        $term = $term."_de";
	    }elseif($term == "keyboards"){
	        $term = $term."_de";
	    }elseif($term == strtolower("GAMING-M€USE")){
	        $term = "gaming-mause";
	    }else{
	        $term = "zubehor";

	    }
	}

    return $term;
}

function getLang($ref)
{
	if( $ref == 'PS4OFPADREVFRNL'){
		return ICL_LANGUAGE_CODE;
	}
}


?>