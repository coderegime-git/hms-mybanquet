<?php
include('../../config.php');

	$output="";
	$output.='
	<table class="table" border="1" style="text-align:center;">	
	<tr>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Sl.no</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Date</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Receipt no</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Room no</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Guest name</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Amount</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Cash</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Card</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Remarks</th>
	</tr>';	
	$amt=0;$amtT=0;
$sqlRm=mysql_query("select sum(amount) as advAmt from room_advance");
	$rowRm=mysql_fetch_array($sqlRm);
	$sqlRc=mysql_query("select sum(amount) as advAmtCsh from room_advance where pay_mode='cash'");
	$rowRc=mysql_fetch_array($sqlRc);
	$sqlCd=mysql_query("select sum(amount) as advAmtCrd from room_advance where pay_mode='card'");
	$rowCd=mysql_fetch_array($sqlCd);
	
		$x=0;
	if(isset($_GET['val'])){
		
	$item_where= " where cur_date like '%".$_GET['val']."%' OR receipt_no like '".$_GET['val']."' OR guest_name like '%".$_GET['val']."%' OR room_no='".$_GET['val']."'";
	/* echo "select * from room_advance $item_where"; */
	$sql=mysql_query("select * from room_advance $item_where");
	} else{
		$sql=mysql_query("select * from  room_advance");
	}
	if(mysql_num_rows($sql)>0) {
	while($row=mysql_fetch_array($sql)) {
		$x++;
		if($row['pay_mode']=='cash'){
			$amt=$row['amount'];
		}
		if($row['pay_mode']=='card') { 
			$amtT=$row['amount'];
		}
	
	$output.='<tr>
	<td>'. $x.'</td>
	<td>'. $row['cur_date'].'</td>
	<td>'.$row['receipt_no'].'</td>
	<td>'.$row['room_no'].'</td>
	<td>'.ucfirst($row['guest_name']).'</td>
	<td>'.$row['amount'].'</td>
	<td>'.$amt .'</td>
	<td>'.$amtT.'</td>
	<td>'.$row['remarks'].'</td>
	
	</tr>';
		  } 
$output.='</table>';
$fileName = 'Room-Advance'.date('d-M-Y-H-i-s').'.xls';
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$fileName");
echo $output;
}
?>