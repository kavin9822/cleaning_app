<?php

/**
 * Description of Product_Mod
 *
 * @author psmahadevan
 */
class Property_Mod {

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
    
///////////////////// Supplier_Form//////////////////
    
public function property(){
    
    if ($this->crg->get('wp') || $this->crg->get('rp')) {
			 
			////////////////////////////////////////////////////////////////////////////////
			//////////////////////////////access condition applied//////////////////////////
			////////////////////////////////////////////////////////////////////////////////    
						
            include_once 'util/DBUTIL.php';
            $dbutil = new DBUTIL($this->crg);
             
            $entityID = $this->ses->get('user')['entity_ID'];
            $userID = $this->ses->get('user')['ID'];
            
            $property_table = $this->crg->get('table_prefix') . 'property';
			$state_table = $this->crg->get('table_prefix') . 'state';
            $country_table = $this->crg->get('table_prefix') . 'country';

            $state_sql = "SELECT ID,StateName FROM $state_table";
            $stmt = $this->db->prepare($state_sql);            
            $stmt->execute();
            $state_data  = $stmt->fetchAll();	
            $this->tpl->set('state_data', $state_data);

            $country_sql = "SELECT ID,CountryName FROM $country_table";
            $stmt = $this->db->prepare($country_sql);            
            $stmt->execute();
            $country_data  = $stmt->fetchAll();	
            $this->tpl->set('country_data', $country_data);
			
            $this->tpl->set('page_title', 'Property Master');	          
            $this->tpl->set('page_header', 'Property Master');
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
                     
                     $sqldetdelete="Delete from $property_table
                                        where $property_table.ID=$data"; 
                        $stmt = $this->db->prepare($sqldetdelete);            
                        
                        if($stmt->execute()){
                        $this->tpl->set('message', 'Property form deleted successfully');
																													  
                        //$this->tpl->set('label', 'List');
                        //$this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
						header('Location:' . $this->crg->get('route')['base_path'] . '/property/cst/property');
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
                               FROM $property_table 
					           WHERE 
                               $property_table.ID = $data";   
                    $property_data = $dbutil->getSqlData($sqlsrr);
                   
                
                    //edit option     
                    $this->tpl->set('message', 'You can view Property Master form');
                    $this->tpl->set('page_header', 'Property Master');
                    $this->tpl->set('FmData', $property_data); 
                    
                    $this->tpl->set('content', $this->tpl->fetch('factory/form/property_design_form.php'));                    
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
                           FROM $property_table 
                           WHERE 
                           $property_table.ID = $data";   
                $property_data = $dbutil->getSqlData($sqlsrr);
                   
                    
                    //edit option 

					
                    $this->tpl->set('message', 'You can edit Property Master form');
                    $this->tpl->set('page_header', 'Property Master');
                    $this->tpl->set('FmData', $property_data); 
                    
                    $this->tpl->set('content', $this->tpl->fetch('factory/form/property_design_form.php'));                    
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
                          $PropertyName= $form_post_data['PropertyName'];
                          $Description= $form_post_data['Description'];
                          $Account_ID= $form_post_data['Account_ID'];
						  $Tag= $form_post_data['Tag'];
						  $StructureType= $form_post_data['StructureType'];
						  $NoOfFloor= $form_post_data['NoOfFloor'];
                          $LivingArea= $form_post_data['LivingArea'];
						  $BuiltYear= $form_post_data['BuiltYear'];
						  $AddressLine1= $form_post_data['AddressLine1'];
						  $AddressLine2= $form_post_data['AddressLine2'];
						  $City= $form_post_data['City'];
						  $StateID= $form_post_data['StateID'];
						  $Pincode= $form_post_data['Pincode'];
						  $CountryID= $form_post_data['CountryID'];
						  
							$sql_update="UPDATE $property_table set PropertyName='$PropertyName',
                                                                    Description ='$Description',
                                                                    Account_ID ='$Account_ID',
                                                                    Tag='$Tag',
                                                                    StructureType='$StructureType',
                                                                    NoOfFloor='$NoOfFloor',
                                                                    LivingArea='$LivingArea',
                                                                    BuiltYear='$BuiltYear',
                                                                    AddressLine1='$AddressLine1',
                                                                    AddressLine2='$AddressLine2',
                                                                    City='$City',
                                                                    StateID='$StateID',
                                                                    Pincode='$Pincode',
                                                                    CountryID='$CountryID' WHERE ID=$data";
                            $stmt1 = $this->db->prepare($sql_update);
                            $stmt1->execute();
							
                            $this->tpl->set('message', 'Property form edited successfully!');   
																														  
                            // $this->tpl->set('label', 'List');
                            // $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
							header('Location:' . $this->crg->get('route')['base_path'] . '/property/cst/property');
                            } catch (Exception $exc) {
                             //edit failed option
                            $this->tpl->set('message', 'Failed to edit, try again!');
                            $this->tpl->set('FmData', $form_post_data);
                            $this->tpl->set('content', $this->tpl->fetch('factory/form/property_design_form.php'));
                            }

                    break;

                case 'addsubmit':
                     if (isset($crud_string)) {
 
                        $form_post_data = $dbutil->arrFltr($_POST);
                        
                      // var_dump($_POST);
					 
                       
					   if (isset($form_post_data['PropertyName'])) {
                           
                                        $val = "'" . $form_post_data['PropertyName'] . "'," .
                                         "'" . $form_post_data['Description'] . "'," .
                                         "'" . $form_post_data['Account_ID'] . "'," .
										 "'" . $form_post_data['Tag'] . "'," .
                                         "'" . $form_post_data['StructureType'] . "'," .
										 "'" . $form_post_data['NoOfFloor'] . "'," .
                                         "'" . $form_post_data['LivingArea'] . "'," .
										 "'" . $form_post_data['BuiltYear'] . "'," .
                                         "'" . $form_post_data['AddressLine1'] . "'," .
										 "'" . $form_post_data['AddressLine2'] . "'," .
										 "'" . $form_post_data['City'] . "'," .
										 "'" . $form_post_data['StateID'] . "'," .
										 "'" . $form_post_data['Pincode'] . "'," .
										 "'" . $form_post_data['CountryID'] . "'," .
                                              "'" .  $this->ses->get('user')['entity_ID'] . "'," .
                                         "'" .  $this->ses->get('user')['ID'] . "'";

                             $sql = "INSERT INTO `" . $this->crg->get('table_prefix') . "property`
                                            (
                                            `PropertyName`, 
                                            `Description`, 
                                            `Account_ID`, 
											`Tag`,
                                            `StructureType`,
											`NoOfFloor`, 
                                            `LivingArea`,
                                            `BuiltYear`,
											`AddressLine1`,
                                            `AddressLine2`,
											`City`,
											`StateID`, 
										    `Pincode`,
											`CountryID`,
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
						header('Location:' . $this->crg->get('route')['base_path'] . '/property/cst/property');
																										
                     } else {
                            //edit option
                            //if submit failed to insert form
                            $this->tpl->set('message', 'Failed to submit!');
                            $this->tpl->set('FmData', $form_post_data);
                            $this->tpl->set('content', $this->tpl->fetch('factory/form/property_design_form.php'));
                     }
                    break;
                case 'add':
                    $this->tpl->set('mode', 'add');
	                $this->tpl->set('page_header', 'Property Master');
                    $this->tpl->set('content', $this->tpl->fetch('factory/form/property_design_form.php'));
                    break;

                default:
                    /*
                     * List form
                     */
                     
                    ////////////////////start//////////////////////////////////////////////
                    
           //bUILD SQL 
            $whereString = '';
         $colArr = array(
                "$property_table.ID",
				"$property_table.PropertyName",
				"$property_table.Description",
				"$property_table.Account_ID",
				"$property_table.StructureType",
				"$property_table.LivingArea"

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
             $whereString ="ORDER BY $property_table.ID DESC";
           }
		   
		      
       $sql = "SELECT " 
                    . implode(',',$colArr)
                    . " FROM $property_table  "
                    . " WHERE "
                    . " $property_table.entity_ID = $entityID" 
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
         
         
		 
            $this->tpl->set('table_columns_label_arr', array('ID','Property Name','Description','Account ID','Structure Type','Living Area'));
            
            /*
             * selectColArr for filter form
             */
            
            $this->tpl->set('selectColArr',$colArr);
                        
            /*
             * set pagination template
             */
            $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');
                   
            //////////////////////close//////////////////////////////////////  
                     
                    include_once $this->tpl->path . '/factory/form/crud_form_property.php';
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

    public function element(){
    
        if ($this->crg->get('wp') || $this->crg->get('rp')) {
                 
                ////////////////////////////////////////////////////////////////////////////////
                //////////////////////////////access condition applied//////////////////////////
                ////////////////////////////////////////////////////////////////////////////////    
                            
                include_once 'util/DBUTIL.php';
                $dbutil = new DBUTIL($this->crg);
                 
                $entityID = $this->ses->get('user')['entity_ID'];
                $userID = $this->ses->get('user')['ID'];
                
                $element_detail_table = $this->crg->get('table_prefix') . 'element_detail';
                $property_table = $this->crg->get('table_prefix') . 'property';
                $item_table = $this->crg->get('table_prefix') . 'item_master';
                $element_attachments_tab = $this->crg->get('table_prefix') . 'element_attachments';
    
                $property_sql = "SELECT ID,PropertyName,NoOfFloor FROM $property_table";
                $stmt = $this->db->prepare($property_sql);            
                $stmt->execute();
                $property_data  = $stmt->fetchAll();	
                $this->tpl->set('property_data', $property_data);

                $item_sql = "SELECT ID,ItemName FROM $item_table";
                $stmt = $this->db->prepare($item_sql);            
                $stmt->execute();
                $item_data  = $stmt->fetchAll();	
                $this->tpl->set('item_data', $item_data);
                
                $this->tpl->set('page_title', 'Elements');	          
                $this->tpl->set('page_header', 'Elements');
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
                         
                                        $sqlsel_del = "SELECT document_path FROM $element_attachments_tab WHERE Element_ID  = '$data'";
                                        $resource_data = $dbutil->getSqlData($sqlsel_del); 
                                        
                                        if(!empty($resource_data)){
                                             foreach($resource_data as $k=>$v){
                                                          unlink(substr($v['document_path'], 2));
                                                   }
                                        }
                                         
                                         $sqldetdelete="Delete $element_detail_table,$element_attachments_tab from $element_detail_table 
                                                        LEFT JOIN  $element_attachments_tab ON $element_detail_table.ID=$element_attachments_tab.Element_ID 
                                                        where $element_detail_table.ID=$data"; 
                                         $stmt = $this->db->prepare($sqldetdelete);            
                            
                            if($stmt->execute()){
                            $this->tpl->set('message', 'Element form deleted successfully');
                                                                                                                          
                            //$this->tpl->set('label', 'List');
                            //$this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                            header('Location:' . $this->crg->get('route')['base_path'] . '/property/cst/element');
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
                                   FROM $element_detail_table 
                                   WHERE 
                                   $element_detail_table.ID = $data";   
                        $element_data = $dbutil->getSqlData($sqlsrr);
                        
                        $sql= "SELECT ID,document_path  From $element_attachments_tab where (Element_ID  = '$data' AND attribute_name='attachment') ORDER BY $element_attachments_tab.ID ASC";            
                        $attachemnt_data = $dbutil->getSqlData($sql);
                        $this->tpl->set('FmDataattachment', $attachemnt_data);
                       
                    
                        //edit option     
                        $this->tpl->set('message', 'You can view Element form');
                        $this->tpl->set('page_header', 'Elements');
                        $this->tpl->set('FmData', $element_data); 
                        
                        $this->tpl->set('content', $this->tpl->fetch('factory/form/element_design_form.php'));                    
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
                               FROM $element_detail_table 
                               WHERE 
                               $element_detail_table.ID = $data";   
                    $element_data = $dbutil->getSqlData($sqlsrr);
                    
                    $sql= "SELECT ID,document_path  From $element_attachments_tab where (Element_ID  = '$data' AND attribute_name='attachment') ORDER BY $element_attachments_tab.ID ASC";            
                    $attachemnt_data = $dbutil->getSqlData($sql);
                    $this->tpl->set('FmDataattachment', $attachemnt_data);
                       
                        
                        //edit option 
    
                        
                        $this->tpl->set('message', 'You can edit Element form');
                        $this->tpl->set('page_header', 'Elements');
                        $this->tpl->set('FmData', $element_data); 
                        
                        $this->tpl->set('content', $this->tpl->fetch('factory/form/element_design_form.php'));                    
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

                         //handle file upload and update staff table    
                           // $updatecustomer = array();
                        
                        foreach ($_FILES as $Fvalue => $valueNotUsing) {
                            $uploadedFile = $util->handle_file_upload($Fvalue, $ID);
                
                            if ($uploadedFile) {
                                // $updatecustomer = '`' . $Fvalue . '` =\'' . $uploadedFile . '\''; // <-- Issue 4: This line overwrites the previous value
                                $updatecustomer .= '`' . $Fvalue . '` =\'' . $uploadedFile . '\','; // <-- Issue 5: Use concatenation to update multiple file fields
                            }
                        }
                
                        // Remove the trailing comma from $updatecustomer
                        $updatecustomer = rtrim($updatecustomer, ',');
                
                        $updateSql = "UPDATE `" . $this->crg->get('table_prefix') . "element_detail`
                                        SET " . $updatecustomer . "
                                        WHERE ID = '" . $data . "'";
                        $stmt = $this->db->prepare($updateSql);
                        $stmt->execute();
                                                   
                        try{
                              $Property_ID= $form_post_data['Property_ID'];
                              $ElementType= $form_post_data['ElementType'];
                              $ElementName= $form_post_data['ElementName'];
                              $Floor_ID= $form_post_data['Floor_ID'];
                              $Notes= $form_post_data['Notes'];
                              $Item_ID= $form_post_data['Item_ID'];
                              
                                $sql_update="UPDATE $element_detail_table set Property_ID='$Property_ID',
                                                                        ElementType ='$ElementType',
                                                                        ElementName='$ElementName',
                                                                        Floor_ID='$Floor_ID',
                                                                        Notes='$Notes',
                                                                        Item_ID='$Item_ID'
                                                                    
                                                                        WHERE ID=$data";
                                $stmt1 = $this->db->prepare($sql_update);
                               // $stmt1->execute();
                                if ($stmt1->execute()) { 
                                
                                $updateCustomer = array();
                                
                                for($j=1;$j<=3;$j++){
                                  //  print_r('hi');die;
                                foreach ($_FILES['files'.$j]['name'] as $i => $name) {
                                    //var_dump($_FILES);die;
                                        $Fvalue='files'.$j;
                                       // print_r($Fvalue);die;
                                     $uploadedFile = $util->multi_handle_file_upload_backup($Fvalue, $lastInsertedID,$i,'tender'); 
                                         
                                    if ($uploadedFile) {
                                       
                                        $updateCustomer[] = '`' . $Fvalue . '` =\'' . $uploadedFile . '\'';
                                     
                                        $filename='"' . $uploadedFile.'"'  ;
                                        $type="";
                                        
                                         if($j==2){
                                           $type="attachment";
                                        }
                                    
                                        $valStr= "'" .  $type . "'," .
                                                 "" . $filename . "," .
                                                 "'" . $data . "'";
                                                     
                                       if($filename!='' && $filename!=null){    
                                           
                                      $sql = "INSERT INTO `" . $this->crg->get('table_prefix') . "element_attachments` (". " `attribute_name`, `document_path`,`Element_ID`) VALUES ( $valStr )";
                                        $stmt = $this->db->prepare($sql);
                                        $stmt->execute();
                                        
                                        }
                                       
                                    }
                                                 
                                 }
                                }
                                                            
                                                     }
                                
                                $this->tpl->set('message', 'Element form edited successfully!');   
                                                                                                                              
                                // $this->tpl->set('label', 'List');
                                // $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                                header('Location:' . $this->crg->get('route')['base_path'] . '/property/cst/element');
                                } catch (Exception $exc) {
                                 //edit failed option
                                $this->tpl->set('message', 'Failed to edit, try again!');
                                $this->tpl->set('FmData', $form_post_data);
                                $this->tpl->set('content', $this->tpl->fetch('factory/form/element_design_form.php'));
                                }
    
                        break;
    
                    case 'addsubmit':
                         if (isset($crud_string)) {
     
                            $form_post_data = $dbutil->arrFltr($_POST);

                            include_once 'util/genUtil.php';
                            $util = new GenUtil();
                            
                          // var_dump($_POST);
                         
                           
                           if (isset($form_post_data['ElementType'])) {
                               
                                            $val = "'" . $form_post_data['Property_ID'] . "'," .
                                             "'" . $form_post_data['ElementType'] . "'," .
                                             "'" . $form_post_data['ElementName'] . "'," .
                                             "'" . $form_post_data['Floor_ID'] . "'," .
                                             "'" . $form_post_data['Notes'] . "'," .
                                             "'" . $form_post_data['Item_ID'] . "'," .
                                             "'" . $form_post_data['Profile_image'] . "'," .
                                             "'" . $form_post_data['FileUpload'] . "'," .
                                                  "'" .  $this->ses->get('user')['entity_ID'] . "'," .
                                             "'" .  $this->ses->get('user')['ID'] . "'";
    
                                 $sql = "INSERT INTO `" . $this->crg->get('table_prefix') . "element_detail`
                                                (
                                                `Property_ID`, 
                                                `ElementType`, 
                                                `ElementName`,
                                                `Floor_ID`,
                                                `Notes`, 
                                                `Item_ID`, 
                                                `Profile_image`,
                                                `FileUpload`,
                                                `entity_ID`,
                                                `users_ID`
                                                ) 
                                             VALUES ( $val )";
                                      $stmt = $this->db->prepare($sql);
                                     // $stmt->execute();
                                     $lastInsertedID = $this->db->lastInsertId();
                                     if ($stmt->execute()) { 
                                        $lastInsertedID = $this->db->lastInsertId();

                                        //handle file upload and update staff table    
                                        //  $updatecustomer = array();
                                        
                                          foreach ($_FILES as $Fvalue => $valueNotUsing) {
                                            $uploadedFile = $util->handle_file_upload($Fvalue, $ID);
                                
                                            if ($uploadedFile) {
                                                // $updatecustomer = '`' . $Fvalue . '` =\'' . $uploadedFile . '\''; // <-- Issue 4: This line overwrites the previous value
                                                $updatecustomer .= '`' . $Fvalue . '` =\'' . $uploadedFile . '\','; // <-- Issue 5: Use concatenation to update multiple file fields
                                            }
                                        }
                                
                                        // Remove the trailing comma from $updatecustomer
                                        $updatecustomer = rtrim($updatecustomer, ',');
                                
                                        $updateSql = "UPDATE `" . $this->crg->get('table_prefix') . "element_detail`
                                                        SET " . $updatecustomer . "
                                                        WHERE ID = '" . $lastInsertedID . "'";
                                        $stmt2 = $this->db->prepare($updateSql);
                                       // $stmt2->execute();
                                       if($stmt2->execute()){
                                           
                                    
                                    $updateCustomer = array();
                                    
                                    for($j=1;$j<=3;$j++){
                                      //  print_r('hi');die;
                                    foreach ($_FILES['files'.$j]['name'] as $i => $name) {
                                      //  var_dump($_FILES);die;
                                            $Fvalue='files'.$j;
                                           // print_r($Fvalue);die;
                                         $uploadedFile = $util->multi_handle_file_upload_backup($Fvalue, $lastInsertedID,$i,'tender'); 
                                             
                                        if ($uploadedFile) {
                                           
                                            $updateCustomer[] = '`' . $Fvalue . '` =\'' . $uploadedFile . '\'';
                                         
                                            $filename='"' . $uploadedFile.'"'  ;
                                            $type="";
                                            
                                             if($j==2){
                                               $type="attachment";
                                            }
                                        
                                            $valStr= "'" .  $type . "'," .
                                                     "" . $filename . "," .
                                                     "'" . $lastInsertedID . "'";
                                                         
                                           if($filename!='' && $filename!=null){    
                                               
                                            $sql = "INSERT INTO `" . $this->crg->get('table_prefix') . "element_attachments` (". " `attribute_name`, `document_path`,`Element_ID`) VALUES ( $valStr )";
                                            $stmt = $this->db->prepare($sql);
                                            $stmt->execute();
                                            
                                            }
                                           
                                        }
                                                     
                                     }
                                    }
                                       }
                                                
                                         }
                                      
                            }
                       
                            $this->tpl->set('mode', 'add');
                            $this->tpl->set('message', '- Success -');
                            // $this->tpl->set('content', $this->tpl->fetch('factory/form/salary_form.php'));
                            header('Location:' . $this->crg->get('route')['base_path'] . '/property/cst/element');
                                                                                                            
                         } else {
                                //edit option
                                //if submit failed to insert form
                                $this->tpl->set('message', 'Failed to submit!');
                                $this->tpl->set('FmData', $form_post_data);
                                $this->tpl->set('content', $this->tpl->fetch('factory/form/element_design_form.php'));
                         }
                        break;
                    case 'add':
                        $this->tpl->set('mode', 'add');
                        $this->tpl->set('page_header', 'Elements');
                        $this->tpl->set('content', $this->tpl->fetch('factory/form/element_design_form.php'));
                        break;
    
                    default:
                        /*
                         * List form
                         */
                         
                        ////////////////////start//////////////////////////////////////////////
                        
               //bUILD SQL 
                $whereString = '';
             $colArr = array(
                    "$element_detail_table.ID",
                    "$property_table.PropertyName",
                    "$element_detail_table.ElementType",
                    "$element_detail_table.ElementName",
                    "$property_table.NoOfFloor",
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
                 $whereString ="ORDER BY $element_detail_table.ID DESC";
               }
               
                  
           $sql = "SELECT " 
                        . implode(',',$colArr)
                        . " FROM $element_detail_table,$property_table,$item_table  "
                        . " WHERE "
                        . " $property_table.ID = $element_detail_table.Property_ID AND" 
                        . " $item_table.ID = $element_detail_table.Item_ID AND" 
                        . " $element_detail_table.entity_ID = $entityID" 
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
             
             
             
                $this->tpl->set('table_columns_label_arr', array('ID','Property Name','Element Type','Element Name','Floor','Item Name'));
                
                /*
                 * selectColArr for filter form
                 */
                
                $this->tpl->set('selectColArr',$colArr);
                            
                /*
                 * set pagination template
                 */
                $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');
                       
                //////////////////////close//////////////////////////////////////  
                         
                        include_once $this->tpl->path . '/factory/form/crud_element_detail_form.php';
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

            public function rooms(){
    
                if ($this->crg->get('wp') || $this->crg->get('rp')) {
                         
                        ////////////////////////////////////////////////////////////////////////////////
                        //////////////////////////////access condition applied//////////////////////////
                        ////////////////////////////////////////////////////////////////////////////////    
                                    
                        include_once 'util/DBUTIL.php';
                        $dbutil = new DBUTIL($this->crg);
                         
                        $entityID = $this->ses->get('user')['entity_ID'];
                        $userID = $this->ses->get('user')['ID'];
                        
                        $room_detail_table = $this->crg->get('table_prefix') . 'room_detail';
                        $property_table = $this->crg->get('table_prefix') . 'property';
                        $item_table = $this->crg->get('table_prefix') . 'item_master';
            
                        $property_sql = "SELECT ID,PropertyName,NoOfFloor FROM $property_table";
                        $stmt = $this->db->prepare($property_sql);            
                        $stmt->execute();
                        $property_data  = $stmt->fetchAll();	
                        $this->tpl->set('property_data', $property_data);
                        
                        $this->tpl->set('page_title', 'Rooms');	          
                        $this->tpl->set('page_header', 'Rooms');
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
                                 
                                 $sqldetdelete="Delete from $room_detail_table
                                                    where $room_detail_table.ID=$data"; 
                                    $stmt = $this->db->prepare($sqldetdelete);            
                                    
                                    if($stmt->execute()){
                                    $this->tpl->set('message', 'Rooms form deleted successfully');
                                                                                                                                  
                                    //$this->tpl->set('label', 'List');
                                    //$this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                                    header('Location:' . $this->crg->get('route')['base_path'] . '/property/cst/rooms');
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
                                           FROM $room_detail_table 
                                           WHERE 
                                           $room_detail_table.ID = $data";   
                                $room_data = $dbutil->getSqlData($sqlsrr);
                               
                            
                                //edit option     
                                $this->tpl->set('message', 'You can view Rooms form');
                                $this->tpl->set('page_header', 'Rooms');
                                $this->tpl->set('FmData', $room_data); 
                                
                                $this->tpl->set('content', $this->tpl->fetch('factory/form/room_design_form.php'));                    
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
                                       FROM $room_detail_table 
                                       WHERE 
                                       $room_detail_table.ID = $data";   
                            $room_data = $dbutil->getSqlData($sqlsrr);
                               
                                
                                //edit option 
            
                                
                                $this->tpl->set('message', 'You can edit Rooms form');
                                $this->tpl->set('page_header', 'Rooms');
                                $this->tpl->set('FmData', $room_data); 
                                
                                $this->tpl->set('content', $this->tpl->fetch('factory/form/room_design_form.php'));                    
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
                                      $Property_ID= $form_post_data['Property_ID'];
                                      $Floor_ID= $form_post_data['Floor_ID'];
                                      $RoomNo= $form_post_data['RoomNo'];
                                      $Tags= $form_post_data['Tags'];
                                      $LivingArea= $form_post_data['LivingArea'];
                                      
                                        $sql_update="UPDATE $room_detail_table set Property_ID='$Property_ID',
                                                                                   Floor_ID ='$Floor_ID',
                                                                                   RoomNo='$RoomNo',
                                                                                   Tags='$Tags',
                                                                                   LivingArea='$LivingArea'
                                                                            
                                                                                   WHERE ID=$data";
                                        $stmt1 = $this->db->prepare($sql_update);
                                        $stmt1->execute();
                                        
                                        $this->tpl->set('message', 'Rooms form edited successfully!');   
                                                                                                                                      
                                        // $this->tpl->set('label', 'List');
                                        // $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                                        header('Location:' . $this->crg->get('route')['base_path'] . '/property/cst/rooms');
                                        } catch (Exception $exc) {
                                         //edit failed option
                                        $this->tpl->set('message', 'Failed to edit, try again!');
                                        $this->tpl->set('FmData', $form_post_data);
                                        $this->tpl->set('content', $this->tpl->fetch('factory/form/room_design_form.php'));
                                        }
            
                                break;
            
                            case 'addsubmit':
                                 if (isset($crud_string)) {
             
                                    $form_post_data = $dbutil->arrFltr($_POST);
        
                                    include_once 'util/genUtil.php';
                                    $util = new GenUtil();
                                    
                                  // var_dump($_POST);
                                 
                                   
                                   if (isset($form_post_data['Property_ID'])) {
                                       
                                                    $val = "'" . $form_post_data['Property_ID'] . "'," .
                                                     "'" . $form_post_data['Floor_ID'] . "'," .
                                                     "'" . $form_post_data['RoomNo'] . "'," .
                                                     "'" . $form_post_data['Tags'] . "'," .
                                                     "'" . $form_post_data['LivingArea'] . "'," .
                                                          "'" .  $this->ses->get('user')['entity_ID'] . "'," .
                                                     "'" .  $this->ses->get('user')['ID'] . "'";
            
                                         $sql = "INSERT INTO `" . $this->crg->get('table_prefix') . "room_detail`
                                                        (
                                                        `Property_ID`, 
                                                        `Floor_ID`,
                                                        `RoomNo`, 
                                                        `Tags`, 
                                                        `LivingArea`,
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
                                    header('Location:' . $this->crg->get('route')['base_path'] . '/property/cst/rooms');
                                                                                                                    
                                 } else {
                                        //edit option
                                        //if submit failed to insert form
                                        $this->tpl->set('message', 'Failed to submit!');
                                        $this->tpl->set('FmData', $form_post_data);
                                        $this->tpl->set('content', $this->tpl->fetch('factory/form/room_design_form.php'));
                                 }
                                break;
                            case 'add':
                                $this->tpl->set('mode', 'add');
                                $this->tpl->set('page_header', 'Rooms');
                                $this->tpl->set('content', $this->tpl->fetch('factory/form/room_design_form.php'));
                                break;
            
                            default:
                                /*
                                 * List form
                                 */
                                 
                                ////////////////////start//////////////////////////////////////////////
                                
                       //bUILD SQL 
                        $whereString = '';
                     $colArr = array(
                            "$room_detail_table.ID",
                            "$property_table.PropertyName",
                            "$property_table.NoOfFloor",
                            "$room_detail_table.RoomNo",
                            "$room_detail_table.Tags",
                            "$room_detail_table.LivingArea"
            
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
                         $whereString ="ORDER BY $room_detail_table.ID DESC";
                       }
                       
                          
                   $sql = "SELECT " 
                                . implode(',',$colArr)
                                . " FROM $room_detail_table,$property_table  "
                                . " WHERE "
                                . " $property_table.ID = $room_detail_table.Property_ID AND" 
                                . " $room_detail_table.entity_ID = $entityID" 
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
                     
                     
                     
                        $this->tpl->set('table_columns_label_arr', array('ID','Property Name','Floor','Room No','Tag Name','Living Area'));
                        
                        /*
                         * selectColArr for filter form
                         */
                        
                        $this->tpl->set('selectColArr',$colArr);
                                    
                        /*
                         * set pagination template
                         */
                        $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');
                               
                        //////////////////////close//////////////////////////////////////  
                                 
                                include_once $this->tpl->path . '/factory/form/crud_room_detail_form.php';
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

                public function template(){
    
                    if ($this->crg->get('wp') || $this->crg->get('rp')) {
                             
                            ////////////////////////////////////////////////////////////////////////////////
                            //////////////////////////////access condition applied//////////////////////////
                            ////////////////////////////////////////////////////////////////////////////////    
                                        
                            include_once 'util/DBUTIL.php';
                            $dbutil = new DBUTIL($this->crg);
                             
                            $entityID = $this->ses->get('user')['entity_ID'];
                            $userID = $this->ses->get('user')['ID'];
                            
                            $template_table = $this->crg->get('table_prefix') . 'template';
                            $department_table = $this->crg->get('table_prefix') . 'department';
                            $tasktag_table = $this->crg->get('table_prefix') . 'tasktag';
                
                            $dept_sql = "SELECT ID,DeptName FROM $department_table";
                            $stmt = $this->db->prepare($dept_sql);            
                            $stmt->execute();
                            $dept_data  = $stmt->fetchAll();	
                            $this->tpl->set('dept_data', $dept_data);

                            $task_sql = "SELECT ID,TaskTag FROM $tasktag_table";
                            $stmt = $this->db->prepare($task_sql);            
                            $stmt->execute();
                            $task_data  = $stmt->fetchAll();	
                            $this->tpl->set('task_data', $task_data);

                            $progress_data = array(array("ID"=>"1","Title"=>"Cleaned"),array("ID"=>"2","Title"=>"Inprogressed"));
                            $this->tpl->set('progress_data', $progress_data);
                            
                            $this->tpl->set('page_title', 'Template');	          
                            $this->tpl->set('page_header', 'Template');
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
                                     
                                     $sqldetdelete="Delete from $template_table
                                                        where $template_table.ID=$data"; 
                                        $stmt = $this->db->prepare($sqldetdelete);            
                                        
                                        if($stmt->execute()){
                                        $this->tpl->set('message', 'Template form deleted successfully');
                                                                                                                                      
                                        //$this->tpl->set('label', 'List');
                                        //$this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                                        header('Location:' . $this->crg->get('route')['base_path'] . '/property/cst/template');
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
                                               FROM $template_table 
                                               WHERE 
                                               $template_table.ID = $data";   
                                    $template_data = $dbutil->getSqlData($sqlsrr);
                                   
                                    //edit option     
                                    $this->tpl->set('message', 'You can view Template form');
                                    $this->tpl->set('page_header', 'Template');
                                    $this->tpl->set('FmData', $template_data); 
                                    
                                    $this->tpl->set('content', $this->tpl->fetch('factory/form/template_design_form.php'));                    
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
                                           FROM $template_table 
                                           WHERE 
                                           $template_table.ID = $data";   
                                $template_data = $dbutil->getSqlData($sqlsrr);
                                   
                                    
                                    //edit option 
                
                                    
                                    $this->tpl->set('message', 'You can edit Template form');
                                    $this->tpl->set('page_header', 'Template');
                                    $this->tpl->set('FmData', $template_data); 
                                    
                                    $this->tpl->set('content', $this->tpl->fetch('factory/form/template_design_form.php'));                    
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
                                          $Department_ID= $form_post_data['Department_ID'];
                                          $TemplateTitle= $form_post_data['TemplateTitle'];
                                          $TemplateDescription= $form_post_data['TemplateDescription'];
                                          $TaskTags= $form_post_data['TaskTags'];
                                          $ProgressStatus= $form_post_data['ProgressStatus'];
                                          $SectionName= $form_post_data['SectionName'];
                                          
                                            $sql_update="UPDATE $template_table set Department_ID='$Department_ID',
                                                                                       TemplateTitle ='$TemplateTitle',
                                                                                       TemplateDescription='$TemplateDescription',
                                                                                       TaskTags='$TaskTags',
                                                                                       ProgressStatus='$ProgressStatus',
                                                                                       SectionName='$SectionName'
                                                                                
                                                                                       WHERE ID=$data";
                                            $stmt1 = $this->db->prepare($sql_update);
                                            $stmt1->execute();
                                            
                                            $this->tpl->set('message', 'Template form edited successfully!');   
                                                                                                                                          
                                            // $this->tpl->set('label', 'List');
                                            // $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                                            header('Location:' . $this->crg->get('route')['base_path'] . '/property/cst/template');
                                            } catch (Exception $exc) {
                                             //edit failed option
                                            $this->tpl->set('message', 'Failed to edit, try again!');
                                            $this->tpl->set('FmData', $form_post_data);
                                            $this->tpl->set('content', $this->tpl->fetch('factory/form/template_design_form.php'));
                                            }
                
                                    break;
                
                                case 'addsubmit':
                                     if (isset($crud_string)) {
                 
                                        $form_post_data = $dbutil->arrFltr($_POST);
            
                                        include_once 'util/genUtil.php';
                                        $util = new GenUtil();
                                        
                                      // var_dump($_POST);
                                     
                                       
                                       if (isset($form_post_data['Department_ID'])) {
                                           
                                                        $val = "'" . $form_post_data['Department_ID'] . "'," .
                                                         "'" . $form_post_data['TemplateTitle'] . "'," .
                                                         "'" . $form_post_data['TemplateDescription'] . "'," .
                                                         "'" . $form_post_data['TaskTags'] . "'," .
                                                         "'" . $form_post_data['ProgressStatus'] . "'," .
                                                         "'" . $form_post_data['SectionName'] . "'," .
                                                              "'" .  $this->ses->get('user')['entity_ID'] . "'," .
                                                         "'" .  $this->ses->get('user')['ID'] . "'";
                
                                             $sql = "INSERT INTO `" . $this->crg->get('table_prefix') . "template`
                                                            (
                                                            `Department_ID`, 
                                                            `TemplateTitle`,
                                                            `TemplateDescription`, 
                                                            `TaskTags`, 
                                                            `ProgressStatus`,
                                                            `SectionName`,
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
                                        header('Location:' . $this->crg->get('route')['base_path'] . '/property/cst/template');
                                                                                                                        
                                     } else {
                                            //edit option
                                            //if submit failed to insert form
                                            $this->tpl->set('message', 'Failed to submit!');
                                            $this->tpl->set('FmData', $form_post_data);
                                            $this->tpl->set('content', $this->tpl->fetch('factory/form/template_design_form.php'));
                                     }
                                    break;
                                case 'add':
                                    $this->tpl->set('mode', 'add');
                                    $this->tpl->set('page_header', 'Template');
                                    $this->tpl->set('content', $this->tpl->fetch('factory/form/template_design_form.php'));
                                    break;
                
                                default:
                                    /*
                                     * List form
                                     */
                                     
                                    ////////////////////start//////////////////////////////////////////////
                                    
                           //bUILD SQL 
                            $whereString = '';
                         $colArr = array(
                                "$template_table.ID",
                                "$department_table.DeptName",
                                "$template_table.TemplateTitle",
                                "$template_table.TemplateDescription",
                                "$tasktag_table.TaskTag",
                                "CASE WHEN $template_table.ProgressStatus=1 THEN 'Cleaned' WHEN $template_table.ProgressStatus=2 THEN 'Inprogressed' ELSE 'undefined' END as ProgressStatus"
                                
                
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
                             $whereString ="ORDER BY $template_table.ID DESC";
                           }
                           
                              
                       $sql = "SELECT " 
                                    . implode(',',$colArr)
                                    . " FROM $template_table,$department_table,$tasktag_table  "
                                    . " WHERE "
                                    . " $department_table.ID = $template_table.Department_ID AND" 
                                    . " $tasktag_table.ID = $template_table.TaskTags AND" 
                                    . " $template_table.entity_ID = $entityID" 
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
                         
                         
                         
                            $this->tpl->set('table_columns_label_arr', array('ID','Department Name','Template Title','Template Description','Tasktag Name','In-progress Status'));
                            
                            /*
                             * selectColArr for filter form
                             */
                            
                            $this->tpl->set('selectColArr',$colArr);
                                        
                            /*
                             * set pagination template
                             */
                            $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');
                                   
                            //////////////////////close//////////////////////////////////////  
                                     
                                    include_once $this->tpl->path . '/factory/form/crud_template_form.php';
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
                    
                    public function schedule(){
    
                        if ($this->crg->get('wp') || $this->crg->get('rp')) {
                                 
                                ////////////////////////////////////////////////////////////////////////////////
                                //////////////////////////////access condition applied//////////////////////////
                                ////////////////////////////////////////////////////////////////////////////////    
                                            
                                include_once 'util/DBUTIL.php';
                                $dbutil = new DBUTIL($this->crg);
                                 
                                $entityID = $this->ses->get('user')['entity_ID'];
                                $userID = $this->ses->get('user')['ID'];
                                
                                $schedule_table = $this->crg->get('table_prefix') . 'schedule_detail';
                                $property_table = $this->crg->get('table_prefix') . 'property';
                                $department_table = $this->crg->get('table_prefix') . 'department';
                                $template_table = $this->crg->get('table_prefix') . 'template';
                                $tasktag_table = $this->crg->get('table_prefix') . 'tasktag';
                                $assignee_table = $this->crg->get('table_prefix') . 'assignee';
                                $schedule_attachments_tab = $this->crg->get('table_prefix') . 'schedule_attachments';
                    
                                $dept_sql = "SELECT ID,DeptName FROM $department_table";
                                $stmt = $this->db->prepare($dept_sql);            
                                $stmt->execute();
                                $dept_data  = $stmt->fetchAll();	
                                $this->tpl->set('dept_data', $dept_data);

                                $property_sql = "SELECT ID,PropertyName FROM $property_table";
                                $stmt = $this->db->prepare($property_sql);            
                                $stmt->execute();
                                $property_data  = $stmt->fetchAll();	
                                $this->tpl->set('property_data', $property_data);

                                $template_sql = "SELECT ID,TemplateTitle FROM $template_table";
                                $stmt = $this->db->prepare($template_sql);            
                                $stmt->execute();
                                $template_data  = $stmt->fetchAll();	
                                $this->tpl->set('template_data', $template_data);
    
                                $task_sql = "SELECT ID,TaskTag FROM $tasktag_table";
                                $stmt = $this->db->prepare($task_sql);            
                                $stmt->execute();
                                $task_data  = $stmt->fetchAll();	
                                $this->tpl->set('task_data', $task_data);

                                $assignee_sql = "SELECT ID,Assignee FROM $assignee_table";
                                $stmt = $this->db->prepare($assignee_sql);            
                                $stmt->execute();
                                $assignee_data  = $stmt->fetchAll();	
                                $this->tpl->set('assignee_data', $assignee_data);
                                
                                $this->tpl->set('page_title', 'Schedule');	          
                                $this->tpl->set('page_header', 'Schedule');
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
                                         
                                        $sqlsel_del = "SELECT document_path FROM $schedule_attachments_tab WHERE schedule_ID  = '$data'";
                                        $resource_data = $dbutil->getSqlData($sqlsel_del); 
                                        
                                        if(!empty($resource_data)){
                                             foreach($resource_data as $k=>$v){
                                                          unlink(substr($v['document_path'], 2));
                                                   }
                                        }
                                         
                                         $sqldetdelete="Delete $schedule_table,$schedule_attachments_tab from $schedule_table 
                                                        LEFT JOIN  $schedule_attachments_tab ON $schedule_table.ID=$schedule_attachments_tab.schedule_ID 
                                                        where $schedule_table.ID=$data"; 
                                            $stmt = $this->db->prepare($sqldetdelete);           
                                            
                                            if($stmt->execute()){
                                            $this->tpl->set('message', 'Schedule form deleted successfully');
                                                                                                                                          
                                            //$this->tpl->set('label', 'List');
                                            //$this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                                            header('Location:' . $this->crg->get('route')['base_path'] . '/property/cst/schedule');
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
                                                   FROM $schedule_table 
                                                   WHERE 
                                                   $schedule_table.ID = $data";   
                                        $schedule_data = $dbutil->getSqlData($sqlsrr);
                                        
                                    $sql= "SELECT ID,document_path  From $schedule_attachments_tab where (schedule_ID  = '$data' AND attribute_name='attachment') ORDER BY $schedule_attachments_tab.ID ASC";            
                                    $attachemnt_data = $dbutil->getSqlData($sql);
                                    $this->tpl->set('FmDataattachment', $attachemnt_data);
                                       
                                        //edit option     
                                        $this->tpl->set('message', 'You can view Schedule form');
                                        $this->tpl->set('page_header', 'Schedule');
                                        $this->tpl->set('FmData', $schedule_data); 
                                        
                                        $this->tpl->set('content', $this->tpl->fetch('factory/form/schedule_design_form.php'));                    
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
                                               FROM $schedule_table 
                                               WHERE 
                                               $schedule_table.ID = $data";   
                                    $schedule_data = $dbutil->getSqlData($sqlsrr);
                                    
                                    $sql= "SELECT ID,document_path  From $schedule_attachments_tab where (schedule_ID  = '$data' AND attribute_name='attachment') ORDER BY $schedule_attachments_tab.ID ASC";            
                                    $attachemnt_data = $dbutil->getSqlData($sql);
                                    $this->tpl->set('FmDataattachment', $attachemnt_data);
                                       
                                        
                                        //edit option 
                    
                                        
                                        $this->tpl->set('message', 'You can edit Schedule form');
                                        $this->tpl->set('page_header', 'Schedule');
                                        $this->tpl->set('FmData', $schedule_data); 
                                        
                                        $this->tpl->set('content', $this->tpl->fetch('factory/form/schedule_design_form.php'));                    
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


                                        $ScheduleDate=date("Y-m-d", strtotime($form_post_data['ScheduleDate']));
                                                                   
                                        try{
                                              $Property_ID= $form_post_data['Property_ID'];
                                              $Department_ID= $form_post_data['Department_ID'];
                                              $Template_ID= $form_post_data['Template_ID'];
                                              $TaskTitle= $form_post_data['TaskTitle'];
                                              $Description= $form_post_data['Description'];
                                              $ScheduleDate= $ScheduleDate;
                                              $EstimatedTime= $form_post_data['EstimatedTime'];
                                              $Assignees_ID= $form_post_data['Assignees_ID'];
                                              $Tasktag_ID= $form_post_data['Tasktag_ID'];
                                              
                                                $sql_update="UPDATE $schedule_table set Property_ID='$Property_ID',
                                                                                        Department_ID ='$Department_ID',
                                                                                        Template_ID='$Template_ID',
                                                                                        TaskTitle='$TaskTitle',
                                                                                        Description='$Description',
                                                                                        ScheduleDate='$ScheduleDate',
                                                                                        EstimatedTime='$EstimatedTime',
                                                                                        Assignees_ID='$Assignees_ID',
                                                                                        Tasktag_ID='$Tasktag_ID'
                                                                                    
                                                                                        WHERE ID=$data";
                                                $stmt1 = $this->db->prepare($sql_update);
                                               // $stmt1->execute();
                                               if ($stmt1->execute()) { 
                                
                                $updateCustomer = array();
                                
                                for($j=1;$j<=3;$j++){
                                  //  print_r('hi');die;
                                foreach ($_FILES['files'.$j]['name'] as $i => $name) {
                                        $Fvalue='files'.$j;
                                       // print_r($Fvalue);die;
                                     $uploadedFile = $util->multi_handle_file_upload_backup($Fvalue, $lastInsertedID,$i,'tender'); 
                                         
                                    if ($uploadedFile) {
                                       
                                        $updateCustomer[] = '`' . $Fvalue . '` =\'' . $uploadedFile . '\'';
                                     
                                        $filename='"' . $uploadedFile.'"'  ;
                                        $type="";
                                        
                                         if($j==2){
                                           $type="attachment";
                                        }
                                    
                                        $valStr= "'" .  $type . "'," .
                                                 "" . $filename . "," .
                                                 "'" . $data . "'";
                                                     
                                       if($filename!='' && $filename!=null){    
                                           
                                      $sql = "INSERT INTO `" . $this->crg->get('table_prefix') . "schedule_attachments` (". " `attribute_name`, `document_path`,`schedule_ID`) VALUES ( $valStr )";
                                        $stmt = $this->db->prepare($sql);
                                        $stmt->execute();
                                        
                                        }
                                       
                                    }
                                                 
                                 }
                                }
                                                            
                                                     }
                                                
                                                $this->tpl->set('message', 'Schedule form edited successfully!');   
                                                                                                                                              
                                                // $this->tpl->set('label', 'List');
                                                // $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                                                header('Location:' . $this->crg->get('route')['base_path'] . '/property/cst/schedule');
                                                } catch (Exception $exc) {
                                                 //edit failed option
                                                $this->tpl->set('message', 'Failed to edit, try again!');
                                                $this->tpl->set('FmData', $form_post_data);
                                                $this->tpl->set('content', $this->tpl->fetch('factory/form/schedule_design_form.php'));
                                                }
                    
                                        break;
                    
                                    case 'addsubmit':
                                         if (isset($crud_string)) {
                     
                                            $form_post_data = $dbutil->arrFltr($_POST);
                
                                            include_once 'util/genUtil.php';
                                            $util = new GenUtil();
                                            
                                          // var_dump($_POST);
                                         
                                          $ScheduleDate=date("Y-m-d", strtotime($form_post_data['ScheduleDate']));
                                           if (isset($form_post_data['Property_ID'])) {
                                               
                                                            $val = "'" . $form_post_data['Property_ID'] . "'," .
                                                             "'" . $form_post_data['Department_ID'] . "'," .
                                                             "'" . $form_post_data['Template_ID'] . "'," .
                                                             "'" . $form_post_data['TaskTitle'] . "'," .
                                                             "'" . $form_post_data['Description'] . "'," .
                                                             "'" . $ScheduleDate . "'," .
                                                             "'" . $form_post_data['EstimatedTime'] . "'," .
                                                             "'" . $form_post_data['Assignees_ID'] . "'," .
                                                             "'" . $form_post_data['FileUpload'] . "'," .
                                                             "'" . $form_post_data['Tasktag_ID'] . "'," .
                                                                  "'" .  $this->ses->get('user')['entity_ID'] . "'," .
                                                             "'" .  $this->ses->get('user')['ID'] . "'";
                    
                                                 $sql = "INSERT INTO `" . $this->crg->get('table_prefix') . "schedule_detail`
                                                                (
                                                                `Property_ID`, 
                                                                `Department_ID`,
                                                                `Template_ID`, 
                                                                `TaskTitle`, 
                                                                `Description`,
                                                                `ScheduleDate`,
                                                                `EstimatedTime`,
                                                                `Assignees_ID`, 
                                                                `FileUpload`, 
                                                                `Tasktag_ID`,
                                                                `entity_ID`,
                                                                `users_ID`
                                                                ) 
                                                             VALUES ( $val )";
                                                      $stmt = $this->db->prepare($sql);
                                                     // $stmt->execute();
                                                     if ($stmt->execute()) { 
                                                        
                                                         $lastInsertedID = $this->db->lastInsertId();
                                    
                                    $updateCustomer = array();
                                    
                                    for($j=1;$j<=3;$j++){
                                      //  print_r('hi');die;
                                    foreach ($_FILES['files'.$j]['name'] as $i => $name) {
                                            $Fvalue='files'.$j;
                                           // print_r($Fvalue);die;
                                         $uploadedFile = $util->multi_handle_file_upload_backup($Fvalue, $lastInsertedID,$i,'tender'); 
                                             
                                        if ($uploadedFile) {
                                           
                                            $updateCustomer[] = '`' . $Fvalue . '` =\'' . $uploadedFile . '\'';
                                         
                                            $filename='"' . $uploadedFile.'"'  ;
                                            $type="";
                                            
                                             if($j==2){
                                               $type="attachment";
                                            }
                                        
                                            $valStr= "'" .  $type . "'," .
                                                     "" . $filename . "," .
                                                     "'" . $lastInsertedID . "'";
                                                         
                                           if($filename!='' && $filename!=null){    
                                               
                                            $sql = "INSERT INTO `" . $this->crg->get('table_prefix') . "schedule_attachments` (". " `attribute_name`, `document_path`,`schedule_ID`) VALUES ( $valStr )";
                                            $stmt = $this->db->prepare($sql);
                                            $stmt->execute();
                                            
                                            }
                                           
                                        }
                                                     
                                     }
                                    }
                                                                
                                                         }
                                                      
                                            }
                                       
                                            $this->tpl->set('mode', 'add');
                                            $this->tpl->set('message', '- Success -');
                                            // $this->tpl->set('content', $this->tpl->fetch('factory/form/salary_form.php'));
                                            header('Location:' . $this->crg->get('route')['base_path'] . '/property/cst/schedule');
                                                                                                                            
                                         } else {
                                                //edit option
                                                //if submit failed to insert form
                                                $this->tpl->set('message', 'Failed to submit!');
                                                $this->tpl->set('FmData', $form_post_data);
                                                $this->tpl->set('content', $this->tpl->fetch('factory/form/schedule_design_form.php'));
                                         }
                                        break;
                                    case 'add':
                                        $this->tpl->set('mode', 'add');
                                        $this->tpl->set('page_header', 'Schedule');
                                        $this->tpl->set('content', $this->tpl->fetch('factory/form/schedule_design_form.php'));
                                        break;
                    
                                    default:
                                        /*
                                         * List form
                                         */
                                         
                                        ////////////////////start//////////////////////////////////////////////
                                        
                               //bUILD SQL 
                                $whereString = '';
                             $colArr = array(
                                    "$schedule_table.ID",
                                    "$property_table.PropertyName",
                                    "$department_table.DeptName",
                                    "$template_table.TemplateTitle",
                                    "$schedule_table.TaskTitle",
                                    "$schedule_table.EstimatedTime",
                                    "$schedule_table.ScheduleDate",
                                    "$assignee_table.Assignee"
                    
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
                                 $whereString ="ORDER BY $schedule_table.ID DESC";
                               }
                               
                                  
                           $sql = "SELECT " 
                                        . implode(',',$colArr)
                                        . " FROM $schedule_table,$property_table,$department_table,$template_table,$assignee_table  "
                                        . " WHERE "
                                        . " $property_table.ID = $schedule_table.Property_ID AND" 
                                        . " $department_table.ID = $schedule_table.Department_ID AND" 
                                        . " $template_table.ID = $schedule_table.Template_ID AND" 
                                        . " $assignee_table.ID = $schedule_table.Assignees_ID AND" 
                                        . " $schedule_table.entity_ID = $entityID" 
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
                             
                             
                             
                                $this->tpl->set('table_columns_label_arr', array('ID','Property Name','Department Name','Template Name','Task Title','Estimated time','Schedule Date','Assignee Name'));
                                
                                /*
                                 * selectColArr for filter form
                                 */
                                
                                $this->tpl->set('selectColArr',$colArr);
                                            
                                /*
                                 * set pagination template
                                 */
                                $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');
                                       
                                //////////////////////close//////////////////////////////////////  
                                         
                                        include_once $this->tpl->path . '/factory/form/crud_schedule_form.php';
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

                        public function task(){
    
                            if ($this->crg->get('wp') || $this->crg->get('rp')) {
                                     
                                    ////////////////////////////////////////////////////////////////////////////////
                                    //////////////////////////////access condition applied//////////////////////////
                                    ////////////////////////////////////////////////////////////////////////////////    
                                                
                                    include_once 'util/DBUTIL.php';
                                    $dbutil = new DBUTIL($this->crg);
                                     
                                    $entityID = $this->ses->get('user')['entity_ID'];
                                    $userID = $this->ses->get('user')['ID'];
                                    
                                    $task_table = $this->crg->get('table_prefix') . 'task_detail';
                                    $property_table = $this->crg->get('table_prefix') . 'property';
                                    $department_table = $this->crg->get('table_prefix') . 'department';
                                    $template_table = $this->crg->get('table_prefix') . 'template';
                                    $tasktag_table = $this->crg->get('table_prefix') . 'tasktag';
                                    $assignee_table = $this->crg->get('table_prefix') . 'assignee';
                                    $task_attachments_tab = $this->crg->get('table_prefix') . 'task_attachments';
                        
                                    $dept_sql = "SELECT ID,DeptName FROM $department_table";
                                    $stmt = $this->db->prepare($dept_sql);            
                                    $stmt->execute();
                                    $dept_data  = $stmt->fetchAll();	
                                    $this->tpl->set('dept_data', $dept_data);
    
                                    $property_sql = "SELECT ID,PropertyName FROM $property_table";
                                    $stmt = $this->db->prepare($property_sql);            
                                    $stmt->execute();
                                    $property_data  = $stmt->fetchAll();	
                                    $this->tpl->set('property_data', $property_data);
    
                                    $template_sql = "SELECT ID,TemplateTitle FROM $template_table";
                                    $stmt = $this->db->prepare($template_sql);            
                                    $stmt->execute();
                                    $template_data  = $stmt->fetchAll();	
                                    $this->tpl->set('template_data', $template_data);
        
                                    $task_sql = "SELECT ID,TaskTag FROM $tasktag_table";
                                    $stmt = $this->db->prepare($task_sql);            
                                    $stmt->execute();
                                    $task_data  = $stmt->fetchAll();	
                                    $this->tpl->set('task_data', $task_data);
    
                                    $assignee_sql = "SELECT ID,Assignee FROM $assignee_table";
                                    $stmt = $this->db->prepare($assignee_sql);            
                                    $stmt->execute();
                                    $assignee_data  = $stmt->fetchAll();	
                                    $this->tpl->set('assignee_data', $assignee_data);
                                    
                                    $this->tpl->set('page_title', 'Task');	          
                                    $this->tpl->set('page_header', 'Task');
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
                                             
                                             $sqlsel_del = "SELECT document_path FROM $task_attachments_tab WHERE task_ID  = '$data'";
                                             $resource_data = $dbutil->getSqlData($sqlsel_del); 
                                        
                                             if(!empty($resource_data)){
                                                foreach($resource_data as $k=>$v){
                                                          unlink(substr($v['document_path'], 2));
                                                   }
                                              }
                                         
                                            $sqldetdelete="Delete $task_table,$task_attachments_tab from $task_table 
                                                        LEFT JOIN  $task_attachments_tab ON $task_table.ID=$task_attachments_tab.task_ID 
                                                        where $task_table.ID=$data"; 
                                            $stmt = $this->db->prepare($sqldetdelete);            
                                                
                                                if($stmt->execute()){
                                                $this->tpl->set('message', 'Task form deleted successfully');
                                                                                                                                              
                                                //$this->tpl->set('label', 'List');
                                                //$this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                                                header('Location:' . $this->crg->get('route')['base_path'] . '/property/cst/task');
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
                                                       FROM $task_table 
                                                       WHERE 
                                                       $task_table.ID = $data";   
                                            $task_data = $dbutil->getSqlData($sqlsrr);
                                            
                                            $sql= "SELECT ID,document_path  From $task_attachments_tab where (task_ID  = '$data' AND attribute_name='attachment') ORDER BY $task_attachments_tab.ID ASC";            
                                            $attachemnt_data = $dbutil->getSqlData($sql);
                                            $this->tpl->set('FmDataattachment', $attachemnt_data);
                                           
                                            //edit option     
                                            $this->tpl->set('message', 'You can view Task form');
                                            $this->tpl->set('page_header', 'Task');
                                            $this->tpl->set('FmData', $task_data); 
                                            
                                            $this->tpl->set('content', $this->tpl->fetch('factory/form/task_design_form.php'));                    
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
                                                       FROM $task_table 
                                                       WHERE 
                                                       $task_table.ID = $data";   
                                            $task_data = $dbutil->getSqlData($sqlsrr);
                                            
                                    $sql= "SELECT ID,document_path  From $task_attachments_tab where (task_ID  = '$data' AND attribute_name='attachment') ORDER BY $task_attachments_tab.ID ASC";            
                                    $attachemnt_data = $dbutil->getSqlData($sql);
                                    $this->tpl->set('FmDataattachment', $attachemnt_data);
                                           
                                            
                                            //edit option 
                        
                                            
                                            $this->tpl->set('message', 'You can edit Task form');
                                            $this->tpl->set('page_header', 'Task');
                                            $this->tpl->set('FmData', $task_data); 
                                            
                                            $this->tpl->set('content', $this->tpl->fetch('factory/form/task_design_form.php'));                    
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
    
                                            //handle file upload and update staff table    
                                            // $updatecustomer = array();
                            
                                            foreach ($_FILES as $Fvalue => $valueNotUsing) {
    
                                                   $uploadedFile = $util->handle_file_upload($Fvalue, $ID);
       
                                            if ($uploadedFile) {
                                        
                                                   $updatecustomer = '`' . $Fvalue . '` =\'' . $uploadedFile . '\'';
                                                 }
                                              }
                               
                                           $updateSql = "UPDATE `" . $this->crg->get('table_prefix') . "task_detail` SET " . $updatecustomer .
                                                        " WHERE ID = " .$data . "";
     
                                           $stmt = $this->db->prepare($updateSql);
                                           $stmt->execute(); 
    
                                                                       
                                            try{
                                                  $Property_ID= $form_post_data['Property_ID'];
                                                  $Department_ID= $form_post_data['Department_ID'];
                                                  $Template_ID= $form_post_data['Template_ID'];
                                                  $TaskTitle= $form_post_data['TaskTitle'];
                                                  $Description= $form_post_data['Description'];
                                                  $EstimatedTime= $form_post_data['EstimatedTime'];
                                                  $Assignees_ID= $form_post_data['Assignees_ID'];
                                                  $Tasktag_ID= $form_post_data['Tasktag_ID'];
                                                  
                                                    $sql_update="UPDATE $task_table set Property_ID='$Property_ID',
                                                                                            Department_ID ='$Department_ID',
                                                                                            Template_ID='$Template_ID',
                                                                                            TaskTitle='$TaskTitle',
                                                                                            Description='$Description',
                                                                                            EstimatedTime='$EstimatedTime',
                                                                                            Assignees_ID='$Assignees_ID',
                                                                                            Tasktag_ID='$Tasktag_ID'
                                                                                        
                                                                                            WHERE ID=$data";
                                                    $stmt1 = $this->db->prepare($sql_update);
                                                   // $stmt1->execute();
                                                    if ($stmt1->execute()) { 
                                
                                $updateCustomer = array();
                                
                                for($j=1;$j<=3;$j++){
                                  //  print_r('hi');die;
                                foreach ($_FILES['files'.$j]['name'] as $i => $name) {
                                    //var_dump($_FILES);die;
                                        $Fvalue='files'.$j;
                                       // print_r($Fvalue);die;
                                     $uploadedFile = $util->multi_handle_file_upload_backup($Fvalue, $lastInsertedID,$i,'tender'); 
                                         
                                    if ($uploadedFile) {
                                       
                                        $updateCustomer[] = '`' . $Fvalue . '` =\'' . $uploadedFile . '\'';
                                     
                                        $filename='"' . $uploadedFile.'"'  ;
                                        $type="";
                                        
                                         if($j==2){
                                           $type="attachment";
                                        }
                                    
                                        $valStr= "'" .  $type . "'," .
                                                 "" . $filename . "," .
                                                 "'" . $data . "'";
                                                     
                                       if($filename!='' && $filename!=null){    
                                           
                                      $sql = "INSERT INTO `" . $this->crg->get('table_prefix') . "task_attachments` (". " `attribute_name`, `document_path`,`task_ID`) VALUES ( $valStr )";
                                        $stmt = $this->db->prepare($sql);
                                        $stmt->execute();
                                        
                                        }
                                       
                                    }
                                                 
                                 }
                                }
                                                            
                                                     }
                                                    
                                                    $this->tpl->set('message', 'Task form edited successfully!');   
                                                                                                                                                  
                                                    // $this->tpl->set('label', 'List');
                                                    // $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                                                    header('Location:' . $this->crg->get('route')['base_path'] . '/property/cst/task');
                                                    } catch (Exception $exc) {
                                                     //edit failed option
                                                    $this->tpl->set('message', 'Failed to edit, try again!');
                                                    $this->tpl->set('FmData', $form_post_data);
                                                    $this->tpl->set('content', $this->tpl->fetch('factory/form/task_design_form.php'));
                                                    }
                        
                                            break;
                        
                                        case 'addsubmit':
                                             if (isset($crud_string)) {
                         
                                                $form_post_data = $dbutil->arrFltr($_POST);
                    
                                                include_once 'util/genUtil.php';
                                                $util = new GenUtil();
                                                
                                              // var_dump($_POST);
                                             
                                               if (isset($form_post_data['Property_ID'])) {
                                                   
                                                                $val = "'" . $form_post_data['Property_ID'] . "'," .
                                                                 "'" . $form_post_data['Department_ID'] . "'," .
                                                                 "'" . $form_post_data['Template_ID'] . "'," .
                                                                 "'" . $form_post_data['TaskTitle'] . "'," .
                                                                 "'" . $form_post_data['Description'] . "'," .
                                                                 "'" . $form_post_data['EstimatedTime'] . "'," .
                                                                 "'" . $form_post_data['Assignees_ID'] . "'," .
                                                                 "'" . $form_post_data['FileUpload'] . "'," .
                                                                 "'" . $form_post_data['Tasktag_ID'] . "'," .
                                                                      "'" .  $this->ses->get('user')['entity_ID'] . "'," .
                                                                 "'" .  $this->ses->get('user')['ID'] . "'";
                        
                                                     $sql = "INSERT INTO `" . $this->crg->get('table_prefix') . "task_detail`
                                                                    (
                                                                    `Property_ID`, 
                                                                    `Department_ID`,
                                                                    `Template_ID`, 
                                                                    `TaskTitle`, 
                                                                    `Description`,
                                                                    `EstimatedTime`,
                                                                    `Assignees_ID`, 
                                                                    `FileUpload`, 
                                                                    `Tasktag_ID`,
                                                                    `entity_ID`,
                                                                    `users_ID`
                                                                    ) 
                                                                 VALUES ( $val )";
                                                          $stmt = $this->db->prepare($sql);
                                                         // $stmt->execute();
                                                         if ($stmt->execute()) { 
                                                            $lastInsertedID = $this->db->lastInsertId();
                                    
                                    $updateCustomer = array();
                                    
                                    for($j=1;$j<=3;$j++){
                                      //  print_r('hi');die;
                                    foreach ($_FILES['files'.$j]['name'] as $i => $name) {
                                      //  var_dump($_FILES);die;
                                            $Fvalue='files'.$j;
                                           // print_r($Fvalue);die;
                                         $uploadedFile = $util->multi_handle_file_upload_backup($Fvalue, $lastInsertedID,$i,'tender'); 
                                             
                                        if ($uploadedFile) {
                                           
                                            $updateCustomer[] = '`' . $Fvalue . '` =\'' . $uploadedFile . '\'';
                                         
                                            $filename='"' . $uploadedFile.'"'  ;
                                            $type="";
                                            
                                             if($j==2){
                                               $type="attachment";
                                            }
                                        
                                            $valStr= "'" .  $type . "'," .
                                                     "" . $filename . "," .
                                                     "'" . $lastInsertedID . "'";
                                                         
                                           if($filename!='' && $filename!=null){    
                                               
                                          $sql = "INSERT INTO `" . $this->crg->get('table_prefix') . "task_attachments` (". " `attribute_name`, `document_path`,`task_ID`) VALUES ( $valStr )";
                                            $stmt = $this->db->prepare($sql);
                                            $stmt->execute();
                                            
                                            }
                                           
                                        }
                                                     
                                     }
                                    }
                                                                    
                                                             }
                                                          
                                                }
                                           
                                                $this->tpl->set('mode', 'add');
                                                $this->tpl->set('message', '- Success -');
                                                // $this->tpl->set('content', $this->tpl->fetch('factory/form/salary_form.php'));
                                                header('Location:' . $this->crg->get('route')['base_path'] . '/property/cst/task');
                                                                                                                                
                                             } else {
                                                    //edit option
                                                    //if submit failed to insert form
                                                    $this->tpl->set('message', 'Failed to submit!');
                                                    $this->tpl->set('FmData', $form_post_data);
                                                    $this->tpl->set('content', $this->tpl->fetch('factory/form/task_design_form.php'));
                                             }
                                            break;
                                        case 'add':
                                            $this->tpl->set('mode', 'add');
                                            $this->tpl->set('page_header', 'Task');
                                            $this->tpl->set('content', $this->tpl->fetch('factory/form/task_design_form.php'));
                                            break;
                        
                                        default:
                                            /*
                                             * List form
                                             */
                                             
                                            ////////////////////start//////////////////////////////////////////////
                                            
                                   //bUILD SQL 
                                    $whereString = '';
                                 $colArr = array(
                                        "$task_table.ID",
                                        "$property_table.PropertyName",
                                        "$department_table.DeptName",
                                        "$template_table.TemplateTitle",
                                        "$task_table.TaskTitle",
                                        "$task_table.EstimatedTime",
                                        "$assignee_table.Assignee"
                        
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
                                     $whereString ="ORDER BY $task_table.ID DESC";
                                   }
                                   
                                      
                               $sql = "SELECT " 
                                            . implode(',',$colArr)
                                            . " FROM $task_table,$property_table,$department_table,$template_table,$assignee_table "
                                            . " WHERE "
                                            . " $property_table.ID = $task_table.Property_ID AND" 
                                            . " $department_table.ID = $task_table.Department_ID AND" 
                                            . " $template_table.ID = $task_table.Template_ID AND" 
                                            . " $assignee_table.ID = $task_table.Assignees_ID AND" 
                                            . " $task_table.entity_ID = $entityID" 
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
                                 
                                 
                                 
                                    $this->tpl->set('table_columns_label_arr', array('ID','Property Name','Department Name','Template Name','Task Title','Estimated time','Assignee Name'));
                                    
                                    /*
                                     * selectColArr for filter form
                                     */
                                    
                                    $this->tpl->set('selectColArr',$colArr);
                                                
                                    /*
                                     * set pagination template
                                     */
                                    $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');
                                           
                                    //////////////////////close//////////////////////////////////////  
                                             
                                            include_once $this->tpl->path . '/factory/form/crud_task_form.php';
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

                            public function issue(){
    
                                if ($this->crg->get('wp') || $this->crg->get('rp')) {
                                         
                                        ////////////////////////////////////////////////////////////////////////////////
                                        //////////////////////////////access condition applied//////////////////////////
                                        ////////////////////////////////////////////////////////////////////////////////    
                                                    
                                        include_once 'util/DBUTIL.php';
                                        $dbutil = new DBUTIL($this->crg);
                                         
                                        $entityID = $this->ses->get('user')['entity_ID'];
                                        $userID = $this->ses->get('user')['ID'];
                                        
                                        $issue_table = $this->crg->get('table_prefix') . 'issue_detail';
                                        $property_table = $this->crg->get('table_prefix') . 'property';
                                        $department_table = $this->crg->get('table_prefix') . 'department';
                                        $element_table = $this->crg->get('table_prefix') . 'element_detail';
                                        $issue_master_table = $this->crg->get('table_prefix') . 'issuetag';
                                        $issue_attachments_tab = $this->crg->get('table_prefix') . 'issue_attachments';
                            
                                        $dept_sql = "SELECT ID,DeptName FROM $department_table";
                                        $stmt = $this->db->prepare($dept_sql);            
                                        $stmt->execute();
                                        $dept_data  = $stmt->fetchAll();	
                                        $this->tpl->set('dept_data', $dept_data);
        
                                        $property_sql = "SELECT ID,PropertyName FROM $property_table";
                                        $stmt = $this->db->prepare($property_sql);            
                                        $stmt->execute();
                                        $property_data  = $stmt->fetchAll();	
                                        $this->tpl->set('property_data', $property_data);
        
                                        $element_sql = "SELECT ID,ElementName FROM $element_table";
                                        $stmt = $this->db->prepare($element_sql);            
                                        $stmt->execute();
                                        $element_data  = $stmt->fetchAll();	
                                        $this->tpl->set('element_data', $element_data);
        
                                        $issue_sql = "SELECT ID,IssueTag FROM $issue_master_table";
                                        $stmt = $this->db->prepare($issue_sql);            
                                        $stmt->execute();
                                        $issue_data  = $stmt->fetchAll();	
                                        $this->tpl->set('issue_data', $issue_data);
                                        
                                        $this->tpl->set('page_title', 'Issue');	          
                                        $this->tpl->set('page_header', 'Issue');
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
                                                 
                                                 $sqlsel_del = "SELECT document_path FROM $issue_attachments_tab WHERE Issue_ID  = '$data'";
                                                 $resource_data = $dbutil->getSqlData($sqlsel_del); 
                                        
                                                if(!empty($resource_data)){
                                                    foreach($resource_data as $k=>$v){
                                                          unlink(substr($v['document_path'], 2));
                                                   }
                                                }
                                         
                                            $sqldetdelete="Delete $issue_table,$issue_attachments_tab from $issue_table 
                                                        LEFT JOIN  $issue_attachments_tab ON $issue_table.ID=$issue_attachments_tab.Issue_ID 
                                                        where $issue_table.ID=$data"; 
                                            $stmt = $this->db->prepare($sqldetdelete);            
                                                    
                                                    if($stmt->execute()){
                                                    $this->tpl->set('message', 'Issue form deleted successfully');
                                                                                                                                                  
                                                    //$this->tpl->set('label', 'List');
                                                    //$this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                                                    header('Location:' . $this->crg->get('route')['base_path'] . '/property/cst/issue');
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
                                                           FROM $issue_table 
                                                           WHERE 
                                                           $issue_table.ID = $data";   
                                                $issue_data = $dbutil->getSqlData($sqlsrr);
                                                
                                                $sql= "SELECT ID,document_path  From $issue_attachments_tab where (Issue_ID  = '$data' AND attribute_name='attachment') ORDER BY $issue_attachments_tab.ID ASC";            
                                                $attachemnt_data = $dbutil->getSqlData($sql);
                                                $this->tpl->set('FmDataattachment', $attachemnt_data);
                                               
                                                //edit option     
                                                $this->tpl->set('message', 'You can view Issue form');
                                                $this->tpl->set('page_header', 'Issue');
                                                $this->tpl->set('FmData', $issue_data); 
                                                
                                                $this->tpl->set('content', $this->tpl->fetch('factory/form/issue_design_form.php'));                    
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
                                                       FROM $issue_table 
                                                       WHERE 
                                                       $issue_table.ID = $data";   
                                            $issue_data = $dbutil->getSqlData($sqlsrr);
                                            
                                    $sql= "SELECT ID,document_path  From $issue_attachments_tab where (Issue_ID  = '$data' AND attribute_name='attachment') ORDER BY $issue_attachments_tab.ID ASC";            
                                    $attachemnt_data = $dbutil->getSqlData($sql);
                                    $this->tpl->set('FmDataattachment', $attachemnt_data);
                                               
                                                
                                                //edit option 
                            
                                                
                                                $this->tpl->set('message', 'You can edit Issue form');
                                                $this->tpl->set('page_header', 'Issue');
                                                $this->tpl->set('FmData', $issue_data); 
                                                
                                                $this->tpl->set('content', $this->tpl->fetch('factory/form/issue_design_form.php'));                    
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
                                                      $Property_ID= $form_post_data['Property_ID'];
                                                      $Department_ID= $form_post_data['Department_ID'];
                                                      $IssueTitle= $form_post_data['IssueTitle'];
                                                      $IssueDescription= $form_post_data['IssueDescription'];
                                                      $Element_ID= $form_post_data['Element_ID'];
                                                      $Issuetag_ID= $form_post_data['Issuetag_ID'];
                                                      
                                                        $sql_update="UPDATE $issue_table set Property_ID='$Property_ID',
                                                                                                Department_ID ='$Department_ID',
                                                                                                IssueTitle='$IssueTitle',
                                                                                                IssueDescription='$IssueDescription',
                                                                                                Element_ID='$Element_ID',
                                                                                                Issuetag_ID='$Issuetag_ID'
                                                                                            
                                                                                                WHERE ID=$data";
                                                        $stmt1 = $this->db->prepare($sql_update);
                                                       // $stmt1->execute();
                                                        if ($stmt1->execute()) { 
                                
                                $updateCustomer = array();
                                
                                for($j=1;$j<=3;$j++){
                                  //  print_r('hi');die;
                                foreach ($_FILES['files'.$j]['name'] as $i => $name) {
                                    //var_dump($_FILES);die;
                                        $Fvalue='files'.$j;
                                       // print_r($Fvalue);die;
                                     $uploadedFile = $util->multi_handle_file_upload_backup($Fvalue, $lastInsertedID,$i,'tender'); 
                                         
                                    if ($uploadedFile) {
                                       
                                        $updateCustomer[] = '`' . $Fvalue . '` =\'' . $uploadedFile . '\'';
                                     
                                        $filename='"' . $uploadedFile.'"'  ;
                                        $type="";
                                        
                                         if($j==2){
                                           $type="attachment";
                                        }
                                    
                                        $valStr= "'" .  $type . "'," .
                                                 "" . $filename . "," .
                                                 "'" . $data . "'";
                                                     
                                       if($filename!='' && $filename!=null){    
                                           
                                      $sql = "INSERT INTO `" . $this->crg->get('table_prefix') . "issue_attachments` (". " `attribute_name`, `document_path`,`Issue_ID`) VALUES ( $valStr )";
                                        $stmt = $this->db->prepare($sql);
                                        $stmt->execute();
                                        
                                        }
                                       
                                    }
                                                 
                                 }
                                }
                                                            
                                                     }
                                                        
                                                        $this->tpl->set('message', 'Issue form edited successfully!');   
                                                                                                                                                      
                                                        // $this->tpl->set('label', 'List');
                                                        // $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                                                        header('Location:' . $this->crg->get('route')['base_path'] . '/property/cst/issue');
                                                        } catch (Exception $exc) {
                                                         //edit failed option
                                                        $this->tpl->set('message', 'Failed to edit, try again!');
                                                        $this->tpl->set('FmData', $form_post_data);
                                                        $this->tpl->set('content', $this->tpl->fetch('factory/form/issue_design_form.php'));
                                                        }
                            
                                                break;
                            
                                            case 'addsubmit':
                                                 if (isset($crud_string)) {
                             
                                                    $form_post_data = $dbutil->arrFltr($_POST);
                        
                                                    include_once 'util/genUtil.php';
                                                    $util = new GenUtil();
                                                    
                                                  // var_dump($_POST);
                                                 
                                                   if (isset($form_post_data['Property_ID'])) {
                                                       
                                                                    $val = "'" . $form_post_data['Property_ID'] . "'," .
                                                                     "'" . $form_post_data['Department_ID'] . "'," .
                                                                     "'" . $form_post_data['IssueTitle'] . "'," .
                                                                     "'" . $form_post_data['IssueDescription'] . "'," .
                                                                     "'" . $form_post_data['Element_ID'] . "'," .
                                                                     "'" . $form_post_data['Issuetag_ID'] . "'," .
                                                                          "'" .  $this->ses->get('user')['entity_ID'] . "'," .
                                                                     "'" .  $this->ses->get('user')['ID'] . "'";
                            
                                                         $sql = "INSERT INTO `" . $this->crg->get('table_prefix') . "issue_detail`
                                                                        (
                                                                        `Property_ID`, 
                                                                        `Department_ID`,
                                                                        `IssueTitle`, 
                                                                        `IssueDescription`, 
                                                                        `Element_ID`,
                                                                        `Issuetag_ID`,
                                                                        `entity_ID`,
                                                                        `users_ID`
                                                                        ) 
                                                                     VALUES ( $val )";
                                                              $stmt = $this->db->prepare($sql);
                                                             // $stmt->execute();
                                                             if ($stmt->execute()) { 
                                                                 $lastInsertedID = $this->db->lastInsertId();
                                    
                                    $updateCustomer = array();
                                    
                                    for($j=1;$j<=3;$j++){
                                      //  print_r('hi');die;
                                    foreach ($_FILES['files'.$j]['name'] as $i => $name) {
                                      //  var_dump($_FILES);die;
                                            $Fvalue='files'.$j;
                                           // print_r($Fvalue);die;
                                         $uploadedFile = $util->multi_handle_file_upload_backup($Fvalue, $lastInsertedID,$i,'tender'); 
                                             
                                        if ($uploadedFile) {
                                           
                                            $updateCustomer[] = '`' . $Fvalue . '` =\'' . $uploadedFile . '\'';
                                         
                                            $filename='"' . $uploadedFile.'"'  ;
                                            $type="";
                                            
                                             if($j==2){
                                               $type="attachment";
                                            }
                                        
                                            $valStr= "'" .  $type . "'," .
                                                     "" . $filename . "," .
                                                     "'" . $lastInsertedID . "'";
                                                         
                                           if($filename!='' && $filename!=null){    
                                               
                                          $sql = "INSERT INTO `" . $this->crg->get('table_prefix') . "issue_attachments` (". " `attribute_name`, `document_path`,`Issue_ID`) VALUES ( $valStr )";
                                            $stmt = $this->db->prepare($sql);
                                            $stmt->execute();
                                            
                                            }
                                           
                                        }
                                                     
                                     }
                                    }
                                                                        
                                                                 }
                                                              
                                                    }
                                               
                                                    $this->tpl->set('mode', 'add');
                                                    $this->tpl->set('message', '- Success -');
                                                    // $this->tpl->set('content', $this->tpl->fetch('factory/form/salary_form.php'));
                                                    header('Location:' . $this->crg->get('route')['base_path'] . '/property/cst/issue');
                                                                                                                                    
                                                 } else {
                                                        //edit option
                                                        //if submit failed to insert form
                                                        $this->tpl->set('message', 'Failed to submit!');
                                                        $this->tpl->set('FmData', $form_post_data);
                                                        $this->tpl->set('content', $this->tpl->fetch('factory/form/issue_design_form.php'));
                                                 }
                                                break;
                                            case 'add':
                                                $this->tpl->set('mode', 'add');
                                                $this->tpl->set('page_header', 'Issue');
                                                $this->tpl->set('content', $this->tpl->fetch('factory/form/issue_design_form.php'));
                                                break;
                            
                                            default:
                                                /*
                                                 * List form
                                                 */
                                                 
                                                ////////////////////start//////////////////////////////////////////////
                                                
                                       //bUILD SQL 
                                        $whereString = '';
                                     $colArr = array(
                                            "$issue_table.ID",
                                            "$property_table.PropertyName",
                                            "$department_table.DeptName",
                                            "$issue_table.IssueTitle",
                                            "$element_table.ElementName",
                                            "$issue_master_table.IssueTag"
                            
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
                                         $whereString ="ORDER BY $issue_table.ID DESC";
                                       }
                                       
                                          
                                   $sql = "SELECT " 
                                                . implode(',',$colArr)
                                                . " FROM $issue_table,$property_table,$department_table,$element_table,$issue_master_table "
                                                . " WHERE "
                                                . " $property_table.ID = $issue_table.Property_ID AND" 
                                                . " $department_table.ID = $issue_table.Department_ID AND" 
                                                . " $element_table.ID = $issue_table.Element_ID AND" 
                                                . " $issue_master_table.ID = $issue_table.Issuetag_ID AND"
                                                . " $issue_table.entity_ID = $entityID" 
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
                                     
                                     
                                     
                                        $this->tpl->set('table_columns_label_arr', array('ID','Property Name','Department Name','Issue Title','Element Name','Issuetag Name'));
                                        
                                        /*
                                         * selectColArr for filter form
                                         */
                                        
                                        $this->tpl->set('selectColArr',$colArr);
                                                    
                                        /*
                                         * set pagination template
                                         */
                                        $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');
                                               
                                        //////////////////////close//////////////////////////////////////  
                                                 
                                                include_once $this->tpl->path . '/factory/form/crud_issue_form.php';
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
                                

                                    public function template_map(){
    
                                        if ($this->crg->get('wp') || $this->crg->get('rp')) {
                                                 
                                                ////////////////////////////////////////////////////////////////////////////////
                                                //////////////////////////////access condition applied//////////////////////////
                                                ////////////////////////////////////////////////////////////////////////////////    
                                                            
                                                include_once 'util/DBUTIL.php';
                                                $dbutil = new DBUTIL($this->crg);
                                                 
                                                $entityID = $this->ses->get('user')['entity_ID'];
                                                $userID = $this->ses->get('user')['ID'];
                                                
                                                $template_map_table = $this->crg->get('table_prefix') . 'template_map';
                                                $property_table = $this->crg->get('table_prefix') . 'property';
                                                $template_table = $this->crg->get('table_prefix') . 'template';
                                                $add_user_table = $this->crg->get('table_prefix') . 'add_user';
                
                                                $property_sql = "SELECT ID,PropertyName FROM $property_table";
                                                $stmt = $this->db->prepare($property_sql);            
                                                $stmt->execute();
                                                $property_data  = $stmt->fetchAll();	
                                                $this->tpl->set('property_data', $property_data);
                
                                                $template_sql = "SELECT ID,TemplateTitle FROM $template_table";
                                                $stmt = $this->db->prepare($template_sql);            
                                                $stmt->execute();
                                                $template_data  = $stmt->fetchAll();	
                                                $this->tpl->set('template_data', $template_data);
                    
                                                $serviceprovider_sql = "SELECT ID,CONCAT(FirstName,' ',LastName) as OwnerName FROM $add_user_table";
                                                $stmt = $this->db->prepare($serviceprovider_sql);            
                                                $stmt->execute();
                                                $serviceprovider_data  = $stmt->fetchAll();	
                                                $this->tpl->set('serviceprovider_data', $serviceprovider_data);
                                                
                                                $this->tpl->set('page_title', 'Map Service Providers With Templates');	          
                                                $this->tpl->set('page_header', 'Map Service Providers With Templates');
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
                                                         
                                                         $sqldetdelete="Delete from $template_map_table
                                                                            where $template_map_table.ID=$data"; 
                                                            $stmt = $this->db->prepare($sqldetdelete);            
                                                            
                                                            if($stmt->execute()){
                                                            $this->tpl->set('message', 'Template map form deleted successfully');
                                                                                                                                                          
                                                            //$this->tpl->set('label', 'List');
                                                            //$this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                                                            header('Location:' . $this->crg->get('route')['base_path'] . '/property/cst/template_map');
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
                                                                   FROM $template_map_table 
                                                                   WHERE 
                                                                   $template_map_table.ID = $data";   
                                                        $template_map_data = $dbutil->getSqlData($sqlsrr);
                                                       
                                                        //edit option     
                                                        $this->tpl->set('message', 'You can view Template map form');
                                                        $this->tpl->set('page_header', 'Map Service Providers With Templates');
                                                        $this->tpl->set('FmData', $template_map_data); 
                                                        
                                                        $this->tpl->set('content', $this->tpl->fetch('factory/form/template_map_design_form.php'));                    
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
                                                                   FROM $template_map_table 
                                                                   WHERE 
                                                                   $template_map_table.ID = $data";   
                                                        $template_map_data = $dbutil->getSqlData($sqlsrr);
                                                       
                                                        
                                                        //edit option 
                                    
                                                        
                                                        $this->tpl->set('message', 'You can edit Template map form');
                                                        $this->tpl->set('page_header', 'Map Service Providers With Templates');
                                                        $this->tpl->set('FmData', $template_map_data); 
                                                        
                                                        $this->tpl->set('content', $this->tpl->fetch('factory/form/template_map_design_form.php'));                    
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
                                                              $Property_ID= $form_post_data['Property_ID'];
                                                              $Template_ID= $form_post_data['Template_ID'];
                                                              $Serviceprovider_ID= $form_post_data['Serviceprovider_ID'];
                                                              
                                                                $sql_update="UPDATE $template_map_table set Property_ID='$Property_ID',
                                                                                                        Template_ID='$Template_ID',
                                                                                                        Serviceprovider_ID='$Serviceprovider_ID'
                                                                                                    
                                                                                                        WHERE ID=$data";
                                                                $stmt1 = $this->db->prepare($sql_update);
                                                                $stmt1->execute();
                                                                
                                                                $this->tpl->set('message', 'Template map form edited successfully!');   
                                                                                                                                                              
                                                                // $this->tpl->set('label', 'List');
                                                                // $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                                                                header('Location:' . $this->crg->get('route')['base_path'] . '/property/cst/template_map');
                                                                } catch (Exception $exc) {
                                                                 //edit failed option
                                                                $this->tpl->set('message', 'Failed to edit, try again!');
                                                                $this->tpl->set('FmData', $form_post_data);
                                                                $this->tpl->set('content', $this->tpl->fetch('factory/form/template_map_design_form.php'));
                                                                }
                                    
                                                        break;
                                    
                                                    case 'addsubmit':
                                                         if (isset($crud_string)) {
                                     
                                                            $form_post_data = $dbutil->arrFltr($_POST);
                                
                                                            include_once 'util/genUtil.php';
                                                            $util = new GenUtil();
                                                            
                                                          // var_dump($_POST);
                                                         
                                                           if (isset($form_post_data['Property_ID'])) {
                                                               
                                                                            $val = "'" . $form_post_data['Property_ID'] . "'," .
                                                                             "'" . $form_post_data['Template_ID'] . "'," .
                                                                             "'" . $form_post_data['Serviceprovider_ID'] . "'," .
                                                                                  "'" .  $this->ses->get('user')['entity_ID'] . "'," .
                                                                             "'" .  $this->ses->get('user')['ID'] . "'";
                                    
                                                                 $sql = "INSERT INTO `" . $this->crg->get('table_prefix') . "template_map`
                                                                                (
                                                                                `Property_ID`, 
                                                                                `Template_ID`, 
                                                                                `Serviceprovider_ID`, 
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
                                                            header('Location:' . $this->crg->get('route')['base_path'] . '/property/cst/template_map');
                                                                                                                                            
                                                         } else {
                                                                //edit option
                                                                //if submit failed to insert form
                                                                $this->tpl->set('message', 'Failed to submit!');
                                                                $this->tpl->set('FmData', $form_post_data);
                                                                $this->tpl->set('content', $this->tpl->fetch('factory/form/template_map_design_form.php'));
                                                         }
                                                        break;
                                                    case 'add':
                                                        $this->tpl->set('mode', 'add');
                                                        $this->tpl->set('page_header', 'Map Service Providers With Templates');
                                                        $this->tpl->set('content', $this->tpl->fetch('factory/form/template_map_design_form.php'));
                                                        break;
                                    
                                                    default:
                                                        /*
                                                         * List form
                                                         */
                                                         
                                                        ////////////////////start//////////////////////////////////////////////
                                                        
                                               //bUILD SQL 
                                                $whereString = '';
                                             $colArr = array(
                                                    "$template_map_table.ID",
                                                    "$property_table.PropertyName",
                                                    "$template_table.TemplateTitle",
                                                    "CONCAT($add_user_table.FirstName,' ',$add_user_table.LastName) as OwnerName"
                                    
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
                                                 $whereString ="ORDER BY $template_map_table.ID DESC";
                                               }
                                               
                                                  
                                            $sql = "SELECT " 
                                                        . implode(',',$colArr)
                                                        . " FROM $template_map_table,$property_table,$template_table,$add_user_table  "
                                                        . " WHERE "
                                                        . " $property_table.ID = $template_map_table.Property_ID AND" 
                                                        . " $template_table.ID = $template_map_table.Template_ID AND" 
                                                        . " $add_user_table.ID = $template_map_table.Serviceprovider_ID AND" 
                                                        . " $template_map_table.entity_ID = $entityID" 
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
                                             
                                             
                                             
                                                $this->tpl->set('table_columns_label_arr', array('ID','Property Name','Template Name','Service Provider Name'));
                                                
                                                /*
                                                 * selectColArr for filter form
                                                 */
                                                
                                                $this->tpl->set('selectColArr',$colArr);
                                                            
                                                /*
                                                 * set pagination template
                                                 */
                                                $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');
                                                       
                                                //////////////////////close//////////////////////////////////////  
                                                         
                                                        include_once $this->tpl->path . '/factory/form/crud_template_map_form.php';
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

                                        public function property_map(){
    
                                            if ($this->crg->get('wp') || $this->crg->get('rp')) {
                                                     
                                                    ////////////////////////////////////////////////////////////////////////////////
                                                    //////////////////////////////access condition applied//////////////////////////
                                                    ////////////////////////////////////////////////////////////////////////////////    
                                                                
                                                    include_once 'util/DBUTIL.php';
                                                    $dbutil = new DBUTIL($this->crg);
                                                     
                                                    $entityID = $this->ses->get('user')['entity_ID'];
                                                    $userID = $this->ses->get('user')['ID'];
                                                    
                                                    $property_map_table = $this->crg->get('table_prefix') . 'property_map';
                                                    $property_table = $this->crg->get('table_prefix') . 'property';
                                                    $add_user_table = $this->crg->get('table_prefix') . 'add_user';
                    
                                                    $property_sql = "SELECT ID,PropertyName FROM $property_table";
                                                    $stmt = $this->db->prepare($property_sql);            
                                                    $stmt->execute();
                                                    $property_data  = $stmt->fetchAll();	
                                                    $this->tpl->set('property_data', $property_data);
                        
                                                    $serviceprovider_sql = "SELECT ID,CONCAT(FirstName,' ',LastName) as OwnerName FROM $add_user_table";
                                                    $stmt = $this->db->prepare($serviceprovider_sql);            
                                                    $stmt->execute();
                                                    $serviceprovider_data  = $stmt->fetchAll();	
                                                    $this->tpl->set('serviceprovider_data', $serviceprovider_data);

                                                    $serviceprovider_type_data = array(array("ID"=>"1","Title"=>"Cleaners"),array("ID"=>"2","Title"=>"Inspectors"),array("ID"=>"3","Title"=>"Maintenance"));
                                                    $this->tpl->set('serviceprovider_type_data', $serviceprovider_type_data);
                                                    
                                                    $this->tpl->set('page_title', 'Map Service Providers With Property');	          
                                                    $this->tpl->set('page_header', 'Map Service Providers With Property');
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
                                                             
                                                             $sqldetdelete="Delete from $property_map_table
                                                                                where $property_map_table.ID=$data"; 
                                                             $stmt = $this->db->prepare($sqldetdelete);            
                                                                
                                                                if($stmt->execute()){
                                                                $this->tpl->set('message', 'Property map form deleted successfully');
                                                                                                                                                              
                                                                //$this->tpl->set('label', 'List');
                                                                //$this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                                                                header('Location:' . $this->crg->get('route')['base_path'] . '/property/cst/property_map');
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
                                                                       FROM $property_map_table 
                                                                       WHERE 
                                                                       $property_map_table.ID = $data";   
                                                            $property_map_data = $dbutil->getSqlData($sqlsrr);
                                                           
                                                            //edit option     
                                                            $this->tpl->set('message', 'You can view Property map form');
                                                            $this->tpl->set('page_header', 'Map Service Providers With Property');
                                                            $this->tpl->set('FmData', $property_map_data); 
                                                            
                                                            $this->tpl->set('content', $this->tpl->fetch('factory/form/property_map_design_form.php'));                    
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
                                                                       FROM $property_map_table 
                                                                       WHERE 
                                                                       $property_map_table.ID = $data";   
                                                            $property_map_data = $dbutil->getSqlData($sqlsrr);
                                                           
                                                            
                                                            //edit option 
                                        
                                                            
                                                            $this->tpl->set('message', 'You can edit Property map form');
                                                            $this->tpl->set('page_header', 'Map Service Providers With Property');
                                                            $this->tpl->set('FmData', $property_map_data); 
                                                            
                                                            $this->tpl->set('content', $this->tpl->fetch('factory/form/property_map_design_form.php'));                    
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
                                                                  $Property_ID= $form_post_data['Property_ID'];
                                                                  $ServiceproviderType= $form_post_data['ServiceproviderType'];
                                                                  $Serviceprovider_ID= $form_post_data['Serviceprovider_ID'];
                                                                  
                                                                    $sql_update="UPDATE $property_map_table set Property_ID='$Property_ID',
                                                                                                            ServiceproviderType='$ServiceproviderType',
                                                                                                            Serviceprovider_ID='$Serviceprovider_ID'
                                                                                                        
                                                                                                            WHERE ID=$data";
                                                                    $stmt1 = $this->db->prepare($sql_update);
                                                                    $stmt1->execute();
                                                                    
                                                                    $this->tpl->set('message', 'Property map form edited successfully!');   
                                                                                                                                                                  
                                                                    // $this->tpl->set('label', 'List');
                                                                    // $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                                                                    header('Location:' . $this->crg->get('route')['base_path'] . '/property/cst/property_map');
                                                                    } catch (Exception $exc) {
                                                                     //edit failed option
                                                                    $this->tpl->set('message', 'Failed to edit, try again!');
                                                                    $this->tpl->set('FmData', $form_post_data);
                                                                    $this->tpl->set('content', $this->tpl->fetch('factory/form/property_map_design_form.php'));
                                                                    }
                                        
                                                            break;
                                        
                                                        case 'addsubmit':
                                                             if (isset($crud_string)) {
                                         
                                                                $form_post_data = $dbutil->arrFltr($_POST);
                                    
                                                                include_once 'util/genUtil.php';
                                                                $util = new GenUtil();
                                                                
                                                              // var_dump($_POST);
                                                             
                                                               if (isset($form_post_data['Property_ID'])) {
                                                                   
                                                                                $val = "'" . $form_post_data['Property_ID'] . "'," .
                                                                                 "'" . $form_post_data['ServiceproviderType'] . "'," .
                                                                                 "'" . $form_post_data['Serviceprovider_ID'] . "'," .
                                                                                      "'" .  $this->ses->get('user')['entity_ID'] . "'," .
                                                                                 "'" .  $this->ses->get('user')['ID'] . "'";
                                        
                                                                     $sql = "INSERT INTO `" . $this->crg->get('table_prefix') . "property_map`
                                                                                    (
                                                                                    `Property_ID`, 
                                                                                    `ServiceproviderType`, 
                                                                                    `Serviceprovider_ID`, 
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
                                                                header('Location:' . $this->crg->get('route')['base_path'] . '/property/cst/property_map');
                                                                                                                                                
                                                             } else {
                                                                    //edit option
                                                                    //if submit failed to insert form
                                                                    $this->tpl->set('message', 'Failed to submit!');
                                                                    $this->tpl->set('FmData', $form_post_data);
                                                                    $this->tpl->set('content', $this->tpl->fetch('factory/form/property_map_design_form.php'));
                                                             }
                                                            break;
                                                        case 'add':
                                                            $this->tpl->set('mode', 'add');
                                                            $this->tpl->set('page_header', 'Map Service Providers With Property');
                                                            $this->tpl->set('content', $this->tpl->fetch('factory/form/property_map_design_form.php'));
                                                            break;
                                        
                                                        default:
                                                            /*
                                                             * List form
                                                             */
                                                             
                                                            ////////////////////start//////////////////////////////////////////////
                                                            
                                                   //bUILD SQL 
                                                    $whereString = '';
                                                 $colArr = array(
                                                        "$property_map_table.ID",
                                                        "$property_table.PropertyName",
                                                        "CASE WHEN $property_map_table.ServiceproviderType=1 THEN 'Cleaners' WHEN $property_map_table.ServiceproviderType=2 THEN 'Inspectors' WHEN $property_map_table.ServiceproviderType=2 THEN 'Maintenance' ELSE 'undefined' END as ServiceproviderType",
                                                        "CONCAT($add_user_table.FirstName,' ',$add_user_table.LastName) as OwnerName"
                                        
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
                                                     $whereString ="ORDER BY $property_map_table.ID DESC";
                                                   }
                                                   
                                                      
                                               $sql = "SELECT " 
                                                            . implode(',',$colArr)
                                                            . " FROM $property_map_table,$property_table,$add_user_table  "
                                                            . " WHERE "
                                                            . " $property_table.ID = $property_map_table.Property_ID AND" 
                                                            . " $add_user_table.ID = $property_map_table.Serviceprovider_ID AND" 
                                                            . " $property_map_table.entity_ID = $entityID" 
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
                                                 
                                                 
                                                 
                                                    $this->tpl->set('table_columns_label_arr', array('ID','Property Name','Service provider Type','Service Provider Name'));
                                                    
                                                    /*
                                                     * selectColArr for filter form
                                                     */
                                                    
                                                    $this->tpl->set('selectColArr',$colArr);
                                                                
                                                    /*
                                                     * set pagination template
                                                     */
                                                    $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');
                                                           
                                                    //////////////////////close//////////////////////////////////////  
                                                             
                                                            include_once $this->tpl->path . '/factory/form/crud_property_map_form.php';
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
    
////////////////////////////////////////////////////
    
////////////////////////////////////////////////////
}
