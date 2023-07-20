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
    function unit() {

        if ($this->crg->get('wp') || $this->crg->get('rp')) {

        //////////////////////////////////////////////////////////////////////////////////
        
        //////////////////////////////access condition applied///////////////////////////
        
        //////////////////////////////////////////////////////////////////////////////// 

         
           include_once 'util/DBUTIL.php';

           $dbutil = new DBUTIL($this->crg);

           $entityID = $this->ses->get('user')['entity_ID'];
           $userID = $this->ses->get('user')['ID'];
           $unit_tab = $this->crg->get('table_prefix') . 'unit';

            ////////////////////start//////////////////////////////////////////////

           //bUILD SQL 

            $whereString = '';

            $colArr = array(

                "$unit_tab.ID",
                "$unit_tab.UnitName",
                "$unit_tab.Description"
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

            $orderBy ="ORDER BY $unit_tab.ID DESC";

         $sql = "SELECT "

                 . implode(',',$colArr)

                 . " FROM $unit_tab "

                 . " WHERE "

                 . " $unit_tab.entity_ID=$entityID "

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

            $this->tpl->set('table_columns_label_arr', array('ID','Unit Name','Description',));

            

            /*,;;

             * selectColArr for filter form

             */

            

            $this->tpl->set('selectColArr',$colArr);

                        

            /*

             * set pagination template

             */

            $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');

            //////////////////////close//////////////////////////////////////  

            include_once $this->tpl->path .'/factory/form/crud_form_unit.php';

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
    ////////////////////////////////////////
    function designation() {
       
        if ($this->crg->get('wp') || $this->crg->get('rp')) {
            
        //////////////////////////////////////////////////////////////////////////////////
        //////////////////////////////access condition applied///////////////////////////
        //////////////////////////////////////////////////////////////////////////////// 
                  
            include_once 'util/DBUTIL.php';
            $dbutil = new DBUTIL($this->crg);
             
            $entityID = $this->ses->get('user')['entity_ID'];
            $userID = $this->ses->get('user')['ID'];
            
            $department_tab = $this->crg->get('table_prefix') . 'department';
            $designation_tab = $this->crg->get('table_prefix') . 'designation';      
          

            ////////////////////start//////////////////////////////////////////////
                    
           //bUILD SQL 
            $whereString = '';
            
            $colArr = array(
                "$designation_tab.ID", 
                "$designation_tab.DesignationName",
				"$department_tab.DeptName"
               
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
            
            $orderBy ="ORDER BY $designation_tab.ID DESC";
            
         $sql = "SELECT "
                 . implode(',',$colArr)
                 . " FROM $designation_tab,$department_tab "
                 . " WHERE "
                 . " $designation_tab.entity_ID=$entityID AND"
                 . " $designation_tab.Department_ID=$department_tab.ID "
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
            $this->tpl->set('table_columns_label_arr', array('ID','Designation Name','Department Name'));
            
            /*,;;
             * selectColArr for filter form
             */
            
            $this->tpl->set('selectColArr',$colArr);
                        
            /*
             * set pagination template
             */
            $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');
                   
            //////////////////////close//////////////////////////////////////  
          
             include_once $this->tpl->path .'/factory/form/crud_form_designation.php';
            
            
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
    ///////////////////////////////////////
    function rawmaterialtype() {
    if ($this->crg->get('wp') || $this->crg->get('rp')) {
        
        ////////////////////////////////////////////////////////////
        //////////////////////////////access condition applied//////
        ////////////////////////////////////////////////////////////
      
        include_once 'util/DBUTIL.php';
        $dbutil = new DBUTIL($this->crg);
         
        $entityID = $this->ses->get('user')['entity_ID'];
        $userID = $this->ses->get('user')['ID'];
        
        $rawmaterialtype_tab = $this->crg->get('table_prefix') . 'rawmaterialtype';
              
        ////////////////////start//////////////////////////////////////////////
                
       //bUILD SQL 
        $whereString = '';
        
        $colArr = array(
            "$rawmaterialtype_tab.ID", 
            "$rawmaterialtype_tab.RawMaterialType",
            "$rawmaterialtype_tab.Description"
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
        
        $orderBy ="ORDER BY $rawmaterialtype_tab.ID DESC";
        
        $sql = "SELECT "
             . implode(',',$colArr)
             . " FROM $rawmaterialtype_tab "
             . " WHERE "
             . " $rawmaterialtype_tab.entity_ID=$entityID "
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
        $this->tpl->set('table_columns_label_arr', array('ID','Raw Material Category','Description'));
        
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
    ///////////////////////////////////////
    function product() {

        if ($this->crg->get('wp') || $this->crg->get('rp')) {

            //////////////////////////////////////////////////////////
            //////////////////////////////access condition applied///
            ////////////////////////////////////////////////////////

           include_once 'util/DBUTIL.php';
           $dbutil = new DBUTIL($this->crg);

           $entityID = $this->ses->get('user')['entity_ID'];
           $userID = $this->ses->get('user')['ID'];
           $unit_tab = $this->crg->get('table_prefix') . 'unit';
           $product_tab = $this->crg->get('table_prefix') . 'product';
           $producttype_tab = $this->crg->get('table_prefix') . 'producttype';

            ////////////////////start//////////////////////////////////////////////

           //bUILD SQL 

            $whereString = '';

            $colArr = array(

                "$product_tab.ID",
                "$producttype_tab.ProductType",
                "$product_tab.ProductName",
                "$product_tab.Description",
                "$unit_tab.UnitName"
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

        $orderBy ="ORDER BY $product_tab.ID DESC";

         $sql = "SELECT "
                 . implode(',',$colArr)
                 . " FROM $product_tab LEFT JOIN $unit_tab ON $product_tab.unit_ID=$unit_tab.ID LEFT JOIN $producttype_tab ON $product_tab.producttype_ID=$producttype_tab.ID "
                 . " WHERE "
                // . " $product_tab.unit_ID=$unit_tab.ID AND "
                 . " $product_tab.entity_ID=$entityID "
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

            $this->tpl->set('table_columns_label_arr', array('ID','Product Category','Product Name','Description','Unit'));

            /*,;;

             * selectColArr for filter form

             */
            $this->tpl->set('selectColArr',$colArr);
            
            /*

             * set pagination template

             */

            $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');

            //////////////////////close//////////////////////////////////////  

            include_once $this->tpl->path .'/factory/form/crud_form_product.php';

            $cus_form_data = Form_Elements::data($this->crg);

            include_once 'util/crud3_1.php';

            new Crud3($this->crg, $cus_form_data);

            $this->tpl->set('master_layout', 'layout_datepicker.php'); 

        } else {

            if ($this->ses->get('user')['ID']) {
                $this->tpl->set('content', $this->tpl->fetch('modules/user/acess_failed_message.php'));
            } else {
                header('Location:' . $this->crg->get('route')['base_path'] . '/user/auth/login');
            }
        }
    } 
    //////////////////////////////////////
    function rawmaterial() {
    if ($this->crg->get('wp') || $this->crg->get('rp')) {
        
        ////////////////////////////////////////////////////////////
        //////////////////////////////access condition applied//////
        ////////////////////////////////////////////////////////////
      
        include_once 'util/DBUTIL.php';
        $dbutil = new DBUTIL($this->crg);
         
        $entityID = $this->ses->get('user')['entity_ID'];
        $userID = $this->ses->get('user')['ID'];
        
        $rawmaterial_tab = $this->crg->get('table_prefix') . 'rawmaterial';
        $rawmaterialtype_tab = $this->crg->get('table_prefix') . 'rawmaterialtype';
        $rawmaterialsubtype_tab = $this->crg->get('table_prefix') . 'rawmaterialsubtype';
        $unit_tab = $this->crg->get('table_prefix') . 'unit';
              
        ////////////////////start//////////////////////////////////////////////
                
       //bUILD SQL 
        $whereString = '';
        
        $colArr = array(
            "$rawmaterial_tab.ID", 
            "$rawmaterialtype_tab.RawMaterialType",
            "$rawmaterialsubtype_tab.RawMaterialSubType",
            "$rawmaterial_tab.RMName",
            "$unit_tab.UnitName"
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
        
        $orderBy ="ORDER BY $rawmaterial_tab.ID DESC";
        
     $sql = "SELECT "
             . implode(',',$colArr)
             . " FROM $rawmaterial_tab,$rawmaterialtype_tab,$rawmaterialsubtype_tab,$unit_tab "
             . " WHERE "
             . " $rawmaterial_tab.rawmaterialtype_ID=$rawmaterialtype_tab.ID AND "
             . " $rawmaterial_tab.rawmaterialsubtype_ID=$rawmaterialsubtype_tab.ID AND "
             . " $rawmaterial_tab.unit_ID=$unit_tab.ID"
            
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
        $this->tpl->set('table_columns_label_arr', array('ID','Raw Material Category','Raw Material SubCategory','Raw Material','Unit of Measure'));
        
        /*,;;
         * selectColArr for filter form
         */
        
        $this->tpl->set('selectColArr',$colArr);
                    
        /*
         * set pagination template
         */
        $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');
               
        //////////////////////close//////////////////////////////////////  
      
         include_once $this->tpl->path .'/factory/form/crud_form_rawmaterial.php';
        
        
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
    //////////////////////////////////////
    function process(){
     if ($this->crg->get('wp') || $this->crg->get('rp')) {
 ////////////////////////////////////////////////////////////////////////////////
 //////////////////////////////access condition applied//////////////////////////
 ////////////////////////////////////////////////////////////////////////////////    
            
            include_once 'util/DBUTIL.php';
            $dbutil = new DBUTIL($this->crg);
             
            $entityID = $this->ses->get('user')['entity_ID'];
            $userID = $this->ses->get('user')['ID'];
            
            $processmaster_tab = $this->crg->get('table_prefix') . 'ProcessMaster';
            
           
            $this->tpl->set('page_title', 'Process');	          
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
                     
                     $sqldetdelete="Delete from $processmaster_tab
                                        where $processmaster_tab.ID=$data"; 
                        $stmt = $this->db->prepare($sqldetdelete);            
                        
                        if($stmt->execute()){
                        $this->tpl->set('message', 'Process deleted successfully');
                        header('Location:' . $this->crg->get('route')['base_path'] . '/admin/mast/process');
                        // $this->tpl->set('label', 'List');
                        // $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
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
                                
                    $sqlsrr = "SELECT  * FROM `$processmaster_tab` WHERE `$processmaster_tab`.`ID` = '$data'";                    
                    $process_data = $dbutil->getSqlData($sqlsrr); 
                    
                    //edit option     
                    $this->tpl->set('message', 'You can view Process form');
                    $this->tpl->set('page_header', 'Production');
                    $this->tpl->set('FmData', $process_data); 
                    
                    $this->tpl->set('content', $this->tpl->fetch('factory/form/process_form.php'));                    
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
                                
                    // $sqlsrr = "SELECT  * FROM `$processdetail_tab`,`$processmaster_tab` WHERE `$processdetail_tab`.`ProcessMaster_ID`=`$processmaster_tab`.`ID` AND `$processdetail_tab`.`ProcessMaster_ID` = '$data'";                    
                    // $process_data = $dbutil->getSqlData($sqlsrr); 
                    
                    $sqlsrr = "SELECT  * FROM `$processmaster_tab` WHERE `$processmaster_tab`.`ID` = '$data'";                    
                    $process_data = $dbutil->getSqlData($sqlsrr); 
                    
                    //edit option     
                    $this->tpl->set('message', 'You can edit Process form');
                    $this->tpl->set('page_header', 'Production');
                    $this->tpl->set('FmData', $process_data); 
                    
                    $this->tpl->set('content', $this->tpl->fetch('factory/form/process_form.php'));                    
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
                            
                            $ProcessName= $form_post_data['ProcessName'];
                            $Description= $form_post_data['Description'];
							
						 $sql_update="UPDATE $processmaster_tab set ProcessName='$ProcessName',Description='$Description' WHERE ID=$data";
                         $stmt1 = $this->db->prepare($sql_update);
                         $stmt1->execute();
                       
                            $this->tpl->set('message', 'Process form edited successfully!');   
                            header('Location:' . $this->crg->get('route')['base_path'] . '/admin/mast/process');
                            // $this->tpl->set('label', 'List');
                            // $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                            } catch (Exception $exc) {
                             //edit failed option
                            $this->tpl->set('message', 'Failed to edit, try again!');
                            $this->tpl->set('FmData', $form_post_data);
                            $this->tpl->set('content', $this->tpl->fetch('factory/form/process_form.php'));
                            }

                    break;

                case 'addsubmit':
                     if (isset($crud_string)) {
                         
                        $form_post_data = $dbutil->arrFltr($_POST);
                        
                       // var_dump($_POST);
                        
                        $entry_count = 1;
                       
                            if (isset($form_post_data['ProcessName'])) {
                           
                                        $val = "'" . $form_post_data['ProcessName'] . "'," .
                                               "'" . $form_post_data['Description'] . "'," .
                                               "'" .  $this->ses->get('user')['entity_ID'] . "'," .
                                               "'" .  $this->ses->get('user')['ID'] . "'";

                              $sql = "INSERT INTO `" . $this->crg->get('table_prefix') . "ProcessMaster`
                                            ( 
                                            `ProcessName`,
                                            `Description`,
                                            `entity_ID`,
                                            `users_ID`
                                            ) 
                                        VALUES ( $val )";
                                  $stmt = $this->db->prepare($sql);
                                  $stmt->execute();
                                  
                    }
                        $this->tpl->set('mode', 'add');
                        $this->tpl->set('message', '- Success -');
                        header('Location:' . $this->crg->get('route')['base_path'] . '/admin/mast/process');
                       // $this->tpl->set('content', $this->tpl->fetch('factory/form/process_form.php'));
                     } else {
                            //edit option
                            //if submit failed to insert form
                            $this->tpl->set('message', 'Failed to submit!');
                            $this->tpl->set('FmData', $form_post_data);
                            $this->tpl->set('content', $this->tpl->fetch('factory/form/process_form.php'));
                     }
                    break;
                case 'add':
                    $this->tpl->set('mode', 'add');
	                $this->tpl->set('page_header', 'Production');
                    $this->tpl->set('content', $this->tpl->fetch('factory/form/process_form.php'));
                    break;

                default:
                    /*
                     * List form
                     */
                     
                    ////////////////////start//////////////////////////////////////////////
                    
           //bUILD SQL 
            $whereString = '';
            
         $colArr = array(
                "$processmaster_tab.ID",
                "$processmaster_tab.ProcessName"
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
             $whereString ="ORDER BY $processmaster_tab.ID DESC";
           }
            
        $sql = "SELECT "
                    . implode(',',$colArr)
                    . " FROM $processmaster_tab "
                    . " WHERE "
                    . " $processmaster_tab.entity_ID = $entityID"
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
         
         
            $this->tpl->set('table_columns_label_arr', array('ID','Product Name'));
            
            /*
             * selectColArr for filter form
             */
            
            $this->tpl->set('selectColArr',$colArr);
                        
            /*
             * set pagination template
             */
            $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');
                   
            //////////////////////close//////////////////////////////////////  
                     
                    include_once $this->tpl->path . '/factory/form/crud_form_process.php';
                    $cus_form_data = Form_Elements::data($this->crg);
                    include_once 'util/crud3.php';
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
    /////////////////////////////////////
    function bomprocess(){
     if ($this->crg->get('wp') || $this->crg->get('rp')) {
             
            ////////////////////////////////////////////////////////////////////////////////
            //////////////////////////////access condition applied//////////////////////////
            ////////////////////////////////////////////////////////////////////////////////    
            
            include_once 'util/DBUTIL.php';
            $dbutil = new DBUTIL($this->crg);
             
            $entityID = $this->ses->get('user')['entity_ID'];
            $userID = $this->ses->get('user')['ID'];
            
            $pdt_table = $this->crg->get('table_prefix') . 'product';
            $rawmaterial_table = $this->crg->get('table_prefix') . 'rawmaterial';
            $unit_table = $this->crg->get('table_prefix') . 'unit';
            $processdetail_tab = $this->crg->get('table_prefix') . 'ProcessDetail';
            $processmaster_tab = $this->crg->get('table_prefix') . 'ProcessMaster';
            $bomprocessdetail_tab = $this->crg->get('table_prefix') . 'BOMProcessDetail';
            $bomprocessmaster_tab = $this->crg->get('table_prefix') . 'BOMProcessMaster';
           
           //product table data 
           
            $pdt_sql = "SELECT ID,ProductName FROM $pdt_table WHERE ProductBomProcess_Status=1 ORDER BY $pdt_table.ID DESC";
            $stmt = $this->db->prepare($pdt_sql);            
            $stmt->execute();
            $pdt_data  = $stmt->fetchAll();	
            $this->tpl->set('pdt_data', $pdt_data);
			
		    $pdt_sql = "SELECT ID,ProductName FROM $pdt_table WHERE ProductBomProcess_Status=2";
            $stmt = $this->db->prepare($pdt_sql);            
            $stmt->execute();
            $pdt1_data  = $stmt->fetchAll();	
            $this->tpl->set('pdt1_data', $pdt1_data);
            
            //process table data
           
            $process_sql = "SELECT ID,ProcessName FROM $processmaster_tab";
            $stmt = $this->db->prepare($process_sql);            
            $stmt->execute();
            $process_data  = $stmt->fetchAll();	
            $this->tpl->set('process_data', $process_data);
            
            //rawmaterial table data
           
            $pdt_sql = "SELECT ID,RMName FROM $rawmaterial_table";
            $stmt = $this->db->prepare($pdt_sql);            
            $stmt->execute();
            $rawmaterial_data  = $stmt->fetchAll();	
            $this->tpl->set('rawmaterial_data', $rawmaterial_data);
            
            //unit table data
           
            $pdt_sql = "SELECT ID,UnitName FROM $unit_table";
            $stmt = $this->db->prepare($pdt_sql);            
            $stmt->execute();
            $unit_data  = $stmt->fetchAll();	
            $this->tpl->set('unit_data', $unit_data);
            
           
            $this->tpl->set('page_title', 'BOM Process');	          
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
                     
					  $sql_update="UPDATE $pdt_table SET ProductBomProcess_Status=1 WHERE ID=(SELECT product_ID FROM $bomprocessmaster_tab WHERE $bomprocessmaster_tab.ID= $data)";
                      $stmt1 = $this->db->prepare($sql_update);
					  $stmt1->execute();
					  
                     $sqldetdelete="Delete $bomprocessdetail_tab,$bomprocessmaster_tab from $bomprocessmaster_tab
                                        LEFT JOIN  $bomprocessdetail_tab ON $bomprocessmaster_tab.ID=$bomprocessdetail_tab.BOMProcessMaster_ID 
                                        where $bomprocessdetail_tab.BOMProcessMaster_ID=$data"; 
                        $stmt = $this->db->prepare($sqldetdelete);            
                        
                        if($stmt->execute()){
                        $this->tpl->set('message', 'Process deleted successfully');
                        header('Location:' . $this->crg->get('route')['base_path'] . '/admin/mast/bomprocess');
                        // $this->tpl->set('label', 'List');
                        // $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
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
                                
                    
                    $sqlsrr = "SELECT  * FROM `$bomprocessmaster_tab` LEFT JOIN `$bomprocessdetail_tab` ON `$bomprocessmaster_tab`.`ID`=`$bomprocessdetail_tab`.`BOMProcessMaster_ID`  WHERE  `$bomprocessmaster_tab`.`ID` = '$data' ORDER BY `$bomprocessdetail_tab`.ID ASC";                    
                    $process_data = $dbutil->getSqlData($sqlsrr); 
                    
                    //edit option     
                    $this->tpl->set('message', 'You can view Process BOM form');
                    $this->tpl->set('page_header', 'Production');
                    $this->tpl->set('FmData', $process_data); 
                    
                    $this->tpl->set('content', $this->tpl->fetch('factory/form/bomprocess_form.php'));                    
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
                                
                    // $sqlsrr = "SELECT  * FROM `$bomprocessdetail_tab`,`$bomprocessmaster_tab` WHERE `$bomprocessdetail_tab`.`BOMProcessMaster_ID`=`$bomprocessmaster_tab`.`ID` AND `$bomprocessdetail_tab`.`BOMProcessMaster_ID` = '$data'";                    
                    // $process_data = $dbutil->getSqlData($sqlsrr); 
                
                    $sqlsrr = "SELECT  * FROM `$bomprocessmaster_tab` LEFT JOIN `$bomprocessdetail_tab` ON `$bomprocessmaster_tab`.`ID`=`$bomprocessdetail_tab`.`BOMProcessMaster_ID`  WHERE  `$bomprocessmaster_tab`.`ID` = '$data' ORDER BY `$bomprocessdetail_tab`.ID ASC";                    
                    $process_data = $dbutil->getSqlData($sqlsrr); 
                        
                    //edit option     
                    $this->tpl->set('message', 'You can edit Process BOM form');
                    $this->tpl->set('page_header', 'Production');
                    $this->tpl->set('FmData', $process_data); 
                    
                    $this->tpl->set('content', $this->tpl->fetch('factory/form/bomprocess_form.php'));                    
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
                    $sqldet_del = "DELETE FROM $bomprocessdetail_tab WHERE BOMProcessMaster_ID=$data";
                    $stmt = $this->db->prepare($sqldet_del);
                    $stmt->execute();   
                            
                            try{
                            
                            $productID= $form_post_data['product_ID'];
                           
                            $sql_update="Update $bomprocessmaster_tab set product_ID='$productID' WHERE ID=$data";
                            $stmt1 = $this->db->prepare($sql_update);
                            $stmt1->execute(); 
                       
                        FOR ($entry_count= 1; $entry_count <= $form_post_data['maxCount'];$entry_count++) {
                                
                                $process_id =$form_post_data['ItemName_'.$entry_count];
                                $rawmaterial_id =$form_post_data['rawmaterial_' . $entry_count];
                                $quantity =$form_post_data['Quantity_' . $entry_count];
                                $unit_id =$form_post_data['unit_' . $entry_count];

                            if(!empty($process_id) && !empty($rawmaterial_id) && !empty($quantity) && !empty($unit_id)){
                                
                                $vals = "'" . $data . "'," .
                                        "'" . $process_id . "'," .
                                        "'" . $rawmaterial_id . "'," .
                                        "'" . $quantity . "'," .
                                        "'" . $unit_id . "'" ;
  
                                $sql2 = "INSERT INTO $bomprocessdetail_tab
                                        ( 
                                            
                                            `BOMProcessMaster_ID`, 
                                            `process_ID`,
                                            `rawmaterial_ID`,
                                            `Quantity`,
                                            `unit_ID`
                                        ) 
                                VALUES ($vals)";
                                $stmt = $this->db->prepare($sql2);
                                $stmt->execute();
                            }
                            
                        }
                       
                            $this->tpl->set('message', 'Process BOM form edited successfully!');   
                            header('Location:' . $this->crg->get('route')['base_path'] . '/admin/mast/bomprocess');
                            // $this->tpl->set('label', 'List');
                            // $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                            } catch (Exception $exc) {
                             //edit failed option
                            $this->tpl->set('message', 'Failed to edit, try again!');
                            $this->tpl->set('FmData', $form_post_data);
                            $this->tpl->set('content', $this->tpl->fetch('factory/form/bomprocess_form.php'));
                            }

                    break;

                case 'addsubmit':
                     if (isset($crud_string)) {
                         
                        $form_post_data = $dbutil->arrFltr($_POST);
                        
                       // var_dump($_POST);
                   
                    if (isset($form_post_data['product_ID'])) {
                           
                                $val = "'" . $form_post_data['product_ID'] . "'," .
                                       "'" .  $this->ses->get('user')['entity_ID'] . "'," .
                                       "'" .  $this->ses->get('user')['ID'] . "'";
                             
							 $product_ID= $form_post_data['product_ID'];
							 if($form_post_data['product_ID']){
                                $sql = "INSERT INTO `" . $this->crg->get('table_prefix') . "BOMProcessMaster`
                                            ( 
                                            `product_ID`,
                                            `entity_ID`,
                                            `users_ID`
                                            ) 
                                        VALUES ( $val )";
                                $stmt = $this->db->prepare($sql);
								
						 $sql_update="UPDATE $pdt_table SET ProductBomProcess_Status=2 WHERE ID=$product_ID";
                         $stmt1 = $this->db->prepare($sql_update);
						 $stmt1->execute();
						 
					}
                                  
                        if ($stmt->execute()) { 
                            
                            $lastInsertedID = $this->db->lastInsertId();
                            
                            FOR ($entry_count = 1; $entry_count <= $form_post_data['maxCount'];$entry_count++) {
                                   
                                    $process_id =$form_post_data['ItemName_' . $entry_count];
                                    $rawmaterial_id =$form_post_data['rawmaterial_' . $entry_count];
                                    $quantity =$form_post_data['Quantity_' . $entry_count];
                                    $unit_id =$form_post_data['unit_' . $entry_count];
                            
                                if(!empty($process_id) && !empty($rawmaterial_id) && !empty($quantity) && !empty($unit_id)){
                                    
                                    $vals = "'" . $lastInsertedID . "'," .
                                            "'" . $process_id . "'," .
                                            "'" . $rawmaterial_id . "'," .
                                            "'" . $quantity . "'," .
                                            "'" . $unit_id . "'" ;
                                     
                                    $sql2 = "INSERT INTO $bomprocessdetail_tab
                                            ( 
                                                `BOMProcessMaster_ID`, 
                                                `process_ID`,
                                                `rawmaterial_ID`,
                                                `Quantity`,
                                                `unit_ID`
                                            ) 
                                    VALUES ($vals)";
    
                                     // this need to be changed in to transaction type
                                    
                                    $stmt = $this->db->prepare($sql2);
                                    $stmt->execute();
                            }
                                    
                            }
                        }
                    }
                        $this->tpl->set('mode', 'add');
                        $this->tpl->set('message', '- Success -');
                        header('Location:' . $this->crg->get('route')['base_path'] . '/admin/mast/bomprocess');
                       // $this->tpl->set('content', $this->tpl->fetch('factory/form/bomprocess_form.php'));
                     } else {
                            //edit option
                            //if submit failed to insert form
                            $this->tpl->set('message', 'Failed to submit!');
                            $this->tpl->set('FmData', $form_post_data);
                            $this->tpl->set('content', $this->tpl->fetch('factory/form/bomprocess_form.php'));
                     }
                    break;
                case 'add':
                    $this->tpl->set('mode', 'add');
	                $this->tpl->set('page_header', 'Production');
                    $this->tpl->set('content', $this->tpl->fetch('factory/form/bomprocess_form.php'));
                    break;

                default:
                    /*
                     * List form
                     */
                     
                    ////////////////////start//////////////////////////////////////////////
                    
           //bUILD SQL 
            $whereString = '';
            
         $colArr = array(
                "$bomprocessmaster_tab.ID",
                "$pdt_table.ProductName"
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
             $whereString ="ORDER BY $bomprocessmaster_tab.ID DESC";
           }
            
        $sql = "SELECT "
                    . implode(',',$colArr)
                    . " FROM $bomprocessmaster_tab,$pdt_table "
                    . " WHERE "
                    . " $pdt_table.ID= $bomprocessmaster_tab.product_ID AND "
                    . " $bomprocessmaster_tab.entity_ID = $entityID"
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
         
         
            $this->tpl->set('table_columns_label_arr', array('ID','Product Name'));
            
            /*
             * selectColArr for filter form
             */
            
            $this->tpl->set('selectColArr',$colArr);
                        
            /*
             * set pagination template
             */
            $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');
                   
            //////////////////////close//////////////////////////////////////  
                     
                    include_once $this->tpl->path . '/factory/form/crud_form_bomprocess.php';
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
    ////////////////////////////////////
     function rawmaterialsubtype() {
        if ($this->crg->get('wp') || $this->crg->get('rp')) {
        
        ////////////////////////////////////////////////////////////
        //////////////////////////////access condition applied//////
        ////////////////////////////////////////////////////////////
      
        include_once 'util/DBUTIL.php';
        $dbutil = new DBUTIL($this->crg);
         
        $entityID = $this->ses->get('user')['entity_ID'];
        $userID = $this->ses->get('user')['ID'];
        
        $rawmaterialtype_tab = $this->crg->get('table_prefix') . 'rawmaterialtype';
        $rawmaterialsubtype_tab = $this->crg->get('table_prefix') . 'rawmaterialsubtype';
              
        ////////////////////start//////////////////////////////////////////////
                
       //bUILD SQL 
        $whereString = '';
        
        $colArr = array(
            "$rawmaterialsubtype_tab.ID", 
            "$rawmaterialtype_tab.RawMaterialType",
            "$rawmaterialsubtype_tab.RawMaterialSubType",
            "$rawmaterialsubtype_tab.Description"
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
        
        $orderBy ="ORDER BY $rawmaterialsubtype_tab.ID DESC";
        
     $sql = "SELECT "
             . implode(',',$colArr)
             . " FROM $rawmaterialsubtype_tab LEFT JOIN $rawmaterialtype_tab ON $rawmaterialsubtype_tab.rawmaterialtype_ID=$rawmaterialtype_tab.ID "
             . " WHERE "
             . " $rawmaterialsubtype_tab.entity_ID=$entityID "
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
        $this->tpl->set('table_columns_label_arr', array('ID','Raw Material Category','Raw Material SubCategory','Description'));
        
        /*,;;
         * selectColArr for filter form
         */
        
        $this->tpl->set('selectColArr',$colArr);
                    
        /*
         * set pagination template
         */
        $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');
               
        //////////////////////close//////////////////////////////////////  
      
         include_once $this->tpl->path .'/factory/form/crud_form_rawmaterialsubtype.php';
        
        
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
    ///////////////////////////////////
     function producttype() {
        
        if ($this->crg->get('wp') || $this->crg->get('rp')) {
        
        /////////////////////////////////////////////
        /////access condition applied////////////////
        /////////////////////////////////////////////
          
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
                "$pdttype_tab.ProductType",
                "$pdttype_tab.Description"
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
            $this->tpl->set('table_columns_label_arr', array('ID','Product Category','Description'));
            
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
    //////////////////////////////////
    function pdndept() {
        if ($this->crg->get('wp') || $this->crg->get('rp')) {
            
            /////////////////////////////////////////////////////////
            //////////////////////////////access condition applied///
            /////////////////////////////////////////////////////////
                      
            include_once 'util/DBUTIL.php';
            $dbutil = new DBUTIL($this->crg);
             
            $entityID = $this->ses->get('user')['entity_ID'];
            $userID = $this->ses->get('user')['ID'];
            
            
            $pdndept_tab = $this->crg->get('table_prefix') . 'pdndepartment';
                  
            ////////////////////start//////////////////////////////////////////////
                    
           //bUILD SQL 
            $whereString = '';
            
            $colArr = array(
                "$pdndept_tab.ID", 
                "$pdndept_tab.DeptName",
                "$pdndept_tab.Description"
               
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
            
            $orderBy ="ORDER BY $pdndept_tab.ID DESC";
            
         $sql = "SELECT "
                 . implode(',',$colArr)
                 . " FROM $pdndept_tab "
                 . " WHERE "
                 . " $pdndept_tab.entity_ID=$entityID "
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
            $this->tpl->set('table_columns_label_arr', array('ID','Production Department','Description'));
            
            /*,;;
             * selectColArr for filter form
             */
            
            $this->tpl->set('selectColArr',$colArr);
                        
            /*
             * set pagination template
             */
            $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');
                   
            //////////////////////close//////////////////////////////////////  
          
             include_once $this->tpl->path .'/factory/form/crud_form_pdndepartment.php';
            
            
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
    ////////////////////////////////////////////////
    
    function approvaltype() {
        if ($this->crg->get('wp') || $this->crg->get('rp')) {
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////access condition applied///////////////////////////
//////////////////////////////////////////////////////////////////////////////// 
          
           include_once 'util/DBUTIL.php';
           $dbutil = new DBUTIL($this->crg);
             
             $entityID = $this->ses->get('user')['entity_ID'];
             $userID = $this->ses->get('user')['ID'];
            
            
           $approvaltype_tab = $this->crg->get('table_prefix') . 'approvaltype';
           $user_tab = $this->crg->get('table_prefix') . 'users';
                  
          

            ////////////////////start//////////////////////////////////////////////
                    
           //bUILD SQL 
            $whereString = '';
            
            $colArr = array(
                "$approvaltype_tab.ID", 
                "$approvaltype_tab.ProcessTypeName",
                "$user_tab.user_nicename"
               
               
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
            
            $orderBy ="ORDER BY $approvaltype_tab.ID DESC";
            
          $sql = "SELECT "
                 . implode(',',$colArr)
                 . " FROM $approvaltype_tab,$user_tab"
                 . " WHERE "
                 . " $user_tab.ID=$approvaltype_tab.approver_ID AND "
                 . " $approvaltype_tab.entity_ID=$entityID "
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
            $this->tpl->set('table_columns_label_arr', array('ID','Approval Type' ,'User'));
            
            /*,;;
             * selectColArr for filter form
             */
            
            $this->tpl->set('selectColArr',$colArr);
                        
            /*
             * set pagination template
             */
            $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');
                   
            //////////////////////close//////////////////////////////////////  
          
             include_once $this->tpl->path .'/factory/form/crud_approvaltype.php';
            
            
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
}
