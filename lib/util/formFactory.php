<?php

class FF {

    private $crg;
    private $ses;
    private $db;
    private $sd;
    private $tpl;
    private $rbac;
    private $formConfig;

    function __construct($reg, $form_config) {


        /*
         * Receiving $rg array
         */
        $this->crg = $reg;

        /*
         * geting object from reg array
         */
        $this->ses = $this->crg->get('ses');
        $this->db = $this->crg->get('db');
        $this->sd = $this->crg->get('SD');
        $this->tpl = $this->crg->get('tpl');
        $this->rbac = $this->crg->get('rbac');

        $this->formConfig = $form_config;
    }

    public function factory() {

        //var_dump($this->crg->get('route'));
        //////////////////////////form content////////////////////////////////////////////////////////

        try {

            $count = 0;
            $max_number_form_elements_per_colum = $this->formConfig['max_number_form_elements_per_colum'];

            $tatal_form_count = count($this->formConfig['form_content']);

            /*
             * Content string in clumn one
             */
            $form_content_master_col_1 = '';
            /*
             * Content string in col 2
             */
            $form_content_master_col_2 = '';

            foreach ($this->formConfig['form_content'] as $key => $value) {


                $this->tpl->set('name', $key);


                foreach ($value as $k => $v) {
                    $this->tpl->set($k, $v);
                }


                //Get teplate format based on input type
                $form_element_template_file = $this->formElementTemplate($value['type']);

                if ($tatal_form_count > $max_number_form_elements_per_colum && $count > $max_number_form_elements_per_colum) {
                    $form_content_master_col_2 .= $this->tpl->fetch('factory/template/' . $form_element_template_file);
                } else {
                    $form_content_master_col_1 .= $this->tpl->fetch('factory/template/' . $form_element_template_file);
                }

                $count = $count + 1;
            }

            if ($tatal_form_count > $max_number_form_elements_per_colum) {
                $this->tpl->set('form_content_master_col_one', $form_content_master_col_1);
                $this->tpl->set('form_content_master_col_two', $form_content_master_col_2);
            } else {
                $this->tpl->set('form_content_master_col_one', $form_content_master_col_1);
            }

            ////////////////////////////////////////////////////////////////////
            ////////////////////////form footer////////////////////////////////
            //////////////////////////////////////////////////////////////////
            $form_footer_master = '';
            foreach ($this->formConfig['form_footer'] as $fkey => $fvalue) {

                $this->tpl->set('name', $fkey);

                foreach ($fvalue as $fk => $fv) {
                    $this->tpl->set($fk, $fv);
                }

                $form_element_template_file = $this->formElementTemplate($fvalue['type']);
                $form_footer_master .= $this->tpl->fetch('factory/template/' . $form_element_template_file);
            }

            $this->tpl->set('form_footer', $form_footer_master);

            //////////////////////////////////////////////////////////////////////

            if ($tatal_form_count > $max_number_form_elements_per_colum) {
                $Complete_form = $this->tpl->fetch('factory/template/form_master_two_column.php');
            } else {
                $Complete_form = $this->tpl->fetch('factory/template/form_master_one_column.php');
            }



            /*
             * Complete form assigned to content part of the template
             */

            if ($this->crg->get('deliver_at')) {
                $this->tpl->set($this->crg->get('deliver_at'), $Complete_form);
            } else {
                $this->tpl->set('content', $Complete_form);
            }
        } catch (Exception $exc) {
            $this->tpl->set('message', $exc->getTraceAsString());
            header("Location:" . $this->crg->get('route')['ref_url']);
        }
    }

    /*
     * Protected function to select type of template 
     * wto the input type
     */

    protected function formElementTemplate($param) {

        switch ($param) {
            case 'hidden':
                $form_template_file = 'form_hidden.php';
                break;
            case 'text':
            case 'email':
            case 'url':
            case 'number':
            case 'tel':
            case 'search':
            case 'range':
            case 'date':
            case 'month':
            case 'week':
            case 'datetime':
            case 'datetime-local':
            case 'color':
                $form_template_file = 'form_input_general.php';
                break;

            case 'button':
            case 'submit':
            case 'reset':
                $form_template_file = 'form_button.php';
                break;

            case 'link':
                $form_template_file = 'form_button_link.php';
                break;


            case 'checkbox':
            case 'radio':
                $form_template_file = 'check_radio_box.php';
                break;

            case 'textarea':
                $form_template_file = 'form_input_textarea.php';
                break;

            case 'select':
                $form_template_file = 'select_box.php';
                break;

            case 'file':
                $form_template_file = 'file_upload.php';
                break;
                
            case 'selecttwo':
                $form_template_file = 'selecttwo_box.php';
                break;    


            default:
                $form_template_file = 'form_input_general.php';
                break;
        }

        return $form_template_file;
    }

/////////////////////////////////////////

