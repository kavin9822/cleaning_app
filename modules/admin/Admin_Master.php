<?php

/**
 * Description of Customer_Mod
 *
 * @author psmahadevan
 */
class Admin_Master {

    private $crg;
    private $ses;
    private $db;
    private $sd;
    private $tpl;
    private $rbac;

    public function __construct($reg = NULL) {
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
    }

    function department() {
        if ($this->crg->get('wp') || $this->crg->get('rp')) {
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////access condition applied///////////////////////////
//////////////////////////////////////////////////////////////////////////////// 
          
           include_once 'util/DBUTIL.php';
           $dbutil = new DBUTIL($this->crg);
             
             $entityID = $this->ses->get('user')['entity_ID'];
             $userID = $this->ses->get('user')['ID'];
            
            
           $dept_tab = $this->crg->get('table_prefix') . 'department';
                  
          

            ////////////////////start//////////////////////////////////////////////
                    
           //bUILD SQL 
            $whereString = '';
            
            $colArr = array(
                "$dept_tab.ID", 
                "$dept_tab.DeptName",
                "$dept_tab.Description"
               
            );
            
            $this->tpl->set('FmData', $_POST);
            foreach($_POST as $k=>$v){
                if(strpos($k,'^')){
                    unset($_POST[$k]);
                }
                $_POST[str_replace('^','_',$k)] = $v;
            }
            $PD=$_POST;
            if($_POST['list']!=''){
                $this->tpl->set('FmData', NULL);
                $PD=NULL;
            }

            IF (count($PD) >= 2) {
                $wsarr = array();
                foreach ($colArr as $colNames) {

		   if (strpos($colNames, 'Date') !== false) {
                list($colNames,$x) = $dbutil->dateFilterFormat($colNames);
            } else {
		        $x = $dbutil->__mdsf($PD[str_replace('.','_',$colNames)]);
            }

                    if ('' != $x) {
                        $wsarr[] = $colNames . " LIKE '%" . $x . "%'";
                    }
                }
                
              IF (count($wsarr) >= 1) {
                 $whereString = ' AND '. implode(' AND ', $wsarr);
              }
            }
            
            $orderBy ="ORDER BY $dept_tab.ID DESC";
            
         $sql = "SELECT "
                 . implode(',',$colArr)
                 . " FROM $dept_tab "
                 . " WHERE "
                 . " $dept_tab.entity_ID=$entityID "
                 . " $whereString "
                 . " $orderBy";
         
            $results_per_page = 50;     
            
                if(isset($PD['pageno'])){$page=$PD['pageno'];}
                else if(isset($PD['pagenof'])){$page=$PD['pagenofirst'];}
                else if(isset($PD['pagenop'])){$page=$PD['pagenoprev'];}
                else if(isset($PD['pagenon'])){$page=$PD['pagenonext'];}
                else if(isset($PD['pagenol'])){$page=$PD['pagenolast'];}
                else if(isset($PD['pagenog'])){$page=$PD['pagenogo'];}
                else{$page=1;} 
         
            /*
             * SET DATA TO TEMPLATE
             */
            $this->tpl->set('sql_data_rows', $dbutil->setPaginationList($sql,$page,$results_per_page,$wsarr));
            /*
             * set table label
             */
            $this->tpl->set('table_columns_label_arr', array('ID','Department Name','Description'));
            
            /*,;;
             * selectColArr for filter form
             */
            
            $this->tpl->set('selectColArr',$colArr);
                        
            /*
             * set pagination template
             */
            $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');
                   
            //////////////////////close//////////////////////////////////////  
          
             include_once $this->tpl->path .'/factory/form/crud_form_departmentmaster.php';
            
            
            $cus_form_data = Form_Elements::data($this->crg);
            include_once 'util/crud3_1.php';
            new Crud3($this->crg, $cus_form_data);
            $this->tpl->set('master_layout', 'layout_datepicker.php'); 
             //if crud is delivered at different point a template
            //Then  call that template and set to content
           
           ////$this->tpl->set('content', $this->tpl->fetch('modules/customer/manage_customer.php'));
        //////////////////////////////////////////////////////////////////////////////////
        //////////////////////////////on access condition failed then ///////////////////////////
        ////////////////////////////////////////////////////////////////////////////////            
        } else {
            if ($this->ses->get('user')['ID']) {
                $this->tpl->set('content', $this->tpl->fetch('modules/user/acess_failed_message.php'));
            } else {
                header('Location:' . $this->crg->get('route')['base_path'] . '/user/auth/login');
            }
        }
    }   
    //////////////////department close here//
    
