<?php
ob_start();
include("../../config.php");
include("../../header.php");
?>
 <!--form validation-->	
<link rel="stylesheet" href="../../form-valid/validationEngine.jquery.css" type="text/css"/>
<script src="../../form-valid/jquery-1.7.2.min.js" type="text/javascript"></script>
<script src="../../form-valid/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8"></script>
<script src="../../form-valid/jquery.validationEngine.js" type="text/javascript" charset="utf-8"></script>

<!-- Datepicker start
<script src="<?php echo $home_path;?>/date-picker/jquery-1.10.2.js"></script>-->
<script src="<?php echo $home_path;?>/date-picker/jquery-ui.js"></script>
<link rel="stylesheet" href="<?php echo $home_path;?>/date-picker/jquery-ui.css">
<!-- End -->

<!---//-form valid---->
<script type="text/javascript">
$(document).ready(function(){
	 $(".datepicker" ).datepicker({
	    changeMonth:true,
     changeYear:true,
     yearRange:"-100:+0",
     dateFormat:"dd/mm/yy"
  });
  
   $(".datepicker1" ).datepicker({
     changeMonth:true,
     changeYear:true,
     yearRange:"-100:+0",
     dateFormat:"dd/mm/yy"
  }); 
  
/*  bal= $("#balance").val();
  if() */
  
    /* $("#statusCHK").click(function(){
		alert('dsds');
		 if(this.checked) {
			 $("#confirm").removeAttr('disabled', false);
		 }else{
			 $("#confirm").attr('disabled', true);
		 }
	 
	}); */
	
	
	$("#msgFo").fadeOut(5000);
	$("#msgFoprop").fadeOut(7000);
 jQuery("#hotelDefi").validationEngine();
	
	$("#comp_desc").keyup(function(){
		$.ajax({
		type: "POST",
		url: "../../action/selectCOMPNoCheckOut.php",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			/*  alert(data);  */
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#search-box").css("background","#FFF");
		}
		});
	});

 $('input[name^=cashrcd_amt]').on('click', function() {
	bal=$("#balance").val();
	Bval=parseFloat($("#bill_amt").val());
	$("#cashrcd_amt").val(bal);
	cashRcd=$("#cashrcd_amt").val();
	totTt=0;
	$(".amtBal").each(function(){
		totTt +=parseFloat($(this).val());
	});
	csBlAmt=parseFloat(Bval-totTt);
	$("#balance").val(csBlAmt.toFixed(2));
	bal=$("#balance").val();
	if(bal==0){
		 $("#confirm").removeAttr('disabled', true); 
	}else{
		$("#confirm").attr('disabled', 'disabled'); 
	}
	if(bal=='NaN'){
		$("#balance").val('');
	}
	
}); 

 $('input[name^=cardrcd_amt]').on('click', function() {
	bal=$("#balance").val();
	Bval=parseFloat($("#bill_amt").val());
	$("#cardrcd_amt").val(bal);
	cardRcd=parseFloat($("#cardrcd_amt").val());
	Bval=parseFloat($("#bill_amt").val());
	totTt=0;
	$(".amtBal").each(function(){
		totTt +=parseFloat($(this).val());
	});
	csBlAmt=parseFloat(Bval-totTt);
	$("#balance").val(csBlAmt.toFixed(2));
	bal=$("#balance").val();
	if(bal==0){
		 $("#confirm").removeAttr('disabled', true); 
	}else{
		$("#confirm").attr('disabled', 'disabled'); 
	}
	if(bal=='NaN'){
		$("#balance").val('');
	}
	if(cardRcd!='0'){
		$("#card_desc").removeAttr('disabled', true);
	}else{
		$("#card_desc").attr('disabled','disabled');
		$("#card_desc").val('');
	}
}); 
$('input[name^=upircd_amt]').on('click', function() {
	        bal=$("#balance").val();
	      Bval=parseFloat($("#bill_amt").val());
	$("#upircd_amt").val(bal);
			upiRcd=parseFloat($("#upircd_amt").val());
			Bval=parseFloat($("#bill_amt").val());
			totTt=0;
			$(".amtBal").each(function(){
				totTt +=parseFloat($(this).val());
			});
			csBlAmt=parseFloat(Bval-totTt);
			$("#balance").val(csBlAmt.toFixed(2));
			bal=$("#balance").val();
			if(bal==0){
				$("#confirm").removeAttr('disabled', true); 
				}else{
				$("#confirm").attr('disabled', 'disabled'); 
			}
			if(bal=='NaN'){
				$("#balance").val('');
			}
			if(upiRcd!='0'){
				$("#upi_desc").removeAttr('disabled', true);
				}else{
				$("#upi_desc").attr('disabled','disabled');
			}
			
		});

$('input[name^=comprcd_amt]').on('click', function() {
	bal=$("#balance").val();
	Bval=parseFloat($("#bill_amt").val());
	$("#comprcd_amt").val(bal);
	
	bal=$("#balance").val();
	Bval=parseFloat($("#bill_amt").val());
	$("#comprcd_amt").val(bal);
	cardRcd=parseFloat($("#comprcd_amt").val());
	Bval=parseFloat($("#bill_amt").val());
	totTt=0;
	$(".amtBal").each(function(){
		totTt +=parseFloat($(this).val());
	});
	csBlAmt=parseFloat(Bval-totTt);
	$("#balance").val(csBlAmt.toFixed(2));
	bal=$("#balance").val();
	if(bal==0){
		 $("#confirm").removeAttr('disabled', true); 
	}else{
		$("#confirm").attr('disabled', 'disabled'); 
	}
	if(bal=='NaN'){
		$("#balance").val('');
	}
	
	if(cardRcd!='0'){
		$("#comp_desc").removeAttr('disabled', true);
	}else{
		$("#comp_desc").attr('disabled','disabled');
		$("#comp_desc").val('');
	}
	//sltcomp();
});


$('input[name^=chequercd_amt]').on('click', function() {
	bal=$("#balance").val();
	Bval=parseFloat($("#bill_amt").val());
	$("#chequercd_amt").val(bal);
	
	cardRcd=parseFloat($("#chequercd_amt").val());
	Bval=parseFloat($("#bill_amt").val());
	totTt=0;
	$(".amtBal").each(function(){
		totTt +=parseFloat($(this).val());
	});
	csBlAmt=parseFloat(Bval-totTt);
	$("#balance").val(csBlAmt.toFixed(2));
	bal=$("#balance").val();
	if(bal==0){
		 $("#confirm").removeAttr('disabled', true); 
	}else{
		$("#confirm").attr('disabled', 'disabled'); 
		
	}
	
	if(cardRcd!='0'){
		$("#cheq_desc").removeAttr('disabled', true);
	}else{
		$("#cheq_desc").attr('disabled','disabled');
		$("#cheq_desc").val('');
	}
	
	if(bal=='NaN'){
		$("#balance").val('');
	}
	

});


$('input[name^=neftrcd_amt]').on('click', function() {
	bal=$("#balance").val();
	Bval=parseFloat($("#bill_amt").val());
	$("#neftrcd_amt").val(bal);
	
	cardRcd=parseFloat($("#neftrcd_amt").val());
	Bval=parseFloat($("#bill_amt").val());
	totTt=0;
	$(".amtBal").each(function(){
		totTt +=parseFloat($(this).val());
	});
	csBlAmt=parseFloat(Bval-totTt);
	$("#balance").val(csBlAmt.toFixed(2));
	bal=$("#balance").val();
	if(bal==0){
		 $("#confirm").removeAttr('disabled', true); 
	}else{
		$("#confirm").attr('disabled', 'disabled'); 
	}
	if(bal=='NaN'){
		$("#balance").val('');
	}
	if(cardRcd!='0'){
		$("#neft_desc").removeAttr('disabled', true);
	}else{
		$("#neft_desc").attr('disabled','disabled');
		$("#neft_desc").val('');
		$("#neft_rem").val('');
	}

});



$('input[name^=roomrcd_amt]').on('click', function() {
	bal=$("#balance").val();
	Bval=parseFloat($("#bill_amt").val());
	$("#roomrcd_amt").val(bal);
	
	cardRcd=parseFloat($("#roomrcd_amt").val());
	Bval=parseFloat($("#bill_amt").val());
	totTt=0;
	$(".amtBal").each(function(){
		totTt +=parseFloat($(this).val());
	});
	csBlAmt=parseFloat(Bval-totTt);
	$("#balance").val(csBlAmt.toFixed(2));
	bal=$("#balance").val();
	if(bal==0){
		 $("#confirm").removeAttr('disabled', true); 
	}else{
		$("#confirm").attr('disabled', 'disabled'); 
	}
	if(bal=='NaN'){
		$("#balance").val('');
	}
	if(cardRcd!='0'){
		$("#room_desc").removeAttr('disabled', true);
	}else{
		$("#room_desc").attr('disabled','disabled');
		$("#room_desc").val('');
		$("#room_rem").val('');
	}
	
});

$('input[name^=refundrcd_amt]').on('click', function() {
	bal=$("#balance").val();
	Bval=parseFloat($("#bill_amt").val());
	$("#refundrcd_amt").val(bal);
	
	cardRcd=parseFloat($("#refundrcd_amt").val());
	Bval=parseFloat($("#bill_amt").val());
	totTt=0;
	$(".amtBal").each(function(){
		totTt +=parseFloat($(this).val());
		});
	csBlAmt=parseFloat(Bval-totTt);
	$("#balance").val(csBlAmt.toFixed(2));
	bal=$("#balance").val();
	/* if(bal==0){
		 $("#confirm").removeAttr('disabled', true); 
	}else{
		$("#confirm").attr('disabled', 'disabled'); 
	} */
	
	if(bal=='NaN'){
		$("#balance").val('');
	}
});


$('input[name^=voidrcd_amt]').on('click', function() {
	bal=$("#balance").val();
	Bval=parseFloat($("#bill_amt").val());
	$("#voidrcd_amt").val(bal);
	
	cardRcd=parseFloat($("#voidrcd_amt").val());
	Bval=parseFloat($("#bill_amt").val());
	totTt=0;
	$(".amtBal").each(function(){
		totTt +=parseFloat($(this).val());
	});
	csBlAmt=parseFloat(Bval-totTt);
	$("#balance").val(csBlAmt.toFixed(2));
	bal=$("#balance").val();
	if(bal==0){
		 $("#confirm").removeAttr('disabled', true); 
	}else{
		$("#confirm").attr('disabled', 'disabled'); 
	}
	if(bal=='NaN'){
		$("#balance").val('');
	}
});


/* Start keyup */

$('input[name^=cashrcd_amt]').live('keyup', function() {
	cashRcd=parseFloat($("#cashrcd_amt").val());
	Bval=parseFloat($("#bill_amt").val());
	cabaltAmt=$("#balance").val();

	totTt=0;
	$(".amtBal").each(function(){
		totTt +=parseFloat($(this).val());
	});
	csBlAmt=parseFloat(Bval-totTt);
	$("#balance").val(csBlAmt.toFixed(2));
	bal=$("#balance").val();
	if(bal==0){
		 $("#confirm").removeAttr('disabled', true); 
	}else{
		$("#confirm").attr('disabled', 'disabled'); 
	}
	if(bal=='NaN'){
		$("#balance").val('');
	}
		
});	

$('input[name^=cardrcd_amt]').live('keyup', function() {
	cardRcd=parseFloat($("#cardrcd_amt").val());
	Bval=parseFloat($("#bill_amt").val());
	totTt=0;
	$(".amtBal").each(function(){
		totTt +=parseFloat($(this).val());
	});
	csBlAmt=parseFloat(Bval-totTt);
	$("#balance").val(csBlAmt.toFixed(2));
	bal=$("#balance").val();
	if(bal==0){
		 $("#confirm").removeAttr('disabled', true); 
	}else{
		$("#confirm").attr('disabled', 'disabled'); 
	}
	if(bal=='NaN'){
		$("#balance").val('');
	}
	if(cardRcd!='0'){
		$("#card_desc").removeAttr('disabled', true);
	}else{
		$("#card_desc").attr('disabled','disabled');
	}
	 
});	

$('input[name^=comprcd_amt]').live('keyup', function() {
	cardRcd=parseFloat($("#comprcd_amt").val());
	Bval=parseFloat($("#bill_amt").val());
	totTt=0;
	$(".amtBal").each(function(){
		totTt +=parseFloat($(this).val());
	});
	csBlAmt=parseFloat(Bval-totTt);
	$("#balance").val(csBlAmt.toFixed(2));
	bal=$("#balance").val();
	if(bal==0){
		 $("#confirm").removeAttr('disabled', true); 
	}else{
		$("#confirm").attr('disabled', 'disabled'); 
	}
	if(bal=='NaN'){
		$("#balance").val('');
	}
	
	if(cardRcd!='0'){
		$("#comp_desc").removeAttr('disabled', true);
	}else{
		$("#comp_desc").attr('disabled','disabled');
	}
	
});	

$('input[name^=chequercd_amt]').live('keyup', function() {
	cardRcd=parseFloat($("#chequercd_amt").val());
	Bval=parseFloat($("#bill_amt").val());
	totTt=0;
	$(".amtBal").each(function(){
		totTt +=parseFloat($(this).val());
	});
	csBlAmt=parseFloat(Bval-totTt);
	$("#balance").val(csBlAmt.toFixed(2));
	bal=$("#balance").val();
	if(bal==0){
		 $("#confirm").removeAttr('disabled', true); 
	}else{
		$("#confirm").attr('disabled', 'disabled'); 
	}
	if(bal=='NaN'){
		$("#balance").val('');
	}
	

});


$('input[name^=neftrcd_amt]').live('keyup', function() {
	cardRcd=parseFloat($("#neftrcd_amt").val());
	Bval=parseFloat($("#bill_amt").val());
	totTt=0;
	$(".amtBal").each(function(){
		totTt +=parseFloat($(this).val());
	});
	csBlAmt=parseFloat(Bval-totTt);
	$("#balance").val(csBlAmt.toFixed(2));
	bal=$("#balance").val();
	if(bal==0){
		 $("#confirm").removeAttr('disabled', true); 
	}else{
		$("#confirm").attr('disabled', 'disabled'); 
	}
	if(bal=='NaN'){
		$("#balance").val('');
	}
	

});



$('input[name^=roomrcd_amt]').live('keyup', function() {
	cardRcd=parseFloat($("#roomrcd_amt").val());
	Bval=parseFloat($("#bill_amt").val());
	totTt=0;
	$(".amtBal").each(function(){
		totTt +=parseFloat($(this).val());
	});
	csBlAmt=parseFloat(Bval-totTt);
	$("#balance").val(csBlAmt.toFixed(2));
	bal=$("#balance").val();
	if(bal==0){
		 $("#confirm").removeAttr('disabled', true); 
	}else{
		$("#confirm").attr('disabled', 'disabled'); 
	}
	if(bal=='NaN'){
		$("#balance").val('');
	}
	if(cardRcd!='0'){
		$("#room_desc").removeAttr('disabled', true);
	}else{
		$("#room_desc").attr('disabled','disabled');
	}
	
});

$('input[name^=refundrcd_amt]').live('keyup', function() {
	cardRcd=parseFloat($("#refundrcd_amt").val());
	Bval=parseFloat($("#bill_amt").val());
	totTt=0;
	$(".amtBal").each(function(){
		totTt +=parseFloat($(this).val());
	});
	csBlAmt=parseFloat(Bval-totTt);
	$("#balance").val(csBlAmt.toFixed(2));
	bal=$("#balance").val();
	/* if(bal==0){
		 $("#confirm").removeAttr('disabled', true); 
	}else{
		$("#confirm").attr('disabled', 'disabled'); 
	} */
	if(bal=='NaN'){
		$("#balance").val('');
	}
});



$('input[name^=voidrcd_amt]').live('keyup', function() {
	cardRcd=parseFloat($("#voidrcd_amt").val());
	Bval=parseFloat($("#bill_amt").val());
	totTt=0;
	$(".amtBal").each(function(){
		totTt +=parseFloat($(this).val());
	});
	csBlAmt=parseFloat(Bval-totTt);
	$("#balance").val(csBlAmt.toFixed(2));
	bal=$("#balance").val();
	/* if(bal==0){
		 $("#confirm").removeAttr('disabled', true); 
	}else{
		$("#confirm").attr('disabled', 'disabled'); 
	} */
	if(bal=='NaN'){
		$("#balance").val('');
	}
});



$('.inputs').keydown(function (e){
   if(e.keyCode == 13){
     $(this).next('.inputs').focus();
 }
});


});