    public function submit() {

        /*
         * Actual data from form
         * Safely we receive it
         */

        $data = $this->arrFltr($_POST);
        $actual_table_name = $this->crg->get('table_prefix') . $this->formConfig['table_name'];
        /*
         * Unique key gen
         */
      
        if ($this->formConfig['unique_key_required']) {

            $uk_prefix = $this->formConfig['unique_key_prefix'];
            
            if($this->formConfig['unique_key_suffix_from_pac_sa']) {
            $uk_suffix = $this->formConfig['unique_key_suffix_from_pac_sa'];                        
            } else { 
           // $uk_suffix = trim($this->tpl->get('EntityShortCode'));
            }
            
            //get suffix data value from a colum name
            /*
            $sufKey = trim($data[$this->formConfig['unique_key_suffix_from_column_name']]);
              
            if (is_string($sufKey) && strlen($sufKey) > 2) {
                $uk_suffix = substr($sufKey, 0, 2);
            } else {
                $uk_suffix = $sufKey;
            }
            */
            
            /////////////////////////////////////
            /////////////////////////////////////

            /*
             * actual table name with prefix
             * Reason for prrefixing table
             * for securoty reason evey installation need to have different table name
             */
            $actual_table_name = $this->crg->get('table_prefix') . $this->formConfig['table_name'];
            $uk_col = $this->formConfig['uniq_key_col'];
      
            $sql_query = "SELECT $uk_col FROM $actual_table_name ORDER BY ID DESC LIMIT 1";
            try {
                $stmt = $this->db->prepare($sql_query);
                $stmt->execute();
                $subject = $stmt->fetch(7);
                
                $pattern = '/\d{6}|\d{5}|\d{4}/';
                
                $start='KI/ST';

                if (is_string($subject) && $subject !== '') {
                    preg_match($pattern, $subject, $matches, PREG_OFFSET_CAPTURE);
                    //Array ( [0] => Array ( [0] => 5716 [1] => 3 ) ) 
                    if ($matches[0][0]) {
                        
                        $keyDIG = $matches[0][0] + 1;
                        
                        $unique_key = $start.'/'.$uk_prefix .'/'.$keyDIG . $uk_suffix;
                    }
                } else {
                    $unique_key = $start.'/'.$uk_prefix.'/'.'1012'. $uk_suffix;
                }
            } catch (Exception $exc) {
                $unique_key = FALSE;
            }

            ////////////////////////////////////

            $data["$uk_col"] = $unique_key;
        }


        /*
         * @var $table_columns_to_select
         * @description Colums to be selected from the table
         * @type array
         * seperate the file upload field
         */

        foreach ($this->formConfig['form_content'] as $key => $value) {
            if (trim($key) && $value['type'] !== 'file' && !empty($data[$key])) {
                $table_columns_to_select[] = trim($key);
                $table_values[] = $data[$key];
            }
        }



        //Buid SQL
        //Colum name array to string
        $colum_string = ' (' . implode(', ', $table_columns_to_select) . ') ';

        //value array to string
        $dataArr = array();
        foreach ($table_values as $DataValue) {
            $dataArr[] = is_numeric($DataValue) ? $DataValue : $this->db->quote($DataValue);
        }

        $value_string = ' (' . implode(", ", $dataArr) . ') ';
        //buid sql string
     $sql = 'insert into ' . $actual_table_name . $colum_string . 'VALUES' . $value_string;




        try {

            $stmt = $this->db->prepare($sql);
            IF ($stmt->execute()) {
                $data['ID']=$this->db->lastInsertId();
                /*
                 * Upload file part 
                 */

                if ($data['ID'] && $this->formConfig['Form_Need_to_upload_file']) {
                    $fileUploadArr = $_FILES;

                    $where_condition = $this->whereCond('ID', $data['ID']);
                    $where_condition .= " Limit 1";

                    $name_value_pair_sting = array();
                    foreach ($fileUploadArr as $uploadKey => $uploadValArr) {
                        if ($uploadValArr['error'] == 0) {
                            $uploaded_file_url = $this->handle_file_upload($uploadKey, $data['ID']);
                            if ($uploaded_file_url) {
                                $name_value_pair_sting[] = $uploadKey . ' = ' . $this->db->quote($uploaded_file_url);
                            }
                        }
                    }

                    if (count($name_value_pair_sting) >= 1) {
                        $update_table_query_string = implode(', ', $name_value_pair_sting);
                    }



                    $sql = 'UPDATE ' . $actual_table_name . ' SET ' . $update_table_query_string . ' ' . $where_condition;
                    $stmt = $this->db->prepare($sql);

                    IF ($stmt->execute()) {
                        $this->tpl->set('message', 'File uploaded and file name updated successfully');
                    } else {
                        $this->tpl->set('message', 'File Update failed');
                    }
                } else {
                    $this->tpl->set('message', '- Success -');
                }
            } else {
                $this->tpl->set('message', 'Failed to insert');
            }
        } catch (Exception $exc) {
            $this->tpl->set('message', 'Upload part failed try again plz.');
        }
        $this->formConfig = Form_Elements::data($this->crg);
        $this->factory();
    }

