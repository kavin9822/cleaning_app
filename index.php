<?php

// development
 //ini_set('display_errors', 'On');
// production

 ini_set('display_errors', 'Off');

/*
 * NOT necessary if you set in php.ini file
 * and in windows path
 */
//set_include_path(".;C:\wamp\www\me\lib");

//Set default local timezone(IST) settings.
date_default_timezone_set('Asia/Kolkata');

/* 
 * Production - linux
 */  
 
 set_include_path(".;C:/xampp/htdocs/cleaning_app/lib");
 
//set_include_path(".:/home/kosheahl/public_html/dev/lib");

/*
 * Master registry class
 */
require_once 'util/ycs.php';
$rg = new Registry();


/*
 * Session stared and 
 * session object is set in the reg
 * you can access using 
 * $rg->get('sess');
 * or even 
 * $_SESSION[]
 */


$rg->set('ses', new Session());


/*
 * Required in all classes
 * we can instantiate in the home landing page itself
 * part of ycs.php 
 */

$rg->set('SD', new SecureData());


/*
 * Configuration loading 
 * from ini file
 */
$rg->set('ycs_config', parse_ini_file('config/config.ini', TRUE));

/*
 * Deliver the data to a tpl varaibale 
 */
$rg->set('deliver_at', 'content');


/*
 * ///////////////////////////////////////////////////////////////////////////
 * ///////////////////////////Template engine///////////////////
 * /////////////////////////////////////////////////////////////////////////
 */
$theme_path = $rg->get('ycs_config')['theme']['THEME_PATH'];
$rg->set('tpl', new View($theme_path));


$rg->get('tpl')->set('company_name', $rg->get('ycs_config')['Company_Info']['COMPANY_NAME']);
$rg->get('tpl')->set('company_short_name', $rg->get('ycs_config')['Company_Info']['COMPANY_SHORT_NAME']);
$rg->get('tpl')->set('company_Address', $rg->get('ycs_config')['Company_Info']['COMPANY_ADDRESS']);
$rg->get('tpl')->set('company_Tin', $rg->get('ycs_config')['Company_Info']['COMPANY_TIN_NO']);
$rg->get('tpl')->set('company_Cst', $rg->get('ycs_config')['Company_Info']['COMPANY_CST_NO']);
$rg->get('tpl')->set('company_SerTax', $rg->get('ycs_config')['Company_Info']['COMPANY_SERVICETAXNO']);
$rg->get('tpl')->set('company_Cin', $rg->get('ycs_config')['Company_Info']['COMPANY_CIN_NO']);
$rg->get('tpl')->set('company_Gst_no', $rg->get('ycs_config')['Company_Info']['COMPANY_GST_NO']);
$rg->get('tpl')->set('company_Sac_code', $rg->get('ycs_config')['Company_Info']['COMPANY_SAC']);
$rg->get('tpl')->set('company_url', $rg->get('ycs_config')['Company_Info']['COMPANY_WEBSITE']);
$rg->get('tpl')->set('currencySymbol', $rg->get('ycs_config')['currency']['CURRENCY_SYMBOL']);
$rg->get('tpl')->set('application_ip', $rg->get('ycs_config')['host']['APPLICATION_IP']);

/*
 * ///////////////////////////////////////////////////////////////////////
 * ////////////Router components starts here//////////////////////////////
 * //////////////////////////////////////////////////////////////////////
 */

$route = array(
    'host_name' => trim($rg->get('ycs_config')['host']['HOST_NAME'], '/'),
    'base_folder' => trim($rg->get('ycs_config')['host']['BASE_FOLDER'], '/')
);

/*
 * base path of the url
 * Example: www.ycs.com
 */
if ($route['base_folder']) {
    $route['base_path'] = $route['host_name'] . '/' . $route['base_folder'];
} else {
    $route['base_path'] = $route['host_name'];
}
/*
 * Refers the base path or home url
 */
$rg->get('tpl')->set('home', $route['base_path']);

/*
 * Theme path to call css in js with complete url
 */
$route['full_theme_Path'] = $route['base_path'] . '/' . $theme_path;

/*
 * Set to the template using a varibale $themePath
 * use to call css and js files
 */

