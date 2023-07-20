<?php

// production
ini_set('display_errors', 'off');

//Set default local timezone(IST) settings.
date_default_timezone_set('Asia/Kolkata');

/*
 * Production - linux
 */
set_include_path(".;C:/xampp/htdocs/cleaning_app/api/v1/lib");

/*
 * Master registry class
 */

include_once 'Util/Registry.php';
$rg = new Util\Registry();
$rg->setJsonHeader();

/*
 * Configuration loading 
 * from ini file 
 */

$rg->set('appConfig', require_once 'config/application.config.php');

/*
 * ///////////////////Work to get url data///////////////////////
 */
$confData = $rg->get('appConfig');


//$req_uri = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_URL);
$req_uri = $_SERVER['REQUEST_URI'];
/////////////////new addition - rem question mark if applicable/////////////////////////////
if (strstr($req_uri, "?")) {
    $remQuestionMark = explode('?', $req_uri, 2);
    $req_uri = $remQuestionMark[0];
}
//////////////////////////////////////////
$trimSlash = trim($req_uri, '/');

//remove base folder string from REQUEST_URI
$yx = substr($trimSlash,strlen($confData['base_folder'])+1);
///explode in to controller key
$uri_array = explode('/', trim($yx, '/'), 10);

/*
 * Save base Folder and uri array in registry for any use inside class
 */
$rg->set('base_folder', $confData['base_folder']);
$rg->set('uri_array', $uri_array);

/////////////////////////////////////////////////////////
////////////////get headers //////////////
$getheader = getallheaders();
$rg->set('HttpHeaders', $getheader);
////////////////////////////////////////////////////////

// $logfile = './resource/transactionlog/Log_' . date("M_Y") . '.txt';
//             chmod('./transactionlog', 0777);

//             if (file_exists($logfile)) {
//                 file_put_contents($logfile, "\n" . "[" . date("d-m-Y H:i:s") . "]" . "{" . print_r($getheader) . "}", FILE_APPEND);
//             } else {
//                 $handle = fopen("$logfile", "w+");
//                 fwrite($handle, "[" . date("d-m-Y H:i:s") . "]" . "{" . print_r($getheader) . "}");
//                 fclose($handle);
//             }
/*
 * $UrlBasedPermission = $rg->get('uri_array')[0];
 * This is the permission string we are going to use to call a function
 */
$PermissionStringFromUrl = isset($uri_array[0]) ? $uri_array[0] : FALSE;

///////////////////////////////////////////////////
if ($PermissionStringFromUrl) {
    $dbDnsInfo = include_once 'config/database.config.php';
    include_once 'Db/medoo.php';
    $db = new Medoo($dbDnsInfo);
    if (!$db) {
        return $rg->setResponseCode(500, 'No such Class exists');
    } //return if db object failed to create //header and err message set alreadt inside medoo class
    //var_dump($db);
    /*
     * Set to reg for use inside the class
     */
    $rg->set('db', $db);
    //for queries u write manually require table prefix
    $rg->set('tablePrefix', $dbDnsInfo['prefix']);

    $getClassInfo = $db->get("permission_api", "*", ["PremissionID" => $PermissionStringFromUrl]);
    //var_dump($getClassInfo);
    if (!empty($getClassInfo)) {
        $moduleFolder = trim($getClassInfo['Module']);
        $controlerCls = trim($getClassInfo['Controller']);
        $rg->set('moduleFolder', $moduleFolder);
        $rg->set('controlerCls', $controlerCls);
    } else {
        return $rg->setResponseCode(404, 'No such method to call so check the url part : ' . $PermissionStringFromUrl);
    }
///////////////////////////////////////////////////////////////////////////////////    
///////////////////////access public class call in public module//////////////////
/////////////////////////////////////////////////////////////////////////////
    if ($getClassInfo['AccessPublic'] === 'Y' && $moduleFolder === 'public') {
        $publicAccessInfo = include_once 'config/public.access.config.php';

        //print_r($publicAccessInfo);
        $IsPublicAccess = FALSE;
        if (is_array($publicAccessInfo)) {
            foreach ($publicAccessInfo as $pubvalue) {
                if ($pubvalue === $PermissionStringFromUrl) {
                    $IsPublicAccess = TRUE;
                    break;
                }
            }
        }

        if ($IsPublicAccess) {
            //////////////////////////////////////////////        
            $fileName = './modules/public/' . $controlerCls . '.php';
            if (is_file($fileName)) {
                include_once $fileName;
                if (class_exists($controlerCls, FALSE)) {
                    /*
                     * instantiate class
                     */

                    $MyControlerObj = new $controlerCls($rg);
                    return $MyControlerObj->init();
                    ////////////////////////////////
                } else {
                    return $rg->setResponseCode(404, 'No such public Class to call');
                }
            } else {
                return $rg->setResponseCode(404, 'File Not found');
            }
            ///////////////////////////////////
        } else {
            return $rg->setResponseCode(404, $PermissionStringFromUrl . ' not found in public access config');
        }
    }//no else part if not access public keep going 
} else {
    return $rg->setResponseCode(404, 'no permission part in the URL');
}
/////////////////////////////////////////////////////////////////////////
////////////////////////////////Public module close///////////////////////////
/////////////////////////////////////////////////////////////////////////////

