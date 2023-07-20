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
        $this->tpl->set('form_title', $this->formConfig['form_title']);

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

        // echo $crud_string;
        switch ($crud_string) {
            case 'view':
                return $this->view();
                break;
            case 'edit':

                $yid = $_POST['ycs_ID'];
                if ($yid) {
                    //bUILD SQL 
                    $table1 = $this->crg->get('table_prefix') . 'customer';

                    $colArr = array(
                        "$table1.SGuserRegStatus"
                    );

                    $yid = $this->db->quote($yid);

                    $sql = "SELECT "
                            . implode(',', $colArr)
                            . " FROM $table1"
                            . " WHERE "
                            . " $table1.ID = $yid  Limit 1";

                    $stmt = $this->db->prepare($sql);
                    $stmt->execute();
                    $rowData = $stmt->fetch(2);
                }

                if ($rowData['SGuserRegStatus'] !== 'YES') {
                    $myForm = new FF($this->crg, $this->formConfig);
                    return $myForm->edit();
                } else {
                    //redirect to edit profile option
                    //with message that you cant edit the pass word locally
                }
                break;
            case 'submit':

                $myForm = new FF($this->crg, $this->formConfig);

                if ($crud_form_submit_from_a_form == 'edit') {
                    return $myForm->submit_edit_form();
                }

                break;
            case 'delete':
                return $this->delete();
                break;
            case 'register with smartguard':
                return $this->sgUserReg();
                break;
            case 'list':
            default:
                return $this->paginate();
                break;
        }
    }

/////////////////////////////////////////

    protected function sgUserReg() {
        $yid = $_POST['ycs_ID'];
        if ($yid) {
            //bUILD SQL 
            $table1 = $this->crg->get('table_prefix') . 'customer';
            $table2 = $this->crg->get('table_prefix') . 'package';
            $colArr = array(
                "$table1.FirstName",
                "$table1.Location",
                "$table1.SGloginID",
                "$table1.SGpassword",
                "$table1.IPAllocationType",
                "$table1.IPType",
                "$table1.EquipmentIp",
                "$table1.Gateway",
                "$table1.AuthenticateUser",
                "$table2.SMPackName",
                "$table1.SGuserRegStatus",
                "$table1.MobileNo",
                "$table1.Email",
                "$table1.SAddress",
                "$table1.SCity",
                "$table1.SPincode",
                "$table1.SState",
            );

            $yid = $this->db->quote($yid);

            $sql = "SELECT "
                    . implode(',', $colArr)
                    . " FROM $table1,$table2"
                    . " WHERE "
                    . " $table1.ID = $yid  AND "
                    . " $table2.ID = $table1.package_ID  "
                    . "Limit 1";

            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $rowData = $stmt->fetch(2);
        }

        if ($rowData['SGuserRegStatus'] !== 'YES' && $rowData['SGloginID'] !== '' && $rowData['SMPackName'] !== '' && $rowData['SMPackName'] !== NULL) {
          
///////////////////////////////////////////////////////            
            //call api to register /change 1 starts here
	   $u_SGServerIP = $this->ses->get('user')['SGServerIP'];
           
           //get smart gaurd package data from registry set in the funtion where this crud class is called 
          $SG_Package_arr = $this->crg->get('SGpackageDataArr');
          $SG_Pac_Valid_arr = $this->crg->get('SGpacValidityArr');
          
	  //check whether a valid ip
	  $valid = filter_var($u_SGServerIP, FILTER_VALIDATE_IP);
          
          $application_ip=$this->tpl->get('application_ip');
 
         if ($u_SGServerIP !== '' && $u_SGServerIP !== NULL && $valid) {

             $urlMaster = "http://".$u_SGServerIP."/sg_api/custom_responce.php?sgdata=";
////////////////////////////////////////////
                  $url = "order_type=1";
                  $url .= "&requester=$application_ip";
                  $url .= "&authkey=sguregp";                  
                  $url .= "&login_id=" . $rowData['SGloginID'];
                  $url .= "&password=" . $rowData['SGpassword'];
                  $url .= "&mobile=" . $rowData['MobileNo'];
                  $url .= "&firstname=" . $rowData['FirstName'];
                  $url .= "&lastname=" . $rowData['Location'];
                  $url .= "&emailid=" . $rowData['Email'];
                  $url .= "&address=" . $rowData['SAddress'] .';'. $rowData['SCity'].' - '. $rowData['SPincode'] .';'. $rowData['SState'];
                  $url .= "&package_name=" . $SG_Package_arr[$rowData['SMPackName']];
                  $url .= "&authenticate_user=" . $rowData['AuthenticateUser'];
                  $url .= "&ip_allocation_type=" . $rowData['IPAllocationType'];
                  $url .= "&ip_type=" . $rowData['IPType'];
                  $url .= "&user_ip=" . $rowData['EquipmentIp'];
                  $url .= "&gateway=" . $rowData['Gateway'];
                  
                  //var_dump($url);
                  
             $encUrl = base64_encode($url);

               $urlMaster .= $encUrl;

            try {
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $urlMaster);
                curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                curl_setopt($ch, CURLOPT_TIMEOUT, 5);
                $data = curl_exec($ch);
                $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);

                ($httpcode >= 200 && $httpcode < 300) ? $responceData = $data : false;
            } catch (Exception $exc) {
                $responceData = FALSE;
            }
////////////change 2//////////////////
	}else{
                $this->tpl->set('message', 'Smart Gaurd IP is not set to this user or user not loged in');
            }