function sltcomp()
{
	
	//$('.loader').css('display','block');
	 setTimeout(function(){ 
	
	
	
		$.ajax({
							type: "POST",
							url: "complist.php",  
							data: {},
							success: function(result) {  
							//alert(result);
							//$('.loader').css('display','none');
							$('#comp_desc').html('');
							$('#comp_desc').append(result);
							},
							async:false
						});
  return false; 
  
  }, 1000);
}


function selectRoomNO(val) {
	$("#room_number").val(val);
	$("#suggesstion-box").hide();
}


function getBillNumDetails() {
	newwindow=window.open('<?php echo $home_path;?>/transaction/frontdesk/settleBillDetails.php',"_blank",'scrollbars=1,menubar=0,resizable=1,width=320,top=100,left=500,height=190');
	newwindow.focus();
}

 function checkSubmit(cb){
	 var menuStr="";
	$('.chk').each(function(i,v){
		if($(this).is(':checked'))
		{
		menuStr +=$(this).val()+',';
		 $("#confirm").removeAttr('disabled', true); 
		}
	});
	menuStr = menuStr.slice(0,-1);
	$("#hid_menu").val(menuStr);
}
  

function settleCash() {
	newwindow=window.open('<?php echo $home_path;?>/transaction/frontdesk/selectSettleCash.php',"_blank",'scrollbars=1,menubar=0,resizable=1,width=500,top=100,left=500,height=220');
	newwindow.focus();
}

