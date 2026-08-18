<?php
ob_start();
 include("../../config.php"); 


/* $home_path='http://192.168.2.51:8081/mypos';
$connection_1 = mysql_connect("localhost", "root", "") or die(mysql_error());
mysql_select_db("mypos", $connection_1) or die(mysql_error()); 

 $connection_2 = mysql_connect("localhost", "root", "") or die(mysql_error());
 mysql_select_db("hms", $connection_2) or die(mysql_error()); */
  /* include("../../header.php");  */
 
?>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); } </script>
<link href="<?php echo $home_path; ?>/css/bootstrap.css" rel='stylesheet' type='text/css' />
<link rel="stylesheet" type="text/css" href="<?php echo $home_path; ?>/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo $home_path; ?>/css/ie.css">
<link rel="stylesheet" href="<?php echo $home_path; ?>/css/flexslider.css" type="text/css" media="screen" />

<script type="text/javascript" src="<?php echo $home_path; ?>/js/jquery-1.11.1.min.js"></script>


<script src="<?php echo $home_path; ?>/js/shortcut.js" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo $home_path;?>/fm-valid/src/js/jquery.validVal.js"></script>
<script type="text/javascript" src="<?php echo $home_path;?>/fm-valid/src/js/jquery.validVal-customValidations.js"></script>
<script type="text/javascript" src="<?php echo $home_path;?>/fm-valid/src/js/jquery.validVal-debugger.js"></script>
<style>
label{
	float:right;
	font-size:12px;
	color:#000;
	width:100px;
}
</style>

<script type="text/javascript">
$(document).ready(function(){
	
	$('form input').keydown(function(e){
             if(e.keyCode==13){       

                if($(':input:eq(' + ($(':input').index(this) + 1) + ')').attr('type')=='submit'){// check for submit button and submit form on enter press
                 return true;
                }

                $(':input:eq(' + ($(':input').index(this) + 1) + ')').focus();

               return false;
             }
			 
			if (e.keyCode == 39) {      
				$(':input:eq(' + ($(':input').index(this) + 1) + ')').focus();

			}
			if (e.keyCode == 37) {      
				$(':input:eq(' + ($(':input').index(this) - 1) + ')').focus();

			}
		});
			
			
			
	$('#item_name').focus();
	$('form[name="hotelDefi"]').validVal().validValDebug();
	$('form[name="hotelDefi"]').validVal();
	
});

function checkForm(){
	itmcDE=$('#item_name').val();
	itmRate=$('#item_rate').val();
	menTyp=$('#menu_type').val();
	itmTx=$('#item_tax').val();
	cntT=$('#cntT').val();
	if(itmcDE==""){
		alert("Please enter item name.");
	}else if(itmRate==""){
		alert("Please enter item rate.");
	}else if(menTyp==""){
		alert("Please select Menu Type.");
	}else if(itmTx==""){
		alert("Please select Item tax.");
	}else {		
			var txtDesc = window.opener.document.getElementById("item_desc"+cntT); 
			var txtrt = window.opener.document.getElementById("item_rate"+cntT); 
			var mnTp = window.opener.document.getElementById("menu_type"+cntT); 
			var sCode = window.opener.document.getElementById("sCode"+cntT); 
			
			/* var strC = window.opener.document.getElementById("strCode"+cntT); 
			var strCc = window.opener.document.getElementById("MNUgP"+cntT);  */
			
			txtDesc.value = itmcDE;
            txtrt.value = itmRate;
			mnTp.value = menTyp;
            sCode.value = itmTx;
			
			self.close();
	}
}		
		
</script>
<div class="col-sm-4">
<form id="hotelDefi" name="hotelDefi" enctype="multipart/form-data"  action="#" method="post" class="" style="">	

<table style="width:100%;margin:0 0 15px -5px;text-align:center;font-size:12px;">
	<tr class="info">
	
		<td colspan="13" style="text-align:center;"><h3 style="text-align:center;font-size:14px;padding:10px;background:#7B0E0E;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>Open Item</b></h3><b></b></td>
	</tr>
</table>
	
<table style="width:100%;margin:20px 0 0 0;" cellpadding="0" cellspacing="0" class="table" border="0" >
<tbody>

