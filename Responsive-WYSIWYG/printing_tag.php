<?php
ob_start();
include("../config.php");
include("../header.php");


$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$cr=explode('/',$rowAC['cur_date']);
$ctt=$cr[2].'-'.$cr[1].'-'.$cr[0];	
$curTime=date('H:i:s');
?>

 <style>
 .menu li a{
	 color:#000;
 }
 </style>

<!DOCTYPE HTML>
<html>
	<head>
		<!--<script type="text/javascript" src="<?php echo $home_path; ?>/js/jquery-1.11.1.min.js"></script>-->
		<!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>-->
		<script src="<?php echo $home_path; ?>/js/bootstrap.min.js"></script>
		<script src="editor.js"></script>
		<script>
			$(document).ready(function() {
				$("#txtEditor").Editor();
				
				$(".incLchk").on("click", function(){
	fpN=$("#fp_no").val();

	if(fpN==''){
		alert('Select FP Number!.');
	}else{
    if(incLchk.checked) {
	$.ajax({
		type:'GET',
		url:' ../action/selectMenuItemChked.php',
			data:{
			fpN:fpN
			},
			success:function(data){
			 /* alert(data); */
			 $("#txDiv").html(data);
			
			}
		});
		
       
    }  else {
		 $("#txDiv").html('');
    }
	}
});



$(".signBrd").on("click", function(){
	fpN=$("#fp_no").val();
	sgnBrd=$("#signboard").val();

	if(fpN==''){
		alert('Select FP Number!.');
	}else{
    if(signBrd.checked) {
	$.ajax({
		type:'GET',
		url:' ../action/selectSignItemChked.php',
			data:{
			fpN:fpN,
			sgnBrd:sgnBrd
			},
			success:function(data){
			/*  alert(data); */
			 $("#txDiv1").html(data);
			
			}
		});
		
       
    }  else {
		$("#txDiv1").html('');
    }
	}
});



			});
		</script>
		<link rel="stylesheet" type="text/css" href="<?php echo $home_path; ?>/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="<?php echo $home_path; ?>/css/font-awesome.min.css">
		<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">-->
		<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">-->
		<link href="editor.css" type="text/css" rel="stylesheet"/>
	</head>
	<body style="">
	
<div style="margin:10px 0 0 0;background-color:#7B0E0E;">
<table style="">
<tr>

<td width="" valign="top"><label style="color:#fff;font-size:12px;margin:0 0 0 10px;">FP.#<em>*</em>&nbsp;&nbsp;</label></td>
<td valign="top">
<select name="fp_no" id="fp_no" style="font-size:12px;width:100px" onChange="selVoucherDet();" class="wagRw1 textbox">
	<option value="">--Select--</option>
	<?php
	$sqle=mysql_query("select distinct fpno from bq_opfpmenuhdr where str_to_date(bkdate,'%d/%m/%Y')>='$ctt' AND bill_status='1' AND vuc_status=''");
	/* $sqle=mysql_query("select distinct fpno from bq_opfpmenuhdr where bill_status='1'"); */
	while($res=mysql_fetch_array($sqle)){
	?>
	<option value="<?php echo $res['fpno']  ?>" ><?php echo strtoupper($res['fpno']); ?></option>
	<?php } ?>
</select>

</td>

<td width="" valign="top"><label style="color:#fff;font-size:12px;">&nbsp;</label></td>
<td valign="top">&nbsp;&nbsp;
<input type="checkbox" id="incLchk" name="incLchk" value="incLchk" class="incLchk"/><span style="color:#fff;font-size:12px;margin:0 0 0 10px;">Menu Items</span>
<input type="checkbox" id="signBrd" name="signBrd" value="signBrd" class="signBrd"/><span style="color:#fff;font-size:12px;margin:0 0 0 10px;">Signboard</span>
</td>

</tr>
</table>
 </div>


		<div class="container-fluid" style="margin:0 15px 0 15px;">
			<div class="row">
			
				<div class="" style="float:right;">
					<div class="row">
					<div class="col-lg-3 nopadding" style="border:1px solid #B3B3B3;border-radius:3px 3px 0 0;margin:10px 0 0 0;height:407px;background-color:#fff;overflow:auto;" >
						<span id="txDiv"></span>
						<span id="txDiv1"></span>

						</div>
						<div class="col-lg-9 nopadding">
							<textarea id="txtEditor">
							
							</textarea> 

						</div>
					</div>
				</div>
			</div>
		</div>
		
	</body>
</html>
