<?php

/**
 * Description of Customer_Mod
 *
 * @author psmahadevan
 */
class User_Region {

    private $crg;
    private $ses;
    private $db;
    private $sd;
    private $tpl;
    private $rbac;

    public function __construct($reg = NULL) {
        /*
         * Receiving $rg array
         */
        $this->crg = $reg;

        /*
         * geting object from reg array
         */
        $this->ses = $this->crg->get('ses');
        $this->db = $this->crg->get('db');
        $this->sd = $this->crg->get('SD');
        $this->tpl = $this->crg->get('tpl');
        $this->rbac = $this->crg->get('rbac');
    }    
    
     function mailbox() {
         
        if ($this->crg->get('wp') || $this->crg->get('rp')) {

        //////////////////////////////////////////////////////////////////////////////////
        //////////////////////////////access condition applied///////////////////////////
        ////////////////////////////////////////////////////////////////////////////////  
            
            include_once 'util/DBUTIL.php';
            $dbutil = new DBUTIL($this->crg);
            $crud_string = null;

            if (isset($_REQUEST['process_ID'])) {
                $crud_string = 'approve';
                   
            } 
            
             switch ($crud_string) {
             
            case 'approve': 
               
            //Add Role when u submit the add role form
             $thisPageURL = $this->crg->get('route')['base_path'] . '/' . $this->crg->get('route')['module'] . '/' . $this->crg->get('route')['controller'] . '/' . $this->crg->get('route')['action'];

             $data = trim($_GET['process_ID']);
             $ProcessType = trim($_GET['processtype']);

                if($ProcessType=='Customer Order'){
                    
                     $_SESSION['req_from_list_view']='edit';
                     $_SESSION['ycs_ID']=$data;
                     header('Location:' . $this->crg->get('route')['base_path'] . '/sales/cst/customer_order');
                     $this->tpl->set('master_layout', 'layout_datepicker.php');
                     
                  
                     }else if($ProcessType=='Purchase Indent'){
                    
                     $_SESSION['req_from_list_view']='edit';
                     $_SESSION['ycs_ID']=$data;
                     header('Location:' . $this->crg->get('route')['base_path'] . '/purchase/pur/manage');
                     $this->tpl->set('master_layout', 'layout_datepicker.php');
                     
                  
                     }
                  break;
                  default :
                        // print_r($this->ses->get('user'));
                      
                        $user_tab = $this->crg->get('table_prefix') . 'users'; 
                        $appprocess_tab = $this->crg->get('table_prefix') . 'approvalprocess'; 
                        $entityID = $this->ses->get('user')['entity_ID'];
                      
            	        
            	        $sqlinbox =  "SELECT s.user_nicename as SendToUser,f.user_nicename as SendFrmUser,a.ProcessType,a.process_ID,CONCAT(if( "
                                        ."TIMESTAMPDIFF(day,a.AuditDateTime,NOW())=0,'',concat(TIMESTAMPDIFF(day,a.AuditDateTime,NOW()),' days ')) , "
                                        ."if(MOD( TIMESTAMPDIFF(hour,a.AuditDateTime,NOW()), 24)=0,'',concat(MOD( TIMESTAMPDIFF(hour,a.AuditDateTime,NOW()), 24), ' hours ')),"
                                        ."MOD( TIMESTAMPDIFF(minute,a.AuditDateTime,NOW()), 60), ' minutes '"
                                        .") as age FROM $appprocess_tab a JOIN $user_tab s ON s.ID = a.sendfromUser_ID JOIN $user_tab f ON f.ID = a.sendtoUser_ID where a.ApprovalStatus=0";
                       
                                        $sqlinboxdata = $dbutil->getSqlData($sqlinbox,2); 
                                        $this->tpl->set('sqlinbox_data', $sqlinboxdata);

                    
                        $this->tpl->set('content', $this->tpl->fetch('factory/mailbox.php'));
            
            
            
                }
                            //////////////////////////////on access condition failed then ///////////////////////////
                        } else {
                            if ($this->ses->get('user')['ID']) {
                                $this->tpl->set('content', $this->tpl->fetch('modules/user/acess_failed_message.php'));
                            } else {
                                header('Location:' . $this->crg->get('route')['base_path'] . '/user/auth/login');
                            }
                        }
                    }
    function dashboard() {
        if ($this->crg->get('wp') || $this->crg->get('rp')) {

//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////access condition applied///////////////////////////
////////////////////////////////////////////////////////////////////////////////  
            
            include_once 'util/DBUTIL.php';
            $dbutil = new DBUTIL($this->crg);

            $crud_string = null;
	
            if (isset($_POST['Action'])) {
                $crud_string = strtolower($_POST['Action']);
            } 
            
             switch ($crud_string) {
                
                  default :
            // print_r($this->ses->get('user'));
            $stock_tab = $this->crg->get('table_prefix') . 'stock';      
            $prd_tab = $this->crg->get('table_prefix') . 'product'; 
            $user_tab = $this->crg->get('table_prefix') . 'users'; 
             $appprocess_tab = $this->crg->get('table_prefix') . 'approvalprocess'; 
            $entityID = $this->ses->get('user')['entity_ID'];
            
            $sqlstk = "SELECT $prd_tab.ItemName,$stock_tab.TotalQty, $stock_tab.LastUpdatedRate, $stock_tab.TotalValue,$user_tab.user_nicename,$stock_tab.AuditDateTime FROM $stock_tab,$user_tab,$prd_tab WHERE $prd_tab.ID=$stock_tab.ItemNo AND $user_tab.ID= $stock_tab.users_ID AND $stock_tab.entity_ID = $entityID";            
            $stock = $dbutil->getSqlData($sqlstk,2); 
	        $this->tpl->set('stk_data', $stock);
	        
	       
	        
            $cst_tab = $this->crg->get('table_prefix') . 'customer';
            $sqlcus = "SELECT COUNT(SGuserRegDate) FROM $cst_tab "
                    . "WHERE MONTH(SGuserRegDate) = MONTH(CURDATE()) "
                    . "AND YEAR(SGuserRegDate) = YEAR(CURDATE()) AND entity_ID = $entityID";            
            $cus_reg = $dbutil->getSqlData($sqlcus,2);              
	        $this->tpl->set('cus_reg_data', $cus_reg);
                        
            $sqlcusqry = "SELECT COUNT(PackExpireDate) FROM $cst_tab "
                       . "WHERE DATE(PackExpireDate) = CURDATE() AND entity_ID = $entityID";            
            $cuspac_expr = $dbutil->getSqlData($sqlcusqry,2); 
            //var_dump($cuspac_expr);
	    $this->tpl->set('cus_pac_reg', $cuspac_expr);
        
        
           /// commented by mr to show new page $this->tpl->set('content', $this->tpl->fetch('factory/dashboard.php'));
             $this->tpl->set('content', $this->tpl->fetch('factory/dashboard_new.php'));
            
            
            
}
            //////////////////////////////on access condition failed then ///////////////////////////
        } else {
            if ($this->ses->get('user')['ID']) {
                $this->tpl->set('content', $this->tpl->fetch('modules/user/acess_failed_message.php'));
            } else {
                header('Location:' . $this->crg->get('route')['base_path'] . '/user/auth/login');
            }
        }
    }
    