<tr>
<input name="cntT" id="cntT" type="hidden" value="<?php echo $_GET['cnt']; ?>"/>
<input name="outlet" id="outlet" type="hidden" value="<?php echo $_GET['out']; ?>"/>
<input name="tx" id="tx" type="hidden" value="<?php echo $_GET['tx']; ?>"/>
<input name="dis" id="dis" type="hidden" value="<?php echo $_GET['dis']; ?>"/>
<input name="sub" id="sub" type="hidden" value="<?php echo $_GET['sub']; ?>"/>
<input name="gnd" id="gnd" type="hidden" value="<?php echo $_GET['gnd']; ?>"/>

<input name="txTotal" id="txTotal" type="hidden" value=""/>
<input name="disTotal" id="disTotal" type="hidden" value=""/>
<input name="subTotal" id="subTotal" type="hidden" value=""/>
<input name="grandTotal" id="grandTotal" type="hidden" value=""/>



	<td style="width:54px;" valign="top"><label style="margin:3px 0 0 0;">Item Name</label></td>
	<td valign="top" style="width:50px;"><input name="item_name" id="item_name" type="text" class="input required textbox" style="" value=""/>
	 </td>
	</tr>
	<tr>
	<td style="width:122px;" valign="top"><label style="">Item Rate</label></td>
	<td valign="top" style="width:50px;"><input name="item_rate" id="item_rate" type="text" class="input required textbox fstChUPPRCase tblImg"  style="width:63px;" value="" /><span style="font-size:12px;">Group</span>
			<?php $sqlRt=mysql_query("select distinct grpcode,grpname from bq_grpcode");?>
			<select name="menu_type" id="menu_type" class="input required textbox fstChUPPRCase tblImg" style="width:79px;float:none;">
			<option value="">--Select--</option>
			<?php while($rowRt=mysql_fetch_array($sqlRt)){?>
			<option class="codesUPPERCase" value="<?php echo $rowRt['grpcode'];?>" ><?php echo $rowRt['grpname'];?></option>
			<?php } ?>
			</select>
	</td>
	</tr>
	<tr>
		<td style="width:122px;" valign="top"><label style="">Tax</label></td>
		<td valign="top" style="width:50px;">
			<?php $sqlRt=mysql_query("select distinct str_code,description from bq_taxstruct where status='1'");?>
			<select name="item_tax" id="item_tax"  class="input required textbox fstChUPPRCase tblImg" onchange="submenuCat();" style="">
			<option value="">--Select--</option>
			<?php while($rowRt=mysql_fetch_array($sqlRt)){?>
			<option class="codesUPPERCase" value="<?php echo $rowRt['str_code'];?>" ><?php echo $rowRt['description'];?></option>
			<?php } ?>
			</select>
			<!--&nbsp;&nbsp;<label style="">Disc&nbsp;<input name="disval" id="disval" type="checkbox" class="" style=""  /></label>-->
							
		</td>
	</tr>
	
	<tr>
	<td style="width:122px;" valign="top"><label style="">Disc</label></td>
	<td width="" valign="top"><input type="radio" name="disval" id="status_active" value="1"  class="textbox fstChUPPRCase" style="width:10px;margin:3px 0 0 0;" checked /><span style="font-size:12px;">Yes</span>
	<input name="disval" id="status_passive" type="radio" value="0" style="width:10px;margin:3px 0 0 0;"/><span style="font-size:12px;">No</span>
	</td>
	</tr>
	
	<!--<tr>
		<td style="width:122px;" valign="top"><label style="">Kitchen</label></td>
		<td valign="top" style="width:50px;">
			<?php $sqlRt=mysql_query("select distinct kitc_code,kitc_desc from mypos.pos_kitchen");?>
			<select name="kitchen" id="kitchen" class="input required textbox fstChUPPRCase tblImg" onchange="submenuCat();">
			<option value="">--Select--</option>
			<?php while($rowRt=mysql_fetch_array($sqlRt)){?>
			<option class="codesUPPERCase" value="<?php echo $rowRt['kitc_code'];?>" ><?php echo $rowRt['kitc_desc'];?></option>
			<?php } ?>
			</select>
		</td>
	</tr>-->
</table>

<div style="text-align:center;margin: 0 0 0 80px;">
	<table style="width:86%;" class="table">
	<tr>
		<td>	
		<button type="button" id="add" class="button_example bnkSbt frstChr" style="" onclick="checkForm();"><img src="../../images/saves.png" class="sbtBtnImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">S</span>ubmit</button>
		</td>
		<td>
		<button type="button" id="exit" name="exit" class="button_example" style="" onclick="self.close();"><img src="../../images/exitBut.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button>	
	</td>
	</tr>
	</table>
</div>
</form>	
	
					