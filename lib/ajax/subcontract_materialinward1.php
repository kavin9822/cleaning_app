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
    
  $dispatchreturnable1_detail_table = $tablePrefix . 'dispatchreturnable1_detail';
  $dispatchreturnable_table = $tablePrefix . 'dispatchreturnable';
  $workorder_table = $tablePrefix . 'workorder';
  $productionorder_table = $tablePrefix . 'productionorder';
  $employee_table = $tablePrefix . 'employee';
  $product_table = $tablePrefix . 'product';
  $rawmaterial_table = $tablePrefix . 'rawmaterial';
  $subcontractor_materialinward_table = $tablePrefix . 'subcontractor_materialinward';
  $submat_inward_detail_table = $tablePrefix . 'submat_inward_detail';
   
  $entityID = $ajxSess->get('user')['entity_ID'];
    
//   $sql_query ="SELECT DISTINCT $submat_inward_detail_table.pending_qty,$dispatchreturnable1_detail_table.Quantity1,$rawmaterial_table.id as item_id,$rawmaterial_table.RMName FROM $dispatchreturnable_table
//                 LEFT JOIN $dispatchreturnable1_detail_table ON $dispatchreturnable_table.ID=$dispatchreturnable1_detail_table.Dispatchreturn_ID 
//                 LEFT JOIN $rawmaterial_table ON $rawmaterial_table.ID=$dispatchreturnable1_detail_table.rawmaterial_ID 
//                 LEFT JOIN $subcontractor_materialinward_table ON $subcontractor_materialinward_table.DispatchID=$dispatchreturnable_table.ID
//                 LEFT JOIN $submat_inward_detail_table ON $submat_inward_detail_table.Rawmaterial_ID=$rawmaterial_table.ID
//                 WHERE  $dispatchreturnable1_detail_table.Dispatchreturn_ID=".$_POST['ColumnValue']." AND $dispatchreturnable1_detail_table.Dispatchreturn_ID=".$_POST['DispatchID']."";

                           
                $sql_query ="SELECT DISTINCT
                              $submat_inward_detail_table.pending_qty,
                              $dispatchreturnable1_detail_table.Quantity1,
                              $rawmaterial_table.id AS item_id,
                              $rawmaterial_table.RMName
                              FROM $dispatchreturnable_table
                              LEFT JOIN $dispatchreturnable1_detail_table
                              ON $dispatchreturnable_table.ID = $dispatchreturnable1_detail_table.Dispatchreturn_ID
                              LEFT JOIN $rawmaterial_table
                              ON $rawmaterial_table.ID = $dispatchreturnable1_detail_table.rawmaterial_ID
                              LEFT JOIN $subcontractor_materialinward_table
                              ON $subcontractor_materialinward_table.DispatchID = $dispatchreturnable_table.ID
                              LEFT JOIN (
                              SELECT
                              MAX($submat_inward_detail_table.id) AS max_id,
                              $submat_inward_detail_table.Rawmaterial_ID,
                              $submat_inward_detail_table.DispatchID
                              FROM $submat_inward_detail_table
                              GROUP BY $submat_inward_detail_table.Rawmaterial_ID, $submat_inward_detail_table.DispatchID
                              ) latest_submat_inward_detail
                              ON latest_submat_inward_detail.Rawmaterial_ID = $rawmaterial_table.ID
                              AND latest_submat_inward_detail.DispatchID = $dispatchreturnable1_detail_table.Dispatchreturn_ID
                              LEFT JOIN $submat_inward_detail_table
                              ON $submat_inward_detail_table.id = latest_submat_inward_detail.max_id
                              AND $submat_inward_detail_table.DispatchID = $dispatchreturnable1_detail_table.Dispatchreturn_ID WHERE $dispatchreturnable1_detail_table.Dispatchreturn_ID=".$_POST['ColumnValue']." AND $dispatchreturnable1_detail_table.Dispatchreturn_ID=".$_POST['DispatchID']."";
                              
    
    	try {
                $stmt = $Db->prepare($sql_query);
            //   $stmt1 = $Db->prepare($sql_query1);
              // var_dump($sql_query);
                if ($stmt->execute()) {

                $Data_rows = $stmt->fetchAll(2);
              //  $Data_rows1 = $stmt1->fetchAll(2);
               
                if($Data_rows){
		            http_response_code();		                 
                 echo json_encode($Data_rows);
                 }else{
        	 	http_response_code(204);
        	 	echo json_encode(array('noData' => 'noData'));
    		    }   
    		    
    		  //   if($Data_rows1){
		      //      http_response_code();		                 
        //          echo json_encode($Data_rows1);
        //          }else{
        // 	 	http_response_code(204);
        // 	 	echo json_encode(array('noData' => 'noData'));
    		  //  }  
                    
                } else {
                  http_response_code(204);
                }
            } catch (Exception $exc) {
              http_response_code(500);
            }
    }
        

}