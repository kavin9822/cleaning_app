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

        $cont_option_data = array(
            'IN' => 'India',
        );
            
       	    $actual_table_name = $crg->get('table_prefix') . 'customertype';
            $entityID = $ses->get('user')['entity_ID'];
            $sql = "SELECT `ID`,`Title` FROM `$actual_table_name` WHERE `Title` like 'enquiry%'";           
            $customer_type_sel = $dbutil->getSqlData($sql,12);

            $sqlcus = "SELECT `ID` FROM `$actual_table_name` WHERE `Title` like 'enquiry%' LIMIT 1";           
            $customer_type_id = $dbutil->getSqlData($sqlcus,7);
       	    //var_dump($customer_type_id[0]);   
            
            $plan_tbl = $crg->get('table_prefix') . 'plan';
            $sqlplan = "SELECT `ID`, `Title` FROM `$plan_tbl` WHERE entity_ID = $entityID";
            $plan_sel = $dbutil->getSqlData($sqlplan, 12);    

	    $table_prefix = $crg->get('table_prefix');
		
	if (isset($form_data['package_ID'])) {

            $actual_table_name_pac = $table_prefix . 'package';
            $sqlpac = "SELECT `ID`, `SMPackName` FROM `$actual_table_name_pac` WHERE `Plan` = '" . $form_data['Plan'] . "'";
            $package_ID_sel = $dbutil->getSqlData($sqlpac, 12);

            ///////////////////////////////////////////// CURL OPERATIONS STARTS //////////////////////////////////////////////////

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
   
///////////////////////////////////////////// CURL OPERATIONS CLOSES /////////////////////////////////////////////	     


            foreach ($package_ID_sel as $k => &$arr) {
                if (isset($pacData[$arr])) {
                    $arr = $pacData[$arr];
                } else {
                    unset($package_ID_sel[$k]);
                }
            } 

        } else {
            $package_ID_sel = [];
        }		   


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
            'max_number_form_elements_per_colum' => 9,
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
            'Max_number_columns_in_data_grid' => 8,
            /*
             * Title of the Page
             */
            'page_title' => 'Marketing Forms',
            /*
             * Can also be the tite of the List data table
             */
            'form_title' => 'Enquiry Form',
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
            'Form_Need_to_upload_file' => FALSE,
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
                'customertype_ID' => array(
                    'type' => 'select',
                    'value' => $form_data['customertype_ID'],
                    'label' => 'Customer Type',
                    'options' => $customer_type_sel                      
                ),
                'entity_ID' => array(
                    'type' => 'hidden',
                    'value' => $ses->get('user')['entity_ID'],
                    'label' => 'Entity ID'                    
                ),                             
                'Address' => array(
                    'type' => 'textarea',
                    'value' => $form_data['Address'],
                    'label' => 'Address',
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
                    'label' => 'State',
                    'options' => $states_option_data
                ),
                'Country' => array(
                    'type' => 'select',
                    'value' => $form_data['Country'],
                    'label' => 'Country',                    
                    'options' => $cont_option_data
                ),
                'MobileNo' => array(
                    'filter' => TRUE,
                    'type' => 'number',
                    'value' => $form_data['MobileNo'],
                    'label' => 'Mobile No.'
                ),
                'Email' => array(
                    'type' => 'email',
                    'value' => $form_data['Email'],
                    'label' => 'Email ID'
                ),
                'Plan' => array(
                    'type' => 'select',
                    'value' => $form_data['Plan'],
                    'label' => 'Plan',
                    'options' => $plan_sel,
                    'status' => 'onchange = "packageSel(' . "'" . $crg->get('route')['base_path'] . "','Plan'" . ')"'
                ),
                'package_ID' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['package_ID'],
                    'label' => 'Package',
                    'options' => $package_ID_sel,
                    'status' => ''
                ),           
                'Reference' => array(
                    'type' => 'text',
                    'value' => $form_data['Reference'],
                    'label' => 'Reference'
                ),
                'ADate' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['ADate'],
                    'status' => 'data-provide="datepicker" data-date-format="yyyy-mm-dd" onclick="ycsdate()"',
                    'label' => 'Appointment Date'
                ),
                'ATime' => array(
                    'type' => 'text',
                    'value' => $form_data['ATime'],
                    'status' => 'class="input-group bootstrap-timepicker timepicker input-small" onmouseover="ycstime()"',
                    'label' => 'Appointment Time'
                ),                                  
                'users_ID' => array(
                    'type' => 'hidden',                     
                    'value' => $ses->get('user')['ID'],
                    'status' => '',
                    'label' => 'Users ID' 
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