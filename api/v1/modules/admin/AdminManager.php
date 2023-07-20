<?php

/**
 * Description of AdminManager
 *
 * @author ycs-gunabalans@yahoo.com
 */

include_once 'Util/CrudApi.php';

class AdminManager extends Util\CrudApi {

    public function __construct($reg = NULL) {
        $this->crg = $reg;
        $this->crg->set('tn', 'user'); //table name without prefix
        $this->crg->set('pk', 'ID'); //priumary key used for access
        parent::__construct($this->crg);
    }

///////////////Constructor completed here/////////////////
//////////////////////////////////////////////////////////

    public function init() {
        
        $currentdatetime = date('Y-m-d H:i:s');
        
        switch ($this->HTTPMethodStringFromUrl) {
            case 'regNewUser':
                $this->registerNewUser();
                break;
            case 'changePass':
                $this->changeUserPassword();
                break; 
            case 'listUser':
                $this->listUser();
                break;     
            case 'assignTarget':
                $this->assignTargetToUser();
                break;     
            default:
                $this->errInfo("Check URL");
                break;
        }
    }

    //////////////////////////////init complete here///////////////////////////////////////////////////////


    /*
     * registerNewUser
     */

    private function registerNewUser() {
        
        $this->checkMethod('POST');
        $this->accRightsCheck(2);
        
        $userName = filter_input(INPUT_POST, 'UserName', FILTER_SANITIZE_STRING);
        $userMob = filter_input(INPUT_POST, 'MobileNo', FILTER_SANITIZE_STRING);
        $userEm = filter_input(INPUT_POST, 'Email', FILTER_SANITIZE_EMAIL);
        $userPass = filter_input(INPUT_POST, 'PassWord', FILTER_SANITIZE_STRING);
        $userRole = filter_input(INPUT_POST, 'Role', FILTER_SANITIZE_STRING);
        $entityID = filter_input(INPUT_POST, 'EntityID', FILTER_SANITIZE_STRING);
        
        /*
         * If ther is no required madatory then return
         */
        if (empty($userName)) {
            return $this->crg->setResponseCode(400, 'User Name required');
        } elseif (empty($userMob)) {
            return $this->crg->setResponseCode(400, 'Mobile number required');
        } elseif (empty($userPass)) {
            return $this->crg->setResponseCode(400, 'Password required');
        } elseif (empty($userEm)) {
            return $this->crg->setResponseCode(400, 'Email required');
        } elseif (empty($userRole)) {
            return $this->crg->setResponseCode(400, 'Role required');
        } elseif(empty($entityID)){
            return $this->crg->setResponseCode(400, 'Entity required');
        }
        
        /*
         * Check for already registered
         */
        if ($this->db->have('user_role', ['UserID' => $userMob])) {
            return $this->crg->setResponseCode(400, 'User Mobile already registered');
        }
        
        if ($this->db->have('user', ['Email' => $userEm])) {
            return $this->crg->setResponseCode(400, 'User Email already registered');
        }
           
            $DataToInsertAr = [
                'UserName' => $userName,
                'Email' => $userEm,
                'MobileNo' => $userMob,
                'UserPwd' => md5($userPass),
                'entity_ID' => $entityID,
                'user_ID' => $this->crg->get('userData')['ID'],
                '#AuditDateTime' => date('Y-m-d H:i:s') // time stamp updated at the time of registration that is sending otp, this can be used to otp expiry purpose
            ];
        
        $regData = $this->db->insert('user', $DataToInsertAr);
        //echo $this->db->last_query();    
        
        if($regData >= 1) {
            $desc = "New user created successfully.";
            /////////////////////////update role in user Role table/////////////////// 
            $urData = [
                'RoleID' => $userRole,
                'UserID' => $userMob,
            ];

            $this->db->insert('user_role', $urData);
            ////////////////////////////////////////////////////////////////////////////
            if ($this->db->has('user_role', ["AND" => $urData])) {
                return $this->crg->setResponseCode(200, $desc, NULL, NULL);
            } else {
                return $this->crg->setResponseCode(200, $desc . ' But, user role not Set, Contact admin', NULL, NULL);
            }
        } else {
            $lnk = $this->baseUrl . "/admin/regNewUser";
            return $this->crg->setResponseCode(400, 'Try again', NULL, NULL);
        }

    }

