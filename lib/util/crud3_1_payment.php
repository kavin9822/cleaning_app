<?php

include_once 'util/formFactory.php';

class Crud3 {

    private $crg;
    private $ses;
    private $db;
    private $sd;
    private $tpl;
    private $rbac;
    private $update_form;

    /*
     * Quey conditions
     */

    /*
     * @var $reg registry array
     * 
     * $update_form = true
     * no add button available in the pagination
     */

    function __construct($reg, $form_config, $update_form = FALSE) {

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

        /*
         * Page Header
         */
        $this->tpl->set('page_header', $this->formConfig['page_title']);
        /*
         * set title
         */
        $this->tpl->set('form_title',$this->tpl->fetch('factory/template/crud_paginated_table_payment.php'));
       
        /*
         * set WHETHER FILE UPLOAD REQUIRED OR NOT
         */
        $this->tpl->set('Form_Need_to_upload_file', $this->formConfig['Form_Need_to_upload_file']);

        /*
         * table name from where the data access happen
         * used for data filter form in the pagination table
         * and sendit through js ajax to verify the 
         * usage of where condition and corresponding table
         */
        $this->tpl->set('tableName_wo_prefix', $this->formConfig['table_name']);

        /*
         * No add buttorn or add button removed
         * PART of crud2 CLASS INSTANCE
         */
        $this->update_form = $update_form;
        $this->tpl->set('update_form', $this->update_form);
        $this->tpl->set('ID_column_required', $this->formConfig['ID_column_required']);

        $this->__init();
    }

    public function __init() {

        /*
         * crud element setting
         * like edit, add or submit etc
         */

        $crud_string = null;

        if (isset($this->crg->get('route')['crud'])) {
            $crud_string = $this->crg->get('route')['crud'];
        }

        if (isset($_POST['req_from_list_view'])) {
            $crud_string = strtolower($_POST['req_from_list_view']);
        }





        /*
         * Example
         * /submit/edit
         */
        if (isset($this->crg->get('route')['crud_form_submit_from'])) {
            $crud_form_submit_from_a_form = $this->crg->get('route')['crud_form_submit_from'];
            $this->tpl->set('crud_form_submit_from', $crud_form_submit_from_a_form);
        } else {
            $crud_form_submit_from_a_form = $crud_string;
            $this->tpl->set('crud_form_submit_from', $crud_string);
        }



        switch ($crud_string) {
            case 'view':
                return $this->view();
                break;
            case 'edit':
                $myForm = new FF($this->crg, $this->formConfig);
                return $myForm->edit();
                break;
            case 'submit':
                $myForm = new FF($this->crg, $this->formConfig);

                if ($crud_form_submit_from_a_form == 'edit') {
                    return $myForm->submit_edit_form();
                } elseif ($crud_form_submit_from_a_form == 'add') {
                    return $myForm->submit();
                }
                break;
            case 'delete':
                return $this->delete();
                break;
            case 'add':
                $myForm = new FF($this->crg, $this->formConfig);
                return $myForm->factory();
                break;
            case 'list':
            default:
                return $this->paginate();
                break;
        }
    }

/////////////////////////////////////////


    protected function paginate() {
        
        try {
            
            $paginationTpl = $this->crg->get('paginationListTemplate');
            if ($paginationTpl) {
                $Complete_form = $this->tpl->fetch($paginationTpl);
            } else {
                $Complete_form = $this->tpl->fetch('factory/template/sql_based_crud_paginated_table.php');
            }
        } catch (Exception $exc) {
            $Complete_form = 'Pl.Try Again';
        }

        if ($this->crg->get('deliver_at')) {
            $this->tpl->set($this->crg->get('deliver_at'), $Complete_form);
        } else {
            $this->tpl->set('content', $Complete_form);
        }
    }

/////////////////////////////////////////////////////////////
//Delete function

