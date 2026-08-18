<?php
ob_start();

include("../config.php");

$added_on=date('Y-m-d H:i:s');
$added_by=$_SESSION['user'];
$date=date('Y-m-d');
$dateYr=date('d/m/Y');
?>
<script>
$(document).ready(function(){
$('#gstin').focus();

});

</script>	
	
<?php
$sql=mysql_fetch_array(mysql_query("select * from bq_opbillstldtl where settleflag!='3' AND bill_no='".$_GET['bl']."'"));
$slR=mysql_fetch_array(mysql_query("select * from bq_opbillhdr where bill_no='".$_GET['bl']."'"));

$slb=mysql_fetch_array(mysql_query("select * from bq_hallbooking where booking_no='".$_GET['bk']."' "));
?>



<table class="table" cellpadding="0" cellspacing="0" border="1" style="margin:0px 0 0px 0px;text-align:center;font-size:12px;width:500px;">
<tr>
	<td style="width:10px;" valign="top"><label style="margin:3px 0 0 0;width:120px;text-align:left;">Bill No</label></td>
	<td valign="top" style="width:50px;">
<input name="bl" id="bl" type="text" class="" style="width:320px;margin:4px 0 0 0;font-weight:bold;" value="<?php echo $_GET['bl']; ?>" readonly />
<input name="bk" id="bk" type="hidden" class="" style="width:320px;margin:4px 0 0 0;font-weight:bold;" value="<?php echo $_GET['bk']; ?>" readonly />	
<input name="from_date" id="from_date" type="hidden" class="" style="width:320px;margin:4px 0 0 0;font-weight:bold;" value="<?php echo $_GET['fr']; ?>" readonly />	
<input name="to_date" id="to_date" type="hidden" class="" style="width:320px;margin:4px 0 0 0;font-weight:bold;" value="<?php echo $_GET['to']; ?>" readonly />	
	</td>
</tr>

<tr>
	<td style="width:10px;" valign="top"><label style="margin:3px 0 0 0;width:120px;text-align:left;">GSTIN</label></td>
	<td valign="top" style="width:50px;"><input name="gstin" id="gstin" type="text" class="" style="width:320px;margin:4px 0 0 0;" value="<?php echo $slR['gst_no']; ?>" onfocus="this.value=''"/>
	</td>
</tr>
<tr>
	<td style="width:10px;" valign="top"><label style="margin:3px 0 0 0;width:120px;text-align:left;">Company Name</label></td>
	<td valign="top" style="width:50px;"><input name="company_name" id="company_name" type="text" value="<?php echo $slb['company_name']; ?>" class="" style="width:320px;margin:4px 0 0 0;" />
	</td>
</tr>
<tr>
	<td style="width:10px;" valign="top"><label style="margin:3px 0 0 0;width:120px;text-align:left;">Guest Name</label></td>
	<td valign="top" style="width:50px;"><input name="guest_name" id="guest_name" type="text" value="<?php echo $slR['fname']; ?>" class="" style="width:320px;margin:4px 0 0 0;" />
	</td>
</tr>
<tr>
	<td style="width:10px;" valign="top"><label style="margin:3px 0 0 0;width:120px;text-align:left;">Address</label></td>
	<td valign="top" style="width:50px;"><input name="gst_address1" id="gst_address1" type="text" class="" value="<?php echo $slR['add1']; ?>" style="width:320px;margin:4px 0 0 0;" />
	</td>
</tr>
<tr>
	<td style="width:10px;" valign="top"><label style="margin:3px 0 0 0;width:120px;text-align:left;">Address1</label></td>
	<td valign="top" style="width:50px;"><input name="gst_address2" id="gst_address2" type="text" class="" value="<?php echo $slR['add2']; ?>" style="width:320px;margin:4px 0 0 0;" />
	</td>
</tr>

<tr>
	<td style="width:10px;" valign="top"><label style="margin:3px 0 0 0;width:120px;text-align:left;">City</label></td>
	<td valign="top" style="width:50px;"><input name="gst_city" id="gst_city" type="text" class="" value="<?php echo $slR['city']; ?>" style="width:320px;margin:4px 0 0 0;" />
	</td>
</tr>
<tr>
	<td style="width:10px;" valign="top"><label style="margin:3px 0 0 0;width:120px;text-align:left;">Pin code</label></td>
	<td valign="top" style="width:50px;"><input name="gst_pin" id="gst_pin" type="text" class="" value="<?php echo $slR['pin']; ?>" style="width:320px;margin:4px 0 0 0;" />
	</td>
</tr>
<tr>
	<td style="width:10px;" valign="top"><label style="margin:3px 0 0 0;width:120px;text-align:left;">Mobile</label></td>
	<td valign="top" style="width:50px;"><input name="gst_mobile" id="gst_mobile" type="text" class="" value="<?php echo $slb['phone']; ?>" style="width:320px;margin:4px 0 0 0;" />
	</td>
</tr>
<?php
					// $select1 = '';
					// $select2 = '';
					// $select3 = '';
					// if($slR['billset_type'] == 'N')
					// {
					// $select1 = 'checked';	
					// }else if($slR['billset_type'] == 'G')
					// {
					// $select2 = 'checked';		
					// }else if($slR['billset_type'] == 'C')
					// {
					// $select3 = 'checked';		
					// }
					?>
					<!--<tr>
					<td><label>Who Claims GST? <em>*</em></label></td>
					<td><div style="display:flex;">
    <input type="radio" id="contactChoice1"
           name="claimgst" class="validate[required]" <?php echo $select1;?> value="N">
    <label for="contactChoice1" style="padding: 3px 9px;">None</label>
    <input type="radio" id="contactChoice2"
           name="claimgst" class="validate[required]" <?php echo $select2;?> value="G">
    <label for="contactChoice2" style="padding: 3px 9px;">Guest</label>
    <input type="radio" id="contactChoice3"
           name="claimgst" class="validate[required]" <?php echo $select3;?> value="C">
    <label for="contactChoice3" style="padding: 3px 9px;">Company</label>
  </div></td>
					</tr>-->

</table>
	  
