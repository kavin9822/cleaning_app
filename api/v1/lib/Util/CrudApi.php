<?php

/*
 * @author Gunabalans
 */

namespace Util;

/**
 * Description of CrudApi
 *
 * @author ycs-gbs
 */
class CrudApi {

    protected $reg;
    protected $crg;
    protected $db;

    /*
     * @desc table name used in crud class
     */
    protected $tn;
    /*
     * @desc primary key of a table to access data
     */
    protected $pk;
    /*
     * @desc access rights level
     * Type INT 
     */
    protected $accessRightsLevelInt;
    /*
     * @desc access rights restricted level
     * Type INT 
     */
    protected $accessRightsRestrictedTo;
    /*
     * HTTP Method identifier - Method by which Data sent over http 
     * This is for developer to know the purpose of the function call 
     * with out any confution
     * 
     * Ofcourece we do check the method   
     */
    protected $HTTPMethodStringFromUrl;
    /*
     * @var $req_method
     * @desc Actual request method
     * By which clent send data API server 
     */
    protected $req_method;

    protected function __construct($reg = NULL) {

        $this->crg = $reg;
        $this->db = $this->crg->get('db');
        $this->tn = $this->crg->get('tn');
        $this->pk = $this->crg->get('pk');

        //methods
        $this->HTTPMethodStringFromUrl = isset($this->crg->get('uri_array')[1]) ? $this->crg->get('uri_array')[1] : FALSE;
        $this->req_method = filter_input(INPUT_SERVER, 'REQUEST_METHOD', FILTER_SANITIZE_STRING);

        $this->accessRightsLevelInt = (int) $this->crg->get('Access_rights')['Rights'];
        $this->accessRightsRestrictedTo = (int) $this->crg->get('Access_rights')['RestrictedTo'];
    }

    //general err info
    protected function errInfo($errMessparam, $dberr = false) {

        $err = [
            'errID' => 'Err in ' . $this->crg->get('moduleFolder') . ' module and at ' . $this->crg->get('controlerCls') . ' Controller',
            'errMessage' => $errMessparam,
            'dberrInfo' => $dberr,
            'debug_trace' => debug_backtrace()
        ];

        return $this->crg->setResponseCode(401, $err);
    }

    public function selectAll($colData, $wCondAr = null, $ljoint = null, $accChk = true) {
        $this->checkMethod();
        if ($accChk) {
            $this->accRightsCheck(2);
        }

        if($ljoint==''){
            $getRows = $this->db->select($this->tn, $colData,  $wCondAr);    
        }else{
            $getRows = $this->db->select($this->tn, $ljoint, $colData,  $wCondAr);
        }
         
        //echo $this->db->last_query();
        if (count($getRows) >= 1) {
            return $this->crg->setResponseCode(200, 'Got Data successfully', $getRows);
        } else {
            return $this->crg->setResponseCode(400, 'No such data to get');
        }
    }

    /*
     * Crud paginated list
     */

    protected function handleListRequest($colData, $wCondAr, $accChk = true) {
        /*
         * Pagination part
         * list/5/100
         * list/pageoffset/limit
         */
        $this->checkMethod();
        if ($accChk) {
            $this->accRightsCheck(2);
        }

        $todalNumRows = $this->db->count($this->tn, $wCondAr);
            	//echo $this->db->last_query();
        if ($todalNumRows < 1) {
            return $this->crg->setResponseCode(400, 'No data to select');
        }

        $PageOffset = !empty($this->crg->get('uri_array')[2]) ? (int) $this->crg->get('uri_array')[2] : 0;
        $PageLimit = !empty($this->crg->get('uri_array')[3]) ? (int) $this->crg->get('uri_array')[3] : 100;

        if ($PageOffset <= 1) {
            $setLimit = $PageLimit;
        } else {
            $setLimit = [$PageOffset, $PageLimit];
        }

        $wCondAr["LIMIT"] = $setLimit;

    	$getManyRows = $this->db->select($this->tn, $colData, $wCondAr);
    	//echo $this->db->last_query();
        $countSelectedRows = count($getManyRows);

        $nextPageOffset = $PageOffset + $PageLimit;
        $prevPageOffset = $PageOffset - $PageLimit;

        //reached prev page limit
        if ($countSelectedRows < $PageLimit && $prevPageOffset < 0) {
            $prevPageOffset = FALSE;
        }

        //reached next page limit
        if ($countSelectedRows < $PageLimit && $nextPageOffset > $todalNumRows) {
            $nextPageOffset = FALSE;
        }

        $pagingData = [
            'prev' => $prevPageOffset,
            'next' => $nextPageOffset,
            'home' => $PageOffset,
            'total' => $todalNumRows,
            'limit' => $PageLimit
        ];

        $responseListData = [
            'pagingData' => $pagingData,
            'rowData' => $countSelectedRows >= 1 ? $getManyRows : false
        ];

        return $this->crg->setResponseCode(200, 'Success', $responseListData);
    }

////////////////////////////////////////////////////////////////////////////////////////////
    /*
     * check metod
     */
    protected function checkMethod($mtd = "GET") {
        if ($this->req_method !== $mtd) {
            $msg = "The request method should be " . $mtd;
            return $this->errInfo($msg);
        }
    }