    function tasktag() {
        if ($this->crg->get('wp') || $this->crg->get('rp')) {
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////access condition applied///////////////////////////
//////////////////////////////////////////////////////////////////////////////// 
          
           include_once 'util/DBUTIL.php';
           $dbutil = new DBUTIL($this->crg);
             
             $entityID = $this->ses->get('user')['entity_ID'];
             $userID = $this->ses->get('user')['ID'];
            
            
           $tasktag_tab = $this->crg->get('table_prefix') . 'tasktag';
                  
          

            ////////////////////start//////////////////////////////////////////////
                    
           //bUILD SQL 
            $whereString = '';
            
            $colArr = array(
                "$tasktag_tab.ID", 
                "$tasktag_tab.TaskTag",
                "$tasktag_tab.Description"
               
            );
            
            $this->tpl->set('FmData', $_POST);
            foreach($_POST as $k=>$v){
                if(strpos($k,'^')){
                    unset($_POST[$k]);
                }
                $_POST[str_replace('^','_',$k)] = $v;
            }
            $PD=$_POST;
            if($_POST['list']!=''){
                $this->tpl->set('FmData', NULL);
                $PD=NULL;
            }

            IF (count($PD) >= 2) {
                $wsarr = array();
                foreach ($colArr as $colNames) {

		   if (strpos($colNames, 'Date') !== false) {
                list($colNames,$x) = $dbutil->dateFilterFormat($colNames);
            } else {
		        $x = $dbutil->__mdsf($PD[str_replace('.','_',$colNames)]);
            }

                    if ('' != $x) {
                        $wsarr[] = $colNames . " LIKE '%" . $x . "%'";
                    }
                }
                
              IF (count($wsarr) >= 1) {
                 $whereString = ' AND '. implode(' AND ', $wsarr);
              }
            }
            
            $orderBy ="ORDER BY $tasktag_tab.ID DESC";
            
         $sql = "SELECT "
                 . implode(',',$colArr)
                 . " FROM $tasktag_tab "
                 . " WHERE "
                 . " $tasktag_tab.entity_ID=$entityID "
                 . " $whereString "
                 . " $orderBy";
         
            $results_per_page = 50;     
            
                if(isset($PD['pageno'])){$page=$PD['pageno'];}
                else if(isset($PD['pagenof'])){$page=$PD['pagenofirst'];}
                else if(isset($PD['pagenop'])){$page=$PD['pagenoprev'];}
                else if(isset($PD['pagenon'])){$page=$PD['pagenonext'];}
                else if(isset($PD['pagenol'])){$page=$PD['pagenolast'];}
                else if(isset($PD['pagenog'])){$page=$PD['pagenogo'];}
                else{$page=1;} 
         
            /*
             * SET DATA TO TEMPLATE
             */
            $this->tpl->set('sql_data_rows', $dbutil->setPaginationList($sql,$page,$results_per_page,$wsarr));
            /*
             * set table label
             */
            $this->tpl->set('table_columns_label_arr', array('ID','Tasktag Name','Description'));
            
            /*,;;
             * selectColArr for filter form
             */
            
            $this->tpl->set('selectColArr',$colArr);
                        
            /*
             * set pagination template
             */
            $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');
                   
            //////////////////////close//////////////////////////////////////  
          
             include_once $this->tpl->path .'/factory/form/crud_form_tasktag.php';
            
            
            $cus_form_data = Form_Elements::data($this->crg);
            include_once 'util/crud3_1.php';
            new Crud3($this->crg, $cus_form_data);
            $this->tpl->set('master_layout', 'layout_datepicker.php'); 
             //if crud is delivered at different point a template
            //Then  call that template and set to content
           
           ////$this->tpl->set('content', $this->tpl->fetch('modules/customer/manage_customer.php'));
        //////////////////////////////////////////////////////////////////////////////////
        //////////////////////////////on access condition failed then ///////////////////////////
        ////////////////////////////////////////////////////////////////////////////////            
        } else {
            if ($this->ses->get('user')['ID']) {
                $this->tpl->set('content', $this->tpl->fetch('modules/user/acess_failed_message.php'));
            } else {
                header('Location:' . $this->crg->get('route')['base_path'] . '/user/auth/login');
            }
        }
    } 
    
