<?php
include("header-main.php");
 ?>
<link href="<?php echo $home_path; ?>/css/bootstrap.css" rel='stylesheet' type='text/css' />
<style>
.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    padding: 8px;
    line-height: 2.428571;
    /* vertical-align: top; */
    /* border-top: 1px solid #ddd; */
}
.tooltip-inner {
    max-width: 100% !important;
}
</style>
<script src="<?php echo $home_path;?>/date-picker/jquery-ui.js"></script>
<link rel="stylesheet" href="<?php echo $home_path;?>/date-picker/jquery-ui.css">
<script type="text/javascript" src="<?php echo $home_path; ?>/js/bootstrap.min.js"></script>
 
<script type="text/javascript">
$(document).ready(function(){
	 $('[data-toggle="tooltip"]').tooltip();   
	$(".datepicker" ).datepicker({
	changeMonth:true,
	changeYear:true,
	yearRange:"-2:+2",
	 minDate: 0, 
	dateFormat:"dd/mm/yy"
	});

	$(".datepicker1" ).datepicker({
	changeMonth:true,
	changeYear:true,
	yearRange:"-2:+2",
	/* minDate: 0, */
	dateFormat:"dd/mm/yy"
	});
  
  	$("[rel=tooltip]").tooltip();
	$("[rel=popover]").popover({trigger:'click',html:true});
	
	
	
	
	
});
function clkSubmit(){
	fromdate=$('#from_date').val();
	if(fromdate!="")
	{
		document.location="density_chart.php?fromdate="+fromdate;
	}	
}
/*function setvenu(e)
{

	var venu = $(e).attr('venu');
	var val = $(e).attr('value');
	var dte = $(e).attr('dte');

	$.ajax({
	type:'GET',
	url:'action/seldensitycht.php',
		data:{
		venu:venu,
		val:val,
		dte:dte
		},
		success:function(data){
			 //alert(data);
			 opt=data.split(',');
			 if(opt[1]==1){
			$('#feedBk').html(opt[0]);
			$('#myModal').modal('show');
			 }else{
			 document.location="transaction/frontdesk/hall-booking.php?venu="+venu+"&val="+val;
			 }
		}
	});
}*/
function setvenu(e)
{

	var venu = $(e).attr('venu');
	var val = $(e).attr('value');
	var dte = $(e).attr('dte');
	$.ajax({
	type:'GET',
	url:'action/seldensitycht.php',
		data:{
		venu:venu,
		val:val,
		dte:dte
		},
		success:function(data){
			 /*alert(data);*/
			 opt=data.split(',');
			 if(data!=1){
			 document.location="transaction/frontdesk/hall-booking.php?ven="+venu+"&val="+val+"&dte="+dte;
			 }
		}
	});
}
</script>	

<!-- Start popup -->
<div id="myModal" class="modal fade" role="dialog" style="padding:20px 0 0 0;width:1000px;margin:0 auto;">
  <div class="modal-dialog modal-sm" style="width:500px;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">

<table class="table" border="1px solid #000" style="text-align:left;font-size:10px;width:500px;border-color:#ddd;">
<tbody id="feedBk">
</tbody>
</table>
      </div>
    </div>

  </div>
</div>
<!-- End popup -->
	
<body class="">

<form action="#" id="hotelDefi" autocomplete="off" name="hotelDefi">
<div class="container">
  <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">SELECT DATE</div>
      <div class="panel-body">
		  <div class="col-md-12">
		  <div class="col-md-2"></div>
		  <div class="col-md-2"><label for="birthday">Date:</label></div>
		  <div class="col-md-4">
		  <input name="from_date" style="margin-bottom:0px;text-align:left;" value="<?php if(isset($_GET['fromdate'])){ echo $_GET['fromdate'];}?>" type="text" class="form-control datepicker" id="from_date" placeholder="Select Date"/>
		  </div>
		  <div class="col-md-3"><button type="button" class="btn btn-info" onClick="clkSubmit()">Submit</button></div>
		  </div>
    </div>
	</div>
	</div>
	
	<div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">BOOK A BANQUET</div>
      <div class="panel-body">
		 <table class="table table-condensed">
		 <?php
		 $dtMnt=date('M-Y');
$dtMntT=date('Y-m-d');

/*$sqlAC=mysql_query("select cur_date from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$adtCurDt=$rowAC['cur_date'];*/
if(isset($_GET['fromdate'])) {
$adtCurDt=$_GET['fromdate'];
$opt=explode('/',$adtCurDt);
$todMnth=$opt[1].'/'.$opt[2];
$curDT=$opt[1];
$dtee=$opt[0].'-'.$opt[1].'-'.$opt[2];
$dae= $adtCurDt;
$dt=explode('/',$dae);
$dDt01='01'.'/'.$dt[0].'/'.$dt[1];
$dae= $todMnth;
$dt=explode('/',$dae);
$dDt01='01'.'/'.$dt[0].'/'.$dt[1];

$frm=$todMnth;
$curDaT=date('m/Y', strtotime($frm));

$dtDs=cal_days_in_month(CAL_GREGORIAN, $dt[0], $dt[1]);
$dtDys=$dtDs+1;

$dtE=explode('/',$frm);
$dtNxt=$dtE[1].'/'.$dtE[0].'/'.'01';

$daterNxt=date('M-Y', strtotime($dtNxt));

if($opt[1]==$dt[0] && $opt[2]==$dt[1]){
	$cDay=$opt[0];
}else{
	$cDay='1';
}
$dttt=$cDay+7;
$dateELess = date('m', strtotime('-1 month', strtotime($dtNxt)));
}
?>
    <thead>
     <tr>
