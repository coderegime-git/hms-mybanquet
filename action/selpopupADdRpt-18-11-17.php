<?php
ob_start();

include("../config.php");
$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];

$snt=$_GET['snt']+1;
$bkN=$_GET['bkN'];

$sqlb=mysql_query("select * from bq_hallbooking where booking_no='".$bkN."' AND confirm_status!='7'");
$rowb=mysql_fetch_array($sqlb);

?>
<?php for($cc=1;$cc<$snt;$cc++) {  ?>

<tr id=""><td style="text-align:center;" class="sourceonVAL"><input name="bl_name[]" id="bl_name<?php echo $cc; ?>" type="text" class="textbox fstChUPPRCase expet" style="width:150px;margin:5px 0 0 0px" value="<?php echo $rowb['guest_name']; ?>" /></td><td style="text-align:center;" class="sourceonVAL"><input name="bl_addr[]" id="bl_addr<?php echo $cc; ?>" type="text" class="textbox fstChUPPRCase expet" style="width:150px;margin:5px 0 0 0px" value="<?php echo $rowb['address1']; ?>" /></td><td style="text-align:center;" class="sourceonVAL"><input name="bl_addr1[]" id="bl_addr1<?php echo $cc; ?>" type="text" class="textbox fstChUPPRCase expet" style="width:150px;margin:5px 0 0 0px" value="<?php echo $rowb['address2']; ?>" /></td><td style="text-align:center;" class="sourceonVAL"><input name="bl_city[]" id="bl_city<?php echo $cc; ?>" type="text" class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="<?php echo $rowb['city']; ?>" /></td><td style="text-align:center;" class="sourceonVAL"><input name="bl_pin[]" id="bl_pin<?php echo $cc; ?>" type="text" class="textbox fstChUPPRCase expet" style="width:80px;margin:5px 0 0 0px" value="<?php echo $rowb['pin']; ?>" /><input name="gst_no[]" id="gst_no<?php echo $cc; ?>" type="text" class="textbox fstChUPPRCase expet" style="width:140px;margin:5px 0 0 0px" value="<?php /* echo $rowb['guest_name']; */ ?>" /><input name="split[]" id="split<?php echo $cc; ?>" type="text" class="textbox fstChUPPRCase expet" style="width:50px;margin:5px 0 0 0px;text-align:center;" value="<?php echo $cc; ?>" readonly /></td></tr>
		
<?php } ?>

