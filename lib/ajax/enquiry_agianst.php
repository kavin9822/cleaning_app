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
    
    $customer_tab = $tablePrefix .'customer';
    $enquiry_tab = $tablePrefix .'enquiry';
    $pdndept_tab = $tablePrefix .'pdndepartment';
    $employee_tab = $tablePrefix .'employee';
    $state_tab = $tablePrefix . 'state';
    $country_tab = $tablePrefix . 'country';
    $tender_tab = $tablePrefix . 'tender';

    $entityID = $ajxSess->get('user')['entity_ID'];
    $enquiry_id=trim($_POST['ColumnValue']);
    
     $sql_query ="SELECT * FROM $tender_tab
                         WHERE $tender_tab.enquiry_ID='$enquiry_id'";
    $stmt = $Db->prepare($sql_query);
    $stmt->execute();
    $enquiry_rows = $stmt->fetchAll(2);
    
   // var_dump($enquiry_rows);die;
    if(count($enquiry_rows)==0){
        $sql_query ="SELECT $customer_tab.ID,$customer_tab.CompanyName as companyname,
                         $customer_tab.MobileNo as mobno,$customer_tab.BillingAddress1 as address1,
                         $customer_tab.BillingAddress2 as address2,$customer_tab.BillingCity as city,
                         $customer_tab.BillingState_ID as state_id,$customer_tab.BillingCountry_ID as country_id,
                         $customer_tab.BillingZip as zip,$customer_tab.Email,
                         $customer_tab.Address_type as type,$state_tab.StateName as state,
                         $country_tab.CountryName as country,$employee_tab.EmpName,
                         $pdndept_tab.DeptName as pdndept,$customer_tab.PersonName as contact_person
                         FROM $customer_tab  
                         LEFT JOIN $state_tab ON $customer_tab.BillingState_ID=$state_tab.ID 
                         LEFT JOIN $country_tab ON $customer_tab.BillingCountry_ID=$country_tab.ID
                         LEFT JOIN $enquiry_tab ON $customer_tab.ID=$enquiry_tab.customer_ID
                         LEFT JOIN $employee_tab ON $enquiry_tab.employee_ID=$employee_tab.ID 
                         LEFT JOIN $pdndept_tab ON $enquiry_tab.pdndepartment_ID=$pdndept_tab.ID 
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