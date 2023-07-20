<?php

/**
 * @Desc EnquiryFollowup in enquiry module
 * @author Gunabalans
 */
include_once 'Util/CrudApi.php';

class EnquiryFollowup extends Util\CrudApi {

    public function __construct($reg = NULL) {
        $this->crg = $reg;
        $this->crg->set('tn', 'enquiryfollowup'); //table name without prefix
        $this->crg->set('pk', 'ID'); //priumary key used for access
        parent::__construct($this->crg);
    }

///////////////Constructor completed here/////////////////
//////////////////////////////////////////////////////////
    public function init() {
        
        $currentdatetime = date('Y-m-d H:i:s');

        switch ($this->HTTPMethodStringFromUrl) {
            case 'add':
                $this->addEnqFollowup();
                break;
            case 'edit':
                $this->editEnqFollowup();
                break;    
            case 'get':
                $this->getEnqFollowup();
                break; 
            case 'list':
                $this->listEnqFollowup();
                break;
            case 'delete':
                $this->deleteEnqFollowup();
                break;    
            default:
                $this->errInfo("Check URL");
                break;
        }
        
        
    }

//////////////////////////////init complete here///////////////////////////////////////////////////////
    public function addEnqFollowup() {
        $this->checkMethod('POST');
        $this->accRightsCheck();
        
        $lastInsEnqID = $this->db->insert("enquiryfollowup", $this->dataEnqFollowup());
        //echo $this->db->last_query();
        
        if($lastInsEnqID){
            return $this->crg->setResponseCode(200, 'Enquiry Followup data saved successfully');
        } else {
            return $this->crg->setResponseCode(400, 'Enquiry Followup data failed to save');
        }
    }
    
    public function editEnqFollowup() {
        $this->checkMethod('POST');
        $this->accRightsCheck();
        
        $enquiryFollowID = filter_input(INPUT_POST, 'ID', FILTER_SANITIZE_STRING);
        //echo $this->db->last_query();
        
        if($enquiryFollowID){
            $this->db->update("enquiryfollowup", $this->dataEnqFollowup(), ['ID'=>$enquiryFollowID]);
            
            return $this->crg->setResponseCode(200, 'Enquiry Followup data updated successfully');
            
        } else {
            return $this->crg->setResponseCode(400, 'Enquiry Followup data failed to edit');
        }
    }

    
    public function getEnqFollowup() {
        $this->checkMethod();
        $this->accRightsCheck();
        
        $enquiryFollowID = filter_input(INPUT_GET, 'ID', FILTER_SANITIZE_STRING);
       
        $enquiryData = $this->db->select("enquiryfollowup", '*', ['enquiryfollowup.ID'=>$enquiryFollowID]);
        //echo $this->db->last_query();
        
        if($enquiryData){
            return $this->crg->setResponseCode(200, 'Enquiry Followup data got successfully',$enquiryData,NULL);
        } else {
            return $this->crg->setResponseCode(400, 'Enquiry Followup data failed to got');
        }
    }
    
    public function listEnqFollowup() {
        $this->checkMethod();
        $this->accRightsCheck();
        
         $ColInfo = [
            'enquiryfollowup.ID' => 'EnqFollowID',
            'callstatus.CallStatus' => 'CallStatus',
            'enquiryfollowup.Remarks' => 'Remarks',
            'enquiryfollowup.AuditDateTime' => 'EnqFollowDateTime'
        ];

        $colAliasData = $this->colWithAlias($ColInfo);

        $ljoint = [
            "[>]callstatus" => ["callstatus_ID" => "ID"]
        ];
       
        $enquiryData = $this->db->select("enquiryfollowup", $ljoint, $colAliasData);
        //echo $this->db->last_query();
        
        if($enquiryData){
            return $this->crg->setResponseCode(200, 'Listed enquiry followup data successfully',$enquiryData,NULL);
        } else {
            return $this->crg->setResponseCode(400, 'No enquiry data to list');
        }
    }
    
    public function deleteEnqFollowup() {
        $this->checkMethod();
        $this->accRightsCheck();
        
        $enquiryID = filter_input(INPUT_GET, 'ID', FILTER_SANITIZE_STRING);
        
        if($enquiryID){
            $this->db->delete("enquiryfollowup", ['ID'=>$enquiryID]);
            
            return $this->crg->setResponseCode(200, 'Enquiry followup deleted successfully');
            
        } else {
            return $this->crg->setResponseCode(400, 'Failed to delete enquiry followup data');
        }
    }
    
    
    //receiving enquiry followup data
    private function dataEnqFollowup() {
        $data = [
            'enquiry_ID' => filter_input(INPUT_POST, 'enquiry_ID', FILTER_SANITIZE_STRING),
            'callstatus_ID' => filter_input(INPUT_POST, 'callstatus_ID', FILTER_SANITIZE_STRING),
            'CallDateTime' => filter_input(INPUT_POST, 'CallDateTime', FILTER_SANITIZE_STRING),
            'Remarks' => filter_input(INPUT_POST, 'Remarks', FILTER_SANITIZE_STRING),
            'entity_ID' => $this->crg->get('userData')['entity_ID'],
            'users_ID' => $this->crg->get('userData')['ID'],
            'AuditDateTime' => $currentdatetime
        ];
        return $data;
    } 
    

    /*
     * End of Class
     */
}
