<?php
ob_start();
include("../../config.php");
include("../../header.php");
?>

<script>
	jQuery(document).ready(function(){
	jQuery("#roommaster").validationEngine();
	});
	
 shortcut.add("Ctrl+A",function() { 
	 window.location.href = "tax_structure_bqt.php";
}); 

/* shortcut.add("Ctrl+E",function() { 
	uid=$('#roomid').val();
	window.location.href = "edit_define_tax.php?roomid="+uid;
}); */

function checkPropertyCode(){
	propCode=$('#property_code').val();
	$.ajax({
		type:'GET',
		url:'../../action/repeatPropertyCode.php',
			data:{
			propCode:propCode
			},
			success:function(data){
				/* alert(data); */
				if(data==1){
					$('#propertycode_err').html('* Property Code already exists.');
					$('#property_code').val('');
				}
				else{
					$('#propertycode_err').html('');
				}
			}
	});
}



 </script>
 
<style>
   label {width: 205px; padding:0 20px 0 20px; display: inline-block;font-weight: bold;color: #000;font-size:12px; } 
   
input[type=text], textarea{
 height:26px;
}
.table td {text-align:center;} 
</style>	


<!--<body style="background:#eaebfc url(../../images/bg-ash2.jpg) repeat scroll center top;font: 69%/160% Lucida Grande,Verdana,Helvetica,Arial,sans-serif;">-->
<body class="bgBODY">

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
 <form id="taxTypes" name="taxTypes" class="" style=""> 
<div class="" style="height:500px;overflow:auto;">	
<div style="margin:10px 50px 10px 0px;float:right;">
		<a href="tax_structure_bqt.php"><button type="button" id="add" class="button_example bnkSbt" onclick="return checkUnitMaster();" style="
float:right;"><img src="../../images/add-contact-iconn.png" class="sbtBtnImg"/>&nbsp;&nbsp;<span class="btnUndLine">A</span>dd Tax Structure</button></a>
</div>
<table class="table table-condensed table-hover table-striped table-bordered frmBgClr" cellpadding="0" cellspacing="0" border="0" class="table" style="margin:0 0 15px -5px;text-align:center;font-size:12px;">
	<tr class="info">
	
		<td colspan="13" style="text-align:center;"><h3 class="viewDT" id="Userhd"><b>View Tax Structures</b></h3><b></b></td>
	</tr>
	<tr>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Sl.no</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Applicable Date</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Structure code</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Description</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Tax code</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Tax desc</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Factor</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Factor value</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Source</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Status</th>
		<!--<th width="80" style="text-align:center;background-color:#F5F5F5;">Edit</th>-->
	</tr>
	<?php 
	$sql=mysql_query("select * from bq_taxstruct");
	$x=0;
	if(mysql_num_rows($sql)>0) {
	while($row=mysql_fetch_array($sql)) {
		$x++;
		if($row['status']==1){
			$status="Active";
		}else{
			$status="Deactive";
		}
		
	?>
	<tr>
		<td width="80" style="text-align:center;"><?php echo $x; ?></td>
		<td width="80"><?php echo $row['applicable_date']; ?></td>
		<td width="80" class="codesUPPERCase" style="text-align:left;"><?php echo $row['str_code']; ?></td>
		<td width="80" class="fstChUPPRCase" style="text-align:left;"><?php echo $row['description']; ?></td>
		<td width="80" class="fstChUPPRCase" style="text-align:left;"><?php echo $row['tax_code']; ?></td>
		<td width="80" class="fstChUPPRCase" style="text-align:left;"><?php echo $row['tax_desc']; ?></td>
		<td width="80" class="fstChUPPRCase" style="text-align:left;"><?php echo $row['factor']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $row['factor_value']; ?></td>
		<td width="80" class="fstChUPPRCase" style="text-align:left;"><?php echo $row['source']; ?></td>
		<td width="80" class="fstChUPPRCase" style="text-align:left;"><?php echo $status; ?></td>
		<!--<td width="80">
		<a href="edit_fotax_structure.php?roomid=<?php /* echo $row['taxtstruct_id']; */ ?>" style="" class="">Edit</a>&nbsp;
		<input type="hidden" id="roomid" name="roomid" value="<?php /* echo $row['taxtstruct_id']; */ ?>"/>
		</td>-->
	</tr>
	<?php } } else{ ?>	
	<div style="margin: 21px 0 26px 10px;;width:95%;" class="alert alert-success">
                               You have not created any Define Tax details...
    </div>
<?php } ?>
</table>
	
	</div>
	<?php include("../../footer.php"); ?>
	</body>
 </form>