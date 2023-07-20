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

if($_POST["ColumnValue"]){
    
    
    $cust_order_tab = $tablePrefix . 'customerorder';
    $cust_order_schedule_tab = $tablePrefix . 'custorder_schedule';


    $entityID = $ajxSess->get('user')['entity_ID'];
    $enquiry_id=trim($_POST['ColumnValue']);
    
    
            $sql_query ="SELECT $cust_order_schedule_tab.custorder_ID as ID,
                         $cust_order_schedule_tab.Quantity,
                         DATE_FORMAT($cust_order_schedule_tab.StartDate, '%d %M %Y') as StartDate,
                         DATE_FORMAT($cust_order_schedule_tab.EndDate, '%d %M %Y') as EndDate
                         FROM $cust_order_schedule_tab   
                         LEFT JOIN $cust_order_tab ON $cust_order_schedule_tab.custorder_ID=$cust_order_tab.ID 
                         WHERE $cust_order_tab.enquiry_ID='$enquiry_id'";

    	try {
                $stmt = $Db->prepare($sql_query);
              // var_dump($sql_query);
                if ($stmt->execute()) {

                $Data_rows = $stmt->fetchAll(2);

                  $i=1;
                 foreach($Data_rows as $k => $v){
                     unset($Data_rows[$k]["ID"]);
                     $Data_rows[$k]["Quantity"]= "<input id='ItemNo_$i' name='ItemNo_$i' class='form-control' value= '".$v['Quantity']."' type='text' readonly>";
                     $Data_rows[$k]["Start Date"]= "<input id='ItemName_$i' name='ItemName_$i' class='form-control' value= '".$v['StartDate']."' type='text' readonly><input name='Id_$i' id='Id_$i' class='form-control' value='".$v['ID']."' type='hidden'>";
                     $Data_rows[$k]["End Date"]="<input id='Note_$i' name='Note_$i' class='form-control'  type='text' value= '".$v['EndDate']."'  readonly>";
                     $i++;
                 }
              
                 
                if($Data_rows){
		            http_response_code();		                 
                 echo json_encode($Data_rows);
                 }else{
        	 	http_response_code(204);
        	 	echo json_encode(array('message' => 'noData'));
    		    }   
                    
                } else {
                  http_response_code(204);
                }
            } catch (Exception $exc) {
              http_response_code(500);
            }
    
}