    function chart() {
        if ($this->crg->get('wp') || $this->crg->get('rp')) {

//////////////////////////////////////////////////////////////////////////////////
//////////////////////////////access condition applied///////////////////////////
////////////////////////////////////////////////////////////////////////////////  
            
                        $sql_query = "CALL pPODashboard()"; 
                        $stmt = $this->db->prepare($sql_query);                        
                        $stmt->execute();
                        $result = $stmt->fetchAll(2);
                        $json_cart_data = json_encode($result);
                        //var_dump($result);
                        
                        $this->tpl->set('po_stage_data', $json_cart_data);
                        
                        $sql_query1 = "CALL pPrdWiseDespQty()"; 
                        $stmt = $this->db->prepare($sql_query1);                        
                        $stmt->execute();
                        $result1 = $stmt->fetchAll();
                        $result2 = array();
                        foreach($result1 as $k=>$v){
                           $result2[]=[$v['ItemName'],$v['Qty']];
                        }
                       
                        $json_bar_cart = json_encode($result2);
                        //var_dump($json_bar_cart);
                        
                        $this->tpl->set('despatch_data', $json_bar_cart);
                        
                        
        
            $this->tpl->set('content', $this->tpl->fetch('factory/chart.php'));

            //////////////////////////////on access condition failed then ///////////////////////////
        } else {
            if ($this->ses->get('user')['ID']) {
                $this->tpl->set('content', $this->tpl->fetch('modules/user/acess_failed_message.php'));
            } else {
                header('Location:' . $this->crg->get('route')['base_path'] . '/user/auth/login');
            }
        }
    }

    /*
     * End of Class
     */
}
