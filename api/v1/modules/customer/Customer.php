<?php

/**
 * @Desc Customer in Customer module
 * @author Gunabalans
 */
include_once 'Util/CrudApi.php';

class Customer extends Util\CrudApi {

    public function __construct($reg = NULL) {
        $this->crg = $reg;
        $this->crg->set('tn', 'customer'); //table name without prefix
        $this->crg->set('pk', 'CustomerID'); //priumary key used for access
         $this->getHeaders = $this->crg->get('HttpHeaders');
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
            'FirstName' => 'Name',
            'CustomerGSTNo' => 'CustGSTN',
            'Address' => 'Address',
            'Pincode' => 'Pincode',
            'City' => 'City',
            'State' => 'State',
            'Country' => 'Country', 
            'MobileNo' => 'MobileNo',
            'Email' => 'Email',
            'DateOfBirth' => 'DOB',
            'AuditDateTime' => 'CurrentDateTime',
        ];
        
                $logfile = './resource/transactionlog/Log_' . date("M_Y") . '.txt';
                chmod('./transactionlog', 0777);
    
                if (file_exists($logfile)) {
                    file_put_contents($logfile, "\n" . "[" . date("d-m-Y H:i:s") . "]" . "{" . $this->getHeaders['Content-Type'] . "}", FILE_APPEND);
                    file_put_contents($logfile, "\n" . "[" . date("d-m-Y H:i:s") . "]" . "{" . $this->getHeaders['Authorization'] . "}", FILE_APPEND);
                    file_put_contents($logfile, "\n" . "[" . date("d-m-Y H:i:s") . "]" . "{" . file_get_contents('php://input') . "}", FILE_APPEND);
                } else {
                    $handle = fopen("$logfile", "w+");
                    fwrite($handle, "[" . date("d-m-Y H:i:s") . "]" . "{" . $this->getHeaders['Content-Type'] . "}");
                    fwrite($handle, "[" . date("d-m-Y H:i:s") . "]" . "{" . $this->getHeaders['Authorization'] . "}");
                    fwrite($handle, "[" . date("d-m-Y H:i:s") . "]" . "{" . file_get_contents('php://input') . "}");
                    fclose($handle);
                }

