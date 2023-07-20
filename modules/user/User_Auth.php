<?php

/**
 * Description of User_Auth
 *
 * @author psmahadevan
 */
class User_Auth {

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

    public function otp() {
/////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////submit otp and login completes here/////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////
        /*
         * if user name password is right in the first section of the login 
         * and if the otp number not set
         * then redirect to login screen
         *
         */

        if (empty($this->ses->get('userBrOTP')['ID']) && empty($otpNumberSess)) {
            header('Location:' . $this->crg->get('route')['base_path'] . '/user/auth/login');
        }


         $otpNumberSess = $this->ses->get('OTPFourDigNo');
        
        $optPostVal = isset($_POST['otp']) ? trim($_POST['otp']) : false;

        //on opt form submit and compare
        if (!empty($optPostVal) && $otpNumberSess == $optPostVal) {
            ob_start(); 
            //set user session ofter a successful otp
            $this->ses->set('user', $this->ses->get('userBrOTP'));

            //over wite the userBrOTP to false
            $this->ses->set('userBrOTP', false);


            //////////////////////////menu manager///////////////////////////////////////
            $masterMenuArr = parse_ini_file('config/menuManager.ini', TRUE);

            /////////////////////////////////////////////////
            //var_dump($masterMenuArr);
            $BuildUserMenu = array();
            foreach ($masterMenuArr as $MenuHeaderkey => $MenuHeadervalueArr) {

                $x = array();
                $x['css'] = $MenuHeadervalueArr['css'];
                array_shift($MenuHeadervalueArr);

                foreach ($MenuHeadervalueArr as $Mkey => $Mvalue) {

                    $perTitle = str_replace('/', '_', trim($Mkey));
                    $perTitle .= '_read';

                    $pID = $this->rbac->Permissions->returnId($perTitle);
                    $uID = $this->ses->get('user')['ID'];
                    if ($pID && $this->rbac->check($pID, $uID)) {
                        $x[trim($Mkey)] = trim($Mvalue);
                    }
                }



                if (count($x) > 1) {
                    $BuildUserMenu[trim($MenuHeaderkey)] = $x;
                }
                unset($x);
            }

            //////////////////////////////////////////////////////////////////////////////////////////

            $this->tpl->set('UserMenu', $BuildUserMenu);

            $this->ses->set('RoleBasedUserMenu', $this->tpl->fetch('factory/template/application/UserMenu.php'));
            
            
            
            ////////////////////////////////////////////////////////////////
            ////////////////////////////////////////////////////////////////


            $this->tpl->set('message', 'login Successfull');
            header('Location:' . $this->crg->get('route')['base_path'] . '/' . $this->crg->get('ycs_config')['host']['LOGIN_SUCCESS_REDIRECT']);
             exit;
             ob_end_flush();
        } else {

///////////////////////////////////////////////////////////////////////////////////////////////
            $msg = empty($optPostVal) ? 'Please Enter the OTP No. to login' : 'Enter your correct OPT No.';
/////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////
            $this->tpl->set('message', $msg);
            $this->tpl->set('master_layout', 'otpTpl.php');
        }
/////////////////////////
    }

    public function login() {


        //////////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////////////////////////////////
        /*
         * If u are already loged in
         * header redirect to home page 
         */
        if (!empty($this->ses->get('user')['ID']) && !empty($this->ses->get('user')['user_email'])) {
            $msg = 'Already Logged in with: '
                    . $this->ses->get('user')['user_email']
                    . '<br><br><a href="' . $this->crg->get('route')['base_path']
                    . '/user/auth/logout">Logout</a> to login as new user'
                    . ' - OR - '
                    . '<a href="' . $this->crg->get('route')['base_path'] . '/' . $this->crg->get('ycs_config')['host']['LOGIN_SUCCESS_REDIRECT'] . '">Home</a>.';


            $this->tpl->set('message', $msg);
            $this->tpl->set('master_layout', 'login.php');
            return;
        }

//////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
        if (!empty($_REQUEST['login_submit'])) {
            $user_email = $this->sd->safedata($_REQUEST['user_email']);
            $password = md5($this->sd->safedata($_REQUEST['user_pass']));
            $tableName = $this->crg->get('table_prefix') . 'users';
            ///change 1
            $tableName1 = $this->crg->get('table_prefix') . 'entity';


            if ($user_email && $password) {

                //change 2 // replace /////////////////////////////////////
                //    $sql = "SELECT * FROM $tableName where `user_email` = '$user_email' Limit 1";
                //////////////////////////////////////////////////////////////////////////////////////////

                $colArr = array(
                    "$tableName.ID",
                    "$tableName.user_nicename",
                    "$tableName.user_email",
                    "$tableName.user_pass",
                    "$tableName.user_mobileno",
                    "$tableName.user_registered",
                    "$tableName.entity_ID",
                    "$tableName.user_status",
                    "$tableName.usertype_ID",
                    "$tableName1.Title AS entity_Title",
                    "$tableName1.ShortCode AS short_code"
                );


                $umail = $this->db->quote($user_email);

                $sql = "SELECT "
                        . implode(',', $colArr)
                        . " FROM $tableName, $tableName1"
                        . " WHERE "
                        . " $tableName.user_email = $umail AND "
                        . " $tableName1.ID = $tableName.entity_ID";


///////////////////////////////////////////////////////////////////////////////
                    $stmt = $this->db->prepare($sql);
                    $stmt->execute();
                    $rows = $stmt->fetch(2);
///////Entity Details//////////////////////////////////////////////////////
                
             $entitytable = $this->crg->get('table_prefix') . 'entity';

                $sqlEntity = "SELECT ID,Title,ShortCode from $entitytable"; 
                       
                        

                $stmtentity = $this->db->prepare($sqlEntity);
                $stmtentity->execute();
                $rowsentity = $stmtentity->fetchAll(2);

               
///////////////////////////////////////////////////////////////////////////////



                if ($rows['user_pass'] === $password && $rows['user_email'] === $user_email) {
                    if ($rows['user_status'] == 1) {

                        ///user session before otp
                        $this->ses->set('userBrOTP', $rows);

                        $this->ses->set('AllEntityDetails', $rowsentity);


                        //generate 4 dig number for otp
                        
                        $rndNo = mt_rand(112211, 999999);



                        $LoginUsermobileNo = trim($rows['user_mobileno']);

                        if (!empty($LoginUsermobileNo) && preg_match('/^\d{10}$/', $LoginUsermobileNo)) {
                            //Store random number in session
                            $this->ses->set('OTPFourDigNo', $rndNo);

                            $smsMessage = 'For GMH login, your OTP is ' . $rndNo . '. Dated ' . date("j M Y g:i a.");

                            include_once 'lib/util/curl.php';

                            //$httpSms = new httpCurl();
                            //if ($httpSms->smsgateway($LoginUsermobileNo, $smsMessage)) {
                                header('Location:' . $this->crg->get('route')['base_path'] . '/user/auth/otp');
                            //}else{
                                //$this->tpl->set('message', 'Can'."'".'t able to send OTP SMS at the moment');
                           // }
                        } else {

                            $this->tpl->set('message', 'MobileNo. is not registered for u. To set contact your admin');
                        }
                    } else {
                        $this->tpl->set('message', 'Contact your admin to activate this account');
                    }
                } else {
                    $this->tpl->set('message', 'Incorrect User Name Or Password');
                }
            } else {
                $this->tpl->set('message', 'No User Name Or Password');
            }
        }


/////////////////////////////////////////////////////////////////////////////////////////////////////////////


        $this->tpl->set('master_layout', 'login.php');
        //loging fn close brase    
    }

