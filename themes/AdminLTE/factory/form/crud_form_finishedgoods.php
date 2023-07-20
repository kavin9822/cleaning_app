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

     
        
        $wrkorder_table = $crg->get('table_prefix') . 'workorder';
        $wrkorder_sql = "SELECT `ID`,`BatchNo` FROM `$wrkorder_table`";
        $wrkorder_sel_data = $dbutil->getSqlData($wrkorder_sql, 12);
        
        $shift_table = $crg->get('table_prefix') . 'shifttiming';
        $shift_sql = "SELECT `ID`,`ShiftName` FROM `$shift_table`";
        $shift_sel_data = $dbutil->getSqlData($shift_sql, 12);
        
        $packagetype_sel_data=array(
            'box'=>'Box',
            'bag'=>'Bag'
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

            'table_name' => 'finishedgood',
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
            'unique_key_required'=>FALSE,
            /*
             * Based on a colum name first three letters
             */
            
            'unique_key_prefix'=> '',
            
            /*
             * Unique key suffix
             * get unique key sufix from value filled in a field
             * or colun name
             */
          //  'unique_key_suffix_from_column_name' => 'Country',
            
            /*
             * Unique key column used to generate and store unique key
             */
            'uniq_key_col' =>'',
            /*
             * Form limit 
             * Number of form elemens per column
             */
            'max_number_form_elements_per_colum' =>12,
            /*
             * Max number of rows in crud2
             * we will do this in next version
             */
            //'List_max_number_rows' => 10,
            
            
            'Max_number_columns_in_data_grid' =>12,
            /*
             * Title of the Page
             */
            'page_title' => '',
            /*
             * Can also be the tite of the List data table
             */
            'form_title' => 'Finished Good Register',
            /*
             * Set to default FALSE, passed as parameter to this static method
             */
            'filter_by_user_id' => FALSE,
            /*
             * set to TRUE by default
             */
            'filter_by_entity_id' =>TRUE,
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
                    'filter' => FALSE,
                    'type' => 'hidden',
                    'value' => $form_data['ID'],
                    'label' => 'ID'
                ),
  
             'workorder_ID' => array(
                    'filter' =>TRUE,
                    'type' =>'select',
                    'value' =>$form_data['workorder_ID'],
                    'label' =>'Batch No',
                    'options'=>$wrkorder_sel_data ,
                    'status'=>'onchange="wrkorderChg(this.value)" required'
                ),
                 'FGDate' => array(
                    'filter' =>TRUE,
                    'type' =>'text',
                    'value' =>$form_data['FGDate'],
                    'label' =>'Date',
                    'status'=>'data-provide="datetimepicker" data-date-format="YYYY-MM-DD" onclick="ycsdate(this.id)" required'
                ),
                'shift_ID' => array(
                    'filter'=>TRUE,
                    'type' =>'select',
                    'value' =>$form_data['shift_ID'],
                    'label' =>'Shift',
                    'options'=>$shift_sel_data,
                    'status'=>'required'
                    
                ),
               
              'Quantity' => array(
                    'filter' =>TRUE,
                    'type' =>'text',
                    'value' =>$form_data['Quantity'],
                    'label' =>'Quantity',
                    'status'=>'readonly'
                ), 
                
                'PackageType' => array(
                    'filter' =>TRUE,
                    'type' =>'select',
                    'value' =>$form_data['PackageType'],
                    'label' =>'Package Type',
                    'options'=>$packagetype_sel_data,
                    'status'=>''
                ),
                
                'NoofBox' => array(
                    'filter' =>TRUE,
                    'type' =>'text',
                    'value' =>$form_data['NoofBox'],
                    'label' =>'No Of Pack',
                    'status'=>''
                   
                ),
                'BoxNo' => array(
                    'filter'=>TRUE,
                    'type' =>'text',
                    'value' =>$form_data['BoxNo'],
                    'label' =>'Pack No',
                'status'=>''
                ),
                
                'Remark' => array(
                    'filter'=>TRUE,
                    'type' =>'text',
                    'value' =>$form_data['Remark'],
                    'label' =>'Remark',
                    'status'=>''
                ),
                'entity_ID'=> array(
                    'type'=>'hidden',
                    'value'=>$ses->get('user')['entity_ID'],
                    'label'=> 'Entity',    
                    'status'=>''
                ),
                 'users_ID'=> array(
                    'type'=>'hidden',
                    'value'=>$ses->get('user')['ID'],
                    'label'=>'User ID',
                    'status'=>''
                    
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
