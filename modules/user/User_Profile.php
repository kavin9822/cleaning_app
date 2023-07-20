<?php

/**
 * Description of Customer_Mod
 *
 * @author psmahadevan
 */
class User_Profile {

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

    //////////////////user type start here//////////////////

    function view() {
        if ($this->crg->get('wp') || $this->crg->get('rp')) {
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////access condition applied///////////////////////////
////////////////////////////////////////////////////////////////////////////////            
            include_once 'util/DBUTIL.php';
            $dbutil = new DBUTIL($this->crg);

            // print_r($this->ses->get('user'));
            $actual_table_name = $this->crg->get('table_prefix') . 'employee';

            $user_Email = $this->ses->get('user')['user_email'];
            
            $user_ID = $this->ses->get('user')['ID'];
            
            $this->tpl->set('userTitle', $this->rbac->Roles->getTitle($user_ID));
            
            $usersql = "SELECT * FROM `$actual_table_name` WHERE `Email` = '$user_Email' limit 1";
            if ($user_Email) {
                $emp = $dbutil->getSqlData($usersql,2);
            } else {
                $this->tpl->set('content', 'No valid user email');
            }


            $this->tpl->set('userData',$emp[0]);
            
            $this->tpl->set('content', $this->tpl->fetch('factory/template/application/view_profile.php'));

            //////////////////////////////on access condition failed then ///////////////////////////
        } else {
            if ($this->ses->get('user')['ID']) {
                $this->tpl->set('content', $this->tpl->fetch('modules/user/acess_failed_message.php'));
            } else {
                header('Location:' . $this->crg->get('route')['base_path'] . '/user/auth/login');
            }
        }
    }

    //////////////////user type close here//////////////////
    //////////////////assign user type and entity / branch to user start here//////////////////

    function activate() {
        if ($this->crg->get('wp') || $this->crg->get('rp')) {

//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////access condition applied///////////////////////////
////////////////////////////////////////////////////////////////////////////////            
            include_once $this->tpl->path . '/factory/form/asignUserTypeEntity_form.php';

            $cus_form_data = Form_Elements::data($this->crg);
            include_once 'util/crud3.php';
            new Crud3($this->crg, $cus_form_data, TRUE);

            //////////////////////////////on access condition failed then ///////////////////////////
        } else {
            if ($this->ses->get('user')['ID']) {
                $this->tpl->set('content', $this->tpl->fetch('modules/user/acess_failed_message.php'));
            } else {
                header('Location:' . $this->crg->get('route')['base_path'] . '/user/auth/login');
            }
        }
    }

    //////////////////asignUserTypeEntity close here//////////////////


    function newpwd() {
        if ($this->crg->get('wp') || $this->crg->get('rp')) {

//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////access condition applied///////////////////////////
////////////////////////////////////////////////////////////////////////////////            
            include_once $this->tpl->path . '/factory/form/change_password.php';

            if ($_REQUEST['submit'] === 'newpass_submit') {

                $table_name = $this->crg->get('table_prefix') . 'users';

                $password = md5($this->sd->safedata($_REQUEST['user_pass']));


                $val_arr = array(
                    'user_nicename' => $this->sd->safedata($_REQUEST['user_nicename']),
                    'user_email' => $this->sd->safedata($_REQUEST['user_email']),
                    'user_pass' => $password
                );

                $table_string = $this->sd->table_column_name_value_gen($val_arr);
                $col_string = $table_string['column_string'];
                $val_string = $table_string['value_string'];

                $Query = "INSERT INTO $table_name ($col_string) VALUES ($val_string)";
                $stmt = $this->db->prepare($Query);
            }
            $cus_form_data = Form_Elements::data($this->crg);
            include_once 'util/crud3.php';
            new Crud3($this->crg, $cus_form_data, TRUE);

            //////////////////////////////on access condition failed then ///////////////////////////
        } else {
            if ($this->ses->get('user')['ID']) {
                $this->tpl->set('content', $this->tpl->fetch('modules/user/acess_failed_message.php'));
            } else {
                header('Location:' . $this->crg->get('route')['base_path'] . '/user/auth/login');
            }
        }
    }
    
    function about() {
        if ($this->crg->get('wp') || $this->crg->get('rp')) {

//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////access condition applied///////////////////////////
////////////////////////////////////////////////////////////////////////////////            
            
            $this->tpl->set('content', $this->tpl->fetch('factory/about.php'));

            //////////////////////////////on access condition failed then ///////////////////////////
        } else {
            if ($this->ses->get('user')['ID']) {
                $this->tpl->set('content', $this->tpl->fetch('modules/user/acess_failed_message.php'));
            } else {
                header('Location:' . $this->crg->get('route')['base_path'] . '/user/auth/login');
            }
        }
    }
    
    function dashboard() {
        if ($this->crg->get('wp') || $this->crg->get('rp')) {

//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////access condition applied///////////////////////////
////////////////////////////////////////////////////////////////////////////////  
            
            include_once 'util/DBUTIL.php';
            $dbutil = new DBUTIL($this->crg);

            // print_r($this->ses->get('user'));
            $serreq_tab = $this->crg->get('table_prefix') . 'servicerequest';            
            $entityID = $this->ses->get('user')['entity_ID'];
            $sqlsrr = "SELECT COUNT(AuditDateTime) FROM $serreq_tab "
                    . "WHERE MONTH(AuditDateTime) = MONTH(CURDATE()) "
                    . "AND YEAR(AuditDateTime) = YEAR(CURDATE()) "
                    . "AND CurrentStatus = 'OPEN' AND entity_ID = $entityID";            
            $srr_open = $dbutil->getSqlData($sqlsrr,2);           
	    $this->tpl->set('srr_open_data', $srr_open);
                 
            $cst_tab = $this->crg->get('table_prefix') . 'customer';
            $sqlcus = "SELECT COUNT(SGuserRegDate) FROM $cst_tab "
                    . "WHERE MONTH(SGuserRegDate) = MONTH(CURDATE()) "
                    . "AND YEAR(SGuserRegDate) = YEAR(CURDATE()) AND entity_ID = $entityID";            
            $cus_reg = $dbutil->getSqlData($sqlcus,2);              
	    $this->tpl->set('cus_reg_data', $cus_reg);
                        
            $sqlcusqry = "SELECT COUNT(PackExpireDate) FROM $cst_tab "
                       . "WHERE DATE(PackExpireDate) = CURDATE() AND entity_ID = $entityID";            
            $cuspac_expr = $dbutil->getSqlData($sqlcusqry,2); 
            //var_dump($cuspac_expr);
	    $this->tpl->set('cus_pac_reg', $cuspac_expr);
        
        
            $this->tpl->set('content', $this->tpl->fetch('factory/dashboard.php'));

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
