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
            $this->tpl->set('page_header', 'Admin');
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
                case 'reset':
                IF ($this->rbac->Roles->reset(true)) {
                    $this->tpl->set('message', 'Roles Reset to initial condition !');
                } ELSE {
                    $this->tpl->set('message', 'Fails to reset Roles - Try Again');
                }
                
                $this->tpl->set('label', 'List Role');
                $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                break;
                
                case 'view':
                    $ycsID = $this->sd->safedata($_POST['ycs_ID']);
                    $info = '';
                    $parentID = $this->crg->get('rbac')->Roles->parentNode($ycsID);

                    $children = $this->crg->get('rbac')->Roles->children($ycsID);

                    //public mixed Rbac->{Entity}->getDescription(int $ID)
                    $info .= 'Role Title : ' . $this->crg->get('rbac')->Roles->getTitle($ycsID);
                    $info .='<br>';
                    $info .= 'Description :' . $this->crg->get('rbac')->Roles->getDescription($ycsID);
                    $info .='<br>';
                    if ($parentID['Title']) {
                        $info .='Parent Role : ' . $parentID['Title'];
                        $info .='<br>';
                    }

                    if (is_array($children)) {
                        foreach ($children as $key => $value) {

                            $info .='<br>';
                            $info .='children Role (' . ($key + 1) . ') :' . $value['Title'];
                        }
                    }


                    $info .='<br>';

                    $this->tpl->set('label', 'List Role');
                    $info .= $this->tpl->fetch('factory/template/form_button_link.php');


                    $this->tpl->set('form_title', 'View Role');

                    $this->tpl->set('sub_content', $info);
                    $this->tpl->set('content', $this->tpl->fetch('factory/template/application/general_form_layout.php'));
                    break;

                case 'delete':

                    $ycsID = $this->sd->safedata($_POST['ycs_ID']);

                    if ($ycsID && $this->crg->get('rbac')->Roles->remove($ycsID)) {
                        $this->tpl->set('message', 'Role Deleted succcessfully');
                    } else {
                        $this->tpl->set('message', 'Fail to remove- try again');
                    }
                    //form_title
                    $this->tpl->set('form_title', 'Del Role');
                    $this->tpl->set('label', 'List Role');
                    $this->tpl->set('sub_content', $this->tpl->fetch('factory/template/form_button_link.php'));

                    $this->tpl->set('content', $this->tpl->fetch('factory/template/application/general_form_layout.php'));
                    break;

                case 'edit':
                    /*
                     * Edit Form 
                     */

                    $ycsID = $this->sd->safedata($_POST['ycs_ID']);

                    if (!$ycsID) {
                        $this->tpl->set('message', 'No Role Selected to Edit');
                        $this->tpl->set('label', 'List Role');
                        $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                        return;
                    }

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
                    $no_Parent_ID = $this->sd->safedata($_POST['no_Parent_ID']);

                    $NewparentID = $this->sd->safedata($_POST['Parent_ID']);
                    //if form with no title
                    if (!$RoleTitle) {
                        $this->tpl->set('message', 'Role Fails to Edit - may be due to same role name - Try again');
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

                        //for no parent id
                        if ($no_Parent_ID == $NewparentID) {
                            $NewparentID = NULL;
                        }

                        if ($this->crg->get('rbac')->Roles->add($RoleTitle, $RoleDescription, $NewparentID)) {
                            $this->tpl->set('message', 'Role Edited succcessfully - with new parent id');
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




    function permissionManager() {
        if ($this->crg->get('wp') || $this->crg->get('rp')) {
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////access condition applied///////////////////////////
////////////////////////////////////////////////////////////////////////////////            
        $this->tpl->set('page_header', 'Admin');
        //Add Role when u submit the add role form
        $thisPageURL = $this->crg->get('route')['base_path'] . '/' . $this->crg->get('route')['module'] . '/' . $this->crg->get('route')['controller'] . '/' . $this->crg->get('route')['action'];
        /*
         * Request form pagination list form
         */
        $crud_string = null;
         
        if (isset($_POST['req_from_list_view'])) {
            $crud_string = strtolower($_POST['req_from_list_view']);
        }

        /*
         * $crud_string is over written here by 
         * request from url example :http://localhost/me/admin/rbac/permissionManager/add
         *  
         * This is to avoid redirecting crud class to create form or delete
         * 
         * if u do that it will thow 
         * No such API to call 
         * exception
         */

        if (!empty($this->crg->get('route')['crud'])) {
            $crud_string = $this->crg->get('route')['crud'];
        }



        switch ($crud_string) {
            case 'view':
                $ycsID = $this->sd->safedata($_POST['ycs_ID']);
                $info = '';
                $parentID = $this->crg->get('rbac')->Permissions->parentNode($ycsID);

                $children = $this->crg->get('rbac')->Permissions->children($ycsID);

                //public mixed Rbac->{Entity}->getDescription(int $ID)
                $info .= 'Permission Title : ' . $this->crg->get('rbac')->Permissions->getTitle($ycsID);
                $info .='<br>';
                $info .= 'Description :' . $this->crg->get('rbac')->Permissions->getDescription($ycsID);
                $info .='<br>';
                if ($parentID['Title']) {
                    $info .='Parent Permissions : ' . $parentID['Title'];
                    $info .='<br>';
                }

                if (is_array($children)) {
                    foreach ($children as $key => $value) {

                        $info .='<br>';
                        $info .='children Permission (' . ($key + 1) . ') :' . $value['Title'];
                    }
                }


                $info .='<br>';

                $this->tpl->set('label', 'List Permissions');
                $info .= $this->tpl->fetch('factory/template/form_button_link.php');


                $this->tpl->set('form_title', 'View Permissions');

                $this->tpl->set('sub_content', $info);
                $this->tpl->set('content', $this->tpl->fetch('factory/template/application/general_form_layout.php'));
                break;



            case 'add-permission':
                
                    include_once 'util/DBUTIL.php';
                    $dbutil = new DBUTIL($this->crg);
                
                    $modules = array();
                    $modules_dir = './modules';
                    
                    /*                
                    $handle = opendir($modules_dir);
                    while (false !== ($entry = readdir($handle))) {
                        if ($entry != "." && $entry != "..") {
                            $modules[] = $entry;
                        }
                    }
                    closedir($handle);
                    */
                    
                    //include this line for the above commented part		
                    $modules = include_once('config/moduleList.php');
                    
                    $permission_tab = $this->crg->get('table_prefix') . 'permissions';
                    
                    try {

                    //to hols the permissions and to disply to user
                    $perm = array();

                    foreach ($modules as $ModName) {

                        $clsMap_fileName = $modules_dir . '/' . $ModName . '/cls_map.ini';
                        if (file_exists($clsMap_fileName)) {
                            $clasMap = parse_ini_file($clsMap_fileName, TRUE);
                            //Class_Map

                            foreach ($clasMap['Class_Map'] as $clsUrlName => $actClsName) {

                                $cls_fileName = $modules_dir . '/' . $ModName . '/' . $actClsName . '.php';
                                if (file_exists($cls_fileName)) {
                                    include_once $cls_fileName;

                                    $getClsMethods = get_class_methods($actClsName);
                                    /*
                                     * construct permissions
                                     */
                                    foreach ($getClsMethods as $methodName) {
                                        /*
                                         * Avoid listing __constructors
                                         */

                                        if ($methodName !== '__construct') {
                                            $permission_prefix = $ModName . '_' . $clsUrlName . '_' . $methodName;
                                            
                                            for($i=1;$i<=3;$i++){
                                                if($i==1){$state=$ModName;}elseif($i==2){$state=$permission_prefix.'_write';}else{$state=$permission_prefix.'_read';}    
                                                $sqlPerm = "SELECT COUNT(Title) FROM `$permission_tab` WHERE Title='$state'";
                                                $permData = $dbutil->getSqlData($sqlPerm, 7);
                                                
                                                if($permData[0]<1){
                                                $sqlIns="INSERT INTO $permission_tab (Title,Description) VALUES ('$state','$state')";
                                                $dbutil->putSqlData($sqlIns);
                                                $perm['Success'][] = $state; 
                                                }
                                            }
                                           
                                        }
                                    }
                                } else {
                                    $perm['Failure'][] = 'No such class file : ' . $cls_fileName;
                                }
                            }
                        } else {
                            $perm['Failure'][] = 'No such class map :' . $clsMap_fileName;
                        }
                    }

                    //mater loop close here 

                    $this->tpl->set('message', 'New Permissions Added!');

                    $this->tpl->set('label', 'List Permissions');
                    $perm['Success'][] = '<br><br><br>'.$this->tpl->fetch('factory/template/form_button_link.php');

                    if ($perm['Failure']) {
                        $perm['Failure'][] = '<br><br><br>';
                    }

                    $perm['Link'][] = '<br><br><br>';

                    $perm['Link'][] = $this->tpl->fetch('factory/template/form_button_link.php');

                    $this->tpl->set('sub_content', implode("<br><br>",$perm['Success']));
                    

                    $this->tpl->set('content', $this->tpl->fetch('factory/template/application/general_form_layout.php'));
                    } catch (Exception $exc) {
                    $this->tpl->set('message', 'New Permission failed to Add. try again');
                    $this->tpl->set('label', 'List Permissions');

                    $link = $this->tpl->fetch('factory/template/form_button_link.php');
                    $link .= $exc->getTraceAsString();

                    $this->tpl->set('content', $link);
                    }
                    
                break;    
                
            case 're-generate':
                /*
                 * generate permision Form 
                 */
                //////////////////////////////////////////////////////
                ////////////reset Rbac permissions//////////////////////////////
                ////////////only for re-generate command////////////////////////
                //////////////////////////////////////////////////////
                if ($crud_string == 're-generate') {
                    $this->crg->get('rbac')->Permissions->reset(true);
                }
                ////////////////////////////////////////////////////////
                ////////////////////////////////////////////////////////
                $modules = array();
                $modules_dir = './modules';
                
                /*
                $handle = opendir($modules_dir);
                while (false !== ($entry = readdir($handle))) {
                    if ($entry != "." && $entry != "..") {
                        $modules[] = $entry;
                    }
                }
                closedir($handle);
                */
                
                //include this line for the above commented part		
                $modules = include_once('config/moduleList.php');
                
                try {

                    //to hols the permissions and to disply to user
                    $perm = array();

                    foreach ($modules as $ModName) {

                        $clsMap_fileName = $modules_dir . '/' . $ModName . '/cls_map.ini';
                        if (file_exists($clsMap_fileName)) {
                            $clasMap = parse_ini_file($clsMap_fileName, TRUE);
                            //Class_Map

                            foreach ($clasMap['Class_Map'] as $clsUrlName => $actClsName) {

                                $cls_fileName = $modules_dir . '/' . $ModName . '/' . $actClsName . '.php';
                                if (file_exists($cls_fileName)) {
                                    include_once $cls_fileName;

                                    $getClsMethods = get_class_methods($actClsName);
                                    /*
                                     * construct permissions
                                     */
                                    foreach ($getClsMethods as $methodName) {
                                        /*
                                         * Avoid listing __constructors
                                         */

                                        if ($methodName !== '__construct') {
                                            $permission_prefix = $ModName . '_' . $clsUrlName . '_' . $methodName;

                                            $permission_write = $permission_prefix . '_write';
                                            $permission_read = $permission_prefix . '_read';

                                            //Rbac permission setting
                                            $perPath = '/' . $ModName . '/' . $permission_write . '/' . $permission_read;

                                            $perDisc = array($ModName, $permission_write, $permission_read);

                                            if ($this->crg->get('rbac')->Permissions->addPath($perPath, $perDisc)) {
                                                $perm['Success'][] = $permission_prefix;
                                            } else {
                                                $perm['Failure'][] = $permission_prefix;
                                            }

                                            unset($permission_write, $permission_read, $perPath, $perDisc);
                                        }
                                    }
                                } else {
                                    $perm['Failure'][] = 'No such class file : ' . $cls_fileName;
                                }
                            }
                        } else {
                            $perm['Failure'][] = 'No such class map :' . $clsMap_fileName;
                        }
                    }

                    //mater loop close here 


                    $this->tpl->set('message', 'Permission resetted');

                    $this->tpl->set('label', 'List Permissions');
                    $perm['Success'][] = '<br><br><br>'.$this->tpl->fetch('factory/template/form_button_link.php');

                    if ($perm['Failure']) {
                        $perm['Failure'][] = '<br><br><br>';
                    }

                    $perm['Link'][] = '<br><br><br>';

                    $perm['Link'][] = $this->tpl->fetch('factory/template/form_button_link.php');

                    $this->tpl->set('sub_content', implode("<br><br>",$perm['Success']));
                    

                    $this->tpl->set('content', $this->tpl->fetch('factory/template/application/general_form_layout.php'));
                } catch (Exception $exc) {
                    $this->tpl->set('message', 'Permission fails to Reset pl. try again');
                    $this->tpl->set('label', 'List Permissions');

                    $link = $this->tpl->fetch('factory/template/form_button_link.php');
                    $link .= $exc->getTraceAsString();

                    $this->tpl->set('content', $link);
                }
                break;

            case 'add':
            case 'edit':
            case 'delete':
                //do nothing
                $this->tpl->set('message', 'No such API to call');
                $this->tpl->set('label', 'List Permissions');

                $link = $this->tpl->fetch('factory/template/form_button_link.php');

                $this->tpl->set('content', $link);
                break;

            default:
                /*
                 * List and add form
                 */

                    include_once $this->tpl->path . '/factory/form/addpermissions_form.php';
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

    //////////////////Per manager close here//////////////////


////////////////////////////////////////////////////////////////////////////////
////////////////////////rolePermissions////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////    
    function rolePermissions() {
        if ($this->crg->get('wp') || $this->crg->get('rp')) {
//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////access condition applied///////////////////////////
////////////////////////////////////////////////////////////////////////////////   

///////////////////////////////////////
           $keyString = '';
           
           if(isset($_POST['req_from_list_view'])){
           	$keyString = strtolower($_POST['req_from_list_view']);
            }
////////////////////////////////////////

            
            switch ($keyString) {
                case 'submit':
                   
                    $this->crg->get('rbac')->Permissions->resetAssignments(TRUE);
                    foreach ($_POST as $Pkey => $Pvalue) {
                        if ('' !== $Pvalue) {
                            $postKey = explode('_', $Pkey);
                            $this->crg->get('rbac')->Permissions->assign($postKey[1], $Pvalue);
                        }
                    }
                    $this->tpl->set('message', 'Role Permission assigned');
                    $this->tpl->set('label', 'Edit');
                    $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                    break;
                case 'reset':
                    $this->crg->get('rbac')->Permissions->resetAssignments(TRUE);
                    $this->tpl->set('message', 'Role Permission Reseted');
                    $this->tpl->set('label', 'Edit');
                    $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                    break;
                
                case 'edit': 
                default:
                   
                    include_once 'util/DBUTIL.php';
                    $dbutil = new DBUTIL($this->crg);
                    
                    $actual_rolePer_table = $this->crg->get('table_prefix') . 'rolepermissions';
                    
                    //edit options
                    //default is edit
                    $mySql = "SELECT `RoleID`,`PermissionID` FROM `$actual_rolePer_table` WHERE `RoleID` <> 1 ORDER BY `RoleID` ASC ";
                    $RolePermissionList = $dbutil->getSqlData($mySql, 3);
                    $this->tpl->set('role_permission_data',$RolePermissionList );

                    ////get all roles By title
                    //$this->rbac->Permissions->getPath($ycsID)    ;

                    $actual_table_name = $this->crg->get('table_prefix') . 'roles';
                    $mySql = "SELECT `ID`,`Title` FROM `$actual_table_name` WHERE `Title` <> 'root' ORDER BY `ID` ASC ";
                    $RoleList = $dbutil->getSqlData($mySql, 12);


                    $permissionList = $dbutil->selectKeyVal('permissions');

                   
                    $pattern = '/_read$/';
                    $permissionFormGenList = array();

                    foreach ($permissionList as $key => $value) {

                        //select lower most permission and use the process

                          if (preg_match($pattern,$value)) {

                            $functionNameArr = explode('_', $value);
                            $urlTypePermissionName = $functionNameArr[0] . '/' . $functionNameArr[1] . '/' . $functionNameArr[2];

                            $rootPermission = 'root';
                            $modulePaermission = $functionNameArr[0];
                            $methodPermission_write = $functionNameArr[0] . '_' . $functionNameArr[1] . '_' . $functionNameArr[2] . '_write';
                            $methodPermission_read = $value;
                            //Get Permission IDs

                            $rootPermissionId = $this->rbac->Permissions->returnId($rootPermission);
                            $modulePaermissionId = $this->rbac->Permissions->returnId($modulePaermission);
                            $methodPermission_writeId = $this->rbac->Permissions->returnId($methodPermission_write);
                            $methodPermission_readId = $this->rbac->Permissions->returnId($methodPermission_read);


                            $PermissionArray = array(
                                '' => '',
                                $methodPermission_readId => $functionNameArr[2] . ' Read',
                                $methodPermission_writeId => $functionNameArr[2] . ' Write',
                                $modulePaermissionId => $functionNameArr[0] . ' Module'
                                    //  $rootPermissionId => 'root'
                            );

                            $permissionFormGenList[$urlTypePermissionName] = $PermissionArray;
                        }

                    }

                    //var_dump($permissionFormGenList);
                    //$table_columns
                    $this->tpl->set('table_columns', $RoleList);
                    $this->tpl->set('table_rows', $permissionFormGenList);

                    $this->tpl->set('content', $this->tpl->fetch('factory/form/rolePermissions_form.php'));

                    break;
            }


            //////////////////////////////on access condition failed then ///////////////////////////
        } else {
            if ($this->ses->get('user')['ID']) {
                $this->tpl->set('content', $this->tpl->fetch('modules/user/acess_failed_message.php'));
            } else {
                header('Location:' . $this->crg->get('route')['base_path'] . '/user/auth/login');
            }
        }
    }

    //////////////////role permission manager close here//////////////////




    /*
     * End of Class
     */
}
