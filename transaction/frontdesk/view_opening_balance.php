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
 	 window.location.href = "business-source.php";
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
<div style="margin:0px 0 10px 750px;">
		<a href="opening_balance.php"><button type="button" id="add" class="button_example bnkSbt" onclick="return checkUnitMaster();" style="margin:4px 0 -8px 209px;"><img src="../../images/add-contact-iconn.png" class="sbtBtnImg"/>&nbsp;&nbsp;<span class="btnUndLine">A</span>dd Opening Balance</button></a>
</div>
<table class="table table-condensed table-hover table-striped table-bordered" cellpadding="0" cellspacing="0" border="0" class="table" style="margin:0 0 15px -5px;text-align:center;font-size:12px;">
	<tr class="info">
	
		<td colspan="13" style="text-align:center;"><h3 style="text-align:center;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>View Opening Balance</b></h3><b></b></td>
	</tr>
	<tr>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Sl.no</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Date</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Bill no</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Vendor Name</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Amount</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Edit</th>
	</tr>
	<?php 
	$sql=mysql_query("select * from ar_bills");
	$x=0;
	if(mysql_num_rows($sql)>0) {
	while($row=mysql_fetch_array($sql)) {
		$x++;
		
	?>
	<tr>
		<td width="80" style="text-align:center;"><?php echo $x; ?></td>
		<td width="80"><?php echo $row['bill_date']; ?></td>
		<td width="80" class="codesUPPERCase"><?php echo $row['bill_no']; ?></td>
		<td width="80" class="codesUPPERCase"><?php echo $row['vendor_code']; ?></td>
		<td width="80" class="codesUPPERCase"><?php echo $row['bill_amount']; ?></td>
		<td width="80">
		<a href="edit_opening_bal.php?opeBal=<?php echo $row['arbill_id']; ?>" style="" class="">Edit</a>&nbsp;
		<input type="hidden" id="compId" name="compId" value="<?php echo $row['arbill_id']; ?>"/>
		</td>
	</tr>
	<?php } } else{ ?>	
	<div style="margin: 21px 0 26px 10px;;width:95%;" class="alert alert-success">
                               You have not created any opening balance details...
    </div>
<?php } ?>
</table>
	
	</div>
	</body>
 </form>