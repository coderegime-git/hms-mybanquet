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
	/* minDate: 0, */
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
			 if(opt[1]==1){
			$('#feedBk').html(opt[0]);
			$('#myModal').modal('show');
			document.getElementById(val+dte+venu).style.color = '#34A853';
			 }else{
			 document.location="transaction/frontdesk/hall-booking.php?venu="+venu+"&val="+val;
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
?>
<td id="" style="font-size:14px;"><div class="form-check">
      <input type="checkbox" class="form-check-input" id="chkl" name="session" venu="<?php echo $rowRe['venue_desc']; ?>" value="lunch" dte="<?php echo $dateE; ?>" onclick="setvenu(this);">
      <label class="form-check-label" id="lunch<?php echo $dateE; ?><?php echo $rowRe['venue_desc']; ?>" for="check2" ><b>L</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	  <input type="checkbox" class="form-check-input" id="chkd" venu="<?php echo $rowRe['venue_desc']; ?>" dte="<?php echo $dateE; ?>" name="session" value="dinner" onclick="setvenu(this);">
      <label class="form-check-label" id="dinner<?php echo $dateE; ?><?php echo $rowRe['venue_desc']; ?>" for="check2"><b>D</b></label>
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