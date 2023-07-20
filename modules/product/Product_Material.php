<?php

/**
 * Description of Product_Mod
 *
 * @author psmahadevan
 */
class Product_Material {

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
            $unit_table = $this->crg->get('table_prefix') . 'unit';   
            $matreqdetail_tab = $this->crg->get('table_prefix') . 'MaterialRequestDetail';
            $matreqmaster_tab = $this->crg->get('table_prefix') . 'MaterialRequestMaster';
            $workorder_tab = $this->crg->get('table_prefix') . 'workorder';
            $product_tab = $this->crg->get('table_prefix') . 'product';
            $approvalprocess_tab = $this->crg->get('table_prefix') . 'approvalprocess';
            $area_tab = $this->crg->get('table_prefix') . 'area';
           
             //WO select box data 
            $sqlwodet= "SELECT $workorder_tab.ID,CONCAT(BatchNo,'  ---  ',ItemName,' ',Description) as BatchNo FROM $workorder_tab,$product_tab WHERE $workorder_tab.entity_ID = $entityID and $workorder_tab.product_ID=$product_tab.ID order by ID desc";            
            $stmt = $this->db->prepare($sqlwodet);            
            $stmt->execute();
            $wo_data  = $stmt->fetchAll(2);	
            
            $this->tpl->set('wo_data', $wo_data);
            
            //rawmaterial select box data
            
            $sql = "SELECT ID,RMName FROM $rawmaterial_table"; 
            $stmt = $this->db->prepare($sql);            
            $stmt->execute();
            $rawmaterial_data  = $stmt->fetchAll();	
            $this->tpl->set('rawmaterial_data', $rawmaterial_data);

            //rawmaterial select box data
            
            $sql = "SELECT ID,Grade FROM $rawmaterial_table"; 
            $stmt = $this->db->prepare($sql);            
            $stmt->execute();
            $grade_data  = $stmt->fetchAll();	
            $this->tpl->set('grade_data', $grade_data);
            
            //area select box
            
            $sql = "SELECT ID,AreaName FROM $area_tab"; 
            $stmt = $this->db->prepare($sql);            
            $stmt->execute();
            $area_data  = $stmt->fetchAll();	
            $this->tpl->set('area_data', $area_data);
            
            
            
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
            //Confirm Submit
             if (!empty($_POST['confirm_submit_button']) && $_POST['confirm_submit_button'] == 'confirm') {
                $crud_string = 'confirm';
            }
            //Add submit
            if (!empty($_POST['add_submit_button']) && $_POST['add_submit_button'] == 'add') {
                $crud_string = 'addsubmit';
            }

