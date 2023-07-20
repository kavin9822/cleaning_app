<?php

/*
 * Production - linux
 */

include_once './set_inc_path.php';

include_once 'util/ses.php';
$ajxSess = new Session();

include_once 'PhpRbac/database/database.config';

try {
    $Db = new PDO("mysql:host={$host};dbname={$dbname}", $user, $pass);
} catch (Exception $exc) {
    
}


header('Content-Type: application/json');


/*
 * make sures you can call only from the host we set
 * and only post request
 * so you cant access the script directly from url
 */


if(isset($_POST["view"])){

$user_tab = $tablePrefix . 'users'; 
$appprocess_tab = $tablePrefix . 'approvalprocess';  

$entityID = $ajxSess->get('user')['entity_ID'];

$query = "SELECT COUNT(*) AS MailCount FROM $appprocess_tab a JOIN $user_tab s ON s.ID = a.sendfromUser_ID JOIN $user_tab f ON f.ID = a.sendtoUser_ID where a.ApprovalStatus=0";

$stmt = $Db->prepare($query);
$stmt->execute();
$result_count = $stmt->fetchAll(2);

$output = '';

if(isset($result_count[0]['MailCount'])){
$count = $result_count[0]['MailCount'];
} else {
$count = 0;
}

$data = array(
   'unseen_notification'  => $count
);

echo json_encode($data);
}
?>