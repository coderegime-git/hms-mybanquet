<?php
include('../../config.php');

	$output="";
	$output.='
	<table class="table" border="" style="text-align:center;border-left:1px solid #000;border-right:1px solid #000;border-top:1px solid #000;border-bottom:1px solid #000;">	
	<tr>
		<td colspan="10" style="text-align:center;font-size:22px;font-weight:bold;">OCCUPANCY DETAILS</td>
	</tr>
	<tr>
		<td colspan="10" style="text-align:right;font-size:18px;font-weight:bold;">Phone: 04368 - 220304,06</td>
	</tr>
	<tr>
		<td colspan="10" style="text-align:center;font-size:25px;font-weight:bold;" >HOTEL PARIS INTERNATIONAL, KARAIKAL</td>
	</tr>
	<table class="table" border="1" style="text-align:center;font-size:20px;">	
	<tr>
		<th width="30" style="text-align:center;background-color:#F5F5F5;">Sl.no</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Arrival Date</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Departure Date</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Room no</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Name</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Age</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Address</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Nationality</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Purpose of visit</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Signature</th>
	</tr>';	
	$amt=0;$amtT=0;
$sqlRm=mysql_query("select sum(amount) as advAmt from room_advance");
	$rowRm=mysql_fetch_array($sqlRm);
	$sqlRc=mysql_query("select sum(amount) as advAmtCsh from room_advance where pay_mode='cash'");
	$rowRc=mysql_fetch_array($sqlRc);
	$sqlCd=mysql_query("select sum(amount) as advAmtCrd from room_advance where pay_mode='card'");
	$rowCd=mysql_fetch_array($sqlCd);
	
	$x=0;
	
	$sql=mysql_query("select distinct gr.guestreg_id,gr.arrival_date,gr.departure_date,gr.room_no,gr.guest_name,gr.address1,gr.address2,gr.city,gr.pin_code,gr.nationality,gr.purpose_visit from guest_register gr,guest_trans gt where gr.room_no=gt.room_no AND gr.guestreg_id=gt.reg_num AND gt.bill_status='1'");
	if(mysql_num_rows($sql)>0) {
	while($row=mysql_fetch_array($sql)) {
		$x++;
		if(isset($row['address2']))
		{
			$address2=ucfirst($row['address2']).', ';
		}	
	$output.='<tr>
	<td style="text-align:center;">'. $x.'</td>
	<td style="text-align:center;">'. $row['arrival_date'].'</td>
	<td style="text-align:center;">'.$row['departure_date'].'</td>
	<td style="text-align:center;">'.$row['room_no'].'</td>
	<td>'.ucfirst($row['guest_name']).'</td>
	<td style="width:50px;"></td>
	<td style="text-align:left;">'.ucfirst($row['address1']).$address2.ucfirst($row['city']).', '.$row['pin_code'].'</td>
	<td style="text-align:center;">'.ucfirst($row['nationality']).'</td>
	<td style="text-align:center;">'.ucfirst($row['purpose_visit']).'</td>
	<td style="width:100px;">&nbsp;</td>
	
	</tr>';
		  } 
$output.='</table>';
$fileName = 'Occupany-Details'.date('d-M-Y-H-i-s').'.xls';
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$fileName");
echo $output;
}
?>