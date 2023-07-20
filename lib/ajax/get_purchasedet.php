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

if($_POST["indent_id"]){
    
    $indent_det_tab = $tablePrefix .'purchaseindentdetail';
    $rawmaterial_tab = $tablePrefix .'rawmaterial';
    $unit_tab = $tablePrefix .'unit';
    $po_det_tab = $tablePrefix .'purchaseorderdetail';
    $po_tab = $tablePrefix .'purchaseorder';
  
   $sql_query ="SELECT $indent_det_tab.rawmaterial_ID as ID,$rawmaterial_tab.RMName,$indent_det_tab.Quantity,$indent_det_tab.RaisedPOQty,$unit_tab.ID as unit_ID,$unit_tab.UnitName FROM $indent_det_tab,$unit_tab,$rawmaterial_tab WHERE $rawmaterial_tab.ID=$indent_det_tab.rawmaterial_ID  AND $unit_tab.ID=$indent_det_tab.unit_ID AND $indent_det_tab.purchaseindent_ID=".$_POST['indent_id']."";
 
   
  	try {
                $stmt = $Db->prepare($sql_query);
               
                if ($stmt->execute()) {
                 $Data_rows= $stmt->fetchAll(2);
                
                $i=1;
               foreach($Data_rows as $k => $v){
                     
                    unset($Data_rows[$k]["ID"]);
                    $Data_rows[$k]["Item Name"]="<input name='ItemName_$i' id='ItemName_$i' class='form-control' value='".$v['RMName']."' type='text' readonly>";
                    $Data_rows[$k]["Pack Details"]="<input name='Packdet_$i' id='Packdet_$i' class='form-control' value='' type='text' if($v[Quantity]==$v[RaisedPOQty]){ echo 'readony';}>";
                    $Data_rows[$k]["Approved Qty"]="<input name='Note_$i' id='Note_$i' value='".$v['Quantity']."'  class='form-control' type='text' readonly><input type='hidden' name='ItemNo_$i' id='ItemNo_$i' class='form-control' value=".$v['ID'].">";
                    $Data_rows[$k]["Raised PO Quantity"]= "<input name='RaisedPOQty_$i' id='RaisedPOQty_$i' class='form-control' value='".$v['RaisedPOQty']."' type='text' readonly>";
                    if($v['Quantity']==$v['RaisedPOQty']){
                      $Data_rows[$k]["PO Quantity"]="<input name='Qty_$i'  id='Qty_$i' readonly class='form-control' type='text' value='0'><input name='unit_$i' id='unit_$i' value=".$v['unit_ID']." class='form-control' type='hidden'>";
                      $Data_rows[$k]["Unit"]="<input name='unitname_$i' id='unitname_$i' class='form-control' value='".$v['UnitName']."' type='text' readonly>";
                      $Data_rows[$k]["Price"]="<input name='Emp_$i' id='Emp_$i'  class='form-control' type='text' value='0' readonly >";
                      $Data_rows[$k]["Amount"]="<input name='Amount_$i' id='Amount_$i' value='0.00' class='form-control' type='text' readonly>";
                         
                    }else{
                        $Data_rows[$k]["PO Quantity"]="<input name='Qty_$i'  id='Qty_$i' class='form-control' type='text' onkeyup=nozero(this.id);POQty_Validation(this.id);$('#Amount_$i').val(($('#Qty_$i').val()*$('#Emp_$i').val()).toFixed(2));ajaxtax_amount_calc(); required><input name='unit_$i' id='unit_$i' value=".$v['unit_ID']." class='form-control' type='hidden'>";
                        $Data_rows[$k]["Unit"]="<input name='unitname_$i' id='unitname_$i' class='form-control' value='".$v['UnitName']."' type='text' readonly>";
                        $Data_rows[$k]["Price"]="<input name='Emp_$i' id='Emp_$i' required class='form-control' type='text' onkeyup=$('#Amount_$i').val(($('#Qty_$i').val()*$('#Emp_$i').val()).toFixed(2));ajaxtax_amount_calc();>";
                        $Data_rows[$k]["Amount"]="<input name='Amount_$i' id='Amount_$i' value='' class='form-control' type='text' readonly>";
                         
                    }
                    
                     $i++;
                }
                
                 if($Data_rows){
		           
		            http_response_code();		                 
                    echo json_encode($Data_rows);

                 }else{
        	 	http_response_code(204);
        	 	echo json_encode(array('noData' => 'noData'));
    		}   
                    
                } else {
                   http_response_code(204);
                }
            } catch (Exception $exc) {
               http_response_code(500);
            }


}


// if($_POST["Raw"])
// {
//   var_dump('data is flowing well');
// }