    public function item(){
    
            if ($this->crg->get('wp') || $this->crg->get('rp')) {
                     
                    ////////////////////////////////////////////////////////////////////////////////
                    //////////////////////////////access condition applied//////////////////////////
                    ////////////////////////////////////////////////////////////////////////////////    
                                
                    include_once 'util/DBUTIL.php';
                    $dbutil = new DBUTIL($this->crg);
                     
                    $entityID = $this->ses->get('user')['entity_ID'];
                    $userID = $this->ses->get('user')['ID'];
                    
                    $item_table = $this->crg->get('table_prefix') . 'item_master';
                    
                    $this->tpl->set('page_title', 'Item Master');	          
                    $this->tpl->set('page_header', 'Item Master');
                    //Add Role when u submit the add role form
                    $thisPageURL = $this->crg->get('route')['base_path'] . '/' . $this->crg->get('route')['module'] . '/' . $this->crg->get('route')['controller'] . '/' . $this->crg->get('route')['action'];
        
                    $crud_string = null;
            
                    if (isset($_POST['req_from_list_view'])) {
                        $crud_string = strtolower($_POST['req_from_list_view']);
                    }              
                    
                    //Edit submit
                    if (!empty($_POST['edit_submit_button']) && $_POST['edit_submit_button'] == 'edit') {
                        $crud_string = 'editsubmit';
                    }
        
                    //Add submit
                    if (!empty($_POST['add_submit_button']) && $_POST['add_submit_button'] == 'add') {
                        $crud_string = 'addsubmit';
                    }
        
        
                    switch ($crud_string) {
                         case 'delete':                    
                              $data = trim($_POST['ycs_ID']);
                              // var_dump($data); 
                               
                               
                            if (!$data) {
                                $this->tpl->set('message', 'Please select any one ID to '.$crud_string.'!');
                                $this->tpl->set('label', 'List');
                                $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                               
                            }
                             
                             $sqldetdelete="Delete from $item_table
                                                where $item_table.ID=$data"; 
                                $stmt = $this->db->prepare($sqldetdelete);            
                                
                                if($stmt->execute()){
                                $this->tpl->set('message', 'Item Master form deleted successfully');
                                                                                                                              
                                //$this->tpl->set('label', 'List');
                                //$this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                                header('Location:' . $this->crg->get('route')['base_path'] . '/admin/mast/item');
                                }
                    break;
                        case 'view':                    
                            $data = trim($_POST['ycs_ID']);
                         
                            if (!$data) {
                                $this->tpl->set('message', 'Please select any one ID to view!');
                                $this->tpl->set('label', 'List');
                                $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                                break;
                            }
                            
                            //mode of form submit
                            $this->tpl->set('mode', 'view');
                            //set id to edit $ycs_ID
                            $this->tpl->set('ycs_ID', $data);         
                                        
                            
                            // $sqlsrr = "SELECT * FROM `$employee_salary_table` WHERE `$employee_salary_table.ID` = '$data'";                    
                            // $employee_salary_data = $dbutil->getSqlData($sqlsrr); 
                            
                            $sqlsrr = "SELECT *
                                       FROM $item_table 
                                       WHERE 
                                       $item_table.ID = $data";   
                            $item_data = $dbutil->getSqlData($sqlsrr);
                           
                        
                            //edit option     
                            $this->tpl->set('message', 'You can view Item Master form');
                            $this->tpl->set('page_header', 'Item Master');
                            $this->tpl->set('FmData', $item_data); 
                            
                            $this->tpl->set('content', $this->tpl->fetch('factory/form/item_master_design_form.php'));                    
                            break;
                        
                        case 'edit':                    
                            $data = trim($_POST['ycs_ID']);
                       // var_dump($data);
                            if (!$data) {
                                $this->tpl->set('message', 'Please select any one ID to edit!');
                                $this->tpl->set('label', 'List');
                                $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                                break;
                            }
                            
                            //mode of form submit
                            $this->tpl->set('mode', 'edit');
                            //set id to edit $ycs_ID
                            $this->tpl->set('ycs_ID', $data);  
                                     
                        //   $sqlsrr = "SELECT  * FROM `$employee_salary_table` WHERE `$employee_salary_table.ID`= `$data`";                    
                        //   $employee_salary_data = $dbutil->getSqlData($sqlsrr); 
                           
                        $sqlsrr = "SELECT *
                                   FROM $item_table 
                                   WHERE 
                                   $item_table.ID = $data";   
                        $item_data = $dbutil->getSqlData($sqlsrr);
                           
                            
                            //edit option 
        
                            
                            $this->tpl->set('message', 'You can edit Item Master form');
                            $this->tpl->set('page_header', 'Item Master');
                            $this->tpl->set('FmData', $item_data); 
                            
                            $this->tpl->set('content', $this->tpl->fetch('factory/form/item_master_design_form.php'));                    
                            break;
                        
                        case 'editsubmit':             
                            $data = trim($_POST['ycs_ID']);
                            
                            //mode of form submit
                            $this->tpl->set('mode', 'edit');
                            //set id to edit $ycs_ID
                            $this->tpl->set('ycs_ID', $data);
        
                            //Post data
                            include_once 'util/genUtil.php';
                            $util = new GenUtil();
                            $form_post_data = $util->arrFltr($_POST);
    
                                                       
                            try{
                                  $ItemName= $form_post_data['ItemName'];
                                  $ItemDescription= $form_post_data['ItemDescription'];
                                  
                                    $sql_update="UPDATE $item_table set ItemName='$ItemName',
                                                                        ItemDescription ='$ItemDescription'
                                                                        WHERE ID=$data";
                                    $stmt1 = $this->db->prepare($sql_update);
                                    $stmt1->execute();
                                    
                                    $this->tpl->set('message', 'Item Master form edited successfully!');   
                                                                                                                                  
                                    // $this->tpl->set('label', 'List');
                                    // $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                                    header('Location:' . $this->crg->get('route')['base_path'] . '/admin/mast/item');
                                    } catch (Exception $exc) {
                                     //edit failed option
                                    $this->tpl->set('message', 'Failed to edit, try again!');
                                    $this->tpl->set('FmData', $form_post_data);
                                    $this->tpl->set('content', $this->tpl->fetch('factory/form/item_master_design_form.php'));
                                    }
        
                            break;
        
                        case 'addsubmit':
                             if (isset($crud_string)) {
         
                                $form_post_data = $dbutil->arrFltr($_POST);
    
                              // var_dump($_POST);
                             
                               
                               if (isset($form_post_data['ItemName'])) {
                                   
                                                $val = "'" . $form_post_data['ItemName'] . "'," .
                                                       "'" . $form_post_data['ItemDescription'] . "'," .
                                                       "'" .  $this->ses->get('user')['entity_ID'] . "'," .
                                                       "'" .  $this->ses->get('user')['ID'] . "'";
        
                                     $sql = "INSERT INTO `" . $this->crg->get('table_prefix') . "item_master`
                                                    (
                                                    `ItemName`, 
                                                    `ItemDescription`, 
                                                    `entity_ID`,
                                                    `users_ID`
                                                    ) 
                                                 VALUES ( $val )";
                                          $stmt = $this->db->prepare($sql);
                                          $stmt->execute();
                                          
                                }
                           
                                $this->tpl->set('mode', 'add');
                                $this->tpl->set('message', '- Success -');
                                // $this->tpl->set('content', $this->tpl->fetch('factory/form/salary_form.php'));
                                header('Location:' . $this->crg->get('route')['base_path'] . '/admin/mast/item');
                                                                                                                
                             } else {
                                    //edit option
                                    //if submit failed to insert form
                                    $this->tpl->set('message', 'Failed to submit!');
                                    $this->tpl->set('FmData', $form_post_data);
                                    $this->tpl->set('content', $this->tpl->fetch('factory/form/item_master_design_form.php'));
                             }
                            break;
                        case 'add':
                            $this->tpl->set('mode', 'add');
                            $this->tpl->set('page_header', 'Item Master');
                            $this->tpl->set('content', $this->tpl->fetch('factory/form/item_master_design_form.php'));
                            break;
        
                        default:
                            /*
                             * List form
                             */
                             
                            ////////////////////start//////////////////////////////////////////////
                            
                   //bUILD SQL 
                    $whereString = '';
                 $colArr = array(
                        "$item_table.ID",
                        "$item_table.ItemName"
        
                       );
                    
                    $this->tpl->set('FmData', $_POST);
                    foreach($_POST as $k=>$v){
                        if(strpos($k,'^')){
                            unset($_POST[$k]);
                        }
                        $_POST[str_replace('^','_',$k)] = $v;
                    }
                    $PD=$_POST;
                    if($_POST['list']!=''){
                        $this->tpl->set('FmData', NULL);
                        $PD=NULL;
                    }
        
                    IF (count($PD) >= 2) {
                        $wsarr = array();
                        foreach ($colArr as $colNames) {
        
                        if (strpos($colNames, 'DATE') !== false) {
                            list($colNames,$x) = $dbutil->dateFilterFormat($colNames);                    
                        }else {
                            $x = $dbutil->__mdsf($PD[str_replace('.','_',$colNames)]);        		    
                        }
        
                          if ('' != $x) {
                           $wsarr[] = $colNames . " LIKE '%" . $x . "%'";
                            }
                        }
                        
                   IF (count($wsarr) >= 1) {
                        $whereString = ' AND '. implode(' AND ', $wsarr);
                    }
                   } else {
                     $whereString ="ORDER BY $item_table.ID DESC";
                   }
                   
                      
               $sql = "SELECT " 
                            . implode(',',$colArr)
                            . " FROM $item_table  "
                            . " WHERE "
                            . " $item_table.entity_ID = $entityID" 
                            . " $whereString";
                    
           
            
                        $results_per_page = 50;     
                    
                        if(isset($PD['pageno'])){$page=$PD['pageno'];}
                        else if(isset($PD['pagenof'])){$page=$PD['pagenofirst'];}
                        else if(isset($PD['pagenop'])){$page=$PD['pagenoprev'];}
                        else if(isset($PD['pagenon'])){$page=$PD['pagenonext'];}
                        else if(isset($PD['pagenol'])){$page=$PD['pagenolast'];}
                        else if(isset($PD['pagenog'])){$page=$PD['pagenogo'];}
                        else{$page=1;} 
                    /*
                     * SET DATA TO TEMPLATE
                                */
                   $this->tpl->set('sql_data_rows', $dbutil->setPaginationList($sql,$page,$results_per_page,$wsarr));
                 
                 
                 
                    $this->tpl->set('table_columns_label_arr', array('ID','Item Name'));
                    
                    /*
                     * selectColArr for filter form
                     */
                    
                    $this->tpl->set('selectColArr',$colArr);
                                
                    /*
                     * set pagination template
                     */
                    $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');
                           
                    //////////////////////close//////////////////////////////////////  
                             
                            include_once $this->tpl->path . '/factory/form/crud_item_form.php';
                            $cus_form_data = Form_Elements::data($this->crg);
                            include_once 'util/crud3_1.php';
                            new Crud3($this->crg, $cus_form_data);
                            break;
                    }
        
                ///////////////Use different template////////////////////
                $this->tpl->set('master_layout', 'layout_datepicker.php'); 
        ////////////////////////////////////////////////////////////////////////////////
        //////////////////////////////on access condition failed then //////////////////
        //////////////////////////////////////////////////////////////////////////////// 
             } else {
                     if ($this->ses->get('user')['ID']) {
                         $this->tpl->set('content', $this->tpl->fetch('modules/user/acess_failed_message.php'));
                     } else {
                         header('Location:' . $this->crg->get('route')['base_path'] . '/user/auth/login');
                     }
                 }
            }
            
