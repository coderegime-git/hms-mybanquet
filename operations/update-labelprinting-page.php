<?php
ob_start();
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
<script type="text/javascript">
$(document).ready(function(){
	var myCalendar;
	myCalendar = new dhtmlXCalendarObject(["calendar","calendar2","calendar3"]);
	myCalendar.setDateFormat("%d-%m-%Y");
	});
	
function chkLABLPrintPage() {
		rfQNo=$("#rfq_no").val();
		$.ajax({
		type:'GET',
		url:'  ../action/selLABLPrintPage.php',
			data:{
			rfQNo:rfQNo
			},
			success:function(data) {
					/* alert(data); */ 
				  Qte=data.split(',');
				  $("#clinDest").html(Qte[0]);
				  $("#nsn_no").val(Qte[1]);
				  $("#contract_no").val(Qte[2]); 
				  $("#part_no").val(Qte[3]); 
				  $("#part_name").val(Qte[4]); 
			}
	});
}

function selLblCLindest(){
	clin_dest=$("#clin_dest").val(); 
	$.ajax({
		type:'GET',
		url:'  ../action/selLABLClnDest.php',
			data:{
			clin_dest:clin_dest
			},
			success:function(data) {
					/* alert(data);  */
				  Qte=data.split(',');
				  $("#clin_qty").val(Qte[0]); 
				  $("#ship_1").val(Qte[1]); 
				  $("#ship_2").val(Qte[2]); 
				  $("#ship_3").val(Qte[3]); 
				  $("#bill_1").val(Qte[4]); 
				  $("#bill_2").val(Qte[5]); 
				  $("#bill_3").val(Qte[6]); 
			}
	});
	
	
}
</script> 
<link rel="stylesheet" type="text/css" href="<?php echo $home_path; ?>/codebase-datepicker/dhtmlxcalendar.css"/>
<script src="<?php echo $home_path; ?>/codebase-datepicker/dhtmlxcalendar.js"></script>
	<style>
		#calendar,
		#calendar2,
		#calendar3 {
			border: 1px solid #909090;
			font-family: Tahoma;
			font-size: 12px;
		 	background: #fff url("../images/date-icon.png") no-repeat scroll 95.5% 45%;
    cursor: pointer; 
		}
	</style>
	
	

<body class="bgBODY">
<div class="about">
	<div id="invoice" >
		<div class="col-md-12" >
			<h3 style="text-align:center;width:100%;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>Label Printing Page</b></h3>
			<div class="block_top_1">
<?php 
	$sql=mysql_query("select * from labelprintingpage where labelprntpge_id='".$_GET['uid']."'");
	$x=0;
	$row=mysql_fetch_array($sql);
		$x++;
	?>			