    public function edit() {
        /*
         * Actual data from form
         * Safely we receive it
         */

        $data = $this->arrFltr($_POST);

        //var_dump($data);

        /*
         * actual table name with prefix
         * Reason for prrefixing table
         * for securoty reason evey installation need to have different table name
         */

        $actual_table_name = $this->crg->get('table_prefix') . $this->formConfig['table_name'];

        /*
         * @var $table_columns_to_select
         * @description Colums to be selected from the table
         * @type array
         */

        //$table_columns_to_select = array_keys($this->formConfig['form_content']);

        foreach ($this->formConfig['form_content'] as $key => $value) {
            if (trim($key)) {
                $table_columns_to_select[] = trim($key);
            }
        }

        //Buid SQL
        //
        //Colum name array to string
        $COLUMS = " `";
        $COLUMS .= implode("`,`", $table_columns_to_select);
        $COLUMS .= "` ";
        ///////////////////////////////

        /*
         * get data from user barnch id from user session
         * By default all the datas are selected with branch id condition
         */

        if (!empty($data['ycs_ID'])) {

            $where_condition = "";
            $where_condition .= "WHERE `ID` = '" . $data['ycs_ID'] . "'";

            $where_condition .= " Limit 1";

        $sql_query = "SELECT $COLUMS FROM `$actual_table_name` $where_condition";

            try {
                $stmt = $this->db->prepare($sql_query);

                IF ($stmt->execute()) {
                    $Data_rows = $stmt->fetchAll(2);


                    $this->tpl->set('message', 'You can edit');
                    $this->formConfig = Form_Elements::data($this->crg, $Data_rows[0]);
                }
            } catch (Exception $exc) {
                $this->tpl->set('message', 'You can not now - try again');
                
            }
        } else {
            $this->tpl->set('message', 'Failed to edit');
            $this->formConfig = Form_Elements::data($this->crg);
        }
        $this->factory();
    }

    /*
     * Update 
     * submit edit form
     * this is an update query
     */

    public function submit_edit_form() {

        $data = $this->arrFltr($_POST);

        /*
         * actual table name with prefix
         * Reason for prrefixing table
         * for securoty reason evey installation need to have different table name
         */

        $actual_table_name = $this->crg->get('table_prefix') . $this->formConfig['table_name'];


        /*
         * @var $table_columns_to_select
         * @description Colums to be selected from the table
         * @type array
         * seperate the file upload field
         */
        $keyValuPair = array();
        foreach ($this->formConfig['form_content'] as $key => $value) {
           if (trim($key) && $value['type'] !== 'file' && $key !== 'ID') {
                $table_columns = trim($key);
                $table_values = is_numeric($data[$key]) ? $data[$key] : $this->db->quote($data[$key]);
                $keyValuPair[] = $table_columns . ' = ' . $table_values;
            }
        }

        //////////////// history table insert starts//////////////
        if($this->formConfig['maintain_history_log_table']){
            
        $history_table = $actual_table_name.'_history';
        $id_for_history_tab = $data['ID'];
        $history_sql = "SELECT * FROM $actual_table_name WHERE ID=$id_for_history_tab";
        $stmt1 = $this->db->prepare($history_sql);
        $stmt1->execute();
        $Data_for_history_table = $stmt1->fetchAll(2);
        //var_dump($Data_for_history_table);
        
        $table_columns_history = array();
        $table_values_history = array();
        foreach($Data_for_history_table[0] as $key => $value){
                $table_columns_history[] = trim($key);
                $table_values_history[] = is_numeric($value) ? $value : $this->db->quote($value);
        }
        
        $column_string_history = ' (' . implode(", ", $table_columns_history) . ') ';
        $value_string_history = ' (' . implode(", ", $table_values_history) . ') ';
        //buid sql string
        $sql_history_insert = 'INSERT INTO ' . $history_table . $column_string_history . 'VALUES' . $value_string_history;
        $stmt2 = $this->db->prepare($sql_history_insert);
        $stmt2->execute();
        }
        /////////////////history table insert closes///////////////////
        
        
        if ($data['ID'] && count($keyValuPair) >= 1) {

            $where_condition = $this->whereCond('ID', $data['ID']);

            $value_string = implode(', ', $keyValuPair);

            $sql = 'UPDATE ' . $actual_table_name . ' SET ' . $value_string . ' ' . $where_condition;

            try {
                $stmt = $this->db->prepare($sql);
                IF ($stmt->execute()) {

                    /*
                     * Upload file part 
                     */

                    if ($data['ID'] && $this->formConfig['Form_Need_to_upload_file']) {

                        $fileUploadArr = $_FILES;
                        $where_condition = $this->whereCond('ID', $data['ID']);

                        $name_value_pair_sting = array();
                        foreach ($fileUploadArr as $uploadKey => $uploadValArr) {
                            if ($uploadValArr['error'] == 0) {
                                $uploaded_file_url = $this->handle_file_upload($uploadKey, $data['ID']);
                                if ($uploaded_file_url) {
                                    $name_value_pair_sting[] = $uploadKey . ' = ' . $this->db->quote($uploaded_file_url);
                                }
                            }
                        }

                        if (count($name_value_pair_sting) >= 1) {
                            $update_table_query_string = implode(', ', $name_value_pair_sting);
                        }

                        $sql = 'UPDATE ' . $actual_table_name . ' SET ' . $update_table_query_string . ' ' . $where_condition;
                        $stmt = $this->db->prepare($sql);

                        IF ($stmt->execute()) {
                            $editFormMsg =   'File uploaded and file name updated successfully';
                        } else {
                            $editFormMsg =   'File Update failed';
                        }
                    } else {
                        $editFormMsg =   'Data Updated, No File to Update';
                    }
                } else {
                    $editFormMsg =   'Update failed';
                }
            } catch (Exception $exc) {
                $editFormMsg =  'try again';
            }
        } else {
            $editFormMsg =  'Update failed';
        }

        $this->showEditForm($data['ID'],$editFormMsg);
    }

