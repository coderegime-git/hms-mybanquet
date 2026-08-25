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
 	 window.location.href = "item_master_bqt.php";
}); 

function srchTxtBtn(){
	$("#searchTxt").val('');
}


function srchBtn() {
	
	itm=$("#searchTxt").val();
	window.location.href = "view_itemmaster_bqt.php?val="+itm;
	
}
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


<div>
<table style="margin:0 0 0 0;">	
<tr>
<!--<td><label style="width:100px;"><b>Outlet :</b></label></td>
<td>
	<?php /* $sqlRt=mysql_query("select * from bq_menumaster group by menu_code order by menu_code ASC"); */?>
	<select name="outlet" id="outlet" class="textbox fstChUPPRCase" style="width:122px;" onChange="showOUTlet()">
	<option value="">--select--</option>
	<?php while($rowRt=mysql_fetch_array($sqlRt)){?>
	<option class="codesUPPERCase" value="<?php echo $rowRt['menu_code'];?>" ><?php echo $rowRt['menu_code'];?></option>
	<?php } ?>
	</select>
</td>-->

<td style="width:534px;">
	<input type="text" id="searchTxt" name="searchTxt" placeholder="Enter Item code/ Name / Menu name" style="margin-left: 30px;width:230px;border-radius: 10px;-moz-border-radius: 10px;-webkit-border-radius:10px;border:1px solid #0B4F8C;height:32px;" value="<?php if(isset($_GET['val'])){ echo $_GET['val'];}?>" onclick="srchTxtBtn();" />

	<button type="button" name="searchBtn" id="searchBtn" style="margin:0px 0 0 0px;color:#000;font-size:13px;font-weight:bold;padding:2px;" class="myButSRc btnn" onclick="srchBtn();"><img src="../../images/audit.png"  class="sbtBtnImg"/>&nbsp;Search&nbsp;</button>
</td>

<td style="width:534px;">
	<a href="item_master_bqt.php"><button type="button" id="add" class="button_example bnkSbt" onclick="return checkUnitMaster();" style="margin:8px 0 8px 209px;"><img src="../../images/add-contact-iconn.png" class="sbtBtnImg"/>&nbsp;&nbsp;<span class="btnUndLine">A</span>dd Item Master</button></a>
</td>
	
</tr>
</table>
</div>



<!--<div style="margin:10px 50px 10px 0px;float:right;">
		<a href="item_master_bqt.php"><button type="button" id="add" class="button_example bnkSbt" onclick="return checkUnitMaster();" style="margin:4px 0 -8px 377px;"><img src="../../images/add-contact-iconn.png" class="sbtBtnImg"/>&nbsp;&nbsp;<span class="btnUndLine">A</span>dd Item Master(Bqt)</button></a>
</div>-->
<table class="table table-condensed table-hover table-striped table-bordered frmBgClr" cellpadding="0" cellspacing="0" border="0" class="table" style="margin:0 0 15px 0px;text-align:center;font-size:12px;">
	<tr class="info">
		<td colspan="15" style="text-align:center;"><h3 class="viewDT" id="Userhd"><b>View Item Master(Bqt)</b></h3><b></b></td>
	</tr>
	<tr>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Sl.no</th>
		<!--<th width="80" style="text-align:center;background-color:#F5F5F5;">Code</th>-->
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Name</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Sub Category</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Submenu Code</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Item rate</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Tax struc</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Allow disc</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Allow qty</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Allow change</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Item Menu Code</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Item Menu Name</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Menu Status</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Status</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Edit</th>
	</tr>
	<?php 
	if(isset($_GET['val'])){
		$item_where= " where item_code='".$_GET['val']."' OR item_name like '%".$_GET['val']."%' OR itmnu_name like '%".$_GET['val']."%'";
		$sql=mysql_query("select * from bq_itemmaster $item_where");
	}else{
		$sql=mysql_query("select * from bq_itemmaster where status='1'");
	}
	
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
		<!--<td width="80"><?php echo $row['item_code']; ?></td>-->
		<td width="80" class="codesUPPERCase"><?php echo $row['item_name']; ?></td>
		<td width="80" class="codesUPPERCase"><?php echo $row['itmsub_cat']; ?></td>
		<td width="80" class="codesUPPERCase"><?php echo $row['itmsubmnu_code']; ?></td>
		<td width="80" class="codesUPPERCase"><?php echo $row['item_rate']; ?></td>
		<td width="80" class="codesUPPERCase"><?php echo $row['tax_struc']; ?></td>
		<td width="80" class="codesUPPERCase"><?php echo $row['allow_disc']; ?></td>
		<td width="80" class="codesUPPERCase"><?php echo $row['allow_qty']; ?></td>
		<td width="80" class="codesUPPERCase"><?php echo $row['allwrate_chg']; ?></td>
		<td width="80" class="codesUPPERCase"><?php echo $row['itmnu_code']; ?></td>
		<td width="80" class="codesUPPERCase"><?php echo $row['itmnu_name']; ?></td>
		<td width="80" class="codesUPPERCase"><?php echo $row['mnu_sts']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $status; ?></td>
		<td width="80">
		<a href="edit_itemmaster_bqt.php?item_id=<?php echo $row['item_id']; ?>" style="" class="">Edit</a>&nbsp;
		</td>
	</tr>
	<?php } } else{ ?>	
	<div style="margin: 21px 0 26px 10px;width:95%;" class="alert alert-success">
                               You have not created any Item Master details...
    </div>
<?php } ?>	
	
</table>
	
	</div>
	<?php include("../../footer.php"); ?>
	</body>
 </form>