<?php
ob_start();
include("../includes/header.php");
include("../util.php");
?>
<style>
.frmSearch {border: 1px solid #F0F0F0;/* background-color:#C8EEFD; */margin: 2px 0px;/* padding:40px; */}
#country-list{float:left;list-style:none;margin:0;padding:0;width:190px;position: absolute;z-index: 1;}
#country-list li{padding: 10px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#country-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;}
</style>
<!--form validation-->	
<link rel="stylesheet" href="../form-valid/validationEngine.jquery.css" type="text/css"/>
<script src="../form-valid/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="../form-valid/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="../form-valid/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>
<!---//-form valid---->
<script type="text/javascript">
$(document).ready(function(){
	$("#nsnnumber").keyup(function(){
	$.ajax({
		type: "POST",
		url: "../action/selectNSNDetForQUote.php",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			 /* alert(data); */ 
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#search-box").css("background","#FFF");
		}
		});
		});
		
		
	$("#msgFo").fadeOut(5000);
	$("#msgFoprop").fadeOut(7000);
	jQuery("#quotationmaster").validationEngine();
		
	var myCalendar;
	myCalendar = new dhtmlXCalendarObject(["calendar","calendar2","calendar3"]);
	myCalendar.setDateFormat("%d-%m-%Y");
	
	var fullDate = new Date();
	console.log(fullDate);
	var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
	var currentDate = fullDate.getDate() +"-"+ twoDigitMonth +"-"+ fullDate.getFullYear();
	$("#calendar").val(currentDate);
	
		
	$('input[name^=quote_rate]').live('keyup', function() {
		/* qtR=parseFloat($("#quote_rate").val()); 
		QtRa=parseFloat(qtR*1);
		$("#quote_rate").val(QtRa.toFixed(3)); */
		/* quote_rate=parseFloat($(this).val()); 
		$("#quote_rate").val(quote_rate.toFixed(3)); */
		qty=parseFloat($("#qty").val()); 
		qtRate=parseFloat($("#quote_rate").val()); 
		qtAmt=parseFloat(qty*qtRate);
		$("#quote_amt").val(qtAmt.toFixed(2));
		qtTotAmt=$("#quote_amt").val();
		if(qtTotAmt=="NaN"){$("#quote_amt").val('0.00');}
	});
	
	

	
	/* $('input[name^=nsn_no]').live('keyup', function() {
		$("#nsnnumber").autocomplete({
			source: batches
		});
	}); */
	
	/* $('input[name^=rfq_no]').live('blur', function() { */
	$('input[name^=qty]').live('keyup', function() {
		qty=parseFloat($("#qty").val()); 
		qtRate=parseFloat($("#quote_rate").val()); 
		qtAmt=parseFloat(qty*qtRate);
		$("#quote_amt").val(qtAmt.toFixed(2));
		qtTotAmt=$("#quote_amt").val();
		if(qtTotAmt=="NaN"){$("#quote_amt").val('0.00');}
		
		propCode=$("#prefix").val(); 
		qtRfqNo=$("#rfq_no").val(); 
		var fullDate = new Date();
		console.log(fullDate);
		//Thu May 19 2011 17:25:38 GMT+1000 {}

		//convert month to 2 digits
		var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
		var now = new Date();
		var start = new Date(now.getFullYear(), 0, 0);
		var diff = now - start;
		var oneDay = 1000 * 60 * 60 * 24;
		var day = Math.floor(diff / oneDay);

		var currentDate=fullDate.getFullYear().toString().substr(2,2);
		 curDTE=propCode+currentDate+day+'-'+qtRfqNo;
		qtRfqNo=$("#quote_number").val(curDTE);
	});
	
	var fullDate = new Date();
		console.log(fullDate);
		var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
		var currentDate = fullDate.getDate() +"-"+ twoDigitMonth +"-"+ fullDate.getFullYear();
		$("#cur_date").val(currentDate);
	
});