            if (isset($_SESSION['req_from_list_view'])) {
                $crud_string = strtolower($_SESSION['req_from_list_view']);
                unset($_SESSION['req_from_list_view']);
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
                     
                     $sqldetdelete="Delete $matreqdetail_tab,$matreqmaster_tab from $matreqmaster_tab
                                        LEFT JOIN  $matreqdetail_tab ON $matreqmaster_tab.ID=$matreqdetail_tab.materialrequest_ID 
                                        where $matreqdetail_tab.materialrequest_ID=$data"; 
                        $stmt = $this->db->prepare($sqldetdelete);            
                        
                        if($stmt->execute()){
                        $this->tpl->set('message', 'Material Request deleted successfully');
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
                    
                     //WO select box data 
                     $sqlwodet= "SELECT $workorder_tab.ID,CONCAT(BatchNo,' -  ',ItemName,' ',Description) as BatchNo  FROM $workorder_tab,$product_tab WHERE $workorder_tab.entity_ID = $entityID and $workorder_tab.product_ID=$product_tab.ID order by ID desc";            
                      
                    $stmt = $this->db->prepare($sqlwodet);            
                    $stmt->execute();
                    $wo_data  = $stmt->fetchAll(2);	
                            
                    //mode of form submit
                    $this->tpl->set('mode', 'view');
                    //set id to edit $ycs_ID
                    $this->tpl->set('ycs_ID', $data);         
                                
                   
                    $sqlsrr = "SELECT * FROM `$matreqdetail_tab`,`$matreqmaster_tab`,$unit_table,$rawmaterial_table WHERE $unit_table.ID=$rawmaterial_table.unit_ID AND $rawmaterial_table.ID=$matreqdetail_tab.rawmaterial_ID AND `$matreqdetail_tab`.`materialrequest_ID`=`$matreqmaster_tab`.`ID` AND `$matreqdetail_tab`.`materialrequest_ID` = '$data'";                    
                    $matreqdetail_data = $dbutil->getSqlData($sqlsrr); 
                   
                
                    //edit option     
                    $this->tpl->set('message', 'You can edit Material Request form');
                    $this->tpl->set('page_header', 'Production');
                    $this->tpl->set('FmData', $matreqdetail_data); 
                    
                    $this->tpl->set('content', $this->tpl->fetch('factory/form/MaterialRequest_form.php'));                    
                    break;
                
                case 'edit':                    
                    $data = trim($_POST['ycs_ID']);
                    $mode='edit';
                    
                    if(isset($_SESSION['ycs_ID']))
                    {
                        $data = trim($_SESSION['ycs_ID']);
                        unset($_SESSION['ycs_ID']);
                        $mode='Confirm';
                    }
                    
                    
               
                    if (!$data) {
                        $this->tpl->set('message', 'Please select any one ID to edit!');
                        $this->tpl->set('label', 'List');
                        $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                        break;
                    }
                    
                    //mode of form submit
                    $this->tpl->set('mode', $mode);
                    
                    //set id to edit $ycs_ID
                    $this->tpl->set('ycs_ID', $data);         
                                
                //   $sqlsrr = "SELECT * FROM `$matreqdetail_tab`,`$matreqmaster_tab` WHERE `$matreqdetail_tab`.`materialrequest_ID`=`$matreqmaster_tab`.`ID` AND `$matreqdetail_tab`.`materialrequest_ID` = '$data'";                    
                //   $matreqdetail_data = $dbutil->getSqlData($sqlsrr);
                  
                    $sqlsrr = "SELECT * FROM `$matreqdetail_tab`,`$matreqmaster_tab`,$unit_table,$rawmaterial_table WHERE $unit_table.ID=$rawmaterial_table.unit_ID AND $rawmaterial_table.ID=$matreqdetail_tab.rawmaterial_ID AND `$matreqdetail_tab`.`materialrequest_ID`=`$matreqmaster_tab`.`ID` AND `$matreqdetail_tab`.`materialrequest_ID` = '$data'";                    
                    $matreqdetail_data = $dbutil->getSqlData($sqlsrr);
                  
                 // $sqlsrr = "SELECT a.RMName,a.Grade,b.ReqQty,b.IssuedQty FROM $rawmaterial_table as a,$matreqdetail_tab as b,$matreqmaster_tab as c WHERE a.ID=b.rawmaterial_ID AND b.materialrequest_ID=c.ID AND b.materialrequest_ID='$data'";                    
                 // $matreqdetail_data = $dbutil->getSqlData($sqlsrr);
                   
                    
             
                    //edit option    
                    if( $mode='Confirm'){
                    $this->tpl->set('message', 'You can edit Material Request Approval Form');
                    }
                    else{
                      $this->tpl->set('message', 'You can edit Material Request Form');
                     
                    }
                    $this->tpl->set('page_header', 'Production');
                    $this->tpl->set('FmData', $matreqdetail_data); 
                    //$this->tpl->set('ApproveProcess', $ApproveProcess); 
                    
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
                            $MaterialRequestNo=$form_post_data['MaterialRequestNo']; 
                            $MRType=$form_post_data['MRType'];
                            $BatchNo= $form_post_data['BatchNo'];
                            $MaterialRequestDate=date("Y-m-d", strtotime($form_post_data['MaterialRequestDate']));
                            $MaterialRequestTime=$form_post_data['MaterialRequestTime'];
                            $area_ID=$form_post_data['area_ID'];
                            $sql_update="Update $matreqmaster_tab set MaterialRequestNo='$MaterialRequestNo',MaterialRequestDate='$MaterialRequestDate',MRType='$MRType',MaterialRequestTime='$MaterialRequestTime',area_ID='$area_ID',workorder_ID='$BatchNo' WHERE ID=$data";
                            $stmt1 = $this->db->prepare($sql_update);
                            $stmt1->execute(); 
                        $entry_count = 1;
                        FOR ($entry_count; $entry_count <= $form_post_data['maxCount'];) {
                                
                                $rawmaterial_id ='ItemNo_' . $entry_count;
                                //$Grade='Amount_' . $entry_count;
                                $grade='ItemName_' . $entry_count;
                                $ReqQty='Water_'. $entry_count;
                                $IssuedQty='Quantity_'. $entry_count;

                                        $vals = "'" . $data . "'," .
                                        "'" . $form_post_data[$rawmaterial_id] . "'," .
                                        "'" . $form_post_data[$grade] . "'," .
                                       // "'" . $form_post_data[$LotNumber] . "'," .
                                        "'" . $form_post_data[$ReqQty] . "'," .
                                        "'" . $form_post_data[$IssuedQty] . "'";
                                        
                                 
                     $sql2 = "INSERT INTO $matreqdetail_tab
                                        ( 
                                `materialrequest_ID`, 
                                `rawmaterial_ID`,
                                `Grade`,
                                `ReqQty`,
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
                    
                case 'confirm':
                    if (isset($crud_string)) {
                            $form_post_data = $dbutil->arrFltr($_POST);
                                               
                            
                            $data=$form_post_data['ycs_ID'];
                            $batchno=$form_post_data['BatchNo'];
                            $sql_update="Update $approvalprocess_tab set ApprovalStatus=1 WHERE process_ID=$data and ProcessType='Material Request'";
                            $stmt1 = $this->db->prepare($sql_update);
                            $stmt1->execute();
                            
                            $sql_update="Update $workorder_tab set Status='MRApproved' WHERE ID=$batchno";
                            $stmt = $this->db->prepare($sql_update);
                            $stmt->execute();
                            
                            
                            $this->tpl->set('message', 'Material Request Confirmed successfully!');   
                            $this->tpl->set('label', 'List');
                            $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                            
                            $sqldet_del = "DELETE FROM $matreqdetail_tab WHERE materialrequest_ID=$data";
                            $stmt = $this->db->prepare($sqldet_del);
                            $stmt->execute();   
                            
                              $entry_count = 1;
                        FOR ($entry_count; $entry_count <= $form_post_data['maxCount'];) {
                                
                                $rawmaterial_id ='ItemNo_' . $entry_count;
                               // $Grade='Amount_' . $entry_count;
                                $grade='ItemName_' . $entry_count;
                                $ReqQty='Water_'. $entry_count;
                                $IssuedQty='Quantity_'. $entry_count;

                                        $vals = "'" . $data . "'," .
                                        "'" . $form_post_data[$rawmaterial_id] . "'," .
                                        "'" . $form_post_data[$grade] . "'," .
                                        //"'" . $form_post_data[$LotNumber] . "'," .
                                        "'" . $form_post_data[$ReqQty] . "'," .
                                        "'" . $form_post_data[$IssuedQty] . "'";
                                
                                $sql2 = "INSERT INTO $matreqdetail_tab
                                ( 
                                `materialrequest_ID`,
                                `rawmaterial_ID`,
                                `Grade`,
                                `ReqQty`,
                                `IssuedQty`)
                                VALUES ($vals)";

                                $stmt = $this->db->prepare($sql2);
                                $stmt->execute();
                            //increment here
                            $entry_count++;
                            }
                            
                    }
                    break;

                case 'addsubmit':
                    //var_dump($_POST);
                     if (isset($crud_string)) {
                         
                        $form_post_data = $dbutil->arrFltr($_POST);
                        
                    
                        
                        $entry_count = 1;
                       
                            if (isset($form_post_data['MRType'])) {
                           
                                        $val = "'" . $form_post_data['MaterialRequestNo'] . "'," .
                                       
                                         "'" . $form_post_data['MRType'] . "'," .
                                         "'" . $form_post_data['BatchNo'] . "'," . 
                                         "'" . date("Y-m-d", strtotime($form_post_data['MaterialRequestDate'])) . "'," .
                                         "'" . $form_post_data['MaterialRequestTime'] . "'," .
                                         "'" . $form_post_data['area_ID'] . "'," .
                                         "'" .  $this->ses->get('user')['entity_ID'] . "'," .
                                         "'" .  $this->ses->get('user')['ID'] . "'";

                         $sql = "INSERT INTO `" . $this->crg->get('table_prefix') . "MaterialRequestMaster`
                                            ( 
                                            `MaterialRequestNo`,
                                            `MRType`,
                                            `workorder_ID`, 
                                            `MaterialRequestDate`,
                                            `MaterialRequestTime`, 
                                            `area_ID`,
                                            `entity_ID`,
                                            `users_ID`
                                            ) 
                                        VALUES ( $val )";
                                  $stmt = $this->db->prepare($sql);
                                  
                                  
                    if ($stmt->execute()) { 
                        $lastInsertedID = $this->db->lastInsertId();
                        FOR ($entry_count; $entry_count <= $form_post_data['maxCount'];) {
                               
                                $rawmaterial_ID ='ItemNo_' . $entry_count;
                                $grade='ItemName_' . $entry_count;
                                $ReqQty='Water_'. $entry_count;
                                $IssuedQty='Quantity_'. $entry_count;

                                $vals = "'" . $lastInsertedID . "'," .
                                        "'" . $form_post_data[$rawmaterial_ID] . "'," .
                                         "'" . $form_post_data[$grade] . "'," .
                                         "'" . $form_post_data[$ReqQty] . "'," .
                                         "'" . $form_post_data[$IssuedQty] . "'" ;
                                       
                                         //"'" . $form_post_data[$Temp] . "'";
                                 
                 $sql2 = "INSERT INTO $matreqdetail_tab
                                        ( 
                                `materialrequest_ID`, 
                                `rawmaterial_ID`,
                                `Grade`,
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
                        
                         //add new material request
                        $entity_short_code=$this->ses->get('user')['short_code'];
                        $start='KI/ST';
                        $newMaterialRequestNumber=$dbutil->keyGenerate('MaterialRequestMaster', 'MRQ','MaterialRequestNo',$start);
                        $this->tpl->set('materialrequest_number', $newMaterialRequestNumber);
                        $this->tpl->set('label', 'List');
                        $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                       // $this->tpl->set('content', $this->tpl->fetch('factory/form/MaterialRequest_form.php'));
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
	                //add new material request
                    $entity_short_code=$this->ses->get('user')['short_code'];
                    $start='KI/ST';
                    $newMaterialRequestNumber=$dbutil->keyGenerate('MaterialRequestMaster', 'MRQ','MaterialRequestNo',$start);
                    $this->tpl->set('materialrequest_number', $newMaterialRequestNumber);
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
                "$matreqmaster_tab.MRType",
                "$workorder_tab.BatchNo",
                "DATE_FORMAT($matreqmaster_tab.MaterialRequestDate, '%d-%m-%Y') AS MaterialRequestDate",
                "$matreqmaster_tab.MaterialRequestTime",
                "$area_tab.AreaName"
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
                    . " FROM $area_tab,$matreqmaster_tab LEFT JOIN $workorder_tab ON $matreqmaster_tab.workorder_ID=$workorder_tab.ID "
                    . " WHERE "
                    . " $area_tab.ID = $matreqmaster_tab.area_ID AND"
                    . " $matreqmaster_tab.entity_ID = $entityID"
                    . " $whereString";
            
            //   $sql = "SELECT "
            //         . implode(',',$colArr)
            //         . " FROM $matreqmaster_tab,$area_tab,$workorder_tab"
            //         . " WHERE "
            //         . " $area_tab.ID = $matreqmaster_tab.area_ID AND"
            //         . " $workorder_tab.ID = $matreqmaster_tab.workorder_ID AND $matreqmaster_tab.MRType IN ('withbatch','withoutbatch') AND "
            //         . " $matreqmaster_tab.entity_ID = $entityID"
            //         . " $whereString";
            
         
    
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
         
         
            $this->tpl->set('table_columns_label_arr', array('ID','Material Request No','Material Request Type','BatchNo','Date','Time','Area'));
            
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
    


//end of material request

//      function materialissue(){
//      if ($this->crg->get('wp') || $this->crg->get('rp')) {
//  ////////////////////////////////////////////////////////////////////////////////
//  //////////////////////////////access condition applied//////////////////////////
//  ////////////////////////////////////////////////////////////////////////////////    
            
//             include_once 'util/DBUTIL.php';
//             $dbutil = new DBUTIL($this->crg);
             
//             $entityID = $this->ses->get('user')['entity_ID'];
//             $userID = $this->ses->get('user')['ID'];
            
//             $rawmaterial_table=$this->crg->get('table_prefix') . 'rawmaterial';
//             $unit_table=$this->crg->get('table_prefix') . 'unit';
//             $matreqdetail_tab=$this->crg->get('table_prefix') . 'MaterialRequestDetail';
//             $grndetail_tab =$this->crg->get('table_prefix') .'purchaseentrydetail';
//             $matreqmaster_tab=$this->crg->get('table_prefix') . 'MaterialRequestMaster';
//             //$rmmixingdet_table=$this->crg->get('table_prefix') . 'RMMixingDetail';
//             $wrkorder_table=$this->crg->get('table_prefix') . 'workorder';
//             $matissuedetail_tab=$this->crg->get('table_prefix') . 'MaterialIssueDetail';
//             $matissuemaster_tab=$this->crg->get('table_prefix') . 'MaterialIssueMaster';
//             $area_tab=$this->crg->get('table_prefix') . 'area';
//             $stock_tab=$this->crg->get('table_prefix') . 'stock';
            
//             //workorder table
//             $sql="SELECT ID,BatchNo FROM $wrkorder_table where Status='MRApproved'"; 
//             $stmt=$this->db->prepare($sql);            
//             $stmt->execute();
//             $wrkorder_data=$stmt->fetchAll();	
//             $this->tpl->set('wrkorder_data', $wrkorder_data);
//           // var_dump($wrkorder_data);
          
//             //rawmaterial select box data
            
//             $sql="SELECT ID,RMName FROM $rawmaterial_table"; 
//             $stmt=$this->db->prepare($sql);            
//             $stmt->execute();
//             $rawmaterial_data=$stmt->fetchAll();	
//             $this->tpl->set('rawmaterial_data', $rawmaterial_data);
            
       
//             // //LotNo select box data
//             // $sql="SELECT ID,LotNo FROM $matreqdetail_tab"; 
//             // $stmt=$this->db->prepare($sql);            
//             // $stmt->execute();
//             // $matreqdetail_data=$stmt->fetchAll();	
//             // $this->tpl->set('matreqdetail_data', $matreqdetail_data);
            
//               //LotNo select box data
//             $sql="SELECT ID,LotNo FROM $grndetail_tab"; 
//             $stmt=$this->db->prepare($sql);            
//             $stmt->execute();
//             $grndetail_data=$stmt->fetchAll();	
//             $this->tpl->set('grndetail_data', $grndetail_data);
            
//              //grade select box data
            
//             $sql="SELECT ID,Grade FROM $rawmaterial_table"; 
//             $stmt=$this->db->prepare($sql);            
//             $stmt->execute();
//             $rawmaterial_grade_data=$stmt->fetchAll();	
//             $this->tpl->set('rawmaterial_grade_data', $rawmaterial_grade_data);
//           //area select box
//             $sql = "SELECT ID,AreaName FROM $area_tab"; 
//             $stmt = $this->db->prepare($sql);            
//             $stmt->execute();
//             $area_data  = $stmt->fetchAll();	
//             $this->tpl->set('area_data', $area_data);

//             $this->tpl->set('page_title', 'Material Issue');	          
//             $this->tpl->set('page_header', 'Production');
//             //Add Role when u submit the add role form
//             $thisPageURL = $this->crg->get('route')['base_path'] . '/' . $this->crg->get('route')['module'] . '/' . $this->crg->get('route')['controller'] . '/' . $this->crg->get('route')['action'];

//             $crud_string = null;
	
//             if (isset($_POST['req_from_list_view'])) {
//                 $crud_string = strtolower($_POST['req_from_list_view']);
//             }              
            
//             //Edit submit
//             if (!empty($_POST['edit_submit_button']) && $_POST['edit_submit_button'] == 'edit') {
//                 $crud_string = 'editsubmit';
//             }

//             //Add submit
//             if (!empty($_POST['add_submit_button']) && $_POST['add_submit_button'] == 'add') {
//                 $crud_string = 'addsubmit';
//             }


//             switch ($crud_string) {
                
//                  case 'delete':                    
//                       $data = trim($_POST['ycs_ID']);
//                       // var_dump($data); 
                       
                       
//                     if (!$data) {
//                         $this->tpl->set('message', 'Please select any one ID to '.$crud_string.'!');
//                         $this->tpl->set('label', 'List');
//                         $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                       
//                     }
                     
//                      $sqldetdelete="Delete $matissuedetail_tab,$matissuemaster_tab from $matissuemaster_tab
//                                         LEFT JOIN  $matissuedetail_tab ON $matissuemaster_tab.ID=$matissuedetail_tab.materialissue_ID 
//                                         where $matissuedetail_tab.materialissue_ID=$data"; 
//                         $stmt = $this->db->prepare($sqldetdelete);            
                        
//                         if($stmt->execute()){
//                         $this->tpl->set('message', 'Material Issue deleted successfully');
//                          $this->tpl->set('label', 'List');
//                         $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
//                         }
//             break;
                
//                 case 'view':                    
//                     $data = trim($_POST['ycs_ID']);
                 
//                     if (!$data) {
//                         $this->tpl->set('message', 'Please select any one ID to view!');
//                         $this->tpl->set('label', 'List');
//                         $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
//                         break;
//                     }
                    
//                     //mode of form submit
//                     $this->tpl->set('mode', 'view');
//                     //set id to edit $ycs_ID
//                     $this->tpl->set('ycs_ID', $data);         
                                   
                          
                   
//                   $sqlsrr = "SELECT * FROM `$matissuedetail_tab`,`$matissuemaster_tab`,$unit_table,$rawmaterial_table WHERE $unit_table.ID=$rawmaterial_table.unit_ID AND $rawmaterial_table.ID=$matissuedetail_tab.rawmaterial_ID AND `$matissuedetail_tab`.`materialissue_ID`=`$matissuemaster_tab`.`ID` AND `$matissuedetail_tab`.`materialissue_ID`='$data'";                    
//                     $matissuedetail_data = $dbutil->getSqlData($sqlsrr); 
                    
                   
                   
                
//                     //edit option     
//                     $this->tpl->set('message', 'You can view Material Issue Form');
//                     $this->tpl->set('page_header', 'Production');
//                     $this->tpl->set('FmData', $matissuedetail_data); 
//                      $woid=$matissuedetail_data[0]['workorder_ID'];
                    
//                   $sqlmrr = "SELECT DISTINCT  $rawmaterial_table.ID,$rawmaterial_table.RMName as RawMaterial,ycias_rawmaterial.Grade,$matreqdetail_tab.rawmaterial_ID,$matreqdetail_tab.Grade,$matreqdetail_tab.LotNo,$matreqdetail_tab.ReqQty FROM $matreqmaster_tab,$matreqdetail_tab,$rawmaterial_table WHERE $matreqdetail_tab.materialrequest_ID=$matreqmaster_tab.ID AND $matreqdetail_tab.rawmaterial_ID=$rawmaterial_table.ID AND $matreqmaster_tab.workorder_ID= '$woid' group by $rawmaterial_table.ID";                    
//                   $matreqdetail_data = $dbutil->getSqlData($sqlmrr);
                    
                  
//                      //edit option     
//                     $this->tpl->set('message', 'You can view Material Issue Form');
//                     $this->tpl->set('page_header', 'Production');
//                     $this->tpl->set('matreqdata', $matreqdetail_data); 
                    
//                     $this->tpl->set('content', $this->tpl->fetch('factory/form/materialissue_form.php'));                    
//                     break;
                
//                 case 'edit':                    
//                     $data = trim($_POST['ycs_ID']);
//                 // var_dump($data);
//                     if (!$data) {
//                         $this->tpl->set('message', 'Please select any one ID to edit!');
//                         $this->tpl->set('label', 'List');
//                         $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
//                         break;
//                     }
                    
//                     //mode of form submit
//                     $this->tpl->set('mode', 'edit');
//                     //set id to edit $ycs_ID
//                     $this->tpl->set('ycs_ID', $data);  
                    
                                
//                 // $sqlsrr = "SELECT * FROM `$matissuedetail_tab`,`$matissuemaster_tab` WHERE `$matissuedetail_tab`.`materialissue_ID`=`$matissuemaster_tab`.`ID` AND `$matissuedetail_tab`.`materialissue_ID` = '$data'";                    
//                 //  $matissuedetail_data = $dbutil->getSqlData($sqlsrr); 
                
                 
//                   $sqlsrr = "SELECT * FROM `$matissuedetail_tab`,`$matissuemaster_tab`,$unit_table,$rawmaterial_table WHERE $unit_table.ID=$rawmaterial_table.unit_ID AND $rawmaterial_table.ID=$matissuedetail_tab.rawmaterial_ID AND `$matissuedetail_tab`.`materialissue_ID`=`$matissuemaster_tab`.`ID` AND `$matissuedetail_tab`.`materialissue_ID`='$data'";                    
//                     $matissuedetail_data = $dbutil->getSqlData($sqlsrr); 
                
//                 // echo  $sqlsrr = "SELECT `$rawmaterial_table`.`RMName`,`$rawmaterial_table`.`Grade`,`$grndetail_tab.LotNo`,`$matissuedetail_tab`.`IssQty` FROM `$matissuedetail_tab`,`$matissuemaster_tab`,`$grndetail_tab`,`$rawmaterial_table` WHERE `$grndetail_tab.id`=`$matissuedetail_tab.LotNo` AND `$rawmaterial_table.id`=`$matissuedetail_tab`.`rawmaterial_ID` AND `$rawmaterial_table.id`=`$matissuedetail_tab`.`Grade` AND `$matissuedetail_tab`.`materialissue_ID`=`$matissuemaster_tab`.`ID` AND `$rawmaterial_table`.`ID`=`$grndetail_tab`.`rawmaterial_ID`AND `$rawmaterial_table`.`ID`='$data'";                    
//                 //     $matissuedetail_data = $dbutil->getSqlData($sqlsrr); 
                   
//                  //edit option     
//                     $this->tpl->set('message', 'You can edit Material Issue Form');
//                     $this->tpl->set('page_header', 'Production');
//                     $this->tpl->set('FmData', $matissuedetail_data);
                   
                   
//                     $matreqdata = trim($_POST['ycs_ID']);
//                 // var_dump($data);
//                     if (!$data) {
//                         $this->tpl->set('message', 'Please select any one ID to edit!');
//                         $this->tpl->set('label', 'List');
//                         $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
//                         break;
//                     }
                    
//                     //mode of form submit
//                     $this->tpl->set('mode', 'edit');
//                     //set id to edit $ycs_ID
//                     $this->tpl->set('ycs_ID', $matreqdata);  
                    
//                   $woid=$matissuedetail_data[0]['workorder_ID'];
                    
//                  $sqlmrr = "SELECT DISTINCT $rawmaterial_table.ID,$unit_table.UnitName,$rawmaterial_table.RMName as RawMaterial,ycias_rawmaterial.Grade,$matreqdetail_tab.rawmaterial_ID,$matreqdetail_tab.Grade,$matreqdetail_tab.LotNo,$matreqdetail_tab.ReqQty FROM $matreqmaster_tab,$matreqdetail_tab,$rawmaterial_table,$unit_table WHERE $unit_table.ID=$rawmaterial_table.unit_ID AND $matreqdetail_tab.materialrequest_ID=$matreqmaster_tab.ID AND $matreqdetail_tab.rawmaterial_ID=$rawmaterial_table.ID AND $matreqmaster_tab.workorder_ID= '$woid' group by $rawmaterial_table.ID";                    
//                   $matreqdetail_data = $dbutil->getSqlData($sqlmrr);
                  
                  
                   
//                      //edit option     
//                     $this->tpl->set('message', 'You can edit Material Issue Form');
//                     $this->tpl->set('page_header', 'Production');
//                     $this->tpl->set('matreqdata', $matreqdetail_data); 
                    
//                 //  $woid=$matissuedetail_data[0]['workorder_ID'];
//                 //  $sqlmrr = "SELECT DISTINCT $rawmaterial_table.ID as RMID,$rawmaterial_table.RMName as RawMaterial,$matreqdetail_tab.rawmaterial_ID,$matreqdetail_tab.Grade,$matreqdetail_tab.LotNo,$matreqdetail_tab.ReqQty,$matreqdetail_tab.IssuedQty FROM $matreqmaster_tab,$matreqdetail_tab,$rawmaterial_table WHERE $matreqdetail_tab.materialrequest_ID=$matreqmaster_tab.ID AND $matreqdetail_tab.rawmaterial_ID=$rawmaterial_table.ID AND $matreqmaster_tab.workorder_ID='$woid'";                    
//                 //  $matreqdetail_data = $dbutil->getSqlData($sqlmrr); 
                  
//                     $this->tpl->set('content', $this->tpl->fetch('factory/form/materialissue_form.php'));                    
//                     break;
                
//                 case 'editsubmit':             
//                     $data = trim($_POST['ycs_ID']);
                    
//                     //mode of form submit
//                     $this->tpl->set('mode', 'edit');
//                     //set id to edit $ycs_ID
//                     $this->tpl->set('ycs_ID', $data);

//                     //Post data
//                     include_once 'util/genUtil.php';
//                     $util = new GenUtil();
//                     $form_post_data = $util->arrFltr($_POST);
                
//                     //Build SQL now
//                     $sqldet_del="DELETE FROM $matissuedetail_tab WHERE materialissue_ID=$data";
//                     $stmt = $this->db->prepare($sqldet_del);
//                     $stmt->execute();   
                            
//                             try{
                              
//                             $MaterialIssueNo=$form_post_data['MaterialIssueNo'];
//                             $workorderID=$form_post_data['workorder_ID'];
//                             $MaterialIssueDate=date("Y-m-d", strtotime($form_post_data['MaterialIssueDate']));
//                             $MaterialIssueTime=$form_post_data['MaterialIssueTime'];
//                             $area_ID=$form_post_data['area_ID'];
//                             $sql_update="Update $matissuemaster_tab set MaterialIssueNo='$MaterialIssueNo',workorder_ID='$workorderID',MaterialIssueDate='$MaterialIssueDate',MaterialIssueTime='$MaterialIssueTime',area_ID='$area_ID' WHERE ID=$data";
//                             $stmt1 = $this->db->prepare($sql_update);
//                             $stmt1->execute(); 
//                         $entry_count = 1;
//                         FOR ($entry_count; $entry_count <= $form_post_data['maxCount'];) {
                                
//                                 $rawmaterial_ID ='ItemNo_' .$entry_count;
//                                 $Grade='ItemName_' .$entry_count;
//                                 $LotNo='Amount_'.$entry_count;
//                                 $IssQty='Water_'.$entry_count;
//                                 $OldIssQty='Note_'.$entry_count;
//                                 //$IssuedQty='Quantity_'. $entry_count;

//                                         $vals = "'" . $data . "'," .
//                                         "'" . $form_post_data[$rawmaterial_ID] . "'," .
//                                         "'" . $form_post_data[$Grade] . "'," .
//                                         "'" . $form_post_data[$LotNo] . "'," .
//                                         "'" . $form_post_data[$IssQty] . "'" ;
//                                       // "'" . $form_post_data[$IssuedQty] . "'";
                                        
                                 
//                                 $sql2 = "INSERT INTO $matissuedetail_tab
//                                         ( 
//                                         `materialissue_ID`, 
//                                         `rawmaterial_ID`,
//                                         `Grade`,
//                                         `LotNo`,
//                                         `IssQty`
//                                          ) 
//                                         VALUES ($vals)";
                             

//                                 $stmt = $this->db->prepare($sql2);
//                                 $stmt->execute();
                                
//                                 /********************STOCK UPDATE STARTS***********************************/                            
//                                 $sql = "SELECT * FROM $stock_tab WHERE ItemNo='$form_post_data[$rawmaterial_ID]'";
//                                 $stmt = $this->db->prepare($sql);            
//                                 $stmt->execute();
//                                 $stock_data= $stmt->fetchAll();
                                
//                                 if(!empty($stock_data)){
//                                     $sql = "UPDATE $stock_tab SET LotNo='$form_post_data[$LotNo]',TotalQty=TotalQty-$form_post_data[$OldIssQty]+$form_post_data[$IssQty],entity_ID=$entityID,users_ID=$userID WHERE ItemNo='$form_post_data[$rawmaterial_ID]'";
//                                     $stmt = $this->db->prepare($sql);            
//                                     $stmt->execute();
//                                 } /* else {
//                                     $sql = "INSERT INTO $stock_tab (ItemNo,TotalQty,LotNo,entity_ID,users_ID) VALUES ('$form_post_data[$rawmaterial_ID]',$form_post_data[$IssQty],'$form_post_data[$LotNo]',$entityID,$userID)";
//                                     $stmt = $this->db->prepare($sql);            
//                                     $stmt->execute();
//                                 } */
//                                 /********************STOCK UPDATE CLOSES***********************************/ 
                                
//                             //increment here
//                             $entry_count++;
//                             }
                       
//                             $this->tpl->set('message', 'Material Issue Form Edited Successfully!');   
//                             $this->tpl->set('label', 'List');
//                             $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
//                             } catch (Exception $exc) {
//                              //edit failed option
//                             $this->tpl->set('message', 'Failed to edit, try again!');
//                             $this->tpl->set('FmData', $form_post_data);
//                             //$this->tpl->set('matreqdata', $form_post_data);
//                             $this->tpl->set('content', $this->tpl->fetch('factory/form/materialissue_form.php'));
//                             }

//                     break;

//                 case 'addsubmit':
//                      if (isset($crud_string)) {
                         
//                         $form_post_data = $dbutil->arrFltr($_POST);
                        
            
//           // var_dump($_POST);
                        
//                         $entry_count = 1;
                       
//                             if (isset($form_post_data['workorder_ID'])) {
                           
//                                       $val = "'" . $form_post_data['MaterialIssueNo'] . "'," .
//                                         "'" . $form_post_data['workorder_ID'] . "'," .
//                                         "'" . date("Y-m-d", strtotime($form_post_data['MaterialIssueDate'])) . "'," .
//                                         "'" . $form_post_data['MaterialIssueTime'] . "'," .
//                                          "'" . $form_post_data['area_ID'] . "'," .
//                                          "'" .  $this->ses->get('user')['entity_ID'] . "'," .
//                                          "'" .  $this->ses->get('user')['ID'] . "'";
                                         
                                         
                                            
//                                         $sql = "INSERT INTO `" . $this->crg->get('table_prefix') . "MaterialIssueMaster`
//                                             ( 
//                                             `MaterialIssueNo`,
//                                             `workorder_ID`,
//                                             `MaterialIssueDate`, 
//                                             `MaterialIssueTime`, 
//                                             `area_ID`,
//                                             `entity_ID`,
//                                             `users_ID`
//                                             ) 
//                                         VALUES ( $val )";
//                                   $stmt = $this->db->prepare($sql);
//                                      //var_dump($sql);
                                  
//                     if ($stmt->execute()) { 
//                         $lastInsertedID = $this->db->lastInsertId();
//                         FOR ($entry_count; $entry_count <= $form_post_data['maxCount'];) {
                               
//                                 $rawmaterial_ID ='ItemNo_' . $entry_count;
//                                 $Grade='ItemName_' . $entry_count;
//                                 $LotNo='Amount_'. $entry_count;
//                                 $IssQty='Water_'. $entry_count;
//                               // $IssuedQty='Quantity_'. $entry_count;

//                                 $vals = "'" . $lastInsertedID . "'," .
//                                         "'" . $form_post_data[$rawmaterial_ID] . "'," .
//                                          "'" . $form_post_data[$Grade] . "'," .
//                                          "'" . $form_post_data[$LotNo] . "'," .
//                                          "'" . $form_post_data[$IssQty] . "'";
//                                       // "'" . $form_post_data[$IssuedQty] . "'" ;
                                       
//                                          //"'" . $form_post_data[$Temp] . "'";
                                 
//                                 $sql2 = "INSERT INTO $matissuedetail_tab
//                                         ( 
//                                 `materialissue_ID`, 
//                                 `rawmaterial_ID`,
//                                 `Grade`,
//                                 `LotNo`,
//                                 `IssQty`
//                                 ) 
//                                 VALUES ($vals)";

//                                  // this need to be changed in to transaction type
                                
//                                 $stmt = $this->db->prepare($sql2);
//                                 $stmt->execute();
                                
//                                 /********************STOCK UPDATE STARTS***********************************/                            
//                                 $sql = "SELECT * FROM $stock_tab WHERE ItemNo='$form_post_data[$rawmaterial_ID]'";
//                                 $stmt = $this->db->prepare($sql);            
//                                 $stmt->execute();
//                                 $stock_data= $stmt->fetchAll();
                                
//                                 if(!empty($stock_data)){
//                                     $sql = "UPDATE $stock_tab SET LotNo='$form_post_data[$LotNo]',TotalQty=TotalQty-$form_post_data[$IssQty],entity_ID=$entityID,users_ID=$userID WHERE ItemNo='$form_post_data[$rawmaterial_ID]'";
//                                     $stmt = $this->db->prepare($sql);            
//                                     $stmt->execute();
//                                 } else {
//                                     $sql = "INSERT INTO $stock_tab (ItemNo,TotalQty,LotNo,entity_ID,users_ID) VALUES ('$form_post_data[$rawmaterial_ID]',$form_post_data[$IssQty],'$form_post_data[$LotNo]',$entityID,$userID)";
//                                     $stmt = $this->db->prepare($sql);            
//                                     $stmt->execute();
//                                 }
//                                 /********************STOCK UPDATE CLOSES***********************************/  
                                
//                                 //increment here
//                                 $entry_count++;
                                
//                             }
                            
                              
//                     }
//                         }
//                         $this->tpl->set('mode', 'add');
//                         $this->tpl->set('message', '- Success -');
                         
//                          //add new material issue
// 	                    $entity_short_code = $this->ses->get('user')['short_code'];
// 	                    $newMaterialIssueNumber = $dbutil->keyGen('MaterialIssueMaster', 'MTIS' ,$entity_short_code,'MaterialIssueNo');
//                         $this->tpl->set('materialissue_number', $newMaterialIssueNumber);
//                         $this->tpl->set('content', $this->tpl->fetch('factory/form/materialissue_form.php'));
//                      } else {
//                             //edit option
//                             //if submit failed to insert form
//                             $this->tpl->set('message', 'Failed to submit!');
//                             $this->tpl->set('FmData', $form_post_data);
//                             $this->tpl->set('content', $this->tpl->fetch('factory/form/materialissue_form.php'));
//                      }
//                     break;
//                 case 'add':
//                     $this->tpl->set('mode', 'add');
// 	                $this->tpl->set('page_header', 'Production');
// 	                 //add new material issue
// 	                 $entity_short_code = $this->ses->get('user')['short_code'];
// 	                 $newMaterialIssueNumber = $dbutil->keyGen('MaterialIssueMaster', 'MTIS' ,$entity_short_code,'MaterialIssueNo');
//                      $this->tpl->set('materialissue_number', $newMaterialIssueNumber);
                   
//                     $this->tpl->set('content', $this->tpl->fetch('factory/form/materialissue_form.php'));
//                     break;

//                 default:
//                     /*
//                      * List form
//                      */
                     
//                     ////////////////////start//////////////////////////////////////////////
                    
//           //bUILD SQL 
//             $whereString = '';
            
//      $colArr = array(
//                 "$matissuemaster_tab.ID",
//                 "$matissuemaster_tab.MaterialIssueNo",
//                 "$wrkorder_table.BatchNo",
//                 "DATE_FORMAT($matissuemaster_tab.MaterialIssueDate, '%d-%m-%Y') AS MaterialIssueDate",
//               // "$matreqmaster_tab.MaterialRequestDate",
//                 "$matissuemaster_tab.MaterialIssueTime",
//                 "$area_tab.AreaName"
                
//               );
       
//             $this->tpl->set('FmData', $_POST);
//             foreach($_POST as $k=>$v){
//                 if(strpos($k,'^')){
//                     unset($_POST[$k]);
//                 }
//                 $_POST[str_replace('^','_',$k)] = $v;
//             }
//             $PD=$_POST;
//             if($_POST['list']!=''){
//                 $this->tpl->set('FmData', NULL);
//                 $PD=NULL;
//             }

//             IF (count($PD) >= 2) {
//                 $wsarr = array();
//                 foreach ($colArr as $colNames) {

// 	            if (strpos($colNames, 'DATE') !== false) {
//                     list($colNames,$x) = $dbutil->dateFilterFormat($colNames);                    
//                 }else {
//         		    $x = $dbutil->__mdsf($PD[str_replace('.','_',$colNames)]);        		    
//                 }

//                   if ('' != $x) {
//                   $wsarr[] = $colNames . " LIKE '%" . $x . "%'";
//                     }
//                 }
                
//           IF (count($wsarr) >= 1) {
//                 $whereString = ' AND '. implode(' AND ', $wsarr);
//             }
//           } else {
//              $whereString ="ORDER BY $matissuemaster_tab.ID DESC";
//           }
            
//     $sql = "SELECT "
//                     . implode(',',$colArr)
//                     . " FROM $matissuemaster_tab,$wrkorder_table,$area_tab"
//                     . " WHERE "
//                     . " $wrkorder_table.ID=$matissuemaster_tab.workorder_ID AND "
//                     . " $area_tab.ID=$matissuemaster_tab.area_ID AND "
//                     . " $matissuemaster_tab.entity_ID = $entityID "
//                     . " $whereString ";
            
         
    
//                 $results_per_page = 50;     
            
//                 if(isset($PD['pageno'])){$page=$PD['pageno'];}
//                 else if(isset($PD['pagenof'])){$page=$PD['pagenofirst'];}
//                 else if(isset($PD['pagenop'])){$page=$PD['pagenoprev'];}
//                 else if(isset($PD['pagenon'])){$page=$PD['pagenonext'];}
//                 else if(isset($PD['pagenol'])){$page=$PD['pagenolast'];}
//                 else if(isset($PD['pagenog'])){$page=$PD['pagenogo'];}
//                 else{$page=1;} 
//             /*
//              * SET DATA TO TEMPLATE
//                         */
//           $this->tpl->set('sql_data_rows', $dbutil->setPaginationList($sql,$page,$results_per_page,$wsarr));
         
         
//             $this->tpl->set('table_columns_label_arr', array('ID','MaterialIssue No','Batch No','Date','Time','Area'));
            
//             /*
//              * selectColArr for filter form
//              */
            
//             $this->tpl->set('selectColArr',$colArr);
                        
//             /*
//              * set pagination template
//              */
//             $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');
                   
//             //////////////////////close//////////////////////////////////////  
                     
//                     include_once $this->tpl->path . '/factory/form/crud_form_MaterialIssueMaster.php';
//                     $cus_form_data = Form_Elements::data($this->crg);
//                     include_once 'util/crud3_1.php';
//                     new Crud3($this->crg, $cus_form_data);
//                     break;
//             }

// 	    ///////////////Use different template////////////////////
// 	    $this->tpl->set('master_layout', 'layout_datepicker.php'); 
// ////////////////////////////////////////////////////////////////////////////////
// //////////////////////////////on access condition failed then //////////////////
// //////////////////////////////////////////////////////////////////////////////// 
//      } else {
//              if ($this->ses->get('user')['ID']) {
//                  $this->tpl->set('content', $this->tpl->fetch('modules/user/acess_failed_message.php'));
//              } else {
//                  header('Location:' . $this->crg->get('route')['base_path'] . '/user/auth/login');
//              }
//          }
//     }
    
     function materialissue(){
     if ($this->crg->get('wp') || $this->crg->get('rp')) {
 ////////////////////////////////////////////////////////////////////////////////
 //////////////////////////////access condition applied//////////////////////////
 ////////////////////////////////////////////////////////////////////////////////
            
            include_once 'util/DBUTIL.php';
            $dbutil = new DBUTIL($this->crg);
             
            $entityID = $this->ses->get('user')['entity_ID'];
            $userID = $this->ses->get('user')['ID'];
            
            $rawmaterial_table=$this->crg->get('table_prefix') . 'rawmaterial';
            $unit_table=$this->crg->get('table_prefix') . 'unit';
            $matreqdetail_tab=$this->crg->get('table_prefix') . 'MaterialRequestDetail';
            $grndetail_tab =$this->crg->get('table_prefix') .'purchaseentrydetail';
            $matreqmaster_tab=$this->crg->get('table_prefix') . 'MaterialRequestMaster';
            //$rmmixingdet_table=$this->crg->get('table_prefix') . 'RMMixingDetail';
            $wrkorder_table=$this->crg->get('table_prefix') . 'workorder';
            $matissuedetail_tab=$this->crg->get('table_prefix') . 'MaterialIssueDetail';
            $matissuemaster_tab=$this->crg->get('table_prefix') . 'MaterialIssueMaster';
            $area_tab=$this->crg->get('table_prefix') . 'area';
            $stock_tab=$this->crg->get('table_prefix') . 'stock';
            $pdt_table=$this->crg->get('table_prefix') . 'product';
            $emp_table=$this->crg->get('table_prefix') . 'employee';
            
            //workorder table
            //$sql="SELECT ID,BatchNo FROM $wrkorder_table where Status='MRApproved'"; 
            $sql= "SELECT $wrkorder_table.ID,CONCAT($wrkorder_table.BatchNo,'-',$pdt_table.ItemName,' ',$pdt_table.Description) as BatchNo,CONCAT($pdt_table.ItemName,' ',$pdt_table.Description) AS ItemName  FROM $wrkorder_table,$pdt_table WHERE $pdt_table.ID=$wrkorder_table.product_ID and $wrkorder_table.Status='MRApproved' order by $wrkorder_table.ID desc";
             $stmt=$this->db->prepare($sql);            
            $stmt->execute();
            $wrkorder_data=$stmt->fetchAll();	
            $this->tpl->set('wrkorder_data', $wrkorder_data);
           // var_dump($wrkorder_data);
          
            //rawmaterial select box data
            
            $sql="SELECT ID,RMName FROM $rawmaterial_table order by ID desc"; 
            $stmt=$this->db->prepare($sql);            
            $stmt->execute();
            $rawmaterial_data=$stmt->fetchAll();	
            $this->tpl->set('rawmaterial_data', $rawmaterial_data);
            
       
            // //LotNo select box data
            // $sql="SELECT ID,LotNo FROM $matreqdetail_tab"; 
            // $stmt=$this->db->prepare($sql);            
            // $stmt->execute();
            // $matreqdetail_data=$stmt->fetchAll();	
            // $this->tpl->set('matreqdetail_data', $matreqdetail_data);
            
              //LotNo select box data
            $sql="SELECT ID,LotNo FROM $grndetail_tab order by ID desc"; 
            $stmt=$this->db->prepare($sql);            
            $stmt->execute();
            $grndetail_data=$stmt->fetchAll();	
            $this->tpl->set('grndetail_data', $grndetail_data);
            
             //grade select box data
            
            $sql="SELECT ID,Grade FROM $rawmaterial_table order by ID desc"; 
            $stmt=$this->db->prepare($sql);            
            $stmt->execute();
            $rawmaterial_grade_data=$stmt->fetchAll();	
            $this->tpl->set('rawmaterial_grade_data', $rawmaterial_grade_data);
          
          //area select box
            $sql = "SELECT ID,AreaName FROM $area_tab"; 
            $stmt = $this->db->prepare($sql);            
            $stmt->execute();
            $area_data  = $stmt->fetchAll();	
            $this->tpl->set('area_data', $area_data);
            
             //employee select box
            $sql = "SELECT ID,EmpName FROM $emp_table"; 
            $stmt = $this->db->prepare($sql);            
            $stmt->execute();
            $emp_data  = $stmt->fetchAll();	
            $this->tpl->set('emp_data', $emp_data);

            $this->tpl->set('page_title', 'Material Issue');	          
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
                     
                     $sqldetdelete="Delete $matissuedetail_tab,$matissuemaster_tab from $matissuemaster_tab
                                        LEFT JOIN  $matissuedetail_tab ON $matissuemaster_tab.ID=$matissuedetail_tab.materialissue_ID 
                                        where $matissuedetail_tab.materialissue_ID=$data"; 
                        $stmt = $this->db->prepare($sqldetdelete);            
                        
                        if($stmt->execute()){
                        $this->tpl->set('message', 'Material Issue deleted successfully');
                         $this->tpl->set('label', 'List');
                        $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
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
                                   
                          
                   
                    $sqlsrr = "SELECT * FROM `$matissuedetail_tab`,`$matissuemaster_tab`,$unit_table,$rawmaterial_table WHERE $unit_table.ID=$rawmaterial_table.unit_ID AND $rawmaterial_table.ID=$matissuedetail_tab.rawmaterial_ID AND `$matissuedetail_tab`.`materialissue_ID`=`$matissuemaster_tab`.`ID` AND `$matissuedetail_tab`.`materialissue_ID`='$data'";                    
                    $matissuedetail_data = $dbutil->getSqlData($sqlsrr); 
                    

                    //edit option     
                    $this->tpl->set('message', 'You can view Material Issue Form');
                    $this->tpl->set('page_header', 'Production');
                    $this->tpl->set('FmData', $matissuedetail_data); 
                     $woid=$matissuedetail_data[0]['workorder_ID'];
                    
                    $sqlmrr = "SELECT DISTINCT $rawmaterial_table.ID,$unit_table.UnitName,$rawmaterial_table.RMName as RawMaterial,ycias_rawmaterial.Grade,$matreqdetail_tab.rawmaterial_ID,$matreqdetail_tab.Grade,$matreqdetail_tab.LotNo,$matreqdetail_tab.ReqQty FROM $matreqmaster_tab,$matreqdetail_tab,$rawmaterial_table,$unit_table WHERE $unit_table.ID=$rawmaterial_table.unit_ID AND $matreqdetail_tab.materialrequest_ID=$matreqmaster_tab.ID AND $matreqdetail_tab.rawmaterial_ID=$rawmaterial_table.ID AND $matreqmaster_tab.workorder_ID= '$woid' group by $rawmaterial_table.ID";                    
                  $matreqdetail_data = $dbutil->getSqlData($sqlmrr);
                  
                  
                  
                     //edit option     
                    $this->tpl->set('message', 'You can view Material Issue Form');
                    $this->tpl->set('page_header', 'Production');
                    $this->tpl->set('matreqdata', $matreqdetail_data); 
                    
                    $this->tpl->set('content', $this->tpl->fetch('factory/form/materialissue_form.php'));                    
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
                    
                                
                // $sqlsrr = "SELECT * FROM `$matissuedetail_tab`,`$matissuemaster_tab` WHERE `$matissuedetail_tab`.`materialissue_ID`=`$matissuemaster_tab`.`ID` AND `$matissuedetail_tab`.`materialissue_ID` = '$data'";                    
                //  $matissuedetail_data = $dbutil->getSqlData($sqlsrr); 
                
                 
                   $sqlsrr = "SELECT * FROM `$matissuedetail_tab`,`$matissuemaster_tab`,$unit_table,$rawmaterial_table WHERE $unit_table.ID=$rawmaterial_table.unit_ID AND $rawmaterial_table.ID=$matissuedetail_tab.rawmaterial_ID AND `$matissuedetail_tab`.`materialissue_ID`=`$matissuemaster_tab`.`ID` AND `$matissuedetail_tab`.`materialissue_ID`='$data'";                    
                    $matissuedetail_data = $dbutil->getSqlData($sqlsrr); 
                
                // echo  $sqlsrr = "SELECT `$rawmaterial_table`.`RMName`,`$rawmaterial_table`.`Grade`,`$grndetail_tab.LotNo`,`$matissuedetail_tab`.`IssQty` FROM `$matissuedetail_tab`,`$matissuemaster_tab`,`$grndetail_tab`,`$rawmaterial_table` WHERE `$grndetail_tab.id`=`$matissuedetail_tab.LotNo` AND `$rawmaterial_table.id`=`$matissuedetail_tab`.`rawmaterial_ID` AND `$rawmaterial_table.id`=`$matissuedetail_tab`.`Grade` AND `$matissuedetail_tab`.`materialissue_ID`=`$matissuemaster_tab`.`ID` AND `$rawmaterial_table`.`ID`=`$grndetail_tab`.`rawmaterial_ID`AND `$rawmaterial_table`.`ID`='$data'";                    
                //     $matissuedetail_data = $dbutil->getSqlData($sqlsrr); 
                   
                 //edit option     
                    $this->tpl->set('message', 'You can edit Material Issue Form');
                    $this->tpl->set('page_header', 'Production');
                    $this->tpl->set('FmData', $matissuedetail_data);
                   
                   
                    $matreqdata = trim($_POST['ycs_ID']);
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
                    $this->tpl->set('ycs_ID', $matreqdata);  
                    
                  $woid=$matissuedetail_data[0]['workorder_ID'];
                    
                 $sqlmrr = "SELECT DISTINCT $rawmaterial_table.ID,$unit_table.UnitName,$rawmaterial_table.RMName as RawMaterial,ycias_rawmaterial.Grade,$matreqdetail_tab.rawmaterial_ID,$matreqdetail_tab.Grade,$matreqdetail_tab.LotNo,$matreqdetail_tab.ReqQty FROM $matreqmaster_tab,$matreqdetail_tab,$rawmaterial_table,$unit_table WHERE $unit_table.ID=$rawmaterial_table.unit_ID AND $matreqdetail_tab.materialrequest_ID=$matreqmaster_tab.ID AND $matreqdetail_tab.rawmaterial_ID=$rawmaterial_table.ID AND $matreqmaster_tab.workorder_ID= '$woid' group by $rawmaterial_table.ID";                    
                  $matreqdetail_data = $dbutil->getSqlData($sqlmrr);
                  
                  
                   
                     //edit option     
                    $this->tpl->set('message', 'You can edit Material Issue Form');
                    $this->tpl->set('page_header', 'Production');
                    $this->tpl->set('matreqdata', $matreqdetail_data); 
                    
                //  $woid=$matissuedetail_data[0]['workorder_ID'];
                //  $sqlmrr = "SELECT DISTINCT $rawmaterial_table.ID as RMID,$rawmaterial_table.RMName as RawMaterial,$matreqdetail_tab.rawmaterial_ID,$matreqdetail_tab.Grade,$matreqdetail_tab.LotNo,$matreqdetail_tab.ReqQty,$matreqdetail_tab.IssuedQty FROM $matreqmaster_tab,$matreqdetail_tab,$rawmaterial_table WHERE $matreqdetail_tab.materialrequest_ID=$matreqmaster_tab.ID AND $matreqdetail_tab.rawmaterial_ID=$rawmaterial_table.ID AND $matreqmaster_tab.workorder_ID='$woid'";                    
                //  $matreqdetail_data = $dbutil->getSqlData($sqlmrr); 
                  
                    $this->tpl->set('content', $this->tpl->fetch('factory/form/materialissue_form.php'));                    
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
                    $sqldet_del="DELETE FROM $matissuedetail_tab WHERE materialissue_ID=$data";
                    $stmt = $this->db->prepare($sqldet_del);
                    $stmt->execute();   
                            
                            try{
                              
                            $MaterialIssueNo=$form_post_data['MaterialIssueNo'];
                            $workorderID=$form_post_data['workorder_ID'];
                            $MaterialIssueDate=date("Y-m-d", strtotime($form_post_data['MaterialIssueDate']));
                            $MaterialIssueTime=$form_post_data['MaterialIssueTime'];
                            $area_ID=$form_post_data['area_ID'];
                            $recievedby_ID=$form_post_data['recievedby_ID'];
                            $sql_update="Update $matissuemaster_tab set MaterialIssueNo='$MaterialIssueNo',workorder_ID='$workorderID',MaterialIssueDate='$MaterialIssueDate',MaterialIssueTime='$MaterialIssueTime',area_ID='$area_ID',recievedby_ID='$recievedby_ID' WHERE ID=$data";
                            $stmt1 = $this->db->prepare($sql_update);
                            $stmt1->execute(); 
                        $entry_count = 1;
                        FOR ($entry_count; $entry_count <= $form_post_data['maxCount'];) {
                                
                                $rawmaterial_ID ='ItemNo_' .$entry_count;
                                $Grade='ItemName_' .$entry_count;
                                $LotNo='EmpName_'.$entry_count;
                                $IssQty='Water_'.$entry_count;
                                $OldIssQty='Note_'.$entry_count;
                                //$IssuedQty='Quantity_'. $entry_count;

                                        $vals = "'" . $data . "'," .
                                        "'" . $form_post_data[$rawmaterial_ID] . "'," .
                                        "'" . $form_post_data[$Grade] . "'," .
                                        "'" . $form_post_data[$LotNo] . "'," .
                                        "'" . $form_post_data[$IssQty] . "'" ;
                                       // "'" . $form_post_data[$IssuedQty] . "'";
                                        
                                 
                                $sql2 = "INSERT INTO $matissuedetail_tab
                                        ( 
                                        `materialissue_ID`, 
                                        `rawmaterial_ID`,
                                        `Grade`,
                                        `LotNo`,
                                        `IssQty`
                                         ) 
                                        VALUES ($vals)";
                             

                                $stmt = $this->db->prepare($sql2);
                                $stmt->execute();
                                
                                /********************STOCK UPDATE STARTS***********************************/                            
                                $sql = "SELECT * FROM $stock_tab WHERE ItemNo='$form_post_data[$rawmaterial_ID]'";
                                $stmt = $this->db->prepare($sql);            
                                $stmt->execute();
                                $stock_data= $stmt->fetchAll();
                                
                                if(!empty($stock_data)){
                                      $sql = "UPDATE $stock_tab SET LotNo='$form_post_data[$LotNo]',TotalQty=TotalQty-$form_post_data[$OldIssQty]+$form_post_data[$IssQty],entity_ID=$entityID,users_ID=$userID WHERE ItemNo='$form_post_data[$rawmaterial_ID]'";
                                    $stmt = $this->db->prepare($sql);            
                                    $stmt->execute();
                                } /* else {
                                    $sql = "INSERT INTO $stock_tab (ItemNo,TotalQty,LotNo,entity_ID,users_ID) VALUES ('$form_post_data[$rawmaterial_ID]',$form_post_data[$IssQty],'$form_post_data[$LotNo]',$entityID,$userID)";
                                    $stmt = $this->db->prepare($sql);            
                                    $stmt->execute();
                                } */
                                /********************STOCK UPDATE CLOSES***********************************/ 
                                
                            //increment here
                            $entry_count++;
                            }
                       
                            $this->tpl->set('message', 'Material Issue Form Edited Successfully!');   
                            $this->tpl->set('label', 'List');
                            $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                            } catch (Exception $exc) {
                             //edit failed option
                            $this->tpl->set('message', 'Failed to edit, try again!');
                            $this->tpl->set('FmData', $form_post_data);
                            //$this->tpl->set('matreqdata', $form_post_data);
                            $this->tpl->set('content', $this->tpl->fetch('factory/form/materialissue_form.php'));
                            }

                    break;

                case 'addsubmit':
                     if (isset($crud_string)) {
                         
                        $form_post_data = $dbutil->arrFltr($_POST);
                        
    // var_dump($_POST);
                        
                        $entry_count = 1;
                       
                            if (isset($form_post_data['workorder_ID'])) {
                           
                                      $val = "'" . $form_post_data['MaterialIssueNo'] . "'," .
                                         "'" . $form_post_data['workorder_ID'] . "'," .
                                         "'" . date("Y-m-d", strtotime($form_post_data['MaterialIssueDate'])) . "'," .
                                         "'" . $form_post_data['MaterialIssueTime'] . "'," .
                                         "'" . $form_post_data['area_ID'] . "'," .
                                         "'" . $form_post_data['recievedby_ID'] . "'," . 
                                         "'" .  $this->ses->get('user')['entity_ID'] . "'," .
                                         "'" .  $this->ses->get('user')['ID'] . "'";
                                         
                                         
                                            
                                         $sql = "INSERT INTO `" . $this->crg->get('table_prefix') . "MaterialIssueMaster`
                                            ( 
                                            `MaterialIssueNo`,
                                            `workorder_ID`,
                                            `MaterialIssueDate`, 
                                            `MaterialIssueTime`, 
                                            `area_ID`,
                                            `recievedby_ID`,
                                            `entity_ID`,
                                            `users_ID`
                                            ) 
                                        VALUES ( $val )";
                                  $stmt = $this->db->prepare($sql);
                                     //var_dump($sql);
                                  
                    if ($stmt->execute()) { 
                        $lastInsertedID = $this->db->lastInsertId();
                        FOR ($entry_count; $entry_count <= $form_post_data['maxCount'];) {
                               
                                $rawmaterial_ID ='ItemNo_' . $entry_count;
                                $Grade='ItemName_' . $entry_count;
                                $LotNo='EmpName_'. $entry_count;
                                $IssQty='Water_'. $entry_count;
                               // $IssuedQty='Quantity_'. $entry_count;

                                $vals = "'" . $lastInsertedID . "'," .
                                        "'" . $form_post_data[$rawmaterial_ID] . "'," .
                                         "'" . $form_post_data[$Grade] . "'," .
                                         "'" . $form_post_data[$LotNo] . "'," .
                                         "'" . $form_post_data[$IssQty] . "'";
                                       // "'" . $form_post_data[$IssuedQty] . "'" ;
                                       
                                         //"'" . $form_post_data[$Temp] . "'";
                                 
                                $sql2 = "INSERT INTO $matissuedetail_tab
                                        ( 
                                `materialissue_ID`, 
                                `rawmaterial_ID`,
                                `Grade`,
                                `LotNo`,
                                `IssQty`
                                ) 
                                VALUES ($vals)";

                                 // this need to be changed in to transaction type
                                
                                $stmt = $this->db->prepare($sql2);
                                $stmt->execute();
                                
                                /********************STOCK UPDATE STARTS***********************************/                            
                                $sql = "SELECT * FROM $stock_tab WHERE ItemNo='$form_post_data[$rawmaterial_ID]'";
                                $stmt = $this->db->prepare($sql);            
                                $stmt->execute();
                                $stock_data= $stmt->fetchAll();
                                
                                if(!empty($stock_data)){
                                     $sql = "UPDATE $stock_tab SET LotNo='$form_post_data[$LotNo]',TotalQty=TotalQty-$form_post_data[$IssQty],entity_ID=$entityID,users_ID=$userID WHERE ItemNo='$form_post_data[$rawmaterial_ID]'";
                                    $stmt = $this->db->prepare($sql);            
                                    $stmt->execute();
                                } else {
                                    $sql = "INSERT INTO $stock_tab (ItemNo,TotalQty,LotNo,entity_ID,users_ID) VALUES ('$form_post_data[$rawmaterial_ID]',$form_post_data[$IssQty],'$form_post_data[$LotNo]',$entityID,$userID)";
                                    $stmt = $this->db->prepare($sql);            
                                    $stmt->execute();
                                }
                                /********************STOCK UPDATE CLOSES***********************************/  
                                
                                //increment here
                                $entry_count++;
                                
                            }
                            
                              
                    }
                        }
                        $this->tpl->set('mode', 'add');
                        $this->tpl->set('message', '- Success -');
                         
                         //add new material issue
	                    $entity_short_code = $this->ses->get('user')['short_code'];
	                    $start='KI/ST';
	                    $newMaterialIssueNumber = $dbutil->keyGenerate('MaterialIssueMaster','MIS','MaterialIssueNo',$start);
                        $this->tpl->set('materialissue_number', $newMaterialIssueNumber);
                        $this->tpl->set('label', 'List');
                        $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                        //$this->tpl->set('content', $this->tpl->fetch('factory/form/materialissue_form.php'));
                     } else {
                            //edit option
                            //if submit failed to insert form
                            $this->tpl->set('message', 'Failed to submit!');
                            $this->tpl->set('FmData', $form_post_data);
                            
                            $this->tpl->set('content', $this->tpl->fetch('factory/form/materialissue_form.php'));
                     }
                    break;
                case 'add':
                    $this->tpl->set('mode', 'add');
	                $this->tpl->set('page_header', 'Production');
	                 //add new material issue
	                 $entity_short_code = $this->ses->get('user')['short_code'];
	                 $start='KI/ST';
	                 $newMaterialIssueNumber = $dbutil->keyGenerate('MaterialIssueMaster', 'MIS','MaterialIssueNo',$start);
                     $this->tpl->set('materialissue_number', $newMaterialIssueNumber);
                   
                    $this->tpl->set('content', $this->tpl->fetch('factory/form/materialissue_form.php'));
                    break;

                default:
                    /*
                     * List form
                     */
                     
                    ////////////////////start//////////////////////////////////////////////
                    
           //bUILD SQL 
            $whereString = '';
            
     $colArr = array(
                "$matissuemaster_tab.ID",
                "$matissuemaster_tab.MaterialIssueNo",
                //"$wrkorder_table.BatchNo",
                "CONCAT($wrkorder_table.BatchNo,' | ', CONCAT($pdt_table.ItemName, ' ', $pdt_table.Description)) As ItemName",
                "DATE_FORMAT($matissuemaster_tab.MaterialIssueDate, '%d-%m-%Y') AS MaterialIssueDate",
               // "$matreqmaster_tab.MaterialRequestDate",
                "$matissuemaster_tab.MaterialIssueTime",
                "$area_tab.AreaName",
                "$emp_table.EmpName"
                
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
             $whereString ="ORDER BY $matissuemaster_tab.ID DESC";
           }
            
    $sql = "SELECT "
                    . implode(',',$colArr)
                    . " FROM $matissuemaster_tab,$wrkorder_table,$area_tab,$pdt_table,$emp_table"
                    . " WHERE "
                    . " $pdt_table.ID=$wrkorder_table.product_ID AND "
                    . " $wrkorder_table.ID=$matissuemaster_tab.workorder_ID AND "
                    //. " $wrkorder_table.ID=$matissuemaster_tab.workorder_ID AND "
                    . " $area_tab.ID=$matissuemaster_tab.area_ID AND "
                    . " $emp_table.ID=$matissuemaster_tab.recievedby_ID AND "
                    . " $matissuemaster_tab.entity_ID = $entityID "
                    . " $whereString ";
            
         
    
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
         
         
            $this->tpl->set('table_columns_label_arr', array('ID','MaterialIssue No','Batch No','Date','Time','Area','Received by'));
            
            /*
             * selectColArr for filter form
             */
            
            $this->tpl->set('selectColArr',$colArr);
                        
            /*
             * set pagination template
             */
            $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');
                   
            //////////////////////close//////////////////////////////////////  
                     
                    include_once $this->tpl->path . '/factory/form/crud_form_MaterialIssueMaster.php';
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
    

    //end
    function partspecification(){
     if ($this->crg->get('wp') || $this->crg->get('rp')) {
 ////////////////////////////////////////////////////////////////////////////////
 //////////////////////////////access condition applied//////////////////////////
 ////////////////////////////////////////////////////////////////////////////////    
            
            include_once 'util/DBUTIL.php';
            $dbutil = new DBUTIL($this->crg);
             
            $entityID = $this->ses->get('user')['entity_ID'];
            $userID = $this->ses->get('user')['ID'];
            
          
            $cust_table = $this->crg->get('table_prefix') . 'customer';
            $pdt_table = $this->crg->get('table_prefix') . 'product';
            $emp_table = $this->crg->get('table_prefix') . 'employee';
            $equipment_table = $this->crg->get('table_prefix') . 'equipment';
            $instrument_table = $this->crg->get('table_prefix') . 'instrument';
           
            $partdetail_tab = $this->crg->get('table_prefix') . 'partspecdetail';
            $partmaster_tab = $this->crg->get('table_prefix') . 'partspecmaster';
           
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
            
            //emp select box data
            $emp_sql = "SELECT ID,EmpName FROM $emp_table"; 
            $stmt = $this->db->prepare($emp_sql);            
            $stmt->execute();
            $emp_data  = $stmt->fetchAll();
            $this->tpl->set('emp_data', $emp_data);
            
            //equipment select box
             //emp select box data
            $instrument_sql = "SELECT ID,InstrumentName FROM $instrument_table"; 
            $stmt = $this->db->prepare($instrument_sql);            
            $stmt->execute();
            $instrument_data  = $stmt->fetchAll();
            $this->tpl->set('equipment_data', $instrument_data);
            
          

            $this->tpl->set('page_title', 'Part Specification');	          
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
                     
                     $sqldetdelete="Delete $partdetail_tab,$partmaster_tab from $partmaster_tab
                                        LEFT JOIN  $partdetail_tab ON $partmaster_tab.ID=$partdetail_tab.partspecmaster_ID 
                                        where $partdetail_tab.partspecmaster_ID=$data"; 
                        $stmt = $this->db->prepare($sqldetdelete);            
                        
                        if($stmt->execute()){
                        $this->tpl->set('message', 'Part Specification deleted successfully');
                         $this->tpl->set('label', 'List');
                        $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                        }
            break;
                case 'view':                    
                    $data = trim($_POST['ycs_ID']);
                 
                    if (!$data) {
                        $this->tpl->set('message', 'Please select any one ID to '.$crud_string.'!');
                        $this->tpl->set('label', 'List');
                        $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                        break;
                    }
                    
                    //mode of form submit
                    $this->tpl->set('mode', 'view');
                    //set id to edit $ycs_ID
                    $this->tpl->set('ycs_ID', $data);         
                                
                   
                    $sqlsrr = "SELECT * FROM `$partdetail_tab`,`$partmaster_tab` WHERE `$partdetail_tab`.`partspecmaster_ID`=`$partmaster_tab`.`ID` AND `$partdetail_tab`.`partspecmaster_ID` = '$data'";                    
                    $partdetail_data = $dbutil->getSqlData($sqlsrr); 
                   
                
                    //edit option     
                    $this->tpl->set('message', 'You can '.$crud_string.' Part Specification form');
                    $this->tpl->set('page_header', 'Production');
                    $this->tpl->set('FmData', $partdetail_data); 
                    
                    $this->tpl->set('content', $this->tpl->fetch('factory/form/partspecfication_form.php'));                    
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
                    
                    $sqlsrr = "SELECT * FROM `$partdetail_tab`,`$partmaster_tab` WHERE `$partdetail_tab`.`partspecmaster_ID`=`$partmaster_tab`.`ID` AND `$partdetail_tab`.`partspecmaster_ID` = '$data'";                    
                    $partdetail_data = $dbutil->getSqlData($sqlsrr); 
                   
                    
                     
                    //edit option     
                    $this->tpl->set('message', 'You can edit Part Specification form');
                    $this->tpl->set('page_header', 'Production');
                    $this->tpl->set('FmData', $partdetail_data); 
                    
                    $this->tpl->set('content', $this->tpl->fetch('factory/form/partspecfication_form.php'));                    
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
                    $sqldet_del = "DELETE FROM $partdetail_tab WHERE partspecmaster_ID=$data";
                    $stmt = $this->db->prepare($sqldet_del);
                    $stmt->execute();   
                            
                            try{
                           
                            $productID= $form_post_data['product_ID'];
                           // $partspectype=$form_post_data['partspectype'];
                            $customerID= $form_post_data['customer_ID'];
                            $preparedbyID=$form_post_data['preparedby_ID'];
                            $approvedbyID=$form_post_data['approvedby_ID'];
                           
                            $sql_update="Update $partmaster_tab set product_ID='$productID',customer_ID='$customerID',preparedby_ID='$preparedbyID',approvedby_ID='$approvedbyID' WHERE ID=$data";
                            $stmt1 = $this->db->prepare($sql_update);
                            $stmt1->execute(); 
                        $entry_count = 1;
                        FOR ($entry_count; $entry_count <= $form_post_data['maxCount'];) {
                               
                                $Parameter ='ItemName_' . $entry_count;
                                $ParamValue ='Amount_' . $entry_count;
                                $equipment_ID ='ItemNo_' . $entry_count;
                               
                                        $vals = "'" . $data . "'," .
                                        "'" . $form_post_data[$Parameter] . "'," .
                                         "'" . $form_post_data[$ParamValue] . "'," .
                                        "'" . $form_post_data[$equipment_ID] . "'" ;
                                        
                                 
                                $sql2 = "INSERT INTO $partdetail_tab
                                        ( 
                                `partspecmaster_ID`, 
                                `Parameter`,
                                `ParamValue`,
                                `equipment_ID` ) 
                                VALUES ($vals)";

                                $stmt = $this->db->prepare($sql2);
                                $stmt->execute();
                            //increment here
                            $entry_count++;
                            }
                       
                            $this->tpl->set('message', 'Part Specification form edited successfully!');   
                            $this->tpl->set('label', 'List');
                            $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                            } catch (Exception $exc) {
                             //edit failed option
                            $this->tpl->set('message', 'Failed to edit, try again!');
                            $this->tpl->set('FmData', $form_post_data);
                            $this->tpl->set('content', $this->tpl->fetch('factory/form/partspecfication_form.php'));
                            }

                    break;

                case 'addsubmit':
                     if (isset($crud_string)) {
                         
                        $form_post_data = $dbutil->arrFltr($_POST);
                        
                        //var_dump($_POST);
                        
                        $entry_count = 1;
                       
                            if (isset($form_post_data['product_ID'])) {
                           
                                        $val ="'" . $form_post_data['product_ID'] . "'," .
                                             // "'" . $form_post_data['partspectype'] . "'," .
                                              "'" . $form_post_data['customer_ID'] . "'," .
                                              "'" . $form_post_data['preparedby_ID'] . "'," .
                                              "'" . $form_post_data['approvedby_ID'] . "'," .
                                              "'" .  $this->ses->get('user')['entity_ID'] . "'," .
                                            "'" .  $this->ses->get('user')['ID'] . "'";

                              $sql = "INSERT INTO `" . $this->crg->get('table_prefix') . "partspecmaster`
                                            ( 
                                            `product_ID`,
                                            `customer_ID`, 
                                            `preparedby_ID`, 
                                            `approvedby_ID`,
                                            `entity_ID`,
                                            `users_ID`
                                            ) 
                                        VALUES ( $val )";
                                  $stmt = $this->db->prepare($sql);
                                  
                                  
                    if ($stmt->execute()) { 
                        $lastInsertedID = $this->db->lastInsertId();
                        FOR ($entry_count; $entry_count <= $form_post_data['maxCount'];) {
                               
                                $Parameter ='ItemName_' . $entry_count;
                                $ParamValue ='Amount_' . $entry_count;
                                $equipment_ID ='ItemNo_' . $entry_count;


                                $vals = "'" . $lastInsertedID . "'," .
                                       "'" . $form_post_data[$Parameter] . "'," .
                                         "'" . $form_post_data[$ParamValue] . "'," .
                                        "'" . $form_post_data[$equipment_ID] . "'" ;
                                       
                                         //"'" . $form_post_data[$Temp] . "'";
                                 
                            $sql2 = "INSERT INTO $partdetail_tab
                                        ( 
                                `partspecmaster_ID`, 
                                `Parameter`,
                                `ParamValue`,
                                `equipment_ID` 
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
                        $this->tpl->set('label', 'List');
                        $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                        //$this->tpl->set('content', $this->tpl->fetch('factory/form/partspecfication_form.php'));
                     } else {
                            //edit option
                            //if submit failed to insert form
                            $this->tpl->set('message', 'Failed to submit!');
                            $this->tpl->set('FmData', $form_post_data);
                            $this->tpl->set('content', $this->tpl->fetch('factory/form/partspecfication_form.php'));
                     }
                    break;
                case 'add':
                    $this->tpl->set('mode', 'add');
	                $this->tpl->set('page_header', 'Production');
	                $this->tpl->set('content', $this->tpl->fetch('factory/form/partspecfication_form.php'));
                    break;

                default:
                    /*
                     * List form
                     */
                     
                    ////////////////////start//////////////////////////////////////////////
                    
           //bUILD SQL 
            $whereString = '';
            
         $colArr = array(
                "a.ID",
                "CONCAT(b.ItemName,'  ', b.Description) AS ItemName  ",
                "c.FirstName",
                "d.EmpName",
                "e.EmpName"
               
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
             $whereString ="ORDER BY a.ID DESC";
           }
            
      $sql = "SELECT "
                    . implode(',',$colArr)
                    . " FROM $partmaster_tab as a,$pdt_table as b,$cust_table as c,$emp_table as d,$emp_table as e"
                    . " WHERE "
                    . "  b.ID=a.product_ID AND "
                    . "  c.ID=a.customer_ID AND "
                    . "  d.ID=a.preparedby_ID AND "
                    . "  e.ID=a.approvedby_ID AND "
                    . "  a.entity_ID = $entityID"
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
         
         
            $this->tpl->set('table_columns_label_arr', array('ID','Part No','Customer','Prepared By','Approved By'));
            
            /*
             * selectColArr for filter form
             */
            
            $this->tpl->set('selectColArr',$colArr);
                        
            /*
             * set pagination template
             */
            $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');
                   
            //////////////////////close//////////////////////////////////////  
                     
                    include_once $this->tpl->path . '/factory/form/crud_form_partspecification.php';
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
    
    function reconcilation()
    {
        
         if ($this->crg->get('wp') || $this->crg->get('rp')) {

//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////access condition applied///////////////////////////
////////////////////////////////////////////////////////////////////////////////  
            
           include_once 'util/DBUTIL.php';
            $dbutil = new DBUTIL($this->crg);
             
            $entityID = $this->ses->get('user')['entity_ID'];
            $userID = $this->ses->get('user')['ID'];
	
            $shift_tab = $this->crg->get('table_prefix') . 'shifttiming';
            $customerTableName =  $this->crg->get('table_prefix') .'customer';
            $employee_tab = $this->crg->get('table_prefix') . 'employee';
            	   
            $workorder_tab = $this->crg->get('table_prefix') . 'workorder';
            	   
            $product_tab =  $this->crg->get('table_prefix') . 'product';
            
            //Shift select box data 
            $sqlshiftdet= "SELECT ID,ShiftName FROM $shift_tab WHERE $shift_tab.entity_ID = $entityID";            
            $stmt = $this->db->prepare($sqlshiftdet);            
            $stmt->execute();
            $shift_data  = $stmt->fetchAll(2);	
            
            $this->tpl->set('shift_data', $shift_data);
            
             //Employee select box data 
            $sqlempdet= "SELECT ID,EmpName FROM $employee_tab WHERE $employee_tab.entity_ID = $entityID";            
            $stmt = $this->db->prepare($sqlempdet);            
            $stmt->execute();
            $empl_data  = $stmt->fetchAll(2);	
            
            $this->tpl->set('empl_data', $empl_data);
            
            
            
             //WO select box data 
            $sqlwodet= "SELECT $workorder_tab.ID,CONCAT(BatchNo,' -  ',ItemName,' ',Description) as BatchNo  FROM $workorder_tab,$product_tab WHERE $workorder_tab.entity_ID = $entityID and $workorder_tab.product_ID=$product_tab.ID order by ID desc";            
                    
            $stmt = $this->db->prepare($sqlwodet);            
            $stmt->execute();
            $wo_data  = $stmt->fetchAll(2);	
            
            $this->tpl->set('wo_data', $wo_data);
            
              $this->tpl->set('page_title', 'RAW MATERIAL RECONCILIATION REPORT');	          
            $this->tpl->set('page_header', 'Report');
            //Add Role when u submit the add role form
            $thisPageURL = $this->crg->get('route')['base_path'] . '/' . $this->crg->get('route')['module'] . '/' . $this->crg->get('route')['controller'] . '/' . $this->crg->get('route')['action'];

            
            $url=$this->crg->get('route')['base_path'] . '/product/mat/reconcilation';        
           $this->tpl->set('content', $this->tpl->fetch('factory/form/roconcilation_form.php'));
              $this->tpl->set('master_layout', 'layout_datepicker.php'); 
                            //////////////////////////////on access condition failed then ///////////////////////////
                        } else {
                            if ($this->ses->get('user')['ID']) {
                                $this->tpl->set('content', $this->tpl->fetch('modules/user/acess_failed_message.php'));
                            } else {
                                header('Location:' . $this->crg->get('route')['base_path'] . '/user/auth/login');
                            }
                        }
        
        
    }
    
}