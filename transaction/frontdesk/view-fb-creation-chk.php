<?php
error_reporting(0);
ob_start();
include("../../config.php");
include("../../header.php");
?>

<link href="<?php echo $home_path; ?>/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo $home_path;?>/date-picker/jquery-ui.css">
<link rel="stylesheet" href="<?php echo $home_path; ?>/css/dataTables.bootstrap.min.css">
<script src="../../js/jquery.js"></script> 
<script type="text/javascript" src="../../js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="../../js/dataTables.bootstrap.min.js"></script>
<script src="<?php echo $home_path;?>/date-picker/jquery-ui.js"></script>
<script src="../../js/sweetalert.min.js"></script>
<script>
	jQuery(document).ready(function(){
		$('#adave').DataTable({
		 "scrollY": 350,
	/* "scrollX": true,  */
	"paging":   false,
		 
	 });
	$(".datepicker" ).datepicker({
	changeMonth:true,
	changeYear:true,
	yearRange:"-100:+0",
	/* minDate: 0, */
	dateFormat:"dd/mm/yy"
	});

	$(".datepicker1" ).datepicker({
	changeMonth:true,
	changeYear:true,
	yearRange:"-100:+0",
	/* minDate: 0, */
	dateFormat:"dd/mm/yy"
	});
	
		 $("#msgFo").fadeOut(5000);
		$('#searchBtn').click(function(){
		item="?val="+$('#searchTxt').val();
		document.location.href="view-reservroom-booking.php"+item;
	}); 
	
	jQuery("#roommaster").validationEngine();
	});
	
function clkSubmit() {
// fromdate=$('#from_date').val();
// todate=$('#to_date').val();
srtx=$('#searchTxt').val();
/* if(fromdate!="" && todate!="")
{ */
// document.location="view-fb-creation.php?fromdate="+fromdate+"&todate="+todate+"&val="+srtx;
document.location="view-fb-creation-chk.php?val="+srtx;
/* } */

}

function srcSub(){
	$('#from_date').val('');
	$('#to_date').val('');
	$('#searchTxt').val('');
}
 </script>
 
<style>

   
input[type=text], textarea{
 height:26px;
}
.table td {text-align:center;} 



</style>	

<body class="bgBODY">
<?php 	
/* echo $_GET['msg']; */ 
if(isset($_GET['msg'])){
?>
<script>
$(document).ready(function(){
	//alert('hi');
fpNum=$('#fpNum').val();
msg=$('#msg').val();
swal({
            title: "Do You  Want To Print FP?",
            text: "FP NO: <?php echo $_GET['fpNum']; ?>",
            icon: "warning",
           buttons:{
				 cancel: "No",
                 confirm: "Yes",
			},
        })
        .then(function (isOkay) {
            if (isOkay) {
                // form.submit();
			window.open('../view/print-fp-creation.php?fpNum='+fpNum+'');
            }
        });
        return false;
});

</script>
<?php } 
if(isset($_GET['cmsg'])){
?>
<script>
$(document).ready(function(){
	//alert('hi');
fpNum=$('#fpNum').val();
swal({
            title: "FP: <?php echo $_GET['fpNum']; ?> Cancelled",
            icon: "warning",
           buttons:{
                 confirm: "OK",
			},
        })
        return false;
});

</script>
<?php } ?>
<input id="fpNum" value="<?php  echo $_GET['fpNum'];?>" hidden > 
<input id="msg" value="<?php  echo $_GET['msg'];?>" hidden > 


<div style="margin:10px 0 0 0;">
<table style="">
<tr>
<!--<td><label style="width:80px;"><b>From :</b></label></td>
<td>
	<input name="from_date" style="width:100px;margin-bottom:0px;text-align:center;" type="text" class="textbox datepicker" id="from_date"   value="<?php if(isset($_GET['fromdate'])){ echo $_GET['fromdate'];}?>" onChange="showsales()" placeholder="From Date"/>
</td>
<td><label style="width:70px;"><b>To :</b></label></td>
<td>
	<input name="to_date" style="width:100px;margin:0px 10px 0 0;text-align:center;" type="text" class="textbox datepicker1" id="to_date"  value="<?php if(isset($_GET['todate'])){ echo $_GET['todate'];}?>" onChange="showsales()" placeholder="To Date"/>
