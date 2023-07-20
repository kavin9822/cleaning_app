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
  
  $bomprocessmaster_table = $tablePrefix . 'BOMProcessMaster';
  $bomprocessdetail_table = $tablePrefix . 'BOMProcessDetail';
  $process_table = $tablePrefix . 'ProcessMaster';

  $enquiry_table = $tablePrefix . 'enquiry';
   
  $entityID = $ajxSess->get('user')['entity_ID'];

       $sql_query ="SELECT $process_table.ID,$process_table.ProcessName 
                            FROM $process_table
                            LEFT JOIN $bomprocessdetail_table ON $bomprocessdetail_table.process_ID=$process_table.ID
                            LEFT JOIN $bomprocessmaster_table ON $bomprocessmaster_table.ID=$bomprocessdetail_table.BOMProcessMaster_ID
                            WHERE $bomprocessmaster_table.product_ID=".$_POST['ColumnValue']." GROUP BY  $process_table.ID";

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