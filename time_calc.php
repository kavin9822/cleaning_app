<?php

$time1 = '00:18';
$time2 = '08:50';

//echo $tot_pro_hrs = $time2-$time1;



$a = new DateTime($time1);
$b = new DateTime($time2);
$interval = $a->diff($b);

echo $interval->format("%H:%i");

