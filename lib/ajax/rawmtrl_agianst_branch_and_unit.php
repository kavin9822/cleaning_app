<?php

include_once './set_inc_path.php';


//set_include_path(".:/home2/sreensta/public_html/lib");

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
    
  
    $material_inward_detail_table = $tablePrefix .'material_inward_detail';
    $unit_table = $tablePrefix .'unit';
    $stock_statement_table = $tablePrefix .'stock';
    
    $entityID = $ajxSess->get('user')['entity_ID'];

    // $sql_query="SELECT $material_inward_detail_table.ID,$material_inward_detail_table.batch_no,$unit_table.Description FROM $material_inward_detail_table,$unit_table  WHERE $unit_table.ID = $purchaseindentdetail_table.unit_ID and $material_inward_detail_table.Iterm_id='".$_POST['ColumnValue']."'";       
     
 $sql_query="SELECT $material_inward_detail_table.batch_no,
                     $material_inward_detail_table.unit,  
                     $stock_statement_table.available_qty,  
                     $unit_table.UnitName 
              FROM   $material_inward_detail_table,$unit_table,$stock_statement_table  
              WHERE  $unit_table.ID = $material_inward_detail_table.unit 
              AND    $stock_statement_table.rawmaterial_id = $material_inward_detail_table.item_id
              AND    $stock_statement_table.entity_ID = $entityID
              AND    $material_inward_detail_table.item_id='".$_POST['ColumnValue']."'";
    
	try {
                $stmt = $Db->prepare($sql_query);
                if ($stmt->execute()) {
                 $Data_rows = $stmt->fetchAll(2);
                if(count($Data_rows) >= 1){
		            http_response_code();		                 
                    echo json_encode($Data_rows);
                }else{
	 	            http_response_code(204);
    		    }   
                }else {
                   http_response_code(204);
                }
               
            } catch (Exception $exc) {
               http_response_code(500);
            }
  
    
}