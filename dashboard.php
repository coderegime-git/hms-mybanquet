<?php
include("header-main.php");
 ?>

<style>
#viewcustomer { /* width:1000px; */ float:left;margin:0px 0 0 0;}
#viewcustomer .table { /* width:1000px; */ float:left; margin:0px 0 0 0; border:solid 1px #f1f1f1;font-size:12px;}
#viewcustomer .table .heading { background:#bfbfbf;}
#viewcustomer .table .heading p { color:#1c1c1c; font-size:12px; padding:8px 15px; font-weight:bold;}
#viewcustomer .table .detail { background:#fff;}
#viewcustomer .table .detail p { color:#373737; font-size:12px; padding:10px 15px; font-weight:normal;}
#viewcustomer .table .detail p b { color:#157cab;}
#viewcustomer .table .detail p a { color:#157cab;}
#viewcustomer .table .detail p span { color:#157cab;}
#viewcustomer .table .borleftdark { border-left:solid 1px #878787;}
#viewcustomer .table .borleftlight { border-left:solid 1px #f1f1f1;}
#viewcustomer .table .borbottomlight { border-bottom:solid 1px #f1f1f1;}

.style-one {
  border: 1px solid #ffffff;
  width: 100%;
}

.DashbrdDiv{
	/* width:790px;margin:0px 0 0 -12px;height:545px;border:1px solid #d5d5d5;background-color:#F4F4F4; */
	/* width:790px;margin:0px 0 0 12px;height:505px;border:1px solid #000;background-color:#fce4d1; */
}

/*------------------------------------------------------------------
[6. Widget / .widget]
*/

.widget {
	
	position: relative;
	clear: both;
	
	width: auto;
	
	margin-bottom: 2em;
		
	overflow: hidden;
}
	