            function assignee() {
        if ($this->crg->get('wp') || $this->crg->get('rp')) {
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////access condition applied///////////////////////////
//////////////////////////////////////////////////////////////////////////////// 
          
           include_once 'util/DBUTIL.php';
           $dbutil = new DBUTIL($this->crg);
             
             $entityID = $this->ses->get('user')['entity_ID'];
             $userID = $this->ses->get('user')['ID'];
            
            
           $assignee_tab = $this->crg->get('table_prefix') . 'assignee';
                  
          

            ////////////////////start//////////////////////////////////////////////
                    
           //bUILD SQL 
            $whereString = '';
            
            $colArr = array(
                "$assignee_tab.ID", 
                "$assignee_tab.Assignee",
                "$assignee_tab.Description"
               
            );
            
            $this->tpl->set('FmData', $_POST);
            foreach($_POST as $k=>$v){
                if(strpos($k,'^')){
                    unset($_POST[$k]);
                }
                $_POST[str_replace('^','_',$k)] = $v;
            }
            $PD=$_POST;
            if($_POST['list']!=''){
                $this->tpl->set('FmData', NULL);
                $PD=NULL;
            }

            IF (count($PD) >= 2) {
                $wsarr = array();
                foreach ($colArr as $colNames) {

		   if (strpos($colNames, 'Date') !== false) {
                list($colNames,$x) = $dbutil->dateFilterFormat($colNames);
            } else {
		        $x = $dbutil->__mdsf($PD[str_replace('.','_',$colNames)]);
            }

                    if ('' != $x) {
                        $wsarr[] = $colNames . " LIKE '%" . $x . "%'";
                    }
                }
                
              IF (count($wsarr) >= 1) {
                 $whereString = ' AND '. implode(' AND ', $wsarr);
              }
            }
            
            $orderBy ="ORDER BY $assignee_tab.ID DESC";
            
         $sql = "SELECT "
                 . implode(',',$colArr)
                 . " FROM $assignee_tab "
                 . " WHERE "
                 . " $assignee_tab.entity_ID=$entityID "
                 . " $whereString "
                 . " $orderBy";
         
            $results_per_page = 50;     
            
                if(isset($PD['pageno'])){$page=$PD['pageno'];}
                else if(isset($PD['pagenof'])){$page=$PD['pagenofirst'];}
                else if(isset($PD['pagenop'])){$page=$PD['pagenoprev'];}
                else if(isset($PD['pagenon'])){$page=$PD['pagenonext'];}
                else if(isset($PD['pagenol'])){$page=$PD['pagenolast'];}
                else if(isset($PD['pagenog'])){$page=$PD['pagenogo'];}
                else{$page=1;} 
         
            /*
             * SET DATA TO TEMPLATE
             */
            $this->tpl->set('sql_data_rows', $dbutil->setPaginationList($sql,$page,$results_per_page,$wsarr));
            /*
             * set table label
             */
            $this->tpl->set('table_columns_label_arr', array('ID','Assignee Name','Description'));
            
            /*,;;
             * selectColArr for filter form
             */
            
            $this->tpl->set('selectColArr',$colArr);
                        
            /*
             * set pagination template
             */
            $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');
                   
            //////////////////////close//////////////////////////////////////  
          
             include_once $this->tpl->path .'/factory/form/crud_assignee_form.php';
            
            
            $cus_form_data = Form_Elements::data($this->crg);
            include_once 'util/crud3_1.php';
            new Crud3($this->crg, $cus_form_data);
            $this->tpl->set('master_layout', 'layout_datepicker.php'); 
             //if crud is delivered at different point a template
            //Then  call that template and set to content
           
           ////$this->tpl->set('content', $this->tpl->fetch('modules/customer/manage_customer.php'));
        //////////////////////////////////////////////////////////////////////////////////
        //////////////////////////////on access condition failed then ///////////////////////////
        ////////////////////////////////////////////////////////////////////////////////            
        } else {
            if ($this->ses->get('user')['ID']) {
                $this->tpl->set('content', $this->tpl->fetch('modules/user/acess_failed_message.php'));
            } else {
                header('Location:' . $this->crg->get('route')['base_path'] . '/user/auth/login');
            }
        }
    } 

