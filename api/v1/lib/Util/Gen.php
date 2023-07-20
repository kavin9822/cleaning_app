<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Util;

/**
 * Description of Gen
 *
 * @author ycs-gbs
 */
class Gen {
    protected $crg;
    protected $db;

    protected function __construct($reg = NULL) {
        $this->crg = $reg;
        $this->db = $this->crg->get('db');
    }

    /*
     * Sent Mail
     */
////////////////////////////////////////////////////////////////////////////
    public function curlManager($to, $message, $type) {
        
       $userMob = $to;
       
       $tabName = 'user';
       $colTosel = 'Email';
       $updateWc = ['MobileNo' => $userMob];
 
       if(trim($type) == "forgetpwd"){
       
        $subject = 'YCSTravel App New Password';

        $getUserRole = $this->db->select('user_role', "*", ['UserID' => $userMob]);         

        if (count($getUserRole) < 1) {
            return FALSE;
        }

        $updatePwSucc = FALSE;
        $userRole = $getUserRole[0]['RoleID'];
        if (empty($userRole)) {
           return FALSE;
        }
       
        } elseif(trim($type) == "targetconf"){
            
        $subject = 'YCSTravel App Target Confirmation Mail';    
            
        } else {
        
        $subject = 'YCSTravel App OTP';
        
        }

        $userMail = $this->db->select($tabName, $colTosel, $updateWc);
        
        $from = "admin@whyceeyes.com";
        $headers = "From:" . $from;

        if (mail($userMail[0], $subject, $message, $headers)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }    
    
    public function getUrlContent($url) {
        $ch=curl_init($url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch,CURLOPT_POST,1);
        curl_setopt($ch,CURLOPT_POSTFIELDS,"");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,2);
        $data = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        return ($httpcode >= 200 && $httpcode < 300) ? $data : false;
    }
    
    /*
     * Sent sms
     */
    protected function smsgateway($smsTo, $smsMessage){
    $to = $smsTo;
 	$message = rawurlencode($smsMessage); //This for encode your message content       
	$apikey = "l7RcTNtZ6kSKrb6BRj8ZcQ";
    $apisender = "YAJURR";
    $channel=2;
    $dcs=0;
    $flashsms=0;
    $route=13;

	$x = 'sms.whyceeyes.com/api/mt/SendSMS?';
	$x .= 'APIKey=' . $apikey;
	$x .= '&senderid=' . $apisender;
	$x .= '&channel=' . $channel;
	$x .= '&DCS=' . $dcs;
	$x .= '&flashsms=' . $flashsms;
	$x .= '&number=' . $to;
	$x .= '&text=' . $message;
	$x .= '&route=' . $route;

	//make curl request
	$y = $this->getUrlContent($x);

 	// convert responce json to arr
 	$resp_arr[] = json_decode($y, true);

 	//return true or false
 	return ($resp_arr[0]['ErrorCode']=='000') ? true : false ;
    }


}
