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
///////////////////////////////////////////////////////////////
    $userEntityId = $ses->get('user')['entity_ID'];
    
    $table2 = $crg->get('table_prefix') . 'package';
        $colArr = array(
            "$table2.ID",
            "$table2.SMPackName"
        );
        
        $sql = "SELECT "
                . implode(',', $colArr)
                . " FROM $table2"
                . " WHERE "
                . " $table2.entity_ID = $userEntityId AND " 
                . "($table2.SMPackName IS NOT NULL AND " 
                . "$table2.SMPackName  <> '')"; 
       $change_package_data = $dbutil->getSqlData($sql, 12);    
       
      if(isset($form_data[package_ID])){
    $pack = $form_data[package_ID];
    }else {
    $pack ='';
    }

///////////////////////////////////////////////////////////////   

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

foreach ($change_package_data as $k => &$arr) {
                             /* If value exists in $pacData then assign it to $arr
                              * Otherwise, unset this array key
                              */
   		if (isset($pacData[$arr])) {
       			$arr = $pacData[$arr];  
   			} else {
       			unset($change_package_data[$k]);
   			}
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
            'ID_column_required' => FALSE,
            /*
             * If u want uniqe key then set the following 2 variables
             * used in creating unique key
             * 
             * 'unique_key_required'=> FALSE,
             * for primary key Id - is autoincriment - number
             */
            'unique_key_required' => FALSE,
            /*
             * Based on a colum name first three letters
             * 
             */
            'unique_key_prefix' => 'cus',
            /*
             * Unique key suffix
             * get unique key sufix from value filled in a field
             * or colun name
             */
            //'unique_key_suffix_from_column_name' => 'Country',
            /*
             * Form limit 
             * Number of form elemens per column
             */
            'max_number_form_elements_per_colum' => 7,
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
            'Max_number_columns_in_data_grid' => 10,
            /*
             * Title of the Page
             */
            'page_title' => 'SmartGuard Forms',
            /*
             * Can also be the tite of the List data table
             */
            'form_title' => 'Change User Package',
            /*
             * Set to default FALSE, passed as parameter to this static method
             */
            'filter_by_user_id' => FALSE,
            /*
             * set to TRUE by default
             */
            'filter_by_entity_id' => TRUE,
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
                    'filter' => FALSE,
                    'type' => 'hidden',
                    'value' => $form_data['ID'],
                    'label' => 'Package ID'
                ),
                'entity_ID' => array(
                    'type' => 'hidden',
                    'value' => $ses->get('user')['entity_ID'],
                    'label' => 'Entity ID'
                ),
                'users_ID' => array(
                    'type' => 'hidden',
                    'value' => $ses->get('user')['ID'],
                    'label' => 'Users ID'
                ),
                'package_ID' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['package_ID'],
                    'label' => 'Smartguard Package',
                    'options' => $change_package_data,
                    'selected' => $pack,
                    'default' => 'na'
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