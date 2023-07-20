<?php

/**
 * @Desc EnquiryManager in enquiry module
 * @author Gunabalans
 */
include_once 'Util/CrudApi.php';

class EnquiryManager extends Util\CrudApi {

    public function __construct($reg = NULL) {
        $this->crg = $reg;
        $this->crg->set('tn', 'enquirymaster'); //table name without prefix
        $this->crg->set('pk', 'EnquiryID'); //priumary key used for access
        $this->getHeaders = $this->crg->get('HttpHeaders');
        parent::__construct($this->crg);
    }

///////////////Constructor completed here/////////////////
//////////////////////////////////////////////////////////
    public function init() {
    
             $logfile = './resource/transactionlog/Log_' . date("M_Y") . '.txt';
                chmod('./transactionlog', 0777);
    
                if (file_exists($logfile)) {
                    file_put_contents($logfile, "\n" . "[" . date("d-m-Y H:i:s") . "]" . "{" . $this->getHeaders['Content-Type'] . "}", FILE_APPEND);
                    file_put_contents($logfile, "\n" . "[" . date("d-m-Y H:i:s") . "]" . "{" . $this->getHeaders['Authorization'] . "}", FILE_APPEND);
                    file_put_contents($logfile, "\n" . "[" . date("d-m-Y H:i:s") . "]" . "{" . file_get_contents('php://input') . "}", FILE_APPEND);
                    file_put_contents($logfile, "\n" . "[" . date("d-m-Y H:i:s") . "]" . "{" . $this->HTTPMethodStringFromUrl . "}", FILE_APPEND);
                } else {
                    $handle = fopen("$logfile", "w+");
                    fwrite($handle, "[" . date("d-m-Y H:i:s") . "]" . "{" . $this->getHeaders['Content-Type'] . "}");
                    fwrite($handle, "[" . date("d-m-Y H:i:s") . "]" . "{" . $this->getHeaders['Authorization'] . "}");
                    fwrite($handle, "[" . date("d-m-Y H:i:s") . "]" . "{" . file_get_contents('php://input') . "}");
                    fwrite($handle, "[" . date("d-m-Y H:i:s") . "]" . "{" . $this->HTTPMethodStringFromUrl . "}");
                    fclose($handle);
                }

        switch ($this->HTTPMethodStringFromUrl) {
            case 'create':
                $this->createEnquiry();
                break;
            case 'update':
                $this->editEnquiry();
                break;    
            case 'get':
                $this->getEnquiry();
                break; 
            case 'list':
                $this->listEnquiry();
                break;
            case 'search':
                $this->searchEnquiry();
                break; 
            case 'delete':
                $this->deleteEnquiry();
                break;    
            default:
                $this->errInfo("Check URL");
                break;
        }
        
        
    }
    

//////////////////////////////init complete here///////////////////////////////////////////////////////
    public function createEnquiry() {
        $this->checkMethod('POST');
        $this->accRightsCheck();
        
        $lastInsEnqID = $this->db->insert("enquirymaster", $this->dataEnqMas());
        //echo $this->db->last_query();
        
        if($lastInsEnqID){
            $this->db->insert("enquirydetail", $this->dataEnqDet($lastInsEnqID));
            //$this->db->insert("cabbookingdetail", $this->dataCabBookDet($lastInsEnqID));
            //$this->db->insert("flightbookingdetail", $this->dataFlightBookDet($lastInsEnqID));
            //$this->db->insert("hotelbookingdetail", $this->dataHotelBookDet($lastInsEnqID));
            //$this->db->insert("visaprocessingdetail", $this->dataVisaProcessDet($lastInsEnqID));
            //$this->db->insert("travelinsurancedetail", $this->dataTravelInsurance($lastInsEnqID));
            //$this->db->insert("sightseeingdetail", $this->dataSightSeeing($lastInsEnqID));
            //$this->db->insert("customizedpackage", $this->dataCustomPackage($lastInsEnqID));
            
            return $this->crg->setResponseCode(200, 'Enquiry data saved successfully');
            
        } else {
            return $this->crg->setResponseCode(400, 'Enquiry data failed to save');
        }
    }
    
