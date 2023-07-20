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

        $states_option_data = array(
            'TN' => 'Tamil Nadu',
            'PY' => 'Pondicherry'
        );

        $router_option_data = array(
            'Y' => 'Yes',
            'N' => 'No'
        );

        $cont_option_data = array(
            'IN' => 'India',
        );        

	    $actual_table_name = $crg->get('table_prefix') . 'customertype';
            $entityID = $ses->get('user')['entity_ID'];
            $sql = "SELECT `ID`,`Title` FROM `$actual_table_name`";           
            $customer_type_sel = $dbutil->getSqlData($sql,12); 
	    // var_dump($customer_type_sel);
            
        if (!$ses->get('customer_status_option_data')) {
            $cust_status_selectBoxData = $dbutil->selectKeyVal('customerstatus','ID','CustStatus');
            $ses->set('customer_status_option_data', $cust_status_selectBoxData);
        } else {
            $cust_status_selectBoxData = $ses->get('customer_status_option_data');
        }
        
        $actual_table_name_pac = $crg->get('table_prefix') . 'package';
        $sqlpac = "SELECT `ID`, `Name` FROM `$actual_table_name_pac` WHERE `entity_ID` = $entityID"; 
        $package_ID_sel = $dbutil->getSqlData($sqlpac, 12);         
        
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
            'max_number_form_elements_per_colum' => 20,
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
            'page_title' => 'Report',
            /*
             * Can also be the tite of the List data table
             */
            'form_title' => 'Individual/Corporate/Enquiry - Customer List',
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
                'CompanyName' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['CompanyName'],
                    'label' => 'Company Name'
                ),
                'customertype_ID' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['customertype_ID'],
                    'label' => 'Customer Type',
                    'options' => $customer_type_sel
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
                'PhoneNo' => array(
                    'type' => 'number',
                    'value' => $form_data['PhoneNo'],
                    'label' => 'Phone No.'
                ),
                'MobileNo' => array(
                    'filter' => TRUE,
                    'type' => 'number',
                    'value' => $form_data['MobileNo'],
                    'label' => 'Mobile No.'
                ),                
                'Email' => array(
                    'filter' => FALSE,
                    'type' => 'email',
                    'value' => $form_data['Email'],
                    'status' => '',
                    'label' => 'Email ID'
                ),                           
                'package_ID' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['package_ID'],
                    'label' => 'Package ID',
                    'options' => $package_ID_sel
                ),
                'PackageType' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['PackageType'],
                    'label' => 'Package Type'
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
                'CustStatus' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['CustStatus'],
                    'label' => 'Customer Status',
                    'options' => $cust_status_selectBoxData                    
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
                    'label' => 'Submit Customer Form'
                ),
                'list' => array(
                    'type' => 'link',
                    'label' => 'List Customers'
                )
            )
        );
        /////////////////////

        return $FormConfig;
    }

}


