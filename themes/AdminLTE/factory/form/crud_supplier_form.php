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
		
        $FormConfig = array(
            /*
             * 
             * Do not use prefix in table name
             * Example in ycs_user
             * enter as user
             * 
             * 'database_table_name' =>'user',
             */

            'table_name' => 'supplier',
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
            'unique_key_prefix' => '',
            /*
             * Unique key suffix
             * get unique key sufix from value filled in a field
             * or colun name
             */
            'unique_key_suffix_from_column_name' => '',
            /*
             * Unique key column used to generate and store unique key
             */
            'uniq_key_col' => '',
            
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
            'Max_number_columns_in_data_grid' => 18,
            /*
             * Title of the Page
             */
            'page_title' => 'Supplier',
            /*
             * Can also be the tite of the List data table
             */
            'form_title' => 'Supplier',
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
				'Nature' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['Nature'],
                    'label' => 'Nature'
                ),	
				'SupplierType' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['SupplierType'],
                    'label' => 'Supplier type'
                ),
				'SupplierName' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['SupplierName'],
                    'label' => 'Supplier Name'
                ),
                'AddressLine1' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['AddressLine1'],
                    'label' => 'Address Line 1'
                ),	
                'AddressLine2' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['AddressLine2'],
                    'label' => 'AddressLine2'
                ),	
				'City' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['City'],
                    'label' => 'City'
                ),	
				'ContactPerson' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['ContactPerson'],
                    'label' => 'Contact Person'
                ),	
				'ContactNumber' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['ContactNumber'],
                    'label' => 'Contact Number'
                ),
                'Email' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['Email'],
                    'label' => 'Email'
                ),	
                'Code' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['Code'],
                    'label' => 'Code'
                ),
                'NatureOfWork' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['NatureOfWork'],
                    'label' => 'Nature Of Work'
                ),
                'Items' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['Items'],
                    'label' => 'Items'
                ),	
                'TypeOfControl' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['TypeOfControl'],
                    'label' => 'Type Of Control'
                ),	
                'MaterialGrade' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['MaterialGrade'],
                    'label' => 'Material Grade'
                ),	
                'CustomerApproved' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['CustomerApproved'],
                    'label' => 'Customer Approved'
                ),	
                'Applicable_Statutory_Requirements' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['Applicable_Statutory_Requirements'],
                    'label' => 'Applicable statutory & regulatory requirements'
                ),	
                'SupplierIsoCertified' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['SupplierIsoCertified'],
                    'label' => 'Supplier Iso Certified'
                ),	
				'CertificateValidity' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['CertificateValidity'],
                    'label' => 'Certificate Validity'
                ),
				'AuditFrequency' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['AuditFrequency'],
                    'label' => 'Audit Frequency'
                ),
				'ApprovedDate' => array(
                    'filter' => TRUE,
                    'type' => 'select',
                    'value' => $form_data['ApprovedDate'],
                    'label' => 'Approved Date'
                ),
				'RevaluationPeriod' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['RevaluationPeriod'],
                    'label' => 'Revaluation Period'
                ),
				'SupplierDevelopment' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['SupplierDevelopment'],
                    'label' => 'Supplier Development'
                ),
				'Remarks' => array(
                    'filter' => TRUE,
                    'type' => 'text',
                    'value' => $form_data['Remarks'],
                    'label' => 'Remarks'
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