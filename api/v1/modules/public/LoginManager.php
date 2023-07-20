<?php

/**
 * @Desc Permission Manager in admin module
 * @author Gunabalans
 */
class LoginManager {

    private $crg;
    private $db;
    private $getHeaders;
    private $req_method;

    public function __construct($reg = NULL) {
        $this->crg = $reg;
        $this->db = $this->crg->get('db');
        $this->getHeaders = $this->crg->get('HttpHeaders');
        //$this->req_method = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);
        $this->req_method = $_SERVER['REQUEST_METHOD'];
    }

///////////////Constructor completed here/////////////////


    public function init() {
        //check for request method
        if ($this->req_method !== 'POST') {
            return $this->crg->setResponseCode(400, 'Request method should be POST');
        }

        $ctype = strtolower(trim($this->getHeaders['Content-Type']));
        $act_ctype = explode(';',$ctype);
        
        //check for content type
        if (empty($ctype)) {
            return $this->crg->setResponseCode(400, 'Content type Not set, Request header Content-Type application/x-www-form-urlencoded - Required');
        }

        if ($act_ctype[0]!='application/x-www-form-urlencoded') {
            return $this->crg->setResponseCode(400, 'Request header Content-Type application/x-www-form-urlencoded - Required');
        }

        return $this->userLogin();
    }

    //////////////////////////////init complete here///////////////////////////////////////////////////////
    /*
     * You can add custom class method her
     */

    protected function userLogin() {
        /*
         * Get login form post data user Name
         */
        $useremail = filter_input(INPUT_POST, 'user_email', FILTER_SANITIZE_EMAIL);
        $userPasswd = filter_input(INPUT_POST, 'user_pass', FILTER_SANITIZE_STRING);

        if (empty($useremail) || empty($userPasswd)) {
            return $this->crg->setResponseCode(400, 'Login require Email and password');
        }

        //$getUserRole[0]['RoleID'] //$getUserRole[0]['profileUpdated'] are got from this select statement
        $getUserRole = $this->db->select('user_role', "*", ['UserID' => $useremail]);

        if (count($getUserRole) !== 1) {
            return $this->crg->setResponseCode(401, 'There is no registered user with this email');
        }

        ////////////////////////////////////////////////////////////////////////////
        $this->stringFromUrl = isset($this->crg->get('uri_array')[1]) ? $this->crg->get('uri_array')[1] : FALSE;

        
        //user table can be student or faculty
        $pw = trim($userPasswd);
        $pw = md5($pw);
        
        $userTable = 'users';
        $wcon = ["AND" => ["user_email" => $useremail, "user_pass" => $pw]];
        $loginUserInfo = [
            'user_nicename' => 'user_nicename',
            'user_mobileno' => 'user_mobileno'
        ];

        $colAliasData = [];
        foreach ($loginUserInfo as $key => $value) {
            $colAliasData[] = $key . '(' . $value . ')';
        }

        //mobile number is used for usere id// login check
        $loginUserData = $this->db->select($userTable, $colAliasData, $wcon);
	    
        $noMobile = $this->db->select('users', 'user_mobileno', ['user_email'=> $useremail]);
        
        
        if(count($getUserRole) == 1 && count($noMobile)!==1){
            return $this->crg->setResponseCode(401, 'There is no registered user with this mobile number');
        }
	
        if (count($loginUserData) >= 1) {

            //add login count 
            //On login successfull - create access tocken
            $strAccessToken = md5(uniqid($useremail . rand(), TRUE));

            $AccessData = [
                'AccessToken' => $strAccessToken,
                'UserID' => $useremail,
            ];
            
            //insert in to access token data
            $this->db->insert('access_token_api', $AccessData);
            //check whether inserted
            if ($this->db->have('access_token_api', ['AccessToken' => $strAccessToken])) {
                $AccessData['Role'] = $getUserRole[0]['RoleID']; //actual role from user_role table agent, admin and other roles
               
                foreach ($loginUserData[0] as $key => $value) {
                    $AccessData[$key] = $value;
                }
                return $this->crg->setResponseCode(200, 'login successfull', $AccessData);
            } else {
                return $this->crg->setResponseCode(400, 'Failed to login (Session failed create)');
            }
        } else {
            //here is the login attempt failed due to wrong password
            //update the count in user role table
            //we can implement here

            return $this->crg->setResponseCode(400, 'Failed to login, enter a valid password');
        }
        
        
    }

// login

    public function logout($param) {
        
    }

    /*
     * End of Class
     */
}
