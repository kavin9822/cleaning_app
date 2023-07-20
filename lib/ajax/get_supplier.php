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

//  echo $_POST['poid'];

if($_POST["supid"]){

    $supplier_tab = $tablePrefix . 'supplier';
    $state_tab = $tablePrefix . 'state';
 
    $sql_query = " SELECT $supplier_tab.ID,$supplier_tab.AddressLine1,$supplier_tab.AddressLine2,$supplier_tab.City,$state_tab.StateName FROM  $supplier_tab,$state_tab WHERE $state_tab.ID=$supplier_tab.state_ID AND $supplier_tab.ID = ".$_POST['supid']." " ;    


    	try {
                $stmt = $Db->prepare($sql_query);
                if ($stmt->execute()) {

                $Data_rows = $stmt->fetchAll(2);

                // echo $Data_rows ;
                // die;
               
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