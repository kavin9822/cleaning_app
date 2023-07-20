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
            'TamilNadu' => 'Tamil Nadu', 
            'Kerala' => 'Kerala',           
            'Karnataka' => 'Karnataka',            
            'AndhraPradesh' => 'Andhra Pradesh',
            'Telangana' => 'Telangana',
            'Andaman and Nicobar' => 'Andaman and Nicobar',
            'Lakshadweep' => 'Lakshadweep',
            'Puducherry' => 'Puducherry'
        );

        $cont_option_data = array(
            'IN' => 'India',
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

            'table_name' => 'buyer',
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
            
            'unique_key_prefix'=> 'BYR',
            
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
            'max_number_form_elements_per_colum' => 7,
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
            'page_title' => 'Entry Forms',
            /*
             * Can also be the tite of the List data table
             */
            'form_title' => 'Buyer Form',
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
                    'label' => 'Buyer ID'
                ),
                'Name' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['Name'],
                    'label' => 'Buyer Name'
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
                'Address' => array(
                    'type' => 'textarea',
                    'value' => $form_data['Address'],
                    'label' => 'Address',
                    'number_of_rows' => 3
                ),
                'City' => array(
                    'filter' => TRUE,
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
                    'label' => 'State / UT',
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
                'TinNo' => array(
                    'filter' => TRUE,
                    'type' => 'number',
                    'value' => $form_data['TinNo'],
                    'label' => 'Tin No.'
                ),  
                'CSTNo' => array(
                    'filter' => TRUE,
                    'type' => 'number',
                    'value' => $form_data['CSTNo'],
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