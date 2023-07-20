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
  if($_POST["product_ID"]){
  
  $rawmaterial_table = $tablePrefix . 'rawmaterial';
  $bomprocessdetail_table = $tablePrefix . 'BOMProcessDetail';
  $bomprocessmaster_table = $tablePrefix . 'BOMProcessMaster';
  $process_table = $tablePrefix . 'ProcessMaster';
  $unit_table = $tablePrefix . 'unit';

  $enquiry_table = $tablePrefix . 'enquiry';
   
  $entityID = $ajxSess->get('user')['entity_ID'];

       $sql_query ="SELECT  $unit_table.ID as unit_ID,$rawmaterial_table.ID as rawmaterial_ID,$rawmaterial_table.RMName,$unit_table.UnitName,$bomprocessdetail_table.Quantity  
                            FROM $process_table
                            LEFT JOIN $bomprocessdetail_table ON $bomprocessdetail_table.process_ID=$process_table.ID
                            LEFT JOIN $rawmaterial_table ON $rawmaterial_table.ID=$bomprocessdetail_table.rawmaterial_ID
                            LEFT JOIN $unit_table ON $unit_table.ID=$bomprocessdetail_table.unit_ID
                            LEFT JOIN $bomprocessmaster_table ON $bomprocessmaster_table.ID=$bomprocessdetail_table.BOMProcessMaster_ID
                            WHERE $bomprocessdetail_table.process_ID=".$_POST['ColumnValue']." AND $bomprocessmaster_table.product_ID='".$_POST['product_ID']."'";

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
}