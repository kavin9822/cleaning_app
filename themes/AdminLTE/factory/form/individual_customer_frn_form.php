<?php

/*
 * @author psmahadevan
 * Note Entity_id and user id - are filter by default so u cant add to pagination list
 */

class Form_Elements {


    public static function data($reg, $form_data = NULL) {

        /*
         * Option data if applicable
         * example
         * $option_data['State']
         * Require key value pair
         * data can be taken even from database
         */

        $crg = $reg;
        $ses = $reg->get('ses');
        $db = $reg->get('db');
        $tpl = $reg->get('tpl');
        
        include_once 'util/DBUTIL.php';
        $dbutil = new DBUTIL($crg);


////////////////////////////////////// CURL OPERATIONS STARTS ///////////////////////////////////////

            $u_SGServerIP = $ses->get('user')['SGServerIP'];
            
if ($u_SGServerIP !== '' && $u_SGServerIP !== NULL) {

$application_ip=$tpl->get('application_ip');

$url = "http://".$u_SGServerIP."/sg_api/custom_responce.php?order_type=4&requester=$application_ip&authkey=yscpsauth";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_TIMEOUT, 5);
$data = curl_exec($ch);
$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
///////////////////////////////////////////////////////////////
($httpcode >= 200 && $httpcode < 300) ? $y = $data : $y = false;
if(!empty($y)){
	$p = explode(':', $y);

	$pac = explode('@', $p[2]);

//var_dump($y);
	$pacData = array();
	foreach ($pac as $pvalue) {
    		$pacDetArr = explode('|', $pvalue);
		$pacData[end($pacDetArr)] = $pacDetArr[0];
    		//$pacData[$pacDetArr[0]] = $pacDetArr[0];
	}
}
///////////////////////////////////////////////////
}else{
      $pacData = FALSE;
     }
 
      
////////////////////////////////////////// CURL OPERATIONS CLOSES ////////////////////////////////////   
  
        $actual_table_name_pac = $crg->get('table_prefix') . 'package';
        $entityID = $ses->get('user')['entity_ID'];
        $sqlpac = "SELECT ID, SMPackName FROM $actual_table_name_pac WHERE entity_ID = $entityID"; 
        $Data_rows = $dbutil->getSqlData($sqlpac,12);    
                 
                 foreach ($Data_rows as $k => &$arr) {
                             /* If value exists in $pacData then assign it to SMPackName
                              * Otherwise, unset this array key
                              */
   		if (isset($pacData[$arr])) {
       			$arr = $pacData[$arr];  
   			} else {
       			unset($Data_rows[$k]);
   			}
		}
            
            
        $states_option_data = array(
            'TamilNadu' => 'Tamil Nadu', 
            'Kerala' => 'Kerala',           
            'Karnataka' => 'Karnataka',            
            'AndhraPradesh' => 'Andhra Pradesh',
            'Telangana' => 'Telangana',
            'Andaman and Nicobar' => 'Andaman and Nicobar',
            'Lakshadweep' => 'Lakshadweep',
            'Puducherry' => 'Puducherry'
        );

        $router_option_data = array(
            'Y' => 'Yes',
            'N' => 'No'
        );

        $cont_option_data = array(
            'IN' => 'India',
        ); 
        
        $ip_allocation_type = array(
            'PRIVATE' => 'PRIVATE', 
            'PUBLIC' => 'PUBLIC'
        ); 
        
        $ip_type = array(
            'DHCP' => 'DHCP', 
            'STATIC' => 'STATIC'
        ); 
        $auth_usr = array(
            'NO' => 'NO',
            'YES' => 'YES'
        );


	    $actual_table_name = $crg->get('table_prefix') . 'customertype';            
            $sql = "SELECT `ID`,`Title` FROM `$actual_table_name` WHERE `Title` like 'individual%'";           
            $customer_type_sel = $dbutil->getSqlData($sql,12);

            $sql = "SELECT `ID` FROM `$actual_table_name` WHERE `Title` like 'individual%' LIMIT 1";           
            $customer_type_id = $dbutil->getSqlData($sql,7);        

            $custstat_table = $crg->get('table_prefix') . 'customerstatus';
            $cssql = "SELECT `ID`,`CustStatus` FROM `$custstat_table`";
            $cust_status_sel = $dbutil->getSqlData($cssql, 12);            
            
        $atn_apm = $crg->get('table_prefix') . 'apmaster';        
        //ApLocation, ApLocation = id position an value position in select box        
        $sqlapm = "SELECT DISTINCT ApLocation, ApLocation FROM $atn_apm WHERE entity_ID = $entityID"; 
        $location_sel = $dbutil->getSqlData($sqlapm, 12); 
        
        $actual_table_cus = $crg->get('table_prefix') . 'customertype';
                
