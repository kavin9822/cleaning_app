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

        //var_dump($ses->get('acc_type_option_data'));
	$actual_table_name = $crg->get('table_prefix') . 'accounttype';
        //$entityID = $ses->get('user')['entity_ID'];
        $sql = "SELECT `ID`, `AccountType` FROM `$actual_table_name`";           
        $account_ID_sel = $dbutil->getSqlData($sql, 12);	

        $FormConfig = array(
            /*
             * 
             * Do not use prefix in table name
             * Example in ycs_user
             * enter as user
             * 
             * 'database_table_name' =>'user',
             */

            'table_name' => 'balancesheet',
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
             */

            //'unique_key_prefix'=> 'BLS',

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
            'page_title' => 'Sales',
            /*
             * Can also be the tite of the List data table
             */
            'form_title' => 'Balance Sheet',
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
                'ClosingDate' => date('Y-m-d')
            ),
            /*
             * Do the form have file upload
             * set to TRUE/False by default
             */
            'Form_Need_to_upload_file' => FALSE,
            'Custom_crud_paginated_table_complete_path' => 'factory/template/application/balancesheet_crud_paginated_table.php',
            /*
             * Form content start here
             * 'form_content'
             */
            'form_content' => array(
                'ID' => array(
                    'filter' => TRUE,
                    'type' => 'hidden',
                    'value' => $form_data['ID'],
                    'label' => 'ID'
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
                'AccountType' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['AccountType'],
                    'label' => 'Account Type',
                    'options' => $account_ID_sel
                ),
                'OpeningBalance' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['OpeningBalance'],
                    'label' => 'Opening Balance'
                ),
                'ClosingBalance' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['ClosingBalance'],
                    'label' => 'Closing Balance'
                ),                
                'ClosingDate' => array(
                    'filter' => TRUE,
                    'type' => 'date',
                    'value' => date('Y-m-d'),
                   
                    'label' => 'Closing Date'
                ),
                'PostedYN' => array(
                    'type' => 'date',
                    'value' => $form_data['PostedYN'],
                    
                    'label' => 'Posted Y/N'
                ),
            ),
            'form_footer' => array(
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