    public function delete() {

        $data = isset($_POST['ycs_ID']) ? trim($_POST['ycs_ID']) : FALSE;

        $actual_table_name = $this->crg->get('table_prefix') . $this->formConfig['table_name'];
        try {
            if ($data) {
                $where_condition = "WHERE `ID` = '" . $data . "'";
                $sql_query = "DELETE FROM `$actual_table_name` $where_condition";
                $stmt = $this->db->prepare($sql_query);

                if ($stmt->execute()) {
                    $this->tpl->set('message', 'Deleted');
                } else {
                    $this->tpl->set('message', 'failed to delete');
                }
            } else {
                $this->tpl->set('message', 'failed to delete');
            }
        } catch (Exception $exc) {
            $this->tpl->set('message', $exc->getTraceAsString());
        }
        header("Location:" . $this->crg->get('route')['ref_url']);
    }

    protected function view() {
    
        $data = isset($_POST['ycs_ID']) ? trim($_POST['ycs_ID']) : FALSE;
               
        $userEntityId = $this->ses->get('user')['entity_ID'];

        //bUILD SQL 
        $table1 = $this->crg->get('table_prefix') . 'payment';
        $table2 = $this->crg->get('table_prefix') . 'employee';
        $table3 = $this->crg->get('table_prefix') . 'expense';
        $table4 = $this->crg->get('table_prefix') . 'paymentmode';

	$colArr = array(
            	"$table1.ID",                
                "$table2.Name",
                "$table1.NonEmployee",
                "$table3.ExpenseType",
                "$table1.Amount",
                "$table4.Paymode",
                "$table1.PaymentDate",
                "$table1.Remark",
            );        
        
        $sql_query = "SELECT "
                . implode(',', $colArr)              
                . " FROM $table1 LEFT JOIN $table2 ON $table2.ID = $table1.employee_ID,$table3,$table4"
                . " WHERE "
 		. " $table1.ID = $data AND "  
                . " $table3.ID = $table1.ExpenseType AND "         
                . " $table4.ID = $table1.PaymentMode AND "
                . " $table1.entity_ID = $userEntityId ";    


              $stmt = $this->db->prepare($sql_query);
              $stmt->execute();
              $Data_rows = $stmt->fetchAll(2);
             
        foreach ($Data_rows as $row) { 
       
     		$vou =    ''  . $row['ID'];
     		$nam =    ''  . $row['Name'];
    		$non =    ''  . $row['NonEmployee'];
                $ext =    ''  . $row['ExpenseType'];
                $amt =    ''  . $row['Amount'];
                $pym =    ''  . $row['Paymode'];
                $pyd =    ''  . $row['PaymentDate'];
                $rmk =    ''  . $row['Remark'];
         
               $val_str = "<br>$vou<br><br> $nam$non<br><br> $ext<br><br> $amt<br><br> $pym<br><br> $pyd<br><br> $rmk";        
        }
       

        /*
         * get content of an id to view
         */
        try {

            if ($data) {              

                    $lable_str = "<br>Voucher&nbsp;No.<br><br> Name<br><br> Expense&nbsp;Type<br><br> Amount<br><br> Payment&nbsp;Mode<br><br> Payment&nbsp;Date<br><br> Remark";
                   $this->tpl->set('label',$lable_str);
                   $this->tpl->set('value',$val_str);
                 

                    if ($value['type'] === 'file') {
                        $form_element_template_file = 'form_image.php';
                    } else {
                        $form_element_template_file = 'form_paragraph.php';
                    }


                    if ($tatal_form_count > $max_number_form_elements_per_colum && $count > $max_number_form_elements_per_colum) {
                        $form_content_master_col_2 .= $this->tpl->fetch('factory/template/' . $form_element_template_file);
                    } else {
                        $form_content_master_col_1 .= $this->tpl->fetch('factory/template/' . $form_element_template_file);
                    }

                    $count = $count + 1;                



                ////////////////////////////////////////////////////////////////////
                ////////////////////////form footer////////////////////////////////
                //////////////////////////////////////////////////////////////////
                $form_footer_master = '';
                $this->tpl->set('name', $this->formConfig['form_footer']['list']);
                $this->tpl->set('label', $this->formConfig['form_footer']['list']['label']);
                $form_footer_master .= $this->tpl->fetch('factory/template/form_print_link.php');
                $this->tpl->set('form_footer', $form_footer_master);
                //////////////////////////////////////////////////////////////////////

                if ($tatal_form_count > $max_number_form_elements_per_colum) {
                    $this->tpl->set('form_content_master_col_one', $form_content_master_col_1);
                    $this->tpl->set('form_content_master_col_two', $form_content_master_col_2);

                    $Complete_form = $this->tpl->fetch('factory/template/form_master_two_column.php');
                } else {
                    $this->tpl->set('form_content_master_col_one', $form_content_master_col_1);
                    $Complete_form = $this->tpl->fetch('factory/template/form_master_one_column.php');
                }

                if ($this->crg->get('deliver_at')) {
                    $this->tpl->set($this->crg->get('deliver_at'), $Complete_form);
                } else {
                    $this->tpl->set('content', $Complete_form);
                }
            } else {
		$this->tpl->set('message', 'Pl.Select any one data to view');
                $this->tpl->set('label', 'Go back to list view');
                $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                //   header("Location:" . $this->crg->get('route')['ref_url']);
            }
        } catch (Exception $exc) {
		$this->tpl->set('message', 'Pl. Try again');
                $this->tpl->set('label', 'Go back to list view');
                $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));

        }
    }

    private function WC() {
        /*
         * get data from user barnch id from user session
         * By default all the datas are selected with branch id condition
         */

        $whereStating = "WHERE ";
        $where_condition = array();
        /*
         * Filter by search filter data from session
         */
        if ($this->ses->get('filter_query')[$this->formConfig['table_name']]) {
            //$b_ID = $this->ses->get('user')['Entity'];
            $where_condition[] = $this->ses->get('filter_query')[$this->formConfig['table_name']];
        }

        /*
         * entity_ID
        */
     if ($this->formConfig['filter_by_entity_id'] && $this->ses->get('user')['entity_ID']) {
        
            $e_ID = $this->ses->get('user')['entity_ID'];
            $where_condition[] = "`entity_ID` = '$e_ID' ";
        }
        
        /*
         * If user loged in AND FILTER by user id
         */
        if ($this->formConfig['filter_by_user_id'] && $this->ses->get('user')['ID']) {
            $u_ID = $this->ses->get('user')['ID'];
            $where_condition[] = "`user_ID` = '$u_ID'";
        }



        /*
         * If user loged in AND FILTER by any column
         * additional filters apart from the filter data from session
         * included only in crud3
         */
         
        if (isset($this->formConfig['filter_by_col'])) {

            foreach ($this->formConfig['filter_by_col'] as $key => $value) {

                if (isset($this->ses->get('filter_query')[$this->formConfig['table_name']])) {
                    if (!strstr($this->ses->get('filter_query')[$this->formConfig['table_name']], $key)) {
                        $where_condition[]  = $value;
                    }
                } else {
                    $where_condition[]  = $value;
                }
            }
        }



        $wc_string = implode(" AND ", $where_condition);

        if ($wc_string) {
            return $whereStating . ' ' . $wc_string;
        } else {
            return FALSE;
        }
    }

    public function filterfactory($selected_table_columns) {

        //var_dump($selected_table_columns);

        /*
         * Content string in clumn one
         */
        $filter_form = '';
        /*
         * Content string in col 2
         */
        $j = 3;
        if (!$this->formConfig['ID_column_required']) {
            array_shift($selected_table_columns);
        }
        foreach ($selected_table_columns as $value) {


            $this->tpl->set('name', $value);

            foreach ($this->formConfig['form_content'][$value] as $ffkey => $ffvalue) {
                $this->tpl->set($ffkey, $ffvalue);
            }

            //var_dump($this->formConfig['form_content'][$value]['type']);

            $filter_form_element_template_file = $this->filterformElementTemplate($this->formConfig['form_content'][$value]['type']);
            $filter_form .= '<td colspan="1" rowspan="1">'
                    . $this->tpl->fetch('factory/template/filterForms/' . $filter_form_element_template_file)
                    . '</td>';


            if ($j == $this->formConfig['Max_number_columns_in_data_grid']) {
                break;
            }
            $j++;
        }

        $this->tpl->set('filter_form', $filter_form);
    }

    /*
     * Protected function to select type of template 
     * wto the input type
     */

    protected function filterformElementTemplate($param) {

        switch ($param) {

            case 'select':
                $form_template_file = 'select.php';
                break;

            default:
                $form_template_file = 'general.php';
                break;
        }

        return $form_template_file;
    }

/////////////class close ////////////////////////////////////
}
