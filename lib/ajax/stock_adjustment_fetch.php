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
    
	
	// $supplier_table = $tablePrefix . 'supplier';
  $stock_table = $tablePrefix . 'stock';
  $purchaseorderdetail_table = $tablePrefix . 'purchaseorderdetail';
  $material_inward_table = $tablePrefix . 'material_inward';
  $material_inward_detail_table = $tablePrefix . 'material_inward_detail';
  $stockadjustment_table = $tablePrefix . 'stockadjustment';
  $rawmaterial_table = $tablePrefix . 'rawmaterial';

	
   
    
    $entityID = $ajxSess->get('user')['entity_ID'];
    
  
     
  // $sql_query ="SELECT $material_inward_detail_table.batch_no FROM $stockadjustment_table 
  //                 inner JOIN $rawmaterial_table ON $stockadjustment_table.item_name = $rawmaterial_table.ID 
  //                 LEFT JOIN $purchaseorderdetail_table ON $purchaseorderdetail_table.rawmaterial_ID = $rawmaterial_table.ID
  //                 LEFT JOIN $purchaseorder_table ON $purchaseorderdetail_table.purchaseorder_ID = $purchaseorder_table.ID
  //                 LEFT JOIN $material_inward_table ON $purchaseorder_table.ID = $material_inward_table.PurchaseNO
  //                 LEFT JOIN $material_inward_detail_table ON $material_inward_table.ID = $material_inward_detail_table.material_inward_id 

  //                 WHERE $rawmaterial_table.ID=".$_POST['ColumnValue']." AND $material_inward_detail_table.batch_no IS NOT NULL"; 

       $sql_query ="SELECT $stock_table.batch_no,$stock_table.available_qty 
              FROM 
                $stock_table
             WHERE
                $stock_table.rawmaterial_id=".$_POST['ColumnValue']." AND entity_ID = $entityID";         


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