<?php
ob_start();
include("../config.php");
include("../header.php");
?>

<script>
	jQuery(document).ready(function(){
	jQuery("#roommaster").validationEngine();
	});
	$("input").focus(function () {
     $("").css('outline','yellow solid thin');
});
 shortcut.add("Ctrl+A",function() { 
 	 window.location.href = "user-master.php";
}); 

/* shortcut.add("Ctrl+E",function() { 
	uid=$('#roomid').val();
	window.location.href = "edit_define_tax.php?roomid="+uid;
}); */


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
<div style="float:right;margin: 0 0 13px;">
		<a href="user-master.php"><button type="button" id="add" class="button_example bnkSbt" onclick="return checkUnitMaster();" style="margin:4px 0 -8px 377px;"><img src="../images/add-contact-iconn.png" class="sbtBtnImg"/>&nbsp;&nbsp;<span class="btnUndLine">A</span>dd User</button></a>
</div>
<table class="table table-condensed table-hover table-striped table-bordered" cellpadding="0" cellspacing="0" border="0" class="table" style="margin:0 0 15px -5px;text-align:center;font-size:12px;">
	<tr class="info">
	
		<td colspan="13" style="text-align:center;"><h3 id="Userhd"><b>View USer</b></h3><b></b></td>
	</tr>
	<tr>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Sl.no</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">User code</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">User name</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">email</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">mobile</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Status</th>
		<th width="80" style="text-align:center;background-color:#F5F5F5;">Edit</th>
	</tr>
	<?php 
	$sql=mysql_query("select * from user");
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
		<td width="80"><?php echo $row['usercode']; ?></td>
		<td width="80" class="codesUPPERCase"><?php echo $row['user_name']; ?></td>
		<td width="80" class="codesUPPERCase"><?php echo $row['email']; ?></td>
		<td width="80" class="codesUPPERCase"><?php echo $row['mobile']; ?></td>
		<td width="80" class="fstChUPPRCase"><?php echo $status; ?></td>
		<td width="80">
		<a href="Update-user-master.php?userId=<?php echo $row['user_id']; ?>" style="" class="">Edit</a>&nbsp;
		<input type="hidden" id="roomid" name="roomid" value="<?php echo $row['user_id']; ?>"/>
		</td>
	</tr>
	<?php } } else{ ?>	
	<div style="margin: 21px 0 26px 10px;;width:95%;" class="alert alert-success">
                               You have not created any User master details...
    </div>
<?php } ?>
</table>
	
	</div>
	<?php include("../footer.php"); ?>
	</body>
 </form>