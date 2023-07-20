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

$stock_tab = $tablePrefix . 'stock';
$item_tab = $tablePrefix . 'item';
$itemtype_tab = $tablePrefix . 'itemtype';
$unit_tab = $tablePrefix . 'unit';
$entityID = $ajxSess->get('user')['entity_ID'];

$query = "SELECT $stock_tab.ID AS StockID,$item_tab.ItemName,$itemtype_tab.ItemType,$unit_tab.UnitCode,$stock_tab.TotalQty FROM $stock_tab,$item_tab,$itemtype_tab,$unit_tab WHERE $stock_tab.entity_ID=$entityID AND $item_tab.ID=$stock_tab.ItemNo AND $stock_tab.TotalQty<=$item_tab.ThresholdQuantity AND $itemtype_tab.ID=$item_tab.itemtype_ID AND $unit_tab.ID=$item_tab.unit_ID ORDER BY $stock_tab.AuditDateTime DESC";
$stmt = $Db->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll(2);

// if($_POST["view"] != 'notify'){
//   foreach($result as $k=>$v){    
//   $update_query = "UPDATE $stock_tab SET NotifiStatus = 1 WHERE NotifiStatus=0 AND entity_ID=$entityID AND ID=".$v['StockID']."";
//   $stmt = $Db->prepare($update_query);
//   $stmt->execute();
//   }
// }

$output = '';

$status_query = "SELECT COUNT($item_tab.ItemName) AS NotifyCount FROM ycias_stock,ycias_item,ycias_itemtype,ycias_unit WHERE $stock_tab.entity_ID=$entityID AND $item_tab.ID=$stock_tab.ItemNo AND $stock_tab.TotalQty<=$item_tab.ThresholdQuantity AND $itemtype_tab.ID=$item_tab.itemtype_ID AND $unit_tab.ID=$item_tab.unit_ID AND $stock_tab.NotifiStatus=0";
$stmt = $Db->prepare($status_query);
$stmt->execute();
$result_count = $stmt->fetchAll(2);

if(isset($result_count[0]['NotifyCount'])){
$count = $result_count[0]['NotifyCount'];
} else {
$count = 0;
}

if(count($result) > 0){
    
    $output .='<li class="header">You have '.$count.' new notifications</li>
                <li>
                 <ul class="menu">';
    foreach($result as $k=>$row){
      $output .= '<li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> '.$row["ItemName"].'&ensp;'.$row["TotalQty"].' '.$row["UnitCode"].' avl.'.'
                    </a>
                  </li>';
    }
     $output .='</ul>
               </li><li class="footer"><a href="#"><span style="color:red;">Place an order for all notified products</span></a></li>';
}else{
    $output .= '<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
}

$data = array(
   'notification' => $output,
   'unseen_notification'  => $count
);

echo json_encode($data);
}
?>