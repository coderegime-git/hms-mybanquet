<?php
ob_start();

include("../config.php");

$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];
$date=date('Y-m-d');
$dateYr=date('d/m/Y');

$bookNo=$_GET['bookNo'];
$bookId=$_GET['bookId'];

$output="";
$output.='
<tr class="dispSHw" style="">
		<td colspan="6" style="text-align:center;font-size:11px;color:#fff;font-weight:bold;background-color:#124680;">ADVANCE DETAILS</td>
	</tr>
<tr style="background-color:#8494a3;">
		<th width="80" style="text-align:center;color:#fff;">SI.No</th>
		<th width="80" style="text-align:center;color:#fff;">Adv Date</th>
		<th width="80" style="text-align:center;color:#fff;">Booking No</th>
		<th width="80" style="text-align:center;color:#fff;">Receipt No</th>
		<th width="80" style="text-align:center;color:#fff;">Guest name</th>
		<th width="80" style="text-align:center;color:#fff;">Amount</th>
		
	</tr>';
$sql=mysql_query("select * from  bq_hallresvadv where booking_no='$bookNo' AND hallbook_id='$bookId' and amount > 0 and status=1");
$x=0;
while($row=mysql_fetch_array($sql)){
	$x++;

$output.='<tr>
		<td  style="text-align:center;">'. $x.'</td>
		<td  style="text-align:center;">'.$row['cur_date'].'</td>
		<td  style="text-align:center;">'.$row['booking_no'].'</td>
		<td  style="text-align:center;">'. $row['receipt_no'].'</td>
		<td  style="text-align:center;">'.strtoupper($row['guest_name']).'</td>
		<td  style="text-align:right;">'.$row['amount'].'</td>
</tr>';
}
$sql1=mysql_fetch_array(mysql_query("select sum(amount)as amt from  bq_hallresvadv where booking_no='$bookNo' AND hallbook_id='$bookId' and amount > 0 and status=1"));

$output.='<tr>
		<td  style="text-align:center;"></td>
		<td  style="text-align:center;"></td>
		<td  style="text-align:center;"></td>
		<td  style="text-align:center;"></td>
		<td  style="text-align:center;font-weight:bold;">TOTAL</td>
		<td  style="text-align:right;font-weight:bold;">'.$sql1['amt'].'</td>
</tr>';

echo $output;
?>