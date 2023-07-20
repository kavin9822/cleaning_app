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
    
	$inventory_transfer_table = $tablePrefix . 'inventory_transfer';
	$inventory_transfer_detail_table = $tablePrefix . 'inventory_transfer_detail';
  $rawmaterial_table = $tablePrefix . 'rawmaterial';
  $unit_table = $tablePrefix . 'unit';
   $stock_table = $tablePrefix . 'stock';
     $entity_table = $tablePrefix . 'entity';
   
    
    $entityID = $ajxSess->get('user')['entity_ID'];
    
  
//   $sql_query ="SELECT $inventory_transfer_table.from_warehouse,
//                   $inventory_transfer_table.to_warehouse,
//                   $rawmaterial_table.RMName,
//                   $inventory_transfer_detail_table.item_name,
//                   $inventory_transfer_detail_table.batch_no,
//                   $stock_table.available_qty,
//                   $inventory_transfer_detail_table.transfer_quantity,
//                   $inventory_transfer_detail_table.unit_id,
//                   $unit_table.UnitName
                  
//               FROM $inventory_transfer_table,
//                   $inventory_transfer_detail_table, 
//                   $rawmaterial_table,
//                   $unit_table,
//                   $stock_table
//              WHERE $inventory_transfer_detail_table.inventory_transfer_ID=$inventory_transfer_table.ID AND  
//                   $inventory_transfer_detail_table.item_name=$rawmaterial_table.ID AND
//                   $inventory_transfer_detail_table.item_name=$stock_table.rawmaterial_id AND
//                   $inventory_transfer_detail_table.unit_id=$unit_table.ID AND 
//                   $stock_table.entity_ID = $entityID AND
//                   $inventory_transfer_table.ID=".$_POST['ColumnValue']."";

                 $sql_query ="SELECT 
                    from_inventory.Title AS from_title,
                    to_inventory.Title AS to_title,
                    $rawmaterial_table.RMName,
                    $inventory_transfer_detail_table.item_name,
                    $inventory_transfer_detail_table.batch_no,
                    $stock_table.available_qty,
                    $inventory_transfer_detail_table.transfer_quantity,
                    $inventory_transfer_detail_table.unit_id,
                    $unit_table.UnitName

                    FROM $inventory_transfer_table
                    INNER JOIN  $inventory_transfer_detail_table ON  $inventory_transfer_table.ID=$inventory_transfer_detail_table.inventory_transfer_ID
                    INNER JOIN  $rawmaterial_table ON $inventory_transfer_detail_table.item_name=$rawmaterial_table.ID
                    INNER JOIN  $stock_table ON $inventory_transfer_detail_table.item_name=$stock_table.rawmaterial_id
                    INNER JOIN  $unit_table ON $inventory_transfer_detail_table.unit_id=$unit_table.ID
                    INNER JOIN  $entity_table AS from_inventory ON $inventory_transfer_table.from_warehouse = from_inventory.ID
                    INNER JOIN  $entity_table AS to_inventory ON  $inventory_transfer_table.to_warehouse=to_inventory.ID
                    
                    WHERE
                    $stock_table.entity_ID = $entityID AND
                    $inventory_transfer_table.ID=".$_POST['ColumnValue'].""; 

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