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

        $YN_option_data = array(
            'Yes' => 'YES',
            'No' => 'NO'
        );      
        
            $actual_table_name = $crg->get('table_prefix') . 'customer';
            $entityID = $ses->get('user')['entity_ID'];
            $sql = "SELECT `ID`, `CompanyName` FROM `$actual_table_name` WHERE `entity_ID` = $entityID && `customertype_ID`=2";
            $customer_ID_sel = $dbutil->getSqlData($sql, 12);
        
        $FormConfig = array(
            /*
             * 
             * Do not use prefix in table name
             * Example in ycs_user
             * enter as user
             * 
             * 'database_table_name' =>'user',
             */

            'table_name' => 'customerconfo',
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
            
            'unique_key_prefix'=> 'CUS',
            
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
            'max_number_form_elements_per_colum' => 11,
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
            'page_title' => 'Corporate Entry Forms',
            /*
             * Can also be the tite of the List data table
             */
            'form_title' => 'Corporate Customer Confirmation',
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
                'CustId' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['CustId'],
                    'label' => 'Customer ID',
                    'options' => $customer_ID_sel 
                ),               
                'entity_ID' => array(
                    'type' => 'hidden',
                    'value' => $ses->get('user')['entity_ID'],
                    'label' => 'Entity'                    
                ),                  
                'FacId' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['FacId'],
                    'label' => 'FAC ID'
                ),
                'TowerAddress' => array(
                    'type' => 'textarea',
                    'status' => '',
                    'value' => $form_data['TowerAddress'],
                    'label' => 'Tower Address',
                    'number_of_rows' => 2
                ),
                'Circle' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['Circle'],
                    'label' => 'Circle'
                ),  
                'PoDate' => array(
                    'type' => 'date',
                    'value' => $form_data['PoDate'],
                    'label' => 'PO Date'
                ),               
                'SoNo' => array(
                    'filter' => TRUE,
                    'type' => 'number',
                    'value' => $form_data['SoNo'],
                    'label' => 'SO No.'
                ),                
                'Mode' => array(
                    'type' => 'text',
                    'value' => $form_data['Mode'],
                    'label' => 'Mode' 
                ),
                'WanIp' => array(
                    'type' => 'text',
                    'value' => $form_data['WanIp' ],
                    'label' => 'WAN IP' 
                ),              
                'PortNo' => array(
                    'type' => 'number',
                    'value' => $form_data['PortNo' ],
                    'label' => 'Port No.' 
                ),
                'CustomerCAF' => array(
                    'type' => 'select',
                    'value' => $form_data['CustomerCAF'],
                    'label' => 'Customer CAF',
                    'options' =>  $YN_option_data
                ),                
                'IpJustification' => array(
                    'type' => 'select',
                    'value' => $form_data['IpJustification'],
                    'label' => 'IP Justification',
                    'options' =>  $YN_option_data
                ),
                'Proof' => array(
                    'type' => 'select',
                    'value' => $form_data['Proof'],
                    'label' => 'Proof',
                    'options' =>  $YN_option_data
                ),
                'CustomerPo' => array(
                    'type' => 'select',
                    'value' => $form_data['CustomerPo'],
                    'label' => 'Customer PO',
                    'options' =>  $YN_option_data
                ),
                'CircuitId' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['CircuitId'],
                    'label' => 'SUB ID / Circuit ID'
                ),
                'CustProofDetail' => array(
                    'type' => 'text',
                    'value' => $form_data['CustProofDetail'],
                    'label' => 'Customer Firm Proof Detail (RC No./PAN No.)' 
                ),
                'DeliveryAcceptanceYN' => array(
                    'type' => 'text',
                    'value' => $form_data['DeliveryAcceptanceYN' ],
                    'label' => 'Link Delivery Acceptance to Reliance' 
                ),                
                'LanIp' => array(
                    'type' => 'text',
                    'value' => $form_data['LanIp' ],
                    'label' => 'LAN IP' 
                ),
                'RequestTickets' => array(
                    'type' => 'text',
                    'value' => $form_data['RequestTickets' ],
                    'label' => 'Fault / Request Ticket Raised' 
                ),
                'TermUpgradeTickets' => array(
                    'type' => 'text',
                    'value' => $form_data['TermUpgradeTickets' ],
                    'label' => 'Termination / Upgrade Ticket Raised' 
                ),
                'Remarks' => array(
                    'type' => 'text',
                    'value' => $form_data['Remarks' ],
                    'label' => 'Remarks' 
                ),
                'users_ID' => array(
                    'type' => 'hidden',
                    'value' => $form_data['users_ID'],
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