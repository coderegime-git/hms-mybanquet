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

	$resultt=mysql_query($sqlE);
}  
			


}
?>
<link rel="stylesheet" href="<?php echo $home_path; ?>/css/dataTables.bootstrap.min.css">
<script type="text/javascript" src="<?php echo $home_path; ?>/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	
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
			r=confirm("Do you want to cancel Reserv Advance");
			if(r==true){
				rg=$('#regN').val();
				rmId=$('#chAdId').val();
				rt=$('#vucher').val();
			
				$('#act').val("approve");
				
		document.location.href="../../action/update-reSerVadv-refund.php?reg="+rg+'&rcpt='+rt+'&rmId='+rmId;
			
			}
			
		}
	
		return;
	});
	
	
});
					function setPrint(id,val,c,d)
						{	
						$('#chAdId').val(val);
						$('#regN').val(c);
						$('#vucher').val(d);
							if($("#"+id).is(":checked"))
							{  
								$('.ckPrint').each(function(){
									a_id=this.id.split('_');
									if($(this).attr('id') != id)
									{
										$(this).attr("disabled",true);
										$("#ed"+a_id[1]).attr("style","display:none");
									}
								});
							}
							else
							{
								$('.ckPrint').each(function(){
									a_id=this.id.split('_');
									$(this).removeAttr("disabled");
									$("#ed"+a_id[1]).attr("style","display:inline");
								});
							}
							
							if($('#st_'+val).val() == 1)
								{
									$("#approve").attr('style','display:none');
									$(".appV").hide();
								}else{
									$("#approve").attr('style','display:block;margin-left:70px;margin-top:-26px;'); 
									$(".appV").show();
									
								}
								
						}
						
						function popup()
						{
							id=$('.ckPrint:checkbox:checked').val();
							newwindow=window.open('<?php echo $home_path;?>/operations/vendorAllocationEmail.php?uid='+id,'mywin','left=220,width=500,height=500,');
							newwindow.focus();
						}
						function popupDC()
						{
							id=$('.ckPrint:checkbox:checked').val();
							newwindow=window.open('<?php echo $home_path;?>/operations/sendToVendorAPProve.php?uid='+id,'_blank');
							newwindow.focus(); 
						}
	
</script>
<style>
   label {width: 205px; padding:0 20px 0 20px; display: inline-block;font-weight: bold;color: #000;font-size:12px; } 
   
input[type=text], textarea{
 height:26px;
}
.table td {text-align:center;} 
check.png

.butExample {
    background-color: #ffffff;
    border: 1px solid #ddd;
    color: #000;
    font-family: arial,helvetica,sans-serif;
    font-size: 12px;
    margin-left: -3px;
    padding: 4px 66px;
}
.fa_pos{
	position:absolute;
	bottom:3px;
	right:8px;
	opacity:2.0;
    
}
.col-sm-6 {
    width: 48%;
}
.table-striped > tbody > tr:nth-child(even) >td 
		{
			background-color:#F9FAFA;
		}
		.table-striped > tbody > tr:nth-child(2n+1) >td
		{
			background-color:#e6e6ff;
		}
		.btns {
  background-color:#0073b5;
  border: none;
  color: white;
  padding: 4px 10px;
  font-size: 14px;
  cursor: pointer;
  
}

/* Darker background on mouse-over */
.btns:hover {
  background-color: RoyalBlue;
}
.well{
background-color:#FFFFFF;
}
</style>	
<script src="../../js/jquery.js"></script> 
<script type="text/javascript" src="../../js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../../js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		//alert ("test");
    $('#adave').DataTable();
} );
</script>
<link rel="stylesheet" href="<?php echo $home_path;?>/tinybox2/style.css" />
<script type="text/javascript" src="<?php echo $home_path;?>/tinybox2/tinybox.js"></script>

<form action="<?php echo $home_path;?>/action/update-roomadv-approve.php" method="post" id="thisform">

<input type="hidden" id="act" name="act" value="" />
<body class="bgBODY">
<div class="container-fluid">
<div class="well">
<div class="table-responsive help-block">
<table class="table table-striped table-success" id="adave" border="1px" style="text-align:center;font-size:12px;border-color:#ddd;">
<thead style="background-color:#FFFFFF;">
<tr class="info">
	
		<td colspan="13" style="text-align:center;"><h3 id="Userhd"><b>View Reservation Advance</b></h3><b></b></td>
	</tr>
		<tr>
		<th width="80" style="text-align:center;">Sl.no</th>
		<th width="80" style="text-align:center;">Receipt Date</th>
		<th width="80" style="text-align:center;">Receipt no</th>
		<th width="80" style="text-align:center;">Function Date</th>
		<th width="80" style="text-align:center;">Guest name</th>
		<th width="80" style="text-align:center;">Amount</th>
		<th width="80" style="text-align:center;">Pay mode</th>
		<th width="80" style="text-align:center;">Status</th>
		<th width="80" style="text-align:center;">Refund</th>
	</tr>
	</thead>
	<tbody>
<?php
$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$adtCurDt=$rowAC['cur_date'];
$ad=explode('/',$adtCurDt);
$adD=$ad[2].'-'.$ad[1].'-'.$ad[0];
	$date=Date('d/m/Y');
	$sql=mysql_query("select * from bq_hallresvadv where str_to_date(cur_date,'%d/%m/%Y') <= '$adD' AND status='1'");
	$x=0;
	if(mysql_num_rows($sql)>0) {
	while($row=mysql_fetch_array($sql)) {
		$x++;
		 if($row['status']==1){
			$status="Advance";
		}else{
			$status="Refund";
		} 
		//$sqb=mysql_fetch_array(mysql_query("select * from room_booking where resv_no='".$row['reserv_no']."'"));
		
?>
		
		
		<input type="hidden" name="regN" id="regN" class="ckPrint regN group1 check_" value=""  />
			<input type="hidden" name="chAdId" id="chAdId" class="ckPrint chAdId group1 check_" value=""  />
			<input name="vucher" type="hidden" id="vucher" class="ckPrint group1 vucher check_" value="" />
			
		<tr>
			<td width="80" style="text-align:center;"><?php echo $x; ?></td>
			
		<td width="80" style="text-align:center;"><?php echo $row['cur_date']; ?></td>
		<td width="80" class="codesUPPERCase" style="text-align:center;" ><?php echo $row['receipt_no']; ?></td>
		<td width="80" class="codesUPPERCase" style="text-align:center;" ><?php echo $row['function_date']; ?></td>
		<td width="80" class="fstChUPPRCase" style="text-align:center;"><?php echo $row['guest_name']; ?></td>
		<td width="80" class="fstChUPPRCase" style="text-align:center;"><?php echo $row['amount']; ?></td>
		<td width="80" class="fstChUPPRCase" style="text-align:center;"><?php echo $row['pay_mode']; ?></td>
		<td width="80" class="fstChUPPRCase" style="text-align:center;"><?php echo $status; ?></td>
		
		<td width="80"class="" style="text-align:center;"><a href="<?php echo $home_path ?>/transaction/frontdesk/reserv-refund-advance.php?roomBk=<?php echo $row['receipt_no']?>&rmBkID=<?php echo $row['booking_no']?>&rmAmt=<?php echo $row['amount'];?>" style="color:#000;font-size:13px;font-weight:bold;"><button type="button" id="pdf" style="margin:0 0 0 10px;" class="myButeXL btnn">Refund</button></a></td>
	
	<?php
		?>
		</tbody>
		 <?php   }   ?>
	</table>
<?php  }  ?>
	</form>
		</div>
		</div>
		</div>