function formSubmit() {
$("#refundrcd_amt").removeAttr('disabled', true); 
 	var menuStr="";
	$('.remSum').each(function(i,v){
		 if($(this).val()!='')
		{ 
		menuStr +=$(this).val()+',';
		 }
	});
	menuStr = menuStr.slice(0,-1);
	$("#hid_menu").val(menuStr);
	
	var menuTp="";
	$('.remTIps').each(function(i,v){
		 if($(this).val()!='')
		{ 
		menuTp +=$(this).val()+',';
		}
	});
	menuTp = menuTp.slice(0,-1);
	$("#hid_tips").val(menuTp);
	csh=$("#cashrcd_amt").val();
	cshRe=$("#cash_rem").val();
	
	crd=$("#cardrcd_amt").val();
	crdSc=$("#card_desc").val().trim();
	crdRm=$("#card_rem").val().trim();

	cheqAmt=$("#chequercd_amt").val();
	cheqDsc=$("#cheq_desc").val();
	cheqRem=$("#cheq_rem").val();
	
	neftAmt=$("#neftrcd_amt").val();
	neftDsc=$("#neft_desc").val();
	neftRem=$("#neft_rem").val();
	
	roomAmt=$("#roomrcd_amt").val();
	roomDsc=$("#room_desc").val();
	roomRem=$("#room_rem").val();
	
	voidAmt=$("#voidrcd_amt").val();
	voidRem=$("#void_rem").val();

if(csh>0 && csh>=50000 && cshRe==""){
	alert("Please enter Pan Card Details.");
	return false; 
}else if(crd>0 && crdSc==""){
	alert("Please select card type.");
	return false; 
}else if(crd>0 && crdRm==""){
	alert("Please enter card no & details.");
	return false; 
}else if(cheqAmt>0 && cheqDsc==""){
	alert("Please select cheque type.");
	return false; 
}else if(cheqAmt>0 && cheqRem==""){
	alert("Please enter cheque no & details.");
	return false; 
}
// else if(neftAmt>0 && neftDsc==""){
	// alert("Please select bank name.");
	// return false; 
// }else if(neftAmt>0 && neftRem==""){
	// alert("Please enter neft details.");
	// return false; 
// }
else if(roomAmt>0 && roomDsc==""){
	alert("Please select room no.");
	return false; 
}else if(roomRem>0 && room_rem==""){
	alert("Please enter room details.");
	return false; 
}else if(voidAmt>0 && voidRem==""){
	alert("Please enter void details.");
	return false; 
}else{
	return true;
}
	
}

