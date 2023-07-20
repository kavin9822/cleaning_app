<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DBUTIL
 *
 * @author psmahadevan
 */
class DBUTIL {

    private $crg;
    private $ses;
    private $db;
    private $sd;
    private $tpl;
    private $rbac;

    public function __construct($reg = NULL) {
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
    }

////////////////////////////////////////////////////////////////////////////

    public function getSqlData($sql,$pdoType = 2) {
        
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            $Data_rows = $stmt->fetchAll($pdoType);
        } catch (Exception $exc) {
            $Data_rows = FALSE;
        }
        return $Data_rows;
    }

/////////////////////////////////////////////////////////////////
    
    public function putSqlData($sql) {
        
        try {
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
        } catch (Exception $exc) {
            $Data_rows = FALSE;
        }
        return TRUE;
    }

///////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////
public function ApprovalProcess($processtype,$sendUserID,$lastInsertedID)
{
    
    
    
        $app_sql = "INSERT INTO ".$this->crg->get('table_prefix').'approvalprocess'." (ProcessType,process_ID,sendfromUser_ID,sendtoUser_ID)"
                        ." VALUES ('$processtype',$lastInsertedID,".$this->ses->get('user')['ID'].",$sendUserID)";
  
   try {
               $stmt1 = $this->db->prepare($app_sql);
  
                if ($stmt1->execute()) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            } catch (Exception $exc) {
                return FALSE;
            }
                
}

    public function updateData($table_name, $data, $whereKEY, $whereVAL) {

        if ($whereKEY && $whereVAL) {

            $actual_table_name = $this->crg->get('table_prefix') . $table_name;
            $sql_query = "SELECT * FROM `$actual_table_name`";
            $sql_query = "UPDATE `ycias_customer` SET ";


            $cols = array();

            foreach ($data as $key => $value) {
                $cols[] = "`$key`= '$value'";
            }

            $sql_query .= implode(',', $cols);

            ///////////////////////////////////////////////////////////////
            $sql_query .= " WHERE `" . $whereKEY . "` = '" . $whereVAL . "'";
            
            try {
                $stmt = $this->db->prepare($sql_query);
                if ($stmt->execute()) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            } catch (Exception $exc) {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }


    ///////////////////////////////////////////////////////////////////////////


    public function delData($table_name, $whereKEY, $whereVAL) {
        if ($whereKEY && $whereVAL) {
            $actual_table_name = $this->crg->get('table_prefix') . $table_name;
            //DELETE FROM `ycs_wp`.`ycs_comments` WHERE `ycs_comments`.`comment_ID` = 2"

            $sql_query = "DELETE FROM `$actual_table_name`";
            $sql_query .= " WHERE `" . $whereKEY . "` = '" . $whereVAL . "'";

            try {
                $stmt = $this->db->prepare($sql_query);
                if ($stmt->execute()) {
                    return TRUE;
                } else {
                    return FALSE;
                }
            } catch (Exception $exc) {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

/////////////////////////////////////////////////////////////////////////////////



    public function selectAllData($table_name, $whereKEY = NULL, $whereVAL = NULL) {
        $actual_table_name = $this->crg->get('table_prefix') . $table_name;
        $sql_query = "SELECT * FROM `$actual_table_name`";

        if ($whereKEY && $whereVAL) {
            $sql_query .= " WHERE `" . $whereKEY . "` = '" . $whereVAL . "'";
        }


        try {
            $stmt = $this->db->prepare($sql_query);
            $stmt->execute();
            $Data_rows = $stmt->fetchAll(2);
        } catch (Exception $exc) {
            $Data_rows = FALSE;
        }
        return $Data_rows;
    }

////////////////////////////////////////////////////


     public function selectKeyVal($table_name, $key = 'ID', $val = 'Title', $whereKEY = NULL, $whereVAL = NULL) {
        $actual_table_name = $this->crg->get('table_prefix') . $table_name;
        
        $sql_query = "SELECT `$key`,`$val` FROM `$actual_table_name`";

        if ($whereKEY && $whereVAL) {
            $sql_query .= " WHERE `" . $whereKEY . "` = '" . $whereVAL . "'";
        }

        try {
            $stmt = $this->db->prepare($sql_query);
            $stmt->execute();
            $Data_rows = $stmt->fetchAll(12);
        } catch (Exception $exc) {
            $Data_rows = FALSE;
        }
        return $Data_rows;
    }


    ///////////////////////////////////

    public function selectOneColmn($table_name, $key = 'ID', $whereKEY = NULL, $whereVAL = NULL) {
        $actual_table_name = $this->crg->get('table_prefix') . $table_name;
        $sql_query = "SELECT `$key` FROM `$actual_table_name` ";

        if ($whereKEY && $whereVAL) {
            $sql_query .= " WHERE `" . $whereKEY . "` = '" . $whereVAL . "'";
        }

        try {
            $stmt = $this->db->prepare($sql_query);
            $stmt->execute();
            $Data_rows = $stmt->fetchAll(7);
        } catch (Exception $exc) {
            $Data_rows = FALSE;
        }
        return $Data_rows;
    }

////////////////////////////////////////////////////////////////////////////
/////////////////////////////////

    /*
     * @description : This generates unique key word of any length
     * 
     */
    public function __clkwd($key_length = 32, $padd = '') {
        $cc = str_pad($padd, $key_length, uniqid(rand(), true));
        return $cc;
    }

    public function keyGen($table_name, $pref = NULL, $sufix = NULL, $uniq_col) {
        /*
         * actual table name with prefix
         * Reason for prrefixing table
         * for securoty reason evey installation need to have different table name
         */
        $actual_table_name = $this->crg->get('table_prefix') . $table_name;
        $entityID = $this->ses->get('user')['entity_ID']; 
        
        //$sql_query = "SELECT MAX(CAST(MID(ID,4)+1 AS UNSIGNED)) FROM $actual_table_name WHERE entity_ID = $entityID";
        
        include_once('MyDateTime.php');

	$mydate = new MyDateTime();
	//$mydate->setDate(2018, 4, 01);
	$result = $mydate->fiscalYear();
	//$start = $result['start']->format('Y-m-d H:i:s');
	//$end = $result['end']->format('Y-m-d H:i:s');
	$fiscalyear = $result['start']->format('y');
	//$fiscalyear = $result['start']->format('M');
        //var_dump($fiscalmonth);
        $sql_query = "SELECT MAX($uniq_col) FROM $actual_table_name WHERE SUBSTRING($uniq_col,7) = (SELECT MAX(CAST(SUBSTRING($uniq_col,7) AS UNSIGNED)) FROM $actual_table_name WHERE entity_ID =$entityID AND $uniq_col LIKE '$fiscalyear%') AND entity_ID =$entityID";
  
        try {
            $stmt = $this->db->prepare($sql_query);
            $stmt->execute();
            $subject = $stmt->fetch(7); 
            
          
           
            $subject = substr($subject, 0,2); 
            
             
   
            if($subject === $fiscalyear && $subject && $subject !== ''){
            
            $max_no_sql = "SELECT MAX(CAST(MID($uniq_col,7)+1 AS UNSIGNED)) FROM $actual_table_name WHERE entity_ID = $entityID AND $uniq_col LIKE '$fiscalyear%'";
            $stmt = $this->db->prepare($max_no_sql);
            $stmt->execute();
            $max_no = $stmt->fetch(7);
            
                //var_dump($max_no);
          
            $unique_key = $fiscalyear. $pref . $max_no . $sufix;            
            
            }else{    
	            $unique_key = $fiscalyear. $pref . '1' . $sufix;     
            }
            
           return $unique_key;
        } catch (Exception $exc) {
            $unique_key = FALSE;
        }
    }

    //////////////////////////////////////////////////////
    
    public function keyGenerateee($table_name, $pref = NULL, $sufix = NULL, $uniq_col,$start) {
        /*
         * actual table name with prefix
         * Reason for prrefixing table
         * for securoty reason evey installation need to have different table name
         */
        $actual_table_name = $this->crg->get('table_prefix') . $table_name;
        $entityID = $this->ses->get('user')['entity_ID']; 
        
        //$sql_query = "SELECT MAX(CAST(MID(ID,4)+1 AS UNSIGNED)) FROM $actual_table_name WHERE entity_ID = $entityID";
        
        include_once('MyDateTime.php');

	$mydate = new MyDateTime();
	//$mydate->setDate(2018, 4, 01);
	$result = $mydate->fiscalYear();
	//$start = $result['start']->format('Y-m-d H:i:s');
	//$end = $result['end']->format('Y-m-d H:i:s');
	$fiscalyear = $result['start']->format('y');
	//$fiscalyear = $result['start']->format('M');
        //var_dump($fiscalmonth);
        $sql_query = "SELECT MAX($uniq_col) FROM $actual_table_name WHERE SUBSTRING($uniq_col,13) = (SELECT MAX(CAST(SUBSTRING($uniq_col,13) AS UNSIGNED)) FROM $actual_table_name WHERE entity_ID =$entityID AND $uniq_col LIKE '%$fiscalyear%') AND entity_ID =$entityID";
  
        try {
            $stmt = $this->db->prepare($sql_query);
            $stmt->execute();
            $subject = $stmt->fetch(7); 
            
         
           
            // $subject = substr($subject, 0,2); 
            
            
            $subject = substr($subject,9,2); 
            
            
             
   
            if($subject === $fiscalyear && $subject && $subject !== ''){
            
            $max_no_sql = "SELECT MAX(CAST(MID($uniq_col,13)+1 AS UNSIGNED)) FROM $actual_table_name WHERE entity_ID = $entityID AND $uniq_col LIKE '%$fiscalyear%'";
            $stmt = $this->db->prepare($max_no_sql);
            $stmt->execute();
            $max_no = $stmt->fetch(7);
            
                //var_dump($max_no);
          
           //already $unique_key = $fiscalyear.'/'. $pref .'/'. $max_no .'/'. $sufix;            
            
            // $unique_key = $start .'/'. $fiscalyear.'/'. $pref .'/'. $max_no .'/'. $sufix;  
            
            $unique_key = $start .'/'. $pref.'/'. $fiscalyear .'/'. $max_no ;            
            
            
            }else{    
	            //already $unique_key = $fiscalyear.'/'.  $pref .'/'.  '1' .'/'.  $sufix;   
	           //  $unique_key = $start .'/'. $fiscalyear.'/'. $pref .'/'. '1' .'/'. $sufix;    
	           $unique_key = $start .'/'. $pref.'/'. $fiscalyear .'/'. '1' ;            
            
            }
            
           return $unique_key;
        } catch (Exception $exc) {
            $unique_key = FALSE;
        }
    }
  
   //// for autogenerate 
   
   public function keyGenerate($table_name, $pref = NULL, $uniq_col,$start) {
        /*
         * actual table name with prefix
         * Reason for prrefixing table
         * for securoty reason evey installation need to have different table name
         */
        $actual_table_name = $this->crg->get('table_prefix') . $table_name;
        $entityID = $this->ses->get('user')['entity_ID']; 
        
        //$sql_query = "SELECT MAX(CAST(MID(ID,4)+1 AS UNSIGNED)) FROM $actual_table_name WHERE entity_ID = $entityID";
        
        include_once('MyDateTime.php');

	$mydate = new MyDateTime();
	
	
	//$mydate->setDate(2018, 4, 01);
	$result = $mydate->fiscalYear();

	//$start = $result['start']->format('Y-m-d H:i:s');
	//$end = $result['end']->format('Y-m-d H:i:s');
	$fiscalyear = $result['start']->format('y');
		
	//$fiscalyear = $result['start']->format('M');
        //var_dump($fiscalmonth);
        $sql_query = "SELECT MAX($uniq_col) FROM $actual_table_name WHERE SUBSTRING($uniq_col,14) = (SELECT MAX(CAST(SUBSTRING($uniq_col,14) AS UNSIGNED)) FROM $actual_table_name WHERE entity_ID =$entityID AND $uniq_col LIKE '%$fiscalyear%') AND entity_ID =$entityID";
  
        try {
            $stmt = $this->db->prepare($sql_query);
            $stmt->execute();
            $subject = $stmt->fetch(7); 
            
           
         
           
            // $subject = substr($subject, 0,2); 
            
            
            $subject = substr($subject,10,2); 
            
         // var_dump($subject);die;
          
   
            if($subject === $fiscalyear && $subject && $subject !== ''){
            
            $max_no_sql = "SELECT MAX(CAST(MID($uniq_col,14)+1 AS UNSIGNED)) FROM $actual_table_name WHERE entity_ID = $entityID AND $uniq_col LIKE '%$fiscalyear%'";
            $stmt = $this->db->prepare($max_no_sql);
            $stmt->execute();
            $max_no = $stmt->fetch(7);
            
                //var_dump($max_no);
          
           //already $unique_key = $fiscalyear.'/'. $pref .'/'. $max_no .'/'. $sufix;            
            
            // $unique_key = $start .'/'. $fiscalyear.'/'. $pref .'/'. $max_no .'/'. $sufix;  
            
            $unique_key = $start .'/'. $pref.'/'. $fiscalyear .'/'. $max_no ;            
            
            
            }else{    
	            //already $unique_key = $fiscalyear.'/'.  $pref .'/'.  '1' .'/'.  $sufix;   
	           //  $unique_key = $start .'/'. $fiscalyear.'/'. $pref .'/'. '1' .'/'. $sufix;    
	           $unique_key = $start .'/'. $pref.'/'. $fiscalyear .'/'. '1' ;            
            
            }
            
           return $unique_key;
        } catch (Exception $exc) {
            $unique_key = FALSE;
        }
    }
   

    /*
     * Data security
     * 
     */

    public function arrFltr($parr = array()) {
        if (is_array($parr)) {
            foreach ($parr as $psk => $psv) {
                $psr = $this->__mdsf($psk);

                if (is_array($psv)) {
                    foreach ($psv as $pk => $pv) {
                        if (trim($pv)) {
                            $padata[$psr][$this->__mdsf($pk)] = $this->__mdsf($pv);
                        }
                    }
                } else {
                    if (trim($psv)) {
                        $padata[$psr] = $this->__mdsf($psv);
                    }
                }
            }
            return $padata;
        } else {
            return false;
        }
    }

//////////////////////////////////

 public function keyGeneration($table_name, $pref = NULL, $sufix = NULL, $uniq_col) {
        /*
         * actual table name with prefix
         * Reason for prrefixing table
         * for securoty reason evey installation need to have different table name
         */
        $actual_table_name = $this->crg->get('table_prefix') . $table_name;
        $entityID = $this->ses->get('user')['entity_ID']; 
        
        $sql_query = "SELECT MAX($uniq_col) FROM $actual_table_name WHERE SUBSTRING($uniq_col,4) = (SELECT MAX(CAST(SUBSTRING($uniq_col,4) AS UNSIGNED)) FROM $actual_table_name WHERE entity_ID =$entityID AND $uniq_col LIKE '$pref%') AND entity_ID =$entityID";
  
        try {
            $stmt = $this->db->prepare($sql_query);
            $stmt->execute();
            $subject = $stmt->fetch(7); 
                  
            $subject = substr($subject, 0,3); 
   
            if($subject === $pref && $subject && $subject !== ''){
            
            $max_no_sql = "SELECT MAX(CAST(MID($uniq_col,4)+1 AS UNSIGNED)) FROM $actual_table_name WHERE entity_ID = $entityID AND $uniq_col LIKE '$pref%'";
            $stmt = $this->db->prepare($max_no_sql);
            $stmt->execute();
            $maxno = $stmt->fetch(7);
            
            $max_no=($maxno<=9)?'0'.$maxno:$maxno;

            $unique_key =  $pref . $max_no . $sufix;            
            
            }else{    
	            $unique_key =  $pref . '01' . $sufix;     
            }
            
            return $unique_key;
        } catch (Exception $exc) {
            $unique_key = FALSE;
        }
    }

    /**
     * @param <type> string
     * @return <type> string
     * @desc treat with html entities and trim only
     * @example good for all types of post data except data from text area
     */
    public function __mdsf($mds) {
        $dta = trim($mds);
        if ($dta) {
            $tzz = htmlentities($dta);
            return $tzz;
        } else {
            return false;
        }
    }

///////cls/////////////////    


 public function historyMaintenance($table_name, $whereKEY, $whereVAL, $entityID) {
        $actual_table_name = $this->crg->get('table_prefix') . $table_name;
        $entityID = $this->ses->get('user')['entity_ID']; 
        $where_cond = " WHERE `" . $whereKEY . "` = '" . $whereVAL . "' AND entity_ID = '$entityID'";

        try {
            $history_table = $actual_table_name.'_history';
            
            $sql_history_insert = 'INSERT INTO ' . $history_table . ' SELECT * FROM '.$actual_table_name.$where_cond;
            $stmt2 = $this->db->prepare($sql_history_insert);
            $stmt2->execute();
            
            $sql_delete = "DELETE FROM `$actual_table_name`";
            $sql_delete .= " WHERE `" . $whereKEY . "` = '" . $whereVAL . "' AND entity_ID = '$entityID'";
            $stmt = $this->db->prepare($sql_delete);
            $stmt->execute();
            
        } catch (Exception $exc) {
            $Data_rows = FALSE;
        }
        return $Data_rows;
    }

//////////////////////////////////////////////////////////////////

public function setPaginationList($sql,$page,$results_per_page,$whereString){
    
			if($whereString==null || $whereString==''){
			    
			$list_data = $this->getSqlData($sql, 3); 
            
			$list_count = count($list_data);
            
			$no_of_pages = ceil($list_count/$results_per_page);
					
			$this->tpl->set('no_of_pages', $no_of_pages);
			$this->tpl->set('current_page', $page);
			$this->tpl->set('results_per_page', $results_per_page);
					
			if(isset($page)){
			 $starting_limit_no = ($page-1)*$results_per_page;  
			} else {
			 $starting_limit_no = 0;
			} 
			
			if($list_count>=$results_per_page){
			  $sql.=" LIMIT $starting_limit_no,$results_per_page";
			}
			  $this->tpl->set('whereString', 'no');
			} 
			
			return $act_list_data = $this->getSqlData($sql, 3);
}

////////////////////////////////////////////////////////////////

public function dateFilterFormat($colNames){
     $y=$_POST[str_replace(' ','_',str_replace('.','_',$colNames))];
            if ('' != $y) {
              preg_match('#\((.*?)\,#', $colNames, $match);
              $colNames = $match[1];
            //   if(strpos($colNames, 'Date') !== false && strpos($colNames, 'Time') !== false ){
            //   $x = $this->__mdsf(date('Y-m-d H:i:s',strtotime($y)));
            //   }else{
               $x = $this->__mdsf(date('Y-m-d',strtotime($y)));    
             // }
              return array($colNames,$x);
            }
}

///////////////////////////////////////////////////////////////

public function concatFilterFormat($colNames, $colType=null){
                $y=$_POST[str_replace(' ','_',str_replace('.','_',$colNames))];
            if ('' != $y) {
               
                if (strpos($colNames, 'IF') == true) {
                     $arr = explode(" ",$y);
                preg_match('#\((.*?)\,#', $colNames, $firstif);
                preg_match('#\',(.*?)\)#', $colNames, $secondif);
                
                $first=$firstif[1];
                $second=$secondif[1];
                if(strpos($firstif, 'IF') == true){
                $first = end(explode(",",$firstif[1]));
                
                }else{
                $second = end(explode(",",$secondif[1]));   
                }
                
                if(count($arr)==1){
                   return $wsarr[] = "(". $first . " LIKE '%" . $arr[0] . "%' OR " . $second . " LIKE '%" . $arr[0] . "%')"; 
                }else if ('' != $arr[0] && $arr[1] != '') {
                 return $wsarr[] = $first . " LIKE '%" . $arr[0] . "%' AND " . $second . " LIKE '%" . $arr[1] . "%'";
                } 
              }else{
              //spc means special characters
                if($colType=='spc'){
                $arr = explode("-",$y);
                preg_match('#\((.*?)\,#', $colNames, $first);
                preg_match('#\',(.*?)\)#', $colNames, $second);
                }else if($colType=='space'){
                $arr = explode(" ",$y);
                preg_match('#\((.*?)\,#', $colNames, $first);
                preg_match('#\',(.*?)\)#', $colNames, $second);
                }else{
                    $arr = preg_split('/(?<=[a-z])(?=[0-9]+)/i',$y);
                    preg_match('#\((.*?)\,#', $colNames, $first);
                    preg_match('#\',(.*?)\)#', $colNames, $second);
                } 
            }      
                
          }    
          
          
                if(count($arr)==1){
                   return $wsarr[] = "(".$first[1] . " LIKE '%" . $arr[0] . "%' OR " . $second[1] . " LIKE '%" . $arr[0] . "%')"; 
                }else if ('' != $arr[0] && $arr[1] != '') {
                 return $wsarr[] = $first[1] . " LIKE '%" . $arr[0] . "%' AND " . $second[1] . " LIKE '%" . $arr[1] . "%'";
                } 
}

///////////////////////////////////////////////////////////////

}
