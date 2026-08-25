<?php 
ob_start();
//session_start(); 
include("config.php");
$sql=mysql_query("select * from property_definition where propdef_id='1'");
$row=mysql_fetch_array($sql);
?>

<!DOCTYPE> 
<html>

<!--<!DOCTYPE HTML>
<html>-->
<head>
<title>MY BANQUET</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Home Jobs, Data Entry, Data Outsourcing, Online Jobs" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="<?php echo $home_path; ?>/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo $home_path; ?>/css/bootstrap.css" rel='stylesheet' type='text/css' />
<!--<link href='//fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>-->
<link rel="stylesheet" type="text/css" href="<?php echo $home_path; ?>/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo $home_path; ?>/css/ie.css">
<link rel="stylesheet" href="<?php echo $home_path; ?>/css/flexslider.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo $home_path; ?>/css/ie.css" type="text/css" media="screen" />
<!---strat-slider---->
<script type="text/javascript" src="<?php echo $home_path; ?>/js/jquery-1.11.1.min.js"></script>
<!---//-slider---->
<script src="<?php echo $home_path; ?>/js/shortcut.js" type="text/javascript"></script>


<link rel="shortcut icon" href="images/rms.png">	


    <link rel="stylesheet" href="<?php echo $home_path; ?>/megamenu-js-master/css/style.css">
    <link rel="stylesheet" href="<?php echo $home_path; ?>/megamenu-js-master/css/ionicons.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo $home_path; ?>/css/loader.css">
    <script type="text/javascript" src="<?php echo $home_path; ?>/js/loader.js"></script>
 
	
</head>
<script>
$(document).ready(function() {

});
	  
		function selectcompany() {
			get_company=$('#get_company').val();
			page = "<?php echo $_SERVER['PHP_SELF'];?>";
			/* alert(page); */
				$.ajax({
					type:'GET',
					url:'../action/companySession.php',
					data:{
					get_company:get_company
					},
					success:function(data){
						location.href=page;
						/* location.reload(); 
						 alert(data); 
						 if(data==1){
							msg='user name already exists';
							$('#msg').html(msg); 
							$('#username').focus();
						} 
						else{
						$('#msg').html('');  
						}  */
					}
				});
			
			}
			
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('txt').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}

</script>
<?php
$sqlAC=mysql_query("select * from audt_control where audtcontrol_id='1'");
$rowAC=mysql_fetch_array($sqlAC);
$curDate=$rowAC['cur_date'];

date_default_timezone_set('Asia/Kolkata');
$currTme = date('H:i:s');
?>
<body onload="startTime()">
<!-- Global Page Loader Markup -->
<div id="global-loader-overlay">
	<div class="global-loader-box">
		<div class="global-spinner"></div>
		<div class="global-loader-text">Loading, please wait...</div>
	</div>
</div>

<!-- Centered Blue Success Modal Backdrop & Markup -->
<div id="global-success-backdrop" onclick="hideSuccessPopup()"></div>

<div id="global-success-popup">
	<div class="success-popup-header">
		<div class="success-popup-icon">
			<i class="fa fa-check"></i>
		</div>
		<div class="success-popup-title" id="success-popup-title">SUCCESS</div>
	</div>
	<div class="success-popup-body" id="success-popup-message">
		Data Saved Successfully.
	</div>
	<div class="success-popup-footer">
		<button type="button" class="success-popup-btn" onclick="hideSuccessPopup()">OK</button>
	</div>
</div>
<!-- header -->
	<!--<div class="header_bg" style="  background: linear-gradient(#3496C3, #3496C3); ">-->
	<div class="header_bg" style="  background-color: #0073B5; ">
		<!--<div class="container" >-->
			<!-----start-header----->
		<div class="" >
			<div class="header" >
			
			
				<!--<div class="logo">-->
<div style="padding:10px;">
					<a href="<?php echo $ippath; ?>/dashboard-my.php"><img src="<?php echo $home_path; ?>/images/hmsmysoftname.png" alt="" style="width:109px;height:30px;" /></a>
					
	<div class="btn-group pull-right" style="/* margin:7px -26px 0 0; */">
	<!--<span style="margin-left:0px;margin-top:0px;">
	<select id="get_company" title="" name="get_company" onchange="selectcompany();" style="height:29px;font-size:15px;width:120px;margin: 5px 0 0;">
	<?php /* echo $companyname; */?>
	</select>
</span>	-->

			<!--<a class="btn dropdown-toggle" href="<?php echo $home_path; ?>/index.php" style="margin:0 0 0 -742px;">-->
				<i class="icon-home"></i>
				<span class="" style="color:#fff;font-weight:700;text-transform:uppercase;font-size:13px;margin:0 0 0 -742px;">Welcome To <?php echo $row['prop_name']; ?></span>
				<span class=""></span>
			<!--</a>-->
			<a class="btn dropdown-toggle" href="<?php echo $home_path; ?>/dashboard.php" >
				<i class="icon-user"></i>
				<span class="" style="color:#fff;font-weight:700;text-transform:uppercase;font-size:13px;"><?php  echo $rowAC['cur_date']; ?></span>
				<span class="" style="color:#fff;font-weight:700;text-transform:uppercase;font-size:13px;" id="txt"></span>
				<span class=""></span>
			</a>
			
			<a class="btn dropdown-toggle" href="<?php echo $home_path; ?>/admin/user-master.php" >
				<i class="icon-user"></i>
				<span class="" style="color:#fff;font-weight:700;text-transform:uppercase;font-size:13px;"><?php echo $_SESSION['user']; ?></span>
				<span class=""></span>
			</a>
			<!--<a class="btn dropdown-toggle" href="<?php/*  echo $home_path;  */?>/logout.php" style="height:28px;">-->
			<a class="btn dropdown-toggle" href="<?php echo $home_path; ?>/logout.php">
				<!--<i class="icon-logout"></i>-->
				<i class="icon-logout"></i>
				<span class="" style="color:#fff;font-weight:700;text-transform:uppercase;font-size:13px;">Logout</span>
				<span class=""></span>
			</a>
		</div>
			</div>
				<?php  include("menu.php"); ?>
			</div>
		</div>
	</div>

   <script src="<?php echo $home_path; ?>/megamenu-js-master/js/megamenu.js"></script>   
	   
       