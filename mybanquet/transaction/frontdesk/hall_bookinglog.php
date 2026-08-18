<?php
ob_start();
//session_start();
include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];
$source_code = $_REQUEST['source_code']
?>
<table id="example" class="table table-condensed table-hover table-striped table-bordered frmBgClr" cellpadding="0" cellspacing="0" border="1" class="table" style="margin:0 0 15px 0px;text-align:center;font-size:12px;">
   <thead>
	<tr class="info">
	
		<td colspan="16" style="text-align:center;"><h3 class="viewDT" id="Userhd"><b>View Hall booking</b></h3><b></b></td>
	</tr>
	<tr>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Sl.no</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Book date</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Booking no</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">venue</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Session</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Funct</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Guest_name</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Address</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">City</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Phone</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">PC Name</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">IP Address</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Status</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">User</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Date & time</th>
	</tr>
	   </thead>
	   <tbody>
	<?php 

	$sql=mysql_query("SELECT *  FROM bq_hallbooking WHERE 	booking_no = '$source_code'");
	$x=0;
	if(mysql_num_rows($sql)>0) {
	while($row=mysql_fetch_array($sql)) {
		$x++;
		if($row['log_status']==1){
			$status="Active";
		}else{
			$status="Deactive";
		}
				
	?>
	<tr>
		<td width="80" style="text-align:center;"><?php echo $x; ?></td>
		<td width="80" class="codesUPPERCase" style="text-align:left;"><?php echo $row['book_date']; ?></td>
		<td width="80" class="codesUPPERCase" style="text-align:left;"><?php echo $row['booking_no']; ?></td>
		<td width="80" class="codesUPPERCase" style="text-align:left;"><?php echo $row['venue']; ?></td>
		<td width="80" class="codesUPPERCase" style="text-align:left;"><?php echo $row['session']; ?></td>
		<td width="80" class="fstChUPPRCase" style="text-align:left;"><?php echo $row['funct']; ?></td>
		<td width="80" class="fstChUPPRCase" style="text-align:left;"><?php echo $row['guest_name']; ?></td>
		<td width="80" class="fstChUPPRCase" style="text-align:left;"><?php echo $row['address1']; ?></td>
		<td width="80" class="fstChUPPRCase " style="text-align:left;" ><?php echo $row['city']; ?></td>
		<td width="80" class="fstChUPPRCase " style="text-align:left;" ><?php echo $row['phone']; ?></td>
		<td width="80" class="fstChUPPRCase " style="text-align:left;" ><?php echo $row['systemname']; ?></td>
		<td width="80" class="fstChUPPRCase " style="text-align:left;" ><?php echo $row['systemip']; ?></td>
		<td width="80" class="fstChUPPRCase " style="text-align:left;" ><?php echo $status; ?></td>
		<td width="80" class="fstChUPPRCase " style="text-align:left;" ><?php echo $row['added_by']; ?></td>
		<td width="80" class="fstChUPPRCase " style="text-align:left;" ><?php echo $row['added_on']; ?></td>
	</tr>
	<?php } }  ?>	
	</tbody>
</table>