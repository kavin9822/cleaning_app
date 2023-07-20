<?php

class GenUtil {

    function __construct() {
        
    }

    /*
     * Return array contain  financial year range
     * 
     * @return array
     */

    public static function financialYear() {
        $fy = array();
        $month = date('m');
        $yr = date('Y');
        //2016-05-25
        if ($month < 4) {
            $y1 = date(($yr - 1) . '-04-01');
            $y2 = date($yr . '-03-31');
        } else {
            $y1 = date($yr . '-04-01');
            $y2 = date(($yr + 1) . '-03-31');
        }

        $fy[] = $y1;
        $fy[] = $y2;

        return $fy;
    }

///////////////////////////////////////////////


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

    /*
     * handle file upload
     */
 public function handle_file_upload_backup($params, $userID = NULL,$i) {
        
        
        try {
            if (!empty($_FILES)) {
              
                if (($_FILES[$params]['tmp_name'][$i])) {
                    
                   
                    $sourcePath = $_FILES[$params]['tmp_name'][$i];
                   
                   
                     $filename = $_FILES[$params]['name'][$i];
                      
                      $extension = end(explode(".", $filename));
                      
                     $folder="";
                      if($extension=="doc" ||$extension=="docx"||$extension=="xlsx"||$extension=="pdf"||$extension=="xls"){
                        $folder="documents"; 
                      }
                      else if($extension=="jpg" ||$extension=="jpeg"||$extension=="png"){
                          $folder="images"; 
                      }
                      else if($extension=="mp4"||$extension=="x-m4v"||$extension=="webm"){
                          
                          $folder="video"; 
                      }
                    
                     $targetPath = "./resource/$folder/" . $userID . '-' . date('y-m-d-H-i-s') . '-' . $_FILES[$params]['name'][$i];
                    
                     
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
    public function handle_file_upload($params, $userID = NULL) {
        try {
            if (!empty($_FILES)) {
                if (is_uploaded_file($_FILES[$params]['tmp_name'])) {
                    $sourcePath = $_FILES[$params]['tmp_name'];
                    $targetPath = "resource/images/" . $userID . '-' . date('y-m-d-H-i-s') . '-' . $_FILES[$params]['name'];
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

    public function getIndianCurrency($number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'one', 2 => 'two',
        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
        7 => 'seven', 8 => 'eight', 9 => 'nine',
        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
    $digits = array('', 'hundred','thousand','lakh', 'crore');
    if($digits_length >= 10){
        echo "Sorry this does not support more than 99 crores";
    }else {
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? '' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal) ? "and " . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' paise' : '';
    return ($Rupees ? ucFirst($Rupees) . 'rupees ' : '') . $paise;
    }
}

 public function custom_file_upload($params, $userID = NULL) {
        try {
            if (!empty($_FILES)) {
                if (is_uploaded_file($_FILES[$params]['tmp_name'])) {
                    
                    $filename = $_FILES[$params]['name'];
                    $extension = end(explode(".", $filename));
                    $folder="";
                    
                      if($extension=="doc" ||$extension=="docx"||$extension=="xlsx"||$extension=="pdf"||$extension=="xls"){
                        $folder="documents"; 
                      }else if($extension=="jpg" ||$extension=="jpeg"||$extension=="png"){
                        $folder="images"; 
                      }else if($extension=="mp4"||$extension=="x-m4v"||$extension=="webm"){
                        $folder="video"; 
                      }
                    
                    $sourcePath = $_FILES[$params]['tmp_name'];
                    $targetPath = "resource/$folder/" . $userID . '-' . date('y-m-d-H-i-s') . '-' . $_FILES[$params]['name'];
                    
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
    
 public function custom_file_upload_specific($params, $userID = NULL,$foldername) {
        try {
            if (!empty($_FILES)) {
                if (is_uploaded_file($_FILES[$params]['tmp_name'])) {
                    
                    $sourcePath = $_FILES[$params]['tmp_name'];
                    $targetPath = "resource/$foldername/" . $userID . '-' . date('y-m-d-H-i-s') . '-' . $_FILES[$params]['name'];
                    
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
    
public function multi_handle_file_upload_backup($params, $userID = NULL,$i,$foldername) {
        
        
        try {
            if (!empty($_FILES)) {
              
                if (($_FILES[$params]['tmp_name'][$i])) {
                    
                   
                    $sourcePath = $_FILES[$params]['tmp_name'][$i];
                   
                    $filename = $_FILES[$params]['name'][$i];
                     
                    
                     $targetPath = "./resource/$foldername/" . $userID . '-' . date('y-m-d-H-i-s') . '-' . $_FILES[$params]['name'][$i];
                    
                     
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
     * class close here
     */
}
