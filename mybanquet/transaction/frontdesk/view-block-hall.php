<?php
ob_start();
include("../../config.php");
include("../../header.php");

if(isset($_POST['act'])){
	
 foreach($_POST['chk'] as $chk){ 
	$sql="update room_advance set bill_status='2' where roomadv_id=".$chk;
	mysql_query($sql);
	$message="Room Advance Cancelled";
	
	
	$sqlE="update guest_trans set";
	$sqlE=$sqlE."bill_status='3',";
	$sqlE=$sqlE." where reg_num='".$_GET['reg']."' AND receipt_no='".$_GET['rcpt']."'";
/* 	echo $sqlE;
	die(); */
	$resultt=mysql_query($sqlE);
}  
			

	/* if($_POST['act']=='cancel'){
		foreach($_POST['chk'] as $chk){
			$sql="update vendor_allocation set status='Cancelled' where vendorallot_id=".$chk;
			mysql_query($sql);
			$message="Vendor Cancelled";
		}
	} */
}
?>

<script type="text/javascript" src="<?php echo $home_path; ?>/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#msgFo").fadeOut(5000);
	$("[rel=tooltip]").tooltip();
	$("[rel=popover]").popover({trigger:'hover',html:true});
				  
$(':checkbox').click(function(e){
	if($("input:checked").length>0){
	   $('#print').show();
	   $('#email').show();
	   $('#approve').show();
	}else{
	   $('#print').hide();
	   $('#email').hide();
	   $('#approve').hide();
	   $('#cancelApprove').hide();
	 }
   
});			  

	$('.btnn').click(function (e) {
		if($(this).attr('id')=="approve"){
			if($("input:checked").length>1){ alert("Please select only one row"); return }
			r=confirm("Do you want to cancel charge.");
			if(r==true){
				regN=$('.regN').val();
				chid=$('.chAdId').val();
				vucher=$('.vucher').val();
				
				$('#act').val("approve");
				/* $('#thisform').attr('action','../../action/update-roomadv-approve.php'); */
		document.location.href="../../action/release-blockroom.php?reg="+regN+'&chid='+chid+'&vucher='+vucher;
				 /* $('#thisform').submit(); */
			}
			
		}
		return;
	});
	
});

shortcut.add("Ctrl+A",function() { 
	window.location.href = "block_halls.php";
}); 
</script>

<link rel="stylesheet" href="<?php echo $home_path;?>/tinybox2/style.css" />
<script type="text/javascript" src="<?php echo $home_path;?>/tinybox2/tinybox.js"></script>

<form action="<?php echo $home_path;?>/action/update-allowance-cancel.php" method="post" id="thisform">

<input type="hidden" id="act" name="act" value="" />
<body class="bgBODY">
<?php if(isset($_GET['msg'])){ ?>
	<p style="text-align:center;">
		<label id="msgFo" class="msgNotify"><?php echo $_GET['msg']; ?></label>
	</p>
<?php } ?>
	<div style="margin:10px 0 10px 0;float:right;">
		<a href="block_halls.php"><button type="button" id="add" class="button_example bnkSbt" style="margin:4px 0 -8px 0px;"><img src="../../images/add-contact-iconn.png" class="sbtBtnImg"/>&nbsp;&nbsp;<span class="btnUndLine">A</span>dd Block Halls</button></a>
	</div>
<div class="about">
	<div class="container" style="width:1000px;/* margin:0; */padding:0;">
	
	<div style="height:33px;margin:0 0 0 22px;" id="toolbar">
    <div class="btn-group">
                          						
	<!--<button type="button" id="print" style="display:none" class="submitbtnprint btnn" onclick="popup()">Print</button>				  
	<button type="button" id="email" style="color:#000;display:none" class="btnn submitbtnedit" onclick="popup()" >Email </button> -->
	<a id="approve" style="display:none;" class="btnn"><button type="button" id="approve" style="color:#000;" class="submitbtnedit appV">Release Room</button></a>
	<!--<a id="cancelApprove" style="display:none;" class="btnn"><button type="button" id="cancelApprove" style="color:#000;" class="submitbtnedit btnn canappV">Cancel Approve</button></a>-->

