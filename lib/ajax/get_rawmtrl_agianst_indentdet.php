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

if($_POST["rawid"]){
    
    $indent_det_tab = $tablePrefix .'purchaseindentdetail';
    $rawmaterial_tab = $tablePrefix .'rawmaterial';
    $unit_tab = $tablePrefix .'unit';
   
   $sql_query ="SELECT $indent_det_tab.rawmaterial_ID as ID,$rawmaterial_tab.RMName,$indent_det_tab.Quantity AS ApprovedQty,$indent_det_tab.RaisedPOQty,$unit_tab.ID as unit_ID,$unit_tab.UnitName FROM $indent_det_tab,$unit_tab,$rawmaterial_tab WHERE $rawmaterial_tab.ID=$indent_det_tab.rawmaterial_ID  AND $unit_tab.ID=$indent_det_tab.unit_ID AND $indent_det_tab.rawmaterial_ID=".$_POST['rawid']."";
 
   
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


