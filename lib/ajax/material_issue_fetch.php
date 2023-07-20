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
    
	
	$materialrequest_table = $tablePrefix . 'materialrequest';
  $materialrequest_detail_table = $tablePrefix . 'materialrequest_detail';
  $rawmaterial_table = $tablePrefix . 'rawmaterial';
  $unit_table = $tablePrefix . 'unit';
  $employee_table = $tablePrefix . 'employee';
    $supplier_table = $tablePrefix . 'supplier';
    $stock_table = $tablePrefix . 'stock';
    
    $entityID = $ajxSess->get('user')['entity_ID'];
    
  
//   $sql_query ="SELECT $materialrequest_table.EmployeeType,$employee_table.EmpName,$materialrequest_table.Remarks,$materialrequest_table.EmployeeType,$rawmaterial_table.RMName,$materialrequest_detail_table.Quantity,$unit_table.UnitName,$materialrequest_detail_table.Rawmaterial_ID 
//                 FROM $materialrequest_table,$employee_table,$materialrequest_detail_table,$rawmaterial_table,$unit_table 
//                 WHERE
//                  $materialrequest_table.EmployeeID=$employee_table.ID   AND
//                 $materialrequest_table.ID = $materialrequest_detail_table.Materialrequest_ID     AND
//                 $materialrequest_detail_table.Rawmaterial_ID = $rawmaterial_table.ID          AND
//               $materialrequest_detail_table.unit_ID = $unit_table.ID                   AND
                
//               $materialrequest_table.ID=".$_POST['ColumnValue']."";  

 $sql_query ="SELECT $materialrequest_table.EmployeeType,
$employee_table.EmpName,
$supplier_table.SupplierName,
$materialrequest_table.Remarks,
$materialrequest_table.EmployeeType,
$rawmaterial_table.RMName,
$materialrequest_detail_table.Quantity,
$unit_table.UnitName,

$materialrequest_detail_table.issue_qty,
$stock_table.available_qty,

$materialrequest_detail_table.Rawmaterial_ID 
FROM $materialrequest_table

LEFT JOIN $materialrequest_detail_table ON $materialrequest_table.ID = $materialrequest_detail_table.Materialrequest_ID
LEFT JOIN $supplier_table ON $materialrequest_table.Subcontractor_ID = $supplier_table.ID
LEFT JOIN $employee_table ON $materialrequest_table.EmployeeID=$employee_table.ID         
LEFT JOIN $rawmaterial_table ON $materialrequest_detail_table.Rawmaterial_ID = $rawmaterial_table.ID      

LEFT JOIN $stock_table ON $materialrequest_detail_table.Rawmaterial_ID = $stock_table.rawmaterial_id 
LEFT JOIN $unit_table ON $materialrequest_detail_table.unit_ID = $unit_table.ID                   
WHERE 
$stock_table.entity_ID = $entityID AND $materialrequest_detail_table.ItemStatus=1 AND
$materialrequest_table.ID=".$_POST['ColumnValue']."";  

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