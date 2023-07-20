<?php

/**
 * @Desc InvoiceManager in invoice module
 * @author Gunabalans
 */
include_once 'Util/CrudApi.php';

class InvoiceManager extends Util\CrudApi {

    public function __construct($reg = NULL) {
        $this->crg = $reg;
        $this->crg->set('tn', 'invoicemaster'); //table name without prefix
        $this->crg->set('pk', 'ID'); //priumary key used for access
        parent::__construct($this->crg);
    }

///////////////Constructor completed here/////////////////
//////////////////////////////////////////////////////////
    public function init() {
      

        switch ($this->HTTPMethodStringFromUrl) {
            
            case 'add':
                $this->addInvoice();
                break;
            case 'edit':
                $this->editInvoice();
                break;    
            case 'get':
                $this->getInvoice();
                break; 
            case 'list':
                $this->listInvoice();
                break;
            case 'search':
                $this->searchInvoice();
                break; 
            case 'delete':
                $this->deleteInvoice();
                break;    
            default:
                $this->errInfo("Check URL");
                break;
        }
        
        
    }

//////////////////////////////init complete here///////////////////////////////////////////////////////
    public function addInvoice() {
        $this->checkMethod('POST');
        $this->accRightsCheck();
        
        $lastInsInvID = $this->db->insert("invoicemaster", $this->dataInvMas());
          
        $currentdatetime = date('Y-m-d H:i:s');
        
        //echo $this->db->last_query();
        
        if($lastInsInvID){
            
            $inv_entry_count = 1;
            for($inv_entry_count; $inv_entry_count <= $maxCount;) {
            
            $this->db->insert("invoicedetail", $this->dataInvDet($lastInsInvID,$inv_entry_count)); 
                //increment here
                $inv_entry_count++;
            }
            
            return $this->crg->setResponseCode(200, 'Invoice data saved successfully');
        } else {
            return $this->crg->setResponseCode(400, 'Invoice data failed to save');
        }
    }
    
    public function editInvoice() {
        $this->checkMethod('POST');
        $this->accRightsCheck();
        
        $invoiceID = filter_input(INPUT_POST, 'ID', FILTER_SANITIZE_STRING);
        $maxCount = filter_input(INPUT_POST, 'maxCount', FILTER_SANITIZE_STRING);
        $currentdatetime = date('Y-m-d H:i:s');

        if($invoiceID){
            $masData = $this->db->update("invoicemaster", $this->dataInvMas(), ['ID'=>$invoiceID]);
            if($masData){
            $this->db->delete("invoicedetail", ['invoice_ID'=>$invoiceID]);
                $inv_entry_count = 1;
                for($inv_entry_count; $inv_entry_count <= $maxCount;) {
                    $this->db->insert("invoicedetail", $this->dataInvDet($invoiceID,$inv_entry_count));
                    //increment here
                    $inv_entry_count++;
                }
            }
            return $this->crg->setResponseCode(200, 'Invoice data updated successfully');
            
        } else {
            return $this->crg->setResponseCode(400, 'Invoice data failed to edit');
        }
    }
    
    public function getInvoice() {
        $this->checkMethod();
        $this->accRightsCheck();
        
        $invoiceID = filter_input(INPUT_GET, 'ID', FILTER_SANITIZE_STRING);

        $ljoint = [
            "[>]invoicedetail" => ["ID" => "invoice_ID"]
        ];
       
        $invoiceData = $this->db->select("invoicemaster", $ljoint,'*',['invoicemaster.ID'=>$invoiceID]);
        //echo $this->db->last_query();
        
        if($invoiceData){
            return $this->crg->setResponseCode(200, 'Invoice data got successfully',$invoiceData,NULL);
        } else {
            return $this->crg->setResponseCode(400, 'Invoice data failed to got');
        }
    }
    
    public function listInvoice() {
        $this->checkMethod();
        $this->accRightsCheck();
        
         $ColInfo = [
            'invoicemaster.ID' => 'InvoiceID',
            'user.UserName' => 'UserName',
            'customer.FirstName' => 'CustFirstName',
            'customer.LastName' => 'CustLastName',
            'invoicemaster.Remarks' => 'Remarks',
            'invoicemaster.BillAmount' => 'BillAmount',
            'invoicemaster.AuditDateTime' => 'InvoiceDateTime'
        ];

        $colAliasData = $this->colWithAlias($ColInfo);

        $ljoint = [
            "[>]customer" => ["customer_ID" => "ID"],
            "[>]user" => ["user_ID" => "ID"]
        ];
       
        $invoiceData = $this->db->select("invoicemaster", $ljoint, $colAliasData);
        echo $this->db->last_query();
        
        if($invoiceData){
            return $this->crg->setResponseCode(200, 'Listed invoice data successfully',$invoiceData,NULL);
        } else {
            return $this->crg->setResponseCode(400, 'No invoice data to list');
        }
    }
    