$rg->get('tpl')->set('themePath', $route['full_theme_Path']);
$rg->get('tpl')->set('logo_image', $route['full_theme_Path'] . '/' . $rg->get('ycs_config')['theme']['LOGO_FILE']);
$rg->get('tpl')->set('invoice_logo', $route['full_theme_Path'] . '/' . $rg->get('ycs_config')['theme']['INV_LOGO']);
$rg->get('tpl')->set('ycias_logo', $route['full_theme_Path'] . '/' . $rg->get('ycs_config')['theme']['YCIAS']);

/*
 * Contain information about
 * Module,conotroller, action
 */
$route['req_uri'] = trim(ltrim(trim($_SERVER['REQUEST_URI'], '/'), $route['base_folder']), '/');

/*
 * The reference url from which the request comes
 */
$route['ref_url'] = $route['base_path'] . '/' . $route['req_uri'];

$rg->get('tpl')->set('ref_url', $route['ref_url']);
/*
 * Split the uri to arrays 
 * in the array 
 * 0 - refers module
 * 1 - referes controller
 * 2 refers - action
 * 3 - crud - creat, update, delete and submit
 */
$route['uri_array'] = explode('/', $route['req_uri']);

/*
 * Setting module
 */
if (isset($route['uri_array'][0]) && $route['uri_array'][0] !== '') {
    $route['module'] = $route['uri_array'][0];
    $clsMap_fileName = './modules/' . $route['module'] . '/cls_map.ini';
    if (file_exists($clsMap_fileName)) {
        $route['module_conf'] = parse_ini_file($clsMap_fileName, TRUE);
    } else {
        $rg->get('tpl')->set('content', 'No such modules please chck the url');
    }
} else {
    $route['module'] = $rg->get('ycs_config')['host']['DEFAULT_MODULE'];
    $clsMap_fileName = './modules/' . $route['module'] . '/cls_map.ini';
    if (file_exists($clsMap_fileName)) {
        $route['module_conf'] = parse_ini_file($clsMap_fileName, TRUE);
    } else {
        $rg->get('tpl')->set('content', 'problem with default module itself');
    }
}

/*
 * Controller settings
 * @ how it WORKs
 * IF{
 *  COLLECT CONTROLLER INFORMATION FROM URL
 *  }ELSE{
 *  GET default controller of the selected MODULE
 * }
 */

if (isset($route['uri_array'][1]) && $route['uri_array'][1] !== '') {
    $route['controller'] = $route['uri_array'][1];
} else {
    $route['controller'] = $route['module_conf']['Landing_Page']['DEFAULT_CONTROLLER'];
}
//////////////////////////////////////////////////////////////////////////////////

/*
 * Setting Action or calling the function in a class
 */
if (isset($route['uri_array'][2]) && $route['uri_array'][2] !== '') {
    $route['action'] = $route['uri_array'][2];
} else {
    $route['action'] = $route['module_conf']['Landing_Page']['DEFAULT_ACTION'];
}

//var_dump($route);
$rg->get('tpl')->set('module', $route['module']);
$rg->get('tpl')->set('controller', $route['controller']);
$rg->get('tpl')->set('method', $route['action']);


/*
 * Setting CRUD action data from url - first priority
 * Default is set during the call
 * at Crud2 class at Crud2.php
 */
if (isset($route['uri_array'][3]) && $route['uri_array'][3] !== '') {
    $route['crud'] = $route['uri_array'][3];
    $rg->get('tpl')->set('crud', $route['crud']);
}

/*
 * this is used crud form submit
 * to find which form is this 
 * is it submit of edit form
 * or add form
 */

if (isset($route['uri_array'][4]) && $route['uri_array'][4] !== '') {
    $route['crud_form_submit_from'] = $route['uri_array'][4];
}


/////////////////////////////
//set title to theme/////////
/////////////////////////////

$rg->get('tpl')->set('title', ucfirst($route['module']) . '|' . ucfirst($route['controller']) . '|' . ucfirst($route['action']));

/*
 * path of the templates inside the theme folder
 * used in fetch command
 * example
 * $this->tpl->set('content', $this->tpl->fetch($this->crg->get('route')['tpl_path_inside_theme'] . '/logout_message.php'));
 */
$route['tpl_path_inside_theme'] = 'modules/' . $route['module'];


/*
 * set the route array to the registry
 * Use this registry data in side the classes
 */
$rg->set('route', $route);
/////////////////////////////////////////////////////////////////////////////////
//////////////////////////path information is ready now/////////////////////////
///////////////////////////Also set the the registry////////////////////////////
////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
///////////////////Apply access controll here////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////
// Instantiate PhpRbac\Rbac object
require_once 'PhpRbac/autoload.php';
$rbac = new PhpRbac\Rbac();

