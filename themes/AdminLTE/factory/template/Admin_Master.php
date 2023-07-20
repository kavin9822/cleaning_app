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


function gate() {
        if ($this->crg->get('wp') || $this->crg->get('rp')) {
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////access condition applied///////////////////////////
////////////////////////////////////////////////////////////////////////////////            
            /*
             * Where to deliver the crud content in tpl
             */
            //$this->crg->set('deliver_at', 'inner_content');
            
            
            //$this->tpl->set('widget_1', $this->tpl->fetch('modules/customer/manage_customer.php'));
            //$this->tpl->set('widget_2', $this->tpl->fetch('modules/customer/manage_customer.php'));

            //var_dump($this->ses->get('select')['customer']['customertype_ID']);
            
          
                include_once $this->tpl->path . '/factory/form/crud_form_gate.php';
            

            

            $cus_form_data = Form_Elements::data($this->crg);
            include_once 'util/crud2.php';
            new Crud2($this->crg, $cus_form_data);
            
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
     function gateinfo() {
        if ($this->crg->get('wp') || $this->crg->get('rp')) {
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////access condition applied///////////////////////////
//////////////////////////////////////////////////////////////////////////////// 
          
           include_once 'util/DBUTIL.php';
           $dbutil = new DBUTIL($this->crg);
             
             $entityID = $this->ses->get('user')['entity_ID'];
             $userID = $this->ses->get('user')['ID'];
            
            
           $gate_tab = $this->crg->get('table_prefix') . 'gateinfo';
                  
          

            ////////////////////start//////////////////////////////////////////////
                    
           //bUILD SQL 
            $whereString = '';
            
            $colArr = array(
                "$gate_tab.ID", 
                "$gate_tab.GateNo"
               
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
            
            $orderBy ="ORDER BY $gate_tab.ID DESC";
            
         $sql = "SELECT "
                 . implode(',',$colArr)
                 . " FROM $gate_tab "
                 . " WHERE "
                 . " $gate_tab.entity_ID=$entityID "
                 . " $whereString"
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
            $this->tpl->set('table_columns_label_arr', array('ID','Gate No'));
            
            /*,;;
             * selectColArr for filter form
             */
            
            $this->tpl->set('selectColArr',$colArr);
                        
            /*
             * set pagination template
             */
            $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');
                   
            //////////////////////close//////////////////////////////////////  
          
             include_once $this->tpl->path .'/factory/form/crud_form_gate.php';
            
            
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

/////////////
  function breakdownreason() {
        if ($this->crg->get('wp') || $this->crg->get('rp')) {
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////access condition applied///////////////////////////
//////////////////////////////////////////////////////////////////////////////// 
          
           include_once 'util/DBUTIL.php';
           $dbutil = new DBUTIL($this->crg);
             
             $entityID = $this->ses->get('user')['entity_ID'];
             $userID = $this->ses->get('user')['ID'];
            
            
           $brk_tab = $this->crg->get('table_prefix') . 'breakdownreasons';
                  
          

            ////////////////////start//////////////////////////////////////////////
                    
           //bUILD SQL 
            $whereString = '';
            
            $colArr = array(
                "$brk_tab.ID", 
                "$brk_tab.Description"
               
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
            
            $orderBy ="ORDER BY $brk_tab.ID DESC";
            
         $sql = "SELECT "
                 . implode(',',$colArr)
                 . " FROM $brk_tab "
                 . " WHERE "
                 . " $brk_tab.entity_ID=$entityID "
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
            $this->tpl->set('table_columns_label_arr', array('ID','Description'));
            
            /*,;;
             * selectColArr for filter form
             */
            
            $this->tpl->set('selectColArr',$colArr);
                        
            /*
             * set pagination template
             */
            $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');
                   
            //////////////////////close//////////////////////////////////////  
          
             include_once $this->tpl->path .'/factory/form/crud_form_breakdownreason.php';
            
            
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
function brkreason() {
        if ($this->crg->get('wp') || $this->crg->get('rp')) {
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////access condition applied///////////////////////////
////////////////////////////////////////////////////////////////////////////////            
            /*
             * Where to deliver the crud content in tpl
             */
            //$this->crg->set('deliver_at', 'inner_content');
            
            
            //$this->tpl->set('widget_1', $this->tpl->fetch('modules/customer/manage_customer.php'));
            //$this->tpl->set('widget_2', $this->tpl->fetch('modules/customer/manage_customer.php'));

            //var_dump($this->ses->get('select')['customer']['customertype_ID']);
            
          
                include_once $this->tpl->path . '/factory/form/crud_form_breakdownreason.php';
            

            

            $cus_form_data = Form_Elements::data($this->crg);
            include_once 'util/crud2.php';
            new Crud2($this->crg, $cus_form_data);
            
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
 function shifttiming() {
        if ($this->crg->get('wp') || $this->crg->get('rp')) {
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////access condition applied///////////////////////////
//////////////////////////////////////////////////////////////////////////////// 
          
           include_once 'util/DBUTIL.php';
           $dbutil = new DBUTIL($this->crg);
             
             $entityID = $this->ses->get('user')['entity_ID'];
             $userID = $this->ses->get('user')['ID'];
            
            
           $shift_tab = $this->crg->get('table_prefix') . 'shifttiming';
                  
          

            ////////////////////start//////////////////////////////////////////////
                    
           //bUILD SQL 
            $whereString = '';
            
            $colArr = array(
                "$shift_tab.ID", 
                "$shift_tab.ShiftName",
                "$shift_tab.FromTime",
                "$shift_tab.ToTime"
               
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
            
            $orderBy ="ORDER BY $shift_tab.ID DESC";
            
         $sql = "SELECT "
                 . implode(',',$colArr)
                 . " FROM $shift_tab "
                 . " WHERE "
                 . " $shift_tab.entity_ID=$entityID "
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
            $this->tpl->set('table_columns_label_arr', array('ID','Shift Name','From Time','To Time'));
            
            /*,;;
             * selectColArr for filter form
             */
            
            $this->tpl->set('selectColArr',$colArr);
                        
            /*
             * set pagination template
             */
            $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');
                   
            //////////////////////close//////////////////////////////////////  
          
             include_once $this->tpl->path .'/factory/form/crud_form_shifttiming.php';
            
            
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
    
    function shift() {
        if ($this->crg->get('wp') || $this->crg->get('rp')) {
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////access condition applied///////////////////////////
////////////////////////////////////////////////////////////////////////////////            
           
                
            include_once $this->tpl->path .'/factory/form/crud_form_shifttiming.php';
            
            $cus_form_data = Form_Elements::data($this->crg);
            include_once 'util/crud2.php';
            new Crud2($this->crg, $cus_form_data);
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
    ///////////////////////////
   function machinemaster() {
        if ($this->crg->get('wp') || $this->crg->get('rp')) {
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////access condition applied///////////////////////////
//////////////////////////////////////////////////////////////////////////////// 
          
           include_once 'util/DBUTIL.php';
           $dbutil = new DBUTIL($this->crg);
             
             $entityID = $this->ses->get('user')['entity_ID'];
             $userID = $this->ses->get('user')['ID'];
            
            
           $mm_tab = $this->crg->get('table_prefix') . 'machinemaster';
                  
          

            ////////////////////start//////////////////////////////////////////////
                    
           //bUILD SQL 
            $whereString = '';
            
            $colArr = array(
                "$mm_tab.ID", 
                "$mm_tab.MachineCode",
                "$mm_tab.MachineName"
                
               
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
            
            $orderBy ="ORDER BY $mm_tab.ID DESC";
            
         $sql = "SELECT "
                 . implode(',',$colArr)
                 . " FROM $mm_tab "
                 . " WHERE "
                 . " $mm_tab.entity_ID=$entityID "
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
            $this->tpl->set('table_columns_label_arr', array('ID','Machine Code','Machine Name'));
            
            /*,;;
             * selectColArr for filter form
             */
            
            $this->tpl->set('selectColArr',$colArr);
                        
            /*
             * set pagination template
             */
            $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');
                   
            //////////////////////close//////////////////////////////////////  
          
             include_once $this->tpl->path .'/factory/form/crud_form_Machinemaster.php';
            
            
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
      
function mmaster() {
        if ($this->crg->get('wp') || $this->crg->get('rp')) {
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////access condition applied///////////////////////////
////////////////////////////////////////////////////////////////////////////////            
            /*
             * Where to deliver the crud content in tpl
             */
            //$this->crg->set('deliver_at', 'inner_content');
            
            
            //$this->tpl->set('widget_1', $this->tpl->fetch('modules/customer/manage_customer.php'));
            //$this->tpl->set('widget_2', $this->tpl->fetch('modules/customer/manage_customer.php'));

            //var_dump($this->ses->get('select')['customer']['customertype_ID']);
            
          
                include_once $this->tpl->path . '/factory/form/crud_form_Machinemaster.php';
            

            

            $cus_form_data = Form_Elements::data($this->crg);
            include_once 'util/crud2.php';
            new Crud2($this->crg, $cus_form_data);
            
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
    
    function dg() {
        if ($this->crg->get('wp') || $this->crg->get('rp')) {
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////access condition applied///////////////////////////
////////////////////////////////////////////////////////////////////////////////            
           
                
            include_once $this->tpl->path .'/factory/form/crud_form_dieselgeneratorregister.php';
            
            $cus_form_data = Form_Elements::data($this->crg);
            include_once 'util/crud2.php';
            new Crud2($this->crg, $cus_form_data);
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
    
  function criticalspare() {
        if ($this->crg->get('wp') || $this->crg->get('rp')) {
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////access condition applied///////////////////////////
//////////////////////////////////////////////////////////////////////////////// 
          
           include_once 'util/DBUTIL.php';
           $dbutil = new DBUTIL($this->crg);
             
             $entityID = $this->ses->get('user')['entity_ID'];
             $userID = $this->ses->get('user')['ID'];
            
            
           $criticalspare_tab = $this->crg->get('table_prefix') . 'CriticalSpare';
           $unit_table = $this->crg->get('table_prefix') . 'unit';
           $machmasstat_table = $this->crg->get('table_prefix') . 'machinemaster';            
          

            ////////////////////start//////////////////////////////////////////////
                    
           //bUILD SQL 
            $whereString = '';
            
            $colArr = array(
                "$criticalspare_tab.ID", 
                "$criticalspare_tab.SpareName",
                "$machmasstat_table.MachineName", 
                "$unit_table.UnitName",
                "$criticalspare_tab.MinStock", 
                "$criticalspare_tab.MaxStock"
               
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
            
            $orderBy ="ORDER BY $criticalspare_tab.ID DESC";
            
         $sql = "SELECT "
                 . implode(',',$colArr)
                 . " FROM $criticalspare_tab,$unit_table,$machmasstat_table "
                 . " WHERE "
                 . " $machmasstat_table.ID=$criticalspare_tab.machine_ID AND "
                 . " $unit_table.ID=$criticalspare_tab.unit_ID AND "
                 . " $criticalspare_tab.entity_ID=$entityID "
                 . " $whereString"
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
            $this->tpl->set('table_columns_label_arr', array('ID','Spare Name','Machine','UOM','Minimum Stock','Maximum Stock'));
            
            /*,;;
             * selectColArr for filter form
             */
            
            $this->tpl->set('selectColArr',$colArr);
                        
            /*
             * set pagination template
             */
            $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');
                   
            //////////////////////close//////////////////////////////////////  
          
             include_once $this->tpl->path .'/factory/form/crud_form_critical.php';
            
            
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
    
   //////////////////////
   function producttype() {
        if ($this->crg->get('wp') || $this->crg->get('rp')) {
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////access condition applied///////////////////////////
//////////////////////////////////////////////////////////////////////////////// 
          
           include_once 'util/DBUTIL.php';
           $dbutil = new DBUTIL($this->crg);
             
             $entityID = $this->ses->get('user')['entity_ID'];
             $userID = $this->ses->get('user')['ID'];
            
            
           $pdttype_tab = $this->crg->get('table_prefix') . 'producttype';
                  
          

            ////////////////////start//////////////////////////////////////////////
                    
           //bUILD SQL 
            $whereString = '';
            
            $colArr = array(
                "$pdttype_tab.ID", 
                "$pdttype_tab.ProductType"
                
                
               
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
            
            $orderBy ="ORDER BY $pdttype_tab.ID DESC";
            
         $sql = "SELECT "
                 . implode(',',$colArr)
                 . " FROM $pdttype_tab "
                 . " WHERE "
                 . " $pdttype_tab.entity_ID=$entityID "
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
            $this->tpl->set('table_columns_label_arr', array('ID','Part Name'));
            
            /*,;;
             * selectColArr for filter form
             */
            
            $this->tpl->set('selectColArr',$colArr);
                        
            /*
             * set pagination template
             */
            $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');
                   
            //////////////////////close//////////////////////////////////////  
          
             include_once $this->tpl->path .'/factory/form/crud_form_producttype.php';
            
            
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


   //////////////////////
   function rawmaterialtype() {
    if ($this->crg->get('wp') || $this->crg->get('rp')) {
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////access condition applied///////////////////////////
//////////////////////////////////////////////////////////////////////////////// 
      
       include_once 'util/DBUTIL.php';
       $dbutil = new DBUTIL($this->crg);
         
         $entityID = $this->ses->get('user')['entity_ID'];
         $userID = $this->ses->get('user')['ID'];
        
        
       $pdttype_tab = $this->crg->get('table_prefix') . 'rawmaterialtype';
              
      

        ////////////////////start//////////////////////////////////////////////
                
       //bUILD SQL 
        $whereString = '';
        
        $colArr = array(
            "$pdttype_tab.ID", 
            "$pdttype_tab.RawMaterialType"
            
            
           
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
             $whereString = ' WHERE '. implode(' AND ', $wsarr);

          }
        }
        
        $orderBy ="ORDER BY $pdttype_tab.ID DESC";
        
     $sql = "SELECT "
             . implode(',',$colArr)
             . " FROM $pdttype_tab "
            //  . " WHERE "
            //  . " $pdttype_tab.entity_ID=$entityID "
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
        $this->tpl->set('table_columns_label_arr', array('ID','RawMaterial Type Name'));
        
        /*,;;
         * selectColArr for filter form
         */
        
        $this->tpl->set('selectColArr',$colArr);
                    
        /*
         * set pagination template
         */
        $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');
               
        //////////////////////close//////////////////////////////////////  
      
         include_once $this->tpl->path .'/factory/form/crud_form_rawmaterialtype.php';
        
        
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
     
   
    function pdttype() {
        if ($this->crg->get('wp') || $this->crg->get('rp')) {
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////access condition applied///////////////////////////
////////////////////////////////////////////////////////////////////////////////            
           
                
            include_once $this->tpl->path .'/factory/form/crud_form_producttype.php';
            
            $cus_form_data = Form_Elements::data($this->crg);
            include_once 'util/crud2.php';
            new Crud2($this->crg, $cus_form_data);
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
   
  /////////////////////////////////////////
     function departmentmaster() {
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
                "$dept_tab.DeptCode",
                "$dept_tab.DeptName"
               
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
            $this->tpl->set('table_columns_label_arr', array('ID','Department Code','Department Name'));
            
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
     
      
    
     function department() {
        if ($this->crg->get('wp') || $this->crg->get('rp')) {
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////access condition applied///////////////////////////
////////////////////////////////////////////////////////////////////////////////            
           
                
            include_once $this->tpl->path .'/factory/form/crud_form_departmentmaster.php';
            
            $cus_form_data = Form_Elements::data($this->crg);
            include_once 'util/crud2.php';
            new Crud2($this->crg, $cus_form_data);
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
    //////////////////entity close here//////////////////
      function bom(){
     if ($this->crg->get('wp') || $this->crg->get('rp')) {
 ////////////////////////////////////////////////////////////////////////////////
 //////////////////////////////access condition applied//////////////////////////
 ////////////////////////////////////////////////////////////////////////////////    
            
            include_once 'util/DBUTIL.php';
            $dbutil = new DBUTIL($this->crg);
             
            $entityID = $this->ses->get('user')['entity_ID'];
            $userID = $this->ses->get('user')['ID'];
            
            $mould_table = $this->crg->get('table_prefix') . 'mould';
            $cust_table = $this->crg->get('table_prefix') . 'customer';
            $pdt_table = $this->crg->get('table_prefix') . 'product';
            $pdttype_table = $this->crg->get('table_prefix') . 'producttype';
            $machmasstat_table = $this->crg->get('table_prefix') . 'machinemaster'; 
            $rawmaterial_table = $this->crg->get('table_prefix') . 'rawmaterial';   
            $unit_table = $this->crg->get('table_prefix') . 'unit';   
            $bomdetail_tab = $this->crg->get('table_prefix') . 'BOMDetail';
            $bommaster_tab = $this->crg->get('table_prefix') . 'BOMMaster';
            
            
            //product select box data 
            //$product_sql = "SELECT ID,ItemName FROM $product_table";
           // $sqlunitdet= "SELECT ID,UnitName FROM $unit_tab WHERE $unit_tab.entity_ID = $entityID";            
           // $stmt = $this->db->prepare($product_sql);            
           // $stmt->execute();
           // $product_data  = $stmt->fetchAll();	
           // $this->tpl->set('product_data', $product_data);
            
            //producttype table data for partname
           
            $pdttype_sql = "SELECT ID,ProductType FROM $pdttype_table";
            $stmt = $this->db->prepare($pdttype_sql);            
            $stmt->execute();
            $pdttype_data  = $stmt->fetchAll();	
            $this->tpl->set('pdttype_data', $pdttype_data);
            
           
           //product table data for partno
           
            $pdt_sql = "SELECT ID,Concat(ItemName,' ', Description ) as ItemName FROM $pdt_table";
            $stmt = $this->db->prepare($pdt_sql);            
            $stmt->execute();
            $pdt_data  = $stmt->fetchAll();	
            $this->tpl->set('pdt_data', $pdt_data);
            
            //customer select box data
            $cust_sql = "SELECT ID,FirstName FROM $cust_table";
            $stmt = $this->db->prepare($cust_sql);            
            $stmt->execute();
            $customer_data  = $stmt->fetchAll();	
            $this->tpl->set('customer_data', $customer_data);
            
            
            //machine select box data
            $sql = "SELECT ID,MachineName FROM $machmasstat_table"; 
           // $sqlstagedet= "SELECT ID,Description FROM $stagedet_tab";            
            $stmt = $this->db->prepare($sql);            
            $stmt->execute();
            $machine_data  = $stmt->fetchAll();	
            $this->tpl->set('machine_data', $machine_data);
            
          
            
            //mould select box data
            $mould_sql = "SELECT ID,Concat(MouldName,' ',Description)as MouldName FROM $mould_table"; 
           // $sqlbrooderdet= "SELECT ID,BatchNo FROM $brooderdetail_tab WHERE $brooderdetail_tab.entity_ID ";            
            $stmt = $this->db->prepare($mould_sql);            
            $stmt->execute();
            //$brooder_data  = $stmt->fetchAll();
            $mould_data  = $stmt->fetchAll();
            $this->tpl->set('mould_data', $mould_data);
            
            //rawmaterial select box data
            
             $sql = "SELECT ID,RMName FROM $rawmaterial_table"; 
           // $sqlstagedet= "SELECT ID,Description FROM $stagedet_tab";            
            $stmt = $this->db->prepare($sql);            
            $stmt->execute();
            $rawmaterial_data  = $stmt->fetchAll();	
            $this->tpl->set('rawmaterial_data', $rawmaterial_data);

            $this->tpl->set('page_title', 'BOM');	          
            $this->tpl->set('page_header', 'Production');
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
                     
                     $sqldetdelete="Delete $bomdetail_tab,$bommaster_tab from $bommaster_tab
                                        LEFT JOIN  $bomdetail_tab ON $bommaster_tab.ID=$bomdetail_tab.bommaster_ID 
                                        where $bomdetail_tab.bommaster_ID=$data"; 
                        $stmt = $this->db->prepare($sqldetdelete);            
                        
                        if($stmt->execute()){
                        $this->tpl->set('message', 'BOM deleted successfully');
                         $this->tpl->set('label', 'List');
                        $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                        }
            break;
                case 'view':                    
                    $data = trim($_POST['ycs_ID']);
                 
                    if (!$data) {
                        $this->tpl->set('message', 'Please select any one ID to edit!');
                        $this->tpl->set('label', 'List');
                        $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                        break;
                    }
                    
                    //mode of form submit
                    $this->tpl->set('mode', 'view');
                    //set id to edit $ycs_ID
                    $this->tpl->set('ycs_ID', $data);         
                                
                    //$sqlsrr = "SELECT * FROM `$maturationfeeddetail_tab`,`$maturationfeedmaster_tab` WHERE `$maturationfeeddetail_tab`.`maturationfeed_ID`=`$maturationfeedmaster_tab`.`ID` AND   `$maturationfeeddetail_tab`.`maturationfeed_ID` = '$data'";                    
                    //$maturationfeeddetail_data = $dbutil->getSqlData($sqlsrr); 
                    // $sqlsrr = "SELECT * FROM `$bomdetail_tab`,`$bommaster_tab` WHERE `$bomdetail_tab`.`bommaster_ID`=`$bommaster_tab`.`ID` AND `$bomdetail_tab`.`bommaster_ID` = '$data'";                    
                    // $bomdetail_data = $dbutil->getSqlData($sqlsrr); 
                    
                     $sqlsrr = "SELECT  DISTINCT 
                    CONCAT($pdt_table.ItemName,' ', $pdt_table.Description ) as ItemName,
                    CONCAT($mould_table.MouldName,' ',$mould_table.Description)as MouldName,
                    $cust_table.FirstName,
                    $machmasstat_table.MachineName,
                    $rawmaterial_table.RMName,
                    $pdttype_table.ProductType,
                    $bommaster_tab.MouldQty,
                    $bomdetail_tab.Qty,
                    $unit_table.UnitName 
                     FROM
                     $pdt_table,$cust_table,$pdttype_table,$machmasstat_table,$unit_table,$rawmaterial_table,$mould_table,$bomdetail_tab,$bommaster_tab
                     WHERE 
                     $pdt_table.ID=$bommaster_tab.product_ID AND 
                     $cust_table.ID = $bommaster_tab.customer_ID AND 
                     $pdttype_table.ID=$bommaster_tab.Producttype_ID AND 
                     $machmasstat_table.ID=$bommaster_tab.machine_ID AND 
                     $unit_table.ID=$rawmaterial_table.unit_ID AND 
                     $rawmaterial_table.ID=$bomdetail_tab.rawmaterial_id AND
                     $mould_table.ID = $bommaster_tab.mould_ID AND
                     $bomdetail_tab.bommaster_ID = $bommaster_tab.ID AND
                     $bomdetail_tab.bommaster_ID ='$data'";   
                     $bomdetail_data = $dbutil->getSqlData($sqlsrr); 
                   
                
                    //edit option     
                    $this->tpl->set('message', 'You can edit BOM form');
                    $this->tpl->set('page_header', 'Production');
                    $this->tpl->set('FmData', $bomdetail_data); 
                    
                    $this->tpl->set('content', $this->tpl->fetch('factory/form/bommaster_form.php'));                    
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
                                
                //   $sqlsrr = "SELECT  * FROM `$bomdetail_tab`,`$bommaster_tab` WHERE `$bomdetail_tab`.`bommaster_ID`=`$bommaster_tab`.`ID` AND `$bomdetail_tab`.`bommaster_ID` = '$data'";                    
                //   $bomdetail_data = $dbutil->getSqlData($sqlsrr); 
                   
                   
                   
                    $sqlsrr = "SELECT  DISTINCT 
                    CONCAT($pdt_table.ItemName,' ', $pdt_table.Description ) as ItemName,
                    CONCAT($mould_table.MouldName,' ',$mould_table.Description)as MouldName,
                    $cust_table.FirstName,
                    $machmasstat_table.MachineName,
                    $rawmaterial_table.RMName,
                    $pdttype_table.ProductType,
                    $bommaster_tab.MouldQty,
                    $bomdetail_tab.Qty,
                    $unit_table.UnitName 
                     FROM
                     $pdt_table,$cust_table,$pdttype_table,$machmasstat_table,$unit_table,$rawmaterial_table,$mould_table,$bomdetail_tab,$bommaster_tab
                     WHERE 
                     $pdt_table.ID=$bommaster_tab.product_ID AND 
                     $cust_table.ID = $bommaster_tab.customer_ID AND 
                     $pdttype_table.ID=$bommaster_tab.Producttype_ID AND 
                     $machmasstat_table.ID=$bommaster_tab.machine_ID AND 
                     $unit_table.ID=$rawmaterial_table.unit_ID AND 
                     $rawmaterial_table.ID=$bomdetail_tab.rawmaterial_id AND
                     $mould_table.ID = $bommaster_tab.mould_ID AND
                     $bomdetail_tab.bommaster_ID = $bommaster_tab.ID AND
                     $bomdetail_tab.bommaster_ID ='$data'";   
                     $bomdetail_data = $dbutil->getSqlData($sqlsrr); 
                     
                   
                     
                    //edit option     
                    $this->tpl->set('message', 'You can edit BOM form');
                    $this->tpl->set('page_header', 'Production');
                    $this->tpl->set('FmData', $bomdetail_data); 
                    
                    $this->tpl->set('content', $this->tpl->fetch('factory/form/bommaster_form.php'));                    
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
                
                    //Build SQL now
                    $sqldet_del = "DELETE FROM $bomdetail_tab WHERE bommaster_ID=$data";
                    $stmt = $this->db->prepare($sqldet_del);
                    $stmt->execute();   
                            
                            try{
                            $producttypeID= $form_post_data['Producttype_ID'];  
                            $productID= $form_post_data['product_ID'];
                            $customerID= $form_post_data['customer_ID'];
                            $machineID=$form_post_data['machine_ID'];
                            $mouldID=$form_post_data['mould_ID'];
                            $mouldQty=$form_post_data['MouldQty'];
                            $sql_update="Update $bommaster_tab set Producttype_ID='$producttypeID',product_ID='$productID',customer_ID='$customerID',machine_ID='$machineID',mould_ID='$mouldID',MouldQty='$mouldQty' WHERE ID=$data";
                            $stmt1 = $this->db->prepare($sql_update);
                            $stmt1->execute(); 
                        $entry_count = 1;
                        FOR ($entry_count; $entry_count <= $form_post_data['maxCount'];) {
                                $rawmaterial_id ='ItemNo_' . $entry_count;
                                $Qty ='Quantity_' . $entry_count;
                               
                                        $vals = "'" . $data . "'," .
                                        "'" . $form_post_data[$rawmaterial_id] . "'," .
                                        "'" . $form_post_data[$Qty] . "'" ;
                                        
                                 
                                $sql2 = "INSERT INTO $bomdetail_tab
                                        ( 
                                `bommaster_ID`, 
                                `rawmaterial_id`,
                                `Qty` ) 
                                VALUES ($vals)";

                                $stmt = $this->db->prepare($sql2);
                                $stmt->execute();
                            //increment here
                            $entry_count++;
                            }
                       
                            $this->tpl->set('message', 'BOM form edited successfully!');   
                            $this->tpl->set('label', 'List');
                            $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                            } catch (Exception $exc) {
                             //edit failed option
                            $this->tpl->set('message', 'Failed to edit, try again!');
                            $this->tpl->set('FmData', $form_post_data);
                            $this->tpl->set('content', $this->tpl->fetch('factory/form/bommaster_form.php'));
                            }

                    break;

                case 'addsubmit':
                     if (isset($crud_string)) {
                         
                        $form_post_data = $dbutil->arrFltr($_POST);
                        
                       // var_dump($_POST);
                        
                        $entry_count = 1;
                       
                            if (isset($form_post_data['product_ID'])) {
                           
                                        $val = "'" . $form_post_data['Producttype_ID'] . "'," .
                                         "'" . $form_post_data['product_ID'] . "'," .
                                        "'" . $form_post_data['customer_ID'] . "'," .
                                        "'" . $form_post_data['machine_ID'] . "'," .
                                        "'" . $form_post_data['mould_ID'] . "'," .
                                         "'" . $form_post_data['MouldQty'] . "'," .
                                              "'" .  $this->ses->get('user')['entity_ID'] . "'," .
                                            "'" .  $this->ses->get('user')['ID'] . "'";

                              $sql = "INSERT INTO `" . $this->crg->get('table_prefix') . "BOMMaster`
                                            ( 
                                            `Producttype_ID`,
                                            `product_ID`, 
                                            `customer_ID`, 
                                            `machine_ID`, 
                                            `mould_ID`,
                                            `MouldQty`,
                                            `entity_ID`,
                                            `users_ID`
                                            ) 
                                        VALUES ( $val )";
                                  $stmt = $this->db->prepare($sql);
                                  
                                  
                    if ($stmt->execute()) { 
                        $lastInsertedID = $this->db->lastInsertId();
                        FOR ($entry_count; $entry_count <= $form_post_data['maxCount'];) {
                               
                                $rawmaterial_id ='ItemNo_' . $entry_count;
                                $Qty ='Quantity_' . $entry_count;
                               


                                $vals = "'" . $lastInsertedID . "'," .
                                        "'" . $form_post_data[$rawmaterial_id] . "'," .
                                        "'" . $form_post_data[$Qty] . "'" ;
                                       
                                         //"'" . $form_post_data[$Temp] . "'";
                                 
                              $sql2 = "INSERT INTO $bomdetail_tab
                                        ( 
                                `bommaster_ID`, 
                                `rawmaterial_id`,
                                `Qty`
                                 ) 
                                VALUES ($vals)";

                                 // this need to be changed in to transaction type
                                
                                $stmt = $this->db->prepare($sql2);
                                $stmt->execute();
                                  //increment here
                                $entry_count++;
                                
                            }
                    }
                        }
                        $this->tpl->set('mode', 'add');
                        $this->tpl->set('message', '- Success -');
                        $this->tpl->set('content', $this->tpl->fetch('factory/form/bommaster_form.php'));
                     } else {
                            //edit option
                            //if submit failed to insert form
                            $this->tpl->set('message', 'Failed to submit!');
                            $this->tpl->set('FmData', $form_post_data);
                            $this->tpl->set('content', $this->tpl->fetch('factory/form/bommaster_form.php'));
                     }
                    break;
                case 'add':
                    $this->tpl->set('mode', 'add');
	                $this->tpl->set('page_header', 'Production');
                    $this->tpl->set('content', $this->tpl->fetch('factory/form/bommaster_form.php'));
                    break;

                default:
                    /*
                     * List form
                     */
                     
                    ////////////////////start//////////////////////////////////////////////
                    
           //bUILD SQL 
            $whereString = '';
            
         $colArr = array(
                "$bommaster_tab.ID",
                "$pdttype_table.ProductType",
                "CONCAT($pdt_table.ItemName,'  ', $pdt_table.Description) AS ItemName ",
                "$cust_table.FirstName",
                "$machmasstat_table.MachineName",
                "Concat($mould_table.MouldName,' ',$mould_table.Description)as MouldName",
                //"$mould_table.MouldName",
                "$bommaster_tab.MouldQty"
                // "$bomdetail_tab.bommaster_ID",
                // "$bomdetail_tab.rawmaterial_id",  
                // "$bomdetail_tab.Qty"
                // "$bomdetail_tab.Temp"
               
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
             $whereString ="ORDER BY $bommaster_tab.ID DESC";
           }
            
        $sql = "SELECT "
                    . implode(',',$colArr)
                    . " FROM $bommaster_tab,$pdttype_table,$pdt_table,$mould_table,$cust_table,$machmasstat_table "
                    . " WHERE "
                    . " $pdttype_table.ID=$bommaster_tab.Producttype_ID AND "
                    . " $pdt_table.ID= $bommaster_tab.product_ID AND "
                    . " $cust_table.ID  = $bommaster_tab.customer_ID AND "
                    . " $machmasstat_table.ID = $bommaster_tab.machine_ID AND "
                    . " $mould_table.ID = $bommaster_tab.mould_ID AND "
                    . " $bommaster_tab.entity_ID = $entityID"
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
         
         
            $this->tpl->set('table_columns_label_arr', array('ID','Part Name','Part No','Customer','Machine','Mould','Mould Quantity'));
            
            /*
             * selectColArr for filter form
             */
            
            $this->tpl->set('selectColArr',$colArr);
                        
            /*
             * set pagination template
             */
            $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');
                   
            //////////////////////close//////////////////////////////////////  
                     
                    include_once $this->tpl->path . '/factory/form/crud_bommaster_form.php';
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
    
 /////////////////////
    function instrument() {
        if ($this->crg->get('wp') || $this->crg->get('rp')) {
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////access condition applied///////////////////////////
//////////////////////////////////////////////////////////////////////////////// 
          
           include_once 'util/DBUTIL.php';
           $dbutil = new DBUTIL($this->crg);
             
             $entityID = $this->ses->get('user')['entity_ID'];
             $userID = $this->ses->get('user')['ID'];
            
            
           $inst_tab = $this->crg->get('table_prefix') . 'instrument';
                  
          

            ////////////////////start//////////////////////////////////////////////
                    
           //bUILD SQL 
            $whereString = '';
            
            $colArr = array(
                "$inst_tab.ID", 
                "$inst_tab.InstrumentCode",
                "$inst_tab.InstrumentName",
                "$inst_tab.InstrumentRange"
               
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
            
            $orderBy ="ORDER BY $inst_tab.ID DESC";
            
         $sql = "SELECT "
                 . implode(',',$colArr)
                 . " FROM $inst_tab "
                 . " WHERE "
                 . " $inst_tab.entity_ID=$entityID "
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
            $this->tpl->set('table_columns_label_arr', array('ID','Instrument Code','Instrument Name','Instrument Range'));
            
            /*,;;
             * selectColArr for filter form
             */
            
            $this->tpl->set('selectColArr',$colArr);
                        
            /*
             * set pagination template
             */
            $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');
                   
            //////////////////////close//////////////////////////////////////  
          
             include_once $this->tpl->path .'/factory/form/crud_form_instrument.php';
            
            
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
     
      
    function instru() {
        if ($this->crg->get('wp') || $this->crg->get('rp')) {
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////access condition applied///////////////////////////
////////////////////////////////////////////////////////////////////////////////            
           
                
            include_once $this->tpl->path .'/factory/form/crud_form_instrument.php';
            
            $cus_form_data = Form_Elements::data($this->crg);
            include_once 'util/crud2.php';
            new Crud2($this->crg, $cus_form_data);
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
    
   
    
   function materialrequest(){
     if ($this->crg->get('wp') || $this->crg->get('rp')) {
 ////////////////////////////////////////////////////////////////////////////////
 //////////////////////////////access condition applied//////////////////////////
 ////////////////////////////////////////////////////////////////////////////////    
            
            include_once 'util/DBUTIL.php';
            $dbutil = new DBUTIL($this->crg);
             
            $entityID = $this->ses->get('user')['entity_ID'];
            $userID = $this->ses->get('user')['ID'];
            
            $rawmaterial_table = $this->crg->get('table_prefix') . 'rawmaterial';
            $wrkorder_table = $this->crg->get('table_prefix') . 'workorder';
            $matreqdetail_tab = $this->crg->get('table_prefix') . 'MaterialRequestDetail';
            $matreqmaster_tab = $this->crg->get('table_prefix') . 'MaterialRequestMaster';
            
            //workorder table
            $sql = "SELECT ID,BatchNo FROM $wrkorder_table"; 
            $stmt = $this->db->prepare($sql);            
            $stmt->execute();
            $wrkorder_data  = $stmt->fetchAll();	
            $this->tpl->set('wrkorder_data', $wrkorder_data);

          
            //rawmaterial select box data
            
            $sql = "SELECT ID,RMName FROM $rawmaterial_table"; 
            $stmt = $this->db->prepare($sql);            
            $stmt->execute();
            $rawmaterial_data  = $stmt->fetchAll();	
            $this->tpl->set('rawmaterial_data', $rawmaterial_data);

            $this->tpl->set('page_title', 'Material Request');	          
            $this->tpl->set('page_header', 'Production');
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
               
                
                case 'view':                    
                    $data = trim($_POST['ycs_ID']);
                 
                    if (!$data) {
                        $this->tpl->set('message', 'Please select any one ID to edit!');
                        $this->tpl->set('label', 'List');
                        $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                        break;
                    }
                    
                    //mode of form submit
                    $this->tpl->set('mode', 'view');
                    //set id to edit $ycs_ID
                    $this->tpl->set('ycs_ID', $data);         
                                
                   
                    $sqlsrr = "SELECT * FROM `$matreqdetail_tab`,`$matreqmaster_tab` WHERE `$matreqdetail_tab`.`materialrequest_ID`=`$matreqmaster_tab`.`ID` AND `$matreqdetail_tab`.`materialrequest_ID` = '$data'";                    
                    $matreqdetail_data = $dbutil->getSqlData($sqlsrr); 
                   
                
                    //edit option     
                    $this->tpl->set('message', 'You can edit Material Request form');
                    $this->tpl->set('page_header', 'Production');
                    $this->tpl->set('FmData', $matreqdetail_data); 
                    
                    $this->tpl->set('content', $this->tpl->fetch('factory/form/MaterialRequest_form.php'));                    
                    break;
                
                case 'edit':                    
                    $data = trim($_POST['ycs_ID']);
                 //var_dump($data);
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
                                
                  $sqlsrr = "SELECT * FROM `$matreqdetail_tab`,`$matreqmaster_tab` WHERE `$matreqdetail_tab`.`materialrequest_ID`=`$matreqmaster_tab`.`ID` AND `$matreqdetail_tab`.`materialrequest_ID` = '$data'";                    
                  $matreqdetail_data = $dbutil->getSqlData($sqlsrr);
                    
                   
                    //edit option     
                    $this->tpl->set('message', 'You can edit Material Request form');
                    $this->tpl->set('page_header', 'Production');
                    $this->tpl->set('FmData', $matreqdetail_data); 
                    
                    $this->tpl->set('content', $this->tpl->fetch('factory/form/MaterialRequest_form.php'));                    
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
                
                    //Build SQL now
                    $sqldet_del = "DELETE FROM $matreqdetail_tab WHERE materialrequest_ID=$data";
                    $stmt = $this->db->prepare($sqldet_del);
                    $stmt->execute();   
                            
                            try{
                              
                            $MaterialRequestNo= $form_post_data['MaterialRequestNo'];
                            $MaterialRequestDate=date("Y-m-d", strtotime($form_post_data['MaterialRequestDate']));
                           // $MaterialRequestDate= $form_post_data['MaterialRequestDate'];
                            $MaterialRequestTime=$form_post_data['MaterialRequestTime'];
                            $Area=$form_post_data['Area'];
                            $sql_update="Update $matreqmaster_tab set MaterialRequestNo='$MaterialRequestNo',MaterialRequestDate='$MaterialRequestDate',MaterialRequestTime='$MaterialRequestTime',Area='$Area' WHERE ID=$data";
                            $stmt1 = $this->db->prepare($sql_update);
                            $stmt1->execute(); 
                        $entry_count = 1;
                        FOR ($entry_count; $entry_count <= $form_post_data['maxCount'];) {
                                
                                $rawmaterial_id ='ItemNo_' . $entry_count;
                                $Grade='ItemName_' . $entry_count;
                                $LotNumber='Amount_'. $entry_count;
                                $ReqQty='Water_'. $entry_count;
                                $IssuedQty='Quantity_'. $entry_count;

                                        $vals = "'" . $data . "'," .
                                        "'" . $form_post_data[$rawmaterial_id] . "'," .
                                        "'" . $form_post_data[$Grade] . "'," .
                                        "'" . $form_post_data[$LotNumber] . "'," .
                                        "'" . $form_post_data[$ReqQty] . "'," .
                                        "'" . $form_post_data[$IssuedQty] . "'";
                                        
                                 
                                   $sql2 = "INSERT INTO $matreqdetail_tab
                                        ( 
                                `materialrequest_ID`, 
                                `rawmaterial_ID`,
                                `Grade`,
                                `LotNo`,
                                `ReqQty',
                                `IssuedQty` ) 
                                VALUES ($vals)";

                                $stmt = $this->db->prepare($sql2);
                                $stmt->execute();
                            //increment here
                            $entry_count++;
                            }
                       
                            $this->tpl->set('message', 'Material Request form edited successfully!');   
                            $this->tpl->set('label', 'List');
                            $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                            } catch (Exception $exc) {
                             //edit failed option
                            $this->tpl->set('message', 'Failed to edit, try again!');
                            $this->tpl->set('FmData', $form_post_data);
                            $this->tpl->set('content', $this->tpl->fetch('factory/form/MaterialRequest_form.php'));
                            }

                    break;

                case 'addsubmit':
                     if (isset($crud_string)) {
                         
                        $form_post_data = $dbutil->arrFltr($_POST);
                        
                      //var_dump($_POST);
                        
                        $entry_count = 1;
                       
                            if (isset($form_post_data['MaterialRequestNo'])) {
                           
                                        $val = "'" . $form_post_data['MaterialRequestNo'] . "'," .
                                        "'" . date("Y-m-d", strtotime($form_post_data['MaterialRequestDate'])) . "'," .
                                        "'" . $form_post_data['MaterialRequestTime'] . "'," .
                                         "'" . $form_post_data['Area'] . "'," .
                                              "'" .  $this->ses->get('user')['entity_ID'] . "'," .
                                            "'" .  $this->ses->get('user')['ID'] . "'";

                                 $sql = "INSERT INTO `" . $this->crg->get('table_prefix') . "MaterialRequestMaster`
                                            ( 
                                            `MaterialRequestNo`, 
                                            `MaterialRequestDate`, 
                                            `MaterialRequestTime`, 
                                            `Area`,
                                            `entity_ID`,
                                            `users_ID`
                                            ) 
                                        VALUES ( $val )";
                                  $stmt = $this->db->prepare($sql);
                                  
                                  
                    if ($stmt->execute()) { 
                        $lastInsertedID = $this->db->lastInsertId();
                        FOR ($entry_count; $entry_count <= $form_post_data['maxCount'];) {
                               
                                $rawmaterial_ID ='ItemNo_' . $entry_count;
                                $Grade='ItemName_' . $entry_count;
                                $LotNumber='Amount_'. $entry_count;
                                $ReqQty='Water_'. $entry_count;
                                $IssuedQty='Quantity_'. $entry_count;

                                $vals = "'" . $lastInsertedID . "'," .
                                        "'" . $form_post_data[$rawmaterial_ID] . "'," .
                                         "'" . $form_post_data[$Grade] . "'," .
                                         "'" . $form_post_data[$LotNumber] . "'," .
                                         "'" . $form_post_data[$ReqQty] . "'," .
                                        "'" . $form_post_data[$IssuedQty] . "'" ;
                                       
                                         //"'" . $form_post_data[$Temp] . "'";
                                 
                          $sql2 = "INSERT INTO $matreqdetail_tab
                                        ( 
                                `materialrequest_ID`, 
                                `rawmaterial_ID`,
                                `Grade`,
                                `LotNo`,
                                `ReqQty`,
                                `IssuedQty`
                                 ) 
                                VALUES ($vals)";

                                 // this need to be changed in to transaction type
                                
                                $stmt = $this->db->prepare($sql2);
                                $stmt->execute();
                                  //increment here
                                $entry_count++;
                                
                            }
                            
                              $dbutil->ApprovalProcess('Material Request',17,$lastInsertedID);
                    }
                        }
                        $this->tpl->set('mode', 'add');
                        $this->tpl->set('message', '- Success -');
                        $this->tpl->set('content', $this->tpl->fetch('factory/form/MaterialRequest_form.php'));
                     } else {
                            //edit option
                            //if submit failed to insert form
                            $this->tpl->set('message', 'Failed to submit!');
                            $this->tpl->set('FmData', $form_post_data);
                            $this->tpl->set('content', $this->tpl->fetch('factory/form/MaterialRequest_form.php'));
                     }
                    break;
                case 'add':
                    $this->tpl->set('mode', 'add');
	                $this->tpl->set('page_header', 'Production');
                    $this->tpl->set('content', $this->tpl->fetch('factory/form/MaterialRequest_form.php'));
                    break;

                default:
                    /*
                     * List form
                     */
                     
                    ////////////////////start//////////////////////////////////////////////
                    
           //bUILD SQL 
            $whereString = '';
            
          $colArr = array(
                "$matreqmaster_tab.ID",
                "$matreqmaster_tab.MaterialRequestNo",
                "DATE_FORMAT($matreqmaster_tab.MaterialRequestDate, '%d-%m-%Y') AS MaterialRequestDate",
               // "$matreqmaster_tab.MaterialRequestDate",
                "$matreqmaster_tab.MaterialRequestTime",
                "$matreqmaster_tab.Area"
                //"$product_table.ItemName",
                //"$cust_table.FirstName",
                //"$machmasstat_table.MachineName",
               // "$mould_table.MouldName",
                //"$bommaster_tab.MouldQty"
                // "$bomdetail_tab.bommaster_ID",
                // "$bomdetail_tab.rawmaterial_id",  
                // "$bomdetail_tab.Qty"
                // "$bomdetail_tab.Temp"
               

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
             $whereString ="ORDER BY $matreqmaster_tab.ID DESC";
           }
            
             $sql = "SELECT "
                    . implode(',',$colArr)
                    . " FROM $matreqmaster_tab"
                    . " WHERE "
                    . " $matreqmaster_tab.entity_ID = $entityID"
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
         
         
            $this->tpl->set('table_columns_label_arr', array('ID','Material Request Number','Material Request Date','Material Request Time','Area'));
            
            /*
             * selectColArr for filter form
             */
            
            $this->tpl->set('selectColArr',$colArr);
                        
            /*
             * set pagination template
             */
            $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');
                   
            //////////////////////close//////////////////////////////////////  
                     
                    include_once $this->tpl->path . '/factory/form/crud_form_MaterialRequestMaster.php';
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
     
   
   function rmmixing(){
     if ($this->crg->get('wp') || $this->crg->get('rp')) {
 ////////////////////////////////////////////////////////////////////////////////
 //////////////////////////////access condition applied//////////////////////////
 ////////////////////////////////////////////////////////////////////////////////    
            
            include_once 'util/DBUTIL.php';
            $dbutil = new DBUTIL($this->crg);
             
            $entityID = $this->ses->get('user')['entity_ID'];
            $userID = $this->ses->get('user')['ID'];
            
           
            $cust_table = $this->crg->get('table_prefix') . 'customer';
            $product_table = $this->crg->get('table_prefix') . 'product';
            $machmasstat_table = $this->crg->get('table_prefix') . 'machinemaster'; 
            $rawmaterial_table = $this->crg->get('table_prefix') . 'rawmaterial';   
            $unit_table = $this->crg->get('table_prefix') . 'unit';   
            $shift_table = $this->crg->get('table_prefix') . 'shifttiming'; 
            $wrk_table = $this->crg->get('table_prefix') . 'workorder'; 
            $rmmixingdetail_tab = $this->crg->get('table_prefix') . 'RMMixingDetail';
            $rmmixingmaster_tab = $this->crg->get('table_prefix') . 'RMMixingMaster';
            
            
            //product select box data 
            $product_sql = "SELECT ID,Concat(ItemName,' ', Description ) as ItemName FROM $product_table";
            $stmt = $this->db->prepare($product_sql);            
            $stmt->execute();
            $product_data  = $stmt->fetchAll();	
            $this->tpl->set('product_data', $product_data);
            
            //customer select box data
            $cust_sql = "SELECT ID,FirstName FROM $cust_table";
            $stmt = $this->db->prepare($cust_sql);            
            $stmt->execute();
            $customer_data  = $stmt->fetchAll();	
            $this->tpl->set('customer_data', $customer_data);
            
            
            //machine select box data
            $sql = "SELECT ID,MachineName FROM $machmasstat_table"; 
            $stmt = $this->db->prepare($sql);            
            $stmt->execute();
            $machine_data  = $stmt->fetchAll();	
            $this->tpl->set('machine_data', $machine_data);
            
          
            
            //shifting select box data
            $shift_sql = "SELECT ID,ShiftName FROM $shift_table"; 
            $stmt = $this->db->prepare($shift_sql);            
            $stmt->execute();
            $shift_data  = $stmt->fetchAll();
            $this->tpl->set('shift_data', $shift_data);
            
            //workorder select box data
            $wrk_sql = "SELECT ID,BatchNo FROM $wrk_table order by ID desc"; 
            $stmt = $this->db->prepare($wrk_sql);            
            $stmt->execute();
            $wrk_data  = $stmt->fetchAll();
            $this->tpl->set('wrk_data', $wrk_data);
            
            //rawmaterial select box data
            
             $sql = "SELECT ID,RMName FROM $rawmaterial_table"; 
           // $sqlstagedet= "SELECT ID,Description FROM $stagedet_tab";            
            $stmt = $this->db->prepare($sql);            
            $stmt->execute();
            $rawmaterial_data  = $stmt->fetchAll();	
            $this->tpl->set('rawmaterial_data', $rawmaterial_data);

            $this->tpl->set('page_title', 'RawMaterial Mixing');	          
            $this->tpl->set('page_header', 'Production');
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
                     
                     $sqldetdelete="Delete $rmmixingdetail_tab,$rmmixingmaster_tab from $rmmixingmaster_tab
                                        LEFT JOIN  $rmmixingdetail_tab ON $rmmixingmaster_tab.ID=$rmmixingdetail_tab.rmmixingmaster_ID 
                                        where $rmmixingdetail_tab.rmmixingmaster_ID=$data"; 
                        $stmt = $this->db->prepare($sqldetdelete);            
                        
                        if($stmt->execute()){
                        $this->tpl->set('message', 'Rawmaterial Mixing deleted successfully');
                         $this->tpl->set('label', 'List');
                        $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                        }
            break;
                
                case 'view':                    
                    $data = trim($_POST['ycs_ID']);
                 
                    if (!$data) {
                        $this->tpl->set('message', 'Please select any one ID to edit!');
                        $this->tpl->set('label', 'List');
                        $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                        break;
                    }
                    
                    //mode of form submit
                    $this->tpl->set('mode', 'view');
                    //set id to edit $ycs_ID
                    $this->tpl->set('ycs_ID', $data);         
                                
                    
                    // $sqlsrr = "SELECT * FROM `$rmmixingdetail_tab`,`$rmmixingmaster_tab`,$machmasstat_table,$cust_table,$product_table WHERE `$machmasstat_table`.`ID`=`$rmmixingmaster_tab`.`machine_ID` AND`$cust_table`.`ID`=`$rmmixingmaster_tab`.`customer_ID` AND `$product_table`.`ID`=`$rmmixingmaster_tab`.`product_ID` AND `$rmmixingdetail_tab`.`rmmixingmaster_ID`=`$rmmixingmaster_tab`.`ID` AND `$rmmixingdetail_tab`.`rmmixingmaster_ID` = '$data'";                    
                    // $rmmixingdetail_data = $dbutil->getSqlData($sqlsrr); 
                    
                     $sqlsrr = "SELECT * FROM `$rmmixingdetail_tab`,`$rmmixingmaster_tab`,$machmasstat_table,$cust_table,$product_table,$unit_table,$rawmaterial_table WHERE `$unit_table`.`ID`=`$rawmaterial_table`.`Unit_ID`AND $rawmaterial_table.ID=$rmmixingdetail_tab.rawmaterial_ID AND `$machmasstat_table`.`ID`=`$rmmixingmaster_tab`.`machine_ID` AND`$cust_table`.`ID`=`$rmmixingmaster_tab`.`customer_ID` AND `$product_table`.`ID`=`$rmmixingmaster_tab`.`product_ID` AND `$rmmixingdetail_tab`.`rmmixingmaster_ID`=`$rmmixingmaster_tab`.`ID` AND `$rmmixingdetail_tab`.`rmmixingmaster_ID` = '$data'";                    
                     $rmmixingdetail_data = $dbutil->getSqlData($sqlsrr); 
                   
                
                    //edit option     
                    $this->tpl->set('message', 'You can edit RawMaterial Mixing form');
                    $this->tpl->set('page_header', 'Production');
                    $this->tpl->set('FmData', $rmmixingdetail_data); 
                    
                    $this->tpl->set('content', $this->tpl->fetch('factory/form/RMMixingMaster.php'));                    
                    break;
                
                case 'edit':                    
                    $data = trim($_POST['ycs_ID']);
                
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
                                
                    $sqlsrr = "SELECT * FROM `$rmmixingdetail_tab`,`$rmmixingmaster_tab`,$machmasstat_table,$cust_table,$product_table,$unit_table,$rawmaterial_table WHERE `$unit_table`.`ID`=`$rawmaterial_table`.`Unit_ID`AND $rawmaterial_table.ID=$rmmixingdetail_tab.rawmaterial_ID AND `$machmasstat_table`.`ID`=`$rmmixingmaster_tab`.`machine_ID` AND`$cust_table`.`ID`=`$rmmixingmaster_tab`.`customer_ID` AND `$product_table`.`ID`=`$rmmixingmaster_tab`.`product_ID` AND `$rmmixingdetail_tab`.`rmmixingmaster_ID`=`$rmmixingmaster_tab`.`ID` AND `$rmmixingdetail_tab`.`rmmixingmaster_ID` = '$data'";                    
                    $rmmixingdetail_data = $dbutil->getSqlData($sqlsrr); 
                    
                    //edit option     
                    $this->tpl->set('message', 'You can edit RawMaterial Mixing form');
                    $this->tpl->set('page_header', 'Production');
                    $this->tpl->set('FmData', $rmmixingdetail_data); 
                    
                    $this->tpl->set('content', $this->tpl->fetch('factory/form/RMMixingMaster.php'));                    
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
                
                    //Build SQL now
                    $sqldet_del = "DELETE FROM $rmmixingdetail_tab WHERE rmmixingmaster_ID=$data";
                    $stmt = $this->db->prepare($sqldet_del);
                    $stmt->execute();   
                            
                            try{
                              
                            $productID= $form_post_data['product_ID'];
                            $batchNo= $form_post_data['BatchNo'];
                            $machineID=$form_post_data['machine_ID'];
                            $mixingDate=date("Y-m-d", strtotime($form_post_data['MixingDate']));
                            $shiftID=$form_post_data['shift_ID'];
                            $TotalMixing=$form_post_data['TotalMixing'];
                            $customerID= $form_post_data['customer_ID'];
                            $sql_update="Update $rmmixingmaster_tab set product_ID='$productID',BatchNo='$batchNo',machine_ID='$machineID',MixingDate='$mixingDate',shift_ID='$shiftID',TotalMixing='$TotalMixing',customer_ID='$customerID' WHERE ID=$data";
                            $stmt1 = $this->db->prepare($sql_update);
                            $stmt1->execute(); 
                        $entry_count = 1;
                        FOR ($entry_count; $entry_count <= $form_post_data['maxCount'];) {
                                $rawmaterial_ID ='ItemNo_' . $entry_count;
                                $GDNO='ItemName_' . $entry_count;
                                $LotNumber='Amount_'. $entry_count;
                                $RMTime='Water_'. $entry_count;
                                $MixingPerc='Quantity_'. $entry_count;
                                $TotConsumption = 'EmpName_' . $entry_count;
                               
                                        $vals = "'" . $data . "'," .
                                        "'" . $form_post_data[$rawmaterial_ID] . "'," .
                                        "'" . $form_post_data[$GDNO] . "'," .  
                                        "'" . $form_post_data[$LotNumber] . "'," .
                                        "'" . date("HH:mm", strtotime($form_post_data[$RMTime])) . "'," .
                                        "'" . $form_post_data[$MixingPerc] . "'," .
                                        "'" . $form_post_data[$TotConsumption ] . "'" ;
                                        
                                 
                                $sql2 = "INSERT INTO $rmmixingdetail_tab
                                        ( 
                                `rmmixingmaster_ID`, 
                                `rawmaterial_ID`,
                                `GDNO`,
                                `LotNo`,
                                `RMTime`,
                                `MixingPerc`,
                                `TotConsumption` ) 
                                VALUES ($vals)";

                                $stmt = $this->db->prepare($sql2);
                                $stmt->execute();
                            //increment here
                            $entry_count++;
                            }
                       
                            $this->tpl->set('message', 'RawMaterial Mixing Form Edited Successfully!');   
                            $this->tpl->set('label', 'List');
                            $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                            } catch (Exception $exc) {
                             //edit failed option
                            $this->tpl->set('message', 'Failed to edit, try again!');
                            $this->tpl->set('FmData', $form_post_data);
                            $this->tpl->set('content', $this->tpl->fetch('factory/form/RMMixingMaster.php'));
                            }

                    break;

                case 'addsubmit':
                     if (isset($crud_string)) {
                         
                        $form_post_data = $dbutil->arrFltr($_POST);
                        
                       //var_dump($_POST);
                        
                        $entry_count = 1;
                       
                            if (isset($form_post_data['product_ID'])) {
                           
                                        $val = "'" . $form_post_data['product_ID'] . "'," .
                                         "'" . $form_post_data['BatchNo'] . "'," .
                                         "'" . $form_post_data['machine_ID'] . "'," .
                                         "'" . date("Y-m-d", strtotime($form_post_data['MixingDate'])) . "'," .
                                          "'" . $form_post_data['TotalMixing'] . "'," .
                                         "'" . $form_post_data['shift_ID'] . "'," .
                                         "'" . $form_post_data['customer_ID'] . "'," .
                                         "'" .  $this->ses->get('user')['entity_ID'] . "'," .
                                         "'" .  $this->ses->get('user')['ID'] . "'";

                              $sql = "INSERT INTO `" . $this->crg->get('table_prefix') . "RMMixingMaster`
                                            ( 
                                            `product_ID`, 
                                            `BatchNo`, 
                                            `machine_ID`, 
                                            `MixingDate`,
                                            `TotalMixing`,
                                            `shift_ID`,
                                            `customer_ID`,
                                            `entity_ID`,
                                            `users_ID`
                                            ) 
                                        VALUES ( $val )";
                                  $stmt = $this->db->prepare($sql);
                                  
                                  
                    if ($stmt->execute()) { 
                        $lastInsertedID = $this->db->lastInsertId();
                        FOR ($entry_count; $entry_count <= $form_post_data['maxCount'];) {
                               
                                $rawmaterial_ID ='ItemNo_' . $entry_count;
                                $GDNO='ItemName_' . $entry_count;
                                $LotNumber='Amount_'. $entry_count;
                                $RMTime='Water_'. $entry_count;
                                $MixingPerc='Quantity_'. $entry_count;
                                $TotConsumption = 'EmpName_' . $entry_count;


                                $vals = "'" . $lastInsertedID . "'," .
                                        "'" . $form_post_data[$rawmaterial_ID] . "'," .
                                        "'" . $form_post_data[$GDNO] . "'," .  
                                        "'" . $form_post_data[$LotNumber] . "'," .
                                          "'" . date("HH:mm", strtotime($form_post_data[$RMTime])) . "'," .
                                        "'" . $form_post_data[$MixingPerc] . "'," .
                                        "'" . $form_post_data[$TotConsumption ] . "'" ; 
                                        
                                       
                                         //"'" . $form_post_data[$Temp] . "'";
                                 
                              $sql2 = "INSERT INTO $rmmixingdetail_tab
                                        ( 
                                `rmmixingmaster_ID`, 
                                `rawmaterial_ID`,
                                `GDNO`,
                                `LotNo`,
                                `RMTime`,
                                `MixingPerc`,
                                `TotConsumption`
                                 ) 
                                VALUES ($vals)";

                                 // this need to be changed in to transaction type
                                
                                $stmt = $this->db->prepare($sql2);
                                $stmt->execute();
                                  //increment here
                                $entry_count++;
                                
                            }
                    }
                        }
                        $this->tpl->set('mode', 'add');
                        $this->tpl->set('message', '- Success -');
                        $this->tpl->set('content', $this->tpl->fetch('factory/form/RMMixingMaster.php'));
                     } else {
                            //edit option
                            //if submit failed to insert form
                            $this->tpl->set('message', 'Failed to submit!');
                            $this->tpl->set('FmData', $form_post_data);
                            $this->tpl->set('content', $this->tpl->fetch('factory/form/RMMixingMaster.php'));
                     }
                    break;
                case 'add':
                    $this->tpl->set('mode', 'add');
	                $this->tpl->set('page_header', 'Production');
                    $this->tpl->set('content', $this->tpl->fetch('factory/form/RMMixingMaster.php'));
                    break;

                default:
                    /*
                     * List form
                     */
                     
                    ////////////////////start//////////////////////////////////////////////
                    
           //bUILD SQL 
            $whereString = '';
            
         $colArr = array(
                "$rmmixingmaster_tab.ID",
                "CONCAT($product_table.ItemName,'  ', $product_table.Description) AS ItemName ",
                "$wrk_table.BatchNo",
                "$machmasstat_table.MachineName",
                "DATE_FORMAT($rmmixingmaster_tab.MixingDate, '%d-%m-%Y') AS MixingDate",
                "$shift_table.ShiftName",
                "$cust_table.FirstName"
                  );
                
                //(working data)
                            //"$rmmixingmaster_tab.ID",
                           // "$rmmixingmaster_tab.product_ID",
                           // "$rmmixingmaster_tab.BatchNo",
                           //  "$rmmixingmaster_tab.machine_ID",
                           // "DATE_FORMAT($rmmixingmaster_tab.MixingDate, '%d-%m-%Y') AS MixingDate",
                           // "$rmmixingmaster_tab.shift_ID",
                           //  "$rmmixingmaster_tab.customer_ID"
              
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
             $whereString ="ORDER BY $rmmixingmaster_tab.ID DESC";
           }
            
          
                $sql = "SELECT "
                    . implode(',',$colArr)
                    . " FROM $rmmixingmaster_tab,$product_table,$wrk_table,$machmasstat_table,$shift_table,$cust_table "
                    . " WHERE "
                    . " $product_table.ID= $rmmixingmaster_tab.product_ID AND "
                    . " $wrk_table.ID=$rmmixingmaster_tab.BatchNo AND "
                    . " $machmasstat_table.ID=$rmmixingmaster_tab.machine_ID AND "
                    . " $shift_table.ID=$rmmixingmaster_tab.shift_ID AND"
                    . " $cust_table.ID=$rmmixingmaster_tab.customer_ID AND "
                    . " $rmmixingmaster_tab.entity_ID = $entityID"
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
         
         
            $this->tpl->set('table_columns_label_arr', array('ID','Part No','Batch No','Machine','Date','Shift','Customer'));
            
            /*
             * selectColArr for filter form
             */
            
            $this->tpl->set('selectColArr',$colArr);
                        
            /*
             * set pagination template
             */
            $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');
                   
            //////////////////////close//////////////////////////////////////  
                     
                    include_once $this->tpl->path . '/factory/form/crud_form_RMMixingMaster.php';
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
     
 //end of rmmixing
 
     function rmmixingratio(){
     if ($this->crg->get('wp') || $this->crg->get('rp')) {
 ////////////////////////////////////////////////////////////////////////////////
 //////////////////////////////access condition applied//////////////////////////
 ////////////////////////////////////////////////////////////////////////////////    
            
            include_once 'util/DBUTIL.php';
            $dbutil = new DBUTIL($this->crg);
             
            $entityID = $this->ses->get('user')['entity_ID'];
            $userID = $this->ses->get('user')['ID'];
            
           
            $emp_table = $this->crg->get('table_prefix') . 'employee'; 
            $product_table = $this->crg->get('table_prefix') . 'product';
            $rawmaterial_table = $this->crg->get('table_prefix') . 'rawmaterial';   
            $unit_table = $this->crg->get('table_prefix') . 'unit';   
            $rmmixingratiodetail_tab = $this->crg->get('table_prefix') . 'RMMixingRatioDetail';
            $rmmixingratiomaster_tab = $this->crg->get('table_prefix') . 'RMMixingRatioMaster';
            $bommaster_tab = $this->crg->get('table_prefix') . 'BOMMaster';
            $bomdetail_tab = $this->crg->get('table_prefix') . 'BOMDetail';
            
            
            //product select box data 
            $product_sql = "SELECT ID,CONCAT(ItemName,' ',Description)AS ItemName FROM $product_table";
            $stmt = $this->db->prepare($product_sql);            
            $stmt->execute();
            $product_data  = $stmt->fetchAll();	
            $this->tpl->set('product_data', $product_data);
            
            //Employee select box data
            $emp_sql = "SELECT ID,EmpName FROM $emp_table";
            $stmt = $this->db->prepare($emp_sql);            
            $stmt->execute();
            $emp_data  = $stmt->fetchAll();	
            $this->tpl->set('emp_data', $emp_data);
            
            
            //rawmaterial select box data
            
            $sql = "SELECT ID,RMName FROM $rawmaterial_table"; 
            $stmt = $this->db->prepare($sql);            
            $stmt->execute();
            $rawmaterial_data  = $stmt->fetchAll();	
            $this->tpl->set('rawmaterial_data', $rawmaterial_data);

            $this->tpl->set('page_title', 'RawMaterial Mixing Ratio');	          
            $this->tpl->set('page_header', 'Production');
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
                     
                     $sqldetdelete="Delete $rmmixingratiodetail_tab,$rmmixingratiomaster_tab from $rmmixingratiomaster_tab
                                        LEFT JOIN  $rmmixingratiodetail_tab ON $rmmixingratiomaster_tab.ID=$rmmixingratiodetail_tab.rmmixingratiomaster_ID 
                                        where $rmmixingratiodetail_tab.rmmixingratiomaster_ID=$data"; 
                        $stmt = $this->db->prepare($sqldetdelete);            
                        
                        if($stmt->execute()){
                        $this->tpl->set('message', 'Rawmaterial Mixing Ratio deleted successfully');
                         $this->tpl->set('label', 'List');
                        $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                        }
            break;
                case 'view':                    
                    $data = trim($_POST['ycs_ID']);
                 
                    if (!$data) {
                        $this->tpl->set('message', 'Please select any one ID to edit!');
                        $this->tpl->set('label', 'List');
                        $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                        break;
                    }
                    
                    //mode of form submit
                    $this->tpl->set('mode', 'view');
                    //set id to edit $ycs_ID
                    $this->tpl->set('ycs_ID', $data);         
                                
                    
                    // $sqlsrr ="SELECT * FROM `$rmmixingratiodetail_tab`,`$rmmixingratiomaster_tab` WHERE `$rmmixingratiodetail_tab`.`rmmixingratiomaster_ID`=`$rmmixingratiomaster_tab`.`ID` AND `$rmmixingratiodetail_tab`.`rmmixingratiomaster_ID`='$data'";                    
                    // $rmmixingratiodetail_data = $dbutil->getSqlData($sqlsrr); 
                   
                    $sqlsrr ="select * from 
                                (SELECT ycias_unit.UnitName, ycias_rawmaterial.RMName,  CONCAT(ycias_product.ItemName,' ',ycias_product.Description)AS ItemName ,ycias_BOMDetail.rawmaterial_ID
                                FROM  $bommaster_tab
                                inner join $product_table on $product_table.ID=$bommaster_tab.product_ID 
                                INNER  join $bomdetail_tab on $bomdetail_tab.bommaster_ID=$bommaster_tab.ID 
                                inner join $rawmaterial_table on $rawmaterial_table.ID=$bomdetail_tab.rawmaterial_id
                                inner join $unit_table on $unit_table.ID=$rawmaterial_table.unit_ID
                                WHERE $bommaster_tab.product_ID=(Select product_ID from $rmmixingratiomaster_tab where $rmmixingratiomaster_tab.ID='$data') ) tt
                                LEFT join 
                                (SELECT $rmmixingratiodetail_tab.RMPerc, ycias_RMMixingRatioMaster.product_ID ,ycias_RMMixingRatioMaster.RMDate, CONCAT($product_table.ItemName,' ',$product_table.Description)AS ItemName,$rmmixingratiodetail_tab.rawmaterial_ID,EmpName
                                 FROM $rmmixingratiomaster_tab 
                                 inner join $product_table on $product_table.ID=$rmmixingratiomaster_tab.product_ID 
                                 inner join $rmmixingratiodetail_tab on $rmmixingratiodetail_tab.rmmixingratiomaster_ID=$rmmixingratiomaster_tab.ID 
                                 inner join $rawmaterial_table on $rawmaterial_table.ID=$rmmixingratiodetail_tab.rawmaterial_id 
                                 inner join $emp_table on $emp_table.ID=$rmmixingratiomaster_tab.approvedby_ID
                                 WHERE $rmmixingratiodetail_tab.rmmixingratiomaster_ID='$data') ss on ss.rawmaterial_ID=tt.rawmaterial_ID";
                                 
                      $rmmixingratiodetail_data = $dbutil->getSqlData($sqlsrr);
                
                    //edit option     
                    $this->tpl->set('message', 'You Can Edit Rawmaterial Mixing Form');
                    $this->tpl->set('page_header', 'Production');
                    $this->tpl->set('FmData', $rmmixingratiodetail_data); 
                    
                    $this->tpl->set('content', $this->tpl->fetch('factory/form/RMMixingRatioMaster.php'));                    
                    break;
                
                case 'edit':                    
                    $data = trim($_POST['ycs_ID']);
                
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
                                
                //   echo $sqlsrr ="SELECT * FROM `$rmmixingratiodetail_tab`,`$rmmixingratiomaster_tab` WHERE `$rmmixingratiodetail_tab`.`rmmixingratiomaster_ID`=`$rmmixingratiomaster_tab`.`ID` AND `$rmmixingratiodetail_tab`.`rmmixingratiomaster_ID`='$data'";                    
                //     $rmmixingratiodetail_data = $dbutil->getSqlData($sqlsrr); 
                    
                    
                     $sqlsrr ="select * from 
                                (SELECT ycias_unit.UnitName, ycias_rawmaterial.RMName,  CONCAT(ycias_product.ItemName,' ',ycias_product.Description)AS ItemName ,ycias_BOMDetail.rawmaterial_ID
                                FROM  $bommaster_tab
                                inner join $product_table on $product_table.ID=$bommaster_tab.product_ID 
                                INNER  join $bomdetail_tab on $bomdetail_tab.bommaster_ID=$bommaster_tab.ID 
                                inner join $rawmaterial_table on $rawmaterial_table.ID=$bomdetail_tab.rawmaterial_id
                                inner join $unit_table on $unit_table.ID=$rawmaterial_table.unit_ID
                                WHERE $bommaster_tab.product_ID=(Select product_ID from $rmmixingratiomaster_tab where $rmmixingratiomaster_tab.ID='$data') ) tt
                                LEFT join 
                                (SELECT $rmmixingratiodetail_tab.RMPerc, ycias_RMMixingRatioMaster.product_ID ,ycias_RMMixingRatioMaster.RMDate,  CONCAT($product_table.ItemName,' ',$product_table.Description)AS ItemName,$rmmixingratiodetail_tab.rawmaterial_ID,EmpName
                                 FROM $rmmixingratiomaster_tab 
                                 inner join $product_table on $product_table.ID=$rmmixingratiomaster_tab.product_ID 
                                 inner join $rmmixingratiodetail_tab on $rmmixingratiodetail_tab.rmmixingratiomaster_ID=$rmmixingratiomaster_tab.ID 
                                 inner join $rawmaterial_table on $rawmaterial_table.ID=$rmmixingratiodetail_tab.rawmaterial_id 
                                 inner join $emp_table on $emp_table.ID=$rmmixingratiomaster_tab.approvedby_ID
                                 WHERE $rmmixingratiodetail_tab.rmmixingratiomaster_ID='$data') ss on ss.rawmaterial_ID=tt.rawmaterial_ID";
                     
                      $rmmixingratiodetail_data = $dbutil->getSqlData($sqlsrr);
                
                    //edit option     
                    
                      $rmmixingratiodetail_data = $dbutil->getSqlData($sqlsrr);
                    
                    //edit option     
                    $this->tpl->set('message', 'You Can Edit RawMaterial Mixing Ratio Form');
                    $this->tpl->set('page_header', 'Production');
                    $this->tpl->set('FmData', $rmmixingratiodetail_data); 
                    
                    $this->tpl->set('content', $this->tpl->fetch('factory/form/RMMixingRatioMaster.php'));                    
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
                
                    //Build SQL now
                    $sqldet_del = "DELETE FROM $rmmixingratiodetail_tab WHERE rmmixingratiomaster_ID=$data";
                    $stmt = $this->db->prepare($sqldet_del);
                    $stmt->execute();   
                            
                            try{
                              
                            $productID= $form_post_data['product_ID'];
                            $approvedbyID= $form_post_data['approvedby_ID'];
                            $RMDate=date("Y-m-d", strtotime($form_post_data['RMDate']));
                            $sql_update="Update $rmmixingratiomaster_tab set product_ID='$productID',approvedby_ID='$approvedbyID',RMDate='$RMDate' WHERE ID=$data";
                            $stmt1 = $this->db->prepare($sql_update);
                            $stmt1->execute(); 
                        $entry_count = 1;
                        FOR ($entry_count; $entry_count <= $form_post_data['maxCount'];) {
                                $rawmaterial_ID ='ItemNo_' . $entry_count;
                                $RMPerc='ItemName_' . $entry_count;
                               // $Measuremt = 'EmpName_' . $entry_count;
                               
                                        $vals = "'" . $data . "'," .
                                        "'" . $form_post_data[$rawmaterial_ID] . "'," .
                                        "'" . $form_post_data[$RMPerc] . "'";
                                       // "'" . $form_post_data[$Measuremt] . "'";
                                        
                        
                          $sql2 = "INSERT INTO $rmmixingratiodetail_tab
                                        ( 
                                `rmmixingratiomaster_ID`, 
                                `rawmaterial_ID`,
                                `RMPerc`
                                 ) 
                                VALUES ($vals)";

                                $stmt = $this->db->prepare($sql2);
                                $stmt->execute();
                            //increment here
                            $entry_count++;
                            }
                       
                            $this->tpl->set('message', 'RawMaterial Mixing Ratio Form Edited Successfully!');   
                            $this->tpl->set('label', 'List');
                            $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                            } catch (Exception $exc) {
                             //edit failed option
                            $this->tpl->set('message', 'Failed To Edit, Try Again!');
                            $this->tpl->set('FmData', $form_post_data);
                            $this->tpl->set('content', $this->tpl->fetch('factory/form/RMMixingRatioMaster.php'));
                            }

                    break;

                case 'addsubmit':
                     if (isset($crud_string)) {
                         
                        $form_post_data = $dbutil->arrFltr($_POST);
                        
                    
                        //var_dump($form_post_data);
                        $entry_count = 1;
                       
                            if (isset($form_post_data['product_ID'])) {
                           
                                        $val = "'" . $form_post_data['product_ID'] . "'," .
                                         "'" . $form_post_data['approvedby_ID'] . "'," .
                                         "'" . date("Y-m-d", strtotime($form_post_data['RMDate'])) . "'," .
                                         "'" .  $this->ses->get('user')['entity_ID'] . "'," .
                                         "'" .  $this->ses->get('user')['ID'] . "'";
                                         
                                          //var_dump($_POST);

                                 $sql = "INSERT INTO `" . $this->crg->get('table_prefix') . "RMMixingRatioMaster`
                                            ( 
                                            `product_ID`, 
                                            `approvedby_ID`, 
                                            `RMDate`, 
                                            `entity_ID`,
                                            `users_ID`
                                            ) 
                                        VALUES ( $val )";
                                  $stmt = $this->db->prepare($sql);
                                  
                                  
                    if ($stmt->execute()) { 
                        $lastInsertedID = $this->db->lastInsertId();
                        FOR ($entry_count; $entry_count <= $form_post_data['maxCount'];) {
                               
                                $rawmaterial_ID ='ItemNo_' . $entry_count;
                                $RMPerc='ItemName_' . $entry_count;
                               // $Measuremt = 'EmpName_' . $entry_count;


                                $vals = "'" . $lastInsertedID . "'," .
                                        "'" . $form_post_data[$rawmaterial_ID] . "'," .
                                        "'" . $form_post_data[$RMPerc] . "'";  
                                       // "'" . $form_post_data[$Measuremt] . "'";
                                        
                                       
                                         //"'" . $form_post_data[$Temp] . "'";
                                 
                       $sql2 = "INSERT INTO $rmmixingratiodetail_tab
                                        (
                                `rmmixingratiomaster_ID`,        
                                `rawmaterial_ID`,
                                `RMPerc`
                                
                                 ) 
                                VALUES ($vals)";

                                 // this need to be changed in to transaction type
                                
                                $stmt = $this->db->prepare($sql2);
                                $stmt->execute();
                                  //increment here
                                $entry_count++;
                                
                            }
                    }
                    
                        }
                        $this->tpl->set('mode', 'add');
                        $this->tpl->set('message', '- Success -');
                        $this->tpl->set('content', $this->tpl->fetch('factory/form/RMMixingRatioMaster.php'));
                     } else {
                            //edit option
                            //if submit failed to insert form
                            $this->tpl->set('message', 'Failed to submit!');
                            $this->tpl->set('FmData', $form_post_data);
                            $this->tpl->set('content', $this->tpl->fetch('factory/form/RMMixingRatioMaster.php'));
                     }
                    break;
                case 'add':
                    $this->tpl->set('mode', 'add');
	                $this->tpl->set('page_header', 'Production');
                    $this->tpl->set('content', $this->tpl->fetch('factory/form/RMMixingRatioMaster.php'));
                    break;

                default:
                    /*
                     * List form
                     */
                     
                    ////////////////////start//////////////////////////////////////////////
                    
           //bUILD SQL 
            $whereString = '';
            
   $colArr = array(
       
                "$rmmixingratiomaster_tab.ID",
                "CONCAT($product_table.ItemName,' ',$product_table.Description) AS ItemName",
                "$emp_table.EmpName",
                "DATE_FORMAT($rmmixingratiomaster_tab.RMDate, '%d-%m-%Y') AS RMDate"
                
                 );
                
                //(working data)
                            //"$rmmixingmaster_tab.ID",
                           // "$rmmixingmaster_tab.product_ID",
                           // "$rmmixingmaster_tab.BatchNo",
                           //  "$rmmixingmaster_tab.machine_ID",
                           // "DATE_FORMAT($rmmixingmaster_tab.MixingDate, '%d-%m-%Y') AS MixingDate",
                           // "$rmmixingmaster_tab.shift_ID",
                           //  "$rmmixingmaster_tab.customer_ID"
              
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
             $whereString ="ORDER BY $rmmixingratiomaster_tab.ID DESC";
           }
            
          
         $sql = "SELECT "
                    . implode(',',$colArr)
                    . " FROM $rmmixingratiomaster_tab,$product_table,$emp_table "
                    . " WHERE "
                    . " $product_table.ID= $rmmixingratiomaster_tab.product_ID AND "
                    . " $emp_table.ID= $rmmixingratiomaster_tab.approvedby_ID AND "
                    . " $rmmixingratiomaster_tab.entity_ID = $entityID "
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
         
         
            $this->tpl->set('table_columns_label_arr', array('ID','Part No','Approved By','Date'));
            
            /*
             * selectColArr for filter form
             */
            
            $this->tpl->set('selectColArr',$colArr);
                        
            /*
             * set pagination template
             */
            $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');
                   
            //////////////////////close//////////////////////////////////////  
                     
                    include_once $this->tpl->path . '/factory/form/crud_form_RMMixingRatioMaster.php';
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
     
    //end of rmmixingratio
    
     function pmchecklist(){
     if ($this->crg->get('wp') || $this->crg->get('rp')) {
 ////////////////////////////////////////////////////////////////////////////////
 //////////////////////////////access condition applied//////////////////////////
 ////////////////////////////////////////////////////////////////////////////////    
            
            include_once 'util/DBUTIL.php';
            $dbutil = new DBUTIL($this->crg);
             
            $entityID = $this->ses->get('user')['entity_ID'];
            $userID = $this->ses->get('user')['ID'];
            
            $machmaster_table = $this->crg->get('table_prefix') . 'machinemaster'; 
           
            $pmchecklistdetail_tab = $this->crg->get('table_prefix') . 'PMChecklistdetail';
            $pmchecklistmaster_tab = $this->crg->get('table_prefix') . 'PMChecklistmaster';
            
             //machine select box data
            $sql = "SELECT ID,MachineName FROM $machmaster_table"; 
            $stmt = $this->db->prepare($sql);            
            $stmt->execute();
            $machine_data  = $stmt->fetchAll();	
            $this->tpl->set('machine_data', $machine_data);
           

            $this->tpl->set('page_title', 'Preventive Maintenance CheckList Form ');	          
            $this->tpl->set('page_header', 'Production');
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
                     
                     $sqldetdelete="Delete $pmchecklistdetail_tab,$pmchecklistmaster_tab from $pmchecklistmaster_tab
                                        LEFT JOIN  $pmchecklistdetail_tab ON $pmchecklistmaster_tab.ID=$pmchecklistdetail_tab.pmchecklistmaster_ID 
                                        where $pmchecklistdetail_tab.pmchecklistmaster_ID=$data"; 
                        $stmt = $this->db->prepare($sqldetdelete);            
                        
                        if($stmt->execute()){
                        $this->tpl->set('message', 'PM Checklist deleted successfully');
                         $this->tpl->set('label', 'List');
                        $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                        }
            break;
                case 'view':                    
                    $data = trim($_POST['ycs_ID']);
                 
                    if (!$data) {
                        $this->tpl->set('message', 'Please select any one ID to edit!');
                        $this->tpl->set('label', 'List');
                        $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                  