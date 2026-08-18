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
 	 window.location.href = "market-segment-master.php";
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
		<a href="tax_details_bqt.php"><button type="button" id="add" class="button_example bnkSbt" onclick="return checkUnitMaster();" style="margin:4px 0 -8px 377px;"><img src="../../images/add-contact-iconn.png" class="sbtBtnImg"/>&nbsp;&nbsp;<span class="btnUndLine">A</span>dd Tax Details</button></a>
</div>
<table class="table table-condensed table-hover table-striped table-bordered frmBgClr" cellpadding="0" cellspacing="0" border="0" class="table" style="margin:0 0 15px 0px;text-align:center;font-size:12px;">
	<tr class="info">
	
		<td colspan="13" style="text-align:center;"><h3 class="viewDT" id="Userhd"><b>View Tax Detail</b></h3><b></b></td>
	</tr>
	<tr>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Sl.no</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Code</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Name</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Edit</th>
	</tr>
	<?php 
	$sql=mysql_query("select * from bq_taxdetail");
	$x=0;
	if(mysql_num_rows($sql)>0) {
	while($row=mysql_fetch_array($sql)) {
		$x++;
	?>
	<tr>
		<td width="80" style="text-align:center;"><?php echo $x; ?></td>
		<td width="80" class="codesUPPERCase"><?php echo $row['hall_tax']; ?></td>
		<td width="80" class="codesUPPERCase"><?php echo $row['food_tax']; ?></td>
		<td width="80">
		<a href="<?php echo $home_path;?>/masters/banquet/tax_details_bqt.php?taxdtId=<?php echo $row['taxdet_id']; ?>" style="" class="">Edit</a>&nbsp;
		</td>
	</tr>
	<?php } } ?>	
	
</table>
	
	</div>
	<?php include("../../footer.php"); ?>
	</body>
 </form>