<?php

/*
 * Production - linux
 */
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
 	try {

    
    $customer_tab = $tablePrefix .'customer';
    
    $usersessiodata = $_SESSION['user'];
    $userID = $Db->quote($usersessiodata["ID"]);
    $entityID=$Db->quote($usersessiodata["entity_ID"]);
  
    
     $args = array(
            'CustomerName' => FILTER_SANITIZE_STRING,
            'DesignationName'=>FILTER_SANITIZE_INT,
            'BillAddress1' => FILTER_SANITIZE_STRING,
            'BillAddress2' => FILTER_SANITIZE_STRING,
            'BillCity' => FILTER_SANITIZE_STRING,
            'CmpyName' => FILTER_SANITIZE_STRING,
            'CustMobNo' => FILTER_SANITIZE_STRING,
            'BillState_ID'=> FILTER_SANITIZE_INT,
            'BillCountry_ID'=> FILTER_SANITIZE_INT,
            'BillZip' => FILTER_SANITIZE_INT
          //  'AddressType'=>FILTER_SANITIZE_STRING
            );
    
            $myinputs = filter_input_array(INPUT_POST, $args);
      
       if(empty($myinputs['CustomerName'])){
            http_response_code(202);
            echo json_encode(array('message' => 'Please Enter Person Name'));   
            return;
        }    
        // if(empty($myinputs['CmpyName'])){
        //     http_response_code(202);
        //     echo json_encode(array('message' => 'Please Enter Company Name'));   
        //     return;
        // } 
        // if(empty($myinputs['DesignationName'])){
        //     http_response_code(202);
        //     echo json_encode(array('message' => 'Please Enter Designation'));   
        //     return;
        // }   
        if(empty($myinputs['BillAddress1'])){
            http_response_code(202);
            echo json_encode(array('message' => 'Please Enter Address Line 1'));   
            return;
        }   
        // if(empty($myinputs['BillAddress2'])){
        //     http_response_code(202);
        //     echo json_encode(array('message' => 'Please Enter Address Line 2'));   
        //     return;
        // }    
        if(empty($myinputs['BillCity'])){
            http_response_code(202);
            echo json_encode(array('message' => 'Please Enter City'));   
            return;
        } 
        
        if(empty($myinputs['BillState_ID'])){
            http_response_code(202);
            echo json_encode(array('message' => 'Please Enter State'));   
            return;
        } 
        
        if(empty($myinputs['BillCountry_ID'])){
            http_response_code(202);
            echo json_encode(array('message' => 'Please Enter Country'));   
            return;
        } 
        
        // if(empty($myinputs['BillZip'])){
        //     http_response_code(202);
        //     echo json_encode(array('message' => 'Please Enter ZipCode'));   
        //     return;
        // } 
       
    $customername=$Db->quote($myinputs['CustomerName']);
    $designation=$Db->quote($myinputs['DesignationName']);
    $address1=$Db->quote($myinputs['BillAddress1']);   
    $address2=$Db->quote($myinputs['BillAddress2']);
    $city=$Db->quote($myinputs['BillCity']);
    $company=$Db->quote($myinputs['CmpyName']);
    $mobno=$Db->quote($myinputs['CustMobNo']);
    $state=$Db->quote($myinputs['BillState_ID']);
    $country=$Db->quote($myinputs['BillCountry_ID']);
    $zip=$Db->quote($myinputs['BillZip']);
    //$addresstype=$Db->quote($myinputs['AddressType']);
    
              
       $entityID = $ajxSess->get('user')['entity_ID'];
  
            if($customername!=='' && $designation!=='' && $company!==''){
                                    
                                $sqlcustomer= "INSERT INTO $customer_tab (
                                `PersonName`, 
                                `DesignationName`,
                                `CompanyName`,
                                `BillingAddress1`,
                                `BillingAddress2`,
    							`BillingCity`,
    							`BillingState_ID`,
    							`BillingCountry_ID`,
    							`BillingZip`,
    							`MobileNo`,
                                `users_ID`, 
                                `entity_ID`
                                )
                                values (
                                $customername,
                                $designation,
                                $company,
                                $address1,
                                $address2,
                                $city,
                                $state,
                                $country,
                                $zip,
                                $mobno,
                                $userID,
                                $entityID
                                )";
                                
                             $stmt = $Db->prepare($sqlcustomer);
                             $stmt->execute();
                            
                    if($stmt){
                           
                          $sql_query = "SELECT $customer_tab.ID,CONCAT($customer_tab.CompanyName ,' || ', $customer_tab.PersonName) AS CompanyName from $customer_tab ORDER BY $customer_tab.ID DESC";
                          $stmt1 = $Db->prepare($sql_query);
                          $stmt1->execute();
                          $customerData_rows = $stmt1->fetchAll();   
                           
                          if($customerData_rows){
    
                                http_response_code(200);		                 
                                echo json_encode($customerData_rows);
                              }else{
                         	http_response_code(202);
                         	echo json_encode(array('noData' => 'noData'));
                         	return;
                      }     
                         	  
                    }
        
            }   

           } catch (Exception $exc) {
                      http_response_code(202);
                      echo json_encode(array('message' => 'Failed to add to customer'));
                      return;
                }              
                        
 