function selNSNNo() {
	nsnNmber=$('#nsnnumber').val();
	/* alert(nsnNmber); */
	$.ajax({
		type:'GET',
		url:'../action/getQteNSNDet.php',
			data:{
			nsnNmber:nsnNmber
			},
			success:function(data){
				 /*  alert(data);  */
				 val=data.split(',');
					/*   $("#partnumber" ).hide();
					$("#partnumber1").show();  */
					/* 	$('#partnumber').prop('selected', true); 
					$('#partnumber option:selected').text(val[0]); 
					$('#partnumber1').html(val[0]);
					$('#partnumber').val(val[0]); 
					$('#partnumber option[value=val[0]]').prop('selected',true); 
					$("#partnumber1" ).html(val[0]);	*/
					/*   $("#partnumber1" ).html(val[0]); */
					/* $("#partnumber option[value=val[0]]").prop('selected', true); 
					$('.selDiv option[value="SEL1"]');
					$('.selDiv option:contains("Selection 1")');
					$('.selDiv option:eq(1)').attr('selected', 'selected')
					$('#element option[value="no"]').attr("selected", "selected");
					*/
				$("#selMulti" ).html(val[0]);
				$("#selPartMulti").html(val[1]);
			/* 	$("#partnumber1" ).html(val[0]);  */
				/* $('#part_name').val(val[1]); */
				$('#partName1').hide();
			}
	});
}



function selPartNo() {
	partNM=$('#partnumber').val();
	/* alert(partNM); */
	$.ajax({
		type:'GET',
		url:'../action/getQtePARTDet.php',
			data:{
			partNM:partNM
			},
			success:function(data){
				/*  alert(data);  */
				val=data.split(',');
			    $('#nsnnumber').html(val[0]);
			 /*    $('#nsnnumber1').html(val[0]);  */
				$('#part_name').val(val[1]);
				/* $("#selPartMulti" ).html(val[1]); */
			}
	});
}



function selectPartNO() { 
	 $('#partnumber').hide();
	 $('#newPartNO').hide();
	 $('#part_name').hide();
	 $('#new_partno').show();
	 $('#oldPartNO').show();
	 $('#new_partname').show();
	 
	  $('#partnumber').val('');
	  $('#part_name').val('');
	 
	/*  $('#part_name').val(''); */
}

function selectOLDPartNO() {
	  $('#partnumber').show();
	  $('#newPartNO').show();
	  $('#part_name').show();
	  $('#new_partno').hide();
	  $('#oldPartNO').hide(); 
	  $('#new_partname').hide(); 
	  
}
	
	
function frmValid(){
	newPRTno=$('#new_partno').val(); 
	newPRTno=$('#part_name').prop("disabled", false);
	var status = true;	
	/* if (newPRTno!='') {
		r=confirm("do u want to add new part no.");
		if(r==true){
			  status = true;
		}else{
			
			status = false;
		}
		
	} */
	
	if(!status){
		return false;
		}
		else
		{
			/* $("#reg-submit").val("Processing.."); */
		}
}

function nsnBlur(){
	nsnNo=$('#nsnnumber').val(); 
	$.ajax({
		type:'GET',
		url:'../action/quoteNSNPreviousStS.php',
			data:{
			nsnNo:nsnNo
			},
			success:function(data){
				/* alert(data); */
				val=data.split(',');
				perSts=$('#perior_status').val(data);
			}
	});
} 

function selectNSNDEt(val) {
$("#nsnnumber").val(val);
$("#suggesstion-box").hide();
}
	
function selqtRate() {
	quote_rate=parseFloat($('#quote_rate').val()); 
	$("#quote_rate").val(quote_rate.toFixed(3));
	 qtTotRt=$("#quote_rate").val();
	if(qtTotRt=="NaN"){$("#quote_rate").val('0.00');} 
	
}

</script> 

<style>
 .block_top_1 {
    background: #f7f7f7 none repeat scroll 0 0;
    float: left;
    margin: 0 20px 0 0;
    min-height: 320px;
    padding: 10px;
    width: 475px;
}
.block_top_2 {
    background: #f7f7f7 none repeat scroll 0 0;
    float: left;
    min-height: 320px;
    padding: 12px;
    width: 475px;
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
    width: 180px;
}
/* .table tr td {
    height: 25px;
	color:#333333;
} */
/* .table-disable-hover.table tbody tr:hover td,
.table-disable-hover.table tbody tr:hover th {
    background-color: inherit;
} */
 #addcustomer .table .textbox { width:180px;} 
 
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
    width: 180px;
}
table tr td {
    height: 25px;
	color: #333333;
}
.table th, .table td{
border-top: 1px solid #dddddd;
    line-height: 18px;
    padding: 8px;
    text-align: left;
    vertical-align: top;
	/* font-size: 12px; */
	}
	
	.table-condensed th, .table-condensed td {
    padding: 4px 5px;
}

