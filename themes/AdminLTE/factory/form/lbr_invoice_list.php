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
       
        
        $actual_table_name = $crg->get('table_prefix') . 'customertype';
        $entityID = $ses->get('user')['entity_ID'];
        $sql = "SELECT `ID` FROM `$actual_table_name` WHERE `Title` like 'individual%' LIMIT 1";           
        $customer_type_id = $dbutil->getSqlData($sql,7);    
        
        $paymentmode_table = $crg->get('table_prefix') . 'paymentmode';
        $pmsql = "SELECT `ID`,`Paymode` FROM $paymentmode_table";           
        $PaymentMode_option_data = $dbutil->getSqlData($pmsql,12); 

	$customer_table = $crg->get('table_prefix') . 'customer';
        $cstsql = "SELECT `ID`,`FirstName` FROM $customer_table WHERE `customertype_ID`=1 AND `entity_ID`=$entityID";           
        $customer_ID_option_data = $dbutil->getSqlData($cstsql,12);    
        

        $FormConfig = array(
            /*
             * 
             * Do not use prefix in table name
             * Example in ycs_user
             * enter as user
             * 
             * 'database_table_name' =>'user',
             */

            'table_name' => 'invoicemaster',
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
            'unique_key_required'=> FALSE,
            /*
             * Based on a colum name first three letters
             */
            
            //'unique_key_prefix'=> 'Inv',
            
            /*
             * Unique key suffix
             * get unique key sufix from value filled in a field
             * or colun name
             */
            //'unique_key_suffix_from_column_name' => 'InvoiceType',
            /*
             * Form limit 
             * Number of form elemens per column
             */
            'max_number_form_elements_per_colum' => 4,
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
            'page_title' => 'Invoice',
            /*
             * Can also be the tite of the List data table
             */
            'form_title' => 'Labour Invoice Form',
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
                'InvoiceType' => "`InvoiceType` = 'Labour'"
             ),
            /*
             * Do the form have file upload
             * set to TRUE/False by default
             */
            'Form_Need_to_upload_file' => FALSE,
            
            
            'Custom_crud_paginated_table_complete_path'=>'factory/template/application/crud_paginated_table_with_Del_view.php',
            /*
             * Form content start here
             * 'form_content'
             */
            'form_content' => array(
                'ID' => array(
                    'filter' => TRUE,
                    'type' => 'hidden',
                    'value' => $form_data['ID'],
                    'label' => 'Invoice No.'
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
                'customer_ID' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['customer_ID'],
                    'label' => 'Customer ID',
                    'options' => $customer_ID_option_data
                ),                
                'InvoiceType' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['InvoiceType'],
                    'label' => 'Invoice Type'
                ),                
                'InvoiceDate' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['InvoiceDate'],
                    'label' => 'Invoice Date'
                ),
                'PaymentMode' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['PaymentMode'],
                    'label' => 'Payment Mode',
                    'options' => $PaymentMode_option_data
                ) 
            ),
            'form_footer' => array(
                'list' => array(
                    'type' => 'link',
                    'label' => 'List Invoice'
                )
            )
        );
        /////////////////////

        return $FormConfig;
    }

}
