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


        if (!$ses->get('user_type_select_BoxData')) {
            $user_type_select_BoxData = $dbutil->selectKeyVal('usertype');
            
            $ses->set('user_type_select_BoxData', $user_type_select_BoxData);
        } else {
            $user_type_select_BoxData = $ses->get('user_type_select_BoxData');
        }   


        if (!$ses->get('entity_select_BoxData')) {
            $entity_select_BoxData = $dbutil->selectKeyVal('entity');
            $ses->set('entity_select_BoxData', $entity_select_BoxData);
        } else {
            $entity_select_BoxData = $ses->get('entity_select_BoxData');
        }

        //var_dump($entity_select_BoxData);

        $FormConfig = array(
            /*
             * 
             * Do not use prefix in table name
             * Example in ycs_user
             * enter as user
             * 
             * 'database_table_name' =>'user',
             */

            'table_name' => 'users',
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
            'unique_key_required'=> FALSE,
            /*
             * Based on a colum name first three letters
             */
            
            //'unique_key_prefix'=> 'cus',
            
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
            'max_number_form_elements_per_colum' => 15,
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
            'page_title' => 'User Admin',
            /*
             * Can also be the tite of the List data table
             */
            'form_title' => 'Change User Password',
            /*
             * Set to default FALSE, passed as parameter to this static method
             */
            'filter_by_user_id' => FALSE,
            /*
             * set to TRUE by default
             */
            'filter_by_entity_id' => FALSE,
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
                    'label' => 'User ID'
                ),
                'entity_ID' => array(
                    'type' => 'hidden',
                    'value' => $ses->get('user')['entity_ID'],
                    'label' => 'Entity'                    
                ),		
                'user_nicename' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['user_nicename'],
                    'label' => 'User Name',
                ),
                'user_email' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['user_email'],
                    'label' => 'User Email',
                ),
                'user_pass' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => '',
                    'label' => 'New Password',
                ),
                //just we are using this column to make form 
                //user_registered will not be altered in this function
                //in pagination table select statement will fetch this data
                //on edit submit we use as  re type password
                'user_registered' => array(

                    'type' => 'text',
                    'value' => '',
                    'label' => 'Retype New Password',
                )
                                              
            ),
            
            'form_footer' => array(
                'clear' => array(
                    'type' => 'reset',
                    'label' => 'Clear'
                ),
                
                'edit_submit_button' => array(
                    'type' => 'submit',
                    'status' => 'value = "editSubmit"',
                    
                    'label' => 'Submit',                    
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
