<?php
include('../../config.php');

	$output="";
	$output.='
	<table class="table" border="" style="text-align:center;border-left:1px solid #000;border-right:1px solid #000;border-top:1px solid #000;border-bottom:1px solid #000;">	
	<tr>
		<td colspan="11" style="text-align:center;font-size:22px;font-weight:bold;">POLICE REPORT</td>
	</tr>
	<tr>
		<td colspan="11" style="text-align:right;font-size:18px;font-weight:bold;">Phone: 04368 - 220304,06</td>
	</tr>
	<tr>
		<td colspan="11" style="text-align:center;font-size:25px;font-weight:bold;" >HOTEL PARIS INTERNATIONAL, KARAIKAL</td>
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
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Phone</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Nationality</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Purpose of visit</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Signature</th>
	</tr>';	
	$x=0;
	$toDate=date('d/m/Y');
	$sql=mysql_query("select distinct gr.guestreg_id,gr.arrival_date,gr.departure_date,gr.room_no,gr.guest_name,gr.address1,gr.address2,gr.city,gr.pin_code,gr.nationality,gr.purpose_visit,gr.phone,gt.reg_num from guest_register gr,guest_trans gt where arrival_date='".$toDate."' AND gr.guestreg_id=gt.reg_num");
	
	/* $sql=mysql_query("select distinct guestreg_id,arrival_date,departure_date,room_no,guest_name,address1,address2,city,pin_code,nationality,purpose_visit,phone from guest_register where arrival_date='".$toDate."'"); */
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
	<td style="text-align:center;">'.ucfirst($row['phone']).'</td>
	<td style="text-align:center;">'.ucfirst($row['nationality']).'</td>
	<td style="text-align:center;">'.ucfirst($row['purpose_visit']).'</td>
	<td style="text-align:center;"></td>
	</tr>';
		  } 
$output.='</table>';
$fileName = 'Police-report'.date('d-M-Y-H-i-s').'.xls';
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$fileName");
echo $output;
}
?>