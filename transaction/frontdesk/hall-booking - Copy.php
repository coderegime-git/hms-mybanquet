<?php
ob_start();
include("../../config.php");
include("../../header.php");
include("../../util.php");

$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$curTime=date('H:i:s');
?>	
<style>
.frmSearch {border: 1px solid #F0F0F0;/* background-color:#C8EEFD; */margin: 2px 0px;/* padding:40px; */}
#country-list{float:left;font-size:14px;list-style:none;margin:18px 0 0 0px;padding:0;width:210px;position: absolute;z-index: 1;}
#country-list li{padding: 2px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#country-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;}
</style>

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
<?php 
/* $result = mysql_query("select distinct room_type from room_master") ;
$tmpStr=""; $btStr=""; $i=0; 
$btStr ='<option value="">---select--</option>';
while($row = mysql_fetch_array( $result )) { 

$tmpStr ='<option value="'.$row['room_type'].'">'.$row['room_type'].'</option>';
$btStr .=$tmpStr;
 $i++;
 
} */

?>	
 
<?php
/* $sqlpP=mysql_query("select * from property_definition");
$rowpP=mysql_fetch_array($sqlpP);	
				
$resultP = mysql_query("select distinct plan_code from meal_plan") ;
$tmpStrP=""; $btStrP=""; $i=0; 
$btStrP ='<option value="">---select--</option>';
while($rowP = mysql_fetch_array( $resultP )) { 
 if($rowP['plan_code']==$rowpP['meal_plan']) {
	$tmpStrP ='<option value="'.$rowP['plan_code'].'" selected >'.$rowP['plan_code'].'</option>';
 }else{
	$tmpStrP ='<option value="'.$rowP['plan_code'].'">'.$rowP['plan_code'].'</option>';
 }
$btStrP .=$tmpStrP;
 $i++;} */ ?> 
.
<?php 
/* $resultN = mysql_query("select distinct nationality_code,country,native from nationality") ;
$tmpStrN=""; $btStrN=""; $i=0; 
$btStrN ='<option value="">---select--</option>';
while($rowN = mysql_fetch_array( $resultN )) { 
if($rowN['native']=='1'){
	$tmpStrN ='<option value="'.$rowN['nationality_code'].'" selected >'.$rowN['nationality_code'].'</option>';
}else{
$tmpStrN ='<option value="'.$rowN['nationality_code'].'">'.$rowN['nationality_code'].'</option>';	
}
$btStrN .=$tmpStrN;
 $i++;} */ ?> 
 <script>
	var item_codes;
	var arr=new Array();
	<?php $result = mysql_query("select * from company_master where status='1'") ;?>
	<?php $str=""; $i=0; 
		$k=0;
		$tmpStr="";
	while($row = mysql_fetch_array( $result )) {
		/* $item_qty='1';
		$itemVal=floatval($row['item_rate']*$item_qty); */
		?>
		
	  arr[<?php echo $i;?>]=new Array();
	  arr[<?php echo $i;?>][0]='<?php echo $row['comp_name']; ?>';
	  arr[<?php echo $i;?>][1]='<?php echo $row['address1']; ?>';
	  arr[<?php echo $i;?>][2]='<?php echo $row['address2']; ?>';
	  arr[<?php echo $i;?>][3]='<?php echo $row['city']; ?>';
	  arr[<?php echo $i;?>][4]='<?php echo $row['pin_code']; ?>';
	  arr[<?php echo $i;?>][5]='<?php echo $row['state']; ?>';
	  arr[<?php echo $i;?>][6]='<?php echo $row['country']; ?>';
	  arr[<?php echo $i;?>][7]='<?php echo $row['phone']; ?>';
	  arr[<?php echo $i;?>][8]='<?php echo $row['email']; ?>';
	  arr[<?php echo $i;?>][9]='<?php echo $row['comp_code']; ?>';
	   <?php if($i==0) { 
		$str="'".$row['comp_name']."'";
	   }else{	
		$str=$str.",'". $row['comp_name']."'";
      }?>	 
	  
	  	  
	 <?php $i++; } ?>	
	
	item_codes=<?php echo ("[" . $str. "]") ?>;
	/* alert(item_codes); */
	
 </script>

 <!--<script type="text/javascript" src="<?php echo $home_path;?>/js/item.js"></script>
<script type="text/javascript" src="<?php echo $home_path;?>/js/util.js"></script>-->
 
<script type="text/javascript">
$(document).ready(function(){
/* 	$( "#departure_date" ).datepicker({ minDate: 0}); */
		 $(".datepicker" ).datepicker({
	    changeMonth:true,
     changeYear:true,
     yearRange:"-100:+0",
	  minDate: 0,
     dateFormat:"dd/mm/yy"
  });
  
   $(".datepicker1" ).datepicker({
     changeMonth:true,
     changeYear:true,
     yearRange:"-100:+0",
	  minDate: 0,
     dateFormat:"dd/mm/yy"
  });
  

$(".arrDt").keyup(function(){
	
	if ($(this).val().length == 2){
		$(this).val($(this).val() + "/");
	}else if ($(this).val().length == 5){
		$(this).val($(this).val() + "/");
	}
	
});



		
	 $("#msgFo").fadeOut(5000);
	jQuery("#hotelDefi").validationEngine();
	
var dt = new Date();
var time = dt.getHours() + ":" + dt.getMinutes() ;
var Dptime = '12:00' ;
$('#departure_time').val(Dptime);
$('#arrival_time').val(time);
 
$('input[name^=book_date]').live('keyup', function() {
	if ($(this).val().length == 2){
		$(this).val($(this).val() + "/");
	}else if ($(this).val().length == 5){
		$(this).val($(this).val() + "/");
	}
	
});
$('input[name^=departure_date]').live('keyup', function() {
	if ($(this).val().length == 2){
		$(this).val($(this).val() + "/");
	}else if ($(this).val().length == 5){
		$(this).val($(this).val() + "/");
	}
	
});

$('input[name^=from_time]').live('keyup', function() {
	if ($(this).val().length == 2){
		$(this).val($(this).val() + ":");
	}/* else if ($(this).val().length == 5){
		$(this).val($(this).val() + ":");
	} */
});

$('input[name^=to_time]').live('keyup', function() {
	if ($(this).val().length == 2){
		$(this).val($(this).val() + ":");
	}/* else if ($(this).val().length == 5){
		$(this).val($(this).val() + ":");
	} */
});

	
	$("#company_name").keyup(function(){
		$.ajax({
		type: "POST",
		url: "../../action/selCompanyNameAUTOsrch.php",
		data:'keyword='+$(this).val(),
		beforeSend: function(){
			$("#company_name").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
		},
		success: function(data){
			/*  alert(data); */
			$("#suggesstion-box").show();
			$("#suggesstion-box").html(data);
			$("#company_name").css("background","#FFF");
		}
		});
	});



});


function arrDateSel(e){
book_date=$('#book_date'+e).val();
adtDate=$('#adtDate').val();
tt=$('.arrDt').val().replace(/[A-Za-z$-/]/g, "");
nsnNo = tt.replace(/(\d{2})(\d{2})(\d{4})/, '$1/$2/$3');
$('.arrDt').val(nsnNo);
var pattern =/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/;
  if (book_date == null || book_date == "" || !pattern.test(book_date)) {
	  alert("check date format dd/mm/yyyy!.");
	  $('#book_date'+e).val('');
	  $('#book_date'+e).focus();
	}
   
$.ajax({
		type:'GET',
		url:'  ../../action/chkRmBOokARrDAte.php',
			data:{
			book_date:book_date,
			adtDate:adtDate
			},
			success:function(data){
				/*  alert(data); */
				if(data==1){
					alert("Booking date less than audit date!.");
					$('#book_date'+e).val('');
					$('#book_date'+e).focus();
				}
												
			}
	});
	
	

}

/* function arrDateSel1(vl){
	arDt=$('#book_date'+vl).val();
	depDt=$('#departure_date'+vl).val();
	adtDate=$('#adtDate').val();
	tt=$('#book_date'+vl).val().replace(/[A-Za-z$-/]/g, "");
	nsnNo = tt.replace(/(\d{2})(\d{2})(\d{4})/, '$1/$2/$3');
	$('#book_date'+vl).val(nsnNo);
	var EnteredDate = document.getElementById("book_date"+vl).value; 
	var EnteredDate = $("#book_date"+vl).val();
	var date = EnteredDate.substring(0, 2);
	var month = EnteredDate.substring(3, 5);
	var year = EnteredDate.substring(6, 10);
	var today = new Date();
	var dt = today.getDate();
	var mt = today.getMonth()+1;
	var yr = today.getFullYear();
	tdyYr=mt+'/'+dt+'/'+yr;
	var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
	EntDate=month+'/'+date+'/'+year+' '+time;
	EntDte=month+'/'+date+'/'+year;
	var arrDate = new Date(EntDte);
	var tdyYrR = new Date(tdyYr);
	var endDate = new Date($('#endDate').val());
	var myDate = new Date(year, month - 1, date);
	
var pattern =/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/;
  if (arDt == null || arDt == "" || !pattern.test(arDt)) {
	  alert("check date format dd/mm/yyyy!.");
	  $('#book_date'+vl).val('')
	  $('#book_date'+vl).focus();
	}	
$.ajax({
		type:'GET',
		url:'  ../../action/chkRmBOokARrDAte.php',
			data:{
			book_date:arDt,
			adtDate:adtDate,
			departure_date:depDt
			},
			success:function(data){
				if(data==1){
					alert("Arrival date less than audit date!.");
					$('#book_date'+vl).val('');
					$('#book_date'+vl).focus();
				}
				if(data==2){
					alert("Check the date!.");
					$('#departure_date'+vl).val('');
					$('#departure_date'+vl).focus();
					
				}
								
			}
	});

} */








/* var rowCountR = 0; 
function addMoreRowsROOM(frm) {
	var rnt = $('#addedRowsEDRoom tr').length;
	vl=$('#rowVl').val();
	rmT=$('.rType').val();
	rmTE=$('#room_type'+rnt).val();
	rmTEe=$('#room_type').val();
	
	rntt=rnt+1;
noRms=parseFloat($('#noof_rms'+rnt).val());
sgle=parseFloat($('#single'+rnt).val());
dbl=parseFloat($('#double'+rnt).val());
tple=parseFloat($('#tripple'+rnt).val());
qud=parseFloat($('#quad'+rnt).val());


tot=(parseFloat(sgle+dbl+tple+qud));


a=0;b=0;
$(".nmRm").each(function(){
	noR=$('#noof_rms').val();
	a+=parseFloat($(this).val());
}); 


	if(a>noR){
		alert("Room count greater than no of rooms!");
		$('#noof_rms').val('');
	}else if(tot>noRms){
		alert("Room count greater than no of rooms!");
	}else if(rmTEe==''){
		alert('Please select Room Type.');	
		$('#noof_rms'+rnt).val('');
	}else if(rmTE==''){
		alert('Please select Room Type.');
		$('#noof_rms'+rnt).val('');
	}else{
	rowCountR=rowCountR+1; 
	rowTblCo=0;
	var rowTblCo = $('#addedRowsEDRoom tr').length+2;
	
	var recRow = '<tr id="rowCount1'+rowCountR+'"><td style="text-align:center;" id="room'+rowCountR+'"><input name="book_date[]" id="book_date'+rowCountR+'" type="text" data-validation="required" class="input validate[required] textbox codesUPPERCase arrDt " value="" style="width:88px;margin:5px 0 0 0px" onblur="arrDateSel1('+rowCountR+');" placeholder="dd/mm/yyyy"/></td><td style="text-align:center;"><input  name="arrival_time[]" id="arrival_time" type="text" data-validation="required" class="input validate[required] textbox codesUPPERCase" onblur="checkPropertyCode();" value="<?php echo $curTime;?>" style="width:75px;margin:5px 0 0 0px" /></td><td style="width:100px;text-align:center;" id="room"><input name="departure_date[]" id="departure_date'+rowCountR+'" type="text" data-validation="required" class="input validate[required] textbox codesUPPERCase" style="width:88px;margin:5px 0 0 0px" onblur="depDateSel1('+rowCountR+');" placeholder="dd/mm/yyyy"/></td><td style="text-align:center;"><input name="departure_time[]" id="departure_time" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:75px;margin:5px 0 0 0px" value="<?php echo $curTime;?>"  /></td><td style="text-align:center;"><input name="dys[]" id="dys'+rowCountR+'" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:75px;margin:5px 0 0 0px" value="" readonly /></td><td style="text-align:center;"><select name="room_type[]" id="room_type'+rowCountR+'" style="font-size:12px;width:100px;height:18px;margin:5px 0 0 0px;" onChange="selRoomTypeDuplicate('+rowCountR+');" class="rmmType rType romType romTypee"><?php echo strtoupper($btStr); ?></select></td><td style="text-align:center;" class="sourceonVAL"><input name="noof_rms[]" id="noof_rms'+rowCountR+'" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:50px;margin:5px 0 0 0px" value="0" /></td><td style="text-align:center;" class="sourceonVAL"><input name="single[]" id="single'+rowCountR+'" type="text" class="textbox fstChUPPRCase wagRw1" style="width:50px;margin:5px 0 0 0px" value="0" /></td><td style="text-align:center;" class="sourceonVAL"><input name="doubl[]" id="double'+rowCountR+'" type="text" class="textbox fstChUPPRCase wagRw1" style="width:50px;margin:5px 0 0 0px" value="0" /></td><td style="text-align:center;" class="sourceonVAL"><input name="tripple[]" id="tripple'+rowCountR+'" type="text" class="textbox fstChUPPRCase wagRw1" style="width:50px;margin:5px 0 0 0px" value="0" /></td><td style="text-align:center;" class="sourceonVAL"><input name="quad[]" id="quad'+rowCountR+'" type="text" class="textbox fstChUPPRCase wagRw1" style="width:50px;margin:5px 0 0 0px" value="0" /></td><td style="text-align:center;" class="sourceonVAL"><input name="exp[]" id="exp'+rowCountR+'" type="text" class="textbox fstChUPPRCase" style="width:50px;margin:5px 0 0 0px" value="0" /></td><td style="text-align:center;" class="sourceonVAL"><input name="exc[]" id="exc'+rowCountR+'" type="text" class="textbox fstChUPPRCase" style="width:50px;margin:5px 0 0 0px" value="0"/></td><td style="text-align:center;"><a href="javascript:void(0);" onclick="removeRow('+rowCountR+');" name="remove['+rowCountR+']" id="remove_'+ rowCountR +'" class="deleterecord"><img src="../../images/removeicon.png" class="familyEmpMasterHREF" style="width:18px;height:18px;margin:5px 0 0 -2px;"/></a></td></tr>'; 
	
	jQuery('#addedRowsEDRoom').append(recRow); 
	$('#rowCountR').val(rowCountR);
	
	trF=$('#tariff_rt').val();
		if(trF==1){
			$(".sourceonTAR").show();
			$(".sourceonVAL").hide();	
		}else{
			$(".sourceonTAR").hide();
			$(".sourceonVAL").show();	
		}
    }
}
 */

/* function selRoomTypeDuplicate(vl){
	val=vl-1;
	$('#rowVl').val(vl);
	rmTval=$('#room_type').val();
	rmTpe2=$('#room_type'+vl).val();
	rmTpeVl=$('#room_type'+val).val();
	
	$.ajax({
		type:'GET',
		url:'  ../../action/repeatRoomTypeBooking.php',
			data:{
			rmTval:rmTval,
			rmTpe2:rmTpe2,
			rmTpeVl:rmTpeVl
			},
			success:function(data){
			 
				if(data==1){
					alert("Room type are same.");
					$('#room_type'+vl).val('');
				}
				else if(data==2){
					alert("Room type are same.");
					$('#room_type'+val).val('');
				}
			}
	});
} 


	function removeRow(removeNum) {
		jQuery('#rowCount1'+removeNum).remove(); 
	}  */
	
	
	

var rowCount1 = 0; 
function addMoreRows1(frm) {
	nati=$('#nationality').val();
	$('#addedRowsED1').html('');
	if(nati!='INDIA'){
		rowCount1=rowCount1+1; 
		rowTblCo=0;
		var rowTblCo = $('#addedRowsED1 tr').length+2;

		var recRow1 = '<tr id="rowCount1'+rowCount1+'"><td style="text-align:center;" id="room'+rowCount1+'" colspan="2"><input name="pass_number" id="pass_number" type="text" class="fstChUPPRCase" style="width:117px;margin:0 0 0 -44px;" placeholder="Passport Number"/><input name="passexp_date" id="passexp_date" type="text" data-validation="required" class="fstChUPPRCase" style="width:75px;" placeholder="Expiry Date"/><input name="issue_place" id="issue_place" type="text" data-validation="required" class="fstChUPPRCase" style="width:121px;" placeholder="Issued place"/><a href="javascript:void(0);" onclick="removeRow1('+rowCount1+');" name="remove['+rowCount1+']" id="remove_'+ rowCount1 +'" class="deleterecord" width="15"><img src="../../images/removeicon.png" style="width:18px;height:18px;margin:0 0 0 321px;"/></a></td></tr><tr id="rowCount2'+rowCount1+'"><td style="text-align:center;" id="room'+rowCount1+'" colspan="2"><input name="visa_number" id="visa_number" type="text" data-validation="required" class="fstChUPPRCase" style="width:117px;margin:0 0 0 -44px;" placeholder="Visa Number"/><input name="visa_expiry" id="visa_expiry" type="text" data-validation="required" class="fstChUPPRCase" style="width:75px;" placeholder="Visa Expiry Date"/><input name="visa_issue" id="visa_issue" type="text" data-validation="required" class="fstChUPPRCase" style="width:121px;" placeholder="Issued place"/><a href="javascript:void(0);" onclick="removeRow2('+rowCount1+');" name="remove['+rowCount1+']" id="remove_'+ rowCount1 +'" class="deleterecord" width="15"><img src="../../images/removeicon.png" style="width:18px;height:18px;margin:0 0 0 321px;"/></a></td></tr>'; 

		jQuery('#addedRowsED1').append(recRow1); 
		$('#rowCount1').val(rowCount1);
	}else{
		$('#addedRowsED1').hide();
	}
	
	if(nati=='INDIA'){
		$('#addedRowsED1').hide();
	}
}

function removeRow1(removeNum) {
	jQuery('#rowCount1'+removeNum).remove(); 
} 	
function removeRow2(removeNum) {
	jQuery('#rowCount2'+removeNum).remove(); 
} 

function selCompanyName(){
	comp=$('#company_name').val();
	$.ajax({
		type:'GET',
		url:'  ../../action/selCompanyNameForCHkIN.php',
			data:{
			comp:comp
			},
			success:function(data){
				 /* alert(data); */
				  opt=data.split('&#');
				 $('#company_name').val(opt[0]);
				 $('#comaddress1').val(opt[1]);
				 $('#comaddress2').val(opt[2]);
				 $('#comcity').val(opt[3]);
				 $('#compincode').val(opt[4]);
				 $('#comphone').val(opt[5]);
				 $('#company').val(opt[6]);
			}
	});
}

function selectRFQ(val) {
$("#company_name").val(val);
$("#suggesstion-box").hide();
}


function selSessionName(e){
sess=$("#session").val(e);
	$.ajax({
		type:'GET',
		url:'  ../../action/selSessionDet.php',
			data:{
			sess:sess
			},
			success:function(data){
				 alert(data);
				  opt=data.split('&#');
				 $('#company_name').val(opt[0]);
				
			}
	});
}


function checkformSubmit(){
	var rnt = $('#addedRowsEDRoom tr').length;
	vl=$('#rowVl').val();
	rmT=$('.rType').val();
	rmTE=$('#room_type'+rnt).val();
	rmTEe=$('#room_type').val();
	var status = true;	
	totTt=0;
	
	rntt=rnt+1;
noRms=parseFloat($('#noof_rms'+rnt).val());
sgle=parseFloat($('#single'+rnt).val());
dbl=parseFloat($('#double'+rnt).val());
tple=parseFloat($('#tripple'+rnt).val());
qud=parseFloat($('#quad'+rnt).val());

/* alert(sgle); */
tot=(parseFloat(sgle+dbl+tple+qud));
/* alert(parseFloat(dbl)); */

a=0;b=0;
$(".nmRm").each(function(){
	noR=$('#noof_rms').val();
	a+=parseFloat($(this).val());
}); 


	if(a>noR){
		alert("Room count greater than no of rooms!");
		$('#noof_rms').val('');
		status = false;
	}else if(tot>noRms){
		alert("Room count greater than no of rooms!");
		$('#noof_rms'+rnt).val('');
		status = false;
	}else if(rmTEe==''){
		alert('Please select Room Type.');	
		$('#noof_rms'+rnt).val('');
		status = false;
	}else if(rmTE==''){
		alert('Please select Room Type.');
		$('#noof_rms'+rnt).val('');
		status = false;
	}
}
</script> 
<style>
.spanClr{
	color: #5b503b;
    display: block;
    float: left;
    font-size: 12px;
    font-weight: normal;
    padding: 0px 9px 0 5px;
		
}
hr.style-one {
    border: 0;
    height: 1px;
    background: #333;
    background-image: linear-gradient(to right, #ccc, #333, #ccc);
	margin:-3px 0 0 0;
}
hr.style-one1 {
    border: 0;
    height: 1px;
    background: #333;
    background-image: linear-gradient(to right, #ccc, #333, #ccc);
	margin:-7px 0 0 0;
}


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


</style>
<body class="bgBODY">
<div class="about">
<?php 	
/* echo $_GET['msg']; */ 
if(isset($_GET['msg'])){
?>
	<p style="text-align:center;margin:-16px 0 0 0;">
		<label id="msgFo" class="" style="color:#7B0E0E;"><?php echo $_GET['msg']; ?></label>
	</p>
<?php } ?>
<div id="invoice" style="">
	<!--<div class="container" >-->
		<div class="" >


<?php
$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$curDate=$rowAC['cur_date'];
?>
<link rel="stylesheet" type="text/css" href="<?php echo $home_path;?>/tcal-picker/tcal.css" />
<script type="text/javascript" src="<?php echo $home_path;?>/tcal-picker/tcal.js"></script> 
<div id="addcustomer" class="frmCentr divBrd frmBgClr" style="width:1039px;">
	<h3 id="Userhd"><b>HALL BOOKING</b></h3>
<form id="hotelDefi" name="hotelDefi" enctype="multipart/form-data" action="<?php echo $home_path;?>/action/add_hall_booking.php" method="post" class="" style="">
	<input name="incLc" id="incLc" type="hidden" style="" value=""/>
	<input type="hidden" name="rowVl" id="rowVl"/>
	<input type="hidden" name="rmomType" id="rmomType"/>
	<input type="hidden" name="adtDate" id="adtDate" value="<?php echo $curDate?>"/>
	<div>
	
<table class="table" cellpadding="0" cellspacing="0" border="0" class="table" style="text-align:center;font-size:12px;margin:0px 0 10px 0px;">
	<tr>
		<th width="" style="text-align:center;background-color:#F5F5F5;">Date</th>
		<th width="" style="text-align:center;background-color:#F5F5F5;">Venue</th>
		<th width="" style="text-align:center;background-color:#F5F5F5;">Session</th>
		<th width="" style="text-align:center;background-color:#F5F5F5;">From</th>
		<th width="" style="text-align:center;background-color:#F5F5F5;">To</th>
		<th width="" style="text-align:center;background-color:#F5F5F5;">Seating</th>
		<th width="" style="text-align:center;background-color:#F5F5F5;">Function</th>
		<th width="" style="text-align:center;background-color:#F5F5F5;">Exp </th>
		<th width="" style="text-align:center;background-color:#F5F5F5;">Guarant</th>
		<th width="" style="text-align:center;background-color:#F5F5F5;">Rate</th>
		<th width="" style="text-align:center;background-color:#F5F5F5;">Status</th>
		<th width="" style="text-align:center;background-color:#F5F5F5;">Guest</th>
		<!--<th style="text-align:center;"><img src="../../images/plus.png" id="add-item" onclick="addMoreRowsROOM(this.form);" style="width:15px;height:15px;cursor:pointer;"/></th>-->
	</tr>
<?php 
for($cc=1;$cc<4;$cc++){
?>
<tr id=""><td style="text-align:center;" id="room"><input  name="book_date[]" id="book_date<?php echo $cc;?>" type="text" data-validation="required" class="textbox codesUPPERCase datepicker" value="" style="width:88px;margin:0px 0 0 0px" onblur="arrDateSel('<?php echo $cc;?>');" placeholder="dd/mm/yyyy"/></td><td style="text-align:center;" >
	<?php $sqlBS=mysql_query("select distinct venue_code,venue_desc from bq_venue where status='1'"); ?>
	<select name="venue[]" id="venue<?php echo $cc;?>" class="fstChUPPRCase" style="width:100px;float:left;font-size:12px;" onChange="selVenueName('<?php echo $cc;?>');">
	<option value="">--Select--</option>
	<?php  while($rowBS=mysql_fetch_array($sqlBS)) {  ?>
	<option value="<?php  echo $rowBS['venue_code']; ?>"><?php  echo $rowBS['venue_desc'];?></option>
	<?php  }  ?>
	</select>
	</td>
	<td style="width:100px;text-align:center;" id="room">
	
	<?php $sqlBS=mysql_query("select distinct sess_code,sess_name from bqt_session where status='1'"); ?>
		<select name="session[]" id="session<?php echo $cc;?>" class="fstChUPPRCase" style="width:100px;float:left;font-size:12px;" onChange="selSessionName('<?php echo $cc;?>');">
		<option value="">--Select--</option>
		<?php  while($rowBS=mysql_fetch_array($sqlBS)) {  ?>
		<option value="<?php  echo $rowBS['sess_code']; ?>"><?php  echo $rowBS['sess_name'];?></option>
		<?php  }  ?>
		</select>
	</td>
	
	<td style="text-align:center;"><input name="from_time[]" id="from_time<?php echo $cc;?>" type="text" class="textbox fstChUPPRCase" style="width:75px;margin:0px 0 0 0px" /></td><td style="text-align:center;"><input name="to_time[]" id="to_time<?php echo $cc;?>" type="text" data-validation="required" class="textbox fstChUPPRCase" style="width:75px;margin:0px 0 0 0px" value="" /></td><td style="text-align:center;">
	
	<?php $sqlBS=mysql_query("select distinct seat_code,seat_desc from bq_seating where status='1'"); ?>
		<select name="seating[]" id="seating<?php echo $cc;?>" class="fstChUPPRCase" style="width:88px;float:left;font-size:12px;" onChange="selSeatingName('<?php echo $cc;?>');">
		<option value="" >--select--</option>
		<?php  while($rowBS=mysql_fetch_array($sqlBS)) {  ?>
		<option value="<?php  echo $rowBS['seat_code']; ?>"><?php  echo $rowBS['seat_desc'];?></option>
		<?php  }  ?>
		</select>
	</td>
	<td style="text-align:center;" class="sourceonVAL">
	<?php $sqlBS=mysql_query("select distinct func_code,func_desc from bq_function where status='1'"); ?>
		<select name="funct[]" id="funct<?php echo $cc;?>" class="fstChUPPRCase" style="width:120px;float:left;font-size:12px;" onChange="selFunctionName('<?php echo $cc;?>');">
		<option value="">--Select--</option>
		<?php  while($rowBS=mysql_fetch_array($sqlBS)) {  ?>
		<option value="<?php  echo $rowBS['func_code']; ?>"><?php  echo $rowBS['func_desc'];?></option>
		<?php  }  ?>
		</select>
	</td>
	
	<td style="text-align:center;" class="sourceonVAL"><input name="expected[]" id="expected<?php echo $cc;?>" type="text" class="textbox fstChUPPRCase sng nmRm" style="width:50px;margin:0px 0 0 0px" value="0"/></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="guaranted[]" id="guaranted<?php echo $cc;?>" type="text" class="textbox fstChUPPRCase dbl nmRm" style="width:50px;margin:0px 0 0 0px" value="0"/></td>
	<td style="text-align:center;" class="sourceonVAL" value="0"><input name="hall_rate[]" id="hall_rate<?php echo $cc;?>" type="text" class="textbox fstChUPPRCase trpl nmRm" style="width:85px;margin:0px 0 0 0px" value="0" /></td>
	<td style="text-align:center;" class="sourceonVAL">
	<?php $sqlBS=mysql_query("select distinct func_code,func_desc from bq_function where status='1'"); ?>
		<select name="confirm_status[]" id="confirm_status<?php echo $cc;?>" class="fstChUPPRCase" style="width:87px;float:left;" onChange="selVenueName();">
		<option value="">--Select--</option>
		<option value="confirm">Confirmed</option>
		<option value="tentative">Tentative</option>
		<option value="cancel">Cancelled</option>
		<option value="waitlist">Waitlisted</option>
		<option value="enquiry">Enquiry</option>
		</select>
	</td>
	<td style="text-align:center;" class="sourceonVAL"><input name="chief_guest[]" id="chief_guest<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:120px;margin:0px 0 0 0px" value="" /></td>
	</tr>	
<?php 
}
?>	
	<tbody id="addedRowsEDRoom">

	</tbody>
</table>
<!-- Start Room Status -->
	<table style="float:left;width:50%;border-right:1px solid #ddd;margin:4px 0 0 0;font-size:12px;" cellpadding="0" cellspacing="0" class="table" border="0" >
	<tbody>
				
				<tr>
		<th width="" style="text-align:center;background-color:#F5F5F5;height:15px;">Venue</th>
		<?php 
		for($cc=6;$cc<=24;$cc++){
		?>
		<th style="text-align:center;background-color:#F5F5F5;width:5px;height:15px;"><?php echo $cc; ?></th>
		<?php } ?>
	</tr>
		
	<tr id="">
	<td style="text-align:center;" id="room"><input type="text" style="width:52px;height:15px;" readonly /></td>
	<?php 
		for($cc=6;$cc<=24;$cc++){
		?>
	<td style="text-align:center;" id="room"><input type="text" style="width:52px;height:15px;" readonly /></td>
	<?php } ?>
	</tr>
	</tbody>	
	</table>


<?php
$sqlRv=mysql_query("select * from bq_stscolor where roomoccupy_id='1'");
$rowRv=mysql_fetch_array($sqlRv); 
$sqlRd=mysql_query("select * from bq_stscolor where roomoccupy_id='2'");
$rowRd=mysql_fetch_array($sqlRd);
$sqlRo=mysql_query("select * from bq_stscolor where roomoccupy_id='3'");
$rowRo=mysql_fetch_array($sqlRo); 
$sqlRg=mysql_query("select * from bq_stscolor where roomoccupy_id='4'");
$rowRg=mysql_fetch_array($sqlRg);
$sqlRm=mysql_query("select * from bq_stscolor where roomoccupy_id='5'");
$rowRm=mysql_fetch_array($sqlRm);
$sqlRe=mysql_query("select * from bq_stscolor where roomoccupy_id='6'");
$rowRe=mysql_fetch_array($sqlRe);
?>
	<table class="table table-condensed table-hover table-striped table-bordered dsTTrm" cellspacing="0" cellpadding="6" border="3">
		<tr>
			<td style="background-color:#<?php echo $rowRv['room_color']; ?>;color:#fff;width:100px;font-size:12px;text-align:center;">Available</td>
			<td style="background-color:#<?php echo $rowRd['room_color']; ?>;color:#fff;width:100px;font-size:12px;text-align:center;">Reserved</td>
			<td style="background-color:#<?php echo $rowRo['room_color']; ?>;color:#fff;width:100px;font-size:12px;text-align:center;">Wait Listed </td>
			<td style="background-color:#<?php echo $rowRg['room_color']; ?>;color:#fff;width:100px;font-size:12px;text-align:center;">Enquiry </td>
			<td style="background-color:#<?php echo $rowRm['room_color']; ?>;color:#fff;width:100px;font-size:12px;text-align:center;">Tentative</td>
			<td style="background-color:#<?php echo $rowRe['room_color']; ?>;color:#fff;width:100px;font-size:12px;text-align:center;">Blocked</td>
		</tr>
		
</table>
<!-- End Room Status -->
	
	<table style="float:left;width:32%;border-right:1px solid #ddd;margin:8px 0 0 0;" cellpadding="0" cellspacing="0" class="table" border="0" >
			<tbody id="addedRowsED1">

			</tbody>
			<tr>
			<td width="" valign="top"><label>Type <em>*</em></label></td>
<td valign="top"><select name="corporate" id="corporate" class="fstChUPPRCase textbox" style="width:210px;float:left;" onChange="corPind();">
<option value="">--Select--</option>
<option value="corporate">Corporate</option>
<option value="individual">Individual</option>
</select></td>
			</tr>
<tr>
<td width="" valign="top"><label>Title <em>*</em></label></td>
<td valign="top"><select name="title" id="title" class="fstChUPPRCase textbox" style="width:50px;float:left;" onChange="corPind();">
<option value="mr">Mr</option>
<option value="mrs">Mrs</option>
<option value="ms">Ms</option>
<option value="dr">Dr</option>
</select>
<input name="guest_name" id="guest_name" type="text" class="textbox fstChUPPRCase" style="width:160px" placeholder="Name"/>
</td>
</tr>
			<tr>
					<td width="" valign="top"><label>Address 1 </label></td>
					<td valign="top"><input name="address1" id="address1" type="text" class="textbox fstChUPPRCase" style="width:210px"/></td>
					</tr>
					<tr>
					<td width="" valign="top"><label>Address 2 </label></td>
					<td valign="top"><input name="address2" id="address2" type="text" class="textbox fstChUPPRCase" style="width:210px"/></td>
					</tr>
			<tr>
				<td width="" valign="top"><label>City <em>*</em></label></td>
				<td width="" valign="top"><input name="city" id="city" type="text" class="textbox fstChUPPRCase" style="width:87px"/><span class="spanClr">Zip</span>
				<input name="pin_code" id="pin_code" type="text" class="textbox fstChUPPRCase" style="width:80px;margin:0 0 0 11px;" /></td>
				
			</tr>
			<tr>
				<td width="" valign="top"><label>Country <em>*</em></label></td>
				<td width="" valign="top"><input name="country" id="country" type="text" class="textbox fstChUPPRCase" style="width:87px"/><span class="spanClr">State</span>
				<input name="state" id="state" type="text" class="textbox fstChUPPRCase" style="width:80px;" /></td>
				
			</tr>
			<tr>
			<td width="" valign="top"><label>Phone <em>*</em></label></td>
			<td valign="top"><input name="phone" id="phone" type="text" class="textbox fstChUPPRCase" style="width:210px"/></td>
			</tr>
			<tr>
			<td width="" valign="top"><label>E-mail <em>*</em></label></td>
			<td valign="top"><input name="email" id="email" type="text" class="textbox" style="width:210px"/></td>
			</tr>
			
				
	</tbody>
				</table>
				<table style="float:left;width:30%;border-right:1px solid #ddd;margin:8px 0 0 0;" cellpadding="0" cellspacing="0" class="table" border="0" >
					<tr>
						<td width="" valign="top"><label>Company</label></td>
						<td valign="top">
							<input name="company_name" id="company_name" type="text" class="textbox fstChUPPRCase" style="width:210px" />
						<div id="suggesstion-box"  onClick="selCompanyName();"></div>
						
					<input name="company" id="company" type="hidden" class="textbox fstChUPPRCase" style="width:120px;margin:0 0 0 11px;" />
					</td>
					</tr>
					<tr>
					<td width="" valign="top"><label>Address 1 </label></td>
					<td valign="top"><input name="comaddress1" id="comaddress1" type="text" class="textbox fstChUPPRCase" style="width:210px"/></td>
					</tr>
					<tr>
					<td width="" valign="top"><label>Address 2 </label></td>
					<td valign="top"><input name="comaddress2" id="comaddress2" type="text" class="textbox fstChUPPRCase" style="width:210px"/></td>
					</tr>
					<tr>
						<td width="" valign="top"><label>City </label></td>
						<td width="" valign="top"><input name="comcity" id="comcity" type="text" class="textbox fstChUPPRCase" style="width:87px"/><span class="spanClr">Zip</span>
						<input name="compincode" id="compincode" type="text" class="textbox fstChUPPRCase" style="width:80px;margin:0 0 0 11px;" /></td>
					</tr>
					
					<tr>
					<td width="" valign="top"><label>Phone </label></td>
					<td valign="top"><input name="comphone" id="comphone" type="text" class="textbox fstChUPPRCase" style="width:210px;"/></td>
					</tr>
					<tr>
					<td width="" valign="top"><label>E-mail <em>*</em></label></td>
					<td valign="top"><input name="comemail" id="comemail" type="text" class="textbox" style="width:210px"/></td>
					</tr>
				<tr>
					<td width="" valign="top"><label>Booker Name</label></td>
					<td valign="top"><input name="booker_name" id="booker_name" type="text" class="textbox" style="width:210px" /></td>
				</tr>
				<tr>
					<td width="" valign="top"><label>Booker No</label></td>
					<td valign="top"><input name="booker_no" id="booker_no" type="text" class="textbox" style="width:210px" /></td>
				</tr>
				
					
												
					</tbody>
				</table>
			
	<table style="width:33%;float:left;margin:8px 0 0 31px;" class="table">
		<tbody>
			<tr>
				<td width="" valign="top"><label>Type of billing <em>*</em></label></td>
				<td valign="top">
				<?php $sqlTB=mysql_query("select distinct bill_code,bill_desc from bq_billinstruc");?>
				<select name="top_code" id="top_code" data-validation="required" class="input validate[required] fstChUPPRCase textbox" style="width:210px">
				<option value="">--Select--</option>
				<?php while($rowTB=mysql_fetch_array($sqlTB)) {?>
					<option value="<?php echo $rowTB['bill_code'];?>" selected ><?php echo $rowTB['bill_desc'];?></option>
				<?php  } ?>
				</select>
				</td>
			</tr>
			<tr>
				<td width="" valign="top"><label>Business Source <em>*</em></label></td>
				<td valign="top">
				<?php $sqlBS=mysql_query("select distinct bs_code,bs_name from bq_bssource where bs_code!=''");?>
				<select name="business_src" id="business_src" data-validation="required" class="input validate[required] fstChUPPRCase textbox" style="width:210px">
				<option value="">--Select--</option>
				<?php while($rowTB=mysql_fetch_array($sqlBS)) { ?>
						<option value="<?php echo $rowTB['bs_code'];?>" ><?php echo $rowTB['bs_name'];?></option>
				<?php } ?>
				</select>
				</td>
			</tr>
			<tr>
				<td width="" valign="top"><label>Market Segment<em>*</em></label></td>
				<td valign="top">
				<?php $sqlBS=mysql_query("select distinct mscode,msname from bq_marketseg");?>
				<select name="segment_code" id="segment_code" data-validation="required" class="input validate[required] fstChUPPRCase textbox" style="width:210px">
				<option value="">--Select--</option>
				<?php while($rowBS=mysql_fetch_array($sqlBS)) { ?>
				<option value="<?php echo $rowBS['mscode'];?>" ><?php echo $rowBS['msname'];?></option>
				<?php  }?>
				</select>
				</td>
			</tr>
			<tr>
				<td width="" valign="top"><label>Pay Mode <em>*</em></label></td>
				<td valign="top">
				<?php $sqlPm=mysql_query("select distinct pay_code,pay_desc from bq_paymode");?>
				<select name="pay_mode" id="pay_mode" data-validation="required" class="input validate[required] fstChUPPRCase textbox" style="width:210px">
				<option value="">--Select--</option>
				<?php while($rowPm=mysql_fetch_array($sqlPm)) { ?>
				<option value="<?php echo $rowPm['pay_code'];?>"><?php echo $rowPm['pay_desc'];?></option>
				<?php } ?>
				</select>
				</td>
			
			</tr>
					<tr>
				<td width="" valign="top"><label>Remind Date</label></td>
				<td valign="top"><input name="booker_no" id="booker_no" type="text" class="textbox datepicker1" style="width:210px" /></td>
			</tr>
				
			<tr>
						<td width="" valign="top"><label>Remarks</label></td>
						<td valign="top"><textarea cols="34" rows="2" name="remarks" id="remarks" value="" style="text-transform:uppercase;font-size:12px;"></textarea></td>
					</tr>	
				</tbody>
			</table>
		</div>
	
<style>
.butExample {
    background-color: #ffffff;
    border: 1px solid #ddd;
    color: #fff;
    font-family: arial,helvetica,sans-serif;
    font-size: 12px;
    margin-left: -3px;
    padding: 4px 71px;
}
</style>

<table style="border-left:1px solid #ddd;" class="table">
	<tr>
		<td>	
	<div style="margin:0px 0 0 0px;">
		<button type="submit" id="send" name="send" class="butExample bnkSbt frstChr" style="" onclick="return checkformSubmit();"><img src="../../images/saves.png" class="sbtBtnImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">S</span>ubmit</button>
		
		<a href="view-room-booking.php"><button type="button" id="update" class="butExample bnkSbt" onclick="return checkPropertyMasterq();"><img src="../../images/audit.png" class="sbtBtnImg "/>&nbsp;&nbsp;<span class="btnUndLine">V</span>iew</button></a>
		
		<a href="view-hallbook-status.php" target="_blank"><button type="button" id="hallsts" class="butExample" style="" onclick="hall_sts()"><img src="../../images/clear-icon.png" class="sbtBtnImg" style="width:20px;height:20px;" />&nbsp;&nbsp;<span class="btnUndLine">H</span>all Status</button></a>
		
			<button type="reset" id="rest" class="butExample" style="" onclick="cancel_ed()"><img src="../../images/clear-icon.png" class="sbtBtnImg" style="width:20px;height:20px;" />&nbsp;&nbsp;<span class="btnUndLine">C</span>lear</button>
			
		<a href="<?php echo $home_path; ?>/dashboard.php"><button type="button" id="exit" name="exit" class="butExample" style="" onClick="self.close();" ><img src="../../images/exitBut.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button></a>
	</div>
	</td>
	</tr>
</table>		
	
	
	
</div>
	</div>
	</div>
	</form>	
	<?php /* include("../../footer.php"); */ ?>
</body>
</html>