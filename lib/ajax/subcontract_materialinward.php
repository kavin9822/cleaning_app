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
    if($_POST["DispatchID"]){
    
	$dispatchreturnable_detail_table = $tablePrefix . 'dispatchreturnable_detail';
  $dispatchreturnable_table = $tablePrefix . 'dispatchreturnable';
  $workorder_table = $tablePrefix . 'workorder';
  $productionorder_table = $tablePrefix . 'productionorder';
  $employee_table = $tablePrefix . 'employee';
  $rawmaterial_table = $tablePrefix . 'rawmaterial';

  $product_table = $tablePrefix . 'product';
   
  $entityID = $ajxSess->get('user')['entity_ID'];
    
  
   $sql_query ="SELECT $product_table.ID,$rawmaterial_table.RMName,$dispatchreturnable_detail_table.Quantity,$product_table.ProductName FROM $dispatchreturnable_table 
                LEFT JOIN $dispatchreturnable_detail_table ON $dispatchreturnable_table.ID=$dispatchreturnable_detail_table.Dispatchreturn_ID 
                LEFT JOIN $rawmaterial_table ON $rawmaterial_table.ID=$dispatchreturnable_detail_table.Rawmaterial_ID 
                LEFT JOIN $product_table ON $product_table.ID=$dispatchreturnable_table.product_ID 
                WHERE $dispatchreturnable_detail_table.Dispatchreturn_ID=".$_POST['ColumnValue']." AND $dispatchreturnable_detail_table.Dispatchreturn_ID=".$_POST['DispatchID']."";

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
}