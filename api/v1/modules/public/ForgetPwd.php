<?php

/**
 * Description of ForgetPwd
 *
 * @author ycs-gunabalans@yahoo.com
 */
include_once 'Util/Gen.php';

class ForgetPwd extends Util\Gen {

    protected  $crg;
    protected  $db;
    private $getHeaders;
    private $req_method;

    public function __construct($reg = NULL) {
        $this->crg = $reg;
        $this->db = $this->crg->get('db');
        $this->getHeaders = $this->crg->get('HttpHeaders');
        $this->req_method = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);
        $this->baseUrl = $this->crg->get('appConfig')['host_name'] . '/' . $this->crg->get('base_folder');
        parent::__construct($reg);
    }

///////////////Constructor completed here/////////////////
//////////////////////////////////////////////////////////

    public function init() {
        //check for request method
        $this->handleSetPwd();
    }

    //////////////////////////////init complete here///////////////////////////////////////////////////////
    /*
     * You can add custom class method her
     */


    private function handleSetPwd() {
        $userMob = filter_input(INPUT_GET, 'MobileNo', FILTER_SANITIZE_STRING);

        if (empty($userMob)) {
            return $this->crg->setResponseCode(400, 'Mobile Number required');
        }

        $getUserRole = $this->db->select('user_role', "*", ['UserID' => $userMob]);
       
        if (count($getUserRole) < 1) {  
            return $this->crg->setResponseCode(401, 'There is no registered user with this Mobile number');
        }

        $updatePwSucc = FALSE;
        $userRole = $getUserRole[0]['RoleID'];

        if(empty($userRole)) {     
            return $this->crg->setResponseCode(401, 'There is no registered user Role with this Mobile number');
        }

        $newPwd = rand(10000000, 99999999);
        
        $dataToUpdate = ['UserPwd' => md5($newPwd)];
        $updateWc = ['MobileNo' => $userMob];

        ////////////////else update the password///////////////////////////////////
        $regData = $this->db->update('user', $dataToUpdate, $updateWc);

        ///////////////////////////////if password set then/////////////////////
        if ($regData >= 1) {
            $desc = "New password was set and sent to your registered mobile no. and email id";
            
            /////////////////////////update role in user Role table/////////////////// 
            $mesageWithPw = 'For YCSTravel app, the new temporary password is ' . $newPwd;
            ////////////////////////////////////////////////////////////////////////////
            /*
             * send otp to registed mobile
             */
             if ($this->smsgateway($userMob, $mesageWithPw)) { 
                 
                 ////If the SMS is sent success then the mail will be sent///
                
                $type="forgetpwd";
                
                if ($this->curlManager($userMob, $mesageWithPw, $type)) {
                    
                    return $this->crg->setResponseCode(200, $desc);
                }else{
                    return $this->crg->setResponseCode(200, str_replace("and email id","",$desc));    
                }
                
            } else {
                return $this->crg->setResponseCode(401, 'Sorry, we are unable to deliver message to your mobile no. and email');
            }
        } else {
            return $this->crg->setResponseCode(400, 'try again');
        }
    }

}

//class