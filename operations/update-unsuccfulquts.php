<?php
ob_start();
include("../includes/header.php");
/* include("config.php"); */
 ?>
 <!--form validation-->	
<link rel="stylesheet" href="../form-valid/validationEngine.jquery.css" type="text/css"/>
<script src="../form-valid/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="../form-valid/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="../form-valid/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<!---//-form valid---->
<script type="text/javascript">
$(document).ready(function(){
	$("#msgFo").fadeOut(5000);
	$("#msgFoprop").fadeOut(7000);
	jQuery("#vendormaster").validationEngine();
});

function selUnsuccRfq() {
	rfq_no=$('#rfq_no').val();
	$.ajax({
		type:'GET',
		url:'  ../action/seleUnSuccessRFq.php',
			data:{
			rfq_no:rfq_no
			},
			success:function(data){
				/* alert(data); */  
				Qte=data.split(',');
				$("#solic_no").val(Qte[0]);
				$("#nsn_no").val(Qte[1]);
				$("#qty").val(Qte[2]);
				$("#price").val(Qte[3]);
			}
	});
}

</script> 
<body class="bgBODY">
<div class="about">
	<div class="container">
		<div class="col-md-12" >
		<div id="invoice" style="margin:0 auto;">
<?php 	
if(isset($_GET['msg'])){
?>
	<p style="text-align:center;">
		<label id="msgFo" class="msgNotify"><?php echo $_GET['msg']; ?></label>
	</p>
<?php } ?>
<p style="text-align:center;">
	<span id="msgFoprop" class="msgNotifyprop"></span>
</p>
<h3 style="text-align:center;width:94%;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>Update Unsuccessful Quotes</b></h3>
<div id="addcustomer" style="border:1px solid #ddd;width:910px;">
	<?php 
	$sql=mysql_query("select * from unsuccessful_quotes where unsucc_quoteId='".$_GET['uid']."'");
	$x=0;
	$row=mysql_fetch_array($sql);
		$x++;
	?>
	
<form id="vendormaster" name="vendormaster" action="<?php echo $home_path;?>/action/update_unsucc_quotes.php" method="post" class="" style="margin: 0 0 12px 0;">
<input name="unsucc_quoteId" id="unsucc_quoteId" type="hidden" data-validation="required" value="<?php echo $row['unsucc_quoteId']?>" />
		<table style="float:left;width:50%;border-right:1px solid #ddd;" cellpadding="0" cellspacing="0" class="table" border="0" >
		<tbody>
			<tr>
				<td width="125" valign="top"><label>RFQ No:</label></td>
				<td valign="top"><input name="rfq_no" id="rfq_no" type="text" data-validation="required" class="input validate[required] textbox codesUPPERCase" value="<?php echo $row['rfq_no']?>" />
				</td>
									
			</tr>
			<tr>
				<td width="145" valign="top"><label>Solicitation # :</label></td>
				<td valign="top"><input name="solic_no" id="solic_no" type="text" data-validation="required" class="input validate[required,custom[onlyLetterSp]] textbox fstChUPPRCase" value="<?php echo $row['solic_no']?>" /></td>
			</tr>
			<tr>
				<td width="150" valign="top"><label>NSN No:</label></td>
				<td valign="top"><input name="nsn_no" id="nsn_no" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" onblur="checkitemcode()" value="<?php echo $row['nsn_no']?>"/></td>
			</tr>
			<tr>
				<td width="150" valign="top"><label>Qty:</label></td>
				<td valign="top"><input name="qty" id="qty" type="text" class="textbox fstChUPPRCase" onblur="checkitemcode()" value="<?php echo $row['qty']?>"/></td>
			</tr>
			
			</tbody>
		</table>
		<table style="width:50%;" class="table">
			<tbody>
			
			<tr>
				<td width="125" valign="top"><label>Price :</label></td>
				<td valign="top"><input name="price" id="price" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" value="<?php echo $row['price']?>"/></td>
			</tr>
			<tr>
				<td width="125" valign="top"><label>Award To whom :</label></td>
				<td valign="top"><input name="award_whom" id="award_whom" type="text" data-validation="required" class="input validate[required] textbox" value="<?php echo $row['award_whom']?>"/></td>
			</tr>
			<tr>
				<td width="125" valign="top"><label>Award Price :</label></td>
				<td valign="top"><input name="award_price" id="award_price" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" value="<?php echo $row['award_price']?>"/></td>
			</tr>
			<tr>
				<td width="125" valign="top"><label>Reasons :</label></td>
				<td valign="top"><textarea name="award_price" id="award_price" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" onblur="checkitemcode()"></textarea></td>
			</tr>
						
		</tbody>
	</table>
	
<table style="border-left:1px solid #ddd;" class="table">
	<tr>
		<td>
	<div style="margin:10px 0 0 112px;">
		<button type="submit" id="add" class="button_example bnkSbt" style="font-weight: bold;" onclick="return checkUnitMaster();"><img src="../images/save-icon.png" class="sbtBtnImg"/>&nbsp;&nbsp;Submit</button>
			
			<a href="view-unsuccessfulquotes.php"><button type="button" id="update" class="button_example bnkSbt" style="font-weight: bold;" onclick="return checkPropertyMasterq();"><img src="../images/view.png" class="sbtBtnImg"/>&nbsp;&nbsp;View</button></a>
			
			<button type="reset" id="rest" class="button_example" style="font-weight: bold;" onclick="cancel_ed()"><img src="../images/clear.png" class="sbtBtnImg"/>&nbsp;&nbsp;Clear</button>
			
			<a href="<?php echo $home_path; ?>/dashboard.php"><button type="button" id="exit" name="exit" class="button_example" style="font-weight: bold;" onClick="self.close();" ><img src="../images/cancel.png" class="sbtBtnImg" style="width:25px;height:25px;"/>&nbsp;&nbsp;Exit</button></a>
			
		</div>
		</td>
	</tr>
</table>
	</form>		
		</div>	
		</div>
		</div>
		</div>
	</div>
	</div>
	<div class="banner-bottom" style="margin:15px 0 0 0;">
		<div class="container">
			<script src="<?php echo $home_path; ?>/js/jquery.wmuSlider.js"></script> 
				<script>
					$('.example1').wmuSlider();         
				</script> 
		</div>
	</div>
		<!-- scroll_top_btn -->
	<script type="text/javascript" src="<?php echo $home_path; ?>/js/move-top.js"></script>
	<script type="text/javascript" src="<?php echo $home_path; ?>/js/easing.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
		
			var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 1200,
				easingType: 'linear' 
			};
			
			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
		 <a href="#" id="toTop" style="display: none;"><span id="toTopHover" style="opacity: 1;"></span></a>

	 <script type="text/javascript" src="<?php echo $home_path; ?>/js/bootstrap-3.1.1.min.js"></script>

</body>
</html>