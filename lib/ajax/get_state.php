<?php

/*
 * Production - linux
 */

include_once './set_inc_path.php';

include_once 'util/ses.php';
$ajxSess = new Session();

include_once 'PhpRbac/database/database.config';

try {
    $Db = new PDO("mysql:host={$host};dbname={$dbname}", $user, $pass);
} catch (Exception $exc) {
    
}


header('Content-Type: application/json');


/*
 * make sures you can call only from the host we set
 * and only post request
 * so you cant access the script directly from url
 */
 
 $state_tab = $tablePrefix . 'state';
   

if(!empty($_POST["StateVal"])){

    //$entityID = $ajxSess->get('user')['entity_ID'];
  
    $sql_query  = "SELECT $state_tab.ID,$state_tab.StateName FROM $state_tab WHERE $state_tab.ID=".$_POST['StateVal']."";
}else{
     $sql_query  = "SELECT $state_tab.ID,$state_tab.StateName FROM $state_tab WHERE 1";
}
    	try {
                $stmt = $Db->prepare($sql_query);
                if ($stmt->execute()) {

                $Data_rows = $stmt->fetchAll(2);
               
                if($Data_rows){
		            http_response_code();		                 
                 echo json_encode($Data_rows);
                 }else{
        	 	http_response_code(204);
        	 	echo json_encode(array('noData' => 'noData'));
    		    }   
                    
                } else {
                   http_response_code(204);
                }
            } catch (Exception $exc) {
               http_response_code(500);
            }