<?php
ob_start();
include("../../config.php");
include("../../header.php");
?>

<script>
	jQuery(document).ready(function(){
	jQuery("#roommaster").validationEngine();
	});
	$("input").focus(function () {
     $("").css('outline','yellow solid thin');
});
 shortcut.add("Ctrl+A",function() { 
 	 window.location.href = "departments-bqt.php";
}); 

</script>
 
<style>
   label {width: 205px; padding:0 20px 0 20px; display: inline-block;font-weight: bold;color: #000;font-size:12px; } 
   
input[type=text], textarea{
 height:26px;
}
.table td {text-align:center;} 
</style>	

<body class="bgBODY">
 <form id="taxTypes" name="taxTypes" class="" style=""> 
<div class="" style="height:500px;overflow:auto;">	
<div style="margin:10px 50px 10px 0px;float:right;">
		<a href="submenu_group_bqt.php"><button type="button" id="add" class="button_example bnkSbt" onclick="return checkUnitMaster();" style="margin:4px 0 -8px 377px;"><img src="../../images/add-contact-iconn.png" class="sbtBtnImg"/>&nbsp;&nbsp;<span class="btnUndLine">A</span>dd Sub Menu Group(Bqt)</button></a>
</div>
<table class="table table-condensed table-hover table-striped table-bordered frmBgClr" cellpadding="0" cellspacing="0" border="0" class="table" style="margin:0 0 15px 0px;text-align:center;font-size:12px;">
<tr class="info">

	<td colspan="13" style="text-align:center;"><h3 class="viewDT" id="Userhd"><b>View Sub Menu Group(Bqt)</b></h3><b></b></td>
</tr>
<tr>
	<th width="80" style="text-align:center;background-color:#F5F5F5;">Sl.no</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;">Code</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;">Name</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;">Group Code</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;">Status</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;">Edit</th>
</tr>
	<?php 
	$sql=mysql_query("select * from bq_submenugrp");
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
		<td width="80" style="text-align:left;"><?php echo $row['submenu_code']; ?></td>
		<td width="80" class="codesUPPERCase" style="text-align:left;"><?php echo $row['submenu_name']; ?></td>
		<td width="80" class="codesUPPERCase" style="text-align:left;"><?php echo $row['subgrp_code']; ?></td>
		<td width="80" class="fstChUPPRCase" style="text-align:left;"><?php echo $status; ?></td>
		<td width="80">
		<a href="edit_subMnuGroup_bqt.php?submng_id=<?php echo $row['submng_id']; ?>" style="" class="">Edit</a>&nbsp;
		</td>
	</tr>
	<?php } } ?>	
	
</table>
	
	</div>
	<?php include("../../footer.php"); ?>
	</body>
 </form>