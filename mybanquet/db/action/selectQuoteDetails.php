<?php  
ob_start();
session_start();
include("../config.php");
$rfq=$_GET['rfq'];


$sql="select * from quotation where rfq_no='$rfq'";
$result=mysql_query($sql);
if(mysql_num_rows($result)>0) {
	$row=mysql_fetch_array($result);
	$nsn_no=$row['nsn_no'];
	$part_no=$row['part_no'];
	$part_name=$row['part_name'];
	$rfq_no=$row['rfq_no'];
	$qty=$row['qty'];
	 $days_possible=$row['days_possible']; 
	/* $days_possible=5; */
	$quote_amt=$row['quote_amt'];
	$quote_number=$row['quote_number'];
	$inspec_place=$row['inspec_place'];
	$fob=$row['fob'];
	$unit_issue=$row['unit_issue'];



	$date = date('d-m-Y');
	$date = strtotime($date);
	$date = strtotime('+'.$days_possible.'days', $date);
	/* echo date('M d, Y', $date); */
	$dayPosble=date('d-m-Y', $date);
	/* echo "select * from partnumber where nsnnumber='$nsn_no'"; */
	$sqlN="select * from partnumber where nsnnumber='$nsn_no'";
	$resultN=mysql_query($sqlN);
	$rowN=mysql_fetch_array($resultN);
	$partnumber=$rowN['partnumber'];
	$partname=$rowN['partname'];


	echo $nsn_no.'@'.$partnumber.'@'.$partname.'@'.$rfq_no.'@'.$qty.'@'.$dayPosble.'@'.$quote_amt.'@'.$quote_number.'@'.$inspec_place.'@'.$fob.'@'.$unit_issue; 
}/* else{
	echo 1;
} */
?>