    private function changeUserPassword() {
       
        $this->checkMethod('POST');
        $this->accRightsCheck(2);
        
        $userID = filter_input(INPUT_POST, 'ID', FILTER_SANITIZE_STRING);
        $userPass = filter_input(INPUT_POST, 'PassWord', FILTER_SANITIZE_STRING);
        
        /*
         * If ther is no required madatory then return
         */
        if (empty($userID)) {
            return $this->crg->setResponseCode(400, 'UserID required');
        } elseif (empty($userPass)) {
            return $this->crg->setResponseCode(400, 'Password required');
        } 
       
        
        $regData = $this->db->update('user', ['UserPwd'=>md5($userPass)], ['ID'=>$userID]);
        //echo $this->db->last_query();    
        
        if($regData >= 1) {
            return $this->crg->setResponseCode(200, "User password changed successfully");
        } else {
            return $this->crg->setResponseCode(400, 'Unable to change the user password, Try again!');
        }

    }
    
    private function listUser() {
        
        $this->checkMethod();
        $this->accRightsCheck(2);
       
        $ColInfo = [
                'user.ID'=>'UserID',
                'user.UserName'=>'UserName',
                'user_role.RoleID' => 'Role',
                'user.Email'=>'Email',
                'user.MobileNo'=>'MobileNo',
                'user.entity_ID'=>'EntityID'
                ];
                
        $colAliasData = $this->colWithAlias($ColInfo);

        $ljoint = [
            "[>]user_role" => ["MobileNo"=>"UserID"]
        ];
                
       
        $userData = $this->db->select('user', $ljoint, $colAliasData);
        //echo $this->db->last_query();    
        
        if($userData >= 1) {
            return $this->crg->setResponseCode(200, "Users listed successfully",$userData);
        } else {
            return $this->crg->setResponseCode(400, 'Unable to list users!');
        }

    }
    
    private function assignTargetToUser() {
        
        $this->checkMethod('POST');
        $this->accRightsCheck(2);
                
        $data = [
            'user_ID' => filter_input(INPUT_POST, 'ID', FILTER_SANITIZE_STRING),
            'AssignedToUserID' => filter_input(INPUT_POST, 'AssignedToUserID', FILTER_SANITIZE_STRING),
            'TargetDuration' => filter_input(INPUT_POST, 'TargetDuration', FILTER_SANITIZE_STRING),
            'EnquiryTarget' => filter_input(INPUT_POST, 'EnquiryTarget', FILTER_SANITIZE_STRING),
            'BookingTarget' => filter_input(INPUT_POST, 'BookingTarget', FILTER_SANITIZE_STRING),
            'MailUserYN' => filter_input(INPUT_POST, 'MailUserYN', FILTER_SANITIZE_STRING),
            'entity_ID' => $this->crg->get('userData')['entity_ID'],
            'AuditDateTime' => $currentdatetime
        ];     
       
        $userData = $this->db->insert('usertarget', $data);
        //echo $this->db->last_query();   
        
        $assignToInfo = $this->db->select('user',['UserName'],['ID'=>$data['AssignedToUserID']]);
        $userInfo = $this->db->select('user',['MobileNo','UserName'],['ID'=>$data['user_ID']]);
        
        $message = "Dear ".$userInfo[0]['UserName'].",\n\n"
                   ."Assigned To:\n"
                   .$assignToInfo[0]['UserName']."\n\n"
                   ."Target Duration:\n"
                   .$data['TargetDuration']."\n\n"
                   ."Enquiry Target:\n"
                   .$data['EnquiryTarget']."\n\n"
                   ."Booking Target:\n"
                   .$data['BookingTarget']."\n\n\n"
                   ."Regards,\n"
                   ."YCSTravel App";
        
        $mailtype="targetconf";
        
        if($userData >= 1) {
            
            require_once('lib/Util/Gen.php');
            $genUtil = new Gen;
            
            if($data['MailUserYN']=='Y'){
                if ($genUtil->curlManager($userInfo[0]['MobileNo'], $message, $mailtype)) {
                    return $this->crg->setResponseCode(200, "Tagret assigned and mail sent to user successfully");
                }else{
                    return $this->crg->setResponseCode(200, 'Target assigned but cant able to send mail to the user');    
                }
            }
            
        } else {
            return $this->crg->setResponseCode(400, 'Unable to assign target to users!');
        }

    }
}

/////////End of AdminManager class///////////////////////