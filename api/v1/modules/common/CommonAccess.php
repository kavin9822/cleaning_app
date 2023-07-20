<?php

/**
 * @Desc CommonAccess module
 * @author Gunabalans
 */
include_once 'Util/CrudApi.php';

class CommonAccess extends Util\CrudApi {

    public function __construct($reg = NULL) {
        $this->crg = $reg;
        parent::__construct($this->crg);
    }

///////////////Constructor completed here/////////////////
//////////////////////////////////////////////////////////
    public function init() {
        /*
         * set where condition
         */

        switch ($this->HTTPMethodStringFromUrl) {
            case 'entity':
                $this->getEntity();
                break;
            case 'leadstatus':
                $this->getLeadStatus();
                break;
            case 'triptype':
                $this->getTripType();
                break;
            case 'relation':
                $this->getRelation();
                break;
            case 'enquirytype':
                $this->getEnquiryType();
                break; 
            case 'visacategory':
                $this->getVisaCategory();
                break; 
            case 'flighttype':
                $this->getFlightType();
                break;
            case 'flightclass':
                $this->getFlightClass();
                break;
            case 'flightstop':
                $this->getFlightStop();
                break;
            case 'customer':
                $this->getCustomer();
                break;    
            default:
                $this->errInfo("Check URL");
                break;
        }
    }

//////////////////////////////init complete here///////////////////////////////////////////////////////
    public function getEnquiryType() {
        $this->checkMethod();
        $data = $this->db->select('enquirytype',['ID','EnquiryType']);
        // echo $this->db->last_query();
        if (count($data) >= 1) {
            return $this->crg->setResponseCode(200, 'listed successfully', $data);
        } else {
            return $this->crg->setResponseCode(400, 'No information available');
        }
    }

    public function getEntity() {
        $this->checkMethod();
        $data = $this->db->select('entity',['ID','EntityName']);
        // echo $this->db->last_query();
        if (count($data) >= 1) {
            return $this->crg->setResponseCode(200, 'listed successfully', $data);
        } else {
            return $this->crg->setResponseCode(400, 'No information available');
        }
    }
    
    public function getLeadStatus() {
        $this->checkMethod();
        $data = $this->db->select('leadstatus',['ID','LeadTitle']);
        // echo $this->db->last_query();
        if (count($data) >= 1) {
            return $this->crg->setResponseCode(200, 'listed successfully', $data);
        } else {
            return $this->crg->setResponseCode(400, 'No information available');
        }
    }
    
    public function getTripType() {
        $this->checkMethod();
        $data = $this->db->select('triptype',['ID','TripType']);
        // echo $this->db->last_query();
        if (count($data) >= 1) {
            return $this->crg->setResponseCode(200, 'listed successfully', $data);
        } else {
            return $this->crg->setResponseCode(400, 'No information available');
        }
    }
    
    public function getRelation() {
        $this->checkMethod();
        $data = $this->db->select('relation',['ID','RelationTitle']);
        // echo $this->db->last_query();
        if (count($data) >= 1) {
            return $this->crg->setResponseCode(200, 'listed successfully', $data);
        } else {
            return $this->crg->setResponseCode(400, 'No information available');
        }
    }
    
    public function getVisaCategory() {
        $this->checkMethod();
        $data = $this->db->select('visacategory',['ID','CategoryName']);
        // echo $this->db->last_query();
        if (count($data) >= 1) {
            return $this->crg->setResponseCode(200, 'listed successfully', $data);
        } else {
            return $this->crg->setResponseCode(400, 'No information available');
        }
    }
    
    public function getFlightType() {
        $this->checkMethod();
        $data = $this->db->select('flighttype',['ID','FlightType']);
        // echo $this->db->last_query();
        if (count($data) >= 1) {
            return $this->crg->setResponseCode(200, 'listed successfully', $data);
        } else {
            return $this->crg->setResponseCode(400, 'No information available');
        }
    }
    
    public function getFlightClass() {
        $this->checkMethod();
        $data = $this->db->select('flightclass',['ID','ClassName']);
        // echo $this->db->last_query();
        if (count($data) >= 1) {
            return $this->crg->setResponseCode(200, 'listed successfully', $data);
        } else {
            return $this->crg->setResponseCode(400, 'No information available');
        }
    }
    
    public function getFlightStop() {
        $this->checkMethod();
        $data = $this->db->select('flightstop',['ID','FlightStop']);
        // echo $this->db->last_query();
        if (count($data) >= 1) {
            return $this->crg->setResponseCode(200, 'listed successfully', $data);
        } else {
            return $this->crg->setResponseCode(400, 'No information available');
        }
    }
    
    public function getCustomer() {
        $this->checkMethod();
        $data = $this->db->select('customer',['ID','FirstName(Name)']);
        // echo $this->db->last_query();
        if (count($data) >= 1) {
            return $this->crg->setResponseCode(200, 'listed successfully', $data);
        } else {
            return $this->crg->setResponseCode(400, 'No information available');
        }
    }

    

    /*
     * End of Class
     */
}
