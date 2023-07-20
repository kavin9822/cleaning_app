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

                
        $active_option_data =  array(
            'Y'=>'Yes',
            'N'=> 'No'
        );   
        
        $dept_tab = $crg->get('table_prefix') . 'department';
        $dept_sql = "SELECT ID,DeptName FROM $dept_tab ORDER BY ID DESC";
        $dept_option_data = $dbutil->getSqlData($dept_sql, 12);

        $designation_tab = $crg->get('table_prefix') . 'designation';
        $desgn_sql = "SELECT ID,DesignationName FROM $designation_tab ORDER BY ID DESC";
        $designation_option_data = $dbutil->getSqlData($desgn_sql, 12);
        
        $state_tab = $crg->get('table_prefix') . 'state';
        $state_sql = "SELECT ID,StateName FROM $state_tab ORDER BY ID DESC";
        $state_option_data = $dbutil->getSqlData($state_sql, 12);
        
        $country_tab = $crg->get('table_prefix') . 'country';
        $country_sql = "SELECT ID,CountryName FROM $country_tab ORDER BY ID DESC";
        $country_option_data = $dbutil->getSqlData($country_sql, 12);

        $FormConfig = array(
            /*
             * 
             * Do not use prefix in table name
             * Example in ycs_user
             * enter as user
             * 
             * 'database_table_name' =>'user',
             */

            'table_name' => 'employee',
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
            'unique_key_required'=> TRUE,
            /*
             * Based on a colum name first three letters
             */
            
            'unique_key_prefix'=> 'MFG',
            
            'uniq_key_col' => 'EmpCode',
            
            /*
             * Unique key suffix
             * get unique key sufix from value filled in a field
             * or colun name
             */
            'unique_key_suffix_from_column_name' => '',
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
            'Max_number_columns_in_data_grid' => 10,
            /*
             * Title of the Page
             */
            'page_title' => 'Static Data',
            /*
             * Can also be the tite of the List data table
             */
            'form_title' => 'Employee',
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
                    'label' => 'Employee ID'
                ),
                'entity_ID' => array(
                    'type' => 'hidden',
                    'value' => $ses->get('user')['entity_ID'],
                    'label' => 'Entity'                    
                ),                
	      	  'users_ID' => array(
                    'type' => 'hidden',
                    'value' => $ses->get('user')['ID'],
                    'label' => 'User ID'
                ),
                // 'employeetype_ID' => array(
                //     'filter' => TRUE,
                //     'type' => 'text',
                //     'value' => $form_data['employeetype_ID'],
                //     'label' => 'Employee ID'
                // ),
                'EmpCode' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['EmpCode'],
                    'label' => 'Employee Code',
                    'status'=>'readonly'
                ),
                'EmpName' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['EmpName'],
                    'label' => 'Employee Name',
                    'status'=>'required'
                ),
                'Department_ID' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['Department_ID'],
                    'label' => 'Department',
                    'options' => $dept_option_data,
                    'status'=>'required'
                ),
                'Designation_ID' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['Designation_ID'],
                    'label' => 'Designation',
                    'options' => $designation_option_data,
                    'status'=>'required'
                ),
                'AddressLine1' => array(
                    'type' => 'textarea',
                    'value' => $form_data['AddressLine1'],
                    'label' => 'AddressLine 1',
                    'number_of_rows'=>3,
                    'status'=>''
                ),
                'AddressLine2' => array(
                    'type' => 'textarea',
                    'value' => $form_data['AddressLine2'],
                    'label' => 'AddressLine 2',
                    'number_of_rows'=>3,
                    'status'=>''
                ),
                'City' => array(
                    'type' => 'text',
                    'value' => $form_data['City'],
                    'label' => 'City',
                    'status' => 'required'
                ),
                'State_ID' => array(
                    'type' => 'select',
                    'value' => $form_data['State_ID'],
                    'label' => 'State',
                    'options' =>$state_option_data,
                    'status' => 'required'
                ),
                'Country_ID' => array(
                    'type' => 'select',
                    'value' => $form_data['Country_ID'],
                    'label' => 'Country',
                    'options' =>$country_option_data,
                    'status' => 'required'
                ),
                'City' => array(
                    'type' => 'text',
                    'value' => $form_data['City'],
                    'label' => 'City',
                    'status' => 'required'
                ),
                'Pincode' => array(
                    'type' => 'text',
                    'value' => $form_data['Pincode'],
                    'label' => 'Pin Code',
                    'status' => 'onkeypress="return onlyNumberKey(event);"'
                ),
                'MobileNo' => array(
                    'type' => 'text',
                    'value' => $form_data['MobileNo'],
                    'label' => 'Mobile No',
                    'status' => 'onkeypress="return onlyNumberKey(event);"'
                ),
                'ContactNo' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['ContactNo'],
                    'label' => 'Emergency Contact No',
                    'status'=>'onkeypress="return onlyNumberKey(event);" required'
                ),
                'DOB' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['DOB'],
                    'label' => 'DOB',
                    'status'=>'data-provide="datetimepicker" data-date-format="YYYY-MM-DD" onclick="ycsdate(this.id)" required'
                ),
                'Email' => array(
		           'filter' => TRUE,                
                    'type' => 'email',
                    'value' => $form_data['Email'],
                    'label' => 'Email ID',
                    'status'=>'required'
                ),
                'Active' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['Active'],
                    'label' => 'Active',
                    'options' => $active_option_data,
                    'status'=>'required'
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