function selBkNo() {
blno=$("#blno").val();
$("#room_desc").val('');
$("#comp_desc").val('');
$("#card_desc").val('');
totTt=0;
	$(".amtBal").each(function(){
		totTt +=parseFloat($(this).val('0'));
	});
	
	$('.remSum').each(function(){
		($(this).val(''));
	});	

$.ajax({
type:'GET',
url:'  ../../action/selectBILLAmt.php',
	data:{
	blno:blno
	},
	success:function(data){
		/* alert(data); */
		opt=data.split(',');
		$("#fp_no").val(opt[0]);
		$("#bill_amt").val(opt[1]);
		$("#guest_name").val(opt[2]);
		$("#balance").val(opt[1]);
		$("#comp_name").val(opt[3]);
		$("#pay_mode").val(opt[4]);
		$("#bk_no").val(opt[5]); 
		$("#bill_date").val(opt[6]); 
		if(opt[1]<0){
			$("#refundrcd_amt").val(opt[1]); 
			$("#balance").val(0);
			$("#confirm").removeAttr('disabled',true);
		}
				
		}
	});	
	
} 



function selRoomNo()
{
	rmNo=$("#room_desc").val();
	blAmt=$("#bill_amt").val();
	$.ajax({
		type:'GET',
		url:'  ../../action/selectROomNOStatsPOS.php',
			data:{
			rmNo:rmNo,
			blAmt:blAmt
			},
			success:function(data){
			 /* alert(data); */
				 opt=data.split(',');
				if(opt[0]==1){
					alert('FO Bill already generated.');
					$("#room_desc").val('');
					$("#balance").val(opt[1]);
					$("#roomrcd_amt").val('');
				}else{
					$("#room_rem").val(data);
					
				}
				
				
				
			}
	});
} 


</script> 
<body class="bgBODY">
	
<div class="about">
<div id="invoice" style="margin:0 0 0 325px">
	<!--<div class="container" >-->
		<div class="col-md-9" >
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
    padding: 2px 9px 0 5px;
		
}