        $FormConfig = array(
            /*
             * 
             * Do not use prefix in table name
             * Example in ycs_user
             * enter as user
             * 
             * 'database_table_name' =>'user',
             */

            'table_name' => 'customer',
            /*
             * Primary key ID column required in the pagination list
             * 
             */
            'ID_column_required' => TRUE,
            /*
             * If u want uniqe key then set the following 2 variables
             * used in creating unique key
             * 
             * 'unique_key_required'=> FALSE,
             * for primary key Id - is autoincriment - number
             */
            'unique_key_required'=> TRUE,
            /*
             * Based on a colum name first three letters
             */
            
            'unique_key_prefix'=> 'CUS',
            
            /*
             * Unique key suffix
             * get unique key sufix from value filled in a field
             * or colun name
             */
            'unique_key_suffix_from_column_name' => 'Country',
            /*
             * Form limit 
             * Number of form elemens per column
             */
            'max_number_form_elements_per_colum' => 22,
            /*
             * Max number of rows in crud2
             * we will do this in next version
             */
            //'List_max_number_rows' => 10,


            /*
             * Max number of columns in list data grid in crud class
             * eventough this class is no called in list data table 
             * but it is available default in the crud class
             * 
             * how to give value to this variable
             * 
             * Number of elements in the form content array ('form_content') is the max limit
             * 
             * Count number of element u use in  
             * form content array used bellow
             * 
             * give equal or less that that
             */
            'Max_number_columns_in_data_grid' => 20,
            /*
             * Title of the Page
             */
            'page_title' => 'Individual Entry Forms',
            /*
             * Can also be the tite of the List data table
             */
            'form_title' => 'Individual Customer',
            /*
             * Set to default FALSE, passed as parameter to this static method
             */
            'filter_by_user_id' => FALSE,
            /*
             * set to TRUE by default
             */
            'filter_by_entity_id' => TRUE,
            /*
             * Filteby any one column
             */
            'filter_by_col' => array(
                'customertype_ID' => "`customertype_ID` = '$customer_type_id[0]'"
             ),
            /*
             * Do the form have file upload
             * set to TRUE/False by default
             */             
            'Form_Need_to_upload_file' => TRUE,
            /*
             * Form content start here
             * 'form_content'
             */
            'form_content' => array(
                'ID' => array(
                    'filter' => TRUE,
                    'type' => 'hidden',
                    'value' => $form_data['ID'],
                    'label' => 'Customer ID'
                ),
                'FirstName' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['FirstName'],
                    'label' => 'First Name'
                ),
                'LastName' => array(    
                    'type' => 'text',
                    'value' => $form_data['LastName'],
                    'label' => 'Last Name'
                ),
                'CustomerGSTNo' => array(    
                    'type' => 'text',
                    'value' => $form_data['CustomerGSTNo'],
                    'label' => 'Customer GST No.'
                ),
                'customertype_ID' => array(  
                    'type' => 'select',
                    'value' => $form_data['customertype_ID'],
                    'label' => 'Customer Type',
                    'options' => $customer_type_sel
                ),                                               
                'Address' => array(
                    'type' => 'textarea',
                    'value' => $form_data['Address'],
                    'label' => 'Billing Address',
                    'number_of_rows' => 3
                ),
                'City' => array(
                    'type' => 'text',
                    'value' => $form_data['City'],
                    'label' => 'City'
                ),
                'Pincode' => array(
                    'type' => 'number',
                    'value' => $form_data['Pincode'],
                    'label' => 'Pin Code'
                ),
                'State' => array(
                    'type' => 'select',
                    'value' => $form_data['State'],
                    'label' => 'State / UT',
                    'options' => $states_option_data
                ),
                'Country' => array(
                    'type' => 'select',
                    'value' => $form_data['Country'],
                    'label' => 'Country',
                    'options' => $cont_option_data
                ),
                ' ' => array(
                    'name' => 'same_address',
                    'type' => 'checkbox',
                    'status' => 'onclick = "sameAddress()"',
                    'label' => 'Service Address is same as Billing Address'
                ),                
                'SAddress' => array(
                    'type' => 'textarea',
                    'status' => '',
                    'value' => $form_data['SAddress'],
                    'label' => 'Service Address',
                    'number_of_rows' => 3
                ),
                'SCity' => array(
                    'type' => 'text',
                    'value' => $form_data['SCity'],
                    'label' => 'City'
                ),
                'SPincode' => array(
                    'type' => 'number',
                    'value' => $form_data['SPincode'],
                    'label' => 'Pin Code'
                ),
                'SState' => array(
                    'type' => 'select',
                    'value' => $form_data['SState'],
                    'label' => 'State / UT',
                    'options' => $states_option_data
                ),
                'SCountry' => array(
                    'type' => 'select',
                    'value' => $form_data['SCountry'],
                    'label' => 'Country',
                    'options' => $cont_option_data
                ),
                'PhoneNo' => array(
                    'type' => 'number',
                    'value' => $form_data['PhoneNo'],
                    'label' => 'Phone No.'
                ),
                'MobileNo' => array(
                    'filter' => TRUE,
                    'type' => 'number',
                    'value' => $form_data['MobileNo'],
                    'label' => 'Mobile No.',
                    'status' => 'data-toggle="popover" data-trigger="focus" data-placement="top" data-content="MobileNo. must be a unique. Duplication not allowed."'
                ),
                'DateOfBirth' => array(
                    'type' => 'text',
                    'value' => $form_data['DateOfBirth' ],
                    'status' => 'data-provide="datepicker" data-date-format="yyyy-mm-dd" onclick="ycsdate()"',                    
                    'label' => 'Date Of Birth' 
                ),
                'Email' => array(
                    'filter' => FALSE,
                    'type' => 'email',
                    'value' => $form_data['Email'],
                    'status' => '',
                    'label' => 'Email ID',
                ),                       
                'package_ID' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['package_ID'],
                    'label' => 'Package ID',
                    'options' => $Data_rows,
                ),
                'IPAllocationType' => array(
                    'type' => 'select',
                    'value' => $form_data['IPAllocationType'],
                    'options' => $ip_allocation_type,                                                     
                    'label' => 'IP Allocation Type' 
                ),
                'IPType' => array(
                    'type' => 'select',
                    'value' => $form_data['IPType'],
                    'options' => $ip_type,                                   
                    'label' => 'IP Type' 
                ),                
                'AuthenticateUser' => array(
                    'type' => 'select',
                    'value' => $form_data['AuthenticateUser'],
                    'options' => $auth_usr,                                   
                    'label' => 'Authenticate User' 
                ),
                'Location' => array(
                    'type' => 'select',
                    'value' => $form_data['Location'],
                    'label' => 'AP Location',
                    'options' => $location_sel,
                    'status' => 'onchange = "apLoc('."'".$crg->get('route')['base_path']."','Location'".')"'                    
                ),                
                'ApSSID' => array(
                    'type' => 'select',
                    'value' => $form_data['ApSSID'],
                    'label' => 'AP SSID',
                    'options' =>'',
                    'status' => 'onchange = "apSSID('."'".$crg->get('route')['base_path']."','ApSSID'".')"'                                   
                ), 
                'ApIp' => array(
                    'type' => 'select',
                    'value' => $form_data['ApIp'],
                    'label' => 'AP IP',
                    'options' =>'',        
                    'status' => ''                    
                ), 
                'EquipmentMac' => array(
                    'type' => 'text',
                    'value' => $form_data['EquipmentMac'],
                    'label' => 'Client Equipment MAC'
                ),
                'EquipmentName' => array(
                    'type' => 'text',
                    'value' => $form_data['EquipmentName'],
                    'label' => 'Client Equipment Name'
                ),
                'EquipmentIp' => array(
                    'type' => 'text',
                    'value' => $form_data['EquipmentIp'],
                    'label' => 'Client Equipment IP'
                ),
                'Gateway' => array(
                    'type' => 'text',
                    'value' => $form_data['Gateway'],
                    'label' => 'Gateway'
                ),
                'RouterYN' => array(
                    'type' => 'select',
                    'value' => $form_data['RouterYN'],
                    'label' => 'Router',
                    'options' => $router_option_data
                ),
                'RecivedAmount' => array(
                    'type' => 'number',
                    'value' => $form_data['RecivedAmount'],
                    'label' => 'Total Amount Received'
                ),
                'RouterInstalAmount' => array(
                    'type' => 'number',
                    'value' => $form_data['RouterInstalAmount'],
                    'label' => 'Installation Charge / Router'
                ),
                'RefundAmount' => array(
                    'type' => 'number',
                    'value' => $form_data['RefundAmount'],
                    'label' => 'Refund Amount'
                ),
                'Reference' => array(
                    'type' => 'text',
                    'value' => $form_data['Reference'],
                    'label' => 'Reference'
                ),
                'PhotoUpload' => array(
                    'type' => 'file',
                    'value' => $form_data['PhotoUpload'],
                    'label' => 'Upload Photo'
                ),
                'IdProof' => array(
                    'type' => 'file',
                    'value' => $form_data['IdProof'],
                    'label' => 'ID Proof'
                ),
                'AddressProof' => array(
                    'type' => 'file',
                    'value' => $form_data['AddressProof'],
                    'label' => 'Address Proof'
                ),
                'OtherProof' => array(
                    'type' => 'file',
                    'value' => $form_data['OtherProof'],
                    'label' => 'Upload Others'
                ),
                'CafUpload' => array(
                    'type' => 'file',
                    'value' => $form_data['CafUpload'],
                    'label' => 'Upload CAF'
                ),
                'CustStatus' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['CustStatus'],
                    'label' => 'Customer Status',
                    'options' => $cust_status_sel,                    
                ),  
                'entity_ID' => array(
                    'type' => 'hidden',
                    'value' => $ses->get('user')['entity_ID'],
                    'label' => 'Entity ID'                    
                ),               
                'users_ID' => array(
                    'type' => 'hidden',
                    'value' => $ses->get('user')['ID'],
                    'label' => 'User ID' 
                )
            ),
            'form_footer' => array(            	          
                'clear' => array(
                    'type' => 'reset',
                    'label' => 'Clear'
                ),
                'submit_button' => array(
                    'type' => 'submit',
                    'label' => 'Submit'
                ),
                'list' => array(
                    'type' => 'link',
                    'label' => 'List'
                )
            )
        );
        /////////////////////

        return $FormConfig;
    }

}