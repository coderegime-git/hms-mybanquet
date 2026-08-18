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
     yearRange:"-100:+5",
	  /* minDate: 0, */
     dateFormat:"dd/mm/yy"
  });
  
   $(".datepicker1" ).datepicker({
     changeMonth:true,
     changeYear:true,
     yearRange:"-100:+5",
	  /* minDate: 0, */
     dateFormat:"dd/mm/yy"
  });
  $(".remindDte" ).datepicker({
     changeMonth:true,
     changeYear:true,
     yearRange:"-100:+5",
	  minDate: 0,
     dateFormat:"dd/mm/yy"
  });
   /* $("#book_date1" ).focus(); */

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
			 /* alert(data); */
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
	
	
	
/* 
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
} */

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
				 $('#comstate').val(opt[5]);
				 $('#comcountry').val(opt[6]);
				 $('#comphone').val(opt[7]);
				 $('#comemail').val(opt[8]);
				$('#comp_code').val(opt[9]);
			}
	});
}

function selectRFQ(val) {
$("#company_name").val(val);
$("#suggesstion-box").hide();
}


function selSessionName(e){
sess=$("#session"+e).val();
venu=$("#venue"+e).val();
bkDt=$("#book_date"+e).val();
	$.ajax({
		type:'GET',
		url:'  ../../action/selSessionDet.php',
			data:{
			sess:sess,
			venu:venu,
			bkDt:bkDt
			},
			success:function(data){
				 /* alert(data); */
				 opt=data.split(',');
				 $('#from_time'+e).val(opt[0]);
				 $('#to_time'+e).val(opt[1]);
				 $('#seating'+e).focus();
				 
				if(opt[0]==2){
					alert(opt[1]);
					$("#session"+e).val('');
					$("#venue"+e).val('');
					$("#book_date"+e).val('');
					$("#from_time"+e).val('');
					$("#to_time"+e).val('');
					$(".venPROShw1").hide();
					$(".venPROShw").hide();
					$("#venPROShw").show(); 
				}	
				
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

function checkformSubmit() {
	bk1=$("#book_date1").val().trim();
	vn1=$("#venue1").val().trim();
	se1=$("#session1").val().trim();
	fr1=$("#from_time1").val().trim();
	to1=$("#to_time1").val().trim();
	seat1=$("#seating1").val().trim();
	fun1=$("#funct1").val().trim();
	exp1=$("#expected1").val().trim();
	gua1=$("#guaranted1").val().trim();
	hlr1=$("#hall_rate1").val().trim();
	con1=$("#confirm_status1").val().trim();
	
	bk2=$("#book_date2").val().trim();
	vn2=$("#venue2").val().trim();
	se2=$("#session2").val().trim();
	fr2=$("#from_time2").val().trim();
	to2=$("#to_time2").val().trim();
	seat2=$("#seating2").val().trim();
	fun2=$("#funct2").val().trim();
	exp2=$("#expected2").val().trim();
	gua2=$("#guaranted2").val().trim();
	hlr2=$("#hall_rate2").val().trim();
	con2=$("#confirm_status2").val().trim();
	
	bk3=$("#book_date3").val().trim();
	vn3=$("#venue3").val().trim();
	se3=$("#session3").val().trim();
	fr3=$("#from_time3").val().trim();
	to3=$("#to_time3").val().trim();
	seat3=$("#seating3").val().trim();
	fun3=$("#funct3").val().trim();
	exp3=$("#expected3").val().trim();
	gua3=$("#guaranted3").val().trim();
	hlr3=$("#hall_rate3").val().trim();
	con3=$("#confirm_status3").val().trim();
	
	
	if(bk1!="" || vn1!="" || se1!="" || fr1!="" || to1!="" || seat1!="" || fun1!="" || exp1!="" || gua1!="" || hlr1!="" || con1!=""){
		if(bk1==""){
			alert("Booking date should not be blank!.");
			return false;
			
		}else if(vn1==""){
			alert("Venue should not be blank!.");
			return false;
			
		}else if(se1==""){
			alert("Session should not be blank!.");
			return false;
			
		}else if(fr1==""){
			alert("From time should not be blank!.");
			return false;
			
		}else if(to1==""){
			alert("To time should not be blank!.");
			return false;
			
		}else if(seat1==""){
			alert("Seating should not be blank!.");
			return false;
			
		}else if(fun1==""){
			alert("Function should not be blank!.");
			return false;
			
		}else if(exp1==""){
			alert("Expected qty should not be blank!.");
			return false;
			
		}else if(exp1<=0){
			alert("Expected qty should be greater than zero.");
			return false;
			
		}else if(gua1==""){
			alert("Guaranted qty should not be blank!.");
			return false;
			
		}else if(gua1<=0){
			alert("Guaranted qty should be greater than zero.");
			return false;
			
		}else if(hlr1==""){
			alert("Hall rate should not be blank!.");
			return false;
			
		}else if(con1==""){
			alert("Status should not be blank!.");
			return false;
			
		}
		
	}
	
	
	if(bk2!=""){
		if(bk2==""){
			alert("Booking date should not be blank!.");
			return false;
			
		}else if(vn2==""){
			alert("Venue should not be blank!.");
			return false;
			
		}else if(se2==""){
			alert("Session should not be blank!.");
			return false;
			
		}else if(fr2==""){
			alert("From time should not be blank!.");
			return false;
			
		}else if(to2==""){
			alert("To time should not be blank!.");
			return false;
			
		}else if(seat2==""){
			alert("Seating should not be blank!.");
			return false;
			
		}else if(fun2==""){
			alert("Function should not be blank!.");
			return false;
			
		}else if(exp2==""){
			alert("Expected should not be blank!.");
			return false;
			
		}else if(exp2<=0){
			alert("Expected qty should be greater than zero.");
			return false;
			
		}else if(gua2==""){
			alert("Guaranted qty should not be blank!.");
			return false;
			
		}else if(gua2<=0){
			alert("Guaranted qty should be greater than zero.");
			return false;
			
		}else if(hlr2==""){
			alert("Hall rate should not be blank!.");
			return false;
			
		}else if(con2==""){
			alert("Status should not be blank!.");
			return false;
			
		}
		
	}
	
	
	
	if(bk3!=""){
		if(bk3==""){
			alert("Booking date should not be blank!.");
			return false;
			
		}else if(vn3==""){
			alert("Venue should not be blank!.");
			return false;
			
		}else if(se3==""){
			alert("Session should not be blank!.");
			return false;
			
		}else if(fr3==""){
			alert("From time should not be blank!.");
			return false;
			
		}else if(to3==""){
			alert("To time should not be blank!.");
			return false;
			
		}else if(seat3==""){
			alert("Seating should not be blank!.");
			return false;
			
		}else if(fun3==""){
			alert("Function should not be blank!.");
			return false;
			
		}else if(exp3==""){
			alert("Expected should not be blank!.");
			return false;
			
		}else if(exp3<=0){
			alert("Expected qty should be greater than zero.");
			return false;
			
		}else if(gua3==""){
			alert("Guaranted qty should not be blank!.");
			return false;
			
		}else if(gua3<=0){
			alert("Guaranted qty should be greater than zero.");
			return false;
			
		}else if(hlr3==""){
			alert("Hall rate should not be blank!.");
			return false;
			
		}else if(con3==""){
			alert("Status should not be blank!.");
			return false;
			
		}
		
	}
	
	
	

	

	/* else{
		return true;
	} */
}

function selVenueName(e){
	venu=$("#venue"+e).val();
	bkDt=$("#book_date"+e).val();
	ses=$("#session"+e).val();
	$.ajax({
		type:'GET',
		url:'  ../../action/selVeniePROGRESSBar.php',
			data:{
			venu:venu,
			e:e,
			bkDt:bkDt,
			ses:ses
			},
			success:function(data){
				/* alert(data); */
			if(data==1){
				/* $("#venPRODef").show(); 
				$(".venPROShw").hide();
				$(".venPROShw1").hide(); */
			}else{
				 $("#venPRODef").hide(); 
				 $(".venPROShw").show();
				 $(".venPROShw1").show();
				 $(".venPROShw1").append(data);
				}
				
				
			}
	});
}



function arrCopySel(e){
r=e-1;

book_date=$('#book_date'+r).val();	
venue=$('#venue'+r).val();	
session=$('#session'+r).val();	
from_time=$('#from_time'+r).val();	
to_time=$('#to_time'+r).val();	
seating=$('#seating'+r).val();	
funct=$('#funct'+r).val();	
expected=$('#expected'+r).val();	
guaranted=$('#guaranted'+r).val();	
hall_rate=$('#hall_rate'+r).val();	
confirm_status=$('#confirm_status'+r).val();	
chief_guest=$('#chief_guest'+r).val();	


$('#book_date'+e).val(book_date);	
$('#session'+e).val(session);	
$('#from_time'+e).val(from_time);	
$('#to_time'+e).val(to_time);	
$('#seating'+e).val(seating);	
$('#funct'+e).val(funct);	
$('#expected'+e).val(expected);	
$('#guaranted'+e).val(guaranted);	
$('#hall_rate'+e).val(hall_rate);	
$('#confirm_status'+e).val(confirm_status);	
$('#chief_guest'+e).val(chief_guest);

	
}



function expeExcQty(a){
	exp=$("#expected"+a).val(); 
	gua=$("#guaranted"+a).val(); 
	if(exp==0){
		alert('Expected qty should not be zero.');
		$("#expected"+a).val(''); 
		/* $("#expected"+a).focus();  */
	}else{
		
	}
}

function guarExcQty(a){
	exp=parseFloat($("#expected"+a).val()); 
	gua=parseFloat($("#guaranted"+a).val()); 
	if(gua==0){
		alert('Please check the guaranted qty.');
		$("#guaranted"+a).val(''); 
	}else if(gua>exp){
		alert('Should be less than expected qty.');
		$("#guaranted"+a).val(''); 
	}else{
		
	}
}


function selTOtme(a){
	frT=$("#from_time"+a).val(); 
	toT=$("#to_time"+a).val(); 
	spF=frT.split(':');
	sp=toT.split(':');
	if(parseFloat(spF[0])>parseFloat(sp[0])){
		alert("To time should not be less than from time.");
		$("#to_time"+a).val(''); 
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

$sqlR=mysql_fetch_array(mysql_query("select * from bq_hallbooking where booking_no='".$_GET['bkno']."' and venue='".$_GET['ven']."' and session='".$_GET['ses']."'"));
?>
<link rel="stylesheet" type="text/css" href="<?php echo $home_path;?>/tcal-picker/tcal.css" />
<script type="text/javascript" src="<?php echo $home_path;?>/tcal-picker/tcal.js"></script> 
<div id="addcustomer" class="frmCentr divBrd frmBgClr" style="width:1076px;">
	<h3 id="Userhd"><b>HALL BOOKING</b><span ><a href="<?php echo $home_path; ?>/density_chart.php?fromdate=<?php echo $rowAC['cur_date'];?>&todate=<?php echo $rowAC['cur_date'];?>"><button type="button" id="exit" name="exit" class="butExample" style=""  ><i class="fa-eye"></i>Exit</button></a></span></h3>
<form id="hotelDefi" name="hotelDefi" enctype="multipart/form-data" action="<?php echo $home_path;?>/action/add_hall_booking.php" method="post" class="" style="">
	<input name="incLc" id="incLc" type="hidden" style="" value=""/>
	<input type="hidden" name="rowVl" id="rowVl"/>
	<input type="hidden" name="rmomType" id="rmomType"/>
	<input type="hidden" name="adtDate" id="adtDate" value="<?php echo $curDate?>"/>
	<div>
	
<table class="table" cellpadding="0" cellspacing="0" border="0" class="table tableS " style="text-align:center;font-size:12px;margin:0px 0 10px 0px;">
<thead class="tathead">
	<tr>
		<th style="text-align:center;background-color:#F5F5F5;color:#000;width:88px;">Date</th>
		<th style="text-align:center;background-color:#F5F5F5;color:#000;width:100px;">Venue</th>
		<th style="text-align:center;background-color:#F5F5F5;color:#000;width:100px;">Session</th>
		<th style="text-align:center;background-color:#F5F5F5;color:#000;width:75px;">From</th>
		<th style="text-align:center;background-color:#F5F5F5;color:#000;width:107px;">To</th>
		<th style="text-align:center;background-color:#F5F5F5;color:#000;width:88px;">Seating</th>
		<th style="text-align:center;background-color:#F5F5F5;color:#000;width:120px;">Function</th>
		<th style="text-align:center;background-color:#F5F5F5;color:#000;width:50px;">Exp </th>
		<th style="text-align:center;background-color:#F5F5F5;color:#000;width:50px;">Guarant</th>
		<th style="text-align:center;background-color:#F5F5F5;color:#000;width:85px;">Rate</th>
		<th style="text-align:center;background-color:#F5F5F5;color:#000;width:87px;">Status</th>
		<th style="text-align:center;background-color:#F5F5F5;color:#000;width:120px;">Veg/Non-veg</th>
		<!--<th style="text-align:center;"><img src="../../images/plus.png" id="add-item" onclick="addMoreRowsROOM(this.form);" style="width:15px;height:15px;cursor:pointer;"/></th>-->
	</tr>
	</thead>
	<tbody class="tathead tatbody tableS" id="displyRoomDET" style="height:100px;">
<?php 
$sqlHB=mysql_query("select * from bq_hallbooking where booking_no='".$_GET['bkno']."'");
while($rowHB=mysql_fetch_array($sqlHB)) {
?>
<tr id=""><td style="text-align:center;" id="room"><input  name="book_date[]" id="book_date<?php echo $cc;?>" type="text" class="textbox codesUPPERCase datepicker" value="<?php echo $rowHB['book_date'];?>" style="width:88px;margin:0px 0 0 0px"  placeholder="dd/mm/yyyy"/></td><td style="text-align:center;" >
	<?php $sqlBS=mysql_query("select distinct venue_code,venue_desc from bq_venue where status='1'"); ?>
	<select name="venue[]" id="venue<?php echo $cc;?>" class="fstChUPPRCase" style="width:100px;float:left;font-size:12px;" onChange="selVenueName('<?php echo $cc;?>');">
	<option value="">--Select--</option>
	<?php  while($rowBS=mysql_fetch_array($sqlBS)) {  
	if($rowHB['venue']==$rowBS['venue_code']){
	?>
	<option value="<?php  echo $rowBS['venue_code']; ?>" selected ><?php  echo $rowBS['venue_desc'];?></option>
	<?php }else{ ?>
	<option value="<?php  echo $rowBS['venue_code']; ?>"><?php  echo $rowBS['venue_desc'];?></option>
	<?php  } } ?>
	</select>
	</td>
	<td style="width:100px;text-align:center;" id="room">
	
	<?php $sqlBS=mysql_query("select distinct sess_code,sess_name from bqt_session where status='1'"); ?>
		<select name="session[]" id="session<?php echo $cc;?>" class="fstChUPPRCase" style="width:100px;float:left;font-size:12px;" onChange="selSessionName('<?php echo $cc;?>');">
		<option value="">--Select--</option>
		<?php  while($rowBS=mysql_fetch_array($sqlBS)) {  
	if($rowHB['session']==$rowBS['sess_code']){
	?>
	<option value="<?php  echo $rowBS['sess_code']; ?>" selected><?php  echo $rowBS['sess_name'];?></option>
	<?php }else{ ?>
	<option value="<?php  echo $rowBS['sess_code']; ?>"><?php  echo $rowBS['sess_name'];?></option>
	<?php  } } ?>
		</select>
	</td>
	
	<td style="text-align:center;"><input name="from_time[]" id="from_time<?php echo $cc;?>" type="text" class="textbox fstChUPPRCase" value="<?php echo $rowHB['from_time'];?>" style="width:96px;margin:0px 0 0 0px" /></td><td style="text-align:center;"><input name="to_time[]" id="to_time<?php echo $cc;?>" type="text" data-validation="required" class="textbox fstChUPPRCase" style="width:96px;margin:0px 0 0 0px" value="<?php echo $rowHB['to_time'];?>" onblur="selTOtme('<?php echo $cc;?>');" /></td><td style="text-align:center;">
	
	<?php $sqlBS=mysql_query("select distinct seat_code,seat_desc from bq_seating where status='1'"); ?>
		<select name="seating[]" id="seating<?php echo $cc;?>" class="fstChUPPRCase" style="width:88px;float:left;font-size:12px;" onChange="selSeatingName('<?php echo $cc;?>');">
		<option value="" >--select--</option>
		<?php  while($rowBS=mysql_fetch_array($sqlBS)) {  
	if($rowHB['seating']==$rowBS['seat_code']){
	?>
	<option value="<?php  echo $rowBS['seat_code']; ?>" selected><?php  echo $rowBS['seat_desc'];?></option>
	<?php }else{ ?>
	<option value="<?php  echo $rowBS['seat_code']; ?>"><?php  echo $rowBS['seat_desc'];?></option>
	<?php  } } ?>
		</select>
	</td>
	<td style="text-align:center;" class="sourceonVAL">
	<?php $sqlBS=mysql_query("select distinct func_code,func_desc from bq_function where status='1'"); ?>
		<select name="funct[]" id="funct<?php echo $cc;?>" class="fstChUPPRCase" style="width:120px;float:left;font-size:12px;" onChange="selFunctionName('<?php echo $cc;?>');">
		<option value="">--Select--</option>
		<?php  while($rowBS=mysql_fetch_array($sqlBS)) {  
	if($rowHB['funct']==$rowBS['func_code']){
	?>
	<option value="<?php  echo $rowBS['func_code']; ?>" selected><?php  echo $rowBS['func_desc'];?></option>
	<?php }else{ ?>
	<option value="<?php  echo $rowBS['func_code']; ?>"><?php  echo $rowBS['func_desc'];?></option>
	<?php  } } ?>
		</select>
	</td>
	
	<td style="text-align:center;" class="sourceonVAL"><input name="expected[]" id="expected<?php echo $cc;?>" type="text" class="textbox fstChUPPRCase sng nmRm" style="width:50px;margin:0px 0 0 0px" value="<?php echo $rowHB['expected'];?>" onblur="expeExcQty(<?php echo $cc;?>);"/></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="guaranted[]" id="guaranted<?php echo $cc;?>" type="text" class="textbox fstChUPPRCase dbl nmRm" style="width:50px;margin:0px 0 0 0px" value="<?php echo $rowHB['guaranted'];?>" onblur="guarExcQty(<?php echo $cc;?>);"/></td>
	<td style="text-align:center;" class="sourceonVAL" value="0"><input name="hall_rate[]" id="hall_rate<?php echo $cc;?>" type="text" class="textbox fstChUPPRCase trpl nmRm" style="width:85px;margin:0px 0 0 0px" value="<?php echo $rowHB['hall_rate']; ?>" /></td>
	<td style="text-align:center;" class="sourceonVAL">
			
		<?php $sqlBS=mysql_query("select distinct room_availability,roomavail_define from bq_stscolor where roomavail_define!='1' AND roomavail_define!='7'"); ?>
		<select name="confirm_status[]" id="confirm_status<?php echo $cc;?>" class="fstChUPPRCase" style="width:87px;float:left;font-size:12px;" onChange="selConfirmStsName('<?php echo $cc;?>');">
		<option value="">--Select--</option>
		<?php  while($rowBS=mysql_fetch_array($sqlBS)) {  
	if($rowHB['confirm_status']==$rowBS['roomavail_define']){
	?>
	<option value="<?php  echo $rowBS['roomavail_define']; ?>" selected><?php  echo $rowBS['room_availability'];?></option>
	<?php }else{ ?>
	<option value="<?php  echo $rowBS['roomavail_define']; ?>"><?php  echo $rowBS['room_availability'];?></option>
	<?php  } } ?>
		</select>
		
		
	</td>
	<td style="text-align:center;" class="sourceonVAL">
		<select name="veg[]" id="veg<?php echo $cc;?>" class="fstChUPPRCase" style="width:100px;float:left;font-size:12px;" >
		<option value="">--Select--</option>
		<option value="veg" <?php if($rowHB['menu_pref']=='veg')?> selected>Veg</option>
		<option value="nonveg" <?php if($rowHB['menu_pref']=='nonveg')?> selected>Non-veg</option>
		</select>
	</td>
	</tr>	
<?php 
}
?>
<?php 
for($cc=1;$cc<10;$cc++){
?>
<tr id=""><td style="text-align:center;" id="room"><input  name="book_date[]" id="book_date<?php echo $cc;?>" type="text" class="textbox codesUPPERCase datepicker" value="" style="width:88px;margin:0px 0 0 0px" onblur="arrDateSel('<?php echo $cc;?>');" onclick="arrCopySel('<?php echo $cc;?>');"  placeholder="dd/mm/yyyy"/></td><td style="text-align:center;" >
	<?php $sqlBS=mysql_query("select distinct venue_code,venue_desc from bq_venue where status='1'"); ?>
	<select name="venue[]" id="venue<?php echo $cc;?>" class="fstChUPPRCase" style="width:100px;float:left;font-size:12px;" onChange="selVenueName('<?php echo $cc;?>');">
	<option value="">--Select--</option>
	<?php  while($rowBS=mysql_fetch_array($sqlBS)) {  ?>
	<option value="<?php  echo $rowBS['venue_code']; ?>"><?php  echo $rowBS['venue_desc'];?></option>
	<?php  } ?>
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
	
	<td style="text-align:center;"><input name="from_time[]" id="from_time<?php echo $cc;?>" type="text" class="textbox fstChUPPRCase" style="width:96px;margin:0px 0 0 0px" /></td><td style="text-align:center;"><input name="to_time[]" id="to_time<?php echo $cc;?>" type="text" data-validation="required" class="textbox fstChUPPRCase" style="width:96px;margin:0px 0 0 0px" value="" onblur="selTOtme('<?php echo $cc;?>');" /></td><td style="text-align:center;">
	
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
	
	<td style="text-align:center;" class="sourceonVAL"><input name="expected[]" id="expected<?php echo $cc;?>" type="text" class="textbox fstChUPPRCase sng nmRm" style="width:50px;margin:0px 0 0 0px" value="0" onblur="expeExcQty(<?php echo $cc;?>);"/></td>
	<td style="text-align:center;" class="sourceonVAL"><input name="guaranted[]" id="guaranted<?php echo $cc;?>" type="text" class="textbox fstChUPPRCase dbl nmRm" style="width:50px;margin:0px 0 0 0px" value="0" onblur="guarExcQty(<?php echo $cc;?>);"/></td>
	<td style="text-align:center;" class="sourceonVAL" value="0"><input name="hall_rate[]" id="hall_rate<?php echo $cc;?>" type="text" class="textbox fstChUPPRCase trpl nmRm" style="width:85px;margin:0px 0 0 0px" value="0" /></td>
	<td style="text-align:center;" class="sourceonVAL">
			
		<?php $sqlBS=mysql_query("select distinct room_availability,roomavail_define from bq_stscolor where roomavail_define!='1' AND roomavail_define!='7'"); ?>
		<select name="confirm_status[]" id="confirm_status<?php echo $cc;?>" class="fstChUPPRCase" style="width:87px;float:left;font-size:12px;" onChange="selConfirmStsName('<?php echo $cc;?>');">
		<option value="">--Select--</option>
		<?php  while($rowBS=mysql_fetch_array($sqlBS)) {  ?>
		<option value="<?php  echo $rowBS['roomavail_define']; ?>"><?php  echo $rowBS['room_availability'];?></option>
		<?php  }  ?>
		</select>
		
		
	</td>
	<td style="text-align:center;" class="sourceonVAL">
		<select name="veg[]" id="veg<?php echo $cc;?>" class="fstChUPPRCase" style="width:100px;float:left;font-size:12px;" >
		<option value="">--Select--</option>
		<option value="veg">Veg</option>
		<option value="nonveg">Non-veg</option>
		</select>
	</td>
	<!--<td style="text-align:center;" class="sourceonVAL"><input name="chief_guest[]" id="chief_guest<?php echo $cc;?>" type="text"  class="textbox fstChUPPRCase expet" style="width:120px;margin:0px 0 0 0px" value="" /></td>-->
	</tr>	
<?php 
}
?>
</tbody>
<tbody id="addedRowsEDRoom">

</tbody>

</table>
<!-- Start Room Status -->
<table style="float:left;width:100%;border:1px solid #ddd;margin:4px 0 0 0;font-size:12px;" cellpadding="0" cellspacing="0" class="table" border="0" >

<tbody id="venPRODef">
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

<tbody class="venPROShw" style="display:none;border:1px solid #cccccc;">
<tr>
	<th width="" style="text-align:center;background-color:#F5F5F5;height:15px;border:1px solid #cccccc;">Venue</th>
	<?php 
	for($cc=6;$cc<=24;$cc++){
	?>
	<th style="text-align:center;background-color:#F5F5F5;width:5px;height:15px;border:1px solid #cccccc;"><?php echo $cc; ?></th>
	<?php } ?>
</tr>
</tbody>
<tbody class="venPROShw1" style="display:none;border:1px solid #cccccc;">

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
<td valign="top"><select name="corporate" id="corporate" data-validation="required" class="input validate[required] fstChUPPRCase textbox" style="width:210px;float:left;" onChange="corPind();">
<option value="">--Select--</option>
<option value="corporate" <?php if($sqlR['menu_pref']=='corporate')?> selected>Corporate</option>
<option value="individual" <?php if($sqlR['menu_pref']=='individual')?> selected>Individual</option>
</select></td>
			</tr>
<tr>
<td width="" valign="top"><label>Title <em>*</em></label></td>
<td valign="top"><select name="title" id="title" data-validation="required" class="input validate[required] fstChUPPRCase textbox" style="width:50px;float:left;" onChange="corPind();">
<option value="mr">Mr</option>
<option value="mrs">Mrs</option>
<option value="ms">Ms</option>
<option value="dr">Dr</option>
</select>
<input name="guest_name" id="guest_name" type="text" data-validation="required" value="<?php  echo $sqlR['guest_name'];?>" class="input validate[required] textbox fstChUPPRCase" style="width:160px" placeholder="Name"/>
</td>
</tr>
			<tr>
					<td width="" valign="top"><label>Address 1 </label></td>
					<td valign="top"><input name="address1" id="address1" type="text" data-validation="required" class="input validate[required] fstChUPPRCase textbox" value="<?php  echo $sqlR['address1'];?>" style="width:210px"/></td>
					</tr>
					<tr>
					<td width="" valign="top"><label>Address 2 </label></td>
					<td valign="top"><input name="address2" id="address2" type="text" class="textbox fstChUPPRCase" style="width:210px" value="<?php  echo $sqlR['address2'];?>"/></td>
					</tr>
			<tr>
				<td width="" valign="top"><label>City <em>*</em></label></td>
				<td width="" valign="top"><input name="city" id="city" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" value="<?php  echo $sqlR['city'];?>" style="width:87px"/><span class="spanClr">Zip</span>
				<input name="pin_code" id="pin_code" value="<?php  echo $sqlR['pin'];?>" type="text" class="textbox fstChUPPRCase" style="width:80px;margin:0 0 0 11px;" /></td>
				
			</tr>
			<tr>
				<td width="" valign="top"><label>State <em>*</em></label></td>
				<td width="" valign="top"><input name="state" id="state" type="text" value="<?php  echo $sqlR['state'];?>" class="textbox fstChUPPRCase" style="width:80px;" value="" /><span class="spanClr">Country</span><input name="country" id="country" type="text" class="textbox fstChUPPRCase"  value="<?php  echo $sqlR['country'];?>" style="width:82px;margin:0 0 0 -8px;" value=""/>
				</td>
				
			</tr>
			<tr>
		<td width="" valign="top"><label>Phone <em>*</em></label></td>
		<td valign="top"><input name="phone" id="phone" type="text" data-validation="required" value="<?php  echo $sqlR['phone'];?>" class="input validate[required] textbox fstChUPPRCase" style="width:210px" onkeypress="return pointNum(event)"/></td>
	</tr>
			
				
	</tbody>
	</table>
<table style="float:left;width:30%;border-right:1px solid #ddd;margin:8px 0 0 0;" cellpadding="0" cellspacing="0" class="table" border="0" >
		<!--<tr>
			<td width="" valign="top"><label>Company</label></td>
			<td valign="top">
				<input name="company_name" id="company_name" type="text" class="textbox fstChUPPRCase" style="width:210px"  />
			<div id="suggesstion-box"  onClick="selCompanyName();"></div>
			
		<input name="comp_code" id="comp_code" type="hidden" class="textbox fstChUPPRCase" style="width:120px;margin:0 0 0 11px;" />
		</td>
		</tr>
		<tr>
		<td width="" valign="top"><label>Address 1 </label></td>
		<td valign="top"><input name="comaddress1" id="comaddress1" type="text" class="textbox fstChUPPRCase" style="width:210px" readonly /></td>
		</tr>
		<tr>
		<td width="" valign="top"><label>Address 2 </label></td>
		<td valign="top"><input name="comaddress2" id="comaddress2" type="text" class="textbox fstChUPPRCase" style="width:210px" readonly /></td>
		</tr>
		<tr>
			<td width="" valign="top"><label>City </label></td>
			<td width="" valign="top"><input name="comcity" id="comcity" type="text" class="textbox fstChUPPRCase" style="width:87px" readonly /><span class="spanClr">Zip</span>
			<input name="compincode" id="compincode" type="text" class="textbox fstChUPPRCase" style="width:80px;margin:0 0 0 11px;" readonly /></td>
		</tr>
		<tr>
			<td width="" valign="top"><label>State <em>*</em></label></td>
			<td width="" valign="top"><input name="comstate" id="comstate" type="text" class="textbox fstChUPPRCase" style="width:80px;" value="" readonly /><span class="spanClr">Country</span><input name="comcountry" id="comcountry" type="text" class="textbox fstChUPPRCase" style="width:82px;margin:0 0 0 -8px;" value="" readonly />
			</td>
		</tr>
<tr>
	<td width="" valign="top"><label>Phone </label></td>
	<td valign="top"><input name="comphone" id="comphone" type="text" class="textbox fstChUPPRCase" style="width:210px;" readonly /></td>
</tr>
<tr>
	<td width="" valign="top"><label>E-mail <em>*</em></label></td>
	<td valign="top"><input name="comemail" id="comemail" type="text" class="textbox" style="width:210px" readonly /></td>
</tr>-->
    <tr>
				<td width="" valign="top"><label>Company</label></td>
				<td valign="top">
				<?php $sqlTB=mysql_query("select distinct comp_code,comp_name from company_master");?>
				<select name="comp_code" id="comp_code" data-validation="required" class="input fstChUPPRCase textbox" style="width:210px">
				<option value="">--Select--</option>
				<?php  while($rowBS=mysql_fetch_array($sqlTB)) {  
	if( $sqlR['comp_code']==$rowBS['comp_code']){
	?>
	<option value="<?php  echo $rowBS['comp_code']; ?>" selected><?php  echo $rowBS['comp_name'];?></option>
	<?php }else{ ?>
	<option value="<?php  echo $rowBS['comp_code']; ?>"><?php  echo $rowBS['comp_name'];?></option>
	<?php  } } ?>
				
				</select>
				</td>
			</tr>
	<tr>
		<td width="" valign="top"><label>E-mail <em></em></label></td>
		<td valign="top"><input name="email" id="email" type="text" value="<?php  echo $sqlR['email'];?>" class="textbox" style="width:210px"/></td>
	</tr>
	<tr>
		<td width="" valign="top"><label>GSTIN <em></em></label></td>
		<td valign="top"><input name="gst_no" id="gst_no" type="text" value="<?php  echo $sqlR['gstin'];?>" class="textbox fstChUPPRCase" style="width:210px" /></td>
	</tr>
	

	<tr>
		<td width="" valign="top"><label>Contact Person</label></td>
		<td valign="top"><input name="contact_person" id="contact_person" type="text" value="<?php  echo $sqlR['contact_person'];?>"  class="textbox codesUPPERCase" style="width:210px" /></td>
	</tr>
	<tr>
		<td width="" valign="top"><label>Mobile no</label></td>
		<td valign="top"><input name="contact_mobile" id="contact_mobile" value="<?php  echo $sqlR['contact_mobile'];?>" type="text" class="textbox" style="width:210px" /></td>
	</tr>
	<tr>
		<td width="" valign="top"><label>Booked By</label></td>
		<td valign="top">
		<!--<input name="booker_no" id="booker_no" type="text" class="textbox" style="width:210px" onkeypress="return pointNum(event)" />-->
		<input name="booked_by" id="booked_by" type="text" class="textbox" value="<?php  echo $sqlR['booked_by'];?>" style="width:210px" />
		</td>
	</tr>
	<tr>
		<td width="" valign="top"><label>Booker Id</label></td>
		<td valign="top"><input name="booker_id" id="booker_id" type="text" value="<?php  echo $sqlR['booker_id'];?>" class="textbox" style="width:210px" /></td>
	</tr>
	</tbody>
</table>
<?php 
$sqlP=mysql_query("select * from property_definition");
$rowP=mysql_fetch_array($sqlP);
?>			
	<table style="width:33%;float:left;margin:8px 0 0 31px;" class="table">
		<tbody>
			<tr>
				<td width="" valign="top"><label>Type of billing <em>*</em></label></td>
				<td valign="top">
				<?php $sqlTB=mysql_query("select distinct bill_code,bill_desc from bq_billinstruc");?>
				<select name="top_code" id="top_code" data-validation="required" class="input validate[required] fstChUPPRCase textbox" style="width:210px">
				<option value="">--Select--</option>
				<?php  while($rowBS=mysql_fetch_array($sqlTB)) {  
	if( $sqlR['top_code']==$rowBS['bill_code']){
	?>
	<option value="<?php  echo $rowBS['bill_code']; ?>" selected><?php  echo $rowBS['bill_desc'];?></option>
	<?php }else{ ?>
	<option value="<?php  echo $rowBS['bill_code']; ?>"><?php  echo $rowBS['bill_desc'];?></option>
	<?php  } } ?>
				
				</select>
				</td>
			</tr>
			<tr>
				<td width="" valign="top"><label>Business Source <em>*</em></label></td>
				<td valign="top">
				<?php $sqlBS=mysql_query("select distinct bs_code,bs_name from bq_bssource where bs_code!=''");?>
				<select name="business_src" id="business_src" data-validation="required" class="input validate[required] fstChUPPRCase textbox" style="width:210px">
				<option value="">--Select--</option>
				<?php 
				while($rowTB=mysql_fetch_array($sqlBS)) {
				if($sqlR['business_src']==$rowTB['bs_code']){		
				?>
				<option value="<?php echo $rowTB['bs_code'];?>" selected ><?php echo $rowTB['bs_name'];?></option>
				<?php }else{ ?>
				<option value="<?php echo $rowTB['bs_code'];?>" ><?php echo $rowTB['bs_name'];?></option>
				<?php } } ?>
				</select>
				</td>
			</tr>
			<tr>
				<td width="" valign="top"><label>Market Segment<em>*</em></label></td>
				<td valign="top">
				<?php $sqlBS=mysql_query("select distinct mscode,msname from bq_marketseg");?>
				<select name="segment_code" id="segment_code"  data-validation="required" class="input validate[required] fstChUPPRCase textbox" style="width:210px">
				<option value="">--Select--</option>
				<?php while($rowBS=mysql_fetch_array($sqlBS)) { ?>
				<?php if($sqlR['segment_code']==($rowBS['mscode'])){	?>
				<option value="<?php echo $rowBS['mscode'];?>" selected ><?php echo $rowBS['msname'];?></option>
				<?php }else{ ?>
				<option value="<?php echo $rowBS['mscode'];?>" ><?php echo $rowBS['msname'];?></option>
				<?php } }?>
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
				<?php if($sqlR['pay_mode']==($rowPm['pay_code'])) {	?>
				<option value="<?php echo $rowPm['pay_code'];?>" selected ><?php echo $rowPm['pay_desc'];?></option>
				<?php } else { ?>
				<option value="<?php echo $rowPm['pay_code'];?>"><?php echo $rowPm['pay_desc'];?></option>
				<?php } } ?>
				</select>
				</td>
			
			</tr>
			<tr>
				<td width="" valign="top"><label>Remind Date</label></td>
				<td valign="top"><input name="remind_date" id="remind_date" value="<?php  echo $sqlR['remind_date'];?>" type="text" class="textbox datepicker1" style="width:210px" /></td>
			</tr>
			<tr>
				<td width="" valign="top"><label>Remarks</label></td>
				<td valign="top"><textarea cols="34" rows="2" name="remarks" id="remarks" value="" style="text-transform:uppercase;font-size:12px;margin: 0 0 6px 0;"><?php  echo $sqlR['remarks'];?></textarea></td>
			</tr>	
			<tr>
		<td width="" valign="top"><label>Bride/Groom Name</label></td>
		<td valign="top"><input name="chf_guest" id="chf_guest" type="text" value="<?php  echo $sqlR['chief_guest'];?>" class="textbox"  style="width:210px" /></td>
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
    margin-left: -118px;
    padding: 4px 49px;
    float: right;
}
</style>

</div>
	</div>
	</div>
	</form>	
	<?php /* include("../../footer.php"); */ ?>
</body>
</html>