.drop-down {
    background: #fff none repeat scroll 0 0;
    border-color: #b1a795 #e2d9c7 #e2d9c7 #b1a795;
    border-style: solid;
    border-width: 1px;
    float: left;
    font-size: 12px;
    height: 28px;
    line-height: 26px;
    margin: 0 0 8px;
    padding: 2px 5px;
	width: 180px;
}


</style>

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
<?php
$sqlCom=mysql_query("select * from property_master where company_id='".$_SESSION['companyId']."'");
$rowCom=mysql_fetch_array($sqlCom);
$prefix=$rowCom['prefix'];
?>	
<body class="bgBODY">
<div class="about">
<div class="col-md-12">


	<div id="invoice" style="border:1px solid #ddd;margin:0 auto;">
 <?php 	
if(isset($_GET['msg'])){
?>
	<p style="text-align:center;">
		<label id="msgFo"class="msgNotify"><?php echo $_GET['msg']; ?></label>
	</p>
<?php } ?>
<p style="text-align:center;">
		<span id="msgFoprop" class="msgNotifyprop"></span>
</p>		
	<h3 style="text-align:center;width:971px;font-size:14px;padding:10px;background:#0080C0;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>Quotation</b></h3>
<div class="" style="border-right:1px solid #ddd;">
<form id="quotationmaster" name="quotationmaster" action="<?php echo $home_path;?>/action/add_quotation.php" method="post" class="" style="margin: 0 0 12px 0;">
<input type="hidden" name="prefix" id="prefix"  class="textbox" value="<?php echo $prefix;?>"/>
<div>
		<table style="float:left;width:50%;border-right:1px solid #ddd;" cellpadding="0" cellspacing="0" border="0" class="table" >
			<tr>
				<td width="180" >Date:</td>
				<td>
				<input name="cur_date" id="calendar" type="text" class="textbox" placeholder="DD-MM-YYYY"/></td>
				
			</tr>
			<tr>
				<td width="180" >Solicitation # :</td>
				<td><input name="solicit_number" id="solicit_number" type="text" data-validation="required" class="input validate[required] textbox"/></td>
			</tr>
			<tr>
				<td width="180" >RFQ No :</td>
				<td >
				<input name="rfq_no" id="rfq_no" type="text" value="<?php echo getNextquoteRFQNumber(); ?>" data-validation="required" class="input validate[required] textbox codesUPPERCase" readonly />
				</td>
			</tr>
			<tr>
				<td width="180" >Currency :</td>
				<td>
					<select class="drop-down fstChUPPRCase" name="currency" id="currency">
						<option value="">--Select--</option>
						<?php
						$sqlC=mysql_query("select * from currency_master where currency_default='1'");
						$rowC=mysql_fetch_array($sqlC);
						
						$sqlba="select * from currency_master";
						$rowba=mysql_query($sqlba);
						while($resultba=mysql_fetch_array($rowba)) {
								if($resultba['currency_default']==$rowC['currency_default']){
																
						?>
						<option value="<?php echo $resultba['currency_code'];?>" selected><?php echo $resultba['currency_code'];?></option>
									<?php }else{?>
						<option value="<?php echo $resultba['currency_code'];?>"><?php echo $resultba['currency_code'];?></option>
						<?php }} ?>		
					</select>
				</td>
			</tr>
	<tr>
		<td width="180" >NSN No * :</td>
		<td>
		<input name="nsn_no" id="nsnnumber" type="text" onkeyup="nsnBlur();"/>
		<div id="suggesstion-box"></div>
		</td>
	</tr>

<?php
	$sql=mysql_query("select * from unsuccessful_quotes");
	$row=mysql_fetch_array($sql);
	$nsn_no=$row['nsn_no'];
