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
        


        // $unit_table = $crg->get('table_prefix') . 'unit';
        // $unit_sql = "SELECT $unit_table.ID,$unit_table.UnitName FROM $unit_table";
        // $unit_sel_data = $dbutil->getSqlData($unit_sql, 12);
        
        
        
        // $pdt_table = $crg->get('table_prefix') . 'product';
        // $pdt_sql = "SELECT $pdt_table.ID,$pdt_table.ItemName FROM $pdt_table";
        // $pdt_sel_data = $dbutil->getSqlData($pdt_sql, 12);
        
        
        // $pdt_table = $crg->get('table_prefix') . 'product';
        // $pdt_sql = "SELECT $pdt_table.ID,$pdt_table.Description FROM $pdt_table";
        // $prdt_sel_data = $dbutil->getSqlData($pdt_sql, 12);
        
        // $pdttype_table = $crg->get('table_prefix') . 'producttype';
        // $pdttype_sql = "SELECT `ID`,`ProductType` FROM `$pdttype_table`";
        // $pdttype_sel_data = $dbutil->getSqlData($pdttype_sql, 12);
        
        // $prodplan_table = $crg->get('table_prefix') .'dailyprodplan';
        // $prodplan_sql = "SELECT Distinct `ID`,`PlanCode` FROM `$prodplan_table` order by ID desc";
        // $prodplan_sel_data = $dbutil->getSqlData($prodplan_sql, 12);

        $prodplan_table = $crg->get('table_prefix') .'dailyprodplan';
        $wo_table = $crg->get('table_prefix') .'workorder';

        $cust_table = $crg->get('table_prefix') .'customer';
        $cust_sql = "SELECT `ID`,`FirstName` FROM `$cust_table`";
        $cust_sel_data = $dbutil->getSqlData($cust_sql, 12);
         
               $prodplan_sql = " SELECT ID,PlanCode from (SELECT ID,PlanCode,PlanQuantity, WorkQuantity from (SELECT $prodplan_table.ID,$prodplan_table.PlanCode,     
                                $prodplan_table.PlanQuantity,IFNUll($wo_table.WorkQuantity,0) as WorkQuantity
                                FROM $prodplan_table
                                left join $wo_table on $prodplan_table.ID= $wo_table.productionplan_ID  
                                ORDER BY $prodplan_table.ID DESC)as t
                                GROUP BY ID 
                                HAVING SUM(WorkQuantity) < PlanQuantity) as F ";
                
                           $prodplan_sel_data = $dbutil->getSqlData($prodplan_sql,12);
      
        // echo $prodplan_sql = "SELECT $prodplan_table.ID,$prodplan_table.PlanCode,$prodplan_table.PlanQuantity,$wo_table.WorkQuantity 
        //                     FROM $prodplan_table,$wo_table
        //                     WHERE $prodplan_table.ID= $wo_table.productionplan_ID 
        //                     GROUP BY $wo_table.productionplan_ID 
        //                     HAVING SUM($wo_table.WorkQuantity) =$prodplan_table.PlanQuantity 
        //                     ORDER BY $prodplan_table.ID DESC";
        //                     $stmt =$db->prepare($prodplan_sql);
        //                     $stmt->execute();
        //     $prodplan_sel_data = $stmt->fetchAll(12);
        // $prodplan_sel_data = $dbutil->getSqlData($prodplan_sql, 2);
//var_dump($_POST);


        $FormConfig = array(
            /*
             * 
             * Do not use prefix in table name
             * Example in ycs_user
             * enter as user
             * 
             * 'database_table_name' =>'user',
             */

            'table_name' => 'workorder',
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
            'max_number_form_elements_per_colum' =>18,
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
            'Max_number_columns_in_data_grid' =>17,
            /*
             * Title of the Page
             */
            'page_title' => '',
            /*
             * Can also be the tite of the List data table
             */
            'form_title' => 'Work Order',
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
                    'label' => 'Work ID'
                ),
                'customer_ID' => array(
                    'filter' => TRUE,
                    'type' => 'selecttwo',
                    'value' => $form_data['customer_ID'],
                    'label' => 'Customer',
                    'options'=>$cust_sel_data,
                    'selecttwo'=>TRUE,
                   'status'=> 'onchange = "Prodfil(' . "'" . $crg->get('route')['base_path'] . "',this.value,'productionplan_ID'" . ')" required onmouseover="ycssel()"',
                ), 
  
              'BatchNo' => array(
                    'filter' =>TRUE,
                    'type' =>'hidden',
                    'value' => $form_data['BatchNo'],
                    'label' => 'Batch No'
                ),
                'productionplan_ID' => array(
                    'filter' => TRUE,
                    'type' => 'selecttwo',
                    'value' => $form_data['productionplan_ID'],
                    'label' => 'Plan Code',
                     'selecttwo'=>TRUE,
                    'options'=>  $prodplan_sel_data,
                    // 'status'=>'onchange="plancode(this.id);" onmouseover="ycssel();" required'
                    'status'=>'onchange="plandata(this.id);" onmouseover="ycssel();" required'
                ),
                 'producttype_ID' => array(
                    'filter' => TRUE,
                    //'type' => 'select',
                    'type' => 'hidden',
                    'value' => $form_data['producttype_ID'],
                    'label' => 'Part Name',
                   // 'options' => $pdt_sel_data,
                     //'status' => 'onchange = "Prodfilter(' . "'" . $crg->get('route')['base_path'] . "',this.value,'product_ID'" . ')" required readonly',
                    
                ),
                  'product_ID' => array(
                    'filter' => TRUE,
                    'type' => 'hidden',
                    //'type' => 'select',
                    'value' => $form_data['product_ID'],
                    'label' => 'Part No',
                    //'options' =>$prdt_sel_data,
                    
                ),
                
                'unit_ID' => array(
                    'filter' => TRUE,
                    'type' => 'hidden',
                    //'type' => 'select',
                    'value' => $form_data['unit_ID'],
                    'label' => 'UOM',
                   // 'options' => $unit_sel_data,
                   
                ),
                'ProductName' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['ProductName'],
                    'label' => 'Part Name',
                    'status'=>'readonly'
                ),
                  'ProductNo' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['ProductNo'],
                    'label' => 'Part No',
                    'status'=>'readonly'
                ),
                
                'UnitName' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['UnitName'],
                    'label' => 'UOM',
                    'status'=>'readonly'
                ),
                'Quantity' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['Quantity'],
                    'label' => 'Plan Quantity',
                    'status'=>'readonly'
                ),
                 'RemainingQty' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['RemainingQty'],
                    'label' => 'Remaining Quantity',
                    'status' => 'readonly'
                ), 
                 'WorkQuantity' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['WorkQuantity'],
                    'label' => 'Work Order Quantity',
                    //'status'=>'onclick="plan();" onkeyup="plan();"required'
                    'status'=>'onchange="workquantity();" onkeypress="return onlyNumberKey(event);" required'
                ),
                
                'Status' => array(
                    'filter' => TRUE,
                    'type' => 'hidden',
                    'value' => $form_data['Status'],
                    'label' => 'Status',
                    'status'=>''
                ),
                'Colour' => array(
                    'filter' => TRUE,
                    'type' => 'hidden',
                    'value' => $form_data['Colour'],
                    'label' => 'Colour',
                    'status'=>''
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
      

      //////////////// for Audit Version starts ///////////
      
      //////////////// for Audit Version closes///////////
      
      return $FormConfig;
    }

}