    function issuetag() {
        if ($this->crg->get('wp') || $this->crg->get('rp')) {
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////access condition applied///////////////////////////
//////////////////////////////////////////////////////////////////////////////// 
          
           include_once 'util/DBUTIL.php';
           $dbutil = new DBUTIL($this->crg);
             
             $entityID = $this->ses->get('user')['entity_ID'];
             $userID = $this->ses->get('user')['ID'];
            
            
           $issuetag_tab = $this->crg->get('table_prefix') . 'issuetag';
                  
          

            ////////////////////start//////////////////////////////////////////////
                    
           //bUILD SQL 
            $whereString = '';
            
            $colArr = array(
                "$issuetag_tab.ID", 
                "$issuetag_tab.IssueTag",
                "$issuetag_tab.Description"
               
            );
            
            $this->tpl->set('FmData', $_POST);
            foreach($_POST as $k=>$v){
                if(strpos($k,'^')){
                    unset($_POST[$k]);
                }
                $_POST[str_replace('^','_',$k)] = $v;
            }
            $PD=$_POST;
            if($_POST['list']!=''){
                $this->tpl->set('FmData', NULL);
                $PD=NULL;
            }

            IF (count($PD) >= 2) {
                $wsarr = array();
                foreach ($colArr as $colNames) {

		   if (strpos($colNames, 'Date') !== false) {
                list($colNames,$x) = $dbutil->dateFilterFormat($colNames);
            } else {
		        $x = $dbutil->__mdsf($PD[str_replace('.','_',$colNames)]);
            }

                    if ('' != $x) {
                        $wsarr[] = $colNames . " LIKE '%" . $x . "%'";
                    }
                }
                
              IF (count($wsarr) >= 1) {
                 $whereString = ' AND '. implode(' AND ', $wsarr);
              }
            }
            
            $orderBy ="ORDER BY $issuetag_tab.ID DESC";
            
         $sql = "SELECT "
                 . implode(',',$colArr)
                 . " FROM $issuetag_tab "
                 . " WHERE "
                 . " $issuetag_tab.entity_ID=$entityID "
                 . " $whereString "
                 . " $orderBy";
         
            $results_per_page = 50;     
            
                if(isset($PD['pageno'])){$page=$PD['pageno'];}
                else if(isset($PD['pagenof'])){$page=$PD['pagenofirst'];}
                else if(isset($PD['pagenop'])){$page=$PD['pagenoprev'];}
                else if(isset($PD['pagenon'])){$page=$PD['pagenonext'];}
                else if(isset($PD['pagenol'])){$page=$PD['pagenolast'];}
                else if(isset($PD['pagenog'])){$page=$PD['pagenogo'];}
                else{$page=1;} 
         
            /*
             * SET DATA TO TEMPLATE
             */
            $this->tpl->set('sql_data_rows', $dbutil->setPaginationList($sql,$page,$results_per_page,$wsarr));
            /*
             * set table label
             */
            $this->tpl->set('table_columns_label_arr', array('ID','Issue tag','Description'));
            
            /*,;;
             * selectColArr for filter form
             */
            
            $this->tpl->set('selectColArr',$colArr);
                        
            /*
             * set pagination template
             */
            $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');
                   
            //////////////////////close//////////////////////////////////////  
          
             include_once $this->tpl->path .'/factory/form/crud_form_Issuetag.php';
            
            
            $cus_form_data = Form_Elements::data($this->crg);
            include_once 'util/crud3_1.php';
            new Crud3($this->crg, $cus_form_data);
            $this->tpl->set('master_layout', 'layout_datepicker.php'); 
             //if crud is delivered at different point a template
            //Then  call that template and set to content
           
           ////$this->tpl->set('content', $this->tpl->fetch('modules/customer/manage_customer.php'));
        //////////////////////////////////////////////////////////////////////////////////
        //////////////////////////////on access condition failed then ///////////////////////////
        ////////////////////////////////////////////////////////////////////////////////            
        } else {
            if ($this->ses->get('user')['ID']) {
                $this->tpl->set('content', $this->tpl->fetch('modules/user/acess_failed_message.php'));
            } else {
                header('Location:' . $this->crg->get('route')['base_path'] . '/user/auth/login');
            }
        }
    } 
    
