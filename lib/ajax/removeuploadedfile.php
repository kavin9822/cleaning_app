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

try {
        
            $args = array(
            'columnid' => FILTER_SANITIZE_STRING,
            'tablename' => FILTER_SANITIZE_STRING
            );
    
            $attach_id = filter_input(INPUT_POST, 'columnid', FILTER_SANITIZE_STRING);
            $table_name = filter_input(INPUT_POST, 'tablename', FILTER_SANITIZE_STRING);
           

        $attachment_table_name = $tablePrefix . $table_name;

 
        $attached_id = false;
        if(!empty($attach_id)){
           $attached_id  =  $Db->quote($attach_id);
        }
       
        if(empty($attached_id)){
            http_response_code(204);
            echo json_encode(array('message' => 'failed to remove'));
            return;
        }
        //   $sqlsel_del = "SELECT document_path FROM $attachment_table_name WHERE ID  = $attached_id";
        //   $stmt = $Db->prepare($sqlsel_del);
        //   $stmt->execute();
        //   $resource_data = $stmt->fetchAll(2);
         
        //  if(!empty($resource_data)){
        //     foreach($resource_data as $k=>$v){
        //           $attached_filepath  =  $Db->quote(substr($v['document_path'], 2));
        //           unlink($attached_filepath);
        //     }
        //  }
         
        $sql_query = "DELETE FROM `$attachment_table_name` WHERE ID = $attached_id";
        $stmt = $Db->prepare($sql_query);
        
        if($stmt->execute()){
         	http_response_code(200);
         	echo json_encode(array('message' => 'Removed Succesfully'));
        }else{
             	http_response_code(204);
             	echo json_encode(array('message' => 'failed to remove'));
            
        }

    } catch (Exception $exc) {
          http_response_code(204);
          echo json_encode(array('message' => 'failed to remove'));
          
    }
   
?>


       