    public function editEnquiry() {
        $this->checkMethod('POST');
        $this->accRightsCheck();
        
        $enquiryID = filter_input(INPUT_POST, $this->pk, FILTER_SANITIZE_STRING);
        //echo $this->db->last_query();
        
        if($enquiryID){
            
            if($this->db->update("enquirymaster", $this->dataEnqMas(), ['ID'=>$enquiryID])){
            $this->db->update("enquirydetail", $this->dataEnqDet($enquiryID), ['enquiry_ID'=>$enquiryID]);
          
            //$this->db->update("cabbookingdetail", $this->dataCabBookDet($enquiryID), ['enquiry_ID'=>$enquiryID]);
            //$this->db->update("flightbookingdetail", $this->dataFlightBookDet($enquiryID), ['enquiry_ID'=>$enquiryID]);
            //$this->db->update("hotelbookingdetail", $this->dataHotelBookDet($enquiryID), ['enquiry_ID'=>$enquiryID]);
            //$this->db->update("visaprocessingdetail", $this->dataVisaProcessDet($enquiryID), ['enquiry_ID'=>$enquiryID]);
            //$this->db->update("travelinsurancedetail", $this->dataTravelInsurance($enquiryID), ['enquiry_ID'=>$enquiryID]);
            //$this->db->update("sightseeingdetail", $this->dataSightSeeing($enquiryID), ['enquiry_ID'=>$enquiryID]);
            //$this->db->update("customizedpackage", $this->dataCustomPackage($enquiryID), ['enquiry_ID'=>$enquiryID]);
            
            return $this->crg->setResponseCode(200, 'Enquiry data updated successfully');
            }else{
            return $this->crg->setResponseCode(400, 'Enquiry data failed to edit');    
            }
            
        } else {
            return $this->crg->setResponseCode(400, 'Enquiry data failed to edit');
        }
    }

    
    public function getEnquiry() {
        $this->checkMethod();
        $this->accRightsCheck();
        
        $enquiryID = filter_input(INPUT_GET, $this->pk, FILTER_SANITIZE_STRING);

        $ljoint = [
            "[>]enquirydetail" => ["ID" => "enquiry_ID"],
            "[>]cabbookingdetail" => ["ID" => "enquiry_ID"],
            "[>]flightbookingdetail" => ["ID" => "enquiry_ID"],
            "[>]hotelbookingdetail" => ["ID" => "enquiry_ID"],
            "[>]visaprocessingdetail" => ["ID" => "enquiry_ID"],
            "[>]travelinsurancedetail" => ["ID" => "enquiry_ID"],
            "[>]sightseeingdetail" => ["ID" => "enquiry_ID"],
            "[>]customizedpackage" => ["ID" => "enquiry_ID"]
        ];
       
        $enquiryData = $this->db->select("enquirymaster", $ljoint,'*',['enquirymaster.ID'=>$enquiryID]);
        //echo $this->db->last_query();
        
        if($enquiryData){
            return $this->crg->setResponseCode(200, 'Enquiry data got successfully',$enquiryData,NULL);
        } else {
            return $this->crg->setResponseCode(400, 'Enquiry data failed to got');
        }
    }
    
    public function listEnquiry() {
        $this->checkMethod();
        $this->accRightsCheck();
 
         $ColInfo = [
            'enquirymaster.ID' => $this->pk,
            'user.UserName' => 'UserName',
            'enquirymaster.customer_ID' => 'customer_ID',
            'customer.FirstName' => 'CustFirstName',
            'customer.LastName' => 'CustLastName',
            'customer.MobileNo' => 'MobileNo',
            'enquirymaster.leadstatus_ID' => 'leadstatus_ID',
            'leadstatus.LeadTitle' => 'LeadStatus',
            'enquirymaster.triptype_ID'=> 'triptype_ID',
            'triptype.TripType'=>'TripType',
            'enquirydetail.enquirytype_ID'=>'enquirytype_ID',
            'enquirytype.EnquiryType'=> 'EnquiryType',
            'enquirymaster.Remarks' => 'Remarks',
            'enquirymaster.NoOfChildren' => 'NoOfChildren',
            'enquirymaster.NoOfAdult' => 'NoOfAdult',
            'enquirymaster.AuditDateTime' => 'EnquiryDateTime'
        ];

        $colAliasData = $this->colWithAlias($ColInfo);

        $ljoint = [
            "[>]enquirydetail" => ["ID" => "enquiry_ID"],
            "[>]customer" => ["customer_ID" => "ID"],
            "[>]user" => ["users_ID" => "ID"],
            "[>]leadstatus" => ["leadstatus_ID" => "ID"],
            "[>]enquirytype" => ["enquirydetail.enquirytype_ID" => "ID"],
            "[>]triptype" => ["triptype_ID" => "ID"],
        ];
       
        $enquiryData = $this->db->select("enquirymaster", $ljoint, $colAliasData);
        //echo $this->db->last_query();
        
        if($enquiryData){
            return $this->crg->setResponseCode(200, 'Listed enquiry data successfully',$enquiryData,NULL);
        } else {
            return $this->crg->setResponseCode(400, 'No enquiry data to list');
        }
    }
    
