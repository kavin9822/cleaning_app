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


	    $actual_table_name = $crg->get('table_prefix') . 'customer';
            $entityID = $ses->get('user')['entity_ID'];
            $sql = "SELECT `ID`, `FirstName` FROM `$actual_table_name` WHERE `entity_ID` = $entityID && `customertype_ID`=3";
            $customer_ID_sel = $dbutil->getSqlData($sql, 12);


	    $actual_table_name_user = $crg->get('table_prefix') . 'users';
            //same as above so no need, it is entity id from login user session
            //$entityID = $ses->get('user')['entity_ID'];
            $sqlusr = "SELECT `ID`, `user_nicename` FROM `$actual_table_name_user` WHERE `entity_ID` = $entityID";
            $UserId_ID_sel = $dbutil->getSqlData($sqlusr, 12);

	//var_dump($ses->get('customer_type_option_data'));
        if (!$ses->get('customer_type_option_data')) {
            $cust_type_selectBoxData = $dbutil->selectKeyVal('customertype','ID','Title');
            $ses->set('customer_type_option_data', $cust_type_selectBoxData);
        } else {
           $cust_type_selectBoxData = $ses->get('customer_type_option_data');
        }

        //it retrives the table current status from database & stored here for further use
          if (!$ses->get('Market_forllowup_Form_status_sel')) {
            $Market_forllowup_Form_status_sel = $dbutil->selectKeyVal('markettingstatus','ID','MarkettingStatus');
            $ses->set('status_sel', $Market_forllowup_Form_status_sel);
        } else {
            $Market_forllowup_Form_status_sel = $ses->get('Market_forllowup_Form_status_sel');
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

            'table_name' => 'marketfollowup',
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
            'unique_key_required' => FALSE,
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
            'page_title' => 'Entry Forms',
            /*
             * Can also be the tite of the List data table
             */
            'form_title' => 'Marketing Follow up Form',
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
                    'filter' => FALSE,
                    'type' => 'hidden',
                    'value' => $form_data['ID'],
                    'label' => 'MarketFollow ID'
                ), 
                'entity_ID' => array(
                    'type' => 'hidden',
                    'value' => $ses->get('user')['entity_ID'],
                    'label' => 'Entity ID'                    
                ),               
                'CustId' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['CustId'],
                    'status' => 'onchange = "hidemyFormEle()"',
                    'label' => 'Customer',
                    'options' => $customer_ID_sel
                ),
                'UserId' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['UserId'],
                    'label' => 'User',
                    'options' => $UserId_ID_sel
                ),
                'MStatus' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['MStatus'],
                    'label' => 'Marketing Status',
                    'status' => 'onchange = "dis()"',
                    'style' => 'display:none',
                    'options' => $Market_forllowup_Form_status_sel
                ),
                'customertype_ID' => array(
                    'type' => 'select',
                    'value' => $form_data['customertype_ID'],
                    'label' => 'Customer Type',
                    'status' => 'onclick = "hideFormElem()"',
                    'options' => $cust_type_selectBoxData
                ),                              
                'MDate' => array(
                    'filter' => TRUE,
                    'type' => 'date',
                    'value' => $form_data['MDate'],
                    'status' => 'data-provide="datepicker" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" onclick="ycsdate()"',
                    'label' => 'Next Follow Date'
                ),
                'MTime' => array(
                    'type' => 'time',
                    'value' => $form_data['MTime'],
                    'status' => '',
                    'label' => 'Next Follow Time'
                ),
                'Remark' => array(
                    'type' => 'textarea',
                    'value' => $form_data['Remark'],
                    'label' => 'Remarks',
                    'number_of_rows' => 2
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
