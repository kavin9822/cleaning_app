<?php

/**
 * Description of Customer_Mod
 *
 * @author psmahadevan
 */
class Manage_User {

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
    
    function usertype() {
        if ($this->crg->get('wp') || $this->crg->get('rp')) {
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////access condition applied///////////////////////////
////////////////////////////////////////////////////////////////////////////////            
            include_once $this->tpl->path . '/factory/form/usertype_form.php';
            $cus_form_data = Form_Elements::data($this->crg);
            include_once 'util/crud2.php';
            new Crud2($this->crg, $cus_form_data);

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
            
            ////////////////////start//////////////////////////////////////////////
	    
	    include_once 'util/DBUTIL.php';
            $dbutil = new DBUTIL($this->crg);
        
            $actual_table_name = $this->crg->get('table_prefix') . 'usertype';
            //$entityID = $this->ses->get('user')['entity_ID'];
            $sql = "SELECT `ID`, `Title` FROM `$actual_table_name`";
            $this->tpl->set('FKEY', 'usertype_ID');
            $this->tpl->set('FKEYVAL', $dbutil->getSqlData($sql, 12));       
            
           
            $actual_table_name_entity = $this->crg->get('table_prefix') . 'entity';
            $sqlent = "SELECT `ID`, `Title` FROM `$actual_table_name_entity`";
            $this->tpl->set('FKEY1', 'entity_ID');            
            $this->tpl->set('FKEYVAL1', $dbutil->getSqlData($sqlent, 12)); 
                 
            //////////////////////close//////////////////////////////////////             
            
            
            include_once $this->tpl->path . '/factory/form/asignUserTypeEntity_form.php';
            
            $cus_form_data = Form_Elements::data($this->crg);
            include_once 'util/crud3.php';
            new Crud3($this->crg, $cus_form_data,TRUE);

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

             if (!empty($_REQUEST['edit_submit_button']) && $_REQUEST['edit_submit_button'] === 'editSubmit') {            

                $table_name = $this->crg->get('table_prefix') . 'users';
		
          	$password = md5($this->sd->safedata($_REQUEST['user_pass'])); 
         
         
	        $re_user_pass = md5($this->sd->safedata($_REQUEST['user_registered'])); 
                                
                /*
                 * if password not match or terms and condition net checked 
                 */
                if ($password !== $re_user_pass ) {
                   $this->tpl->set('message', 'Password doest not matches');   
                   $this->tpl->set('label', 'List Users');
                   $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));                
                   return;                  
                }                            
                 
                
               
		$id = $_POST['ID'];

         	$Query = "UPDATE $table_name SET `user_pass`= '$password' WHERE `ID`= '$id'";
         
                $stmt = $this->db->prepare($Query);
                if($stmt->execute()){
	                $this->tpl->set('message', 'Password changed successfully');                
                }else{
	                $this->tpl->set('message', 'Failed to changed Password');        
                
                }
                        $this->tpl->set('label', 'List Role');
                        $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                return;
                
                }
            
            
            include_once $this->tpl->path . '/factory/form/change_password.php';          
            $cus_form_data = Form_Elements::data($this->crg);
            include_once 'util/crud3.php';
            new Crud3($this->crg, $cus_form_data,TRUE);

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
