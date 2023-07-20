#!/usr/bin/php -q
<?php

/*******************************************************************************
* Software: YCIAS (Auto Alert SMS for Package Expire)                          *
* Version:  1.0                                                                *
* Date:     2017-03-29                                                         *
* Author:   BOOPATHI Duraisamy                                                 *
* License:  under Yajurr Computer Solution Pvt. Ltd.(www.whyceeyes.com)        *
*                                                                              *
* Use, modify and redistribute this software is restricted and not allowed.    *
* (C) Copyright 2016-2017. YCS . All Rights Reserved.                          *
*******************************************************************************/


//Set default local timezone(IST) settings.
date_default_timezone_set('Asia/Kolkata');

set_include_path(".:/home/spitczze/public_html/crm/lib");

include_once 'PhpRbac/database/database.config';

try {
    $Db = new PDO("mysql:host={$host};dbname={$dbname}", $user, $pass);
} catch (Exception $exc) {
    
}

$entity_tab = $tablePrefix . 'entity';
$revmod_tab = $tablePrefix . 'revenuemodel';

$entity_sql= "SELECT $entity_tab.ID,$entity_tab.SGServerIP,$revmod_tab.PaymentYN FROM $entity_tab "
           . "LEFT JOIN $revmod_tab ON $entity_tab.RevenueModel = $revmod_tab.RevenueModel";

$stmt = $Db->prepare($entity_sql);
$stmt->execute();
$Entity_data = $stmt->fetchAll(2);
$entitycount = count($Entity_data);

for ($i = 0; $i<$entitycount; $i++) {
  
 if($Entity_data[$i]['PaymentYN']==='Y'){
        $ServerIP = $Entity_data[$i]['SGServerIP'];
        $EntityID = $Entity_data[$i]['ID'];
        
        
/////////////////////////////////// CURL OPERATIONS STARTS ////////////////////////////////////////////

        $u_SGServerIP = $ServerIP;

        if ($u_SGServerIP !== '' && $u_SGServerIP !== NULL) {

            $url = "http://" . $u_SGServerIP . "/sg_api/custom_responce.php?order_type=4&requester=103.50.162.27&authkey=yscpsauth";

            include_once 'lib/util/curl.php';

            $httpSms = new httpCurl();
            $y = $httpSms->getUrlContent($url);

            if (!empty($y)) {
                $p = explode(':', $y);

                $pac = explode('@', $p[2]);

                //var_dump($y);

                $pacData = array();
                foreach ($pac as $pvalue) {
                    $pacDetArr = explode('|', $pvalue);
                    $pacData[end($pacDetArr)] = $pacDetArr[0];
                }
            }
        } else {
            $pacData = FALSE;
        }

////////////////////////////////////////// CURL OPERATIONS CLOSES /////////////////////////////////////////////  
        
        $customer_tab = $tablePrefix . 'customer';
        $package_tab = $tablePrefix . 'package';

        $cust_sql = "SELECT $customer_tab.ID,$customer_tab.FirstName,$customer_tab.MobileNo,$package_tab.SMPackName,"
                . "$customer_tab.PackExpireDate FROM $customer_tab,$package_tab "
                . "WHERE $package_tab.ID=$customer_tab.package_ID AND $customer_tab.entity_ID=$EntityID "
                . "AND $customer_tab.PackExpireDate!='NULL' AND $customer_tab.SGuserRegStatus='YES' "
                . "AND DATE($customer_tab.PackExpireDate) BETWEEN DATE(NOW()) AND DATE(DATE_ADD(NOW(), INTERVAL 3 DAY)) "
                . "AND LENGTH($customer_tab.MobileNo)=10";

        $stmt = $Db->prepare($cust_sql);
        $stmt->execute();
        $Cust_data = $stmt->fetchAll(2);
        $custcount = count($Cust_data);
        
        foreach ($Cust_data as $k => &$arr) {
                             /* If value exists in $pacData then assign it to index[4]
                              * Otherwise, unset this array key
                              */
   		if (isset($pacData[$arr['SMPackName']])) {
       			$arr['SMPackName'] = $pacData[$arr['SMPackName']];  
   			} else {
       			unset($Cust_data[$k]);
   			}
		}      
                
                
        for ($j = 0; $j<$custcount; $j++) {
            
            try {

                    $cust_mobileno = $Cust_data[$j]['MobileNo'];
                    $CustomerMobileNo = trim($cust_mobileno);

                    $cus_name = $Cust_data[$j]['FirstName'];
                    $cus_nam_arr = preg_split("/[\s]+/", $cus_name);
                    $cust_name = implode("+", $cus_nam_arr);
                    $cust_fname = str_replace('&', '-', $cust_name);
                    
                    $pac= $Cust_data[$j]['SMPackName'];
                    $pac_arr = preg_split("/[\s]+/",$pac);
                    $cus_pack = implode("+",$pac_arr);
                    $cust_pack = str_replace('&', '-', $cus_pack);

                    $exp_date = $Cust_data[$j]['PackExpireDate'];
                    $exdate = strtotime($exp_date);
                    $expiry_date = date("d-m-Y+H:i:s", $exdate);

                    

                    if (preg_match('/^\d{10}$/', $CustomerMobileNo) && !empty($cust_pack) && $cust_pack!==NULL) {

                    $smsMessage = 'Dear+' . $cust_fname . '!.+Your+pack+"' . $cust_pack . '"+is+going+to+expire+on+' . $expiry_date . '.+Pls+recharge+before+for+uninterrupted+internet';

                        include_once 'util/curl.php';

                        $httpSms = new httpCurl();
                        if ($httpSms->smssigma($CustomerMobileNo, $smsMessage)) {
                            echo 'SMS is sent to Customer Registered MobileNo.';
                        }
                    } else {

                           echo 'SMS is not sent to the customer. The MobileNo. or Package is not valid';
                    }

                    
                } catch (Exception $e) {
                            echo 'Caught exception: ',  $e->getMessage(), "\n";
                }   
            
            }
        
    }
}