    //////////////End of login/////////////////////

    public function logout() {

        if ($this->ses->get('user')['ID']) {
            $this->ses->destroy();
                $this->tpl->set('message', 'Logout successfully - Thank you');
        $this->tpl->set('master_layout', 'login.php');
        }
    
    }

    ///////////////End of logout/////////////////
    //////////////////////////////////////////////////////////////////
    ////////////////////////////////REGISTER//////////////////////////
    //////////////////////////////////////////////////////////////////

    public function register() {
        //var_dump($this->crg->get('route'));
        //user_email
        //user_pass
        if ($this->crg->get('wp') || $this->crg->get('rp')) {

            if (!empty($_REQUEST['submit']) && $_REQUEST['submit'] === 'reg_submit') {

                $table_name = $this->crg->get('table_prefix') . 'users';

                $password = md5($this->sd->safedata($_REQUEST['user_pass']));
                $re_user_pass = md5($this->sd->safedata($_REQUEST['re_user_pass']));
                $terms_conditions = $this->sd->safedata($_REQUEST['terms']);
                /*
                 * if password not match or terms and condition net checked 
                 */
                if ($password !== $re_user_pass) {

                    $this->tpl->set('message', 'Password doest not matches');
                    $this->tpl->set('master_layout', 'register.php');
                    return;
                }
                if (!$terms_conditions) {

                    $this->tpl->set('message', 'You are not agreed to the terms and conditions');
                    $this->tpl->set('master_layout', 'register.php');
                    return;
                }



                $val_arr = array(
                    'user_nicename' => $this->sd->safedata($_REQUEST['user_nicename']),
                    'user_email' => $this->sd->safedata($_REQUEST['user_email']),
                    'user_pass' => $password,
                    'user_mobileno' => $this->sd->safedata($_REQUEST['user_mobileno'])
                );


                $table_string = $this->sd->table_column_name_value_gen($val_arr);
                $col_string = $table_string['column_string'];
                $val_string = $table_string['value_string'];

                $Query = "INSERT INTO $table_name ($col_string) VALUES ($val_string)";
                $stmt = $this->db->prepare($Query);

                if ($stmt->execute()) {
                    $this->tpl->set('message', 'User Created successfully');
                } else {
                    $this->tpl->set('message', 'The email id exists already');
                    $this->tpl->set('reg_form_values', $val_arr);
                }
            }
            $this->tpl->set('master_layout', 'register.php');
        } else {

            if ($this->ses->get('user')['ID']) {
                $this->tpl->set('content', $this->tpl->fetch('modules/user/acess_failed_message.php'));
            } else {
                header('Location:' . $this->crg->get('route')['base_path'] . '/user/auth/login');
            }
        }
    }

    //////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////Forget Password///////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
    function forgegtpassword() {
        if ($this->ses->get('user')['ID']) {
            $this->ses->destroy();
        }
        $this->tpl->set('message', 'In order to change your Password, Please contact System Admin!');
        $this->tpl->set('master_layout', 'login.php');
    }

    public function profile() {
        //var_dump($this->crg->get('route'));
        //user_email
        //user_pass
        if ($this->crg->get('wp') || $this->crg->get('rp')) {
            $this->tpl->set('master_layout', 'profile.php');
        }
    }

    /*
     * End of Class
     */
}
