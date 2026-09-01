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
<!-- international telephone code-->
<link rel="stylesheet" href="https://cdn.tutorialjinni.com/intl-tel-input/17.0.8/css/intlTelInput.css"/>
<script src="https://cdn.tutorialjinni.com/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<!-- international telephone code->
<!-- Datepicker start
<script src="<?php echo $home_path;?>/date-picker/jquery-1.10.2.js"></script>-->
<script src="<?php echo $home_path;?>/date-picker/jquery-ui.js"></script>
<link rel="stylesheet" href="<?php echo $home_path;?>/date-picker/jquery-ui.css">
<script src="../../js/sweetalert.min.js"></script>
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

//isd code
            var input = document.querySelector("#phone");
            window.intlTelInput(input, {
                separateDialCode: true,
                //excludeCountries: ["in", "il"],
                preferredCountries: ["in", "jp", "pk", "no"]
            });
			var input = document.querySelector("#mobile");
            window.intlTelInput(input, {
                separateDialCode: true,
                //excludeCountries: ["in", "il"],
                preferredCountries: ["in", "jp", "pk", "no"]
            });
//isd code


		
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

function alphab(e,t)    
		 {
			//alert('hi');	
				var unicode=e.charCode? e.charCode : e.keyCode;
				/*alert(unicode);
				return false;*/
				if(unicode==13 || unicode==47 || unicode==46 )
				{
					  try{t.blur();}catch(e){}
					  return true;
				 }
				if (unicode!=8 && unicode !=9 && unicode !=32 )
					{
						
						if (unicode<48 || unicode>57 ) 
							return false 
					}
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
	bk0=$("#book_date0").val().trim();
	vn0=$("#venue0").val().trim();
	se0=$("#session0").val().trim();
	fr0=$("#from_time0").val().trim();
	to0=$("#to_time0").val().trim();
	seat0=$("#seating0").val().trim();
	fun0=$("#funct0").val().trim();
	exp0=$("#expected0").val().trim();
	gua0=$("#guaranted0").val().trim();
	hlr0=$("#hall_rate0").val().trim();
	con0=$("#confirm_status0").val().trim();
	
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
	
	
	if(bk0!="" || vn0!="" || se0!="" || fr0!="" || to0!="" || seat0!="" || fun0!="" || exp0!="" || gua0!="" || hlr0!="" || con0!=""){
		if(bk0==""){
			alert("Booking date should not be blank!.");
			return false;
			
		}else if(vn0==""){
			alert("Venue should not be blank!.");
			return false;
			
		}else if(se0==""){
			alert("Session should not be blank!.");
			return false;
			
		}else if(fr0==""){
			alert("From time should not be blank!.");
			return false;
			
		}else if(to0==""){
			alert("To time should not be blank!.");
			return false;
			
		}else if(seat0==""){
			alert("Seating should not be blank!.");
			return false;
			
		}else if(fun0==""){
			alert("Function should not be blank!.");
			return false;
			
		}else if(exp0==""){
			alert("Expected qty should not be blank!.");
			return false;
			
		}else if(exp0<=0){
			alert("Expected qty should be greater than zero.");
			return false;
			
		}else if(gua0==""){
			alert("Guaranted qty should not be blank!.");
			return false;
			
		}else if(gua0<=0){
			alert("Guaranted qty should be greater than zero.");
			return false;
			
		}else if(hlr0==""){
			alert("Hall rate should not be blank!.");
			return false;
			
		}else if(con0==""){
			alert("Status should not be blank!.");
			return false;
			
		}
		
	}
	
	
	if(bk1!=""){
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
			alert("Expected should not be blank!.");
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
			
		}else if(con21=""){
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

function selConfirmStsName(e){
	con=$("#confirm_status"+e).val();
	// alert(con);
if(con==2){
	$(".req").attr("class", "validate[required]");
	$(".mob").attr("class", "validate[required,custom[integer],minSize[10],maxSize[10]]");
	// $( ".mob" ).addClass('validate[required,custom[integer],minSize[10],maxSize[10]]');
	}else{
		$(".req").attr("class", " ");
	    $(".mob").attr("class", " ");	
		}
	}


</script> 
<<style type="text/css">
/* Payroll (MyPay) Standardized Transaction View/Add Styling */
body, body.bgBODY {
    background-color: #ffffff !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 12px !important;
    margin: 0 !important;
    padding: 0 !important;
}

.mypay-container {
    width: 100% !important;
    max-width: 100% !important;
    margin: 15px auto 40px auto !important;
    padding: 0 10px !important;
    box-sizing: border-box !important;
}

.mypay-card {
    width: 1180px !important;
    max-width: 98% !important;
    margin: 0 auto !important;
    background: #ffffff !important;
    border: 1px solid #0073B5 !important;
    border-radius: 6px !important;
    overflow: hidden !important;
    box-shadow: none !important;
    padding: 0 !important;
}

.mypay-card-header {
    background: #0073B5 !important;
    color: #ffffff !important;
    text-align: center !important;
    height: 38px !important;
    line-height: 38px !important;
    padding: 0 15px !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-weight: bold !important;
    font-size: 13px !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
    margin: 0 !important;
    border: none !important;
    border-radius: 5px 5px 0 0 !important;
}

form#hotelDefi {
    margin: 0 !important;
    padding: 0 !important;
    display: block !important;
}

.mypay-card-body {
    padding: 15px 20px !important;
    background: #ffffff !important;
    margin: 0 !important;
}

.mypay-sub-table {
    width: 100% !important;
    border-collapse: collapse !important;
    border: 1px solid #0073B5 !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 11px !important;
    margin-bottom: 10px !important;
}

.mypay-sub-table thead th {
    background-color: #f5f5f5 !important;
    color: #222222 !important;
    font-weight: bold !important;
    font-size: 11px !important;
    text-align: center !important;
    height: 28px !important;
    padding: 4px 4px !important;
    border: 1px solid #e0e0e0 !important;
    white-space: nowrap !important;
}

.mypay-sub-table tbody td {
    padding: 4px 3px !important;
    border: 1px solid #e0e0e0 !important;
    background-color: #ffffff !important;
    text-align: center !important;
    vertical-align: middle !important;
}

.mypay-input-sm {
    width: 100% !important;
    height: 26px !important;
    line-height: 26px !important;
    padding: 0 5px !important;
    border: 1px solid #d0d7de !important;
    border-radius: 3px !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 11px !important;
    color: #333333 !important;
    background: #ffffff !important;
    box-sizing: border-box !important;
    outline: none !important;
}

.mypay-input-sm:focus {
    border-color: #0084b4 !important;
}

/* Modern Status Legend Bar */
.mypay-legend-strip {
    display: flex !important;
    width: 100% !important;
    gap: 8px !important;
    margin: 8px 0 14px 0 !important;
    padding: 0 !important;
    box-sizing: border-box !important;
}

.mypay-legend-item {
    flex: 1 !important;
    height: 30px !important;
    line-height: 30px !important;
    text-align: center !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 12px !important;
    font-weight: bold !important;
    color: #ffffff !important;
    border-radius: 4px !important;
    letter-spacing: 0.3px !important;
    box-shadow: 0 1px 3px rgba(0,0,0,0.12) !important;
    transition: transform 0.15s ease, box-shadow 0.15s ease !important;
    user-select: none !important;
}

.mypay-legend-item:hover {
    transform: translateY(-1px) !important;
    box-shadow: 0 3px 6px rgba(0,0,0,0.18) !important;
}

.legend-available {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
}

.legend-reserved {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%) !important;
}

