<?php
ob_start();
include("../../config.php");
include("../../header.php");
?>
   <link rel="stylesheet" href="<?php echo $home_path;?>/css/jquery-ui.css">
   <script src="<?php echo $home_path;?>/js/jquery-ui.js"></script>
   
   <script>
	var item_codes;
	
	var arr=new Array();
	<?php $result = mysql_query("select * from bq_itemmaster where status='1' group by item_code") ;?>
	<?php $str=""; $i=0; 
		$k=0;
		$tmpStr="";
	while($row = mysql_fetch_array( $result )) {
		$item_qty='1';
		$itemVal=floatval($row['item_rate']*$item_qty);
		?>
		
	  arr[<?php echo $i;?>]=new Array();
	  arr[<?php echo $i;?>][0]='<?php echo $row['item_code']; ?>';
	  arr[<?php echo $i;?>][1]='<?php echo strtoupper($row['item_name']); ?>';
	  arr[<?php echo $i;?>][2]='<?php echo $row['item_rate']; ?>';
	  arr[<?php echo $i;?>][3]='<?php echo $item_qty; ?>';
	  arr[<?php echo $i;?>][4]='<?php echo $itemVal; ?>';
	  arr[<?php echo $i;?>][5]='<?php echo $row['tax_struc']; ?>';
	  arr[<?php echo $i;?>][6]='<?php echo $row['menu_type']; ?>';
	  
	  <?php if($i==0) { 
		$str="'".$row['item_code']."'";
	   }else{	
		$str=$str.",'". $row['item_code']."'";
      }?>	 
	  
	  	  
	 <?php $i++; } ?>	
	
	item_codes=<?php echo ("[" . $str. "]") ?>;
	
	
	var itemdes;
	var arr_desc=new Array();
	<?php $result = mysql_query("select * from bq_itemmaster where status='1' group by item_code") ;?>
	<?php $str=""; $i=0; 
		$k=0;
		$tmpStr="";
	while($row = mysql_fetch_array( $result )) {
		$item_qty='1';
		$itemVal=floatval($row['item_rate']*$item_qty);
		?>
		
	  arr_desc[<?php echo $i;?>]=new Array();
	  arr_desc[<?php echo $i;?>][0]='<?php echo $row['item_name']; ?>';
	  arr_desc[<?php echo $i;?>][1]='<?php echo $row['item_code']; ?>';
	  arr_desc[<?php echo $i;?>][2]='<?php echo $row['item_rate']; ?>';
	  arr_desc[<?php echo $i;?>][3]='<?php echo $item_qty; ?>';
	  arr_desc[<?php echo $i;?>][4]='<?php echo $itemVal; ?>';
	  arr_desc[<?php echo $i;?>][5]='<?php echo $row['tax_struc']; ?>';
	  arr_desc[<?php echo $i;?>][6]='<?php echo $row['menu_type']; ?>';
		 
	  <?php if($i==0) { 
		$str="'".$row['item_name']."'";
	   }else{	
		$str=$str.",'". $row['item_name']."'";
      }?>	 
	  
	  	  
	 <?php $i++; } ?>	
	
	itemdes=<?php echo ("[" . $str. "]") ?>;	
</script> 

 



<style>
.buttexample {
background-color: #ffffff;
border: 1px solid #ddd;
color: #000;
font-family: arial,helvetica,sans-serif;
font-size: 12px;
margin-left: -3px;
padding: 4px 41px;
}

.sbtBImg{
	width:18px;
	height:18px;
	
}

.buttExaSS {
    background-color: #ffffff;
    border: 1px solid #888888;
    color: #000;
    font-family: arial,helvetica,sans-serif;
    font-size: 12px;
   /*  margin-left: -3px; */
    padding: 10px 0px;
    /* padding: 5px 59px; */
	width:184px;
}

