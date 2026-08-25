<?php
error_reporting(0);
ob_start();
include("../../config.php");
include("../../header.php");

$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$adtCurDt=trim($rowAC['cur_date']);
?>
<link rel="stylesheet" href="<?php echo $home_path;?>/date-picker/jquery-ui.css">
<script src="<?php echo $home_path;?>/date-picker/jquery-ui.js"></script>
<script src="../../js/sweetalert.min.js"></script>

<script>
jQuery(document).ready(function(){
	$(".datepicker").datepicker({
		changeMonth:true,
		changeYear:true,
		yearRange:"-100:+0",
		dateFormat:"dd/mm/yy"
	});

	$(".datepicker1").datepicker({
		changeMonth:true,
		changeYear:true,
		yearRange:"-100:+0",
		dateFormat:"dd/mm/yy"
	});
	
	$("#msgFo").fadeOut(5000);
});

shortcut.add("Ctrl+A",function() { 
	window.location.href = "amendments.php";
}); 

function clkSubmit() {
	fromdate=$('#from_date').val();
	todate=$('#to_date').val();
	srtx=$('#searchTxt').val();
	document.location="view-amendments.php?fromdate="+fromdate+"&todate="+todate+"&val="+srtx;
}

function srcSub(){
	$('#from_date').val('');
	$('#to_date').val('');
	$('#searchTxt').val('');
}

function printPage(){
	$('.ckPrint').hide().delay(3000).show(0);
	$('.Ckk').hide().delay(3000).show(0);	
	$('.dispSHw').show().delay(1000).hide(0);					
	var divContents = $("#dvContainer").html();
	var printWindow = window.open('', '', 'height=400,width=800');
	printWindow.document.write('<html><head><title>Amendments Details</title>');
	printWindow.document.write('</head><body>');
	printWindow.document.write(divContents);
	printWindow.document.write('</body></html>');
	printWindow.document.close();
	printWindow.print(); 
}
</script>

