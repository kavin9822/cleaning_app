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
   
  $enquiry_table = $tablePrefix . 'enquiry';
	$tender_table = $tablePrefix . 'tender';
	$tenderdetail_table = $tablePrefix . 'tenderdetail';
  $pdndepartment_table = $tablePrefix . 'pdndepartment';
  $customer_table = $tablePrefix . 'customer';
   
    
    $entityID = $ajxSess->get('user')['entity_ID'];
    
  
     $sql_query ="SELECT *,$pdndepartment_table.DeptName,$customer_table.PersonName,$tender_table.TenderSection,$tender_table.ClosingDateTime,$tender_table.InspectionAgency,$tender_table.ProcureApproveYN,$tender_table.ApproveAgency,$tender_table.RAEnabledYN,$tender_table.RegularOrDev,$tender_table.ValidityOfferDays,$tenderdetail_table.Title FROM $enquiry_table 
                  LEFT JOIN $pdndepartment_table ON $pdndepartment_table.ID=$enquiry_table.pdndepartment_ID 
                  LEFT JOIN $customer_table ON $customer_table.ID=$enquiry_table.customer_ID 
                  LEFT JOIN $tender_table ON $tender_table.enquiry_ID=$enquiry_table.ID 
                  INNER JOIN $tenderdetail_table ON $tenderdetail_table.tender_ID=$tender_table.ID WHERE $enquiry_table.ID=".$_POST['ColumnValue']."";
    
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