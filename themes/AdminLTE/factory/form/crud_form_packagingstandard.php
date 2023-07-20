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

     
        
        $pdt_table = $crg->get('table_prefix') . 'product';
        $pdt_sql = "SELECT `ID`,Concat(`ItemName`,' ', `Description`) as ItemName FROM `$pdt_table`";
        $pdt_sel_data = $dbutil->getSqlData($pdt_sql, 12);
        
        $pdttype_table = $crg->get('table_prefix') . 'producttype';
        $pdttype_sql = "SELECT `ID`,`ProductType` FROM `$pdttype_table`";
        $pdttype_sel_data = $dbutil->getSqlData($pdttype_sql, 12);
       

        $FormConfig = array(
            /*
             * 
             * Do not use prefix in table name
             * Example in ycs_user
             * enter as user
             * 
             * 'database_table_name' =>'user',
             */

            'table_name' => 'PackagingStand',
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
            'page_title' => 'Static Data',
            /*
             * Can also be the tite of the List data table
             */
            'form_title' => 'Packaging Standard',
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
  
             'producttype_ID' => array(
                    'filter' =>TRUE,
                    'type' =>'select',
                    'value' =>$form_data['producttype_ID'],
                    'label' =>'Part Name',
                    'options'=>$pdttype_sel_data,
                    'status'=>'required'
                ),
                 'product_ID' => array(
                    'filter' =>TRUE,
                    'type' =>'select',
                    'value' =>$form_data['product_ID'],
                    'label' =>'Part No',
                     'options'=>$pdt_sel_data
                ),
                'NoofCoils' => array(
                    'filter'=>TRUE,
                    'type' =>'text',
                    'value' =>$form_data['NoofCoils'],
                    'label' =>'No Of Coils',
                    'options'=>$prodplan_sel_data,
                    
                ),
               
              'Wgtpercoil' => array(
                    'filter' =>TRUE,
                    'type' =>'text',
                    'value' =>$form_data['Wgtpercoil'],
                    'label' =>'Weight Per Coil',
                    
                ), 
                
                'BagQty' => array(
                    'filter' =>TRUE,
                    'type' =>'text',
                    'value' =>$form_data['BagQty'],
                    'label' =>'Bag Quantity',
                ),
                
                'BagSize' => array(
                    'filter' =>TRUE,
                    'type' =>'text',
                    'value' =>$form_data['BagSize'],
                    'label' =>'Bag Size',
                   
                ),
                'PSDate' => array(
                    'filter'=>TRUE,
                    'type' =>'text',
                    'value' =>$form_data['PSDate'],
                    'label' =>'Date',
                    'status'=>'data-provide="datetimepicker" data-date-format="YYYY-MM-DD" onclick="ycsdate(this.id)" required'
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