?>
	<tr>
		<td width="180" >NSN Previous Status *:</td>
		<td>
			<input name="perior_status" id="perior_status" type="text" class="textbox fstChUPPRCase" readonly />
		</td>
	</tr>
	<tr>
		<td width="180" >Inspection Place:</td>
		<td>
			<select class="drop-down fstChUPPRCase" name="inspec_place" id="inspec_place">
				<option value="">--Select--</option>
				<option value="origin">Origin</option>
				<option value="destination">Destination</option>
			</select>
		</td>
	</tr>
	<tr>
		<td width="180" >FOB:</td>
		<td><select class="drop-down fstChUPPRCase" name="fob" id="fob">
				<option value="">--Select--</option>
				<option value="origin">Origin</option>
				<option value="destination">Destination</option>
		</select></td>
	</tr>
	
			
			
		</table>
		</div>
		<div class="" >
		<table style="width:50%;border-left:1px solid #ddd;" class="table">
			
			<tr>
				<td width="180" >Qty Req:</td>
				<td ><input name="qty" id="qty" type="text" data-validation="required" class="input validate[required,custom[integer]] textbox"/></td>
			</tr>
			<tr>
				<td width="180" >Req Days :</td>
				<td><input name="req_days" id="req_days" type="text" data-validation="required" class="input validate[required,custom[integer]] textbox"/></td>
			</tr>
			<tr>
				<td width="180" >Days Possible :</td>
				<td ><input name="days_possible" id="days_possible" type="text" data-validation="required" class="input validate[required,custom[integer]] textbox"/></td>
			</tr>
			<tr>
				<td width="180" >Unit of Issue (U/I):</td>
				<td >
				<select name="unit_issue" id="unit_issue" style="" onChange="selPartNo();">
		<option value="">--Select--</option>
		<?php
		 $sqle="select uoi_code from unitof_issue";
		$rowe=mysql_query($sqle);
		while($resulte=mysql_fetch_array($rowe)) { 
			?>
			<option value="<?php echo $resulte['uoi_code'];  ?>"><?php  echo $resulte['uoi_code']; ?></option>
		<?php  }  ?>
		</select>
		</td>
			</tr>
			
			<tr>
				<td width="180" >Rate *:</td>
				<td ><input name="quote_rate" id="quote_rate" type="text" data-validation="required" class="input validate[required,custom[number]] textbox" onblur="selqtRate();"/></td>
			</tr>
			<tr>
				<td width="180" >Amount *:</td>
				<td ><input name="quote_amt" id="quote_amt" type="text" data-validation="required" class="input validate[required,custom[number]] textbox"  onblur="checkitemcode()" readonly /></td>
			</tr>
			<tr>
		<td width="180" >Quote# :</td>
		<td><input name="quote_number" id="quote_number" type="text" class="textbox codesUPPERCase" readonly /></td>
	</tr>
						
		</table>
	</div>
</div>


<table style="border-left:1px solid #ddd;" class="table">
	<tr>
		<td>
<div style="text-align:center;">
	<button type="submit" id="add" class="button_example bnkSbt" style="font-weight: bold;" onClick="return frmValid();"><img src="../images/save-icon.png" class="sbtBtnImg"/>&nbsp;&nbsp;Submit</button>
		
		<a href="view-quotation-master.php"><button type="button" id="update" class="button_example bnkSbt" style="font-weight: bold;" onclick="return checkPropertyMasterq();"><img src="../images/view.png" class="sbtBtnImg"/>&nbsp;&nbsp;View</button></a>
		
		<button type="reset" id="rest" class="button_example" style="font-weight: bold;" onclick="cancel_ed()"><img src="../images/clear.png" class="sbtBtnImg"/>&nbsp;&nbsp;Clear</button>
		
		<a href="<?php echo $home_path; ?>/dashboard.php"><button type="button" id="exit" name="exit" class="button_example" style="font-weight: bold;" ><img src="../images/cancel.png" class="sbtBtnImg" style="width:25px;height:25px;"/>&nbsp;&nbsp;Exit</button></a>
		
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
				scrollSpeed: 1800,
				easingType: 'linear' 
			};
			
			
			$().UItoTop({ easingType: 'easeOutQuart' });
			
		});
	</script>
		 <a href="#" id="toTop" style="display: none;"><span id="toTopHover" style="opacity: 1;"></span></a>

	 <script type="text/javascript" src="<?php echo $home_path; ?>/js/bootstrap-3.1.1.min.js"></script>

</body>
</html>