/////////////////////////////
            //////////////Responce process/////////////////////////////
            if ($responceData) {

                $responcedataArr = explode('#', $responceData);

                switch ($responcedataArr[0]) {
                    case 'Status:Success':
                        
                        $pacValidity = $SG_Pac_Valid_arr[$rowData['SMPackName']];
                        $pacValidity = strtolower($pacValidity);
                        
                            if($pacValidity == "1 month validity"){
                                $pacValid = "1 MONTH";
                            }elseif ($pacValidity == "3 month validity") {
                                $pacValid = "3 MONTH";
                            }elseif ($pacValidity == "6 month validity") {
                                $pacValid = "6 MONTH";
                            }elseif ($pacValidity == "1 year validity") {
                                $pacValid = "1 YEAR";
                            }elseif ($pacValidity == "1 hour demo") {
                                $pacValid = "1 HOUR";
                            }
                            
                            $regdate = date("Y-m-d H:i:s");
                            
                               $sql = "UPDATE $table1 SET $table1.SGuserRegStatus = 'YES' , $table1.SGuserRegDate = '$regdate',"
                                    . "$table1.PackStartDate= '$regdate',"
                                    . "$table1.PackExpireDate = DATE_ADD('$regdate', INTERVAL $pacValid)"
                                    . "WHERE $table1.ID = $yid";
                        
                        try {
                            $stmt = $this->db->prepare($sql);
                            $stmt->execute();                            
                            $stmt->closeCursor();
                            
                            $sqlcus= "SELECT $table1.FirstName,$table1.MobileNo,$table2.SMPackName FROM $table1,$table2 WHERE $table1.ID = $yid AND $table1.package_ID=$table2.ID";            
            		    $otherstmt = $this->db->prepare($sqlcus);            
            		    $result = $otherstmt->execute();
                            $cust_data  = $otherstmt->fetchAll();
                            
                            $cust_mobileno = $cust_data[0]['MobileNo'];
                            $cus_name=$cust_data[0]['FirstName'];                                                       
			    $cus_nam_arr = preg_split("/[\s]+/",$cus_name);	
                            $cust_fname =  implode("+", $cus_nam_arr);
                            
                            $pac= $SG_Package_arr{$cust_data[0]['SMPackName']};
                            $pac_arr = preg_split("/[\s]+/",$pac);
                            $cust_pack = implode("+",$pac_arr);                            

                            $CustomerMobileNo = trim($cust_mobileno);
                            

                        if (!empty($CustomerMobileNo) && preg_match('/^\d{10}$/', $CustomerMobileNo)) {                           

                            $smsMessage = 'Dear+' . $cust_fname . '!.+U+r+Successfully+Registered+as+new+customer+in+SP+Internet+Technologies+on+' . date("j+M+Y+g:i+a.") . '+And+ur+Pack+is+"' . $cust_pack .'"';

                            include_once 'lib/util/curl.php';

                            $httpSms = new httpCurl();
                            if ($httpSms->smssigma($CustomerMobileNo, $smsMessage)) {                            
                                
                                $entityID = $this->ses->get('user')['entity_ID']; 
                                $entity_tab = $this->crg->get('table_prefix') . 'entity';
                                $users_tab = $this->crg->get('table_prefix') . 'users';
                                $usertype_tab = $this->crg->get('table_prefix') . 'usertype';
                                
                                $sql_query = "SELECT $entity_tab.Title,$entity_tab.SMSToAdmin,$users_tab.user_mobileno AS AdMobileNo "
                                        . "FROM $users_tab LEFT JOIN $entity_tab "
                                        . "ON $users_tab.entity_ID = $entity_tab.ID "
                                        . "LEFT JOIN $usertype_tab ON $users_tab.usertype_ID =$usertype_tab.ID "
                                        . "WHERE $entity_tab.ID = $entityID  AND $usertype_tab.Title LIKE 'admin'";
                                                              
                                $stmt = $this->db->prepare($sql_query);
                                $stmt->execute();
                                $smsAdmData = $stmt->fetch(2);
                                //var_dump($smsAdmData);
                                if($smsAdmData['SMSToAdmin']=='Y'){ 
                                    $AdMobNo = trim($smsAdmData['AdMobileNo']);                          
                                    $admEntityName = $smsAdmData['Title'];
                                    
                                    if (!empty($AdMobNo) && preg_match('/^\d{10}$/', $AdMobNo)){
                                        $smsAdmMessage = 'Dear+' . $admEntityName . '+Admin!.+New+Customer+' . $cust_fname . '+is+Successfully+Registered+in+SmartGuard+on+' . date("j+M+Y+g:i+a.") . '+And+Customer+Pack+is+"' . $cust_pack .'"';
                                        
                                         if ($httpSms->smssigma($AdMobNo, $smsAdmMessage)) {
                                             $this->tpl->set('message', $responcedataArr[1] . ' and SGuserRegStatus updated, SMS is sent to Customer and also to Entity Admin if selected YES in Entity Form');
                                             }
                                             else{
                                             $this->tpl->set('message', $responcedataArr[1] . ' and SGuserRegStatus updated, SMS is sent to Customer and not sent to Entity Admin. Please check Entity Admin MobileNo.');  
                                             }
                                         }                               
                                }
                                
                            }
                        } else {

                            $this->tpl->set('message', $responcedataArr[1] . 'Customer MobileNo. is Invalid, Please Check or enter Valid MobileNo.');
                        }                            
                        }catch (Exception $exc) {
                            $this->tpl->set('message', $responcedataArr[1] . ' and SGuserRegStatus Update Failed & SMS is not sent to Customer, Try Again');
                        }


                        break;
                    case 'Status:Failed':
                        if ($responceData[1] == 'Login Id already registered') {

                            $sql = "UPDATE $table1 SET $table1.SGuserRegStatus = 'YES' WHERE $table1.ID = $yid";

                            try {
                                $stmt = $this->db->prepare($sql);
                                $stmt->execute();
                                $this->tpl->set('message', $responcedataArr[1] . ' and SGuserRegStatus Update Successfull');
                            } catch (Exception $exc) {
                                $this->tpl->set('message', $responcedataArr[1] . ' and SGuserRegStatus Update Failed, Try Again');
                            }
                        } else {
                            $this->tpl->set('message', $responcedataArr[1]);
                        }
                        break;
                    default:
                        $this->tpl->set('message', 'No responce data');
                        break;
                }
            } else {
                $this->tpl->set('message', 'No responce data - Smartguard not responding');
            }
        } else {
            $this->tpl->set('message', 'No Login ID or Package');
        }

        $this->tpl->set('label', 'Go back to List');
        $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
        return;
    }

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
//smartgaurd reg process
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


        foreach ($this->formConfig['form_content'] as $key => $value) {
            if (trim($key)) {
                $table_columns_to_select[] = trim($key);
            }
        }


        //more conditoins can be added here
        //$where_condition .= " Limit $limit";
        //$table_columns_to_select
        //to colum string
        $tcts = " `";
        $tcts .= implode("`,`", $table_columns_to_select);
        $tcts .= "` ";
        ///////////////////////////////




        /*
         * get content of an id to view
         */
        try {

            if ($data) {
                $where_condition = " WHERE `ID` = '" . $data . "'";

                $where_condition .= " Limit 1";

                $sql_query = "SELECT $tcts FROM `$actual_table_name` $where_condition";



                $stmt = $this->db->prepare($sql_query);
                $stmt->execute();
                $Data_rows = $stmt->fetchAll(2);


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
                    $this->tpl->set('value', $Data_rows[0][$key]);
                    $this->tpl->set('label', $value['label']);

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
                }



                ////////////////////////////////////////////////////////////////////
                ////////////////////////form footer////////////////////////////////
                //////////////////////////////////////////////////////////////////
                $form_footer_master = '';
                $this->tpl->set('name', $this->formConfig['form_footer']['list']);
                $this->tpl->set('label', $this->formConfig['form_footer']['list']['label']);
                $form_footer_master .= $this->tpl->fetch('factory/template/form_button_link.php');
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
                        $where_condition[] = $value;
                    }
                } else {
                    $where_condition[] = $value;
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
