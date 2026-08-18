<?php
ob_start();
include("../../config.php");
include("../../header.php");

$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$curTime=date('H:i:s');
?>	
<style>
/* .frmSearch {border: 1px solid #F0F0F0;/* background-color:#C8EEFD; */margin: 2px 0px;/* padding:40px; */}
#country-list{float:left;font-size:14px;list-style:none;margin:18px 0 0 0px;padding:0;width:210px;position: absolute;z-index: 1;}
#country-list li{padding: 2px; background:#FAFAFA;border-bottom:#F0F0F0 1px solid;}
#country-list li:hover{background:#F0F0F0;}
#search-box{padding: 10px;border: #F0F0F0 1px solid;} */


.spanClr{
	color: #5b503b;
    display: block;
    float: left;
    font-size: 12px;
    font-weight: normal;
    padding: 2px 9px 0 5px;
		
}

.frmSearch {border: 1px solid #F0F0F0;/* background-color:#C8EEFD; */margin: 2px 0px;/* padding:40px; */}
#country-list{float:left;list-style:none;margin:0;padding:0;width:190px;position: absolute;z-index: 1;}
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
$roomBk=$_GET['roomBk'];
$sqlQR=mysql_query("select * from room_booking where resv_no='".$_GET['roomBk']."' AND resv_status!='4' AND resv_status!='5'");
$rowQR=mysql_fetch_array($sqlQR);
?>
<?php 
$result = mysql_query("select distinct room_type from room_master") ;
$tmpStr=""; $btStr=""; $i=0; 
$btStr ='<option value="">---select--</option>';
while($row = mysql_fetch_array( $result )) { 
$tmpStr ='<option value="'.$row['room_type'].'">'.$row['room_type'].'</option>';
$btStr .=$tmpStr;
 $i++;} ?>	
<?php 
$resultP = mysql_query("select distinct plan_code from meal_plan") ;
$tmpStrP=""; $btStrP=""; $i=0; 
$btStrP ='<option value="">---select--</option>';
while($rowP = mysql_fetch_array( $resultP )) {
if($rowP['plan_code']==$rowQR['meal_plan']){
	$tmpStrP ='<option value="'.$rowP['plan_code'].'" selected >'.$rowP['plan_code'].'</option>';
}else{
	$tmpStrP ='<option value="'.$rowP['plan_code'].'">'.$rowP['plan_code'].'</option>';
}

$btStrP .=$tmpStrP;
 $i++;} ?> 
.
<?php 
$resultN = mysql_query("select distinct nationality_code,country,native from nationality") ;
$tmpStrN=""; $btStrN=""; $i=0; 
$btStrN ='<option value="">---select--</option>';
while($rowN = mysql_fetch_array( $resultN )) { 
if($rowN['native']=='1'){
	$tmpStrN ='<option value="'.$rowN['nationality_code'].'" selected >'.$rowN['country'].'</option>';
}else{
$tmpStrN ='<option value="'.$rowN['nationality_code'].'">'.$rowN['country'].'</option>';	
}
$btStrN .=$tmpStrN;
 $i++;} ?> 
 					
 
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





$(".depaDate").keyup(function(){
	if ($(this).val().length == 2){
		$(this).val($(this).val() + "/");
	}else if ($(this).val().length == 5){
		$(this).val($(this).val() + "/");
	}
});
			
	$("#msgFo").fadeOut(5000);
	$("#msgFoprop").fadeOut(7000);
	jQuery("#hotelDefi").validationEngine();
	
var dt = new Date();
/* var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds(); */
var time = dt.getHours() + ":" + dt.getMinutes() ;
 $('#departure_time').val(time);
 $('#arrival_time').val(time);
 
$('input[name^=arrival_date]').live('keyup', function() {
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

	
	$("#msgFo").fadeOut(5000);
	$("#msgFoprop").fadeOut(7000);
	jQuery("#hotelDefi").validationEngine();
	
var dt = new Date();
/* var time = dt.getHours() + ":" + dt.getMinutes() + ":" + dt.getSeconds(); */
var time = dt.getHours() + ":" + dt.getMinutes();

var Dptime = '12:00' ;
$('#departure_time').val(Dptime);
/* $('#departure_time').val(time); */
 $('#arrival_time').val(time);
 
 
$('input[name^=disc_val]').live('keyup', function() {
		totRmsn=0;totDblsn=0;	totTrsn=0;totQdsn=0;totExtn=0;totExc=0;
		dsPer=0;rmBdTt=0;
		room_type=($("#room_type").val());
		rate_code=($("#rate_code").val());
		disc=($("#disc").val());
		disVal=($("#disc_val").val());
		/* alert(rmSng); */
		$.ajax({
		type:'GET',
		url:'  ../../action/calcDisROOMBkChkInVAlue.php',
			data:{
			room_type:room_type,
			rate_code:rate_code,
			disc:disc,
			disVal:disVal
			},
			success:function(data){
				  /* alert(data); */ 
		 opt=data.split(',');
		rmSng=($("#room_single").val(opt[0]));
		rmDbl=($("#room_double").val(opt[1]));
		rmTrp=($("#room_tripple").val(opt[2]));
		rmQud=($("#room_quadruple").val(opt[3]));
		rmExper=($("#room_extperson").val(opt[4]));
		rmExch=($("#room_extchild").val(opt[5]));
		}
		});
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
	
	
	
	
$(".incLchk").on("click", function(){
    if(incLchk.checked) {
        $("#incLc").val('inclyes');
		incl=$('#incLchk').val();
		incLc=$('#incLc').val();
		roomType1=$('#room_type1').val();
		roomType2=$('#room_type2').val();
		roomType3=$('#room_type3').val();
		rateCode=$('#rate_code').val();
		room_no=$('#room_no').val();
		
		rmSng1=($("#room_single1").val());
		rmDbl1=($("#room_double1").val());
		rmTrp1=($("#room_tripple1").val());
		rmQud1=($("#room_quadruple1").val());
		rmExper1=($("#room_extperson1").val());
		rmExch1=($("#room_extchild1").val());
		mlSng1=($("#meal_single1").val());
		mlDbl1=($("#meal_double1").val());
		mlTpl1=($("#meal_tripple1").val());
		mlQdr1=($("#meal_quadruple1").val());
		mlExt1=($("#meal_extperson1").val());
		mlEXd1=($("#meal_extchild1").val());
		
		rmSng2=($("#room_single2").val());
		rmDbl2=($("#room_double2").val());
		rmTrp2=($("#room_tripple2").val());
		rmQud2=($("#room_quadruple2").val());
		rmExper2=($("#room_extperson2").val());
		rmExch2=($("#room_extchild2").val());
		mlSng2=($("#meal_single2").val());
		mlDbl2=($("#meal_double2").val());
		mlTpl2=($("#meal_tripple2").val());
		mlQdr2=($("#meal_quadruple2").val());
		mlExt2=($("#meal_extperson2").val());
		mlEXd2=($("#meal_extchild2").val());
		
		rmSng3=($("#room_single3").val());
		rmDbl3=($("#room_double3").val());
		rmTrp3=($("#room_tripple3").val());
		rmQud3=($("#room_quadruple3").val());
		rmExper3=($("#room_extperson3").val());
		rmExch3=($("#room_extchild3").val());
		mlSng3=($("#meal_single3").val());
		mlDbl3=($("#meal_double3").val());
		mlTpl3=($("#meal_tripple3").val());
		mlQdr3=($("#meal_quadruple3").val());
		mlExt3=($("#meal_extperson3").val());
		mlEXd3=($("#meal_extchild3").val());
		
		$.ajax({
		type:'GET',
		url:'  ../../action/selectINCLusiveROOMbook.php',
			data:{
			incl:incl,
			incLc:incLc,
			rateCode:rateCode,
			room_no:room_no,
			roomType1:roomType1,
			roomType2:roomType2,
			roomType3:roomType3,
			
			rmSng1:rmSng1,
			rmDbl1:rmDbl1,
			rmTrp1:rmTrp1,
			rmQud1:rmQud1,
			rmExper1:rmExper1,
			rmExch1:rmExch1,
			mlSng1:mlSng1,
			mlDbl1:mlDbl1,
			mlTpl1:mlTpl1,
			mlQdr1:mlQdr1,
			mlExt1:mlExt1,
			mlEXd1:mlEXd1,
			
			rmSng2:rmSng2,
			rmDbl2:rmDbl2,
			rmTrp2:rmTrp2,
			rmQud2:rmQud2,
			rmExper2:rmExper2,
			rmExch2:rmExch2,
			mlSng2:mlSng2,
			mlDbl2:mlDbl2,
			mlTpl2:mlTpl2,
			mlQdr2:mlQdr2,
			mlExt2:mlExt2,
			mlEXd2:mlEXd2,
			
			rmSng3:rmSng3,
			rmDbl3:rmDbl3,
			rmTrp3:rmTrp3,
			rmQud3:rmQud3,
			rmExper3:rmExper3,
			rmExch3:rmExch3,
			mlSng3:mlSng3,
			mlDbl3:mlDbl3,
			mlTpl3:mlTpl3,
			mlQdr3:mlQdr3,
			mlExt3:mlExt3,
			mlEXd3:mlEXd3
			},
			success:function(data){
			 /* alert(data); */ 
				opt=data.split(',');
				
				$('#room_single1').val(opt[0]);
				$('#room_double1').val(opt[1]);
				$('#room_tripple1').val(opt[2]);
				$('#room_quadruple1').val(opt[3]);
				$('#room_extperson1').val(opt[4]);
				$('#room_extchild1').val(opt[5]);
				$('#meal_single1').val(opt[6]);
				$('#meal_double1').val(opt[7]);
				$('#meal_tripple1').val(opt[8]);
				$('#meal_quadruple1').val(opt[9]);
				$('#meal_extperson1').val(opt[10]);
				$('#meal_extchild1').val(opt[11]);
				
				$('#room_single2').val(opt[12]);
				$('#room_double2').val(opt[13]);
				$('#room_tripple2').val(opt[14]);
				$('#room_quadruple2').val(opt[15]);
				$('#room_extperson2').val(opt[16]);
				$('#room_extchild2').val(opt[17]);
				$('#meal_single2').val(opt[18]);
				$('#meal_double2').val(opt[19]);
				$('#meal_tripple2').val(opt[20]);
				$('#meal_quadruple2').val(opt[21]);
				$('#meal_extperson2').val(opt[22]);
				$('#meal_extchild2').val(opt[23]);
				
				$('#room_single3').val(opt[24]);
				$('#room_double3').val(opt[25]);
				$('#room_tripple3').val(opt[26]);
				$('#room_quadruple3').val(opt[27]);
				$('#room_extperson3').val(opt[28]);
				$('#room_extchild3').val(opt[29]);
				$('#meal_single3').val(opt[30]);
				$('#meal_double3').val(opt[31]);
				$('#meal_tripple3').val(opt[32]);
				$('#meal_quadruple3').val(opt[33]);
				$('#meal_extperson3').val(opt[34]);
				$('#meal_extchild3').val(opt[35]); 
				
			}
		});
		
       
    } else {
		
	var menuStr="";
	$('.rmmType').each(function(i,v){
		/* if($(this).is(':checked'))
		{
		menuStr +=$(this).val()+',';
		} */
		menuStr +=$(this).val()+',';
	});
	menuStr = menuStr.slice(0,-1);
	$("#rmomType").val(menuStr);
	rmTe=$("#rmomType").val();
	
	
          $("#incLc").val('inclno');
		  incl=$('#incLchk').val();
		incLc=$('#incLc').val();
		roomType1=$('#room_type1').val();
		roomType2=$('#room_type2').val();
		roomType3=$('#room_type3').val();
		
		rateCode=$('#rate_code').val();
		room_no=$('#room_no').val();
		
		rmSng1=($("#room_single1").val());
		rmDbl1=($("#room_double1").val());
		rmTrp1=($("#room_tripple1").val());
		rmQud1=($("#room_quadruple1").val());
		rmExper1=($("#room_extperson1").val());
		rmExch1=($("#room_extchild1").val());
		mlSng1=($("#meal_single1").val());
		mlDbl1=($("#meal_double1").val());
		mlTpl1=($("#meal_tripple1").val());
		mlQdr1=($("#meal_quadruple1").val());
		mlExt1=($("#meal_extperson1").val());
		mlEXd1=($("#meal_extchild1").val());
		
		rmSng2=($("#room_single2").val());
		rmDbl2=($("#room_double2").val());
		rmTrp2=($("#room_tripple2").val());
		rmQud2=($("#room_quadruple2").val());
		rmExper2=($("#room_extperson2").val());
		rmExch2=($("#room_extchild2").val());
		mlSng2=($("#meal_single2").val());
		mlDbl2=($("#meal_double2").val());
		mlTpl2=($("#meal_tripple2").val());
		mlQdr2=($("#meal_quadruple2").val());
		mlExt2=($("#meal_extperson2").val());
		mlEXd2=($("#meal_extchild2").val());
		
		rmSng3=($("#room_single3").val());
		rmDbl3=($("#room_double3").val());
		rmTrp3=($("#room_tripple3").val());
		rmQud3=($("#room_quadruple3").val());
		rmExper3=($("#room_extperson3").val());
		rmExch3=($("#room_extchild3").val());
		mlSng3=($("#meal_single3").val());
		mlDbl3=($("#meal_double3").val());
		mlTpl3=($("#meal_tripple3").val());
		mlQdr3=($("#meal_quadruple3").val());
		mlExt3=($("#meal_extperson3").val());
		mlEXd3=($("#meal_extchild3").val());
		
		$.ajax({
		type:'GET',
		url:'  ../../action/selectINCLusiveROOMbook.php',
			data:{
			rmTe:rmTe,
			incl:incl,
			incLc:incLc,
			rateCode:rateCode,
			room_no:room_no,
			roomType1:roomType1,
			roomType2:roomType2,
			roomType3:roomType3,
			
			rmSng1:rmSng1,
			rmDbl1:rmDbl1,
			rmTrp1:rmTrp1,
			rmQud1:rmQud1,
			rmExper1:rmExper1,
			rmExch1:rmExch1,
			mlSng1:mlSng1,
			mlDbl1:mlDbl1,
			mlTpl1:mlTpl1,
			mlQdr1:mlQdr1,
			mlExt1:mlExt1,
			mlEXd1:mlEXd1,
			
			rmSng2:rmSng2,
			rmDbl2:rmDbl2,
			rmTrp2:rmTrp2,
			rmQud2:rmQud2,
			rmExper2:rmExper2,
			rmExch2:rmExch2,
			mlSng2:mlSng2,
			mlDbl2:mlDbl2,
			mlTpl2:mlTpl2,
			mlQdr2:mlQdr2,
			mlExt2:mlExt2,
			mlEXd2:mlEXd2,
			
			rmSng3:rmSng3,
			rmDbl3:rmDbl3,
			rmTrp3:rmTrp3,
			rmQud3:rmQud3,
			rmExper3:rmExper3,
			rmExch3:rmExch3,
			mlSng3:mlSng3,
			mlDbl3:mlDbl3,
			mlTpl3:mlTpl3,
			mlQdr3:mlQdr3,
			mlExt3:mlExt3,
			mlEXd3:mlEXd3
			},
			success:function(data){
				/* alert(data); */
				opt=data.split(',');
				/* alert(opt[11]); */
				$('.rmSgle').hide();
				$('#rtCode').html(opt[0]);
				$('#rate_desc').val(opt[1]);
				
			}
		});
    }
});


	

});

/*  shortcut.add("Ctrl+S",function() { 
	 $('#hotelDefi').attr('action', '../../action/add_room_booking.php');  
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
}); */
/* (function($) {
	window.addEvent('domready',function() {
		$('content-box').addEvent('keydown',function(event) {
			if((event.control || event.meta) && event.key == 'b') {
				event.stop();
				$('propmaster').submit();
			}
		});
	});
});
 */
 
function depDateSel(vl){
	arrival_date=$('#arrival_date').val();
	departure_date=$('#departure_date').val();
	departure_time=$('#departure_time').val();
	$('#depraDate').val(departure_date);
	$('#depraTime').val(departure_time);
	adtDate=$('#adtDate').val();
	depDt=$('.depaDate').val();
	tt=$('.depaDate').val().replace(/[A-Za-z$-]/g, "");
	nsnNo = tt.replace(/(\d{2})(\d{2})(\d{4})/, '$1/$2/$3');
	$('.depaDate').val(nsnNo);
var pattern =/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/;
  if (departure_date == null || departure_date == "" || !pattern.test(departure_date)) {
	  alert("check date format dd/mm/yyyy!.");
	  $('#departure_date').val('');
	  $('#departure_date').focus();
	}
$.ajax({
		type:'GET',
		url:'  ../../action/chkRmBOokDEpDAte.php',
			data:{
			arrival_date:arrival_date,
			departure_date:departure_date,
			adtDate:adtDate
			},
			success:function(data){
				 /* alert(data);  */
				if(data==1){
					alert("Departure date less than audit date!.");
					/* $('#departure_date').val('');
					$('#departure_date').focus(); */
						
				}
				ot=data.split(',');
				$('#dys'+vl).val(ot[1]);
				
				
			}
	});
 
}

function arrDateSel(){
arrival_date=$('#arrival_date').val();
departure_date=$('#departure_date').val();
arrival_time=$('#arrival_time').val();
$('#arriDate').val(arrival_date);
$('#arriTime').val(arrival_time);

adtDate=$('#adtDate').val();
tt=$('.arrDt').val().replace(/[A-Za-z$-/]/g, "");
nsnNo = tt.replace(/(\d{2})(\d{2})(\d{4})/, '$1/$2/$3');
$('.arrDt').val(nsnNo);
var pattern =/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/;
  if (arrival_date == null || arrival_date == "" || !pattern.test(arrival_date)) {
	  alert("check date format dd/mm/yyyy!.");
	  $('#arrival_date').val('');
	  $('#arrival_date').focus();
	}
   
$.ajax({
		type:'GET',
		url:'  ../../action/chkRmBOokARrDAte.php',
			data:{
			arrival_date:arrival_date,
			adtDate:adtDate,
			departure_date:departure_date
			},
			success:function(data){
				/* alert(data);  */
				if(data==1){
					alert("Arrival date less than audit date!.");
					$('#arrival_date').val('');
					$('#arrival_date').focus();
				}
				if(data==2){
					alert("Check the date!.");
					$('#departure_date').val('');
					$('#departure_date').focus();
					
				}
								
			}
	});
	
	

}

function arrDateSel1(vl){
	/* alert(vl); */
	arDt=$('#arrival_date'+vl).val();
	depDt=$('#departure_date'+vl).val();
	adtDate=$('#adtDate').val();
	tt=$('#arrival_date'+vl).val().replace(/[A-Za-z$-/]/g, "");
	nsnNo = tt.replace(/(\d{2})(\d{2})(\d{4})/, '$1/$2/$3');
	$('#arrival_date'+vl).val(nsnNo);
	var EnteredDate = document.getElementById("arrival_date"+vl).value; 
	var EnteredDate = $("#arrival_date"+vl).val();
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
	/* alert(EntDte); */
	var arrDate = new Date(EntDte);
	var tdyYrR = new Date(tdyYr);
	var endDate = new Date($('#endDate').val());
	var myDate = new Date(year, month - 1, date);
	
var pattern =/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/;
  if (arDt == null || arDt == "" || !pattern.test(arDt)) {
	  alert("check date format dd/mm/yyyy!.");
	  $('#arrival_date'+vl).val('')
	  $('#arrival_date'+vl).focus();
	}	
$.ajax({
		type:'GET',
		url:'  ../../action/chkRmBOokARrDAte.php',
			data:{
			arrival_date:arDt,
			adtDate:adtDate,
			departure_date:depDt
			},
			success:function(data){
				/* alert(data);  */
				if(data==1){
					alert("Arrival date less than audit date!.");
					$('#arrival_date'+vl).val('');
					$('#arrival_date'+vl).focus();
				}
				if(data==2){
					alert("Check the date!.");
					$('#departure_date'+vl).val('');
					$('#departure_date'+vl).focus();
					
				}
								
			}
	});

}

function depDateSel1(vl){
dpDt=$('#departure_date'+vl).val();
arDt=$('#arrival_date'+vl).val();
adtDate=$('#adtDate').val();
tt=$('#departure_date'+vl).val().replace(/[A-Za-z$-/]/g, "");
nsnNo = tt.replace(/(\d{2})(\d{2})(\d{4})/, '$1/$2/$3');
$('#departure_date'+vl).val(nsnNo);
	var startDate = document.getElementById("arrival_date"+vl).value; 
	var dtt = startDate.substring(0, 2);
	var mtt = startDate.substring(3, 5);
	var yrr = startDate.substring(6, 10);
	arrYr=mtt+'/'+dtt+'/'+yrr;
	
	var EnteredDate = document.getElementById("departure_date"+vl).value; 
	var dt = EnteredDate.substring(0, 2);
	var mt = EnteredDate.substring(3, 5);
	var yr = EnteredDate.substring(6, 10);
	depYr=mt+'/'+dt+'/'+yr;
	
	var startDate = new Date(startDate);
	var endDate = new Date(EnteredDate);
var pattern =/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/;
  if (dpDt == null || dpDt == "" || !pattern.test(dpDt)) {
	  alert("check date format dd/mm/yyyy!.");
	  $('#departure_date'+vl).val('')
	  $('#departure_date'+vl).focus();
	}	
	$.ajax({
		type:'GET',
		url:'  ../../action/chkRmBOokDEpDAte.php',
			data:{
			arrival_date:arDt,
			departure_date:dpDt,
			adtDate:adtDate
			},
			success:function(data){
				/* alert(data);  */
				if(data==1){
					alert("Departure date less than audit date!.");
					$('#departure_date'+vl).val('');
					$('#departure_date'+vl).focus();
					ot=data.split(',');
					$('#dys'+vl).val(ot[1]);
				}
				
			}
	});
	
}

function selRoomTypeDuplicate(vl){
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
				 /* alert(data); */ 
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






var rowCountR = 0; 
function addMoreRowsROOM(frm) {
	bk=parseFloat($('#book_rowcount').val());
	
	var rnt = parseFloat($('#addedRowsEDRoom tr').length);
	vl=$('#rowVl').val();
	rmT=$('.rType').val();
	rmTE=$('#room_type'+rnt).val();
	rmTEe=$('#room_type').val();

noRms=parseFloat($('#noof_rms'+rnt).val());
sgle=parseFloat($('#single'+rnt).val());
dbl=parseFloat($('#double'+rnt).val());
tple=parseFloat($('#tripple'+rnt).val());
qud=parseFloat($('#quad'+rnt).val());

tot=(parseFloat(sgle+dbl+tple+qud));

	rmT=$('.romType').val();
	rmTE=$('#room_type'+rnt).val();
	/* alert(frm); */
	
	if(tot>noRms){
		alert("Room count greater than no of rooms!");
	}else if(rmTEe==''){
		alert('Please select Room Type.');	
	}else if(rmTE==''){
		alert('Please select Room Type.');
	}else{
	rowCountR=rowCountR+1; 
	rowTblCo=0;
	var rowTblCo = $('#addedRowsEDRoom tr').length+2;
	
	var recRow = '<tr id="rowCount1'+rowCountR+'"><td style="text-align:center;" id="room'+rowCountR+'"><input name="arrival_date[]" id="arrival_date'+rowCountR+'" type="text" data-validation="required" class="input validate[required] textbox codesUPPERCase arrDt" value="" style="width:88px;margin:5px 0 0 0px" onblur="arrDateSel1('+rowCountR+');" placeholder="dd/mm/yyyy"/></td><td style="text-align:center;"><input  name="arrival_time[]" id="arrival_time" type="text" data-validation="required" class="input validate[required] textbox codesUPPERCase" onblur="checkPropertyCode();" value="<?php echo $curTime;?>" style="width:75px;margin:5px 0 0 0px" /></td><td style="width:100px;text-align:center;" id="room"><input name="departure_date[]" id="departure_date'+rowCountR+'" type="text" data-validation="required" class="input validate[required] textbox codesUPPERCase" style="width:78px;margin:5px 0 0 0px" onblur="depDateSel1('+rowCountR+');" placeholder="dd/mm/yyyy"/></td><td style="text-align:center;"><input name="departure_time[]" id="departure_time" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:75px;margin:5px 0 0 0px" value="<?php echo $curTime;?>"  /></td><td style="text-align:center;"><input name="dys[]" id="dys'+rowCountR+'" type="text" class="textbox fstChUPPRCase" style="width:75px;margin:5px 0 0 0px" value="" readonly /></td><td style="text-align:center;"><select name="room_type[]" id="room_type'+rowCountR+'" style="font-size:12px;width:80px;height:18px;margin:5px 0 0 0px;" onChange="selRoomTypeDuplicate('+rowCountR+');" class="wagRw1 romTypee rmmType"><?php echo strtoupper($btStr); ?></select></td><td style="text-align:center;" class="sourceonVAL"><input name="noof_rms[]" id="noof_rms'+rowCountR+'" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:50px;margin:5px 0 0 0px" /></td><td style="text-align:center;" class="sourceonVAL"><input name="single[]" id="single'+rowCountR+'" type="text" class="textbox fstChUPPRCase" style="width:50px;margin:5px 0 0 0px" value="0" /></td><td style="text-align:center;" class="sourceonVAL"><input name="doubl[]" id="double'+rowCountR+'" type="text" class="textbox fstChUPPRCase" style="width:50px;margin:5px 0 0 0px" value="0" /></td><td style="text-align:center;" class="sourceonVAL"><input name="tripple[]" id="tripple'+rowCountR+'" type="text" class="textbox fstChUPPRCase" style="width:50px;margin:5px 0 0 0px" value="0" /></td><td style="text-align:center;" class="sourceonVAL"><input name="quad[]" id="quad'+rowCountR+'" type="text" class="textbox fstChUPPRCase" value="0" style="width:50px;margin:5px 0 0 0px" /></td><td style="text-align:center;" class="sourceonVAL"><input name="exp[]" id="exp'+rowCountR+'" type="text" value="0" class="textbox fstChUPPRCase" style="width:50px;margin:5px 0 0 0px" /></td><td style="text-align:center;" class="sourceonVAL"><input name="exc[]" value="0" id="exc'+rowCountR+'" type="text" class="textbox fstChUPPRCase" style="width:50px;margin:5px 0 0 0px" /></td><td style="text-align:center;"><a href="javascript:void(0);" onclick="removeRow('+rowCountR+');" name="remove['+rowCountR+']" id="remove_'+ rowCountR +'" class="deleterecord"><img src="../../images/removeicon.png" class="familyEmpMasterHREF" style="width:18px;height:18px;margin:5px 0 0 -2px;"/></a></td></tr>'; 
	
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


	function removeRow(removeNum) {
		jQuery('#rowCount1'+removeNum).remove(); 
	} 
	
	
	
	

/* var rowCount = 0; 
function addMoreRows() {
	paxNo=$('#pax').val();
	rowCount=rowCount+1; 
	rowTblCo=0;
	var rowTblCo = $('#addedRowsED tr').length+2;
	$('#addedRowsED').html('');
	for(i=0;i<paxNo;i++) {
		var recRow = '<tr id="rowCount'+rowCount+'"><td style="text-align:center;" id="room'+rowCount+'" colspan="2"><select style="width:50px;float:left;margin:0 0 0 110px;" name="title[]" id="title" data-validation="required" class="input validate[required] textbox codesUPPERCase"><option value="mr">Mr</option><option value="mrs">Mrs</option><option value="ms">Ms</option><option value="dr">Dr</option></select><input name="guest_name[]" id="guest_name" type="text" data-validation="required" class="input validate[required] textbox codesUPPERCase" style="width:149px;"/><a href="javascript:void(0);" onclick="removeRow('+rowCount+');" name="remove['+rowCount+']" id="remove_'+ rowCount +'" class="deleterecord" width="15"><img src="../../images/removeicon.png" style="width:18px;height:18px;"/></a></td></tr>'; 

		jQuery('#addedRowsED').append(recRow); 
		$('#rowCount').val(rowCount);
	}
}
	function removeRow(removeNum) {
	 jQuery('#rowCount'+removeNum).remove(); 
	}  */


var rowCtRms = 0; 
function addMoreRowsRMS(vl) {
	numR=$('#numR').val();
	/* noR=$('#noof_rms').val(); */
	$('#addedRowsED1').html('');
		rowCtRms=rowCtRms+1; 
		rowTblCo=0;
		$('#addedRowsRM').empty();
		var rowTblCo = $('#addedRowsED1 tr').length+2;
		
	sng=$('#single'+vl).val();
	dbl=$('#double'+vl).val();
	dbl=$('#double'+vl).val();
	tpl=$('#tripple'+vl).val();
	qud=$('#quad'+vl).val();
	exp=$('#exp'+vl).val();
	dubl=parseFloat(dbl*2);
	tpll=parseFloat(tpl*3);
	qudl=parseFloat(qud*4);
	noR=parseFloat(sng)+parseFloat(dubl)+parseFloat(tpll)+parseFloat(qudl)+parseFloat(exp);
	
	noRR=noR-numR;
	 /* alert(noRR); */ 
	if(noR>numR){
	$('#addedRowsRM').show();
	$('#rwCnt').hide();
	for(i=0;i<noRR;i++){
		
		var recRow1 = '<tr id="rowCtRms'+rowCtRms+'"><td style="text-align:center;" id="room'+rowCtRms+'"><select style="width:93px;margin:5px 0 0 0px;" name="title[]" id="title'+rowCtRms+'" class="textbox codesUPPERCase"><option value="">--Select--</option><option value="mr" selected >Mr</option><option value="mrs">Mrs</option><option value="ms">Ms</option><option value="dr">Dr</option></select></td><td style="text-align:center;"><input name="gust_name[]" id="guest_name'+rowCtRms+'" type="text" class="textbox codesUPPERCase" onblur="checkPropertyCode();" value="" style="width:264px;margin:5px 0 0 0px" /></td><td style="width:100px;text-align:center;" id="room'+rowCtRms+'"><input name="lst_name[]" id="last_name'+rowCtRms+'" type="text" class="textbox fstChUPPRCase" style="width:250px;margin:5px 0 0 0px" /></td><td style="text-align:center;"><input name="arval_by[]" id="arrival_by'+rowCtRms+'" type="text" class="textbox fstChUPPRCase" style="width:150px;margin:5px 0 0 0px" /></td><td style="text-align:center;" class="sourceonVAL"><select name="mel_plan[]" id="meal_plan'+rowCtRms+'" style="font-size:12px;width:97px;height:18px;margin:5px 0 0 0px;" class=" romType" onchange="selMealPlan();"><?php echo strtoupper($btStrP); ?></select></td><td style="text-align:center;" class="sourceonVAL"><select name="natnality[]" id="nationality'+rowCtRms+'" style="font-size:12px;width:155px;height:18px;margin:5px 0 0 0px;" onChange="addMoreRows1();" class=" romType"><?php echo strtoupper($btStrN); ?></select></td></tr>';
		/* alert(recRow1); */
		jQuery('#addedRowsRM').append(recRow1); 
		$('#rowCtRms').val(rowCtRms);
		
	}
		}else{
			$('#addedRowsRM').hide();
			$('#rwCnt').show();
		}
		
}




function removeRow1(removeNum) {
	jQuery('#rowCount1'+removeNum).remove(); 
} 	
function removeRow2(removeNum) {
	jQuery('#rowCount2'+removeNum).remove(); 
} 


function selRateCode() {
	rateCode=$('#rate_code').val();
	rmbkId=$('#resvNo').val();
	var menuStr="";
	$('.rmmType').each(function(i,v){
		menuStr +=$(this).val()+',';
	});
	menuStr = menuStr.slice(0,-1);
	$("#rmomType").val(menuStr);
	rmTe=$("#rmomType").val();
		var rnt = $('#addedRowsEDRoom tr').length;
		romTpe=$('#room_type'+rnt).val();
		$.ajax({
		type:'GET',
		url:'  ../../action/checkselRateDETforReserv-EDIT.php',
			data:{
			rateCode:rateCode,
			rmTe:rmTe,
			rmbkId:rmbkId,
			romTpe:romTpe
			},
			success:function(data){
				  /* alert(data); */   
				if(data==1){
					alert("Select room type.");
				}				 
				opt=data.split(',');
				$('.rmSgle').hide();
				$('#rtCode').html(opt[0]);
				$('#rate_desc').val(opt[1]);
			}
		});	
}


function selRateCodeConfirm(){
	rateCode=$('#rate_code').val();
	rmbkId=$('#resvNo').val();
	var menuStr="";
	$('.rmmType').each(function(i,v){
		menuStr +=$(this).val()+',';
	});
	menuStr = menuStr.slice(0,-1);
	$("#rmomType").val(menuStr);
	rmTe=$("#rmomType").val();
		var rnt = $('#addedRowsEDRoom tr').length;
		romTpe=$('#room_type'+rnt).val();
		$.ajax({
		type:'GET',
		url:'  ../../action/checkselRateDETforReserv-EDIT.php',
			data:{
			rateCode:rateCode,
			rmTe:rmTe,
			rmbkId:rmbkId,
			romTpe:romTpe
			},
			success:function(data){
				 /* alert(data); */   
				if(data==0){
					alert("Select room type.");rtCode
				}				 
				opt=data.split(',');
				$('.rmSgle').hide();
				$('#rtCode').html(opt[0]);
				$('#rate_desc').val(opt[1]);
			}
		});	
}

function selRoomNo() {
	room_no=$('#room_no').val();
	$.ajax({
		type:'GET',
		url:'  ../../action/selRoomtypeforGUest.php',
			data:{
			room_no:room_no
			},
			success:function(data){
				/* alert(data); */
				if(data==2){
					alert('Room Dirty!.');
					$('#room_no').val('');
					$('#room_type').val('');
					$('#room_no').focus();
				}else if(data==3){
					alert('Room Occupied!.');
					$('#room_no').val('');
					$('#room_type').val('');
					$('#room_no').focus();
					
				}else{
					$('#room_type').val(data);
				}
			}
	});	
}	
/* function visaDetails(){
	var rowTb = $('#addedRowsED1 tr').length+1;
	alert(rowTb);
	nati=$('#nationality').val();
	if(nati=='india'){
		$('#add-item1').hide();	
	}else{
		$('#add-item1').show();
	}
} */
function selCompanyName(){
	comp=$('#company_name').val();
	$.ajax({
		type:'GET',
		url:'  ../../action/selCompanyNameForCHkIN.php',
			data:{
			comp:comp
			},
			success:function(data){
				/*  alert(data);  */
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

function removeROwDel(val){
	r=confirm("Do you want to delete?");
	if(r==true){
		document.location.href="<?php echo $home_path;?>/action/del_room_booking.php?del="+val;
	}else{
				
	}
}

function selectRFQ(val) {
$("#company_name").val(val);
$("#suggesstion-box").hide();
}


function rooMcancel_ed() {
	rmK=$('#roombook_id').val();
	canRe=$('#can_reason').val();
	conSt=$('#con_status').val('Cancelled');
	if(canRe==""){
		alert('Enter reason .');
	}else{
		document.location.href="<?php echo $home_path;?>/action/cancel-room-booking.php?romK="+rmK;
	}
}

function selMealPlan(){
	room_no=$('#room_no').val();
	rateCode=$('#rate_code').val();
	roomType=$('#room_type').val();
	mePln=$('#meal_plan').val();
	$.ajax({
		type:'GET',
		url:'  ../../action/selecMealPlanSELET.php',
			data:{
			mePln:mePln,
			room_no:room_no,
			rateCode:rateCode,
			roomType:roomType
			},
			success:function(data){
			/*  alert(data);  */
				opt=data.split(',');
				
				
				$('.melSng').val(opt[0]);
				$('.melDbl').val(opt[1]);
				$('.melTpl').val(opt[2]);
				$('.melQtr').val(opt[3]);
				$('.melExp').val(opt[4]);
				$('.melChd').val(opt[5]);
				
				
				
			}
	});	
	
}



function removeRowPX(vl) {
	roomBk=$('#rmbook_id'+vl).val();
	numR=$('#numR').val();
	resNo=$('#resv_no').val();
	r=confirm("Do you want to delete the record?.");
	if(r==true){
		$.ajax({
			type:'GET',
			url:'  ../../action/selROOMBookingPAXRemove.php',
				data:{
				roomBk:roomBk,
				numR:numR,
				resNo:resNo,
				vl:vl
				},
				success:function(data){
					/*  alert(data); */
					if(data==1){
						alert('Min Pax!.');
					}else{
						document.location.href="<?php echo $home_path;?>/transaction/frontdesk/edit_room_booking.php?roomBk="+resNo+"&rmBkID="+roomBk;
						/* $('#paxRem').hide();
						$('#paxInsert').html(data); */
					}
					
					
				}
		});
	}else{
		
	}
	
	
	 /* jQuery('#rowCount'+vl).remove(); */ 
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
</style>
<body class="bgBODY">
<div class="about">
<div id="invoice" style="">
	<!--<div class="container" >-->
		<div class="" >
<?php 	
if(isset($_GET['msg'])){
?>
	<p style="text-align:center;">
		<label id="msgFo" class="msgNotify"><?php echo $_GET['msg']; ?></label>
	</p>
<?php } ?>
<p style="text-align:center;margin:-16px 0 0 0;">
		<span id="msgFoprop" class="msgNotifyprop"></span>
</p>
<?php
$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$curDate=$rowAC['cur_date'];

 $sqlTEmp=mysql_query("select * from room_booking where resv_no='".$_GET['roomBk']."' AND resv_status!='4' AND resv_status!='5'");
 $nmrows=mysql_num_rows($sqlTEmp);
 $rowT=mysql_fetch_array($sqlTEmp);
?>
<div id="addcustomer" class="frmCentr divBrd frmBgClr" style="width:1039px;">
	<h3 id="Userhd"><b>RESERVATIONS/COPY</b></h3>
	<form id="hotelDefi" name="hotelDefi" enctype="multipart/form-data" action="<?php echo $home_path;?>/action/add_room_booking.php" method="post" class="" style="">
	<input name="incLc" id="incLc" type="hidden" style="" value=""/>
	
	<input type="hidden" name="book_rowcount" id="book_rowcount" class="textbox" value="<?php echo  $nmrows; ?>" readonly />
	<input type="hidden" name="roombook_id" id="roombook_id" class="textbox" value="<?php echo  $_GET['rmBkID']; ?>" readonly />
	<input type="hidden" name="resvNo" id="resvNo" class="textbox" value="<?php echo  $_GET['roomBk']; ?>" readonly />
	<input type="hidden" name="rmomType" id="rmomType"/>
	<input type="hidden" name="rowVl" id="rowVl"/>
	<input type="hidden" name="adtDate" id="adtDate" value="<?php echo $curDate?>"/>
	<input type="hidden" name="rowcount" id="rowcount" value="<?php echo $rowT['rowcount']; ?>"/>
		<div>
			<!--<table style="float:left;width:50%;border-right:1px solid #ddd;margin:10px 0 10px 0px;" cellpadding="0" cellspacing="0" class="table" border="0" >
			<tbody>
				<tr>
					<td width="" valign="top"><label>Resv #<em>*</em></label></td>
					<td valign="top" style="width:268px;"><input type="text" name="resv_no" id="resv_no" data-validation="required" class="input validate[required]  textbox" style="margin:0 0 0 0;width:210px;" value="<?php /* echo $rowQR['resv_no']; */ ?>" readonly />
					</td>
				</tr>
			</tbody>
			</table>-->
			<table style="width:100%;margin:10px 0 10px 0px;" class="table">
					<tbody>
					<input type="hidden" name="resv_no" id="resv_no" data-validation="required" class="input validate[required]  textbox" style="margin:0 0 0 0;width:210px;" value="<?php echo $rowQR['resv_no']; ?>" readonly />
					<tr>
						<td width="" valign="top"><label>Group<em>*</em></label></td>
						<td valign="top" style="float:left;"><input name="group_name" id="group_name" type="text" class="textbox fstChUPPRCase" style="margin:0 0 0 0;width:210px;" value="<?php echo $rowQR['group_name']; ?>" /></td>
						
					<td width="" valign="top"><label>Booking Date</label></td>
					<td valign="top" style="float:left;"><input name="booking_date" id="booking_date" type="text" class="textbox fstChUPPRCase" style="margin:0 0 0 0;width:210px;" value="<?php if(isset($rowQR['booking_date'])) { echo $rowQR['booking_date']; } ?>" readonly /></td>
					
					<td width="" valign="top"><label>Booker ID</label></td>
					<td valign="top" style="float:left;"><input name="booking_id" id="booking_id" type="text" class="textbox fstChUPPRCase" style="margin:0 0 0 0;width:210px;" value="<?php if(isset($rowQR['booking_id'])) { echo $rowQR['booking_id']; } ?>" readonly /></td>
					
					
					</tr>
					
				</tbody>
			</table>
			
<table class="table" cellpadding="0" cellspacing="0" border="0" class="table" style="text-align:center;font-size:12px;margin:0px 0 10px 0px;">
	<tr>
		<th width="" style="text-align:center;background-color:#F5F5F5;">Arr Date</th>
		<th width="" style="text-align:center;background-color:#F5F5F5;">Arr Time</th>
		<th width="" style="text-align:center;background-color:#F5F5F5;">Dep Date</th>
		<th width="" style="text-align:center;background-color:#F5F5F5;">Dep Time</th>
		<th width="" style="text-align:center;background-color:#F5F5F5;">No of days</th>
		<th width="" style="text-align:center;background-color:#F5F5F5;">Room type</th>
		<th width="" style="text-align:center;background-color:#F5F5F5;">Rms</th>
		<th width="" style="text-align:center;background-color:#F5F5F5;">Sgle</th>
		<th width="" style="text-align:center;background-color:#F5F5F5;">Dbl</th>
		<th width="" style="text-align:center;background-color:#F5F5F5;">Trpl</th>
		<th width="" style="text-align:center;background-color:#F5F5F5;">Quad</th>
		<th width="" style="text-align:center;background-color:#F5F5F5;">Exp</th>
		<th width="" style="text-align:center;background-color:#F5F5F5;">Exc</th>
		<!--<th style="text-align:center;"><img src="../../images/plus.png" id="add-item" onclick="addMoreRowsROOM(this.form);" style="width:15px;height:15px;cursor:pointer;"/></th>-->
	</tr>
<?php 
$roomBk=$_GET['roomBk'];

$sqlQ=mysql_query("select * from room_booking where resv_no='".$_GET['roomBk']."' AND resv_status!='4' AND resv_status!='5' group by room_type");
$nmRs=mysql_num_rows($sqlQ);

$x=0;
while($rowQ=mysql_fetch_array($sqlQ)){
	$x++;
	
	$sqlR=mysql_query("select sum(noof_rms)as NoRms,sum(single)as rmSng,sum(doubl)as rmDbl,sum(tripple)as rmTpl,sum(quad)as rmQd,sum(exp)as rmExp,sum(exc)as rmEch,room_type from room_booking where resv_no='".$_GET['roomBk']."' AND room_type='".$rowQ['room_type']."' AND resv_status!='4' AND resv_status!='5' group by room_type");
	$rowR=mysql_fetch_array($sqlR);
	
	$noRms=$rowR['NoRms'];
	/* echo $noRms; */
	/* $rmSng=$rowR['rmSng'];
	$rmDbl=$rowR['rmDbl'];
	$rmTpl=$rowR['rmTpl'];
	$rmQd=$rowR['rmQd'];
	$rmExp=$rowR['rmExp'];
	$rmEch=$rowR['rmEch']; */
	
?>

<input  name="arriDate" id="arriDate" type="hidden" value="<?php echo $rowQ['arrival_date']; ?>" />
<input  name="arriTime" id="arriTime" type="hidden"  value="<?php echo $rowQ['arrival_time']; ?>" />
<input  name="depraDate" id="depraDate" type="hidden" value="<?php echo $rowQ['departure_date']; ?>" />
<input  name="depraTime" id="depraTime" type="hidden" value="<?php echo $rowQ['departure_time']; ?>" />
<?php

$arr=explode('/',$rowQ['arrival_date']);
$dep=explode('/',$rowQ['departure_date']);

$fromDtDte=$arr[2].'-'.$arr[1].'-'.$arr[0];
$todayDte=$dep[2].'-'.$dep[1].'-'.$dep[0];

$arDate = strtotime($fromDtDte);
$deptDte = strtotime($todayDte);

$datediff = $deptDte - $arDate;
$datediffF=round(abs(($datediff/(60*60*24))));

?>

<tr id="rowCountR'+rowCountR+'"><td style="text-align:center;" id="room'+rowCountR+'"><input  name="arrival_date[]" id="arrival_date" type="text" data-validation="required" class="input validate[required] textbox codesUPPERCase arrDt" value="<?php echo $rowQ['arrival_date']; ?>" style="width:88px;margin:5px 0 0 0px" onblur="arrDateSel();" placeholder="dd/mm/yyyy"/></td><td style="text-align:center;" ><input  name="arrival_time[]" id="arrival_time" type="text" data-validation="required" class="input validate[required] textbox codesUPPERCase " onblur="checkPropertyCode();" value="<?php echo $rowQ['arrival_time']; ?>" style="width:75px;margin:5px 0 0 0px" /></td><td style="width:100px;text-align:center;" id="room"><input name="departure_date[]" id="departure_date" type="text" data-validation="required" class="input validate[required] textbox codesUPPERCase depaDate" style="width:78px;margin:5px 0 0 0px" onblur="depDateSel(<?php echo $x; ?>);" value="<?php echo $rowQ['departure_date']; ?>" placeholder="dd/mm/yyyy" /></td><td style="text-align:center;"><input name="departure_time[]" id="departure_time" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" value="<?php echo $rowQ['departure_time']; ?>" style="width:75px;margin:5px 0 0 0px" /></td><td style="text-align:center;"><input name="dys[]" id="dys<?php echo $x; ?>" type="text" class=" textbox fstChUPPRCase" style="width:75px;margin:5px 0 0 0px" value="<?php echo $datediffF;?>" readonly /></td><td style="text-align:center;">

<select name="room_type[]" id="room_type" style="font-size:12px;width:80px;height:18px;margin:5px 0 0 0px;" onChange="selTaxCode();" class="wagRw1 romType"><option value="">---select--</option>;
<?php $result = mysql_query("select distinct room_type from room_master") ;
$tmpStr=""; $btStr=""; $i=0; 
while($row = mysql_fetch_array( $result )) { ?>
<?php if(($row['room_type'])==($rowQ['room_type'])) { ?>
<option value=<?php echo $row['room_type']; ?> selected ><?php echo $row['room_type']; ?> </option>
<?php 
} else { ?>
<option value=<?php echo $row['room_type']; ?> ><?php echo $row['room_type']; ?> </option>
<?php } } ?>	
</select></td><td style="text-align:center;" class="sourceonVAL"><input name="noof_rms[]" id="noof_rms" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:50px;margin:5px 0 0 0px" value="<?php echo $noRms; ?>"  /></td><td style="text-align:center;" class="sourceonVAL"><input name="single[]" id="single<?php echo $x; ?>" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:50px;margin:5px 0 0 0px" value="<?php echo $rowQ['single']; ?>" onkeyup="addMoreRowsRMS(<?php echo $x; ?>);" /></td><td style="text-align:center;" class="sourceonVAL"><input name="doubl[]" id="double<?php echo $x; ?>" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:50px;margin:5px 0 0 0px" value="<?php echo $rowQ['doubl']; ?>" onkeyup="addMoreRowsRMS(<?php echo $x; ?>);" /></td><td style="text-align:center;" class="sourceonVAL"><input name="tripple[]" id="tripple<?php echo $x; ?>" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:50px;margin:5px 0 0 0px" value="<?php echo $rowQ['tripple']; ?>" onkeyup="addMoreRowsRMS(<?php echo $x; ?>);"/></td><td style="text-align:center;" class="sourceonVAL"><input name="quad[]" id="quad<?php echo $x; ?>" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:50px;margin:5px 0 0 0px" value="<?php echo $rowQ['quad']; ?>" onkeyup="addMoreRowsRMS(<?php echo $x; ?>);"/></td><td style="text-align:center;" class="sourceonVAL"><input name="exp[]" id="exp<?php echo $x; ?>" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:50px;margin:5px 0 0 0px" value="<?php echo $rowQ['exp']; ?>" onkeyup="addMoreRowsRMS(<?php echo $x; ?>);" /></td><td style="text-align:center;" class="sourceonVAL"><input name="exc[]" id="exc<?php echo $x; ?>" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:50px;margin:5px 0 0 0px" value="<?php echo $rowQ['exc']; ?>" onkeyup="addMoreRowsRMS(<?php echo $x; ?>);" /></td>
<?php if($nmRs>1) { ?>
<td><img src="../../images/removeicon.png" class="familyEmpMasterHREF" style="width:18px;height:18px;margin:5px 0 0 6px;cursor:pointer;" onclick="removeROwDel(<?php echo $rowQ['roombook_id']; ?>);" title="Delete"/></td>
<?php } ?>
<td><input type="hidden" name="roombook_id[]" id="roombook_id" class="textbox" style="margin:0 0 0 0;width:210px;cursor:pointer;" value="<?php echo $rowQ['roombook_id']; ?>" readonly /></td></tr>	
<?php } ?>

	
</table>
<table style="float:left;width:80%;border-right:1px solid #ddd;margin:4px 0 0 0;font-size:12px;" cellpadding="0" cellspacing="0" class="table" border="0" >
	<thead class="tathead">
	<tr>
		<th style="text-align:center;background-color:#F5F5F5;width:100px;">Title</th>
		<th style="text-align:center;background-color:#F5F5F5;width:250px;">Name</th>
		<th style="text-align:center;background-color:#F5F5F5;width:250px;">&nbsp;&nbsp;Last Name</th>
		<th style="text-align:center;background-color:#F5F5F5;width:150px;">Arrival By</th>
		<th style="text-align:center;background-color:#F5F5F5;width:100px;">Plan</th>
		<th style="text-align:center;background-color:#F5F5F5;width:150px;">Nationality</th>
		<!--<th width="" style="text-align:center;background-color:#F5F5F5;">Guest Type</th>
		<th style="text-align:center;"><img src="../../images/plus.png" id="add-item" onclick="addMoreRowsROOM(this.form);" style="width:15px;height:15px;cursor:pointer;"/></th>-->
	</tr>
		</thead>
<?php		
 $sqRm=mysql_query("select * from room_booking where resv_no='".$_GET['roomBk']."' AND resv_status='1'");
 $nmr=mysql_num_rows($sqRm);
 $rs=mysql_num_rows($sqRm);
 ?>	
<?php if($nmr>=5){?> 
		<tbody class="tathead tatbody tableS" id="displyRoomDET" style="width:1034px;height:100px;">
<?php } else { ?>
		<tbody class="tathead tatbody tableS" id="displyRoomDET" style="width:1034px;">
<?php } ?>
<?php
 $j=0;
 while($rwR=mysql_fetch_array($sqRm)){
	  $j++;
 ?>
	<tr id="rowCountR'+rowCountR+'">
	<td style="text-align:center;" id="room'+rowCountR+'">
	
	<input name="rmbook_id[]" id="rmbook_id<?php echo $j; ?>" type="hidden" class="textbox fstChUPPRCase" style="width:210px" value="<?php echo $rwR['roombook_id']; ?>"/>
	<input name="numR" id="numR" type="hidden" class="textbox fstChUPPRCase" style="width:210px" value="<?php echo $rs; ?>"/>
	
	<select style="width:93px;margin:5px 0 0 0px;" name="title[]" id="title<?php echo $j; ?>" data-validation="required" class="input validate[required] textbox codesUPPERCase"><option value="">--Select--</option><option value="mr"<?php echo ($rwR['title']=='mr')?'selected':''; ?>>Mr</option><option value="mrs"<?php echo ($rwR['title']=='mrs')?'selected':'';?>>Mrs</option><option value="ms"<?php echo ($rwR['title']=='ms')?'selected':'';?>>Ms</option><option value="dr"<?php echo ($rwR['title']=='dr')?'selected':'';?>>Dr</option></select>
	</td>
	<td style="text-align:center;"><input  name="gust_name[]" id="guest_name<?php echo $j; ?>" type="text" data-validation="required" class="input validate[required] textbox codesUPPERCase" onblur="checkPropertyCode();" value="<?php echo $rwR['guest_name']; ?>" style="width:264px;margin:5px 0 0 0px" /></td><td style="width:100px;text-align:center;" id="room"><input name="lst_name[]" id="last_name<?php echo $j; ?>" type="text" class="textbox fstChUPPRCase" style="width:250px;margin:5px 0 0 0px" value="<?php echo $rwR['last_name']; ?>" /></td><td style="text-align:center;"><input name="arval_by[]" id="arrival_by<?php echo $j; ?>" type="text" class="textbox fstChUPPRCase" style="width:150px;margin:5px 0 0 0px" value="<?php echo $rwR['arrival_by']; ?>" /></td><td style="text-align:center;" class="sourceonVAL"><select name="mel_plan[]" id="meal_plan<?php echo $j; ?>" style="font-size:12px;width:97px;height:18px;margin:5px 0 0 0px;" onchange="selMealPlan();" class="wagRw1 romType"><?php echo strtoupper($btStrP); ?></select></td><td style="text-align:center;" class="sourceonVAL"><select name="natnality[]" id="nationality<?php echo $j; ?>" style="font-size:12px;width:138px;height:18px;margin:5px 0 0 0px;" onChange="addMoreRows1();" class="wagRw1 romType"><?php echo strtoupper($btStrN); ?></select></td><td><a href="javascript:void(0);" onclick="removeRowPX(<?php echo $j; ?>);" name="remove['+rowCount+']" id="remove_'+ rowCount +'" class="deleterecord" width="15"><img src="../../images/removeicon.png" style="width:18px;height:18px;margin:5px 0 0 0;"/></a></td></tr>	
<?php } ?>
</tbody>
<tbody class="tathead tatbody tableS" id="addedRowsRM" style="height:50px;display:none;" >

</tbody>
</table>
	<table style="float:left;width:32%;border-right:1px solid #ddd;margin:8px 0 0 0;" cellpadding="0" cellspacing="0" class="table" border="0" >
					<tbody id="addedRowsED1">

					</tbody>
					<tr>
					<td width="" valign="top"><label>Address 1 <em>*</em></label></td>
					<td valign="top"><input name="address1" id="address1" type="text" class="textbox fstChUPPRCase" style="width:210px" value="<?php echo $rowQR['address1']; ?>"/></td>
					</tr>
					<tr>
					<td width="" valign="top"><label>Address 2 <em>*</em></label></td>
					<td valign="top"><input name="address2" id="address2" type="text" class="textbox fstChUPPRCase" style="width:210px" value="<?php echo $rowQR['address2']; ?>"/></td>
					</tr>
					<tr>
						<td width="" valign="top"><label>City <em>*</em></label></td>
						<td width="" valign="top"><input name="city" id="city" type="text" class="textbox fstChUPPRCase" style="width:87px" value="<?php echo $rowQR['city']; ?>"/><span class="spanClr">Zip</span>
						<input name="pin_code" id="pin_code" type="text" class="textbox fstChUPPRCase" style="width:80px;margin:0 0 0 11px;" value="<?php echo $rowQR['pin_code']; ?>" /></td>
						
					</tr>
					<tr>
						<td width="" valign="top"><label>Country <em>*</em></label></td>
						<td width="" valign="top"><input name="country" id="country" type="text" class="textbox fstChUPPRCase" style="width:87px" value="<?php echo $rowQR['country']; ?>" /><span class="spanClr">State</span>
						<input name="state" id="state" type="text" class="textbox fstChUPPRCase" style="width:80px;" value="<?php echo $rowQR['state']; ?>" /></td>
						
					</tr>
					<tr>
					<td width="" valign="top"><label>Phone <em>*</em></label></td>
					<td valign="top"><input name="phone" id="phone" type="text" class="textbox fstChUPPRCase" style="width:210px" value="<?php echo $rowQR['phone']; ?>"/></td>
					</tr>
					<tr>
					<td width="" valign="top"><label>E-mail <em>*</em></label></td>
					<td valign="top"><input name="email" id="email" type="text" class="textbox" style="width:210px" value="<?php echo $rowQR['email']; ?>"/></td>
					</tr>
					
					<tr>
					<td width="" valign="top"><label>Status</label></td>
					<td valign="top">
						<select name="con_status" id="con_status" class="fstChUPPRCase" style="width:210px;" >
						<option value="">--Select--</option>
						<option value="Confirm"<?php echo ($rowQR['con_status']=='Confirm')?'selected':'';?> >Confirm</option>
						<option value="Waitlist"<?php echo ($rowQR['con_status']=='Waitlist')?'selected':'';?>>Waitlist</option>
						<option value="Tentative"<?php echo ($rowQR['con_status']=='Tentative')?'selected':'';?>>Tentative</option>
						<option value="Cancelled"<?php echo ($rowQR['con_status']=='Cancelled')?'selected':'';?>>Cancelled</option>
						<option value="Noshow"<?php echo ($rowQR['con_status']=='Noshow')?'selected':'';?>>Noshow</option>
						</select>
					</td>
					</tr>
					<tr>
					<td width="" valign="top"><label>Reason <em>*</em></label></td>
					<td valign="top"><input name="can_reason" id="can_reason" type="text" class="textbox" style="width:210px" value="<?php echo $rowQR['can_reason']; ?>" /></td>
					</tr>
					<tr>
						<td width="" valign="top"><label>Booker Name</label></td>
						<td valign="top"><input name="booker_name" id="booker_name" type="text" class="textbox" style="width:210px"value="<?php echo $rowQR['booker_name']; ?>" /></td>
					</tr>
					<tr>
						<td width="" valign="top"><label>Booker No</label></td>
						<td valign="top"><input name="booker_no" id="booker_no" type="text" class="textbox" style="width:210px" value="<?php echo $rowQR['booker_no']; ?>" /></td>
					</tr>

					<tr>
						<td width="" valign="top"><label>Voucher No</label></td>
						<td valign="top"><input name="voucher_num" id="voucher_num" type="text" class="textbox" style="width:210px" value="<?php echo $rowQR['voucher_num']; ?>"/></td>
					</tr>
						
						
					</tbody>
				</table>
				<table style="float:left;width:30%;border-right:1px solid #ddd;margin:8px 0 0 0;" cellpadding="0" cellspacing="0" class="table" border="0" >
					<tr>
						<td width="" valign="top"><label>Company</label></td>
						<td valign="top">
						<input name="company_name" id="company_name" type="text" class="textbox fstChUPPRCase" value="<?php echo $rowQR['company_name'];?>" style="width:210px" />
						<div id="suggesstion-box"  onClick="selCompanyName();"></div>
						
						<?php /* $sqlBS=mysql_query("select distinct comp_code,comp_name from company_master where status='1'"); */?>
							<!--<select name="company" id="company" class="fstChUPPRCase" style="width:79px;float:left;" onChange="selCompanyName();">
							<option value="">--Select--</option>
							<?php /* while($rowBS=mysql_fetch_array($sqlBS)) { */ ?>
							<?php 
							/* if($rowBS['comp_code']==$rowQR['company']){ */
							?>
							<option value="<?php echo $rowBS['comp_code'];?>" selected ><?php echo $rowBS['comp_code'];?></option>
							<?php /* } else { */ ?>
							<option value="<?php echo $rowBS['comp_code'];?>"><?php echo $rowBS['comp_code'];?></option>
							<?php /* } } */ ?>
							</select>-->
					<input name="company" id="company" type="hidden" class="textbox fstChUPPRCase" style="width:120px;margin:0 0 0 11px;" value="<?php echo $rowQR['company_name']; ?>" readonly /></td>
					</tr>
					<tr>
					<td width="" valign="top"><label>Address 1 </label></td>
					<td valign="top"><input name="comaddress1" id="comaddress1" type="text" class="textbox fstChUPPRCase" style="width:210px" value="<?php echo $rowQR['comaddress1']; ?>"/></td>
					</tr>
					<tr>
					<td width="" valign="top"><label>Address 2 </label></td>
					<td valign="top"><input name="comaddress2" id="comaddress2" type="text" class="textbox fstChUPPRCase" style="width:210px" value="<?php echo $rowQR['comaddress2']; ?>"/></td>
					</tr>
					<tr>
						<td width="" valign="top"><label>City </label></td>
						<td width="" valign="top"><input name="comcity" id="comcity" type="text" class="textbox fstChUPPRCase" style="width:87px" value="<?php echo $rowQR['comcity']; ?>"/><span class="spanClr">Zip</span>
						<input name="compincode" id="compincode" type="text" class="textbox fstChUPPRCase" style="width:80px;margin:0 0 0 11px;" value="<?php echo $rowQR['compincode']; ?>" /></td>
					</tr>
					<tr>
						<td width="" valign="top"><label>State </label></td>
						<td width="" valign="top"><input name="comstate" id="comstate" type="text" class="textbox fstChUPPRCase" style="width:87px" value="<?php echo $rowQR['comstate']; ?>"/><span class="spanClr">Country</span>
						<input name="comcountry" id="comcountry" type="text" class="textbox fstChUPPRCase" style="width:75px;margin:0 0 0 -8px;" value="<?php echo $rowQR['comcountry']; ?>" /></td>
					</tr>
					<tr>
					<td width="" valign="top"><label>Phone </label></td>
					<td valign="top"><input name="comphone" id="comphone" type="text" class="textbox fstChUPPRCase" style="width:210px;" value="<?php echo $rowQR['comphone']; ?>"/></td>
					</tr>
					<tr>
					<td width="" valign="top"><label>E-mail <em>*</em></label></td>
					<td valign="top"><input name="comemail" id="comemail" type="text" class="textbox" style="width:210px" value="<?php echo $rowQR['comemail']; ?>" /></td>
					</tr>
					<tr>
							<td width="" valign="top"><label>Spl Instruictions</label></td>
							<td valign="top"><input name="spl_instruc" id="spl_instruc" type="text" class="textbox" style="width:210px" value="<?php echo $rowQR['spl_instruc']; ?>"/></td>
						</tr>
							<tr>
							<td width="" valign="top"><label>Identy No.</label></td>
							<td valign="top"><input name="guest_ident" id="guest_ident" type="text" class="textbox" style="width:210px" value="<?php echo $rowQR['guest_ident']; ?>" /></td>
						</tr>	
							
						<tr>
							<td width="" valign="top"><label>Pickup details</label></td>
							<td valign="top"><input name="pick_detail" id="pick_detail" type="text" class="textbox" style="width:210px" value="<?php echo $rowQR['pick_detail']; ?>" /></td>
						</tr>	
						
					</tbody>
				</table>
			<?php 
			$sqlcu=mysql_query("select currency_code from currency where base_currency='1'");
			$rowcu=mysql_fetch_array($sqlcu);
			$curCode=$rowcu['currency_code'];
			
			$sqlPr=mysql_query("select * from property_definition");
			$rowPr=mysql_fetch_array($sqlPr);
			
			
			?>
			
		<table style="width:33%;float:left;margin:8px 0 0 31px;" class="table">
					<tbody>
					<tr>
					<td width="" valign="top"><label>Guest Type <em>*</em></label></td>
					<td valign="top">
					<select name="guest_type" id="guest_type" data-validation="required" class="textbox input validate[required] fstChUPPRCase" style="width:210px">
					<option value="">--Select--</option>
					<option value="normal" <?php echo ($rowQR['guest_type']=='normal')?'selected':'';?> >Normal Guest</option>
					<option value="house"<?php echo ($rowQR['guest_type']=='house')?'selected':'';?>>House Guest</option>
					<option value="complimentry"<?php echo ($rowQR['guest_type']=='complimentry')?'selected':'';?>>Complimentry Guest</option>
					<option value="diplomat"<?php echo ($rowQR['guest_type']=='diplomat')?'selected':'';?>>Diplomat Guest</option>
					</select>
					</td>
					</tr>
						<tr>
							<td width="" valign="top"><label>Type of billing <em>*</em></label></td>
							<td valign="top">
							<?php 
							$sqlTB=mysql_query("select distinct tob_code,tob_desc from type_ofbilling");?>
							<select name="top_code" id="top_code" data-validation="required" class="textbox input validate[required] fstChUPPRCase" style="width:210px">
							<option value="">--Select--</option>
							<?php while($rowTB=mysql_fetch_array($sqlTB)) { ?>
							<?php if($rowQR['top_code']==$rowTB['tob_code']) { ?>
								<option value="<?php echo $rowTB['tob_code'];?>" selected ><?php echo $rowTB['tob_desc'];?></option>
							<?php }else{ ?>
								<option value="<?php echo $rowTB['tob_code'];?>"><?php echo $rowTB['tob_desc'];?></option>
							<?php } } ?>
							</select>
							</td>
						</tr>
						<tr>
							<td width="" valign="top"><label>Business Source <em>*</em></label></td>
							<td valign="top">
							<?php $sqlBS=mysql_query("select distinct source_code,source_desc from business_source");?>
							<select name="business_src" id="business_src" data-validation="required" class="textbox input validate[required] fstChUPPRCase" style="width:210px">
							<option value="">--Select--</option>
							<?php while($rowBS=mysql_fetch_array($sqlBS)) { ?>
							<?php if($rowQR['business_src']==$rowBS['source_code']) { ?>
							<option value="<?php echo $rowBS['source_code'];?>" selected ><?php echo $rowBS['source_desc'];?></option>
							<?php }else{?>
							<option value="<?php echo $rowBS['source_code'];?>"><?php echo $rowBS['source_desc'];?></option>
							<?php } }?>
							</select>
							</td>
						</tr>
						<tr>
				<?php
				/* echo $rowQR['segment_code'];
				die(); */
				?>
					<td width="" valign="top"><label>Market Segment<em>*</em></label></td>
					<td valign="top">
					<?php $sqlBS=mysql_query("select distinct segment_code,segment_desc from market_segment");?>
					<select name="segment_code" id="segment_code" data-validation="required" class="input validate[required] fstChUPPRCase textbox" style="width:210px">
					<option value="">--Select--</option>
					<?php while($rowBS=mysql_fetch_array($sqlBS)) { ?>
					<?php if($rowQR['segment_code']==$rowBS['segment_code']) { ?>
					<option value="<?php echo $rowBS['segment_code'];?>" selected ><?php echo $rowBS['segment_desc'];?></option>
					<?php } else { ?>
					<option value="<?php echo $rowBS['segment_code'];?>"><?php echo $rowBS['segment_desc'];?></option>
					<?php } } ?>
					</select>
					</td>
				</tr>
				
						<tr>
							<td width="" valign="top"><label>Purpose of visit<em>*</em></label></td>
							<td valign="top">
							<?php $sqlPV=mysql_query("select distinct purposeofvisit_code from purposeof_visit");?>
							<select name="purpose_visit" id="purpose_visit" data-validation="required" class="textbox input validate[required] fstChUPPRCase" style="width:210px">
							<option value="">--Select--</option>
							<?php while($rowPV=mysql_fetch_array($sqlPV)) { ?>
							<?php if($rowQR['purpose_visit']==$rowPV['purposeofvisit_code']) { ?>
							<option value="<?php echo $rowPV['purposeofvisit_code'];?>" selected ><?php echo $rowPV['purposeofvisit_code'];?></option>
							<?php }else{?>
							<option value="<?php echo $rowPV['purposeofvisit_code'];?>"><?php echo $rowPV['purposeofvisit_code'];?></option>
							<?php } } ?>
							</select>
							</td>
						</tr>
						
						<tr>
							<td width="" valign="top"><label>Pay Mode <em>*</em></label></td>
							<td valign="top">
							<?php $sqlPm=mysql_query("select distinct payment_mode from payment_mode");?>
							<select name="pay_mode" id="pay_mode" data-validation="required" class="input validate[required] fstChUPPRCase textbox" style="width:210px">
							<option value="">--Select--</option>
							<?php while($rowPm=mysql_fetch_array($sqlPm)) { ?>
							<?php if($rowQR['pay_mode']==$rowPm['payment_mode']) { ?>
							<option value="<?php echo $rowPm['payment_mode'];?>" selected ><?php echo $rowPm['payment_mode'];?></option>
							<?php }else{?>
							<option value="<?php echo $rowPm['payment_mode'];?>"><?php echo $rowPm['payment_mode'];?></option>
							<?php } } ?>
							</select>
							</td>
						
						</tr>
						
						<!--<tr>
							<td width="" valign="top"><label>Pay Mode <em>*</em></label></td>
							<td valign="top">
							<select name="pay_mode" id="pay_mode" data-validation="required" class="textbox input validate[required] fstChUPPRCase" style="width:210px">
							<option value="">--Select--</option>
							<option value="cash"<?php echo ($rowQR['pay_mode']=='cash')?'selected':'';?>>Cash</option>
							<option value="card"<?php echo ($rowQR['pay_mode']=='card')?'selected':'';?>>Card</option>
							</select></td>
						</tr>-->
						
	<?php 
$sqlPr=mysql_query("select * from property_definition");
$rowPr=mysql_fetch_array($sqlPr);

if(isset($_GET['rmType'])){
	$sqlPr=mysql_query("select * from rate_table where room_type='".$_GET['rmType']."' AND structure_code='".$rowPr['rack_table']."'");
	$rowPr=mysql_fetch_array($sqlPr);
	
	$room_single=$rowPr['room_single'];
	$room_double=$rowPr['room_double'];
	$room_tripple=$rowPr['room_tripple'];
	$room_quadruple=$rowPr['room_quadruple'];
	$room_extperson=$rowPr['room_extperson'];
	$room_extchild=$rowPr['room_extchild'];
	$meal_single=$rowPr['meal_single'];
	$meal_double=$rowPr['meal_double'];
	$meal_tripple=$rowPr['meal_tripple'];
	$meal_quadruple=$rowPr['meal_quadruple'];
	$meal_extperson=$rowPr['meal_extperson'];
	$meal_extchild=$rowPr['meal_extchild'];
}else{
	$room_single="";
	$room_double="";
	$room_tripple="";
	$room_quadruple="";
	$room_extperson="";
	$room_extchild="";
	$meal_single="";
	$meal_double="";
	$meal_tripple="";
	$meal_quadruple="";
	$meal_extperson="";
	$meal_extchild="";
	
}

?>
				<tr>
						<td width="" valign="top"><label>Rate<em>*</em></label></td>
						<td valign="top">
						<?php $sqlRk=mysql_query("select distinct structure_code from rate_table");?>
						<select style="width:79px;float:left;" name="rate_code" id="rate_code" data-validation="required" class="input validate[required] fstChUPPRCase" onchange="selRateCode();">
						<option value="">--Select--</option>
						<?php while($rowRk=mysql_fetch_array($sqlRk)) { ?>
						<?php if($rowRk['structure_code']==$rowQR['rate_code']) { ?>
						<option value="<?php echo $rowRk['structure_code'];?>" selected ><?php echo $rowRk['structure_code'];?></option>
						<?php } else { ?>
						<option value="<?php echo $rowRk['structure_code'];?>"><?php echo $rowRk['structure_code'];?></option>
						<?php } } ?>
						</select>
						<!--<select style="width:79px;float:left;" name="rate_code" id="rate_code" ><option value="">--Select--</option></select>--><input name="rate_desc" id="rate_desc" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:120px;margin:0 0 0 11px;" value="<?php if(isset($rowQR['rate_desc'])){ echo $rowQR['rate_desc'];} ?>" /></td>
					</tr>
					
					<tr>
						<td width="" valign="top"><label>Disc<em>*</em></label></td>
						<td valign="top" style=""><select style="width:79px;float:left;" name="disc" id="disc" ><option value="">--Select--</option><option value="amount"<?php echo ($rowQR['disc']=='amount')?'selected':'';?>>Amount</option><option value="percentage"<?php echo ($rowQR['disc']=='percentage')?'selected':'';?>>Percentage</option></select><input name="disc_val" id="disc_val" type="text" class="textbox fstChUPPRCase" style="width:50px;margin:0 0 0 11px;" value="<?php echo $rowQR['disc_val'];?>" />&nbsp;&nbsp;
						<input type="button" name="confirm" id="confirm" value="confirm" onclick="selRateCodeConfirm();" hidden />
						<input type="checkbox" name="incLchk" id="incLchk" value="incl"<?php echo ($rowQR['taxInclusive']=='inclyes')?'checked':''; ?> class="incLchk" style=""/> <span style="font-size:12px;"> Tax Incl</span>
						</td>
					</tr>
					</tbody>
					</table>
					<table style="width:33%;float:right;margin:4px 0 0 0;text-align:center;font-size:12px;" class="table">
					<tr>
					<td width="" valign="top"><label class="spanClr">Food %<em>*</em></label></td>
					<td width="" valign="top">
					<input name="food_disc" id="food_disc" type="text" class="textbox fstChUPPRCase" style="width:55px" value="<?php echo $rowQR['food_disc']; ?>" placeholder="Disc"/>
					<span class="spanClr">Bev %<em>*</em></span>
					<input name="bev_disc" id="bev_disc" type="text" style="width:55px" class="textbox fstChUPPRCase" value="<?php echo $rowQR['bev_disc']; ?>" placeholder="Disc"/>
					<span class="spanClr">Liq %<em>*</em></span>
					<input name="liq_disc" id="liq_disc" type="text" style="width:55px" class="textbox fstChUPPRCase" value="<?php echo $rowQR['liq_disc']; ?>" placeholder="Disc"/></td>
					</tr>
					</tbody>
					</table>
			<table style="width:30%;float:right;margin:4px 0 0 0;text-align:center;font-size:12px;" class="table tableS">
					<thead class="tathead">
						<tr>
							<th width="" style="text-align:center;background-color:#F5F5F5;width:25px;"></th>
							<th width="" style="text-align:center;background-color:#F5F5F5;width:55px;">Single</th>
							<th width="" style="text-align:center;background-color:#F5F5F5;width:55px;">Double</th>
							<th width="" style="text-align:center;background-color:#F5F5F5;width:55px;">Tripple</th>
							<th width="" style="text-align:center;background-color:#F5F5F5;width:55px;">Quad</th>
							<th width="" style="text-align:center;background-color:#F5F5F5;width:55px;">Exp</th>
							<th width="" style="text-align:center;background-color:#F5F5F5;width:55px;">Exc</th>
						</tr>
					<tbody class="tathead tatbody tableS" id="rtCode" style="">
					
					</tbody>
<tbody class="tathead tatbody tableS" id="rtCode" style="">					
<?php
$sqlr=mysql_query("select * from room_booking where resv_no='".$_GET['roomBk']."' group by room_type");
$x=0;
while($rowr=mysql_fetch_array($sqlr)) { 
$x++;
?>
<tr class="rmSgle"><td><input name="room_type[]" id="room_type<?php echo $x; ?>" class="rmmType" type="hidden" value="<?php echo $rowr['room_type']; ?>" /><?php echo $rowr['room_type']; ?></td>
	<td width="" style="text-align:center;"><input name="room_single[]" id="room_single<?php echo $x; ?>" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:55px;margin:0 0 0 0px" value="<?php echo $rowr['room_single']; ?>"  /></td>
	<td width="" style="text-align:center;"><input name="room_double[]" id="room_double<?php echo $x; ?>" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:55px;margin:0 0 0 0px" value="<?php echo $rowr['room_double']; ?>" /></td>
	<td width="" style="text-align:center;"><input name="room_tripple[]" id="room_tripple<?php echo $x; ?>" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:55px;margin:0 0 0 0px" value="<?php echo $rowr['room_tripple']; ?>"  /></td>
	<td width="" style="text-align:center;"><input name="room_quadruple[]" id="room_quadruple<?php echo $x; ?>" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:55px;margin:0 0 0 0px" value="<?php echo $rowr['room_quadruple']; ?>"   /></td>
	<td width="" style="text-align:center;"><input name="room_extperson[]" id="room_extperson<?php echo $x; ?>" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:55px;margin:0 0 0 0px" value="<?php echo $rowr['room_extperson']; ?>"  /></td>
	<td width="" style="text-align:center;"><input name="room_extchild[]" id="room_extchild<?php echo $x; ?>" type="text" data-validation="required" class="input validate[required] textbox fstChUPPRCase" style="width:55px;margin:0 0 0 0px" value="<?php echo $rowr['room_extchild']; ?>"  /></td>
</tr>
<tr class="rmSgle"><td></td>
	<td width="" style="text-align:center;"><input name="meal_single[]" id="meal_single<?php echo $x; ?>" type="text" class="textbox fstChUPPRCase" style="width:55px;margin:0 0 0 0px" value="<?php echo $rowr['meal_single']; ?>"  /></td>
	<td width="" style="text-align:center;"><input name="meal_double[]" id="meal_double<?php echo $x; ?>" type="text" class="textbox fstChUPPRCase" style="width:55px;margin:0 0 0 0px" value="<?php echo $rowr['meal_double']; ?>"  /></td>
	<td width="" style="text-align:center;"><input name="meal_tripple[]" id="meal_tripple<?php echo $x; ?>" type="text" class="textbox fstChUPPRCase" style="width:55px;margin:0 0 0 0px" value="<?php echo $rowr['meal_tripple']; ?>"   /></td>
	<td width="" style="text-align:center;"><input name="meal_quadruple[]" id="meal_quadruple<?php echo $x; ?>" type="text" class="textbox fstChUPPRCase" style="width:55px;margin:0 0 0 0px" value="<?php echo $rowr['meal_quadruple']; ?>"  /></td>
	<td width="" style="text-align:center;"><input name="meal_extperson[]" id="meal_extperson<?php echo $x; ?>" type="text" data-validation="required" class="textbox fstChUPPRCase" style="width:55px;margin:0 0 0 0px" value="<?php echo $rowr['meal_extperson']; ?>"  /></td>
	<td width="" style="text-align:center;"><input name="meal_extchild[]" id="meal_extchild<?php echo $x; ?>" type="text" class="textbox fstChUPPRCase" style="width:55px;margin:0 0 0 0px" value="<?php echo $rowr['meal_extchild']; ?>" /></td>
</tr>
<?php } ?>
	</tbody>
<tbody id="rtCode" >
					
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
    padding: 4px 100px;
}
</style>
	<table style="border-left:1px solid #ddd;" class="table">
	<tr>
		<td>	
<div style="margin:0px 0 0 0px;">

	<button type="submit" id="send" name="send" class="butExample bnkSbt frstChr" style="" onclick="return checkEditRoomBk();"><img src="../../images/saves.png" class="sbtBtnImg frstChr"/>&nbsp;&nbsp;<span class="btnUndLine">S</span>ubmit</button>
	
	<button type="button" id="cancel" class="butExample" style="" onclick="rooMcancel_ed();"><img src="../../images/del.png" class="sbtBtnImg" style="width:15px;height:15px;" />&nbsp;&nbsp;<span class="btnUndLine">C</span>ancel</button>
	
	<a href="view-room-booking.php"><button type="button" id="update" class="butExample bnkSbt" onclick="return checkPropertyMasterq();"><img src="../../images/audit.png" class="sbtBtnImg "/>&nbsp;&nbsp;<span class="btnUndLine">V</span>iew</button></a>
		
	<a href="<?php echo $home_path; ?>/dashboard.php"><button type="button" id="exit" name="exit" class="butExample" style="" onClick="self.close();" ><img src="../../images/exitBut.png" class="sbtBtnImg" />&nbsp;&nbsp;<span class="btnUndLine">E</span>xit</button></a>
	
</div>
	</td>
	</tr>
	</table>		
	</form>	
	
	
</div>
	</div>
	</div>
</body>
</html>