<style>
label {width: 205px; padding:0 20px 0 20px; display: inline-block;font-weight: bold;color: #000;font-size:12px; } 
input[type=text], textarea{
 height:26px;
}
.table td {text-align:center;} 
.butExample {
    padding: 4px 9px;
}
</style>	

<body class="bgBODY">

<div style="margin:10px 0 0 0;">
<table>
<tr>
<td><label style="width:80px;"><b>From :</b></label></td>
<td>
	<input name="from_date" style="width:100px;margin-bottom:0px;text-align:center;" type="text" class="textbox datepicker" id="from_date" value="<?php if(isset($_GET['fromdate'])){ echo $_GET['fromdate'];}else{ echo $adtCurDt; }?>" placeholder="From Date"/>
</td>
<td><label style="width:70px;"><b>To :</b></label></td>
<td>
	<input name="to_date" style="width:100px;margin:0px 10px 0 0;text-align:center;" type="text" class="textbox datepicker1" id="to_date" value="<?php if(isset($_GET['todate'])){ echo $_GET['todate'];}else{ echo $adtCurDt; }?>" placeholder="To Date"/>
</td>
<td style="width:400px;">
	<input type="text" id="searchTxt" name="searchTxt" placeholder="Amend No / FP No / Booking No / Guest" style="margin-left: 20px;width:250px;border-radius: 10px;-moz-border-radius: 10px;-webkit-border-radius:10px;border:1px solid #0B4F8C;height:32px;" value="<?php if(isset($_GET['val'])) {echo $_GET['val'];}else{echo '';}?>" onclick="srcSub();" />
	<input name="submt" style="margin:0 0 0 10px;" type="button" id="submt" class="btnH" value="Display" onClick="clkSubmit()" />
</td>
<td>
	<input type="button" value="Print" class="myButsprn" onclick="printPage();" style="margin:0 10px 0 10px;font-weight: bold;padding: 5px;">
</td>
<td>
	<a href="amendments.php"><button type="button" id="add" class="button_example bnkSbt" style="margin:4px 0 -8px 0px;"><img src="../../images/add-contact-iconn.png" class="sbtBtnImg"/>&nbsp;&nbsp;<span class="btnUndLine">A</span>dd Amendment</button></a>
</td>
</tr>
</table>
</div>

<?php if(isset($_GET['msg'])){ ?>
<p style="text-align:center;">
	<label id="msgFo" class="msgNotify"><?php echo $_GET['msg']; ?></label>
</p>
<?php } ?>

<div id="dvContainer">
<table cellpadding="0" cellspacing="0" border="1" class="table table-striped table-bordered frmBgClr" style="margin:10px 0 15px 0px;text-align:center;font-size:12px;width:100%;">
	<tr class="info">
		<td colspan="15" style="text-align:center;"><h3 class="viewDTT"><b>View Amendments Details</b></h3></td>
	</tr>
	<tr>
		<th width="40" style="text-align:center;background-color:#0073B5;color:#fff;">Sl.no</th>
		<th width="80" style="text-align:center;background-color:#0073B5;color:#fff;">Amend#</th>
		<th width="80" style="text-align:center;background-color:#0073B5;color:#fff;">FP#</th>
		<th width="80" style="text-align:center;background-color:#0073B5;color:#fff;">Booking#</th>
		<th width="140" style="text-align:center;background-color:#0073B5;color:#fff;">Guest Name</th>
		<th width="90" style="text-align:center;background-color:#0073B5;color:#fff;">Func Date</th>
		<th width="100" style="text-align:center;background-color:#0073B5;color:#fff;">Venue</th>
		<th width="100" style="text-align:center;background-color:#0073B5;color:#fff;">Session</th>
		<th width="60" style="text-align:center;background-color:#0073B5;color:#fff;">Exp Pax</th>
		<th width="60" style="text-align:center;background-color:#0073B5;color:#fff;">Grn Pax</th>
		<th width="90" style="text-align:center;background-color:#0073B5;color:#fff;">Amended Venue</th>
		<th width="90" style="text-align:center;background-color:#0073B5;color:#fff;">Amended Session</th>
		<th width="60" style="text-align:center;background-color:#0073B5;color:#fff;">Print</th>
		<th width="90" style="text-align:center;background-color:#0073B5;color:#fff;">Amended By</th>
	</tr>
	<?php 
	$where = " where 1=1 ";
	if(isset($_GET['fromdate']) && $_GET['fromdate']!='' && isset($_GET['todate']) && $_GET['todate']!='') {
		$fr=explode('/',$_GET['fromdate']);
		$frm=$fr[2].'-'.$fr[1].'-'.$fr[0];
		$to=explode('/',$_GET['todate']);
		$tod=$to[2].'-'.$to[1].'-'.$to[0];
		$where .= " AND str_to_date(func_date,'%d/%m/%Y') >= '$frm' AND str_to_date(func_date,'%d/%m/%Y') <= '$tod' ";
	}
	if(isset($_GET['val']) && $_GET['val']!='') {
		$v = mysql_real_escape_string($_GET['val']);
		$where .= " AND (amendno like '%$v%' OR fp_no like '%$v%' OR booking_no like '%$v%' OR guest_name like '%$v%') ";
	}
	
	$sql = mysql_query("select * from bq_amendments $where order by amend_id DESC");
	$x = 0;
	if($sql && mysql_num_rows($sql) > 0) {
		while($row = mysql_fetch_array($sql)) {
			$x++;
	?>
	<tr>
		<td><?php echo $x; ?></td>
		<td class="codesUPPERCase"><b><?php echo $row['amendno']; ?></b></td>
		<td class="codesUPPERCase"><?php echo $row['fp_no']; ?></td>
		<td class="codesUPPERCase"><?php echo $row['booking_no']; ?></td>
		<td style="text-align:left;" class="codesUPPERCase"><?php echo $row['guest_name']; ?></td>
		<td><?php echo $row['func_date']; ?></td>
		<td class="codesUPPERCase"><?php echo $row['venue']; ?></td>
		<td class="codesUPPERCase"><?php echo $row['session']; ?></td>
		<td><?php echo $row['amd_expx'] ? $row['amd_expx'] : $row['exppax']; ?></td>
		<td><?php echo $row['amd_grpx'] ? $row['amd_grpx'] : $row['grntpax']; ?></td>
		<td class="codesUPPERCase"><?php echo $row['amd_ven'] ? $row['amd_ven'] : '-'; ?></td>
		<td class="codesUPPERCase"><?php echo $row['amd_sess'] ? $row['amd_sess'] : '-'; ?></td>
		<td>
			<a href="../view/print-fp-creation.php?fpNum=<?php echo $row['fp_no']; ?>&amend=<?php echo $row['amendno']; ?>" target="_blank"><input type="button" class="btnH" value="Print"/></a>
		</td>
		<td class="codesUPPERCase"><?php echo $row['amend_by']; ?></td>
	</tr>
	<?php } } else { ?>
	<tr>
		<td colspan="14">
			<div style="margin: 21px 0 26px 10px;width:95%;" class="alert alert-success">
				No Amendments found...
			</div>
		</td>
	</tr>
	<?php } ?>
</table>
</div>

<?php include("../../footer.php"); ?>
</body>
</html>