.frmSearch {border: 1px solid #F0F0F0;/* background-color:#C8EEFD; */margin: 2px 0px;/* padding:40px; */}
#country-list{float:left;list-style:none;margin:0;padding:0;width:90px;position: absolute;z-index: 1;}
#country-list li{padding: 2px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;font-size:12px;}
#country-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;}

/* thead, tbody { display: block; }

tbody {
    height: 300px;      
    overflow-y: auto;    
    overflow-x: hidden;  
} */

.tathead{ display: block;border:none; }

.tatbody {
   /*  height: 350px; */       /* Just for the demo          */
    overflow-y: auto;    /* Trigger vertical scroll    */
    overflow-x: hidden;  /* Hide the horizontal scroll */
	border:none;
}
.tbHd{
	color: #5b503b;
    display: block;
    float: right;
    font-size: 12px;
    font-weight: normal;
    padding: 3px 9px 0 0;
	font-weight:normal;
}


.tableS > thead > tr > th, .tableS > tbody > tr > th, .table > tfoot > tr > th, .tableS > thead > tr > td, .tableS > tbody > tr > td, .tableS > tfoot > tr > td {
  color: #333333;
  border:1px solid #CCCCCC;
}

.inptSt {
	border: none;
    border-radius: 0;
    color: #555555;
    display: inline-block;
    font-size: 13px;
    line-height: 18px;
 }
 	.buttExaS {
    background-color: #ffffff;
    border: 1px solid #888888;
    color: #000;
    font-family: arial,helvetica,sans-serif;
    font-size: 12px;
   /*  margin-left: -3px; */
    padding: 5.1px 0px;
    /* padding: 5.5px 59px; */
	width:125px;
}

	.butEx{
	background-color: #ffffff;
    border: 1px solid #ddd;
    color: #000;
    font-family: arial,helvetica,sans-serif;
    font-size: 12px;
    margin-left: -3px;
    padding: 4px 58px;
	}
	</style>
		
<div id="addcustomer" style="border:1px solid #ddd;width:769px;height:335px;margin: 32px 0 0 0;">
	<h3 style="text-align:center;font-size:14px;padding:10px;background:#0073B5;color:#fff;margin:1px 0 0 0;text-transform:uppercase;"><b>Settlement</b></h3>
<form id="hotelDefi" name="hotelDefi" enctype="multipart/form-data" action="<?php echo $home_path;?>/action/add_bqtsettlement.php" method="post" class="" style="">
		<div>
		<input type="hidden" name="tariff_rt" id="tariff_rt" />
		<input type="hidden" name="taxCodee" id="taxCodee" class="txCde"/>
		<input type="hidden" name="departure_time" id="departure_time" class=""/>
		<textarea id="hid_menu" name="hid_menu" value="" hidden ></textarea>
		<textarea id="hid_tips" name="hid_tips" value="" hidden ></textarea>
		

<?php

	
if(isset($_GET['rgNm'])){

$sqlBh=mysql_query("select * from bill_header bh,guest_register gr where gr.guestreg_id='".$_GET['rgNm']."' AND bh.reg_num='".$_GET['rgNm']."' AND settleflag='4'");
$rowBh=mysql_fetch_array($sqlBh); 
	if($rowBh['net_amt']<0){
		$refund=$rowBh['net_amt'];
	}else{
		$refund=0;
	}
	
	if($rowBh['net_amt']>0){
		$balNc=$rowBh['net_amt'];
	}else{
		$balNc=0;
	}
}
?>		
<table style="float:left;width:100%;margin:4px 0 7px 0;font-size:12px;" cellpadding="0" cellspacing="0" class="" border="0" >
<tbody>
<tr>
<td width="60" valign="top"><label style="float:right;width:65px;margin:0 0 0 6px;font-weight:bold;">Bill #<em></em></label></td>
<td valign="top" style="margin:0 0 0 0;">
<select name="blno" id="blno" style="font-size:12px;width:138px" onChange="selBkNo();" class="wagRw1 textbox">
<option value="">--Select--</option>
<?php
$sqle=mysql_query("select distinct bill_no from bq_opbillhdr where bill_status='1'");
while($res=mysql_fetch_array($sqle)){
?>
<option value="<?php echo $res['bill_no']  ?>" ><?php echo strtoupper($res['bill_no']); ?></option>
<?php } ?>
</select>
</td>

<td width="60" valign="top"><label style="float:right;width:55px;margin:0 0 0 6px;font-weight:bold;">Bill Date<em></em></label></td>
	<td valign="top" style="margin:0 0 0 0;">
	<input name="bill_date" id="bill_date" type="text" data-validation="required" class="input validate[required]  fstChUPPRCase" style="width:100px;" value="" readonly />
	</td>
	<td width="60" valign="top"><label style="float:right;width:84px;margin:0 0 0 6px;font-weight:bold;">Bill Amount<em></em></label></td>
	<td valign="top" style="margin:0 0 0 0;">
	<input name="bill_amt" id="bill_amt" type="text" data-validation="required" class="input validate[required]  fstChUPPRCase" style="width:118px;" value="" readonly />
	</td>
	<td width="60" valign="top"><label style="float:right;width:55px;margin:0 0 0 6px;font-weight:bold;">Balance <em></em></label></td>
	<td valign="top" style="margin:0 0 0 0;">
	<input name="balance" id="balance" type="text" class="fstChUPPRCase" style="width:87px;" value="" readonly />
	</td>
	
</tr>	
<tr>
	<!--<td width="60" valign="top"><label style="float:right;width:65px;margin:0 0 0 6px;color:#fff;font-weight:bold;">FP #<em></em></label></td>
	<td valign="top" style="margin:0 0 0 0;">-->
	<input name="fp_no" id="fp_no" data-validation="required" type="hidden" class="input validate[required] textbox codesUPPERCase inptSt" style="width:82px;" value="" onkeyup="getGUestName();" readonly />
	</td>
	<td width="60" valign="top"><label style="float:right;width:84px;margin:0 0 0 6px;font-weight:bold;">Guest Name<em></em></label></td>
	<td valign="top" style="margin:0 0 0 0;">
	<input name="guest_name" id="guest_name" type="text" data-validation="required" class="input validate[required]  fstChUPPRCase" style="width:138px;" value="" readonly />
	</td>
	<td width="60" valign="top"><label style="width:55px;margin:0 0 0 6px;font-weight:bold;">Company <em></em></label></td>
	<td valign="top" style="margin:0 0 0 0;">
	<input name="comp_name" id="comp_name" type="text" class="fstChUPPRCase" style="width:100px;" value="" readonly />
	</td>
	<td width="60" valign="top"><label style="float:right;width:55px;margin:0 0 0 6px;font-weight:bold;">Book #<em></em></label></td>
<td valign="top" style="margin:0 0 0 0;">
<input name="bk_no" id="bk_no" type="text" data-validation="required" class="input validate[required]  fstChUPPRCase" style="width:118px;" value="" readonly />
</td>
	<td width="60" valign="top"><label style="float:left;width:41px;margin:0 0 0 6px;font-weight:bold;">Mode<em></em></label></td>
	<td valign="top" style="margin:0 0 0 0;">
	<input name="pay_mode" id="pay_mode" type="text" data-validation="required" class="input validate[required]  fstChUPPRCase" style="width:87px;" value="" readonly />
	</td>
</tr>	
</tbody>
</table>
	
<table class="table tableS" style="width:15%;float:left;margin:0px 0 0 0;text-align:center;font-size:12px;">
<tr>
<th width="" style="text-align:center;background-color:#C3C3C3;width:1%;">Mode</th>
</tr>
<tr>
<td>
<button type="button" id="cash" name="pay_mode" value="cash" class="buttExaS bnkSbt frstChr submit" style="" onclick="checkCheOutCash();" disabled >&nbsp;&nbsp;<span class="btnUndLine">C</span>ash</button>
</td>
</tr>
<tr>
<td>
<button type="button" id="card" name="pay_mode" value="card" class="buttExaS" style="" onclick="checkCheOutCard();">&nbsp;&nbsp;<span class="btnUndLine">C</span>ard</button></a>
</td>
</tr>
<tr>
							<td>
							<button type="button" id="upi" name="pay_mode" value="upi" class="buttExaS" style="" onclick="checkCheOutCard();">&nbsp;&nbsp;<span class="btnUndLine">U</span>PI</button></a>
						</td>
					</tr>
<tr>
<td>
<button type="button" id="company" name="pay_mode" value="company" class="buttExaS bnkSbt" onclick="checkCheOutCompany();" >&nbsp;&nbsp;<span class="btnUndLine">C</span>ompany</button>
</td>
</tr>
<tr>
<td>
<button type="button" id="cheque" name="pay_mode" value="cheque" class="buttExaS" style="" onclick="checkCheOutCheq();" >&nbsp;&nbsp;<span class="btnUndLine">C</span>heque</button>
</td>
</tr>
<tr>
<td>
<button type="button" id="cheque" name="pay_mode" value="neft" class="buttExaS" style="" onclick="checkCheOutNeft();" >&nbsp;&nbsp;<span class="btnUndLine">N</span>eft</button>
</td>
</tr>
<tr>
<td>
<button type="button" id="room" name="pay_mode" value="room" class="buttExaS" style="" onclick="checkCheOutROOM();" >&nbsp;&nbsp;<span class="btnUndLine">R</span>oom</button>
</td>
</tr>
<tr>
<td>
<button type="button" id="refund" name="pay_mode" value="refund" class="buttExaS" style="" onclick="checkCheOutREFUND();" >&nbsp;&nbsp;<span class="btnUndLine">R</span>efund</button>
</td>
</tr>
<tr>
<td>
<button type="button" id="void" name="pay_mode" value="void" class="buttExaS" style="" onclick="checkCheOutVOID();" >&nbsp;&nbsp;<span class="btnUndLine">V</span>oid</button>
</td>
</tr>
</table>
		
<div id="" style="width:81.8%;float:right;">

<table cellpadding="0" cellspacing="0" border="1" class="" style="text-align:center;font-size:12px;width:100%;background-color:#fff;">
	<tr>
		<th width="" style="text-align:center;background-color:#C3C3C3;width:20%;">Amount</th>
		<th width="" style="text-align:center;background-color:#C3C3C3;width:16%;">Description</th>
		<th width="" style="text-align:center;background-color:#C3C3C3;width:16%;">Tips</th>
		<th width="" style="text-align:center;background-color:#C3C3C3;width:30%;">Remarks</th>
	</tr>
	<?php /* for($i=0;$i<5;$i++) { */?>
	<tr>
		<td width="" style="text-align:center;background-color:#ffffff;width:20%;height:31px;"><input name="cashrcd_amt" id="cashrcd_amt" type="text"  style="width:90px;border:1px solid #ddd;text-align:right;" value="0" class="inptSt amtBal"/></td>
		<td width="" style="text-align:center;background-color:#ffffff;width:16%;height:31px;"><input name="cash_desc" id="cash_desc" type="text"  style="width:90px;border:1px solid #ddd;" value="" class="inptSt"/></td>
		<td width="" style="text-align:center;background-color:#ffffff;width:16%;height:31px;"><input name="cash_tips" id="cash_tips" type="text"  style="width:90px;border:1px solid #ddd;" value="" class="inptSt remTIps" /></td>
		<td width="" style="text-align:center;background-color:#ffffff;width:30%;height:31px;"><input name="cash_rem" id="cash_rem" type="text"  style="width:170px;border:1px solid #ddd;" value="" class="inptSt remSum" placeholder="PAN Card Details."/></td>
	</tr>
	<?php /* } */ ?>
	<tr>
		<td width="" style="text-align:center;background-color:#ffffff;width:20%;height:31px;"><input name="cardrcd_amt" id="cardrcd_amt" type="text"  style="width:90px;border:1px solid #ddd;text-align:right;" value="0" class="inptSt amtBal"/></td>
		<td width="" style="text-align:center;background-color:#ffffff;width:16%;height:31px;">
		<select name="card_desc" id="card_desc" style="width:90px;border:1px solid #ddd;" class="inptSt fstChUPPRCase" disabled >
		<option value="">--Select--</option>
		<?php 
		$sqlF=mysql_query("select * from company_master where classf='creditcard' AND status='1'");
		while($rowF=mysql_fetch_array($sqlF)) {	?>
		<option value="<?php echo $rowF['comp_name']; ?>"><?php echo strtoupper($rowF['comp_name']); ?></option>
		<?php }	?>
		</select>
		<!--<input name="card_desc" id="card_desc" type="text"  style="width:30px;" value="" class="inptSt"/>--></td>
		<td width="" style="text-align:center;background-color:#ffffff;width:16%;height:31px;"><input name="card_tips" id="card_tips" type="text"  style="width:90px;border:1px solid #ddd;" value="" class="inptSt remTIps"/></td>
		<td width="" style="text-align:center;background-color:#ffffff;width:30%;height:31px;"><input name="card_rem" id="card_rem" type="text"  style="width:170px;border:1px solid #ddd;" value="" class="inptSt remSum" /></td>
	</tr>
	<tr>
							<td width="" style="text-align:center;background-color:#ffffff;width:20%;height:31px;"><input name="upircd_amt" id="upircd_amt" type="text"  style="width:90px;border:1px solid #ddd;text-align:right;" value="0" class="inptSt amtBal pMode"/></td>
							<td width="" style="text-align:center;background-color:#ffffff;width:16%;height:31px;">
								<select name="upi_desc" id="upi_desc" style="width:90px;border:1px solid #ddd;" class="inptSt" disabled >
									<option value="">--Select--</option>
									<?php 
										$sqlF=mysql_query("select * from company_master where classf='upi'");
										while($rowF=mysql_fetch_array($sqlF)) {	?>
										<option value="<?php echo $rowF['comp_name']; ?>"><?php echo $rowF['comp_name']; ?></option>
									<?php }	?>
								</select>
							<!--<input name="card_desc" id="card_desc" type="text"  style="width:30px;" value="" class="inptSt"/>--></td>
							<td width="" style="text-align:center;background-color:#ffffff;width:16%;height:31px;"><input name="upi_tips" id="upi_tips" type="text"  style="width:90px;border:1px solid #ddd;" value="" class="inptSt"/></td>
							<td width="" style="text-align:center;background-color:#ffffff;width:30%;height:31px;"><input name="upi_rem" id="upi_rem" type="text"  style="width:170px;border:1px solid #ddd;" value="" class="inptSt remSum"/></td>
						</tr>
	<tr>
		<td width="" style="text-align:center;background-color:#ffffff;width:20%;height:31px;"><input name="comprcd_amt" id="comprcd_amt" type="text"  style="width:90px;border:1px solid #ddd;text-align:right;" value="0" class="inptSt amtBal"/></td>
	
		<td width="" style="text-align:center;background-color:#ffffff;width:16%;height:31px;">
		<?php 
	 $sqlBS=mysql_query("select distinct comp_code,comp_name from company_master where  classf='company' order by comp_name ASC");
		?>
			<select name="comp_desc" id="comp_desc" style="width:90px;border:1px solid #ddd;font-size:12px;" class="fstChUPPRCase inptSt" disabled >
			<option value="">--Select--</option>
			<?php while($rowBS=mysql_fetch_array($sqlBS)) { ?>
			<option value="<?php echo $rowBS['comp_code'];?>"><?php echo strtoupper($rowBS['comp_name']);?></option>
			<?php } ?>
			</select>
		</td>
				
		<td width="" style="text-align:center;background-color:#ffffff;width:16%;height:31px;"><input name="comp_tips" id="comp_tips" type="text"  style="width:90px;border:1px solid #ddd;" value="" class="inptSt remTIps"/></td>
		<td width="" style="text-align:center;background-color:#ffffff;width:30%;height:31px;"><input name="comp_rem" id="comp_rem" type="text"  style="width:170px;border:1px solid #ddd;" value="" class="inptSt remSum "/></td>
	</tr>
	<tr>
		<td width="" style="text-align:center;background-color:#ffffff;width:20%;height:31px;"><input name="chequercd_amt" id="chequercd_amt" type="text"  style="width:90px;border:1px solid #ddd;text-align:right;" value="0" class="inptSt amtBal"/></td>
		<td width="" style="text-align:center;background-color:#ffffff;width:16%;height:31px;"><input name="cheq_desc" id="cheq_desc" type="text"  style="width:90px;border:1px solid #ddd;" value="" class="inptSt datepicker" placeholder="cheque date"/></td>
		<td width="" style="text-align:center;background-color:#ffffff;width:16%;height:31px;"><input name="cheq_tips" id="cheq_tips" type="text"  style="width:90px;border:1px solid #ddd;" value="" class="inptSt remTIps"/></td>
		<td width="" style="text-align:center;background-color:#ffffff;width:30%;height:31px;"><input name="cheq_rem" id="cheq_rem" type="text"  style="width:170px;border:1px solid #ddd;" value="" class="inptSt remSum"/></td>
	</tr>
	<tr>
		<td width="" style="text-align:center;background-color:#ffffff;width:20%;height:31px;"><input name="neftrcd_amt" id="neftrcd_amt" type="text"  style="width:90px;border:1px solid #ddd;text-align:right;" value="0" class="inptSt amtBal"/></td>
		
		<td width="" style="text-align:center;background-color:#ffffff;width:16%;height:31px;">
		<?php $sqlBS=mysql_query("select distinct bank_code,bank_name from mybanquet.bq_bankname where status='1'");?>
			<!--<select name="neft_desc" id="neft_desc" style="width:90px;border:1px solid #ddd;font-size:12px;" class="fstChUPPRCase inptSt" disabled >
			<option value="">--Select--</option>
			<?php while($rowBS=mysql_fetch_array($sqlBS)) { ?>
			<option value="<?php echo $rowBS['bank_code'];?>"><?php echo strtoupper($rowBS['bank_name']);?></option>
			<?php } ?>
			</select>-->
			<input name="neft_desc" id="neft_desc" type="text"  style="width:90px;border:1px solid #ddd;" value="" class="inptSt"/>
		</td>
		<td width="" style="text-align:center;background-color:#ffffff;width:16%;height:31px;"><input name="neft_tips" id="neft_tips" type="text"  style="width:90px;border:1px solid #ddd;" value="" class="inptSt remTIps"/></td>
		<td width="" style="text-align:center;background-color:#ffffff;width:30%;height:31px;"><input name="neft_rem" id="neft_rem" type="text"  style="width:170px;border:1px solid #ddd;" value="" class="inptSt remSum"/></td>
	</tr>
	<tr>
		<td width="" style="text-align:center;background-color:#ffffff;width:20%;height:31px;"><input name="roomrcd_amt" id="roomrcd_amt" type="text"  style="width:90px;border:1px solid #ddd;text-align:right;" value="0" class="inptSt amtBal"/></td>
		<td width="" style="text-align:center;background-color:#ffffff;width:16%;height:31px;">
		<select name="room_desc" id="room_desc" style="width:90px;border:1px solid #ddd;" class="inptSt" onChange="selRoomNo();" disabled >
		<option value="">--Select--</option>
		
		</select>
		<!--<input name="room_desc" id="room_desc" type="text"  style="width:90px;border:1px solid #ddd;" value="" class="inptSt"/>
		<div id="suggesstion-box"></div>-->
		</td>
		<td width="" style="text-align:center;background-color:#ffffff;width:16%;height:31px;"><input name="room_tips" id="room_tips" type="text"  style="width:90px;border:1px solid #ddd;" value="" class="inptSt remTIps"/>
		</td>
		<td width="" style="text-align:center;background-color:#ffffff;width:30%;height:31px;"><input name="room_rem" id="room_rem" type="text"  style="width:170px;border:1px solid #ddd;" value="" class="inptSt remSum"/></td>
	</tr>
	<?php /* if(isset($rowBh['net_amt']) && $rowBh['net_amt']<0) { */ ?>
	<tr>
		<td width="" style="text-align:center;background-color:#ffffff;width:20%;height:31px;"><input name="refundrcd_amt" id="refundrcd_amt" type="text" style="width:90px;border:1px solid #ddd;text-align:right;" value="<?php if(isset($refund)){echo $refund;}else{echo '0';}?>" class="inptSt amtBal" disabled /></td>
		<td width="" style="text-align:center;background-color:#ffffff;width:16%;height:31px;"><input name="refund_desc" id="refund_desc" type="text"  style="width:90px;border:1px solid #ddd;" value="" class="inptSt"  /></td>
		<td width="" style="text-align:center;background-color:#ffffff;width:16%;height:31px;"><input name="refund_tips" id="refund_tips" type="text"  style="width:90px;border:1px solid #ddd;" value="" class="inptSt remTIps" disabled /></td>
		<td width="" style="text-align:center;background-color:#ffffff;width:30%;height:31px;"><input name="refund_rem" id="refund_rem" type="text"  style="width:170px;border:1px solid #ddd;" value="" class="inptSt remSum"  /></td>
	</tr>
	
	<tr>
		<td width="" style="text-align:center;background-color:#ffffff;width:20%;height:31px;"><input name="voidrcd_amt" id="voidrcd_amt" type="text" style="width:90px;border:1px solid #ddd;text-align:right;" value="<?php if(isset($refund)){echo $refund;}else{echo '0';}?>" class="inptSt amtBal"  /></td>
		<td width="" style="text-align:center;background-color:#ffffff;width:16%;height:31px;"><input name="void_desc" id="void_desc" type="text"  style="width:90px;border:1px solid #ddd;" value="" class="inptSt"  /></td>
		<td width="" style="text-align:center;background-color:#ffffff;width:16%;height:31px;"><input name="void_tips" id="void_tips" type="text"  style="width:90px;border:1px solid #ddd;" value="" class="inptSt remTIps"  /></td>
		<td width="" style="text-align:center;background-color:#ffffff;width:30%;height:31px;"><input name="void_rem" id="void_rem" type="text"  style="width:170px;border:1px solid #ddd;" value="" class="inptSt remSum"  /></td>
	</tr>
	</table>
</div>
<style>
.btn-sm{
    padding: 3px 10px;
    width: 25%;
}
.nowrap{white-space: nowrap;}
.table-responsive{
overflow:hidden;
}
</style>

<div class="col-md-12  responsive nowrap " style=" padding-left:3px;">
		<button type="submit" id="confirm" class="btn btn-primary btn-sm btn-responsive" style="" onclick="return formSubmit();" disabled ><img src="../../images/saves.png" class="sbtBtnImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">S</span>ubmit</button>
		
		<a href="<?php echo $home_path; ?>/transaction/frontdesk/view-resettlement.php"><button type="button" id="confirm" class="btn btn-primary btn-sm btn-responsive" style="" ><img src="../../images/saves.png" class="sbtBtnImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">R</span>e-settle</button></a>	
		
		<button type="reset" id="rest" class="btn btn-primary btn-sm btn-responsive" style=""><img src="../../images/clear.png" class="sbtBtnImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">C</span>lear</button>
		
		<a href="<?php echo $home_path; ?>/dashboard.php"><button type="button" id="exit" name="exit" class="btn btn-primary btn-sm btn-responsive" style="" ><img src="<?php echo $home_path; ?>/images/exitBut.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button></a>	
	</div>
	

</div>
	</div>
	</div>
	</form>	
</body>
</html>