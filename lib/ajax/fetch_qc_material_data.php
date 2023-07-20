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
    
  $supplier_table = $tablePrefix . 'supplier';
  $purchaseorder_table = $tablePrefix . 'purchaseorder';
  $material_inward_table = $tablePrefix . 'material_inward';
  $purchaseindent_table = $tablePrefix . 'purchaseindent';

  $rawmaterial_table = $tablePrefix . 'rawmaterial';
  $material_inward_detail_table = $tablePrefix . 'material_inward_detail';
  $unit = $tablePrefix . 'unit';
    
    $entityID = $ajxSess->get('user')['entity_ID'];


      $sql_query ="SELECT 
                            $material_inward_detail_table.item_id,
                            $rawmaterial_table.RMName, 
                            $material_inward_detail_table.received_qty, 
                            $material_inward_detail_table.unit,
                            $unit.UnitName,
                            $material_inward_detail_table.received_qt_in_kg,
                            $material_inward_detail_table.batch_no, 
                            $material_inward_detail_table.supplier_invoice_no, 
                            $material_inward_detail_table.material_quantity_stat, 
                            $material_inward_detail_table.invoice_date
                      FROM 
                            $material_inward_table, 
                            $material_inward_detail_table,
                            $rawmaterial_table,
                            $unit
                           
                      WHERE 
                            $material_inward_table.ID = $material_inward_detail_table.material_inward_id
                      AND   $material_inward_detail_table.item_id = $rawmaterial_table.ID  
                      AND   $material_inward_detail_table.unit = $unit.ID 
                      AND   $material_inward_detail_table.ItemStatus = 1
                      AND   $material_inward_table.entity_ID = $entityID
                      AND   $material_inward_table.ID=".$_POST['ColumnValue']."";   
                      
                      //   AND   $material_inward_detail_table.received_qty >= $material_inward_detail_table.material_quantity_stat 

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