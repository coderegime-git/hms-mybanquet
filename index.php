<?php 
include("config.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>RMS BANQUET</title>

	<link rel="stylesheet" href="login-form/css/animate.css">
	<!-- Custom Stylesheet -->
	<link rel="stylesheet" href="login-form/css/style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo $home_path; ?>/css/loader.css">
	<script type="text/javascript" src="<?php echo $home_path; ?>/js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="<?php echo $home_path; ?>/js/loader.js"></script>
	
</head>

<body>
<!-- Global Page Loader Markup -->
<div id="global-loader-overlay">
	<div class="global-loader-box">
		<div class="global-spinner"></div>
		<div class="global-loader-text">Loading, please wait...</div>
	</div>
</div>
	<div class="container">
		<div class="top">
			<h1 id="title" class="hidden"><span id="logo">MY <span>BANQUET</span></span></h1>
		</div>
		
<?php 	
if(isset($_GET['msg'])){
?>
<label id="msgFo" class="" style="color:red;margin:0 0 0 0px;padding:4px 15px 4px 15px;font-weight:bold;"><?php echo $_GET['msg']; ?></label>
<?php } ?>	

		<div class="login-box animated fadeInUp">
			<div class="box-header">
				<h2>Log In</h2>
			</div>
			<form class="login active" action="userAuthenticate.php" method="post" name="loginfrm">
				
				<label for="username">Username</label>
				<br/>
				<input type="text" name="username" id="username">
				<br/>
				<label for="password">Password</label>
				<br/>
				<input type="password" name="password" id="password">
				<br/>
				<button type="submit" name="submit">Sign In</button>
				<br/>
				  <a href="#"><p class="small">Forgot your password?</p></a>
			 </form>
		</div>
	</div>
	
</body>

<script>
	$(document).ready(function () {
		$("#msgFo").fadeOut(5000);
    	$('#logo').addClass('animated fadeInDown');
    	$("input:text:visible:first").focus();
	});
	$('#username').focus(function() {
		$('label[for="username"]').addClass('selected');
	});
	$('#username').blur(function() {
		$('label[for="username"]').removeClass('selected');
	});
	$('#password').focus(function() {
		$('label[for="password"]').addClass('selected');
	});
	$('#password').blur(function() {
		$('label[for="password"]').removeClass('selected');
	});
</script>
 <!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>-->
        <script type="text/javascript" src="elastic-slider/js/jquery.eislideshow.js"></script>
        <script type="text/javascript" src="elastic-slider/js/jquery.easing.1.3.js"></script>
        <script type="text/javascript">
            $(function() {
                $('#ei-slider').eislideshow({
					animation			: 'center',
					autoplay			: true,
					slideshow_interval	: 3000,
					titlesFactor		: 0
                });
            });
        </script>
</html>