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
	  minDate: 0,
     dateFormat:"dd/mm/yy"
  });
  
   $(".datepicker1" ).datepicker({
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
	alert('sass');
	var rnt = $('#addedRowsEDRoom tr').length;

	rowCountR=rowCountR+1; 
	rowTblCo=0;
	var rowTblCo = $('#addedRowsEDRoom tr').length+2;
	
	var recRow = '<tr id="rowCount1'+rowCountR+'"><td style="text-align:center;" id="room'+rowCountR+'"><input  name="book_date[]" id="book_date'+rowCountR+'" type="text" class="textbox codesUPPERCase datepicker" value="" style="width:88px;margin:0px 0 0 0px" onblur="arrDateSel('+rowCountR+');" placeholder="dd/mm/yyyy"/></td><td style="text-align:center;" ><?php $sqlBS=mysql_query("select distinct venue_code,venue_desc from bq_venue where status='1'"); ?><select name="venue[]" id="venue'+rowCountR+'" class="fstChUPPRCase" style="width:100px;float:left;font-size:12px;" onChange="selVenueName('+rowCountR+');"><option value="">--Select--</option><?php  while($rowBS=mysql_fetch_array($sqlBS)) {  ?><option value="<?php  echo $rowBS['venue_code']; ?>"><?php  echo $rowBS['venue_desc'];?></option><?php } ?></select></td><td style="width:100px;text-align:center;" id="room"><?php $sqlBS=mysql_query("select distinct sess_code,sess_name from bqt_session where status='1'"); ?><select name="session[]" id="session'+rowCountR+'" class="fstChUPPRCase" style="width:100px;float:left;font-size:12px;" onChange="selSessionName('+rowCountR+');"><option value="">--Select--</option><?php while($rowBS=mysql_fetch_array($sqlBS)) {  ?><option value="<?php  echo $rowBS['sess_code']; ?>"><?php  echo $rowBS['sess_name'];?></option> <?php } ?></select></td><td style="text-align:center;"><input name="from_time[]" id="from_time'+rowCountR+'" type="text" class="textbox fstChUPPRCase" style="width:75px;margin:0px 0 0 0px" value="<?php if(isset($rowb['from_time'])) {echo $rowb['from_time'];}?>" /></td><td style="text-align:center;"><input name="to_time[]" id="to_time'+rowCountR+'" type="text" data-validation="required" class="textbox fstChUPPRCase" style="width:75px;margin:0px 0 0 0px" value="<?php if(isset($rowb['to_time'])) {echo $rowb['to_time'];}?>" /></td><td style="text-align:center;"><?php $sqlBS=mysql_query("select distinct seat_code,seat_desc from bq_seating where status='1'"); ?><select name="seating[]" id="seating'+rowCountR+'" class="fstChUPPRCase"style="width:88px;float:left;font-size:12px;" onChange="selSeatingName('+rowCountR+');"><option value="" >--select--</option>	<?php  while($rowBS=mysql_fetch_array($sqlBS)) {  ?><option value="<?php  echo $rowBS['seat_code']; ?>"><?php  echo $rowBS['seat_desc'];?></option><?php } ?></select></td><td style="text-align:center;" class="sourceonVAL"><?php $sqlBS=mysql_query("select distinct func_code,func_desc from bq_function where status='1'"); ?><select name="funct[]" id="funct'+rowCountR+'" class="fstChUPPRCase" style="width:120px;float:left;font-size:12px;" onChange="selFunctionName('+rowCountR+');"><option value="">--Select--</option><?php  while($rowBS=mysql_fetch_array($sqlBS)) {  ?><option value="<?php  echo $rowBS['func_code']; ?>"><?php  echo $rowBS['func_desc'];?></option><?php } ?></select></td><td style="text-align:center;" class="sourceonVAL"><input name="expected[]" id="expected'+rowCountR+'" type="text" class="textbox fstChUPPRCase sng nmRm" style="width:50px;margin:0px 0 0 0px" value="<?php if(isset($rowb['expected'])) {echo $rowb['expected'];}?>"/></td><td style="text-align:center;" class="sourceonVAL"><input name="guaranted[]" id="guaranted'+rowCountR+'" type="text" class="textbox fstChUPPRCase dbl nmRm" style="width:50px;margin:0px 0 0 0px" value="<?php if(isset($rowb['guaranted'])) {echo $rowb['guaranted'];}?>"/></td><td style="text-align:center;" class="sourceonVAL" value="0"><input name="hall_rate[]" id="hall_rate'+rowCountR+'" type="text" class="textbox fstChUPPRCase trpl nmRm" style="width:85px;margin:0px 0 0 0px" value="<?php if(isset($rowb['hall_rate'])) {echo $rowb['hall_rate'];}?>" /></td><td style="text-align:center;" class="sourceonVAL"><?php $sqlBS=mysql_query("select distinct room_availability,roomavail_define from bq_stscolor where roomavail_define!='1'"); ?><select name="confirm_status[]" id="confirm_status'+rowCountR+'" class="fstChUPPRCase" style="width:87px;float:left;font-size:12px;" onChange="selConfirmStsName('+rowCountR+');"><option value="">--Select--</option><?php  while($rowBS=mysql_fetch_array($sqlBS)) {  ?><option value="<?php  echo $rowBS['roomavail_define']; ?>"><?php  echo $rowBS['room_availability'];?></option><?php } ?></select></td><td style="text-align:center;" class="sourceonVAL"><input name="chief_guest[]" id="chief_guest'+rowCountR+'" type="text"  class="textbox fstChUPPRCase expet" style="width:120px;margin:0px 0 0 0px" value="<?php if(isset($rowb['chief_guest'])) {echo $rowb['chief_guest'];}?>" /></td></tr>'; 
	
	jQuery('#addedRowsEDRoom').append(recRow); 
	$('#rowCountR').val(rowCountR);
	
	trF=$('#tariff_rt').val();
		  
} */
 

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

label{font-weight:bold;}

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
<form id="hotelDefi" name="hotelDefi" enctype="multipart/form-data" action="<?php echo $home_path;?>/action/update_hall_booking.php" method="post" class="" style="">
	<input name="incLc" id="incLc" type="hidden" style="" value=""/>
	<input type="hidden" name="rowVl" id="rowVl"/>
	<input type="hidden" name="rmomType" id="rmomType"/>
	<input type="hidden" name="adtDate" id="adtDate" value="<?php echo $curDate?>"/>
	<input type="hidden" name="bookNum" id="bookNum" value="<?php echo $_GET['roomBk'];?>"/>
	<div>
	
<table class="table" cellpadding="0" cellspacing="0" border="1" class="table" style="text-align:center;font-size:12px;margin:0px 0 10px 0px;">
	<tr>
		<th width="" style="text-align:center;background-color:#d3524e;color:#fff;">Date</th>
		<th width="" style="text-align:center;background-color:#d3524e;color:#fff;">Venue</th>
		<th width="" style="text-align:center;background-color:#d3524e;color:#fff;">Session</th>
		<th width="" style="text-align:center;background-color:#d3524e;color:#fff;">From</th>
		<th width="" style="text-align:center;background-color:#d3524e;color:#fff;">To</th>
		<th width="" style="text-align:center;background-color:#d3524e;color:#fff;">Seating</th>
		<th width="" style="text-align:center;background-color:#d3524e;color:#fff;">Function</th>
		<th width="" style="text-align:center;background-color:#d3524e;color:#fff;">Exp </th>
		<th width="" style="text-align:center;background-color:#d3524e;color:#fff;">Guarant</th>
		<th width="" style="text-align:center;background-color:#d3524e;color:#fff;">Rate</th>
		<th width="" style="text-align:center;background-color:#d3524e;color:#fff;">Status</th>
		<th width="" style="text-align:center;background-color:#d3524e;color:#fff;">Guest</th>
	</tr>
<?php 
$sqlb=mysql_query("select * from bq_hallbooking where booking_no='".$_GET['roomBk']."' AND confirm_status!='7'");
$nrws=mysql_num_rows($sqlb);
$cc=0;
$nmRs=mysql_num_rows($sqlb);
while($rowb=mysql_fetch_array($sqlb)){
	$cc++;
/* echo "select seat_desc from bq_seating where seat_code='".$rowb['seating']."'";
die();	 */
	$rwSes=mysql_fetch_array(mysql_query("select seat_desc from bq_seating where seat_code='".$rowb['seating']."'"));
	$rwFn=mysql_fetch_array(mysql_query("select func_desc from bq_function where func_code='".$rowb['funct']."'"));

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
$rowbl=mysql_fetch_array($sqlRe);

	
if($rowb['confirm_status']==1) {
	$rmAVai=$rowRv['room_availability'];
	$clr=$rowRv['room_color'];
}else if($rowb['confirm_status']==2) {
	$rmAVai=$rowRd['room_availability'];
	$clr=$rowRd['room_color'];
}else if($rowb['confirm_status']==3) {
	$rmAVai=$rowRo['room_availability'];
	$clr=$rowRo['room_color'];
}else if($rowb['confirm_status']==4) {
	$rmAVai=$rowRg['room_availability'];
	$clr=$rowRg['room_color'];
}else if($rowb['confirm_status']==5) {
	$rmAVai=$rowRm['room_availability'];
	$clr=$rowRm['room_color'];
}else if($rowb['confirm_status']==6) {
	$rmAVai=$rowbl['room_availability'];
	$clr=$rowbl['room_color'];
}


?>

<input type="hidden" name="hallbook_id[]" id="hallbook_id" value="<?php echo $rowb['hallbook_id'];?>"/>

<tr id="">
<td style="text-align:center;" id="room"><?php if(isset($rowb['book_date'])) {echo $rowb['book_date'];}?></td>
<td style="text-align:center;" readonly ><?php  echo strtoupper($rowb['venue']);?></td>
<td style="text-align:center;" readonly ><?php  echo strtoupper($rowb['session']);?></td>
<td style="text-align:center;" readonly ><?php  echo $rowb['from_time'];?></td>
<td style="text-align:center;" readonly ><?php  echo $rowb['to_time'];?></td>
<td style="text-align:center;" readonly ><?php  echo strtoupper($rwSes['seat_desc']);?></td>
<td style="text-align:center;" readonly ><?php  echo  strtoupper($rwFn['func_desc']);?></td>
<td style="text-align:center;" readonly ><?php  echo $rowb['expected'];?></td>
<td style="text-align:center;" readonly ><?php  echo $rowb['guaranted'];?></td>
<td style="text-align:center;" readonly ><?php  echo $rowb['hall_rate'];?></td>
<td style="text-align:center;" readonly ><?php  echo $rmAVai;?></td>
<td style="text-align:center;" readonly ><?php if(isset($rowb['chief_guest'])) {echo $rowb['chief_guest'];}?></td>

	</tr>	
<?php 
 } 
?>	


</table>
<!-- Start Room Status -->




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
<?php
$sqb=mysql_query("select * from bq_hallbooking where booking_no='".$_GET['roomBk']."'");
$rob=mysql_fetch_array($sqb);
?>
<table style="float:left;width:32%;border-right:1px solid #ddd;margin:8px 0 0 0;" cellpadding="0" cellspacing="0" class="table" border="1" >
<tbody id="addedRowsED1">

</tbody>
<tr>
<td width="" valign="top"><label>Type </label></td>
<td valign="top" style="font-size:12px;"><?php echo strtoupper($rob['corporate']); ?></td>
</tr>
<tr>
<td width="" valign="top"><label>Title </label></td>
<td valign="top" style="font-size:12px;"><?php echo strtoupper($rob['title']); ?><?php echo '. '.strtoupper($rob['guest_name']);?></td>
</tr>
			<tr>
					<td width="" valign="top"><label>Address 1 </label></td>
					<td valign="top" style="font-size:12px;"><?php echo strtoupper($rob['address1']); ?></td>
					</tr>
					<tr>
					<td width="" valign="top"><label>Address 2 </label></td>
					<td valign="top" style="font-size:12px;"><?php echo strtoupper($rob['address2']); ?></td>
					</tr>
			<tr>
				<td width="" valign="top"><label>City </label></td>
				<td width="" valign="top" style="font-size:12px;"><?php echo strtoupper($rob['city']); ?></td>
				
			</tr>
			<tr>
				<td width="" valign="top"><label>Zip </label></td>
				<td width="" valign="top" style="font-size:12px;"><?php echo strtoupper($rob['pin']); ?></td>
			</tr>
			<tr>
				<td width="" valign="top"><label>State </label></td>
				<td width="" valign="top" style="font-size:12px;"><?php echo strtoupper($rob['state']); ?>
				</td>
				
			</tr>
			<tr>
				<td width="" valign="top"><label>Country </label></td>
				<td width="" valign="top" style="font-size:12px;"><?php echo strtoupper($rob['country']); ?>
				</td>
				
			</tr>
			
			
				
	</tbody>
	</table>
<table style="float:left;width:30%;border-right:1px solid #ddd;margin:8px 0 0 0;" cellpadding="0" cellspacing="0" class="table" border="1" >
	<tr>
	<td width="" valign="top"><label>Phone </label></td>
	<td valign="top" style="font-size:12px;"><?php echo $rob['phone']; ?></td>
	</tr>
	<tr>
	<td width="" valign="top"><label>E-mail </label></td>
	<td valign="top" style="font-size:12px;"><?php echo strtoupper($rob['email']); ?></td>
	</tr>
	<tr>
		<td width="" valign="top"><label>Contact Person</label></td>
		<td valign="top" style="font-size:12px;"><?php echo strtoupper($rob['contact_person']); ?></td>
	</tr>
	<tr>
		<td width="" valign="top"><label>Mobile no</label></td>
		<td valign="top" style="font-size:12px;"><?php echo $rob['contact_mobile']; ?></td>
	</tr>
	<tr>
		<td width="" valign="top"><label>Booked By</label></td>
		<td valign="top" style="font-size:12px;"><?php echo strtoupper($rob['booked_by']); ?>
		</td>
	</tr>
	<tr>
		<td width="" valign="top"><label>Booker Id</label></td>
		<td valign="top" style="font-size:12px;"><?php echo strtoupper($rob['booker_id']); ?></td>
	</tr>
	<tr>
		<td width="" valign="top"><label>&nbsp;</label></td>
		<td valign="top" style="font-size:12px;">&nbsp;</td>
	</tr>
	<tr>
		<td width="" valign="top"><label>&nbsp;</label></td>
		<td valign="top" style="font-size:12px;">&nbsp;</td>
	</tr>
	
	</tbody>
</table>
			
	<table style="width:33%;float:left;margin:8px 0 0 31px;" class="table" cellpadding="0" cellspacing="0" class="table" border="1">
		<tbody>
			<tr>
				<td width="" valign="top"><label>Type of billing </label></td>
				<td valign="top" style="font-size:12px;"><?php echo strtoupper($rob['top_code']); ?></td>
			</tr>
			<tr>
				<td width="" valign="top"><label>Business Source </label></td>
				<td valign="top" style="font-size:12px;"><?php echo strtoupper($rob['business_src']); ?></td>
			</tr>
			<tr>
				<td width="" valign="top"><label>Market Segment</label></td>
				<td valign="top" style="font-size:12px;"><?php echo strtoupper($rob['segment_code']); ?></td>
			</tr>
			<tr>
				<td width="" valign="top"><label>Pay Mode </label></td>
				<td valign="top" style="font-size:12px;"><?php echo strtoupper($rob['pay_mode']); ?></td>
			</tr>
			<tr>
				<td width="" valign="top"><label>Remind Date</label></td>
				<td valign="top" style="font-size:12px;"><?php echo strtoupper($rob['remind_date']); ?></td>
			</tr>
			<tr>
				<td width="" valign="top"><label>Remarks</label></td>
				<td valign="top" style="font-size:12px;"><?php echo strtoupper($rob['remarks']); ?></td>
			</tr>	
			<tr>
		<td width="" valign="top"><label>&nbsp;</label></td>
		<td valign="top" style="font-size:12px;">&nbsp;</td>
	</tr>
	<tr>
		<td width="" valign="top"><label>&nbsp;</label></td>
		<td valign="top" style="font-size:12px;">&nbsp;</td>
	</tr>
			</tbody>
		</table>
	</div>

<?php 
$sqlB=mysql_query("select * from bq_opfpmenuhdr where bkno='".$_GET['roomBk']."'");
$rowB=mysql_fetch_array($sqlB);


$sqlBb=mysql_query("select * from bq_hallbooking where booking_no='".$_GET['roomBk']."'");
$rowBb=mysql_fetch_array($sqlBb);

$sqS=mysql_query("select * from bqt_session where sess_code='".$rowBb['session']."'");
$roS=mysql_fetch_array($sqS);

$sqT=mysql_query("select bill_desc from bq_billinstruc where bill_code='".$rowBb['top_code']."'");
$roT=mysql_fetch_array($sqT);

$sqF=mysql_query("select func_desc from bq_function where func_code='".$rowBb['funct']."'");
$roF=mysql_fetch_array($sqF);
?>

<div>
<table style="width:100%;height:12px;border-left:1px solid #000;" cellpadding="0" cellspacing="0" class="table" border="1">
<tr style="font-size:13px;">
	<td style="font-weight:bold;text-align:center;width:30%;">&nbsp;</td>
	<td style="font-weight:bold;text-align:center;width:35.2%;border-right:1px solid #000;">MENU ITEMS</td>
	<td style="font-weight:bold;text-align:center;width:35.2%;border-right:1px solid #000;">REQUIREMENTS</td>
	
</tr>
</table>
<table style="width:35%;float:left;" >
<?php
$rwf=mysql_fetch_array(mysql_query("select menucode from bq_opfpmenudetail where fpno='".$rowB['fpno']."'"));
$rw=mysql_fetch_array(mysql_query("select itmnu_name from bq_itemmaster where itmnu_code='".$rwf['menucode']."'"));
?>
<tr style="font-size:13px;">
<td style="text-align:left;width:35%;vertical-align:top;font-weight:bold;">
TYPE OF MENU&nbsp;:&nbsp;&nbsp;<?php echo $rw['itmnu_name']; ?><br/><br/>
GUARANTED PAX&nbsp;:&nbsp;<?php echo $rowBb['guaranted']; ?><br/><br/>
EXPECTED PAX&nbsp;:&nbsp;<?php echo $rowBb['expected']; ?><br/><br/>
<?php if(isset($rowB['pictime']) && $rowB['pictime']!='') { ?>
FOOD PICK UP AT&nbsp;:&nbsp;<?php echo $rowB['pictime']; ?><br/><br/>
<?php } ?>
<?php if(isset($rowB['sertime']) && $rowB['sertime']!='') { ?>
FOOD SERVICE AT&nbsp;:&nbsp;&nbsp;<?php echo $rowB['sertime']; ?><br/><br/>
<?php } ?>
<?php if(isset($rowB['mortea']) && $rowB['mortea']!='') { ?>
M.T &nbsp;:&nbsp;&nbsp;<?php echo $rowB['mortea']; ?><br/><br/>
<?php } ?>
<?php if(isset($rowB['evetea']) && $rowB['evetea']!='') { ?>
E.T &nbsp;:&nbsp;&nbsp;<?php echo $rowB['evetea']; ?><br/><br/>
<?php } ?>

</td>
</tr>
</table>





<table style="width:35%;float:left;">
<tr style="font-size:13px;">
<td style="text-align:left;width:35%;vertical-align:top;font-weight:bold;">
<?php
$sqFu=mysql_query("select * from bq_opfpmenudetail where fpno='".$rowB['fpno']."'");
$x=0;
while($roFu=mysql_fetch_array($sqFu)){
	$x++;
	$srl=sprintf('%02d', $x);
?>

&nbsp;&nbsp;<?php echo strtoupper($roFu['itemname']); ?><br/>

<?php 
}
?>
</td>
</tr>
</table>


<table style="width:30%;float:left;">
<tr style="font-size:13px;">
<td style="text-align:left;vertical-align:top;">&nbsp;
<?php
$sqFu=mysql_query("select * from bq_opfpdeptinst where fpno='".$rowB['fpno']."' AND bill_status!='3'");
$x=0;
while($roFu=mysql_fetch_array($sqFu)){
	$x++;
	$rw=mysql_fetch_array(mysql_query("select * from bq_deptmt where dept_code='".$roFu['deptcode']."'"));
?>

<span style="border-bottom: 1px dotted #000;font-weight:bold;"><?php echo strtoupper($rw['dept_name']); ?></span><br/>
<?php echo strtoupper($roFu['deptdesc']); ?><br/>

<?php 
 } 
?>
</td>
</tr>


</table>



<table style="width:30%;float:right;height:21px;margin:-19px 0 0px 0;" >
<?php 
$rsea=mysql_fetch_array(mysql_query("select seat_desc from bq_seating where seat_code='".$rowBb['seating']."'"));
?>
<tr>
<td style="text-align:left;float:left;vertical-align:top;font-size:13px;font-weight:bold;">&nbsp;&nbsp;<?php /* echo strtoupper($rsea['seat_desc']); */ ?>

</td>
</tr>
</table>

<table style="width:100%;height:50px;text-wrap:none;" class="table" cellpadding="0" cellspacing="0" class="table" border="1" >
<tr>
<td style="font-weight:bold;font-size:13px;width:50px;">&nbsp;REMARKS&nbsp;&nbsp;</td>
<td style="font-weight:bold;text-align:left;font-size:13px;color:#000;margin:0 0 0 0px;"><?php echo strtoupper($rowB['remarks']); ?>&nbsp;</td>
</tr>
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


	
</div>
	</div>
	</div>
	</form>	
	<?php /* include("../../footer.php"); */ ?>
</body>
</html>