.dblMas{
	color: #474747;
    display: block;
    float: right;
    font-size: 12px;
    font-weight: normal;
    padding: 3px 9px 0 0;
}
</style>
<style>
.frmSearch {border: 1px solid #F0F0F0;/* background-color:#C8EEFD; */margin: 2px 0px;/* padding:40px; */}
#country-list{float:left;list-style:none;margin:26px 0 0 0px;padding:0;width:190px;position: absolute;z-index: 1;}
#country-list li{padding: 2px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#country-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;}
</style>

<!---//-form valid---->
<script type="text/javascript">
$(document).ready(function(){
	/* $("#item_desc1").focus(); */
	$("#fp_no").focus();
		totTot =0;
		$(".lineTot").each(function(){
			totTot +=parseFloat($(this).val());
		});
		 $("#sub_total").val(totTot.toFixed(2)); 
		 $("#grnd_tot").val(totTot.toFixed(2)); 
		 
		 
	$("#msgFo").fadeOut(5000);
	$("#msgFoprop").fadeOut(7000);
	$('form[name="hotelDefi"]').validVal().validValDebug();
			$('form[name="hotelDefi"]').validVal();
			
			

$('input[name^=kot_itemcode]').keyup(function(){
rowid=($(this).attr("id")).substr(9);
vl=$(this).val();
out=$("#kot_outlet").val();
tx=$("#tax_total").val();
dis=$("#dis_total").val();
sub=$("#sub_total").val();
gnd=$("#grnd_tot").val();

	if(vl==55555){
		val=$('.ckPrint:checkbox:checked').val();
		newwindow=window.open('<?php echo $home_path;?>/transaction/frontdesk/openItemInsert.php?cnt='+rowid+'&out='+out+'&tx='+tx+'&dis='+dis+'&sub='+sub+'&gnd='+gnd,"_blank",'scrollbars=1,menubar=0,resizable=1,left=500,width=450,height=300');
		newwindow.focus(); 
	}
});



$('input[name^=booking_no]').keyup(function(){
		$("#tax_total").val('');
		$.ajax({
		type:'GET',
		url:'  ../../action/selKOTBookNo.php',
		data:{
		itmcDE:itmcDE,
		
		},
		success:function(data){
			alert(data);
			
			}
		}); 
});	
	
	/* $("#item_code").keyup(function(){
		$.ajax({
		type: "POST",
		url: "../../action/selectItemDetails.php",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#search-box").css("background","#FFF");
		}
		});
	});	 */
	
	document.getElementById("hotelDefi").onkeypress = function(e) {
  var key = e.charCode || e.keyCode || 0;     
  if (key == 13) {
   /*  alert("I told you not to, why did you do it?"); */
    e.preventDefault();
  }
}

			/* $(".vertical").keypress(function(event) {
        if(event.keyCode == 13) { 
        textboxes = $("input.vertical");
        debugger;
        currentBoxNumber = textboxes.index(this);
        if (textboxes[currentBoxNumber + 1] != null) {
            nextBox = textboxes[currentBoxNumber + 1]
            nextBox.focus();
            nextBox.select();
            event.preventDefault();
            return false 
            }
        }
    }); */
	
	$('input[name^=kot_itemqty]').on('blur', function() {
		qtyVal =($(this).val()); 
		itmDs=($(this).parent().prev().find('input').val());
		if(itmDs!='' && qtyVal==''){
			alert('Check the Qty!.');
			/* $(this).parent().prev().find('input').focus(); */ 
			$('#submit').prop('disabled', true);
		}/* else if(qtyVal==0 || qtyVal=='' || qtyVal=='NaN'){
			alert('Check the Qty!.');
			$(this).parent().prev().find('input').focus(); 
			$('#submit').prop('disabled', true);
			
		} */else{
			$('#submit').prop('disabled', false);
		}
	}); 
	
	$('input[name^=item_rate]').on('keyup', function() {
		unitval =parseFloat($(this).val()); 
		qtyVal =parseFloat($(this).parent().prev().find('input').val());
		totAMt=(qtyVal*unitval);
		Amt =parseFloat($(this).parent().next().find('input').val(totAMt));
		ttAmt=parseFloat($(this).parent().next().find('input').val());
		if(isNaN(ttAmt)){ ttAmt=parseFloat($(this).parent().next().find('input').val(0));}
		 lnTT=$(".lineTot").val();
		 if(lnTT=='NaN'){$(".lineTot").val('0');}
	});
	
	 $('input[name^=kot_itemqty]').on('keyup', function() {
		qtyVal =parseFloat($(this).val()); 
		itmcDE=($(this).parent().prev().prev().find('input').val());
		itmDs=($(this).parent().prev().find('input').val());
		unitval =parseFloat($(this).parent().next().find('input').val());
		totAMt=(qtyVal*unitval);
		Amt =parseFloat($(this).parent().next().next().find('input').val(totAMt.toFixed(2)));
		ttAmt=parseFloat($(this).parent().next().next().find('input').val());
		if(isNaN(ttAmt)){ ttAmt=parseFloat($(this).parent().next().next().find('input').val(0));}
		 lnTT=$(".lineTot").val();
		 if(lnTT=='NaN'){$(".lineTot").val('0');}
		totTot =0;
		$(".lineTot").each(function(){
			totTot +=parseFloat($(this).val());
			
		});
		
		if(itmDs!='' && qtyVal==''){
			alert('Check the Qty!.');
			/* $(this).focus(); */ 
			$('#submit').prop('disabled', true);
		}else if(qtyVal<=0){
			alert('Check the Qty!.');
			/* $(this).focus();  */
			$('#submit').prop('disabled', true);
		}else{
			$('#submit').prop('disabled', false);
		}
		
		rw=($(this).attr("id")).substr(8);
		qtyVal =parseFloat($(this).val()); 
		itmcDE=($(this).parent().prev().prev().find('input').val());
		unitval =parseFloat($(this).parent().next().find('input').val());
		strCode=$("#strCode"+rw).val();
		txTot=$("#tax_total").val();
		$("#tax_total").val('');
		outLt=$("#kot_outlet").val();
		$.ajax({
		type:'GET',
		url:'  ../../action/selKOTBillTAXCalc.php',
		data:{
		itmcDE:itmcDE,
		unitval:unitval,
		qtyVal:qtyVal,
		txTot:txTot,
		strCode:strCode,
		outLt:outLt
		},
		success:function(data){
		
			$("#lineTax"+rw).val(data); 
			
		lnTx =0;
		$(".lineTax").each(function(){
			lnTx +=parseFloat($(this).val());
		});
		$("#tax_total").val(lnTx);
		
		tx=parseFloat($("#tax_total").val()); 
		
		 if(tx=='NaN'){$("#tax_total").val('0');}
		
		 dsc=parseFloat($("#dis_total").val()); 
		 gTOT=(totTot+tx);
		 $("#sub_total").val(totTot.toFixed(2)); 
		 $("#grnd_tot").val(gTOT.toFixed(2));
		}
		}); 
		
  }); 
   
   

});

 shortcut.add("Ctrl+S",function() { 
	 $('#hotelDefi').attr('action', '../../action/add_hotel_definition.php');  
	 $('#hotelDefi').submit(); 
}); 
 shortcut.add("Ctrl+V",function() { 
	window.location.href = "view_hotel_definition.php";
});
 shortcut.add("Ctrl+C",function() { 
  $('#hotelDefi').find("input[type=text], textarea").val("");
});
 shortcut.add("Ctrl+E",function() { 
 window.location.href = "../../dashboard.php";
});

function outletOpen(){
	id=$('.ckPrint:checkbox:checked').val();
	newwindow=window.open('<?php echo $home_path;?>/transaction/frontdesk/outletBillMenu.php','mywin','left=280,top=100,width=200,height=200,');
	newwindow.focus();
}

function tableNoOpn(){
	newwindow=window.open('<?php echo $home_path;?>/transaction/frontdesk/outletKotOpn.php','mywin','left=280,top=100,width=200,height=200,');
	newwindow.focus();
}

function stewardOpn(){
	newwindow=window.open('<?php echo $home_path;?>/transaction/frontdesk/outletstewOpn.php','mywin','left=280,top=100,width=200,height=200,');
	newwindow.focus();
	
}

function smCde(cnt){
	newwindow=window.open('<?php echo $home_path;?>/transaction/frontdesk/outletItemCode.php?cnt='+cnt,'mywin','left=280,top=100,width=200,height=200,');
	newwindow.focus();
}

function selectItem(val) {
$("#search-box").val(val);
$("#suggesstion-box").hide();
}

		
		
var rowCount = 14; 
function addMoreRows() {
	$('#rwDis').show();
	paxNo=$('#pax').val();
	var rwTbl = $('#tblRw tr').length;
	rowCount=rowCount+1; 
	rowCunt=rwTbl+1; 
	rowTblCo=0;
	/* alert(rowCunt); */
	var rowTblCo = $('#addedRowsED tr').length+2;
	/* $('#addedRowsED').html(''); */
	/* for(i=0;i<paxNo;i++) { */
		var recRow = '<tr id="rowCount'+rowCount+'"><td width="60"><input name="kot_itemcode[]" id="item_code'+rowCount+'" type="text" class="textbox codesUPPERCase itemCde item_code" style="width:90px;margin:4px 0 0 0;" onblur="kotItmCDE('+rowCount+');"  /></td><td width="" class="codesUPPERCase"><input name="kot_itemdesc[]" id="item_desc'+rowCount+'" type="text" class="textbox codesUPPERCase item_desc" style="width:185px;margin:4px 0 0 0;"  /></td><td width="40" class="fstChUPPRCase"><input name="kot_itemqty[]" id="item_qty'+rowCount+'" type="text" class="textbox codesUPPERCase item_qty" style="width:65px;margin:4px 0 0 0;" onblur="chkItmQTy('+rowCount+');" /></td><td width="" class="fstChUPPRCase"><input name="item_rate[]" id="item_rate'+rowCount+'" type="text" class="textbox codesUPPERCase" style="width:100px;margin:4px 0 0 0;" /></td><td width="50" class="fstChUPPRCase"><input name="kot_itemval[]" id="item_val'+rowCount+'" type="text" class="textbox codesUPPERCase lineTot item_rate" style="width:100px;margin:4px 0 0 0;" value="0" /></td><td width="60" class="fstChUPPRCase"><input name="kot_itempref[]" id="item_pref'+rowCount+'" type="text" class="textbox codesUPPERCase item_pref" style="width:142px;margin:4px 0 0 0;" onkeypress="addMoreRows(this.form);" /></td><td width="60" class="fstChUPPRCase"><input name="kot_no[]" id="kot_no'+rowCount+'" type="text" class="textbox codesUPPERCase" style="width:60px;margin:4px 0 0 0;" readonly /></tr>';
		
		
		jQuery('#addedRowsED').append(recRow); 
		$('#rowCount').val(rowCount);
	/* } */
}
function removeRow(removeNum) {
		jQuery('#rowCount'+removeNum).remove(); 
	} 
	
	function remiTRecord(a){
		out=$('#kot_outlet').val();
		tbl=$('#kot_table').val();
		cvs=$('#kot_covers').val();
		ste=$('#kot_steward').val();
		kotId=$('#kotbill_id'+a).val();
		r=confirm("Do you want to the record?");
		if(r==true){
			document.location.href="../../action/delete-kotitemRecrd.php?kotId="+kotId+'&out='+out+'&tbl='+tbl+'&cvs='+cvs+'&ste='+ste;
		}else{
			
		}
}

function setPrint(id,val)
		{	
			if($("#"+id).is(":checked"))
			{  

	var menuStr="";
	$('.chk').each(function(i,v){
		if($(this).is(':checked'))
		{
		menuStr +=$(this).val()+',';
		}
	});
	menuStr = menuStr.slice(0,-1);
	$("#hid_menu").val(menuStr);
	

		
				/* $('.ckPrint').each(function(){
					a_id=this.id.split('_');
					if($(this).attr('id') != id)
					{
						$(this).attr("disabled",true);
						$("#ed"+a_id[1]).attr("style","display:none"); 
					}
				}); */
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

function setMenu()
{
	var menuStr="";
	$('.chk').each(function(i,v){
		if($(this).is(':checked'))
		{
		menuStr +=$(this).val()+',';
		}
	});
	menuStr = menuStr.slice(0,-1);
	$("#hid_menu").val(menuStr);
}
		
function tableTransfer(){
	hdMnu=$("#hid_menu").val();
	tblNo=$('#kot_table').val();
	/* newwindow=window.open('<?php echo $home_path;?>/transaction/frontdesk/kot-tableTransfer.php','mywin','left=580,top=100,width=350,height=200,'); */
	newwindow=window.open('<?php echo $home_path;?>/transaction/frontdesk/kot-tableTransfer.php?ktbId='+hdMnu+'&tblNo='+tblNo,'mywin','left=580,top=100,width=350,height=200,'); 
	newwindow.focus();
	
}
function kotTableSbt(){
	$('#submit').prop('disabled', true);
	out=$('#kot_outlet').val();
	tbl=$('#kot_table').val();
	cvs=$('#kot_covers').val();
	ste=$('#kot_steward').val();
	kotEdt=$('#kotEdit').val();

$("#hotelDefi").attr("action","<?php  echo $home_path; ?>/action/add_kotbill.php");
$("#hotelDefi").submit();
}

function kotBillGEn(){
	/* alert('fdfd'); */
	out=$('#kot_outlet').val();
	tbl=$('#kot_table').val();
	cvs=$('#kot_covers').val();
	ste=$('#kot_steward').val();
	kotEdt=$('#kotEdit').val();
if(kotEdt=='edit'){
$("#hotelDefi").attr("action","<?php  echo $home_path; ?>/action/add_room_service.php");
$("#hotelDefi").submit();
}
	
/* document.location.href="<?php echo $home_path;?>/transaction/frontdesk/add_kotOUTLETbill.php?out="+out+'&tbl='+tbl+'&cvs='+cvs+'&ste='+ste; */
	
	
	/* $.ajax({
		type:'GET',
		url:'  ../../action/selKOTBillGENErate.php',
			data:{
			out:out,
			tbl:tbl
			},
			success:function(data){
			
document.location.href="<?php echo $home_path;?>/transaction/frontdesk/add_kotOUTLETbill.php?out="+out+'&tbl='+tbl+'&cvs='+cvs+'&ste='+ste;				 
				if(data==1){
					document.location.href="<?php echo $home_path;?>/transaction/frontdesk/billing-screen.php?out="+out+'&tbl='+tbl+'&cvs='+cvs+'&ste='+ste;
				}
				
			}
	}); */
	
}


function chkItemDesc(a) {
 itmSte=$('#item_desc'+a).val();
 outLt=$('#kot_outlet').val();
 $.ajax({
		type:'GET',
		url:'  ../../action/reptkotITemDesc.php',
			data:{
			itmSte:itmSte,
			outLt:outLt
			},
			success:function(data){
			 /* alert(data); */
				if(data==0){
				/*  alert('Check the item code!.');  */
					 $('#item_code'+a).val('');
					$('#item_desc'+a).val('');
					/* $('#item_desc'+a).focus();  */
				}
				else{
					
				}
			}
	});
	 
}


function bookNoName(){
fpN=$('#fp_no').val();
	$.ajax({
		type:'GET',
		url:'  ../../action/selBookBillName.php',
			data:{
			fpN:fpN
			},
			success:function(data){
			  /* alert(data); */ 
			  opt=data.split('&&');
			  $('#booking_no').val(opt[0]);
			  $('#guest_name').val(opt[1]);
			  $('#guar_pax').val(opt[2]);
			  $("#item_desc1").focus();
			}
	});
}


function pointNum(e)
{
	var charCode = (e.which)?e.which:e.keyCode;
	if(charCode > 31 && (charCode < 48 || charCode >57) && charCode != 46)
			{
			alert ("Digits only");
			return false;
			}
}


</script> 
<body class="bgBODY">



  <!--form validation-->	
<script type="text/javascript" src="<?php echo $home_path;?>/js/item.js"></script>
<script type="text/javascript" src="<?php echo $home_path;?>/js/util.js"></script>
<script type="text/javascript" src="<?php echo $home_path;?>/fm-valid/src/js/jquery.validVal.js"></script>
<script type="text/javascript" src="<?php echo $home_path;?>/fm-valid/src/js/jquery.validVal-customValidations.js"></script>
<script type="text/javascript" src="<?php echo $home_path;?>/fm-valid/src/js/jquery.validVal-debugger.js"></script>

<script src="../../js/shortcut.js" type="text/javascript"></script>

		
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
<style>
.spanClr{
	color: #5b503b;
    display: block;
    float: left;
    font-size: 12px;
    font-weight: normal;
    padding: 0px 9px 0 5px;
		
}
.btn-sm{
    padding: 3px 10px;
    margin-top: 6px;
    width: 25%;
}
.nowrap{white-space: nowrap;}
.table-responsive{
overflow:hidden;
}
</style>
	<?php
/* echo $_POST['open_outlet'];
die(); */
?>
<style>
/* .tblImg{
background: url(../../images/tblopn.png) no-repeat scroll 81px 3px;
background-size: 15px 15px;
padding-left:30px;	
} */

.tathead{ display: block;border:none; }

.tatbody {
   /*  height: 348px;  */      /* Just for the demo          */
   /*  height: 350px;  */      /* Just for the demo          */
    overflow-y: auto;    /* Trigger vertical scroll    */
    overflow-x: hidden;  /* Hide the horizontal scroll */
	border:none;
}

.tableS > thead > tr > th, .tableS > tbody > tr > th, .table > tfoot > tr > th, .tableS > thead > tr > td, .tableS > tbody > tr > td, .tableS > tfoot > tr > td {
  color: #333333;
  border:1px solid #CCCCCC;
}
.butExample{
	padding:4px 57px;
}
</style>


<div class="col-sm-2" >


</div>
<!--<form id="hotelDefi" name="hotelDefi" enctype="multipart/form-data"  action="<?php echo $home_path;?>/action/add_kotbill.php" method="post" class="" style="">-->
<?php
$currentTime=date('H:i');

$sqlS=mysql_query("select * from bqt_session");
while($rowS=mysql_fetch_array($sqlS)){
	$frTime=$rowS['from_time'];
	$toTime=$rowS['to_time'];
	/* if (strtotime($currentTime) > strtotime($frTime) && strtotime($currentTime) < strtotime($toTime)) {  */
	if (strtotime($currentTime) > strtotime($frTime)) {
		/* echo $currentTime.$frTime; */
		/* echo $toTime; */
		$sessCode= $rowS['sess_code'];
	}
	
}


$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$curDate=$rowAC['cur_date'];
$cur=explode('/',$curDate);
$curen=$cur[2].'-'.$cur[1].'-'.$cur[0];

/* echo "select distinct fpno from bq_opfpmenuhdr where bill_status='1' AND str_to_date(bkdate,'%d/%m/%Y') = '$curen' AND fpno!=''"; */
/* $sqR=mysql_query("select * from bq_opfpmenuhdr where fpno='".$bkN."' AND confirm_status='1'");
$roR=mysql_fetch_array($sqR); */ 
?>	
<div id="addcustomer" class="col-sm-7 divBrd frmBgClr frmCentr" style="width:814px;height:502px;padding:0px;">
<form id="hotelDefi" name="hotelDefi" enctype="multipart/form-data"  action="<?php echo $home_path;?>/action/add_fpkot.php" method="post" class="" style="">	
	<h3 id="Userhd"><span style="color:#fff;"><?php if(isset($_POST['open_outlet'])){echo $_POST['open_outlet'];}?></span><span style=""><b>K.O.T</b></span><span style="float:right;"><b><?php /* if(isset($sessCode)) { echo $sessCode;} */?></b></span></h3>



		<input type="hidden" id="hid_menu" name="hid_menu" value=""/>
		<table style="width:100%;border-right:1px solid #000;border-left:1px solid #000;border-top:1px solid #000;border-bottom:1px solid #000;margin:3px 0 0 0;" cellpadding="0" cellspacing="0" class="table" border="0" >
			<tbody>

			<tr>

			<td  valign="top"><label style="margin:3px 0 0 0;">FP. No.</label></td>
			<td valign="top">
			<?php $sqlRt=mysql_query("select distinct fpno from bq_opfpmenuhdr where bill_status='1' AND str_to_date(bkdate,'%d/%m/%Y') = '$curen' AND fpno!=''");?>
			<select name="fp_no" id="fp_no" data-validation="required" class="required  fstChUPPRCase txtBx" onchange="bookNoName();" style="width:100px;margin:3px 0 0 0;">
			<option value="">--Select--</option>
			<?php while($rowRt=mysql_fetch_array($sqlRt)) { ?>
			<option class="codesUPPERCase" value="<?php echo $rowRt['fpno'];?>" ><?php echo $rowRt['fpno'];?></option>
			<?php } ?>
			</select>
				
			<!--<input name="fp_no" id="fp_no" type="text" data-validation="required" class="input required textbox fstChUPPRCase" style="width:80px;margin:4px 0 0 0;" value="" readonly />-->
			
			</td>
				
			<td style="width:54px;" valign="top"><label style="margin:3px 0 0 0;">Booking#</label></td>
			<td valign="top" style="width:50px;"><input name="booking_no" id="booking_no" type="text" class="input required textbox fstChUPPRCase tblImg" style="width:100px;margin:4px 0 0 0;" value="" readonly />
			 </td>
			<td style="" valign="top"><label style="margin:3px 0 0 0;">Guest name</label></td>
			<td valign="top" style="width:50px;"><input name="guest_name" id="guest_name" type="text" class="input required textbox fstChUPPRCase tblImg" style="width:170px;margin:4px 0 0 0;" value="<?php /* echo $_GET['tbl']; */ ?>" readonly />

			</td>
			<td style="" valign="top"><label style="margin:3px 0 0 0;">Pax</label></td>
			<td valign="top" style="width:50px;"><input name="guar_pax" id="guar_pax" type="text" class="input required textbox fstChUPPRCase tblImg" style="width:70px;margin:4px 0 0 0;" value="" readonly />

			</td>


			</tr>
									
					</tbody>
				</table>

		
<table class="table table-condensed table-hover table-striped table-bordered" cellpadding="0" cellspacing="0" border="0" class="table" style="margin:0 0 0px 0px;text-align:center;font-size:12px;">
<thead class="tathead">
	<tr>
		<th style="text-align:center;background-color:#0073B5;color:#fff;width:110px;">Code</th>
		<th style="text-align:center;background-color:#0073B5;color:#fff;width:96px;">Sac</th>
		<th style="text-align:center;background-color:#0073B5;color:#fff;width:252px;">Item Desc</th>
		<th style="text-align:center;background-color:#0073B5;color:#fff;width:83px;">Qty</th>
		<th style="text-align:center;background-color:#0073B5;color:#fff;width:122px;">Item Rate</th>
		<!--<th style="text-align:center;background-color:#0073B5;color:#fff;width:95px;">Tax</th>-->
		<th style="text-align:center;background-color:#0073B5;color:#fff;width:149px;">Value</th>
	</tr>
	</thead>
	<tbody id="tblRw" style="overflow:auto;height:360px;" class="tathead tatbody" >
	<tr>
	
	<input name="menu_type[]" id="menu_type1" type="hidden" class="textbox codesUPPERCase" style="width:40px;margin:4px 0 0 0;" value="" />
	<input name="strCode[]" id="sCode1" type="hidden" class="textbox codesUPPERCase" style="width:40px;margin:4px 0 0 0;" value="" />
		
		<td width="60"><input name="kot_itemcode[]" id="item_code1" type="text" class="textbox codesUPPERCase itemCde required" style="width:110px;margin:4px 0 0 0;"  />
		</td>
		<td width="60"><input name="kot_sac[]" id="kot_sac1" type="text" class="textbox codesUPPERCase required" style="width:90px;margin:4px 0 0 0;"  />
		</td>
		<td width="" class="codesUPPERCase"><input name="kot_itemdesc[]" id="item_desc1" type="text" class="textbox codesUPPERCase required" style="width:250px;margin:4px 0 0 0;" onblur="chkItemDesc(<?php echo '1' ?>);" /></td>
		<td width="40" class="fstChUPPRCase"><input name="kot_itemqty[]" id="item_qty1" type="text" class="textbox codesUPPERCase required" style="width:80px;margin:4px 0 0 0;" value="" onkeypress="return pointNum(event)" onblur="chkItmQTy(<?php echo '1' ?>);" /></td>
		<td width="50" class="fstChUPPRCase"><input name="item_rate[]" id="item_rate1" type="text" class="textbox codesUPPERCase required" style="width:120px;margin:4px 0 0 0;" onkeypress="return pointNum(event)"  /></td>
		
		<!--<input name="strCode[]" id="strCode1" type="hidden" class="textbox  codesUPPERCase clr" style="width:40px;margin:4px 0 0 0;" value="" />
		<td><input type="text" name="lineTax[]" id="lineTax1" value="" style="width:92px;" class="textbox1 fstChUPPRCase required lineTax" readonly  /></td>-->
		<td width="60" class="fstChUPPRCase">
		<input name="kot_itemval[]" id="item_val1" type="text" class="textbox codesUPPERCase lineTot required" style="width:120px;margin:4px 0 0 0;" value="0" onkeypress="return pointNum(event)" readonly  />
		</td>
		<!--<td width="142" class="fstChUPPRCase"><input name="kot_itempref[]" id="item_pref1" type="text" class="textbox codesUPPERCase" style="width:142px;margin:4px 0 0 0;" /></td>
		<td width="50" class="fstChUPPRCase"><!--<input name="kot_no[]" id="kot_no1" type="text" class="textbox codesUPPERCase" style="width:60px;margin:4px 0 0 0;" readonly />-->
		
		
		
		<input name="kot_lnedsvl[]" id="kot_lnedsvl1" type="hidden" class="textbox codesUPPERCase" style="width:40px;margin:4px 0 0 0;" value="" />
		<input name="discAmt[]" id="discAmt1" type="hidden" class="textbox codesUPPERCase discAmt" style="width:40px;margin:4px 0 0 0;" value="" />
		<input name="open_dis[]" id="open_dis1" type="hidden" class="textbox codesUPPERCase" style="width:100px;margin:4px 0 0 0;" value="0" readonly  />
		<input name="lineTax[]" id="lineTax1" type="hidden" class="textbox codesUPPERCase lineTax" style="width:40px;margin:4px 0 0 0;" value="0" />
		
		<!--<input name="menu_type[]" id="menu_type1" type="hidden" class="textbox codesUPPERCase" style="width:40px;margin:4px 0 0 0;" value="" />-->
		
	</tr>
<?php   
	for($i=2;$i<=30;$i++) { ?>
	<tr>
	
	<input name="menu_type[]" id="menu_type<?php echo $i;?>" type="hidden" class="textbox codesUPPERCase" style="width:40px;margin:4px 0 0 0;" value="" />
	<input name="strCode[]" id="sCode<?php echo $i;?>" type="hidden" class="textbox codesUPPERCase" style="width:40px;margin:4px 0 0 0;" value="" />
	
		<td width="60"><input name="kot_itemcode[]" id="item_code<?php echo $i;?>" type="text" class="textbox codesUPPERCase itemCde item_code" style="width:110px;margin:4px 0 0 0;" />
		</td>
		<td width="60"><input name="kot_sac[]" id="kot_sac<?php echo $i;?>" type="text" class="textbox codesUPPERCase" style="width:90px;margin:4px 0 0 0;"  />
		<td width="" class="codesUPPERCase"><input name="kot_itemdesc[]" id="item_desc<?php echo $i;?>" type="text" class="textbox codesUPPERCase " style="width:250px;margin:4px 0 0 0;" onblur="chkItemDesc(<?php echo $i; ?>);" /></td>
		<td width="40" class="fstChUPPRCase"><input name="kot_itemqty[]" id="item_qty<?php echo $i;?>" type="text" class="textbox codesUPPERCase " style="width:80px;margin:4px 0 0 0;" onkeypress="return pointNum(event)" onblur="chkItmQTy(<?php echo $i; ?>);" /></td>
		<td width="50" class="fstChUPPRCase"><input name="item_rate[]" id="item_rate<?php echo $i;?>" type="text" class="textbox codesUPPERCase " style="width:120px;margin:4px 0 0 0;" onkeypress="return pointNum(event)" /></td>
		<!--<input name="strCode[]" id="strCode<?php echo $c;?>" type="hidden" class="textbox form-control codesUPPERCase clr" style="width:40px;margin:4px 0 0 0;" value="" />
												<td><input type="text" name="lineTax[]" id="lineTax<?php echo $c;?>" value="" style="width:92px;" class="textbox1 fstChUPPRCase required  lineTax" readonly  /></td>-->
		<td width="60" class="fstChUPPRCase"><input name="kot_itemval[]" id="item_val<?php echo $i;?>" type="text" class="textbox codesUPPERCase lineTot" style="width:120px;margin:4px 0 0 0;" onkeypress="return pointNum(event)" value="0" readonly  />
		</td>
		<!--<td width="142" class="fstChUPPRCase"><input name="kot_itempref[]" id="item_pref<?php echo $i;?>" type="text" class="textbox codesUPPERCase" style="width:142px;margin:4px 0 0 0;" onkeypress="addMoreRows();" /></td>-->
		<!--<input name="kot_no[]" id="kot_no<?php echo $i;?>" type="text" class="textbox codesUPPERCase" style="width:60px;margin:4px 0 0 0;" readonly />-->
		
		<input name="kot_lnedsvl[]" id="kot_lnedsvl<?php echo $i;?>" type="hidden" class="textbox codesUPPERCase" style="width:40px;margin:4px 0 0 0;" value="" />
		<input name="discAmt[]" id="discAmt<?php echo $i;?>" type="hidden" class="textbox codesUPPERCase discAmt" style="width:40px;margin:4px 0 0 0;" value="" />
		<input name="open_dis[]" id="open_dis<?php echo $i;?>" type="hidden" class="textbox codesUPPERCase" style="width:100px;margin:4px 0 0 0;" value="0" readonly  />
		<input name="lineTax[]" id="lineTax<?php echo $i;?>" type="hidden" class="textbox codesUPPERCase lineTax" style="width:40px;margin:4px 0 0 0;" value="0" />

	</tr>
<?php   }  ?>
	<tr id="rwDis" style="display:none;">
      <td colspan="7">
	  <table id="tblRw">
        <tbody id="addedRowsED" >
		
		</tbody>
		</table>
		</td>
	 </tr>
		
		
		
	</tbody>

</table>

<table style="border-left:1px solid #ddd;margin:10px 0 0 0;" class="table">
	<tr>
		<td>	
	<div class="col-md-12  responsive nowrap " style=" padding-left:3px;">
		<button type="submit" id="send" name="send" class="btn btn-primary btn-sm btn-responsive" style="" onclick="return checkformSubmit();"><img src="../../images/saves.png" class="sbtBtnImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">S</span>ubmit</button>
		
		<a href="view-fpkot.php?fromdate=<?php echo $curDate;?>&todate=<?php echo $curDate;?>"><button type="button" id="update" class="btn btn-primary btn-sm btn-responsive" onclick="return checkPropertyMasterq();"><img src="../../images/audit.png" class="sbtBtnImg "/>&nbsp;&nbsp;<span class="btnUndLine">V</span>iew</button></a>
		
		<button type="reset" id="rest" class="btn btn-primary btn-sm btn-responsive" style="" onclick="cancel_ed()"><img src="../../images/clear-icon.png" class="sbtBtnImg" style="width:20px;height:20px;" />&nbsp;&nbsp;<span class="btnUndLine">C</span>lear</button>
			
		<a href="<?php echo $home_path; ?>/dashboard.php?fromdate=<?php echo $rowAC['cur_date'];?>&todate=<?php echo $rowAC['cur_date'];?>"><button type="button" id="exit" name="exit" class="btn btn-primary btn-sm btn-responsive" style=""  ><img src="../../images/exitBut.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button></a>
	</div>
	</td>
	</tr>
</table>



</div>


<div style="width:246px;float:right;margin:5px 0 0 0;" class="">
<!--<h3 id="gstVw">&nbsp;</h3>-->
<?php

?>
</div>
	
<?php /* include("../../footer.php");  */?>	
				
	</form>				
</body>
</html>