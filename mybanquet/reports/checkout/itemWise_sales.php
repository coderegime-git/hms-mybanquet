<?php
ob_start();
include("../../config.php");
include("../../header.php");
?>
 
<style>
label {width: 205px; padding:0 20px 0 20px; display: inline-block;font-weight: bold;color: #000;font-size:12px; } 
   
input[type=text], textarea{
 height:26px;
}
.table td {text-align:center;} 

  #searchTxt{
	background
	:url("../../images/search.png") no-repeat scroll right center #FFFFFF;
	}
</style>	
<script src="<?php echo $home_path;?>/date-picker/jquery-ui.js"></script>
<link rel="stylesheet" href="<?php echo $home_path;?>/date-picker/jquery-ui.css">
<script>
$(document).ready(function(){

	$(".datepicker" ).datepicker({
	changeMonth:true,
	changeYear:true,
	yearRange:"-2:+1",
	/* minDate: 0, */
	dateFormat:"dd/mm/yy"
	});

	$(".datepicker1" ).datepicker({
	changeMonth:true,
	changeYear:true,
	yearRange:"-2:+1",
	/* minDate: 0, */
	dateFormat:"dd/mm/yy"
	});
	
 $(':checkbox').click(function(e){
	if($("input:checked").length>0){
	$('#print').show();
	}else{
	$('#print').hide();
	}
});

$('#searchBtn').click(function(){
	fromdate=$('#from_date').val();
	todate=$('#to_date').val();
	val=$('#searchTxt').val();
	/* if(fromdate!="" && todate!="" && val!="")
	{ */
	document.location="itemWise_sales.php?fromdate="+fromdate+"&todate="+todate+"&val="+val;
	/* } */

	/* item="?val="+$('#searchTxt').val();
	document.location.href="itemWise_sales.php"+item; */
	}); 
	
	
jQuery("#roommaster").validationEngine();
$(".ckPrint").show();

});


function setPrint(id,val)
		{	
			if($("#"+id).is(":checked"))
			{  
					$('.ckPrint').each(function(){
					a_id=this.id.split('_');
					if($(this).attr('id') != id)
					{
						$(this).attr("disabled",true);
						$("#ed"+a_id[1]).attr("style","display:none");
					}
				});
			}
			else
			{
				$('.ckPrint').each(function(){
					a_id=this.id.split('_');
					$(this).removeAttr("disabled");
					$("#ed"+a_id[1]).attr("style","display:inline");
				});
			}
		}