    /*
     * Access rights and Access restriction condition
     */

    protected function accRightsCheck($accLevel) {
        if ($this->accessRightsLevelInt >= $accLevel) {
            if ($this->accessRightsRestrictedTo === $accLevel) {
                $errMess = 'this user is resctricted to level ' . $this->accessRightsRestrictedTo . ' or ' . $this->HTTPMethodStringFromUrl . ' API call';
                return $this->crg->setResponseCode(401, $errMess);
            }
        } else {
           return $this->crg->setResponseCode(401, 'You dont have access to this resource');
        }
    }

    /*
     * Handle insert request
     */

    public function handleAddRequest($ColDataToAdd, $accChk = true) {
        $this->checkMethod("POST");
        if ($accChk) {
            $this->accRightsCheck(3);
        }

        $insertData = $this->db->insert($this->tn, $ColDataToAdd);
        //if update successfull
        if ($insertData >= 1) {
            return $this->crg->setResponseCode(200, 'Data inserted Successfully ' . $this->crg->get('message'));
        } else {
            return $this->crg->setResponseCode(400, 'Failed to Insert');
        }
    }

//////////////////////////////////////////////////////////////////////////////////////////

    /*
     * Handle update request
     */

    public function handleUpdateRequest($ColDataToUpdate, $wCondAr, $accChk = true) {
        $this->checkMethod("POST");
        if ($accChk) {
            $this->accRightsCheck(4);
        }
        $updateData = $this->db->update($this->tn, $ColDataToUpdate, $wCondAr);
        //echo  $this->db->last_query();
        //if update successfull
        if ($updateData >= 1) {
            return $this->crg->setResponseCode(200, 'Data Updated Successfully');
        } else {
            return $this->crg->setResponseCode(400, 'No changes made, failed to update');
        }
    }

//////////////////////////////////////////////////////////////////////////////////////////

    /*
     * Crud get method call
     * 
     */

    public function handleGetRequest($colData, $wCondAr, $accChk = true) {
        $this->checkMethod();
        if ($accChk) {
            $this->accRightsCheck(2);
        }
        if (is_array($wCondAr)) {
            $getRow = $this->db->select($this->tn, $colData, $wCondAr);
            if (count($getRow) == 1) {
                return $this->crg->setResponseCode(200, 'Got Data successfully', $getRow[0]);
            } else {
                return $this->crg->setResponseCode(400, 'No such data to get');
            }
        } else {
            return $this->crg->setResponseCode(400, 'ID Data required');
        }
    }

//////////////////////////////////////////////////////////////////////////////////////////
    public function handleDelRequest($wCondAr, $accChk = true) {
        $this->checkMethod("DELETE");
        //is access check required or not
        if ($accChk) {
            $this->accRightsCheck(5);
        }

        $delData = $this->db->delete($this->tn, $wCondAr);
        if ($delData >= 1) {
            return $this->crg->setResponseCode(200, 'Data deleted');
        } else {
            return $this->crg->setResponseCode(200, 'No date to Delete or deleted already');
        }
    }

//////////////////////////////////////////////////////////////////////////////////////////
    /*
     * @name wc()
     * @return array
     * @desc Primary key based where condition setter function
     */
    protected function wc() {
        //id column /permission/get/A123
        $IDCol = $this->crg->get('uri_array')[2];
        //if id is empty then return
        if (empty($IDCol)) {
            return $this->crg->setResponseCode(400, 'Id value required or cant be empty');
        }
        $wConArr = [
            $this->pk => trim(strip_tags($IDCol))
        ];

        return $wConArr;
    }

/////////////////



    /*
     * handle file upload
     */

    protected function handle_file_upload($params, $whereToUpload, $userID = NULL) {
        try {
            if (!empty($_FILES)) {
                if (is_uploaded_file($_FILES[$params]['tmp_name'])) {
                    $sourcePath = $_FILES[$params]['tmp_name'];
                    $targetPath = $whereToUpload . '/' . $userID . '-' . date('y-m-d-H-i-s') . '-' . $_FILES[$params]['name'];
                    if (move_uploaded_file($sourcePath, $targetPath)) {
                        return $targetPath;
                    } else {
                        return FALSE;
                    }
                }
            }
        } catch (Exception $exc) {
            return FALSE;
        }
    }

    /*
     * Convert Col data with alias
     */

    public function colWithAlias($coldt) {
        $colAliasData = [];
        foreach ($coldt as $key => $value) {
            $colAliasData[] = $key . '(' . $value . ')';
        }
        return $colAliasData;
    }

////////class/////////////
}
