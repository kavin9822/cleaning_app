<?php

class httpCurl{


////////////////////////////////////////////////////////////////////////////


 function getUrlContent($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; .NET CLR 1.1.4322)');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($ch, CURLOPT_TIMEOUT, 5);
    $data = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    return ($httpcode >= 200 && $httpcode < 300) ? $data : false;
 }



 function smssigma($smsTo, $smsMessage){
	$username = 'spit';
	$password = 'HTOWJR';
	$senderid = 'SPITIN';
        $to = $smsTo;
 	$message = $smsMessage;
	
	//$routeId =12 for ECONOMIC ROUTE
        //$routeId =7 for OPT-IN TRANS ROUTE {AUTO}
	$routeId = 7;

	$x = 'http://smssigma.com/API/WebSMS/Http/v1.0a/index.php?';
	$x .= 'username=' . $username;
	$x .= '&password=' . $password;
	$x .= '&sender=' . $senderid;
	$x .= '&to=' . $to;
	$x .= '&message=' . $message;
	$x .= '&reqid=1&format={json|text}';
	$x .= '&route_id=' . $routeId;
	$x .= '&sendondate=' . date(DATE_ATOM);

	//make curl request
	$y = $this->getUrlContent($x);        
	
        //var_dump($x);
	// convert responce json to arr
	//$responce_arr = json_decode($y, true)// json conversion failed so we are using str match
   
	// As s:7:"dlr_seq";i:1 is the succes code
        
	$smsSend = strstr($y, 's:7:"dlr_seq";i:1') ? true : false; 



	//return true or false
	return ($smsSend) ? true : false ;
	
	
 }
/////class close here
}