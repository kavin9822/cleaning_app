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
        
        $industrystat_table = $crg->get('table_prefix') . 'industry';
        $indussql = "SELECT `ID`,`IndustryType` FROM `$industrystat_table`";
        $indus_status_sel = $dbutil->getSqlData($indussql, 12);
        
         
        $leadstat_table = $crg->get('table_prefix') . 'lead';
        $leadsql = "SELECT `ID`,`LeadStatus` FROM `$leadstat_table`";
        $lead_status_sel = $dbutil->getSqlData($leadsql, 12);

        $FormConfig = array(
            /*
             * 
             * Do not use prefix in table name
             * Example in ycs_user
             * enter as user
             * 
             * 'database_table_name' =>'user',
             */

            'table_name' => 'enquiry',
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
             * 
             */
            
            'unique_key_prefix'=> 'cst',
            
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
            'max_number_form_elements_per_colum' => 6,
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
            'Max_number_columns_in_data_grid' => 6,
            /*
             * Title of the Page
             */
            'page_title' => 'Production',
            /*
             * Can also be the tite of the List data table
             */
            'form_title' => 'Enquiry',
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
                'ID'=>array(
                    'filter' => TRUE,
                    'type' => 'hidden',
                    'value' => $form_data['ID'],
                    'label' => 'ID'
                ),
                'CompanyName' => array(  
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['CompanyName'],
                    'label' => 'Company Name'
                    
                ),         
                'industry_id' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['industry_id'],
                    'label' => 'Industry Type',
                    'options'=>$indus_status_sel
                    ),
                'Website' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['Website'],
                    'label' => 'Website',
                    
                    ),
                    
                 'ProductInterested' => array(
                    'type' => 'text',
                    'value' =>$form_data['ProductInterested'],
                    'label' => 'Product Interested'
                ),
                'leadstatus_id' => array(
                   'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['leadstatus_id'],
                    'label' => 'Lead Status',
                    'options'=>$lead_status_sel
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
                    'label' => 'List',
                    'status' => ''
                )
            )
        );
        /////////////////////

        return $FormConfig;
    }

}
