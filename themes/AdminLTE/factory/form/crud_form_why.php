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
        $tpl = $reg->get('tpl');

        include_once 'util/DBUTIL.php';
        $dbutil = new DBUTIL($crg);
        
        $entityID = $ses->get('user')['entity_ID'];
        
        $machine_tab = $crg->get('table_prefix') . 'machinemaster';
        $sql = "SELECT `ID`,`MachineName` FROM `$machine_tab`";           
        $machine_status_sel = $dbutil->getSqlData($sql,12);

        

        $FormConfig = array(
            /*
             * 
             * Do not use prefix in table name
             * Example in ycs_user
             * enter as user
             * 
             * 'database_table_name' =>'user',
             */

            'table_name' => 'whywhy',
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
            'unique_key_required' =>FALSE,
            /*
             * Based on a colum name first three letters
             */
            'unique_key_prefix' =>'',
            /*
             * Unique key suffix
             * get unique key sufix from value filled in a field
             * or colun name
             */
            'unique_key_suffix_from_column_name' => '',
            /*
             * Unique key column used to generate and store unique key
             */
            'uniq_key_col' =>'',
            
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
            'page_title' => 'Production',
            /*
             * Can also be the tite of the List data table
             */
            'form_title' => 'Why-Why Analysis',
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
            //'filter_by_col' => array(
            //    'customertype_ID' => "`customertype_ID` = '$customer_type_id[0]'"
            //),
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
                'DefectName' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['DefectName'],
                    'label' => 'Name Of The Defect',
                    'status'=>'required'
                ),
                'WhyDate' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['WhyDate'],
                    'label' => 'Date',
                    'status' => 'data-provide="datetimepicker" data-date-format="YYYY-MM-DD" onclick="ycsdatetime(this.id)"'
                   
                ),
                'machine_ID' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['machine_ID'],
                    'label' => 'Machine',
                    'status' => 'required'
                ),
                'ProbDesc' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['ProbDesc'],
                    'label' => 'Problem Description',
                    'status' => ''
                ),
                'Occurence' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['Occurence'],
                    'label' => 'Occurence',
                    'status'=>'',
                ),
                'ContainmentAction' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['ContainmentAction'],
                    'label' => 'Containment Action',
                    'status'=>''
                ),
                'ContainmentResp' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['ContainmentResp'],
                    'label' => 'Containment Response',
                    'status'=>''
                ),
                'ContainmentTarget' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['ContainmentTarget'],
                    'label' => 'Containment Target',
                    'status'=>''
                ),
                'ActRootCause' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['ActRootCause'],
                    'label' => 'Actual RootCause',
                    'status'=>'required'
                ),
                'ActRootResp' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['ActRootResp'],
                    'label' => 'Actual RootResponse',
                    'status'=>'required'
                ),
                'ActRooeTarget' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['ActRooeTarget'],
                    'label' => 'Actual RootTarget',
                    'status'=>'required'
                ),
                
                'CorrAction' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['CorrAction'],
                    'label' => 'Corrective Action',
                    'status'=>''
                ),
                'CorrActResp' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['CorrActResp'],
                    'label' => 'Corrective Action Response',
                    'status'=>'required'
                ),
                'CorrActTarget' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['CorrActTarget'],
                    'label' => 'Corrective ActionTarget',
                    'status' => ''
                ),
                'PrevAction' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['PrevAction'],
                    'label' => 'Preventive Action'
                ),
                 'PrevActResp' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['PrevActResp'],
                    'label' => 'Preventive ActionResponse'
                ),
                 'PrevActTarget' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['PrevActTarget'],
                    'label' => 'Preventive ActionTarget'
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