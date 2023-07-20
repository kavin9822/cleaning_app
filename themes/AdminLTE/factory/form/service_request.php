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
        
        include_once 'util/DBUTIL.php';
        $dbutil = new DBUTIL($crg);
        
        $statuss_option_data = array(
            'Open' => 'Open',
            'Closed' => 'Closed',
            'In Progress' => 'In Progress'
        );

        $cont_option_data = array(
            'IN' => 'India',
        );  
        
        $yn_option = array(
            'YES' => 'Y',
            'NO' => 'N'
        );
        
        $os_option = array(
            'WindowsXP' => 'Windows XP',
            'Windows7' => 'Windows 7',
            'Windows8' => 'Windows 8',
            'Windows10' => 'Windows 10',
            'Mac' => 'Mac',
            'Linux' => 'Linux',
            'Ubuntu' => 'Ubuntu'
        );   
        
        $net_connection_option = array(
            'Connected' => 'Connected',
            'Limited' => 'Limited'
        );          
  
      	    $actual_table_name = $crg->get('table_prefix') . 'customer';
            $entityID = $ses->get('user')['entity_ID'];
            $sql = "SELECT `ID`, `FirstName` FROM `$actual_table_name` WHERE `entity_ID` = $entityID && `customertype_ID`=1";
            $customer_ID_sel = $dbutil->getSqlData($sql, 12);

	    $actual_table_name_emp = $crg->get('table_prefix') . 'employee';
            //same as above so no need, it is entity id from login user session
            //$entityID = $ses->get('user')['entity_ID'];
            $sqlemp = "SELECT `ID`, `Name` FROM `$actual_table_name_emp` WHERE `entity_ID` = $entityID";
            $employee_ID_sel = $dbutil->getSqlData($sqlemp, 12);


        $FormConfig = array(
            /*
             * 
             * Do not use prefix in table name
             * Example in ycs_user
             * enter as user
             * 
             * 'database_table_name' =>'user',
             */

            'table_name' => 'servicerequest',
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
            
            'unique_key_prefix'=> 'SRR',
            
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
            'max_number_form_elements_per_colum' => 12,
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
            'Max_number_columns_in_data_grid' => 12,
            /*
             * Title of the Page
             */
            'page_title' => 'Individual Customer Forms',
            /*
             * Can also be the tite of the List data table
             */
            'form_title' => 'Service Request',
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
            	'entity_ID' => "`entity_ID` = ". $ses->get('user')['entity_ID'],
               // 'customer_ID' => "`customer_ID` = ". $customer_ID_sel
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
                    'label' => 'ServiceRequest ID'
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
                ),
                'customer_ID' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['customer_ID'],
                    'label' => 'Customer ID',
                    'options' => $customer_ID_sel
                ),
                'CallAttendEmpID' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['CallAttendEmpID'],
                    'label' => 'Call Attend Employee',
                    'options' => $employee_ID_sel
                ),                
                'Complaint' => array(
                    'type' => 'textarea',
                    'value' => $form_data['Complaint'],
                    'label' => 'Complaint'
                ),
                'SrDate' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['SrDate'],
                    'status' => 'data-provide="datepicker" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" onclick="ycsdate()"',
                    'label' => 'Service Date'
                ),
                'SrTime' => array(
                    'type' => 'text',
                    'value' => $form_data['SrTime'],
                    'label' => 'Service Time',
                    'status' => ''
                ),               
                'ServTechnicianEmpID' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['ServTechnicianEmpID'],
                    'label' => 'Service Technician Employee',
                    'options' => $employee_ID_sel
                ),
                'CurrentStatus' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['CurrentStatus'],
                    'label' => 'Status',
                    'options' => $statuss_option_data
                ),
                'SrCloseDate' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['SrCloseDate'],
                    'status' => 'data-provide="datepicker" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" onclick="ycsdate()"',
                    'label' => 'Service Close Date'
                ),
                'SrCloseTime' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['SrCloseTime'],
                    'label' => 'Service Close Time',
                    'status' => ''
                ),
                'Remark' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['Remark'],
                    'label' => 'Remark'
                ),
                'LanConnectedYN' => array(           
                    'type' => 'select',
                    'option' => $yn_option,
                    'value' => $form_data['LanConnectedYN'],
                    'label' => 'Lan Connected'
                ),	
                'AdopterOnYN' => array(                
                    'type' => 'select',
                    'option' => $yn_option,
                    'value' => $form_data['AdopterOnYN'],
                    'label' => 'Adopter On'
                ),
                'OperatingSystem' => array(                  
                    'type' => 'select',
                    'option' => $os_option,
                    'value' => $form_data['OperatingSystem'],
                    'label' => 'Operating System'
                ),	
                'NetworkConnection' => array(               
                    'type' => 'select',
                    'option' => $net_connection_option,
                    'value' => $form_data['NetworkConnection'],
                    'label' => 'Network Connection'
                ),	
                'PingRouterTestYN' => array(               
                    'type' => 'select',
                    'option' => $yn_option,
                    'value' => $form_data['PingRouterTestYN'],
                    'label' => 'Ping Router Test'
                ),
                'PingLanTestYN' => array(                  
                    'type' => 'select',
                    'option' => $yn_option,
                    'value' => $form_data['PingLanTestYN'],
                    'label' => 'Ping Lan Test'
                ),
                'DeviceOnYN' => array(                  
                    'type' => 'select',
                    'option' => $yn_option,
                    'value' => $form_data['DeviceOnYN'],
                    'label' => 'Device On'
                ),
                'LanWireConnectedYN' => array(                  
                    'type' => 'select',
                    'option' => $yn_option,
                    'value' => $form_data['LanWireConnectedYN'],
                    'label' => 'Lan Wire Connected'
                ),
                'WifyRouterYN' => array(                  
                    'type' => 'select',
                    'option' => $yn_option,
                    'value' => $form_data['WifyRouterYN'],
                    'label' => 'Wify Router'
                ),
                'PortCheckReachedYN' => array(                  
                    'type' => 'select',
                    'option' => $yn_option,
                    'value' => $form_data['PortCheckReachedYN'],
                    'label' => 'Port Check Reached'
                ),
                'WifyMobileCheckYN' => array(                  
                    'type' => 'select',
                    'option' => $yn_option,
                    'value' => $form_data['WifyMobileCheckYN'],
                    'label' => 'Wify Mobile Check'
                ),
                
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