function popupBillPrint()
{
	val=$('.ckPrint:checkbox:checked').val();
	newwindow=window.open('<?php echo $home_path;?>/transaction/view/bill-print-pdout.php?billNo='+val,"_blank",'scrollbars=1,menubar=0,resizable=1,width=1000,height=700');
	newwindow.focus(); 
}
function printPage(){
			/* $(".ckPrint").hide(); */
			 /* $('.ckPrint').delay(5000).hide(0);  */ 
			$('.ckPrint').hide().delay(3000).show(0);
			$('.Ckk').hide().delay(3000).show(0);	
			$('.dispSHw').show().delay(1000).hide(0);				
			var divContents = $("#dvContainer").html();
		    var printWindow = window.open('', '', 'height=400,width=800');
            printWindow.document.write('<html><head><title>DIV Contents</title>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print(); 
}
/* function showsales() { */
/* function clkSubmit() {
fromdate=$('#from_date').val();
todate=$('#to_date').val();
out=$('#outlet').val();
mnuTy=$('#menu_type').val();
kotTy=$('#kot_type').val();
if(fromdate!="" && todate!="")
{
	document.location="itemWise_sales.php?fromdate="+fromdate+"&todate="+todate+"&mnuTy="+mnuTy+"&out=All";
}

} */

/* function showMnuType(){ */
/* function clkSubmit(){
fromdate=$('#from_date').val();
todate=$('#to_date').val();
mnuTy=$('#menu_type').val();
out=$('#outlet').val();
kotTy=$('#kot_type').val();
if(fromdate!="" && todate!="" && mnuTy!="" )
{

	document.location="itemWise_sales.php?fromdate="+fromdate+"&todate="+todate+"&mnuTy="+mnuTy+"&out="+out;
}
} */

/* function showOUTlet(){ */
function clkSubmit(){
fromdate=$('#from_date').val();
todate=$('#to_date').val();
out=$('#outlet').val();
kotTy=$('#kot_type').val();
mnuTy=$('#menu_type').val();
if(fromdate!="" && todate!="")
{

	document.location="itemWise_sales.php?fromdate="+fromdate+"&todate="+todate+"&mnuTy="+mnuTy+"&out="+out;
}
}

 function showKotType() { 

	fromdate=$('#from_date').val();
	todate=$('#to_date').val();
	kotTy=$('#kot_type').val();
	out=$('#outlet').val();
	mnuTy=$('#menu_type').val();
	if(fromdate!="" && todate!="" && kotTy!="")
	{
		document.location="itemWise_sales.php?fromdate="+fromdate+"&todate="+todate+"&kotTy="+kotTy;
	}
} 



</script>
<body class="bgBODY">
<form id="taxTypes" name="taxTypes" class="" style=""> 
<div class="" style="">	


<table style="left:0;width:100%;">	
<tr>
<!--<td> <button type="button" id="print" style="display:none;margin:10px 0 -3px 145px;" class="submitbtnprint btnn" onclick="popupBillPrint()">Print</button></td>-->

<td><label style="width:80px;"><b>From :</b></label></td>
<td>
	<input name="from_date" style="width:100px;margin-bottom:0px;text-align:center;" type="text" class="textbox datepicker" id="from_date"   value="<?php if(isset($_GET['todate'])){ echo $_GET['fromdate'];}?>" onChange="showsales()" placeholder="From Date"/>
</td>

<td><label style="width:70px;"><b>To :</b></label></td>
<td style="width:80px;">
	<input name="to_date" style="width:100px;margin:0px 3px 0 0;text-align:center;" type="text" class="textbox datepicker1" id="to_date"  value="<?php if(isset($_GET['todate'])){ echo $_GET['todate'];}?>" onChange="showsales()" placeholder="To Date"/>
</td>

<td><label style="width:120px;"><b>Menu Type :</b></label></td>
<td>
	<?php $sqlRt=mysql_query("select grpcode,grpname from bq_grpcode");?>
	<select name="menu_type" id="menu_type" style="width:90px;margin:0 0 0 -26px" onChange="showMnuType()">
	<option value="">--select--</option>
	<option value="All"<?php if(isset($_GET['mnuTy'])) { echo ($_GET['mnuTy']=='All')?'selected':'';} ?>>All</option>
	<?php while($rowRt=mysql_fetch_array($sqlRt)) { ?>
	<?php if($rowRt['grpcode']==$_GET['mnuTy']) { ?>
	<option class="codesUPPERCase" value="<?php echo $rowRt['grpcode'];?>" selected ><?php echo $rowRt['grpname'];?></option>
	<?php } else { ?>
	<option class="codesUPPERCase" value="<?php echo $rowRt['grpcode'];?>"><?php echo $rowRt['grpname'];?></option>
	<?php } } ?>
	</select>
	<input name="submt" style="margin:0 0 0 20px;" type="button" id="submt"  class="btnH" value="Display" onClick="clkSubmit()" />
</td>


<td>
	<input type="button" value="Print" class="myButsprn" onclick="printPage();" style="margin:0 0 0 10px;font-weight: bold;padding: 5px;">
</td>

<td>
	<a href="<?php echo $home_path ?>/reports/checkout/xt_viewBQTITEMWisesales.php?fromdate=<?php echo $_GET['fromdate']?>&todate=<?php echo $_GET['todate']?>&mnuTy=<?php echo $_GET['mnuTy']?>" style="margin:0px 0 0 25px;color:#000;font-size:13px;font-weight:bold;"><button type="button" id="pdf" style="margin:0 0 0 0px;" class="myButeXL btnn"><img src="../../images/excel1.png"  class="sbtBtnImg"/>&nbsp;Export&nbsp;</button></a>
</td>
	
</tr>
</table>
<?php
$sql=mysql_query("select * from property_definition where propdef_id='1'");
$row=mysql_fetch_array($sql);
$prop_name=$row['prop_name'];
$city=$row['city'];
$phone=$row['phone'];

?>
<div style="" >
<table class="table table-condensed table-hover table-striped table-bordered" cellpadding="0" cellspacing="0" border="0" class="table" style="margin:0px 0 0px 0px;text-align:center;font-size:12px;width:99%;">
	<tr class="info">
	
	<td colspan="9" style="text-align:center;"><h3 class="viewDTT"><b>ITEM WISE SALES REPORT from <?php if(isset($_GET['fromdate'])){echo $_GET['fromdate']; } ?> to <?php if(isset($_GET['todate'])){echo $_GET['todate']; } ?></b></h3><b></b></td>
	</tr>
</table>

<div style="" class="">
<div class="scrollingtable frmCentrR" id="dvContainer" style="padding:0px 0 0 0;width:100%;">
 <div >
 <div >
<table border="1" cellpadding="0" cellspacing="0" style="text-align:center;font-size:12px;">
<thead  >
		<tr>
		<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;background-color:#7B0E0E;color:#fff;width:10%;"><div label="Sl.no" ></div></th>
		<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;background-color:#7B0E0E;color:#fff;width:10%;"><div label="Date" ></div></th>
		<th class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;background-color:#7B0E0E;color:#fff;width:10%;"><div label="Bill no" ></div></th>
		<th  class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;background-color:#7B0E0E;color:#fff;width:10%;"><div label="Code" ></div></th>
		<th  class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;background-color:#7B0E0E;color:#fff;width:15%;"><div label="Name" ></div></th>
		<th  class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;background-color:#7B0E0E;color:#fff;width:20%;"><div label="Qty" ></div></th>
		<th  class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;background-color:#7B0E0E;color:#fff;width:15%;"><div label="Rate" ></div></th>
		<th  class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;background-color:#7B0E0E;color:#fff;width:15%;"><div label="Disc" ></div></th>
		<th  class="codesUPPERCase" style="text-align:center;background-color:#F5F5F5;background-color:#7B0E0E;color:#fff;width:10%;"><div label="Total" ></div></th>
	
	
	</tr>
</thead>
<thead class="dispSHw" style="display:none;">
<tr >
	<td colspan="9" style="text-align:center;font-size:14px;font-weight:bold;"><?php echo $prop_name.', '.$city; ?></td>
</tr>
<tr>
	<td colspan="9" style="text-align:center;"><h3 class="viewDT"><b>ITEM WISE SALES REPORT from <?php if(isset($_GET['fromdate'])){echo $_GET['fromdate']; } ?> to <?php if(isset($_GET['todate'])){echo $_GET['todate']; } ?></b></h3><b></b></td>
</tr>
<tr>
	<th width="40" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Sl.no</th>
	<th width="40" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Date</th>
	<th width="40" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Bill no</th>
	<th width="110" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Code</th>
	<th width="110" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Name</th>
	<th width="110" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Qty</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Rate</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Disc</th>
	<th width="80" style="text-align:center;background-color:#F5F5F5;border:1px solid #000;">Total</th>
	
</tr>
</thead>
<tbody>

<?php

$lnTt=0;$lnQy=0;$lnDt=0;$txAT=0;$txATT=0;$itemqty=0;$itemrate=0;$discamt=0;$item_total=0;
$fr=explode('/',$_GET['fromdate']);
$frm=$fr[2].'-'.$fr[1].'-'.$fr[0];

$to=explode('/',$_GET['todate']);
$tod=$to[2].'-'.$to[1].'-'.$to[0];
if($_GET['mnuTy']!='All' && $_GET['mnuTy']!='' ){
	$sq=mysql_query("select * from bq_grpcode where grpcode='".$_GET['mnuTy']."'");
}else{
	$sq=mysql_query("select * from bq_grpcode");
}

while($rwp=mysql_fetch_array($sq)) {
$x=0;
if(isset($_GET['fromdate'],$_GET['todate']) && isset($_GET['mnuTy'])) {
$item_where=" where str_to_date(bill_date,'%d/%m/%Y') >= '$frm' AND str_to_date(bill_date,'%d/%m/%Y') <= '$tod' AND grpcode='".$rwp['grpcode']."' AND bill_status!='3'";
$sql=mysql_query("select * from bq_opbillhdtl $item_where");
}
$nmR=mysql_num_rows($sql);
if(mysql_num_rows($sql)>0){
$itemqtyy=0;$itemratee=0;$discamtt=0;$item_totall=0;
?>
<tr>
<td style="text-align:left;width:120px;color:#FF0034;font-weight:bold;" colspan="6"><?php echo strtoupper($rwp['grpname']); ?></td>
</tr>
<?php  

while($row=mysql_fetch_array($sql)){
$x++;

$itemqty+=$row['itemqty'];
$itemrate+=$row['itemrate'];
$discamt+=$row['discamt'];
$item_total+=$row['item_total'];

$itemqtyy+=$row['itemqty'];
$itemratee+=$row['itemrate'];
$discamtt+=$row['discamt'];
$item_totall+=$row['item_total'];

?>	
	<tr>
		<td width="" class="fstChUPPRCase" style="text-align:center;width:30px;"><?php echo $x; ?></td>
		<td width="" class="fstChUPPRCase" style="text-align:left;width:100px;"><?php echo $row['bill_date']; ?></td>
		<td width="" class="fstChUPPRCase" style="text-align:left;width:100px;"><?php echo $row['bill_no']; ?></td>
		<td width="" class="fstChUPPRCase" style="text-align:left;width:100px;"><?php echo $row['itemcode']; ?></td>
		<td width="" class="fstChUPPRCase" style="text-align:left;width:220px;"><?php echo $row['itemname']; ?></td>
		<td width="" class="fstChUPPRCase" style="text-align:right;width:120px;"><?php echo $row['itemqty']; ?></td>
		<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;"><?php echo $row['itemrate']; ?></td>
		<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;"><?php echo $row['discamt']; ?></td>
		<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;"><?php echo $row['item_total']; ?></td>
	</tr>
<?php } } ?>
<?php if($x=$nmR) { ?>
<tr>
		<td width="" class="fstChUPPRCase" style="text-align:center;width:30px;">&nbsp;</td>
		<td width="" class="fstChUPPRCase" style="text-align:left;width:100px;">&nbsp;</td>
		<td width="" class="fstChUPPRCase" style="text-align:left;width:100px;">&nbsp;</td>
		<td width="" class="fstChUPPRCase" style="text-align:left;width:100px;">&nbsp;</td>
		<td width="" class="fstChUPPRCase" style="text-align:left;width:220px;font-weight:bold;">Total</td>
		<td width="" class="fstChUPPRCase" style="text-align:right;width:120px;font-weight:bold;"><?php echo sprintf("%01.2f",$itemqtyy); ?></td>
		<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;font-weight:bold;"><?php echo sprintf("%01.2f",$itemratee); ?></td>
		<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;font-weight:bold;"><?php echo sprintf("%01.2f",$discamtt); ?></td>
		<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;font-weight:bold;"><?php echo sprintf("%01.2f",$item_totall); ?></td>
	</tr>

<?php } } ?>		

<tr>
		<td width="" class="fstChUPPRCase" style="text-align:center;width:30px;">&nbsp;</td>
		<td width="" class="fstChUPPRCase" style="text-align:left;width:100px;">&nbsp;</td>
		<td width="" class="fstChUPPRCase" style="text-align:left;width:100px;">&nbsp;</td>
		<td width="" class="fstChUPPRCase" style="text-align:left;width:100px;">&nbsp;</td>
		<td width="" class="fstChUPPRCase" style="text-align:left;width:220px;font-weight:bold;">Grand Total</td>
		<td width="" class="fstChUPPRCase" style="text-align:right;width:120px;font-weight:bold;"><?php echo sprintf("%01.2f",$itemqty); ?></td>
		<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;font-weight:bold;"><?php echo sprintf("%01.2f",$itemrate); ?></td>
		<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;font-weight:bold;"><?php echo sprintf("%01.2f",$discamt); ?></td>
		<td width="" class="fstChUPPRCase" style="text-align:right;width:100px;font-weight:bold;"><?php echo sprintf("%01.2f",$item_total); ?></td>
	</tr>
	
	
</tbody>	
</table>
	</div>
	</div>
	</div>

</div>
</body>
 </form>