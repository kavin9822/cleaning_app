<?php

/**
 * @Desc CustomerDocs in Customer module
 * @author Gunabalans
 */
include_once 'Util/CrudApi.php';

class CustomerDocs extends Util\CrudApi {

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
            'FileName' => filter_input(INPUT_POST, 'FileName', FILTER_SANITIZE_STRING),
            'UploadFile' => filter_input(INPUT_POST, 'UploadFile', FILTER_SANITIZE_STRING),
            'customer_ID' => filter_input(INPUT_POST, 'customer_ID', FILTER_SANITIZE_STRING),
            'AuditDateTime' => date('Y-m-d H:i:s')
        ];
        
        $custID = filter_input(INPUT_GET, 'CustID', FILTER_SANITIZE_STRING);
        $custDocID = filter_input(INPUT_POST, 'ID', FILTER_SANITIZE_STRING);
        
        switch ($this->HTTPMethodStringFromUrl) {
            case 'view':
                $this->checkMethod();
                
                $x = $this->db->select('customerdocs', '*', ['ID' => filter_input(INPUT_GET, 'ID', FILTER_SANITIZE_STRING)]);               
                if($x){                   
                    return $this->crg->setResponseCode(200, 'Data got Successfully',$x);
        	    } else {     
                    return $this->crg->setResponseCode(400, 'No data available, failed to delete');        	      
                }
                break;
                
            case 'delete':
                $this->checkMethod();
                $fileName = $this->db->select('customerdocs', 'UploadFile', ['ID' => filter_input(INPUT_GET, 'ID', FILTER_SANITIZE_STRING)]);
                $filePath = '../'.$this->crg->get('appConfig')['customer_docs'] . '/' . $fileName[0];
                
                if(file_exists($filePath)){
                    unlink($filePath);
                    $x = $this->db->delete('customerdocs', ['ID' => filter_input(INPUT_GET, 'ID', FILTER_SANITIZE_STRING)]);               
                }
                
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
                $whereCondArray = ['ID' => $custDocID];
                /*
                 * we can add more where contion in to the arr
                 * example
                 * $whereCondArray["Aadhar"] = "test";
                 * and pass tp handle request functions
                 * //////////////////////////////////////////////////////////////////
                 */
                 
                $fileName = $this->db->select('customerdocs', 'UploadFile', $whereCondArray);
                $filePath = '../'.$this->crg->get('appConfig')['customer_docs'] . '/' . $fileName[0];
                
                if(file_exists($filePath)){
                    unlink($filePath);
                }                 
                 
                // Read image path, convert to base64 encoding
             	$img = imagecreatefromstring(base64_decode($data['UploadFile']));
        	    $imgFileName = $this->crg->get('appConfig')['customer_docs'] . '/' . $ColInfo['customer_ID'] .'_'. $ColInfo['FileName'] . '.png';
        	    imagepng($img, '../' . $imgFileName);
                
                //Incase appresource is inside the base folder
                //$data['PhotoUpload'] = $this->crg->get('appConfig')['host_name'] . '/' . $this->crg->get('base_folder'). $imgFileName;                   
                
        	    //Incase appresource is outside the base folder, common.
                $ColInfo['UploadFile'] = $ColInfo['customer_ID'] .'_'. $ColInfo['FileName'] . '.png';  
                
                $x = $this->db->update('customerdocs', $ColInfo, $whereCondArray);
                //echo $this->db->last_query();
                if($x){                   
                    return $this->crg->setResponseCode(200, 'Data Updated Successfully');
        	    } else {     
                    return $this->crg->setResponseCode(400, 'No changes made, failed to update');        	      
                }
		        
                break;
                
             case 'add':
                 
                // Read image path, convert to base64 encoding
             	$img = imagecreatefromstring(base64_decode($data['UploadFile']));
        	    $imgFileName = $this->crg->get('appConfig')['customer_docs'] . '/' . $ColInfo['customer_ID'] .'_'. $ColInfo['FileName'] . '.png';
        	    imagepng($img,  '../'. $imgFileName);
                
        	    //Incase appresource is outside the base folder, common.
                $ColInfo['UploadFile'] = $ColInfo['customer_ID'] .'_'. $ColInfo['FileName'] . '.png';
              
                $x = $this->db->insert('customerdocs', $ColInfo);
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
                    
                $getRow = $this->db->select('customerdocs', '*', $whereCondArray);
                
                    if (count($getRow) >= 1) {
                        foreach($getRow as $key=>$value){
                            foreach ($value as $subKey => $subValue) {
                                if($subKey=='UploadFile'){
                    	            $getRow[$key][$subKey] = $this->crg->get('appConfig')['host_name']. '/' . $this->crg->get('appConfig')['customer_docs'] . '/' . $subValue;
                                }
                            }
                        }
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