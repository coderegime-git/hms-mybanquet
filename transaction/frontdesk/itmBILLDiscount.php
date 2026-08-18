<?php
ob_start();
/* include("../../config.php"); */


$home_path='http://localhost:8081/mypos';
$connection_1 = mysql_connect("localhost", "root", "") or die(mysql_error());
mysql_select_db("mypos", $connection_1) or die(mysql_error()); 

 $connection_2 = mysql_connect("localhost", "root", "") or die(mysql_error());
 mysql_select_db("hms", $connection_2) or die(mysql_error()); 
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
	outlet=$('#outlet').val();
	itmcDE=$('#item_name').val();
	itmRate=$('#item_rate').val();
	disv=$('#status_active').val();
	txTot=$('#item_tax').val();
	menTyp=$('#menu_type').val();
	tx=$('#tx').val();
	dis=$('#dis').val();
	sub=$('#sub').val();
	gnd=$('#gnd').val();
$.ajax({
		type:'GET',
		url:'  ../../action/selOPenItemInsert.php',
		data:{
		outlet:outlet,
		itmcDE:itmcDE,
		itmRate:itmRate,
		disv:disv,
		txTot:txTot,
		tx:tx,
		dis:dis,
		sub:sub,
		gnd:gnd
		},
		success:function(data){
			/*  alert(data);  */
		gnd=parseFloat(data)+parseFloat(sub)+parseFloat(itmRate);
		/* alert(itmRate); */
		sb=parseFloat(itmRate)+parseFloat(sub);
		/* alert(sb); */
		$('#grandTotal').val(gnd);
		$('#subTotal').val(sb);
		$('#txTotal').val(data);
		cntT=document.getElementById("cntT").value; 
		
			var txtName = window.opener.document.getElementById("item_code"+cntT); 
			var txtDesc = window.opener.document.getElementById("item_desc"+cntT); 
			var txtQty = window.opener.document.getElementById("item_qty"+cntT); 
			var txtrt = window.opener.document.getElementById("item_rate"+cntT); 
			var txtVl = window.opener.document.getElementById("item_val"+cntT); 
			var dsl = window.opener.document.getElementById("open_dis"+cntT); 
			var dscAt = window.opener.document.getElementById("kot_lnedsvl"+cntT); 
			var strC = window.opener.document.getElementById("strCode"+cntT); 
			var mnTp = window.opener.document.getElementById("menu_type"+cntT); 
			var lntx = window.opener.document.getElementById("lineTax"+cntT); 
			
			var subTt = window.opener.document.getElementById("sub_total"); 
			var disTt = window.opener.document.getElementById("dis_total"); 
			var grndTt = window.opener.document.getElementById("grnd_tot"); 
			var txTt = window.opener.document.getElementById("tax_total"); 
			
		/* 	txtName.value = itmcDE; */
            txtDesc.value = itmcDE;
           /*  txtQty.value = '1'; */
            txtrt.value = itmRate;
            txtVl.value = itmRate;
            dsl.value = disv;
            strC.value = txTot;
            mnTp.value = menTyp;
            lntx.value = data;
            dscAt.value = disv;
			
            subTt.value = sb;
            grndTt.value = gnd;
          /*   txTt.value = data; */
			
			txtQty.focus();
			
			top.open('','_self',''); top.close();
		
		
		}
		}); 
}		
		
</script>
<div class="col-sm-4">
<form id="hotelDefi" name="hotelDefi" enctype="multipart/form-data"  action="#" method="post" class="" style="">	

<table style="width:100%;margin:0 0 15px -5px;text-align:center;font-size:12px;">
	<tr class="info">
	
		<td colspan="13" style="text-align:center;"><h3 style="text-align:center;font-size:14px;padding:10px;background:#7B0E0E;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>Discount Reason</b></h3><b></b></td>
	</tr>
</table>
	
<table style="width:100%;margin:20px 0 0 0;" cellpadding="0" cellspacing="0" class="table" border="0" >
<tbody>

<tr>
<td style="width:54px;" valign="top"><label style="margin:3px 0 0 0;">Discount</label></td>
<td valign="top" style="width:50px;"><input type="text" name="disc_type" id="disc_type" style="" readonly />
</td>
</tr>
<tr>
<td style="width:54px;" valign="top"><label style="margin:3px 0 0 0;">Percentage</label></td>
<td valign="top" style="width:50px;"><input type="text" name="disc_amt" id="disc_amt" style="" readonly /></td>
</tr>
<tr>
<td style="width:54px;" valign="top"><label style="margin:3px 0 0 0;">Reason</label></td>
<td valign="top" style="width:50px;"><input type="text" name="reason" id="reason" style=""/></td>
</tr>

<tr>
<td style="width:54px;" valign="top"><label style="margin:3px 0 0 0;">Authorized By</label></td>
<td valign="top" style="width:50px;"><input type="text" name="authorized_by" id="authorized_by" style=""/></td>
</tr>

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
	
					