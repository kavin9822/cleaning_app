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
    $state_tab = $tablePrefix . 'state';
    $country_tab = $tablePrefix . 'country';

    $entityID = $ajxSess->get('user')['entity_ID'];
    $customername=trim($_POST['ColumnValue']);
   
     $sql_query ="SELECT $customer_tab.ID,$customer_tab.CompanyName as companyname,
                         $customer_tab.MobileNo as mobno,$customer_tab.BillingAddress1 as address1,
                         $customer_tab.BillingAddress2 as address2,$customer_tab.BillingCity as city,
                         $customer_tab.BillingState_ID as state_id,$customer_tab.BillingCountry_ID as country_id,
                         $customer_tab.BillingZip as zip,$customer_tab.Email,
                         $customer_tab.Address_type as type,$state_tab.StateName as state,
                         $country_tab.CountryName as country
                         FROM $customer_tab  
                         LEFT JOIN $state_tab ON $customer_tab.BillingState_ID=$state_tab.ID 
                         LEFT JOIN $country_tab ON $customer_tab.BillingCountry_ID=$country_tab.ID  WHERE $customer_tab.PersonName='$customername'";
    
   
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