    public function deleteEnquiry() {
        $this->checkMethod();
        $this->accRightsCheck();
        
        $enquiryID = filter_input(INPUT_GET, $this->pk, FILTER_SANITIZE_STRING);
        
        if($enquiryID){
            if($this->db->delete("enquirymaster", ['ID'=>$enquiryID])){
            $this->db->delete("enquirydetail", ['enquiry_ID'=>$enquiryID]);
            //$this->db->delete("cabbookingdetail", ['enquiry_ID'=>$enquiryID]);
            //$this->db->delete("flightbookingdetail", ['enquiry_ID'=>$enquiryID]);
            //$this->db->delete("hotelbookingdetail", ['enquiry_ID'=>$enquiryID]);
            //$this->db->delete("visaprocessingdetail", ['enquiry_ID'=>$enquiryID]);
            //$this->db->delete("travelinsurancedetail", ['enquiry_ID'=>$enquiryID]);
            //$this->db->delete("sightseeingdetail", ['enquiry_ID'=>$enquiryID]);
            //$this->db->delete("customizedpackage", ['enquiry_ID'=>$enquiryID]);
            
                return $this->crg->setResponseCode(200, 'Enquiry deleted successfully');
            }else{
                return $this->crg->setResponseCode(400, 'Failed to delete enquiry data');
            }
        } else {
            return $this->crg->setResponseCode(400, 'Failed to delete enquiry data');
        }
    }
    
