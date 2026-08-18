<?php  
session_start();
include("../config.php");	
$vendName=$_GET['vendName'];		
$sqll=mysql_query("select distinct rfq_no from vendor_po where vendor_name='$vendName'");
	$rfQ="";
	$rfQ.='<option value="">--Select--</option>';
	while($rowR=mysql_fetch_array($sqll)){
		 $rfQ.='<option value="'.$rowR['rfq_no'].'">'.$rowR['rfq_no'].'</option>';
	}
	
	echo $rfQ; 
	
	?>