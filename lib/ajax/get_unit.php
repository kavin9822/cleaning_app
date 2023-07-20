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
if($_POST["poid"]){


    // $RawType_tab = $tablePrefix .'rawmaterialtype';
    $Raw_tab = $tablePrefix .'rawmaterial';
    $unit_tab = $tablePrefix .'unit';

  $sql_query = "SELECT  $unit_tab.ID,$unit_tab.UnitName FROM $Raw_tab,$unit_tab where $unit_tab.ID=$Raw_tab.unit_ID AND $Raw_tab.ID = ".$_POST["poid"]."";


    	try {
                $stmt = $Db->prepare($sql_query); 
                
                if ($stmt->execute()) {

                $Data_rowss = $stmt->fetchAll(2);

                if($Data_rowss){
		            http_response_code();		
                   echo json_encode($Data_rowss);
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