        switch ($this->HTTPMethodStringFromUrl) {
            case 'delete':
                
                $this->checkMethod();
                $this->accRightsCheck();
        
                $custID = filter_input(INPUT_GET, $this->pk, FILTER_SANITIZE_STRING);
                
                if($custID){
                    $this->db->delete("customer", ['ID'=>$custID]);
                    $this->db->delete("customerdocs", ['customer_ID'=>$enquiryID]);
                    $this->db->delete("customerfamily", ['customer_ID'=>$enquiryID]);
                    
                    return $this->crg->setResponseCode(200, 'Customer records has been deleted successfully');
                    
                } else {
                    return $this->crg->setResponseCode(400, 'Failed to delete customer data');
                }
                
                break;
            
            case 'get':
                $custID = filter_input(INPUT_GET, $this->pk, FILTER_SANITIZE_STRING);
                
                $ColToSel = $this->colWithAlias($ColInfo);  
                //$this->handleGetRequest($ColToSel, $whereCondArray);
                
                $this->checkMethod();
                $this->accRightsCheck(2);
                
                $whereCondArray = ['ID' => $custID];
                
                if (is_array($whereCondArray)) {
                $getRow = $this->db->select('customer', $ColToSel, $whereCondArray);
                
                    if (count($getRow) == 1) {
                    //if (count($getRow) == 1 && $getRow[0]['PhotoUpload']!==null) {    
                    	//$getRow[0]['Photo'] = $this->crg->get('appConfig')['host_name']. '/' . $this->crg->get('appConfig')['customer_docs'] . '/' . $getRow[0]['PhotoUpload'];
                    	//$getRow[0]['IdProof'] = $this->crg->get('appConfig')['host_name']. '/' . $this->crg->get('appConfig')['customer_docs'] . '/' . $getRow[0]['IdProof'];
                        return $this->crg->setResponseCode(200, 'Got Data successfully', $getRow[0]);
                    } else {
                        return $this->crg->setResponseCode(400, 'No such data to get');
                    }
                } else {
                    return $this->crg->setResponseCode(400, 'ID Data required');
                }                
                
                break;
            
            case 'update':
		        
		        $CustID = filter_input(INPUT_POST, $this->pk, FILTER_SANITIZE_STRING);
                
		        /*
                 * /////////////////////////////////////////////////////////////
                 * set where condition
                 */
                $whereCondArray = ['ID' => $CustID];
                /*
                 * we can add more where contion in to the arr
                 * example
                 * $whereCondArray["Aadhar"] = "test";
                 * and pass tp handle request functions
                 * //////////////////////////////////////////////////////////////////
                 */

                $ColDtUpdate = $this->dataReceiver($ColInfo, FALSE);
               
                $x = $this->db->update('customer', $ColDtUpdate, $whereCondArray);
                //echo $this->db->last_query();
                if($x){                   
                    return $this->crg->setResponseCode(200, 'Data Updated Successfully');
        	    } else {     
                    return $this->crg->setResponseCode(400, 'No changes made, failed to update');        	      
                }
                break;
                
             case 'create':
		        //$usrID = $this->crg->get('UserID');
		        
		        $logfile = './resource/transactionlog/Log_' . date("M_Y") . '.txt';
                chmod('./transactionlog', 0777);
    
                if (file_exists($logfile)) {
                    file_put_contents($logfile, "\n" . "[" . date("d-m-Y H:i:s") . "]" . "{" . file_get_contents('php://input') . "}", FILE_APPEND);
                } else {
                    $handle = fopen("$logfile", "w+");
                    fwrite($handle, "[" . date("d-m-Y H:i:s") . "]" . "{" . file_get_contents('php://input') . "}");
                    fclose($handle);
                }

                $ColDtUpdate = $this->dataReceiver($ColInfo, FALSE);
                $x = $this->db->insert('customer', $ColDtUpdate);
                //echo $this->db->last_query();
                
                if($x){                   
                      return $this->crg->setResponseCode(200, 'Data inserted successfully');
        	    } else {     
                      return $this->crg->setResponseCode(400, 'Data failed to insert!');        	      
                }
                break;
            
            case 'list':
                
                //$ColToSel = ['ID','FirstName','LastName','City','MobileNo','Email']; 
                
                $ColToSel = ['ID('.$this->pk.')','FirstName(Name)','CustomerGSTNo(CustGSTN)','Address','Pincode','City','State','Country','MobileNo','Email','DateOfBirth(DOB)']; 
                $ColToSelQuery = ['FirstName','LastName','City','Email']; 
                
                $this->checkMethod();
                $this->accRightsCheck(2);
                
                $whereCondArray = ['entity_ID' => $this->crg->get('userData')['entity_ID']];
                
                $query_string = filter_input(INPUT_GET, 'q', FILTER_SANITIZE_STRING);
                
                if($query_string){
                    if(is_numeric($query_string)){
                        $rowdata = $this->db->select("customer",$ColToSel,['MobileNo[~]' => $query_string]);
                    }else{
                        $rowdata = $this->db->select("customer",$ColToSel,[
                                    	"MATCH" => [
                                    		"columns" => $ColToSelQuery,
                                    		"keyword" => $query_string,
                                    		"mode" => "boolean"
                                    	]]);
                    }
                    
                    //echo $this->db->last_query();   
                        
                        if (count($rowdata) >= 1)
                         return $this->crg->setResponseCode(200, 'Got Data successfully', $rowdata);
                        else
                         return $this->crg->setResponseCode(400, 'No such data to get');
                    
                }else{
                if (is_array($whereCondArray)) {
                $getRow = $this->db->select('customer',$ColToSel, $whereCondArray);
                
                    if (count($getRow) >= 1) {
                        return $this->crg->setResponseCode(200, 'Got Data successfully', $getRow);
                    } else {
                        return $this->crg->setResponseCode(400, 'No such data to get');
                    }
                } else {
                    return $this->crg->setResponseCode(400, 'Entity ID Data required');
                }  
                }
                
                break; 
            
            case 'search':
                
                $this->checkMethod();
                $this->accRightsCheck();
        
                //used in get metohds
                $ColInfo = [
                    'ID' => 'CustID',
                    'FirstName' => 'Name',
                    'MobileNo' => 'Mobile',
                    'Email' => 'Email',
                    'City' => 'City',
                ];
        
                //http://ycstravel.whyceeyes.com/V1.0/customer/search?FilterBy=Mobile&FilterValue=978822
                $fby = filter_input(INPUT_GET, 'FilterBy', FILTER_DEFAULT);
                $fval = filter_input(INPUT_GET, 'FilterValue', FILTER_DEFAULT);
        
                $colToSelect = $this->colWithAlias($ColInfo);
                $flipCol = array_flip($ColInfo);
                if (isset($fby) && !empty($fby)) {
                    $wCondAr = [$flipCol[$fby].'[~]'=> $fval];
                    return $this->selectAll($colToSelect, $wCondAr);
                } else {
                    return $this->crg->setResponseCode(400, 'No data to search');
                }
            
            break;  
                
            default:
                $this->errInfo("Check URL");
                break;
        }
    }