<form id="quotationmaster" name="quotationmaster" action="<?php echo $home_path;?>/action/update_labelprintingpage.php" method="post" class="" style="margin: 0 0 12px 0;">
<input name="labelprntpge_id" id="labelprntpge_id" type="hidden" data-validation="required" value="<?php echo $row['labelprntpge_id']?>" />
			<table style="float:left;" class="table table-condensed table-disable-hover" cellpadding="0" cellspacing="0" class="table" border="0" >
				<tr>
					<td width="125" valign="top">Label Type:</td>
					<td valign="top">
					<select name="label_type" id="label_type">
					<option value="">--Select--</option>
					<option value="Unit Label"<?php echo ($row['label_type']=='Unit Label')?'selected':''; ?>>Unit Label</option>
					<option value="Exterior Label"<?php echo ($row['label_type']=='Exterior Label')?'selected':''; ?>>Exterior Label</option>
					<option value="MSL Label"<?php echo ($row['label_type']=='MSL Label')?'selected':''; ?>>MSL Label</option>
					</select>
					<!--<td valign="top"><input name="item_name" id="item_name" type="text" class="textbox" />-->
					</td>
				</tr>
				<tr>
						<td width="125" valign="top">RFQ No * :</td>
						<td valign="top">
						<input name="rfq_no" id="rfq_no" type="text" class="textbox" onblur="chkLABLPrintPage();" value="<?php echo $row['rfq_no']?>"/>
						</td>
						
										
				</tr>
				<tr>
					<td width="125" valign="top">Date *:</td>
					<td valign="top">
						<input name="date" id="calendar" type="text" class="textbox" onblur="checkitemcode()" value="<?php echo $row['date']?>"/>
					</td>
				</tr>
				
				<tr>
					<td width="180" >CLIN Dest.:</td>
					<td id="clinDest">
						<input name="clin_no" id="clin_no1" type="text" data-validation="required" class="input validate[required] textbox" value="<?php echo $row['dest_code']?>"/>
					</td>
				</tr>
			
				<tr>
					<td width="125" valign="top">CLIN Qty:</td>
					<td valign="top"><input name="clin_no" id="clin_qty" type="text" class="textbox" onblur="checkitemcode()" value="<?php echo $row['clin_no']?>"/></td>
					
				</tr>
					<tr>
						<td width="125" valign="top">Shipment No :</td>
						<td valign="top">
						<input name="shipment_no" id="shipment_no" type="text" class="textbox" onblur="checkitemcode()" value="<?php echo $row['shipment_no']?>"/>
							<!--<select name="shipment_no" id="shipment_no">
								<option>--Select--</option>
								<option value="yes">Yes</option>
								<option value="no">No</option>
							</select>-->
						</td>
						
					</tr>
				<tr>
							<td width="125" valign="top">Label Qty :</td>
							<td valign="top"><input name="label_qty" id="label_qty" type="text" class="textbox" onblur="checkitemcode()" value="<?php echo $row['label_qty']?>"/></td>
							
						</tr>
						<tr>
							<td width="125" valign="top">TCN No :</td>
							<td valign="top">
							<input name="tcn_no" id="tcn_no" type="text" class="textbox" onblur="checkitemcode()" value="<?php echo $row['tcn_no']?>"/>
							<!--<select name="tcn_no" id="tcn_no">
								<option value="">--Select--</option>
								<option value="Auto Generate">Auto Generate</option>
								<option value="Manual">Manual</option>
							</select>--></td>
							
						</tr>
						<tr>
							<td width="125" valign="top">Package Type *:</td>
							<td valign="top"><input name="package_type" id="package_type" type="text" class="textbox" onblur="checkitemcode()" value="<?php echo $row['package_type']?>"/></td>
							
						</tr>
						<tr>
							<td width="125" valign="top">Total No. of pieces *:</td>
							<td valign="top"><input name="total_nopieces" id="total_nopieces" type="text" class="textbox" onblur="checkitemcode()" value="<?php echo $row['total_nopieces']?>"/></td>
							
						</tr>
					
				</table>
			</div>
			<div class="block_top_2">
			<table style="" class="table">
				<tr>
					<td width="125" valign="top">Piece No :</td>
					<td valign="top"><input name="piece_no" id="piece_no" type="text" class="textbox" onblur="checkitemcode()" value="<?php echo $row['piece_no']?>"/></td>
				</tr>
				<tr>
					<td width="125" valign="top">Package Dimensions :</td>
					<td valign="top"><input name="package_dimension" id="package_dimension" type="text" class="textbox" onblur="checkitemcode()" value="<?php echo $row['package_dimension']?>"/></td>
				</tr>
				<tr>
					<td width="125" valign="top">Cu. Wt.:</td>
					<td valign="top"><input name="cu_wt" id="cu_wt" type="text" class="textbox" onblur="checkitemcode()" value="<?php echo $row['cu_wt']?>"/></td>
				</tr>
				<tr>
					<td width="125" valign="top">Cu. Area *:</td>
					<td valign="top"><input name="cu_area" id="cu_area" type="text" class="textbox" onblur="checkitemcode()" value="<?php echo $row['cu_area']?>"/></td>
				</tr>	
					
				<tr>
					<td width="125" valign="top">Contract No :</td>
					<td valign="top"><input name="contract_no" id="contract_no" type="text" class="textbox" onblur="checkitemcode()" value="<?php echo $row['contract_no']?>"/></td>
				</tr>
				<tr>
					<td width="125" valign="top">NSN No :</td>
					<td valign="top"><input name="nsn_no" id="nsn_no" type="text" class="textbox" onblur="checkitemcode()" value="<?php echo $row['nsn_no']?>"/></td>
				</tr>
				<tr>
					<td width="125" valign="top">CAGE Code:</td>
					<td valign="top"><input name="cage_code" id="cage_code" type="text" class="textbox" onblur="checkitemcode()" value="<?php echo $row['cage_code']?>"/></td>
				</tr>
				<tr>
					<td width="125" valign="top">Part No:</td>
					<td valign="top"><input name="part_no" id="part_no" type="text" class="textbox" onblur="checkitemcode()" value="<?php echo $row['part_no']?>"/></td>
				</tr>	
				<tr>
					<td width="125" valign="top">Part Name:</td>
					<td valign="top"><input name="part_name" id="part_name" type="text" class="textbox" onblur="checkitemcode()" value="<?php echo $row['part_name']?>"/></td>
				</tr>	
						
						
				
			</table>
			</div>
			<div class="block_top_3">
			<table style="" class="table">
					
						<tr>
							<td width="125" valign="top">QUP :</td>
							<td valign="top"><input name="qup" id="qup" type="text" class="textbox" onblur="checkitemcode()" value="<?php echo $row['qup']?>"/></td>
							
						</tr>
						
						<!--<tr>
							<td width="125" valign="top">TCN :</td>
							<td valign="top"><input name="tcn" id="tcn" type="text" class="textbox" onblur="checkitemcode()"/></td>
							
						</tr>-->
						
							<ul id="myTab" class="nav nav-tabs">
                             <li class="active"><a href="#tab_billto" data-toggle="tab">From Address</a></li>
                             <li><a href="#tab_shippto" data-toggle="tab">To Address</a></li>
						 </ul>

				 <div id="myTabContent" class="tab-content" >
					 <div class="tab-pane fade in active" id="tab_billto">
						 <input id="bill_1" name="bill_1" value="<?php echo $row['bill_1']?>" style="width:271px" type="text" placeholder="Address Line 1">
						 <input id="bill_2" name="bill_2" value="<?php echo $row['bill_2']?>" style="width:271px" type="text" placeholder="Address Line 2">
						 <input id="bill_3" name="bill_3" value="<?php echo $row['bill_3']?>" style="width:271px" type="text" placeholder="Address Line 3">
						 <input id="bill_4" name="bill_4" value="<?php echo $row['bill_4']?>" style="width:271px" type="text" placeholder="Address Line 4">
					 </div>
					 <div class="tab-pane fade in " id="tab_shippto">
						<input id="ship_1"  name="ship_1" value="<?php echo $row['ship_1']?>" style="width:271px" type="text" placeholder="Address Line 1">
						<input id="ship_2"  name="ship_2" value="<?php echo $row['ship_2']?>" style="width:271px" type="text" placeholder="Address Line 2">
						<input id="ship_3"  name="ship_3" value="<?php echo $row['ship_3']?>" style="width:271px" type="text" placeholder="Address Line 3">
						<input id="ship_4"  name="ship_4" value="<?php echo $row['ship_4']?>" style="width:271px" type="text" placeholder="Address Line 4">
					 </div>
					 </div>
							 
						<tr>
							<td width="125" valign="top">Priority:</td>
							<td valign="top"><input name="priority" id="priority" type="text" class="textbox" onblur="checkitemcode()" value="<?php echo $row['priority']?>"/></td>
							
						</tr>
						<tr>
							<td width="125" valign="top">Serial No :</td>
							<td valign="top"><input name="serial_no" id="serial_no" type="text" class="textbox" onblur="checkitemcode()" value="<?php echo $row['serial_no']?>"/></td>
							
						</tr>
						<tr>
							<td width="125" valign="top">UID No :</td>
							<td valign="top"><input name="uid_no" id="uid_no" type="text" class="textbox" onblur="checkitemcode()" value="<?php echo $row['uid_no']?>"/></td>
							
						</tr>
						<tr>
							<td width="125" valign="top">RFID:</td>
							<td valign="top"><input name="rfid" id="rfid" type="text" class="textbox" onblur="checkitemcode()" value="<?php echo $row['rfid']?>"/></td>
							
						</tr>
						<!--<tr>
							<td width="125" valign="top">Print:</td>
							<td valign="top"><input name="item_code" id="item_code" type="text" class="textbox" onblur="checkitemcode()"/></td>
						</tr>-->
						
						
				
			</table>
			</div>
<table style="border-left:1px solid #ddd;" class="table">
	<tr>
		<td>			
	<div style="margin:10px 0 0 194px;">
		<button type="submit" id="add" class="button_example bnkSbt" style="font-weight: bold;" onclick="return checkUnitMaster();"><img src="../images/save-icon.png" class="sbtBtnImg"/>&nbsp;&nbsp;Submit</button>
			
			<a href="view-labelprintingpage.php"><button type="button" id="update" class="button_example bnkSbt" style="font-weight: bold;" onclick="return checkPropertyMasterq();"><img src="../images/view.png" class="sbtBtnImg"/>&nbsp;&nbsp;View</button></a>
			
			<button type="reset" id="rest" class="button_example" style="font-weight: bold;" onclick="cancel_ed()"><img src="../images/clear.png" class="sbtBtnImg"/>&nbsp;&nbsp;Clear</button>
			
			<button type="button" id="exit" name="exit" class="button_example" style="font-weight: bold;" onClick="self.close();" ><img src="../images/cancel.png" class="sbtBtnImg" style="width:25px;height:25px;"/>&nbsp;&nbsp;Exit</button>
			
		</div>
		</td>
	</tr>
</table>
</form>		
			
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