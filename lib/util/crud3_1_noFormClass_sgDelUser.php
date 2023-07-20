<?php

class Crud3 {

    private $crg;
    private $ses;
    private $db;
    private $sd;
    private $tpl;
    private $rbac;
    private $update_form;

    /*
     * Quey conditions
     */

    /*
     * @var $reg registry array
     * 
     * $update_form = true
     * no add button available in the pagination
     */

    function __construct($reg) {

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


       
        /*
         * No add buttorn or add button removed
         * PART of crud2 CLASS INSTANCE
         */


        $this->__init();
    }

    public function __init() {

        /*
         * crud element setting
         * like edit, add or submit etc
         */

        $crud_string = null;

        if (isset($this->crg->get('route')['crud'])) {
            $crud_string = $this->crg->get('route')['crud'];
        }

        if (isset($_POST['req_from_list_view'])) {
            $crud_string = strtolower($_POST['req_from_list_view']);
        }

        /*
         * Example
         * /submit/edit
         */
        if (isset($this->crg->get('route')['crud_form_submit_from'])) {
            $crud_form_submit_from_a_form = $this->crg->get('route')['crud_form_submit_from'];
            $this->tpl->set('crud_form_submit_from', $crud_form_submit_from_a_form);
        } else {
            $crud_form_submit_from_a_form = $crud_string;
            $this->tpl->set('crud_form_submit_from', $crud_string);
        }


        // echo $crud_string;
        switch ($crud_string) {
            case 'delete':
                
                $yid = $_POST['ycs_ID'];
                if ($yid) {
                    //bUILD SQL 
                    $table1 = $this->crg->get('table_prefix') . 'customer';

                    $colArr = array(
                        "$table1.SGloginID",
                        "$table1.SGuserRegStatus"
                    );

		    //quote		
                    $yid = $this->db->quote($yid);

                    $sql = "SELECT "
                            . implode(',', $colArr)
                            . " FROM $table1"
                            . " WHERE "
                            . " $table1.ID = $yid  Limit 1";

                    $stmt = $this->db->prepare($sql);
                    $stmt->execute();
                    $rowData = $stmt->fetch(2);
                }



                if ($rowData['SGuserRegStatus'] == 'YES' && $rowData['SGloginID'] !== '' && $rowData['SGloginID'] !== NULL) {
                    //call api to register

	   	$u_SGServerIP = $this->ses->get('user')['SGServerIP'];

	  	//check whether a valid ip
	  	$valid = filter_var($u_SGServerIP, FILTER_VALIDATE_IP);
            
		$application_ip=$this->tpl->get('application_ip');

         if ($u_SGServerIP !== '' && $u_SGServerIP !== NULL && $valid) {

             $urlMaster = "http://".$u_SGServerIP."/sg_api/custom_responce.php?sgdata=";


                    $url = "order_type=21";
                    $url .= "&requester=$application_ip";

                    $url .= "&authkey=sguregp";
                    $url .= "&login_id=" . $rowData['SGloginID'];



                    $encUrl = base64_encode($url);

                    $urlMaster .= $encUrl;


                    try {
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $urlMaster);
                        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)');
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
                        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
                        $data = curl_exec($ch);
                        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                        curl_close($ch);

                        ($httpcode >= 200 && $httpcode < 300) ? $responceData = $data : false;
                    } catch (Exception $exc) {
                        $responceData = FALSE;
                    }
	    }else{
                $this->tpl->set('message', 'Smart Gaurd IP is not set to this user or user not loged in');
            }
                    //////////////Responce process/////////////////////////////
                    if ($responceData) {

                        $responcedataArr = explode('#', $responceData);

                        

                        switch ($responcedataArr[0]) {
                            case 'Status:Success':
                                $sql = "DELETE FROM $table1 WHERE $table1.ID = $yid";
                                try {
                                    $stmt = $this->db->prepare($sql);
                                    $stmt->execute();
                                    $this->tpl->set('message', $responcedataArr[1] . 'But SGuserRegStatus Update Successfull');
                                } catch (Exception $exc) {
                                    $this->tpl->set('message', $responcedataArr[1] . 'But SGuserRegStatus Update Failed, Try Again');
                                }
                                break;
                            case 'Status:Failed':
                                $this->tpl->set('message', $responcedataArr[1]);
                                break;
                            default:
                                $this->tpl->set('message', 'No responce data');
                                break;
                        }
                    } else {
                        $this->tpl->set('message', 'No responce data - Smartgaurd not responding');
                    }
                } else {
                    $this->tpl->set('message', 'No Login ID or Package');
                }

                $this->tpl->set('label', 'Go back to List');
                $this->tpl->set('content', $this->tpl->fetch('factory/template/form_button_link.php'));
                
                break;

            case 'list':
            default:
                return $this->paginate();
                break;
        }
    }

/////////////////////////////////////////


    protected function paginate() {

        try {

            $paginationTpl = $this->crg->get('paginationListTemplate');
            if ($paginationTpl) {
                $Complete_form = $this->tpl->fetch($paginationTpl);
            } else {
                $Complete_form = $this->tpl->fetch('factory/template/sql_based_crud_paginated_table.php');
            }
        } catch (Exception $exc) {
            $Complete_form = 'Pl.Try Again';
        }

        if ($this->crg->get('deliver_at')) {
            $this->tpl->set($this->crg->get('deliver_at'), $Complete_form);
        } else {
            $this->tpl->set('content', $Complete_form);
        }
    }

/////////////////////////////////////////////////////////////

   
/////////////class close ////////////////////////////////////
}
