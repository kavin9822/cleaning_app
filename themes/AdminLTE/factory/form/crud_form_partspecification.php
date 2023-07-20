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

       
        
        $cust_table = $crg->get('table_prefix') .'customer';
        $cust_sql = "SELECT `ID`,`FirstName` FROM `$cust_table`";
        $cust_sel_data = $dbutil->getSqlData($cust_sql, 12);
        
        $pdt_table = $crg->get('table_prefix') . 'product';
        $pdt_sql = "SELECT `ID`,Concat(`ItemName`,' ', Description ) as ItemName FROM `$pdt_table`";
        $pdt_sel_data = $dbutil->getSqlData($pdt_sql, 12);
        
        $emp_table = $crg->get('table_prefix') . 'employee';
        $emp_sql = "SELECT `ID`,`EmpName` FROM `$emp_table`";
        $emp_sel_data = $dbutil->getSqlData($emp_sql, 12);
        
        $partspectype_sel_data=array(
            'Automobile'=>'Automobile',
            'NonAutomobile'=>'Non Automobile'
            );
        
       
        $FormConfig = array(
            /*
             * 
             * Do not use prefix in table name
             * Example in ycs_user
             * enter as user
             * 
             * 'database_table_name' =>'user',
             */

            'table_name' => 'partspecmaster',
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
            
            'unique_key_prefix'=> 'PRD',
            
            /*
             * Unique key suffix
             * get unique key sufix from value filled in a field
             * or colun name
             */
          //  'unique_key_suffix_from_column_name' => 'Country',
            
            /*
             * Unique key column used to generate and store unique key
             */
            'uniq_key_col' =>'BatchNo',
            /*
             * Form limit 
             * Number of form elemens per column
             */
            'max_number_form_elements_per_colum' =>15,
            /*
             * Max number of rows in crud2
             * we will do this in next version
             */
            //'List_max_number_rows' => 10,
            
            /*
             * maintinaing a history table log, ensure that you created the history table in db.
             */
            'maintain_history_log_table' => FALSE,
            
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
            'Max_number_columns_in_data_grid' =>15,
            /*
             * Title of the Page
             */
            'page_title' => 'Static Data',
            /*
             * Can also be the tite of the List data table
             */
            'form_title' => 'Part Specification',
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
                    'label' => 'PartSpecificationType ID'
                ),
                'product_ID' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['product_ID'],
                    'label' => 'Part No',
                    'options' => $pdt_sel_data,
                    'status'=>'required'
                ),
                 
               'customer_ID' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['customer_ID'],
                    'label' => 'Customer',
                    'options'=>  $cust_sel_data,
                ), 
                
               'preparedby_ID' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['preparedby_ID'],
                    'label' => 'PreparedBy ID',
                    'options'=>$emp_sel_data,
                ),
                'approvedby_ID' => array(
                    'filter' => TRUE,
                    'type' =>'select',
                    'value' => $form_data['approvedby_ID'],
                    'label' =>'ApprovedBy ID',
                    'options'=>$emp_sel_data,
                ),
                
                    'entity_ID' => array(
                    'type' => 'hidden',
                    'value' => $ses->get('user')['entity_ID'],
                    'label' => 'Entity',
                    
                ),
                 'users_ID' => array(
                    'type' => 'hidden',
                    'value' => $ses->get('user')['ID'],
                    'label' => 'User ID',
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
      

      //////////////// for Audit Version starts ///////////
      
      //////////////// for Audit Version closes///////////
      
      return $FormConfig;
    }

}
