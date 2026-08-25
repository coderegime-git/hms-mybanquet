<?php 
ob_start();
session_start(); 
include("config.php");
?>

<!DOCTYPE> 
<html>

<!--<!DOCTYPE HTML>
<html>-->
<head>
<title>MYPOS</title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Home Jobs, Data Entry, Data Outsourcing, Online Jobs" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- //for-mobile-apps -->
<link href="<?php echo $home_path; ?>/css/bootstrap.css" rel='stylesheet' type='text/css' />
<!--<link href='//fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600,700,800,900' rel='stylesheet' type='text/css'>
<link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>-->
<link rel="stylesheet" type="text/css" href="<?php echo $home_path; ?>/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo $home_path; ?>/css/ie.css">
<link rel="stylesheet" href="<?php echo $home_path; ?>/css/flexslider.css" type="text/css" media="screen" />
<!---strat-slider---->
<script type="text/javascript" src="<?php echo $home_path; ?>/js/jquery-1.11.1.min.js"></script>
<!---//-slider---->

<script src="<?php echo $home_path; ?>/js/shortcut.js" type="text/javascript"></script>
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
</script>
<body>
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
	<div class="header_bg" style="  background: linear-gradient(#3496C3, #3496C3); ">
		<!--<div class="container" >-->
			<!-----start-header----->
		<div class="" >
			<div class="header" >
			
			
				<!--<div class="logo">-->
<div style="padding:10px;">
					<a href="<?php echo $home_path;?>/dashboard.php"><img src="<?php echo $home_path; ?>/images/hmsmysoftname.png" alt="" style="width:109px;height:30px;" /></a>
					
	<div class="btn-group pull-right" style="/* margin:7px -26px 0 0; */">
	<!--<span style="margin-left:0px;margin-top:0px;">
	<select id="get_company" title="" name="get_company" onchange="selectcompany();" style="height:29px;font-size:15px;width:120px;margin: 5px 0 0;">
	<?php /* echo $companyname; */?>
	</select>
</span>	-->

			<a class="btn dropdown-toggle" href="<?php echo $home_path; ?>/index.php" style="margin:0 0 0 -742px;">
				<i class="icon-home"></i>
				<span class="" style="color:#fff;font-weight:700;text-transform:uppercase;font-size:13px;">Welcome To MYPOS</span>
				<span class=""></span>
			</a>
			<a class="btn dropdown-toggle" href="#" data-toggle="dropdown" style="margin:0 0 0 -650px;">
				<i class="icon-user"></i>
				<span class="" style="color:#fff;font-weight:700;text-transform:uppercase;font-size:13px;"><?php /* echo $company_name; */ ?></span>
				<span class=""></span>
			</a>
			
			
			<a class="btn dropdown-toggle" href="#" data-toggle="dropdown">
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
				<?php  include("menu-other.php"); ?>
			</div>
		</div>
	</div>

	   
       