    /*
     * Data security
     * 
     */

    public function arrFltr($parr = array()) {
        if (is_array($parr)) {
            foreach ($parr as $psk => $psv) {
                $psr = $this->__mdsf($psk);

                if (is_array($psv)) {
                    foreach ($psv as $pk => $pv) {
                        if (trim($pv)) {
                            $padata[$psr][$this->__mdsf($pk)] = $this->__mdsf($pv);
                        }
                    }
                } else {
                    if (trim($psv)) {
                        $padata[$psr] = $this->__mdsf($psv);
                    }
                }
            }
            return $padata;
        } else {
            return false;
        }
    }

//////////////////////////////////

    /**
     * @param <type> string
     * @return <type> string
     * @desc treat with html entities and trim only
     * @example good for all types of post data except data from text area
     */
    public function __mdsf($mds) {
        $dta = trim($mds);
        if ($dta) {
            $tzz = htmlentities($dta);
            return $tzz;
        } else {
            return false;
        }
    }

    /*
     * handle file upload
     */

    public function handle_file_upload($params, $userID = NULL) {
        try {
            if (!empty($_FILES)) {
                if (is_uploaded_file($_FILES[$params]['tmp_name'])) {
                    $sourcePath = $_FILES[$params]['tmp_name'];
                    $targetPath = './resource/images/' . $userID . '-' . date('y-m-d-H-i-s') . '-' . $_FILES[$params]['name'];
                    if (move_uploaded_file($sourcePath, $targetPath)) {
                        return $targetPath;
                    } else {
                        return FALSE;
                    }
                }
            }
        } catch (Exception $exc) {
            return FALSE;
        }
    }

/////////////////////////////
//where condition///////////
///////////////////////////
    public function whereCond($key, $val) {
        $where_condition = 'WHERE ' . $key . ' = ';
        $where_condition .= is_numeric($val) ? $val : $this->db->quote($val);
        return $where_condition;
    }

///////////////////
//
    public function showEditForm($id,$msg) {
        if ($id) {
            $where_condition = $this->whereCond('ID', $id);
            $where_condition .= " Limit 1";

            $actual_table_name = $this->crg->get('table_prefix') . $this->formConfig['table_name'];

            $sql_query = "SELECT * FROM $actual_table_name $where_condition";

            try {
                $stmt = $this->db->prepare($sql_query);

                IF ($stmt->execute()) {
                    $Data_rows = $stmt->fetchAll(2);
                    $this->tpl->set('message', $msg);
                    $this->formConfig = Form_Elements::data($this->crg, $Data_rows[0]);
                }
            } catch (Exception $exc) {
                $this->tpl->set('message', 'You can not now - try again');
            }
        } else {
            $this->tpl->set('message', 'Failed to edit');
            $this->formConfig = Form_Elements::data($this->crg);
        }
        $this->factory();
    }

/////////////class close ////////////////////////////////////
}