//////////////////////////////init complete here///////////////////////////////////////////////////////

    /*
     * receive data from post
     * @var $add true if u want to generate rand string to pk value
     * and selectively udate data
     */

    private function dataReceiver($ColInfoData, $add = true) {
        echo hi;die;
        $data = [
            //'ID' => filter_input(INPUT_POST, $ColInfoData['ID'], FILTER_SANITIZE_STRING),
            //'PhotoUpload' => filter_input(INPUT_POST, $ColInfoData['PhotoUpload'], FILTER_SANITIZE_STRING),
            //'Designation' => filter_input(INPUT_POST, $ColInfoData['Designation'], FILTER_SANITIZE_STRING),
            'FirstName' => filter_input(INPUT_POST, $ColInfoData['FirstName'], FILTER_SANITIZE_STRING),
            //'LastName' => filter_input(INPUT_POST, $ColInfoData['LastName'], FILTER_SANITIZE_STRING),
            'CustomerGSTNo' => filter_input(INPUT_POST, $ColInfoData['CustomerGSTNo'], FILTER_SANITIZE_STRING),
            'Address' => filter_input(INPUT_POST, $ColInfoData['Address'], FILTER_SANITIZE_STRING),
            'City' => filter_input(INPUT_POST, $ColInfoData['City'], FILTER_SANITIZE_STRING),
            'Pincode' => filter_input(INPUT_POST, $ColInfoData['Pincode'], FILTER_SANITIZE_EMAIL),
            'State' => filter_input(INPUT_POST, $ColInfoData['State'], FILTER_SANITIZE_STRING),
            'Country' => filter_input(INPUT_POST, $ColInfoData['Country'], FILTER_SANITIZE_STRING),
            //'PhoneNo' => filter_input(INPUT_POST, $ColInfoData['PhoneNo'], FILTER_SANITIZE_STRING),
            'MobileNo' => filter_input(INPUT_POST, $ColInfoData['MobileNo'], FILTER_SANITIZE_STRING),
            'Email' => filter_input(INPUT_POST, $ColInfoData['Email'], FILTER_SANITIZE_STRING),
            //'AltMobileNo' => filter_input(INPUT_POST, $ColInfoData['AltMobileNo'], FILTER_SANITIZE_STRING),
            //'AltEmail' => filter_input(INPUT_POST, $ColInfoData['AltEmail'], FILTER_SANITIZE_STRING),
            //'DateOfAnniversary' => filter_input(INPUT_POST, $ColInfoData['DateOfAnniversary'], FILTER_SANITIZE_STRING),
            'DateOfBirth' => date('Y-m-d',strtotime(filter_input(INPUT_POST, $ColInfoData['DateOfBirth'], FILTER_SANITIZE_STRING))),
            //'IdProof' => filter_input(INPUT_POST, $ColInfoData['IdProof'], FILTER_SANITIZE_STRING),
            'AuditDateTime' => filter_input(INPUT_POST, $ColInfoData['AuditDateTime'], FILTER_SANITIZE_STRING),
            'entity_ID' => $this->crg->get('userData')['entity_ID'],
            'user_ID' => $this->crg->get('userData')['ID'],
        ];
      

	    // Read image path, convert to base64 encoding
    //  	$img = imagecreatefromstring(base64_decode($data['PhotoUpload']));
	   // $imgFileName = $this->crg->get('appConfig')['customer_docs'] . '/' . $this->crg->get('UserID') .  '.png';
    //     imagepng($img,  "../". $imgFileName);	
        
    //     $imgIdProof = imagecreatefromstring(base64_decode($data['IdProof']));
	   // $imgFileIdProof = $this->crg->get('appConfig')['customer_docs'] . '/' . 'IDProof-'. $this->crg->get('UserID') .'.png';
    //     imagepng($imgIdProof,  "../". $imgFileIdProof);
        
        //Incase appresource is inside the base folder
        //$data['PhotoUpload'] = $this->crg->get('appConfig')['host_name'] . '/' . $this->crg->get('base_folder'). $imgFileName;                   
        
	    //Incase appresource is outside the base folder, common.
        // $data['PhotoUpload'] = $this->crg->get('UserID') . '.png';  
        // $data['IdProof'] = 'IdProof-'.$this->crg->get('UserID') . '.png';  
       
        /*
         * if add is true add pk value incase if insert command 
         */
        if ($add) {
            $data[$this->pk] = str_pad(rand(), 12);
        }
        return $data;
    }

    /*
     * End of Class
     */
}
?>