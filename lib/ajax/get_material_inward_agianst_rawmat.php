<?php

/*
 * Production - linux
 */

include_once './set_inc_path.php';

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

if($_POST["indent_id"]){
   $purchaseorder_table = $tablePrefix .'purchaseorder';
    $indent_det_tab = $tablePrefix .'purchaseindentdetail';
    $rawmaterial_table = $tablePrefix .'rawmaterial';
    $purchaseorderdetail_table = $tablePrefix .'purchaseorderdetail';
    $supplier_table = $tablePrefix . 'supplier';
   
   // $sql_query ="SELECT $rawmaterial_tab.ID,$rawmaterial_tab.RMName FROM $rawmaterial_tab,$indent_det_tab WHERE $indent_det_tab.rawmaterial_ID=$rawmaterial_tab.ID AND $indent_det_tab.ItemStatus=1 AND $indent_det_tab.purchaseindent_ID=".$_POST['indent_id']."";  
//  echo   $sql_query ="SELECT   $purchaseorder_table.supplier_ID,$supplier_table.SupplierName,$rawmaterial_table.ID, $rawmaterial_table.RMName FROM $purchaseorder_table LEFT JOIN $supplier_table ON $purchaseorder_table.supplier_ID = $supplier_table.ID LEFT JOIN $purchaseorderdetail_table ON $purchaseorderdetail_table.purchaseorder_ID = $purchaseorder_table.ID LEFT JOIN $rawmaterial_table ON $purchaseorderdetail_table.rawmaterial_ID = $rawmaterial_table.ID WHERE $purchaseorderdetail_table.ItemStatus AND $purchaseorder_table.ID=".$_POST['indent_id']."";  die;

 $sql_query ="SELECT  *, $supplier_table.SupplierName,$purchaseorder_table.supplier_ID,$rawmaterial_table.ID,	$rawmaterial_table.RMName 
 FROM $purchaseorder_table,$supplier_table ,$purchaseorderdetail_table,$rawmaterial_table
 WHERE
     $purchaseorder_table.supplier_ID = $supplier_table.ID AND
     $purchaseorder_table.ID = $purchaseorderdetail_table.purchaseorder_ID  AND
     $purchaseorderdetail_table.rawmaterial_ID = $rawmaterial_table.ID 	AND
     $purchaseorderdetail_table.ItemStatus=1                            AND
     $purchaseorder_table.ID=".$_POST['indent_id']."";   
   
  	try {
                $stmt = $Db->prepare($sql_query);
               
                if ($stmt->execute()) {
                 $Data_rows= $stmt->fetchAll(2);
                
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


// if($_POST["Raw"])
// {
//   var_dump('data is flowing well');
// }