/*
 * //////////////////////////////////////////////////////////////////////////
 * ///////////////////////Database connection//////////////////////////////
 * ///////////////////////phpRbac - connection is used in the application/////////////////////// 
 * ///////////So connection object is taken from a place that is it////////////////////
 */

$rg->set('rbac', $rbac);
$rg->set('db', Jf::$Db);
$rg->set('table_prefix', Jf::$TABLE_PREFIX);


/*
 * User Login Attempt
 */
/*
 * Any one view the applciation
 * we call them as guest - Role
 * 
 */

if ($rg->get('ses')->get('user')['ID'] && $rg->get('ses')->get('user')['user_email']) {
    $user_id = $rg->get('ses')->get('user')['ID'];
    $rg->get('tpl')->set('whoIsOnline', $rg->get('ses')->get('user')['user_nicename']);
    $rg->get('tpl')->set('userEntity', $rg->get('ses')->get('user')['entity_Title']);
    $rg->get('tpl')->set('EntityShortCode', $rg->get('ses')->get('user')['short_code']);
    $rg->get('tpl')->set('whoIsOnline_status', 'Online');
    $rg->get('tpl')->set('user_menu', $rg->get('tpl')->fetch('modules/user/user_logout_menu.php'));
} else {
    //guest user id
    //user id 0 not defined or created in the database intentionally
    $user_id = 0;
    $rg->get('tpl')->set('whoIsOnline', 'Guest');
    $rg->get('tpl')->set('user_menu', $rg->get('tpl')->fetch('modules/user/user_login_menu.php'));
}


/*
 * if you have minimum read access you can call this function
 * Else you are not a allowed
 */

try {
    $permission_write = $route['module'] . '_' . $route['controller'] . '_' . $route['action'] . '_write';
    if ($rbac->Permissions->returnId($permission_write)) {

        if ($rbac->check($permission_write, $user_id)) {
            //echo 'you have write permission that means also read permission';
            $rg->set('wp', TRUE);
            $rg->set('rp', TRUE);
        } else {
            $rg->set('wp', FALSE);
        }
    } else {
        // there is no such permission
        // is called make through that is true
        $rg->set('wp', TRUE);
    }

    /*
     * if u have write permission then u are automatically have read permission
     * so $rg->get('rp') is true already 
     * so set read only  if u not having read permission if(!$rg->get('rp')){
     */


    if (!$rg->get('rp')) {
        $permission_read = $route['module'] . '_' . $route['controller'] . '_' . $route['action'] . '_read';
        $rbac->Permissions->returnId($permission_read);
        if ($rbac->Permissions->returnId($permission_read)) {
            if ($rbac->check($permission_read, $user_id)) {
                //echo 'you have read permission';
                $rg->set('rp', TRUE);
            } else {
                $rg->set('rp', FALSE);
            }
        } else {
            // there is no such permission
            // is called make through that is true
            $rg->set('rp', TRUE);
        }
    }


    /*
     * set permission to template
     */
    $rg->get('tpl')->set('wp', $rg->get('wp'));
    $rg->get('tpl')->set('rp', $rg->get('rp'));
} catch (Exception $exc) {
    
}
//////////////////////Access control end if///////////////////////////////////    


/*
 * For the route controller fix the correspoding class name
 * Here
 * url path name of controller is not directly used to call a class
 * This we are doing only for controller
 * 
 */


$route['controller_class'] = $route['module_conf']['Class_Map'][$route['controller']];

$cls_fileName = './modules/' . $route['module'] . '/' . $route['controller_class'] . '.php';

if (file_exists($cls_fileName)) {
    include_once $cls_fileName;
    if (class_exists($route['controller_class'])) {
        $calAnObject = new $route['controller_class']($rg);

        if (method_exists($calAnObject, $route['action'])) {
           $calAnObject->{$route['action']}();			
       
        } else {
            $rg->get('tpl')->set('content', 'There is no such function to call');
        }
    } else {
        $rg->get('tpl')->set('content','Return and say  No such class exists');
    }
} else {
    $rg->get('tpl')->set('content', 'Return and say  No such file exists');
}
///////////////////////////////////////////////////////////////////////////////    




if ($rg->get('tpl')->get('master_layout')) {
  $rg->get('tpl')->render($rg->get('tpl')->get('master_layout'));
} else {
   $rg->get('tpl')->render('layout.php');
}    