/*
 * Check for access tocken
 * from the header
 */
if (isset($getheader['Authorization']) && !empty($getheader['Authorization'])) {

    $tokenArr = explode(' ', $getheader['Authorization'], 2);
    $AccessToken = trim(array_pop($tokenArr));
    if (!empty($AccessToken)) {
        //example Bearer, Basic
        //we dont do anythig as of now
        $AccessTokenType = array_shift($tokenArr);
    } else {
        $AccessToken = FALSE;
        return $rg->setResponseCode(401, 'Access token is empty');
    }
} else {
    $AccessToken = FALSE;
    return $rg->setResponseCode(401, 'Authorization header not set or empty');
}

/*
 * If $PermissionStringFromUrl and $AccessToken is present
 * then proceed with accessing resource
 */

if ($PermissionStringFromUrl && $AccessToken) {
///////////////////////////////////////////////////
    //where condition for acess token - bed_access_token`
    $ws1 = ["AND" => [
            'AccessToken' => $AccessToken,
            "#AuditDateTime[>]" => "(NOW() - INTERVAL " . (int) $confData['SessionDuration'] . ' MINUTE)'
        ]
    ];

    //get User Id , we use mobile number as user id
    $userID = $db->select('access_token_api', 'UserID', $ws1);
    if (count($userID) < 1) {//stop if dont get any user id
        return $rg->setResponseCode(401, 'Session expired');
    }
    $userID = $db->select('users', 'ID',['user_email' => $userID[0]]);
    //$AccessToken
    //get multiple roles of a user identified by mobile number we named as UserID
    $roleID = $db->select('userroles', 'RoleID', ['UserID' => $userID[0]]);
    
    $userData = $db->select('users', ['ID','user_nicename','user_email','entity_ID'], ['ID' => $userID[0]]);
    $rg->set('userData', $userData[0]);
    
    if (count($roleID) < 1) {//stop if role was not set
        return $rg->setResponseCode(401, 'Contact admin, To assign Role');
    }

    $rpCol = [
        'PermissionID'
    ];

    $rpWr = [
        "AND" => [
            //'PermissionID' => $PermissionStringFromUrl,
            'RoleID' => $roleID[0] //for multiple roles use complete array of $roleID
        ]
    ];

    $accData = $db->select('rolepermissions', $rpCol, $rpWr);
    if (count($accData) < 1) {//stop if role was not set
        $accessMag = 'Contact admin, Permission (' . $PermissionStringFromUrl . ') was not asigned to this Role (' . $roleID[0] . ')';
        return $rg->setResponseCode(401, $accessMag);
    }
    //var_dump($accData);die;
    /*
     * allowed to call the class and method if access rights is > 0 
     */
    if (!empty($accData[0])) {
        //set to reg
        $rg->set('Access_rights', $accData[0]);
        //////////////////////////////////////////
        ///////////////////new addition in index.php/////////////////////
        $rg->set('Access_token', $AccessToken);
        /////////////////////////////////////////
        $rg->set('UserID', $userID[0]);
        $rg->set('RoleID', $roleID[0]);
        ///////////////////////////////////////
        //////////////////////////////////////////////        
        $fileName = './modules/' . $moduleFolder . '/' . $controlerCls . '.php';
        if (is_file($fileName)) {
            include_once $fileName;
            if (class_exists($controlerCls, FALSE)) {
                /*
                 * instantiate class
                 */
                $MyControlerObj = new $controlerCls($rg);
                return $MyControlerObj->init();
                ////////////////////////////////
            } else {
                return $rg->setResponseCode(404, 'No such Class exists');
            }
        } else {
            return $rg->setResponseCode(404, 'File not found');
        }
    } else {
        return $rg->setResponseCode(401, 'Access restricted, This Role restricted to access the permssion or resource');
    }
} else {
    /*
     * Improper request
     */
    if (empty($PermissionStringFromUrl)) {
        return $rg->setResponseCode(400, 'Permission String From Url was not set, Ex: /customer/update/id, here update string');
    }

    /*
     * unauthorised required login
     */
    if (empty($AccessToken)) {
        return $rg->setResponseCode(401, 'unauthorised required login');
    }
}