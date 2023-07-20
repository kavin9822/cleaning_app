<?php

/**
 * @Desc EnquiryReminder in enquiry module
 * @author Gunabalans
 */
include_once 'Util/CrudApi.php';

class EnquiryReminder extends Util\CrudApi {

    public function __construct($reg = NULL) {
        $this->crg = $reg;
        $this->crg->set('tn', 'reminder'); //table name without prefix
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
            'ReminderTitle' => filter_input(INPUT_POST, 'ReminderTitle', FILTER_SANITIZE_STRING),
            //'Description' => filter_input(INPUT_POST, 'Description', FILTER_SANITIZE_STRING), 
            'ReminderDate' => filter_input(INPUT_POST, 'ReminderDate', FILTER_SANITIZE_STRING),
            'ReminderTime' => filter_input(INPUT_POST, 'ReminderTime', FILTER_SANITIZE_STRING),
            'customer_ID' => filter_input(INPUT_POST, 'customer_ID', FILTER_SANITIZE_STRING),
            'AuditDateTime' => date('Y-m-d H:i:s')
        ];
        
        $custID = filter_input(INPUT_GET, 'CustID', FILTER_SANITIZE_STRING);
        //$enquiryID = filter_input(INPUT_GET, 'EnquiryID', FILTER_SANITIZE_STRING);
        $enqRemindID = filter_input(INPUT_POST, 'ID', FILTER_SANITIZE_STRING);
        
        switch ($this->HTTPMethodStringFromUrl) {
            case 'view':
                $this->checkMethod();
                
                $x = $this->db->select('reminder', '*', ['ID' => filter_input(INPUT_GET, 'ID', FILTER_SANITIZE_STRING)]);               
                if($x){                   
                    return $this->crg->setResponseCode(200, 'Data got Successfully',$x);
        	    } else {     
                    return $this->crg->setResponseCode(400, 'No data available, failed to delete');        	      
                }
                break;
            
            case 'delete':
                $this->checkMethod();
                
                $x = $this->db->delete('reminder', ['ID' => filter_input(INPUT_GET, 'ID', FILTER_SANITIZE_STRING)]);               
                if($x){                   
                    return $this->crg->setResponseCode(200, 'Data deleted Successfully');
        	    } else {     
                    return $this->crg->setResponseCode(400, 'No data available, failed to delete');        	      
                }
                break;
            
            case 'edit':
		        
		        /*
                 * /////////////////////////////////////////////////////////////
                 * set where condition
                 */
                $whereCondArray = ['ID' => $enqRemindID];
                /*
                 * we can add more where contion in to the arr
                 * example
                 * $whereCondArray["Aadhar"] = "test";
                 * and pass tp handle request functions
                 * //////////////////////////////////////////////////////////////////
                 */
                
                $x = $this->db->update('reminder', $ColInfo, $whereCondArray);
                //echo $this->db->last_query();
                if($x){                   
                    return $this->crg->setResponseCode(200, 'Data Updated Successfully');
        	    } else {     
                    return $this->crg->setResponseCode(400, 'No changes made, failed to update');        	      
                }
		        
                break;
                
             case 'add':
              
                $x = $this->db->insert('reminder', $ColInfo);
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
                    
                $getRow = $this->db->select('reminder', '*', $whereCondArray);
                    
                    if (count($getRow) >= 1) {
                        return $this->crg->setResponseCode(200, 'Got Data successfully', $getRow[0]);
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