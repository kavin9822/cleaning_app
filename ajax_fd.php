<?php

/*
 * NOT necessary if you set in php.ini file
 * and in windows path
 */
//set_include_path(".;C:\wamp\www\me\lib");

/*
 * Production - linux
 */  
set_include_path(".;C:/xampp/htdocs/cleaning_app/lib");

include_once 'util/ses.php';
$ajxSess = new Session();

include_once 'PhpRbac/database/database.config';

try {
    $Db = new PDO("mysql:host={$host};dbname={$dbname}", $user, $pass);
} catch (Exception $exc) {
    echo $exc->getTraceAsString();
}


/*
 * make sures you can call only from the host we set
 * and only post request
 * so you cant access the script directly from url
 */

if ($_SERVER['HTTP_HOST'] === 'http://localhost/' && $_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['column_name'] && $_POST['seach_value']) {

    switch ($_POST['dtype']) {
        case 'select':
            $q = '`' . $_POST['column_name'] . "` = '" . $_POST['seach_value'] . "'";
            break;
        case 'clear':
            $q = NULL;
            break;

        case 'date':
            $q = $_POST['seach_value'];
            break;


        default:
            $q = '`' . $_POST['column_name'] . "` LIKE '%" . $_POST['seach_value'] . "%'";
            break;
    }

    if ($_POST['dtype'] !== 'clear') {
      $_SESSION[$_POST['dtype']][$_POST['table_name']][$_POST['column_name']] = $_POST['seach_value'];
    } 

    $_SESSION['filter_query'][$_POST['table_name']] = $q;
    echo $q;  
}