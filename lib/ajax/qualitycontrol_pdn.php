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

if($_POST["WorkorderID"]){
    
	$workorder_table = $tablePrefix . 'workorder';
  $employee_table = $tablePrefix . 'employee';
  $supplier_table = $tablePrefix . 'supplier';
   
    
    $entityID = $ajxSess->get('user')['entity_ID'];
    
  
    $sql_query ="SELECT $workorder_table.CompletedDate,$employee_table.EmpName,$supplier_table.SupplierName FROM $workorder_table 
                 LEFT JOIN $employee_table ON $employee_table.ID=$workorder_table.EmployeeID
                 LEFT JOIN $supplier_table ON $supplier_table.ID=$workorder_table.Subcontractor_ID WHERE $workorder_table.ID='".$_POST['WorkorderID']."'";
	
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