</td>-->
<td style="width:534px;">
	<input type="text" id="searchTxt" name="searchTxt" placeholder="Guest Name / Function Date" style="width:230px;border-radius: 10px;-moz-border-radius: 10px;-webkit-border-radius:10px;border:1px solid #0B4F8C;height:32px;margin: 0 0 11px 25px;" value="<?php if(isset($_GET['val'])) {echo $_GET['val'];}else{echo '';}?>" onclick="srcSub();" />

	<input name="submt" style="margin:0 0 0 10px;" type="button" id="submt"  class="btnH" value="Display" onClick="clkSubmit()" />
	
</td>

<!--<td>
<a href="fp_creation.php"><button type="button" id="add" class="button_example bnkSbt" onclick="return checkUnitMaster();" style="margin:4px 0 -8px 0px;"><img src="../../images/add-contact-iconn.png" class="sbtBtnImg"/>&nbsp;&nbsp;<span class="btnUndLine">A</span>dd FP Creation</button></a>
</td>-->
</tr>
</table>
</div>

<form id="taxTypes" name="taxTypes" class="" style=""> 
<table class="table table-striped table-success" id="adave" border="1" style="text-align:center;font-size:12px; border-color:#ddd;">
<thead style="background-color:#FFFFFF;">
<tr class="info">
		<td colspan="21" style="text-align:center;"><h3 class="viewDTT" style=""><b>View Function Prospectus Creation Details</b></h3><b></b></td>
	</tr>
	<tr>
		<th  style="text-align:center;background-color:#0073B5;;color:#fff;">Sl.no</th>
		<th  style="text-align:center;background-color:#0073B5;;color:#fff;">Booking_No#</th>
		<th  style="text-align:center;background-color:#0073B5;;color:#fff;">Id#</th>
		<th  style="text-align:center;background-color:#0073B5;;color:#fff;">Guest name</th>
		<th  style="text-align:center;background-color:#0073B5;;color:#fff;">Venue</th>
		<th  style="text-align:center;background-color:#0073B5;;color:#fff;">Session</th>
		<th  style="text-align:center;background-color:#0073B5;;color:#fff;">Function Date</th>
		<th  style="text-align:center;background-color:#0073B5;;color:#fff;">Create</th>
		<!--<th  style="text-align:center;background-color:#0073B5;;color:#fff;">Approval Status</th>-->
		<th  style="text-align:center;background-color:#0073B5;;color:#fff;">Edit</th>
		<th  style="text-align:center;background-color:#0073B5;;color:#fff;">Print</th>
		<th  style="text-align:center;background-color:#0073B5;;color:#fff;">FP Cancel</th>
		<th  style="text-align:center;background-color:#0073B5;;color:#fff;">Created by</th>
		<th  style="text-align:center;background-color:#0073B5;;color:#fff;">Created on</th>
	</thead>
	<tbody>
	<style>
.butExample {
    padding: 4px 9px;
}
.butDisable{
	padding: 4px 9px;
}
</style>
<?php 
$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$adtCurDt=trim($rowAC['cur_date']);
$ad=explode('/',$adtCurDt);
$cur=$ad[2].'-'.$ad[1].'-'.$ad[0];
	
	if(isset($_GET['val']) && $_GET['val']!=''){
       // $item_where= " where joborder ='".$_GET['val']."'";
       $sql=mysql_query("select * from bq_hallbooking where book_date ='".$_GET['val']."' or guest_name ='".strtolower($_GET['val'])."' and confirm_status='2' order by str_to_date(book_date,'%d/%m/%Y') ASC");	
	   
	}else{
	$sql=mysql_query("select * from bq_hallbooking where str_to_date(book_date,'%d/%m/%Y') >= '".$cur."' and confirm_status='2' order by str_to_date(book_date,'%d/%m/%Y') ASC");
	}
	

