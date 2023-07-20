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
    
	$enquiry_table = $tablePrefix . 'enquiry';
	$customer_table = $tablePrefix . 'customer';
	$state_table = $tablePrefix . 'state';
	
   
    
    $entityID = $ajxSess->get('user')['entity_ID'];
    
  
  $sql_query ="SELECT $enquiry_table.PONo,$customer_table.PersonName, $customer_table.CompanyName,$customer_table.GSTNo, $customer_table.BillingAddress1,$customer_table.BillingAddress2,$customer_table.BillingCity, $state_table.StateName, $customer_table.BillingZip FROM $enquiry_table LEFT JOIN $customer_table ON  $customer_table.ID = $enquiry_table.customer_ID LEFT JOIN $state_table ON $customer_table.BillingState_ID = $state_table.ID WHERE $enquiry_table.ID=".$_POST['ColumnValue']."";  

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