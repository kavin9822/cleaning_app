<?php



/**

 * Description of Product_Mod

 *

 * @author psmahadevan

 */

class Product_Mod {



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

                "$unit_tab.UnitCode",

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

            $this->tpl->set('table_columns_label_arr', array('ID','Unit Code','Unit Name'));

            

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

        

    

    function units() {

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

            

          

                include_once $this->tpl->path . '/factory/form/crud_form_unit.php';

            



            



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



    function ctmanage() {

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

            

            

                include_once $this->tpl->path . '/factory/form/customer_type.php';

                       



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

    

    function pkmanage() {

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

            

            

                include_once $this->tpl->path . '/factory/form/package.php';

                       



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

    

    function addcountry() {

        include_once $this->tpl->path . '/factory/form/add_country_form.php';

        $cus_form_data = Form_Elements::data($this->crg);

        //call crud class

        include_once 'util/crud2.php';

        new Crud2($this->crg, $cus_form_data);

    }

    

   

    function pps(){

     if ($this->crg->get('wp') || $this->crg->get('rp')) {

 ////////////////////////////////////////////////////////////////////////////////

 //////////////////////////////access condition applied//////////////////////////

 ////////////////////////////////////////////////////////////////////////////////    

        

            include_once 'util/DBUTIL.php';

            $dbutil = new DBUTIL($this->crg);

             

            $entityID = $this->ses->get('user')['entity_ID'];

            $userID = $this->ses->get('user')['ID'];

            

            $SOPMaster_tab = $this->crg->get('table_prefix') . 'SOPMaster';

            $product_tab = $this->crg->get('table_prefix') . 'product';

             $unit_tab = $this->crg->get('table_prefix') . 'unit';

            $SOP_tab = $this->crg->get('table_prefix') . 'SOP';

            

            $workorder_tab = $this->crg->get('table_prefix') . 'workorder';

            $machine_tab = $this->crg->get('table_prefix') . 'machinemaster';

            $shift_tab = $this->crg->get('table_prefix') . 'shifttiming';

            $employee_tab = $this->crg->get('table_prefix') . 'employee';

            $bdreason_tab = $this->crg->get('table_prefix') . 'breakdownreasons';

            $pipeproduction_tab = $this->crg->get('table_prefix') . 'pipeproduction';

            $pipeproductionraw_tab = $this->crg->get('table_prefix') . 'pprawmaterialdet';

             

             	

        	$customerTableName =  $this->crg->get('table_prefix') .'customer';

        	$BOMMasterTableName =  $this->crg->get('table_prefix') .'BOMMaster';

        	$BOMDetailTableName =  $this->crg->get('table_prefix') .'BOMDetail';

        	$rawmaterialTableName =  $this->crg->get('table_prefix') .'rawmaterial';

        	$machinemasterTableName =  $this->crg->get('table_prefix') .'machinemaster';

        	$mouldTableName =  $this->crg->get('table_prefix') .'mould';

            

            

             //WO select box data 

            $sqlwodet= "SELECT ID,BatchNo FROM $workorder_tab WHERE $workorder_tab.entity_ID = $entityID";            

            $stmt = $this->db->prepare($sqlwodet);            

            $stmt->execute();

            $wo_data  = $stmt->fetchAll(2);	

            

            $this->tpl->set('wo_data', $wo_data);

            

            

             //BDReason select box data 

            $sqlbddet= "SELECT ID,Description FROM $bdreason_tab WHERE $bdreason_tab.entity_ID = $entityID";            

            $stmt = $this->db->prepare($sqlbddet);            

            $stmt->execute();

            $bd_data  = $stmt->fetchAll(2);	

            

            $this->tpl->set('BDreason_data', $bd_data);

            

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

            

            //machine select box data

            

            $sqlmachdet= "SELECT ID,MachineName FROM $machine_tab WHERE $machine_tab.entity_ID = $entityID";            

            $stmt = $this->db->prepare($sqlmachdet);            

            $stmt->execute();

            $mach_data  = $stmt->fetchAll(2);	

            

            $this->tpl->set('mach_data', $mach_data);

            

            //Product select box data 

            $sqlproductdet= "SELECT ID,ItemName FROM $product_tab WHERE $product_tab.entity_ID = $entityID";            

            $stmt = $this->db->prepare($sqlproductdet);            

            $stmt->execute();

            $product_data  = $stmt->fetchAll(2);	

            

            $this->tpl->set('product_data', $product_data);

            

            

            //SOP Parameter data 

            $sqlSOPMaster= "SELECT $SOPMaster_tab.ID,$SOPMaster_tab.ParameterName,$unit_tab.UnitName, $SOPMaster_tab.Spec FROM $SOPMaster_tab,$unit_tab where $SOPMaster_tab.unit_ID=$unit_tab.ID";            

           

            $stmt = $this->db->prepare($sqlSOPMaster);            

            $stmt->execute();

            $SOPMaster_data  = $stmt->fetchAll();

            

            $this->tpl->set('SOPMaster_data', $SOPMaster_data);

            

            



            $this->tpl->set('page_title', 'Pipe Production Sheet');	          

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

                case 'edit':                    

                    

                    $data = trim($_POST['ycs_ID']);

                    

                    if (!$data) {

                        $this->tpl->set('message', 'Please select any one ID to '.$crud_string.'!');

                        $this->tpl->set('label', 'List');

                        $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));

                        break;

                    }

                    

                    //mode of form submit

                    $this->tpl->set('mode', $crud_string);

                  

                    //set id to edit $ycs_ID

                    $this->tpl->set('ycs_ID', $data);    

                    

                    $sqlsrr = "SELECT * FROM $pipeproduction_tab  where $pipeproduction_tab.ID=$data";                    

                    $pipeprod_data = $dbutil->getSqlData($sqlsrr);             

                    $this->tpl->set('FmData', $pipeprod_data); 

                    

                    $woid=$pipeprod_data[0]['workorder_ID'];

                    $sqlpro="Select product_ID from $workorder_tab where $workorder_tab.ID=$woid" ;           

                    $stmt = $this->db->prepare($sqlpro);            

                    $stmt->execute();

                    $productID = $stmt->fetch(4);

                    

                    $SOPsql_query = "Select ParameterName ,SOPValue,GroupName,outputpermin from $SOP_tab,$SOPMaster_tab  where $SOPMaster_tab.ID= $SOP_tab.sopmaster_ID AND product_ID= $productID[0]";

                    $pipeprodsop_data = $dbutil->getSqlData($SOPsql_query);             

                    $this->tpl->set('FmSOPData', $pipeprodsop_data); 

                    

                    

                    

                    $sql_query  = "select DISTINCT $workorder_tab.ID,$customerTableName.FirstName,$rawmaterialTableName.ID as RMID,$rawmaterialTableName.RMName as RawMaterial,$rawmaterialTableName.Grade, $product_tab.ID as ProductID,$product_tab.weight, $product_tab.ItemName,$machinemasterTableName.MachineName,"

                                    ."$mouldTableName.MouldName,$workorder_tab.Quantity,$BOMMasterTableName.MouldQty,$pipeproductionraw_tab.OpeningQty,$pipeproductionraw_tab.InwardQty,$pipeproductionraw_tab.ConsumedQty,$pipeproductionraw_tab.RejectedQty,$pipeproductionraw_tab.ClosingQty  "

                                    ."from $workorder_tab,$BOMMasterTableName,$BOMDetailTableName,$customerTableName,$machinemasterTableName,$mouldTableName,$product_tab,"

                                    ."$rawmaterialTableName,$pipeproductionraw_tab where  $workorder_tab.customer_ID= $customerTableName.ID "

                                    ."and $BOMMasterTableName.machine_ID=$machinemasterTableName.ID and $BOMMasterTableName.mould_ID = $mouldTableName.ID"

                                   ." AND $workorder_tab.product_ID = $product_tab.ID and  $workorder_tab.product_ID=$BOMMasterTableName.product_ID AND  $pipeproductionraw_tab.rawmaterial_id = $rawmaterialTableName.ID"

                                   ." AND $workorder_tab.ID = $woid and $pipeproductionraw_tab.	pipeproduction_ID =$data order by $rawmaterialTableName.ID ";

                   

                    $pipeprodrm_data = $dbutil->getSqlData($sql_query);             

                    $this->tpl->set('FmRMData', $pipeprodrm_data); 

                    

                    

                    $this->tpl->set('message', 'You can '.$crud_string);

                    $this->tpl->set('page_header', 'Sales');

                    

                    $this->tpl->set('content', $this->tpl->fetch('factory/form/pipe_production_form.php'));                    

                    break;

                 

                case 'editsubmit':             

                    $data = trim($_POST['ycs_ID']);

                    

                    //mode of form submit

                    $this->tpl->set('mode', 'edit');

                    //set id to edit $ycs_ID

                    $this->tpl->set('ycs_ID', $data);

                    try{

                     if (isset($crud_string)) {

                         

                        $form_post_data = $dbutil->arrFltr($_POST);

                       

                        $entry_count = 1;

                        

                       

                            $BatchNo= $form_post_data['BatchNo'];

                            $OperatorName= $form_post_data['OperatorName'] ;

                            $Shift= $form_post_data['Shift'] ;

                            $productiontime= $form_post_data['productiontime'];

                            $CorrugatedRPM= $form_post_data['CorrugatedRPM'];

                            $ExtruderSpeedRPM= $form_post_data['ExtruderSpeedRPM'] ;

                            $CoExtruderRPM= $form_post_data['CoExtruderRPM'];

                            $ChillerTempInput= $form_post_data['ChillerTempInput'] ;

                            $ChillerTempOutput= $form_post_data['ChillerTempOutput'];

                            $AirPressure= $form_post_data['AirPressure'] ;

                            $ProdStartTime= $form_post_data['ProdStartTime'];

                            $ProdEndTime= $form_post_data['ProdEndTime'] ;

                            $IdleHrs= $form_post_data['IdleHrs'];

                            $IdleDesc= $form_post_data['IdleDesc'] ;

                            $PowerCutHrs= $form_post_data['PowerCutHrs'];

                            $TotProdRunHrs= $form_post_data['TotProdRunHrs'] ;

                            $TotProdMtr= $form_post_data['TotProdMtr'] ;

                            $TotProdKg= $form_post_data['TotProdKg'];

                            $BDHrs= $form_post_data['BreakdownHrs'] ;

                            $Communication= $form_post_data['Communication'];

                            $Lumps= $form_post_data['Lumps'];

                            $StartupWaste= $form_post_data['StartupWaste'] ;

                            $CuttingWaste= $form_post_data['CuttingWaste'];

                            $FinsihingWaste= $form_post_data['FinsihingWaste'] ;

                            $TotalScrap= $form_post_data['TotalScrap'];

                            $Actweight= $form_post_data['Actweight'] ;

                            $ActOutput= $form_post_data['ActOutput'];

                                         

                                        $sql2 = "update  $pipeproduction_tab set " .

                                                  "`workorder_ID`='$BatchNo',

                                                   `operator_ID`='$OperatorName',

                                                   `shift_ID`='$Shift',

                                                   `ProdTime`='$productiontime',

                                                   `CorrugatorAmps`='$CorrugatedRPM',

                                                   `ExtruderAmps`='$ExtruderSpeedRPM', 

                                                   `CoExtruderAmps`='$CoExtruderRPM',

                                        		   `ChillerTempInput`='$ChillerTempInput',

                                                   `ChillerTempOutput`='$ChillerTempOutput',

                                                   `AirPressure`='$AirPressure',

                                                   `ProdStartTime`='$ProdStartTime',

                                                   `ProdEndTime`='$ProdEndTime',

                                                   `IdleHrs`='$IdleHrs',

                                                   `IdleDesc`='$IdleDesc',

                                                   `PowercutHrs`='$PowerCutHrs',

                                                   `TotProdRunningHrs`='$TotProdRunHrs',

                                                   `TotProdMtr`='$TotProdMtr',

                                                   `TotProdKg`='$TotProdKg',

                                                   `BreakdownHrs`='$BDHrs',

                                                   `Communication`='$Communication',

                                                   `Lumps`='$Lumps',

                                                   `StartUpWaste`='$StartupWaste',

                                                   `CuttingWaste`='$CuttingWaste',

                                                   `FinishingWaste`='$FinsihingWaste',

                                                   `TotalWaste`='$TotalScrap',

                                                   `ActualWgt`='$Actweight',

                                                   `ActualOutput`='$ActOutput' where ID= $data";

                        

                                     $stmt = $this->db->prepare($sql2);

                                       $entry_count=1;

                                          //increment here

                                       if ($stmt->execute()) { 

                                           

                                     

                                    $sqldelete="Delete from $pipeproductionraw_tab where $pipeproductionraw_tab.pipeproduction_ID=$data "; 

                                    $stmt = $this->db->prepare($sqldelete);            

                                    $stmt->execute();

                                 

                                    FOR ($entry_count; $entry_count <= $form_post_data['maxCount'];) {

                                           

                                            $RM_ID ='RMID_' . $entry_count;

                                            $OpeningBalance='OpeningBalance_' . $entry_count ;

                                            $InwardQty='InwardQty_'. $entry_count;

                                            $RejectedQty='RejectedQty_'. $entry_count;

                                            $ClosingBalance='ClosingBalance_'. $entry_count;

                                            $ConsumedQty='ConsumedQty_' . $entry_count;

                                            

            

                                            $vals = "'" . $data . "'," .

                                                    "'" . $form_post_data[$RM_ID] . "'," .

                                                     "'" . $form_post_data[$OpeningBalance] . "'," .

                                                     "'" . $form_post_data[$InwardQty] . "'," .

                                                     "'" . $form_post_data[$RejectedQty] . "'," .

                                                       "'" . $form_post_data[$ClosingBalance] . "'," .

                                                     "'" . $form_post_data[$ConsumedQty] . "'" ;

                                                    

                                                   

                                                     //"'" . $form_post_data[$Temp] . "'";

                                             

                                    $sql2 = "INSERT INTO $pipeproductionraw_tab

                                                    ( 

                                            `pipeproduction_ID`, 

                                            `rawmaterial_ID`,

                                            `OpeningQty`,

                                            `InwardQty`,

                                            `RejectedQty`,

                                            `ClosingQty`,

                                            `ConsumedQty`

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

                     

                     $this->tpl->set('message', 'Pipe Production form edited successfully!');  

                            $this->tpl->set('label', 'List');

                            $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));

                            } catch (Exception $exc) {

                             //edit failed option

                            $this->tpl->set('message', 'Failed to edit, try again!');

                            $this->tpl->set('FmData', $form_post_data);

                            $this->tpl->set('content', $this->tpl->fetch('factory/form/pipe_production_form.php'));

                            }

                            

                     break;



                case 'addsubmit':

                     if (isset($crud_string)) {

                         

                        $form_post_data = $dbutil->arrFltr($_POST);

                       

                       

                       

                    

                        $entry_count = 1;



                            if (isset($form_post_data['BatchNo'])) {

                        

        

                                       

                                        $vals = "'" . $form_post_data['BatchNo'] . "'," .

                                                "'" . $form_post_data['OperatorName'] ."'," .

                                                "'" . $form_post_data['Shift'] ."'," .

                                                "'" . $form_post_data['productiontime'] . "'," .

                                                "'" . $form_post_data['CorrugatedRPM'] . "'," .

                                                "'" . $form_post_data['ExtruderSpeedRPM'] ."'," .

                                                "'" . $form_post_data['CoExtruderRPM'] . "'," .

                                                "'" . $form_post_data['ChillerTempInput'] ."'," .

                                                "'" . $form_post_data['ChillerTempOutput'] . "'," .

                                                "'" . $form_post_data['AirPressure'] ."'," .

                                                "'" . $form_post_data['ProdStartTime'] . "'," .

                                                "'" . $form_post_data['ProdEndTime'] ."'," .

                                                "'" . $form_post_data['IdleHrs'] . "'," .

                                                "'" . $form_post_data['IdleDesc'] ."'," .

                                                "'" . $form_post_data['PowerCutHrs'] . "'," .

                                                "'" . $form_post_data['TotProdRunHrs'] ."'," .

                                                "'" . $form_post_data['TotProdMtr'] ."'," .

                                                "'" . $form_post_data['TotProdKg'] . "'," .

                                                "'" . $form_post_data['BDHrs'] ."'," .

                                                "'" . $form_post_data['Communication'] . "'," .

                                                "'" . $form_post_data['Lumps'] . "'," .

                                                "'" . $form_post_data['StartupWaste'] ."'," .

                                                "'" . $form_post_data['CuttingWaste'] . "'," .

                                                "'" . $form_post_data['FinsihingWaste'] ."'," .

                                                "'" . $form_post_data['TotalScrap'] . "'," .

                                                   "'" . $form_post_data['Actweight'] ."'," .

                                                "'" . $form_post_data['ActOutput'] . "'," .

                                                "'" .  $this->ses->get('user')['entity_ID'] . "'," .

                                                "'" .  $this->ses->get('user')['ID'] . "'";

                                         

                                        $sql2 = "INSERT INTO $pipeproduction_tab" .

                                                "( 

                                                     `workorder_ID`,

                                                     `operator_ID`,

                                                     `shift_ID`,

                                                     `ProdTime`,

                                                     `CorrugatorAmps`,

                                                     `ExtruderAmps`, 

                                                     `CoExtruderAmps`,

                                                     `ChillerTempInput`,

                                                     `ChillerTempOutput`,

                                                     `AirPressure`,

                                                      `ProdStartTime`,

                                                      `ProdEndTime`,

                                                      `IdleHrs`,

                                                      `IdleDesc`,

                                                      `PowercutHrs`,

                                                      `TotProdRunningHrs`,

                                                      `TotProdMtr`,

                                                      `TotProdKg`,

                                                      `BreakdownHrs`,

                                                      `Communication`,

                                                      `Lumps`,

                                                      `StartUpWaste`,

                                                      `CuttingWaste`,

                                                      `FinishingWaste`,

                                                      `TotalWaste`,

                                                      `ActualWgt`,

                                                      `ActualOutput`,

                                                       `entity_ID`,

                                                       `users_ID`

                                       ) 

                                        VALUES ($vals)";

        

                                        // this need to be changed in to transaction type

                                        

                                        $stmt = $this->db->prepare($sql2);

                                       $entry_count=1;

                                          //increment here

                                       if ($stmt->execute()) { 

                                           

                                    $lastInsertedID = $this->db->lastInsertId();

                                 

                                    FOR ($entry_count; $entry_count <= $form_post_data['maxCount'];) {

                                           

                                            $RM_ID ='RMID_' . $entry_count;

                                            $OpeningBalance='OpeningBalance_' . $entry_count ;

                                            $InwardQty='InwardQty_'. $entry_count;

                                            $RejectedQty='RejectedQty_'. $entry_count;

                                            $ClosingBalance='ClosingBalance_'. $entry_count;

                                            $ConsumedQty='ConsumedQty_' . $entry_count;

                                            

            

                                            $vals = "'" . $lastInsertedID . "'," .

                                                    "'" . $form_post_data[$RM_ID] . "'," .

                                                     "'" . $form_post_data[$OpeningBalance] . "'," .

                                                     "'" . $form_post_data[$InwardQty] . "'," .

                                                     "'" . $form_post_data[$RejectedQty] . "'," .

                                                       "'" . $form_post_data[$ClosingBalance] . "'," .

                                                     "'" . $form_post_data[$ConsumedQty] . "'" ;

                                                    

                                                   

                                                     //"'" . $form_post_data[$Temp] . "'";

                                             

                                      $sql2 = "INSERT INTO $pipeproductionraw_tab

                                                    ( 

                                            `pipeproduction_ID`, 

                                            `rawmaterial_ID`,

                                            `OpeningQty`,

                                            `InwardQty`,

                                            `RejectedQty`,

                                            `ClosingQty`,

                                            `ConsumedQty`

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

                             

                             $this->tpl->set('message', '- Success -');

                        $this->tpl->set('content', $this->tpl->fetch('factory/form/pipe_production_form.php'));

                         $this->tpl->set('master_layout', 'layout_datepicker.php');

                     } else {

                            //edit option

                            //if submit failed to insert form

                            $this->tpl->set('message', 'Failed to submit!');

                            $this->tpl->set('FmData', $form_post_data);

                            $this->tpl->set('content', $this->tpl->fetch('factory/form/pipe_production_form.php'));

                     

                             $this->tpl->set('master_layout', 'layout_datepicker.php');

                     }

                    break;

                case 'add':

                     $this->tpl->set('master_layout', 'layout_datepicker.php');

                    $this->tpl->set('mode', 'add');

                    $this->tpl->set('content', $this->tpl->fetch('factory/form/pipe_production_form.php'));

                    break;



                default:

                    /*

                     * List form

                     */

                    

                   $whereString = '';

            

                        $colArr = array(

                            "$pipeproduction_tab.ID",

                              "$workorder_tab.BatchNo",  

                              "$shift_tab.ShiftName",  

                            "$pipeproduction_tab.ProdTime", 

                            "$pipeproduction_tab.CorrugatorAmps",

                            "$pipeproduction_tab.ExtruderAmps",

                            "$pipeproduction_tab.CoExtruderAmps", 

                            "$pipeproduction_tab.ChillerTempInput",

                            "$pipeproduction_tab.ChillerTempOutput",

                            "$pipeproduction_tab.AirPressure",

                            "$pipeproduction_tab.IdleHrs",

                            "$pipeproduction_tab.PowerCutHrs", 

                            "$pipeproduction_tab.TotProdRunningHrs",

                            "$pipeproduction_tab.TotProdMtr",

                            "$pipeproduction_tab.TotProdKg",

                            "$pipeproduction_tab.BreakdownHrs"

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

                    }else if(strpos($colNames, 'CONCAT') !== false){

                          if(preg_match('/-/', $colNames)){

                               if($dbutil->concatFilterFormat($colNames)){

                                 $wsarr[] = $dbutil->concatFilterFormat($colNames,'spc');

                               }

                          }else{

                            if($dbutil->concatFilterFormat($colNames)){

                            $wsarr[] = $dbutil->concatFilterFormat($colNames);

                            }  

                          }

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

            } 

                

            $orderBy ="ORDER BY $pipeproduction_tab.ID DESC";

           

            

       $sql = "SELECT "

                 . implode(',',$colArr)

                 . " FROM $pipeproduction_tab,$workorder_tab,$shift_tab"

                 . " WHERE "

                 . " $workorder_tab.ID=$pipeproduction_tab.workorder_ID AND "

                  . "$shift_tab.ID=$pipeproduction_tab.shift_ID AND "

                 . " $pipeproduction_tab.entity_ID = $entityID"

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

             

            $this->tpl->set('table_columns_label_arr', array('Production ID','BatchNo','Shift Name','Prod. Time','Corrugated RPM','Extruder RPM','Co Extruder RPM','Chiller Temp Input','Chiller Temp Output','Air Pressure(Bar)','Idle Hrs','Power Cut Hrs','Tot. Prod. Running Hrs','Tot. Prod. in Mtr/No','

                                                                Tot. Prod. in KG','Breakdown Hrs'));

            

            /*

            * selectColArr for filter form

             */

            

       $this->tpl->set('selectColArr',$colArr);

                        

            /*

             * set pagination template

             */

            $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');

            

                    include_once $this->tpl->path . '/factory/form/pipe_production_crud_form.php';

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

    

//      function oie(){

//      if ($this->crg->get('wp') || $this->crg->get('rp')) {

//  ////////////////////////////////////////////////////////////////////////////////

//  //////////////////////////////access condition applied//////////////////////////

//  ////////////////////////////////////////////////////////////////////////////////

      

//             include_once 'util/DBUTIL.php';

//             $dbutil = new DBUTIL($this->crg);

             

//             $entityID = $this->ses->get('user')['entity_ID'];

//             $userID = $this->ses->get('user')['ID'];

            

//             $SOPMaster_tab = $this->crg->get('table_prefix') . 'SOPMaster';

//             $product_tab = $this->crg->get('table_prefix') . 'product';

//              $unit_tab = $this->crg->get('table_prefix') . 'unit';

//             $SOP_tab = $this->crg->get('table_prefix') . 'SOP';

//             $equipment_tab = $this->crg->get('table_prefix') . 'equipment';

//             $dailyproduction_tab = $this->crg->get('table_prefix') . 'dailyprodplan';

            

//             $workorder_tab = $this->crg->get('table_prefix') . 'workorder';

//              $shift_tab = $this->crg->get('table_prefix') . 'shifttiming';

//             $employee_tab = $this->crg->get('table_prefix') . 'employee';

//              $bdreason_tab = $this->crg->get('table_prefix') . 'breakdownreasons';

//               $pipeproduction_tab = $this->crg->get('table_prefix') . 'pipeproduction';

            

//             $onlineinspsubdet_tab = $this->crg->get('table_prefix') . 'onlineinspsubdet';

//             $onlineinspmaster_tab = $this->crg->get('table_prefix') . 'onlineinspmaster';

//             $onlineinspdet_tab = $this->crg->get('table_prefix') . 'onlineinspdet';

//             $onlineinspprobdet_tab = $this->crg->get('table_prefix') . 'onlineinspprobdet';

//             $partspecdeta_tab = $this->crg->get('table_prefix') . 'partspecdetail';
            
//             $fgstock_tab = $this->crg->get('table_prefix') . 'fgstock';

            

            

//              //WO select box data 

//             // $sqlwodet= "SELECT ID,BatchNo FROM $workorder_tab WHERE $workorder_tab.entity_ID = $entityID and $workorder_tab.ID in (Select workorder_ID from $pipeproduction_tab )  order by ID desc";

//             $sqlwodet= "SELECT  distinct $workorder_tab.ID,$workorder_tab.BatchNo FROM $workorder_tab, $pipeproduction_tab WHERE $workorder_tab.ID = $pipeproduction_tab.workorder_ID AND $workorder_tab.entity_ID = $entityID order by ID desc";

//             $stmt = $this->db->prepare($sqlwodet);

//             $stmt->execute();

//             $wo_data  = $stmt->fetchAll(2);	

            

//             $this->tpl->set('wo_data', $wo_data);


            

            

//             //PipeProductionShift

            

//             $sqlwodet= "SELECT $pipeproduction_tab.ID,Concat(DATE_FORMAT($pipeproduction_tab.AuditDateTime,'%d/%m/%Y'),'-',ShiftName) as ShiftName FROM $pipeproduction_tab,$shift_tab WHERE $pipeproduction_tab.shift_ID=$shift_tab.ID AND $pipeproduction_tab.entity_ID = $entityID order by ID desc";            

//             $stmt = $this->db->prepare($sqlwodet);

//             $stmt->execute();

//             $ppshift_data  = $stmt->fetchAll(2);	

            

//             $this->tpl->set('ppshift_data', $ppshift_data);

            

            

//              //BDReason select box data 

//             $sqlbddet= "SELECT ID,Description FROM $bdreason_tab WHERE $bdreason_tab.entity_ID = $entityID";            

//             $stmt = $this->db->prepare($sqlbddet);            

//             $stmt->execute();

//             $bd_data  = $stmt->fetchAll(2);	

            

//             $this->tpl->set('BDreason_data', $bd_data);

            

//              //Shift select box data 

//             $sqlshiftdet= "SELECT ID,ShiftName FROM $shift_tab WHERE $shift_tab.entity_ID = $entityID";            

//             $stmt = $this->db->prepare($sqlshiftdet);            

//             $stmt->execute();

//             $shift_data  = $stmt->fetchAll(2);	

            

//             $this->tpl->set('shift_data', $shift_data);

            

//              //Employee select box data 

//             $sqlempdet= "SELECT ID,EmpName FROM $employee_tab WHERE $employee_tab.entity_ID = $entityID";            

//             $stmt = $this->db->prepare($sqlempdet);            

//             $stmt->execute();

//             $empl_data  = $stmt->fetchAll(2);	

            

//             $this->tpl->set('empl_data', $empl_data);

            

            

//             //Product select box data 

//             $sqlproductdet= "SELECT ID,ItemName FROM $product_tab WHERE $product_tab.entity_ID = $entityID";            

//             $stmt = $this->db->prepare($sqlproductdet);            

//             $stmt->execute();

//             $product_data  = $stmt->fetchAll(2);	

            

//             $this->tpl->set('product_data', $product_data);

            

            

//             //SOP Parameter data 

//             $sqlSOPMaster= "SELECT $SOPMaster_tab.ID,$SOPMaster_tab.ParameterName,$unit_tab.UnitName, $SOPMaster_tab.Spec,$SOPMaster_tab.GroupName FROM $SOPMaster_tab,$unit_tab where $SOPMaster_tab.unit_ID=$unit_tab.ID and ($SOPMaster_tab.GroupName <>'' ) ";            

           

//             $stmt = $this->db->prepare($sqlSOPMaster);            

//             $stmt->execute();

//             $SOPMaster_data  = $stmt->fetchAll();

            

//             $this->tpl->set('SOPMaster_data', $SOPMaster_data);

            

            



//             $this->tpl->set('page_title', 'On-line Inspection Entry');	          

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

//                 case 'delete':                    

//                       $data = trim($_POST['ycs_ID']);

//                       // var_dump($data); 

                       

                       

//                     if (!$data) {

//                         $this->tpl->set('message', 'Please select any one ID to '.$crud_string.'!');

//                         $this->tpl->set('label', 'List');

//                         $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));

                       

//                     }

                     

//                      $sqldetdelete="Delete $onlineinspmaster_tab,$onlineinspsubdet_tab,$onlineinspprobdet_tab,$onlineinspdet_tab from $onlineinspmaster_tab

//                                         LEFT JOIN  $onlineinspdet_tab ON $onlineinspmaster_tab.ID=$onlineinspdet_tab.onlineinspmaster_ID 

//                                         LEFT JOIN  $onlineinspsubdet_tab ON $onlineinspmaster_tab.ID=$onlineinspsubdet_tab.onlineinspmaster_ID 

//                                         LEFT JOIN  $onlineinspprobdet_tab ON $onlineinspmaster_tab.ID=$onlineinspprobdet_tab.onlineinspmaster_ID 

//                                         where $onlineinspdet_tab.onlineinspmaster_ID=$data and $onlineinspsubdet_tab.onlineinspmaster_ID=$data and $onlineinspprobdet_tab.onlineinspmaster_ID=$data"; 

//                         $stmt = $this->db->prepare($sqldetdelete);            

                        

//                         if($stmt->execute()){

//                         $this->tpl->set('message', 'online inspection deleted successfully');

//                          $this->tpl->set('label', 'List');

//                         $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));

//                         }

//             break;

//                 case 'view':

                    

//                     include_once 'util/genUtil.php';

//                     $util = new GenUtil();

//                     $form_post_data = $util->arrFltr($_POST);

//                 case 'edit':                    

//                       $data = trim($_POST['ycs_ID']);

                    

                

//                     if (!$data) {

//                         $this->tpl->set('message', 'Please select any one ID to '.$crud_string.'!');

//                         $this->tpl->set('label', 'List');

//                         $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));

//                         break;

//                     }

                    

                  

                    

//                     //mode of form submit

//                     $this->tpl->set('mode', $crud_string);

                  

//                     //set id to edit $ycs_ID

//                     $this->tpl->set('ycs_ID', $data);         

                                

//                     $sqlpro="Select product_ID from $SOP_tab where $SOP_tab.ID=$data" ;           

//                     $stmt = $this->db->prepare($sqlpro);            

//                     $stmt->execute();

//                     $productID = $stmt->fetch(4);

                 

//                   $sqlsrr = "select $partspecdeta_tab.ID, $onlineinspmaster_tab.TotInspQty,$onlineinspmaster_tab.AcceptedQty,$onlineinspmaster_tab.ReworkQty,$onlineinspmaster_tab.pipeproduction_ID,"

//                                 ."$onlineinspmaster_tab.RejectedQty,$onlineinspmaster_tab.RejectionPPM,$onlineinspmaster_tab.ReworkPPM,$equipment_tab.EquipmentName,"

//                                 ."$onlineinspmaster_tab.ProbDesc,$onlineinspmaster_tab.ProbQty,$onlineinspmaster_tab.workorder_ID,$product_tab.ID as product_ID,CONCAT($product_tab.ItemName, ' ', $product_tab.Description) AS ItemName, "

//                                 ."$onlineinspmaster_tab.shift_ID,$onlineinspmaster_tab.operator_ID,$partspecdeta_tab.Parameter,"

//                                 ."$partspecdeta_tab.ParamValue,$onlineinspdet_tab.InsValue1,$onlineinspdet_tab.InsValue2,"

//                                 ."$onlineinspdet_tab.InsValue3,$onlineinspdet_tab.InsValue4,$onlineinspdet_tab.InsValue5,"

//                                 ."$onlineinspdet_tab.InsValue6,$onlineinspdet_tab.InsValue7,$onlineinspdet_tab.InsValue8,"

//                                 ."$onlineinspdet_tab.InsResult from $onlineinspmaster_tab,$onlineinspdet_tab,$workorder_tab,$partspecdeta_tab,$product_tab,$shift_tab,$equipment_tab "

//                                 ."where $onlineinspdet_tab.onlineinspmaster_ID=$onlineinspmaster_tab.ID  and $partspecdeta_tab.ID=$onlineinspdet_tab.partspecdetail_ID " 

//                                 ."and $workorder_tab.ID=$onlineinspmaster_tab.workorder_ID and $onlineinspmaster_tab.shift_ID=$shift_tab.ID " 

//                                 ." and $workorder_tab.product_ID=$product_tab.ID and $partspecdeta_tab.equipment_ID=$equipment_tab.ID  and $onlineinspmaster_tab.id=$data group by $partspecdeta_tab.ID order by $partspecdeta_tab.ID";

                                

//                     $onlineinspdet_data = $dbutil->getSqlData($sqlsrr);             

//                     $this->tpl->set('FmData', $onlineinspdet_data); 

                    

                    

//                  $sqlsubrr =  "SELECT  $SOPMaster_tab.ID, $onlineinspsubdet_tab.parametername as ParameterName,$SOPMaster_tab.GroupName,$SOPMaster_tab.Spec,"

//                                   ."$onlineinspsubdet_tab.FPA,$onlineinspsubdet_tab.MPA,$onlineinspsubdet_tab.LPA "

//                                   ."FROM $onlineinspsubdet_tab "

//                                   ."left OUTER join $SOPMaster_tab on  $onlineinspsubdet_tab.sopmaster_ID=$SOPMaster_tab.ID where $onlineinspsubdet_tab.onlineinspmaster_ID=$data order by $onlineinspsubdet_tab.ID asc";

                    

                                  

//                     $onlineinspsubdet_data = $dbutil->getSqlData($sqlsubrr);             

//                     $this->tpl->set('FmsubData', $onlineinspsubdet_data); 

                    

//                     $sql_sub = "SELECT $onlineinspprobdet_tab.ProbDesc,$onlineinspprobdet_tab.ProbQty FROM $onlineinspprobdet_tab WHERE $onlineinspprobdet_tab.onlineinspmaster_ID ='$data'";                    

//                     $onlineinspprobdet_data = $dbutil->getSqlData($sql_sub);             

//                     $this->tpl->set('FmDataSub', $onlineinspprobdet_data);

                    

                    

//                     $this->tpl->set('message', 'You can '.$crud_string);

//                     $this->tpl->set('page_header', 'Sales');

                    

//                     $this->tpl->set('content', $this->tpl->fetch('factory/form/onlineinspection.php'));                    

//                     break;

                    

                   

             

//                 case 'editsubmit':             

//                     $data = trim($_POST['ycs_ID']);

                  

//                     //mode of form submit

//                     $this->tpl->set('mode', 'edit');

//                     //set id to edit $ycs_ID

//                     $this->tpl->set('ycs_ID', $data);

//                     try{

//                      if (isset($crud_string)) {

                    

//                             $form_post_data = $dbutil->arrFltr($_POST);

                            

// //var_dump($form_post_data);

//                         $entry_count = 1;

//                         $entry_count1=1;

//                         $entry_count2=1;

                       

//                                                 $productID = $_POST['productID'];

//                                                 $workorder_ID = $_POST['workorder_ID'];

//                                                 $shift=$form_post_data['Shift'];

//                                                 $operator=$form_post_data['OperatorName'] ;

//                                                 $InspDate=date("Y-m-d", strtotime($form_post_data['InspDate']));

//                                                 $productiontime=$form_post_data['productiontime'] ;

//                                                 $TotInspQty=$form_post_data['TotInspQty'];

//                                                 $RejectionPPM=$form_post_data['RejectionPPM'] ;

//                                                 $AcceptedQty=$form_post_data['AcceptedQty'];

//                                                 $ReworkPPM=$form_post_data['ReworkPPM'] ;

//                                                 $ReworkQty=$form_post_data['ReworkQty'];

//                                                 $ProbDesc=$form_post_data['ProbDesc'] ;

//                                                 $RejectedQty=$form_post_data['RejectedQty'];

//                                                 $ProblemQty=$form_post_data['ProblemQty'] ;

//                                                 $ppID=$form_post_data['PPShift'] ;

                                                

//                         $sql2= "Update $onlineinspmaster_tab set "

//                                                     // ." `workorder_ID`='$workorder_ID'," 

//                                                      ." `shift_ID`='$shift',"

//                                                      ."`pipeproduction_ID`='$ppID',"

//                                                      ."`operator_ID`='$operator',"

//                                                      ."`InspDate`='$InspDate',"

//                                                      ."`InspTime`='$productiontime'," 

//                                                      ."`TotInspQty`='$TotInspQty',"  

//                                                      ."`RejectionPPM`='$RejectionPPM'," 

//                                                      ."`AcceptedQty`='$AcceptedQty'," 

//                                                      ."`ReworkPPM`='$ReworkPPM'," 

//                                                      ."`ReworkQty`='$ReworkQty'," 

//                                                       ."`ProbDesc`='$ProbDesc'," 

//                                                       ."`RejectedQty`='$RejectedQty'," 

//                                                       ."`ProbQty`='$ProblemQty' where ID=$data";

                                                     

//                         $stmt = $this->db->prepare($sql2);  

//                         $entry_count=1;

                     

//                          if ($stmt->execute()) { 

                            

//                         //$sqldetdelete="Delete $onlineinspmaster_tab,$onlineinspdet_tab from $onlineinspmaster_tab LEFT JOIN  $onlineinspdet_tab ON $onlineinspmaster_tab.ID=$onlineinspdet_tab.onlineinspmaster_ID where $onlineinspdet_tab.onlineinspmaster_ID=$data" ; 

        

//                         $sqldetdelete="Delete from $onlineinspdet_tab where $onlineinspdet_tab.onlineinspmaster_ID=$data" ; 

//                         $stmt = $this->db->prepare($sqldetdelete);            

//                         $stmt->execute();

                       

                    

//                         FOR ($entry_count; $entry_count <= $form_post_data['partSpecmaxCount'];) {

                               

//                                 $partspec_ID ='RMID_' . $entry_count;

//                                 $Obs1='Obs1_' . $entry_count ;

//                                 $Obs2='Obs2_'. $entry_count;

//                                 $Obs3='Obs3_'. $entry_count;

//                                 $Obs4='Obs4_'. $entry_count;

//                                 $Obs5='Obs5_' . $entry_count;

//                                 $Obs6='Obs6_'. $entry_count;

//                                 $Obs7='Obs7_'. $entry_count;

//                                 $Obs8='Obs8_'. $entry_count;

//                                 $ObsResult='Result_'. $entry_count;



//                                 $vals = "'" . $data . "'," .

//                                         "'" . $form_post_data[$partspec_ID] . "'," .

//                                          "'" . $form_post_data[$Obs1] . "'," .

//                                          "'" . $form_post_data[$Obs2] . "'," .

//                                          "'" . $form_post_data[$Obs3] . "'," .

//                                           "'" . $form_post_data[$Obs4] . "'," .

//                                          "'" . $form_post_data[$Obs5] . "'," .

//                                          "'" . $form_post_data[$Obs6] . "'," .

//                                           "'" . $form_post_data[$Obs7] . "'," .

//                                          "'" . $form_post_data[$Obs8] . "'," .

//                                          "'" . $form_post_data[$ObsResult] . "'" ;

                                       

//                                          //"'" . $form_post_data[$Temp] . "'";

                                 

//                           $sql2 = "INSERT INTO $onlineinspdet_tab

//                                         ( 

//                                 `onlineinspmaster_ID`, 

//                                 `partspecdetail_ID`,

//                                 `InsValue1`,

//                                 `InsValue2`,

//                                 `InsValue3`,

//                                  `InsValue4`,

//                                 `InsValue5`,

//                                 `InsValue6`,

//                                  `InsValue7`,

//                                 `InsValue8`,

//                                 `InsResult`

//                                  ) 

//                                 VALUES ($vals)";



//                                  // this need to be changed in to transaction type

                                

//                                 $stmt = $this->db->prepare($sql2);

//                                 $detailIns = $stmt->execute();

//                                   //increment here

//                                 $entry_count++;

                                

//                             }
                            
                            
//                             //  $actItemNo=$form_post_data['product_ID'];
//                             //  $actQuantity=$form_post_data['AcceptedQty'];
//                             //  $availableqty=$form_post_data['Availableqty']; 
                                  
//                             //  $sqlsrr="SELECT item_ID,TotalQty FROM $fgstock_tab where item_ID=$actItemNo AND entity_ID=$entityID"; 
//                             //  $fgstock_data = $dbutil->getSqlData($sqlsrr);
//                             //  $count=count($fgstock_data);
                             
                            
                                  
//                             //  commented for fg stock insertion on fg register if($count>0){
//                             //     $sql_updt_fgstock = "UPDATE $fgstock_tab SET TotalQty=TotalQty-$availableqty+$actQuantity WHERE item_ID=$actItemNo AND entity_ID=$entityID";
//                             //     $stmt = $this->db->prepare($sql_updt_stock);
//                             // }
//                             // else{
//                             //      $sql_updt_fgstock = "INSERT INTO $fgstock_tab 
//                             //     (
                                
//                             //     item_ID,
//                             //     TotalQty,
//                             //     entity_ID,
//                             //     users_ID
//                             //     )
//                             //     VALUES (
//                             //         $actItemNo,
//                             //         $actQuantity,
//                             //         $entityID,
//                             //         $userID);";
                                    
//                             //     $stmt = $this->db->prepare($sql_updt_fgstock);
//                             // }
//                             // $stmt->execute();

                             

//                          }

                         

//                         //$stmt = $this->db->prepare($sqlupdate);  

//                         $entry_count1=1;

                     

//                          if ($detailIns) { 

//                         //$sqldelete="Delete $onlineinspmaster_tab,$onlineinspsubdet_tab from $onlineinspmaster_tab LEFT JOIN $onlineinspsubdet_tab ON $onlineinspmaster_tab.ID=$onlineinspsubdet_tab.onlineinspmaster_ID where $onlineinspsubdet_tab.onlineinspmaster_ID=$data"; 

//                         $sqldelete="Delete from $onlineinspsubdet_tab where $onlineinspsubdet_tab.onlineinspmaster_ID=$data"; 

//                         $stmt = $this->db->prepare($sqldelete);            

//                         $stmt->execute();

                                       

//                             FOR ($entry_count1; $entry_count1 <= $form_post_data['maxCount'];) {

                               

//                                 $ParamName ='ItemNo_' . $entry_count1;

//                                 $SOPID ='ItemName_' . $entry_count1;

//                                 $FPA='FPA_' . $entry_count1;

//                                 $MPA='MPA_'. $entry_count1;

//                                 $LPA='LPA_'. $entry_count1;

                                

                                

                                

//                                 $vals = "'" . $data . "'," .

//                                         "'" . $form_post_data[$SOPID] . "'," .

//                                         "'" . $form_post_data[$ParamName] . "'," .

//                                          "'" . $form_post_data[$FPA] . "'," .

//                                          "'" . $form_post_data[$MPA] . "'," .

//                                          "'" . $form_post_data[$LPA] . "'" ;

                                          

                                 

//                           $sql2 = "INSERT INTO $onlineinspsubdet_tab

//                                         ( 

//                                 `onlineinspmaster_ID`,

//                                 `sopmaster_ID`,

//                                 `parametername`,

//                                 `FPA`,

//                                 `MPA`,

//                                 `LPA`

//                                  ) 

//                                 VALUES ($vals)";



//                                  // this need to be changed in to transaction type

                                

//                                 $stmt = $this->db->prepare($sql2);

//                                 $subDetIns = $stmt->execute();

//                                   //increment here

//                                 $entry_count1++;

                                

                          

//                             }

                             

//                          }

                                  

                       

//                                 //$stmt = $this->db->prepare($sql2);

//                                   $entry_count2=1;

//                                   if ($subDetIns) { 

                                  

//                                   // $sqldelete="Delete $onlineinspmaster_tab,$onlineinspprobdet_tab from $onlineinspmaster_tab,$onlineinspprobdet_tab LEFT JOIN $onlineinspprobdet_tab ON $onlineinspmaster_tab.ID=$onlineinspprobdet_tab.onlineinspmaster_ID where $onlineinspprobdet_tab.onlineinspmaster_ID=$data"; 

//                                  $sqldelete="Delete from $onlineinspprobdet_tab where $onlineinspprobdet_tab.onlineinspmaster_ID=$data"; 

//                                     $stmt = $this->db->prepare($sqldelete);            

//                                     $stmt->execute();

                                 

//                                 FOR ($entry_count2; $entry_count2 <= $form_post_data['maxCountSub'];) {

                               

//                                 $prbqty ='Water_' . $entry_count2;

//                                 $ProbDesc ='Rat_' . $entry_count2;

                                

                                

//                                 $vals = "'" . $data . "'," .

//                                         "'" . $form_post_data[$prbqty] . "'," .

//                                         "'" . $form_post_data[$ProbDesc] . "'" ;

                                         

                                          

                                 

//                         $sql2 = "INSERT INTO $onlineinspprobdet_tab

//                                         ( 

//                                 `onlineinspmaster_ID`,

//                                 `ProbDesc`,

//                                 `ProbQty`

                                

//                                  ) 

//                                 VALUES ($vals)";





//                                  // this need to be changed in to transaction type

                                

//                                 $stmt = $this->db->prepare($sql2);

//                                 $stmt->execute();

//                                   //increment here

//                                 $entry_count2++;

                                

                                

//                      }

                            

//                      }

                          

                            

//                      }

                     

//                             $this->tpl->set('message', 'On-line Inspection Entry  edited successfully!');  

//                             $this->tpl->set('label', 'List');

//                             $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));

//                             } catch (Exception $exc) {

//                              //edit failed option

//                             $this->tpl->set('message', 'Failed to edit, try again!');

//                             $this->tpl->set('FmData', $form_post_data);

//                             $this->tpl->set('content', $this->tpl->fetch('factory/form/onlineinspection.php'));

//                             }

                            

//                      break;



//                 case 'addsubmit':

//                      if (isset($crud_string)) {

                         

//                         $form_post_data = $dbutil->arrFltr($_POST);

                      

//                          $entry_count = 1;

//                          $entry_count1 = 1;

//                          $entry_count2 = 1;



//                             if (isset($form_post_data['BatchNo'])) {


//                                         $vals = "'" . $form_post_data['BatchNo'] . "'," .

//                                                 "'" . $form_post_data['Shift'] ."'," .

//                                                 "'" . $form_post_data['PPShift'] ."'," .

//                                                 "'" . $form_post_data['OperatorName'] . "'," .

//                                                 "'" . date("Y-m-d", strtotime($form_post_data['InspDate'])) . "'," .

//                                                 "'" . $form_post_data['productiontime'] . "'," .

//                                                 "'" . $form_post_data['TotInspQty'] ."'," .

//                                                 "'" . $form_post_data['RejectionPPM'] . "'," .

//                                                 "'" . $form_post_data['AcceptedQty'] ."'," .

//                                                 "'" . $form_post_data['ReworkPPM'] . "'," .

//                                                 "'" . $form_post_data['ReworkQty'] ."'," .

//                                                 "'" . $form_post_data['ProbDesc'] . "'," .

//                                                 "'" . $form_post_data['RejectedQty'] ."'," .

//                                                 "'" . $form_post_data['ProblemQty'] . "'," .

//                                               "'" .  $this->ses->get('user')['entity_ID'] . "'," .

//                                                 "'" .  $this->ses->get('user')['ID'] . "'";

                                         

//                                         $sql2 = "INSERT INTO $onlineinspmaster_tab" .

//                                                 "( 

//                                                      `workorder_ID`,

//                                                      `shift_ID`,

//                                                      `pipeproduction_ID`,

//                                                      `operator_ID`,

//                                                      `InspDate`,

//                                                      `InspTime`,

//                                                      `TotInspQty`, 

//                                                      `RejectionPPM`,

//                                                      `AcceptedQty`,

//                                                      `ReworkPPM`,

//                                                      `ReworkQty`,

//                                                       `ProbDesc`,

//                                                       `RejectedQty`,

//                                                       `ProbQty`,

//                                                       `entity_ID`,

//                                                       `users_ID`

//                                       ) 

//                                         VALUES ($vals)";

        

//                                         // this need to be changed in to transaction type

                                        

//                                         $stmt = $this->db->prepare($sql2);

                                       

//                                           //increment here

                                       

//                                       if ($stmt->execute()) { 
                                           
                                           

//                         $lastInsertedID = $this->db->lastInsertId();

//                         FOR ($entry_count; $entry_count <= $form_post_data['partSpecmaxCount'];) {

                               

//                                 $partspec_ID ='RMID_' . $entry_count;

//                                 $Obs1='Obs1_' . $entry_count ;

//                                 $Obs2='Obs2_'. $entry_count;

//                                 $Obs3='Obs3_'. $entry_count;

//                                 $Obs4='Obs4_'. $entry_count;

//                                 $Obs5='Obs5_' . $entry_count;

//                                 $Obs6='Obs6_'. $entry_count;

//                                 $Obs7='Obs7_'. $entry_count;

//                                 $Obs8='Obs8_'. $entry_count;

//                                 $ObsResult='Result_'. $entry_count;



//                                 $vals = "'" . $lastInsertedID . "'," .

//                                         "'" . $form_post_data[$partspec_ID] . "'," .

//                                          "'" . $form_post_data[$Obs1] . "'," .

//                                          "'" . $form_post_data[$Obs2] . "'," .

//                                          "'" . $form_post_data[$Obs3] . "'," .

//                                          "'" . $form_post_data[$Obs4] . "'," .

//                                          "'" . $form_post_data[$Obs5] . "'," .

//                                          "'" . $form_post_data[$Obs6] . "'," .

//                                          "'" . $form_post_data[$Obs7] . "'," .

//                                          "'" . $form_post_data[$Obs8] . "'," .

//                                          "'" . $form_post_data[$ObsResult] . "'" ;

                                       

//                                          //"'" . $form_post_data[$Temp] . "'";

                                 

//                           $sql2 = "INSERT INTO $onlineinspdet_tab

//                                         ( 

//                                 `onlineinspmaster_ID`, 

//                                 `partspecdetail_ID`,

//                                 `InsValue1`,

//                                 `InsValue2`,

//                                 `InsValue3`,

//                                 `InsValue4`,

//                                 `InsValue5`,

//                                 `InsValue6`,

//                                 `InsValue7`,

//                                 `InsValue8`,

//                                 `InsResult`

//                                  ) 

//                                 VALUES ($vals)";



//                                  // this need to be changed in to transaction type

                                

//                                 $stmt = $this->db->prepare($sql2);

//                                 $stmt->execute();
                                
                            

//                                   //increment here

//                                 $entry_count++;

                            


//                             }
//                             //  $actItemNo=$form_post_data['product_ID'];
//                             //  $actQuantity=$form_post_data['AcceptedQty'];
//                             //  $availableqty=$form_post_data['Availableqty']; 
                                  
//                             //  $sqlsrr="SELECT item_ID,TotalQty FROM $fgstock_tab where item_ID=$actItemNo AND entity_ID=$entityID"; 
//                             //  $fgstock_data = $dbutil->getSqlData($sqlsrr);
//                             //  $count=count($fgstock_data);
                             
                            
                                  
//                             //  if($count>0){
//                             //      $sql_updt_fgstock = "UPDATE $fgstock_tab SET TotalQty=TotalQty-$actQuantity WHERE item_ID=$actItemNo AND entity_ID=$entityID";
//                             //     $stmt = $this->db->prepare($sql_updt_stock);
//                             // }
//                             // else{
//                             //      $sql_updt_fgstock = "INSERT INTO $fgstock_tab 
//                             //     (
                                
//                             //     item_ID,
//                             //     TotalQty,
//                             //     entity_ID,
//                             //     users_ID
//                             //     )
//                             //     VALUES (
//                             //         $actItemNo,
//                             //         $actQuantity,
//                             //         $entityID,
//                             //         $userID);";
                                    
//                             //     $stmt = $this->db->prepare($sql_updt_fgstock);
//                             // }
//                             // $stmt->execute();

//                             }

//                             }

//                              $stmt = $this->db->prepare($sql2);

//                              $entry_count1=1;

                            

//                                           //increment here

//                             if ($stmt->execute()) { 

                                       

//                                     FOR ($entry_count1; $entry_count1 <= $form_post_data['maxCount'];) {

                               

//                                 $ParamName ='ItemNo_' . $entry_count1;

//                                 $SOPID ='ItemName_' . $entry_count1;

//                                 $FPA='FPA_' . $entry_count1;

//                                 $MPA='MPA_'. $entry_count1;

//                                 $LPA='LPA_'. $entry_count1;

                                

//                               //  var_dump($form_post_data[$SOPID]);

                                

//                                 $vals = "'" . $lastInsertedID . "'," .

//                                         "'" . $form_post_data[$SOPID] . "'," .

//                                         "'" . $form_post_data[$ParamName] . "'," .

//                                          "'" . $form_post_data[$FPA] . "'," .

//                                          "'" . $form_post_data[$MPA] . "'," .

//                                          "'" . $form_post_data[$LPA] . "'" ;

                                          

                                 

//                           $sql2 = "INSERT INTO $onlineinspsubdet_tab

//                                         ( 

//                                 `onlineinspmaster_ID`,

//                                 `sopmaster_ID`,

//                                 `parametername`,

//                                 `FPA`,

//                                 `MPA`,

//                                 `LPA`

//                                  ) 

//                                 VALUES ($vals)";





//                                  // this need to be changed in to transaction type

                                

//                                 $stmt = $this->db->prepare($sql2);

//                                 $stmt->execute();

//                                   //increment here
                                    
                            

//                                 $entry_count1++;

                                

                          

//                                     }

//                                       }

//                                 $stmt = $this->db->prepare($sql2);

//                                 $entry_count2=1;

                            

//                                           //increment here

//                                 if ($stmt->execute()) { 

                                    

                                    

//                         //////newly added

                        

//                                 FOR ($entry_count2; $entry_count2 <= $form_post_data['maxCountSub'];) {

                               

//                                 $prbqty ='Water_' . $entry_count2;

//                                 $ProbDesc ='Rat_' . $entry_count2;

                                

                                

//                                 $vals = "'" . $lastInsertedID . "'," .

//                                         "'" . $form_post_data[$prbqty] . "'," .

//                                         "'" . $form_post_data[$ProbDesc] . "'" ;

                                         

                                          

                                 

//                         $sql2 = "INSERT INTO $onlineinspprobdet_tab

//                                         ( 

//                                 `onlineinspmaster_ID`,

//                                 `ProbDesc`,

//                                 `ProbQty`

                                

//                                  ) 

//                                 VALUES ($vals)";





//                                  // this need to be changed in to transaction type

                                

//                                 $stmt = $this->db->prepare($sql2);

//                                 $stmt->execute();

//                                   //increment here

//                                 $entry_count2++;

                                

                          

//                                     }

//                             }

                          

                            

                             

//                         $this->tpl->set('message', '- Success -');

//                         $this->tpl->set('mode', 'add');
                        
//                         $this->tpl->set('label', 'List');

//                         $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));

//                       // $this->tpl->set('content', $this->tpl->fetch('factory/form/onlineinspection.php'));

//                         $this->tpl->set('master_layout', 'layout_datepicker.php');

//                      } else {

//                             //edit option

//                             //if submit failed to insert form

//                             $this->tpl->set('message', 'Failed to submit!');

//                             $this->tpl->set('FmData', $form_post_data);

//                             $this->tpl->set('content', $this->tpl->fetch('factory/form/onlineinspection.php'));

                     

//                              $this->tpl->set('master_layout', 'layout_datepicker.php');

//                      }

//                     break;

//                 case 'add':

//                     // var_dump($_POST);

//                      $this->tpl->set('master_layout', 'layout_datepicker.php');

//                     $this->tpl->set('mode', 'add');

//                     $this->tpl->set('content', $this->tpl->fetch('factory/form/onlineinspection.php'));

//                     break;



//                 default:

//                     /*

//                      * List form

//                      */

                    

//                   $whereString = '';

            

//                         $colArr = array(

//                             "$onlineinspmaster_tab.ID",

//                               "$workorder_tab.BatchNo",

//                                 "CONCAT($product_tab.ItemName,' ',$product_tab.Description)AS ItemName",

//                               "$shift_tab.ShiftName",  

//                             "DATE_FORMAT($onlineinspmaster_tab.InspDate, '%d-%m-%Y') AS InspDate",

//                             "TotInspQty", 

//                             "RejectionPPM",

//                             "AcceptedQty",

//                             "ReworkPPM",

//                             "ReworkQty",

//                             "$onlineinspprobdet_tab.ProbDesc",

//                             "RejectedQty",

//                             "$onlineinspprobdet_tab.ProbQty"

//                             );

                        

//                         $this->tpl->set('FmData', $_POST);

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



// 		            if (strpos($colNames, 'Date') !== false) {

//                           list($colNames,$x) = $dbutil->dateFilterFormat($colNames);

//                     }else if(strpos($colNames, 'CONCAT') !== false){

//                           if(preg_match('/-/', $colNames)){

//                               if($dbutil->concatFilterFormat($colNames)){

//                                  $wsarr[] = $dbutil->concatFilterFormat($colNames,'spc');

//                               }

//                           }else{

//                             if($dbutil->concatFilterFormat($colNames)){

//                             $wsarr[] = $dbutil->concatFilterFormat($colNames);

//                             }  

//                           }

//                     }else {

//         		          $x = $dbutil->__mdsf($PD[str_replace('.','_',$colNames)]);

//                     }



//                     if ('' != $x) {

//                         $wsarr[] = $colNames . " LIKE '%" . $x . "%'";

//                     }

//                 }

                

//               IF (count($wsarr) >= 1) {

//                  $whereString = ' AND '. implode(' AND ', $wsarr);

//               }

//             } 

                

//             $orderBy ="GROUP BY $onlineinspmaster_tab.ID ORDER BY $onlineinspmaster_tab.ID DESC";

           

            

//             $sql = "SELECT "

//                  . implode(',',$colArr)

//                  . " FROM $onlineinspmaster_tab,$workorder_tab,$shift_tab,$onlineinspprobdet_tab,$product_tab"

//                  . " WHERE "

//                  . " $workorder_tab.ID=$onlineinspmaster_tab.workorder_ID AND "

//                  . " $workorder_tab.product_ID=$product_tab.ID AND "

//                  . " $shift_tab.ID=$onlineinspmaster_tab.shift_ID AND "

//                  . " $onlineinspprobdet_tab.onlineinspmaster_ID=$onlineinspmaster_tab.ID AND "

//                  . " $onlineinspmaster_tab.entity_ID = $entityID"

//                  . " $whereString"

//                  . " $orderBy";

            

         

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

//             /*

//              * set table label

//              */

             

//             $this->tpl->set('table_columns_label_arr', array('Production ID','BatchNo','Part No','Shift','Inspection Date','TotInspQty','Rejection PPM','Accepted Qty','Rework PPM','Rework Qty','ProbDesc','Rejected Qty','Prob Qty'));

                            

//                             /*

//                 ,'Chiller Temp '             * selectColArr for filter form

//                              */

                            

//                 $this->tpl->set('selectColArr',$colArr);

                        

//             /*

//              * set pagination template

//              */

//             $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');

            

//                     include_once $this->tpl->path . '/factory/form/onlineinsp_crud_form.php';

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

    

 //end

  function manage() {

        if ($this->crg->get('wp') || $this->crg->get('rp')) {

//////////////////////////////////////////////////////////////////////////////////

//////////////////////////////access condition applied///////////////////////////

//////////////////////////////////////////////////////////////////////////////// 

          

           include_once 'util/DBUTIL.php';

           $dbutil = new DBUTIL($this->crg);

             

             $entityID = $this->ses->get('user')['entity_ID'];

             $userID = $this->ses->get('user')['ID'];

            

           

        $pdttype_table = $this->crg->get('table_prefix') . 'producttype';

        $unit_table = $this->crg->get('table_prefix') . 'unit';

            

        $pdt_table = $this->crg->get('table_prefix') . 'product'; 



            ////////////////////start//////////////////////////////////////////////

                    

           //bUILD SQL 

            $whereString = '';

            

            $colArr = array(

                "$pdt_table.ID", 

                "$pdttype_table.ProductType",

                "$pdt_table.Type", 

                "$pdt_table.ItemCode", 

                "$pdt_table.ItemName",

                "$pdt_table.Description", 

                "a.UnitName",

                "$pdt_table.weight",

                "b.UnitName",

                "$pdt_table.CycleTime", 

                "$pdt_table.ThresholdQuantity"

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

            

            $orderBy ="ORDER BY $pdt_table.ID DESC";

            

    $sql = "SELECT "

                 . implode(',',$colArr)

                 . " FROM $pdt_table,$pdttype_table,$unit_table as a,$unit_table as b "

                 . " WHERE "

                 . " $pdttype_table.ID = $pdt_table.Producttype_ID AND "

                 . " a.ID =$pdt_table.unit_ID AND "

                 . " b.ID =$pdt_table.WeightUnit AND "

                 . " $pdt_table.entity_ID = $entityID  "

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

            $this->tpl->set('table_columns_label_arr', array('ID','Product Type','Type of Product','Product Code','Part No','Part Name','Product Unit','Weight','Weight Unit','Cycle Time','Threshold Quantity'));

            

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

    

    //end

    function rawmaterial() {

        if ($this->crg->get('wp') || $this->crg->get('rp')) {

//////////////////////////////////////////////////////////////////////////////////

//////////////////////////////access condition applied///////////////////////////

//////////////////////////////////////////////////////////////////////////////// 

          

           include_once 'util/DBUTIL.php';

           $dbutil = new DBUTIL($this->crg);

             

             $entityID = $this->ses->get('user')['entity_ID'];

             $userID = $this->ses->get('user')['ID'];

            

           

        $rawmaterial_table = $this->crg->get('table_prefix') . 'rawmaterial';

        $unit_table = $this->crg->get('table_prefix') . 'unit';

        $rawmaterialtype_table = $this->crg->get('table_prefix') . 'rawmaterialtype';

        

            

        



            ////////////////////start//////////////////////////////////////////////

                    

           //bUILD SQL 

            $whereString = '';

            

            $colArr = array(

                "$rawmaterial_table.ID", 

                "$rawmaterial_table.RMCode",

                "$rawmaterialtype_table.RawMaterialType",

                "$rawmaterial_table.RMName", 

                "$rawmaterial_table.Grade",

                "$unit_table.UnitName",

                "$rawmaterial_table.ThresholdQuantity"

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

            

            $orderBy ="ORDER BY $rawmaterial_table.ID DESC";

            

         $sql = "SELECT "

                 . implode(',',$colArr)

                 . " FROM $rawmaterial_table,$unit_table,$rawmaterialtype_table "

                 . " WHERE "

                 . " $unit_table.ID =$rawmaterial_table.unit_ID AND "

                 ."$rawmaterialtype_table.ID = $rawmaterial_table.rawmaterialtype_ID AND"

                 . " $rawmaterial_table.entity_ID = $entityID  "

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

            $this->tpl->set('table_columns_label_arr', array('ID','Raw Material Code','Material Type','Material',' Grade','UOM','Threshold Quantity'));

            

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

    

   //end

    function pipe(){

     if ($this->crg->get('wp') || $this->crg->get('rp')) {

 ////////////////////////////////////////////////////////////////////////////////

 //////////////////////////////access condition applied//////////////////////////

 ////////////////////////////////////////////////////////////////////////////////    

                // var_dump($_POST); 

            include_once 'util/DBUTIL.php';

            $dbutil = new DBUTIL($this->crg);

             

            $entityID = $this->ses->get('user')['entity_ID'];

            $userID = $this->ses->get('user')['ID'];

            

            $SOPMaster_tab = $this->crg->get('table_prefix') . 'SOPMaster';

            $product_tab = $this->crg->get('table_prefix') . 'product';

             $unit_tab = $this->crg->get('table_prefix') . 'unit';

            $SOP_tab = $this->crg->get('table_prefix') . 'SOP';

            

            $workorder_tab = $this->crg->get('table_prefix') . 'workorder';

            $machine_tab = $this->crg->get('table_prefix') . 'machinemaster';

            $shift_tab = $this->crg->get('table_prefix') . 'shifttiming';

            $employee_tab = $this->crg->get('table_prefix') . 'employee';

            $bdreason_tab = $this->crg->get('table_prefix') . 'breakdownreasons';

            $pipeproduction_tab = $this->crg->get('table_prefix') . 'pipeproduction';

            $dailyproduction_tab = $this->crg->get('table_prefix') . 'dailyprodplan';

            $pipeproductionraw_tab = $this->crg->get('table_prefix') . 'pprawmaterialdet';

            $productionbrkdwn_tab = $this->crg->get('table_prefix') . 'productionbreakdowndet';

            $matissuemaster_tab=$this->crg->get('table_prefix') . 'MaterialIssueMaster';


             

             	

        	$customerTableName =  $this->crg->get('table_prefix') .'customer';

        	$BOMMasterTableName =  $this->crg->get('table_prefix') .'BOMMaster';

        	$BOMDetailTableName =  $this->crg->get('table_prefix') .'BOMDetail';

        	$rawmaterialTableName =  $this->crg->get('table_prefix') .'rawmaterial';

        	$machinemasterTableName =  $this->crg->get('table_prefix') .'machinemaster';

        	

        	$mouldTableName =  $this->crg->get('table_prefix') .'mould';

            

            

             //WO select box data 

            $sqlwodet= "SELECT $workorder_tab.ID,$workorder_tab.BatchNo FROM $workorder_tab,$matissuemaster_tab WHERE $workorder_tab.entity_ID = $entityID and $workorder_tab.ID = $matissuemaster_tab.workorder_ID order by ID desc"; 

            $stmt = $this->db->prepare($sqlwodet);

            $stmt->execute();

            $wo_data  = $stmt->fetchAll(2);	

            

            $this->tpl->set('wo_data', $wo_data);

            

            

             //BDReason select box data 

            $sqlbddet= "SELECT ID,Description FROM $bdreason_tab WHERE $bdreason_tab.entity_ID = $entityID";            

            $stmt = $this->db->prepare($sqlbddet);            

            $stmt->execute();

            $bd_data  = $stmt->fetchAll(2);	

            

            $this->tpl->set('BDreason_data', $bd_data);

            

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

            

            //machine select box data

            

            $sqlmachdet= "SELECT ID,MachineName FROM $machine_tab WHERE $machine_tab.entity_ID = $entityID";            

            $stmt = $this->db->prepare($sqlmachdet);            

            $stmt->execute();

            $mach_data  = $stmt->fetchAll(2);	

            

            $this->tpl->set('mach_data', $mach_data);

            

            //Product select box data 

            $sqlproductdet= "SELECT ID,ItemName FROM $product_tab WHERE $product_tab.entity_ID = $entityID";            

            $stmt = $this->db->prepare($sqlproductdet);            

            $stmt->execute();

            $product_data  = $stmt->fetchAll(2);	

            

            $this->tpl->set('product_data', $product_data);

            

            

            //SOP Parameter data 

            $sqlSOPMaster= "SELECT $SOPMaster_tab.ID,$SOPMaster_tab.ParameterName,$unit_tab.UnitName, $SOPMaster_tab.Spec FROM $SOPMaster_tab,$unit_tab where $SOPMaster_tab.unit_ID=$unit_tab.ID";            

           

            $stmt = $this->db->prepare($sqlSOPMaster);            

            $stmt->execute();

            $SOPMaster_data  = $stmt->fetchAll();

            

            $this->tpl->set('SOPMaster_data', $SOPMaster_data);

            

            



            $this->tpl->set('page_title', 'Pipe Production Sheet');	          

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

                     

                    $sqldetdelete="Delete $pipeproduction_tab,$pipeproductionraw_tab,$productionbrkdwn_tab from $pipeproduction_tab

                                        LEFT JOIN  $pipeproductionraw_tab ON $pipeproduction_tab.ID=$pipeproductionraw_tab.pipeproduction_ID 

                                        LEFT JOIN  $productionbrkdwn_tab ON $pipeproduction_tab.ID=$productionbrkdwn_tab.pipeproduction_ID 

                                        where $pipeproductionraw_tab.pipeproduction_ID=$data and $productionbrkdwn_tab.pipeproduction_ID=$data"; 

                        $stmt = $this->db->prepare($sqldetdelete);            

                        

                        if($stmt->execute()){

                        $this->tpl->set('message', 'Pipe production deleted successfully');

                         $this->tpl->set('label', 'List');

                        $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));

                        }

                    break;

               

                case 'view':                    

                    

                      $data = trim($_POST['ycs_ID']);

                    

                    if (!$data) {

                        $this->tpl->set('message', 'Please select any one ID to View!');

                        $this->tpl->set('label', 'List');

                        $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));

                        break;

                    }

                    

                    //mode of form submit

                    $this->tpl->set('mode', 'view');

                  

                    //set id to edit $ycs_ID

                    $this->tpl->set('ycs_ID', $data);    

                    

                    $sqlsrr = "SELECT * FROM $pipeproduction_tab  where $pipeproduction_tab.ID=$data";                    

                    $pipeprod_data = $dbutil->getSqlData($sqlsrr);             

                    $this->tpl->set('FmData', $pipeprod_data); 

                    

                    $woid=$pipeprod_data[0]['workorder_ID'];

                    $sqlpro="Select product_ID from $workorder_tab where $workorder_tab.ID=$woid" ;           

                    $stmt = $this->db->prepare($sqlpro);            

                    $stmt->execute();

                    $productID = $stmt->fetch(4);

                    

                    $SOPsql_query = "Select ParameterName,SOPValue,GroupName,outputpermin from $SOP_tab,$SOPMaster_tab  where $SOPMaster_tab.ID= $SOP_tab.sopmaster_ID AND product_ID= $productID[0]";

                    $pipeprodsop_data = $dbutil->getSqlData($SOPsql_query);             

                    $this->tpl->set('FmSOPData', $pipeprodsop_data); 

                    

                    

                    

                    $sql_query  = "select DISTINCT $workorder_tab.ID,$customerTableName.FirstName,$rawmaterialTableName.ID as RMID,$rawmaterialTableName.RMName as RawMaterial,$rawmaterialTableName.Grade, $product_tab.ID as ProductID,$product_tab.weight, $product_tab.ItemName,$machinemasterTableName.MachineName,"

                                    ."$mouldTableName.MouldName,$workorder_tab.Quantity,$BOMMasterTableName.MouldQty,$pipeproductionraw_tab.OpeningQty,$pipeproductionraw_tab.InwardQty,$pipeproductionraw_tab.ConsumedQty,$pipeproductionraw_tab.RejectedQty,$pipeproductionraw_tab.ClosingQty "

                                    ." from $workorder_tab,$BOMMasterTableName,$BOMDetailTableName,$customerTableName,$machinemasterTableName,$mouldTableName,$product_tab,"

                                    ."$rawmaterialTableName,$pipeproductionraw_tab where  $workorder_tab.customer_ID= $customerTableName.ID "

                                    ."and $BOMMasterTableName.machine_ID=$machinemasterTableName.ID and $BOMMasterTableName.mould_ID = $mouldTableName.ID"

                                    ." AND $workorder_tab.product_ID = $product_tab.ID and $workorder_tab.product_ID=$BOMMasterTableName.product_ID AND $pipeproductionraw_tab.rawmaterial_id = $rawmaterialTableName.ID"

                                    ." AND $workorder_tab.ID = $woid and $pipeproductionraw_tab.pipeproduction_ID=$data order by $rawmaterialTableName.ID ";

                   

                    $pipeprodrm_data = $dbutil->getSqlData($sql_query);       

                    

                    $this->tpl->set('FmRMData', $pipeprodrm_data); 

               

                    $sql_sub = "SELECT $productionbrkdwn_tab.BreakDownStartTime,$productionbrkdwn_tab.BreakDownEndTime,$productionbrkdwn_tab.BreakdownHrs,$productionbrkdwn_tab.breaskdownreason_ID,$productionbrkdwn_tab.Remarks FROM $productionbrkdwn_tab WHERE $productionbrkdwn_tab.pipeproduction_ID ='$data'";                    

                    $pdnbrkdwn_subdet_data = $dbutil->getSqlData($sql_sub);             

                    $this->tpl->set('FmDataSub', $pdnbrkdwn_subdet_data);

                    

                            

                    $this->tpl->set('message', 'You Can View Pipe Production Form ');

                    $this->tpl->set('page_header', 'Sales');

                    

                    $this->tpl->set('content', $this->tpl->fetch('factory/form/pipeproduction.php'));    

                    break;

                    

                case 'edit':

                    include_once 'util/genUtil.php';

                    $util = new GenUtil();

                    $form_post_data = $util->arrFltr($_POST);

                    

                    $data = trim($_POST['ycs_ID']);

                    

                    if (!$data) {

                        $this->tpl->set('message', 'Please select any one ID to '.$crud_string.'!');

                        $this->tpl->set('label', 'List');

                        $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));

                        break;

                    }

                    

                    //mode of form submit

                    $this->tpl->set('mode', $crud_string);

                  

                    //set id to edit $ycs_ID

                    $this->tpl->set('ycs_ID', $data);    

                    

                    $sqlsrr = "SELECT * FROM $pipeproduction_tab  where $pipeproduction_tab.ID=$data";                    

                    $pipeprod_data = $dbutil->getSqlData($sqlsrr);             

                    $this->tpl->set('FmData', $pipeprod_data); 

                    

                    $woid=$pipeprod_data[0]['workorder_ID'];

                    $sqlpro="Select product_ID from $workorder_tab where $workorder_tab.ID=$woid" ;           

                    $stmt = $this->db->prepare($sqlpro);            

                    $stmt->execute();

                    $productID = $stmt->fetch(4);

                    

                    $SOPsql_query = "Select ParameterName,SOPValue,GroupName,outputpermin from $SOP_tab,$SOPMaster_tab  where $SOPMaster_tab.ID= $SOP_tab.sopmaster_ID AND product_ID= $productID[0] order by GroupName,ParameterName";

                    $pipeprodsop_data = $dbutil->getSqlData($SOPsql_query);             

                    $this->tpl->set('FmSOPData', $pipeprodsop_data);

                    

                   

                    $sql_query  = "select DISTINCT $workorder_tab.ID,$customerTableName.FirstName,$unit_tab.UnitName,$rawmaterialTableName.ID as RMID,$rawmaterialTableName.RMName as RawMaterial,$rawmaterialTableName.Grade, $product_tab.ID as ProductID,$product_tab.weight, $product_tab.ItemName,$machinemasterTableName.MachineName,"

                                    ."$mouldTableName.MouldName,$workorder_tab.Quantity,$BOMMasterTableName.MouldQty,$pipeproductionraw_tab.OpeningQty,$pipeproductionraw_tab.InwardQty,$pipeproductionraw_tab.ConsumedQty,$pipeproductionraw_tab.RejectedQty,$pipeproductionraw_tab.ClosingQty "

                                    ." from $workorder_tab,$unit_tab,$BOMMasterTableName,$BOMDetailTableName,$customerTableName,$machinemasterTableName,$mouldTableName,$product_tab,"

                                    ."$rawmaterialTableName,$pipeproductionraw_tab where  $workorder_tab.customer_ID= $customerTableName.ID "

                                    ."and $BOMMasterTableName.machine_ID=$machinemasterTableName.ID and $unit_tab.ID=$rawmaterialTableName.unit_ID and  $BOMMasterTableName.mould_ID = $mouldTableName.ID"

                                    ." AND $workorder_tab.product_ID = $product_tab.ID and $workorder_tab.product_ID=$BOMMasterTableName.product_ID AND $pipeproductionraw_tab.rawmaterial_id = $rawmaterialTableName.ID"

                                    ." AND $workorder_tab.ID = $woid and $pipeproductionraw_tab.pipeproduction_ID=$data order by $rawmaterialTableName.ID ";   

                    

                    //   $sql_query  = "select DISTINCT $workorder_tab.ID,$unitTableName.UnitName,$customerTableName.FirstName,$rawmaterialTableName.ID as RMID,$rawmaterialTableName.RMName as RawMaterial,$rawmaterialTableName.Grade, $product_tab.ID as ProductID,$product_tab.weight, $product_tab.ItemName,$machinemasterTableName.MachineName,"

                    //                         ."$mouldTableName.MouldName,$workorder_tab.Quantity,$BOMMasterTableName.MouldQty,$pipeproductionraw_tab.OpeningQty,$pipeproductionraw_tab.InwardQty,$pipeproductionraw_tab.ConsumedQty,$pipeproductionraw_tab.RejectedQty,$pipeproductionraw_tab.ClosingQty "

                    //                         ." from $workorder_tab,$unitTableName,$BOMMasterTableName,$BOMDetailTableName,$customerTableName,$machinemasterTableName,$mouldTableName,$product_tab,"

                    //                         ." $rawmaterialTableName,$pipeproductionraw_tab where $unitTableName.ID=$rawmaterialTableName.Unit_ID AND $workorder_tab.customer_ID= $customerTableName.ID "

                    //                         ."and $BOMMasterTableName.machine_ID=$machinemasterTableName.ID and $BOMMasterTableName.mould_ID = $mouldTableName.ID"

                    //                         ." AND $workorder_tab.product_ID = $product_tab.ID and $workorder_tab.product_ID=$BOMMasterTableName.product_ID AND  $pipeproductionraw_tab.rawmaterial_id = $rawmaterialTableName.ID"

                    //                         ." AND $workorder_tab.ID = $woid and $pipeproductionraw_tab.pipeproduction_ID=$data order by $rawmaterialTableName.ID ";

                           

                    $pipeprodrm_data = $dbutil->getSqlData($sql_query);       

                    

                    $this->tpl->set('FmRMData', $pipeprodrm_data); 

                    

                    $sql_sub = "SELECT $productionbrkdwn_tab.BreakDownStartTime,$productionbrkdwn_tab.BreakDownEndTime,$productionbrkdwn_tab.BreakdownHrs,$productionbrkdwn_tab.breaskdownreason_ID,$productionbrkdwn_tab.Remarks FROM $productionbrkdwn_tab WHERE $productionbrkdwn_tab.pipeproduction_ID ='$data'";                    

                    $pdnbrkdwn_subdet_data = $dbutil->getSqlData($sql_sub);             

                    $this->tpl->set('FmDataSub', $pdnbrkdwn_subdet_data);

                    

                            

                    $this->tpl->set('message', 'You can '.$crud_string);

                    $this->tpl->set('page_header', 'Sales');

                    

                    $this->tpl->set('content', $this->tpl->fetch('factory/form/pipeproduction.php'));                    

                    break;

                 

                case 'editsubmit':             

                    $data = trim($_POST['ycs_ID']);

                    

                    //mode of form submit

                    $this->tpl->set('mode', 'edit');

                    //set id to edit $ycs_ID

                    $this->tpl->set('ycs_ID', $data);

                    try{

                     if (isset($crud_string)) {

                         

                        $form_post_data = $dbutil->arrFltr($_POST);

                       

                         $entry_count = 1;

                         $entry_count1=1;

                        

                       

                            $BatchNo= $form_post_data['BatchNo'];

                            $OperatorName= $form_post_data['OperatorName'] ;

                            $Shift= $form_post_data['Shift'] ;

                            $productiontime= $form_post_data['productiontime'];

                            $CorrugatedRPM= $form_post_data['CorrugatedRPM'];

                            $ExtruderSpeedRPM= $form_post_data['ExtruderSpeedRPM'] ;

                            $CoExtruderRPM= $form_post_data['CoExtruderRPM'];

                            $ChillerTempInput= $form_post_data['ChillerTempInput'] ;

                            $ChillerTempOutput= $form_post_data['ChillerTempOutput'];

                            $AirPressure= $form_post_data['AirPressure'] ;

                            $ProdStartTime= $form_post_data['ProdStartTime'];

                            $ProdEndTime= $form_post_data['ProdEndTime'] ;

                            $IdleHrs= $form_post_data['IdleHrs'];

                            $IdleDesc= $form_post_data['IdleDesc'] ;

                            $PowerCutHrs= $form_post_data['PowerCutHrs'];

                            $TotProdRunHrs= $form_post_data['TotProdRunHrs'] ;

                            $TotProdMtr= $form_post_data['TotProdMtr'] ;

                            $TotProdKg= $form_post_data['TotProdKg'];

                            $BDHrs= $form_post_data['BDHrs'] ;

                            $Communication= $form_post_data['Communication'];

                            $Lumps= $form_post_data['Lumps'];

                            $StartupWaste= $form_post_data['StartupWaste'] ;

                            $CuttingWaste= $form_post_data['CuttingWaste'];

                            $FinsihingWaste= $form_post_data['FinsihingWaste'] ;

                            $FailureWaste= $form_post_data['FailWaste'] ;

                            $TotalScrap= $form_post_data['TotalScrap'];

                            $Actweight= $form_post_data['Actweight'] ;

                            $ActOutput= $form_post_data['ActOutput'];

                                         

                                        $sql2 = "update  $pipeproduction_tab set " .

                                                  "`workorder_ID`='$BatchNo',

                                                   `operator_ID`='$OperatorName',

                                                   `shift_ID`='$Shift',

                                                   `ProdTime`='$productiontime',

                                                   `CorrugatorAmps`='$CorrugatedRPM',

                                                   `ExtruderAmps`='$ExtruderSpeedRPM', 

                                                   `CoExtruderAmps`='$CoExtruderRPM',

                                        		   `ChillerTempInput`='$ChillerTempInput',

                                                   `ChillerTempOutput`='$ChillerTempOutput',

                                                   `AirPressure`='$AirPressure',

                                                   `ProdStartTime`='$ProdStartTime',

                                                   `ProdEndTime`='$ProdEndTime',

                                                   `IdleHrs`='$IdleHrs',

                                                   `IdleDesc`='$IdleDesc',

                                                   `PowercutHrs`='$PowerCutHrs',

                                                   `TotProdRunningHrs`='$TotProdRunHrs',

                                                   `TotProdMtr`='$TotProdMtr',

                                                   `TotProdKg`='$TotProdKg',

                                                   `BreakdownHrs`='$BDHrs',

                                                   `Communication`='$Communication',

                                                   `Lumps`='$Lumps',

                                                   `StartUpWaste`='$StartupWaste',

                                                   `CuttingWaste`='$CuttingWaste',

                                                   `FinishingWaste`='$FinsihingWaste',

                                                    `FailureWaste`='$FailureWaste',

                                                   `TotalWaste`='$TotalScrap',

                                                   `ActualWgt`='$Actweight',

                                                   `ActualOutput`='$ActOutput' where ID= $data";

                        

                                       $stmt = $this->db->prepare($sql2);

                                       $entry_count=1;

                                      

                                          //increment here

                                       if ($stmt->execute()) { 

                                           

                                    $sqldelete="Delete from $pipeproductionraw_tab where $pipeproductionraw_tab.pipeproduction_ID=$data "; 

                                    $stmt = $this->db->prepare($sqldelete);            

                                    $stmt->execute();

                                    

                                    

                                    FOR ($entry_count; $entry_count <= $form_post_data['maxCount'];) {

                                           

                                            $RM_ID ='RMID_' . $entry_count;

                                            $OpeningBalance='OpeningBalance_' . $entry_count ;

                                            $InwardQty='InwardQty_'. $entry_count;

                                            $RejectedQty='RejectedQty_'. $entry_count;

                                            $ClosingBalance='ClosingBalance_'. $entry_count;

                                            $ConsumedQty='ConsumedQty_' . $entry_count;

                                            

            

                                            $vals = "'" . $data . "'," .

                                                     "'" . $form_post_data[$RM_ID] . "'," .

                                                     "'" . $form_post_data[$OpeningBalance] . "'," .

                                                     "'" . $form_post_data[$InwardQty] . "'," .

                                                     "'" . $form_post_data[$RejectedQty] . "'," .

                                                     "'" . $form_post_data[$ClosingBalance] . "'," .

                                                     "'" . $form_post_data[$ConsumedQty] . "'" ;

                                                    

                                                   

                                                     //"'" . $form_post_data[$Temp] . "'";

                                             

                                $sql2 = "INSERT INTO $pipeproductionraw_tab

                                                    ( 

                                            `pipeproduction_ID`, 

                                            `rawmaterial_ID`,

                                            `OpeningQty`,

                                            `InwardQty`,

                                            `RejectedQty`,

                                            `ClosingQty`,

                                            `ConsumedQty`

                                            ) 

                                            VALUES ($vals)";



                                 // this need to be changed in to transaction type

                                

                                            $stmt = $this->db->prepare($sql2);

                                            $stmt->execute();

                                              //increment here

                                            $entry_count++;

                                

                            }

                            }

                     

                            

                                     $stmt = $this->db->prepare($sql2);

                                       $entry_count1=1;

                                  if ($stmt->execute()) { 

                                         

                                    $sqldelete="Delete from $productionbrkdwn_tab where $productionbrkdwn_tab.pipeproduction_ID=$data "; 

                                    $stmt = $this->db->prepare($sqldelete);            

                                    $stmt->execute();

                                 

                                 FOR ($entry_count1; $entry_count1 <= $form_post_data['maxCountSub'];) {

                                        

                                            $Machine ='ItemNo_' . $entry_count1;

                                            $brkdwnstarttime='Rate_' . $entry_count1 ;

                                            $brkdwnendtime='Note_'. $entry_count1;

                                            $brkdwnhrs='Rat_'. $entry_count1;

                                            $brkdwnreason='ItemName_'. $entry_count1;

                                            $Remarks='Water_'. $entry_count1;

                                           

                                            

            

                                            $vals =  "'" . $data. "'," .

                                                     "'" . $form_post_data[$Machine] . "'," .

                                                     "'" . $form_post_data[$brkdwnstarttime] . "'," .

                                                     "'" . $form_post_data[$brkdwnendtime] . "'," .

                                                     "'" . $form_post_data[$brkdwnhrs] . "'," .

                                                     "'" . $form_post_data[$brkdwnreason] . "'," .

                                                     "'" . $form_post_data[$Remarks] . "'" ;   

                                             

                                                     

                                        $sql2 = "INSERT INTO $productionbrkdwn_tab

                                            ( 

                                            `pipeproduction_ID`, 

                                            `machine_ID`,

                                            `BreakDownStartTime`,

                                            `BreakDownEndTime`,

                                            `BreakdownHrs`,

                                            `breaskdownreason_ID`,

                                            `Remarks`

                                           

                                            ) 

                                            VALUES ($vals)";

                                            

                                 // this need to be changed in to transaction type

                                

                                            $stmt = $this->db->prepare($sql2);

                                            $stmt->execute();

                                              

                                              //increment here

                                           

                                            $entry_count1++;

                                

                     }

                            

                     }

                     }

                     

                     

                            $this->tpl->set('message', 'Pipe Production form edited successfully!');  

                            $this->tpl->set('label', 'List');

                            $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));

                            } catch (Exception $exc) {

                             //edit failed option

                            $this->tpl->set('message', 'Failed to edit, try again!');

                            $this->tpl->set('FmData', $form_post_data);

                            $this->tpl->set('content', $this->tpl->fetch('factory/form/pipeproduction.php'));

                            }

                            

                     break;



                case 'addsubmit':

                     if (isset($crud_string)) {

                         

                        $form_post_data = $dbutil->arrFltr($_POST);

                       

                        //var_dump($form_post_data);

                    

                        $entry_count = 1;

                        $entry_count1=1;

                        if (isset($form_post_data['BatchNo'])) {

                        

                                        $vals = "'" . $form_post_data['BatchNo'] . "'," .

                                                "'" . $form_post_data['OperatorName'] ."'," .

                                                "'" . $form_post_data['Shift'] ."'," .

                                                "'" . $form_post_data['productiontime'] . "'," .

                                                "'" . $form_post_data['CorrugatedRPM'] . "'," .

                                                "'" . $form_post_data['ExtruderSpeedRPM'] ."'," .

                                                "'" . $form_post_data['CoExtruderRPM'] . "'," .

                                                "'" . $form_post_data['ChillerTempInput'] ."'," .

                                                "'" . $form_post_data['ChillerTempOutput'] . "'," .

                                                "'" . $form_post_data['AirPressure'] ."'," .

                                                "'" . $form_post_data['ProdStartTime'] . "'," .

                                                "'" . $form_post_data['ProdEndTime'] ."'," .

                                                "'" . $form_post_data['IdleHrs'] . "'," .

                                                "'" . $form_post_data['IdleDesc'] ."'," .

                                                "'" . $form_post_data['PowerCutHrs'] . "'," .

                                                "'" . $form_post_data['TotProdRunHrs'] ."'," .

                                                "'" . $form_post_data['TotProdMtr'] ."'," .

                                                "'" . $form_post_data['TotProdKg'] . "'," .

                                                "'" . $form_post_data['BDHrs'] ."'," .

                                                "'" . $form_post_data['Communication'] . "'," .

                                                "'" . $form_post_data['Lumps'] . "'," .

                                                "'" . $form_post_data['StartupWaste'] ."'," .

                                                "'" . $form_post_data['CuttingWaste'] . "'," .

                                                "'" . $form_post_data['FinsihingWaste'] ."'," .

                                                "'" . $form_post_data['FailWaste'] ."'," .

                                                "'" . $form_post_data['TotalScrap'] . "'," .

                                                "'" . $form_post_data['Actweight'] ."'," .

                                                "'" . $form_post_data['ActOutput'] . "'," .

                                                "'" .  $this->ses->get('user')['entity_ID'] . "'," .

                                                "'" .  $this->ses->get('user')['ID'] . "'";

                                         

                                       $sql2 = "INSERT INTO $pipeproduction_tab" .

                                                        "( 

                                                          `workorder_ID`,

                                                          `operator_ID`,

                                                          `shift_ID`,

                                                          `ProdTime`,

                                                          `CorrugatorAmps`,

                                                          `ExtruderAmps`, 

                                                          `CoExtruderAmps`,

                                                          `ChillerTempInput`,

                                                          `ChillerTempOutput`,

                                                          `AirPressure`,

                                                          `ProdStartTime`,

                                                          `ProdEndTime`,

                                                          `IdleHrs`,

                                                          `IdleDesc`,

                                                          `PowercutHrs`,

                                                          `TotProdRunningHrs`,

                                                          `TotProdMtr`,

                                                          `TotProdKg`,

                                                          `BreakdownHrs`,

                                                          `Communication`,

                                                          `Lumps`,

                                                          `StartUpWaste`,

                                                          `CuttingWaste`,

                                                          `FinishingWaste`,

                                                           `FailureWaste`,

                                                          `TotalWaste`,

                                                          `ActualWgt`,

                                                          `ActualOutput`,

                                                          `entity_ID`,

                                                          `users_ID`

                                                       )    

                                        VALUES ($vals)";

        

                                        // this need to be changed in to transaction type

                                        

                                        $stmt = $this->db->prepare($sql2);

                                        

                                       $entry_count=1;

                                          //increment here

                                       if ($stmt->execute()) { 

                                   

                                           

                                    $lastInsertedID = $this->db->lastInsertId();

                                 

                                    FOR ($entry_count; $entry_count <= $form_post_data['maxCount'];) {

                                       

                                            $RM_ID ='RMID_' . $entry_count;

                                            $OpeningBalance='OpeningBalance_' . $entry_count ;

                                            $InwardQty='InwardQty_'. $entry_count;

                                            $RejectedQty='RejectedQty_'. $entry_count;

                                            $ClosingBalance='ClosingBalance_'. $entry_count;

                                            $ConsumedQty='ConsumedQty_' . $entry_count;

                                            

            

                                            $vals = "'" . $lastInsertedID . "'," .

                                                    "'" . $form_post_data[$RM_ID] . "'," .

                                                     "'" . $form_post_data[$OpeningBalance] . "'," .

                                                     "'" . $form_post_data[$InwardQty] . "'," .

                                                     "'" . $form_post_data[$RejectedQty] . "'," .

                                                     "'" . $form_post_data[$ClosingBalance] . "'," .

                                                     "'" . $form_post_data[$ConsumedQty] . "'" ;

                                                    

                                                   

                                                     //"'" . $form_post_data[$Temp] . "'";

                                             

                                       $sql2 = "INSERT INTO $pipeproductionraw_tab

                                            ( 

                                            `pipeproduction_ID`, 

                                            `rawmaterial_ID`,

                                            `OpeningQty`,

                                            `InwardQty`,

                                            `RejectedQty`,

                                            `ClosingQty`,

                                            `ConsumedQty`

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

                            

                            //$stmt = $this->db->prepare($sql2);

                             $entry_count1=1;

                            

                                          //increment here

                                        

                                    

                                      FOR ($entry_count1; $entry_count1 <= $form_post_data['maxCountSub'];) {

                                           

                                            $Machine ='ItemNo_' . $entry_count1;

                                            $brkdwnstarttime='Rate_' . $entry_count1 ;

                                            $brkdwnendtime='Note_'. $entry_count1;

                                            $brkdwnhrs='Rat_'. $entry_count1;

                                            $brkdwnreason='ItemName_'. $entry_count1;

                                            $Remarks='Water_'. $entry_count1;

                                           

                                            

            

                                            $vals = "'" . $lastInsertedID . "'," .

                                                    "'" . $form_post_data[$Machine] . "'," .

                                                    "'" . $form_post_data[$brkdwnstarttime] . "'," .

                                                    "'" . $form_post_data[$brkdwnendtime] . "'," .

                                                    "'" . $form_post_data[$brkdwnhrs] . "'," .

                                                    //  "'" . $form_post_data[$brkdwnendtime] . "'," .

                                                     "'" . $form_post_data[$brkdwnreason] . "'," .

                                                     "'" . $form_post_data[$Remarks] . "'" ;   

                                                     

                                                          

                                       $sql2 = "INSERT INTO $productionbrkdwn_tab

                                            ( 

                                            `pipeproduction_ID`, 

                                            `machine_ID`,

                                            `BreakDownStartTime`,

                                            `BreakDownEndTime`,

                                            `BreakdownHrs`,

                                            `breaskdownreason_ID`,

                                            `Remarks`

                                            ) 

                                            VALUES ($vals)";



                                 // this need to be changed in to transaction type

                                

                                            $stmt = $this->db->prepare($sql2);

                                            $stmt->execute();

                                              //increment here

                                            $entry_count1++;

                                

                            }

                   

                            

                        $this->tpl->set('message', '- Success -');

                        $this->tpl->set('mode', 'add');
                        
                         $this->tpl->set('label', 'List');
                         $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                        //$this->tpl->set('content', $this->tpl->fetch('factory/form/pipeproduction.php'));

                        $this->tpl->set('master_layout', 'layout_datepicker.php');

                     } else {

                            //edit option

                            //if submit failed to insert form

                            $this->tpl->set('message', 'Failed to submit!');

                            $this->tpl->set('FmData', $form_post_data);

                            $this->tpl->set('content', $this->tpl->fetch('factory/form/pipeproduction.php'));

                             $this->tpl->set('master_layout', 'layout_datepicker.php');

                     }

                    break;

                case 'add':

                     $this->tpl->set('master_layout', 'layout_datepicker.php');

                    $this->tpl->set('mode', 'add');

                    $this->tpl->set('content', $this->tpl->fetch('factory/form/pipeproduction.php'));

                    break;



                default:

                    /*

                     * List form

                     */

                    

                   $whereString = '';

            

                        $colArr = array(

                            "$pipeproduction_tab.ID",

                            "$workorder_tab.BatchNo",

                            "CONCAT($product_tab.ItemName,' ',$product_tab.Description)AS ItemName",

                            "$machine_tab.MachineName",

                            "$shift_tab.ShiftName",  

                            "$pipeproduction_tab.ProdTime", 

                            "$pipeproduction_tab.CorrugatorAmps",

                            "$pipeproduction_tab.ExtruderAmps",

                            "$pipeproduction_tab.CoExtruderAmps", 

                            "$pipeproduction_tab.ChillerTempInput",

                            "$pipeproduction_tab.ChillerTempOutput",

                            "$pipeproduction_tab.AirPressure",

                            "$pipeproduction_tab.IdleHrs",

                            "$pipeproduction_tab.PowerCutHrs", 

                            "$pipeproduction_tab.TotProdRunningHrs",

                            "$pipeproduction_tab.TotProdMtr",

                            "$pipeproduction_tab.TotProdKg"

                            //"$productionbrkdwn_tab.BreakdownHrs"

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

                    }else if(strpos($colNames, 'CONCAT') !== false){

                          if(preg_match('/-/', $colNames)){

                               if($dbutil->concatFilterFormat($colNames)){

                                 $wsarr[] = $dbutil->concatFilterFormat($colNames,'spc');

                               }

                          }else{

                            if($dbutil->concatFilterFormat($colNames)){

                            $wsarr[] = $dbutil->concatFilterFormat($colNames);

                            }  

                          }

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

            } 

                

            $orderBy ="ORDER BY $pipeproduction_tab.ID DESC";

           

                    

                $sql = "SELECT "

                         . implode(',',$colArr)

                         . " FROM $pipeproduction_tab,$workorder_tab,$shift_tab,$product_tab,$dailyproduction_tab,$machine_tab"

                         . " WHERE "

                         . " $workorder_tab.ID=$pipeproduction_tab.workorder_ID AND "

                         . " $workorder_tab.product_ID=$product_tab.ID AND "

                         . " $shift_tab.ID=$pipeproduction_tab.shift_ID AND "

                         . " $workorder_tab.productionplan_ID=$dailyproduction_tab.ID AND "

                         . " $dailyproduction_tab.machine_ID=$machine_tab.ID AND "

                        // . " $productionbrkdwn_tab.pipeproduction_ID=$pipeproduction_tab.ID AND "

                         . " $pipeproduction_tab.entity_ID = $entityID"

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

             

            $this->tpl->set('table_columns_label_arr', array('Production ID','BatchNo','Product','Line','Shift Name','Prod. Time','Corrugated RPM','Extruder RPM','Co Extruder RPM','Chiller Temp Input','Chiller Temp Output','Air Pressure(Bar)','Idle Hrs','Power Cut Hrs','Tot. Prod. Running Hrs','Tot. Prod. in Mtr/No','

                                                                Tot. Prod. in KG'));

            

            /*

            * selectColArr for filter form

             */

            

            $this->tpl->set('selectColArr',$colArr);

                        

            /*

             * set pagination template

             */

            $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');

            

                    include_once $this->tpl->path . '/factory/form/pipe_production_crud_form.php';

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

    

  function oee(){

         if ($this->crg->get('wp') || $this->crg->get('rp')) {

            

            include_once 'util/DBUTIL.php';

            $dbutil = new DBUTIL($this->crg);

            

             $entityID = $this->ses->get('user')['entity_ID'];

            $userID = $this->ses->get('user')['ID'];

            

            

            $wo_table = $this->crg->get('table_prefix') . 'workorder ';

        	$dp_table=$this->crg->get('table_prefix').'dailyprodplan';

        	$machinemaster_table=$this->crg->get('table_prefix').'machinemaster';

        	$pp_table=$this->crg->get('table_prefix').'pipeproduction ';

        	$shift_table=$this->crg->get('table_prefix').'shifttiming  ';

        	$pdt_table=$this->crg->get('table_prefix').'product  ';

        	$sop_table=$this->crg->get('table_prefix').'SOP';

        	$oninsp_table=$this->crg->get('table_prefix').'onlineinspmaster ';

            

          

            

            //customer select box data

            $pp_sql = "SELECT DISTINCT date(AuditDateTime) as PPDate FROM $pp_table";

            $stmt = $this->db->prepare($pp_sql);            

            $stmt->execute();

            $pp_data  = $stmt->fetchAll();	

            $this->tpl->set('pp_data', $pp_data);

            //var_dump($pp_data);

            

             $overallcount_proc = "CALL pOEE($sdate,$edate,$cid)";   

             $stmt = $this->db->prepare($overallcount_proc);                        

             $stmt->execute();

             $overalldata = $stmt->fetchAll(2);

             $this->tpl->set('overall_data', $overalldata);



             

             //source select box data

            $shift_sql = "SELECT ID,ShiftName FROM $shift_table";

            $stmt = $this->db->prepare($shift_sql);            

            $stmt->execute();

            $shift_data  = $stmt->fetchAll();	

            $this->tpl->set('shift_data', $shift_data);

            

            //Add submit

            if (!empty($_POST['add_submit_button']) && $_POST['add_submit_button'] == 'add') {

                $crud_string = 'addsubmit';

            }

            

            $this->tpl->set('page_title', 'OEE (Overall Equipment Effectiveness)');	          

            $this->tpl->set('page_header', 'Report');

            //Add Role when u submit the add role form

            $thisPageURL = $this->crg->get('route')['base_path'] . '/' . $this->crg->get('route')['module'] . '/' . $this->crg->get('route')['controller'] . '/' . $this->crg->get('route')['action'];

            

             switch ($crud_string) {

                    case 'addsubmit':

                        

                     if (isset($crud_string)) {

                       

                        $form_post_data = $dbutil->arrFltr($_POST);

                                  $sdate = $form_post_data['sdate'];

                                  $edate = $form_post_data['edate'];

                                  $shift =$form_post_data['shift_ID'];

                                 

                                  

                                   if($form_post_data['shift_ID']=='All'){

                                   

                                   $shift=0;     

 

                                   }else{

                                       $shift =$form_post_data['shift_ID']; 

                                   }

                                   

                                   $test=array($sdate,$edate,$shift);

                                         

                                    $sql_query ="CALL pOEE('$sdate','$edate','$shift')"; 

                                    $stmt = $this->db->prepare($sql_query);                        

                      

                                    //   var_dump($test);   

                                         if ($stmt->execute()) { 

                                             

                                             $result=$stmt->fetchAll(2);

                                             $this->tpl->set('result', $result);

                                             $this->tpl->set('FmData', $test);

                                             

                                         }

                                 }

                                 

                            }

             

             

            

             $this->tpl->set('content', $this->tpl->fetch('factory/form/oee.php'));

              $this->tpl->set('master_layout', 'layout_datepicker.php'); 

            

         } else {

            if ($this->ses->get('user')['ID']) {

                $this->tpl->set('content', $this->tpl->fetch('modules/user/acess_failed_message.php'));

            } else {

                header('Location:' . $this->crg->get('route')['base_path'] . '/user/auth/login');

            }

        }

    

}



function lead() {

        if ($this->crg->get('wp') || $this->crg->get('rp')) {

//////////////////////////////////////////////////////////////////////////////////

//////////////////////////////access condition applied///////////////////////////

//////////////////////////////////////////////////////////////////////////////// 

          

           include_once 'util/DBUTIL.php';

           $dbutil = new DBUTIL($this->crg);

             

             $entityID = $this->ses->get('user')['entity_ID'];

             $userID = $this->ses->get('user')['ID'];

            

            

           $lead_tab = $this->crg->get('table_prefix') . 'lead';

                  

          



            ////////////////////start//////////////////////////////////////////////

                    

           //bUILD SQL 

            $whereString = '';

            

            $colArr = array(

                "$lead_tab.ID", 

                "$lead_tab.LeadStatus",

                "$lead_tab.LeadType"

                

               

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

            

            $orderBy ="ORDER BY $lead_tab.ID DESC";

            

         $sql = "SELECT "

                 . implode(',',$colArr)

                 . " FROM $lead_tab "

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

            $this->tpl->set('table_columns_label_arr', array('ID','Lead Status','Lead Type'));

            

            /*,;;

             * selectColArr for filter form

             */

            

            $this->tpl->set('selectColArr',$colArr);

                        

            /*

             * set pagination template

             */

            $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');

                   

            //////////////////////close//////////////////////////////////////  

          

             include_once $this->tpl->path .'/factory/form/crud_lead.php';

            

            

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

       

   function leads() {

        if ($this->crg->get('wp') || $this->crg->get('rp')) {

//////////////////////////////////////////////////////////////////////////////////

//////////////////////////////access condition applied///////////////////////////

////////////////////////////////////////////////////////////////////////////////            

           

                

            include_once $this->tpl->path .'/factory/form/crud_lead.php';

            

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

    

function industry() {

        if ($this->crg->get('wp') || $this->crg->get('rp')) {

//////////////////////////////////////////////////////////////////////////////////

//////////////////////////////access condition applied///////////////////////////

//////////////////////////////////////////////////////////////////////////////// 

          

           include_once 'util/DBUTIL.php';

           $dbutil = new DBUTIL($this->crg);

             

             $entityID = $this->ses->get('user')['entity_ID'];

             $userID = $this->ses->get('user')['ID'];

            

            

           $indus_tab = $this->crg->get('table_prefix') . 'industry';

                  

          



            ////////////////////start//////////////////////////////////////////////

                    

           //bUILD SQL 

            $whereString = '';

            

            $colArr = array(

                "$indus_tab.ID", 

                "$indus_tab.IndustryType"

                

                

               

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

            

            $orderBy ="ORDER BY $indus_tab.ID DESC";

            

         $sql = "SELECT "

                 . implode(',',$colArr)

                 . " FROM $indus_tab "

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

            $this->tpl->set('table_columns_label_arr', array('ID','Industry Type'));

            

            /*,;;

             * selectColArr for filter form

             */

            

            $this->tpl->set('selectColArr',$colArr);

                        

            /*

             * set pagination template

             */

            $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');

                   

            //////////////////////close//////////////////////////////////////  

          

             include_once $this->tpl->path .'/factory/form/crud_industry.php';

            

            

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

           

       function indus() {

        if ($this->crg->get('wp') || $this->crg->get('rp')) {

//////////////////////////////////////////////////////////////////////////////////

//////////////////////////////access condition applied///////////////////////////

////////////////////////////////////////////////////////////////////////////////            

           

                

            include_once $this->tpl->path .'/factory/form/crud_industry.php';

            

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

    

///////////////////////////////////////////////////////////////////////////////////////////////////////

   

   function saleslead(){

     if ($this->crg->get('wp') || $this->crg->get('rp')) {

 ////////////////////////////////////////////////////////////////////////////////

 //////////////////////////////access condition applied//////////////////////////

 ////////////////////////////////////////////////////////////////////////////////    

            

            include_once 'util/DBUTIL.php';

            $dbutil = new DBUTIL($this->crg);

             

            $entityID = $this->ses->get('user')['entity_ID'];

            $userID = $this->ses->get('user')['ID'];

            

           

            $industry_table = $this->crg->get('table_prefix') . 'industry';

            $lead_table = $this->crg->get('table_prefix') . 'lead';

           

            $enquirydetail_tab = $this->crg->get('table_prefix') . 'enquirydetail';

            $enquirymaster_tab = $this->crg->get('table_prefix') . 'enquiry';

            

            

            

            

            //industry select box data

            $industry_sql = "SELECT ID,IndustryType FROM $industry_table";

            $stmt = $this->db->prepare($industry_sql);            

            $stmt->execute();

            $industry_data  = $stmt->fetchAll();	

            $this->tpl->set('industry_data', $industry_data);

            

            

            //leadstatus select box data

            $sql = "SELECT ID,LeadStatus FROM $lead_table"; 

            $stmt = $this->db->prepare($sql);            

            $stmt->execute();

            $lead_data  = $stmt->fetchAll();	

            $this->tpl->set('lead_data', $lead_data);

            

            //leadstatus select box data

            $sql = "SELECT ID,LeadType FROM $lead_table"; 

            $stmt = $this->db->prepare($sql);            

            $stmt->execute();

            $leadtype_data  = $stmt->fetchAll();	

            $this->tpl->set('leadtype_data', $leadtype_data);

            



            $this->tpl->set('page_title', 'Sales Lead/Enquiry Details');	          

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

                     

                     $sqldetdelete="Delete $enquirydetail_tab,$enquirymaster_tab from $enquirymaster_tab

                                        LEFT JOIN  $enquirydetail_tab ON $enquirymaster_tab.ID=$enquirydetail_tab.enquiry_ID 

                                        where $enquirydetail_tab.enquiry_ID=$data"; 

                        $stmt = $this->db->prepare($sqldetdelete);            

                        

                        if($stmt->execute()){

                        $this->tpl->set('message', 'Sales Lead deleted successfully');

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

                                

                    

                    $sqlsrr = "SELECT * FROM `$enquirydetail_tab`,`$enquirymaster_tab` WHERE  `$enquirydetail_tab`.`enquiry_ID`=`$enquirymaster_tab`.`ID` AND `$enquirydetail_tab`.`enquiry_ID` = '$data'";                    

                    $enquirydetail_data = $dbutil->getSqlData($sqlsrr); 

                   

                

                    //edit option     

                    $this->tpl->set('message', 'You can '.$crud_string.' Sales Lead/Enquiry Detail form');

                    $this->tpl->set('page_header', 'Production');

                    $this->tpl->set('FmData', $enquirydetail_data); 

                    

                    $this->tpl->set('content', $this->tpl->fetch('factory/form/enquiry.php'));                    

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

                   

                    $sqlsrr = "SELECT * FROM `$enquirydetail_tab`,`$enquirymaster_tab` WHERE  `$enquirydetail_tab`.`enquiry_ID`=`$enquirymaster_tab`.`ID` AND `$enquirydetail_tab`.`enquiry_ID` = '$data'";                    

                    $enquirydetail_data = $dbutil->getSqlData($sqlsrr); 

                    //edit option     

                    $this->tpl->set('message', 'You can edit Sales Lead/Equiry Detail form');

                    $this->tpl->set('page_header', 'Production');

                    $this->tpl->set('FmData', $enquirydetail_data); 

                    

                    $this->tpl->set('content', $this->tpl->fetch('factory/form/enquiry.php'));                    

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

                    $sqldet_del = "DELETE FROM $enquirydetail_tab WHERE enquiry_ID=$data";

                    $stmt = $this->db->prepare($sqldet_del);

                    $stmt->execute();   

                            

                            try{

                              

                            $CompanyName= $form_post_data['CompanyName'];

                            $industry_id= $form_post_data['industry_id'];

                            $Website=$form_post_data['Website'];

                            $ProductInterested=$form_post_data['ProductInterested'];

                            $CompanyAddress=$form_post_data['CompanyAddress'];

                            $leadstatus_id=$form_post_data['leadstatus_id'];

                            $sql_update="Update $enquirymaster_tab set CompanyName='$CompanyName',industry_id='$industry_id',Website='$Website',ProductInterested='$ProductInterested',CompanyAddress='$CompanyAddress',leadstatus_id='$leadstatus_id' WHERE ID=$data";

                            $stmt1 = $this->db->prepare($sql_update);

                            $stmt1->execute(); 

                        $entry_count = 1;

                        FOR ($entry_count; $entry_count <= $form_post_data['maxCount'];) {

                                $LeadName ='ItemNo_' . $entry_count;

                                $MobileNo='ItemName_' . $entry_count;

                                $Email='Water_'. $entry_count;

                                $LeadDesignation='EmpName_'. $entry_count;

                                $leadtype_id='Amount_'. $entry_count;

                                $DepartmentName = 'Note_' . $entry_count;

                               

                                        $vals = "'" . $data . "'," .

                                        "'" . $form_post_data[$LeadName] . "'," .

                                        "'" . $form_post_data[$MobileNo] . "'," .  

                                        "'" . $form_post_data[$Email] . "'," .

                                        "'" . $form_post_data[$LeadDesignation] . "'," .

                                        "'" . $form_post_data[$leadtype_id] . "'," .

                                        "'" . $form_post_data[$DepartmentName ] . "'" ;

                                        

                                 

                              $sql2 = "INSERT INTO $enquirydetail_tab

                                        ( 

                                `enquiry_ID`, 

                                `LeadName`,

                                `MobileNo`,

                                `Email`,

                                `LeadDesignation`,

                                `leadtype_id`,

                                `DepartmentName` 

                                ) 

                                VALUES ($vals)";



                                $stmt = $this->db->prepare($sql2);

                                $stmt->execute();

                            //increment here

                            $entry_count++;

                            

                           

                            }

                       

                            $this->tpl->set('message', 'Sales Lead/Equiry Detail Edited Successfully!');   

                            $this->tpl->set('label', 'List');

                            $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));

                            } catch (Exception $exc) {

                             //edit failed option

                            $this->tpl->set('message', 'Failed to edit, try again!');

                            $this->tpl->set('FmData', $form_post_data);

                            $this->tpl->set('content', $this->tpl->fetch('factory/form/enquiry.php'));

                            }



                    break;



                case 'addsubmit':

                     if (isset($crud_string)) {

                         

                        $form_post_data = $dbutil->arrFltr($_POST);

                        

                        $entry_count = 1;

                       

                            if (isset($form_post_data['CompanyName'])) {

                           

                                        $val = "'" . $form_post_data['CompanyName'] . "'," .

                                         "'" . $form_post_data['industry_id'] . "'," .

                                         "'" . $form_post_data['Website'] . "'," .

                                         "'" . $form_post_data['ProductInterested'] . "'," .

                                         "'" . $form_post_data['CompanyAddress'] . "'," .

                                         "'" . $form_post_data['leadstatus_id'] . "'" ;

                                      



                              $sql = "INSERT INTO `" . $this->crg->get('table_prefix') . "enquiry`

                                            ( 

                                            `CompanyName`, 

                                            `industry_id`, 

                                            `Website`, 

                                            `ProductInterested`,

                                            `CompanyAddress`,

                                            `leadstatus_id`

                                            

                                            ) 

                                        VALUES ($val)";

                                  $stmt = $this->db->prepare($sql);

                                  

                                  

                    if ($stmt->execute()) { 

                        $lastInsertedID = $this->db->lastInsertId();

                        FOR ($entry_count; $entry_count <= $form_post_data['maxCount'];) {

                               

                                $LeadName ='ItemNo_' . $entry_count;

                                $MobileNo='ItemName_' . $entry_count;

                                $Email='Water_'. $entry_count;

                                $LeadDesignation='EmpName_'. $entry_count;

                                $leadtype_id='Amount_'. $entry_count;

                                $DepartmentName ='Note_' . $entry_count;



                                $vals = "'" . $lastInsertedID . "'," .

                                         "'" . $form_post_data[$LeadName] . "'," .

                                        "'" . $form_post_data[$MobileNo] . "'," .  

                                        "'" . $form_post_data[$Email] . "'," .

                                        "'" . $form_post_data[$LeadDesignation] . "'," .

                                        "'" . $form_post_data[$leadtype_id] . "'," .

                                        "'" . $form_post_data[$DepartmentName ] . "'";

                                        

                                       

                                         //"'" . $form_post_data[$Temp] . "'";

                           $sql2 = "INSERT INTO $enquirydetail_tab

                                        ( 

                                `enquiry_ID`, 

                                `LeadName`,

                                `MobileNo`,

                                `Email`,

                                `LeadDesignation`,

                                `leadtype_id`,

                                `DepartmentName` 

                                ) 

                                VALUES ($vals)";



                                 // this need to be changed in to transaction type

                                

                                $stmt = $this->db->prepare($sql2);

                                $stmt->execute();

                                  //increment here

                                $entry_count++;

                                

                            }

                           //var_dump($_POST);   

                    }

                        }

                        $this->tpl->set('mode', 'add');

                        $this->tpl->set('message', '- Success -');

                        //$this->tpl->set('content', $this->tpl->fetch('factory/form/enquiry.php'));
                        
                          $this->tpl->set('label', 'List');

                          $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));

                     } else {

                            //edit option

                            //if submit failed to insert form

                            $this->tpl->set('message', 'Failed to submit!');

                            $this->tpl->set('FmData', $form_post_data);

                            $this->tpl->set('content', $this->tpl->fetch('factory/form/enquiry.php'));

                     }

                    break;

                case 'add':

                    $this->tpl->set('mode', 'add');

	                $this->tpl->set('page_header', 'Production');

                    $this->tpl->set('content', $this->tpl->fetch('factory/form/enquiry.php'));

                    break;



                default:

                    /*

                     * List form

                     */

                     

                    ////////////////////start//////////////////////////////////////////////

                    

           //bUILD SQL 

            $whereString = '';

            

         $colArr = array(

                "$enquirymaster_tab.ID",

                "$enquirymaster_tab.CompanyName",

                "$industry_table.IndustryType",

                "$enquirymaster_tab.Website",

                "$enquirymaster_tab.ProductInterested",

                "$enquirymaster_tab.CompanyAddress",

                "$lead_table.LeadStatus"

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

             $whereString ="ORDER BY $enquirymaster_tab.ID DESC";

           }

            

            

          

               $sql = "SELECT "

                    . implode(',',$colArr)

                    . " FROM $enquirymaster_tab,$industry_table,$lead_table "

                    . " WHERE "

                    . " $industry_table.ID= $enquirymaster_tab.industry_id AND "

                    . " $lead_table.ID=$enquirymaster_tab.leadstatus_id "

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

         

         

            $this->tpl->set('table_columns_label_arr', array('ID','Company Name','Industry Type','Website','Product Interested','Company Address','Lead Status'));

            

            /*

             * selectColArr for filter form

             */

            

            $this->tpl->set('selectColArr',$colArr);

                        

            /*

             * set pagination template

             */

            $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');

                   

            //////////////////////close//////////////////////////////////////  

                     

                    include_once $this->tpl->path . '/factory/form/crud_enquiry.php';

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

    

    /*

     * End of Class

     */

         function online(){

     if ($this->crg->get('wp') || $this->crg->get('rp')) {

 ////////////////////////////////////////////////////////////////////////////////

 //////////////////////////////access condition applied//////////////////////////

 ////////////////////////////////////////////////////////////////////////////////    

            

            include_once 'util/DBUTIL.php';

            $dbutil = new DBUTIL($this->crg);

             

            $entityID = $this->ses->get('user')['entity_ID'];

            $userID = $this->ses->get('user')['ID'];

            

            $SOPMaster_tab = $this->crg->get('table_prefix') . 'SOPMaster';

            $product_tab = $this->crg->get('table_prefix') . 'product';

             $unit_tab = $this->crg->get('table_prefix') . 'unit';

            $SOP_tab = $this->crg->get('table_prefix') . 'SOP';

            $equipment_tab = $this->crg->get('table_prefix') . 'equipment';

            

            $workorder_tab = $this->crg->get('table_prefix') . 'workorder';

             $shift_tab = $this->crg->get('table_prefix') . 'shifttiming';

            $employee_tab = $this->crg->get('table_prefix') . 'employee';

             $bdreason_tab = $this->crg->get('table_prefix') . 'breakdownreasons';

              $pipeproduction_tab = $this->crg->get('table_prefix') . 'pipeproduction';

            

            $onlineinspsubdet_tab = $this->crg->get('table_prefix') . 'onlineinspsubdet';

            $onlineinspmaster_tab = $this->crg->get('table_prefix') . 'onlineinspmaster';

            $onlineinspdet_tab = $this->crg->get('table_prefix') . 'onlineinspdet';

            $onlineinspprobdet_tab = $this->crg->get('table_prefix') . 'onlineinspprobdet';

            $partspecdeta_tab = $this->crg->get('table_prefix') . 'partspecdetail';

            

            

             //WO select box data 

            $sqlwodet= "SELECT ID,BatchNo FROM $workorder_tab WHERE $workorder_tab.entity_ID = $entityID";            

            $stmt = $this->db->prepare($sqlwodet);            

            $stmt->execute();

            $wo_data  = $stmt->fetchAll(2);	

            

            $this->tpl->set('wo_data', $wo_data);

            

            

             //BDReason select box data 

            $sqlbddet= "SELECT ID,Description FROM $bdreason_tab WHERE $bdreason_tab.entity_ID = $entityID";            

            $stmt = $this->db->prepare($sqlbddet);            

            $stmt->execute();

            $bd_data  = $stmt->fetchAll(2);	

            

            $this->tpl->set('BDreason_data', $bd_data);

            

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

            

            

            //Product select box data 

            $sqlproductdet= "SELECT ID,ItemName FROM $product_tab WHERE $product_tab.entity_ID = $entityID";            

            $stmt = $this->db->prepare($sqlproductdet);            

            $stmt->execute();

            $product_data  = $stmt->fetchAll(2);	

            

            $this->tpl->set('product_data', $product_data);

            

            

            //SOP Parameter data 

            $sqlSOPMaster= "SELECT $SOPMaster_tab.ID,$SOPMaster_tab.ParameterName,$unit_tab.UnitName, $SOPMaster_tab.Spec,$SOPMaster_tab.GroupName FROM $SOPMaster_tab,$unit_tab where $SOPMaster_tab.unit_ID=$unit_tab.ID and ($SOPMaster_tab.GroupName <>'' ) ";            

           

            $stmt = $this->db->prepare($sqlSOPMaster);            

            $stmt->execute();

            $SOPMaster_data  = $stmt->fetchAll();

            

            $this->tpl->set('SOPMaster_data', $SOPMaster_data);

            

            



            $this->tpl->set('page_title', 'On-line Inspection Entry');	          

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

                case 'edit':                    

                      $data = trim($_POST['ycs_ID']);

                    

                

                    if (!$data) {

                        $this->tpl->set('message', 'Please select any one ID to '.$crud_string.'!');

                        $this->tpl->set('label', 'List');

                        $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));

                        break;

                    }

                    

                  

                    

                    //mode of form submit

                    $this->tpl->set('mode', $crud_string);

                  

                    //set id to edit $ycs_ID

                    $this->tpl->set('ycs_ID', $data);         

                                

                    $sqlpro="Select product_ID from $SOP_tab where $SOP_tab.ID=$data" ;           

                    $stmt = $this->db->prepare($sqlpro);            

                    $stmt->execute();

                    $productID = $stmt->fetch(4);

                 

                    $sqlsrr = "select $partspecdeta_tab.ID, $onlineinspmaster_tab.TotInspQty,$onlineinspmaster_tab.AcceptedQty,$onlineinspmaster_tab.ReworkQty,"

                                ."$onlineinspmaster_tab.RejectedQty,$onlineinspmaster_tab.RejectionPPM,$onlineinspmaster_tab.ReworkPPM,$equipment_tab.EquipmentName,"

                                ."$onlineinspmaster_tab.ProbDesc,$onlineinspmaster_tab.ProbQty,$onlineinspmaster_tab.workorder_ID,$product_tab.ItemName,"

                                ."$onlineinspmaster_tab.shift_ID,$onlineinspmaster_tab.operator_ID,$partspecdeta_tab.Parameter,"

                                ."$partspecdeta_tab.ParamValue,$onlineinspdet_tab.InsValue1,$onlineinspdet_tab.InsValue2,"

                                ."$onlineinspdet_tab.InsValue3,$onlineinspdet_tab.InsValue4,$onlineinspdet_tab.InsValue5,"

                                ."$onlineinspdet_tab.InsValue6,$onlineinspdet_tab.InsValue7,$onlineinspdet_tab.InsValue8,"

                                ."$onlineinspdet_tab.InsResult from $onlineinspmaster_tab,$onlineinspdet_tab,$workorder_tab,$partspecdeta_tab,$product_tab,$shift_tab,$equipment_tab "

                                ."where $onlineinspdet_tab.onlineinspmaster_ID=$onlineinspmaster_tab.ID and $partspecdeta_tab.ID=$onlineinspdet_tab.partspecdetail_ID " 

                                ."and $workorder_tab.ID=$onlineinspmaster_tab.workorder_ID and $onlineinspmaster_tab.shift_ID=$shift_tab.ID " 

                                ." and $workorder_tab.product_ID=$product_tab.ID and $partspecdeta_tab.equipment_ID=$equipment_tab.ID and $onlineinspmaster_tab.id=$data order by $partspecdeta_tab.ID ";

                                

                    $onlineinspdet_data = $dbutil->getSqlData($sqlsrr);             

                    $this->tpl->set('FmData', $onlineinspdet_data); 

                    

                    

                 $sqlsubrr =  "SELECT  $SOPMaster_tab.ID, $onlineinspsubdet_tab.parametername as ParameterName,$SOPMaster_tab.GroupName,$SOPMaster_tab.Spec,"

                                  ."$onlineinspsubdet_tab.FPA,$onlineinspsubdet_tab.MPA,$onlineinspsubdet_tab.LPA "

                                  ."FROM $onlineinspsubdet_tab "

                                  ."left OUTER join $SOPMaster_tab on  $onlineinspsubdet_tab.sopmaster_ID=$SOPMaster_tab.ID where $onlineinspsubdet_tab.onlineinspmaster_ID=$data order by $onlineinspsubdet_tab.ID asc";

                    

                                  

                    $onlineinspsubdet_data = $dbutil->getSqlData($sqlsubrr);             

                    $this->tpl->set('FmsubData', $onlineinspsubdet_data); 

                    

                    $sql_sub = "SELECT $onlineinspprobdet_tab.ProbDesc,$onlineinspprobdet_tab.ProbQty FROM $onlineinspprobdet_tab WHERE $onlineinspprobdet_tab.onlineinspmaster_ID ='$data'";                    

                    $onlineinspprobdet_data = $dbutil->getSqlData($sql_sub);             

                    $this->tpl->set('FmDataSub', $onlineinspprobdet_data);

                    

                    

                    $this->tpl->set('message', 'You can '.$crud_string);

                    $this->tpl->set('page_header', 'Sales');

                    

                    $this->tpl->set('content', $this->tpl->fetch('factory/form/onlineinspection.php'));                    

                    break;

                    

                   

                

                case 'editsubmit':             

                    $data = trim($_POST['ycs_ID']);

                  

                    //mode of form submit

                    $this->tpl->set('mode', 'edit');

                    //set id to edit $ycs_ID

                    $this->tpl->set('ycs_ID', $data);

                    try{

                     if (isset($crud_string)) {

                     include_once 'util/genUtil.php';

                            $util = new GenUtil();

                            $form_post_data = $util->arrFltr($_POST);

                            



                        $entry_count = 1;

                        $entry_count1=1;

                        $entry_count2=1;

                       

                                                $productID = $_POST['productID'];

                                               // $workorder_ID = $_POST['workorder_ID'];

                                                $shift=$form_post_data['Shift'];

                                                $operator=$form_post_data['OperatorName'] ;

                                                $productiontime=$form_post_data['productiontime'] ;

                                                $TotInspQty=$form_post_data['TotInspQty'];

                                                $RejectionPPM=$form_post_data['RejectionPPM'] ;

                                                $AcceptedQty=$form_post_data['AcceptedQty'];

                                                $ReworkPPM=$form_post_data['ReworkPPM'] ;

                                                $ReworkQty=$form_post_data['ReworkQty'];

                                                $ProbDesc=$form_post_data['ProbDesc'] ;

                                                $RejectedQty=$form_post_data['RejectedQty'];

                                                $ProblemQty=$form_post_data['ProblemQty'] ;

                                                

                        $sqlupdate= "Update $onlineinspmaster_tab set "

                                                    // ." `workorder_ID`='$workorder_ID'," 

                                                     ." `shift_ID`='$shift'," 

                                                     ."`operator_ID`='$operator'," 

                                                     ."`InspDate`='$productiontime'," 

                                                     ."`TotInspQty`='$TotInspQty',"  

                                                     ."`RejectionPPM`='$RejectionPPM'," 

                                                     ."`AcceptedQty`='$AcceptedQty'," 

                                                     ."`ReworkPPM`='$ReworkPPM'," 

                                                     ."`ReworkQty`='$ReworkQty'," 

                                                      ."`ProbDesc`='$ProbDesc'," 

                                                      ."`RejectedQty`='$RejectedQty'," 

                                                      ."`ProbQty`='$ProblemQty'    where ID=$data"  ;

                                                     

                        $stmt = $this->db->prepare($sqlupdate);  

                        $entry_count=1;

                     

                         if ($stmt->execute()) { 

                             

                             

                        $sqldetdelete="Delete from $onlineinspdet_tab where $onlineinspdet_tab.onlineinspmaster_ID=$data" ; 

                        $stmt = $this->db->prepare($sqldetdelete);            

                        $stmt->execute();

                       

                     

                        FOR ($entry_count; $entry_count <= $form_post_data['partSpecmaxCount'];) {

                               

                                $partspec_ID ='RMID_' . $entry_count;

                                $Obs1='Obs1_' . $entry_count ;

                                $Obs2='Obs2_'. $entry_count;

                                $Obs3='Obs3_'. $entry_count;

                                $Obs4='Obs4_'. $entry_count;

                                $Obs5='Obs5_' . $entry_count;

                                $Obs6='Obs6_'. $entry_count;

                                $Obs7='Obs7_'. $entry_count;

                                $Obs8='Obs8_'. $entry_count;

                                $ObsResult='Result_'. $entry_count;



                                $vals = "'" . $data . "'," .

                                        "'" . $form_post_data[$partspec_ID] . "'," .

                                         "'" . $form_post_data[$Obs1] . "'," .

                                         "'" . $form_post_data[$Obs2] . "'," .

                                         "'" . $form_post_data[$Obs3] . "'," .

                                           "'" . $form_post_data[$Obs4] . "'," .

                                         "'" . $form_post_data[$Obs5] . "'," .

                                         "'" . $form_post_data[$Obs6] . "'," .

                                           "'" . $form_post_data[$Obs7] . "'," .

                                         "'" . $form_post_data[$Obs8] . "'," .

                                         "'" . $form_post_data[$ObsResult] . "'" ;

                                       

                                         //"'" . $form_post_data[$Temp] . "'";

                                 

                          $sql2 = "INSERT INTO $onlineinspdet_tab

                                        ( 

                                `onlineinspmaster_ID`, 

                                `partspecdetail_ID`,

                                `InsValue1`,

                                `InsValue2`,

                                `InsValue3`,

                                 `InsValue4`,

                                `InsValue5`,

                                `InsValue6`,

                                 `InsValue7`,

                                `InsValue8`,

                                `InsResult`

                                 ) 

                                VALUES ($vals)";



                                 // this need to be changed in to transaction type

                                

                                $stmt = $this->db->prepare($sql2);

                                $stmt->execute();

                                  //increment here

                                $entry_count++;

                                

                            }

                             

                         }

                        $stmt = $this->db->prepare($sqlupdate);  

                        $entry_count1=1;

                     

                         if ($stmt->execute()) { 

                              

                    $sqldelete="Delete from $onlineinspsubdet_tab where $onlineinspsubdet_tab.onlineinspmaster_ID=$data "; 

                        $stmt = $this->db->prepare($sqldelete);            

                        $stmt->execute();

                                       

                            FOR ($entry_count1; $entry_count1 <= $form_post_data['maxCount'];) {

                               

                                $ParamName ='ItemNo_' . $entry_count1;

                                $SOPID ='ItemName_' . $entry_count1;

                                $FPA='FPA_' . $entry_count1;

                                $MPA='MPA_'. $entry_count1;

                                $LPA='LPA_'. $entry_count1;

                                

                                

                                

                                $vals = "'" . $data . "'," .

                                        "'" . $form_post_data[$SOPID] . "'," .

                                        "'" . $form_post_data[$ParamName] . "'," .

                                         "'" . $form_post_data[$FPA] . "'," .

                                         "'" . $form_post_data[$MPA] . "'," .

                                         "'" . $form_post_data[$LPA] . "'" ;

                                          

                                 

                          $sql2 = "INSERT INTO $onlineinspsubdet_tab

                                        ( 

                                `onlineinspmaster_ID`,

                                `sopmaster_ID`,

                                `parametername`,

                                `FPA`,

                                `MPA`,

                                `LPA`

                                 ) 

                                VALUES ($vals)";



                                 // this need to be changed in to transaction type

                                

                                $stmt = $this->db->prepare($sql2);

                                $stmt->execute();

                                  //increment here

                                $entry_count1++;

                                

                          

                            }

                             

                         }

                                  

                       

                                $stmt = $this->db->prepare($sql2);

                                $entry_count2=1;

                                  if ($stmt->execute()) { 

                                         

                                  $sqldelete="Delete from $onlineinspprobdet_tab where $onlineinspprobdet_tab.onlineinspmaster_ID=$data "; 

                                    $stmt = $this->db->prepare($sqldelete);            

                                    $stmt->execute();

                                 

                                FOR ($entry_count2; $entry_count2 <= $form_post_data['maxCountSub'];) {

                               

                                $prbqty ='Water_' . $entry_count2;

                                $ProbDesc ='Rat_' . $entry_count2;

                                

                                

                                $vals = "'" . $data . "'," .

                                        "'" . $form_post_data[$prbqty] . "'," .

                                        "'" . $form_post_data[$ProbDesc] . "'" ;

                                         

                                          

                                 

                        $sql2 = "INSERT INTO $onlineinspprobdet_tab

                                        ( 

                                `onlineinspmaster_ID`,

                                `ProbDesc`,

                                `ProbQty`

                                

                                 ) 

                                VALUES ($vals)";





                                 // this need to be changed in to transaction type

                                

                                $stmt = $this->db->prepare($sql2);

                                $stmt->execute();

                                  //increment here

                                $entry_count2++;

                                

                                

                     }

                            

                     }

                          

                            

                     }

                     

                            $this->tpl->set('message', 'On-line Inspection Entry  edited successfully!');  

                            $this->tpl->set('label', 'List');

                            $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));

                            } catch (Exception $exc) {

                             //edit failed option

                            $this->tpl->set('message', 'Failed to edit, try again!');

                            $this->tpl->set('FmData', $form_post_data);

                            $this->tpl->set('content', $this->tpl->fetch('factory/form/onlineinspection.php'));

                            }

                            

                     break;



                case 'addsubmit':

                     if (isset($crud_string)) {

                         

                        $form_post_data = $dbutil->arrFltr($_POST);

                        var_dump($_POST);

                      

                         $entry_count = 1;

                         $entry_count1 = 1;

                         $entry_count2 = 1;



                            if (isset($form_post_data['BatchNo'])) {

        

                                      

                                        $vals = "'" . $form_post_data['BatchNo'] . "'," .

                                                "'" . $form_post_data['Shift'] ."'," .

                                                "'" . $form_post_data['OperatorName'] . "'," .

                                                "'" . $form_post_data['productiontime'] . "'," .

                                                "'" . $form_post_data['TotInspQty'] ."'," .

                                                "'" . $form_post_data['RejectionPPM'] . "'," .

                                                "'" . $form_post_data['AcceptedQty'] ."'," .

                                                "'" . $form_post_data['ReworkPPM'] . "'," .

                                                "'" . $form_post_data['ReworkQty'] ."'," .

                                               // "'" . $form_post_data['ProbDesc'] . "'," .

                                                "'" . $form_post_data['RejectedQty'] ."'," .

                                                //"'" . $form_post_data['ProblemQty'] . "'," .

                                               "'" .  $this->ses->get('user')['entity_ID'] . "'," .

                                                "'" .  $this->ses->get('user')['ID'] . "'";

                                         

                                        $sql2 = "INSERT INTO $onlineinspmaster_tab" .

                                                "( 

                                                     `workorder_ID`,

                                                     `shift_ID`,

                                                     `operator_ID`,

                                                     `InspDate`,

                                                     `TotInspQty`, 

                                                     `RejectionPPM`,

                                                     `AcceptedQty`,

                                                     `ReworkPPM`,

                                                     `ReworkQty`,

                                                     `RejectedQty`,

                                                     `entity_ID`,

                                                     `users_ID`

                                       ) 

                                        VALUES ($vals)";

        

                                        // this need to be changed in to transaction type

                                        

                                        $stmt = $this->db->prepare($sql2);

                                       

                                          //increment here

                                       

                                       if ($stmt->execute()) { 

                        $lastInsertedID = $this->db->lastInsertId();

                        FOR ($entry_count; $entry_count <= $form_post_data['partSpecmaxCount'];) {

                               

                                $partspec_ID ='RMID_' . $entry_count;

                                $Obs1='Obs1_' . $entry_count ;

                                $Obs2='Obs2_'. $entry_count;

                                $Obs3='Obs3_'. $entry_count;

                                $Obs4='Obs4_'. $entry_count;

                                $Obs5='Obs5_' . $entry_count;

                                $Obs6='Obs6_'. $entry_count;

                                $Obs7='Obs7_'. $entry_count;

                                $Obs8='Obs8_'. $entry_count;

                                $ObsResult='Result_'. $entry_count;



                                $vals = "'" . $lastInsertedID . "'," .

                                        "'" . $form_post_data[$partspec_ID] . "'," .

                                         "'" . $form_post_data[$Obs1] . "'," .

                                         "'" . $form_post_data[$Obs2] . "'," .

                                         "'" . $form_post_data[$Obs3] . "'," .

                                         "'" . $form_post_data[$Obs4] . "'," .

                                         "'" . $form_post_data[$Obs5] . "'," .

                                         "'" . $form_post_data[$Obs6] . "'," .

                                         "'" . $form_post_data[$Obs7] . "'," .

                                         "'" . $form_post_data[$Obs8] . "'," .

                                         "'" . $form_post_data[$ObsResult] . "'" ;

                                       

                                         //"'" . $form_post_data[$Temp] . "'";

                                 

                          $sql2 = "INSERT INTO $onlineinspdet_tab

                                        ( 

                                `onlineinspmaster_ID`, 

                                `partspecdetail_ID`,

                                `InsValue1`,

                                `InsValue2`,

                                `InsValue3`,

                                `InsValue4`,

                                `InsValue5`,

                                `InsValue6`,

                                `InsValue7`,

                                `InsValue8`,

                                `InsResult`

                                 ) 

                                VALUES ($vals)";



                                 // this need to be changed in to transaction type

                                

                                $stmt = $this->db->prepare($sql2);

                                $stmt->execute();

                                  //increment here

                                $entry_count++;

                                

                            }

                            }

                        

                             $stmt = $this->db->prepare($sql2);

                             //$entry_count1=1;

                            

                                          //increment here

                            if ($stmt->execute()) { 

                            // $lastInsertedID = $this->db->lastInsertId();  

                            FOR ($entry_count1; $entry_count1 <= $form_post_data['maxCount'];) {

                               

                                $ParamName ='ItemNo_' . $entry_count1;

                                $SOPID ='ItemName_' . $entry_count1;

                                $FPA='FPA_' . $entry_count1;

                                $MPA='MPA_'. $entry_count1;

                                $LPA='LPA_'. $entry_count1;

                                

                              //  var_dump($form_post_data[$SOPID]);

                                

                                $vals = "'" . $lastInsertedID . "'," .

                                        "'" . $form_post_data[$SOPID] . "'," .

                                        "'" . $form_post_data[$ParamName] . "'," .

                                         "'" . $form_post_data[$FPA] . "'," .

                                         "'" . $form_post_data[$MPA] . "'," .

                                         "'" . $form_post_data[$LPA] . "'" ;

                                          

                                 

                          $sql2 = "INSERT INTO $onlineinspsubdet_tab

                                        ( 

                                `onlineinspmaster_ID`,

                                `sopmaster_ID`,

                                `parametername`,

                                `FPA`,

                                `MPA`,

                                `LPA`

                                 ) 

                                VALUES ($vals)";





                                 // this need to be changed in to transaction type

                                

                                $stmt = $this->db->prepare($sql2);

                                $stmt->execute();

                                  //increment here

                                $entry_count1++;

                                

                          

                                    }

                                       }

                                $stmt = $this->db->prepare($sql2);

                               // $entry_count2=1;

                            

                                          //increment here

                                if ($stmt->execute()) { 

                                    

                                // $lastInsertedID = $this->db->lastInsertId();    

                        //////newly added

                        

                                FOR ($entry_count2; $entry_count2 <= $form_post_data['maxCountSub'];) {

                               

                                $prbqty ='Water_' . $entry_count2;

                                $ProbDesc ='Rat_' . $entry_count2;

                                

                                

                                $vals = "'" . $lastInsertedID . "'," .

                                        "'" . $form_post_data[$prbqty] . "'," .

                                        "'" . $form_post_data[$ProbDesc] . "'" ;

                                         

                                          

                                 

                        $sql2 = "INSERT INTO $onlineinspprobdet_tab

                                        ( 

                                `onlineinspmaster_ID`,

                                `ProbDesc`,

                                `ProbQty`

                                

                                 ) 

                                VALUES ($vals)";





                                 // this need to be changed in to transaction type

                                

                                $stmt = $this->db->prepare($sql2);

                                $stmt->execute();

                                  //increment here

                                $entry_count2++;

                                

                          

                                    }

                            }

                          

                            }

                             

                        $this->tpl->set('message', '- Success -');

                        $this->tpl->set('content', $this->tpl->fetch('factory/form/onlineinspection.php'));

                        $this->tpl->set('master_layout', 'layout_datepicker.php');

                     } else {

                            //edit option

                            //if submit failed to insert form

                            $this->tpl->set('message', 'Failed to submit!');

                            $this->tpl->set('FmData', $form_post_data);

                            $this->tpl->set('content', $this->tpl->fetch('factory/form/onlineinspection.php'));

                     

                             $this->tpl->set('master_layout', 'layout_datepicker.php');

                     }

                    break;

                case 'add':

                     $this->tpl->set('master_layout', 'layout_datepicker.php');

                    $this->tpl->set('mode', 'add');

                    $this->tpl->set('content', $this->tpl->fetch('factory/form/onlineinspection.php'));

                    break;



                default:

                    /*

                     * List form

                     */

                    

                   $whereString = '';

            

                        $colArr = array(

                            "$onlineinspmaster_tab.ID",

                              "$workorder_tab.BatchNo", 

                              "CONCAT(ItemName, ' ', Description) AS Product ",

                              "$shift_tab.ShiftName",  

                            "InspDate",

                            "TotInspQty", 

                            "RejectionPPM",

                            "AcceptedQty",

                            "ReworkPPM",

                            "ReworkQty",

                            "$onlineinspprobdet_tab.ProbDesc",

                            "RejectedQty",

                            "$onlineinspprobdet_tab.ProbQty"

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

                    }else if(strpos($colNames, 'CONCAT') !== false){

                          if(preg_match('/-/', $colNames)){

                               if($dbutil->concatFilterFormat($colNames)){

                                 $wsarr[] = $dbutil->concatFilterFormat($colNames,'spc');

                               }

                          }else{

                            if($dbutil->concatFilterFormat($colNames)){

                            $wsarr[] = $dbutil->concatFilterFormat($colNames);

                            }  

                          }

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

            } 

                

            $orderBy ="ORDER BY $onlineinspmaster_tab.ID DESC";

           

            

            $sql = "SELECT "

                 . implode(',',$colArr)

                 . " FROM $onlineinspmaster_tab,$workorder_tab,$shift_tab,$onlineinspprobdet_tab,$product_tab"

                 . " WHERE "

                 . " $workorder_tab.ID=$onlineinspmaster_tab.workorder_ID AND "

                 . " $shift_tab.ID=$onlineinspmaster_tab.shift_ID AND "

                 . " $onlineinspprobdet_tab.onlineinspmaster_ID=$onlineinspmaster_tab.ID AND "

                 . " $workorder_tab.product_ID=$product_tab.ID AND "

                 . " $onlineinspmaster_tab.entity_ID = $entityID"

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

             

            $this->tpl->set('table_columns_label_arr', array('Production ID','BatchNo','Product','Shift','Inspection Time','TotInspQty','Rejection PPM','Accepted Qty','Rework PPM','Rework Qty','ProbDesc','Rejected Qty','Prob Qty'));

            

            /*

,'Chiller Temp '             * selectColArr for filter form

             */

            

       $this->tpl->set('selectColArr',$colArr);

                        

            /*

             * set pagination template

             */

            $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');

            

                    include_once $this->tpl->path . '/factory/form/onlineinsp_crud_form.php';

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

    

    function purchaserequest(){

     if ($this->crg->get('wp') || $this->crg->get('rp')) {

 ////////////////////////////////////////////////////////////////////////////////

 //////////////////////////////access condition applied//////////////////////////

 ////////////////////////////////////////////////////////////////////////////////    

            

            

            include_once 'util/DBUTIL.php';

            $dbutil = new DBUTIL($this->crg);

             

            $entityID = $this->ses->get('user')['entity_ID'];

            $userID = $this->ses->get('user')['ID'];

            

            $pedetail_tab = $this->crg->get('table_prefix') . 'purchaseentrydetail';

            $rawmaterial_tab = $this->crg->get('table_prefix') . 'rawmaterial';

            $supplier_tab = $this->crg->get('table_prefix') . 'supplier';

            $prdetail_tab = $this->crg->get('table_prefix') . 'PurchaseRequestDetail';

            $prmaster_tab = $this->crg->get('table_prefix') . 'PurchaseRequestMaster';

            $rawmaterialtype_tab = $this->crg->get('table_prefix') . 'rawmaterialtype';

            $approvaltype_tab = $this->crg->get('table_prefix') . 'approvaltype';

            $approvalprocess_tab = $this->crg->get('table_prefix') . 'approvalprocess';

            

            //approvaltype select box

            

             $sql = "SELECT approver_ID FROM $approvaltype_tab where $approvaltype_tab.ProcessTypeName='Purchase Request'"; 

            $stmt = $this->db->prepare($sql);            

            $stmt->execute();

            $approvaltype_data = $stmt->fetchAll();	

            

            $approve=$approvaltype_data;

            

          //get rawmaterial  info select box 

            $raw_sql ="SELECT ID,RMName FROM $rawmaterial_tab";

            $stmt = $this->db->prepare($raw_sql);            

            $stmt->execute();

            $raw_data= $stmt->fetchAll();	

            $this->tpl->set('raw_data',$raw_data);

           

            $rawtype_sql ="SELECT ID,RawMaterialType FROM $rawmaterialtype_tab";

            $stmt = $this->db->prepare($rawtype_sql);            

            $stmt->execute();

            $rawtype_data= $stmt->fetchAll();	

            $this->tpl->set('rawtype_data',$rawtype_data);

             

             //get supplier  info select box 

            $supplier_sql ="SELECT ID,Company FROM $supplier_tab";

            $stmt = $this->db->prepare($supplier_sql);            

            $stmt->execute();

            $supplier_data= $stmt->fetchAll();	

            $this->tpl->set('supplier_data',$supplier_data);

            

           

            $this->tpl->set('page_title', 'Purchase Request');	          

            $this->tpl->set('page_header', 'Store');

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

                     

                     $sqldetdelete="Delete $prmaster_tab,$prdetail_tab from $prmaster_tab

                                        LEFT JOIN  $prdetail_tab ON $prmaster_tab.ID=$prdetail_tab.purchaserequest_ID 

                                        where $prdetail_tab.purchaserequest_ID=$data"; 

                        $stmt = $this->db->prepare($sqldetdelete);            

                        

                        if($stmt->execute()){

                        $this->tpl->set('message', 'Purchase Request deleted successfully');

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

                                

                    

                    $sqlsrr ="SELECT * FROM `$prdetail_tab`,`$prmaster_tab` WHERE `$prdetail_tab`.`purchaserequest_ID`=`$prmaster_tab`.`ID` AND `$prdetail_tab`.`purchaserequest_ID`='$data'";

                    $prdetail_data = $dbutil->getSqlData($sqlsrr); 

                   

             

                    //edit option     

                    $this->tpl->set('message', 'You Can Edit Purchase Request Form');

                    $this->tpl->set('page_header', 'Store');

                    $this->tpl->set('FmData', $prdetail_data); 

                    

                    $this->tpl->set('content', $this->tpl->fetch('factory/form/purchaserequest_form.php'));                    

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

                    

                  

                                

                     $sqlsrr ="SELECT * FROM `$prdetail_tab`,`$prmaster_tab` WHERE `$prdetail_tab`.`purchaserequest_ID`=`$prmaster_tab`.`ID` AND `$prdetail_tab`.`purchaserequest_ID`='$data'";                    

                    $prdetail_data = $dbutil->getSqlData($sqlsrr); 



                    //edit option     

                    $this->tpl->set('message', 'You Can Edit Purchase Request Form');

                    $this->tpl->set('page_header', 'Store');

                    $this->tpl->set('FmData', $prdetail_data); 



                    $rawtypeID = $prdetail_data[0]['rawmaterialtype_ID'];                     

                    $rawmaterial_tab = $this->crg->get('table_prefix') . 'rawmaterial';

                    $rawmaterial_sql ="SELECT ID,RMName FROM $rawmaterial_tab WHERE rawmaterialtype_ID = $rawtypeID";

                    $stmt = $this->db->prepare($rawmaterial_sql);

                    $stmt->execute();

                    $rawmaterial_data= $stmt->fetchAll();

                    $this->tpl->set('raw_data', $rawmaterial_data); 



                    $this->tpl->set('content', $this->tpl->fetch('factory/form/purchaserequest_form.php'));                    

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

                    $sqldet_del ="DELETE FROM $prdetail_tab WHERE purchaserequest_ID=$data";

                    $stmt = $this->db->prepare($sqldet_del);

                    $stmt->execute();   

                            

                            try{

                              

                            $PurchaseRequestNo= $form_post_data['PurchaseRequestNo'];

                            $PurchaseRequestDate=date("Y-m-d", strtotime($form_post_data['PurchaseRequestDate']));

                            $PurchaseRequestTime= $form_post_data['PurchaseRequestTime'];

                            $materialtype= $form_post_data['MaterialType'];

                            

                            $Remarks=$form_post_data['Remarks'];

                           

                            $sql_update="Update $prmaster_tab set PurchaseRequestNo='$PurchaseRequestNo',PurchaseRequestDate='$PurchaseRequestDate',PurchaseRequestTime='$PurchaseRequestTime',Remarks='$Remarks',rawmaterialtype_ID='$materialtype' WHERE ID=$data";

                          //var_dump($sql_update);

                            $stmt1 = $this->db->prepare($sql_update);

                            $stmt1->execute(); 

                        $entry_count = 1;

                        FOR ($entry_count; $entry_count <= $form_post_data['maxCount'];) {

                                

                                

                                $rawmaterial='ItemNo_' .$entry_count;

                                $purpose='ItemName_' .$entry_count;

                                $reqqty='Water_' .$entry_count;

                                $supplier='EmpName_' .$entry_count;

                                $date='Rate_' .$entry_count;

                                $AvailableQty='Amount_' .$entry_count;

                                $ApproxCost='Note_' .$entry_count;

                                $PaymentType='Quantity_' .$entry_count;

                                $ApprovedQty='BatchNo_' .$entry_count;





                               $vals = "'" . $data . "'," .

                                         "'" . $form_post_data[$rawmaterial] . "'," . 

                                         "'" . $form_post_data[$purpose] . "'," .

                                         "'" . $form_post_data[$reqqty] . "'," .

                                         "'" . $form_post_data[$supplier] . "'," .

                                         "'" . date("Y-m-d H:i:s", strtotime($form_post_data[$date])) . "',".

                                         "'" . $form_post_data[$AvailableQty] . "'," .

                                         "'" . $form_post_data[$ApproxCost] . "'," .

                                         "'" . $form_post_data[$PaymentType] . "'," .

                                          "'" . $form_post_data[$ApprovedQty] . "'" ;

                                 

            $sql2 = "INSERT INTO $prdetail_tab

                                ( 

                                `purchaserequest_ID`, 

                                `rawmaterial_ID`, 

                                `Purpose`, 

                                `ReqQty`,

                                `supplier_ID`,

                                `LastPurchaseDate`,

                                `AvailableQty`,

                                `ApproxCost`,

                                `PaymentType`,

                                `ApprovedQty`



                                )

                                VALUES ($vals)";



                                $stmt = $this->db->prepare($sql2);

                                $stmt->execute();

                            //increment here

                            $entry_count++;

                            }

                       

                            $this->tpl->set('message', 'Purchase Request Form Edited Successfully!');   

                            $this->tpl->set('label', 'List');

                            $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));

                            } catch (Exception $exc) {

                             //edit failed option

                            $this->tpl->set('message', 'Failed To Edit, Try Again!');

                            $this->tpl->set('FmData', $form_post_data);

                            $this->tpl->set('content', $this->tpl->fetch('factory/form/purchaserequest_form.php'));

                            }



                    break;

                case 'confirm':

                        

                    if (isset($crud_string)) {

                            $form_post_data = $dbutil->arrFltr($_POST);

                                               

                            

                            $data=$form_post_data['ycs_ID'];

                           

                           

                            $sql_update="Update $approvalprocess_tab set ApprovalStatus=1 WHERE process_ID=$data and ProcessType='Purchase Request'";

                            $stmt1 = $this->db->prepare($sql_update);

                            $stmt1->execute();

                            

                            // $sql_update="Update $prmaster_tab set Stage='Approved' WHERE $prmaster_tab.supplier_ID=$pid";

                            // $stmt = $this->db->prepare($sql_update);

                            // $stmt->execute();

                            

                            

                            $this->tpl->set('message', 'Purchase Request Confirmed successfully!');   

                            $this->tpl->set('label', 'List');

                            $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));

                          

                            $sqldet_del = "DELETE FROM $prdetail_tab WHERE purchaserequest_ID=$data";

                            $stmt = $this->db->prepare($sqldet_del);

                            $stmt->execute();   

                            

                              $entry_count = 1;

                        FOR ($entry_count; $entry_count <= $form_post_data['maxCount'];) {

                                  

                                             

                                $rawmaterial='ItemNo_' .$entry_count;

                                $purpose='ItemName_' .$entry_count;

                                $reqqty='Water_' .$entry_count;

                                $supplier='EmpName_' .$entry_count;

                                $date='Rate_' .$entry_count;

                                $AvailableQty='Amount_' .$entry_count;

                                $ApproxCost='Note_' .$entry_count;

                                $PaymentType='Quantity_' .$entry_count;

                                $ApprovedQty='BatchNo_' .$entry_count;





                               $vals = "'" . $data . "'," .

                                         "'" . $form_post_data[$rawmaterial] . "'," . 

                                         "'" . $form_post_data[$purpose] . "'," .

                                         "'" . $form_post_data[$reqqty] . "'," .

                                         "'" . $form_post_data[$supplier] . "'," .

                                         "'" . date("Y-m-d H:i:s", strtotime($form_post_data[$date])) . "',".

                                         "'" . $form_post_data[$AvailableQty] . "'," .

                                         "'" . $form_post_data[$ApproxCost] . "'," .

                                         "'" . $form_post_data[$PaymentType] . "'," .

                                          "'" . $form_post_data[$ApprovedQty] . "'" ;

                                 

             $sql2 = "INSERT INTO $prdetail_tab

                                ( 

                                `purchaserequest_ID`, 

                                `rawmaterial_ID`, 

                                `Purpose`, 

                                `ReqQty`,

                                `supplier_ID`,

                                `LastPurchaseDate`,

                                `AvailableQty`,

                                `ApproxCost`,

                                `PaymentType`,

                                `ApprovedQty`



                                )

                                VALUES ($vals)";



                                $stmt = $this->db->prepare($sql2);

                                $stmt->execute();

                            //increment here

                            $entry_count++;

                            }

                            

                    }

                    break;

                case 'addsubmit':

                     if (isset($crud_string)) {

                         

                        $form_post_data = $dbutil->arrFltr($_POST);

                        

      // var_dump($_POST);

               

                 // var_dump($form_post_data);

                        $entry_count = 1;

                        

                       

                            if (isset($form_post_data['PurchaseRequestNo'])) {

                           

                                        $val = "'" . $form_post_data['PurchaseRequestNo'] . "'," .

                                         "'" . date("Y-m-d", strtotime($form_post_data['PurchaseRequestDate'])) . "'," .

                                         "'" . $form_post_data['PurchaseRequestTime'] . "'," .

                                         "'" . $form_post_data['MaterialType'] . "'," .

                                         "'" . $form_post_data['Remarks'] . "'," .

                                         "'" .  $this->ses->get('user')['entity_ID'] . "'," .

                                         "'" .  $this->ses->get('user')['ID'] . "'";



                               $sql = "INSERT INTO `" . $this->crg->get('table_prefix') . "PurchaseRequestMaster`

                                            ( 

                                            `PurchaseRequestNo`, 

                                            `PurchaseRequestDate`,

                                            `PurchaseRequestTime`,

                                            `rawmaterialtype_ID`,

                                            `Remarks`,

                                            `entity_ID`, 

                                            `users_ID`

                                            ) 

                                        VALUES ($val)";

                                  $stmt = $this->db->prepare($sql);

                                  

                                  

                    if ($stmt->execute()) { 



                        //  var_dump($stmt);



                        $lastInsertedID = $this->db->lastInsertId();



                        FOR ($entry_count; $entry_count <= $form_post_data['maxCount'];) {

                                

                                $rawmaterial='ItemNo_' .$entry_count;

                                $purpose='ItemName_' .$entry_count;

                                $reqqty='Water_' .$entry_count;

                                $supplier='EmpName_' .$entry_count;

                                $date='Rate_' .$entry_count;

                                $AvailableQty='Amount_' .$entry_count;

                                $ApproxCost='Note_' .$entry_count;

                                $PaymentType='Quantity_' .$entry_count;

                                $ApprovedQty='BatchNo_' .$entry_count;

                               

                                $vals = "'" . $lastInsertedID . "'," .

                                       

                                         "'" . $form_post_data[$rawmaterial] . "'," . 

                                         "'" . $form_post_data[$purpose] . "'," .

                                         "'" . $form_post_data[$reqqty] . "'," .

                                         "'" . $form_post_data[$supplier] . "'," .

                                         "'" . date("Y-m-d H:i:s", strtotime($form_post_data[$date])) . "',".

                                         "'" . $form_post_data[$AvailableQty] . "'," .

                                         "'" . $form_post_data[$ApproxCost] . "'," .

                                         "'" . $form_post_data[$PaymentType] . "'," .

                                         "'" . $form_post_data[$ApprovedQty] . "'" ;

                                        

                                       

                                    

                                       

                                         //"'" . $form_post_data[$Temp] . "'";

                                 

              $sql2 = "INSERT INTO $prdetail_tab

                            (

                                `purchaserequest_ID`, 

                                `rawmaterial_ID`,

                                `Purpose`, 

                                `ReqQty`,

                                `supplier_ID`,

                                `LastPurchaseDate`,

                                `AvailableQty`,

                                `ApproxCost`,

                                `PaymentType`,

                                `ApprovedQty`

                                

                            ) 

                                

                        VALUES ($vals)";



                                 // this need to be changed in to transaction type

                                

                                $stmt = $this->db->prepare($sql2);

                                $stmt->execute();

                                  //increment here

                                $entry_count++;

                                

                            }

                    }

                     $dbutil->ApprovalProcess('Purchase Request',$approve[0][0],$lastInsertedID);

                        }

                        $this->tpl->set('mode', 'add');

                        $this->tpl->set('message', '- Success -');

                        $this->tpl->set('content', $this->tpl->fetch('factory/form/purchaserequest_form.php'));

                     } else {

                            //edit option

                            //if submit failed to insert form

                            $this->tpl->set('message', 'Failed to submit!');

                            $this->tpl->set('FmData', $form_post_data);

                            $this->tpl->set('content', $this->tpl->fetch('factory/form/purchaserequest_form.php'));

                     }

                       

                    break;

                case 'add':

                            $this->tpl->set('mode', 'add');

	                        $this->tpl->set('page_header', 'Store');

	                  //add new purchase order 

                        $entity_short_code = $this->ses->get('user')['short_code'];

                        $newPRNumber =$dbutil->keyGen('PurchaseRequestMaster', 'PURQ', $entity_short_code,'PurchaseRequestNo');  

                        $this->tpl->set('pr_number', $newPRNumber);

                        $this->tpl->set('content', $this->tpl->fetch('factory/form/purchaserequest_form.php'));

                    break;



                default:

                    /*

                     * List form

                     */

                     

                    ////////////////////start//////////////////////////////////////////////

                    

           //bUILD SQL 

            $whereString = '';

            

   $colArr = array(

       

                "$prmaster_tab.ID",

                "$prmaster_tab.PurchaseRequestNo",

                "DATE_FORMAT($prmaster_tab.PurchaseRequestDate, '%d-%m-%Y') AS PurchaseRequestDate",

                "$prmaster_tab.PurchaseRequestTime",

                "$prmaster_tab.Remarks"

               

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

             $whereString ="ORDER BY $prmaster_tab.ID DESC";

           }

            

          

         $sql = "SELECT "

                    . implode(',',$colArr)

                    . " FROM $prmaster_tab "

                    . " WHERE "

                    . " $prmaster_tab.entity_ID = $entityID "

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

         

         

            $this->tpl->set('table_columns_label_arr', array('ID','Purchase Request No','Date','Time','Remarks'));

            

            /*

             * selectColArr for filter form

             */

            

            $this->tpl->set('selectColArr',$colArr);

                        

            /*

             * set pagination template

             */

            $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');

                   

            //////////////////////close//////////////////////////////////////  

                     

                    include_once $this->tpl->path . '/factory/form/crud_purchase_request_form.php';

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

    

    

       function order(){

     if ($this->crg->get('wp') || $this->crg->get('rp')) {

 ////////////////////////////////////////////////////////////////////////////////

 //////////////////////////////access condition applied//////////////////////////

 ////////////////////////////////////////////////////////////////////////////////    

            

            

            include_once 'util/DBUTIL.php';

            $dbutil = new DBUTIL($this->crg);

            

            //Post data

            include_once 'util/genUtil.php';

            $util = new GenUtil();

           

       

             

            $entityID = $this->ses->get('user')['entity_ID'];

            $userID = $this->ses->get('user')['ID'];

            

            $supplier_tab = $this->crg->get('table_prefix') . 'supplier';

            $rawmaterial_tab = $this->crg->get('table_prefix') . 'rawmaterial';

            $payment_tab = $this->crg->get('table_prefix') . 'paymentmode';

            $podetail_tab = $this->crg->get('table_prefix') . 'purchaseorderdetail';

            $pomaster_tab = $this->crg->get('table_prefix') . 'purchaseorder';

            $unit_tab = $this->crg->get('table_prefix') . 'unit';

            $approvaltype_tab = $this->crg->get('table_prefix') . 'approvaltype';

            $approvalprocess_tab = $this->crg->get('table_prefix') . 'approvalprocess';

            $rawmaterialtype_tab = $this->crg->get('table_prefix') . 'rawmaterialtype';

             //unit select box data

            $unit_sql ="SELECT ID,UnitCode FROM $unit_tab";

            $stmt =$this->db->prepare($unit_sql);            

            $stmt->execute();

            $unit_data = $stmt->fetchAll();	

            $this->tpl->set('unit_data', $unit_data);



            $rawtype_sql ="SELECT ID,RawMaterialType FROM $rawmaterialtype_tab";

            $stmt = $this->db->prepare($rawtype_sql);            

            $stmt->execute();

            $rawtype_data= $stmt->fetchAll();	

            $this->tpl->set('rawtype_data',$rawtype_data);

             

            

            

            //supplierselect box data

            $suppl_sql ="SELECT ID,Company FROM $supplier_tab";

            $stmt =$this->db->prepare($suppl_sql);            

            $stmt->execute();

            $suppl_data = $stmt->fetchAll();	

            $this->tpl->set('suppl_data', $suppl_data);

           // var_dump($Supplier_data);

           

            //paymentmode select box data

            $payment_sql = "SELECT ID,Paymode FROM $payment_tab";

            $stmt =$this->db->prepare($payment_sql);            

            $stmt->execute();

            $payment_data = $stmt->fetchAll();	

            $this->tpl->set('payment_data', $payment_data);

            

           //get rawmaterial  info select box 

            $raw_sql ="SELECT ID,RMName FROM $rawmaterial_tab";

            $stmt = $this->db->prepare($raw_sql);            

            $stmt->execute();

            $raw_data= $stmt->fetchAll();	

            $this->tpl->set('raw_data',$raw_data);

            

            //approvaltype select box

            

            //  $sql = "SELECT approver_ID FROM $approvaltype_tab where $approvaltype_tab.ProcessTypeName='Purchase Order'"; 

            // $stmt = $this->db->prepare($sql);            

            // $stmt->execute();

            // $approvaltype_data = $stmt->fetchAll();	

            

            // $approve=$approvaltype_data;

            

            //var_dump($approve[0][0]);

            

            $this->tpl->set('page_title', 'Purchase Order');	          

            $this->tpl->set('page_header', 'Store');

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

                     

                     $sqldetdelete="Delete $pomaster_tab,$podetail_tab from $pomaster_tab

                                        LEFT JOIN  $podetail_tab ON $pomaster_tab.ID=$podetail_tab.purchaseorder_ID 

                                        where $podetail_tab.purchaseorder_ID=$data"; 

                        $stmt = $this->db->prepare($sqldetdelete);            

                        

                        if($stmt->execute()){

                        $this->tpl->set('message', 'Purchase Order deleted successfully');

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

                                

                    

                    $sqlsrr ="SELECT * FROM `$podetail_tab`,`$pomaster_tab` WHERE `$podetail_tab`.`purchaseorder_ID`=`$pomaster_tab`.`ID` AND `$podetail_tab`.`purchaseorder_ID`='$data'";                    

                    $podetail_data = $dbutil->getSqlData($sqlsrr); 

                   

                

                    //edit option     

                    $this->tpl->set('message', 'You Can View Purchase Order Form');

                    $this->tpl->set('page_header', 'Store');

                    $this->tpl->set('FmData', $podetail_data); 

                    

                    $this->tpl->set('content', $this->tpl->fetch('factory/form/order.php'));                    

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

                    

                     $sqlsrr ="SELECT * FROM `$podetail_tab`,`$pomaster_tab` WHERE `$podetail_tab`.`purchaseorder_ID`=`$pomaster_tab`.`ID` AND `$podetail_tab`.`purchaseorder_ID`='$data'";                    

                    $podetail_data = $dbutil->getSqlData($sqlsrr); 

                   

                    

                    //edit option     

                    $this->tpl->set('message', 'You Can Edit Purchase Order Form');

                    $this->tpl->set('page_header', 'Store');

                    $this->tpl->set('FmData', $podetail_data); 

                    

                    $this->tpl->set('content', $this->tpl->fetch('factory/form/order.php'));                    

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



                    // var_dump($form_post_data);

                

                    //Build SQL now

                    $sqldet_del ="DELETE FROM $podetail_tab WHERE purchaseorder_ID=$data";

                    $stmt = $this->db->prepare($sqldet_del);

                    $stmt->execute();   



                      

       $IGSTTax = $form_post_data['IGSTTax'] ;

       if( $IGSTTax == null )

       {

           $IGSTTax = 0 ;

       }else

       {

           $IGSTTax = $form_post_data['IGSTTax'];

       }

     

      $CGSTTax = $form_post_data['CGSTTax'] ;

       if( $CGSTTax == null )

       {

           $CGSTTax = 0 ;

       }else

       {

           $CGSTTax = $form_post_data['CGSTTax'];

       }

       

      $SGSTTax = $form_post_data['SGSTTax'] ;

      

      if( $SGSTTax == null )

       {

           $SGSTTax = 0 ;

       }else

       {

           $SGSTTax = $form_post_data['SGSTTax'];

       }







       

require_once('TCPDF/capa.php');

                       

ob_start(); // at the beggining of your script





// create new PDF document

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);



// set document information

$pdf->SetCreator(PDF_CREATOR);

$pdf->SetAuthor('Sreenidhi Enterprises');

$report_title = "Invoice Report";

$pdf->SetTitle($report_title);

$pdf->SetSubject('Corrective And Preventive Action');

$pdf->SetKeywords('Quotation,Invoice');



// set default header data

$capa_date = date('d.m.Y',strtotime($capa_data['AuditDateTime']));



$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.'.', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));

$pdf->setFooterData(array(0,64,0), array(0,64,128));



// set header and footer fonts

$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));



// set default monospaced font

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);



// set margins

$pdf->SetMargins(10, 30, 10);

$pdf->SetHeaderMargin(10);

$pdf->SetFooterMargin(10);



// set auto page breaks

$pdf->SetAutoPageBreak(TRUE, 13);



// set image scale factor

$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);



// set some language-dependent strings (optional)

if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {

require_once(dirname(__FILE__).'/lang/eng.php');

$pdf->setLanguageArray($l);

}



// ---------------------------------------------------------



// set default font subsetting mode

$pdf->setFontSubsetting(true);



// Set font

// dejavusans is a UTF-8 Unicode font, if you only need to

// print standard ASCII chars, you can use core fonts like

// helvetica or times to reduce file size.



//$pdf->SetFont('times', '', 12, '', true);



$pdf->SetFont('Helvetica', 'Italic', 10, '', true);



// Add a page

// This method has several options, check the source code documentation for more information.



$pdf->AddPage();



$pageWidth = 200;

$pageHeight = 283;

$margin = 11;

//$pdf->Rect( $margin, $margin , $pageWidth - $margin , $pageHeight - $margin);

// Line break





// Line

$pdf->Line(11, 284, 199, 284, '');



$quote_no = $form_post_data['PurchaseOrderNo'];



$podate=date("Y-m-d", strtotime($form_post_data['PurchaseOrderDate']));



//$html = ob_get_clean();



// $html = <<<EOD





// EOD;



//$pdf->writeHTML($html, true, false, false, false, '');



//$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);



$trows = '';







                            

                            try{

                              

                            $PurchaseOrderNo= $form_post_data['PurchaseOrderNo'];

                            $supplier_ID= $form_post_data['supplier_ID'];

                            $purchaseorder_ID= $form_post_data['purchaseorder_ID'];

                            $Tax= $form_post_data['Tax'];

                            $materialtype=$form_post_data['MaterialType'];

                            $GSTAmount= $form_post_data['GSTAmount'];

                            $BillAmount= $form_post_data['BillAmount'];

                            $NetAmount= $form_post_data['NetAmount'];

                            $PurchaseOrderDate=date("Y-m-d", strtotime($form_post_data['PurchaseOrderDate']));

                            $DespatchThrough= $form_post_data['DespatchThrough'];

                            $SupplierOrderNo= $form_post_data['SupplierOrderNo'];

                            $OtherReference= $form_post_data['OtherReference'];

                            $PaymentMode= $form_post_data['PaymentMode'];

                            $Destination= $form_post_data['Destination'];

                            $TermsOfDelivery=$form_post_data['TermsOfDelivery'];

                            

                            

                            $sql_update="Update $pomaster_tab set PurchaseOrderNo='$PurchaseOrderNo',supplier_ID='$supplier_ID',Tax='$Tax',rawmaterialtype_ID=$materialtype,

                            GSTAmount='$GSTAmount',BillAmount='$BillAmount',NetAmount='$NetAmount',PurchaseOrderDate='$PurchaseOrderDate',DespatchThrough='$DespatchThrough',SupplierOrderNo='$SupplierOrderNo',OtherReference='$OtherReference',PaymentMode='$PaymentMode',Destination='$Destination',TermsOfDelivery='$TermsOfDelivery' WHERE ID=$data";

                            $stmt1 = $this->db->prepare($sql_update);

                            $stmt1->execute(); 



                        $entry_count = 1;

                        FOR ($entry_count; $entry_count <= $form_post_data['maxCount'];) {

                                

                                

                                $ItemNo='ItemNo_' .$entry_count;

                                $ItemName='ItemName_' .$entry_count;

                                $DueDate='Rat_' .$entry_count;

                                $Quantity='Qty_' .$entry_count;

                                $Amount='Amount_' .$entry_count;

                                $Rate='Emp_' .$entry_count;

                                $Per='Water_' .$entry_count;



                                if($ItemNo == null)

                                {

                                    continue ;

                                }

                               

                               





                               $vals = "'" . $data . "'," .

                                         "'" . $form_post_data[$ItemName] . "'," . 

                                         "'" . $form_post_data[$ItemNo] . "'," .

                                       // "'" . $form_post_data[$ItemNo] . "'," .

                                       // "'" . $form_post_data[$ItemName] . "'," . 

                                        "'" . date("Y-m-d H:i:s", strtotime($form_post_data[$DueDate])) . "',".

                                       //  "'" . $form_post_data[$DueDate] . "'," . 

                                        "'" . $form_post_data[$Quantity] . "'," . 

                                        "'" . (float) $form_post_data[$Amount] . "'," .

                                        "'" . (float) $form_post_data[$Rate] . "'," . 

                                        "'" . $form_post_data[$Per] . "'" ; 

                                        

                                        

                                 

               $sql2 = "INSERT INTO $podetail_tab

                                ( 

                                `purchaseorder_ID`, 

                                `RMName`,

                                `rawmaterial_ID`, 

                                `DueDate`,

                                `Quantity`,

                                `EstimatedAmount`,

                                `Rate`,

                                `unit_ID`

                                )

                                VALUES ($vals)";



                                $stmt = $this->db->prepare($sql2);

                                $stmt->execute();

                            //increment here

                            $entry_count++;

                            }



                            $Rawmaterials = "SELECT $podetail_tab.* , $rawmaterial_tab.RMName,$unit_tab.UnitCode FROM $rawmaterial_tab,$unit_tab,$podetail_tab where  $rawmaterial_tab.ID = $podetail_tab.rawmaterial_ID AND $unit_tab.ID = $podetail_tab.unit_ID  AND $podetail_tab.purchaseorder_ID =  $data ";



                            $stmt =$this->db->prepare($Rawmaterials);

                            $stmt->execute();

                            $rawMaterialData = $stmt->fetchAll(2);

                 

                            

                         //    $rawMaterialDatas = array();

                         //    $rawMaterialDatas[] =  $rawMaterialData;

                 

                         //    $count = 1;

                         //    $counts = 0; 

                           

                             // foreach($rawMaterialData as $a=>$b)

                             // {

                                 

                             //     $trows.='<tr>

                             //     <td style="width:50" align="left">'.$counts+1.'</td>

                             //     <td style="width:350" align="left">'. $b['RMName'].'</td>

                             //     <td style="width:67" align="center">'.$b["Quantity"].'</td>

                             //     <td style="width:66" align="right">'.$b["Rate"].'</td>

                             //     <td style="width:66" align="right">'. $b["UnitCode"].'</td>

                             //      <td style="width:66" align="right">'. $b["EstimatedAmount"].'</td>

                             //     </tr>'; 

                             //     $count++;

                             //     $counts++;

                                 

                             // }

                             $count=1;

                             foreach($rawMaterialData as $k=>$v)

                             {

                                  $trows.='<tr>

                                 <td style="width:50" align="left">'.$count.'</td>

                                 <td style="width:350" align="left">'. $v['RMName'].'</td>

                                 <td style="width:67" align="center">'.$v["Quantity"].'</td>

                                 <td style="width:66" align="right">'.$v["Rate"].'</td>

                                 <td style="width:66" align="right">'. $v["UnitCode"].'</td>

                                  <td style="width:66" align="right">'. $v["EstimatedAmount"].'</td>

                                 </tr>'; 

                                  $count++;

                             }

                 

                            for($i=1;$i<3;$i++){

                                                     

                            $trowss.="<tr><td></td><td></td>"      

                                . "<td></td>"

                                . "<td></td>"

                                . "<td></td>"

                                . "<td></td></tr>";

                        }



                        $total=0;

                

                        $tot=number_format($form_post_data[$Amount]);

                        $poNumber = strval($form_post_data['PurchaseOrderNo']);

                        $poDate = strval(date("Y-m-d", strtotime($form_post_data['PurchaseOrderDate'])));       

                        

                        $paymentType = "SELECT $payment_tab.Paymode,$supplier_tab.Company  FROM $payment_tab,$supplier_tab,$pomaster_tab where  $supplier_tab.ID = $pomaster_tab.supplier_ID AND $payment_tab.ID = $pomaster_tab.PaymentMode  AND $pomaster_tab.ID =  $lastInsertedID ";

                        $stmt =$this->db->prepare($paymentType);            

                        $stmt->execute();

                        $paymentMod = $stmt->fetchAll(2);

                 

                        $ModeOfPay = strval($paymentMod[0]["Paymode"]);

                        $Supplier = strval($paymentMod[0]["Company"]);

                 

                        $otherRef = strval($form_post_data['OtherReference']);

                        $termsOfDelivery = strval($form_post_data['TermsOfDelivery']);

                        $cgstPre=strval($CGSTTax.'%');

                        $sgstPre=strval($SGSTTax.'%');

                        $igstPre=strval($IGSTTax.'%');

                        $cgstAmount = strval((float) $form_post_data['CGSTAmount']);

                        $sgstAmount = strval((float) $form_post_data['SGSTAmount']);

                        $igstAmount = strval((float) $form_post_data['IGSTAmount']);

                        $netAmount = strval((float) $form_post_data['NetAmount']);

                        $BillAmount = strval((float) $form_post_data['BillAmount']);



                        

       $number = $netAmount;

       // $inWords = getIndianCurrency( $netAmount);

       $inWords = $util -> getIndianCurrency($number).' only';





                        

$html = ob_get_clean();  



$html = <<<EOD

   <table cellspacing="0" cellpadding="4" border="1">

   

   <tr>

   <td align="center"><u><h3><b style="font-size:20px;">INVOICE</b></h3></u></td>

   </tr>

  

       <tr>

         <td width="333" rowspan="3" align="left" >Invoice To: <br> 

         <b>Kosh Innovations</b><br>

         Cs-46 & 47,<br>

         Pipdic Industrial Estate,<br>  

         Mettupalayam, Puducherry - 605 009.<br> 

         GSTIN/UIN: 34APOPK9748J1Z5<br>

         State Name :  Puducherry,<br> 

         Code : 34<br> 

         E-Mail : koshinnovations@gmail.com  </td>



         <td width="166" align="left">Voucher No.: <br>  <b></b> </td>

         <td width="166" align="left">Date: <br><b>$poDate</b></td>

        

        </tr>

        

        <tr>

        <td width="166" align="left"> will update soon...</td>

        <td width="166" align="left">Mode/Terms of Payment: <br><b> $ModeOfPay</b></td>

      

       </tr>



       <tr>

       <td width="166" align="left">Supplier’s Ref./Order No <br> <b>$poNumber</b></td>

       <td width="166" align="left">Other Reference(s): <br> <b>$otherRef</b></td>

      

      </tr>

   

      <tr>

      <td width="332" align="left">Supplier:<br> <b>$Supplier</b></td>

      <td width="333" align="left">Terms of Delivery: <br><b>$termsOfDelivery</b></td>



     </tr>



       <tr>

       <td width="50" align="center"><b>S.No</b></td>

       <td width="350" align="center"><b>Description of Goods</b></td>

       <td width="67" align="center"><b>Quantity</b></td>

       <td width="66" align="center"> <b>Rate</b></td>

       <td width="66" align="center"><b>Per</b></td>

       <td width="66" align="center"><b>Total Amount</b></td>

      </tr>

        {$trows}

        {$trowss}



        <tr>

        <td width="533" ></td>

        <td width="66" align="right"><b>Total:</b> </td>

        <td width="66" align="right" ><b>$BillAmount</b> </td>

        </tr>

        

        <tr>

        <td width="665" ></td>

        </tr>

        

        <tr>

        <td width="467" align="center"></td>

        <td width="132" align="center"><b>Tax-Percentage</b></td>

        <td width="66" align="center"><b>Amount</b></td>

        </tr>

        <tr>

        <td width="533" align="right">CGST: </td>

        <td width="66" align="right">$cgstPre</td>

        <td width="66" align="right">$cgstAmount</td>

        </tr>

        <tr>

        <td width="533" align="right">SGST: </td>

        <td width="66" align="right">$sgstPre</td>

        <td width="66" align="right">$sgstAmount</td>

        </tr>

        <tr>

        <td width="533" align="right">IGST: </td>

        <td width="66" align="right">$igstPre</td>

        <td width="66" align="right">$igstAmount</td>

        </tr>

 

        <tr>

        <td width="599" align="right"><b>Final Amount</b></td>

        <td width="66" align="right"><b>$netAmount</b></td>

        </tr>



        <tr>

        <td width="665" align="left">Amount Chargeable (in words): <br> <b> $inWords</b><br><br><br><br><br><br><br> </td>

        

        </tr>



        <tr>

        <td width="333" align="left" > Company's Pan:  </td>

        <td width="332" align="right"> <b> For Kosh Innovations </b> <br><br><br><br>  Authorised Signatory

        </td>

        </tr>

  

         

       </table>







EOD;

$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);



$ht = ob_get_clean();                           



//                     $ht=<<<EOD

//                       <table cellspacing="" cellpadding="2">

//                             <tr>

//                                <td>

//                                <p style="text-indent: 50px;">* Our risk and responsiblity ceases once the goods leave the godown.</p>

//                                <p style="text-indent: 50px;">* An interest @ 24% per month will be charged if the payment is not made in time.</p>

//                                <p style="text-indent: 50px;">* Subject to {$tot} jurisdication.</p>

//                                </td>

//                            </tr>

                  

//                        </table>  





// EOD;



$pdf->writeHTMLCell(0, 0, '', '', $ht, 0, 1, 0, true, '', true);



$htl = ob_get_clean();

$htl='



<table cellspacing="" cellpadding="1">

                       

        

       <tr>

           <td>

            <p style="text-indent: 50px;">*This is computer generated Invoice, hence no signature required.</p><p></p>

           </td>

       </tr> 

        

   </table>'

;



$pdf->writeHTMLCell(0, 0, '', '', $htl, 0, 1, 0, true, '', true);



// $htmls = ob_get_clean();                           



// $htmls='





//   <table cellspacing="" cellpadding="">



//          <tr>

//           <img src="" alt="test alt attribute" style="border:1px solid black">  

//        </tr>



//    </table>  

// ';



// $pdf->writeHTMLCell(0, 0, '', '', $htmls, 0, 1, 0, true, '', true);



//$pdf->addDescription("We hope you shall find our rates more competitve and raise your valuable order on us so that it can lay the foundation for our long term business relationship\n\nAssuring you of our best service at all times.");

// $pdf->addDescription($quotationdetail_data[0]['Description']);

//$pdf->Ln();

// $pdf->addTermsCondtNew('*This is computer generated quotation and hence no signature required.');



                       // Print text using writeHTMLCell()





// ---------------------------------------------------------



// $sign='*This is computer generated Invoice, hence no signature required.';



// 	$x = $pdf->GetX();

//     $y = $pdf->GetY();

// 	$pdf->SetXY( $x, $y+10 );

// 	$length = $pdf->GetStringWidth( $sign );

// 	$lignes = $pdf->sizeOfText( $sign, $length) ;

// 	$pdf->MultiCell(190, 4, $sign,0,'L',0,1,'','',true,0,false,true,0);





ob_end_clean();// at the end of your script



$pdf->Output($_SERVER['DOCUMENT_ROOT'] ."/resource/documents/Invoice".$quote_no.".pdf", "F");



$this->ses->set('pdffile', "/resource/documents/Invoice".$quote_no.".pdf"); 





//$dbutil->ApprovalProcess('Purchase Order',$approve[0][0],$data);   



                 

                      

                     

                       

                            $this->tpl->set('message', 'Purchase Order Form Edited Successfully!');   

                            $this->tpl->set('label', 'List');

                            $this->tpl->set('callmodal', 'yes');

                            $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));

                            } catch (Exception $exc) {

                             //edit failed option

                            $this->tpl->set('message', 'Failed To Edit, Try Again!');

                            $this->tpl->set('FmData', $form_post_data);

                            $this->tpl->set('content', $this->tpl->fetch('factory/form/order.php'));

                            }



                    break;

                    /////////////////////newly added (26.06.2019)///////////////

                    // case 'confirm':

                        

                    // if (isset($crud_string)) {

                    //         $form_post_data = $dbutil->arrFltr($_POST);

                                               

                            

                    //         $data=$form_post_data['ycs_ID'];

                    //         $pid=$form_post_data['supplier_ID'];

                    //         // var_dump($pid); 

                    //         $sql_update="Update $approvalprocess_tab set ApprovalStatus=1 WHERE process_ID=$data and ProcessType='Purchase Order'";

                    //         $stmt1 = $this->db->prepare($sql_update);

                    //         $stmt1->execute();

                            

                    //         $sql_update="Update $pomaster_tab set Stage='Approved' WHERE $pomaster_tab.supplier_ID=$pid";

                    //         $stmt = $this->db->prepare($sql_update);

                    //         $stmt->execute();

                            

                            

                    //         $this->tpl->set('message', 'Purchase Order Confirmed successfully!');   

                    //         $this->tpl->set('label', 'List');

                    //         $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));

                            

                    //         // $sqldet_del = "DELETE FROM $podetail_tab WHERE purchaseorder_ID=$data";

                    //         // $stmt = $this->db->prepare($sqldet_del);

                    //         // $stmt->execute();   

                            

                    //           $entry_count = 1;

                    //     FOR ($entry_count; $entry_count <= $form_post_data['maxCount'];) {

                                  

                    //             $ItemNo='ItemNo_' .$entry_count;

                    //             $ItemName='ItemName_' .$entry_count;

                    //             $DueDate='Rat_' .$entry_count;

                    //             $Quantity='Qty_' .$entry_count;

                    //             $Amount='Amount_' .$entry_count;

                    //             $Rate='Emp_' .$entry_count;

                    //             $Per='Water_' .$entry_count;



                    //                      $vals = "'" . $data . "'," .

                    //                      "'" . $form_post_data[$ItemName] . "'," . 

                    //                      "'" . $form_post_data[$ItemNo] . "'," .

                    //                   // "'" . $form_post_data[$ItemNo] . "'," .

                    //                   // "'" . $form_post_data[$ItemName] . "'," . 

                    //                     "'" . date("Y-m-d H:i:s", strtotime($form_post_data[$DueDate])) . "',".

                    //                   //  "'" . $form_post_data[$DueDate] . "'," . 

                    //                     "'" . $form_post_data[$Quantity] . "'," . 

                    //                     "'" . (float) $form_post_data[$Amount] . "'," .

                    //                     "'" . (float) $form_post_data[$Rate] . "'," . 

                    //                     "'" . $form_post_data[$Per] . "'" ; 

                                

                    //             $sql2 = "INSERT INTO $podetail_tab

                    //             ( 

                    //             `purchaseorder_ID`, 

                    //             `rawmaterial_ID`, 

                    //             `RMName`,

                    //             `DueDate`,

                    //             `Quantity`,

                    //             `EstimatedAmount`,

                    //             `Rate`,

                    //             `unit_ID`

                    //             VALUES ($vals)";



                    //             $stmt = $this->db->prepare($sql2);

                    //             $stmt->execute();

                    //         //increment here

                    //         $entry_count++;

                    //         }

                            

                    // }

                    // break;

 /////////////////////newly ended for confirm (26.06.2019)///////////////

 case 'addsubmit':

    if (isset($crud_string)) {



       $form_post_data = $dbutil->arrFltr($_POST);

       

       



       $IGSTTax = $form_post_data['IGSTTax'] ;

       if( $IGSTTax == null )

       {

           $IGSTTax = 0 ;

       }else

       {

           $IGSTTax = $form_post_data['IGSTTax'];

       }

     

      $CGSTTax = $form_post_data['CGSTTax'] ;

       if( $CGSTTax == null )

       {

           $CGSTTax = 0 ;

       }else

       {

           $CGSTTax = $form_post_data['CGSTTax'];

       }



      $SGSTTax = $form_post_data['SGSTTax'] ;

      

      if( $SGSTTax == null )

       {

           $SGSTTax = 0 ;

       }else

       {

           $SGSTTax = $form_post_data['SGSTTax'];

       }



       $entry_count = 1;

       

      

           if (isset($form_post_data['supplier_ID'])) {

          

                       $val = "'" . $form_post_data['PurchaseOrderNo'] . "'," .

                        "'" . $form_post_data['supplier_ID'] . "'," .

                        "'" . date("Y-m-d", strtotime($form_post_data['PurchaseOrderDate'])) . "'," .

                        "'" . $CGSTTax . "'," .

                        "'" . (float) $form_post_data['CGSTAmount'] . "'," .

                        "'" . $SGSTTax . "'," .

                        "'" . (float) $form_post_data['SGSTAmount'] . "'," .

                        "'" .$IGSTTax . "'," .

                        "'" . (float) $form_post_data['IGSTAmount'] . "'," .

                        "'" . $form_post_data['MaterialType'] . "'," .

                        "'" . (float) $form_post_data['BillAmount'] . "'," .

                        "'" . (float) $form_post_data['NetAmount'] . "'," .

                        "'" . $form_post_data['DespatchThrough'] . "'," .

                        "'" . $form_post_data['SupplierOrderNo'] . "'," .

                        "'" . $form_post_data['OtherReference'] . "'," .

                        "'" . $form_post_data['PaymentMode'] . "'," .

                        "'" . $form_post_data['Destination'] . "'," .

                        "'" . $form_post_data['TermsOfDelivery'] . "'," .

                        "'" .  $this->ses->get('user')['entity_ID'] . "'," .

                        "'" .  $this->ses->get('user')['ID'] . "'";



             $sql = "INSERT INTO `" . $this->crg->get('table_prefix') . "purchaseorder`

                           ( 

                           `PurchaseOrderNo`, 

                           `supplier_ID`,

                           `PurchaseOrderDate`,

                           `CGSTTax`,

                           `CGSTAmount`,

                           `SGSTTax`,

                           `SGSTAmount`,

                           `IGSTTax`,

                           `IGSTAmount`,

                          `rawmaterialtype_ID`,  

                           `BillAmount`, 

                           `NetAmount`,

                           `DespatchThrough`,

                           `SupplierOrderNo`,

                           `OtherReference`,

                           `PaymentMode`,

                           `Destination`, 

                           `TermsOfDelivery`,

                           `entity_ID`, 

                           `users_ID`

                           ) 

                       VALUES ($val)";

                 $stmt = $this->db->prepare($sql);

                 

                 

   if ($stmt->execute()) { 

       $lastInsertedID = $this->db->lastInsertId();

                   

require_once('TCPDF/capa.php'); 

                       

ob_start(); // at the beggining of your script





// create new PDF document

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);



// set document information

$pdf->SetCreator(PDF_CREATOR);

$pdf->SetAuthor('Sreenidhi Enterprises');

$report_title = "Invoice Report";

$pdf->SetTitle($report_title);

$pdf->SetSubject('Corrective And Preventive Action');

$pdf->SetKeywords('Quotation,Invoice');



// set default header data

$capa_date = date('d.m.Y',strtotime($capa_data['AuditDateTime']));



$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.'.', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));

$pdf->setFooterData(array(0,64,0), array(0,64,128));



// set header and footer fonts

$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));

$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));



// set default monospaced font

$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);



// set margins

$pdf->SetMargins(10, 30, 10);

$pdf->SetHeaderMargin(10);

$pdf->SetFooterMargin(10);



// set auto page breaks

$pdf->SetAutoPageBreak(TRUE, 13);



// set image scale factor

$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);



// set some language-dependent strings (optional)

if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {

require_once(dirname(__FILE__).'/lang/eng.php');

$pdf->setLanguageArray($l);

}



// ---------------------------------------------------------



// set default font subsetting mode

$pdf->setFontSubsetting(true);



// Set font

// dejavusans is a UTF-8 Unicode font, if you only need to

// print standard ASCII chars, you can use core fonts like

// helvetica or times to reduce file size.



//$pdf->SetFont('times', '', 12, '', true);



$pdf->SetFont('Helvetica', 'Italic', 10, '', true);



// Add a page

// This method has several options, check the source code documentation for more information.



$pdf->AddPage();



$pageWidth = 200;

$pageHeight = 283;

$margin = 11;

//$pdf->Rect( $margin, $margin , $pageWidth - $margin , $pageHeight - $margin);

// Line break





// Line

$pdf->Line(11, 284, 199, 284, '');



$quote_no = $form_post_data['PurchaseOrderNo'];



$podate=date("Y-m-d", strtotime($form_post_data['PurchaseOrderDate']));







//$html = ob_get_clean();



// $html = <<<EOD





// EOD;



//$pdf->writeHTML($html, true, false, false, false, '');



//$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);



$trows = '';









       FOR ($entry_count; $entry_count <= $form_post_data['maxCount'];) {

               

           

               

                

               $ItemNo='ItemNo_' .$entry_count;

               $ItemName='ItemName_' .$entry_count;

               $DueDate='Rat_' .$entry_count;

               $Quantity='Qty_' .$entry_count;

               $Amount='Amount_' .$entry_count;

               $Rate='Emp_' .$entry_count;

               $Per='Water_' .$entry_count;



               if($ItemNo == null)

               {

                   continue ;

               }

              

               



               $vals = "'" . $lastInsertedID . "'," .

                       "'" . $form_post_data[$ItemName] . "'," . 

                       "'" . $form_post_data[$ItemNo] . "'," .

                       "'" . date("Y-m-d H:i:s", strtotime($form_post_data[$DueDate])) . "',".

                       "'" . $form_post_data[$Quantity] . "'," . 

                       "'" . (float) $form_post_data[$Amount] . "',".

                       "'" . $form_post_data[$Rate] . "'," . 

                       "'" . (float) $form_post_data[$Per] . "'" ;

                        //"'" . $form_post_data[$Temp] . "'";

                

             $sql2 = "INSERT INTO $podetail_tab

           (

               `purchaseorder_ID`, 

               `RMName`,

               `rawmaterial_ID`, 

               `DueDate`,

               `Quantity`,

               `EstimatedAmount`,

               `Rate`,

               `unit_ID`

           ) 

               

       VALUES ($vals)";



                // this need to be changed in to transaction type

               

               $stmt = $this->db->prepare($sql2);

               $stmt->execute();







        //        $ptype=$form_post_data[$ItemNo];



        //        $actQuantity=$form_post_data[$Quantity];



        //        $rate=$form_post_data[$Rate];

               

        //        $actItemNo=$form_post_data[$Per];

               

        //        $price=$form_post_data[$Amount];



               

        //        $tot= number_format($form_post_data[$Amount]);              

        //        $trows.='<tr>

        //    <td style="width:50" align="left">'.$entry_count.'</td>

        //    <td style="width:350" align="left">'. $ptype.'</td>

        //    <td style="width:67" align="center">'.$actQuantity.'</td>

        //    <td style="width:66" align="right">'.$rate.'</td>

        //    <td style="width:66" align="right">'. $actItemNo.'</td>

        //     <td style="width:66" align="right">'. $price.'</td>

        //    </tr>'; 



               $entry_count++;

               

           }



           $Rawmaterials = "SELECT $podetail_tab.* , $rawmaterial_tab.RMName,$unit_tab.UnitCode FROM $rawmaterial_tab,$unit_tab,$podetail_tab where  $rawmaterial_tab.ID = $podetail_tab.rawmaterial_ID AND $unit_tab.ID = $podetail_tab.unit_ID  AND $podetail_tab.purchaseorder_ID =  $lastInsertedID ";



           $stmt =$this->db->prepare($Rawmaterials);

           $stmt->execute();

           $rawMaterialData = $stmt->fetchAll(2);



           

        //    $rawMaterialDatas = array();

        //    $rawMaterialDatas[] =  $rawMaterialData;



        //    $count = 1;

        //    $counts = 0; 

          

            // foreach($rawMaterialData as $a=>$b)

            // {

                

            //     $trows.='<tr>

            //     <td style="width:50" align="left">'.$counts+1.'</td>

            //     <td style="width:350" align="left">'. $b['RMName'].'</td>

            //     <td style="width:67" align="center">'.$b["Quantity"].'</td>

            //     <td style="width:66" align="right">'.$b["Rate"].'</td>

            //     <td style="width:66" align="right">'. $b["UnitCode"].'</td>

            //      <td style="width:66" align="right">'. $b["EstimatedAmount"].'</td>

            //     </tr>'; 

            //     $count++;

            //     $counts++;

                

            // }

            $count=1;

            foreach($rawMaterialData as $k=>$v)

            {

                 $trows.= '<tr>

                <td style="width:50" align="left">'.$count.'</td>

                <td style="width:350" align="left">'. $v['RMName'].'</td>

                <td style="width:67" align="center">'.$v["Quantity"].'</td>

                <td style="width:66" align="right">'.$v["Rate"].'</td>

                <td style="width:66" align="right">'. $v["UnitCode"].'</td>

                 <td style="width:66" align="right">'. $v["EstimatedAmount"].'</td>

                </tr>' ; 

                 $count++;

            }



           for($i=1;$i<3;$i++){

                                    

           $trowss.="<tr><td></td><td></td>"      

               . "<td></td>"

               . "<td></td>"

               . "<td></td>"

               . "<td></td></tr>";

       }



       $total=0;

                

       $tot=number_format($form_post_data[$Amount]);

       $poNumber = strval($form_post_data['PurchaseOrderNo']);

       $poDate = strval(date("Y-m-d", strtotime($form_post_data['PurchaseOrderDate'])));       

       

       $paymentType = "SELECT $payment_tab.Paymode,$supplier_tab.Company  FROM $payment_tab,$supplier_tab,$pomaster_tab where  $supplier_tab.ID = $pomaster_tab.supplier_ID AND $payment_tab.ID = $pomaster_tab.PaymentMode  AND $pomaster_tab.ID =  $lastInsertedID ";

       $stmt =$this->db->prepare($paymentType);            

       $stmt->execute();

       $paymentMod = $stmt->fetchAll(2);



       $ModeOfPay = strval($paymentMod[0]["Paymode"]);

       $Supplier = strval($paymentMod[0]["Company"]);



       $otherRef = strval($form_post_data['OtherReference']);

       $termsOfDelivery = strval($form_post_data['TermsOfDelivery']);

       $cgstPre=strval($CGSTTax.'%');

       $sgstPre=strval($SGSTTax.'%');

       $igstPre=strval($IGSTTax.'%');

       $cgstAmount = strval((float) $form_post_data['CGSTAmount']);

       $sgstAmount = strval((float) $form_post_data['SGSTAmount']);

       $igstAmount = strval((float) $form_post_data['IGSTAmount']);

       $netAmount = strval((float) $form_post_data['NetAmount']);

       $BillAmount = strval((float) $form_post_data['BillAmount']);





       $number = $netAmount;

        // $inWords = getIndianCurrency( $netAmount);

        $inWords = $util -> getIndianCurrency($number).' only';



    

       

       

       

       // $total+=$tot;

       

       // $cgst=($total*0.09);

       

       // $gst=($total*0.18);

       

       //  $commercialroundoff=0.20;

       

       //  $freightcharges=120;

       

       // $tottaxamount=$freightcharges+$total;

       

       // $tatalamt=$tot+$gst;

       

       // $fnalamt=number_format($tatalamt+$commercialroundoff);

       

       // $finalamt=$fnalamt;

       

       // $entityname=$entity_data[0]['Title'];

       

       // $podate=date('d.m.Y',strtotime($po_data[0]['PODate']));

       // $pono=$po_data[0]['PONo'];

       // $qdate=date('d.m.Y',strtotime($form_post_data['InvoiceDate']));

       // $numtoword = $util->getIndianCurrency($finalamt). ' only';



$html = ob_get_clean();  



$html = <<<EOD

   <table cellspacing="0" cellpadding="4" border="1">

   

   <tr>

   <td align="center"><u><h3><b style="font-size:20px;">INVOICE</b></h3></u></td>

   </tr>

  

       <tr>

         <td width="333" rowspan="3" align="left" >Invoice To: <br> 

         <b>Kosh Innovations</b><br>

         Cs-46 & 47,<br>

         Pipdic Industrial Estate,<br>  

         Mettupalayam, Puducherry - 605 009.<br> 

         GSTIN/UIN: 34APOPK9748J1Z5<br>

         State Name :  Puducherry,<br> 

         Code : 34<br> 

         E-Mail : koshinnovations@gmail.com  </td>



         <td width="166" align="left">Voucher No.: <br>  <b></b> </td>

         <td width="166" align="left">Date: <br><b>$poDate</b></td>

        

        </tr>

        

        <tr>

        <td width="166" align="left"> will update soon...</td>

        <td width="166" align="left">Mode/Terms of Payment: <br><b> $ModeOfPay</b></td>

      

       </tr>



       <tr>

       <td width="166" align="left">Supplier’s Ref./Order No <br> <b>$poNumber</b></td>

       <td width="166" align="left">Other Reference(s): <br> <b>$otherRef</b></td>

      

      </tr>

   

      <tr>

      <td width="332" align="left">Supplier:<br> <b>$Supplier</b></td>

      <td width="333" align="left">Terms of Delivery: <br><b>$termsOfDelivery</b></td>



     </tr>



       <tr>

       <td width="50" align="center"><b>S.No</b></td>

       <td width="350" align="center"><b>Description of Goods</b></td>

       <td width="67" align="center"><b>Quantity</b></td>

       <td width="66" align="center"> <b>Rate</b></td>

       <td width="66" align="center"><b>Per</b></td>

       <td width="66" align="center"><b>Total Amount</b></td>

      </tr>

        {$trows}

        {$trowss}



        <tr>

        <td width="533" ></td>

        <td width="66" align="right"><b>Total:</b> </td>

        <td width="66" align="right" ><b>$BillAmount</b> </td>

        </tr>

        

        <tr>

        <td width="665" ></td>

        </tr>

        

        <tr>

        <td width="467" align="center"></td>

        <td width="132" align="center"><b>Tax-Percentage</b></td>

        <td width="66" align="center"><b>Amount</b></td>

        </tr>

        <tr>

        <td width="533" align="right">CGST: </td>

        <td width="66" align="right">$cgstPre</td>

        <td width="66" align="right">$cgstAmount</td>

        </tr>

        <tr>

        <td width="533" align="right">SGST: </td>

        <td width="66" align="right">$sgstPre</td>

        <td width="66" align="right">$sgstAmount</td>

        </tr>

        <tr>

        <td width="533" align="right">IGST: </td>

        <td width="66" align="right">$igstPre</td>

        <td width="66" align="right">$igstAmount</td>

        </tr>

 

        <tr>

        <td width="599" align="right"><b>Final Amount</b></td>

        <td width="66" align="right"><b>$netAmount</b></td>

        </tr>



        <tr>

        <td width="665" align="left">Amount Chargeable (in words)<br><b>$inWords</b> <br><br><br><br><br><br><br> </td>

        

        </tr>



        <tr>

        <td width="333" align="left" > Company's Pan:  </td>

        <td width="332" align="right"> <b> For Kosh Innovations </b> <br><br><br><br>  Authorised Signatory

        </td>

        </tr>

  

         

       </table>







EOD;



   $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);



        $ht = ob_get_clean();                           

    

//                     $ht=<<<EOD

//                       <table cellspacing="" cellpadding="2">

//                             <tr>

//                                <td>

//                                <p style="text-indent: 50px;">* Our risk and responsiblity ceases once the goods leave the godown.</p>

//                                <p style="text-indent: 50px;">* An interest @ 24% per month will be charged if the payment is not made in time.</p>

//                                <p style="text-indent: 50px;">* Subject to {$tot} jurisdication.</p>

//                                </td>

//                            </tr>

                          

//                        </table>  





// EOD;



       $pdf->writeHTMLCell(0, 0, '', '', $ht, 0, 1, 0, true, '', true);

      

       $htl = ob_get_clean();

       $htl='



       <table cellspacing="" cellpadding="1">

                               

                

               <tr>

                   <td>

                    <p style="text-indent: 50px;">*This is computer generated Invoice, hence no signature required.</p><p></p>

                   </td>

               </tr> 

                

           </table>'

       ;



$pdf->writeHTMLCell(0, 0, '', '', $htl, 0, 1, 0, true, '', true);



// $htmls = ob_get_clean();                           



// $htmls='





//   <table cellspacing="" cellpadding="">

   

//          <tr>

//           <img src="" alt="test alt attribute" style="border:1px solid black">  

//        </tr>

      

//    </table>  

// ';



// $pdf->writeHTMLCell(0, 0, '', '', $htmls, 0, 1, 0, true, '', true);

  

   //$pdf->addDescription("We hope you shall find our rates more competitve and raise your valuable order on us so that it can lay the foundation for our long term business relationship\n\nAssuring you of our best service at all times.");

  // $pdf->addDescription($quotationdetail_data[0]['Description']);

   //$pdf->Ln();

  // $pdf->addTermsCondtNew('*This is computer generated quotation and hence no signature required.');



                               // Print text using writeHTMLCell()

 

   

   // ---------------------------------------------------------

   

   // $sign='*This is computer generated Invoice, hence no signature required.';

   

   // 	$x = $pdf->GetX();

   //     $y = $pdf->GetY();

   // 	$pdf->SetXY( $x, $y+10 );

   // 	$length = $pdf->GetStringWidth( $sign );

   // 	$lignes = $pdf->sizeOfText( $sign, $length) ;

   // 	$pdf->MultiCell(190, 4, $sign,0,'L',0,1,'','',true,0,false,true,0);





    ob_end_clean();// at the end of your script

    

    $pdf->Output($_SERVER['DOCUMENT_ROOT'] ."/resource/documents/Invoice".$quote_no.".pdf", "F");

    

      //$pdf->Output($_SERVER['DOCUMENT_ROOT'] ."/resource/documents/Quotation".$quote_no.".pdf", "F");  



    //   $this->tpl->set('pdffile', "/resource/documents/Quotation".$quote_no.".pdf");



      //$this->tpl->set('content', $this->tpl->fetch('factory/form/buttonpdf.php'));

               



   //  $pdf->Output($_SERVER['DOCUMENT_ROOT'] ."/resource/documents/Invoice".$quote_no.".pdf", "F");

   

    $this->ses->set('pdffile', "/resource/documents/Invoice".$quote_no.".pdf"); 



   //  $this->ses->set('quoteno', $quote_no); 

   //  $this->ses->set('form_title', 'Invoice');	   





      // $dbutil->ApprovalProcess('Purchase Order',$approve[0][0],$lastInsertedID);

   }

       }

       //var_dump($b);

       //var_dump($rawMaterialData);

    //    var_dump($number);

    //    var_dump($inWords);   



       $this->tpl->set('mode', 'add');

      $this->tpl->set('callmodal', 'yes');

       $this->tpl->set('message','--success--');

       $this->tpl->set('content', $this->tpl->fetch('factory/form/order.php'));

    } else {

           //edit option

           //if submit failed to insert form

           $this->tpl->set('message', 'Failed to submit!');

           $this->tpl->set('FmData', $form_post_data);

           $this->tpl->set('content', $this->tpl->fetch('factory/form/order.php'));

    }

      

   break;

                case 'add':

                            $this->tpl->set('mode', 'add');

	                        $this->tpl->set('page_header', 'Store');

	                  //add new purchase order 

                        $entity_short_code = $this->ses->get('user')['short_code'];

                        $newPONumber =$dbutil->keyGen('purchaseorder', 'KPUO', $entity_short_code,'PurchaseOrderNo');  

                        $this->tpl->set('po_number', $newPONumber);

                       

            //add new batch no 

                        // $entity_short_code = $this->ses->get('user')['short_code'];

                        // $newBatchNo =$dbutil->keyGen('purchaseorder', 'KBAT', $entity_short_code,'BatchNo');  

                        // $this->tpl->set('bacth_no', $newBatchNo);

                        $this->tpl->set('content', $this->tpl->fetch('factory/form/order.php'));

                    break;



                default:

                    /*

                     * List form

                     */

                     

                    ////////////////////start//////////////////////////////////////////////

                    

           //bUILD SQL 

            $whereString = '';

            

   $colArr = array(

       

                "$pomaster_tab.ID",

                "$pomaster_tab.PurchaseOrderNo",

                "$supplier_tab.Company ",

                "$pomaster_tab.BillAmount",

                //"$pomaster_tab.BatchNo",

                "DATE_FORMAT($pomaster_tab.PurchaseOrderDate, '%d-%m-%Y') AS PurchaseOrderDate",

                "$payment_tab.Paymode",

                "$pomaster_tab.Destination",

                "$pomaster_tab.TermsOfDelivery",

              

                

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

             $whereString ="ORDER BY $pomaster_tab.ID DESC";

           }

            

          

         $sql = "SELECT "

                    . implode(',',$colArr)

                    . " FROM $pomaster_tab,$supplier_tab,$payment_tab "

                    . " WHERE "

                    . " $supplier_tab.ID= $pomaster_tab.supplier_ID AND "

                    . " $payment_tab.ID= $pomaster_tab.PaymentMode AND "

                    . " $pomaster_tab.entity_ID = $entityID "

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

         

         

            $this->tpl->set('table_columns_label_arr', array('ID','PurchaseOrder No','Supplier Name','Bill Amount','Date','Payment Mode','Destination','Terms Of Delivery'));

            

            /*

             * selectColArr for filter form

             */

            

            $this->tpl->set('selectColArr',$colArr);

                        

            /*

             * set pagination template

             */

            $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');

                   

            //////////////////////close//////////////////////////////////////  

                     

                    include_once $this->tpl->path . '/factory/form/purchase_order_crud_form.php';

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

    

//   commented on 17.03.2020 for materialrequest type  function returneddeliverychallan(){



       



       



//         include_once 'util/genUtil.php';



//         $util = new GenUtil();



        



//      if ($this->crg->get('wp') || $this->crg->get('rp')) {



 



//  ////////////////////////////////////////////////////////////////////////////////



//  //////////////////////////////access condition applied//////////////////////////



//  ////////////////////////////////////////////////////////////////////////////////    



            



            



//             include_once 'util/DBUTIL.php';



//             $dbutil = new DBUTIL($this->crg);



             



//             $entityID = $this->ses->get('user')['entity_ID'];



//             $userID = $this->ses->get('user')['ID'];



            



            



//             $returneddcdetail_tab = $this->crg->get('table_prefix') . 'returned_dcdetail';



//             $returneddcmaster_tab = $this->crg->get('table_prefix') . 'returned_dcmaster';



//             $delvmaster_tab = $this->crg->get('table_prefix') . 'deliverychallan';

            

//             $dcdetail_tab = $this->crg->get('table_prefix') . 'deliverychallandetail';



//             $customer_table= $this->crg->get('table_prefix') . 'customer';

    

//             $rawmaterial_tab = $this->crg->get('table_prefix') . 'rawmaterial';

            

//             $rawmattype_tab= $this->crg->get('table_prefix') . 'rawmaterialtype';



//              //product select box data



//              $pdtt_sql ="SELECT $delvmaster_tab.ID,DCNO FROM $delvmaster_tab where $delvmaster_tab.DeliveryChoice='Returnable'";



//             $stmt =$this->db->prepare($pdtt_sql);            



//             $stmt->execute();



//             $pdt_data = $stmt->fetchAll();	



//             $this->tpl->set('deliverychallan_data', $pdt_data);



            

            





//             $this->tpl->set('page_title', 'Returned Delivery Challan');	          



//             $this->tpl->set('page_header', '');



//             //Add Role when u submit the add role form



//             $thisPageURL = $this->crg->get('route')['base_path'] . '/' . $this->crg->get('route')['module'] . '/' . $this->crg->get('route')['controller'] . '/' . $this->crg->get('route')['action'];







//             $crud_string = null;



	



//              if (isset($_POST['req_from_list_view'])) {



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





//                      $sqldetdelete="Delete $returneddcmaster_tab,$returneddcdetail_tab from $returneddcmaster_tab



//                                         LEFT JOIN  $returneddcdetail_tab ON $returneddcmaster_tab.ID=$returneddcdetail_tab.return_dcmaster_ID 



//                                         where $returneddcdetail_tab.return_dcmaster_ID=$data"; 



//                         $stmt = $this->db->prepare($sqldetdelete);            



                        



//                         if($stmt->execute()){



//                         $this->tpl->set('message', 'Return Delivery Challan Form deleted successfully');



//                          $this->tpl->set('label', 'List');



//                         $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));



//                         }



//                      break;



                     



//                 case 'view':                    



//                     $data = trim($_POST['ycs_ID']);



                 



//                     if (!$data) {



//                         $this->tpl->set('message', 'Please select any one ID to edit!');



//                         $this->tpl->set('label', 'List');



//                         $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));



//                         break;



//                     }



                    



//                     //mode of form submit



//                     $this->tpl->set('mode', 'view');



//                     //set id to edit $ycs_ID



//                     $this->tpl->set('ycs_ID', $data);         



                                

                     

                    



//                     $sqlsrr ="SELECT * FROM `$returneddcdetail_tab`,`$returneddcmaster_tab` WHERE `$returneddcdetail_tab`.`return_dcmaster_ID`=`$returneddcmaster_tab`.`ID` AND `$returneddcdetail_tab`.`return_dcmaster_ID`='$data'";                    



//                     $podetail_data = $dbutil->getSqlData($sqlsrr); 

                    

//                      $sql="SELECT 

//                       $rawmaterial_tab.ID as rawmaterial_ID,

//                       $rawmaterial_tab.RMName, 

//                       $rawmattype_tab.ID as rawmattype_ID,

//                       $rawmattype_tab.RawMaterialType,

//                       $delvmaster_tab.DeliveryDate,

//                       $customer_table.ID as customer_ID,

//                       $customer_table.FirstName,

//                       $delvmaster_tab.DeliveryChoice, 

//                       $delvmaster_tab.TaxChoice, 

//                       $delvmaster_tab.BillAmount, 

//                       $delvmaster_tab.CGSTAmount, 

//                       $delvmaster_tab.CGSTTax, 

//                       $delvmaster_tab.SGSTTax, 

//                       $delvmaster_tab.SGSTAmount, 

//                       $delvmaster_tab.IGSTTax, 

//                       $delvmaster_tab.IGSTAmount, 

//                       $delvmaster_tab.NetAmount, 

//                       $dcdetail_tab.HSNCode,

//                       $dcdetail_tab.Quantity, 

//                       $dcdetail_tab.Rate, 

//                       $dcdetail_tab.EstimatedAmount

//                       FROM 

//                       $delvmaster_tab,

//                       $dcdetail_tab,

//                       $customer_table,

//                       $rawmaterial_tab,

//                       $rawmattype_tab

                      

//                       WHERE 

//                       $delvmaster_tab.ID=$dcdetail_tab.deliverychallan_ID 

//                       AND 

//                       $customer_table.ID=$delvmaster_tab.customer_ID 

//                       AND 

//                       $rawmaterial_tab.ID=$dcdetail_tab.rawmaterial_ID 

//                       AND

//                       $rawmattype_tab.ID=$delvmaster_tab.rawmaterialtype_ID 

//                       AND

//                       $dcdetail_tab.deliverychallan_ID=".$podetail_data[0]['dc_ID']."";

                      

                      

//                     $deliverychallan_data = $dbutil->getSqlData($sql); 

                    

//                     $this->tpl->set('DCData', $deliverychallan_data); 

                  

//                     $sql="SELECT * FROM $delvmaster_tab,$dcdetail_tab where `$dcdetail_tab`.`deliverychallan_ID`=`$delvmaster_tab`.`ID";

//                     $dc_data = $dbutil->getSqlData($sql); 

                    

                    

                    

//                     $rawtypeID = $dc_data[0]['rawmaterialtype_ID'];               



//                     $rawmaterial_sql ="SELECT ID,RMName FROM $rawmaterial_tab WHERE rawmaterialtype_ID = $rawtypeID";



//                     $stmt = $this->db->prepare($rawmaterial_sql);



//                     $stmt->execute();



//                     $rawmaterial_data= $stmt->fetchAll();



//                     $this->tpl->set('raw_data', $rawmaterial_data);

                   



                



//                     //edit option     



//                     $this->tpl->set('message', 'You Can View Return Delivery Challan Form');



//                     $this->tpl->set('page_header', 'Store');



//                     $this->tpl->set('FmData', $podetail_data); 



                    



//                     $this->tpl->set('content', $this->tpl->fetch('factory/form/returned_deliverychallan.php'));                    



//                     break;



                



//                 case 'edit':                    



//                     $data = trim($_POST['ycs_ID']);



                   



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



                                



//                     $sqlsrr ="SELECT * FROM `$returneddcdetail_tab`,`$returneddcmaster_tab` WHERE `$returneddcdetail_tab`.`return_dcmaster_ID`=`$returneddcmaster_tab`.`ID` AND `$returneddcdetail_tab`.`return_dcmaster_ID`='$data'";                    



//                     $podetail_data = $dbutil->getSqlData($sqlsrr); 

                    

//                       $sql="SELECT 

//                       $rawmaterial_tab.ID as rawmaterial_ID,

//                       $rawmaterial_tab.RMName, 

//                       $rawmattype_tab.ID as rawmattype_ID,

//                       $rawmattype_tab.RawMaterialType,

//                       $delvmaster_tab.DeliveryDate,

//                       $customer_table.ID as customer_ID,

//                       $customer_table.FirstName,

//                       $delvmaster_tab.DeliveryChoice, 

//                       $delvmaster_tab.TaxChoice, 

//                       $delvmaster_tab.BillAmount, 

//                       $delvmaster_tab.CGSTAmount, 

//                       $delvmaster_tab.CGSTTax, 

//                       $delvmaster_tab.SGSTTax, 

//                       $delvmaster_tab.SGSTAmount, 

//                       $delvmaster_tab.IGSTTax, 

//                       $delvmaster_tab.IGSTAmount, 

//                       $delvmaster_tab.NetAmount, 

//                       $dcdetail_tab.HSNCode,

//                       $dcdetail_tab.Quantity, 

//                       $dcdetail_tab.Rate, 

//                       $dcdetail_tab.EstimatedAmount

//                       FROM 

//                       $delvmaster_tab,

//                       $dcdetail_tab,

//                       $customer_table,

//                       $rawmaterial_tab,

//                       $rawmattype_tab

                      

//                       WHERE 

//                       $delvmaster_tab.ID=$dcdetail_tab.deliverychallan_ID 

//                       AND 

//                       $customer_table.ID=$delvmaster_tab.customer_ID 

//                       AND 

//                       $rawmaterial_tab.ID=$dcdetail_tab.rawmaterial_ID 

//                       AND

//                       $rawmattype_tab.ID=$delvmaster_tab.rawmaterialtype_ID 

//                       AND

//                       $dcdetail_tab.deliverychallan_ID=".$podetail_data[0]['dc_ID']."";

                      

                      

//                     $deliverychallan_data = $dbutil->getSqlData($sql); 

                    

//                     $this->tpl->set('DCData', $deliverychallan_data); 

                  

//                     $sql="SELECT * FROM $delvmaster_tab,$dcdetail_tab where `$dcdetail_tab`.`deliverychallan_ID`=`$delvmaster_tab`.`ID";

//                     $dc_data = $dbutil->getSqlData($sql); 

                    

                    

                    

//                     $rawtypeID = $dc_data[0]['rawmaterialtype_ID'];               



//                     $rawmaterial_sql ="SELECT ID,RMName FROM $rawmaterial_tab WHERE rawmaterialtype_ID = $rawtypeID";



//                     $stmt = $this->db->prepare($rawmaterial_sql);



//                     $stmt->execute();



//                     $rawmaterial_data= $stmt->fetchAll();



//                     $this->tpl->set('raw_data', $rawmaterial_data);





//                     //edit option     



//                     $this->tpl->set('message', 'You Can Edit Return Delivery Challan Form');



//                     $this->tpl->set('page_header', 'Store');



//                     $this->tpl->set('FmData', $podetail_data); 



                

//                     $this->tpl->set('content', $this->tpl->fetch('factory/form/returned_deliverychallan.php'));                    



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



//                     $sqldet_del ="DELETE FROM $returneddcdetail_tab WHERE return_dcmaster_ID=$data";



//                     $stmt = $this->db->prepare($sqldet_del);



//                     $stmt->execute();   



                            





//                             try{



                                



                           



//                             $dcid= $form_post_data['dc_ID'];



//                             $returndate=date("Y-m-d", strtotime($form_post_data['ReceivedDate']));



//                             $Comments= $form_post_data['Comments'];



//                             $entityID;

                            

//                             $userID;

                            

//                             $sql_update= "Update 



//                                         $returneddcmaster_tab set 



//                                         dc_ID='$dcid',



//                                         Comments='$Comments',



//                                         entity_ID=$entityID,



//                                         users_ID=$userID



//                                         WHERE ID=$data" ;







//                             $stmt1 = $this->db->prepare($sql_update);



//                             $stmt1->execute(); 



                            



//                         $entry_count = 1;



//                         FOR ($entry_count; $entry_count <= $form_post_data['maxCount'];) {



                                





//                                 $ItemName='ItemName_' .$entry_count;



//                                 $hsn='Water_' .$entry_count;



//                                 $DCQuantity='Note_' .$entry_count;



//                                 $pendingqty='Quantity_' .$entry_count;



//                                 $receivedqty='Amount_' .$entry_count;

                               





//                               $vals = "'" . $data . "'," .



                                        

//                                         "'" . $form_post_data[$ItemName] . "'," . 

                                        

//                                         "'" . $form_post_data[$hsn] . "'," . 



//                                         "'" . $form_post_data[$DCQuantity] . "'," . 



//                                         "'" . $form_post_data[$pendingqty] . "'," .



//                                         "'" . $form_post_data[$receivedqty] . "'";

                                       



//                                   $sql2 = "INSERT INTO $returneddcdetail_tab

                    

//                                             ( 



//                                               `return_dcmaster_ID`, 



//                                                 `rawmaterial_ID`, 

                                                

//                                                 `HSNCode`,



//                                                 `DcQuantity`,



//                                                 `PendingQuantity`,



//                                                 `ReceivedQuantity`





//                                              )



//                                 VALUES ($vals)";







//                                 $stmt = $this->db->prepare($sql2);



//                                 $stmt->execute();



                                



                           



                            



//                             //increment here



//                             $entry_count++;



//                             }







                        



//                             $this->tpl->set('message', 'Return Delivery Challan Form Edited Successfully!');   



//                             $this->tpl->set('label', 'List');



//                             $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));



//                             } catch (Exception $exc) {



//                              //edit failed option



//                             $this->tpl->set('message', 'Failed To Edit, Try Again!');



//                             $this->tpl->set('FmData', $form_post_data);



//                             $this->tpl->set('content', $this->tpl->fetch('factory/form/returned_deliverychallan.php'));



//                             }







//                     break;



                  



//                 case 'addsubmit':



                    



//                      if (isset($crud_string)) {



                         



//                         $form_post_data = $dbutil->arrFltr($_POST);







//                         $entry_count = 1;



                        



//                             if (isset($form_post_data['dc_ID'])) {



                           



//                                         $val = "'" . $form_post_data['dc_ID'] . "'," .



//                                          "'" . date("Y-m-d", strtotime($form_post_data['ReceivedDate'])) . "'," .



//                                          "'" . $form_post_data['Comments'] . "'," .

  

//                                          "'" .  $this->ses->get('user')['entity_ID'] . "'," .



//                                          "'" .  $this->ses->get('user')['ID'] . "'";







//                               $sql = "INSERT INTO `" . $this->crg->get('table_prefix') . "returned_dcmaster`



//                                             ( 



//                                             `dc_ID`, 



//                                             `ReceivedDate`,

                                            

//                                             `Comments`,



//                                             `entity_ID`, 



//                                             `users_ID`



//                                             ) 



//                                         VALUES ($val)";



//                                   $stmt = $this->db->prepare($sql);



                                  



                                  



//                     if ($stmt->execute()) { 



                        



//                         $lastInsertedID = $this->db->lastInsertId();





//                         FOR ($entry_count; $entry_count <= $form_post_data['maxCount'];) {



   

//                                 $ItemName='ItemName_' .$entry_count;



//                                 $hsn='Water_' .$entry_count;



//                                 $DCQuantity='Note_' .$entry_count;



//                                 $pendingqty='Quantity_' .$entry_count;



//                                 $receivedqty='Amount_' .$entry_count;



                    





//                                 $vals = "'" . $lastInsertedID . "'," .



//                                         "'" . $form_post_data[$ItemName] . "'," . 

                                        

//                                         "'" . $form_post_data[$hsn] . "'," . 



//                                         "'" . $form_post_data[$DCQuantity] . "'," . 



//                                         "'" . $form_post_data[$pendingqty] . "'," .



//                                         "'" . $form_post_data[$receivedqty] . "'";



                                 



//                           $sql2 = "INSERT INTO $returneddcdetail_tab



//                                               (



//                                                 `return_dcmaster_ID`, 



//                                                 `rawmaterial_ID`, 

                                                

//                                                 `HSNCode`,



//                                                 `DcQuantity`,



//                                                 `PendingQuantity`,



//                                                 `ReceivedQuantity`



//                                             ) 



                                                



//                                         VALUES ($vals)";







//                                  // this need to be changed in to transaction type



                                



//                                 $stmt = $this->db->prepare($sql2);



//                                 $stmt->execute();



                            



//                                 $entry_count++;



                                



//                             }





//                     }



//                         }



//                         $this->tpl->set('mode', 'add');



//                         $this->tpl->set('message', '- Success -');



//                         $this->tpl->set('content', $this->tpl->fetch('factory/form/returned_deliverychallan.php'));



//                      } else {



//                             //edit option



//                             //if submit failed to insert form



//                             $this->tpl->set('message', 'Failed to submit!');



//                             $this->tpl->set('FmData', $form_post_data);



//                             $this->tpl->set('content', $this->tpl->fetch('factory/form/returned_deliverychallan.php'));



//                      }



                       



//                     break;



//                 case 'add':



//                             $this->tpl->set('mode', 'add');



// 	                        $this->tpl->set('page_header', '');



	               

//                         $this->tpl->set('content', $this->tpl->fetch('factory/form/returned_deliverychallan.php'));



//                     break;







//                 default:



//                     /*



//                      * List form



//                      */



                     



//                     ////////////////////start//////////////////////////////////////////////



                    



//           //bUILD SQL 



//             $whereString = '';



            



//   $colArr = array(



       

              



//                 "$returneddcmaster_tab.ID",



//                 "$delvmaster_tab.DCNo",



//                 "$customer_table.FirstName ",



//                 "DATE_FORMAT($returneddcmaster_tab.ReceivedDate, '%d-%m-%Y') AS ReceivedDate",



//                 "$returneddcdetail_tab.DCQuantity",

                

//                 "$returneddcdetail_tab.PendingQuantity",

                

//                 "$returneddcdetail_tab.ReceivedQuantity"

                



//                  );



                



              



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



//              $whereString ="ORDER BY $returneddcmaster_tab.ID DESC";



//           }

     

            



          



//          $sql = "SELECT "



//                     . implode(',',$colArr)



//                     . " FROM $delvmaster_tab,$customer_table ,$returneddcmaster_tab,$returneddcdetail_tab"



//                     . " WHERE "



//                     . " $customer_table.ID= $delvmaster_tab.customer_ID AND "

                    

//                      . " $delvmaster_tab.ID= $returneddcmaster_tab.DC_ID AND "

                    

//                      . " $returneddcmaster_tab.ID= $returneddcdetail_tab.return_dcmaster_ID AND "



//                     . " $returneddcmaster_tab.entity_ID = $entityID "



//                     . " $whereString";



            



            



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



         



         



//             $this->tpl->set('table_columns_label_arr', array('ID','DeliveryChallan No','Customer Name','Received Date','DC Quantity','Pending Quantity','Received Quantity'));



            



//             /*



//              * selectColArr for filter form



//              */



            



//             $this->tpl->set('selectColArr',$colArr);



                        



//             /*



//              * set pagination template



//              */



//             $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');



                   



//             //////////////////////close//////////////////////////////////////  



                     



//                     include_once $this->tpl->path . '/factory/form/returneddc_crud_form.php';



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

    function deliverychallan(){

       
        include_once 'util/genUtil.php';

        $util = new GenUtil();


     if ($this->crg->get('wp') || $this->crg->get('rp')) {

 ////////////////////////////////////////////////////////////////////////////////

 //////////////////////////////access condition applied//////////////////////////

 ////////////////////////////////////////////////////////////////////////////////    

            include_once 'util/DBUTIL.php';

            $dbutil = new DBUTIL($this->crg);

            $entityID = $this->ses->get('user')['entity_ID'];

            $userID = $this->ses->get('user')['ID'];


            $delvdetail_tab = $this->crg->get('table_prefix') . 'deliverychallandetail';

            $delvmaster_tab = $this->crg->get('table_prefix') . 'deliverychallan';

            $product_tab = $this->crg->get('table_prefix') . 'product';

            $customer_table= $this->crg->get('table_prefix') . 'customer';

            $rawmaterialtype_tab = $this->crg->get('table_prefix') . 'rawmaterialtype';

            $rawmaterial_tab = $this->crg->get('table_prefix') . 'rawmaterial';

            $unit_tab = $this->crg->get('table_prefix') . 'unit';

    

            $rawtype_sql ="SELECT ID,RawMaterialType FROM $rawmaterialtype_tab";

            $stmt = $this->db->prepare($rawtype_sql);            

            $stmt->execute();
            
            $rawtype_data= $stmt->fetchAll();	
            
            $this->tpl->set('rawtype_data',$rawtype_data);


            //customer select box data

            $sql = "SELECT ID,FirstName FROM $customer_table"; 

            $stmt = $this->db->prepare($sql);            

            $stmt->execute();

            $customer_data  = $stmt->fetchAll();	

            $this->tpl->set('customer_data', $customer_data);


           /// unit select data

           

            $unit_sql ="SELECT ID,UnitName FROM $unit_tab";

            $stmt = $this->db->prepare($unit_sql);            

            $stmt->execute();

            $unit_data= $stmt->fetchAll();	

            $this->tpl->set('unit_data',$unit_data);

            


            $this->tpl->set('page_title', 'Delivery Challan');	          



            $this->tpl->set('page_header', '');



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



                     $sqldetdelete="Delete $delvmaster_tab,$delvdetail_tab from $delvmaster_tab

                                        LEFT JOIN  $delvdetail_tab ON $delvmaster_tab.ID=$delvdetail_tab.deliverychallan_ID 

                                        where $delvdetail_tab.deliverychallan_ID=$data"; 



                        $stmt = $this->db->prepare($sqldetdelete);            



                        if($stmt->execute()){



                        $this->tpl->set('message', 'Delivery Challan Form deleted successfully');



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


                    $sqlsrr ="SELECT * FROM `$delvdetail_tab`,`$delvmaster_tab` WHERE `$delvdetail_tab`.`deliverychallan_ID`=`$delvmaster_tab`.`ID` AND `$delvdetail_tab`.`deliverychallan_ID`='$data'";                    

                    $podetail_data = $dbutil->getSqlData($sqlsrr); 

                    $count=count($podetail_data);

                    

                 for($i=1;$i<=$count;$i++){

                    

                    $rawtypeID = $podetail_data[$i-1]['rawmaterialtype_ID'];

                    $rawmaterial_tab = $this->crg->get('table_prefix') . 'rawmaterial';

                    $rawmaterial_sql ="SELECT ID,RMName FROM $rawmaterial_tab WHERE rawmaterialtype_ID = $rawtypeID";

                    $raw_data[] = $dbutil->getSqlData($rawmaterial_sql); 

                    

                    }

                    

                    $this->tpl->set('raw_data', $raw_data);


                    //edit option     


                    $this->tpl->set('message', 'You Can View Delivery Challan Form');


                    $this->tpl->set('page_header', 'Store');



                    $this->tpl->set('FmData', $podetail_data); 


                    $this->tpl->set('content', $this->tpl->fetch('factory/form/deliverychallan.php'));                    



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


                    $sqlsrr ="SELECT * FROM `$delvdetail_tab`,`$delvmaster_tab` WHERE `$delvdetail_tab`.`deliverychallan_ID`=`$delvmaster_tab`.`ID` AND `$delvdetail_tab`.`deliverychallan_ID`='$data'";                    

                    $podetail_data = $dbutil->getSqlData($sqlsrr); 

                    $count=count($podetail_data);

                    

                 for($i=1;$i<=$count;$i++){

                    
                    $rawtypeID = $podetail_data[$i-1]['rawmaterialtype_ID'];

                    $rawmaterial_tab = $this->crg->get('table_prefix') . 'rawmaterial';

                    $rawmaterial_sql ="SELECT ID,RMName FROM $rawmaterial_tab WHERE rawmaterialtype_ID = $rawtypeID";

                    $raw_data[] = $dbutil->getSqlData($rawmaterial_sql); 

                    

                    }

                    

                   $this->tpl->set('raw_data', $raw_data);

                       

                    //edit option     



                    $this->tpl->set('message', 'You Can Edit Delivery Challan Form');



                    $this->tpl->set('page_header', 'Store');



                    $this->tpl->set('FmData', $podetail_data); 



                    // var_dump($podetail_data);


                    $this->tpl->set('content', $this->tpl->fetch('factory/form/deliverychallan.php'));                    



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



                    $sqldet_del ="DELETE FROM $delvdetail_tab WHERE deliverychallan_ID=$data";

                    $stmt = $this->db->prepare($sqldet_del);

                    $stmt->execute();   



                            try{


                            $taxchoice='CGST_SGST';

                             if($form_post_data['TaxChoice']=='CGST_SGST'){

                                 $taxchoice='CGST_SGST';

                             }else{

                                  $taxchoice='IGST';

                             }
                             
                             $deliverychoice='Non-Returnable';


                             if($form_post_data['DeliveryChoice']=='Returnable'){



                                 $deliverychoice='Returnable';


                             }else{


                                  $deliverychoice='Non-Returnable';


                             }


                             $IGSTTax = $form_post_data['IGSTTax'] ;



                             if( $IGSTTax == null )

                             {

                                 $IGSTTax = 0 ;

                             }else


                             {

                                 $IGSTTax = $form_post_data['IGSTTax'];


                             }


                            $CGSTTax = $form_post_data['CGSTTax'] ;



                             if( $CGSTTax == null )

                             {

                                 $CGSTTax = 0 ;

                             }else

                             {

                                 $CGSTTax = $form_post_data['CGSTTax'];

                             }



                            $SGSTTax = $form_post_data['SGSTTax'] ;


                            if( $SGSTTax == null )

                             {

                                 $SGSTTax = 0 ;


                             }else

                             {

                                 $SGSTTax = $form_post_data['SGSTTax'];

                             }



require_once('TCPDF/deliveryChallan.php');



ob_start(); // at the beggining of your script



// create new PDF document



$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


// set document information



$pdf->SetCreator(PDF_CREATOR);



$pdf->SetAuthor('Sreenidhi Enterprises');



$report_title = "Delivery Challan";



$pdf->SetTitle($report_title);



$pdf->SetSubject('Corrective And Preventive Action');



$pdf->SetKeywords('Quotation,Invoice');


// set default header data



$capa_date = date('d.m.Y',strtotime($capa_data['AuditDateTime']));


$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.'.', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));



$pdf->setFooterData(array(0,64,0), array(0,64,128));


// set header and footer fonts



$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));



$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));



// set default monospaced font



$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);


// set margins



$pdf->SetMargins(10, 30, 10);



$pdf->SetHeaderMargin(10);



$pdf->SetFooterMargin(10);


// set auto page breaks



$pdf->SetAutoPageBreak(TRUE, 13);


// set image scale factor



$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);



// set some language-dependent strings (optional)



if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {



require_once(dirname(__FILE__).'/lang/eng.php');



$pdf->setLanguageArray($l);



}



// ---------------------------------------------------------


// set default font subsetting mode



$pdf->setFontSubsetting(true);


// Set font



// dejavusans is a UTF-8 Unicode font, if you only need to



// print standard ASCII chars, you can use core fonts like



// helvetica or times to reduce file size.


//$pdf->SetFont('times', '', 12, '', true);


$pdf->SetFont('Helvetica', 'Italic', 10, '', true);


// Add a page



// This method has several options, check the source code documentation for more information.


$pdf->AddPage();


$pageWidth = 200;


$pageHeight = 283;

$margin = 11;



//$pdf->Rect( $margin, $margin , $pageWidth - $margin , $pageHeight - $margin);

// Line break

// Line



$pdf->Line(11, 284, 199, 284, '');

$quote_no = $form_post_data['DCNo'];

// $podate=date("Y-m-d", strtotime($form_post_data['PurchaseOrderDate']));

//$html = ob_get_clean();

// $html = <<<EOD

// EOD;

//$pdf->writeHTML($html, true, false, false, false, '');

//$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);




$trows = '';



                            $dcNo= $form_post_data['DCNo'];

                            $customer_ID= $form_post_data['customer_ID'];

                            $rawmaterialtype_ID=$form_post_data['rawmaterialtype_ID'];

                            $deliverydate=date("Y-m-d", strtotime($form_post_data['DeliveryDate']));

                            $Tax= $taxchoice ;
                            
                            $cgstAmount=  (float) $form_post_data['CGSTAmount'];

                            $sgstAmount=  (float) $form_post_data['SGSTAmount'];

                            $igstAmount=  (float) $form_post_data['IGSTAmount'];

                            $BillAmount= $form_post_data['BillAmount'];

                            $NetAmount= $form_post_data['NetAmount'];

                            $deliverychoice;

                            $taxchoice;

                            $Remarks= $form_post_data['Remarks'];

   
                             $sql_update= "Update 



                                        $delvmaster_tab set 

                                        DCNo='$dcNo',
                                  
                                        customer_ID='$customer_ID',

                                        rawtype_ID='$rawmaterialtype_ID',

                                        CGSTTax='$CGSTTax',

                                        CGSTAmount='$cgstAmount',

                                        SGSTTax='$SGSTTax',

                                        SGSTAmount='$sgstAmount',

                                        IGSTTax='$IGSTTax',

                                        IGSTAmount='$igstAmount',

                                        BillAmount='$BillAmount',

                                        NetAmount='$NetAmount',

                                        DeliveryDate='$deliverydate',

                                        DeliveryChoice='$deliverychoice',

                                        TaxChoice='$taxchoice',
                                        
                                        Remarks= '$Remarks'

                                        WHERE ID=$data" ;


                            $stmt1 = $this->db->prepare($sql_update);

                            $stmt1->execute(); 


                        $entry_count = 1;



                        FOR ($entry_count; $entry_count <= $form_post_data['maxCount'];) {



                                $ItemName='ItemName_' .$entry_count;

                                

                                $ItemNo='ItemNo_' .$entry_count;

                                

                                $hsn='EmpName_' .$entry_count;

                                

                                $unit='Rat_' .$entry_count;



                                $Quantity='Qty_' .$entry_count;



                                $Amount='Amount_' .$entry_count;



                                $Rate='Emp_' .$entry_count;



           

                               $vals = "'" . $data . "'," .

                               

                                        "'" . $form_post_data[$ItemName] . "'," . 



                                         "'" . $form_post_data[$ItemNo] . "'," . 

                                         

                                        "'" . $form_post_data[$hsn] . "'," . 

                                        

                                        "'" . $form_post_data[$unit] . "'," . 



                                        "'" . $form_post_data[$Quantity] . "'," . 



                                        "'" . (float) $form_post_data[$Amount] . "'," .



                                        "'" .  $form_post_data[$Rate]  . "'" ; 



               $sql2 = "INSERT INTO $delvdetail_tab


                                ( 


                                `deliverychallan_ID`, 

                                `rawmaterialtype_ID`,

                                `rawmaterial_ID`, 

                                `HSNCode`,

                                `unit_ID`,

                                `Quantity`,

                                `EstimatedAmount`,

                                `Rate`



                                )



                                VALUES ($vals)";


                                $stmt = $this->db->prepare($sql2);

                                $stmt->execute();


                            $actualqty=$form_post_data[$Quantity];



                            $itemid=$form_post_data[$ItemNo];


                            //  $sqlsrr="SELECT * FROM $pdtstock_tab where item_ID=$itemid "; 



                            //  $stock_data = $dbutil->getSqlData($sqlsrr);



                            //  $count=count($stock_data);



                             



                            // if($count>0){



                            // $sql_updt_stock = "UPDATE $pdtstock_tab SET AvailableQty=(AvailableQty-$form_post_data[$initialqty])+$actualqty WHERE item_ID=$itemid AND entity_ID=$entityID";



                            // $stmt = $this->db->prepare($sql_updt_stock);



                            // }



                            // else{



                            //      $sql_updt_stock = "INSERT INTO $pdtstock_tab (item_ID,AvailableQty,entity_ID,users_ID)



                            //     VALUES ($itemid,$actualqty,$entityID,$userID);";



                            //     $stmt = $this->db->prepare($sql_updt_stock);



                            // }



                            // $stmt->execute();


                            //increment here



                            $entry_count++;



                            }



                            $productdetailDatas = "SELECT $rawmaterial_tab.ID,$rawmaterial_tab.RMName,$delvdetail_tab.HSNCode,$delvdetail_tab.Quantity,$delvdetail_tab.EstimatedAmount FROM $rawmaterial_tab,$delvdetail_tab where $rawmaterial_tab.ID = $delvdetail_tab.rawmaterial_ID And $delvdetail_tab.deliverychallan_ID = $data ";



                            $stmt =$this->db->prepare( $productdetailDatas);            



                            $stmt->execute();



                            $delDcproduct = $stmt->fetchAll(2);



                            // var_dump($delDcproduct); 



                            $count = 1;



                            foreach($delDcproduct as $k=>$v){



                                $troww .=  '<tr>



                                <td style="width:50" align="left">'.$count.'</td>



                                <td style="width:350" align="left">'. $v['RMName'].'</td>



                                <td style="width:67" align="center">'. $v['HSNCode'].'  </td>



                                <td style="width:99" align="right">'.$v["Quantity"].'</td>



                                <td style="width:99" align="right">'. $v["EstimatedAmount"].'</td>



                                </tr>'; 



                                 $count++;



                            }



                            for($i=1;$i<3;$i++){


                                $trowss.="<tr> <td></td> <td></td>"      



                                    . "<td></td>"



                                    . "<td></td>"



                                    . "<td></td>"



                                    . "</tr>";



                            }





                            // $val = "'" . $form_post_data['DCNo'] . "'," .



                            // "'" . $form_post_data['customer_ID'] . "'," .



                            // "'" . date("Y-m-d", strtotime($form_post_data['DeliveryDate'])) . "'," .



                            //  "'" . $taxchoice . "'," .



                            // "'" . $CGSTTax . "'," .



                            // "'" . (float) $form_post_data['CGSTAmount'] . "'," .



                            // "'" . $SGSTTax . "'," .



                            // "'" . (float) $form_post_data['SGSTAmount'] . "'," .



                            // "'" .$IGSTTax . "'," .



                            // "'" . (float) $form_post_data['IGSTAmount'] . "'," .



                            // "'" . (float) $form_post_data['BillAmount'] . "'," .



                            // "'" . (float) $form_post_data['NetAmount'] . "'," .



                            // "'" . $deliverychoice . "'," .



                            // "'" .  $this->ses->get('user')['entity_ID'] . "'," .



                            // "'" .  $this->ses->get('user')['ID'] . "'";



                     



                            // $total=0;



                                     



                            // $tot=number_format($form_post_data[$Amount]);



                            $DCNumber = strval($form_post_data['DCNo']);



                            $DCDate = strval(date("Y-m-d", strtotime($form_post_data['DeliveryDate'])));     



                            



                            $DC_table = $this->crg->get('table_prefix') . "deliverychallan" ;







                            $customerName = "SELECT $customer_table.ID , $customer_table.FirstName from $customer_table, $DC_table where  $DC_table.customer_ID = $customer_table.ID and $DC_table.ID = $data ";







                            $stmt =$this->db->prepare($customerName);            



                            $stmt->execute();



                            $CusDcName = $stmt->fetchAll(2);







                            $custumeName = $CusDcName[0]['FirstName'];







                            // var_dump($CusDcName);



                            



                            // $paymentType = "SELECT $payment_tab.Paymode,$supplier_tab.Company  FROM $payment_tab,$supplier_tab,$pomaster_tab where  $supplier_tab.ID = $pomaster_tab.supplier_ID AND $payment_tab.ID = $pomaster_tab.PaymentMode  AND $pomaster_tab.ID =  $lastInsertedID ";



                            // $stmt =$this->db->prepare($paymentType);            



                            // $stmt->execute();



                            // $paymentMod = $stmt->fetchAll(2);



                     



                            // $ModeOfPay = strval($paymentMod[0]["Paymode"]);



                            // $Supplier = strval($paymentMod[0]["Company"]);



                     



                            // $otherRef = strval($form_post_data['OtherReference']);



                            // $termsOfDelivery = strval($form_post_data['TermsOfDelivery']);







                            $cgstPre=strval($CGSTTax.'%');



                            $sgstPre=strval($SGSTTax.'%');



                            $igstPre=strval($IGSTTax.'%');



                            $cgstAmount = strval((float) $form_post_data['CGSTAmount']);



                            $sgstAmount = strval((float) $form_post_data['SGSTAmount']);



                            $igstAmount = strval((float) $form_post_data['IGSTAmount']);



                            $netAmount = strval((float) $form_post_data['NetAmount']);



                            $BillAmount = strval((float) $form_post_data['BillAmount']);



                     



                     



                            // $number = $netAmount;



                            //  // $inWords = getIndianCurrency( $netAmount);



                            //  $inWords = $util -> getIndianCurrency($number).' only';



                           



                             $html = <<<EOD



         



                            



        <table cellspacing="0" cellpadding="4" border="1">



   



  



       <tr>







                             <td align="center" >  <u><b style="font-size:130%;" > DELIVERY CHALLAN  </b></u> <br> <br>



                               <b style="font-size:180%;" > KOSH INNOVATION  </b> <br>  



                              <b >Cs-46 & 47, Pipdic Industrial Estate,Mettupalayam,Puducherry - 9.</b> <br> 



                              <b> GST NO. :34APOPK9748JIZ5 </b>  <br></td>



                             



                             </tr>







        



                    <tr>



                    <td width="333">  DC NO. : <b>$DCNumber</b> <br>  </td>



                    <td width="332">  Date : <b>$DCDate</b>  <br></td>



                    </tr>







                    <tr>



                    <td width="665" > TO : <b>  $custumeName </b> <br></td>



                    </tr>



   



    







       <tr>



       <td width="50" align="center"><b>S.No</b></td>



       <td width="350" align="center"><b>Description </b></td>



       <td width="67" align="center"><b>HSN</b></td>



       <td width="99" align="center"> <b>Quantity</b></td>



       <td width="99" align="center"><b>Value</b></td>



    



      </tr>



       



        {$troww}



        {$trowss}







        <tr>



        <td width="467" ></td>



        <td width="99" align="right"><b>Total:</b> </td>



        <td width="99" align="right" ><b>$BillAmount</b> </td>



        </tr>



        



        <tr>



        <td width="665" ></td>



        </tr>



        



        <tr>



        <td width="467" align="center"></td>



        <td width="132" align="center"><b>Tax-Percentage</b></td>



        <td width="66" align="center"><b>Amount</b></td>



        </tr>



        <tr>



        <td width="533" align="right">CGST: </td>



        <td width="66" align="right"> $cgstPre</td>



        <td width="66" align="right">$cgstAmount</td>



        </tr>



        <tr>



        <td width="533" align="right">SGST: </td>



        <td width="66" align="right">$sgstPre</td>



        <td width="66" align="right">$sgstAmount</td>



        </tr>



        <tr>



        <td width="533" align="right">IGST: </td>



        <td width="66" align="right">$igstPre</td>



        <td width="66" align="right">$igstAmount</td>



        </tr>



 



        <tr>



        <td width="599" align="right"><b>Final Amount</b></td>



        <td width="66" align="right"><b>$netAmount</b></td>



        </tr>







        <tr>



        <td width="665" align="left"> <br> Returnable (or) Non-Returnable : <b> $deliverychoice </b>  -- For Kosh Innovation <br> <br><br> </td>



        </tr>







        <tr>



        <td width="333" align="left" >   Receiver's Signature <br><br> </td>



        <td width="332" align="right"> <br> Authorised Signatory <br><br>



        </td>



        </tr>



  



         



       </table>



EOD;







$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);







$ht = ob_get_clean();                           







//                     $ht=<<<EOD



//                       <table cellspacing="" cellpadding="2">



//                             <tr>



//                                <td>



//                                <p style="text-indent: 50px;">* Our risk and responsiblity ceases once the goods leave the godown.</p>



//                                <p style="text-indent: 50px;">* An interest @ 24% per month will be charged if the payment is not made in time.</p>



//                                <p style="text-indent: 50px;">* Subject to {$tot} jurisdication.</p>



//                                </td>



//                            </tr>



                  



//                        </table>  











// EOD;







$pdf->writeHTMLCell(0, 0, '', '', $ht, 0, 1, 0, true, '', true);







$htl = ob_get_clean();



$htl='







<table cellspacing="" cellpadding="1">



                       



        



       <tr>



           <td>



            <p style="text-indent: 50px;">*This is computer generated Invoice, hence no signature required.</p><p></p>



           </td>



       </tr> 



        



   </table>'



;







$pdf->writeHTMLCell(0, 0, '', '', $htl, 0, 1, 0, true, '', true); 







// $htmls = ob_get_clean();                           







// $htmls='











//   <table cellspacing="" cellpadding="">







//          <tr>



//           <img src="" alt="test alt attribute" style="border:1px solid black">  



//        </tr>







//    </table>  



// ';







// $pdf->writeHTMLCell(0, 0, '', '', $htmls, 0, 1, 0, true, '', true);







//$pdf->addDescription("We hope you shall find our rates more competitve and raise your valuable order on us so that it can lay the foundation for our long term business relationship\n\nAssuring you of our best service at all times.");



// $pdf->addDescription($quotationdetail_data[0]['Description']);



//$pdf->Ln();



// $pdf->addTermsCondtNew('*This is computer generated quotation and hence no signature required.');







                       // Print text using writeHTMLCell()











// ---------------------------------------------------------







// $sign='*This is computer generated Invoice, hence no signature required.';







// 	$x = $pdf->GetX();



//     $y = $pdf->GetY();



// 	$pdf->SetXY( $x, $y+10 );



// 	$length = $pdf->GetStringWidth( $sign );



// 	$lignes = $pdf->sizeOfText( $sign, $length) ;



// 	$pdf->MultiCell(190, 4, $sign,0,'L',0,1,'','',true,0,false,true,0);











ob_end_clean();// at the end of your script







$pdf->Output($_SERVER['DOCUMENT_ROOT'] ."/resource/deliveryChallan/Invoice".$data.".pdf", "F");







//$pdf->Output($_SERVER['DOCUMENT_ROOT'] ."/resource/documents/Quotation".$quote_no.".pdf", "F");  







//   $this->tpl->set('pdffile', "/resource/documents/Quotation".$quote_no.".pdf");







//$this->tpl->set('content', $this->tpl->fetch('factory/form/buttonpdf.php'));



       







//  $pdf->Output($_SERVER['DOCUMENT_ROOT'] ."/resource/documents/Invoice".$quote_no.".pdf", "F");







$this->ses->set('pdffile', "/resource/deliveryChallan/Invoice".$data.".pdf");







//  $this->ses->set('quoteno', $quote_no); 



//  $this->ses->set('form_title', 'Invoice');	   











//$dbutil->ApprovalProcess('Purchase Order',$approve[0][0],$data);



                       



                            $this->tpl->set('message', 'Delivery Challan Form Edited Successfully!');   



                            $this->tpl->set('label', 'List');



                            $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));



                            } catch (Exception $exc) {



                             //edit failed option



                            $this->tpl->set('message', 'Failed To Edit, Try Again!');



                            $this->tpl->set('FmData', $form_post_data);



                            $this->tpl->set('content', $this->tpl->fetch('factory/form/deliverychallan.php'));



                            }







                    break;



                  



                   











                case 'addsubmit':



                    



                     if (isset($crud_string)) {



                         



                        $form_post_data = $dbutil->arrFltr($_POST);



                        



                        $IGSTTax = $form_post_data['IGSTTax'] ;



                        if( $IGSTTax == null )



                        {



                            $IGSTTax = 0 ;



                        }else



                        {



                            $IGSTTax = $form_post_data['IGSTTax'];



                        }



                      



                       $CGSTTax = $form_post_data['CGSTTax'] ;



                        if( $CGSTTax == null )



                        {



                            $CGSTTax = 0 ;



                        }else



                        {



                            $CGSTTax = $form_post_data['CGSTTax'];



                        }



                        



                       $SGSTTax = $form_post_data['SGSTTax'] ;



                       



                       if( $SGSTTax == null )



                        {


                            $SGSTTax = 0 ;


                        }else


                        {


                            $SGSTTax = $form_post_data['SGSTTax'];


                        }



                        $taxchoice='CGST_SGST';


                             if($form_post_data['TaxChoice']=='CGST_SGST'){

                                 $taxchoice='CGST_SGST';

                             }else{

                                  $taxchoice='IGST';

                             }



                             



                         $deliverychoice='Non-Returnable';



                         



                             if($form_post_data['DeliveryChoice']=='Returnable'){



                                 $deliverychoice='Returnable';



                             }else{



                                  $deliverychoice='Non-Returnable';



                             }



                             







                        $entry_count = 1;



                            if (isset($form_post_data['customer_ID'])) {



                           



                                        $val = "'" . $form_post_data['DCNo'] . "'," .

                                         "'" . $form_post_data['customer_ID'] . "'," .

                                        //   "'" . $form_post_data['rawmaterialtype_ID'] . "'," .

                                         "'" . date("Y-m-d", strtotime($form_post_data['DeliveryDate'])) . "'," .

                                         "'" . $taxchoice . "'," .

                                         "'" . $CGSTTax . "'," .

                                         "'" . (float) $form_post_data['CGSTAmount'] . "'," .

                                         "'" . $SGSTTax . "'," .

                                         "'" . (float) $form_post_data['SGSTAmount'] . "'," .

                                         "'" .$IGSTTax . "'," .

                                         "'" . (float) $form_post_data['IGSTAmount'] . "'," .

                                         "'" . (float) $form_post_data['BillAmount'] . "'," .

                                         "'" . (float) $form_post_data['NetAmount'] . "'," .

                                         "'" . $deliverychoice . "'," .

                                         "'" . $form_post_data['Remarks'] . "'," .

                                         "'" .  $this->ses->get('user')['entity_ID'] . "'," .

                                         "'" .  $this->ses->get('user')['ID'] . "'";



                               $sql = "INSERT INTO `" . $this->crg->get('table_prefix') . "deliverychallan`  

                                            ( 

                                            `DCNo`, 

                                            `customer_ID`,

                                            `DeliveryDate`,

                                            `TaxChoice`,

                                            `CGSTTax`,

                                            `CGSTAmount`,

                                            `SGSTTax`,

                                            `SGSTAmount`,

                                            `IGSTTax`,

                                            `IGSTAmount`,

                                            `BillAmount`, 

                                            `NetAmount`,

                                            `DeliveryChoice`,

                                            `Remarks`,

                                            `entity_ID`, 

                                            `users_ID`



                                            ) 



                                        VALUES ($val)";



                                  $stmt = $this->db->prepare($sql);



                                  



                                  



                    if ($stmt->execute()) { 



                        



                        $lastInsertedID = $this->db->lastInsertId();







require_once('TCPDF/deliveryChallan.php');



                       



ob_start(); // at the beggining of your script











// create new PDF document



$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);







// set document information



$pdf->SetCreator(PDF_CREATOR);



$pdf->SetAuthor('Sreenidhi Enterprises');



$report_title = "Delivery Challan";



$pdf->SetTitle($report_title);



$pdf->SetSubject('Corrective And Preventive Action');



$pdf->SetKeywords('Quotation,Invoice');







// set default header data



$capa_date = date('d.m.Y',strtotime($capa_data['AuditDateTime']));







$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.'.', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));



$pdf->setFooterData(array(0,64,0), array(0,64,128));







// set header and footer fonts



$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));



$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));







// set default monospaced font



$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);







// set margins



$pdf->SetMargins(10, 30, 10);



$pdf->SetHeaderMargin(10);



$pdf->SetFooterMargin(10);







// set auto page breaks



$pdf->SetAutoPageBreak(TRUE, 13);







// set image scale factor



$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);







// set some language-dependent strings (optional)



if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {



require_once(dirname(__FILE__).'/lang/eng.php');



$pdf->setLanguageArray($l);



}







// ---------------------------------------------------------







// set default font subsetting mode



$pdf->setFontSubsetting(true);







// Set font



// dejavusans is a UTF-8 Unicode font, if you only need to



// print standard ASCII chars, you can use core fonts like



// helvetica or times to reduce file size.







//$pdf->SetFont('times', '', 12, '', true);







$pdf->SetFont('Helvetica', 'Italic', 10, '', true);







// Add a page



// This method has several options, check the source code documentation for more information.







$pdf->AddPage();







$pageWidth = 200;



$pageHeight = 283;



$margin = 11;



//$pdf->Rect( $margin, $margin , $pageWidth - $margin , $pageHeight - $margin);



// Line break











// Line



$pdf->Line(11, 284, 199, 284, '');







// $quote_no = $form_post_data['PurchaseOrderNo'];







// $podate=date("Y-m-d", strtotime($form_post_data['PurchaseOrderDate']));







//$html = ob_get_clean();







// $html = <<<EOD











// EOD;







//$pdf->writeHTML($html, true, false, false, false, '');







//$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);







$trows = '';



                                    



                        FOR ($entry_count; $entry_count <= $form_post_data['maxCount'];) {



                                



  



                                $ItemName='ItemName_' .$entry_count;



                                $ItemNo='ItemNo_' .$entry_count;

                                

                                $unit='Rat_' .$entry_count;



                                $hsn='EmpName_' .$entry_count;



                                $Quantity='Qty_' .$entry_count;



                                $Amount='Amount_' .$entry_count;



                                $Rate='Emp_' .$entry_count;



                                $Per='Water_' .$entry_count;



                        



                                // if($ItemNo == null)



                                // {



                                //     continue ;



                                // }



                                



                                







                                $vals = "'" . $lastInsertedID . "'," .



                                        "'" . $form_post_data[$ItemName] . "'," . 

                                        

                                        "'" . $form_post_data[$ItemNo] . "'," . 

                                        

                                         "'" . $form_post_data[$unit] . "'," . 

                                        

                                        "'" . $form_post_data[$hsn] . "'," . 



                                        "'" . $form_post_data[$Quantity] . "'," . 



                                        "'" . (float) $form_post_data[$Amount] . "',".



                                        "'" . $form_post_data[$Rate] . "'" ;


                                         //"'" . $form_post_data[$Temp] . "'";



                              $sql2 = "INSERT INTO $delvdetail_tab


                                                (



                                                `deliverychallan_ID`,

                                                

                                                `rawmaterialtype_ID`, 



                                                `rawmaterial_ID`, 

                                                

                                                `unit_ID`,

                                                

                                                `HSNCode`,



                                                `Quantity`,



                                                `EstimatedAmount`,



                                                `Rate`


                                            ) 



                                        VALUES ($vals)";


                                 // this need to be changed in to transaction type



                                $stmt = $this->db->prepare($sql2);



                                $stmt->execute();



                            $qty=$form_post_data[$Quantity];

                            $itemid=$form_post_data[$ItemName];

                            //  $sqlsrr="SELECT * FROM $pdtstock_tab where item_ID=$itemid"; 

                            //  $stock_data = $dbutil->getSqlData($sqlsrr);

                            //  $count=count($stock_data);


                            // if($count>0){

                            // $sql_updt_stock = "UPDATE $pdtstock_tab SET AvailableQty=AvailableQty-$qty WHERE item_ID=$itemid AND entity_ID=$entityID";

                            // $stmt = $this->db->prepare($sql_updt_stock);

                            // }

                            // else{

                            //      $sql_updt_stock = "INSERT INTO $pdtstock_tab (item_ID,AvailableQty,entity_ID,users_ID)

                            //     VALUES ($itemid,$qty,$entityID,$userID);";

                            //     $stmt = $this->db->prepare($sql_updt_stock);

                            // }



                            // $stmt->execute();


                                $entry_count++;


                            }


                            $productdetailDatas = "SELECT $rawmaterial_tab.ID,$rawmaterial_tab.RMName,$delvdetail_tab.HSNCode,$delvdetail_tab.Quantity,$delvdetail_tab.EstimatedAmount FROM $rawmaterial_tab,$delvdetail_tab where $rawmaterial_tab.ID = $delvdetail_tab.rawmaterial_ID And $delvdetail_tab.deliverychallan_ID = $lastInsertedID ";



                            $stmt =$this->db->prepare( $productdetailDatas);            



                            $stmt->execute();



                            $delDcproduct = $stmt->fetchAll(2);



                            // var_dump($delDcproduct); 







                            $count = 1;



                            foreach($delDcproduct as $k=>$v){



                                $troww .=  '<tr>



                                <td style="width:50" align="left">'.$count.'</td>



                                <td style="width:350" align="left">'. $v['RMName'].'</td>



                                <td style="width:67" align="center">'. $v['HSNCode'].'  </td>



                                <td style="width:99" align="right">'.$v["Quantity"].'</td>



                                <td style="width:99" align="right">'. $v["EstimatedAmount"].'</td>



                                </tr>'; 



                                 $count++;



                            }

                            for($i=1;$i<3;$i++){


                                $trowss.="<tr> <td></td> <td></td>"      



                                    . "<td></td>"



                                    . "<td></td>"



                                    . "<td></td>"



                                    . "</tr>";



                            }

                            



                            // $val = "'" . $form_post_data['DCNo'] . "'," .



                            // "'" . $form_post_data['customer_ID'] . "'," .



                            // "'" . date("Y-m-d", strtotime($form_post_data['DeliveryDate'])) . "'," .



                            //  "'" . $taxchoice . "'," .



                            // "'" . $CGSTTax . "'," .



                            // "'" . (float) $form_post_data['CGSTAmount'] . "'," .



                            // "'" . $SGSTTax . "'," .



                            // "'" . (float) $form_post_data['SGSTAmount'] . "'," .



                            // "'" .$IGSTTax . "'," .



                            // "'" . (float) $form_post_data['IGSTAmount'] . "'," .



                            // "'" . (float) $form_post_data['BillAmount'] . "'," .



                            // "'" . (float) $form_post_data['NetAmount'] . "'," .



                            // "'" . $deliverychoice . "'," .



                            // "'" .  $this->ses->get('user')['entity_ID'] . "'," .



                            // "'" .  $this->ses->get('user')['ID'] . "'";


                            // $total=0;


                            // $tot=number_format($form_post_data[$Amount]);



                            $DCNumber = strval($form_post_data['DCNo']);



                            $DCDate = strval(date("Y-m-d", strtotime($form_post_data['DeliveryDate'])));     


                            $DC_table = $this->crg->get('table_prefix') . "deliverychallan" ;







                            $customerName = "SELECT $customer_table.ID , $customer_table.FirstName from $customer_table, $DC_table where  $DC_table.customer_ID = $customer_table.ID and $DC_table.ID = $lastInsertedID ";


                            $stmt =$this->db->prepare($customerName);            

                            $stmt->execute();

                            $CusDcName = $stmt->fetchAll(2);

                            $custumeName = $CusDcName[0]['FirstName'];



                            // var_dump($CusDcName);


                            // $paymentType = "SELECT $payment_tab.Paymode,$supplier_tab.Company  FROM $payment_tab,$supplier_tab,$pomaster_tab where  $supplier_tab.ID = $pomaster_tab.supplier_ID AND $payment_tab.ID = $pomaster_tab.PaymentMode  AND $pomaster_tab.ID =  $lastInsertedID ";



                            // $stmt =$this->db->prepare($paymentType);            



                            // $stmt->execute();



                            // $paymentMod = $stmt->fetchAll(2);



                     



                            // $ModeOfPay = strval($paymentMod[0]["Paymode"]);



                            // $Supplier = strval($paymentMod[0]["Company"]);



                     



                            // $otherRef = strval($form_post_data['OtherReference']);



                            // $termsOfDelivery = strval($form_post_data['TermsOfDelivery']);







                            $cgstPre=strval($CGSTTax.'%');



                            $sgstPre=strval($SGSTTax.'%');



                            $igstPre=strval($IGSTTax.'%');



                            $cgstAmount = strval((float) $form_post_data['CGSTAmount']);



                            $sgstAmount = strval((float) $form_post_data['SGSTAmount']);



                            $igstAmount = strval((float) $form_post_data['IGSTAmount']);



                            $netAmount = strval((float) $form_post_data['NetAmount']);



                            $BillAmount = strval((float) $form_post_data['BillAmount']);



                     



                     



                            // $number = $netAmount;



                            //  // $inWords = getIndianCurrency( $netAmount);



                            //  $inWords = $util -> getIndianCurrency($number).' only';



                           



                             $html = <<<EOD



         



                            



        <table cellspacing="0" cellpadding="4" border="1">



   



  



       <tr>







                             <td align="center" >  <u><b style="font-size:130%;" > DELIVERY CHALLAN  </b></u> <br> <br>



                               <b style="font-size:180%;" > KOSH INNOVATION  </b> <br>  



                              <b >Cs-46 & 47, Pipdic Industrial Estate,Mettupalayam,Puducherry - 9.</b> <br> 



                              <b> GST NO. :34APOPK9748JIZ5 </b>  <br></td>



                             



                             </tr>







        



                    <tr>



                    <td width="333">  DC NO. : <b>$DCNumber</b> <br>  </td>



                    <td width="332">  Date : <b>$DCDate</b>  <br></td>



                    </tr>







                    <tr>



                    <td width="665" > TO : <b>  $custumeName </b> <br></td>



                    </tr>



   



    







       <tr>



       <td width="50" align="center"><b>S.No</b></td>



       <td width="350" align="center"><b>Description </b></td>



       <td width="67" align="center"><b>HSN</b></td>



       <td width="99" align="center"> <b>Quantity</b></td>



       <td width="99" align="center"><b>Value</b></td>



    



      </tr>



       



        {$troww}



        {$trowss}







        <tr>



        <td width="467" ></td>



        <td width="99" align="right"><b>Total:</b> </td>



        <td width="99" align="right" ><b>$BillAmount</b> </td>



        </tr>



        



        <tr>



        <td width="665" ></td>



        </tr>



        



        <tr>



        <td width="467" align="center"></td>



        <td width="132" align="center"><b>Tax-Percentage</b></td>



        <td width="66" align="center"><b>Amount</b></td>



        </tr>



        <tr>



        <td width="533" align="right">CGST: </td>



        <td width="66" align="right"> $cgstPre</td>



        <td width="66" align="right">$cgstAmount</td>



        </tr>



        <tr>



        <td width="533" align="right">SGST: </td>



        <td width="66" align="right">$sgstPre</td>



        <td width="66" align="right">$sgstAmount</td>



        </tr>



        <tr>



        <td width="533" align="right">IGST: </td>



        <td width="66" align="right">$igstPre</td>



        <td width="66" align="right">$igstAmount</td>



        </tr>



 



        <tr>



        <td width="599" align="right"><b>Final Amount</b></td>



        <td width="66" align="right"><b>$netAmount</b></td>



        </tr>







        <tr>



        <td width="665" align="left"> <br> Returnable (or) Non-Returnable : <b> $deliverychoice </b>  -- For Kosh Innovation <br> <br><br> </td>



        </tr>







        <tr>



        <td width="333" align="left" >   Receiver's Signature <br><br> </td>



        <td width="332" align="right"> <br> Authorised Signatory <br><br>



        </td>



        </tr>



  



         



       </table>



EOD;







$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);







$ht = ob_get_clean();                           







//                     $ht=<<<EOD



//                       <table cellspacing="" cellpadding="2">



//                             <tr>



//                                <td>



//                                <p style="text-indent: 50px;">* Our risk and responsiblity ceases once the goods leave the godown.</p>



//                                <p style="text-indent: 50px;">* An interest @ 24% per month will be charged if the payment is not made in time.</p>



//                                <p style="text-indent: 50px;">* Subject to {$tot} jurisdication.</p>



//                                </td>



//                            </tr>



                  



//                        </table>  











// EOD;







$pdf->writeHTMLCell(0, 0, '', '', $ht, 0, 1, 0, true, '', true);







$htl = ob_get_clean();



$htl='







<table cellspacing="" cellpadding="1">



                       



        



       <tr>



           <td>



            <p style="text-indent: 50px;">*This is computer generated Invoice, hence no signature required.</p><p></p>



           </td>



       </tr> 



        



   </table>'



;







$pdf->writeHTMLCell(0, 0, '', '', $htl, 0, 1, 0, true, '', true); 







// $htmls = ob_get_clean();                           







// $htmls='











//   <table cellspacing="" cellpadding="">







//          <tr>



//           <img src="" alt="test alt attribute" style="border:1px solid black">  



//        </tr>







//    </table>  



// ';







// $pdf->writeHTMLCell(0, 0, '', '', $htmls, 0, 1, 0, true, '', true);







//$pdf->addDescription("We hope you shall find our rates more competitve and raise your valuable order on us so that it can lay the foundation for our long term business relationship\n\nAssuring you of our best service at all times.");



// $pdf->addDescription($quotationdetail_data[0]['Description']);



//$pdf->Ln();



// $pdf->addTermsCondtNew('*This is computer generated quotation and hence no signature required.');







                       // Print text using writeHTMLCell()











// ---------------------------------------------------------







// $sign='*This is computer generated Invoice, hence no signature required.';







// 	$x = $pdf->GetX();



//     $y = $pdf->GetY();



// 	$pdf->SetXY( $x, $y+10 );



// 	$length = $pdf->GetStringWidth( $sign );



// 	$lignes = $pdf->sizeOfText( $sign, $length) ;



// 	$pdf->MultiCell(190, 4, $sign,0,'L',0,1,'','',true,0,false,true,0);











ob_end_clean();// at the end of your script







$pdf->Output($_SERVER['DOCUMENT_ROOT'] ."/resource/deliveryChallan/Invoice".$lastInsertedID.".pdf", "F");







//$pdf->Output($_SERVER['DOCUMENT_ROOT'] ."/resource/documents/Quotation".$quote_no.".pdf", "F");  







//   $this->tpl->set('pdffile', "/resource/documents/Quotation".$quote_no.".pdf");







//$this->tpl->set('content', $this->tpl->fetch('factory/form/buttonpdf.php'));



       







//  $pdf->Output($_SERVER['DOCUMENT_ROOT'] ."/resource/documents/Invoice".$quote_no.".pdf", "F");







$this->ses->set('pdffile', "/resource/deliveryChallan/Invoice".$lastInsertedID.".pdf"); 







//  $this->ses->set('quoteno', $quote_no); 



//  $this->ses->set('form_title', 'Invoice');	   



//$dbutil->ApprovalProcess('Purchase Order',$approve[0][0],$lastInsertedID);



                    }



                        }



                        $this->tpl->set('mode', 'add');



                        $this->tpl->set('message', '- Success -');


                        
                        $this->tpl->set('label', 'List');



                        $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                        
                        //$this->tpl->set('content', $this->tpl->fetch('factory/form/deliverychallan.php'));



                     } else {



                            //edit option



                            //if submit failed to insert form



                            $this->tpl->set('message', 'Failed to submit!');



                            $this->tpl->set('FmData', $form_post_data);



                            $this->tpl->set('content', $this->tpl->fetch('factory/form/deliverychallan.php'));



                     }



                       



                    break;



                case 'add':



                            $this->tpl->set('mode', 'add');



	                        $this->tpl->set('page_header', 'Store');



	                  //add new purchase order 



                        $entity_short_code = $this->ses->get('user')['short_code'];

                        $start='KI/ST';

                        $newPONumber =$dbutil->keyGenerate('deliverychallan', 'DCN','DCNO',$start);  



                        $this->tpl->set('po_number', $newPONumber);



                       



            //add new batch no 



                        // $entity_short_code = $this->ses->get('user')['short_code'];



                        // $newBatchNo =$dbutil->keyGen('purchaseorder', 'KBAT', $entity_short_code,'BatchNo');  



                        // $this->tpl->set('bacth_no', $newBatchNo);



                        $this->tpl->set('content', $this->tpl->fetch('factory/form/deliverychallan.php'));



                    break;







                default:



                    /*



                     * List form



                     */



                     



                    ////////////////////start//////////////////////////////////////////////



                    



           //bUILD SQL 



            $whereString = '';



            



   $colArr = array(



       



                "$delvmaster_tab.ID",



                "$delvmaster_tab.DCNo",



                "$customer_table.FirstName ",



                "$delvmaster_tab.BillAmount",



                //"$pomaster_tab.BatchNo",



                "DATE_FORMAT($delvmaster_tab.DeliveryDate, '%d-%m-%Y') AS DeliveryDate",



                "$delvmaster_tab.DeliveryChoice",
                
                "$delvmaster_tab.Remarks"



               



              



                



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



             $whereString ="ORDER BY $delvmaster_tab.ID DESC";



           }



            



          



         $sql = "SELECT "



                    . implode(',',$colArr)



                    . " FROM $delvmaster_tab,$customer_table "



                    . " WHERE "



                    . " $customer_table.ID= $delvmaster_tab.customer_ID AND "



                    . " $delvmaster_tab.entity_ID = $entityID "



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



         



         



            $this->tpl->set('table_columns_label_arr', array('ID','DeliveryChallan No','Customer Name','Bill Amount','Date','Deliver Choice','Remarks'));



            



            /*



             * selectColArr for filter form



             */



            



            $this->tpl->set('selectColArr',$colArr);
           
            $this->tpl->set('dcpdf','Generate Pdf');



                        



            /*



             * set pagination template



             */



            $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');



                   



            //////////////////////close//////////////////////////////////////  



                     



                    include_once $this->tpl->path . '/factory/form/deliverychallan_crud_form.php';



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

    function returneddeliverychallan(){




        include_once 'util/genUtil.php';



        $util = new GenUtil();



        



     if ($this->crg->get('wp') || $this->crg->get('rp')) {



 



 ////////////////////////////////////////////////////////////////////////////////



 //////////////////////////////access condition applied//////////////////////////



 ////////////////////////////////////////////////////////////////////////////////    



            



            



            include_once 'util/DBUTIL.php';



            $dbutil = new DBUTIL($this->crg);



             



            $entityID = $this->ses->get('user')['entity_ID'];



            $userID = $this->ses->get('user')['ID'];



            



            



            $returneddcdetail_tab = $this->crg->get('table_prefix') . 'returned_dcdetail';



            $returneddcmaster_tab = $this->crg->get('table_prefix') . 'returned_dcmaster';



            $delvmaster_tab = $this->crg->get('table_prefix') . 'deliverychallan';

            

            $dcdetail_tab = $this->crg->get('table_prefix') . 'deliverychallandetail';



            $customer_table= $this->crg->get('table_prefix') . 'customer';

    

            $rawmaterial_tab = $this->crg->get('table_prefix') . 'rawmaterial';

            

            $rawmattype_tab= $this->crg->get('table_prefix') . 'rawmaterialtype';

            

            $gateinfo_tab= $this->crg->get('table_prefix') . 'gateinfo';



             //dc select box data



             $pdtt_sql ="SELECT $delvmaster_tab.ID,$delvmaster_tab.DCNO FROM $delvmaster_tab where $delvmaster_tab.DeliveryChoice='Returnable' order by $delvmaster_tab.ID desc";



            $stmt =$this->db->prepare($pdtt_sql);            



            $stmt->execute();



            $pdt_data = $stmt->fetchAll();	



            $this->tpl->set('deliverychallan_data', $pdt_data);

            

            //gate select box data



             $gate_sql ="SELECT $gateinfo_tab.ID,GateNO FROM $gateinfo_tab";



            $stmt =$this->db->prepare($gate_sql);            



            $stmt->execute();



            $gate_data = $stmt->fetchAll();	



            $this->tpl->set('gate_data', $gate_data);







            $this->tpl->set('page_title', 'Returned Delivery Challan');	          



            $this->tpl->set('page_header', '');



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





                     $sqldetdelete="Delete $returneddcmaster_tab,$returneddcdetail_tab from $returneddcmaster_tab



                                        LEFT JOIN  $returneddcdetail_tab ON $returneddcmaster_tab.ID=$returneddcdetail_tab.return_dcmaster_ID 



                                        where $returneddcdetail_tab.return_dcmaster_ID=$data"; 



                        $stmt = $this->db->prepare($sqldetdelete);            



                        



                        if($stmt->execute()){



                        $this->tpl->set('message', 'Return Delivery Challan Form deleted successfully');



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



                                

                     

                    



                    $sqlsrr ="SELECT * FROM `$returneddcdetail_tab`,`$returneddcmaster_tab` WHERE `$returneddcdetail_tab`.`return_dcmaster_ID`=`$returneddcmaster_tab`.`ID` AND `$returneddcdetail_tab`.`return_dcmaster_ID`='$data'";                    



                    $podetail_data = $dbutil->getSqlData($sqlsrr); 

                    

                     $sql="SELECT 

                       $rawmaterial_tab.ID as rawmaterial_ID,

                       $rawmaterial_tab.RMName, 

                       $rawmattype_tab.ID as rawmattype_ID,

                       $rawmattype_tab.RawMaterialType,

                       $delvmaster_tab.DeliveryDate,

                       $customer_table.ID as customer_ID,

                       $customer_table.FirstName,

                       $delvmaster_tab.DeliveryChoice, 

                       $delvmaster_tab.TaxChoice, 

                       $delvmaster_tab.BillAmount, 

                       $delvmaster_tab.CGSTAmount, 

                       $delvmaster_tab.CGSTTax, 

                       $delvmaster_tab.SGSTTax, 

                       $delvmaster_tab.SGSTAmount, 

                       $delvmaster_tab.IGSTTax, 

                       $delvmaster_tab.IGSTAmount, 

                       $delvmaster_tab.NetAmount, 
                       
                       $delvmaster_tab.Remarks, 

                       $dcdetail_tab.HSNCode,

                       $dcdetail_tab.Quantity, 

                       $dcdetail_tab.Rate, 

                       $dcdetail_tab.EstimatedAmount

                      FROM 

                      $delvmaster_tab,

                      $dcdetail_tab,

                      $customer_table,

                      $rawmaterial_tab,

                      $rawmattype_tab

                      

                      WHERE 

                      $delvmaster_tab.ID=$dcdetail_tab.deliverychallan_ID 

                      AND 

                      $customer_table.ID=$delvmaster_tab.customer_ID 

                      AND 

                      $rawmaterial_tab.ID=$dcdetail_tab.rawmaterial_ID 

                      AND

                      $rawmattype_tab.ID=$dcdetail_tab.rawmaterialtype_ID 

                      AND

                      $dcdetail_tab.deliverychallan_ID=".$podetail_data[0]['dc_ID']."";

                      

                      

                    $deliverychallan_data = $dbutil->getSqlData($sql); 

                    

                    $this->tpl->set('DCData', $deliverychallan_data); 

                    

                   

                  

                     $sql="SELECT * FROM $delvmaster_tab,$dcdetail_tab where `$dcdetail_tab`.`deliverychallan_ID`=`$delvmaster_tab`.`ID` AND `$dcdetail_tab`.`deliverychallan_ID`=".$podetail_data[0]['dc_ID']."";

                     $dc_data = $dbutil->getSqlData($sql); 

                    

                    

                    $count=count($dc_data);

                    

                   for($i=1;$i<=$count;$i++){

                    

                   // $rawtypeID = $dc_data[$i-1]['rawmaterialtype_ID'];

                   

                    $rawtypeID = $dc_data[$i-1]['rawmaterial_ID'];



                    $rawmaterial_tab = $this->crg->get('table_prefix') . 'rawmaterial';



                    //  $rawmaterial_sql ="SELECT ID,RMName FROM $rawmaterial_tab WHERE rawmaterialtype_ID = $rawtypeID";

                     $rawmaterial_sql ="SELECT ID,RMName FROM $rawmaterial_tab WHERE ID = $rawtypeID";



                    $raw_data[] = $dbutil->getSqlData($rawmaterial_sql); 

                     

                   

                     

                    }

                    

                    $this->tpl->set('raw_data', $raw_data);

                    

                    // $rawtypeID = $dc_data[0]['rawmaterialtype_ID'];               



                    // $rawmaterial_sql ="SELECT ID,RMName FROM $rawmaterial_tab WHERE rawmaterialtype_ID = $rawtypeID";



                    // $stmt = $this->db->prepare($rawmaterial_sql);



                    // $stmt->execute();



                    // $rawmaterial_data= $stmt->fetchAll();



                    // $this->tpl->set('raw_data', $rawmaterial_data);

                   



                



                    //edit option     



                    $this->tpl->set('message', 'You Can View Return Delivery Challan Form');



                    $this->tpl->set('page_header', 'Store');



                    $this->tpl->set('FmData', $podetail_data); 



                    



                    $this->tpl->set('content', $this->tpl->fetch('factory/form/returneddc.php'));                    



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



                                



                    $sqlsrr ="SELECT * FROM `$returneddcdetail_tab`,`$returneddcmaster_tab` WHERE `$returneddcdetail_tab`.`return_dcmaster_ID`=`$returneddcmaster_tab`.`ID` AND `$returneddcdetail_tab`.`return_dcmaster_ID`='$data'";                    



                    $podetail_data = $dbutil->getSqlData($sqlsrr); 

                    

                       $sql="SELECT 

                       $rawmaterial_tab.ID as rawmaterial_ID,

                       $rawmaterial_tab.RMName, 

                       $rawmattype_tab.ID as rawmattype_ID,

                       $rawmattype_tab.RawMaterialType,

                       $delvmaster_tab.DeliveryDate,

                       $customer_table.ID as customer_ID,

                       $customer_table.FirstName,

                       $delvmaster_tab.DeliveryChoice, 

                       $delvmaster_tab.TaxChoice, 

                       $delvmaster_tab.BillAmount, 

                       $delvmaster_tab.CGSTAmount, 

                       $delvmaster_tab.CGSTTax, 

                       $delvmaster_tab.SGSTTax, 

                       $delvmaster_tab.SGSTAmount, 

                       $delvmaster_tab.IGSTTax, 

                       $delvmaster_tab.IGSTAmount, 

                       $delvmaster_tab.NetAmount,
                       
                       $delvmaster_tab.Remarks,

                       $dcdetail_tab.HSNCode,

                       $dcdetail_tab.Quantity, 

                       $dcdetail_tab.Rate, 

                       $dcdetail_tab.EstimatedAmount

                      FROM 

                      $delvmaster_tab,

                      $dcdetail_tab,

                      $customer_table,

                      $rawmaterial_tab,

                      $rawmattype_tab

                      

                      WHERE 

                      $delvmaster_tab.ID=$dcdetail_tab.deliverychallan_ID 

                      AND 

                      $customer_table.ID=$delvmaster_tab.customer_ID 

                      AND 

                      $rawmaterial_tab.ID=$dcdetail_tab.rawmaterial_ID 

                      AND

                      $rawmattype_tab.ID=$dcdetail_tab.rawmaterialtype_ID 

                      AND

                      $dcdetail_tab.deliverychallan_ID=".$podetail_data[0]['dc_ID']."";

                      

                      

                    $deliverychallan_data = $dbutil->getSqlData($sql); 

                    

                    $this->tpl->set('DCData', $deliverychallan_data); 

                    

                    

                    

                    

                   

                  

                    $sql="SELECT * FROM $delvmaster_tab,$dcdetail_tab where `$dcdetail_tab`.`deliverychallan_ID`=`$delvmaster_tab`.`ID` AND `$dcdetail_tab`.`deliverychallan_ID`=".$podetail_data[0]['dc_ID']."";

                    $dc_data = $dbutil->getSqlData($sql); 

                    

                   

                    

                    // $rawtypeID = $dc_data[0]['rawmaterialtype_ID'];               



                    // $rawmaterial_sql ="SELECT ID,RMName FROM $rawmaterial_tab WHERE rawmaterialtype_ID = $rawtypeID";



                    // $stmt = $this->db->prepare($rawmaterial_sql);



                    // $stmt->execute();



                    // $rawmaterial_data= $stmt->fetchAll();



                    // $this->tpl->set('raw_data', $rawmaterial_data);

                    

                     $count=count($dc_data);

                    

                   for($i=1;$i<=$count;$i++){

                    

                    //$rawtypeID = $dc_data[$i-1]['rawmaterialtype_ID'];

                    

                    $rawtypeID = $dc_data[$i-1]['rawmaterial_ID'];



                    $rawmaterial_tab = $this->crg->get('table_prefix') . 'rawmaterial';



                     $rawmaterial_sql ="SELECT ID,RMName FROM $rawmaterial_tab WHERE ID = $rawtypeID";



                    $raw_data[] = $dbutil->getSqlData($rawmaterial_sql); 

                     

                  

                     

                    }

                    

                    $this->tpl->set('raw_data', $raw_data);



                    //edit option     



                    $this->tpl->set('message', 'You Can Edit Return Delivery Challan Form');



                    $this->tpl->set('page_header', 'Store');



                    $this->tpl->set('FmData', $podetail_data); 



                

                    $this->tpl->set('content', $this->tpl->fetch('factory/form/returneddc.php'));                    



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



                    $sqldet_del ="DELETE FROM $returneddcdetail_tab WHERE return_dcmaster_ID=$data";



                    $stmt = $this->db->prepare($sqldet_del);



                    $stmt->execute();   



                            





                            try{



                                



                           



                            $dcid= $form_post_data['dc_ID'];

                            

                            $gateinfo_ID= $form_post_data['gateinfo_ID'];



                            $returndate=date("Y-m-d", strtotime($form_post_data['ReceivedDate']));



                            $Comments= $form_post_data['Comments'];



                            $entityID;

                            

                            $userID;

                            

                            $sql_update= "Update 



                                        $returneddcmaster_tab set 



                                        dc_ID='$dcid',

                                        

                                        gateinfo_ID='$gateinfo_ID',



                                        Comments='$Comments',



                                        entity_ID=$entityID,



                                        users_ID=$userID



                                        WHERE ID=$data" ;







                            $stmt1 = $this->db->prepare($sql_update);



                            $stmt1->execute(); 



                            



                        $entry_count = 1;



                        FOR ($entry_count; $entry_count <= $form_post_data['maxCount'];) {



                                





                                $ItemName='ItemName_' .$entry_count;



                                $hsn='Water_' .$entry_count;



                                $DCQuantity='Note_' .$entry_count;



                                $pendingqty='Quantity_' .$entry_count;



                                $receivedqty='Amount_' .$entry_count;

                               





                               $vals = "'" . $data . "'," .



                                        

                                        "'" . $form_post_data[$ItemName] . "'," . 

                                        

                                        "'" . $form_post_data[$hsn] . "'," . 



                                        "'" . $form_post_data[$DCQuantity] . "'," . 



                                        "'" . $form_post_data[$pendingqty] . "'," .



                                        "'" . $form_post_data[$receivedqty] . "'";

                                       



                                   $sql2 = "INSERT INTO $returneddcdetail_tab

                    

                                            ( 



                                               `return_dcmaster_ID`, 



                                                `rawmaterial_ID`, 

                                                

                                                `HSNCode`,



                                                `DcQuantity`,



                                                `PendingQuantity`,



                                                `ReceivedQuantity`





                                             )



                                VALUES ($vals)";







                                $stmt = $this->db->prepare($sql2);



                                $stmt->execute();



                                



                           



                            



                            //increment here



                            $entry_count++;



                            }







                        



                            $this->tpl->set('message', 'Return Delivery Challan Form Edited Successfully!');   



                            $this->tpl->set('label', 'List');



                            $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));



                            } catch (Exception $exc) {



                             //edit failed option



                            $this->tpl->set('message', 'Failed To Edit, Try Again!');



                            $this->tpl->set('FmData', $form_post_data);



                            $this->tpl->set('content', $this->tpl->fetch('factory/form/returneddc.php'));



                            }







                    break;



                  



                case 'addsubmit':



                    



                     if (isset($crud_string)) {



                         



                        $form_post_data = $dbutil->arrFltr($_POST);







                        $entry_count = 1;



                        



                            if (isset($form_post_data['dc_ID'])) {



                           



                                        $val = "'" . $form_post_data['dc_ID'] . "'," .

                                        

                                        "'" . $form_post_data['gateinfo_ID'] . "'," .



                                         "'" . date("Y-m-d", strtotime($form_post_data['ReceivedDate'])) . "'," .



                                         "'" . $form_post_data['Comments'] . "'," .

  

                                         "'" .  $this->ses->get('user')['entity_ID'] . "'," .



                                         "'" .  $this->ses->get('user')['ID'] . "'";







                              $sql = "INSERT INTO `" . $this->crg->get('table_prefix') . "returned_dcmaster`



                                            ( 



                                            `dc_ID`, 

                                            

                                            `gateinfo_ID`,



                                            `ReceivedDate`,

                                            

                                            `Comments`,



                                            `entity_ID`, 



                                            `users_ID`



                                            ) 



                                        VALUES ($val)";



                                  $stmt = $this->db->prepare($sql);



                                  



                                  



                    if ($stmt->execute()) { 



                        



                        $lastInsertedID = $this->db->lastInsertId();





                        FOR ($entry_count; $entry_count <= $form_post_data['maxCount'];) {



   

                                $ItemName='ItemName_' .$entry_count;



                                $hsn='Water_' .$entry_count;



                                $DCQuantity='Note_' .$entry_count;



                                $pendingqty='Quantity_' .$entry_count;



                                $receivedqty='Amount_' .$entry_count;



                    





                                $vals = "'" . $lastInsertedID . "'," .



                                        "'" . $form_post_data[$ItemName] . "'," . 

                                        

                                        "'" . $form_post_data[$hsn] . "'," . 



                                        "'" . $form_post_data[$DCQuantity] . "'," . 



                                        "'" . $form_post_data[$pendingqty] . "'," .



                                        "'" . $form_post_data[$receivedqty] . "'";



                                 



                          $sql2 = "INSERT INTO $returneddcdetail_tab



                                              (



                                                `return_dcmaster_ID`, 



                                                `rawmaterial_ID`, 

                                                

                                                `HSNCode`,



                                                `DcQuantity`,



                                                `PendingQuantity`,



                                                `ReceivedQuantity`



                                            ) 



                                                



                                        VALUES ($vals)";







                                 // this need to be changed in to transaction type



                                



                                $stmt = $this->db->prepare($sql2);



                                $stmt->execute();



                            



                                $entry_count++;



                                



                            }





                    }



                        }



                        $this->tpl->set('mode', 'add');



                        $this->tpl->set('message', '- Success -');


                        
                        $this->tpl->set('label', 'List');



                        $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                       // $this->tpl->set('content', $this->tpl->fetch('factory/form/returneddc.php'));



                     } else {



                            //edit option



                            //if submit failed to insert form



                            $this->tpl->set('message', 'Failed to submit!');



                            $this->tpl->set('FmData', $form_post_data);



                            $this->tpl->set('content', $this->tpl->fetch('factory/form/returneddc.php'));



                     }



                       



                    break;



                case 'add':



                            $this->tpl->set('mode', 'add');



	                        $this->tpl->set('page_header', '');



	               

                        $this->tpl->set('content', $this->tpl->fetch('factory/form/returneddc.php'));



                    break;







                default:



                    /*



                     * List form



                     */



                     



                    ////////////////////start//////////////////////////////////////////////



                    



           //bUILD SQL 



            $whereString = '';



            



   $colArr = array(



       

              



                "$returneddcmaster_tab.ID",



                "$delvmaster_tab.DCNo",



                "$customer_table.FirstName ",



                "DATE_FORMAT($returneddcmaster_tab.ReceivedDate, '%d-%m-%Y') AS ReceivedDate",



                "$returneddcdetail_tab.DCQuantity",

                

                "$returneddcdetail_tab.PendingQuantity",

                

                "$returneddcdetail_tab.ReceivedQuantity"

                



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



             $whereString ="GROUP BY $returneddcmaster_tab.ID DESC";



           }

     

            



          



          $sql = "SELECT "



                    . implode(',',$colArr)



                    . " FROM $delvmaster_tab,$customer_table ,$returneddcmaster_tab,$returneddcdetail_tab"



                    . " WHERE "



                    . " $customer_table.ID= $delvmaster_tab.customer_ID AND "

                    

                     . " $delvmaster_tab.ID= $returneddcmaster_tab.DC_ID AND "

                    

                     . " $returneddcmaster_tab.ID= $returneddcdetail_tab.return_dcmaster_ID AND "



                    . " $returneddcmaster_tab.entity_ID = $entityID "



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



         



         



            $this->tpl->set('table_columns_label_arr', array('ID','DeliveryChallan No','Customer Name','Received Date','DC Quantity','Pending Quantity','Received Quantity'));



            



            /*



             * selectColArr for filter form



             */



            



            $this->tpl->set('selectColArr',$colArr);



                        



            /*



             * set pagination template



             */



            $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');



                   



            //////////////////////close//////////////////////////////////////  



                     



                    include_once $this->tpl->path . '/factory/form/returneddc_crud_form.php';



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

    

    function purchase(){

var_dump($_POST);
var_dump($_FILES);
     if ($this->crg->get('wp') || $this->crg->get('rp')) {



 ////////////////////////////////////////////////////////////////////////////////



 //////////////////////////////access condition applied//////////////////////////



 ////////////////////////////////////////////////////////////////////////////////    




            include_once 'util/DBUTIL.php';

            $dbutil = new DBUTIL($this->crg);

            $entityID = $this->ses->get('user')['entity_ID'];

            $userID = $this->ses->get('user')['ID'];



            $supplier_tab = $this->crg->get('table_prefix') . 'supplier';

            $po_tab = $this->crg->get('table_prefix') . 'purchaseorder';

            $gateinfo_tab = $this->crg->get('table_prefix') . 'gateinfo';

            //$payment_tab = $this->crg->get('table_prefix') . 'paymentmode';

            $podetail_tab = $this->crg->get('table_prefix') . 'purchaseorderdetail';

            $pedetail_tab = $this->crg->get('table_prefix') . 'purchaseentrydetail';

            $pemaster_tab = $this->crg->get('table_prefix') . 'purchaseentry';

            $unit_tab = $this->crg->get('table_prefix') . 'unit';



            $stock_tab = $this->crg->get('table_prefix') . 'stock';



             $rawmaterial_tab = $this->crg->get('table_prefix') . 'rawmaterial';



            $approvaltype_tab = $this->crg->get('table_prefix') . 'approvaltype';



            $approvalprocess_tab = $this->crg->get('table_prefix') . 'approvalprocess';

            

            $peattachdetail_tab = $this->crg->get('table_prefix') . 'purchaseentry_attachmentdetails';


            //approvaltype select box



             $sql = "SELECT approver_ID FROM $approvaltype_tab where $approvaltype_tab.ProcessTypeName='GRN Approval'"; 



            $stmt = $this->db->prepare($sql);            



            $stmt->execute();



            $approvaltype_data = $stmt->fetchAll();	



            



            $approve=$approvaltype_data;



            



             //unit select box data



            $unit_sql ="SELECT ID,UnitCode FROM $unit_tab";



            $stmt =$this->db->prepare($unit_sql);            



            $stmt->execute();



            $unit_data = $stmt->fetchAll();	



            $this->tpl->set('unit_data', $unit_data);


            //supplier select box data



            $Supplier_sql ="SELECT ID,Company FROM $supplier_tab";



            $stmt =$this->db->prepare($Supplier_sql);            



            $stmt->execute();



            $Supplier_data = $stmt->fetchAll();	



            $this->tpl->set('Supplier_data', $Supplier_data);



           // var_dump($Supplier_data);

            // //paymentmode select box data



            // $payment_sql = "SELECT ID,Paymode FROM $payment_tab";



            // $stmt =$this->db->prepare($payment_sql);            



            // $stmt->execute();



            // $payment_data = $stmt->fetchAll();	



            // $this->tpl->set('payment_data', $payment_data);


            //gate info select box data



            $gateinfo_sql = "SELECT ID,GateNo FROM $gateinfo_tab";



            $stmt = $this->db->prepare($gateinfo_sql);            



            $stmt->execute();



            $gateinfo_data  = $stmt->fetchAll();	



            $this->tpl->set('gateinfo_data', $gateinfo_data);



            //get  purchaseorder no info select box



            // $po_sql = "SELECT ID,PurchaseOrderNo FROM $po_tab where $po_tab.Stage='Approved'";



             $po_sql = "SELECT ID,PurchaseOrderNo FROM $po_tab order by $po_tab.ID desc";



            $stmt = $this->db->prepare($po_sql);            



            $stmt->execute();



            $po_data= $stmt->fetchAll();	



            $this->tpl->set('po_data', $po_data);

            //purchaseorder no for edit



             //get  purchaseorder no info select box



            $po_sql = "SELECT ID,PurchaseOrderNo FROM $po_tab";



            $stmt = $this->db->prepare($po_sql);            



            $stmt->execute();



            $poedit_data= $stmt->fetchAll();	



            $this->tpl->set('poedit_data', $poedit_data);



            // var_dump($po_data);



           //get rawmaterial  info select box 



            $pod_sql ="SELECT rawmaterial_ID as ID,RMName FROM $podetail_tab";



            $stmt = $this->db->prepare($pod_sql);            



            $stmt->execute();



            $pod_data= $stmt->fetchAll();	



            $this->tpl->set('pod_data',$pod_data);




            $this->tpl->set('page_title', 'GRN');	          



            $this->tpl->set('page_header', 'Store');



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


            //Confirm Submit



             if (!empty($_POST['confirm_submit_button']) && $_POST['confirm_submit_button'] == 'confirm') {



                $crud_string = 'confirm';



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



                     $sqldetdelete="Delete $pemaster_tab,$pedetail_tab from $pemaster_tab



                                        LEFT JOIN  $pedetail_tab ON $pemaster_tab.ID=$pedetail_tab.purchaseentry_ID 



                                        where $pedetail_tab.purchaseentry_ID=$data"; 



                        $stmt = $this->db->prepare($sqldetdelete);            
                        $stmt->execute();


                     $sqlsel_del = "SELECT ID,documentpath FROM $peattachdetail_tab WHERE purchaseentry_ID = '$data'";

                     $stmt = $this->db->prepare($sqlsel_del);

                     $stmt->execute();

                     $resource_data = $stmt->fetchAll();


                     
                    if(count($resource_data)>0){
                     foreach($resource_data as $k=>$v){

                         unlink('.'. substr($v['documentpath'], 1));     

                                

                      }

                    }

                     $sqldet_del = "DELETE FROM $peattachdetail_tab WHERE purchaseentry_ID = '$data' ";

                     $stmt2 = $this->db->prepare($sqldet_del);

                     $stmt2->execute();



                        if($stmt){



                        $this->tpl->set('message', 'GRN deleted successfully');



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


                    // $sqlsrr ="SELECT * FROM `$pedetail_tab`,`$pemaster_tab` WHERE `$pedetail_tab`.`purchaseentry_ID`=`$pemaster_tab`.`ID` AND `$pedetail_tab`.`purchaseentry_ID`='$data'";                    

                    // $pedetail_data = $dbutil->getSqlData($sqlsrr); 
                    
                     $sqlsrr ="SELECT `$pedetail_tab`.*,`$pemaster_tab`.*,`$supplier_tab`.`company` FROM `$pedetail_tab`,`$pemaster_tab`, `$supplier_tab` WHERE `$pedetail_tab`.`purchaseentry_ID`=`$pemaster_tab`.`ID` AND `$supplier_tab`.`ID` = `$pemaster_tab`.`supplier_ID` and  `$pedetail_tab`.`purchaseentry_ID`='$data'";

                    $pedetail_data = $dbutil->getSqlData($sqlsrr); 
                    
                    



                    $image= "SELECT ID,documentpath  From $peattachdetail_tab where (purchaseentry_ID  = '$data' AND documentname='images')"; 

                    $img = $dbutil->getSqlData($image);

                    $this->tpl->set('FmDataimage', $img);

                    

                    $documentsql= "SELECT ID,documentpath  From $peattachdetail_tab where (purchaseentry_ID  = '$data' AND documentname=documents')"; 

                    $document = $dbutil->getSqlData($documentsql);

                    $this->tpl->set('FmDatadocument', $document);



                    //edit option     


                    $this->tpl->set('message', 'You Can View GRN Form');



                    $this->tpl->set('page_header', 'Store');



                    $this->tpl->set('FmData', $pedetail_data); 



                    



                    $this->tpl->set('content', $this->tpl->fetch('factory/form/purchase_entry_form.php'));                    



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



                    $sqlsrr ="SELECT `$pedetail_tab`.*,`$pemaster_tab`.*,`$supplier_tab`.`company` FROM `$pedetail_tab`,`$pemaster_tab`, `$supplier_tab` WHERE `$pedetail_tab`.`purchaseentry_ID`=`$pemaster_tab`.`ID` AND `$supplier_tab`.`ID` = `$pemaster_tab`.`supplier_ID` and  `$pedetail_tab`.`purchaseentry_ID`='$data'";

                    $pedetail_data = $dbutil->getSqlData($sqlsrr); 
                    

                    $image= "SELECT ID,documentpath  From $peattachdetail_tab where (purchaseentry_ID  = '$data' AND documentname='images')"; 

                    $img = $dbutil->getSqlData($image);

                    $this->tpl->set('FmDataimage', $img);

                    

                    $documentsql= "SELECT ID,documentpath  From $peattachdetail_tab where (purchaseentry_ID  = '$data' AND documentname=documents')"; 

                    $document = $dbutil->getSqlData($documentsql);

                    $this->tpl->set('FmDatadocument', $document);



                    



                    //edit option     


                    if($mode=='Confirm'){
                  
                    $this->tpl->set('message', 'You Can Edit GRN Approval Form');
                    
                    }
                    else{

                    $this->tpl->set('message', 'You Can Edit GRN Form');
                   
                    
                    }

                     $this->tpl->set('page_header', 'Store');
                     
                    $this->tpl->set('FmData', $pedetail_data); 



                   



                    



                    $this->tpl->set('content', $this->tpl->fetch('factory/form/purchase_entry_form.php'));                    



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



                    $sqldet_del = "DELETE FROM $pedetail_tab WHERE purchaseentry_ID=$data";



                     //$maxcount= "SELECT MAX (purchaseentry_ID)  FROM $pedetail_tab Where ";



                    $stmt = $this->db->prepare($sqldet_del);



                    $stmt->execute();   



                            
 


                            try{



                              



                            $PurchaseEntryNo= $form_post_data['PurchaseEntryNo'];



                            $supplier_ID= $form_post_data['supplier_ID'];



                            $purchaseorder_ID= $form_post_data['purchaseorder_ID'];



                            $Tax= $form_post_data['Tax'];



                            $FreightAmount= $form_post_data['FreightAmount'];



                            $BillAmount= $form_post_data['BillAmount'];



                            $InvoiceNo= $form_post_data['InvoiceNo'];



                            $gateinfo_ID= $form_post_data['gateinfo_ID'];



                            $PurchaseEntryDate=date("Y-m-d", strtotime($form_post_data['PurchaseEntryDate']));



                            $DCNo= $form_post_data['DCNo'];



                            $LRNo= $form_post_data['LRNo'];



                            $Transporter= $form_post_data['Transporter'];



                            



                            $sql_update="Update $pemaster_tab set PurchaseEntryNo='$PurchaseEntryNo',supplier_ID='$supplier_ID',purchaseorder_ID='$purchaseorder_ID',Tax='$Tax',



                            FreightAmount='$FreightAmount',BillAmount='$BillAmount',InvoiceNo='$InvoiceNo',gateinfo_ID='$gateinfo_ID',PurchaseEntryDate='$PurchaseEntryDate',DCNo='$DCNo',LRNo='$LRNo',Transporter='$Transporter' WHERE ID=$data";



                            $stmt1 = $this->db->prepare($sql_update);



                            $stmt1->execute(); 

                                                  
                            $ID =$data;

                             
                               

                             if($stmt1->execute()){ 

                  

                                  $updateCustomer = array();

                            

                           // $updateCustomer['ID'] = $corp_form_post_data['ID']; 

                            

                              for($j=1;$j<=4;$j++)

                            {

                            foreach ($_FILES['files'.$j]['name'] as $i => $name) {

                                        if (strlen($_FILES['files'.$j]['name'][$i]) > 1) {

                                            $Fvalue='files'.$j;

                                           

                                            

                                             $uploadedFile = $util->handle_file_upload_backup($Fvalue, $ID,$i);

                                             

                                             if ($uploadedFile) {

                                   

                                  

                                     $updateCustomer[] = '`' . $Fvalue . '` =\'' . $uploadedFile . '\'';

                                     

                                    $filename='"' . $uploadedFile.'"'  ;

                                    $type="";

                                    if($j==2){

                                       $type="images";

                                    }

                                     if($j==3){

                                       $type="brochure";

                                    }

                                     if($j==4){

                                       $type="video";

                                    }

                                       

                                    

                                      $valStr= "'" .  $type . "'," .

                                            "" . $filename . "," .

                                          "'" . $ID . "'";

                                            

                              $sql = "INSERT INTO `" . $this->crg->get('table_prefix') . "purchaseentry_attachmentdetails` ("

                                . " `documentname`, `documentpath`,`purchaseentry_ID`) VALUES ( $valStr )";

                                          

                                // this need to be changed in to transaction type

                                 $stmt = $this->db->prepare($sql);

                                 $stmt->execute();

                                    

                              

                                   

                                }

                                             

                                             

                                    

                                }

                             }

                                 

                            }



                          



                             }





                        $entry_count = 1;



                        FOR ($entry_count; $entry_count <= $form_post_data['maxCount'];) {



                                



                                $ItemNo='ItemNo_'. $entry_count;


                                $ItemName='ItemName_'. $entry_count;
                                
                                
                                $rmtypeid='MaterialTypeid_'. $entry_count;


                                $rmtype='MaterialType_'. $entry_count;


                                $LotNo='Note_'. $entry_count;


                                $POQuantity='Quantity_'. $entry_count;


                                $ActualQuantity='Water_'. $entry_count;


                                $unit='Rat_'. $entry_count;


                                $acceptedquantity='EmpName_'. $entry_count;


                                $rejectedquantity='Amount_'. $entry_count;

                                

                                $quantity='qty_'. $entry_count;



                               $vals = "'" . $data . "'," .



                                         "'" . $form_post_data[$ItemName] . "'," . 



                                         "'" . $form_post_data[$ItemNo] . "'," .
                                         
                                         
                                         "'" . $form_post_data[$rmtypeid] . "'," . 



                                         "'" . $form_post_data[$rmtype] . "'," .



                                         "'" . $form_post_data[$LotNo] . "'," . 



                                         "'" . $form_post_data[$POQuantity] . "'," . 



                                         "'" . $form_post_data[$ActualQuantity] . "'," . 



                                         "'" . $form_post_data[$unit] . "'," . 

                                         

                                         "'" . $form_post_data[$acceptedquantity] . "'," . 

                                         

                                          "'" . $form_post_data[$rejectedquantity] ."'" ; 

                                         

 

 

                                 



                                 $sql2 = "INSERT INTO $pedetail_tab



                            ( 



                            `purchaseentry_ID`,



                            `rawmaterial_ID`, 



                            `RMName`,
                            
                            
                            `rawmaterialtype_ID`, 



                            `RMType`,



                            `LotNo`,



                            `POQuantity`, 



                            `ActualQty`,



                            `unit_ID`,

                            

                           `AcceptedQty`,



                           `RejectedQty`



                           



                            ) 



                                VALUES ($vals)";







                                $stmt = $this->db->prepare($sql2);



                                $stmt->execute();



                                



                                // *************** stock update******************** //



                            // commented by me on19.03.2020 need to confirm with fakeer ji   $sql = "UPDATE $stock_tab SET $stock_tab.TotalQty=$stock_tab.TotalQty-$form_post_data[$ActualQuantity] WHERE $stock_tab.ItemNo='$form_post_data[$ItemName]' AND  $stock_tab.LotNo='$form_post_data[$LotNo]'";



                            // $stmt = $this->db->prepare($sql);



                            // $stmt->execute();



                                



                            //increment here



                            $entry_count++;



                            }





                                if($form_post_data['PurchaseEntryNo']){



                                $userID = $this->ses->get('user')['ID'];



                                $entityID = $this->ses->get('user')['entity_ID'];



                                 $sql_query_proc = "CALL pStockUpdate( @iRet, $data, $entityID, $userID)";   



                                $stmt = $this->db->prepare($sql_query_proc);                        



                                $stmt->execute();



                                }



                            $this->tpl->set('message', 'GRN Form Edited Successfully!');   



                            $this->tpl->set('label', 'List');



                            $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));



                            } catch (Exception $exc) {



                             //edit failed option



                            $this->tpl->set('message', 'Failed To Edit, Try Again!');



                            $this->tpl->set('FmData', $form_post_data);



                            $this->tpl->set('content', $this->tpl->fetch('factory/form/purchase_entry_form.php'));



                            }



                    break;



                 case 'confirm':



                    if (isset($crud_string)) {



                            $form_post_data = $dbutil->arrFltr($_POST);



                                               




                            $data=$form_post_data['ycs_ID'];



                            $supplier_ID=$form_post_data['supplier_ID'];


                            $purchaseentryno= $form_post_data['PurchaseEntryNo'];





                            $sql_update="Update $approvalprocess_tab set ApprovalStatus=1 WHERE process_ID=$data and ProcessType='GRN Approval'";



                            $stmt1 = $this->db->prepare($sql_update);



                            $stmt1->execute();



                            



                            $sql_update="Update $pemaster_tab set Stage='Approved' WHERE $pemaster_tab.supplier_ID=$supplier_ID";



                            $stmt = $this->db->prepare($sql_update);



                            $stmt->execute();





                            $this->tpl->set('message', 'GRN Confirmed successfully!');   



                            $this->tpl->set('label', 'List');



                            $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));





                            $sqldet_del = "DELETE FROM $pedetail_tab WHERE purchaseentry_ID=$data";



                            $stmt = $this->db->prepare($sqldet_del);



                            $stmt->execute();   


                        $entry_count = 1;



                        FOR ($entry_count; $entry_count <= $form_post_data['maxCount'];) {




                                $ItemNo='ItemNo_'. $entry_count;



                                $ItemName='ItemName_'. $entry_count;
                                
                                
                                $rmtypeid='MaterialTypeid_'. $entry_count;


                                $rmtype='MaterialType_'. $entry_count;


                                $LotNo='Note_'. $entry_count;



                                $POQuantity='Quantity_'. $entry_count;



                                $ActualQuantity='Water_'. $entry_count;



                                $unit='Rat_'. $entry_count;



                                $acceptedquantity='EmpName_'. $entry_count;



                                $rejectedquantity='Amount_'. $entry_count;




                               $vals = "'" . $data . "'," .



                                         "'" . $form_post_data[$ItemName] . "'," . 



                                         "'" . $form_post_data[$ItemNo] . "'," .
                                         
                                         
                                         
                                         "'" . $form_post_data[$rmtypeid] . "'," . 



                                         "'" . $form_post_data[$rmtype] . "'," .



                                         "'" . $form_post_data[$LotNo] . "'," . 



                                         "'" . $form_post_data[$POQuantity] . "'," . 



                                         "'" . $form_post_data[$ActualQuantity] . "'," . 



                                         "'" . $form_post_data[$unit] . "'," . 



                                         "'" . $form_post_data[$acceptedquantity] . "'," . 



                                         "'" . $form_post_data[$rejectedquantity] ."'" ;  

                                $sql2 = "INSERT INTO $pedetail_tab



                                ( 



                                `purchaseentry_ID`,

                                `rawmaterial_ID`, 

                                `RMName`,
                                
                                `rawmaterialtype_ID`, 
                                
                                `RMType`,

                                `LotNo`,

                                `POQuantity`, 

                                `ActualQty`,

                                `unit_ID`,

                                `AcceptedQty`,

                                `RejectedQty`)



                                VALUES ($vals)";




                                $stmt = $this->db->prepare($sql2);



                                $stmt->execute();



                            //increment here



                            $entry_count++;



                            }



                          // var_dump($data); 



                             if($form_post_data['PurchaseEntryNo']){



                        $userID = $this->ses->get('user')['ID'];



                        $entityID = $this->ses->get('user')['entity_ID'];



                         $sql_query_proc = "CALL pStockUpdate( @iRet, $data, $entityID, $userID)";   



                        $stmt = $this->db->prepare($sql_query_proc);                        



                        $stmt->execute();



                        }



                    }

                    



                    break;



                    



                case 'addsubmit':

                    

                    include_once 'util/genUtil.php';



                    $util = new GenUtil();



                     if (isset($crud_string)) {



                        $form_post_data = $dbutil->arrFltr($_POST);


              



                        $entry_count = 1;



                            if (isset($form_post_data['purchaseorder_ID'])) {





                                        $val = "'" . $form_post_data['PurchaseEntryNo'] . "'," .



                                         "'" . $form_post_data['supplier_ID'] . "'," .



                                         "'" . $form_post_data['purchaseorder_ID'] . "'," .



                                         "'" . $form_post_data['Tax'] . "'," .



                                         "'" . $form_post_data['FreightAmount'] . "'," .



                                         "'" . $form_post_data['BillAmount'] . "'," .



                                         "'" . $form_post_data['InvoiceNo'] . "'," .



                                         "'" . $form_post_data['gateinfo_ID'] . "'," .



                                         "'" . date("Y-m-d", strtotime($form_post_data['PurchaseEntryDate'])) . "'," .



                                         "'" . $form_post_data['DCNo'] . "'," .



                                         "'" . $form_post_data['LRNo'] . "'," .



                                         "'" . $form_post_data['Transporter'] . "'," .



                                         "'" .  $this->ses->get('user')['entity_ID'] . "'," .



                                         "'" .  $this->ses->get('user')['ID'] . "'";







                                   $sql = "INSERT INTO `" . $this->crg->get('table_prefix') . "purchaseentry`



                                            ( 



                                            `PurchaseEntryNo`, 



                                            `supplier_ID`, 



                                            `purchaseorder_ID`,



                                            `Tax`, 



                                            `FreightAmount`, 



                                            `BillAmount`, 



                                            `InvoiceNo`,



                                            `gateinfo_ID`,



                                            `PurchaseEntryDate`,



                                            `DCNo`,



                                            `LRNo`, 



                                            `Transporter`,



                                            `entity_ID`, 



                                            `users_ID`



                                            ) 



                                        VALUES ( $val )";



                                  $stmt = $this->db->prepare($sql);

                                  $result=$stmt->execute();

                                  



                                  



                    if ($result) { 



                        $lastInsertedID = $this->db->lastInsertId();



                        FOR ($entry_count; $entry_count <= $form_post_data['maxCount'];) {



                                $ItemName='ItemName_'. $entry_count;

                               
                                $ItemNo='ItemNo_'. $entry_count;
                                
                                $rmtype='MaterialType_'. $entry_count;

                                
                                $rmtypeid='MaterialTypeid_'. $entry_count;


                                $LotNo='Note_'. $entry_count;


                                $POQuantity='Quantity_'. $entry_count;


                                $ActualQuantity='Water_'. $entry_count;

                               
                                $unit='Rat_'. $entry_count;



                                //$Quantity='Quantity_'. $entry_count;



                                //$AcceptedQuantity='EmpName_'. $entry_count;



                                //$RejectedQuantity='Amount_'. $entry_count; 




                                $vals = "'" . $lastInsertedID . "'," .



                                         "'" . $form_post_data[$ItemName] . "'," . 

                                         "'" . $form_post_data[$ItemNo] . "'," .
                                         
                                         "'" . $form_post_data[$rmtype] . "'," .
                                         
                                         "'" . $form_post_data[$rmtypeid] . "'," . 

                                         "'" . $form_post_data[$LotNo] . "'," . 

                                         "'" . $form_post_data[$POQuantity] . "'," . 

                                         "'" . $form_post_data[$ActualQuantity] . "'," . 

                                         "'" . $form_post_data[$unit] ."'";



                                        



                                         /*



                                         "'" . $form_post_data[$AcceptedQuantity] . "'," . 



                                         "'" . $form_post_data[$RejectedQuantity] . "'";



                                         */



                                       



                                         //"'" . $form_post_data[$Temp] . "'";



                                 



                     $sql2 = "INSERT INTO $pedetail_tab



                                        (



                            `purchaseentry_ID`,



                            `RMName`,
                            

                            `rawmaterial_ID`,
                            
                            
                            `RMType`,
                            
                            
                            `rawmaterialtype_ID`,


                            `LotNo`,


                            `POQuantity`,


                            `ActualQty`,


                            `unit_ID`



                           



                            ) 



                                VALUES ($vals)";







                                 // this need to be changed in to transaction type



                                



                                $stmt = $this->db->prepare($sql2);



                                $result=$stmt->execute();



                                  //increment here



                                $entry_count++;



                      



                            }

                    

                    

                            if($result) {

                                

                                

                        

                        $updateCustomer = array();

                            

                           

                            

                              for($j=1;$j<=4;$j++)

                                      {

                                           

                                           

                            foreach ($_FILES['files'.$j]['name'] as $i => $name) {

                                

                                        if (strlen($_FILES['files'.$j]['name'][$i]) > 1) {

                                            

                                            $Fvalue='files'.$j;

                                           
                                          

                                             $uploadedFile = $util->handle_file_upload_backup($Fvalue,$lastInsertedID,$i);

                                             

                                             

                                              

                                             if ($uploadedFile) {

                                   

                                  

                                     $updateCustomer[] = '`' . $Fvalue . '` =\'' . $uploadedFile . '\'';

                                     

                               

                                     

                                    $filename='"' . $uploadedFile.'"';

                                    

                                    $type="";

                                    if($j==2){

                                       $type="images";

                                    }

                                     if($j==3){

                                       $type="brochure";

                                    }

                                     if($j==4){

                                       $type="video";

                                    }

                                    

                                    

                                      $valStr= "'" .  $type . "'," .

                                            "" . $filename . "," .

                                          "'" . $lastInsertedID . "'";

                                            

                              $sql = "INSERT INTO `" . $this->crg->get('table_prefix') . "purchaseentry_attachmentdetails` ("

                                . " `documentname`, `documentpath`,`purchaseentry_ID`) VALUES ( $valStr )";

                                          

                                // this need to be changed in to transaction type

                                $stmt = $this->db->prepare($sql);

                                $stmt->execute();

                                    
                              
                                   

                                }

                                             

                                             

                                    

                                }

                             }

                            }

                          

                    } 

                      



                        //      if($form_post_data['PurchaseEntryNo']){



                        // $userID = $this->ses->get('user')['ID'];



                        // $entityID = $this->ses->get('user')['entity_ID'];



                        //  $sql_query_proc = "CALL pStockUpdate( @iRet, $lastInsertedID, $entityID, $userID)";   



                        // $stmt = $this->db->prepare($sql_query_proc);                        



                        // $stmt->execute();



                        // }



                        



                            //update purchase order status to qa



                            $sql = "UPDATE $po_tab SET Stage='qa' WHERE ID=".$form_post_data['purchaseorder_ID']."";



                            $stmt = $this->db->prepare($sql);



                            $stmt->execute();



                            



                             $dbutil->ApprovalProcess('GRN Approval',$approve[0][0],$lastInsertedID);



                          



                    



                        
                        
                    }

                            }



                        $this->tpl->set('mode', 'add');



                        $this->tpl->set('message', '- Success -');
                        
                        $entity_short_code = $this->ses->get('user')['short_code'];
    
                        $start='KI/ST';
    
                        $newPONumber = $dbutil->keyGenerate('purchaseentry', 'GRN','PurchaseEntryNo',$start);  
    
    

                     $this->tpl->set('po_number', $newPONumber);

                     $this->tpl->set('label', 'List');

                     $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));

                        //$this->tpl->set('content', $this->tpl->fetch('factory/form/purchase_entry_form.php'));



                     } else {



                            //edit option



                            //if submit failed to insert form



                            $this->tpl->set('message', 'Failed to submit!');



                            $this->tpl->set('FmData', $form_post_data);



                             //add new purchase order 



                    // $entity_short_code = $this->ses->get('user')['short_code'];



                    // $newPONumber = $dbutil->keyGenerateee('purchaseentry', 'GRN', $entity_short_code,'PurchaseEntryNo');  



                    // $this->tpl->set('po_number', $newPONumber);



                            $this->tpl->set('content', $this->tpl->fetch('factory/form/purchase_entry_form.php'));



                     }



                    break;



                case 'add':



                    $this->tpl->set('mode', 'add');



	                $this->tpl->set('page_header', 'Store');



	                //add new purchase order 



                    $entity_short_code = $this->ses->get('user')['short_code'];
                    
                    $start='KI/ST';

                    $newPONumber = $dbutil->keyGenerate('purchaseentry', 'GRN','PurchaseEntryNo',$start);  



                    $this->tpl->set('po_number', $newPONumber);



                    $this->tpl->set('content', $this->tpl->fetch('factory/form/purchase_entry_form.php'));



                    break;







                default:



                    /*



                     * List form



                     */



                     



                    ////////////////////start//////////////////////////////////////////////



                    



           //bUILD SQL 



            $whereString = '';



            



   $colArr = array(



       



                "$pemaster_tab.ID",



                "$pemaster_tab.PurchaseEntryNo",



                "$supplier_tab.Company ",



                "$po_tab.PurchaseOrderNo",



                "$pemaster_tab.InvoiceNo",



                "$gateinfo_tab.GateNo",



                "DATE_FORMAT($pemaster_tab.PurchaseEntryDate, '%d-%m-%Y') AS PurchaseEntryDate",



                "$pemaster_tab.LRNo",



                // "$pemaster_tab.DCNo",



                "$pemaster_tab.Transporter"



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



             $whereString ="ORDER BY $pemaster_tab.ID DESC";



           }



            



          



         $sql = "SELECT "



                    . implode(',',$colArr)



                    . " FROM $pemaster_tab,$supplier_tab,$po_tab,$gateinfo_tab "



                    . " WHERE "



                    . " $supplier_tab.ID= $pemaster_tab.supplier_ID AND "



                    . " $po_tab.ID= $pemaster_tab.purchaseorder_ID AND "



                    . " $gateinfo_tab.ID= $pemaster_tab.gateinfo_ID AND "



                    //. "$payment_tab.ID= $pemaster_tab.PaymentMode AND "



                    . " $pemaster_tab.entity_ID = $entityID "



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




            $this->tpl->set('table_columns_label_arr', array('ID','PurchaseEntry No','Supplier Name','PurchaseOrder No','Invoice No','Gate No','Date','LR No','Transporter'));



            



            /*



             * selectColArr for filter form



             */



            



            $this->tpl->set('selectColArr',$colArr);



                        



            /*



             * set pagination template



             */



            $this->crg->set('paginationListTemplate','factory/template/sql_based_crud_paginated_table.php');



                   



            //////////////////////close//////////////////////////////////////  



                     



                    include_once $this->tpl->path . '/factory/form/purchase_entry_crud_form.php';



                    $cus_form_data = Form_Elements::data($this->crg);



                    include_once 'util/crud3_1.php';



                    new Crud3($this->crg, $cus_form_data);



                    break;



            }

                 $this->tpl->set('master_layout', 'layout_datepicker.php');





	    ///////////////Use different template////////////////////



	   // $this->tpl->set('master_layout', 'layout_datepicker.php'); 



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

