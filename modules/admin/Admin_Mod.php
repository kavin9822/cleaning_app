<?php

/**
 * Description of Customer_Mod
 *
 * @author psmahadevan
 */
class Admin_Mod {

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

    function entity() {
        if ($this->crg->get('wp') || $this->crg->get('rp')) {
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////access condition applied///////////////////////////
////////////////////////////////////////////////////////////////////////////////            
            include_once $this->tpl->path . '/factory/form/entity_form.php';
            $cus_form_data = Form_Elements::data($this->crg);
            include_once 'util/crud3.php';
            new Crud3($this->crg, $cus_form_data);

            //////////////////////////////on access condition failed then ///////////////////////////
        } else {
            if ($this->ses->get('user')['ID']) {
                $this->tpl->set('content', $this->tpl->fetch('modules/user/acess_failed_message.php'));
            } else {
                header('Location:' . $this->crg->get('route')['base_path'] . '/user/auth/login');
            }
        }
    }

    //////////////////entity close here//////////////////

    function userRole() {
        if ($this->crg->get('wp') || $this->crg->get('rp')) {

//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////access condition applied///////////////////////////
////////////////////////////////////////////////////////////////////////////////    
            
            if (isset($_POST['user_id']) && isset($_POST['role_ID'])) {
                $ui = $_POST['user_id'];
                $ri = $_POST['role_ID'];

                $actual_table_name = $this->crg->get('table_prefix') . 'userroles';

                $sql_query = "INSERT INTO `" . $actual_table_name . "`(`UserID`, `RoleID`, `AssignmentDate`) " .
                        "VALUES ('" . $ui . "','" . $ri . "','" . time() . "')";

                try {
                    $stmt = $this->db->prepare($sql_query);
                    if ($stmt->execute()) {
                        $this->tpl->set('message', 'User Role assigned successfully');
                    }
                    //        $Data_rows = $stmt->fetchAll(2);
                } catch (Exception $exc) {
                    $Data_rows = FALSE;
                }
            }

            $this->tpl->set('page_title', 'User Role Setting');

            include_once 'util/DBUTIL.php';
            $dbUtil = new DBUTIL($this->crg);

            $usrData = $dbUtil->selectKeyVal('users', 'ID', 'user_nicename');
            $this->tpl->set('user_data', $usrData);
            $userRoleData = array();
            foreach ($usrData as $uID => $uName) {
                $userRoleData[] = array(
                    'ID' => $uID,
                    'user_nicename' => $uName,
                    'Roles' => $this->rbac->Users->allRoles($uID)
                );
            }



            $this->tpl->set('userRoleData', $userRoleData);
            //role_data
            $roleData = $dbUtil->selectKeyVal('roles');
            $this->tpl->set('role_data', $roleData);


            $this->tpl->set('content', $this->tpl->fetch('factory/form/user_role.php'));

            //////////////////////////////on access condition failed then ///////////////////////////
        } else {
            if ($this->ses->get('user')['ID']) {
                $this->tpl->set('content', $this->tpl->fetch('modules/user/acess_failed_message.php'));
            } else {
                header('Location:' . $this->crg->get('route')['base_path'] . '/user/auth/login');
            }
        }
    }

    public function unassign() {
        if ($this->crg->get('wp') || $this->crg->get('rp')) {

//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////access condition applied///////////////////////////
////////////////////////////////////////////////////////////////////////////////    
            //////////////////////////////on access condition failed then ///////////////////////////
            //public bool Rbac->Users->unassign(mixed $Role, int $UserID = null)
            //user id
            //$this->crg->get('route')['crud']
            // role id
            //$this->crg->get('route')['crud_form_submit_from']
            if ($this->crg->get('route')['crud'] && $this->crg->get('route')['crud_form_submit_from']) {
                $this->rbac->Users->unassign($this->crg->get('route')['crud_form_submit_from'], $this->crg->get('route')['crud']);
               header('Location:' . $this->crg->get('route')['base_path'] . '/admin/adm/userRole');
            }
        } else {
            if ($this->ses->get('user')['ID']) {
                $this->tpl->set('content', $this->tpl->fetch('modules/user/acess_failed_message.php'));
            } else {
                header('Location:' . $this->crg->get('route')['base_path'] . '/user/auth/login');
            }
        }
    }
    
    function marketingsms() {
        if ($this->crg->get('wp') || $this->crg->get('rp')) {
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////access condition applied///////////////////////////
//////////////////////////////////////////////////////////////////////////////// 
	   
            include_once 'lib/util/DBUTIL.php';
            $dbutil = new DBUTIL($this->crg);
            
            ///////////////////entity select box data///////////////////////             
            $entity_table = $this->crg->get('table_prefix') . 'entity'; 
            $sql= "SELECT ID, Title, SGServerIP FROM $entity_table";                               
            $allentity  = $dbutil->getSqlData($sql,2); 
            $formatted = [];
	    foreach($allentity as $v){
                $formatted[$v['ID']] = implode(' | ', $v);
            }         
	    $this->tpl->set('entity_data', $formatted);	    
	    //////////entity select box data ends///////////////////////////
	    ///////////////////customer type select box data///////////////////////             
            $cust_type_table = $this->crg->get('table_prefix') . 'customertype'; 
            $ctype_sql= "SELECT ID, Title FROM $cust_type_table";                               
            $cust_type  = $dbutil->getSqlData($ctype_sql,12);           
	    $this->tpl->set('cust_type', $cust_type);	    
	    ///////////customer typeselect box data ends///////////////////////////// 
       	    $form_post_data = $dbutil->arrFltr($_POST);       	    
       	    $entityId = $form_post_data['EntityID']; 
       	    $customerType = $form_post_data['customer_type']; 
       	    $customerStatus = $form_post_data['customer_status']; 
       	    $message = $form_post_data['message'];
       	    $cust_table = $this->crg->get('table_prefix') . 'customer';
       	    if($entityId==="AllEntity"){
       	      $sql_sms="SELECT MobileNo FROM $cust_table";
       	    }elseif(isset($customerType) && $customerStatus!=="All"){
       	      $sql_sms="SELECT MobileNo FROM $cust_table WHERE customertype_ID=$customerType AND CustStatus=$customerStatus AND entity_ID=$entityId";
       	    }elseif(isset($customerType) && $customerStatus==="All"){
 	      $sql_sms="SELECT MobileNo FROM $cust_table WHERE customertype_ID=$customerType AND entity_ID=$entityId";
       	    }        	    
                try {
                    $stmt = $this->db->prepare($sql_sms);
                    if ($stmt->execute()) {
                        $Data_rows = $stmt->fetchAll(7);
                    } 
                } catch (Exception $exc) {
                    $Data_rows = FALSE;
                }
       	  // $datacount = count($Data_rows);
       	   
       	 // for($i=0;$i=$datacount;i++){
       	   
       	 // }
       	    

            $this->tpl->set('content', $this->tpl->fetch('factory/form/marketing_sms.php'));

            //////////////////////////////on access condition failed then ///////////////////////////
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
}
