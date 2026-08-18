<?php  
session_start();
include("../config.php");

$rfQNo=$_GET['rfQNo'];
	
$partNMe="";
$partNMe.='<select name="dest_code" id="clin_dest" style="font-size:14px;" onChange="selLblCLindest();">';
$partNMe.='<option value="">--Select--</option>';

/* echo "select * from customer_po where rfq_no='$rfQNo'";  */	
$sqlRF=mysql_query("select * from customer_po where rfq_no='$rfQNo'");
while($rowRF=mysql_fetch_array($sqlRF)) {
	$partNMe.='<option value="'.$rowRF['clin_dest'].'">'.$rowRF['clin_dest'].'</option>';
$nsn_no=$rowRF['nsn_no'];	
$customerpo_no=$rowRF['customerpo_no'];
$part_no=$rowRF['part_no'];
$part_name=$rowRF['part_name'];
}
	

	
  echo $partNMe.','.$nsn_no.','.$customerpo_no.','.$part_no.','.$part_name; 
?>