    function role() {
        if ($this->crg->get('wp') || $this->crg->get('rp')) {
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////access condition applied///////////////////////////
//////////////////////////////////////////////////////////////////////////////// 
          
           include_once 'util/DBUTIL.php';
           $dbutil = new DBUTIL($this->crg);
             
             $entityID = $this->ses->get('user')['entity_ID'];
             $userID = $this->ses->get('user')['ID'];
            
            
           $role_tab = $this->crg->get('table_prefix') . 'role';
                  
          

            ////////////////////start//////////////////////////////////////////////
                    
           //bUILD SQL 
            $whereString = '';
            
            $colArr = array(
                "$role_tab.ID", 
                "$role_tab.RoleName",
                "$role_tab.Description"
               
            );
            
            $this->tpl->set('FmData', $_POST);
            foreach($_POST as $k=>$v){
                if(strpos($k,'^')){
                    unset($_POST[$k]);
                }
                $_POST[str_replace('^','_',$k)] = $v;
            }
            $PD=$_POST;
            if($_POST['list']!=''){
                $this->tpl->set('FmData', NULL);
                $PD=NULL;
            }

            IF (count($PD) >= 2) {
                $wsarr = array();
                foreach ($colArr as $colNames) {

		   if (strpos($colNames, 'Date') !== false) {
                list($colNames,$x) = $dbutil->dateFilterFormat($colNames);
            } else {
		        $x = $dbutil->__mdsf($PD[str_replace('.','_',$colNames)]);
            }

                    if ('' != $x) {
                        $wsarr[] = $colNames . " LIKE '%" . $x . "%'";
                    }
                }
                
              IF (count($wsarr) >= 1) {
                 $whereString = ' AND '. implode(' AND ', $wsarr);
              }
            }
            
            $orderBy ="ORDER BY $role_tab.ID DESC";
            
         $sql = "SELECT "
                 . implode(',',$colArr)
                 . " FROM $role_tab "
                 . " WHERE "
                 . " $role_tab.entity_ID=$entityID "
                 . " $whereString "
                 . " $orderBy";
         
            $results_per_page = 50;     
            
                if(isset($PD['pageno'])){$page=$PD['pageno'];}
                else if(isset($PD['pagenof'])){$page=$PD['pagenofirst'];}
                else if(isset($PD['pagenop'])){$page=$PD['pagenoprev'];}
                else if(isset($PD['pagenon'])){$page=$PD['pagenonext'];}
                else if(isset($PD['pagenol'])){$page=$PD['pagenolast'];}
                else if(isset($PD['pagenog'])){$page=$PD['pagenogo'];}
                else{$page=1;} 
         
            /*
             * SET DATA TO TEMPLATE
             */
            $this->tpl->set('sql_data_rows', $dbutil->setPaginationList($sql,$page,$results_per_page,$wsarr));
            /*
             * set table label
             */
            $this->tpl->set('table_columns_label_arr', array('ID','Role Name','Description'));
            
            /*,;;
             * selectColArr for filter form
             */
            
            $this->tpl->set('selectColArr',$colArr);
                        
            /*
             * set pagination template
             */
            $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');
                   
            //////////////////////close//////////////////////////////////////  
          
             include_once $this->tpl->path .'/factory/form/crud_role_master_form.php';
            
            
            $cus_form_data = Form_Elements::data($this->crg);
            include_once 'util/crud3_1.php';
            new Crud3($this->crg, $cus_form_data);
            $this->tpl->set('master_layout', 'layout_datepicker.php'); 
             //if crud is delivered at different point a template
            //Then  call that template and set to content
           
           ////$this->tpl->set('content', $this->tpl->fetch('modules/customer/manage_customer.php'));
        //////////////////////////////////////////////////////////////////////////////////
        //////////////////////////////on access condition failed then ///////////////////////////
        ////////////////////////////////////////////////////////////////////////////////            
        } else {
            if ($this->ses->get('user')['ID']) {
                $this->tpl->set('content', $this->tpl->fetch('modules/user/acess_failed_message.php'));
            } else {
                header('Location:' . $this->crg->get('route')['base_path'] . '/user/auth/login');
            }
        }
    } 
    
