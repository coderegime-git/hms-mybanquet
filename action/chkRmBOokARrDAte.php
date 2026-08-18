<?php  

include("../config.php");

$arrival_date=$_GET['book_date'];
$adtDate= $_GET['adtDate'];


$fromDt=explode('/',$arrival_date);
$toExpl=explode('/',$adtDate);


$fromDtDte=$fromDt[2].'-'.$fromDt[1].'-'.$fromDt[0];
$todayDte=$toExpl[2].'-'.$toExpl[1].'-'.$toExpl[0];


$arDate = strtotime($fromDtDte);
$adtDte = strtotime($todayDte);


  if($arDate < $adtDte)
   {
     echo 1;
   } 
  
?>