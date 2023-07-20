<?php

include_once './set_inc_path.php';


//set_include_path(".:/home2/sreensta/public_html/lib");

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

if($_POST["ColumnValue"]){
    
    $tablename=$_POST["firsttable"];
    
    
   // echo $tablename ;
   // var_dump($tablename);
    
     $secondtable=$_POST["secondtable"];
    
    // echo $secondtable ;
    //var_dump($secondtable);
    
     
     $wheretable=$_POST["wheretable"];
    

    
     
     $selectcolumnname=$_POST["selectcolumn"];
     $selectid=$_POST["selectid"];
    
    $firsttab_name = $tablePrefix .$tablename;
    $secondtab_name = $tablePrefix .$secondtable;
    $wheretab_name = $tablePrefix .$wheretable;
     
      $sql_query="SELECT $firsttab_name.ID,$selectcolumnname FROM $firsttab_name,$secondtab_name  WHERE $secondtab_name.$selectid = $firsttab_name.ID and $wheretab_name.ID='".$_POST['ColumnValue']."'";
    
	try {
                $stmt = $Db->prepare($sql_query);
                if ($stmt->execute()) {

                 $Data_rows = $stmt->fetchAll(2);
                    
  
                 if(count($Data_rows) >= 1){
		        http_response_code();		                 
                 echo json_encode($Data_rows);
                 
                 
                 }else{
	 	http_response_code(204);
	 	
    		}   
                 
                } else {
                   http_response_code(204);
                }
               
            } catch (Exception $exc) {
               http_response_code(500);
            }
  
    
}