.widget-header {
	
	position: relative;
	
	height: 40px;
	line-height: 40px;
	
	/* background: #f9f6f1; */
	background: #4d0501;
	background:-moz-linear-gradient(top, #4d0501 0%, #f2efea 100%); /* FF3.6+ */
	background:-webkit-gradient(linear, left top, left bottom, color-stop(0%,#4d0501), color-stop(100%,#f2efea)); /* Chrome,Safari4+ */
	background:-webkit-linear-gradient(top, #4d0501 0%,#f2efea 100%); /* Chrome10+,Safari5.1+ */
	background:-o-linear-gradient(top, #4d0501 0%,#f2efea 100%); /* Opera11.10+ */
	background:-ms-linear-gradient(top, #4d0501 0%,#f2efea 100%); /* IE10+ */
	background:linear-gradient(top, #4d0501 0%,#f2efea 100%); /* W3C */
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#4d0501', endColorstr='#f2efea');
	-ms-filter: "progid:DXImageTransform.Microsoft.gradient(startColorstr='#4d0501', endColorstr='#f2efea')";
	
	
	border: 1px solid #d6d6d6;
	
	
	-webkit-background-clip: padding-box;
}	
	
	.widget-header h3 {
		
		position: relative;
		top: 2px;
		left: 10px;
		
		display: inline-block;
		margin-right: 3em;
		
		font-size: 14px;
		font-weight: 800;
		color: #525252;
		line-height: 18px;
		
		text-shadow: 1px 1px 2px rgba(255,255,255,.5);
	}
	
		.widget-header [class^="icon-"], .widget-header [class*=" icon-"] {
			
			display: inline-block;
			margin-left: 13px;
			margin-right: -2px;
			
			font-size: 16px;
			color: #555;
			vertical-align: middle;
			
			
			
		}




.widget-content {
	padding: 20px 15px 15px;
	
	background: #FFF;
	
	
	border: 1px solid #D5D5D5;
	
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	border-radius: 5px;
}

.widget-header+.widget-content {
	border-top: none;
	
	-webkit-border-top-left-radius: 0;
	-webkit-border-top-right-radius: 0;
	-moz-border-radius-topleft: 0;
	-moz-border-radius-topright: 0;
	border-top-left-radius: 0;
	border-top-right-radius: 0;
}

.widget-nopad .widget-content {
	padding: 0;
}

/* Widget Content Clearfix */	
.widget-content:before,
.widget-content:after {
    content:"";
    display:table;
}

.widget-content:after {
    clear:both;
}

/* For IE 6/7 (trigger hasLayout) */
.widget-content {
    zoom:1;
}

/* Widget Table */

.widget-table .widget-content {
	padding: 0;
}

.widget-table .table {
	margin-bottom: 0;
	
	border: none;
}

.widget-table .table tr td:first-child {
	border-left: none;
}

.widget-table .table tr th:first-child {
	border-left: none;
}


/* Widget Plain */

.widget-plain {
	
	background: transparent;
	
	border: none;
}

.widget-plain .widget-content {
	padding: 0;
	
	background: transparent;
	
	border: none;
}


/* Widget Box */

.widget-box {	
	
}

.widget-box .widget-content {	
	background: #E3E3E3;	
	background: #FFF;
}


#dashBrdTbl {
   /*  margin: 65px 0 0 28px; */
    margin: 38px 0 0 30px;
}

.dashMasImg {
    height: 83px;
    text-align: center;
    width: 126px;
}

.tbl,td{
	/* padding:0 22px 0 22px; */
	padding:0 16px;
	/* background-color:#D4D4CC; */
} 

.bgbox
{
background: url(images/box.jpg) no-repeat; 
background-size:260px 250px;
//background:url(images/box.jpg);
}

.login:before {
  content: '';
  position: absolute;
  /* top: -8px; */
  right: -8px;
  bottom: -8px;
  left: -8px;
 /*  z-index: -1; */
  background: rgba(0, 0, 0, 0.08);
  border-radius: 4px;
}
.login h1 {
  margin: -20px -20px 21px;
  line-height: 40px;
  font-size: 15px;
  font-weight: bold;
  color: #555;
  text-align: center;
  text-shadow: 0 1px white;
  background: #f3f3f3;
  border-bottom: 1px solid #cfcfcf;
  border-radius: 3px 3px 0 0;
  background-image: -webkit-linear-gradient(top, whiteffd, #eef2f5);
  background-image: -moz-linear-gradient(top, whiteffd, #eef2f5);
  background-image: -o-linear-gradient(top, whiteffd, #eef2f5);
  background-image: linear-gradient(to bottom, whiteffd, #eef2f5);
  -webkit-box-shadow: 0 1px whitesmoke;
  box-shadow: 0 1px whitesmoke;
}

.dashMasLbl {
    color: #000;
    font: 12px/1.5em Arial,Helvetica,sans-serif;
    margin: 8px 0 0;
    text-align: center;
    width: 112px;
}

/*------------------------------------------------------------------
.wrapper {
   /*  width: 250px; */
}

.btnUndLine {
    text-decoration: underline #00008b;
}
</style>
<script src="<?php echo $home_path;?>/date-picker/jquery-ui.js"></script>
<link rel="stylesheet" href="<?php echo $home_path;?>/date-picker/jquery-ui.css">

 <script type="text/javascript" src="<?php echo $home_path; ?>/js/bootstrap.min.js"></script>
<!-- <script src="<?php echo $home_path;?>/carslider/js/jquery-1.11.3.min.js" type="text/javascript"></script>-->
 <script src="<?php echo $home_path;?>/carslider/js/jssor.slider-22.2.16.mini.js" type="text/javascript"></script>
 <script type="text/javascript" src="<?php echo $home_path; ?>/js/bootstrap.min.js"></script>
 
<script type="text/javascript">
$(document).ready(function(){
	 $('[data-toggle="tooltip"]').tooltip();   
	$(".datepicker" ).datepicker({
	changeMonth:true,
	changeYear:true,
	yearRange:"-2:+2",
	 minDate: 0, 
	dateFormat:"dd/mm/yy"
	});

	$(".datepicker1" ).datepicker({
	changeMonth:true,
	changeYear:true,
	yearRange:"-2:+2",
	/* minDate: 0, */
	dateFormat:"dd/mm/yy"
	});
	
	 $('.demo').ntm();
	 var jssor_1_options = {
              $AutoPlay: true,
              $AutoPlaySteps: 4,
              $SlideDuration: 160,
              $SlideWidth: 200,
              $SlideSpacing: 3,
              $Cols: 4,
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$,
                $Steps: 4
              },
              $BulletNavigatorOptions: {
                $Class: $JssorBulletNavigator$,
                $SpacingX: 1,
                $SpacingY: 1
              }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);
            function ScaleSlider() {
                var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
                if (refSize) {
                    refSize = Math.min(refSize, 1000);
                    jssor_1_slider.$ScaleWidth(refSize);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }
            ScaleSlider();
            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);
  
  	$("[rel=tooltip]").tooltip();
	$("[rel=popover]").popover({trigger:'click',html:true});
	
	
	
	
	
});
	function clickFirstRow(){
		 firstSpn=$("#firstRowSpn").html();
		 if(firstSpn=='Vacant'){
		 
		 }
	}
</script>	


	
<body class="">

<form action="#" id="hotelDefi" name="hotelDefi">

<!--<div class="col-md-3" style="background-color:#efffe1;" id="clFrs">-->
<div class="col-md-3" id="clFrs" style="height:525px;">

<link rel="stylesheet" type="text/css" href="<?php echo $home_path; ?>/css/ie.css">
<script type="text/javascript" src="tree-menu/lib/jquery.ntm/js/jquery.ntm.js"></script>
        <link rel="stylesheet" href="tree-menu/css/style.css" />
       <!-- <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">-->
        <link rel="stylesheet" href="tree-menu/lib/jquery.ntm/themes/default/css/theme.css" />
        <script type="text/javascript">
           /*  $(document).ready(function() {
                $('.demo').ntm();
            }); */
        </script>
<?php 
$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$adtCurDt=$rowAC['cur_date'];
$adtT=explode('/',$adtCurDt);
$adtTT=$adtT[2].'-'.$adtT[1].'-'.$adtT[0];

$toDate=$adtCurDt;
?>
        <div class="wrapper" style="">
         <div class="tree-menu demo" id="tree-menu" style="overflow:auto;height:543px;">
		  <div style="font-size:15px;color:#7B0E0E;font-weight:bold;padding:6px;text-align:center;">Hall Status</div>
		  <ul>
<?php 
$toDate=$adtCurDt;
$sqlAR=mysql_query("select count(distinct booking_no) AS todayDep from bq_hallbooking where confirm_status='2' AND str_to_date(book_date,'%d/%m/%Y') >= '$adtTT'"); 
$rowAr=mysql_fetch_array($sqlAR);
?>		
<li><a href="#">All <span style="font-size:15px;color:blue;"><?php echo $rowAr['todayDep']; ?></span></a>
<ul>
<li style="color:#af0a05;background-color:#fff;"><table class="table dsWrpTbl" style="border:1px solid #000;">
<tr><td style="width:22px;margin:0 0 0 5px;background-color:#C3C3C3;color:#000;border:1px solid #000;">Bk#</td><td style="width:70px;background-color:#C3C3C3;color:#000;border:1px solid #000;">Gst Name</td><td style="width:50px;background-color:#C3C3C3;color:#000;border:1px solid #000;">Func Date</td><td style="width:50px;background-color:#C3C3C3;color:#000;border:1px solid #000;">venue</td>
</tr>
<?php 
	$sqlR=mysql_query("select * from bq_hallbooking where confirm_status='2' AND str_to_date(book_date,'%d/%m/%Y') >= '$adtTT' order by str_to_date(book_date,'%d/%m/%Y') ASC"); 
	$pax=0;$adTpax=0;$chDpax=0;
	while($rowR=mysql_fetch_array($sqlR)){
		
		$gstST= strtoupper(mb_strimwidth($rowR['guest_name'], 0, 15, '...'));
		
?>
<tr><td style="width:22px;margin:0 0 0 5px;border-right:1px solid #000;text-align:right;"><a href="<?php echo $home_path;?>/transaction/frontdesk/edit-hall-booking.php?roomBk=<?php echo $rowR['booking_no']; ?>&rmBkID=<?php echo $rowR['hallbook_id']; ?>" target="_blank" title="Click here"><?php echo $rowR['booking_no']; ?></a></td><td style="width:60px;border-right:1px solid #000;"><?php echo $gstST; ?></td><td style="width:50px;border-right:1px solid #000;"><?php echo $rowR['book_date']; ?></td><td style="width:50px;border-right:1px solid #000;"><?php echo $rowR['venue']; ?></td>
</tr>
	<?php } ?>
</table></li>
			</ul>
			  </li>
			</ul>
		
<?php 
$ad=explode('/',$adtCurDt);
$add=$ad[2].'-'.$ad[1].'-'.$ad[0];

$sqlAR=mysql_query("select count(distinct booking_no) AS fortheDy from bq_hallbooking where str_to_date(book_date,'%d/%m/%Y') = '$add' AND confirm_status='2' order by str_to_date(book_date,'%d/%m/%Y') ASC"); 
$rowAr=mysql_fetch_array($sqlAR);

?>			
<ul>
	<li><a href="#" style="">For The Day&nbsp;<span style="font-size:15px;color:blue;"><?php echo $rowAr['fortheDy'];?></span> </a>
	<ul>
<li style="color:#af0a05;background-color:#fff;"><table class="table dsWrpTbl" style="border:1px solid #000;">
<tr><td style="width:22px;margin:0 0 0 5px;background-color:#C3C3C3;color:#000;border:1px solid #000;">Bk#</td><td style="width:70px;background-color:#C3C3C3;color:#000;border:1px solid #000;">Gst Name</td><td style="width:50px;background-color:#C3C3C3;color:#000;border:1px solid #000;">Func Date</td><td style="width:50px;background-color:#C3C3C3;color:#000;border:1px solid #000;">venue</td>
</tr>
<?php
$sqlAR=mysql_query("select * from bq_hallbooking where str_to_date(book_date,'%d/%m/%Y')= '$add' AND confirm_status='2' order by str_to_date(book_date,'%d/%m/%Y') ASC"); 
while($rowR=mysql_fetch_array($sqlAR)){

$gstST= strtoupper(mb_strimwidth($rowR['guest_name'], 0, 15, '...'));

?>
<tr><td style="width:22px;margin:0 0 0 5px;border-right:1px solid #000;text-align:right;"><a href="<?php echo $home_path;?>/transaction/frontdesk/edit-hall-booking.php?roomBk=<?php echo $rowR['booking_no']; ?>&rmBkID=<?php echo $rowR['hallbook_id']; ?>" target="_blank" title="Click here"><?php echo $rowR['booking_no']; ?></a></td><td style="width:60px;border-right:1px solid #000;"><?php echo $gstST; ?></td><td style="width:50px;border-right:1px solid #000;"><?php echo $rowR['book_date']; ?></td><td style="width:50px;border-right:1px solid #000;"><?php echo $rowR['venue']; ?></td>
</tr>
<?php } ?>
</table></li>
 				  </ul>
			  </li>
			  
			</ul>
		 		  
			<ul>
<?php 

$monday = strtotime("last monday");
$monday = date('w', $monday)==date('w') ? $monday+7*86400 : $monday;
 
$sunday = strtotime(date("Y-m-d",$monday)." +6 days");
 
$frm = date("Y-m-d",$monday);
$tod = date("Y-m-d",$sunday);

$sqlAR=mysql_query("select count(distinct booking_no) AS forWeek from bq_hallbooking where str_to_date(book_date,'%d/%m/%Y') >= '$frm' AND str_to_date(book_date,'%d/%m/%Y') <= '$tod' AND confirm_status='2'"); 
$rowAr=mysql_fetch_array($sqlAR);

?>		
	<li><a href="#">For The Week <span style="font-size:15px;color:blue;"><?php echo $rowAr['forWeek'];?></span></a>
		<ul>
<li style="color:#af0a05;background-color:#fff;"><table class="table dsWrpTbl" style="border:1px solid #000;">
<tr><td style="width:22px;margin:0 0 0 5px;background-color:#C3C3C3;color:#000;border:1px solid #000;">Bk#</td><td style="width:70px;background-color:#C3C3C3;color:#000;border:1px solid #000;">Gst Name</td><td style="width:50px;background-color:#C3C3C3;color:#000;border:1px solid #000;">Func Date</td><td style="width:50px;background-color:#C3C3C3;color:#000;border:1px solid #000;">venue</td>
</tr>
<?php 
$sqlAR=mysql_query("select * from bq_hallbooking where str_to_date(book_date,'%d/%m/%Y') >= '$frm' AND str_to_date(book_date,'%d/%m/%Y') <= '$tod' AND confirm_status='2' order by str_to_date(book_date,'%d/%m/%Y') ASC"); 
while($rowR=mysql_fetch_array($sqlAR)){
$gstST= strtoupper(mb_strimwidth($rowR['guest_name'], 0, 15, '...'));
?>
<tr><td style="width:22px;margin:0 0 0 5px;border-right:1px solid #000;;text-align:right"><a href="<?php echo $home_path;?>/transaction/frontdesk/edit-hall-booking.php?roomBk=<?php echo $rowR['booking_no']; ?>&rmBkID=<?php echo $rowR['hallbook_id']; ?>" target="_blank" title="Click here"><?php echo $rowR['booking_no']; ?></a></td><td style="width:60px;border-right:1px solid #000;"><?php echo $gstST; ?></td><td style="width:50px;border-right:1px solid #000;"><?php echo $rowR['book_date']; ?></td><td style="width:50px;border-right:1px solid #000;"><?php echo $rowR['venue']; ?></td>
</tr>
<?php } ?>
</table></li>
</ul>
</li>
</ul>

<ul>
<?php 
/* $toDate=date('d/m/Y'); */
$toDate=$adtCurDt;
$fr=explode('/',$adtCurDt);
/* $frm=$fr[2].'-'.$fr[1].'-'.'01'; */
$frm=$fr[2].'-'.$fr[1].'-'.$fr[0];
$a_date = $frm;
$tod= date("Y-m-t", strtotime($a_date));
$sqlAR=mysql_query("select count(distinct booking_no) AS forMnth from bq_hallbooking where str_to_date(book_date,'%d/%m/%Y') >= '$frm' AND str_to_date(book_date,'%d/%m/%Y') <= '$tod' AND confirm_status='2'"); 
$rowAr=mysql_fetch_array($sqlAR);
?>			
<li><a href="#">For The Month<span style="font-size:15px;color:blue;"><?php echo $rowAr['forMnth'];?></span></a>
	<ul>
<li style="color:#af0a05;background-color:#fff;"><table class="table dsWrpTbl" style="border:1px solid #000;">
<tr><td style="width:22px;margin:0 0 0 5px;background-color:#C3C3C3;color:#000;border:1px solid #000;">Bk#</td><td style="width:70px;background-color:#C3C3C3;color:#000;border:1px solid #000;">Gst Name</td><td style="width:50px;background-color:#C3C3C3;color:#000;border:1px solid #000;">Func Date</td><td style="width:50px;background-color:#C3C3C3;color:#000;border:1px solid #000;">venue</td>
</tr>
<?php 
$sqlAR=mysql_query("select * from bq_hallbooking where str_to_date(book_date,'%d/%m/%Y') >= '$frm' AND str_to_date(book_date,'%d/%m/%Y') <= '$tod' AND confirm_status='2' order by str_to_date(book_date,'%d/%m/%Y') ASC"); 
while($rowR=mysql_fetch_array($sqlAR)){
	$gstST= strtoupper(mb_strimwidth($rowR['guest_name'], 0, 15, '...'));
?>
<tr><td style="width:22px;margin:0 0 0 5px;border-right:1px solid #000;;text-align:right"><a href="<?php echo $home_path;?>/transaction/frontdesk/edit-hall-booking.php?roomBk=<?php echo $rowR['booking_no']; ?>&rmBkID=<?php echo $rowR['hallbook_id']; ?>" target="_blank" title="Click here"><?php echo $rowR['booking_no']; ?></a></td><td style="width:60px;border-right:1px solid #000;"><?php echo $gstST; ?></td><td style="width:50px;border-right:1px solid #000;"><?php echo $rowR['book_date']; ?></td><td style="width:50px;border-right:1px solid #000;"><?php echo $rowR['venue']; ?></td>
</tr>
			<?php } ?>
			</table></li>
		</ul>
	</li>
	</ul>
<ul>
<?php 

$toDate=$adtCurDt;
$sqlDp=mysql_query("select count(distinct bh.billhead_id) AS todayDept from bill_header bh,bill_detail bd where bh.bill_date='".$toDate."' AND bh.bill_no=bd.bill_no AND bh.settleflag='2'");
$rowDp=mysql_fetch_array($sqlDp);

?>

</ul>



</div>
	</div>
</div>

<script>
function showGridView() {
	
	ven=$('#bq_venue').val();
	fromdate=$('#from_date').val();
	let fromParts = fromdate.split('/');
	let fromDate = new Date(fromParts[2], fromParts[1] - 1, fromParts[0]);
	todate=$('#to_date').val();
	let toParts = todate.split('/');
	let toDate = new Date(toParts[2], toParts[1] - 1, toParts[0]);
	//console.log(todate);
	let today = new Date();
    today.setHours(0, 0, 0, 0); // Remove time for accurate comparison

    if (fromDate < today) {
        alert("From date cannot be earlier than today.");
        return; // Don't proceed with the rest of showGridView
    }
    if (toDate < today) {
        alert("From date cannot be earlier than today.");
        return; // Don't proceed with the rest of showGridView
    }
	if(fromdate!="" && todate!="")
	{
		document.location="dashboard.php?fromdate="+fromdate+"&todate="+todate+"&ven="+ven;
	}
}

function dashNext(){
 	frm=$('#from_date').val(); 
	$.ajax({
		type:'GET',
		url:' action/seldashBrdBQT.php',
			data:{
			frm:frm 
			},
			success:function(data){
				/* alert(data); */
				opt=data.split('&#');
				$('#dshBrd').hide();
				$('#dshBrdShw').show();
				$('#dshBrdShw').html(opt[0]);
				$('#from_date').val(opt[1]);
				$('#to_date').val(opt[1]);
				setTimeout(function() {
               showGridView();
         }, 300); 
				//showGridView();
			}
		}); 
		
	/* document.location="dashboard.php?fromdate="+adtDt+"&todate="+adtDt+"&ven="; */
}

function dashprevious(){
	frm=$('#from_date').val(); 
	$.ajax({
		type:'GET',
		url:' action/seldashBrdNxtBQT.php',
			data:{
			frm:frm 
			},
			success:function(data){
				/* alert(data); */
				opt=data.split('&#');
				$('#dshBrd').hide();
				$('#dshBrdShw').show();
				$('#dshBrdShw').html(opt[0]);
				$('#from_date').val(opt[1]);
				$('#to_date').val(opt[1]);
				setTimeout(function() {
               showGridView();
         }, 300); 
				//showGridView();
			
			}
		}); 
	
}
</script>

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
$rowbl=mysql_fetch_array($sqlRe);
?>





<div id="viewcustomer" class="col-md-9" id="cOlT">
<input type="hidden" id="adtDt" name="adtDt" value="<?php echo $adtCurDt;?>"/>
<div style="margin:0px 0 0 0px;background-color:#0073B5;color:#fff;" >
<table style="width:800px;">	
<tr>
<td style="width:60px;"><label style="width:80px;color:#fff;font-size:12px;"><b>From </b></label></td>
<td >
	<input name="from_date" style="width:100px;margin-bottom:0px;text-align:center;" type="text" class="textbox datepicker" id="from_date"   value="<?php if(isset($_GET['todate'])){ echo $_GET['fromdate'];}?>" onChange="showsales()" placeholder="From Date"/>
</td>
<td style="width:60px;"><label style="width:70px;color:#fff;font-size:12px;"><b>To </b></label></td>
<td>
	<input name="to_date" style="width:100px;margin:0px 100px 0 0;text-align:center;" type="text" class="textbox datepicker1" id="to_date"  value="<?php if(isset($_GET['todate'])){ echo $_GET['todate'];}?>" onChange="showsales()" placeholder="To Date"/>
</td>
<td style="width:90px;"><label style="width:90px;color:#fff;font-size:12px;"><b>Status </b></label></td>
<td style="border:none;width:161px;" >
		<?php $sqlPV=mysql_query("select * from bq_venue");?>
		<select name="bq_venue" id="bq_venue" style="width:143px;font-size:12px;" >
		<option value="all">All</option>
		<?php while($rowPV=mysql_fetch_array($sqlPV)) { ?>
		<?php if($rowPV['venue_desc']==$_GET['ven']) { ?>
		<option value="<?php echo $rowPV['venue_code'];?>" selected ><?php echo $rowPV['venue_desc'];?></option>
		<?php } else { ?>
		<option value="<?php echo $rowPV['venue_code'];?>"><?php echo $rowPV['venue_desc'];?></option>
		<?php } } ?>
		</select>
</td>
<td style="" id="">
<span>
&nbsp;&nbsp;<input type="button" value="Apply" class="btnH" onclick="showGridView();" style="margin:0 0 0 0px;font-weight: bold;font-size:13px;padding:0px 2px 0 2px;">
</span>
</td>

<td style="" id="">
<span>
<img src="<?php echo $home_path;?>/images/previou.png" value="Apply" class="btnH" style="margin:0 0 0 0px;font-weight: bold;font-size:13px;padding:0px 2px 0 2px;width:35px;height:25px;cursor:pointer;" title="Previous" onclick="dashprevious();"/>
<img src="<?php echo $home_path;?>/images/next.png" value="Apply" class="btnH" style="margin:0 0 0 0px;font-weight: bold;font-size:13px;padding:0px 2px 0 2px;width:35px;height:25px;cursor:pointer;" title="Next" onclick="dashNext();"/>
</span>
</td>

	
</tr>
</table>
<table class="table table-condensed table-hover table-striped table-bordered frmBgClr" cellpadding="0" cellspacing="0" border="0" class="table" style="margin:0px 0 0px 0px;text-align:center;font-size:12px;">
<tr>
	<th style="text-align:center;background-color:#17C464;font-weight:bold;width:80px;">Date</th>
	<th style="text-align:center;background-color:#17C464;font-weight:bold;width:80px;">Venue</th>
	<?php 
	for($cc=6;$cc<=24;$cc++){
	?>
	<th style="text-align:center;background-color:#17C464;font-weight:bold;width:20px;"><?php echo $cc; ?></th>
	<?php } ?>
</tr>
</table>
</div>


<div id="dshBrd" style="width:100%;height:463px;overflow:auto;">




<!--<div style="background-color:#7b0e0e;width:100%;">
<table class="table table-condensed table-hover table-striped table-bordered frmBgClr" cellpadding="0" cellspacing="0" border="0" class="table" style="margin:0px 0 0px 0px;text-align:center;font-size:12px;border:none;float:right;">
<tr>
	<td style="border:none;width:100px;" id="Userhd">
		<?php $sqlPV=mysql_query("select * from bq_venue");?>
		<select name="bq_venue" id="bq_venue" style="width:120px;font-size:12px;" >
		<option value="all">All</option>
		<?php while($rowPV=mysql_fetch_array($sqlPV)) { ?>
		<?php if($rowPV['venue_desc']==$_GET['ven']) { ?>
		<option value="<?php echo $rowPV['venue_code'];?>" selected ><?php echo $rowPV['venue_desc'];?></option>
		<?php } else { ?>
		<option value="<?php echo $rowPV['venue_code'];?>"><?php echo $rowPV['venue_desc'];?></option>
		<?php } } ?>
		</select>

<span>
<input name="from_date" style="width:100px;float:right;" type="text" class="textbox datepicker" id="from_date"   value="<?php if(isset($_GET['todate'])){ echo $_GET['fromdate'];}?>" onChange="showsales()" placeholder="From Date"/>
</span>

<span>
	<input name="to_date" style="width:100px;float:right;" type="text" class="textbox datepicker1" id="to_date"  value="<?php if(isset($_GET['todate'])){ echo $_GET['todate'];}?>" onChange="showsales()" placeholder="To Date"/>
</span>
</td>
<td style="width:42px;" id="Userhd">
<span>
<input type="button" value="Apply" class="btnH" onclick="showGridView();" style="margin:0 0 0 0px;font-weight: bold;padding: 5px;font-size:13px;padding:0px 2px 0 2px;">
</span>
</td>
</tr>
</table>
</div>-->

<style>
table {
    table-layout:fixed;
}

table td {
    overflow:hidden;
	border:none;
}

::-webkit-scrollbar
{
  width: 6px;  /* for vertical scrollbars */
  height: 12px; /* for horizontal scrollbars */
}

::-webkit-scrollbar-track
{
  background: rgba(0, 0, 0, 0.1);
}

::-webkit-scrollbar-thumb
{
  background: rgba(0, 0, 0, 0.5);
}
</style>

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
$rowbl=mysql_fetch_array($sqlRe);


$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$adtCurDt=$rowAC['cur_date'];
$dte=explode('/',$adtCurDt);
$dtea=$dte[2].'/'.$dte[1].'/'.$dte[0];
?>	

<table class="table table-condensed table-hover table-striped table-bordered frmBgClr" cellpadding="0" cellspacing="0" border="0" class="table" style="margin:0px 0 0px 0px;text-align:center;font-size:12px;">

<tr>
<?php
if(isset($_GET['fromdate']) && isset($_GET['todate'])) { 
$fr=explode('/',$_GET['fromdate']);
$frm=$fr[2].'-'.$fr[1].'-'.$fr[0];
$to=explode('/',$_GET['todate']);
$tod=$to[2].'-'.$to[1].'-'.$to[0];


$frDate=$_GET['fromdate'];
$toDate=$_GET['todate'];
}else{
$frDate=$adtCurDt;
$toDate=$adtCurDt;	
}
$frxpl=explode('/',$frDate);
$frDt=@$frxpl[2].'-'.@$frxpl[1].'-'.@$frxpl[0];
$toDat=explode('/',$toDate);
$toDD=@$toDat[2].'-'.@$toDat[1].'-'.@$toDat[0];
		
$date_from = $frDt;   
$date_from = strtotime($date_from); 
$date_to = $toDD;  
$date_to = strtotime($date_to);  
for ($i=$date_from; $i<=$date_to; $i+=86400) {
	
$rr= date("d/m/Y", $i);	
$rrr= date("Y-m-d", $i);

	
if(isset($_GET['ven']) && $_GET['ven']!='' && $_GET['ven']!='all') {
	$sqlRe=mysql_query("select * from bq_venue where venue_code='".$_GET['ven']."'");
}else if(isset($_GET['ven']) && $_GET['ven']=='all') {
	$sqlRe=mysql_query("select * from bq_venue");
}else{
	$sqlRe=mysql_query("select * from bq_venue");
}
$x=0;
while($rowRe=mysql_fetch_array($sqlRe)){
	$x++;
?>
		<?php if($x==1) { ?>
		<?php  if(isset($_GET['fromdate']) && $_GET['fromdate']!='') { ?>
		<td style="text-align:center;width:80px;"><?php  echo $rr;  ?></td>
		<?php }else{ ?>
		<td style="text-align:center;width:80px;"><?php  echo $adtCurDt;  ?></td>
		<?php } ?>
		<?php }else{ ?>
		<td style="text-align:center;width:80px;">&nbsp;</td>
		<?php } ?>
		<!--<td style="text-align:left;width:80px;"><a href="<?php echo $home_path ?>/transaction/frontdesk/hall-booking.php?ven=<?php echo $rowRe['venue_desc']?>&dte=<?php echo $rr; ?>" style="color:#000;"><?php echo $rowRe['venue_desc']; ?></a></td>-->
		<td style="text-align:left;width:80px;"><a href="<?php echo $home_path ?>/transaction/frontdesk/view-hall-booking.php?val=<?php echo $rowRe['venue_code']?>&fromdate=<?php echo $rr; ?>&todate=<?php echo $rr; ?>" style="color:#000;"><?php echo $rowRe['venue_desc']; ?></a></td>

<script>
function vcntRoomBook() {
	document.location.href="<?php echo $home_path ?>/transaction/frontdesk/hall-booking.php";
}
</script>
<?php 
for($cc=6;$cc<=24;$cc++){

$sqD=mysql_query("select * from bq_dashhall where str_to_date(funtion_date,'%d/%m/%Y') = STR_TO_DATE('$rr','%d/%m/%Y') AND venue='".$rowRe['venue_code']."' AND hour='".$cc."' AND status='1'");
//echo "select * from bq_dashhall where str_to_date(funtion_date,'%d/%m/%Y') = STR_TO_DATE('$rr','%d/%m/%Y') AND venue='".$rowRe['venue_desc']."' AND hour='".$cc."' AND status='1'";
if(mysql_num_rows($sqD)>0){
$roD=mysql_fetch_array($sqD);

$sqb=mysql_fetch_array(mysql_query("select * from bq_hallbooking where booking_no='".$roD['booking_no']."' AND hallbook_id='".$roD['hallbook_id']."'"));	
?>
<?php
if($roD['confirm_status']==1){
	$bgcolor= '#'.$rowRv['room_color'];
}else if($roD['confirm_status']==2){
	$bgcolor= '#'.$rowRd['room_color'];
}else if($roD['confirm_status']==3){
	$bgcolor= '#'.$rowRo['room_color'];
}else if($roD['confirm_status']==4){
	$bgcolor= '#'.$rowRg['room_color'];
}else if($roD['confirm_status']==5){
	$bgcolor= '#'.$rowRm['room_color'];
}else if($roD['confirm_status']==6){
	$bgcolor= '#'.$rowbl['room_color'];
}else{
	/* $bgcolor= '#'.$rowRd['room_color']; */
}
/* echo $bgcolor; */
?>
<td style="text-align:center;width:20px;background-color:<?php echo $bgcolor; ?>;color:#fff;" ><a href="<?php echo $home_path;?>/transaction/frontdesk/edit-hall-booking.php?roomBk=<?php echo $roD['booking_no']; ?>&rmBkID=<?php echo $roD['hallbook_id']; ?>" data-toggle="tooltip" title="<?php echo 'BK#:'.$roD['booking_no'].','.strtoupper('  GUEST:'.$roD['guest_name']).',  PAX: '.$sqb['guaranted'];?>">&nbsp;</a></td>
<?php }else{ ?>
<a href="<?php echo $home_path;?>/transaction/frontdesk/hall-booking.php?dte=<?php echo $rr; ?>&ven=<?php echo $rowRe['venue_desc']; ?>"><td style="text-align:center;width:20px;background-color:#<?php echo $rowRv['room_color']; ?>;" onclick="vcntRoomBook();"><a href="<?php echo $home_path;?>/transaction/frontdesk/hall-booking.php?dte=<?php echo $rr; ?>&ven=<?php echo $rowRe['venue_desc']; ?>" data-toggle="tooltip" title="Vacant!">&nbsp;</a>&nbsp;&nbsp;</td></a>	
	
<?php } } ?>
		
		
</tr>
<?php  }  }  ?>
</table>



</div>


	
<div id="dshBrdShw" style="width:100%;height:463px;overflow:auto;display:none;">


</div>

<div id="viewcustomer" style="width:100%;overflow:auto;margin:0px 0 0 0;">	
<table class="table table-condensed table-hover table-striped table-bordered dsTTrm" cellspacing="0" cellpadding="6" border="3">
		<tr>
			<td style="background-color:#<?php echo $rowRv['room_color']; ?>;color:#fff;width:100px;font-size:12px;text-align:center;">Available</td>
			<td style="background-color:#<?php echo $rowRd['room_color']; ?>;color:#fff;width:100px;font-size:12px;text-align:center;">Reserved</td>
			<td style="background-color:#<?php echo $rowRo['room_color']; ?>;color:#fff;width:100px;font-size:12px;text-align:center;">Wait Listed </td>
			<td style="background-color:#<?php echo $rowRg['room_color']; ?>;color:#fff;width:100px;font-size:12px;text-align:center;">Enquiry </td>
			<td style="background-color:#<?php echo $rowRm['room_color']; ?>;color:#fff;width:100px;font-size:12px;text-align:center;">Tentative</td>
			<td style="background-color:#<?php echo $rowbl['room_color']; ?>;color:#fff;width:100px;font-size:12px;text-align:center;">Blocked</td>
		</tr>
		
</table>
</div>
	

</div>











</form>	
<?php include("footer.php");  ?>		
</body>
</html>