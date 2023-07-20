<?php

include('util/MyDateTime.php');

$mydate = new MyDateTime();
$mydate->setDate(2018, 4, 01);
$result = $mydate->fiscalYear();
$start = $result['start']->format('Y-m-d H:i:s');
$fiscalyear = $result['start']->format('y');
$end = $result['end']->format('Y-m-d H:i:s');
$today = date('Y-m-d H:i:s');
$today = strtotime();
var_dump($fiscalyear);
var_dump($mydate);
var_dump($start);
var_dump($end);