    public function add_user(){
    
                                    if ($this->crg->get('wp') || $this->crg->get('rp')) {
                                             
                                            ////////////////////////////////////////////////////////////////////////////////
                                            //////////////////////////////access condition applied//////////////////////////
                                            ////////////////////////////////////////////////////////////////////////////////    
                                                        
                                            include_once 'util/DBUTIL.php';
                                            $dbutil = new DBUTIL($this->crg);
                                             
                                            $entityID = $this->ses->get('user')['entity_ID'];
                                            $userID = $this->ses->get('user')['ID'];
                                            
                                            $add_user_table = $this->crg->get('table_prefix') . 'add_user';
                                            $department_table = $this->crg->get('table_prefix') . 'department';
                                            $role_table = $this->crg->get('table_prefix') . 'role';
                                
                                            $dept_sql = "SELECT ID,DeptName FROM $department_table";
                                            $stmt = $this->db->prepare($dept_sql);            
                                            $stmt->execute();
                                            $dept_data  = $stmt->fetchAll();	
                                            $this->tpl->set('dept_data', $dept_data);
            
                                            $role_sql = "SELECT ID,RoleName FROM $role_table";
                                            $stmt = $this->db->prepare($role_sql);            
                                            $stmt->execute();
                                            $role_data  = $stmt->fetchAll();	
                                            $this->tpl->set('role_data', $role_data);

                                            $usertype_data = array(array("ID"=>"1","Title"=>"Property Owner"),array("ID"=>"2","Title"=>"Service Provider"));
                                            $this->tpl->set('usertype_data', $usertype_data);

                                            $status_data = array(array("ID"=>"1","Title"=>"Active"),array("ID"=>"2","Title"=>"Inactive"));
                                            $this->tpl->set('status_data', $status_data);
                                            
                                            $this->tpl->set('page_title', 'User');	          
                                            $this->tpl->set('page_header', 'User');
                                            //Add Role when u submit the add role form
                                            $thisPageURL = $this->crg->get('route')['base_path'] . '/' . $this->crg->get('route')['module'] . '/' . $this->crg->get('route')['controller'] . '/' . $this->crg->get('route')['action'];
                                
                                            $crud_string = null;
                                    
                                            if (isset($_POST['req_from_list_view'])) {
                                                $crud_string = strtolower($_POST['req_from_list_view']);
                                            }              
                                            
                                            //Edit submit
                                            if (!empty($_POST['edit_submit_button']) && $_POST['edit_submit_button'] == 'edit') {
                                                $crud_string = 'editsubmit';
                                            }
                                
                                            //Add submit
                                            if (!empty($_POST['add_submit_button']) && $_POST['add_submit_button'] == 'add') {
                                                $crud_string = 'addsubmit';
                                            }
                                
                                
                                            switch ($crud_string) {
                                                 case 'delete':                    
                                                      $data = trim($_POST['ycs_ID']);
                                                      // var_dump($data); 
                                                       
                                                       
                                                    if (!$data) {
                                                        $this->tpl->set('message', 'Please select any one ID to '.$crud_string.'!');
                                                        $this->tpl->set('label', 'List');
                                                        $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                                                       
                                                    }
                                                     
                                                     $sqldetdelete="Delete from $add_user_table
                                                                        where $add_user_table.ID=$data"; 
                                                        $stmt = $this->db->prepare($sqldetdelete);            
                                                        
                                                        if($stmt->execute()){
                                                        $this->tpl->set('message', 'User form deleted successfully');
                                                                                                                                                      
                                                        //$this->tpl->set('label', 'List');
                                                        //$this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                                                        header('Location:' . $this->crg->get('route')['base_path'] . '/admin/mast/add_user');
                                                        }
                                            break;
                                                case 'view':                    
                                                    $data = trim($_POST['ycs_ID']);
                                                 
                                                    if (!$data) {
                                                        $this->tpl->set('message', 'Please select any one ID to view!');
                                                        $this->tpl->set('label', 'List');
                                                        $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                                                        break;
                                                    }
                                                    
                                                    //mode of form submit
                                                    $this->tpl->set('mode', 'view');
                                                    //set id to edit $ycs_ID
                                                    $this->tpl->set('ycs_ID', $data);         
                                                                
                                                    
                                                    // $sqlsrr = "SELECT * FROM `$employee_salary_table` WHERE `$employee_salary_table.ID` = '$data'";                    
                                                    // $employee_salary_data = $dbutil->getSqlData($sqlsrr); 
                                                    
                                                    $sqlsrr = "SELECT *
                                                               FROM $add_user_table 
                                                               WHERE 
                                                               $add_user_table.ID = $data";   
                                                    $add_user_data = $dbutil->getSqlData($sqlsrr);
                                                   
                                                    //edit option     
                                                    $this->tpl->set('message', 'You can view User form');
                                                    $this->tpl->set('page_header', 'User');
                                                    $this->tpl->set('FmData', $add_user_data); 
                                                    
                                                    $this->tpl->set('content', $this->tpl->fetch('factory/form/add_user_design_form.php'));                    
                                                    break;
                                                
                                                case 'edit':                    
                                                    $data = trim($_POST['ycs_ID']);
                                               // var_dump($data);
                                                    if (!$data) {
                                                        $this->tpl->set('message', 'Please select any one ID to edit!');
                                                        $this->tpl->set('label', 'List');
                                                        $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                                                        break;
                                                    }
                                                    
                                                    //mode of form submit
                                                    $this->tpl->set('mode', 'edit');
                                                    //set id to edit $ycs_ID
                                                    $this->tpl->set('ycs_ID', $data);  
                                                             
                                                //   $sqlsrr = "SELECT  * FROM `$employee_salary_table` WHERE `$employee_salary_table.ID`= `$data`";                    
                                                //   $employee_salary_data = $dbutil->getSqlData($sqlsrr); 
                                                   
                                                $sqlsrr = "SELECT *
                                                           FROM $add_user_table 
                                                           WHERE 
                                                           $add_user_table.ID = $data";   
                                                $add_user_data = $dbutil->getSqlData($sqlsrr);
                                                   
                                                    
                                                    //edit option 
                                
                                                    
                                                    $this->tpl->set('message', 'You can edit User form');
                                                    $this->tpl->set('page_header', 'User');
                                                    $this->tpl->set('FmData', $add_user_data); 
                                                    
                                                    $this->tpl->set('content', $this->tpl->fetch('factory/form/add_user_design_form.php'));                    
                                                    break;
                                                
                                                case 'editsubmit':             
                                                    $data = trim($_POST['ycs_ID']);
                                                    
                                                    //mode of form submit
                                                    $this->tpl->set('mode', 'edit');
                                                    //set id to edit $ycs_ID
                                                    $this->tpl->set('ycs_ID', $data);
                                
                                                    //Post data
                                                    include_once 'util/genUtil.php';
                                                    $util = new GenUtil();
                                                    $form_post_data = $util->arrFltr($_POST);
            
                                                                               
                                                    try{
                                                          $FirstName= $form_post_data['FirstName'];
                                                          $LastName= $form_post_data['LastName'];
                                                          $Email= $form_post_data['Email'];
                                                          $UserType= $form_post_data['UserType'];
                                                          $Role_ID= $form_post_data['Role_ID'];
                                                          $Department_ID= $form_post_data['Department_ID'];
                                                          $Status= $form_post_data['Status'];
                                                          
                                                            $sql_update="UPDATE $add_user_table set FirstName='$FirstName',
                                                                                                    LastName ='$LastName',
                                                                                                    Email='$Email',
                                                                                                    UserType='$UserType',
                                                                                                    Role_ID='$Role_ID',
                                                                                                    Department_ID='$Department_ID',
                                                                                                    Status='$Status'
                                                                                                
                                                                                                    WHERE ID=$data";
                                                            $stmt1 = $this->db->prepare($sql_update);
                                                            $stmt1->execute();
                                                            
                                                            $this->tpl->set('message', 'User form edited successfully!');   
                                                                                                                                                          
                                                            // $this->tpl->set('label', 'List');
                                                            // $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                                                            header('Location:' . $this->crg->get('route')['base_path'] . '/admin/mast/add_user');
                                                            } catch (Exception $exc) {
                                                             //edit failed option
                                                            $this->tpl->set('message', 'Failed to edit, try again!');
                                                            $this->tpl->set('FmData', $form_post_data);
                                                            $this->tpl->set('content', $this->tpl->fetch('factory/form/add_user_design_form.php'));
                                                            }
                                
                                                    break;
                                
                                                case 'addsubmit':
                                                     if (isset($crud_string)) {
                                 
                                                        $form_post_data = $dbutil->arrFltr($_POST);
                            
                                                        include_once 'util/genUtil.php';
                                                        $util = new GenUtil();
                                                        
                                                      // var_dump($_POST);
                                                     
                                                       if (isset($form_post_data['FirstName'])) {
                                                           
                                                                        $val = "'" . $form_post_data['FirstName'] . "'," .
                                                                         "'" . $form_post_data['LastName'] . "'," .
                                                                         "'" . $form_post_data['Email'] . "'," .
                                                                         "'" . $form_post_data['UserType'] . "'," .
                                                                         "'" . $form_post_data['Role_ID'] . "'," .
                                                                         "'" . $form_post_data['Department_ID'] . "'," .
                                                                         "'" . $form_post_data['Status'] . "'," .
                                                                              "'" .  $this->ses->get('user')['entity_ID'] . "'," .
                                                                         "'" .  $this->ses->get('user')['ID'] . "'";
                                
                                                             $sql = "INSERT INTO `" . $this->crg->get('table_prefix') . "add_user`
                                                                            (
                                                                            `FirstName`, 
                                                                            `LastName`,
                                                                            `Email`, 
                                                                            `UserType`, 
                                                                            `Role_ID`,
                                                                            `Department_ID`,
                                                                            `Status`,
                                                                            `entity_ID`,
                                                                            `users_ID`
                                                                            ) 
                                                                         VALUES ( $val )";
                                                                  $stmt = $this->db->prepare($sql);
                                                                  $stmt->execute();
                                                                  
                                                        }
                                                   
                                                        $this->tpl->set('mode', 'add');
                                                        $this->tpl->set('message', '- Success -');
                                                        // $this->tpl->set('content', $this->tpl->fetch('factory/form/salary_form.php'));
                                                        header('Location:' . $this->crg->get('route')['base_path'] . '/admin/mast/add_user');
                                                                                                                                        
                                                     } else {
                                                            //edit option
                                                            //if submit failed to insert form
                                                            $this->tpl->set('message', 'Failed to submit!');
                                                            $this->tpl->set('FmData', $form_post_data);
                                                            $this->tpl->set('content', $this->tpl->fetch('factory/form/add_user_design_form.php'));
                                                     }
                                                    break;
                                                case 'add':
                                                    $this->tpl->set('mode', 'add');
                                                    $this->tpl->set('page_header', 'User');
                                                    $this->tpl->set('content', $this->tpl->fetch('factory/form/add_user_design_form.php'));
                                                    break;
                                
                                                default:
                                                    /*
                                                     * List form
                                                     */
                                                     
                                                    ////////////////////start//////////////////////////////////////////////
                                                    
                                           //bUILD SQL 
                                            $whereString = '';
                                         $colArr = array(
                                                "$add_user_table.ID",
                                                "CONCAT(FirstName,' ',LastName) as OwnerName",
                                                "$add_user_table.Email",
                                                "CASE WHEN $add_user_table.UserType=1 THEN 'Property Owner' WHEN $add_user_table.UserType=2 THEN 'Service Provider' ELSE 'undefined' END as UserType ",
                                                "$role_table.RoleName",
                                                "$department_table.DeptName",
                                                "CASE WHEN $add_user_table.Status=1 THEN 'Active' WHEN $add_user_table.Status=2 THEN 'Inactive' ELSE 'undefined' END as Status"
                                
                                               );
                                            
                                            $this->tpl->set('FmData', $_POST);
                                            foreach($_POST as $k=>$v){
                                                if(strpos($k,'^')){
                                                    unset($_POST[$k]);
                                                }
                                                $_POST[str_replace('^','_',$k)] = $v;
                                            }
                                            $PD=$_POST;
                                            if($_POST['list']!=''){
                                                $this->tpl->set('FmData', NULL);
                                                $PD=NULL;
                                            }
                                
                                            IF (count($PD) >= 2) {
                                                $wsarr = array();
                                                foreach ($colArr as $colNames) {
                                
                                                if (strpos($colNames, 'DATE') !== false) {
                                                    list($colNames,$x) = $dbutil->dateFilterFormat($colNames);                    
                                                }else {
                                                    $x = $dbutil->__mdsf($PD[str_replace('.','_',$colNames)]);        		    
                                                }
                                
                                                  if ('' != $x) {
                                                   $wsarr[] = $colNames . " LIKE '%" . $x . "%'";
                                                    }
                                                }
                                                
                                           IF (count($wsarr) >= 1) {
                                                $whereString = ' AND '. implode(' AND ', $wsarr);
                                            }
                                           } else {
                                             $whereString ="ORDER BY $add_user_table.ID DESC";
                                           }
                                           
                                              
                                       $sql = "SELECT " 
                                                    . implode(',',$colArr)
                                                    . " FROM $add_user_table,$role_table,$department_table  "
                                                    . " WHERE "
                                                    . " $role_table.ID = $add_user_table.Role_ID AND" 
                                                    . " $department_table.ID = $add_user_table.Department_ID AND" 
                                                    . " $add_user_table.entity_ID = $entityID" 
                                                    . " $whereString";
                                            
                                   
                                    
                                                $results_per_page = 50;     
                                            
                                                if(isset($PD['pageno'])){$page=$PD['pageno'];}
                                                else if(isset($PD['pagenof'])){$page=$PD['pagenofirst'];}
                                                else if(isset($PD['pagenop'])){$page=$PD['pagenoprev'];}
                                                else if(isset($PD['pagenon'])){$page=$PD['pagenonext'];}
                                                else if(isset($PD['pagenol'])){$page=$PD['pagenolast'];}
                                                else if(isset($PD['pagenog'])){$page=$PD['pagenogo'];}
                                                else{$page=1;} 
                                            /*
                                             * SET DATA TO TEMPLATE
                                                        */
                                           $this->tpl->set('sql_data_rows', $dbutil->setPaginationList($sql,$page,$results_per_page,$wsarr));
                                         
                                         
                                         
                                            $this->tpl->set('table_columns_label_arr', array('ID','Property Owner Name','Email ID','User Type','Role Name','Department Name','Status'));
                                            
                                            /*
                                             * selectColArr for filter form
                                             */
                                            
                                            $this->tpl->set('selectColArr',$colArr);
                                                        
                                            /*
                                             * set pagination template
                                             */
                                            $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');
                                                   
                                            //////////////////////close//////////////////////////////////////  
                                                     
                                                    include_once $this->tpl->path . '/factory/form/crud_add_user_form.php';
                                                    $cus_form_data = Form_Elements::data($this->crg);
                                                    include_once 'util/crud3_1.php';
                                                    new Crud3($this->crg, $cus_form_data);
                                                    break;
                                            }
                                
                                        ///////////////Use different template////////////////////
                                        $this->tpl->set('master_layout', 'layout_datepicker.php'); 
                                ////////////////////////////////////////////////////////////////////////////////
                                //////////////////////////////on access condition failed then //////////////////
                                //////////////////////////////////////////////////////////////////////////////// 
                                     } else {
                                             if ($this->ses->get('user')['ID']) {
                                                 $this->tpl->set('content', $this->tpl->fetch('modules/user/acess_failed_message.php'));
                                             } else {
                                                 header('Location:' . $this->crg->get('route')['base_path'] . '/user/auth/login');
                                             }
                                         }
                                    }
    
    
}
