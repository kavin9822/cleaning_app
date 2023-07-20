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
    
    
    $enquiry_tab = $tablePrefix .'enquiry';
    $pdndept_tab = $tablePrefix .'pdndepartment';
    $pdnorder_tab = $tablePrefix . 'productionorder';
    $cust_order_tab = $tablePrefix . 'customerorder';
    $custpurchase_order_tab = $tablePrefix . 'custpurchase_orderdetail';

    $entityID = $ajxSess->get('user')['entity_ID'];
    $enquiry_id=trim($_POST['ColumnValue']);
    
    $sql_query ="SELECT * FROM $pdnorder_tab
                         WHERE $pdnorder_tab.enquiry_ID='$enquiry_id'";
    $stmt = $Db->prepare($sql_query);
    $stmt->execute();
    $enquiry_rows = $stmt->fetchAll(2);
    
   // var_dump($enquiry_rows);die;
    if(count($enquiry_rows)==0){
            
            $sql_query ="SELECT $cust_order_tab.ID,
                         $cust_order_tab.CustOrderNo,
                         $pdndept_tab.DeptName as pdndept,
                         $cust_order_tab.Drawing_Path,
                         IF($cust_order_tab.Thirdparty_Inspn=1,'Yes','No') as Thirdparty_Inspn,
                         $cust_order_tab.Packing_Instn,
                         $custpurchase_order_tab.PurchaseorderNo
                         FROM $cust_order_tab  
                         LEFT JOIN $enquiry_tab ON $cust_order_tab.enquiry_ID=$enquiry_tab.ID 
                         LEFT JOIN $pdndept_tab ON $enquiry_tab.pdndepartment_ID=$pdndept_tab.ID 
                         LEFT JOIN $custpurchase_order_tab ON $cust_order_tab.ID=$custpurchase_order_tab.custorder_ID
                         WHERE $enquiry_tab.ID='$enquiry_id'";

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
        	 	echo json_encode(array('message' => 'noData'));
    		    }   
                    
                } else {
                  http_response_code(204);
                }
            } catch (Exception $exc) {
              http_response_code(500);
            }
    }else{
        $Data_rows =[];
        echo json_encode(array('message' => 'This Enquiry_ID Already Exsist'));
    }
     

}