    public function deleteInvoice() {
        $this->checkMethod();
        $this->accRightsCheck();
        
        $invoiceID = filter_input(INPUT_GET, 'ID', FILTER_SANITIZE_STRING);
        
        if($invoiceID){
            $masData = $this->db->delete("invoicemaster", ['ID'=>$invoiceID]);
            if($masData){
            $this->db->delete("invoicedetail", ['invoice_ID'=>$invoiceID]);}
            
            return $this->crg->setResponseCode(200, 'Invoice deleted successfully');
            
        } else {
            return $this->crg->setResponseCode(400, 'Failed to delete invoice data');
        }
    }
    
    public function searchInvoice() {
        $this->checkMethod();
        $this->accRightsCheck();
        
        //used in get metohds
        $ColInfo = [
            'invoicemaster.ID' => 'InvoiceID',
            'user.UserName' => 'UserName',
            'customer.FirstName' => 'CustFirstName',
            'customer.LastName' => 'CustLastName',
            'invoicemaster.Remarks' => 'Remarks',
            'invoicemaster.BillAmount' => 'BillAmount',
            'invoicemaster.AuditDateTime' => 'InvoiceDateTime'
        ];
        
        $ljoint = [
            "[>]customer" => ["customer_ID" => "ID"],
            "[>]user" => ["user_ID" => "ID"]
        ];

        //http://ycstravel.whyceeyes.com/V1.0/enquiry/search?FilterBy=Mobile&FilterValue=978822
        $fby = filter_input(INPUT_GET, 'FilterBy', FILTER_DEFAULT);
        $fval = filter_input(INPUT_GET, 'FilterValue', FILTER_DEFAULT);

        $colToSelect = $this->colWithAlias($ColInfo);
        $flipCol = array_flip($ColInfo);
        if (isset($fby) && !empty($fby)) {
            $wCondAr = [$flipCol[$fby].'[~]'=> $fval];
            return $this->selectAll($colToSelect, $wCondAr, $ljoint);
        } else {
            return $this->crg->setResponseCode(400, 'No data to search');
        }
    }
    
    
    //receiving invoice master data
    private function dataInvMas() {
        $data = [
            'customer_ID' => filter_input(INPUT_POST, 'customer_ID', FILTER_SANITIZE_STRING),
            'InvoiceDate' => filter_input(INPUT_POST, 'InvoiceDate', FILTER_SANITIZE_STRING),
            'PaymentMode' => filter_input(INPUT_POST, 'PaymentMode', FILTER_SANITIZE_STRING),
            'BillAmount' => filter_input(INPUT_POST, 'BillAmount', FILTER_SANITIZE_STRING),
            'Remarks' => filter_input(INPUT_POST, 'Remarks', FILTER_SANITIZE_STRING),
            'entity_ID' => $this->crg->get('userData')['entity_ID'],
            'user_ID' => $this->crg->get('userData')['ID'],
            'AuditDateTime' => $currentdatetime
        ];
        return $data;
    } 
    
    //receiving invoice detail data
    //$ii -> invoice_entry_count
    private function dataInvDet($lastInsertID,$ii) {
        $data = [
            'invoice_ID' => $lastInsertID,
            'Service' => filter_input(INPUT_POST, 'Service_'.$ii, FILTER_SANITIZE_STRING),
            'Description' => filter_input(INPUT_POST, 'Description_'.$ii, FILTER_SANITIZE_STRING),
            'BillOption' => filter_input(INPUT_POST, 'BillOption_'.$ii, FILTER_SANITIZE_STRING),
            'GST' => filter_input(INPUT_POST, 'GST_'.$ii, FILTER_SANITIZE_STRING),
            'Price' => filter_input(INPUT_POST, 'Price_'.$ii, FILTER_SANITIZE_STRING),
            'ServiceCharge' => filter_input(INPUT_POST, 'ServiceCharge_'.$ii, FILTER_SANITIZE_STRING),
            'Amount' => filter_input(INPUT_POST, 'Amount_'.$ii, FILTER_SANITIZE_STRING)
        ];
        return $data;
    }


    /*
     * End of Class
     */
}
