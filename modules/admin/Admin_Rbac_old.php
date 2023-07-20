<?php

/**
 * Description of Customer_Mod
 *
 * @author psmahadevan
 */
class Admin_Rbac {

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

    
    
///////////////////////Rbac Role Manager//////////////////////////////////

    function roleManager() {
        if ($this->crg->get('wp') || $this->crg->get('rp')) {
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////access condition applied///////////////////////////
////////////////////////////////////////////////////////////////////////////////            
            //Add Role when u submit the add role form
            $thisPageURL = $this->crg->get('route')['base_path'] . '/' . $this->crg->get('route')['module'] . '/' . $this->crg->get('route')['controller'] . '/' . $this->crg->get('route')['action'];

            if (isset($_POST['req_from_list_view'])) {
                $crud_string = strtolower($_POST['req_from_list_view']);
            }

            //Edit submit
            if ($_POST['edit_submit_button'] == 'edit') {
                $crud_string = 'editsubmit';
            }


            //Add submit
            if ($_POST['add_submit_button'] == 'add') {
                $crud_string = 'addsubmit';
            }


            switch ($crud_string) {
                case 'view':
                    $ycsID = $this->sd->safedata($_POST['ycs_ID']);
                    $info = '';
                    $parentID = $this->crg->get('rbac')->Roles->parentNode($ycsID);

                    //public mixed Rbac->{Entity}->getDescription(int $ID)
                    $info .= 'Role Title : ' . $this->crg->get('rbac')->Roles->getTitle($ycsID);
                    $info .='<br>';
                    $info .= 'Description :' . $this->crg->get('rbac')->Roles->getDescription($ycsID);
                    $info .='<br>';
                    $info .='Parent Role : ' . $parentID['Title'];

                    $info .='<br>';

                    $this->tpl->set('label', 'List Role');
                    $info .= $this->tpl->fetch('factory/template/form_button_link.php');

                    $this->tpl->set('content', $info);

                    break;

                case 'delete':
                    $ycsID = $this->sd->safedata($_POST['ycs_ID']);

                    if ($ycsID && $this->crg->get('rbac')->Roles->remove($ycsID, TRUE)) {
                        $this->tpl->set('message', 'Role Deleted succcessfully');
                    } else {
                        $this->tpl->set('message', 'Fail to remove- try again');
                    }

                    $this->tpl->set('label', 'List Role');
                    $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                    break;

                case 'edit':
                    /*
                     * Edit Form 
                     */
                    include_once $this->tpl->path . '/factory/form/editRole_form.php';
                    $fc = Form_Elements::data($this->crg);
                    include_once 'util/formFactory.php';
                    $myForm = new FF($this->crg, $fc);
                    return $myForm->factory();
                    break;

                case 'editsubmit':

                    $ID = $this->sd->safedata($_POST['ID']);
                    $RoleTitle = $this->sd->safedata($_REQUEST['Title']);
                    $RoleDescription = $this->sd->safedata($_POST['Description']);
                    $existingParentID = $this->sd->safedata($_POST['existing_Parent_ID']);

                    $NewparentID = $this->sd->safedata($_POST['Parent_ID']);
                    //if form with no title
                    if (!$RoleTitle) {
                        $this->tpl->set('message', 'Title is required - pl fill the form carefully');
                        $this->tpl->set('label', 'List Role');
                        $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                        return;
                    }
                    //Edit role                    
                    if ($existingParentID == $NewparentID) {
                        if ($this->crg->get('rbac')->Roles->edit($ID, $RoleTitle, $RoleDescription)) {
                            $this->tpl->set('message', 'Role Edited succcessfully');
                            $this->tpl->set('label', 'List Role');
                            $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                            return;
                        } else {
                            $this->tpl->set('message', 'Role Fails to Edit - may be due to same role name - Try again');
                            $this->tpl->set('label', 'List Role');
                            $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                            return;
                        }
                    } else {



                        //public bool Rbac->{Entity}->edit(int $ID, string $NewTitle = null, string $NewDescription = null)
                        ///$this->crg->get('rbac')->Roles->edit($ycsID,$RoleTitle,$RoleDescription);

                        if ($this->crg->get('rbac')->Roles->remove($ID, TRUE)) {

                            //check ehther the role is avaible 
                            if ($this->crg->get('rbac')->Roles->titleId($RoleTitle)) {
                                $this->tpl->set('message', 'New Role with Title '.$RoleTitle .' already available');
                                $this->tpl->set('label', 'List Role');
                                return $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                            }

                            if ($this->crg->get('rbac')->Roles->add($RoleTitle, $RoleDescription, $parentID)) {
                                $this->tpl->set('message', 'Role Edited succcessfully - with new parent id - required to add permissins');
                            } else {
                                $this->tpl->set('message', 'Fail to Edit Role Try again - But Role and its permission are removed');
                            }
                        } else {
                            $this->tpl->set('message', 'Fail to Edit Role Try again');
                        }
                        $this->tpl->set('label', 'List Role');
                        $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                    }
                    break;

                case 'addsubmit':

                    $parentID = $this->sd->safedata($_REQUEST['ID']);
                    $RoleTitle = $this->sd->safedata($_REQUEST['Title']);
                    $RoleDescription = $this->sd->safedata($_REQUEST['Description']);
                    if ($RoleTitle && !$this->crg->get('rbac')->Roles->titleId($RoleTitle)) {
                        if ($this->crg->get('rbac')->Roles->add($RoleTitle, $RoleDescription, $parentID)) {
                            $this->tpl->set('message', 'Role added succcessfully');
                        } else {
                            $this->tpl->set('message', 'Fail to add Role Try again');
                        }
                        $this->tpl->set('label', 'List Role');
                        $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                    } else {
                        $this->tpl->set('message', 'Title is required or Role exist already');
                        $this->tpl->set('label', 'List Role');
                        $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                    }

                    break;

                default:
                    /*
                     * List and add form
                     */
                    include_once $this->tpl->path . '/factory/form/addRole_form.php';
                    $cus_form_data = Form_Elements::data($this->crg);
                    include_once 'util/crud3.php';
                    new Crud3($this->crg, $cus_form_data);
                    break;
            }


            ////////////////////////////////////////////////////////////////////////////
            //////////////////////////////on access condition failed then /////////////
            ///////////////////////////////////////////////////////////////////////////
        } else {
            if ($this->ses->get('user')['ID']) {
                $this->tpl->set('content', $this->tpl->fetch('modules/user/acess_failed_message.php'));
            } else {
                header('Location:' . $this->crg->get('route')['base_path'] . '/user/auth/login');
            }
        }
    }

    //////////////////Role manager close here//////////////////




    /*
     * End of Class
     */
}