$x=0;
while($row=mysql_fetch_array($sql)) {
$x++;

	$sqlC=mysql_fetch_array(mysql_query("select * from bq_opfpmenuhdr where bkno='".$row['booking_no']."' and fpno='".$row['fpno']."'"));


$sqlv=mysql_query("select * from bq_venue where venue_code='".$row['venue']."' AND status ='1'");
$rov=mysql_fetch_array($sqlv);
?>


<tr>
	<td  style="text-align:center;"><?php echo $x;  ?></td>
	<td  style="text-align:center;"><?php echo $row['booking_no'];?></td>
	<td  style="text-align:center;"><?php echo $row['hallbook_id']; ?></td>
	<td  style="text-align:left;width:250px;"><?php echo strtoupper($row['guest_name']); ?></td>
	<td  style="text-align:center;"><?php echo strtoupper($rov['venue_desc']); ?></td>
	<td  style="text-align:center;"><?php echo strtoupper($row['session']); ?></td>
	<td  style="text-align:center;"><?php echo strtoupper($row['book_date']); ?></td>
	<td  style="text-align:center;">
	<?php if($sqlC['bill_status']==3 || $sqlC['bill_status']=='' ) { ?>
	<a href="<?php echo $home_path;?>/transaction/frontdesk/fp_creation.php?bkNo=<?php echo $row['booking_no'];?>&&bid=<?php echo $row['hallbook_id'];?>"><i class="fa fa-plus-square fa-2x" style="color:#2a9c33;" aria-hidden="true"></i></a>
	<?php }else{?>
	 <i class="fa fa-plus-square fa-2x" style="color:#bcc4bf;" aria-hidden="true"></i>
    <?php }?>
	</td>
	<!--<td  style="text-align:center;">
	<a href="<?php echo $home_path;?>/transaction/frontdesk/fp_creation.php?bkNo=<?php echo $row['booking_no'];?>&&bid=<?php echo $row['hallbook_id'];?>"><i class="fa fa-plus-square fa-2x" style="color:#2a9c33;" aria-hidden="true"></i></a>
	</td>-->
	<!--<td  style="text-align:center;">
	<?php if($sqlC['aprove_sts']==1) { ?>
	<a href="<?php echo $home_path;?>/transaction/frontdesk/approve_fp.php?fpNo=<?php echo $row['fpno'];?>">Pending</a>
	<?php }elseif($sqlC['aprove_sts']==2){?>
	<a href="#" style="color:#4f9c40;font-weight:bold;cursor:context-menu;">Approved</a>
	<?php }?>
	</td>-->
	<td  style="text-align:center;">
	<?php if($sqlC['bill_status']==1) { ?>
	<a href="<?php echo $home_path;?>/transaction/frontdesk/edit-fp-creation.php?fpNo=<?php echo $row['fpno'];?>"><i class="fa fa-edit fa-2x" style="color:#000;" aria-hidden="true"></i></a>
	<?php }else{?>
    <i class="fa fa-edit fa-2x" style="color:#bcc4bf;" aria-hidden="true"></i>
    <?php }?>
	</td>
	<td  style="text-align:center;">
	<?php
		if($pid == '1'){
        $billtype='print-fp-creation.php';
        }else{
        $billtype='print-fp-creation.php';
        }
    ?>
	<a href="<?php echo $home_path;?>/transaction/view/<?php echo $billtype; ?>?fpNum=<?php echo $row['fpno'];?>"><i class="fa fa-print fa-2x" style="color:#000;" aria-hidden="true"></i></a>
	</td>
	<td  style="text-align:center;">	
    <?php if($sqlC['bill_status']==1) { ?>
    <!--<a href="<?php echo $home_path;?>/action/cancel-fp-creation.php?fpNum=<?php echo $row['fpno'];?>&bkno=<?php echo $row['bkno'];?>">-->
	<a onclick="fpcancel('<?php echo $row['fpno'];?>','<?php echo $row['booking_no'];?>');" ><i class="fa fa-trash fa-2x" style="color:#e62031;cursor:pointer;" aria-hidden="true"></i></a>
    <?php }else{?>
    <i class="fa fa-trash fa-2x" style="color:#bcc4bf;" aria-hidden="true"></i>
    <?php }?>
</td>
<td><?php echo $row['added_by']; ?></td>
<td><?php echo $row['added_on']; ?></td>
</tr>
<?php } ?>	
</tbody>
</table>

	</div>
	</div>
	</div>
	</div>


	<?php include("../../footer.php"); ?>
	</body>
 </form>
<script>
	function fpcancel(a,e){
	fpNum=a;
	bkno=e;
    swal({
            title: "Do You  Want To Cancel FP?",
            text: "FP NO: <?php echo $_GET['fpNum']; ?>",
            icon: "warning",
           buttons:{
				 cancel: "No",
                 confirm: "Yes",
			},
        })
        .then(function (isOkay) {
            if (isOkay) {
                // form.submit();
			document.location.href="<?php echo $home_path;?>/action/cancel-fp-creation.php?fpNum="+fpNum+"&bkno="+bkno;
            }
        });
        return false;
	
}
</script>