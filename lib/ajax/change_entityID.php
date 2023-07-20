<?php

/*
 * Production - linux
 */

//set_include_path(".c:/mfh//gmhdemo/lib");
// set_include_path(".;C:/xampp/htdocs/mfg/lib");
set_include_path(".:/home/whyceffy/public_html/mfg/lib");

include_once 'util/ses.php';
$ajxSess = new Session();

include_once 'PhpRbac/database/database.config';

try {
    $Db = new PDO("mysql:host={$host};dbname={$dbname}", $user, $pass);
} catch (Exception $exc) {
    
}
header('Content-Type: application/json');

if($_POST["entityID"]){

	$entity_tab = $tablePrefix . 	'entity';

 
  
     $sql_query  = "SELECT  Title,ShortCode FROM  $entity_tab where ID='".$_POST['entityID']."'";		
  
	try {
                $stmt = $Db->prepare($sql_query);
                if ($stmt->execute()) {

                 $Data_rows = $stmt->fetchAll(2);
               
                 if($Data_rows[0]){
                    
		             $_SESSION['user']['entity_ID'] = $_POST['entityID'];
                     $_SESSION['user']['entity_Title']=$Data_rows[0]['Title'];
                     $_SESSION['user']['short_code']=$Data_rows[0]['ShortCode'];
                     echo json_encode('Branch Changed',true);
                 }
                } else {
                   http_response_code(204);
                }
            } catch (Exception $exc) {
               http_response_code(500);
            }
 
}



?>