<?php
include("../includes/header.php");
/* include("config.php"); */
 ?>
<style>
 .block_top_1 {
    background: #f7f7f7 none repeat scroll 0 0;
    float: left;
    margin: 0 20px 0 0;
    min-height: 320px;
    padding: 10px;
    width: 300px;
}
.block_top_2 {
    background: #f7f7f7 none repeat scroll 0 0;
    float: left;
    min-height: 320px;
    padding: 10px;
    width: 300px;
}
.block_top_3 {
    background: #f7f7f7 none repeat scroll 0 0;
    float: left;
    margin: 0 0 0 20px;
    min-height: 320px;
    padding: 10px;
    width: 300px;
}
input, textarea, select, .uneditable-input {
    border: 1px solid #cccccc;
    border-radius: 0;
    color: #555555;
    display: inline-block;
    font-size: 13px;
    height: 28px;
    line-height: 28px;
    margin-bottom: 9px;
    padding: 4px;
    width: 150px;
}
/* .table tr td {
    height: 25px;
	color:#333333;
} */
.table-disable-hover.table tbody tr:hover td,
.table-disable-hover.table tbody tr:hover th {
    background-color: inherit;
}
 #addcustomer .table .textbox { width:150px;} 
 
 .textbox {
    background: #fff none repeat scroll 0 0;
    border-color: #b1a795 #e2d9c7 #e2d9c7 #b1a795;
    border-style: solid;
    border-width: 1px;
    float: left;
    font-size: 12px;
    height: 26px;
    line-height: 26px;
    margin: 0 0 10px;
    padding: 0 5px;
    width: 150px;
}
table tr td {
    height: 25px;
	color: #333333;
}

</style>
<body class="bgBODY">
<div class="about">
	<div id="invoice" >
		<div class="col-md-12" >
			<h3 style="text-align:center;width:100%;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>Quotation</b></h3>
			<div class="block_top_1">

			<table style="float:left;" class="table table-condensed table-disable-hover" cellpadding="0" cellspacing="0" class="table" border="0" >
			

				<tr>
						<td width="125" valign="top">Property Code:</td>
						<td valign="top"><select>
						<option>--Select--</option>
						</select>
						<!--<td valign="top"><input name="item_name" id="item_name" type="text" class="textbox" />-->
						</td>
						
						
				</tr>
				<tr>
						<td width="125" valign="top">MSN No * :</td>
						<td valign="top">
						<select>
						<option>--Select--</option>
						</select>
						<!--<input name="item_des" id="item_des" type="text" class="textbox" />--></td>
						
										
				</tr>
				<tr>
					<td width="125" valign="top">Perior Status *:</td>
					<td valign="top">
						<select>
							<option>--Select--</option>
						</select>
					</td>
				</tr>
				<tr>
					<td width="125" valign="top">RFQ No:</td>
					<td valign="top"><input name="item_code" id="item_code" type="text" class="textbox" onblur="checkitemcode()"/></td>
					
				</tr>
					<tr>
						<td width="125" valign="top">Vendor Name :</td>
						<td valign="top">
							<select>
								<option>--Select--</option>
							</select>
						</td>
						
					</tr>
					
				</table>
			</div>
			<div class="block_top_2">
			<table style="" class="table">
					
						
						<tr>
							<td width="125" valign="top">Days Possible :</td>
							<td valign="top"><input name="item_code" id="item_code" type="text" class="textbox" onblur="checkitemcode()"/></td>
							
						</tr>
						<tr>
							<td width="125" valign="top">Qty:</td>
							<td valign="top"><input name="item_code" id="item_code" type="text" class="textbox" onblur="checkitemcode()"/></td>
							
						</tr>
						<tr>
							<td width="125" valign="top">Rate *:</td>
							<td valign="top"><input name="item_code" id="item_code" type="text" class="textbox" onblur="checkitemcode()"/></td>
							
						</tr>
						<tr>
							<td width="125" valign="top">Amount *:</td>
							<td valign="top"><input name="item_code" id="item_code" type="text" class="textbox" onblur="checkitemcode()"/></td>
							
						</tr>
						
				
			</table>
			</div>
			<div class="block_top_3">
			<table style="" class="table">
					
						<tr>
							<td width="125" valign="top">RFQ No :</td>
							<td valign="top"><input name="item_code" id="item_code" type="text" class="textbox" onblur="checkitemcode()"/></td>
							
						</tr>
						<tr>
							<td width="125" valign="top">Quote No :</td>
							<td valign="top"><input name="item_code" id="item_code" type="text" class="textbox" onblur="checkitemcode()"/></td>
							
						</tr>
						<!--<tr>
							<td width="125" valign="top">Periority:</td>
							<td valign="top"><input name="item_code" id="item_code" type="text" class="textbox" onblur="checkitemcode()"/></td>
							
						</tr>
						<tr>
							<td width="125" valign="top">Day Possibility *:</td>
							<td valign="top"><input name="item_code" id="item_code" type="text" class="textbox" onblur="checkitemcode()"/></td>
							
						</tr>
						<tr>
							<td width="125" valign="top">RFQ No *:</td>
							<td valign="top"><input name="item_code" id="item_code" type="text" class="textbox" onblur="checkitemcode()"/></td>
							
						</tr>-->
						
				
			</table>
			</div>
	<div style="margin:50px 0 0 194px;">
		<button type="submit" id="add" class="button_example bnkSbt" style="font-weight: bold;" onclick="return checkUnitMaster();"><img src="../images/save-icon.png" class="sbtBtnImg"/>&nbsp;&nbsp;Submit</button>
			
			<a href="update-hotel-definition.php"><button type="button" id="update" class="button_example bnkSbt" style="font-weight: bold;" onclick="return checkPropertyMasterq();"><img src="../images/modify1.png" class="sbtBtnImg"/>&nbsp;&nbsp;Modify</button></a>
			
			<button type="reset" id="rest" class="button_example" style="font-weight: bold;" onclick="cancel_ed()"><img src="../images/clear.png" class="sbtBtnImg"/>&nbsp;&nbsp;Clear</button>
			
			<button type="button" id="exit" name="exit" class="button_example" style="font-weight: bold;" onClick="self.close();" ><img src="../images/cancel.png" class="sbtBtnImg" style="width:25px;height:25px;"/>&nbsp;&nbsp;Exit</button>
			
		</div>
			<!--<table style="margin:0 0 0 359px;width:150px;text-align:center;" class="col-md-3 table" >
				<tr>
					<td valign="top">
						<input id="addButton" class="submitbtn" type="submit" value="Save" name="text" style="">
					</td>
				</tr>
			</table>-->
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