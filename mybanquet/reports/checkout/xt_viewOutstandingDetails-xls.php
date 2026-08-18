<?php
include('../../config.php');

	$output="";
	$output.='
	<table class="table" border="" style="text-align:center;border-left:1px solid #000;border-right:1px solid #000;border-top:1px solid #000;border-bottom:1px solid #000;">	
	<tr>
		<td colspan="6" style="text-align:center;font-size:22px;font-weight:bold;">OUTSTANDING DETAILS</td>
	</tr>
	<tr>
		<td colspan="6" style="text-align:right;font-size:18px;font-weight:bold;">Cell: 98410 51645</td>
	</tr>
	<tr>
		<td colspan="6" style="text-align:center;font-size:25px;font-weight:bold;" >HI TECH TYRES</td>
	</tr>
	<table class="table" border="1" style="text-align:center;font-size:20px;">	
	<tr>
		<th width="30" style="text-align:center;background-color:#F5F5F5;">Sl.no</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Bill No</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Bill Date</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Vendor name</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Bill Amount</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Remarks</th>
	</tr>';	
	$amt=0;$amtT=0;

	$x=0;
	$sql=mysql_query("select * from ar_bills");	
	if(mysql_num_rows($sql)>0) {
	while($row=mysql_fetch_array($sql)) {
		$sqlS=mysql_query("select * from company_master where vendor_code='".$row['vendor_code']."'");
		$rowS=mysql_fetch_array($sqlS);
		$vendor_name=$rowS['vendor_name'];
		
		$x++;
		if(isset($row['remarks']) && ($row['remarks']!='Null'))
		{
			$remarks=ucfirst($row['remarks']).', ';
		}else{
			$remarks="";
		}	
	$output.='<tr>
	<td style="text-align:center;">'. $x.'</td>
	<td style="text-align:center;">'.ucfirst($row['bill_no']).'</td>
	<td style="text-align:center;">'.ucfirst($row['bill_date']).'</td>
	<td style="text-align:center;">'.ucfirst($vendor_name).'</td>
	<td style="text-align:center;">'.ucfirst($row['bill_amount']).'</td>
	<td style="text-align:center;">'.$remarks.'</td>
	
	
	</tr>';
		  } 
$output.='</table>';
$fileName = 'outstanding-Details'.date('d-M-Y-H-i-s').'.xls';
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$fileName");
echo $output;
}
?>