.legend-waitlisted {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%) !important;
}

.legend-enquiry {
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%) !important;
}

.legend-tentative {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;
}

.legend-blocked {
    background: linear-gradient(135deg, #64748b 0%, #475569 100%) !important;
}

.mypay-wedding-table {
    width: 100% !important;
    border-collapse: separate !important;
    border-spacing: 0 8px !important;
    background: #fdfdfd !important;
    border: 1px solid #e0e0e0 !important;
    border-radius: 4px !important;
    padding: 10px 15px !important;
    margin-bottom: 12px !important;
}

.mypay-wedding-table td {
    border: none !important;
    padding: 2px 8px !important;
    font-size: 12px !important;
    vertical-align: middle !important;
}

/* 3 Column Layout */
.mypay-three-col-layout {
    display: flex !important;
    gap: 15px !important;
    margin-top: 10px !important;
}

.mypay-form-col {
    flex: 1 !important;
    background: #fafbfc !important;
    border: 1px solid #e1e4e8 !important;
    border-radius: 4px !important;
    padding: 12px 14px !important;
}

.mypay-col-title {
    font-weight: bold !important;
    font-size: 12px !important;
    color: #0073B5 !important;
    margin-bottom: 10px !important;
    padding-bottom: 5px !important;
    border-bottom: 1px solid #e1e4e8 !important;
    text-transform: uppercase !important;
}

.mypay-form-table {
    width: 100% !important;
    border-collapse: separate !important;
    border-spacing: 0 8px !important;
    border: none !important;
    margin: 0 !important;
    padding: 0 !important;
}

.mypay-form-table tr,
.mypay-form-table td {
    border: none !important;
    background: transparent !important;
    padding: 0 !important;
    vertical-align: middle !important;
}

.mypay-label-cell {
    width: 36% !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 12px !important;
    color: #222222 !important;
    font-weight: normal !important;
    padding-right: 6px !important;
    text-align: left !important;
    line-height: 1.2 !important;
}

.mypay-label-cell label {
    margin: 0 !important;
    padding: 0 !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 12px !important;
    color: #222222 !important;
    font-weight: normal !important;
    display: inline-block !important;
}

.mypay-label-cell label em, .mypay-label-cell label .req-star {
    color: #d9534f !important;
    font-style: normal !important;
    margin-left: 1px !important;
    font-weight: bold !important;
}

.mypay-input-cell {
    width: 64% !important;
}

.mypay-input, select.mypay-input, textarea.mypay-input {
    width: 100% !important;
    height: 28px !important;
    line-height: 28px !important;
    padding: 0 8px !important;
    border: 1px solid #d0d7de !important;
    border-radius: 3px !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 12px !important;
    color: #333333 !important;
    background: #ffffff !important;
    box-sizing: border-box !important;
    outline: none !important;
}

textarea.mypay-input {
    height: 48px !important;
    line-height: 1.4 !important;
    padding: 4px 8px !important;
}

.mypay-input:focus, select.mypay-input:focus, textarea.mypay-input:focus {
    border-color: #0084b4 !important;
}

/* Card Bottom Action Bar */
.mypay-card-footer {
    background: #0073B5 !important;
    height: 44px !important;
    padding: 0 15px !important;
    box-sizing: border-box !important;
    display: flex !important;
    justify-content: center !important;
    align-items: center !important;
    gap: 8px !important;
    margin: 0 !important;
    border: none !important;
    border-radius: 0 0 5px 5px !important;
}

.btn-mypay-action {
    background: #005b8a !important;
    color: #ffffff !important;
    border: 1px solid rgba(255, 255, 255, 0.35) !important;
    border-radius: 3px !important;
    padding: 0 14px !important;
    font-family: Arial, Helvetica, sans-serif !important;
    font-size: 12px !important;
    font-weight: bold !important;
    height: 28px !important;
    line-height: 26px !important;
    box-sizing: border-box !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 6px !important;
    text-decoration: none !important;
    cursor: pointer !important;
    margin: 0 !important;
}

.btn-mypay-action:hover {
    background: #00496e !important;
    color: #ffffff !important;
    text-decoration: none !important;
}
</style>

<body class="bgBODY">

<div class="mypay-container">

<?php if(isset($_GET['msg'])){ ?>
<script>
$(document).ready(function(){
    swal({
        title: "Booking No: <?php echo $_GET['msg']; ?>",
        icon: "success",
    });
});
</script>
<p style="text-align:center;margin:10px 0;">
    <label id="msgFo" style="color:#7B0E0E;font-weight:bold;font-size:13px;"><?php echo htmlspecialchars($_GET['msg']); ?></label>
</p>
<?php } ?>

<?php
$sqlAC = mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC = mysql_fetch_array($sqlAC);
$curDate = $rowAC['cur_date'];
?>

    <div class="mypay-card">
        <div class="mypay-card-header">
            HALL BOOKING
        </div>

        <form id="hotelDefi" name="hotelDefi" enctype="multipart/form-data" action="<?php echo $home_path;?>/action/add_hall_booking.php" method="post">
            <input name="incLc" id="incLc" type="hidden" value=""/>
            <input type="hidden" name="rowVl" id="rowVl"/>
            <input type="hidden" name="rmomType" id="rmomType"/>
            <input type="hidden" name="adtDate" id="adtDate" value="<?php echo $curDate; ?>"/>

            <div class="mypay-card-body">
                
                <!-- 1. Top Hall Details Table -->
                <div style="overflow-x:auto;">
                    <table class="mypay-sub-table" cellpadding="0" cellspacing="0">
                        <thead>
                            <tr>
                                <th style="width:90px;">Date</th>
                                <th style="width:110px;">Venue</th>
                                <th style="width:110px;">Session</th>
                                <th style="width:75px;">From</th>
                                <th style="width:75px;">To</th>
                                <th style="width:95px;">Seating</th>
                                <th style="width:120px;">Function</th>
                                <th style="width:60px;">Exp Pax</th>
                                <th style="width:60px;">Guar Pax</th>
                                <th style="width:75px;">Food Rate</th>
                                <th style="width:75px;">Hall Rate</th>
                                <th style="width:110px;">Status</th>
                            </tr>
                        </thead>
                        <tbody id="displyRoomDET">
                        <?php 
                        if(isset($_GET['ven'])){
                            $hid_regsp1 = $_GET['ven'];
                            $hidRrR1 = trim($hid_regsp1, ',');
                            $rmNSpt1 = explode(',', $hidRrR1);
                            $cnt = count($rmNSpt1);
                        } else {
                            $cnt = 0;
                        }
                        if(isset($_GET['val'])){
                            $hid_val = $_GET['val'];
                            $hidval = trim($hid_val, ',');
                            $rmNval = explode(',', $hidval);
                        }
                        if(isset($_GET['dte'])){
                            $hid_dte = $_GET['dte'];
                            $hiddte = trim($hid_dte, ',');
                            $rmNdte = explode(',', $hiddte);
                        }

                        if(isset($_GET['ven'])){
                            for($cc=0; $cc<count($rmNSpt1); $cc++){
                        ?>
                            <tr>
                                <td><input name="book_date[]" id="book_date<?php echo $cc;?>" type="text" class="mypay-input-sm" value="<?php if(isset($rmNdte[$cc])) {echo htmlspecialchars($rmNdte[$cc]);}?>" placeholder="dd/mm/yyyy" readonly /></td>
                                <td>
                                    <?php $sqlBS = mysql_query("select distinct venue_code, venue_desc from bq_venue where status='1'"); ?>
                                    <select name="venue[]" id="venue<?php echo $cc;?>" class="mypay-input-sm" onChange="selVenueName('<?php echo $cc;?>');" readonly>
                                        <option value="">--Select--</option>
                                        <?php while($rowBS = mysql_fetch_array($sqlBS)) {  
                                            $sel = (isset($rmNSpt1[$cc]) && $rmNSpt1[$cc] == $rowBS['venue_code']) ? 'selected' : '';
                                        ?>
                                            <option value="<?php echo htmlspecialchars($rowBS['venue_code']); ?>" <?php echo $sel; ?>><?php echo htmlspecialchars($rowBS['venue_desc']); ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td>
                                    <?php $sqlBS = mysql_query("select distinct sess_code, sess_name from bqt_session where status='1'"); ?>
                                    <select name="session[]" id="session<?php echo $cc;?>" class="mypay-input-sm" onChange="selSessionName('<?php echo $cc;?>');" readonly>
                                        <option value="">--Select--</option>
                                        <?php while($rowBS = mysql_fetch_array($sqlBS)) {  
                                            $sel = (isset($rmNval[$cc]) && $rmNval[$cc] == $rowBS['sess_code']) ? 'selected' : '';
                                        ?>
                                            <option value="<?php echo htmlspecialchars($rowBS['sess_code']); ?>" <?php echo $sel; ?>><?php echo htmlspecialchars($rowBS['sess_name']); ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <?php 
                                $sqlse = mysql_query("select * from bqt_session where status='1' and sess_code='".$rmNval[$cc]."'");
                                while($rowBS = mysql_fetch_array($sqlse)) {	
                                ?>
                                    <td><input name="from_time[]" id="from_time<?php echo $cc;?>" type="text" class="mypay-input-sm" value="<?php echo htmlspecialchars($rowBS['from_time']);?>"/></td>
                                    <td><input name="to_time[]" id="to_time<?php echo $cc;?>" type="text" class="mypay-input-sm" value="<?php echo htmlspecialchars($rowBS['to_time']);?>" onblur="selTOtme('<?php echo $cc;?>');"/></td>
                                <?php } ?>
                                <td>
                                    <?php $sqlBS = mysql_query("select distinct seat_code, seat_desc from bq_seating where status='1'"); ?>
                                    <select name="seating[]" id="seating<?php echo $cc;?>" class="mypay-input-sm" onChange="selSeatingName('<?php echo $cc;?>');">
                                        <option value="">--Select--</option>
                                        <?php while($rowBS = mysql_fetch_array($sqlBS)) { ?>
                                            <option value="<?php echo htmlspecialchars($rowBS['seat_code']); ?>"><?php echo htmlspecialchars($rowBS['seat_desc']); ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td>
                                    <?php $sqlBS = mysql_query("select distinct func_code, func_desc from bq_function where status='1'"); ?>
                                    <select name="funct[]" id="funct<?php echo $cc;?>" class="mypay-input-sm" onChange="selFunctionName('<?php echo $cc;?>');">
                                        <option value="">--Select--</option>
                                        <?php while($rowBS = mysql_fetch_array($sqlBS)) { ?>
                                            <option value="<?php echo htmlspecialchars($rowBS['func_code']); ?>"><?php echo htmlspecialchars($rowBS['func_desc']); ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td><input name="expected[]" id="expected<?php echo $cc;?>" type="text" class="mypay-input-sm" value="0" onblur="expeExcQty(<?php echo $cc;?>);"/></td>
                                <td><input name="guaranted[]" id="guaranted<?php echo $cc;?>" type="text" class="mypay-input-sm" value="0" onblur="guarExcQty(<?php echo $cc;?>);"/></td>
                                <td><input name="plan_rate[]" id="plan_rate<?php echo $cc;?>" type="text" class="mypay-input-sm" value="0" /></td>
                                <td><input name="hall_rate[]" id="hall_rate<?php echo $cc;?>" type="text" class="mypay-input-sm" value="0" /></td>
                                <td>
                                    <?php $sqlBS = mysql_query("select distinct room_availability, roomavail_define from bq_stscolor where roomavail_define!='1' AND roomavail_define!='7'"); ?>
                                    <select name="confirm_status[]" id="confirm_status<?php echo $cc;?>" class="mypay-input-sm" onChange="selConfirmStsName('<?php echo $cc;?>');">
                                        <option value="">--Select--</option>
                                        <?php while($rowBS = mysql_fetch_array($sqlBS)) { ?>
                                            <option value="<?php echo htmlspecialchars($rowBS['roomavail_define']); ?>"><?php echo htmlspecialchars($rowBS['room_availability']); ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                        <?php } } ?>

                        <?php for($cc=$cnt; $cc<10; $cc++){ ?>
                            <tr>
                                <td><input name="book_date[]" id="book_date<?php echo $cc;?>" type="text" class="mypay-input-sm datepicker" onblur="arrDateSel('<?php echo $cc;?>');" onclick="arrCopySel('<?php echo $cc;?>');" placeholder="dd/mm/yyyy"/></td>
                                <td>
                                    <?php $sqlBS = mysql_query("select distinct venue_code, venue_desc from bq_venue where status='1'"); ?>
                                    <select name="venue[]" id="venue<?php echo $cc;?>" class="mypay-input-sm" onChange="selVenueName('<?php echo $cc;?>');">
                                        <option value="">--Select--</option>
                                        <?php while($rowBS = mysql_fetch_array($sqlBS)) { ?>
                                            <option value="<?php echo htmlspecialchars($rowBS['venue_code']); ?>"><?php echo htmlspecialchars($rowBS['venue_desc']); ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td>
                                    <?php $sqlBS = mysql_query("select distinct sess_code, sess_name from bqt_session where status='1'"); ?>
                                    <select name="session[]" id="session<?php echo $cc;?>" class="mypay-input-sm" onChange="selSessionName('<?php echo $cc;?>');">
                                        <option value="">--Select--</option>
                                        <?php while($rowBS = mysql_fetch_array($sqlBS)) { ?>
                                            <option value="<?php echo htmlspecialchars($rowBS['sess_code']); ?>"><?php echo htmlspecialchars($rowBS['sess_name']); ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td><input name="from_time[]" id="from_time<?php echo $cc;?>" type="text" class="mypay-input-sm" /></td>
                                <td><input name="to_time[]" id="to_time<?php echo $cc;?>" type="text" class="mypay-input-sm" onblur="selTOtme('<?php echo $cc;?>');" /></td>
                                <td>
                                    <?php $sqlBS = mysql_query("select distinct seat_code, seat_desc from bq_seating where status='1'"); ?>
                                    <select name="seating[]" id="seating<?php echo $cc;?>" class="mypay-input-sm" onChange="selSeatingName('<?php echo $cc;?>');">
                                        <option value="">--Select--</option>
                                        <?php while($rowBS = mysql_fetch_array($sqlBS)) { ?>
                                            <option value="<?php echo htmlspecialchars($rowBS['seat_code']); ?>"><?php echo htmlspecialchars($rowBS['seat_desc']); ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td>
                                    <?php $sqlBS = mysql_query("select distinct func_code, func_desc from bq_function where status='1'"); ?>
                                    <select name="funct[]" id="funct<?php echo $cc;?>" class="mypay-input-sm" onChange="selFunctionName('<?php echo $cc;?>');">
                                        <option value="">--Select--</option>
                                        <?php while($rowBS = mysql_fetch_array($sqlBS)) { ?>
                                            <option value="<?php echo htmlspecialchars($rowBS['func_code']); ?>"><?php echo htmlspecialchars($rowBS['func_desc']); ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td><input name="expected[]" id="expected<?php echo $cc;?>" type="text" class="mypay-input-sm" value="0" onblur="expeExcQty(<?php echo $cc;?>);"/></td>
                                <td><input name="guaranted[]" id="guaranted<?php echo $cc;?>" type="text" class="mypay-input-sm" value="0" onblur="guarExcQty(<?php echo $cc;?>);"/></td>
                                <td><input name="plan_rate[]" id="plan_rate<?php echo $cc;?>" type="text" class="mypay-input-sm" value="0" /></td>
                                <td><input name="hall_rate[]" id="hall_rate<?php echo $cc;?>" type="text" class="mypay-input-sm" value="0" /></td>
                                <td>
                                    <?php $sqlBS = mysql_query("select distinct room_availability, roomavail_define from bq_stscolor where roomavail_define!='1' AND roomavail_define!='7'"); ?>
                                    <select name="confirm_status[]" id="confirm_status<?php echo $cc;?>" class="mypay-input-sm" onChange="selConfirmStsName('<?php echo $cc;?>');">
                                        <option value="">--Select--</option>
                                        <?php while($rowBS = mysql_fetch_array($sqlBS)) { ?>
                                            <option value="<?php echo htmlspecialchars($rowBS['roomavail_define']); ?>"><?php echo htmlspecialchars($rowBS['room_availability']); ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>

                <!-- 2. Status Color Legend Bar -->
                <div class="mypay-legend-strip">
                    <div class="mypay-legend-item legend-available">Available</div>
                    <div class="mypay-legend-item legend-reserved">Reserved</div>
                    <div class="mypay-legend-item legend-waitlisted">Wait Listed</div>
                    <div class="mypay-legend-item legend-enquiry">Enquiry</div>
                    <div class="mypay-legend-item legend-tentative">Tentative</div>
                    <div class="mypay-legend-item legend-blocked">Blocked</div>
                </div>

                <!-- 3. Wedding Information Grid -->
                <table class="mypay-wedding-table" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="width:15%;font-weight:bold;text-align:right;">Bride Name :</td>
                        <td style="width:35%;"><input name="bride" id="bride" type="text" class="mypay-input" /></td>
                        <td style="width:15%;font-weight:bold;text-align:right;">Groom Name :</td>
                        <td style="width:35%;"><input name="groom" id="groom" type="text" class="mypay-input" /></td>
                    </tr>
                    <tr>
                        <td style="font-weight:bold;text-align:right;">Bride Location :</td>
                        <td><input name="bride_loc" id="bride_loc" type="text" class="mypay-input" /></td>
                        <td style="font-weight:bold;text-align:right;">Groom Location :</td>
                        <td><input name="groom_loc" id="groom_loc" type="text" class="mypay-input" /></td>
                    </tr>
                </table>

                <!-- 4. Three Column Parameter Details -->
                <div class="mypay-three-col-layout">
                    
                    <!-- Col 1: Guest Information -->
                    <div class="mypay-form-col">
                        <div class="mypay-col-title"><i class="fa fa-user"></i> Guest Information</div>
                        <table class="mypay-form-table" cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td class="mypay-label-cell"><label>Type <em>*</em> :</label></td>
                                    <td class="mypay-input-cell">
                                        <select name="corporate" id="corporate" class="mypay-input" onChange="corPind();" required>
                                            <option value="">--Select--</option>
                                            <option value="corporate">Corporate</option>
                                            <option value="individual">Individual</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="mypay-label-cell"><label>Title & Name <em>*</em> :</label></td>
                                    <td class="mypay-input-cell">
                                        <div style="display:flex;gap:4px;">
                                            <select name="title" id="title" class="mypay-input" style="width:65px !important;" onChange="corPind();">
                                                <option value="mr">Mr</option>
                                                <option value="mrs">Mrs</option>
                                                <option value="ms">Ms</option>
                                                <option value="m/s">M/s</option>
                                                <option value="dr">Dr</option>
                                            </select>
                                            <input name="guest_name" id="guest_name" type="text" class="mypay-input" placeholder="Guest Name" style="flex:1;" required />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="mypay-label-cell"><label>Address 1 :</label></td>
                                    <td class="mypay-input-cell"><input name="address1" id="address1" type="text" class="mypay-input" /></td>
                                </tr>
                                <tr>
                                    <td class="mypay-label-cell"><label>Address 2 :</label></td>
                                    <td class="mypay-input-cell"><input name="address2" id="address2" type="text" class="mypay-input" /></td>
                                </tr>
                                <tr>
                                    <td class="mypay-label-cell"><label>City & Zip <em>*</em> :</label></td>
                                    <td class="mypay-input-cell">
                                        <div style="display:flex;gap:4px;">
                                            <input name="city" id="city" type="text" class="mypay-input" style="flex:1;" placeholder="City" required />
                                            <input name="pin_code" id="pin_code" type="text" class="mypay-input" placeholder="Zip" maxlength="6" style="width:75px !important;" onkeypress="return pointNum(event);" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="mypay-label-cell"><label>State & Country <em>*</em> :</label></td>
                                    <td class="mypay-input-cell">
                                        <div style="display:flex;gap:4px;">
                                            <select name="state" id="state" class="mypay-input" style="flex:1;">
                                                <option value="">--State--</option>
                                                <?php 
                                                $sqlBS = mysql_query("select distinct state_code, state_name from states where status='1'");
                                                while($rowBS = mysql_fetch_array($sqlBS)) {  
                                                ?>
                                                    <option value="<?php echo htmlspecialchars($rowBS['state_code']); ?>"><?php echo htmlspecialchars($rowBS['state_name']); ?></option>
                                                <?php } ?>
                                            </select>
                                            <input name="country" id="country" type="text" class="mypay-input" style="width:75px !important;" value="India"/>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="mypay-label-cell"><label>Phone <em>*</em> :</label></td>
                                    <td class="mypay-input-cell">
                                        <input name="phone" type="text" id="phone" class="mypay-input" maxlength="10" onkeypress="return pointNum(event);" required />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Col 2: Company & Contact Person -->
                    <div class="mypay-form-col">
                        <div class="mypay-col-title"><i class="fa fa-building"></i> Company & Contact</div>
                        <table class="mypay-form-table" cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td class="mypay-label-cell"><label>Company :</label></td>
                                    <td class="mypay-input-cell">
                                        <?php $sqlTB = mysql_query("select distinct comp_code, comp_name from company_master"); ?>
                                        <select name="comp_code" id="comp_code" class="mypay-input">
                                            <option value="">--Select Company--</option>
                                            <?php while($rowTB = mysql_fetch_array($sqlTB)) { ?>
                                                <option value="<?php echo htmlspecialchars($rowTB['comp_code']); ?>"><?php echo htmlspecialchars($rowTB['comp_name']); ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="mypay-label-cell"><label>Email :</label></td>
                                    <td class="mypay-input-cell"><input name="email" id="email" type="email" class="mypay-input" /></td>
                                </tr>
                                <tr>
                                    <td class="mypay-label-cell"><label>GSTIN :</label></td>
                                    <td class="mypay-input-cell"><input name="gst_no" id="gst_no" type="text" class="mypay-input" style="text-transform:uppercase;" /></td>
                                </tr>
                                <tr>
                                    <td class="mypay-label-cell"><label>Contact Person :</label></td>
                                    <td class="mypay-input-cell"><input name="contact_person" id="contact_person" type="text" class="mypay-input" style="text-transform:uppercase;" /></td>
                                </tr>
                                <tr>
                                    <td class="mypay-label-cell"><label>Mobile No :</label></td>
                                    <td class="mypay-input-cell"><input name="contact_mobile" type="text" id="mobile" class="mypay-input" maxlength="10" onkeypress="return pointNum(event);" /></td>
                                </tr>
                                <tr>
                                    <td class="mypay-label-cell"><label>Booked By :</label></td>
                                    <td class="mypay-input-cell"><input name="booked_by" id="booked_by" type="text" class="mypay-input" /></td>
                                </tr>
                                <tr>
                                    <td class="mypay-label-cell"><label>Booker ID :</label></td>
                                    <td class="mypay-input-cell"><input name="booker_id" id="booker_id" type="text" class="mypay-input" /></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Col 3: Billing & Instructions -->
                    <?php 
                    $sqlP = mysql_query("select * from property_definition");
                    $rowP = ($sqlP && mysql_num_rows($sqlP)>0) ? mysql_fetch_array($sqlP) : array();
                    ?>
                    <div class="mypay-form-col">
                        <div class="mypay-col-title"><i class="fa fa-file-text"></i> Billing & Instructions</div>
                        <table class="mypay-form-table" cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td class="mypay-label-cell"><label>Type of Billing <em>*</em> :</label></td>
                                    <td class="mypay-input-cell">
                                        <?php $sqlTB = mysql_query("select distinct bill_code, bill_desc from bq_billinstruc"); ?>
                                        <select name="top_code" id="top_code" class="mypay-input" required>
                                            <option value="">--Select--</option>
                                            <?php while($rowTB = mysql_fetch_array($sqlTB)) { ?>
                                                <option value="<?php echo htmlspecialchars($rowTB['bill_code']); ?>" selected><?php echo htmlspecialchars($rowTB['bill_desc']); ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="mypay-label-cell"><label>Business Source <em>*</em> :</label></td>
                                    <td class="mypay-input-cell">
                                        <?php $sqlBS = mysql_query("select distinct bs_code, bs_name from bq_bssource where bs_code!=''"); ?>
                                        <select name="business_src" id="business_src" class="mypay-input" required>
                                            <option value="">--Select--</option>
                                            <?php 
                                            while($rowTB = mysql_fetch_array($sqlBS)) {
                                                $sel = (isset($rowP['business_src']) && $rowP['business_src'] == strtoupper($rowTB['bs_code'])) ? 'selected' : '';
                                            ?>
                                                <option value="<?php echo htmlspecialchars($rowTB['bs_code']); ?>" <?php echo $sel; ?>><?php echo htmlspecialchars($rowTB['bs_name']); ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="mypay-label-cell"><label>Market Segment <em>*</em> :</label></td>
                                    <td class="mypay-input-cell">
                                        <?php $sqlBS = mysql_query("select distinct mscode, msname from bq_marketseg"); ?>
                                        <select name="segment_code" id="segment_code" class="mypay-input" required>
                                            <option value="">--Select--</option>
                                            <?php 
                                            while($rowBS = mysql_fetch_array($sqlBS)) {
                                                $sel = (isset($rowP['segment_code']) && $rowP['segment_code'] == $rowBS['mscode']) ? 'selected' : '';
                                            ?>
                                                <option value="<?php echo htmlspecialchars($rowBS['mscode']); ?>" <?php echo $sel; ?>><?php echo htmlspecialchars($rowBS['msname']); ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="mypay-label-cell"><label>Pay Mode <em>*</em> :</label></td>
                                    <td class="mypay-input-cell">
                                        <?php $sqlPm = mysql_query("select distinct pay_code, pay_desc from bq_paymode"); ?>
                                        <select name="pay_mode" id="pay_mode" class="mypay-input" required>
                                            <option value="">--Select--</option>
                                            <?php 
                                            while($rowPm = mysql_fetch_array($sqlPm)) {
                                                $sel = (isset($rowP['pay_mode']) && $rowP['pay_mode'] == $rowPm['pay_code']) ? 'selected' : '';
                                            ?>
                                                <option value="<?php echo htmlspecialchars($rowPm['pay_code']); ?>" <?php echo $sel; ?>><?php echo htmlspecialchars($rowPm['pay_desc']); ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="mypay-label-cell"><label>Remind Date :</label></td>
                                    <td class="mypay-input-cell"><input name="remind_date" id="remind_date" type="text" class="mypay-input datepicker1" /></td>
                                </tr>
                                <tr>
                                    <td class="mypay-label-cell"><label>Remarks :</label></td>
                                    <td class="mypay-input-cell"><textarea name="remarks" id="remarks" class="mypay-input" style="text-transform:uppercase;"></textarea></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>

            <!-- Card Bottom Action Bar -->
            <div class="mypay-card-footer">
                <button type="submit" id="send" name="send" class="btn-mypay-action" onclick="return checkformSubmit();" title="Submit (Ctrl+S)">
                    <i class="fa fa-floppy-o"></i> Submit
                </button>
                <a href="view-hall-booking.php?fromdate=<?php echo $rowAC['cur_date'];?>&todate=<?php echo $rowAC['cur_date'];?>&val=" class="btn-mypay-action" title="View (Ctrl+V)">
                    <i class="fa fa-eye"></i> View
                </a>
                <a href="<?php echo $home_path;?>/dashboard.php?fromdate=<?php echo $rowAC['cur_date'];?>&todate=<?php echo $rowAC['cur_date'];?>" target="_blank" class="btn-mypay-action" title="Hall Status">
                    <i class="fa fa-th"></i> Hall Status
                </a>
                <button type="reset" id="rest" class="btn-mypay-action" onclick="cancel_ed();" title="Clear (Ctrl+C)">
                    <i class="fa fa-paint-brush" style="color:#f39c12;"></i> Clear
                </button>
                <a href="<?php echo $home_path; ?>/dashboard.php?fromdate=<?php echo $rowAC['cur_date'];?>&todate=<?php echo $rowAC['cur_date'];?>" class="btn-mypay-action" title="Exit (Ctrl+E)">
                    <i class="fa fa-times" style="color:#e74c3c;"></i> Exit
                </a>
            </div>
        </form>
    </div>

</div>

<?php include("../../footer.php"); ?>
</body>
</html>