<?php


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

//Package listing API

//string(108) "Status:Failed#Remarks:There are no packages available. 
//Please allow some packages to view on Captive Portal." 


//http://103.207.4.2/main.php

//admin user
//Home >>Policy Management >> Package
//                              >> Manage package >> edit package 
                                                        //View Package On Captive Portal >>yes/no


$x = "http://103.207.4.2/sg_api/custom_responce.php?order_type=4&requester=103.50.162.27&authkey=yscpsauth";
$y = getUrlContent($x);
var_dump($y);
$p = explode(':', $y);

$pac = explode('@', $p[2]);
$pacData = array();
foreach ($pac as $pvalue) {
    $pacDetArr = explode('|', $pvalue);
    
    $pacData[end($pacDetArr)] = $pacDetArr[0]; 
}
var_dump($pacData);
