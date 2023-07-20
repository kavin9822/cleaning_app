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
        
        $machmasstat_table = $crg->get('table_prefix') . 'machinemaster';            
        $sql = "SELECT `ID`,`MachineName` FROM `$machmasstat_table`";           
        $machmas_status_sel = $dbutil->getSqlData($sql,12);
        
        $dept_table = $crg->get('table_prefix') . 'department';            
        $sql = "SELECT `ID`,`DeptName` FROM `$dept_table`";           
        $dept_status_sel = $dbutil->getSqlData($sql,12);

        $shift_table = $crg->get('table_prefix') .'shifttiming';            
        $sql = "SELECT `ID`,`ShiftName` FROM `$shift_table`";           
        $shift_status_sel = $dbutil->getSqlData($sql,12);
       
       
        $emp_table = $crg->get('table_prefix') .'employee';            
        $sql = "SELECT `ID`,`EmpName` FROM `$emp_table`";           
        $emp_data= $dbutil->getSqlData($sql,12);
        
        $pp_table = $crg->get('table_prefix') . 'pipeproduction'; 
        $ppdnbrk_table = $crg->get('table_prefix') . 'productionbreakdowndet'; 
        $wo_table = $crg->get('table_prefix') . 'workorder'; 
         $sql = "SELECT DISTINCT $wo_table.ID,$wo_table.BatchNo 
         FROM 
         $wo_table,
         $ppdnbrk_table,
         $pp_table
         WHERE 
            $pp_table.workorder_ID=$wo_table.ID
            AND 
            $pp_table.id=$ppdnbrk_table.pipeproduction_ID
            and ($ppdnbrk_table.breaskdownreason_ID='8' 
            OR
            $ppdnbrk_table.breaskdownreason_ID='5'
            OR 
            $ppdnbrk_table.breaskdownreason_ID='3') 
            GROUP BY
            $pp_table.ID";           
        $batch_status_sel = $dbutil->getSqlData($sql,12);
        
        
        
         if (isset($form_data['RegisterDate'])) {
                  $form_data['RegisterDate']=date('d-m-Y',strtotime($form_data['RegisterDate']));
              } else {
                  $form_data['RegisterDate']=date('d-m-Y');
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

            'table_name' => 'breakdownrequisition',
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
            
            'unique_key_prefix'=> 'BDR',
            
            /*
             * Unique key suffix
             * get unique key sufix from value filled in a field
             * or colun name
             */
            'unique_key_suffix_from_column_name' => '',
            
            /*
             * Unique key column
             */
            'uniq_key_col' => 'BDRequestNo',
            /*
             * Form limit 
             * Number of form elemens per column
             */
            'max_number_form_elements_per_colum' => 12,
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
            'Max_number_columns_in_data_grid' => 12,
            /*
             * Title of the Page
             */
            'page_title' => 'Static Data',
            /*
             * Can also be the tite of the List data table
             */
            'form_title' => 'BreakDown Requisition',
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
                    'label' => 'BreakdownRequistion ID'
                ),
                
                'BDRequestNo' => array(
                    'filter' => TRUE,
                    'type' => 'hidden',
                    'value' => $form_data['BDRequestNo'],
                    'label' => 'Breakdown Requisition No'
                ), 
                 'workorder_ID' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['workorder_ID'],
                    'label' => 'Batch No',
                    'options' => $batch_status_sel,
                    'status'=>'onchange="machine(this.value)" required'
                
                ),
                 'BDDate' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['BDDate'],
                    'label' => 'BreakDown Date',
                    'status' =>'onmouseover="datepicker(this.id);"'
                     
                ),
                'BDTime' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['BDTime'],
                    'label' => 'BreakDown Time',
                    'status' =>'data-provide="datetimepicker" data-date-format="HH:mm" onclick="ycsdatetime(this.id)"'
                     
                ),
               
                'dpartment_ID' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['dpartment_ID'],
                    'label' => 'Department',
                    'options' => $dept_status_sel,
                    'status'=>'required'
                
                ),
                'mechanic_ID' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['mechanic_ID'],
                    'label' => 'Mechanic',
                    'options' => $emp_data,
                    'status'=>'required'
                
                ),
                'electrician_ID' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['electrician_ID'],
                    'label' => 'Electrician',
                    'options' =>$emp_data,
                    'status'=>'required'
                
                ),
                'CellName' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['CellName'],
                    'label' => 'CellName',
                    'status'=>'required'
                
                ),
                 'CellNo' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['CellNo'],
                    'label' => 'CellNo',
                    'status'=>'required'
                
                ),
                'machine_ID' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['machine_ID'],
                    'label' => 'Machine',
                  'options'=>$machmas_status_sel,
                  'status'=>'readonly'
                   
                ),
                //  'machine_ID' => array(
                //     'filter' => TRUE,
                //     'type' => 'text',
                //     'value' => $form_data['machine_ID'],
                //     'label' => 'Machine',
                //   'status'=>'readonly'
                   
                // ),
                 'machinecode' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['machinecode'],
                    'label' => 'Machine No',
                    'status'=>'readonly'
                ),
                 'Shop' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['Shop'],
                    'label' => 'Shop',
                    'status'=>''
                ),
                 'productionincharge_ID' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['productionincharge_ID'],
                    'label' => 'Production Incharge',
                     'options' =>$emp_data,
                     'status'=>''
                    
                ),
                 'MachineStopDate' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['MachineStopDate'],
                    'label' => 'Machine Date',
                    //  'status' =>'data-provide="datetimepicker" data-date-format="YYYY-MM-DD" onclick="ycsdatetime(this.id)"'
                     'status' =>'data-date-format="YYYY-MM-DD" onmouseover="datepicker(this.id)"'
                    
                ),
                'MachineStopShift_ID' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['MachineStopShift_ID'],
                    'label' => 'Machine Stopped From',
                    'options'=>$shift_status_sel,
                     
                ),
                 'MachineStopTime' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['MachineStopTime'],
                    'label' => 'Machine Stopped Time',
                    'status' =>'data-provide="datetimepicker" data-date-format="HH:mm" onclick="ycsdatetime(this.id)"'
                     
                ), 'MachineHandedDate' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['MachineHandedDate'],
                    'label' => 'Machine Hand Over Date',
                    //'status' =>'data-provide="datetimepicker" data-date-format="YYYY-MM-DD" onclick="ycsdatetime(this.id)"'
                    'status' =>'data-date-format="YYYY-MM-DD" onmouseover="datepicker(this.id)"' 
                ),
                 'MachineHandedShift_ID' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['MachineHandedShift_ID'],
                    'label' => 'Machine Hand Over',
                    'options'=>$shift_status_sel,
                     
                ),
                'MachineHandedTime' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['MachineHandedTime'],
                    'label' => 'Machine Hand Over Time',
                     'status' =>'data-provide="datetimepicker" data-date-format="HH:mm" onclick="ycsdatetime(this.id)"'
                     
                ),
                'Observation' => array(
                    'filter' => TRUE,
                    'type' => 'textarea',
                    'value' => $form_data['Observation'],
                    'label' => 'Observation',
                    'status'=>''
                    
                ),
                 'attendedby_ID' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['attendedby_ID'],
                    'label' => 'Attended By',
                   'options'=> $emp_data,
                   'status'=>'required'
                     
                ),
                'verifiedby_ID' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['verifiedby_ID'],
                    'label' => 'Verified By',
                   'options'=> $emp_data,
                   'status'=>'required'
                     
                ),
               'entity_ID' => array(
                    'type' => 'hidden',
                    'value' => $ses->get('user')['entity_ID'],
                    'label' => 'Entity'                    
                ),
		        'users_ID' => array(
                    'type' => 'hidden',
                    'value' => $ses->get('user')['ID'],
                    'label' => 'User ID'
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
