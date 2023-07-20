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
        
        $state_tab = $crg->get('table_prefix') . 'state';
        $country_tab = $crg->get('table_prefix') . 'country';
        $statecountrymap_tab = $crg->get('table_prefix') . 'statecountrymap';
        //$entityID = $ses->get('user')['entity_ID'];
        
        // $state_sql = "SELECT ID,StateName FROM $state_tab";
        // $states_option_data = $dbutil->getSqlData($state_sql, 12);
        
        $country_sql = "SELECT ID,CountryName FROM $country_tab";
        $country_option_data = $dbutil->getSqlData($country_sql, 12);
        
        if(isset($form_data['state_ID'])){
            
         $sqlstate = "SELECT $state_tab.ID,$state_tab.StateName FROM $state_tab,$statecountrymap_tab WHERE $statecountrymap_tab.country_ID = '".$form_data['country_ID']."' AND $state_tab.ID=$statecountrymap_tab.state_ID ORDER BY $state_tab.StateName";
         $states_option_data = $dbutil->getSqlData($sqlstate, 12);         
      
        } else {
         $states_option_data = [];
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

            'table_name' => 'supplier',
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
            'unique_key_required' => TRUE,
            /*
             * Based on a colum name first three letters
             */
            'unique_key_prefix' => 'SUP',
             /*
             * Unique key column used to generate and store unique key
             */
            'uniq_key_col' => 'SupplierCode',
            /*
             * Unique key suffix
             * get unique key sufix from value filled in a field
             * or colun name
             */
            'unique_key_suffix_from_column_name' => 'City',
            /*
             * Form limit 
             * Number of form elemens per column
             */
            'max_number_form_elements_per_colum' => 10,
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
            'page_title' => 'Static Data',
            /*
             * Can also be the tite of the List data table
             */
            'form_title' => 'Supplier',
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
                    'filter' => TRUE,
                    'type' => 'hidden',
                    'value' => $form_data['ID'],
                    'label' => 'Supplier ID'
                ),
                'entity_ID' => array(
                    'type' => 'hidden',
                    'value' => $ses->get('user')['entity_ID'],
                    'label' => 'Entity'                    
                ),
		        'CreatedUserID' => array(
                    'type' => 'hidden',
                    'value' => $ses->get('user')['ID'],
                    'label' => 'User ID'
                ),
                'Company' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['Company'],
                    'label' => 'Company Name',
                   
                    
                ),
                'ContactPerson' => array(
                    'type' => 'text',
                    'value' => $form_data['ContactPerson'],
                    'label' => 'Contact Person',
                    
                ),
                'country_ID' => array(
                    'type' => 'select',
                    'value' => $form_data['country_ID'],
                    'label' => 'Country',
                    'options' => $country_option_data,
                    'status' => 'onchange="getState('."'".$crg->get('route')['base_path']."',this.value,'state_ID'".')"'
                ),
                'Address' => array(
                    'type' => 'textarea',
                    'value' => $form_data['Address'],
                    'label' => 'Address',
                    'number_of_rows' => 4,
                    'status' => ''
                ),
                'City' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['City'],
                    'label' => 'City',
                    
                ),
                'Pincode' => array(
                    'type' => 'text',
                    'value' => $form_data['Pincode'],
                    'label' => 'Pin Code',
                    'status' => 'onkeypress="return onlyNumberKey(event);"'
                ),
                'state_ID' => array(
                    'type' => 'select',
                    'value' => $form_data['state_ID'],
                    'label' => 'State',
                    'options' => $states_option_data,
                ),
                
                'PhoneNo' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['PhoneNo'],
                    'label' => 'Phone No.'
                ),
                'MobileNo' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['MobileNo'],
                    'label' => 'Mobile No.',
                    'status' => 'onkeypress="return onlyNumberKey(event);"'
                ),
                'Email' => array(
                    'type' => 'email',
                    'value' => $form_data['Email'],
                    'label' => 'Email',
                    'status' => ''
                ),
                'BankName' => array(
                    'type' => 'text',
                    'value' => $form_data['BankName'],
                    'label' => 'Bank Name'
                ),
                'BankBranch' => array(
                    'type' => 'text',
                    'value' => $form_data['BankBranch'],
                    'label' => 'Bank Branch'
                ),
                'BankAccountNo' => array(
                    'type' => 'text',
                    'value' => $form_data['BankAccountNo'],
                    'label' => 'Bank Account No.'
                ),
                'BankIFSC' => array(
                    'type' => 'text',
                    'value' => $form_data['BankIFSC'],
                    'label' => 'Bank IFSC'
                ),
                'TinNo' => array(
                    'type' => 'text',
                    'value' => $form_data['TinNo'],
                    'label' => 'GST No.'
                ),
                'CstNo' => array(
                    'type' => 'text',
                    'value' => $form_data['CstNo'],
                    'label' => 'CST No.'
                )
            ),
            'form_footer' => array(
                'clear' => array(
                    'type' => 'reset',
                    'label' => 'Clear'
                ),
                'submit_button' => array(
                    'type' => 'submit',
                    'label' => 'Submit',
                    'status' => 'onclick="addRequired('. "'Company','City','MobileNo'".')" onmouseover="addRequired('. "'Company','City','MobileNo'".')" onfocus="addRequired('. "'Company','City','MobileNo'".')"'
                ),
                'list' => array(
                    'type' => 'link',
                    'label' => 'List',
                    'status' => ''
                )
            )
        );
        /////////////////////

        return $FormConfig;
    }

}
