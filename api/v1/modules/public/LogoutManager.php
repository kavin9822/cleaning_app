<?php

/**
 * @Desc Permission Manager in admin module
 * @author Gunabalans
 */
class LogoutManager {

    private $crg;
    private $db;
    private $getHeaders;
    private $req_method;

    public function __construct($reg = NULL) {
        $this->crg = $reg;
        $this->db = $this->crg->get('db');
        $this->getHeaders = $this->crg->get('HttpHeaders');
        // $this->req_method = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);
         $this->req_method = $_SERVER['REQUEST_METHOD'];
    }

///////////////Constructor completed here/////////////////
//////////////////////////////////////////////////////////

    public function init() {
        //check for request method
        if ($this->req_method !== 'GET') {
            return $this->crg->setResponseCode(400, 'Request method should be GET');
        }

        //check whether he has already loged in 
/////////////////////////////////////////////////////////////////////////////////////////////            
        if (isset($this->crg->get('HttpHeaders')['Authorization']) && !empty($this->crg->get('HttpHeaders')['Authorization'])) {

            $tokenArr = explode(' ', $this->crg->get('HttpHeaders')['Authorization'], 2);
            if (count($tokenArr) > 1) { //require two part bearer token
                $AccessToken = trim(array_pop($tokenArr));                
                
            ////////////refreshing the fcm access token///////////////////////////////////
            $mobData=$this->db->select('access_token_api', "*", ['AccessToken' => $AccessToken]);     
            $useremail = $mobData[0]['UserID'];
		
            $userTable = 'users';
			$updateWc = ['user_email' => $useremail];

		//////////////////////////////////////////////////////////////////////////////

                //$AccessTokenType = array_shift($tokenArr);
                if ($this->db->have('access_token_api', ['AccessToken' => $AccessToken])) {
                    $this->db->delete('access_token_api', ['AccessToken' => $AccessToken]);
                    return $this->crg->setResponseCode(200, 'Logout successfully');
                } else {
                    return $this->crg->setResponseCode(400, 'Logout Failed');
                }
                
            }
        }
    }

/////////////////////////////////////////////////////////////////////////////////////////////////

    /*
     * End of Class
     */
}