    public function searchEnquiry() {
        $this->checkMethod();
        $this->accRightsCheck();
        
        //used in get metohds
         $ColInfo = [
            'enquirymaster.ID' => 'EnquiryID',
            'user.UserName' => 'UserName',
            'customer.FirstName' => 'CustFirstName',
            'customer.LastName' => 'CustLastName',
            'customer.MobileNo' => 'MobileNo',
            'leadstatus.LeadTitle' => 'LeadStatus',
            'enquirymaster.Remarks' => 'Remarks',
            'enquirymaster.AuditDateTime' => 'EnquiryDateTime'
        ];
        
        $ljoint = [
            "[>]customer" => ["customer_ID" => "ID"],
            "[>]user" => ["users_ID" => "ID"],
            "[>]leadstatus" => ["leadstatus_ID" => "ID"]
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
    
    
    //receiving enquiry master data
    private function dataEnqMas() {
        $data = [
            'customer_ID' => filter_input(INPUT_POST, 'customer_ID', FILTER_SANITIZE_STRING),
            'leadstatus_ID' => filter_input(INPUT_POST, 'leadstatus_ID', FILTER_SANITIZE_STRING),
            //'triptype_ID' => filter_input(INPUT_POST, 'triptype_ID', FILTER_SANITIZE_STRING),
            //'NoOfInfants' => filter_input(INPUT_POST, 'NoOfInfants', FILTER_SANITIZE_STRING),
            'NoOfChildren' => filter_input(INPUT_POST, 'NoOfChildren', FILTER_SANITIZE_STRING),
            'NoOfAdult' => filter_input(INPUT_POST, 'NoOfAdult', FILTER_SANITIZE_STRING),
            //'NoOfSenior' => filter_input(INPUT_POST, 'NoOfSenior', FILTER_SANITIZE_STRING),
            'Remarks' => filter_input(INPUT_POST, 'Remarks', FILTER_SANITIZE_STRING),
            'entity_ID' => $this->crg->get('userData')['entity_ID'],
            'users_ID' => $this->crg->get('userData')['ID'],
            'AuditDateTime' => date('Y-m-d H:i:s')
        ];
        return $data;
    } 
    
    //receiving enquiry detail data
    private function dataEnqDet($lastInsertID) {
        $data = [
            'enquiry_ID' => $lastInsertID,
            'enquirytype_ID' => filter_input(INPUT_POST, 'enquirytype_ID', FILTER_SANITIZE_STRING)
        ];
        return $data;
    }
    
    //receiving cab booking data
    private function dataCabBookDet($lastInsertID) {
        $data = [
            'CBFromPlace' => filter_input(INPUT_POST, 'CBFromPlace', FILTER_SANITIZE_STRING),
            'CBToPlace' => filter_input(INPUT_POST, 'CBToPlace', FILTER_SANITIZE_STRING),
            'CBCabType' => filter_input(INPUT_POST, 'CBCabType', FILTER_SANITIZE_STRING),
            'CBPickupLocation' => filter_input(INPUT_POST, 'CBPickupLocation', FILTER_SANITIZE_STRING),
            'CBDropLocation' => filter_input(INPUT_POST, 'CBDropLocation', FILTER_SANITIZE_STRING),
            'CBJourneyDateTime' => filter_input(INPUT_POST, 'CBJourneyDateTime', FILTER_SANITIZE_STRING),
            'CBReturnDateTime' => filter_input(INPUT_POST, 'CBReturnDateTime', FILTER_SANITIZE_STRING),
            'enquiry_ID' => $lastInsertID,
            'CBAuditDateTime' => date('Y-m-d H:i:s')
        ];
        return $data;
    }
    
    //receiving hotel booking data
    private function dataHotelBookDet($lastInsertID) {
        $data = [
            'HBCountry' => filter_input(INPUT_POST, 'HBCountry', FILTER_SANITIZE_STRING),
            'HBCity' => filter_input(INPUT_POST, 'HBCity', FILTER_SANITIZE_STRING),
            'HBRoomType' => filter_input(INPUT_POST, 'HBRoomType', FILTER_SANITIZE_STRING),
            'HBStarRating' => filter_input(INPUT_POST, 'HBStarRating', FILTER_SANITIZE_STRING),
            'HBCheckIn' => filter_input(INPUT_POST, 'HBCheckIn', FILTER_SANITIZE_STRING),
            'HBCheckOut' => filter_input(INPUT_POST, 'HBCheckOut', FILTER_SANITIZE_STRING),
            'HBNoOfNights' => filter_input(INPUT_POST, 'HBNoOfNights', FILTER_SANITIZE_STRING),
            'HBBudget' => filter_input(INPUT_POST, 'HBBudget', FILTER_SANITIZE_STRING),
            'HBNoOfRooms' => filter_input(INPUT_POST, 'HBNoOfRooms', FILTER_SANITIZE_STRING),
            'enquiry_ID' => $lastInsertID, 
            'HBAuditDateTime' => date('Y-m-d H:i:s')
        ];
        return $data;
    }
    
    //receiving flight booking data
    private function dataFlightBookDet($lastInsertID) {
        $data = [
            'FBFromPlace' => filter_input(INPUT_POST, 'FBFromPlace', FILTER_SANITIZE_STRING),
            'FBToPlace' => filter_input(INPUT_POST, 'FBToPlace', FILTER_SANITIZE_STRING),
            'FBDepatureDateTime' => filter_input(INPUT_POST, 'FBDepatureDateTime', FILTER_SANITIZE_STRING),
            'FBReturnDateTime' => filter_input(INPUT_POST, 'FBReturnDateTime', FILTER_SANITIZE_STRING),
            'FBFlightClass' => filter_input(INPUT_POST, 'FBFlightClass', FILTER_SANITIZE_STRING),
            'FBFlightType' => filter_input(INPUT_POST, 'FBFlightType', FILTER_SANITIZE_STRING),
            'FBFlexibility' => filter_input(INPUT_POST, 'FBFlexibility', FILTER_SANITIZE_STRING),
            'FBFlightStop' => filter_input(INPUT_POST, 'FBFlightStop', FILTER_SANITIZE_STRING),
            'enquiry_ID' => $lastInsertID, 
            'FBAuditDateTime' => date('Y-m-d H:i:s')
        ];
        return $data;
    }
    
    //receiving visa processing data
    private function dataVisaProcessDet($lastInsertID) {
        $data = [
            'VPCountry' => filter_input(INPUT_POST, 'VPCountry', FILTER_SANITIZE_STRING),
            'VPVisaCategory' => filter_input(INPUT_POST, 'VPVisaCategory', FILTER_SANITIZE_STRING),
            'VPVisaType' => filter_input(INPUT_POST, 'VPVisaType', FILTER_SANITIZE_STRING),
            'VPDuration' => filter_input(INPUT_POST, 'VPDuration', FILTER_SANITIZE_STRING),
            'VPTravelDate' => filter_input(INPUT_POST, 'VPTravelDate', FILTER_SANITIZE_STRING),
            'VPDescription' => filter_input(INPUT_POST, 'VPDescription', FILTER_SANITIZE_STRING),
            'enquiry_ID' => $lastInsertID, 
            'VPAuditDateTime' => date('Y-m-d H:i:s')
        ];
        return $data;
    }
        
    //receiving travel insurance data
    private function dataTravelInsurance($lastInsertID) {
        $data = [
            'TINoOfDays' => filter_input(INPUT_POST, 'VPCountry', FILTER_SANITIZE_STRING),
            'TITravelDate' => filter_input(INPUT_POST, 'VPVisaCategory', FILTER_SANITIZE_STRING),
            'TIVisaInsuranceYN' => filter_input(INPUT_POST, 'VPVisaType', FILTER_SANITIZE_STRING),
            'enquiry_ID' => $lastInsertID, 
            'TIAuditDateTime' => date('Y-m-d H:i:s')
        ];
        return $data;
    }   
    
    //receiving forex data
    private function dataForex($lastInsertID) {
        $data = [
            'FRCountry' => filter_input(INPUT_POST, 'VPCountry', FILTER_SANITIZE_STRING),
            'FRAmount' => filter_input(INPUT_POST, 'VPVisaCategory', FILTER_SANITIZE_STRING),
            'enquiry_ID' => $lastInsertID, 
            'FRAuditDateTime' => date('Y-m-d H:i:s')
        ];
        return $data;
    }   
    
    //receiving sight seeing data
    private function dataSightSeeing($lastInsertID) {
        $data = [
            'SSCountry' => filter_input(INPUT_POST, 'SSCountry', FILTER_SANITIZE_STRING),
            'SSCity' => filter_input(INPUT_POST, 'SSCity', FILTER_SANITIZE_STRING),
            'SSPlacesToSee' => filter_input(INPUT_POST, 'SSPlacesToSee', FILTER_SANITIZE_STRING),
            'SSPreference' => filter_input(INPUT_POST, 'SSPreference', FILTER_SANITIZE_STRING),
            'SSStartDate' => filter_input(INPUT_POST, 'SSStartDate', FILTER_SANITIZE_STRING),
            'SSEndDate' => filter_input(INPUT_POST, 'SSEndDate', FILTER_SANITIZE_STRING),
            'enquiry_ID' => $lastInsertID, 
            'SSAuditDateTime' => date('Y-m-d H:i:s')
        ];
        return $data;
    }
    
    //receiving custom package data
    private function dataCustomPackage($lastInsertID) {
        $data = [
            'CPCountry' => filter_input(INPUT_POST, 'CPCountry', FILTER_SANITIZE_STRING),
            'visacategory_ID' => filter_input(INPUT_POST, 'visacategory_ID', FILTER_SANITIZE_STRING),
            'CPServices' => filter_input(INPUT_POST, 'CPServices', FILTER_SANITIZE_STRING),
            'CPHotelRatings' => filter_input(INPUT_POST, 'CPHotelRatings', FILTER_SANITIZE_STRING),
            'CPTravelDate' => filter_input(INPUT_POST, 'CPTravelDate', FILTER_SANITIZE_STRING),
            'CPFlexibility' => filter_input(INPUT_POST, 'CPFlexibility', FILTER_SANITIZE_STRING),
            'CPNoOfRooms' => filter_input(INPUT_POST, 'CPNoOfRooms', FILTER_SANITIZE_STRING),
            'CPPreference' => filter_input(INPUT_POST, 'CPPreference', FILTER_SANITIZE_STRING),
            'CPBudget' => filter_input(INPUT_POST, 'CPBudget', FILTER_SANITIZE_STRING),
            'CPNoOfNights' => filter_input(INPUT_POST, 'CPNoOfNights', FILTER_SANITIZE_STRING),
            'CPDescription' => filter_input(INPUT_POST, 'CPDescription', FILTER_SANITIZE_STRING),
            'enquiry_ID' => $lastInsertID, 
            'CPAuditDateTime' => date('Y-m-d H:i:s')
        ];
        return $data;
    }

    /*
     * End of Class
     */
}