<td id="" style="text-align:left;font-size:14px;width:200px;" ><b>Banquet Name</b></td>
<?php 
for($i=0;$i<7;$i++){
$dateE = date('d-m-Y', strtotime('+'.$i.'days', strtotime($dtee)));
?>
<td id="" style="font-size:14px;"><b><?php echo $dateE; ?></b></td>
<?php } ?>
</tr>
    </thead>
    <tbody>
	<?php $sqlRe=mysql_query("select * from bq_venue");
		  while($rowRe=mysql_fetch_array($sqlRe)){
		?>
	<tr>
	<td><?php echo ucwords($rowRe['venue_desc']); ?></td>
<?php 
for($i=0;$i<7;$i++){
$dateE = date('d-m-Y', strtotime('+'.$i.'days', strtotime($dtee)));
$dateF = date('d/m/Y', strtotime('+'.$i.'days', strtotime($dtee)));
?>
<td id="" style="font-size:14px;"><div class="form-check">
<?php
$dte=$dateE;
$fr=explode('-',$dte);
$dat=$fr[2].'-'.$fr[1].'-'.$fr[0];
$sqlR=mysql_fetch_array(mysql_query("select * from bq_hallbooking where str_to_date(book_date,'%d/%m/%Y')='".$dat."' and venue='".$rowRe['venue_code']."' and session='LUNCH'"));
if($sqlR['book_date']==$dateF && $sqlR['venue']==$rowRe['venue_code'] && $sqlR['session']=='LUNCH'){
	$color='#ed3e1f';
}else{
	$color='#34f50a';
}
$sqlD=mysql_fetch_array(mysql_query("select * from bq_hallbooking where str_to_date(book_date,'%d/%m/%Y')='".$dat."' and venue='".$rowRe['venue_code']."' and session='DINNER'"));
if($sqlD['book_date']==$dateF && $sqlD['venue']==$rowRe['venue_code'] && $sqlD['session']=='DINNER'){
	$colord='#ed3e1f';
}else{
	$colord='#34f50a';
}
?>
      <?php 
	  $checkLu=mysql_query("select * from bq_hallbooking where str_to_date(book_date,'%d/%m/%Y')='".$dat."' and venue='".$rowRe['venue_code']."' and session='LUNCH'");
	  if (mysql_num_rows($checkLu) > 0) { ?>
      <a href="#" data-toggle="tooltip" data-html="true" title="Guest Name :<?php echo $sqlR['guest_name']; ?><br>Mobile No :<?php echo $sqlR['phone']; ?><br>Remarks :<?php echo $sqlR['remarks']; ?>"><input type="checkbox" style="outline: 3px solid <?php echo $color; ?>;" class="form-check-input" id="chkl" name="session" venu="<?php echo $rowRe['venue_code']; ?>" value="LUNCH" dte="<?php echo $dateF; ?>" onclick="setvenu(this);"></a>
	  <?php }else{?>
	  <input type="checkbox" style="outline: 3px solid <?php echo $color; ?>;" class="form-check-input" id="chkl" name="session" venu="<?php echo $rowRe['venue_code']; ?>" value="LUNCH" dte="<?php echo $dateF; ?>" onclick="setvenu(this);">
	  <?php }?>
      <label class="form-check-label"  id="lunch" for="check2" ><b>L</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  <?php 
	  $checkDi=mysql_query("select * from bq_hallbooking where str_to_date(book_date,'%d/%m/%Y')='".$dat."' and venue='".$rowRe['venue_code']."' and session='DINNER'");
	  if (mysql_num_rows($checkDi) > 0) { ?>
	  <a href="#" data-toggle="tooltip" data-html="true" title="Guest Name :<?php echo $sqlD['guest_name']; ?><br>Mobile No :<?php echo $sqlD['phone']; ?><br>Remarks :<?php echo $sqlD['remarks']; ?>"><input type="checkbox" class="form-check-input"  style="outline: 3px solid <?php echo $colord; ?>;" id="chkd" venu="<?php echo $rowRe['venue_code']; ?>" dte="<?php echo $dateF; ?>" name="session" value="DINNER" onclick="setvenu(this);"></a>
	  <?php }else{?>
	  <input type="checkbox" class="form-check-input"  style="outline: 3px solid <?php echo $colord; ?>;" id="chkd" venu="<?php echo $rowRe['venue_code']; ?>" dte="<?php echo $dateF; ?>" name="session" value="DINNER" onclick="setvenu(this);"/>
	   <?php }?>
      <label class="form-check-label"  id="dinner" for="check2"><b>D</b></label>
    </div></td>
<?php } ?>
	</tr>
       <?php } ?>
    </tbody>
  </table>
    </div>
	</div>
	</div>
	
	
</div>


</form>	
<?php include("footer.php");  ?>		
</body>
</html>