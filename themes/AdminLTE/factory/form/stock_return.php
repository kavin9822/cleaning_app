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
        
        $entityID = $ses->get('user')['entity_ID'];

        $item_tab = $crg->get('table_prefix') . 'item';
        $sql_itm = "SELECT `ID`,`ItemName` FROM `$item_tab`";
        $item_sel_data = $dbutil->getSqlData($sql_itm, 12);
        
        $employee_tab = $crg->get('table_prefix') . 'employee';
        $sql_str = "SELECT `ID`,`EmpName` FROM `$employee_tab`";
        $employee_sel_data = $dbutil->getSqlData($sql_str, 12);
        
        $tankdet_tab = $crg->get('table_prefix') . 'tankdetail';
        $sec_sql = "SELECT DISTINCT `TankLocation`,`TankLocation` FROM `$tankdet_tab` WHERE entity_ID=$entityID";
        $section_sel_data = $dbutil->getSqlData($sec_sql, 12);
        $section_sel_data = array('Maturation' => 'Maturation','Canteen'=>'Canteen') + $section_sel_data;
    
        
        if (isset($form_data['ReceiptDate'])) {
                  $form_data['ReceiptDate']=date('d-m-Y',strtotime($form_data['ReceiptDate']));
              } else {
                  $form_data['ReceiptDate']=date('d-m-Y');
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

            'table_name' => 'stockreturn',
            /*
             * Primary key ID column required in the pagination list
             * 
             */
            'ID_column_required' => FALSE,
            
            'Stock_Update'=> TRUE,
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
            
           'unique_key_prefix'=> 'pod',
            
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
            'max_number_form_elements_per_colum' => 14,
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
            'page_title' => 'Store',
            /*
             * Can also be the tite of the List data table
             */
            'form_title' => 'Stock Return',
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
                    'label' => 'Users ID'   
                ),
                'ItemName' => array(
                    'type' => 'hidden',
                    'value' => '',
                ),
                 'item_ID' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['item_ID'],
                    'label' => 'Item Name',
                    'options' => $item_sel_data,
                    'status' => 'onchange="getItemNameCrud(this.id,'."'ItemName'".')"',
                ),
                'EmployeeName' => array(
                    'type' => 'hidden',
                    'value' => '',
                    'status' => '',
                    ),
                'employee_ID' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['employee_ID'],
                    'label' => 'Employee',
                    'options' => $employee_sel_data,
                    'status' => 'onchange="getItemNameCrud(this.id,'."'EmployeeName'".')"',
                ),
                'Section' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['Section'],
                    'label' => 'Section',
                    'options' => $section_sel_data,
                    'status' => '',
                ),
                'ReceiptDate' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['ReceiptDate'],
                    'status' => 'data-provide="datetimepicker" data-date-format="DD-MM-YYYY" onclick="ycsdate(this.id)"',
                    'label' => 'Receipt Date'
                ),
                 'Quantity' => array(
                     'filter' => TRUE,
                    'type' => 'number',
                    'value' => $form_data['Quantity'],
                    'label' => 'Quantity',
                    'status' => '',
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
