<?php

/**
 * @Desc Customer Family in Customer module
 * @author Gunabalans
 */
include_once 'Util/CrudApi.php';

class CustomerFamily extends Util\CrudApi {

    public function __construct($reg = NULL) {
        $this->crg = $reg;
        $this->crg->set('tn', 'customerfamily'); //table name without prefix
        $this->crg->set('pk', 'ID'); //priumary key used for access
        parent::__construct($this->crg);
    }

///////////////Constructor completed here/////////////////
//////////////////////////////////////////////////////////
    public function init() {
        /*
         * Crud Implemetation call
         */
        //used in get metohds
        $ColInfo = [
            'MemberName' => filter_input(INPUT_POST, 'MemberName', FILTER_SANITIZE_STRING),
            'DOB' => filter_input(INPUT_POST, 'DOB', FILTER_SANITIZE_STRING),
            'MobileNo' => filter_input(INPUT_POST, 'MobileNo', FILTER_SANITIZE_STRING),
            'customer_ID' => filter_input(INPUT_POST, 'customer_ID', FILTER_SANITIZE_STRING),
            'relation_ID' => filter_input(INPUT_POST, 'relation_ID', FILTER_SANITIZE_STRING),
            'PassportNo' => filter_input(INPUT_POST, 'PassportNo', FILTER_SANITIZE_STRING),
            'PassportExpiryDate' => filter_input(INPUT_POST, 'PassportExpiryDate', FILTER_SANITIZE_STRING),
            'MemberType' => filter_input(INPUT_POST, 'MemberType', FILTER_SANITIZE_STRING),
            'AuditDateTime' => filter_input(INPUT_POST, 'CurrentDateTime', FILTER_SANITIZE_STRING)
        ];
        
        $custID = filter_input(INPUT_GET, 'CustID', FILTER_SANITIZE_STRING);
        $custMemberID = filter_input(INPUT_POST, 'ID', FILTER_SANITIZE_STRING);
        
        switch ($this->HTTPMethodStringFromUrl) {
            case 'delete':
                $this->checkMethod();
                
                $x = $this->db->delete('customerfamily', ['ID' => filter_input(INPUT_GET, 'ID', FILTER_SANITIZE_STRING)]);               
                if($x){                   
                    return $this->crg->setResponseCode(200, 'Data deleted Successfully');
        	    } else {     
                    return $this->crg->setResponseCode(400, 'No data available, failed to delete');        	      
                }
                break;
            
            case 'update':
		        
		        /*
                 * /////////////////////////////////////////////////////////////
                 * set where condition
                 */
                $whereCondArray = ['ID' => $custMemberID];
                /*
                 * we can add more where contion in to the arr
                 * example
                 * $whereCondArray["Aadhar"] = "test";
                 * and pass tp handle request functions
                 * //////////////////////////////////////////////////////////////////
                 */
                
                $x = $this->db->update('customerfamily', $ColInfo, $whereCondArray);
                //echo $this->db->last_query();
                if($x){                   
                    return $this->crg->setResponseCode(200, 'Data Updated Successfully');
        	    } else {     
                    return $this->crg->setResponseCode(400, 'No changes made, failed to update');        	      
                }
		        
                break;
                
             case 'create':
                
                $x = $this->db->insert('customerfamily', $ColInfo);
                //echo $this->db->last_query();
                
                if($x){                   
                      return $this->crg->setResponseCode(200, 'Data inserted successfully');
        	    } else {     
                      return $this->crg->setResponseCode(400, 'Data failed to insert!');        	      
                }
                break;
            
            case 'list':
                
                $this->checkMethod();
                $this->accRightsCheck(2);
                
                $whereCondArray = ['customer_ID' => $custID];
                
                if (is_array($whereCondArray)) {
                $getRow = $this->db->select('customerfamily', '*', $whereCondArray);
                
                    if (count($getRow) >= 1) {
                        return $this->crg->setResponseCode(200, 'Got Data successfully', $getRow);
                    } else {
                        return $this->crg->setResponseCode(400, 'No such data to get');
                    }
                } else {
                    return $this->crg->setResponseCode(400, 'Customer ID Data required');
                } 
                
                break; 
                
            default:
                $this->errInfo("Check URL");
                break;
        }
    }

//////////////////////////////init complete here///////////////////////////////////////////////////////


    /*
     * End of Class
     */
}