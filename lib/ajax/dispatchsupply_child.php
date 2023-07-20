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
    
  $customerorder_detail_table = $tablePrefix . 'customerorder_detail';
  $product_table = $tablePrefix . 'product';
  $customerorder_table = $tablePrefix . 'customerorder';
  $enquiry_table = $tablePrefix . 'enquiry';
  $productionorder_table = $tablePrefix . 'productionorder';
  $fgstock_table = $tablePrefix . 'fgstock';
  $dispatch_supply_detail_table = $tablePrefix . 'dispatch_supply_detail';
   
  $entityID = $ajxSess->get('user')['entity_ID'];
    
//   $sql_query ="SELECT $product_table.ID as product_ID,$product_table.ProductName,$customerorder_detail_table.Quantity,$fgstock_table.available_qty,$dispatch_supply_detail_table.pending_qty FROM $enquiry_table 
//                 LEFT JOIN $customerorder_table ON $customerorder_table.enquiry_ID=$enquiry_table.ID
//                 LEFT JOIN $customerorder_detail_table ON $customerorder_detail_table.custorder_ID=$customerorder_table.ID
//                 LEFT JOIN $product_table ON $customerorder_detail_table.Product_ID=$product_table.ID
//                 LEFT JOIN $fgstock_table ON $fgstock_table.product_ID=$product_table.ID
//                 LEFT JOIN $productionorder_table ON $productionorder_table.enquiry_ID=$enquiry_table.ID
//                 LEFT JOIN $dispatch_supply_detail_table ON $dispatch_supply_detail_table.product_ID=$product_table.ID
//                 WHERE $productionorder_table.ID=".$_POST['ColumnValue']."";
                
//   $sql_query ="SELECT DISTINCT $product_table.ID as product_ID,$product_table.ProductName,$customerorder_detail_table.Quantity,$fgstock_table.available_qty,$dispatch_supply_detail_table.pending_qty FROM $enquiry_table 
//                               LEFT JOIN $customerorder_table ON $customerorder_table.enquiry_ID=$enquiry_table.ID
//                               LEFT JOIN $customerorder_detail_table ON $customerorder_detail_table.custorder_ID=$customerorder_table.ID
//                               LEFT JOIN $product_table ON $customerorder_detail_table.Product_ID=$product_table.ID
//                               LEFT JOIN $fgstock_table ON $fgstock_table.product_ID=$product_table.ID
//                               LEFT JOIN $productionorder_table ON $productionorder_table.enquiry_ID=$enquiry_table.ID
//                               LEFT JOIN (
//                               SELECT
//                               MAX($dispatch_supply_detail_table.id) AS max_id,
//                               $dispatch_supply_detail_table.product_ID,
//                               $dispatch_supply_detail_table.production_ID
//                               FROM $dispatch_supply_detail_table
//                               GROUP BY $dispatch_supply_detail_table.product_ID, $dispatch_supply_detail_table.production_ID
//                               ) latest_dispatch_supply_detail
//                               ON latest_dispatch_supply_detail.product_ID = $product_table.ID
//                               AND latest_dispatch_supply_detail.production_ID = $productionorder_table.ID
//                               LEFT JOIN $dispatch_supply_detail_table
//                               ON $dispatch_supply_detail_table.production_ID = latest_dispatch_supply_detail.max_id
//                               AND $dispatch_supply_detail_table.production_ID = $productionorder_table.ID WHERE $productionorder_table.ID=".$_POST['ColumnValue']."";

                           $sql_query ="SELECT
                                        DISTINCT $product_table.ID as product_ID,
                                        $product_table.ProductName,
                                        $customerorder_detail_table.Quantity,
                                        $fgstock_table.available_qty,
                                        $dispatch_supply_detail_table.pending_qty
                                        FROM $enquiry_table
                                        LEFT JOIN $customerorder_table ON $customerorder_table.enquiry_ID = $enquiry_table.ID
                                        LEFT JOIN $customerorder_detail_table ON $customerorder_detail_table.custorder_ID = $customerorder_table.ID
                                        LEFT JOIN $product_table ON $customerorder_detail_table.Product_ID = $product_table.ID
                                        LEFT JOIN $fgstock_table ON $fgstock_table.product_ID = $product_table.ID
                                        LEFT JOIN $productionorder_table ON $productionorder_table.enquiry_ID = $enquiry_table.ID
                                        LEFT JOIN (
                                        SELECT
                                        MAX(dsd.id) AS max_id,
                                        dsd.product_ID,
                                        dsd.production_ID
                                        FROM $dispatch_supply_detail_table dsd
                                        GROUP BY dsd.product_ID, dsd.production_ID
                                        ) latest_dispatch_supply_detail ON
                                        latest_dispatch_supply_detail.product_ID = $product_table.ID
                                        AND latest_dispatch_supply_detail.production_ID = $productionorder_table.ID
                                        LEFT JOIN $dispatch_supply_detail_table ON
                                        $dispatch_supply_detail_table.id = latest_dispatch_supply_detail.max_id
                                        AND $dispatch_supply_detail_table.production_ID = latest_dispatch_supply_detail.production_ID
                                        AND $dispatch_supply_detail_table.product_ID = latest_dispatch_supply_detail.product_ID WHERE $productionorder_table.ID=".$_POST['ColumnValue']." AND $fgstock_table.entity_ID=$entityID";

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
