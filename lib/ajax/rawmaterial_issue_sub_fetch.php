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
    
	$workorder_table = $tablePrefix . 'workorder';
  $processmaster_table = $tablePrefix . 'ProcessMaster';
  $employee_table = $tablePrefix . 'employee';

  $bomprocessmaster_table = $tablePrefix . 'BOMProcessMaster';
  $bomprocessdetail_table = $tablePrefix . 'BOMProcessDetail';
  $rawmaterial_table = $tablePrefix . 'rawmaterial';
  $unit_table = $tablePrefix . 'unit';
  $product_table = $tablePrefix . 'product';
  $supplier_table = $tablePrefix . 'supplier';	
  $workorder_detail_table = $tablePrefix . 'workorder_detail';
    $stock_data = $tablePrefix . 'stock';
   
    
    $entityID = $ajxSess->get('user')['entity_ID'];
    
    // $sql_query ="SELECT $workorder_table.ProcessID,$workorder_table.ProductSize, $workorder_table.Thickness,$workorder_table.Colour, $workorder_table.Design,$workorder_table.Quantity,$workorder_table.CompletedDate, $workorder_table.SequenceMaterialIssued, $workorder_table.Details, $workorder_table.Remarks FROM $workorder_table LEFT JOIN $customer_table ON  $customer_table.ID = $enquiry_table.customer_ID LEFT JOIN $state_table ON $customer_table.BillingState_ID = $state_table.ID WHERE $enquiry_table.ID=".$_POST['ColumnValue']."";  

 $sql_query ="SELECT    
$workorder_table.ProcessID,
$processmaster_table.ProcessName,
$workorder_table.ProductSize, 
$workorder_table.Thickness,
$workorder_table.Colour, 
$workorder_table.Design,
$workorder_table.CompletedDate,
$workorder_table.SequenceMaterialIssued, 
$workorder_table.Details, 
$workorder_table.NoofQuantity, 
$workorder_table.Remarks, 
$workorder_table.product_ID,
$workorder_table.EmployeeID,
$employee_table.EmpName,
$workorder_table.Subcontractor_ID,
$workorder_table.Status,
$supplier_table.SupplierName,
$product_table.ProductName,




$workorder_detail_table.unit_ID,
$workorder_detail_table.UnitName,
$workorder_detail_table.rawmaterial_ID,
$workorder_detail_table.RMName,

$stock_data.available_qty,
$workorder_detail_table.rmt_qty,

 $workorder_detail_table.Quantity2

FROM 
$workorder_table

LEFT JOIN $workorder_detail_table  ON $workorder_table.ID = $workorder_detail_table.Workorder_ID
LEFT JOIN $stock_data  ON $workorder_detail_table.rawmaterial_ID = $stock_data.rawmaterial_id

LEFT JOIN $product_table  ON $workorder_table.product_ID = $product_table.ID
LEFT JOIN $employee_table ON  $workorder_table.EmployeeID = $employee_table.ID
LEFT JOIN $supplier_table ON  $workorder_table.Subcontractor_ID = $supplier_table.ID
LEFT JOIN $processmaster_table ON  $workorder_table.ProcessID = $processmaster_table.ID

WHERE
  $workorder_table.ID=".$_POST['ColumnValue']." AND $stock_data.entity_ID = $workorder_table.entity_ID AND $workorder_detail_table.ItemStatus = 1";       

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