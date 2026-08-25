<?php
ob_start();
include("../../config.php");
include("../../header.php");
?>

<script>
	jQuery(document).ready(function(){
		jQuery("#roommaster").validationEngine();
		$("#msgFo").fadeOut(5000);
	});
	$("input").focus(function () {
     $("").css('outline','yellow solid thin');
});
 shortcut.add("Ctrl+A",function() { 
 	 window.location.href = "valid_settlement_bqt.php";
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
<?php 	
if(isset($_GET['msg'])){
?>
	<p style="text-align:center;">
		<label id="msgFo" class="msgNotify"><?php echo $_GET['msg']; ?></label>
	</p>
<?php } ?>
<div style="margin:10px 50px 10px 0px;float:right;">
		<a href="valid_settlement_bqt.php"><button type="button" id="add" class="button_example bnkSbt" onclick="return checkUnitMaster();" style="margin:4px 0 -8px 377px;"><img src="../../images/add-contact-iconn.png" class="sbtBtnImg"/>&nbsp;&nbsp;<span class="btnUndLine">A</span>dd Valid Settlement(Bqt)</button></a>
</div>
<table class="table table-condensed table-hover table-striped table-bordered frmBgClr" cellpadding="0" cellspacing="0" border="0" class="table" style="margin:0 0 15px 0px;text-align:center;font-size:12px;">
	<tr class="info">
		<td colspan="13" style="text-align:center;"><h3 class="viewDT" id="Userhd"><b>View Valid Settlements(Bqt)</b></h3><b></b></td>
	</tr>
	<tr>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Sl.no</th>
		<th width="120" style="text-align:center;background-color:#F5F5F5;">Outlet Code</th>
		<th width="150" style="text-align:center;background-color:#F5F5F5;">Outlet Name</th>
		<th width="250" style="text-align:center;background-color:#F5F5F5;">Applicable Outlets</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Edit</th>
	</tr>
	<?php 
	$sql=mysql_query("select * from pos_validsettle");
	$x=0;
	if($sql && mysql_num_rows($sql)>0) {
	while($row=mysql_fetch_array($sql)) {
		$x++;
	?>
	<tr>
		<td width="80" style="text-align:center;"><?php echo $x; ?></td>
		<td width="120" style="text-align:left;"><?php echo $row['outlet_code']; ?></td>
		<td width="150" class="codesUPPERCase" style="text-align:left;"><?php echo $row['outlet_name']; ?></td>
		<td width="250" class="codesUPPERCase" style="text-align:left;"><?php echo str_replace(',', ', ', $row['outlets']); ?></td>
		<td width="80">
		<a href="edit_valid_settlement_bqt.php?valid_id=<?php echo $row['valid_id']; ?>" style="" class="">Edit</a>&nbsp;
		</td>
	</tr>
	<?php } } else{ ?>	
	<tr>
		<td colspan="5">
			<div style="margin: 21px 0 26px 10px;width:95%;" class="alert alert-success">
				You have not created any Valid Settlement details...
			</div>
		</td>
	</tr>
<?php } ?>
</table>
	
	</div>
	<?php include("../../footer.php"); ?>
	</body>
 </form>
