<?php  
session_start();
include("../config.php");

$rfqNO=$_GET['rfqNO'];

/* echo "select * from customer_po where rfq_no='$rfqNO'"; */
/* $partNMe.='<select style="height:100px;scroll:auto" name="clin_dest[]" id="clin_dest" style="font-size:14px;" multiple onClick="selClinDest();">'; */

$sql=mysql_query("select * from customer_po where rfq_no='$rfqNO'");
$row=mysql_fetch_array($sql);



/*$partNMe.="<option value=''>--Select--</option>";
 if(mysql_num_rows($sql)>0) {
	while($row=mysql_fetch_array($sql)) {
		$partNMe.='<option value="'.$row['clin_dest'].'">'.$row['clin_dest'].'</option>'; 
		$part_name=$row['part_name'];
		$order_value=$row['order_value'];
		$nsn_no=$row['nsn_no'];
	}
} */
echo $row['clin_dest'].'@'.$row['clin_qty'].'@'.$row['order_value'].'@'.$row['total_qty'];  
?>