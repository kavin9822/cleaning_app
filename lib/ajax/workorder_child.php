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
    
	$bomprocessdetail_table = $tablePrefix . 'BOMProcessDetail';
  $rawmaterial_table = $tablePrefix . 'rawmaterial';
  $unit_table = $tablePrefix . 'unit';
  $customerorder_detail_table = $tablePrefix . 'customerorder_detail';
  $product_table = $tablePrefix . 'product';
  $productionorder_table = $tablePrefix . 'productionorder';
  $process_table = $tablePrefix . 'ProcessMaster';

  $enquiry_table = $tablePrefix . 'enquiry';
   
  $entityID = $ajxSess->get('user')['entity_ID'];
    
  /*
   $sql_query ="SELECT *,$product_table.ProductName,$rawmaterial_table.RMName,$bomprocessdetail_table.Quantity,$unit_table.UnitName FROM $customerorder_detail_table
                LEFT JOIN $product_table ON $product_table.ID=$customerorder_detail_table.Product_ID

                LEFT JOIN $unit_table ON $unit_table.ID=$bomprocessdetail_table.unit_ID  
                LEFT JOIN $customerorder_detail_table ON $customerorder_detail_table.unit_ID=$bomprocessdetail_table.unit_ID  
                WHERE $productionorder_table.ID=".$_POST['ColumnValue']."";*/

        // $sql_query ="SELECT $product_table.ProductName,
        //                           $rawmaterial_table.RMName,
        //                           $bomprocessdetail_table.Quantity,
        //                           $unit_table.UnitName 
        //                           FROM $enquiry_table 
        //                           LEFT JOIN $productionorder_table ON $enquiry_table.ID=$productionorder_table.enquiry_ID 
        //                           RIGHT JOIN $bomprocessdetail_table ON $bomprocessdetail_table.rawmaterial_ID=$rawmaterial_table.ID 
        //                           INNER JOIN $rawmaterial_table ON $rawmaterial_table.ID=$bomprocessdetail_table.rawmaterial_ID 
        //                           INNER JOIN $unit_table ON $unit_table.ID=$bomprocessdetail_table.unit_ID 
        //                           INNER JOIN $customerorder_detail_table ON $customerorder_detail_table.unit_ID=$unit_table.ID 
        //                           INNER JOIN $product_table ON $product_table.ID=$customerorder_detail_table.Product_ID 
        //                           WHERE $productionorder_table.ID=".$_POST['ColumnValue']."";

       $sql_query ="SELECT $product_table.ProductName,
                            $rawmaterial_table.RMName,
                            $bomprocessdetail_table.Quantity,
                            $unit_table.UnitName,
                            $process_table.ProcessName  
                            FROM $enquiry_table,$productionorder_table,$bomprocessdetail_table,$rawmaterial_table,$unit_table,$customerorder_detail_table,$product_table,$process_table
                            WHERE $enquiry_table.ID=$productionorder_table.enquiry_ID AND
                            $bomprocessdetail_table.rawmaterial_ID=$rawmaterial_table.ID AND
                            $rawmaterial_table.ID=$bomprocessdetail_table.rawmaterial_ID AND
                            $unit_table.ID=$bomprocessdetail_table.unit_ID AND
                            $customerorder_detail_table.unit_ID=$unit_table.ID AND
                            $product_table.ID=$customerorder_detail_table.Product_ID AND
                            $process_table.ID=$bomprocessdetail_table.process_ID AND
                            $productionorder_table.ID=".$_POST['ColumnValue']."";

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