<!--<a id="approve" style="display:none;" class="btnn"><input type="button" class="submitbtnedit" id="approveE" value="Approve" style="margin-top:-29px;"/></a>-->
	<!--<button type="button" id="approve" style="color:#000;display:none" class="btnn submitbtnedit" onclick="popupDC()" >Approve </button>-->
<div>
	<input value="<?php echo $_POST['keyword']?>" name="keyword" type="text" class="input-medium search-query" style="float:left;margin-left:635px;margin-top:-21px;display:none"/>
	<button style="margin-top: -4.1%;height: 21px;font-size: 12px;padding-top: 1px;float: left;display:none" class="btnn">Go</button>
</div>
</div>
</div>
					
					
		<div class="col-md-12" style="overflow:auto;width:1000px;height:450px;" >
		
		
<table class="table table-condensed table-hover table-striped table-bordered" cellpadding="0" cellspacing="0" border="0" class="table" style="margin:0 0 15px -5px;text-align:center;font-size:12px;">
<tr class="info">
	
		<td colspan="13" style="text-align:center;"><h3 id="Userhd"><b>View Block Room</b></h3><b></b></td>
	</tr>
		<tr>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Sl.no</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Blocked Date</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Venue</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Session</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">From Time</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">To Time</th>
		<!--<th width="80" style="text-align:center;background-color:#F5F5F5;">Remarks</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Status</th>-->
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Release</th>
	</tr>
                     
		<?php
$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$adtCurDt=$rowAC['cur_date'];

	$date=Date('d/m/Y');
	$sql=mysql_query("select * from bq_hallbooking where confirm_status='6'");
	$x=0;
	if(mysql_num_rows($sql)>0) {
	while($row=mysql_fetch_array($sql)) {
		$x++;
		 // if($row['status']==0){
			// $status="Active";
		// }else{
			// $status="Deactive";
		// } 
?>
		<tbody style="">
		<tr>
			<input type="hidden" name="hallbook_id" id="hallbook_id" class="textbox" value="<?php echo $row['hallbook_id'];?>"/>
			<td width="80" style="text-align:center;"><?php echo $x; ?></td>
			<input type="hidden" name="booking_no" id="booking_no" class="ckPrint regN group1 check_" value="<?php echo $row['booking_no']?>"  />
			</td>
		<td width="80" class="fstChUPPRCase" style="text-align:center;"><?php echo $row['book_date']; ?></td>
		<td width="80" class="fstChUPPRCase" style="text-align:center;"><?php echo $row['venue']; ?>
		<td width="80" class="fstChUPPRCase" style="text-align:center;"><?php echo $row['session']; ?></td>
		<td width="80" class="fstChUPPRCase" style="text-align:center;"><?php echo $row['from_time']; ?></td>
		<td width="80" class="fstChUPPRCase" style="text-align:center;"><?php echo $row['to_time']; ?></td>
		<!--<td width="80" class="fstChUPPRCase" style="text-align:center;"><?php echo $row['remarks']; ?></td>
		<td width="80" class="fstChUPPRCase" style="text-align:center;"><?php echo $status; ?></td>-->
		<td width="80" class="fstChUPPRCase" style="text-align:center;"><a href="<?php echo $home_path;?>/action/release-blockhalls.php?hallbook_id=<?php echo $row['hallbook_id'];?>&venue=<?php echo $row['venue'];?>&session=<?php echo $row['session'];?>&book_date=<?php echo $row['book_date'];?>"><input type="button" name="release" id="release" value="Release"/></a></td>
		</tbody> 
		 <?php   }   ?>
	</table>
<?php  } else { ?>

		  <div style="margin:10px 0 10px 0" class="alert alert-success">
			   You have not created any Block Halls Details...
		 </div>

		<?php  }  ?>

	</form>

	</div>
		</div>
		</div>
		<?php include("../../footer.php"); ?>