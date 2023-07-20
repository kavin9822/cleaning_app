<?php

/*
 * Production - linux
 */
include_once'./set_inc_path.php';

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

if($_POST["ColumnValue"]){
    
	$tenderdetail_table = $tablePrefix . 'tenderdetail';
	$tender_table = $tablePrefix . 'tender';
	$users_table = $tablePrefix . 'users';
   
    
    $entityID = $ajxSess->get('user')['entity_ID'];
    
  
    $sql_query ="SELECT $tenderdetail_table.Title,$tenderdetail_table.Qty,$users_table.user_nicename FROM $tender_table LEFT JOIN $tenderdetail_table ON $tenderdetail_table.tender_ID=$tender_table.ID LEFT JOIN $users_table ON $users_table.ID=$tender_table.users_ID WHERE $tenderdetail_table.tender_ID=".$_POST['ColumnValue']."";
	
    	try {
                $stmt = $Db->prepare($sql_query);
              // var_dump($sql_query);
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

}