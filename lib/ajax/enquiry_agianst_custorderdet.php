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

if($_POST["ColumnValue"]){
    
    
    $enquiry_tab = $tablePrefix .'enquiry';
    $pdndept_tab = $tablePrefix .'pdndepartment';
    $pdnorder_tab = $tablePrefix . 'productionorder';
    $cust_order_tab = $tablePrefix . 'customerorder';
    $cust_order_dettab = $tablePrefix . 'customerorder_detail';
    $unit_tab = $tablePrefix .'unit';
    $product_tab = $tablePrefix .'product';

    $entityID = $ajxSess->get('user')['entity_ID'];
    $enquiry_id=trim($_POST['ColumnValue']);
    
    
            $sql_query ="SELECT $cust_order_dettab.custorder_ID as ID,
                         $cust_order_dettab.ProductNo,
                         $product_tab.ProductName,
                         $cust_order_dettab.PdtDescription,$unit_tab.UnitName,
                         $cust_order_dettab.Quantity,$cust_order_dettab.Price,
                         $cust_order_dettab.Amount
                         FROM $cust_order_dettab
                         LEFT JOIN $cust_order_tab ON $cust_order_dettab.custorder_ID=$cust_order_tab.ID 
                         LEFT JOIN $enquiry_tab ON $cust_order_tab.enquiry_ID=$enquiry_tab.ID 
                         LEFT JOIN $unit_tab ON $cust_order_dettab.unit_ID=$unit_tab.ID 
                         LEFT JOIN $product_tab ON $cust_order_dettab.Product_ID=$product_tab.ID 
                         WHERE $cust_order_tab.enquiry_ID='$enquiry_id'";

    	try {
                $stmt = $Db->prepare($sql_query);
              // var_dump($sql_query);
                if ($stmt->execute()) {

                $Data_rows = $stmt->fetchAll(2);
               
                 $i=1;
                 foreach($Data_rows as $k => $v){
                     unset($Data_rows[$k]["ID"]);
                     $Data_rows[$k]["ProductNo"]= "<input id='ItemNo_$i' name='ItemNo_$i' class='form-control' value= '".$v['ProductNo']."' type='text' readonly>";
                     $Data_rows[$k]["ProductName"]= "<input id='ItemName_$i' name='ItemName_$i' class='form-control' value= '".$v['ProductName']."' type='text' readonly><input name='Id_$i' id='Id_$i' class='form-control' value='".$v['ID']."' type='hidden'>";
                     $Data_rows[$k]["PdtDescription"]="<input id='Note_$i' name='Note_$i' class='form-control'  type='text' value= '".$v['PdtDescription']."'  readonly>";
                     $Data_rows[$k]["UnitName"]= "<input id='Unit_$i' name='Unit_$i' class='form-control'  type='text' value= '".$v['UnitName']."'  readonly>";
                     $Data_rows[$k]["Quantity"]= "<input id='Quantity_$i' name='Quantity_$i' class='form-control'  type='text' value= '".$v['Quantity']."'  readonly>";
                     $Data_rows[$k]["Price"]= "<input id='Price_$i' name='Price_$i' class='form-control'  type='text' value= '".$v['Price']."'  readonly>";
                     $Data_rows[$k]["Amount"]= "<input id='Amount_$i' name='Amount_$i' class='form-control'  type='text' value= '".$v['Amount']."'  readonly>";
                     $i++;
                 }
                if($Data_rows){
		            http_response_code();		                 
                 echo json_encode($Data_rows);
                 }else{
        	 	http_response_code(204);
        	 	echo json_encode(array('message' => 'noData'));
    		    }   
                    
                } else {
                  http_response_code(204);
                }
            } catch (Exception $exc) {
              http_response_code(500);
            }
    
}