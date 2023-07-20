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

        $cont_option_data = array(
            'IN' => 'India',
        );

        $payterm_option_data = array(
            'Prepaid' => 'Prepaid',
            'Postpaid' => 'Postpaid'
        );

        if (!$ses->get('corp_Customer_Type_Id')) {
            $actual_customertype_table = $crg->get('table_prefix') . 'customertype';
            $mySqlQry = "SELECT `ID` FROM `$actual_customertype_table` WHERE `Title` like 'corporate%'";
            $corp_Cust_Type_Id_arr = $dbutil->getSqlData($mySqlQry);
            $corp_Cust_Type_Id = $corp_Cust_Type_Id_arr[0]['ID']; 
            $ses->set('corp_Customer_Type_Id', $corp_Cust_Type_Id);
        } else {

            $corp_Cust_Type_Id = $ses->get('corp_Customer_Type_Id');
        }
        
        $actual_table_name_pac = $crg->get('table_prefix') . 'package';
        $sqlpac = "SELECT `ID`, `Name` FROM `$actual_table_name_pac` WHERE `entity_ID` = $entityID"; 
        $package_ID_sel = $dbutil->getSqlData($sqlpac, 12);  
        
        $custstat_table = $crg->get('table_prefix') . 'customerstatus';            
        $sql = "SELECT `ID`,`CustStatus` FROM `$custstat_table`";           
        $cust_status_sel = $dbutil->getSqlData($sql,12);

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
            'unique_key_required' => TRUE,
            /*
             * Based on a colum name first three letters
             */
            'unique_key_prefix' => 'CUS',
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
            'max_number_form_elements_per_colum' => 17,
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
            'Max_number_columns_in_data_grid' => 13,
            /*
             * Title of the Page
             */
            'page_title' => 'Corporate Entry Forms',
            /*
             * Can also be the tite of the List data table
             */
            'form_title' => 'Corporate Customer / IBS Master',
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
             * Filteby any one column
             */
            'filter_by_col' => array(
            	'entity_ID' => "`entity_ID` = ". $ses->get('user')['entity_ID'],
                'customertype_ID' => "`customertype_ID` = ". $corp_Cust_Type_Id
            ),
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
                'CompanyName' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['CompanyName'],
                    'label' => 'Company Name'
                ),
                'FirstName' => array(            
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
                    'options' => null
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
                'SAddress' => array(
                    'type' => 'textarea',
                    'value' => $form_data['SAddress'],
                    'status' => '',
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
                    'label' => 'State',
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
                    'label' => 'Mobile No.'
                ),
                'Email' => array(
                    'type' => 'email',
                    'value' => $form_data['Email'],
                    'label' => 'Email ID'
                ),
                'PaymentTerms' => array(
                    'type' => 'select',
                    'value' => $form_data['PaymentTerms'],
                    'label' => 'Payment Terms',
                    'options' => $payterm_option_data
                ),
                'PackageType' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['PackageType'],
                    'label' => 'Package Type'
                ),
                'Amount' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['Amount'],
                    'label' => 'Package Amount'
                ),
                'Location' => array(
                    'type' => 'text',
                    'value' => $form_data['Location'],
                    'label' => 'AP Location'
                ),                
                'ApIp' => array(
                    'type' => 'text',
                    'value' => $form_data['ApIp'],
                    'label' => 'AP IP'
                ),
                'ApSSID' => array(
                    'type' => 'text',
                    'value' => $form_data['ApSSID'],
                    'label' => 'AP SSID'
                ),
                'EquipmentMac' => array(
                    'type' => 'text',
                    'value' => $form_data['EquipmentMac'],
                    'label' => 'Equipment MAC'
                ),
                'EquipmentName' => array(
                    'type' => 'text',
                    'value' => $form_data['EquipmentName'],
                    'label' => 'Equipment Name'
                ),
                'EquipmentIp' => array(
                    'type' => 'text',
                    'value' => $form_data['EquipmentIp'],
                    'label' => 'Equipment IP'
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
                'users_ID' => array(
                    'type' => 'hidden',
                    'value' => $ses->get('user')['ID'],
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
